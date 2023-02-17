<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('academics.subject'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('academics.subject'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('academics.academics'); ?></a>
                <a href="#"><?php echo app('translator')->get('academics.subject'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($subject)): ?>
          <?php if(userPermission(258)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('subject')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($subject)): ?>
                                    <?php echo app('translator')->get('academics.edit_subject'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('academics.add_subject'); ?>
                                <?php endif; ?>
                              
                            </h3>
                        </div>
                        <?php if(isset($subject)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'subject_update', 'method' => 'POST'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(258)): ?>
      
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'subject_store', 'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e(@$errors->has('subject_name') ? ' is-invalid' : ''); ?>" 
                                            type="text" name="subject_name" autocomplete="off" value="<?php echo e(isset($subject)? $subject->subject_name: old('subject_name')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($subject)? $subject->id: ''); ?>">
                                            <label><?php echo app('translator')->get('academics.subject_name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('subject_name')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e(@$errors->first('subject_name')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="d-flex radio-btn-flex">
                                            <?php if(isset($subject)): ?>
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationFather" value="T" class="common-radio relationButton" <?php echo e(@$subject->subject_type == 'T'? 'checked':''); ?>>
                                                <label for="relationFather"><?php echo app('translator')->get('academics.theory'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationMother" value="P" class="common-radio relationButton" <?php echo e(@$subject->subject_type == 'P'? 'checked':''); ?>>
                                                <label for="relationMother"><?php echo app('translator')->get('academics.practical'); ?></label>
                                            </div>
                                            <?php else: ?>
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationFather" value="T" class="common-radio relationButton" checked>
                                                <label for="relationFather"><?php echo app('translator')->get('academics.theory'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="subject_type" id="relationMother" value="P" class="common-radio relationButton">
                                                <label for="relationMother"><?php echo app('translator')->get('academics.practical'); ?></label>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('subject_code') ? ' is-invalid' : ''); ?>" type="text" name="subject_code" autocomplete="off" value="<?php echo e(isset($subject)? $subject->subject_code: old('subject_code')); ?>">
                                            <label><?php echo app('translator')->get('academics.subject_code'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('subject_code')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e(@$errors->first('subject_code')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                 <?php 
                                  $tooltip = "";
                                  if(userPermission(258)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($subject)): ?>
                                                <?php echo app('translator')->get('academics.update_subject'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('academics.save_subject'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('academics.subject_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                               
                                <tr>
                                    <th> <?php echo app('translator')->get('common.sl'); ?></th>
                                    <th> <?php echo app('translator')->get('academics.subject'); ?></th>
                                    <th> <?php echo app('translator')->get('academics.subject_type'); ?></th>
                                    <th><?php echo app('translator')->get('academics.subject_code'); ?></th>
                                    <th><?php echo app('translator')->get('common.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i=0; ?>
                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$i); ?></td>
                                    <td><?php echo e(@$subject->subject_name); ?></td>
                                    <td><?php echo e(trans('academics.'.($subject->subject_type == 'T'? 'theory':'practical'))); ?> </td>
                                    <td><?php echo e(@$subject->subject_code); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('common.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                 <?php if(userPermission(259)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('subject_edit', [@$subject->id])); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                               <?php endif; ?>
                                                <?php if(userPermission(260)): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteSubjectModal<?php echo e(@$subject->id); ?>"  href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                           <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                 <div class="modal fade admin-query" id="deleteSubjectModal<?php echo e(@$subject->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('academics.delete_subject'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                    <a href="<?php echo e(route('subject_delete', [@$subject->id])); ?>" class="text-light">
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/academics/subject.blade.php ENDPATH**/ ?>