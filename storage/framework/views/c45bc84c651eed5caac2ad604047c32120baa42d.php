<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('hr.teachers_list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('hr.teachers_list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('hr.teachers'); ?></a>
                <a href="#"><?php echo app('translator')->get('hr.teachers_list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
       
        <div class="row">
            <div class="col-lg-12 student-details up_admin_visitor">
                <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">

                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <li class="nav-item">
                        <a class="nav-link <?php if($key== 0): ?> active <?php endif; ?> " href="#tab<?php echo e($key); ?>" role="tab" data-toggle="tab"><?php echo e($record->class->class_name); ?> (<?php echo e($record->section->section_name); ?>) </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
                <!-- Tab panes -->
                <div class="tab-content mt-40">
                    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <div role="tabpanel" class="tab-pane fade  <?php if($key== 0): ?> active show <?php endif; ?>" id="tab<?php echo e($key); ?>">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>
                                    <tr> 
                                        <th><?php echo app('translator')->get('hr.teacher_name'); ?></th>
                                        <th><?php echo app('translator')->get('common.email'); ?></th>
                                        <th><?php echo app('translator')->get('common.phone'); ?></th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    <?php $__currentLoopData = $record->StudentTeacher; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr> 
                                        <td>
                                            <img src="<?php echo e(file_exists(@$value->teacher->staff_photo) ? asset(@$value->teacher->staff_photo) : asset('public/uploads/staff/demo/staff.jpg')); ?>" class="img img-thumbnail" style="width: 60px; height: auto;">
                                            <?php echo e(@$value->teacher !=""?@$value->teacher->full_name:""); ?>

                                        </td> 
                                        <td><?php echo e(@$value->teacher !=""?@$value->teacher->email:""); ?></td>
                                        <td><?php echo e(@$value->teacher !=""?@$value->teacher->mobile:""); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/studentPanel/studentTeacher.blade.php ENDPATH**/ ?>