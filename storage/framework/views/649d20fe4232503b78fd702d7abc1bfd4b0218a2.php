<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('reports.student_login_info'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<input type="text" hidden value="<?php echo e(@$clas->class_name); ?>" id="cls">
<input type="text" hidden value="<?php echo e(@$clas->section_name->sectionName->section_name); ?>" id="sec">
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('reports.student_login_info'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('reports.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('reports.student_login_info'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('common.select_criteria'); ?> </h3>
                    </div>
                </div>
            </div>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_login_search', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

            <div class="row">
                <div class="col-lg-12">
                <div class="white-box">
                    <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-6 mt-30-md col-md-6">
                                    <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->get('common.select_class'); ?> *" value=""><?php echo app('translator')->get('common.select_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>"  <?php echo e(isset($class_id)? ($class->id == $class_id? 'selected':''): ''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 mt-30-md col-md-6" id="select_section_div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('reports.select_current_section'); ?>" value=""><?php echo app('translator')->get('reports.select_current_section'); ?></option>
                                        <?php if(isset($class_id)): ?>
                                        <?php $__currentLoopData = $class->classSection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($section->sectionName->id); ?>" <?php echo e(old('section')==$section->sectionName->id ? 'selected' : ''); ?> >
                                            <?php echo e($section->sectionName->section_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php endif; ?>
                                    </select>
                                    <div class="pull-right loader loader_style" id="select_section_loader">
                                        <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->get('common.search'); ?>
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <?php echo e(Form::close()); ?>

            <?php if(isset($students)): ?>
            <div class="row mt-40"> 
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('reports.manage_login'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id_s" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                   
                                    <tr>
                                        <th><?php echo app('translator')->get('common.sl'); ?></th>
                                        <th><?php echo app('translator')->get('student.admission_no'); ?></th>
                                        <th><?php echo app('translator')->get('student.student_name'); ?></th>
                                        <th><?php echo app('translator')->get('reports.email_&_password'); ?></</th>                                       
                                        <th><?php echo app('translator')->get('reports.parent_email_&_password'); ?> </th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $count=1;
                                    ?>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($count++); ?></td>
                                        <td><?php echo e($student->admission_no); ?></td>
                                        <td><?php echo e($student->first_name.' '.$student->last_name); ?></td>
                                        <td><?php echo e($student->user !=""?$student->user->email:""); ?>

                                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'reset-student-password', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                            <input type="hidden" name="id" value="<?php echo e($student->user_id); ?>">
                                            <div class="row mt-10">
                                                <div class="col-lg-6">
                                                    <div class="input-effect md_mb_20">
                                                        <input class="primary-input read-only-input"  type="text" name="new_password" required="true" minlength="6">
                                                        <label><?php echo app('translator')->get('reports.reset_password'); ?></label>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6">

                                                    <?php if(userPermission(380)): ?>

                                                   
                                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                                       
                                                        <?php echo app('translator')->get('reports.update'); ?>
                                                    </button>
                                               <?php endif; ?>
                                                </div>
                                            </div>
                                             <?php echo e(Form::close()); ?>

                                        </td>

                                        <td><?php echo e($student->parents->parent_user->email); ?>

                                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'reset-student-password', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                            <input type="hidden" name="id" value="<?php echo e(@$student->parents->parent_user->id); ?>">
                                            <div class="row mt-10">
                                                <div class="col-lg-6">
                                                    <div class="input-effect md_mb_20">
                                                        <input class="primary-input read-only-input" type="text" name="new_password" required="true" minlength="6">
                                                        <label><?php echo app('translator')->get('reports.reset_password'); ?></label>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                                        
                                                        <?php echo app('translator')->get('common.update'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                             <?php echo e(Form::close()); ?>

                                        </td>
                                    </tr>
                                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/studentInformation/login_info.blade.php ENDPATH**/ ?>