<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('student.student_admission'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/backEnd/')); ?>/css/croppie.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('student.student_admission'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('student.student_information'); ?></a>
                <a href="#"><?php echo app('translator')->get('student.student_admission'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="main-title xs_mt_0 mt_0_sm">
                    <h3 class="mb-0"><?php echo app('translator')->get('student.add_student'); ?></h3>
                </div>
            </div>
              <?php if(userPermission(63)): ?>
               <div class="offset-lg-3 col-lg-3 text-right mb-20 col-sm-6">
                <a href="<?php echo e(route('import_student')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('student.import_student'); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <?php if(userPermission(65)): ?>
            <?php echo e(Form::open(['class' => 'form-horizontal studentadmission', 'files' => true, 'route' => 'student_store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'student_form'])); ?>

        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                
                <div class="white-box">
                    <div class="">
                        <div class="row">
            
                            <div class="col-lg-12 text-center">
                                <?php if($errors->any()): ?>
                                        <div class="error text-danger "><?php echo e('Something went wrong, please try again'); ?></div>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($error == "The email address has already been taken."): ?>
                                        <div class="error text-danger "><?php echo e('The email address has already been taken, You can find out in student list or disabled student list'); ?></div>
                                        <?php else: ?>
                                            <div class="error text-danger "><?php echo e($error); ?></div>
                                    <?php endif; ?> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </div>
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('student.personal_info'); ?></h4>
                                </div>
                            </div>
                        </div>
 
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                     
                        <div class="row mb-40 mt-30">
                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('session') ? ' is-invalid' : ''); ?>" name="session" id="academic_year">
                                        <option data-display="<?php echo app('translator')->get('common.academic_year'); ?> <?php if(is_required('session')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('common.academic_year'); ?> <?php if(is_required('session')==true): ?> * <?php endif; ?></option>
                                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($session->id); ?>" <?php echo e(old('session') == $session->id? 'selected': ''); ?>><?php echo e($session->year); ?>[<?php echo e($session->title); ?>]</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('session')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('session')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="class-div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" name="class" id="classSelectStudent">
                                        <option data-display="<?php echo app('translator')->get('common.class'); ?> <?php if(is_required('class')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('common.class'); ?> <?php if(is_required('class')==true): ?> * <?php endif; ?></option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_class_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                           
                           
                            <?php if(!empty(old('class'))): ?>
                            <?php
                                $old_sections = DB::table('sm_class_sections')->where('class_id', '=', old('class'))
                                ->join('sm_sections','sm_class_sections.section_id','=','sm_sections.id')
                                ->get();
                            ?>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="section"
                                        id="sectionSelectStudent" >
                                       <option data-display="<?php echo app('translator')->get('common.section'); ?> <?php if(is_required('section')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('common.section'); ?> <?php if(is_required('section')==true): ?> * <?php endif; ?></option>
                                        <?php $__currentLoopData = $old_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old_section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option value="<?php echo e($old_section->id); ?>" <?php echo e(old('section')==$old_section->id ? 'selected' : ''); ?> >
                                            <?php echo e($old_section->section_name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php else: ?>

                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="section" id="sectionSelectStudent">
                                       <option data-display="<?php echo app('translator')->get('common.section'); ?> <?php if(is_required('section')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('common.section'); ?> <?php if(is_required('section')==true): ?> * <?php endif; ?></option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="col-lg-2">
                                <div class="input-effect">
                                    <input class="primary-input  form-control<?php echo e($errors->has('admission_number') ? ' is-invalid' : ''); ?>" type="text" onkeyup="GetAdmin(this.value)" name="admission_number"
                                     value="<?php echo e($max_admission_id != ''? $max_admission_id + 1 : 1); ?>" >

                                   <label><?php echo app('translator')->get('student.admission_number'); ?> <?php if(is_required('admission_number')==true): ?> * <?php endif; ?></label>
                                    <span class="focus-border"></span>
                                    <span class="invalid-feedback" id="Admission_Number" role="alert">
                                    </span>
                                    <?php if($errors->has('admission_number')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('admission_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                           
                                
                            
                            

                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input oninput="numberCheck(this)" class="primary-input" type="text" id="roll_number" name="roll_number"  value="<?php echo e(old('roll_number')); ?>">
                                    <label> <?php echo e(moduleStatusCheck('Lead')==true ? __('lead::lead.id_number') : __('student.roll')); ?>

                                         <?php if(is_required('roll_number')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border"></span>
                                    <span class="text-danger" id="roll-error" role="alert">
                                        <strong></strong>
                                    </span>
                                    <?php if($errors->has('roll_number')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('roll_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40">
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" type="text" name="first_name" value="<?php echo e(old('first_name')); ?>">
                                    <label><?php echo app('translator')->get('student.first_name'); ?>  <?php if(is_required('first_name')==true): ?> <span> *</span> <?php endif; ?> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('first_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" type="text" name="last_name" value="<?php echo e(old('last_name')); ?>">
                                    <label><?php echo app('translator')->get('student.last_name'); ?>  <?php if(is_required('last_name')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('last_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('gender') ? ' is-invalid' : ''); ?>" name="gender">
                                                                           
                                        <option data-display="<?php echo app('translator')->get('common.gender'); ?> <?php if(is_required('gender')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('common.gender'); ?> <?php if(is_required('gender')==true): ?> <span>*</span> <?php endif; ?> </option>

                                        <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($gender->id); ?>" <?php echo e(old('gender') == $gender->id? 'selected': ''); ?>><?php echo e($gender->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('gender')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('gender')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input date form-control<?php echo e($errors->has('date_of_birth') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                 name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" autocomplete="off">
                                            
                                                <label><?php echo app('translator')->get('common.date_of_birth'); ?>  <?php if(is_required('date_of_birth')==true): ?> <span> *</span> <?php endif; ?></label>
                                               
                                                <span class="focus-border"></span>
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
                        </div>
                        <div class="row mb-40">
                             <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('blood_group') ? ' is-invalid' : ''); ?>" name="blood_group">
                                        <option data-display="<?php echo app('translator')->get('common.blood_group'); ?> <?php if(is_required('blood_group')==true): ?>  * <?php endif; ?>" value=""><?php echo app('translator')->get('common.blood_group'); ?>  <?php if(is_required('blood_group')==true): ?> <span> *</span> <?php endif; ?></option>
                                        <?php $__currentLoopData = $blood_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blood_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($blood_group->id); ?>" <?php echo e(old('blood_group') == $blood_group->id? 'selected': ''); ?>><?php echo e($blood_group->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('blood_group')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('blood_group')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('religion') ? ' is-invalid' : ''); ?>" name="religion">
                                        <option data-display="<?php echo app('translator')->get('student.religion'); ?> <?php if(is_required('religion')==true): ?> <?php endif; ?>" value=""><?php echo app('translator')->get('student.religion'); ?> <?php if(is_required('religion')==true): ?> <span> *</span> <?php endif; ?></option>
                                        <?php $__currentLoopData = $religions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $religion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($religion->id); ?>" <?php echo e(old('religion') == $religion->id? 'selected': ''); ?>><?php echo e($religion->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('religion')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('religion')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="caste" value="<?php echo e(old('caste')); ?>">
                                    <label><?php echo app('translator')->get('student.caste'); ?> <?php if(is_required('caste')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('caste')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('caste')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input oninput="emailCheck(this)" class="primary-input email_address form-control<?php echo e($errors->has('email_address') ? ' is-invalid' : ''); ?>" id="email_address" type="text" name="email_address" value="<?php echo e(old('email_address')); ?>">
                                    <label><?php echo app('translator')->get('common.email_address'); ?>  <?php if(is_required('email_address')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('email_address')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email_address')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input oninput="phoneCheck(this)" class="primary-input phone_number form-control<?php echo e($errors->has('phone_number') ? ' is-invalid' : ''); ?>" type="tel" name="phone_number" id="phone_number" value="<?php echo e(old('phone_number')); ?>">
                                    
                                    <label><?php echo app('translator')->get('student.phone_number'); ?>  <?php if(is_required('phone_number')==true): ?> <span> *</span> <?php endif; ?></label>
                                  
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('phone_number')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="ro mb-40 d-none" id="exitStudent">
                            <div class="col-lg-12">
                                <input type="checkbox" id="edit_info" value="yes" class="common-checkbox" name="edit_info">
                                <label for="edit_info" class="text-danger"><?php echo app('translator')->get('student.student_already_exit_this_phone_number_are_you_to_edit_student_parent_info'); ?></label>
                            </div>
                        </div>
                        <div class="row mb-40">
                            <div class="col-lg-2">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input date" id="" type="text"
                                                name="admission_date" value="<?php echo e(old('admission_date') != ""? old('admission_date'):date('m/d/Y')); ?>" autocomplete="off">
                                            <label><?php echo app('translator')->get('student.admission_date'); ?></label>
                                            <span class="focus-border">  <?php if(is_required('admission_date')==true): ?> <span> *</span> <?php endif; ?></span>
                                            <?php if($errors->has('admission_date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('admission_date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="admission-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('student_category_id') ? ' is-invalid' : ''); ?>" name="student_category_id">
                                        <option data-display="<?php echo app('translator')->get('student.category'); ?>  <?php if(is_required('student_category_id')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('student.student_category_id'); ?>  <?php if(is_required('category')==true): ?> <span> *</span> <?php endif; ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('student_category_id') == $category->id? 'selected': ''); ?>><?php echo e($category->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('student_category_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('student_category_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('student_group_id') ? ' is-invalid' : ''); ?>" name="student_group_id">
                                        <option data-display="<?php echo app('translator')->get('student.group'); ?>  <?php if(is_required('student_group_id')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('student.group'); ?>  <?php if(is_required('student_group_id')==true): ?> <span> *</span> <?php endif; ?></option>
                                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($group->id); ?>" <?php echo e(old('student_group_id') == $group->id? 'selected': ''); ?>><?php echo e($group->group); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('student_group_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('student_group_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="height" value="<?php echo e(old('height')); ?>">
                                    <label><?php echo app('translator')->get('student.height_in'); ?>)  <?php if(is_required('height')==true): ?> <span> *</span> <?php endif; ?> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('height')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('height')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="weight" value="<?php echo e(old('weight')); ?>">
                                    <label><?php echo app('translator')->get('student.weight_kg'); ?>  <?php if(is_required('weight')==true): ?> <span> *</span> <?php endif; ?> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('weight')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('weight')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if(moduleStatusCheck('Lead')==true): ?>
                            <div class="row mb-40">                           
                                <div class="col-lg-4 ">
                                    <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('route') ? ' is-invalid' : ''); ?>" name="source_id" id="source_id">
                                                <option data-display="<?php echo app('translator')->get('lead::lead.source'); ?> <?php if(is_required('source_id')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('lead::lead.source'); ?> <?php if(is_required('source_id')==true): ?> <span> *</span> <?php endif; ?></option>
                                                <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($source->id); ?>" <?php echo e(old('source_id') == $source->id? 'selected': ''); ?>><?php echo e($source->source_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('source_id')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('source_id')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row mb-40">
                            <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderPhoto" placeholder="<?php echo app('translator')->get('common.student_photo'); ?>  <?php if(is_required('photo')==true): ?> * <?php endif; ?>"
                                                readonly="">
                                            <span class="focus-border"></span>

                                            <?php if($errors->has('photo')): ?>
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong><?php echo e(@$errors->first('photo')); ?></strong>
                                                </span>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="photo"><?php echo app('translator')->get('common.browse'); ?></label>
                                            <input type="file" class="d-none" value="<?php echo e(old('photo')); ?>" name="photo" id="photo">
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 text-right">
                                <div class="row">
                                    <div class="col-lg-7 text-left" id="parent_info">
                                        <input type="hidden" name="parent_id" value="">

                                    </div>
                                    <div class="col-lg-5">
                                        <button class="primary-btn-small-input primary-btn small fix-gr-bg" type="button" data-toggle="modal" data-target="#editStudent">
                                            <span class="ti-plus pr-2"></span>
                                            <?php echo app('translator')->get('student.add_parents'); ?>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Start Sibling Add Modal -->
                        <div class="modal fade admin-query" id="editStudent">
                            <div class="modal-dialog small-modal modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo app('translator')->get('student.select_sibling'); ?></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-lg-12" id="sibling_required_error">

                                                            </div>
                                                        </div>
                                                        <div class="row mt-25">
                                                            <div class="col-lg-12" id="sibling_class_div">
                                                                <select class="niceSelect w-100 bb" name="sibling_class" id="select_sibling_class">
                                                                    <option data-display="<?php echo app('translator')->get('student.class'); ?> *" value=""><?php echo app('translator')->get('student.class'); ?> *</option>
                                                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($class->id); ?>" <?php echo e(old('sibling_class') == $class->id? 'selected': ''); ?> ><?php echo e($class->class_name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-25">
                                                            <div class="col-lg-12" id="sibling_section_div">
                                                                <select class="niceSelect w-100 bb" name="sibling_section" id="select_sibling_section">
                                                                    <option data-display="<?php echo app('translator')->get('common.section'); ?> *" value=""><?php echo app('translator')->get('common.section'); ?> *</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-25">
                                                            <div class="col-lg-12" id="sibling_name_div">
                                                                <select class="niceSelect w-100 bb" name="select_sibling_name" id="select_sibling_name">
                                                                    <option data-display="<?php echo app('translator')->get('student.sibling'); ?> *" value=""><?php echo app('translator')->get('student.sibling'); ?> *</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 text-center mt-40">
                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>

                                                            <button class="primary-btn fix-gr-bg" id="save_button_parent" data-dismiss="modal" type="button"><?php echo app('translator')->get('common.save_information'); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Sibling Add Modal -->
                        <div class="parent_details" id="parent_details">
                            
                            <div class="row mt-40">
                                <div class="col-lg-12">
                                    <div class="main-title">
                                        <h4 class="stu-sub-head"><?php echo app('translator')->get('student.parents_and_guardian_info'); ?> </h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-40 mt-30">
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('fathers_name') ? ' is-invalid' : ''); ?>" type="text" name="fathers_name" id="fathers_name" value="<?php echo e(old('fathers_name')); ?>">
                                        <label><?php echo app('translator')->get('student.father_name'); ?>  <?php if(is_required('father_name')==true): ?> <span> *</span> <?php endif; ?> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('fathers_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('fathers_name')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input" type="text" name="fathers_occupation" id="fathers_occupation" value="<?php echo e(old('fathers_occupation')); ?>">
                                        <label><?php echo app('translator')->get('student.occupation'); ?> <?php if(is_required('fathers_occupation')==true): ?> <span> *</span> <?php endif; ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('fathers_occupation')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('fathers_occupation')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                 <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('fathers_phone') ? ' is-invalid' : ''); ?>" type="text" name="fathers_phone" id="fathers_phone" value="<?php echo e(old('fathers_phone')); ?>">
                                        <label><?php echo app('translator')->get('student.father_phone'); ?>  <?php if(is_required('father_phone')==true): ?> <span> *</span> <?php endif; ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('fathers_phone')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('fathers_phone')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderFathersName" placeholder="<?php echo app('translator')->get('common.photo'); ?> <?php if(is_required('fathers_photo')==true): ?> * <?php endif; ?>"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('fathers_photo')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('fathers_photo')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="fathers_photo"><?php echo app('translator')->get('common.browse'); ?></label>
                                                <input type="file" class="d-none" name="fathers_photo" id="fathers_photo">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('mothers_name') ? ' is-invalid' : ''); ?>" type="text" name="mothers_name" id="mothers_name" value="<?php echo e(old('mothers_name')); ?>">
                                        <label><?php echo app('translator')->get('student.mother_name'); ?>  <?php if(is_required('mothers_name')==true): ?> <span> *</span> <?php endif; ?> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('mothers_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('mothers_name')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input" type="text" name="mothers_occupation" id="mothers_occupation" value="<?php echo e(old('mothers_occupation')); ?>">
                                        <label><?php echo app('translator')->get('student.occupation'); ?> <?php if(is_required('mothers_occupation')==true): ?> <span> *</span> <?php endif; ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('mothers_occupation')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('mothers_occupation')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                 <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e($errors->has('mothers_phone') ? ' is-invalid' : ''); ?>" type="text" name="mothers_phone" id="mothers_phone" value="<?php echo e(old('mothers_phone')); ?>">
                                        <label><?php echo app('translator')->get('student.mother_phone'); ?>  <?php if(is_required('mothers_phone')==true): ?> <span> *</span> <?php endif; ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('mothers_phone')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('mothers_phone')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderMothersName" placeholder="<?php echo app('translator')->get('student.photo'); ?>  <?php if(is_required('mothers_photo')==true): ?> * <?php endif; ?>"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('mothers_photo')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('mothers_photo')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="mothers_photo"><?php echo app('translator')->get('common.browse'); ?></label>
                                                <input type="file" class="d-none" name="mothers_photo" id="mothers_photo">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-40">
                                <div class="col-lg-12 d-flex flex-wrap">
                                    <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('student.relation_with_guardian'); ?></p>
                                    <div class="d-flex radio-btn-flex ml-40">
                                        <div class="mr-30">
                                            <input type="radio" name="relationButton" id="relationFather" value="F" class="common-radio relationButton" <?php echo e(old('relationButton') == "F"? 'checked': ''); ?>>
                                            <label for="relationFather"><?php echo app('translator')->get('student.father'); ?></label>
                                        </div>
                                        <div class="mr-30">
                                            <input type="radio" name="relationButton" id="relationMother" value="M" class="common-radio relationButton" <?php echo e(old('relationButton') == "M"? 'checked': ''); ?>>
                                            <label for="relationMother"><?php echo app('translator')->get('student.mother'); ?></label>
                                        </div>
                                        <div>
                                            <input type="radio" name="relationButton" id="relationOther" value="O" class="common-radio relationButton"  <?php echo e(old('relationButton') != ""? (old('relationButton') == "O"? 'checked': ''): 'checked'); ?>>
                                            <label for="relationOther"><?php echo app('translator')->get('student.Other'); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-40">
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('guardians_name') ? ' is-invalid' : ''); ?>" type="text" name="guardians_name" id="guardians_name" value="<?php echo e(old('guardians_name')); ?>">
                                        <label><?php echo app('translator')->get('student.guardian_name'); ?>  <?php if(is_required('guardians_name')==true): ?> <span> *</span> <?php endif; ?> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('guardians_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('guardians_name')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input read-only-input" type="text" placeholder="Relation" name="relation" id="relation" value="Other" readonly>
                                        <label><?php echo app('translator')->get('student.relation_with_guardian'); ?> <?php if(is_required('relation')==true): ?> <span> *</span> <?php endif; ?> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('relation')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('relation')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input oninput="emailCheck(this)" class="primary-input form-control<?php echo e($errors->has('guardians_email') ? ' is-invalid' : ''); ?>" type="text" name="guardians_email" id="guardians_email" value="<?php echo e(old('guardians_email')); ?>">
                                        <label><?php echo app('translator')->get('student.guardian_email'); ?> <?php if(is_required('guardians_email')==true): ?> <span> *</span> <?php endif; ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('guardians_email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('guardians_email')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect sm2_mb_20 md_mb_20">
                                                <input class="primary-input" type="text" id="placeholderGuardiansName" placeholder="<?php echo app('translator')->get('student.photo'); ?> <?php if(is_required('guardians_photo')==true): ?> * <?php endif; ?>"
                                                    readonly="">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('guardians_photo')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('guardians_photo')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="guardians_photo"><?php echo app('translator')->get('common.browse'); ?></label>
                                                <input type="file" class="d-none" name="guardians_photo" id="guardians_photo">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-30">
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input form-control<?php echo e($errors->has('guardians_phone') ? ' is-invalid' : ''); ?>" type="text" name="guardians_phone" id="guardians_phone" value="<?php echo e(old('guardians_phone')); ?>">
                                        <label><?php echo app('translator')->get('student.guardian_phone'); ?><?php if(is_required('guardians_phone')==true): ?> <span> *</span> <?php endif; ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('guardians_phone')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e(@$errors->first('guardians_phone')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input class="primary-input" type="text" name="guardians_occupation" id="guardians_occupation" value="<?php echo e(old('guardians_occupation')); ?>">
                                        <label><?php echo app('translator')->get('student.guardian_occupation'); ?> <?php if(is_required('guardians_occupation')==true): ?> <span> *</span> <?php endif; ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('guardians_occupation')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e(@$errors->first('guardians_occupation')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-40 mt-40">
                                <div class="col-lg-6">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <textarea class="primary-input form-control" cols="0" rows="3" name="guardians_address" id="guardians_address"><?php echo e(old('guardians_address')); ?></textarea>
                                        <label><?php echo app('translator')->get('student.guardian_address'); ?> <?php if(is_required('guardians_address')==true): ?> <span> *</span> <?php endif; ?> </label>
                                        <span class="focus-border textarea"></span>
                                       <?php if($errors->has('guardians_address')): ?>
                                        <span class="invalid-feedback">
                                            <strong><?php echo e($errors->first('guardians_address')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('student.student_address_info'); ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-30 mt-30">
                            <?php if(moduleStatusCheck('Lead')==true): ?>
                            <div class="col-lg-4 ">
                                <div class="input-effect" style="margin-top:53px !important">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('route') ? ' is-invalid' : ''); ?>" name="lead_city" id="lead_city">
                                        <option data-display="<?php echo app('translator')->get('lead::lead.city'); ?> <?php if(is_required('lead_city')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('lead::lead.city'); ?> <?php if(is_required('lead_city')==true): ?> <span> *</span> <?php endif; ?></option>
                                        <?php $__currentLoopData = $lead_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city->id); ?>" <?php echo e(old('lead_city') == $city->id? 'selected': ''); ?>><?php echo e($city->city_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('lead_city')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('lead_city')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-lg-4">

                                <div class="input-effect sm2_mb_20 md_mb_20 mt-20">
                                    <textarea class="primary-input form-control<?php echo e($errors->has('current_address') ? ' is-invalid' : ''); ?>" cols="0" rows="3" name="current_address" id="current_address"><?php echo e(old('current_address')); ?></textarea>
                                    <label><?php echo app('translator')->get('student.current_address'); ?> <?php if(is_required('current_address')==true): ?> <span> *</span> <?php endif; ?> </label>
                                    <span class="focus-border textarea"></span>
                                   <?php if($errors->has('current_address')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('current_address')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-4">

                                <div class="input-effect sm2_mb_20 md_mb_20 mt-20">
                                    <textarea class="primary-input form-control<?php echo e($errors->has('current_address') ? ' is-invalid' : ''); ?>" cols="0" rows="3" name="permanent_address" id="permanent_address"><?php echo e(old('permanent_address')); ?></textarea>
                                    <label><?php echo app('translator')->get('student.permanent_address'); ?>  <?php if(is_required('permanent_address')==true): ?> <span> *</span> <?php endif; ?> </label>
                                    <span class="focus-border textarea"></span>
                                   <?php if($errors->has('permanent_address')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('permanent_address')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('student.transport'); ?></h4>
                                </div>
                            </div>
                        </div>

                         <div class="row mb-40 mt-30">
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('route') ? ' is-invalid' : ''); ?>" name="route" id="route">
                                        <option data-display="<?php echo app('translator')->get('student.route_list'); ?> <?php if(is_required('route')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('student.route_list'); ?> <?php if(is_required('route')==true): ?> <span> *</span> <?php endif; ?></option>
                                        <?php $__currentLoopData = $route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($route_list->id); ?>" <?php echo e(old('route') == $route_list->id? 'selected': ''); ?>><?php echo e($route_list->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('route')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('route')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="select_vehicle_div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('vehicle') ? ' is-invalid' : ''); ?>" name="vehicle" id="selectVehicle">
                                        <option data-display="<?php echo app('translator')->get('student.vehicle_number'); ?> <?php if(is_required('vehicle')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('student.vehicle_number'); ?> <?php if(is_required('vehicle')==true): ?> <span> *</span> <?php endif; ?></option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_transport_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('vehicle')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('vehicle')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div> 
                        </div>

                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('student.Other_info'); ?></h4>
                                </div>
                            </div>
                        </div>
                         <div class="row mb-40 mt-30">
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('dormitory_name') ? ' is-invalid' : ''); ?>" name="dormitory_name" id="SelectDormitory">
                                        <option data-display="<?php echo app('translator')->get('dormitory.dormitory_name'); ?> <?php if(is_required('dormitory_name')==true): ?> * <?php endif; ?>" value=""><?php echo app('translator')->get('dormitory.dormitory_name'); ?> <?php if(is_required('dormitory_name')==true): ?> <span> *</span> <?php endif; ?></option >
                                        <?php $__currentLoopData = $dormitory_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dormitory_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($dormitory_list->id); ?>" <?php echo e(old('dormitory_name') == $dormitory_list->id? 'selected': ''); ?>><?php echo e($dormitory_list->dormitory_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('dormitory_name')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('dormitory_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20" id="roomNumberDiv">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('room_number') ? ' is-invalid' : ''); ?>" name="room_number" id="selectRoomNumber">
                                        <option data-display="<?php echo app('translator')->get('academics.room_number'); ?> <?php if(is_required('room_number')==true): ?> <span> *</span> <?php endif; ?>" value=""><?php echo app('translator')->get('academics.room_number'); ?> <?php if(is_required('room_number')==true): ?> <span> *</span> <?php endif; ?></option>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_dormitory_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('room_number')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('room_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('student.document_info'); ?></h4>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-30 mt-30">
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control<?php echo e($errors->has('national_id_number') ? ' is-invalid' : ''); ?>" type="text" name="national_id_number" value="<?php echo e(old('national_id_number')); ?>">
                                    <label><?php echo app('translator')->get('common.national_id_number'); ?> <?php if(is_required('national_id_number')==true): ?> <span> *</span> <?php endif; ?> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('national_id_number')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('national_id_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="local_id_number" value="<?php echo e(old('local_id_number')); ?>">
                                    <label> <?php echo app('translator')->get('common.birth_certificate_number'); ?><?php if(is_required('local_id_number')==true): ?> <span> *</span> <?php endif; ?> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('local_id_number')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('local_id_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="bank_account_number" value="<?php echo e(old('bank_account_number')); ?>">
                                    <label><?php echo app('translator')->get('accounts.bank_account_number'); ?><?php if(is_required('bank_account_number')==true): ?> <span> *</span> <?php endif; ?> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('bank_account_number')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('bank_account_number')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="bank_name" value="<?php echo e(old('bank_name')); ?>">
                                    <label><?php echo app('translator')->get('student.bank_name'); ?> <?php if(is_required('bank_name')==true): ?> <span> *</span> <?php endif; ?> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('bank_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('bank_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40">
                            <div class="col-lg-6">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <textarea class="primary-input form-control" cols="0" rows="3" name="previous_school_details"><?php echo e(old('previous_school_details')); ?></textarea>
                                    <label><?php echo app('translator')->get('student.previous_school_details'); ?><?php if(is_required('previous_school_details')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border textarea"></span>
                                    <?php if($errors->has('previous_school_details')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('previous_school_details')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <textarea class="primary-input form-control" cols="0" rows="3" name="additional_notes"><?php echo e(old('additional_notes')); ?></textarea>
                                    <label><?php echo app('translator')->get('student.additional_notes'); ?> <?php if(is_required('additional_notes')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border textarea"></span>
                                    <?php if($errors->has('additional_notes')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('additional_notes')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect mt-30">
                                    <input class="primary-input form-control" type="text" name="ifsc_code" value="<?php echo e(old('ifsc_code')); ?>">
                                    <label><?php echo app('translator')->get('student.ifsc_code'); ?> <?php if(is_required('ifsc_code')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('ifsc_code')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('ifsc_code')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                         <div class="row mb-40 mt-30">
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control" type="text" name="document_title_1" value="<?php echo e(old('document_title_1')); ?>">
                                    <label><?php echo app('translator')->get('student.document_01_title'); ?> <?php if(is_required('document_file_1')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('document_title_1')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('document_title_1')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="document_title_2" value="<?php echo e(old('document_title_2')); ?>">
                                    <label><?php echo app('translator')->get('student.document_02_title'); ?> <?php if(is_required('document_file_2')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('document_title_2')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('document_title_2')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="document_title_3" value="<?php echo e(old('document_title_3')); ?>">
                                    <label><?php echo app('translator')->get('student.document_03_title'); ?> <?php if(is_required('document_file_3')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('document_title_3')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('document_title_3')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input" type="text" name="document_title_4" value="<?php echo e(old('document_title_4')); ?>">
                                    <label><?php echo app('translator')->get('student.document_04_title'); ?> <?php if(is_required('document_file_4')==true): ?> <span> *</span> <?php endif; ?></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('document_title_4')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('document_title_4')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                         <div class="row mb-30">
                             <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="01  <?php if(is_required('document_file_1')==true): ?> * <?php endif; ?>"
                                                readonly="">
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('document_file_1')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('document_file_1')); ?></strong>
                                                        </span>
                                                <?php endif; ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_1"><?php echo app('translator')->get('common.browse'); ?></label>
                                            <input type="file" class="d-none" name="document_file_1" id="document_file_1">
                                        </button>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileTwoName" placeholder="02 <?php if(is_required('document_file_2')==true): ?> * <?php endif; ?>"
                                                readonly="">
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('document_file_2')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('document_file_2')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_2"><?php echo app('translator')->get('common.browse'); ?></label>
                                            <input type="file" class="d-none" name="document_file_2" id="document_file_2">
                                        </button>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileThreeName" placeholder="03 <?php if(is_required('document_file_3')==true): ?> * <?php endif; ?>"
                                                readonly="">
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('document_file_3')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('document_file_3')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_3"><?php echo app('translator')->get('common.browse'); ?></label>
                                            <input type="file" class="d-none" name="document_file_3" id="document_file_3">
                                        </button>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-3">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <input class="primary-input" type="text" id="placeholderFileFourName" placeholder="04 <?php if(is_required('document_file_4')==true): ?> * <?php endif; ?>"
                                                readonly="">
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('document_file_4')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('document_file_4')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_4"><?php echo app('translator')->get('common.browse'); ?></label>
                                            <input type="file" class="d-none" name="document_file_4" id="document_file_4">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        
                        <div class="row mt-40">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h4 class="stu-sub-head"><?php echo app('translator')->get('student.custom_field'); ?></h4>
                                </div>
                            </div>
                        </div>
                        <?php echo $__env->make('backEnd.studentInformation._custom_field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        

	                        <?php 
                                  $tooltip = "";
                                  if(userPermission(65)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>


                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                               <button class="primary-btn fix-gr-bg submit" id="_submit_btn_admission" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('student.save_student'); ?>
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
 
<input type="text" id="STurl" value="<?php echo e(route('student_admission_pic')); ?>" hidden>
 <div class="modal" id="LogoPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('student.crop_image_and_upload'); ?></h4>
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
                
                <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="upload_logo"><?php echo app('translator')->get('student.crop'); ?></a>
            </div>
        </div>
    </div>
</div>


 

 <div class="modal" id="FatherPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('student.crop_image_and_upload'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="fa_resize"></div>
                <button class="btn rotate float-lef" data-deg="90" > 
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" > 
                <i class="ti-back-left"></i></button>
                <hr>
                
                <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="FatherPic_logo"><?php echo app('translator')->get('student.crop'); ?></a>
            </div>
        </div>
    </div>
</div>

 

 <div class="modal" id="MotherPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crop Image And Upload</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="ma_resize"></div>
                <button class="btn rotate float-lef" data-deg="90" > 
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" > 
                <i class="ti-back-left"></i></button>
                <hr>
                
                <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="Mother_logo">Crop</a>
            </div>
        </div>
    </div>
</div>

 

 <div class="modal" id="GurdianPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crop Image And Upload</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="Gu_resize"></div>
                <button class="btn rotate float-lef" data-deg="90" > 
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" > 
                <i class="ti-back-left"></i></button>
                <hr>                
                <a href="javascript:;" class="primary-btn fix-gr-bg pull-right" id="Gurdian_logo">Crop</a>
            </div>
        </div>
    </div>
</div>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/croppie.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/st_addmision.js"></script>
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
        $(document).on('change','.phone_number',function(){
           
            let email =  $("#email_address").val();
            let phone =  $(this).val();
            checkExitStudent(email, phone);
        });
        $(document).on('change','.email_address',function(){
            let email = $(this).val();
            let phone = $("#phone_number").val();
            checkExitStudent(email, phone);
        });
        function checkExitStudent(email, phone){
           var url = $("#url").val();
           var formData = {
                email : email,
                phone : phone,
            }
            $.ajax({
                type: "GET",
                data: formData,
                dataType: "json",
                url: url + "/" + "student/check-exit",
                success: function(data) {
                    if(data.student !=null) {
                        $('#exitStudent').removeClass('d-none');
                    } else {
                        $('#exitStudent').addClass('d-none');
                        $('#edit_info').prop('checked', false); 
                    }
                  
                },
                error: function(data) {
                    console.log("Error:", data);
                }

            })
        }
        
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/studentInformation/student_admission.blade.php ENDPATH**/ ?>