<div class="search-results-container" style="max-width: 800px; margin: 0 auto; padding-top: 20px;">
    <div class="search-header">
    
        <form method="get" action="<?php echo $this->url->href('GlobalSearchController', 'search', ['plugin' => 'Globalsearch']) ?>" class="navbar-form navbar-right" style="width: 100%;">
            <div style="display: flex; width: 100%;">
                <input type="text" name="q" placeholder="<?= t('Search') ?>..." class="form-control" value="<?php echo ($query) ? $query : '' ; ?>" required style="flex: 1; width: 100%; padding: 5px; font-size: 16px;">
                <button type="submit" class="btn btn-primary" style="flex: 0 0 auto; padding: 5px 20px;">
                    <i class="fa fa-search" aria-hidden="true" style="color: #00a3d4;"></i>
                </button>
            </div>
            <div style="margin-bottom: 15px; display: flex; gap: 10px;">
                <label><input type="checkbox" name="filter_tasks" value="1" <?php if ($filter_tasks) echo 'checked'; ?>> <?php echo t('Task') ?></label>
                <label><input type="checkbox" name="filter_comments" value="1" <?php if ($filter_comments) echo 'checked'; ?>> <?php echo t('Comments') ?></label>
                <label><input type="checkbox" name="filter_projects" value="1" <?php if ($filter_projects) echo 'checked'; ?>> <?php echo t('Projects') ?></label>
            </div>
        </form>

        <hr>

        <h2><?php echo t('Results for:') ?> "<?php echo $this->text->e($query) ?>"</h2>
        <p style="margin-bottom: 15px;"><?php echo $count_results; ?> <?php echo t('results found') ?></p>
    </div>

    <?php 
    function truncate_text($text, $maxLength = 150) {
        if (strlen($text) > $maxLength) {
            return substr($text, 0, $maxLength) . '...';
        }
        return $text;
    }
    ?>

    <ul class="search-results-list" style="list-style: none; padding-left: 0;">
        <?php foreach ($results as $result): ?>
            <li class="search-result-item" style="margin-bottom: 10px;padding: 20px;border-radius: 10px;background: #f9f9f9;border-bottom: 2px solid #ddd;">
                <?php if (isset($result['title'])): ?>
                    <strong><i class="fa fa-tasks"></i> <?php echo t('Task') ?></strong>
                    <a href="<?php echo $this->url->href('TaskViewController', 'show', ['task_id' => $result['id'], 'project_id' => $result['project_id']]) ?>"
                       target="_blank" style="display: block; font-size: 18px; text-decoration: none;">
                        <?php echo $this->text->e($result['title']) ?>
                    </a>
                    <p style="font-size: 14px; color: #4d4d4d;">
                        <?php echo $this->text->e(truncate_text($result['description'])) ?>
                    </p>

                <?php elseif (isset($result['comment'])): ?>
                    <strong><i class="fa fa-comment"></i> <?php echo t('Comment') ?></strong>
                    <a href="<?php echo $this->url->href('TaskViewController', 'show', ['task_id' => $result['task_id']]) ?>"
                       target="_blank" style="display: block; font-size: 18px; text-decoration: none;">
                        <?php echo t('Comment on task') ?>
                    </a>
                    <p style="font-size: 14px; color: #4d4d4d;">
                        <?php echo $this->text->e(truncate_text($result['comment'])) ?>
                    </p>

                <?php elseif (isset($result['name'])): ?>
                    <strong><i class="fa fa-th"></i> <?php echo t('Project') ?></strong>
                    <a href="<?php echo $this->url->href('ProjectViewController', 'show', ['project_id' => $result['id']]) ?>"
                       target="_blank" style="display: block; font-size: 18px; text-decoration: none;">
                        <?php echo $this->text->e($result['name']) ?>
                    </a>
                    <p style="font-size: 14px; color: #4d4d4d;">
                        <?php echo $this->text->e(truncate_text($result['description'])) ?>
                    </p>
                <?php endif ?>
            </li>
        <?php endforeach ?>
    </ul>

    <?php if (empty($results)): ?>
        <p><?php echo t('No results found for') ?> "<?php echo $this->text->e($query) ?>"</p>
    <?php endif ?>
</div>
