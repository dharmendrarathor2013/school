<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('exam.exam_type'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('exam.exam_type'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('exam.examination'); ?></a>
                <a href="#"><?php echo app('translator')->get('exam.exam_type'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="offset-lg-9 col-lg-3 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('exam')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('exam.exam_setup'); ?>
                </a>
            </div>

        </div>
        <?php if(isset($exam_type_edit)): ?>
         <?php if(userPermission(209)): ?>
                       
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('exam-type')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($exam_type_edit)): ?>
                                    <?php echo app('translator')->get('exam.edit_exam_type'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('exam.add_exam_type'); ?>
                                <?php endif; ?>
                              
                            </h3>
                        </div>
                        <?php if(isset($exam_type_edit)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_type_update', 'method' => 'POST'])); ?>

                        <?php else: ?>
                         <?php if(userPermission(209)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'exam_type_store', 'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                       
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('exam_type_title') ? ' is-invalid' : ''); ?>" type="text" name="exam_type_title" autocomplete="off" value="<?php echo e(isset($exam_type_edit)? $exam_type_edit->title : ''); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($exam_type_edit)? $exam_type_edit->id: Request::old('exam_type_title')); ?>">
                                            <label> <?php echo app('translator')->get('exam.exam_name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('exam_type_title')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('exam_type_title')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>


                                    </div>
                                </div>  


	                            <?php 
                                  $tooltip = "";
                                  if(userPermission(209)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($exam_type_edit)): ?>
                                                <?php echo app('translator')->get('exam.update_exam_type'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('exam.save_exam_type'); ?>
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
                            <h3 class="mb-0 "><?php echo app('translator')->get('exam.exam_type_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                              
                                <tr>
                                    <th><?php echo app('translator')->get('common.sl'); ?></th>
                                    <th><?php echo app('translator')->get('exam.exam_name'); ?></th>
                                    
                                    <th><?php echo app('translator')->get('common.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i=0; ?>
                                <?php $__currentLoopData = $exams_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exams_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$i); ?></td>
                                    <td><?php echo e(@$exams_type->title); ?></td>
                                    
                                    <td>
                                        <div class="dropdown-widget d-flex align-items-center flex-wrap">
                                                <div class="dropdown mr-1 mb-1">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <?php echo app('translator')->get('common.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">

                                                        <?php if(userPermission(210)): ?>

                                                        <a class="dropdown-item" href="<?php echo e(route('exam_type_edit', [$exams_type->id])); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(userPermission(211)): ?>

                                                        <a class="dropdown-item" data-toggle="modal" data-target="#deleteSubjectModal<?php echo e(@$exams_type->id); ?>"  href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                                   <?php endif; ?>
                                                    </div>
                                                </div>
                                                 <a  class="primary-btn small tr-bg" href="<?php echo e(route('exam-marks-setup',$exams_type->id)); ?>">
                                                    <span class="pl ti-settings"></span> <?php echo app('translator')->get('exam.exam_setup'); ?>
                                                </a>
                                        </div>
                                    </td>
                                </tr>
                                 <div class="modal fade admin-query" id="deleteSubjectModal<?php echo e(@$exams_type->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('exam.delete_exam_type'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                    <a href="<?php echo e(route('exam_type_delete', [@$exams_type->id])); ?>" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.delete'); ?></button>
                                                     </a>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/examination/exam_type.blade.php ENDPATH**/ ?>