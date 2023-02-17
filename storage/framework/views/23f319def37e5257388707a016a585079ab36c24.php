<?php if(userPermission(399) && menuStatus(399)): ?>
    <li data-position="<?php echo e(menuPosition(399)); ?>">
        <a href="<?php echo e(route('manage-adons')); ?>"><?php echo app('translator')->get('system_settings.module_manager'); ?></a>
    </li>
<?php endif; ?>





<?php if(userPermission(549) && menuStatus(549)): ?>

    <li data-position="<?php echo e(menuPosition(549)); ?>">
        <a href="<?php echo e(route('language-list')); ?>"><?php echo app('translator')->get('system_settings.language'); ?></a>
    </li>
<?php endif; ?>

<?php if(userPermission(456) && menuStatus(465)): ?>

    <li data-position="<?php echo e(menuPosition(465)); ?>">
        <a href="<?php echo e(route('backup-settings')); ?>"><?php echo app('translator')->get('system_settings.backup_settings'); ?></a>
    </li>
<?php endif; ?>




<?php if(userPermission(478) && menuStatus(478)): ?>

    <li data-position="<?php echo e(menuPosition(478)); ?>">
        <a href="<?php echo e(route('update-system')); ?>"> <?php echo app('translator')->get('system_settings.about_&_update'); ?></a>
    </li>
<?php endif; ?>

<?php if(userPermission(4000) && menuStatus(4000)): ?>

    <li data-position="<?php echo e(menuPosition(4000)); ?>">
        <a href="<?php echo e(route('utility')); ?>"><?php echo app('translator')->get('system_settings.utilities'); ?></a>
    </li>
<?php endif; ?>

<?php if(userPermission(482) && menuStatus(482)): ?>
    <li data-position="<?php echo e(menuPosition(482)); ?>">
        <a href="<?php echo e(route('api/permission')); ?>"><?php echo app('translator')->get('system_settings.api_permission'); ?> </a>
    </li>
<?php endif; ?>


<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/school_erp/resources/views/backEnd/partials/without_saas_school_admin_menu.blade.php ENDPATH**/ ?>