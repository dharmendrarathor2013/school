<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('hr.staff_import'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/backEnd/')); ?>/css/croppie.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <style type="text/css">
        .form-control:disabled {
            background-color: #FFFFFF;
        }
    </style>


<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('hr.staff_import'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('hr.add_staff'); ?></a>
                    <a href="#"><?php echo app('translator')->get('hr.staff_import'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="main-title">
                        
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-3 text-right mb-20">
                    <a href="<?php echo e(url('/public/backEnd/bulksample/staffs.xlsx')); ?>">
                        <button class="primary-btn tr-bg text-uppercase bord-rad">
                            <?php echo app('translator')->get('hr.download_sample_file'); ?>
                            <span class="pl ti-download"></span>
                        </button>
                    </a>
                </div>   
            </div>

            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'staff_bulk_store',
            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'staff_form'])); ?>

                <div class="row">
                    <div class="col-lg-12">


                        <div class="white-box">
                            <div class="">
                                


                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <?php if( moduleStatusCheck('MultiBranch') && isset($branches )): ?>
                                <div class="row mb-30">
                                       <div class="col-lg-3">
                                           <div class="input-effect">
                                               <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('branch_id') ? ' is-invalid' : ''); ?>" name="branch_id" id="branch_id">
                                                    <option data-display="<?php echo app('translator')->get('hr.branch'); ?> *" value=""><?php echo app('translator')->get('hr.branch'); ?> *</option>
                                                       <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <option value="<?php echo e($branch->id); ?>" <?php echo e(isset($branch_id)? ($branch->id == $branch_id? 'selected':''): ''); ?>><?php echo e($branch->branch_name); ?></option>
                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                               </select>
                                                <span class="focus-border"></span>
                                                   <?php if($errors->has('branch_id')): ?>
                                                   <span class="invalid-feedback invalid-select" role="alert">
                                                       <strong><?php echo e($errors->first('branch_id')); ?></strong>
                                                   </span>
                                               <?php endif; ?>
                                           </div>
                                       </div>
                                </div> 
                                   <?php endif; ?>
                                <div class="row mb-40 mt-30">

                                    


                                    <div class="col-lg-3">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('staff_no') ? ' is-invalid' : ''); ?>" type="text"  name="staff_no" value="<?php echo e($max_staff_no != ''? $max_staff_no + 1 : 1); ?>" readonly>
                                            <span class="focus-border"></span>
                                            <label><?php echo app('translator')->get('hr.staff_no'); ?> <?php echo e(in_array('staff_no', $is_required) ? '*' : ''); ?> </label>
                                            <?php if($errors->has('staff_no')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('staff_no')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>



                                    <div class="col-lg-3">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control" type="text"
                                                        id="placeholderPhoto" placeholder="Excel file" readonly="">
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="photo">Browse</label>
                                                    <input type="file" class="d-none" name="file" id="photo">
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            <?php echo app('translator')->get('hr.save_bulk_staff'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/humanResource/importStaff.blade.php ENDPATH**/ ?>