<div class="search-results-container">
    <div class="search-header">
    
        <form method="get" action="<?php echo $this->url->href('GlobalSearchController', 'search', ['plugin' => 'Globalsearch']) ?>" class="navbar-form navbar-right search-bar">
            <input type="text" name="q" placeholder="<?= t('Search') ?>..." class="form-control" value="<?php echo ($this->text->e($query)) ? $this->text->e($query) : '' ; ?>" required>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
            
            <div class="search-filters">
                <label><input type="checkbox" name="filter_tasks" value="1" <?php if ($filter_tasks) echo 'checked'; ?>> <strong><i class="fa fa-tasks"></i> <?php echo t('Task') ?></strong></label>
                <label><input type="checkbox" name="filter_comments" value="1" <?php if ($filter_comments) echo 'checked'; ?>> <strong><i class="fa fa-comment"></i> <?php echo t('Comment') ?></strong></label>
                <label><input type="checkbox" name="filter_projects" value="1" <?php if ($filter_projects) echo 'checked'; ?>> <strong><i class="fa fa-th"></i> <?php echo t('Project') ?></strong></label>
            </div>
        </form>

        <hr>

        <h2><?php echo t('Results for:') ?> "<?php echo $this->text->e($query) ?>"</h2>
        <p><?php echo $count_results; ?> <?php echo t('results found') ?></p>
    </div>

    <?php 
    function truncate_text($text, $maxLength = 150) {
        if (strlen($text) > $maxLength) {
            return substr($text, 0, $maxLength) . '...';
        }
        return $text;
    }
    ?>

    <ul class="search-results-list">
        <?php foreach ($results as $result): ?>
            <li class="search-result-item">
                <?php if (isset($result['title'])): ?>
                    <strong><i class="fa fa-tasks"></i> <?php echo t('Task') ?></strong>
                    <a href="<?php echo $this->url->href('TaskViewController', 'show', ['task_id' => $result['id'], 'project_id' => $result['project_id']]) ?>"
                       target="_blank">
                        <?php echo $this->text->e($result['title']) ?>
                    </a>
                    <p>
                        <?php echo $this->text->e(truncate_text($result['description'])) ?>
                    </p>
                    <small><?php echo $this->dt->datetime($result['date_creation']); ?></small>

                <?php elseif (isset($result['comment'])): ?>
                    <strong><i class="fa fa-comment"></i> <?php echo t('Comment') ?></strong>
                    <a href="<?php echo $this->url->href('TaskViewController', 'show', ['task_id' => $result['task_id']]) ?>#comment-<?php echo $result['comment_id']; ?>"
                       target="_blank">
                        <?php echo t('Comment on task') ?>
                    </a>
                    <p>
                        <?php echo $this->text->e(truncate_text($result['comment'])) ?>
                    </p>
                    <small><?php echo $this->dt->datetime($result['date_creation']); ?></small>

                <?php elseif (isset($result['name'])): ?>
                    <strong><i class="fa fa-th"></i> <?php echo t('Project') ?></strong>
                    <a href="<?php echo $this->url->href('ProjectViewController', 'show', ['project_id' => $result['id']]) ?>"
                       target="_blank">
                        <?php echo $this->text->e($result['name']) ?>
                    </a>
                    <p>
                        <?php echo $this->text->e(truncate_text($result['description'])) ?>
                    </p>
                <?php endif ?>
            </li>
        <?php endforeach ?>
    </ul>

    <div class="search-p-5">
        <?php if (empty($results)): ?>
            <p><?php echo t('No results found for') ?> "<?php echo $this->text->e($query) ?>"</p>
        <?php endif ?>
    </div>
</div>
