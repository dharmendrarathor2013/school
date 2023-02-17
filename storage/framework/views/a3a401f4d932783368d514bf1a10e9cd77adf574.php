<?php if(auth()->user()->student): ?>
    <?php if(userPermission(1156) && menuStatus(1156)): ?>
        <li data-position="<?php echo e(menuPosition(1156)); ?>" class="sortable_li">
            <a href="<?php echo e(route('fees.student-fees-list',[auth()->user()->student->id])); ?>">
                <div class="nav_icon_small">
                    <span class="flaticon-wallet"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('fees.fees'); ?>
                </div>
            </a>
        </li>
    <?php endif; ?>
<?php endif; ?><?php /**PATH /var/www/html/impact-eschool-erp-main/Modules/Fees/Resources/views/sidebar/feesStudentSidebar.blade.php ENDPATH**/ ?>