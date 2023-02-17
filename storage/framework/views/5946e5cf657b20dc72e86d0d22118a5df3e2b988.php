<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('hr.add_new_staff'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/backEnd/')); ?>/css/croppie.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    .form-control:disabled{
        background-color: #FFFFFF;
    }
</style>

<input type="text" hidden id="urlStaff" value="<?php echo e(route('staffPicStore')); ?>">
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('hr.add_new_staff'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="<?php echo e(route('staff_directory')); ?>"><?php echo app('translator')->get('hr.human_resource'); ?></a>
                <a href="#"><?php echo app('translator')->get('hr.add_new_staff'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('hr.staff_information'); ?> </h3>
                </div>
            </div>
            <div class="col-lg-2 text-md-right text-left col-md-6 mb-30-lg">
                <a href="<?php echo e(route('staff_directory')); ?>" class="primary-btn small fix-gr-bg">
                    <?php echo app('translator')->get('hr.all_staff_list'); ?>
                </a>
            </div>

            <?php if(userPermission(4001)): ?>
            <div class="col-lg-2 text-md-right text-left col-md-6 mb-30-lg">
                <a href="<?php echo e(route('import_staff')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('hr.import'); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'staffStore', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

        <div class="row">
            <div class="col-lg-12">
              <div class="white-box">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h4><?php echo app('translator')->get('hr.basic_info'); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>

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
                    <div class="row mb-30">
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
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('role_id') ? ' is-invalid' : ''); ?>" name="role_id" id="role_id">
                                    <option data-display="<?php echo app('translator')->get('hr.role'); ?> <?php echo e(in_array('role', $is_required) ? '*' : ''); ?>" value=""><?php echo app('translator')->get('common.select'); ?> <?php echo e(in_array('role', $is_required) ? '*' : ''); ?></option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>" <?php echo e((old("role_id") ==  $value->id? "selected":"")); ?>><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="focus-border"></span>
                                <?php if($errors->has('role_id')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('role_id')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('department_id') ? ' is-invalid' : ''); ?>" name="department_id" id="department_id">
                                    <option data-display="<?php echo app('translator')->get('hr.department'); ?> <?php echo e(in_array('department', $is_required) ? '*' : ''); ?>" value=""><?php echo app('translator')->get('common.select'); ?> <?php echo e(in_array('department', $is_required) ? '*' : ''); ?></option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>" <?php echo e(old('department_id')==$value->id? 'selected': ''); ?>  ><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="focus-border"></span>
                                <?php if($errors->has('department_id')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('department_id')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('designation_id') ? ' is-invalid' : ''); ?>" name="designation_id" id="designation_id">
                                    <option data-display="<?php echo app('translator')->get('hr.designations'); ?> <?php echo e(in_array('designation', $is_required) ? '*' : ''); ?>" value=""><?php echo app('translator')->get('common.select'); ?> <?php echo e(in_array('designation', $is_required) ? '*' : ''); ?></option>
                                    <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>" <?php echo e(old('designation_id')==$value->id? 'selected': ''); ?> ><?php echo e($value->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="focus-border"></span>
                                <?php if($errors->has('designation_id')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('designation_id')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                      
                    </div>



                    <div class="row mb-30">
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control <?php echo e($errors->has('first_name') ? 'is-invalid' : ' '); ?>" type="text"  name="first_name" value="<?php echo e(old('first_name')); ?>">
                                <span class="focus-border"></span>
                                <label><?php echo app('translator')->get('hr.first_name'); ?> <?php echo e(in_array('first_name', $is_required) ? '*' : ''); ?> </label>
                                <?php if($errors->has('first_name')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('first_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" type="text"  name="last_name" value="<?php echo e(old('last_name')); ?>">
                                <span class="focus-border"></span>
                                <label><?php echo app('translator')->get('hr.last_name'); ?> <?php echo e(in_array('last_name', $is_required) ? '*' : ''); ?> </label>
                                <?php if($errors->has('last_name')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('last_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('fathers_name') ? ' is-invalid' : ''); ?>" type="text"  name="fathers_name" value="<?php echo e(old('first_name')); ?>">
                                <span class="focus-border"></span>
                                <label><?php echo app('translator')->get('student.father_name'); ?> <?php echo e(in_array('fathers_name', $is_required) ? '*' : ''); ?></label>
                                <?php if($errors->has('fathers_name')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('fathers_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('mothers_name') ? ' is-invalid' : ''); ?>" type="text" name="mothers_name" value="<?php echo e(old('mothers_name')); ?>">
                                <span class="focus-border"></span>
                                <label><?php echo app('translator')->get('hr.mother_name'); ?> <?php echo e(in_array('mothers_name', $is_required) ? '*' : ''); ?></label>
                                <?php if($errors->has('mothers_name')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('mothers_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-30">
                       <div class="col-lg-3">
                        <div class="input-effect">
                            <input onkeyup="emailCheck(this)" class="primary-input form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" type="email"  name="email" value="<?php echo e(old('email')); ?>">
                            <span class="focus-border"></span>
                            <label><?php echo app('translator')->get('common.email'); ?> <?php echo e(in_array('email', $is_required) ? '*' : ''); ?> </label>
                            <?php if($errors->has('email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="input-effect">
                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('gender_id') ? ' is-invalid' : ''); ?>" name="gender_id">
                                <option data-display="<?php echo app('translator')->get('common.gender'); ?> *" value=""><?php echo app('translator')->get('common.gender'); ?> <?php echo e(in_array('gender', $is_required) ? '*' : ''); ?></option>
                                <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($gender->id); ?>" <?php echo e(old('gender_id') == $gender->id? 'selected': ''); ?>><?php echo e($gender->base_setup_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="focus-border"></span>
                            <?php if($errors->has('gender_id')): ?>
                            <span class="invalid-feedback invalid-select" role="alert">
                                <strong><?php echo e($errors->first('gender_id')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="no-gutters input-right-icon">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control<?php echo e($errors->has('date_of_birth') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                     name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" autocomplete="off">
                                    <span class="focus-border"></span>
                                    <label><?php echo app('translator')->get('common.date_of_birth'); ?> <?php echo e(in_array('date_of_birth', $is_required) ? '*' : ''); ?></label>
                                    <?php if($errors->has('date_of_birth')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('date_of_birth')); ?></strong>
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
                    </div>
                    <div class="col-lg-3">
                        <div class="no-gutters input-right-icon">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control<?php echo e($errors->has('date_of_joining') ? ' is-invalid' : ''); ?>" id="date_of_joining" type="text"
                                     name="date_of_joining" value="<?php echo e(date('m/d/Y')); ?>">
                                    <span class="focus-border"></span>
                                    <label><?php echo app('translator')->get('hr.date_of_joining'); ?> <?php echo e(in_array('date_of_joining', $is_required) ? '*' : ''); ?></label>
                                    <?php if($errors->has('date_of_joining')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('date_of_joining')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-calendar" id="date_of_joining"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-20">
                 <div class="col-lg-3">
                    <div class="input-effect">
                        <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('mobile') ? ' is-invalid' : ''); ?>" type="text"  name="mobile" value="<?php echo e(old('mobile')); ?>">
                        <span class="focus-border"></span>
                        <label><?php echo app('translator')->get('common.mobile'); ?>  <?php echo e(in_array('mobile', $is_required) ? '*' : ''); ?></label>
                        <?php if($errors->has('mobile')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('mobile')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-effect">
                        <select class="niceSelect w-100 bb form-control" name="marital_status">
                            <option data-display="<?php echo app('translator')->get('hr.marital_status'); ?> <?php echo e(in_array('marital_status', $is_required) ? '*' : ''); ?>" value=""><?php echo app('translator')->get('hr.marital_status'); ?> <?php echo e(in_array('marital_status', $is_required) ? '*' : ''); ?></option>

                            <option <?php echo e(old('marital_status') == 'married'? 'selected': ''); ?> value="married"><?php echo app('translator')->get('hr.married'); ?></option>
                            <option <?php echo e(old('marital_status') == 'unmarried'? 'selected': ''); ?> value="unmarried"><?php echo app('translator')->get('hr.unmarried'); ?></option>

                        </select>
                        <span class="focus-border"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-effect">
                        <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('emergency_mobile') ? ' is-invalid' : ''); ?>" type="text"  name="emergency_mobile" value="<?php echo e(old('emergency_mobile')); ?>">
                        <span class="focus-border"></span>
                        <label><?php echo app('translator')->get('hr.emergency_mobile'); ?> <?php echo e(in_array('emergency_mobile', $is_required) ? '*' : ''); ?></label>
                        <?php if($errors->has('emergency_mobile')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('emergency_mobile')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="input-effect">
                        <input class="primary-input form-control<?php echo e($errors->has('driving_license') ? ' is-invalid' : ''); ?>" type="text"  name="driving_license" value="<?php echo e(old('driving_license')); ?>">
                        <span class="focus-border"></span>
                        <label><?php echo app('translator')->get('hr.driving_license'); ?> <?php echo e(in_array('driving_license', $is_required) ? '*' : ''); ?></label>
                        <?php if($errors->has('driving_license')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('driving_license')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>


            </div>
            <div class="row mb-20">
                <div class="col-lg-6">
                    <div class="row no-gutters input-right-icon">
                        <div class="col">
                            <div class="input-effect">

                                <input class="primary-input form-control <?php echo e($errors->has('staff_photo') ? ' is-invalid' : ''); ?>" type="text" id="placeholderStaffsName"
                                placeholder="<?php echo e(isset($editData->file) && $editData->file != '' ? getFilePath3($editData->file):(in_array('staff_photo', $is_required) ? trans('hr.staff_photo') .'*': trans('hr.staff_photo'))); ?>"
                                disabled>
                                <span class="focus-border"></span>

                                <?php if($errors->has('staff_photo')): ?>
                                     <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('staff_photo')); ?></strong>
                                    </span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="primary-btn-small-input" type="button">
                                <label class="primary-btn small fix-gr-bg" for="staff_photo"><?php echo app('translator')->get('common.browse'); ?></label>
                                <input type="file" class="d-none" name="staff_photo" id="staff_photo">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-lg-6">
                    <div class="input-effect">
                        <textarea class="primary-input form-control <?php echo e($errors->has('current_address') ? 'is-invalid' : ''); ?>" cols="0" rows="4" name="current_address" id="current_address"><?php echo e(old('current_address')); ?></textarea>
                        <label><?php echo app('translator')->get('hr.current_address'); ?> <?php echo e(in_array('current_address', $is_required) ? '*' : ''); ?> </label>
                        <span class="focus-border textarea"></span>

                        <?php if($errors->has('current_address')): ?>
                         <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('current_address')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-effect">
                        <textarea class="primary-input form-control <?php echo e($errors->has('permanent_address') ? 'is-invalid' : ''); ?>" cols="0" rows="4"  name="permanent_address" id="permanent_address"><?php echo e(old('permanent_address')); ?></textarea>
                        <label><?php echo app('translator')->get('hr.permanent_address'); ?> <?php echo e(in_array('permanent_address', $is_required) ? '*' : ''); ?> </label>
                        <span class="focus-border textarea"></span>
                         <?php if($errors->has('permanent_address')): ?>
                         <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('permanent_address')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row md-20">
                <div class="col-lg-6">
                    <div class="input-effect">
                        <textarea class="primary-input form-control" cols="0" rows="4" name="qualification" id="qualification"><?php echo e(old('qualification')); ?></textarea>
                        <label><?php echo app('translator')->get('hr.qualifications'); ?> <?php echo e(in_array('qualifications', $is_required) ? '*' : ''); ?></label>
                        <span class="focus-border textarea"></span>
                        <?php if($errors->has('qualification')): ?>
                        <span class="danger text-danger">
                            <strong><?php echo e($errors->first('qualification')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-effect">
                        <textarea class="primary-input form-control" cols="0" rows="4"  name="experience" id="experience" value="<?php echo e(old('experience')); ?>"></textarea>
                        <label><?php echo app('translator')->get('hr.experience'); ?> <?php echo e(in_array('experience', $is_required) ? '*' : ''); ?></label>
                        <span class="focus-border textarea"></span>
                        <?php if($errors->has('experience')): ?>
                        <span class="danger text-danger">
                            <strong><?php echo e($errors->first('experience')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h4><?php echo app('translator')->get('hr.payroll_details'); ?></h4>
                    </div>
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row mb-20">
                <div class="col-lg-3">
                   <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('epf_no') ? ' is-invalid' : ''); ?>" type="text"  name="epf_no" value="<?php echo e(old('epf_no')); ?>">
                    <label><?php echo app('translator')->get('hr.epf_no'); ?> <?php echo e(in_array('epf_no', $is_required) ? '*' : ''); ?></label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('epf_no')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('epf_no')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-3">
               <div class="input-effect">
                   <input oninput="numberCheck(this)" class="primary-input form-control<?php echo e($errors->has('basic_salary') ? ' is-invalid' : ''); ?>" type="text"  name="basic_salary" value="<?php echo e(old('basic_salary')); ?>" autocomplete="off">
                   <label><?php echo app('translator')->get('hr.basic_salary'); ?> <?php echo e(in_array('basic_salary', $is_required) ? '*' : ''); ?></label>
                   <span class="focus-border"></span>
                   <?php if($errors->has('basic_salary')): ?>
                   <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('basic_salary')); ?></strong>
                </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="input-effect">
                <select class="niceSelect w-100 bb form-control" name="contract_type">
                    <option data-display="<?php echo app('translator')->get('hr.contract_type'); ?> <?php echo e(in_array('contract_type', $is_required) ? '*' : ''); ?>" value=""> <?php echo app('translator')->get('hr.contract_type'); ?> <?php echo e(in_array('contract_type', $is_required) ? '*' : ''); ?></option>
                    <option value="permanent"><?php echo app('translator')->get('hr.permanent'); ?> </option>
                    <option value="contract"> <?php echo app('translator')->get('hr.contract'); ?></option>
                </select>
                <span class="focus-border"></span>

            </div>
        </div>

        <div class="col-lg-3">
           <div class="input-effect">
            <input class="primary-input form-control<?php echo e($errors->has('location') ? ' is-invalid' : ''); ?>" type="text" value="<?php echo e(old('location')); ?>" name="location">
            <label><?php echo app('translator')->get('hr.location'); ?> <?php echo e(in_array('location', $is_required) ? '*' : ''); ?></label>
            <span class="focus-border"></span>
            <?php if($errors->has('location')): ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('location')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>

<div class="row mt-40">
    <div class="col-lg-12">
        <div class="main-title">
            <h4><?php echo app('translator')->get('hr.bank_info_details'); ?></h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>
<div class="row mb-20">
    <div class="col-lg-3">
       <div class="input-effect">
        <input class="primary-input form-control<?php echo e($errors->has('bank_account_name') ? ' is-invalid' : ''); ?>" type="text"  name="bank_account_name" value="<?php echo e(old('bank_account_name')); ?>">
        <label><?php echo app('translator')->get('hr.bank_account_name'); ?> <?php echo e(in_array('bank_account_name', $is_required) ? '*' : ''); ?></label>
        <span class="focus-border"></span>

    </div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input onkeyup="numberCheck(this)" class="primary-input form-control<?php echo e($errors->has('bank_account_no') ? ' is-invalid' : ''); ?>" type="text"  name="bank_account_no" value="<?php echo e(old('bank_account_no')); ?>">
        <label><?php echo app('translator')->get('accounts.account_no'); ?> <?php echo e(in_array('bank_account_no', $is_required) ? '*' : ''); ?></label>
    <span class="focus-border"></span>

</div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('bank_name') ? ' is-invalid' : ''); ?>" type="text"  name="bank_name" value="<?php echo e(old('bank_name')); ?>">
    <label><?php echo app('translator')->get('accounts.bank_name'); ?> <?php echo e(in_array('bank_name', $is_required) ? '*' : ''); ?></label>
    <span class="focus-border"></span>

</div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('bank_brach') ? ' is-invalid' : ''); ?>" type="text"  name="bank_brach" value="<?php echo e(old('bank_brach')); ?>">
    <label><?php echo app('translator')->get('accounts.branch_name'); ?> <?php echo e(in_array('bank_brach', $is_required) ? '*' : ''); ?></label>
    <span class="focus-border"></span>

</div>
</div>

</div>

<div class="row mt-40">
    <div class="col-lg-12">
        <div class="main-title">
            <h4><?php echo app('translator')->get('hr.social_links_details'); ?></h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>
<div class="row mb-20">
    <div class="col-lg-3">
       <div class="input-effect">
        <input class="primary-input form-control<?php echo e($errors->has('facebook_url') ? ' is-invalid' : ''); ?>" type="text" name="facebook_url" value=<?php echo e(old('facebook_url')); ?>>
        <label><?php echo app('translator')->get('hr.facebook_url'); ?> <?php echo e(in_array('facebook', $is_required) ? '*' : ''); ?></label>
        <span class="focus-border"></span>

    </div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('twiteer_url') ? ' is-invalid' : ''); ?>" type="text"  name="twiteer_url" value="<?php echo e(old('twiteer_url')); ?>">
    <label><?php echo app('translator')->get('hr.twitter_url'); ?> <?php echo e(in_array('twitter', $is_required) ? '*' : ''); ?></label>
    <span class="focus-border"></span>

</div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('linkedin_url') ? ' is-invalid' : ''); ?>" type="text"  name="linkedin_url" value="<?php echo e(old('linkedin_url')); ?>">
    <label><?php echo app('translator')->get('hr.linkedin_url'); ?> <?php echo e(in_array('linkedin', $is_required) ? '*' : ''); ?></label>
    <span class="focus-border"></span>

</div>
</div>

<div class="col-lg-3">
   <div class="input-effect">
    <input class="primary-input form-control<?php echo e($errors->has('instragram_url') ? ' is-invalid' : ''); ?>" type="text"  name="instragram_url" value="<?php echo e(old('instragram_url')); ?>">
    <label><?php echo app('translator')->get('hr.instragram_url'); ?> <?php echo e(in_array('instragram', $is_required) ? '*' : ''); ?></label>
    <span class="focus-border"></span>

</div>
</div>

</div>

<div class="row mt-40">
    <div class="col-lg-12">
        <div class="main-title">
            <h4><?php echo app('translator')->get('hr.document_info'); ?></h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>

<div class="row mb-20">
   <div class="col-lg-4">
    <div class="row no-gutters input-right-icon">
        <div class="col">
            <div class="input-effect">
                <input class="primary-input" type="text" id="placeholderResume" placeholder="<?php echo e(isset($editData->resume) && $editData->resume != ""? getFilePath3($editData->resume):(in_array('resume', $is_required) ? trans('hr.resume') .'*': trans('hr.resume'))); ?>"
                readonly>
                <span class="focus-border"></span>
            </div>
        </div>
        <div class="col-auto">
            <button class="primary-btn-small-input" type="button">
                <label class="primary-btn small fix-gr-bg" for="resume"><?php echo app('translator')->get('common.browse'); ?></label>
                <input type="file" class="d-none" name="resume" id="resume">
            </button>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="row no-gutters input-right-icon">
        <div class="col">
            <div class="input-effect">
                <input class="primary-input" type="text" id="placeholderJoiningLetter" placeholder="<?php echo e(isset($editData->joining_letter) && $editData->joining_letter != ""? getFilePath3($editData->joining_letter):(in_array('joining_letter', $is_required) ? trans('hr.joining_letter') .'*': trans('hr.joining_letter'))); ?>"
                readonly>
                <span class="focus-border"></span>
            </div>
        </div>
        <div class="col-auto">
            <button class="primary-btn-small-input" type="button">
                <label class="primary-btn small fix-gr-bg" for="joining_letter"><?php echo app('translator')->get('common.browse'); ?></label>
                <input type="file" class="d-none" name="joining_letter" id="joining_letter">
            </button>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="row no-gutters input-right-icon">
        <div class="col">
            <div class="input-effect">
                <input class="primary-input" type="text" id="placeholderOthersDocument" placeholder="<?php echo e(isset($editData->other_document) && $editData->other_document != ""? getFilePath3($editData->other_document):(in_array('other_documents', $is_required) ? trans('hr.other_documents') .'*': trans('hr.other_documents'))); ?>"
                readonly>
                <span class="focus-border"></span>
            </div>
        </div>
        <div class="col-auto">
            <button class="primary-btn-small-input" type="button">
                <label class="primary-btn small fix-gr-bg" for="other_document"><?php echo app('translator')->get('common.browse'); ?></label>
                <input type="file" class="d-none" name="other_document" id="other_document">
            </button>
        </div>
    </div>
</div>
</div>


<div class="row mt-40">
    <div class="col-lg-12">
        <div class="main-title">
            <h4><?php echo app('translator')->get('hr.custom_field'); ?></h4>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg-12">
        <hr>
    </div>
</div>
<?php echo $__env->make('backEnd.studentInformation._custom_field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="row mt-40">
    <div class="col-lg-12 text-center">
        <button class="primary-btn fix-gr-bg submit">
            <span class="ti-check"></span>
            <?php echo app('translator')->get('hr.save_staff'); ?>

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

<div class="modal" id="LogoPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('hr.crop_image_and_upload'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="resize"></div>
                <button class="btn rotate float-lef" data-deg="90" >
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" >
                <i class="ti-back-left"></i></button>
                <hr>

                <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="upload_logo"><?php echo app('translator')->get('hr.crop'); ?></a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(document).ready(function(){
        $(document).on('change','.cutom-photo',function(){
            let v = $(this).val();
            let v1 = $(this).data("id");
            console.log(v,v1);
            getFileName(v, v1);
        });

        function getFileName(value, placeholder){
            if (value) {
                var startIndex = (value.indexOf('\\') >= 0 ? value.lastIndexOf('\\') : value.lastIndexOf('/'));
                var filename = value.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
                $(placeholder).attr('placeholder', '');
                $(placeholder).attr('placeholder', filename);
            }
        }
    })
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/croppie.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/editStaff.js"></script>
<script>
    $(document).ready(function(){
        
        $(document).on('change','.cutom-photo',function(){
            let v = $(this).val();
            let v1 = $(this).data("id");
            console.log(v,v1);
            getFileName(v, v1);

        });

        function getFileName(value, placeholder){
            if (value) {
                var startIndex = (value.indexOf('\\') >= 0 ? value.lastIndexOf('\\') : value.lastIndexOf('/'));
                var filename = value.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
                $(placeholder).attr('placeholder', '');
                $(placeholder).attr('placeholder', filename);
            }
        }

        
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp/resources/views/backEnd/humanResource/addStaff.blade.php ENDPATH**/ ?>