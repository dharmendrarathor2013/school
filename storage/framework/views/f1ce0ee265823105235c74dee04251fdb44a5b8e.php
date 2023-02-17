<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('academics.subject_list'); ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('common.subject'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="<?php echo e(route('student_subject')); ?>"><?php echo app('translator')->get('common.subject'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
       
        <div class="row">
            <div class="col-lg-12 student-details up_admin_visitor">
                <ul class="nav nav-tabs tabs_scroll_nav ml-0" role="tablist">

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
                                        <th><?php echo app('translator')->get('common.subject'); ?></th>
                                        <th><?php echo app('translator')->get('common.teacher'); ?></th>
                                        <th><?php echo app('translator')->get('academics.subject_type'); ?></th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    <?php $__currentLoopData = $record->AssignSubject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignSubject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$assignSubject->subject!=""?@$assignSubject->subject->subject_name:""); ?></td>
                                        <td><?php echo e(@$assignSubject->teacher!=""?@$assignSubject->teacher->full_name:""); ?></td>
                                        <td>
                                            <?php if(!empty(@$assignSubject->subject)): ?>
                                            <?php echo e(@$assignSubject->subject->subject_type == "T"? 'Theory': 'Practical'); ?>

                                            <?php endif; ?>
                                        </td>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/studentPanel/student_subject.blade.php ENDPATH**/ ?>