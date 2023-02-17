<?php if(userPermission(920) && menuStatus(920)): ?>
<li data-position="<?php echo e(menuPosition(920)); ?>" class="sortable_li">
    <a href="javascript:void(0)" class="has-arrow" aria-expanded="false"> 
        <div class="nav_icon_small">
            <span class="flaticon-test"></span>
        </div>
        <div class="nav_title">
            <?php echo app('translator')->get('bulkprint::bulk.bulk_print'); ?>
        </div>
    </a>
    <ul class="list-unstyled" id="subMenuBulkPrint">
        <?php if(userPermission(921)  && menuStatus(921)): ?>
            <li data-position="<?php echo e(menuPosition(921)); ?>">
                <a href="<?php echo e(route('student-id-card-bulk-print')); ?>"><?php echo app('translator')->get('admin.id_card'); ?></a>
            </li>
       <?php endif; ?>
        <?php if(userPermission(922)  && menuStatus(922)): ?>
            <li data-position="<?php echo e(menuPosition(922)); ?>">
                <a href="<?php echo e(route('certificate-bulk-print')); ?>">  <?php echo app('translator')->get('admin.student_certificate'); ?></a>
            </li>
          <?php endif; ?>
 

     <?php if(userPermission(924)  && menuStatus(924)): ?>
        <li data-position="<?php echo e(menuPosition(924)); ?>">
            <a href="<?php echo e(route('payroll-bulk-print')); ?>"> <?php echo app('translator')->get('bulkprint::bulk.payroll_bulk_print'); ?></a>
        </li>
    <?php endif; ?>
    <?php if(generalSetting()->fees_status == 0): ?>
        <?php if(userPermission(926)  && menuStatus(926)): ?>
            <li data-position="<?php echo e(menuPosition(926)); ?>">
                <a href="<?php echo e(route('fees-bulk-print')); ?>"> <?php echo app('translator')->get('bulkprint::bulk.fees_invoice_bulk_print'); ?></a>
            </li>
        <?php endif; ?>
        
        <?php if(userPermission(925)  && menuStatus(925)): ?>
            <li data-position="<?php echo e(menuPosition(925)); ?>">
                <a href="<?php echo e(route('invoice-settings')); ?>"> <?php echo app('translator')->get('bulkprint::bulk.fees_invoice_settings'); ?></a>
            </li>
        <?php endif; ?>
    <?php else: ?>
        <?php if(userPermission(1162)  && menuStatus(1162)): ?>
            <li data-position="<?php echo e(menuPosition(1162)); ?>">
                <a href="<?php echo e(route('fees-invoice-bulk-print')); ?>"> <?php echo app('translator')->get('bulkprint::bulk.fees_invoice_bulk_print'); ?></a>
            </li>
        <?php endif; ?>
        <?php if(userPermission(1162)  && menuStatus(1162)): ?>
            <li data-position="<?php echo e(menuPosition(1162)); ?>">
                <a href="<?php echo e(route('fees-invoice-bulk-print-settings')); ?>"> <?php echo app('translator')->get('bulkprint::bulk.fees_invoice_bulk_print_settings'); ?></a>
            </li>
        <?php endif; ?>
    <?php endif; ?>

        <?php if(moduleStatusCheck('Lms')== True): ?>
            <?php if(userPermission(1566)  && menuStatus(1566)): ?>
                <li data-position="<?php echo e(menuPosition(1566)); ?>">
                    <a href="<?php echo e(route('lms-certificate-bulk-print')); ?>"> <?php echo app('translator')->get('bulkprint::bulk.lms_certificate'); ?></a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>
<?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/Modules/BulkPrint/Resources/views/menu/bulk_print_sidebar.blade.php ENDPATH**/ ?>