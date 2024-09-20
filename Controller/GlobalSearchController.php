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

        $results = $this->searchQuery($query, $filterTasks, $filterComments, $filterProjects);

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

        if (!$this->userSession->isLogged()) {
            return $results;
        }

        $accessibleProjectIds = $this->projectPermissionModel->getProjectIds($this->userSession->getId());

        if ($filterTasks && !empty($accessibleProjectIds)) {
            $tasks = $this->db->table(TaskModel::TABLE)
                ->beginOr()
                ->ilike('title', '%' . $query . '%')
                ->ilike('description', '%' . $query . '%')
                ->closeOr()
                ->in('project_id', $accessibleProjectIds)
                ->desc('date_creation')
                ->findAll();

            $results = array_merge($results, $tasks);
        }

        if ($filterComments && !empty($accessibleProjectIds)) {
            $comments = $this->db->table(CommentModel::TABLE)
                ->join(TaskModel::TABLE, 'id', 'task_id')
                ->ilike('comment', '%' . $query . '%')
                ->in(TaskModel::TABLE . '.project_id', $accessibleProjectIds)
                ->desc(CommentModel::TABLE . '.date_creation')
                ->findAll();

            $comments = array_map(function ($array) {
                return [
                    'task_id' => $array['task_id'],
                    'comment' => $array['comment']
                ];
            }, $comments);

            $results = array_merge($results, $comments);
        }

        if ($filterProjects && !empty($accessibleProjectIds)) {
            $projects = $this->db->table(ProjectModel::TABLE)
                ->ilike('name', '%' . $query . '%')
                ->in('id', $accessibleProjectIds)
                ->desc('id')
                ->findAll();

            $results = array_merge($results, $projects);
        }

        return $results;
    }
}
