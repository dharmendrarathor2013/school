<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('study.others_download'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('study.assignment_list'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('study.study_material'); ?></a>
                <a href="#"><?php echo app('translator')->get('study.assignment_list'); ?></a>
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
                                            <th><?php echo app('translator')->get('study.content_title'); ?></th>
                                            <th><?php echo app('translator')->get('common.type'); ?></th>
                                            <th><?php echo app('translator')->get('common.date'); ?></th>
                                            <th><?php echo app('translator')->get('study.available_for'); ?></th>                                           
                                            <th style="max-width:30%"><?php echo app('translator')->get('common.description'); ?></th>
                                            <th><?php echo app('translator')->get('common.action'); ?></th>
                                        </tr>
                                    </thead>
                
                                    <tbody>
                                        
                                        <?php $__currentLoopData = $record->getUploadContent('as'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                
                                            <td><?php echo e(@$value->content_title); ?></td>
                                            <td>
                                                <?php if(@$value->content_type == 'as'): ?>
                                                    <?php echo e('Assignment'); ?>

                                                <?php elseif(@$value->content_type == 'st'): ?>
                                                    <?php echo e('Study Material'); ?>

                                                <?php elseif(@$value->content_type == 'sy'): ?>
                                                    <?php echo e('Syllabus'); ?>

                                                <?php else: ?>
                                                    <?php echo e('Others Download'); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td  data-sort="<?php echo e(strtotime(@$value->upload_date)); ?>" >
                                            <?php echo e(@$value->upload_date != ""? dateConvert(@$value->upload_date):''); ?>

                
                                            </td>
                                            <td>
                                                <?php if(@$value->available_for_admin == 1): ?>
                                                    <?php echo app('translator')->get('study.all_admins'); ?><br>
                                                <?php endif; ?>
                                                <?php if(@$value->available_for_all_classes == 1): ?>
                                                    <?php echo app('translator')->get('study.all_classes_student'); ?>
                                                <?php endif; ?>
                
                                                <?php if(@$value->classes != "" && $value->sections != ""): ?>
                                                    <?php echo app('translator')->get('study.all_students_of'); ?> (<?php echo e(@$value->classes->class_name.'->'.@$value->sections->section_name); ?>)
                                                <?php endif; ?>
                                                <?php if(@$value->classes != "" && $value->sections ==null): ?>
                                                <?php echo app('translator')->get('study.all_students_of'); ?> (<?php echo e(@$value->classes->class_name.'->'.'All Sections'); ?>)
                                            <?php endif; ?>
                                            </td>
                                          
                                            <td>
                
                                            <?php echo e(\Illuminate\Support\Str::limit(@$value->description, 500)); ?>

                
                
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <?php echo app('translator')->get('common.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a data-modal-size="modal-lg" title="View Content Details" class="dropdown-item modalLink" href="<?php echo e(route('upload-content-student-view', $value->id)); ?>"><?php echo app('translator')->get('common.view'); ?></a>
                                                        <?php if(@$value->upload_file != ""): ?>
                                                            <?php if(userPermission(32)): ?>
                                                            <a class="dropdown-item" href="<?php echo e(url(@$value->upload_file)); ?>" download>
                                                                <?php echo app('translator')->get('study.download'); ?>  <span class="pl ti-download"></span>
                                                            </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    </div>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/studentPanel/assignmentList.blade.php ENDPATH**/ ?>