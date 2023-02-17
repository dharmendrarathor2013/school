<?php $__currentLoopData = $due_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-4 col-md-6 all_courses">
        <div class="academic-item">
            <div class="academic-img" 
                style="background:  
                url(<?php echo e($value->image != ""? asset($value->image) : '../img/client/common-banner1.jpg'); ?>) 
                            no-repeat top;">
                </div>
            <div class="academic-text">
                <h4>
                    <a href="<?php echo e(url('course-Details/'.$value->id)); ?>"><?php echo e($value->title); ?></a>
                </h4>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" value="<?php echo e($skip+count($due_courses)); ?>" class="hide-button">
<input type="hidden" value="<?php echo e($count); ?>" class="count-course"><?php /**PATH D:\xampp\htdocs\InfixEduv6.6.1\resources\views/frontEnd/home/loadMorePage.blade.php ENDPATH**/ ?>