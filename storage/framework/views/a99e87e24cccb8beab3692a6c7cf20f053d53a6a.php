<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('admin.student_certificate'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('admin.student_certificate'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('admin.admin_section'); ?></a>
                <a href="#"><?php echo app('translator')->get('admin.student_certificate'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($certificate)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('student-certificate')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('common.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
           
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($certificate)): ?>
                                    <?php echo app('translator')->get('admin.edit_certificate'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('admin.add_certificate'); ?>
                                <?php endif; ?>
                              
                            </h3>
                        </div>
                        <?php if(isset($certificate)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('student-certificate-update',$certificate->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                          <?php if(userPermission(50)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student-certificate',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="name" autocomplete="off" value="<?php echo e(isset($certificate)? $certificate->name: old('name')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($certificate)? $certificate->id: ''); ?>">
                                            <label><?php echo app('translator')->get('admin.certificate_name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('header_left_text') ? ' is-invalid' : ''); ?>"
                                                type="text" name="header_left_text" autocomplete="off" value="<?php echo e(isset($certificate)? $certificate->header_left_text: old('header_left_text')); ?>">
                                            <label><?php echo app('translator')->get('admin.header_left_text'); ?><span></span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('header_left_text')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('header_left_text')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" type="text" name="date" autocomplete="off" value="<?php echo e(isset($certificate)? date('m/d/Y', strtotime($certificate->date)): date('m/d/Y')); ?>">
                                            <span class="focus-border"></span>
                                            <label><?php echo app('translator')->get('common.date'); ?> <span></span></label>
                                            <?php if($errors->has('date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control<?php echo e($errors->has('body') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="body" maxlength="500"><?php echo e(isset($certificate)? $certificate->body: old('body')); ?></textarea>
                                            <label><?php echo app('translator')->get('admin.body_max_character_lenght_500'); ?> <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            <?php if($errors->has('body')): ?>
                                                <span class="error text-danger"><strong><?php echo e($errors->first('body')); ?></strong></span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="text-primary">[name] [dob] [present_address] [guardian] [created_at] [admission_no] [roll_no] [class] [section] [gender] [admission_date] [category] [cast] [father_name] [mother_name] [religion] [email] [phone]</span>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('footer_left_text') ? ' is-invalid' : ''); ?>"
                                                type="text" name="footer_left_text" autocomplete="off" value="<?php echo e(isset($certificate)? $certificate->footer_left_text: old('footer_left_text')); ?>">
                                            <label><?php echo app('translator')->get('admin.footer_left_text'); ?> <span></span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('footer_left_text')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('footer_left_text')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('footer_center_text') ? ' is-invalid' : ''); ?>"
                                                type="text" name="footer_center_text" autocomplete="off" value="<?php echo e(isset($certificate)? $certificate->footer_center_text: old('footer_center_text')); ?>">
                                            <label><?php echo app('translator')->get('admin.footer_center_text'); ?><span></span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('footer_center_text')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('footer_center_text')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('footer_right_text') ? ' is-invalid' : ''); ?>"
                                                type="text" name="footer_right_text" autocomplete="off" value="<?php echo e(isset($certificate)? $certificate->footer_right_text: old('footer_right_text')); ?>">
                                            <label><?php echo app('translator')->get('admin.footer_right_text'); ?><span></span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('footer_right_text')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('footer_right_text')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12 d-flex">
                                        <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('admin.student_photo'); ?></p>
                                        <div class="d-flex radio-btn-flex ml-40">
                                            <div class="mr-30">
                                                <input type="radio" name="student_photo" id="relationFather" value="1" class="common-radio relationButton" <?php echo e(isset($certificate)? ($certificate->student_photo == 1? 'checked': ''):'checked'); ?>>
                                                <label for="relationFather"><?php echo app('translator')->get('common.yes'); ?></label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="student_photo" id="relationMother" value="0" class="common-radio relationButton" <?php echo e(isset($certificate)? ($certificate->student_photo == 0? 'checked': ''):''); ?>>
                                                <label for="relationMother"><?php echo app('translator')->get('common.none'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mt-35">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('file') ? ' is-invalid' : ''); ?>" id="placeholderInput" type="text" placeholder="<?php echo e(isset($certificate)? ($certificate->file != ""? getFilePath3($certificate->file):trans('common.image') .' *'): trans('common.image') .' (1100 X 850)px *'); ?>" readonly>
                                            <span class="focus-border"></span>
                                            
                                            <?php if($errors->has('file')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('file')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="browseFile"><?php echo app('translator')->get('common.browse'); ?></label>
                                            <input type="file" class="d-none" id="browseFile" name="file" value="<?php echo e(isset($certificate)? ($certificate->file != ""? getFilePath3($certificate->file):''): ''); ?>">
                                        </button>
                                    </div>
                                    
                                </div>
	                           <?php 
                                  $tooltip = "";
                                  if(userPermission(50)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($certificate)): ?>
                                                <?php echo app('translator')->get('admin.update_certificate'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('admin.save_certificate'); ?>
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

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">  <?php echo app('translator')->get('admin.certificate_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                
                                <tr>
                                    <th><?php echo app('translator')->get('common.name'); ?></th>
                                    <th><?php echo app('translator')->get('admin.background_image'); ?></th>
                                    <th><?php echo app('translator')->get('common.actions'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a class="text-color" data-toggle="modal" data-target="#showCertificateModal<?php echo e(@$certificate->id); ?>"  href="#"><?php echo e(@$certificate->name); ?></a></td>
                                    <td>
                                        <?php if(@$certificate->file): ?>
                                            <img src="<?php echo e(url(@$certificate->file)); ?>" width="100">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('common.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#showCertificateModal<?php echo e(@$certificate->id); ?>"  href="#"><?php echo app('translator')->get('common.view'); ?></a>
                                                 <?php if(userPermission(51)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('student-certificate-edit',@$certificate->id)); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                <?php endif; ?>
                                                 <?php if(userPermission(52)): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteSectionModal<?php echo e(@$certificate->id); ?>"  href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteSectionModal<?php echo e(@$certificate->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('admin.delete_certificate'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                    <?php echo e(Form::open(['route' => array('student-certificate-delete',@$certificate->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.delete'); ?></button>
                                                    <?php echo e(Form::close()); ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade admin-query" id="showCertificateModal<?php echo e(@$certificate->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered large-modal">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('admin.view_certificate'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="container student-certificate">
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-12 text-center">
                                                            <div class="mb-5">
								                                <img class="img-fluid" src="<?php echo e(asset($certificate->file)); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-10 text-center certificate-position">
                                                            <div>
                                                                <div class="row justify-content-lg-between mb-5">
                                                                    <div class="col-md-5">
                                                                        <p class="m-0"><?php echo e(@$certificate->header_left_text); ?>:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p class="m-0"><?php echo app('translator')->get('admin.date'); ?>: <?php echo e(@$certificate->date); ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class="certificate-middle">
                                                                    <p>
                                                                        <?php echo e(@$certificate->body); ?>

                                                                    </p>
                                                                </div>

                                                                <div class="mt-80 mb-4">
                                                                    <div class="row">
                                                                        <div class="col-md-4 text-center">
                                                                            <div class="signature bb-15"><?php echo e(@$certificate->footer_left_text); ?></div>
                                                                        </div>
                                                                        <div class="col-md-4 text-center">
                                                                            <div class="signature bb-15"><?php echo e(@$certificate->footer_center_text); ?></div>
                                                                        </div>
                                                                        <div class="col-md-4 text-center">
                                                                            <div class="signature bb-15"><?php echo e(@$certificate->footer_right_text); ?></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/admin/student_certificate.blade.php ENDPATH**/ ?>