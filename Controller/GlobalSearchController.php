<?php

namespace Kanboard\Plugin\GlobalSearch\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Model\CommentModel;
use Kanboard\Model\ProjectModel;
use Kanboard\Model\TaskModel;

/**
 * This file is part of the Kanboard GlobalSearch Plugin project.
 *
 *
 * @package     Kanboard GlobalSearch Plugin
 * @author      Valentino Pesce
 * @copyright   2024 (c) Valentino Pesce
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class GlobalSearchController extends BaseController
{
    public function search()
    {
        $query = $this->request->getStringParam('q');

        $filterTasks = $this->request->getIntegerParam('filter_tasks');
        $filterComments = $this->request->getIntegerParam('filter_comments');
        $filterProjects = $this->request->getIntegerParam('filter_projects');

        $results = $this->searchQuery(trim($query), $filterTasks, $filterComments, $filterProjects);

        $this->response->html($this->helper->layout->app('Globalsearch:global_search/search', [
            'title' => t('Global search'),
            'results' => $results,
            'count_results' => count($results),
            'query' => $query,
            'filter_tasks' => $filterTasks,
            'filter_comments' => $filterComments,
            'filter_projects' => $filterProjects,
        ]));
    }

    private function searchQuery($query, $filterTasks, $filterComments, $filterProjects)
    {
        $results = [];

        if (!$this->userSession->isLogged() or empty($query)) {
            return $results;
        }

        $accessibleProjectIds = $this->projectPermissionModel->getProjectIds($this->userSession->getId());

        $keywords = array_filter(explode(' ', $query));

        if ($filterTasks && !empty($accessibleProjectIds)) {
            $tasksQuery = $this->db->table(TaskModel::TABLE);

            foreach ($keywords as $keyword) {
                $tasksQuery->beginOr()
                    ->ilike('title', '%' . $keyword . '%')
                    ->ilike('description', '%' . $keyword . '%')
                    ->closeOr();
            }

            $tasksQuery->in('project_id', $accessibleProjectIds)
                ->desc('date_creation');

            $tasks = $tasksQuery->findAll();
            $results = array_merge($results, $tasks);
        }

        if ($filterComments && !empty($accessibleProjectIds)) {
            $commentsQuery = $this->db->table(CommentModel::TABLE)
                ->columns(
                    CommentModel::TABLE . '.id AS comment_id',
                    CommentModel::TABLE . '.task_id',
                    CommentModel::TABLE . '.comment',
                    CommentModel::TABLE . '.date_creation'
                )
                ->join(TaskModel::TABLE, 'id', 'task_id');

            foreach ($keywords as $keyword) {
                $commentsQuery->ilike('comment', '%' . $keyword . '%');
            }

            $commentsQuery->in(TaskModel::TABLE . '.project_id', $accessibleProjectIds)
                ->desc(CommentModel::TABLE . '.date_creation');

            $comments = $commentsQuery->findAll();
            $comments = array_map(function ($array) {
                return [
                    'comment_id' => $array['comment_id'],
                    'task_id' => $array['task_id'],
                    'comment' => $array['comment'],
                    'date_creation' => $array['date_creation']
                ];
            }, $comments);
            $results = array_merge($results, $comments);
        }

        if ($filterProjects && !empty($accessibleProjectIds)) {
            $projectsQuery = $this->db->table(ProjectModel::TABLE);

            foreach ($keywords as $keyword) {
                $projectsQuery->ilike('name', '%' . $keyword . '%');
            }

            $projectsQuery->in('id', $accessibleProjectIds)
                ->desc('id');

            $projects = $projectsQuery->findAll();
            $results = array_merge($results, $projects);
        }

        return $results;
    }
}
