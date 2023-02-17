<?php if(userPermission(1157) && menuStatus(1157)): ?>
    <li data-position="<?php echo e(menuPosition(1157)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">            
            <div class="nav_icon_small">
                <span class="flaticon-reading"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('fees::feesModule.fees'); ?>
            </div>
        </a>
        <ul class="list-unstyled">
            <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e(route('fees.student-fees-list', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </li>
<?php endif; ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/Modules/Fees/Resources/views/sidebar/feesParentSidebar.blade.php ENDPATH**/ ?>