<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('student.student_details'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <?php
        function showTimelineDocName($data){
            $name = explode('/', $data);
            $number = count($name);
            return $name[$number-1];
        }
        function showDocumentName($data){
            $name = explode('/', $data);
            $number = count($name);
            return $name[$number-1];
        }
    ?>
<?php  $setting = app('school_info');  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?>

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('student.student_details'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="<?php echo e(route('student_list')); ?>"><?php echo app('translator')->get('student.student_list'); ?></a>
                    <a href="#"><?php echo app('translator')->get('student.student_details'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Start Student Meta Information -->
                    <div class="main-title">
                        <h3 class="mb-20"><?php echo app('translator')->get('student.student_details'); ?></h3>
                    </div>
                    <div class="student-meta-box">
                        <div class="student-meta-top"></div>
                            <img class="student-meta-img img-100" src="<?php echo e(file_exists(@$student_detail->student_photo) ? asset($student_detail->student_photo) : asset('public/uploads/staff/demo/staff.jpg')); ?>" alt="">

                        <div class="white-box radius-t-y-0">
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('student.student_name'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e(@$student_detail->first_name.' '.@$student_detail->last_name); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('student.admission_number'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e(@$student_detail->admission_no); ?>

                                    </div>
                                </div>
                            </div>
                            <?php if($setting->multiple_roll ==0): ?>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('student.roll_number'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e(@$student_detail->roll_no); ?>

                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('student.class'); ?>
                                    </div>
                                    <div class="value">
                                        <?php if($student_detail->defaultClass!=""): ?>
                                            <?php echo e(@$student_detail->defaultClass->class->class_name); ?>

                                            
                                        <?php elseif($student_detail->studentRecord !=""): ?>  
                                        <?php echo e(@$student_detail->studentRecord->class->class_name); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('student.section'); ?>
                                    </div>
                                    <div class="value">
                                        
                                        <?php if($student_detail->defaultClass!=""): ?>
                                        <?php echo e(@$student_detail->defaultClass->section->section_name); ?>

                                       
                                        <?php elseif($student_detail->studentRecord !=""): ?>  
                                        <?php echo e(@$student_detail->studentRecord->section->section_name); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('common.gender'); ?>
                                    </div>
                                    <div class="value">

                                        <?php echo e(@$student_detail->gender !=""?$student_detail->gender->base_setup_name:""); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Student Meta Information -->
                    <?php if(count($siblings) >0 ): ?>
                        <!-- Start Siblings Meta Information -->
                        <div class="main-title mt-40">
                            <h3 class="mb-20"><?php echo app('translator')->get('student.sibling_information'); ?> </h3>
                        </div>
                        <?php $__currentLoopData = $siblings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sibling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="student-meta-box mb-20">
                                    <div class="student-meta-top siblings-meta-top"></div>
                                    <img class="student-meta-img img-100" src="<?php echo e(asset(@$sibling->student_photo)); ?>" alt="">
                                    <div class="white-box radius-t-y-0">
                                        <div class="single-meta mt-10">
                                            <div class="d-flex justify-content-between">
                                                <div class="name">
                                                    <?php echo app('translator')->get('student.sibling_name'); ?>
                                                </div>
                                                 <div class="value">
                                                    <?php echo e(isset($sibling->full_name)?$sibling->full_name:''); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="d-flex justify-content-between">
                                                <div class="name">
                                                    <?php echo app('translator')->get('student.admission_number'); ?>
                                                </div>
                                                <div class="value">
                                                    <?php echo e(@$sibling->admission_no); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="d-flex justify-content-between">
                                                <div class="name">
                                                    <?php echo app('translator')->get('student.roll_number'); ?>
                                                </div>
                                                <div class="value">
                                                    <?php echo e(@$sibling->roll_no); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="d-flex justify-content-between">
                                                <div class="name">
                                                    <?php echo app('translator')->get('student.class'); ?>
                                                </div>
                                                <div class="value">
                                                    <?php echo e(@$sibling->class->class_name); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="d-flex justify-content-between">
                                                <div class="name">
                                                    <?php echo app('translator')->get('student.section'); ?>
                                                </div>
                                                <div class="value">
                                                    <?php echo e($sibling->section !=""?$sibling->section->section_name:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="d-flex justify-content-between">
                                                <div class="name">
                                                    <?php echo app('translator')->get('student.gender'); ?>
                                                </div>
                                                <div class="value">
                                                    <?php echo e($sibling->gender!=""? $sibling->gender->base_setup_name:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- End Siblings Meta Information -->

                <?php endif; ?>
                </div>

                <!-- Start Student Details -->
                <div class="col-lg-9 student-details up_admin_visitor">
                    <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link  <?php if(Session::get('studentDocuments') != 'active' && Session::get('studentRecord') != 'active' && Session::get('studentTimeline') != 'active'): ?> active <?php endif; ?>" href="#studentProfile" role="tab" data-toggle="tab"><?php echo app('translator')->get('student.profile'); ?></a>
                        </li>
                        <?php if(generalSetting()->fees_status == 0): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#studentFees" role="tab" data-toggle="tab"><?php echo app('translator')->get('fees.fees'); ?></a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item">
                            <a class="nav-link" href="#leaves" role="tab" data-toggle="tab"><?php echo app('translator')->get('leave.leave'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#studentExam" role="tab" data-toggle="tab"><?php echo app('translator')->get('exam.exam'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Session::get('studentDocuments') == 'active'? 'active':''); ?>" href="#studentDocuments" role="tab" data-toggle="tab"><?php echo app('translator')->get('student.document'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Session::get('studentRecord') == 'active'? 'active':''); ?> " href="#studentRecord" role="tab" data-toggle="tab"><?php echo app('translator')->get('student.student_record'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Session::get('studentTimeline') == 'active'? 'active':''); ?> " href="#studentTimeline" role="tab" data-toggle="tab"><?php echo app('translator')->get('student.timeline'); ?></a>
                        </li>
                        
                        <li class="nav-item edit-button">
                            <?php if(userPermission(66)): ?>
                                <a href="<?php echo e(route('student_edit', [@$student_detail->id])); ?>"
                                class="primary-btn small fix-gr-bg"><?php echo app('translator')->get('common.edit'); ?>
                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>


                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Profile Tab -->
                        <div role="tabpanel" class="tab-pane fade  <?php if(Session::get('studentDocuments') != 'active' && Session::get('studentRecord') != 'active' && Session::get('studentTimeline') != 'active'): ?> show active <?php endif; ?>" id="studentProfile">
                            <div class="white-box">
                                <h4 class="stu-sub-head"><?php echo app('translator')->get('student.personal_info'); ?></h4>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.admission_date'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(!empty($student_detail->admission_date)? dateConvert($student_detail->admission_date):''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('student.date_of_birth'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(!empty($student_detail->date_of_birth)? dateConvert($student_detail->date_of_birth):''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('student.age'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(\Carbon\Carbon::parse($student_detail->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years')); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('student.category'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->category != ""? $student_detail->category->category_name:""); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('student.group'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->group ? $student_detail->group->group:""); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('student.religion'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->religion != ""? $student_detail->religion->base_setup_name:""); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('student.phone_number'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php if($student_detail->mobile): ?>
                                                    <a href="tel:<?php echo e(@$student_detail->mobile); ?>"> <?php echo e(@$student_detail->mobile); ?></a>
                                                    <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('common.email_address'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php if($student_detail->email): ?>
                                                <a href="mailto:<?php echo e(@$student_detail->email); ?>"> <?php echo e(@$student_detail->email); ?></a>
                                                    <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if(moduleStatusCheck('Lead')==true): ?>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-6">
                                                <div class="">
                                                    <?php echo app('translator')->get('lead::lead.city'); ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-md-7">
                                                <div class="">
                                                    <?php echo e(@$student_detail->leadCity->city_name); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('lead::lead.source'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(@$student_detail->source->source_name); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('student.present_address'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(@$student_detail->current_address); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('student.permanent_address'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(@$student_detail->permanent_address); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Start Parent Part -->
                                <h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('student.Parent_Guardian_Details'); ?></h4>
                                <div class="d-flex">
                                    <div class="mr-20 mt-20">
                                            <img class="student-meta-img img-100" src="<?php echo e(file_exists(@$student_detail->parents->fathers_photo) ? asset($student_detail->parents->fathers_photo) : asset('public/uploads/staff/demo/father.png')); ?>" alt="">

                                    </div>
                                    <div class="w-100">
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.father_name'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e(@$student_detail->parents->fathers_name); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.occupation'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e(@$student_detail->parents!=""?@$student_detail->parents->fathers_occupation:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.phone_number'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e(@$student_detail->parents !=""?@$student_detail->parents->fathers_mobile:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <div class="mr-20 mt-20">
                                             <img class="student-meta-img img-100" src="<?php echo e(file_exists(@$student_detail->parents->mothers_photo) ? asset($student_detail->parents->mothers_photo) : asset('public/uploads/staff/demo/mother.jpg')); ?>" alt="">
                                    </div>
                                    <div class="w-100">
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.mother_name'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e($student_detail->parents !=""?@$student_detail->parents->mothers_name:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.occupation'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e($student_detail->parents !=""?@$student_detail->parents->mothers_occupation:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.phone_number'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e($student_detail->parents !=""?@$student_detail->parents->mothers_mobile:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <div class="mr-20 mt-20">
                                        <img class="student-meta-img img-100" src="<?php echo e(file_exists(@$student_detail->parents->guardians_photo) ? asset($student_detail->parents->guardians_photo) : asset('public/uploads/staff/demo/guardian.jpg')); ?>" alt="">

                                    </div>
                                    <div class="w-100">
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.guardian_name'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e($student_detail->parents !=""?@$student_detail->parents->guardians_name:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.email_address'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e($student_detail->parents !=""?@$student_detail->parents->guardians_email:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.phone_number'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e($student_detail->parents !=""?@$student_detail->parents->guardians_mobile:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.relation_with_guardian'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e($student_detail->parents !=""?@$student_detail->parents->guardians_relation:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.occupation'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e($student_detail->parents !=""?@$student_detail->parents->guardians_occupation:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.guardian_address'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php echo e($student_detail->parents !=""?@$student_detail->parents->guardians_address:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Parent Part -->

                                <!-- Start Transport Part -->
                                <h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('student.transport_and_dormitory_info'); ?></h4>


                                <?php if(!empty($student_detail->route_list_id)): ?>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.route'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->route_list_id)? @$student_detail->route->title: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php endif; ?>

                                <?php if(isset($student_detail->vehicle)): ?>
                                    <?php if(!empty($vehicle_no)): ?>
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5">
                                                <div class="">
                                                    <?php echo app('translator')->get('student.vehicle_number'); ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-md-6">
                                                <div class="">
                                                    <?php echo e($student_detail->vehicle != ""? @$student_detail->vehicle->vehicle_no: ''); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php endif; ?>


                                <?php endif; ?>


                                    <?php if(isset($driver_info)): ?>
                                        <?php if(!empty($driver_info->full_name)): ?>
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.driver_name'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-7 col-md-6">
                                                    <div class="">
                                                        <?php echo e($student_detail->vechile_id != ""? @$driver_info->full_name:''); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                    <?php endif; ?>

                                    <?php if(isset($driver_info)): ?>
                                        <?php if(!empty($driver_info->mobile)): ?>
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.driver_phone_number'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-7 col-md-6">
                                                    <div class="">
                                                        <?php echo e($student_detail->vechile_id != ""? @$driver_info->mobile:''); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                    <?php if(isset($student_detail->dormitory)): ?>
                                        <?php if(!empty($student_detail->dormitory->dormitory_name)): ?>
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5">
                                                    <div class="">
                                                        <?php echo app('translator')->get('student.dormitory_name'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-7 col-md-6">
                                                    <div class="">
                                                        <?php echo e(isset($student_detail->dormitory_id)?@$student_detail->dormitory->dormitory_name: ''); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                <!-- End Transport Part -->

                                <!-- Start Other Information Part -->
                                <h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('student.other_information'); ?></h4>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('common.blood_group'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->bloodgroup_id)? @$student_detail->bloodGroup->base_setup_name: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.student_group'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->student_group_id)? @$student_detail->group->group: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.height'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->height)? @$student_detail->height: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.weight'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->weight)? @$student_detail->weight: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.previous_school_details'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->previous_school_details)? @$student_detail->previous_school_details: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.national_id_number'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->national_id_no)? @$student_detail->national_id_no: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.local_id_number'); ?>
                                            </div>
                                        </div>


                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->local_id_no)? @$student_detail->local_id_no: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('accounts.bank_account_number'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->bank_account_no)? @$student_detail->bank_account_no: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.bank_name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->bank_name)? @$student_detail->bank_name: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.ifsc_code'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->ifsc_code)? @$student_detail->ifsc_code: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Other Information Part -->
                                
                                
                                    <?php echo $__env->make('backEnd.customField._coutom_field_show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                

                            </div>
                        </div>
                        <!-- End Profile Tab -->

                        <!-- Start Fees Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="studentFees">
                            <div class="table-responsive">
                                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="white-box no-search no-paginate no-table-info mb-2">
                                        <div class="main-title">
                                            <h3 class="mb-10"><?php echo e($record->class->class_name); ?> (<?php echo e($record->section->section_name); ?>)</h3>
                                        </div>
                                        <table class="display school-table school-table-style res_scrol" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('fees.fees_group'); ?></th>
                                                    <th><?php echo app('translator')->get('fees.fees_code'); ?></th>
                                                    <th><?php echo app('translator')->get('fees.due_date'); ?></th>
                                                    <th><?php echo app('translator')->get('fees.Status'); ?></th>
                                                    <th><?php echo app('translator')->get('fees.amount'); ?> (<?php echo e(@$currency); ?>)</th>
                                                    <th><?php echo app('translator')->get('fees.payment_ID'); ?></th>
                                                    <th><?php echo app('translator')->get('fees.mode'); ?></th>
                                                    <th><?php echo app('translator')->get('common.date'); ?></th>
                                                    <th><?php echo app('translator')->get('fees.discount'); ?> (<?php echo e(@$currency); ?>)</th>
                                                    <th><?php echo app('translator')->get('fees.fine'); ?> (<?php echo e(@$currency); ?>)</th>
                                                    <th><?php echo app('translator')->get('fees.paid'); ?> (<?php echo e(@$currency); ?>)</th>
                                                    <th><?php echo app('translator')->get('fees.balance'); ?> (<?php echo e(@$currency); ?>)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    @$grand_total = 0;
                                                    @$total_fine = 0;
                                                    @$total_discount = 0;
                                                    @$total_paid = 0;
                                                    @$total_grand_paid = 0;
                                                    @$total_balance = 0;
                                                ?>
                                                <?php $__currentLoopData = $student_detail->feesAssign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_assigned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($fees_assigned->record_id == $record->id): ?>
                                                        <?php
                                                            @$grand_total += @$fees_assigned->feesGroupMaster->amount;
                                                        ?>
                                                        <?php
                                                            @$discount_amount = $fees_assigned->applied_discount;
                                                            @$total_discount += @$discount_amount;
                                                            @$student_id = @$fees_assigned->student_id;
                                                        ?>
                                                        <?php
                                                            @$paid = App\SmFeesAssign::discountSum(@$fees_assigned->student_id, @$fees_assigned->feesGroupMaster->feesTypes->id, 'amount', $fees_assigned->record_id);
                                                            @$total_grand_paid += @$paid;
                                                        ?>
                                                        <?php
                                                            @$fine = App\SmFeesAssign::discountSum(@$fees_assigned->student_id, @$fees_assigned->feesGroupMaster->feesTypes->id, 'fine', $fees_assigned->record_id);
                                                            @$total_fine += @$fine;
                                                        ?>

                                                        <?php
                                                            @$total_paid = @$discount_amount + @$paid;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo e(@$fees_assigned->feesGroupMaster->feesGroups !=""?@$fees_assigned->feesGroupMaster->feesGroups->name:""); ?></td>
                                                            <td><?php echo e(@$fees_assigned->feesGroupMaster->feesTypes!=""?@$fees_assigned->feesGroupMaster->feesTypes->name:""); ?></td>
                                                            <td>
                                                                <?php if(!empty(@$fees_assigned->feesGroupMaster)): ?>
                                                                    <?php echo e(@$fees_assigned->feesGroupMaster->date != ""? dateConvert(@$fees_assigned->feesGroupMaster->date):''); ?>

                                                                <?php endif; ?>
                                                            </td>
                                                            <?php
                                                                $total_payable_amount=$fees_assigned->fees_amount;
                                                                $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                                                $balance_amount=number_format($rest_amount+$fine, 2, '.', '');
                                                                $total_balance +=  $balance_amount;
                                                            ?>
                                                            <td>
                                                                <?php if($balance_amount ==0): ?>
                                                                    <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('fees.paid'); ?></button>
                                                                <?php elseif($paid != 0): ?>
                                                                    <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('fees.partial'); ?></button>
                                                                <?php elseif($paid == 0): ?>
                                                                    <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->get('fees.unpaid'); ?></button>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    echo number_format($fees_assigned->feesGroupMaster->amount, 2, '.', '');
                                                                ?>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td> <?php echo e(@$discount_amount); ?> </td>
                                                            <td><?php echo e(@$fine); ?></td>
                                                            <td><?php echo e(@$paid); ?></td>
                                                            <td>
                                                                <?php echo @$balance_amount; ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            @$payments = App\SmFeesAssign::feesPayment(@$fees_assigned->feesGroupMaster->feesTypes->id, @$fees_assigned->student_id, $fees_assigned->record_id);
                                                            $i = 0;
                                                        ?>
                                                        <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right"><img src="<?php echo e(asset('public/backEnd/img/table-arrow.png')); ?>"></td>
                                                                <td>
                                                                    <?php
                                                                        @$created_by = App\User::find(@$payment->created_by);
                                                                    ?>
                                                                    <?php if(@$created_by != ""): ?>
                                                                    <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo e('Collected By: '.@$created_by->full_name); ?>"><?php echo e(@$payment->fees_type_id.'/'.@$payment->id); ?></a></td>
                                                                    <?php endif; ?>
                                                                <td><?php echo e($payment->payment_mode); ?></td>
                                                                <td class="nowrap"><?php echo e(@$payment->payment_date != ""? dateConvert(@$payment->payment_date):''); ?></td>
                                                                <td><?php echo e(@$payment->discount_amount); ?></td>
                                                                <td>
                                                                    <?php echo e($payment->fine); ?>

                                                                    <?php if($payment->fine!=0): ?>
                                                                        <?php if(strlen($payment->fine_title) > 14): ?>
                                                                            <spna class="text-danger nowrap" title="<?php echo e($payment->fine_title); ?>">
                                                                                (<?php echo e(substr($payment->fine_title, 0, 15) . '...'); ?>)
                                                                            </spna>
                                                                        <?php else: ?>
                                                                            <?php if($payment->fine_title==''): ?>
                                                                                <?php echo e($payment->fine_title); ?>

                                                                            <?php else: ?>
                                                                                <spna class="text-danger nowrap">
                                                                                    (<?php echo e($payment->fine_title); ?>)
                                                                                </spna>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?php echo e(@$payment->amount); ?></td>
                                                                <td></td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th><?php echo app('translator')->get('fees.grand_total'); ?> (<?php echo e(@$currency); ?>)</th>
                                                    <th></th>
                                                    <th><?php echo e(@$grand_total); ?></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th><?php echo e(@$total_discount); ?></th>
                                                    <th><?php echo e(@$total_fine); ?></th>
                                                    <th><?php echo e(@$total_grand_paid); ?></th>
                                                    <th><?php echo e(number_format($total_balance, 2, '.', '')); ?></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <!-- End Profile Tab -->
                        <!-- Start leave Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="leaves">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                        <table class="display school-table school-table-style" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="nowrap"><?php echo app('translator')->get('leave.leave_type'); ?></th>
                                                    <th class="nowrap"><?php echo app('translator')->get('leave.leave_from'); ?> </th>
                                                    <th class="nowrap"><?php echo app('translator')->get('leave.leave_to'); ?></th>
                                                    <th class="nowrap"><?php echo app('translator')->get('leave.apply_date'); ?></th>
                                                    <th class="nowrap"><?php echo app('translator')->get('common.status'); ?></th>
                                                    <th class="nowrap"><?php echo app('translator')->get('common.action'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $diff = ''; ?>
                                            <?php if(isset($student_detail)): ?>
                                            <?php if(count($student_detail->studentLeave)>0): ?>
                                            <?php $__currentLoopData = $student_detail->studentLeave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="nowrap"><?php echo e(@$value->leaveType->type); ?></td>
                                                    <td class="nowrap"><?php echo e($value->leave_from != ""? dateConvert($value->leave_from):''); ?></td>
                                                    <td class="nowrap"><?php echo e($value->leave_to != ""? dateConvert($value->leave_to):''); ?></td>
                                                    <td class="nowrap"><?php echo e($value->apply_date != ""? dateConvert($value->apply_date):''); ?></td>
                                                    <td class="nowrap">
                                                        <?php if($value->approve_status == 'P'): ?>
                                                        <button class="primary-btn small bg-warning text-white border-0"> <?php echo app('translator')->get('student.pending'); ?></button>
                                                        <?php endif; ?>

                                                        <?php if($value->approve_status == 'A'): ?>
                                                        <button class="primary-btn small bg-success text-white border-0"> <?php echo app('translator')->get('student.approved'); ?></button>
                                                        <?php endif; ?>

                                                        <?php if($value->approve_status == 'C'): ?>
                                                        <button class="primary-btn small bg-danger text-white border-0"> <?php echo app('translator')->get('common.cancelled'); ?></button>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="nowrap">
                                                        <a class="modalLink" data-modal-size="modal-md" title="<?php echo app('translator')->get('student.view'); ?> <?php echo app('translator')->get('student.leave'); ?> <?php echo app('translator')->get('student.details'); ?>" href="<?php echo e(url('view-leave-details-apply', $value->id)); ?>"><button class="primary-btn small tr-bg"> <?php echo app('translator')->get('student.view'); ?> </button></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo app('translator')->get('student.not_leaves_data'); ?></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- End leave Tab -->

                        <!-- Start Exam Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="studentExam">
                            <?php
                                $exam_count= count($exam_terms);
                            ?>
                            <?php if($exam_count > 1): ?>
                                <div class="white-box no-search no-paginate no-table-info mb-2">
                                <table class="display school-table school-table-style shadow-none pb-0" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <?php echo app('translator')->get('student.subject'); ?>
                                                </th>
                                                <th>
                                                    <?php echo app('translator')->get('student.full_marks'); ?>
                                                </th>
                                                <th>
                                                    <?php echo app('translator')->get('student.passing_marks'); ?>
                                                </th>
                                                <th>
                                                    <?php echo app('translator')->get('student.obtained_marks'); ?>
                                                </th>
                                                <th>
                                                    <?php echo app('translator')->get('student.results'); ?>
                                                </th>
                                            </tr>
                                        </thead>
                                </table>
                                </div>
                            <?php endif; ?>
                            <div class="white-box no-search no-paginate no-table-info mb-2">
                                <?php $__currentLoopData = $student_detail->studentRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $exam_terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $get_results = App\SmStudent::getExamResult(@$exam->id, @$record);
                                        ?>
                                        <?php if($get_results): ?>
                                            <div class="main-title">
                                                <h3 class="mb-0"><?php echo e(@$exam->title); ?></h3>
                                            </div>
                                            <?php
                                                $grand_total = 0;
                                                $grand_total_marks = 0;
                                                $result = 0;
                                                $temp_grade=[];
                                                $total_gpa_point = 0;
                                                $total_subject = count($get_results);
                                                $optional_subject = 0;
                                                $optional_gpa = 0;
                                                $onlyOptional = 0;
                                            ?>
                                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('student.date'); ?></th>
                                                        <th><?php echo app('translator')->get('exam.subject_full_marks'); ?></th>
                                                        <th><?php echo app('translator')->get('exam.obtained_marks'); ?></th>
                                                        <th><?php echo app('translator')->get('exam.grade'); ?></th>
                                                        <th><?php echo app('translator')->get('exam.gpa'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $get_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            if((!is_null($record->optionalSubjectSetup)) && (!is_null($record->optionalSubject))){
                                                                if($mark->subject_id != @$record->optionalSubject->subject_id){
                                                                    $temp_grade[]=$mark->total_gpa_grade;
                                                                }
                                                            }else{
                                                                $temp_grade[]=$mark->total_gpa_grade;
                                                            }
                                                            $total_gpa_point += $mark->total_gpa_point;
                                                            if(! is_null(@$record->optionalSubject)){
                                                                if(@$record->optionalSubject->subject_id == $mark->subject->id){
                                                                    $total_gpa_point = $total_gpa_point - $mark->total_gpa_point;
                                                                    $onlyOptional = $mark->total_gpa_point;
                                                                }
                                                            }
                                                            $temp_gpa[]=$mark->total_gpa_point;
                                                            $get_subject_marks =  subjectFullMark ($mark->exam_type_id, $mark->subject_id );

                                                            $subject_marks = App\SmStudent::fullMarksBySubject($exam->id, $mark->subject_id);
                                                            $schedule_by_subject = App\SmStudent::scheduleBySubject($exam->id, $mark->subject_id, @$record);
                                                            $result_subject = 0;
                                                            $grand_total_marks += $get_subject_marks;
                                                            if(@$mark->is_absent == 0){
                                                                $grand_total += @$mark->total_marks;
                                                                if($mark->marks < $subject_marks->pass_mark){
                                                                    $result_subject++;
                                                                    $result++;
                                                                }
                                                            }else{
                                                                $result_subject++;
                                                                $result++;
                                                            }
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo e(!empty($schedule_by_subject->date)? dateConvert($schedule_by_subject->date):''); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(@$mark->subject->subject_name); ?> (<?php echo e(@subjectFullMark($mark->exam_type_id, $mark->subject_id )); ?>)
                                                            </td>
                                                            <td>
                                                                <?php echo e(@$mark->total_marks); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(@$mark->total_gpa_grade); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(number_format(@$mark->total_gpa_point, 2, '.', '')); ?>

                                                                <?php
                                                                    if (@$record->optionalSubject->subject_id!='') {
                                                                        if (@$record->optionalSubject->subject_id == $mark->subject->id) {
                                                                            $optional_subject = 1;
                                                                            if ($mark->total_gpa_point > @$record->optionalSubjectSetup->gpa_above) {
                                                                                $optional_gpa = @$record->optionalSubjectSetup->gpa_above;
                                                                                echo "GPA Above ".@$record->optionalSubjectSetup->gpa_above;
                                                                                echo "<hr>";
                                                                                echo number_format($mark->total_gpa_point  - @$record->optionalSubjectSetup->gpa_above, 2, '.', '');
                                                                            } else {
                                                                                echo "GPA Above".@$record->optionalSubjectSetup->gpa_above;
                                                                                echo "<hr>";
                                                                                echo "0";
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th>
                                                            <?php echo app('translator')->get('exam.grand_total'); ?>: <?php echo e($grand_total); ?>/<?php echo e($grand_total_marks); ?>

                                                        </th>
                                                        <th><?php echo app('translator')->get('exam.grade'); ?>:
                                                            <?php
                                                                if(in_array($fail_gpa_name->grade_name,$temp_grade)){
                                                                    echo $fail_gpa_name->grade_name;
                                                                }else {
                                                                    $final_gpa_point = ($total_gpa_point + @$onlyOptional - @$record->optionalSubjectSetup->gpa_above)/  ($total_subject - $optional_subject);
                                                                    $average_grade=0;
                                                                    $average_grade_max=0;
                                                                    if($result == 0 && $grand_total_marks != 0){
                                                                        $gpa_point=number_format($final_gpa_point, 2, '.', '');
                                                                        if($gpa_point >= $max_gpa){
                                                                            $average_grade_max = App\SmMarksGrade::where('school_id',Auth::user()->school_id)
                                                                            ->where('academic_id', getAcademicId() )
                                                                            ->where('from', '<=', $max_gpa)
                                                                            ->where('up', '>=', $max_gpa)
                                                                            ->first('grade_name');

                                                                            echo  @$average_grade_max->grade_name;
                                                                        } else {
                                                                            $average_grade = App\SmMarksGrade::where('school_id',Auth::user()->school_id)
                                                                            ->where('academic_id', getAcademicId())
                                                                            ->where('from', '<=', $final_gpa_point)
                                                                            ->where('up', '>=', $final_gpa_point )
                                                                            ->first('grade_name');
                                                                            echo  @$average_grade->grade_name;
                                                                        }
                                                                    }else{
                                                                        echo $fail_gpa_name->grade_name;
                                                                    }
                                                                }
                                                            ?>
                                                        </th>
                                                        <th>
                                                            <?php if(@$record->optionalSubject->subject_id!=''): ?>
                                                                <?php echo app('translator')->get('reports.without_optional'); ?>
                                                                <?php
                                                                    $withoutOptionalSubject = $total_subject - $optional_subject;
                                                                    $final_gpa_point = ($total_gpa_point - $optional_gpa);
                                                                    $totalAdd = $total_gpa_point / $withoutOptionalSubject;
                                                                    $float_final_gpa_point_add=number_format($totalAdd,2);
                                                                    if($float_final_gpa_point_add >= $max_gpa){
                                                                        echo $max_gpa;
                                                                    }else {
                                                                        echo $float_final_gpa_point_add;
                                                                    }
                                                                ?>
                                                                <br>
                                                            <?php endif; ?>
                                                            
                                                            <?php echo app('translator')->get('exam.gpa'); ?>
                                                            <?php
                                                                $final_gpa_point = 0;
                                                                $final_gpa_point = ($total_gpa_point + @$onlyOptional - @$record->optionalSubjectSetup->gpa_above)/  ($total_subject - $optional_subject);
                                                                $float_final_gpa_point=number_format($final_gpa_point,2);
                                                                if($float_final_gpa_point >= $max_gpa){
                                                                    echo number_format($max_gpa,2);
                                                                }else {
                                                                    echo number_format($float_final_gpa_point,2);
                                                                }
                                                            ?>
                                                        </th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <!-- End Exam Tab -->

                        <!-- Start Documents Tab -->
                        <div role="tabpanel" class="tab-pane fade <?php echo e(Session::get('studentDocuments') == 'active'? 'show active':''); ?>" id="studentDocuments">
                            <div class="white-box">
                                <div class="text-right mb-20">
                                    <button type="button" data-toggle="modal" data-target="#add_document_madal"
                                            class="primary-btn tr-bg text-uppercase bord-rad">
                                        <?php echo app('translator')->get('student.upload_document'); ?>
                                        <span class="pl ti-upload"></span>
                                    </button>
                                </div>
                                <table id="" class="table simple-table table-responsive school-table"
                                       cellspacing="0">
                                    <thead class="d-block">
                                    <tr class="d-flex">
                                        <th class="col-2"><?php echo app('translator')->get('student.title'); ?></th>
                                        <th class="col-6"><?php echo app('translator')->get('student.name'); ?></th>
                                        <th class="col-4"><?php echo app('translator')->get('student.action'); ?></th>
                                    </tr>
                                    </thead>

                                    <tbody class="d-block">
                                    <?php if($student_detail->document_file_1 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-2"><?php echo e($student_detail->document_title_1); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_1)); ?></td>
                                            <td class="col-4">
                                                <?php if(file_exists($student_detail->document_file_1)): ?>
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad"
                                                        href="<?php echo e(url($student_detail->document_file_1)); ?>" download>
                                                        <?php echo app('translator')->get('common.download'); ?><span class="pl ti-download"></span>
                                                    </a>
                                                     <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,1)"  data-id="1"  href="#">
                                                        <span class="ti-trash"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_2 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-2"><?php echo e($student_detail->document_title_2); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_2)); ?></td>
                                            <td class="col-4">
                                                <?php if(file_exists($student_detail->document_file_2)): ?>
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad"
                                                       href="<?php echo e(url($student_detail->document_file_2)); ?>" download>
                                                        <?php echo app('translator')->get('common.download'); ?><span class="pl ti-download"></span>
                                                    </a>
                                                    <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,2)"  data-id="2"  href="#">
                                                        <span class="ti-trash"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_3 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-2"><?php echo e($student_detail->document_title_3); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_3)); ?></td>
                                            <td class="col-4">
                                                <?php if(file_exists($student_detail->document_file_3)): ?>
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad"
                                                    href="<?php echo e(url($student_detail->document_file_3)); ?>" download>
                                                        <?php echo app('translator')->get('common.download'); ?><span class="pl ti-download"></span>
                                                    </a>
                                                    <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,3)"  data-id="3"  href="#">
                                                        <span class="ti-trash"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_4 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-2"><?php echo e($student_detail->document_title_4); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_4)); ?></td>
                                            <td class="col-4">
                                                <?php if(file_exists($student_detail->document_file_4)): ?>
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad"
                                                    href="<?php echo e(url($student_detail->document_file_4)); ?>" download>
                                                        <?php echo app('translator')->get('common.download'); ?><span class="pl ti-download"></span>
                                                    </a>

                                                    <a class="primary-btn icon-only fix-gr-bg" onclick="deleteDoc(<?php echo e($student_detail->id); ?>,4)"  data-id="4"  href="#">
                                                        <span class="ti-trash"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                     

                                    <div class="modal fade admin-query" id="delete-doc" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('common.delete'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <form action="<?php echo e(route('student_document_delete')); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="student_id" >
                                                            <input type="hidden" name="doc_id">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                            <button type="submit" class="primary-btn fix-gr-bg"><?php echo app('translator')->get('common.delete'); ?></button>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    

                                    <?php $__currentLoopData = $student_detail->studentDocument; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr class="d-flex">
                                            <td class="col-2"><?php echo e($document->title); ?></td>
                                            <td class="col-6"><?php echo e(showDocument($document->file)); ?></td>
                                            <td class="col-4">
                                                <?php if(file_exists($document->file)): ?>
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad"
                                                    href="<?php echo e(url($document->file)); ?>" download>
                                                        <?php echo app('translator')->get('common.download'); ?><span class="pl ti-download"></span>
                                                    </a>
                                                <?php endif; ?>
                                                <a class="primary-btn icon-only fix-gr-bg" data-toggle="modal"
                                                   data-target="#deleteDocumentModal<?php echo e($document->id); ?>" href="#">
                                                    <span class="ti-trash"></span>
                                                </a>

                                            </td>
                                        </tr>
                                        <div class="modal fade admin-query" id="deleteDocumentModal<?php echo e($document->id); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->get('common.delete'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?>
                                                            </button>
                                                            <a class="primary-btn fix-gr-bg"
                                                               href="<?php echo e(route('delete-student-document', [$document->id])); ?>">
                                                                <?php echo app('translator')->get('common.delete'); ?></a>
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
                        <!-- End Documents Tab -->
                        <!-- Add Document modal form start-->
                        <div class="modal fade admin-query" id="add_document_madal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"> <?php echo app('translator')->get('student.upload_document'); ?></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'upload_document',
                                                                'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="hidden" name="student_id"
                                                           value="<?php echo e($student_detail->id); ?>">
                                                    <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control{" type="text"
                                                                       name="title" value="" id="title">
                                                                <label> <?php echo app('translator')->get('common.title'); ?><span>*</span> </label>
                                                                <span class="focus-border"></span>

                                                                <span class=" text-danger" role="alert"
                                                                      id="amount_error">
                                                                    
                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-30">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect">
                                                                <input class="primary-input" type="text"
                                                                       id="placeholderPhoto" placeholder="Document"
                                                                       disabled>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="primary-btn-small-input" type="button">
                                                                <label class="primary-btn small fix-gr-bg" for="photo"> <?php echo app('translator')->get('common.browse'); ?></label>
                                                                <input type="file" class="d-none" name="photo"
                                                                       id="photo">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- <div class="col-lg-12 text-center mt-40">
                                                    <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                                        <span class="ti-check"></span>
                                                        save information
                                                    </button>
                                                </div> -->
                                                <div class="col-lg-12 text-center mt-40">
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?>
                                                        </button>

                                                        <button class="primary-btn fix-gr-bg submit" type="submit"><?php echo app('translator')->get('student.save'); ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo e(Form::close()); ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Add Document modal form end-->
                        <!-- delete document modal -->

                        <!-- delete document modal -->
                        <!-- Start Timeline Tab -->
                        <div role="tabpanel" class="tab-pane fade <?php echo e(Session::get('studentRecord') == 'active'? 'show active':''); ?>" id="studentRecord">
                            <div class="white-box">
                                <div class="text-right mb-20">
                                    <button  class="primary-btn-small-input primary-btn small fix-gr-bg" type="button"
                                    data-toggle="modal" data-target="#assignClass"> <span class="ti-plus pr-2"></span> <?php echo app('translator')->get('common.add'); ?></button>
                                </div>
                                <table id="" class="table simple-table table-responsive school-table"
                                       cellspacing="0">
                                    <thead class="d-block">
                                        <tr class="d-flex">
                                            <th class="col-3"><?php echo app('translator')->get('common.class'); ?></th>
                                            <th class="col-3"><?php echo app('translator')->get('common.section'); ?></th>
                                            <?php if($setting->multiple_roll ==1): ?>
                                            <th class="col-3"><?php echo app('translator')->get('student.id_number'); ?></th>
                                            <?php endif; ?>
                                            <th class="col-3"><?php echo app('translator')->get('student.action'); ?></th>
                                        </tr>
                                    </thead>
        
                                    <tbody class="d-block">
                                        <?php $__currentLoopData = $student_detail->studentRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="d-flex">
                                                <td class="col-3"><?php echo e($record->class->class_name); ?> <?php if($record->is_default): ?> <span class="badge badge_1"> <?php echo e(__('common.default')); ?> </span> <?php endif; ?> </td>
                                                <td class="col-3"><?php echo e($record->section->section_name); ?></td>
                                                <?php if($setting->multiple_roll ==1): ?>
                                                <td class="col-3"><?php echo e($record->roll_no); ?></td>
                                                <?php endif; ?>
                                                <td class="col-3">
                                                <a class="primary-btn icon-only fix-gr-bg modalLink" data-modal-size="small-modal"
                                                   title="<?php echo app('translator')->get('student.edit_assign_class'); ?>"
                                                   href="<?php echo e(route('student_assign_edit', [@$record->student_id,@$record->id])); ?>"><span class="ti-pencil"></span></a>
                                                <a href="#" class="primary-btn icon-only fix-gr-bg" data-toggle="modal" data-target="#deleteRecord_<?php echo e($record->id); ?>">
                                                    <span class="ti-trash"></span>
                                                </a>        
                                                   
                                                </td>
                                            </tr>
                                       
                                        
                                   
                                   
                                     
        
                                    <div class="modal fade admin-query" id="deleteRecord_<?php echo e($record->id); ?>" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('common.delete'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
        
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                    </div>
        
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
        
                                                        <form action="<?php echo e(route('student.record.delete')); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="student_id" value="<?php echo e($record->student_id); ?>">
                                                            <input type="hidden" name="record_id" value="<?php echo e($record->id); ?>">
                                                          
                                                            <button type="submit" class="primary-btn fix-gr-bg"><?php echo app('translator')->get('common.delete'); ?></button>
        
                                                        </form>
        
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
                        <!-- End Timeline Tab -->

                        <div role="tabpanel" class="tab-pane fade <?php echo e(Session::get('studentTimeline') == 'active'? 'show active':''); ?>" id="studentTimeline">
                            <div class="white-box">
                                <div class="text-right mb-20">
                                    <button type="button" data-toggle="modal" data-target="#add_timeline_madal"
                                            class="primary-btn tr-bg text-uppercase bord-rad">
                                        <?php echo app('translator')->get('common.add'); ?>
                                        <span class="pl ti-plus"></span>
                                    </button>

                                </div>
                                <?php $__currentLoopData = $timelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="student-activities">
                                        <div class="single-activity">
                                            <h4 class="title text-uppercase">

                                                <?php echo e($timeline->date != ""? dateConvert($timeline->date):''); ?>


                                            </h4>
                                            <div class="sub-activity-box d-flex">
                                                <h6 class="time text-uppercase">10.30 pm</h6>
                                                <div class="sub-activity">
                                                    <h5 class="subtitle text-uppercase"> <?php echo e($timeline->title); ?></h5>
                                                    <p>
                                                        <?php echo e($timeline->description); ?>

                                                    </p>
                                                </div>

                                                <div class="close-activity">

                                                    <a class="primary-btn icon-only fix-gr-bg" data-toggle="modal"
                                                       data-target="#deleteTimelineModal<?php echo e($timeline->id); ?>" href="#">
                                                        <span class="ti-trash text-white"></span>
                                                    </a>

                                                    <?php if(file_exists($timeline->file)): ?>
                                                        <a href="<?php echo e(url($timeline->file)); ?>"
                                                           class="primary-btn tr-bg text-uppercase bord-rad" download>
                                                            <?php echo app('translator')->get('common.download'); ?><span class="pl ti-download"></span>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade admin-query" id="deleteTimelineModal<?php echo e($timeline->id); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->get('common.delete'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?>
                                                            </button>
                                                            <a class="primary-btn fix-gr-bg"
                                                               href="<?php echo e(route('delete_timeline', [$timeline->id])); ?>">
                                                                <?php echo app('translator')->get('common.delete'); ?></a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                            </div>
                        </div>

                 

                    </div>
                </div>
                <!-- End Student Details -->
            </div>


        </div>
    </section>

    <!-- timeline form modal start-->
    <div class="modal fade admin-query" id="add_timeline_madal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo app('translator')->get('student.add_timeline'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_timeline_store',
                                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="student_id" value="<?php echo e($student_detail->id); ?>">
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{" type="text" name="title" value=""
                                                   id="title" maxlength="200">
                                            <label><?php echo app('translator')->get('student.title'); ?> <span>*</span> </label>
                                            <span class="focus-border"></span>

                                            <span class=" text-danger" role="alert" id="amount_error">
                                                
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control" readonly id="startDate" type="text"
                                                   name="date">
                                            <label><?php echo app('translator')->get('common.date'); ?></label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="3" name="description"
                                              id="Description"></textarea>
                                    <label><?php echo app('translator')->get('common.description'); ?><span></span> </label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-40">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input" type="text" id="placeholderFileFourName"
                                                   placeholder="Document"
                                                   disabled>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg"
                                                   for="document_file_4"><?php echo app('translator')->get('common.browse'); ?></label>
                                            <input type="file" class="d-none" name="document_file_4"
                                                   id="document_file_4">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">

                                <input type="checkbox" id="currentAddressCheck" class="common-checkbox"
                                       name="visible_to_student" value="1">
                                <label for="currentAddressCheck"><?php echo app('translator')->get('student.visible_to_this_person'); ?></label>
                            </div>


                            <!-- <div class="col-lg-12 text-center mt-40">
                                <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                    <span class="ti-check"></span>
                                    save information
                                </button>
                            </div> -->
                            <div class="col-lg-12 text-center mt-40">
                                <div class="mt-40 d-flex justify-content-between">
                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>

                                    <button class="primary-btn fix-gr-bg submit" type="submit"><?php echo app('translator')->get('common.save'); ?></button>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- timeline form modal end-->
    <!-- assign class form modal start-->
    <div class="modal fade admin-query" id="assignClass">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo app('translator')->get('student.assign_class'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student.record.store','method' => 'POST'])); ?>

                      
                           
                            <input type="hidden" name="student_id" value="<?php echo e($student_detail->id); ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('session') ? ' is-invalid' : ''); ?>" name="session" id="academic_year">
                                            <option data-display="<?php echo app('translator')->get('common.academic_year'); ?> *" value=""><?php echo app('translator')->get('common.academic_year'); ?> *</option>
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
                            </div>
                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <div class="input-effect sm2_mb_20 md_mb_20" id="class-div">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" name="class" id="classSelectStudent">
                                            <option data-display="<?php echo app('translator')->get('common.class'); ?> *" value=""><?php echo app('translator')->get('common.class'); ?> *</option>
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
                            </div>
                            <div class="row mt-25">    
                                <div class="col-lg-12">
                                    <div class="input-effect sm2_mb_20 md_mb_20" id="sectionStudentDiv">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="section" id="sectionSelectStudent">
                                           <option data-display="<?php echo app('translator')->get('common.section'); ?> *" value=""><?php echo app('translator')->get('common.section'); ?> *</option>
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
                            </div>
                            <?php if(generalSetting()->multiple_roll==1): ?>
                            <div class="row mt-25">
                                <div class="col-lg-12">
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
                            <?php endif; ?>
                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <input type="checkbox" id="is_default" value="1" class="common-checkbox" name="is_default">
                                    <label for="is_default"><?php echo app('translator')->get('student.is_default'); ?></label>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center mt-20">
                                <div class="mt-40 d-flex justify-content-between">
                                    <button type="button" class="primary-btn tr-bg"
                                            data-dismiss="modal"><?php echo app('translator')->get('admin.cancel'); ?></button>
                                    <button class="primary-btn fix-gr-bg submit" id="save_button_query"
                                            type="submit"><?php echo app('translator')->get('admin.save'); ?></button>
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- assign class form modal end-->

<script>
    function deleteDoc(id,doc){
        var modal = $('#delete-doc');
         modal.find('input[name=student_id]').val(id)
         modal.find('input[name=doc_id]').val(doc)
         modal.modal('show');
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/studentInformation/student_view.blade.php ENDPATH**/ ?>