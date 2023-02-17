<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('reports.student_report'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<input type="text" hidden value="<?php echo e(@$clas->class_name); ?>" id="cls">
<input type="text" hidden value="<?php echo e(@$clas->section_name->sectionName->section_name); ?>" id="sec">
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('reports.student_report'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('reports.reports'); ?></a>
                <a href="#"><?php echo app('translator')->get('reports.student_report'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30" ><?php echo app('translator')->get('common.select_criteria'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 niceSelect bb form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->get('common.select_class'); ?> *" value=""><?php echo app('translator')->get('common.select_class'); ?></option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>"  <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3 mt-30-md" id="select_section_div">
                                    <select class="w-100 niceSelect bb form-control<?php echo e($errors->has('current_section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('common.select_section'); ?>" value=""><?php echo app('translator')->get('common.select_section'); ?></option>
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
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 niceSelect bb form-control<?php echo e($errors->has('current_section') ? ' is-invalid' : ''); ?>" name="type">
                                        <option data-display="<?php echo app('translator')->get('reports.select_type'); ?>" value=""><?php echo app('translator')->get('reports.select_type'); ?></option>
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>" <?php echo e(isset($type_id)? ($type_id == $type->id? 'selected':''):''); ?>><?php echo e($type->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 niceSelect bb form-control<?php echo e($errors->has('gender') ? ' is-invalid' : ''); ?>" name="gender">
                                        <option data-display="<?php echo app('translator')->get('reports.select_gender'); ?>" value=""><?php echo app('translator')->get('reports.select_gender'); ?></option>
                                        <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($gender->id); ?>" <?php echo e(isset($gender_id)? ($gender_id == $gender->id? 'selected':''):''); ?>><?php echo e($gender->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->get('common.search'); ?>
                                    </button>
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
            
<?php if(isset($students)): ?>

 <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('reports.student_report'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="d-flex justify-content-between mb-20"> -->
                        <!-- <button type="submit" class="primary-btn fix-gr-bg mr-20" onclick="javascript: form.action='<?php echo e(url('student-attendance-holiday')); ?>'">
                            <span class="ti-hand-point-right pr"></span>
                            mark as holiday
                        </button> -->

                        
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12 ">
                           
                            <table id="table_ids" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <?php if(session()->has('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="9">
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th><?php echo app('translator')->get('common.class'); ?></th>
                                        <th><?php echo app('translator')->get('common.section'); ?></th>
                                        <th><?php echo app('translator')->get('student.admission_no'); ?></th>
                                        <th><?php echo app('translator')->get('common.name'); ?></th>
                                        <th><?php echo app('translator')->get('student.father_name'); ?></th>
                                        <th><?php echo app('translator')->get('common.date_of_birth'); ?></th>
                                        <th><?php echo app('translator')->get('common.gender'); ?></th>
                                        <th><?php echo app('translator')->get('common.type'); ?></th>
                                        <th><?php echo app('translator')->get('common.phone'); ?></th>
                                        <th><?php echo app('translator')->get('reports.nid_no'); ?></th>
                                        <th><?php echo app('translator')->get('reports.Birth_Certificate_Number'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php if(!empty($student->recordClass)){ echo $student->recordClass->class->class_name; }else { echo ''; } ?></td>
                                        <td>
                                            <?php if($section_id==null): ?>
                                            
                                                    
                                                (<?php $__currentLoopData = $student->recordClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($section->section->section_name); ?>,
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>)                                    
                                            <?php else: ?>
                                            <?php echo e($student->recordSection != ""? $student->recordSection->section->section_name:""); ?>

                                            <?php endif; ?>
                                        
                                        </td>
                                        <td><?php echo e($student->admission_no); ?></td>
                                        <td><?php echo e($student->first_name.' '.$student->last_name); ?></td>
                                        <td><?php echo e($student->parents !=""?$student->parents->fathers_name:""); ?></td>
                                        <td><?php echo e($student->date_of_birth != ""? dateConvert($student->date_of_birth):''); ?></td>
                                        <td><?php echo e($student->gender != ""? $student->gender->base_setup_name:""); ?></td>
                                        <td><?php echo e($student->category != ""? $student->category->category_name:""); ?></td>
                                        <td><?php echo e($student->mobile); ?></td>
                                        <td><?php echo e($student->national_id_no); ?></td>
                                        <td><?php echo e($student->local_id_no); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>

<?php endif; ?>

    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/studentInformation/student_report.blade.php ENDPATH**/ ?>