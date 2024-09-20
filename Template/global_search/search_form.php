<form method="get" action="<?php echo $this->url->href('GlobalSearchController', 'search', ['plugin' => 'Globalsearch']) ?>" class="navbar-form navbar-right" style="width: 100%;">
    <div style="display: flex; width: 100%;">
        <input type="text" name="q" placeholder="<?= t('Global search') ?>..." class="form-control" required style="flex: 1; width: 100%; padding: 5px; font-size: 16px;">
        <input type="hidden" name="filter_tasks" value="1">
        <input type="hidden" name="filter_comments" value="1">
        <input type="hidden" name="filter_projects" value="1">
        <button type="submit" class="btn btn-primary" style="flex: 0 0 auto; padding: 5px 20px;">
            <i class="fa fa-search" aria-hidden="true" style="color: #00a3d4;"></i>
        </button>
    </div>
</form>
