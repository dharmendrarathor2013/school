<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('student.student_group'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('student.student_group'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('admin-dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('student.student_information'); ?></a>
                <a href="#"><?php echo app('translator')->get('student.student_group'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($student_group)): ?>
         <?php if(userPermission(77)): ?>
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('student_group')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('common.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
          
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($student_group)): ?>
                                    <?php echo app('translator')->get('student.edit_student_group'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('student.add_student_group'); ?>
                                <?php endif; ?>
                             
                            </h3>
                        </div>
                        <?php if(isset($student_group)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_group_update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                          <?php if(userPermission(77)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_group_store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                       
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('group') ? ' is-invalid' : ''); ?>"
                                                type="text" name="group" autocomplete="off" value="<?php echo e(isset($student_group)? $student_group->group: old('group')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($student_group)? $student_group->id: ''); ?>">
                                            <label><?php echo app('translator')->get('student.group'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('group')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('group')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <?php 
                                  $tooltip = "";
                                  if(userPermission(77)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($student_group)): ?>
                                                <?php echo app('translator')->get('student.update_group'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('student.save_group'); ?>
                                            <?php endif; ?>
                                          
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('student.student_group_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                               
                                <tr>
                                    <th><?php echo app('translator')->get('student.group'); ?></th>
                                    <th><?php echo app('translator')->get('student.students'); ?></th>
                                    <th><?php echo app('translator')->get('common.actions'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $student_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($student_group->group); ?></td>
                                    <td><?php echo e(@$student_group->students_count); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('common.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(79)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('student_group_edit', [$student_group->id])); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                               <?php endif; ?>
                                               <?php if(userPermission(80)): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteStudentGroupModal<?php echo e($student_group->id); ?>"
                                                    href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                            <?php endif; ?>
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteStudentGroupModal<?php echo e($student_group->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('student.delete_group'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                    <a href="<?php echo e(route('student_group_delete', [$student_group->id])); ?>"><button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.delete'); ?></button></a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/studentInformation/student_group.blade.php ENDPATH**/ ?>