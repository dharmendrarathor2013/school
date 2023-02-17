<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('transport.transport'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('transport.transport'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="<?php echo e(route('student_subject')); ?>"><?php echo app('translator')->get('transport.transport'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
       
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->get('transport.transport_route_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 mb-30">
                                <!-- Start Student Meta Information -->
                                <div class="student-meta-box">
                                    <div class="student-meta-top"></div>
                                    <img class="student-meta-img img-100" src="<?php echo e(file_exists($student_detail->student_photo) ? asset($student_detail->student_photo) : asset('public/uploads/staff/demo/staff.jpg')); ?>" alt="">
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
                                                    <?php echo e($student_detail->gender !=""?$student_detail->gender->base_setup_name:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Student Meta Information -->
                
                            </div>
                    <div class="col-lg-9">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('transport.route'); ?></th>
                                    <th><?php echo app('translator')->get('transport.vehicle'); ?></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td valign="top"><?php echo e(@$route->route->title); ?></td>
                                    <td>
                                        <table>
                                            <?php
                                              @$vehicles = explode(",",@$route->vehicle_id);
                                            ?>
                                            <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php @$vehicle = App\SmVehicle::find(@$vehicle);
                                                    ?>
                                                    <?php echo e(@$vehicle->vehicle_no); ?>



                                                </td>
                                                <td >
                                                    <div class="col-sm-6">
                                                        
                                                    <?php if(@$student_detail->route_list_id == @$route->route->id && @$student_detail->vechile_id == @$vehicle->id): ?>
                                                        <a href="javascript:void(0)" class="primary-btn small fix-gr-bg">Assigned</a> 
                                                    <?php endif; ?>
                                                    </div>
                                                     
                                                    <div class="col-sm-6">
                                                         
                                                         <a class="primary-btn small fix-gr-bg modalLink" title="Transport Details" data-modal-size="modal" href="<?php echo e(route('student_transport_view_modal', [@$route->route->id, @$vehicle->id])); ?>"><?php echo app('translator')->get('common.view'); ?></a>
                                                   
                                                    </div>
                                                    

                                                </td>

                                                
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </table>
                                    </td> 
                                </tr>
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
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/studentPanel/student_transport.blade.php ENDPATH**/ ?>