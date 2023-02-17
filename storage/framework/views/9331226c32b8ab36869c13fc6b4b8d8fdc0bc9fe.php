    
    <?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('student.student_profile'); ?>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('mainContent'); ?>
    <?php  $setting = generalSetting();  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?>
    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3 mb-30">
                    <!-- Start Student Meta Information -->
                    <div class="main-title">
                        <h3 class="mb-20"><?php echo app('translator')->get('student.student_profile'); ?></h3>
                    </div>
                    <div class="student-meta-box">
                        <div class="student-meta-top"></div>
                        <img class="student-meta-img img-100" src="<?php echo e(file_exists(@$student_detail->student_photo) ? asset($student_detail->student_photo) : asset('public/uploads/staff/demo/student.jpg')); ?>" alt="">
                        <div class="white-box radius-t-y-0">
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('student.student_name'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e($student_detail->first_name.' '.$student_detail->last_name); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        <?php echo app('translator')->get('student.admission_no'); ?>
                                    </div>
                                    <div class="value">
                                        <?php echo e($student_detail->admission_no); ?>

                                    </div>
                                </div>
                            </div>
                            <?php if(generalSetting()->multiple_roll==0): ?>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            <?php if(moduleStatusCheck('Lead')==true): ?>
                                            <?php echo app('translator')->get('student.id_number'); ?>
                                            <?php else: ?>  
                                            <?php echo app('translator')->get('student.roll_number'); ?>
                                            <?php endif; ?> 
                                        </div>
                                        <div class="value">
                                            <?php echo e($student_detail->roll_no); ?>

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
                                        <?php echo e(@$student_detail->gender !=""?@$student_detail->gender->base_setup_name:""); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- End Student Meta Information -->
                </div>
                <!-- Start Student Details -->
                <div class="col-lg-9">
                    <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#studentProfile" role="tab" data-toggle="tab"><?php echo app('translator')->get('student.profile'); ?></a>
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
                            <a class="nav-link" href="#studentDocuments" role="tab" data-toggle="tab"><?php echo app('translator')->get('student.documents'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#studentTimeline" role="tab" data-toggle="tab"><?php echo app('translator')->get('student.student_record'); ?></a>
                        </li>

                        <?php if(moduleStatusCheck('Wallet')): ?>
                            <?php if(userPermission(1127)): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo e(Session::get('parentWallet') == 'active'? 'active':''); ?> " href="#parentWallet" role="tab" data-toggle="tab"><?php echo app('translator')->get('wallet::wallet.wallet'); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>


                        <li class="nav-item edit-button">
                            <a href="<?php echo e(route('update-my-children',$student_detail->id)); ?>" class="primary-btn small fix-gr-bg pull-right"><?php echo e(__('Update Profile')); ?></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                    <!-- Start Profile Tab -->
                        <div role="tabpanel" class="tab-pane fade  show active" id="studentProfile">
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
                                            <?php echo e(@$student_detail->admission_date != ""? dateConvert(@$student_detail->admission_date):''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('common.date_of_birth'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                              <?php echo e(@$student_detail->date_of_birth != ""? dateConvert(@$student_detail->date_of_birth ):''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('common.type'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e(@$student_detail->category->category_name); ?>

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
                                                <?php if(!empty($student_detail->religion)): ?>
                                                <?php echo e(@$student_detail->religion->base_setup_name); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                <?php echo app('translator')->get('common.phone_number'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                <?php echo e($student_detail->mobile); ?>

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
                                                <?php echo e($student_detail->email); ?>

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
                                               <?php echo e($student_detail->current_address); ?>

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
                                                <?php echo e($student_detail->permanent_address); ?>

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
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->fathers_name); ?>

                                                        <?php endif; ?>
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
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->fathers_occupation); ?>

                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('common.phone_number'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->fathers_mobile); ?>

                                                        <?php endif; ?>
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
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->mothers_name); ?>

                                                        <?php endif; ?>
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
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->mothers_occupation); ?>

                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('common.phone_number'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->mothers_mobile); ?>

                                                        <?php endif; ?>
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
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->guardians_name); ?>

                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('common.email_address'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->guardians_email); ?>

                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="">
                                                        <?php echo app('translator')->get('common.phone_number'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-7">
                                                    <div class="">
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->guardians_mobile); ?>

                                                        <?php endif; ?>
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
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->guardians_relation); ?>

                                                        <?php endif; ?>
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
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->guardians_occupation); ?>

                                                        <?php endif; ?>
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
                                                        <?php if(!empty($student_detail->parents)): ?>
                                                        <?php echo e($student_detail->parents->guardians_address); ?>

                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Parent Part -->
                                <!-- Start Transport Part -->
                                <h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('student.transport_and_dormitory_details'); ?></h4>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('common.route'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->route)? @$student_detail->route->title: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('transport.vehicle_number'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->vechile_id)? $student_detail->vehicle->vehicle_no: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('transport.driver_name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->vechile_id)? $driver->full_name: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('transport.driver_phone_number'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e($student_detail->vechile_id != ""? $driver->mobile: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('dormitory.dormitory_name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e($student_detail->dormitory_id != ""? $student_detail->dormitory->dormitory_name: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Transport Part -->
                                <!-- Start Other Information Part -->
                                <h4 class="stu-sub-head mt-40"><?php echo app('translator')->get('student.other_information'); ?></h4>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.blood_group'); ?>
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
                                                <?php echo app('translator')->get('student.height'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->height)? $student_detail->height: ''); ?>

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
                                                <?php echo e(isset($student_detail->weight)? $student_detail->weight: ''); ?>

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
                                                <?php echo e(isset($student_detail->previous_school_details)? $student_detail->previous_school_details: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.national_identification_number'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->national_id_no)? $student_detail->national_id_no: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('student.local_identification_number'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->local_id_no)? $student_detail->local_id_no: ''); ?>

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
                                                <?php echo e(isset($student_detail->bank_account_no)? $student_detail->bank_account_no: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                <?php echo app('translator')->get('accounts.bank_name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                <?php echo e(isset($student_detail->bank_name)? $student_detail->bank_name: ''); ?>

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
                                                <?php echo e(isset($student_detail->ifsc_code)? $student_detail->ifsc_code: ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                    <?php echo $__env->make('backEnd.customField._coutom_field_show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                
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
                                            <table  class="display school-table school-table-style" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th> <?php echo app('translator')->get('fees.fees_group'); ?></th>
                                                        <th><?php echo app('translator')->get('fees.fees_code'); ?></th>
                                                        <th><?php echo app('translator')->get('fees.due_date'); ?></th>
                                                        <th><?php echo app('translator')->get('common.status'); ?></th>
                                                        <th><?php echo app('translator')->get('fees.amount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                                        <th><?php echo app('translator')->get('fees.payment_id'); ?></th>
                                                        <th><?php echo app('translator')->get('fees.mode'); ?></th>
                                                        <th><?php echo app('translator')->get('common.date'); ?></th>
                                                        <th><?php echo app('translator')->get('fees.discount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                                        <th><?php echo app('translator')->get('fees.fine'); ?>(<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                                        <th><?php echo app('translator')->get('fees.paid'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                                        <th><?php echo app('translator')->get('fees.balance'); ?></th>
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
                                                    <?php $__currentLoopData = $fees_assigneds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_assigned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                            <?php 
                                                                echo @$balance_amount;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                        <?php 
                                                            @$payments = App\SmFeesAssign::feesPayment(@$fees_assigned->feesGroupMaster->feesTypes->id, @$fees_assigned->student_id, $fees_assigned->recordDetail->id);
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
                                                            <td>
                                                                <?php echo e($payment->payment_mode); ?>

                                                            </td>
                                                            <td class="nowrap">                                                                                
                                                            <?php echo e(@$payment->payment_date != ""? dateConvert(@$payment->payment_date):''); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(@$payment->discount_amount); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(@$payment->fine); ?>

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
                                                            <td>
                                                                <?php echo e(@$payment->amount); ?>

                                                            </td>
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
                                                        <th><?php echo app('translator')->get('fees.grand_total'); ?> (<?php echo e(@generalSetting()->currency_symbol); ?>)</th>
                                                        <th></th>
                                                        <th><?php echo e(@$grand_total); ?></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th><?php echo e(@$total_discount); ?></th>
                                                        <th><?php echo e(@$total_fine); ?></th>
                                                        <th><?php echo e(@$total_grand_paid); ?></th>
                                                        <th><?php echo e(number_format($total_balance, 2, '.', '')); ?> </th>
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
                                    <div class="row mt-30">
                                        <div class="col-lg-12">
                                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('leave.leave_type'); ?></th>
                                                        <th><?php echo app('translator')->get('leave.leave_from'); ?> </th>
                                                        <th><?php echo app('translator')->get('leave.leave_to'); ?></th>
                                                        <th><?php echo app('translator')->get('leave.apply_date'); ?></th>
                                                        <th><?php echo app('translator')->get('common.status'); ?></th>
                                                        <th><?php echo app('translator')->get('common.action'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $diff = ''; ?>
                                                <?php if(count($leave_details)>0): ?>
                                                <?php $__currentLoopData = $leave_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(@$value->leaveType->type); ?></td>
                                                    <td>

                            <?php echo e($value->leave_from != ""? dateConvert($value->leave_from):''); ?>


                                                    </td>
                                                    <td>

                            <?php echo e($value->leave_to != ""? dateConvert($value->leave_to):''); ?>


                                                    </td>
                                                    <td>

                            <?php echo e($value->apply_date != ""? dateConvert($value->apply_date):''); ?>


                                                    </td>
                                                    <td>

                                                        <?php if($value->approve_status == 'P'): ?>
                                                        <button class="primary-btn small bg-warning text-white border-0"> <?php echo app('translator')->get('common.pending'); ?></button>
                                                        <?php endif; ?>

                                                        <?php if($value->approve_status == 'A'): ?>
                                                        <button class="primary-btn small bg-success text-white border-0"> <?php echo app('translator')->get('common.approved'); ?></button>
                                                        <?php endif; ?>

                                                        <?php if($value->approve_status == 'C'): ?>
                                                        <button class="primary-btn small bg-danger text-white border-0"> <?php echo app('translator')->get('common.cancelled'); ?></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <a class="modalLink" data-modal-size="modal-md" title="<?php echo app('translator')->get('common.view_leave_details'); ?>" href="<?php echo e(url('view-leave-details-apply', $value->id)); ?>"><button class="primary-btn small tr-bg"> <?php echo app('translator')->get('common.view'); ?> </button></a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php echo app('translator')->get('leave.not_leaves_data'); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- End leave Tab -->

                        <!-- Start Exam Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="studentExam">
                            <?php $__currentLoopData = $student_detail->studentRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $today = date('Y-m-d H:i:s');
                                $exam_count= count($exam_terms);
                            ?>
                            <?php if($exam_count > 1): ?>
                            <div class="white-box no-search no-paginate no-table-info mb-2">
                               <table class="display school-table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo app('translator')->get('common.subject'); ?>
                                            </th>
                                            <th>
                                                <?php echo app('translator')->get('exam.full_marks'); ?>
                                            </th>
                                            <th>
                                                <?php echo app('translator')->get('exam.passing_marks'); ?>
                                            </th>
                                            <th>
                                                <?php echo app('translator')->get('exam.obtained_marks'); ?>
                                            </th>
                                            <th>
                                                <?php echo app('translator')->get('exam.results'); ?>
                                            </th>
                                        </tr>
                                    </thead>
                               </table>
                            </div>
                            <?php endif; ?>
                            <div class="white-box no-search no-paginate no-table-info mb-2">
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
                                <?php if(isset($exam->examSettings->publish_date)): ?>
                                    <?php if($exam->examSettings->publish_date <=  $today): ?>
                                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('common.date'); ?></th>
                                                    <th>
                                                        <?php echo app('translator')->get('exam.subject_full_marks'); ?>)
                                                    </th>
                                                    <th>
                                                        <?php echo app('translator')->get('exam.obtained_marks'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo app('translator')->get('exam.grade'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo app('translator')->get('exam.gpa'); ?>
                                                    </th>
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
                                                        if (@$record->optionalSubject!='') {
                                                            if (@$record->optionalSubject->subject_id == $mark->subject->id) {
                                                                $optional_subject = 1;
                                                            if ($mark->total_gpa_point > @$record->optionalSubjectSetup->gpa_above) {
                                                                    $optional_gpa = @$record->optionalSubjectSetup->gpa_above;
                                                                echo "GPA Above ".@$record->optionalSubjectSetup->gpa_above;
                                                                echo "<hr>";
                                                                echo $mark->total_gpa_point  - @$record->optionalSubjectSetup->gpa_above;
                                                                } else {
                                                                    echo "GPA Above ".@$record->optionalSubjectSetup->gpa_above;
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
                                                        if(in_array($failgpaname->grade_name,$temp_grade)){
                                                            echo $failgpaname->grade_name;
                                                            }else {
                                                                $final_gpa_point = ($total_gpa_point + @$onlyOptional - @$record->optionalSubjectSetup->gpa_above)/  ($total_subject - $optional_subject);
                                                                $average_grade=0;
                                                                $average_grade_max=0;
                                                                if($result == 0 && $grand_total_marks != 0){
                                                                    $gpa_point=number_format($final_gpa_point, 2, '.', '');
                                                                    if($gpa_point >= $maxgpa){
                                                                        $average_grade_max = App\SmMarksGrade::where('school_id',Auth::user()->school_id)
                                                                        ->where('academic_id', getAcademicId() )
                                                                        ->where('from', '<=', $maxgpa )
                                                                        ->where('up', '>=', $maxgpa )
                                                                        ->first('grade_name');

                                                                        echo  @$average_grade_max->grade_name;
                                                                    } else {
                                                                        $average_grade = App\SmMarksGrade::where('school_id',Auth::user()->school_id)
                                                                        ->where('academic_id', getAcademicId() )
                                                                        ->where('from', '<=', $final_gpa_point )
                                                                        ->where('up', '>=', $final_gpa_point )
                                                                        ->first('grade_name');
                                                                        echo  @$average_grade->grade_name;
                                                                    }
                                                            }else{
                                                                echo $failgpaname->grade_name;
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
                                                                if($float_final_gpa_point_add >= $maxgpa){
                                                                    echo $maxgpa;
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
                                                            if($float_final_gpa_point >= $maxgpa){
                                                                echo number_format($maxgpa,2);
                                                            }else {
                                                                echo number_format($float_final_gpa_point,2);
                                                            }
                                                        ?>
                                                    </th>
                                                </tr>
                                                </tfoot>
                                        </table>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- End Exam Tab -->

                            <!-- Start Documents Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="studentDocuments">
                            <div class="white-box">
                                <table id="" class="table simple-table table-responsive school-table"
                                    cellspacing="0">
                                    <thead class="d-block">
                                        <tr class="d-flex">
                                            <th class="col-3"><?php echo app('translator')->get('student.document_title'); ?></th>
                                            <th class="col-6"><?php echo app('translator')->get('common.name'); ?></th>
                                            <th class="col-3"><?php echo app('translator')->get('common.action'); ?></th>
                                        </tr>
                                    </thead>

                                    <tbody class="d-block">
                                        <?php if($student_detail->document_file_1 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-3"><?php echo e($student_detail->document_title_1); ?> </td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_1)); ?></td>
                                            <td class="col-3 d-flex align-items-center">
                                                
                                                    <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                        <a href="<?php echo e(asset($student_detail->document_file_1)); ?>" download><?php echo app('translator')->get('common.download'); ?></a>
                                                        <span class="pl ti-download"></span>
                                                    </button>
                                                
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php if($student_detail->document_file_2 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-3"><?php echo e($student_detail->document_title_2); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_2)); ?></td>
                                            <td class="col-3 d-flex align-items-center">
                                                
                                                    <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                        <a href="<?php echo e(asset($student_detail->document_file_2)); ?>" download><?php echo app('translator')->get('common.download'); ?></a>
                                                        <span class="pl ti-download"></span>
                                                    </button>
                                                
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php if($student_detail->document_file_3 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-3"><?php echo e($student_detail->document_title_3); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_3)); ?></td>
                                            <td class="col-3 d-flex align-items-center">
                                                
                                                    <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                        <a href="<?php echo e(asset($student_detail->document_file_3)); ?>" download><?php echo app('translator')->get('common.download'); ?></a>
                                                        <span class="pl ti-download"></span>
                                                    </button>
                                                
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php if($student_detail->document_file_4 != ""): ?>
                                        <tr class="d-flex">
                                            <td class="col-3"><?php echo e($student_detail->document_title_4); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$student_detail->document_file_4)); ?></td>
                                            <td class="col-3 d-flex align-items-center">
                                                
                                                    <button class="primary-btn tr-bg text-uppercase bord-rad mr-1">
                                                        <a href="<?php echo e(asset($student_detail->document_file_4)); ?>" download><?php echo app('translator')->get('common.download'); ?></a>
                                                        <span class="pl ti-download"></span>
                                                    </button>
                                                
                                            </td>
                                        </tr>
                                        <?php endif; ?>

                                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="d-flex">
                                            <td class="col-3"><?php echo e(@$document->title); ?></td>
                                            <td class="col-6"><?php echo e(showDocument(@$document->file)); ?></td>
                                            <td class="col-3">
                                                
                                                    <a class="primary-btn tr-bg text-uppercase bord-rad" href="<?php echo e(url(@$document->file)); ?>" download>
                                                        <?php echo app('translator')->get('common.download'); ?><span class="pl ti-download"></span>
                                                    </a>
                                                
                                            </td>
                                        </tr>
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
                                        <h4 class="modal-title"><?php echo app('translator')->get('student.upload_documents'); ?></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                       <div class="container-fluid">
                                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'upload_document',
                                                                'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="student_id" value="<?php echo e($student_detail->id); ?>">
                                                        <div class="row mt-25">
                                                            <div class="col-lg-12">
                                                                <div class="input-effect">
                                                                    <input class="primary-input form-control{" type="text" name="title" value="" id="title">
                                                                    <label><?php echo app('translator')->get('common.title'); ?> <span>*</span> </label>
                                                                    <span class="focus-border"></span>

                                                                    <span class=" text-danger" role="alert" id="amount_error">

                                                                    </span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mt-30">
                                                        <div class="row no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="input-effect">
                                                                    <input class="primary-input" type="text" id="placeholderPhoto" placeholder="Document"
                                                                        disabled>
                                                                    <span class="focus-border"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <button class="primary-btn-small-input" type="button">
                                                                    <label class="primary-btn small fix-gr-bg" for="photo"><?php echo app('translator')->get('common.browse'); ?></label>
                                                                    <input type="file" class="d-none" name="photo" id="photo">
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
                        <!-- Add Document modal form end-->
                        <!-- delete document modal -->

                        <!-- delete document modal -->
                        <!-- Start Timeline Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="studentTimeline">
                            <div class="white-box">
                                
                                <table id="" class="table simple-table table-responsive school-table"
                                       cellspacing="0">
                                    <thead class="d-block">
                                        <tr class="d-flex">
                                            <th class="col-4"><?php echo app('translator')->get('common.class'); ?></th>
                                            <th class="col-4"><?php echo app('translator')->get('common.section'); ?></th>
                                            <th class="col-4"><?php echo app('translator')->get('student.id_number'); ?></th>
                                        </tr>
                                    </thead>
        
                                    <tbody class="d-block">
                                        <?php $__currentLoopData = $student_detail->studentRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="d-flex">
                                                <td class="col-4"><?php echo e($record->class->class_name); ?></td>
                                                <td class="col-4"><?php echo e($record->section->section_name); ?></td>
                                                <td class="col-4"><?php echo e($record->roll_no); ?></td>                                                
                                            </tr>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Timeline Tab -->

                        <?php if(moduleStatusCheck('Wallet')): ?>
                        <div role="tabpanel" class="tab-pane fade" id="parentWallet">
                            <div class="white-box">
                                <?php echo $__env->make('wallet::_addWallet',compact('walletAmounts', 'bankAccounts', 'paymentMethods'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

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
                                                <input class="primary-input form-control{" type="text" name="title" value="" id="title">
                                                <label><?php echo app('translator')->get('common.title'); ?> <span>*</span> </label>
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
                                                <input class="primary-input date form-control" id="startDate" type="text"
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
                                        <textarea class="primary-input form-control" cols="0" rows="3" name="description" id="Description"></textarea>
                                        <label><?php echo app('translator')->get('common.description'); ?><span></span> </label>
                                        <span class="focus-border textarea"></span>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-30">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input" type="text" id="placeholderFileFourName" placeholder="Document"
                                                    disabled>
                                                <span class="focus-border"></span>
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
                                <div class="col-lg-12 mt-30">

                                    <input type="checkbox" id="currentAddressCheck" class="common-checkbox" name="visible_to_student" value="1">
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




    <?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/parentPanel/my_children.blade.php ENDPATH**/ ?>