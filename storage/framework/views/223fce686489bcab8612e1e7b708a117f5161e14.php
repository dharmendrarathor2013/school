    <?php $__env->startSection('title'); ?>
        <?php echo app('translator')->get('reports.tabulation_sheet_report'); ?>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <?php $__env->startPush('css'); ?>
        <style type="text/css">
            .table tbody td {
                padding: 5px;
                text-align: center;
                vertical-align: middle;
            }

            .table head th {
                padding: 5px;
                text-align: center;
                vertical-align: middle;
            }

            .table head tr th {
                padding: 5px;
                text-align: center;
                vertical-align: middle;
            }

            th, td {
                white-space: nowrap;
                text-align: center !important;
            }

            th.subject-list {
                white-space: inherit;
            }

            #main-content {
                width: auto !important;
            }

            .main-wrapper {
                display: inherit;
            }

            .table thead th {
                padding: 5px;
                vertical-align: middle;
            }

            .student_name, .subject-list {
                line-height: 12px;
            }

            .student_name b {
                min-width: 20%;
            }

            .gradeChart tbody td{
                padding: 0px;
                padding-left: 5px;
            }
            
            hr{
                margin: 0px;
            }

            .name_field{
                width: 200px;
            }

            .roll_field{
                width: 80px;
            }

            .large_spanTh{
                width: 500px;
            }

            .scrolled_table th,
            .scrolled_table td{
                padding: 6px 25px !important;
            }

            #grade_table th {
                border: 1px solid #dee2e6;
                border-top-style: solid;
                border-top-width: 1px;
                text-align: left;
                background: #351681;
                color: white;
                background: #f2f2f2;
                color: #415094;
                font-size: 12px;
                font-weight: 500;
                text-transform: uppercase;
                border-top: 0px;
                padding: 5px 4px;
                background: transparent;
                border-bottom: 1px solid rgba(130, 139, 178, 0.15) !important;
            }

            #grade_table td {
                color: #828bb2;
                padding: 0 7px;
                font-weight: 400;
                background-color: transparent;
                border-right: 0;
                border-left: 0;
                text-align: left !important;
                border-bottom: 1px solid rgba(130, 139, 178, 0.15) !important;
            }

            .single-report-admit table tr th {
                border: 0;
                border-bottom: 1px solid rgba(67, 89, 187, 0.15) !important;
                text-align: left
            }

            .single-report-admit table thead tr th {
                border: 0 !important;
            }

            .single-report-admit table tbody tr:first-of-type td {
                border-top: 1px solid rgba(67, 89, 187, 0.15) !important;
            }

            .single-report-admit table tr td {
                vertical-align: middle;
                font-size: 12px;
                color: #828BB2;
                font-weight: 400;
                border: 0;
                border-bottom: 1px solid rgba(130, 139, 178, 0.15) !important;
                text-align: left;
                background: #fff !important;
            }

            .single-report-admit table.summeryTable tbody tr:first-of-type td,
            .single-report-admit table.comment_table tbody tr:first-of-type td {
                border-top:0 !important;
            }

            .student_marks_table{
                width: 100%;
                margin: 0px auto 0 auto;
                padding-left: 10px;
                padding-right: 5px;
                padding: 30px;
            }

            thead{
                font-weight:bold;
                text-align:left;
                color: #415094;
                font-size: 10px;
            }

            .student_info li p{
                font-size: 14px;
                font-weight: 500;
                color: #828bb2;
            }

            .student_info li p.bold_text{
                font-weight: 600;
                color: #415094;
            }

            ul.student_info li {
                display: flex;
            }

            ul.student_info {
                padding: 0;
            }

            ul.student_info li p:first-child {
                flex: 55px 0 0;
            }
            ul.student_info.info2 li p:first-child {
                flex: 100px 0 0;
            }
        </style>
    <?php $__env->stopPush(); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('reports.tabulation_sheet_report'); ?> </h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('reports.reports'); ?></a>
                    <a href="<?php echo e(route('tabulation_sheet_report')); ?>"><?php echo app('translator')->get('reports.tabulation_sheet_report'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('common.select_criteria'); ?> </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'tabulation_sheet_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                    <div class="row">
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="col-lg-3 mt-30-md md_mb_20">
                            <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('exam') ? ' is-invalid' : ''); ?>" name="exam">
                                <option data-display="<?php echo app('translator')->get('exam.select_exam'); ?>*" value=""><?php echo app('translator')->get('exam.select_exam'); ?>*</option>
                                <?php $__currentLoopData = $exam_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($exam->id); ?>" <?php echo e(isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''); ?>><?php echo e($exam->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('exam')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('exam')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-3 mt-30-md md_mb_20">
                            <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                <option data-display="<?php echo app('translator')->get('common.select_class'); ?> *" value=""><?php echo app('translator')->get('common.select_class'); ?>*</option>
                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('class')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('class')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-3 mt-30-md md_mb_20" id="select_section_div">
                            <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                <option data-display="<?php echo app('translator')->get('common.select_section'); ?> *" value=""><?php echo app('translator')->get('common.select_section'); ?> *</option>
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
                        <div class="col-lg-3 mt-30-md md_mb_20" id="select_student_div">
                            <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                                <option data-display="<?php echo app('translator')->get('common.select_student'); ?>" value=""><?php echo app('translator')->get('common.select_student'); ?></option>
                            </select>
                            <div class="pull-right loader loader_style" id="select_student_loader">
                                <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                            </div>
                            <?php if($errors->has('student')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('student')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-12 mt-20 text-right">
                            <button type="submit" class="primary-btn small fix-gr-bg">
                                <span class="ti-search"></span>
                                <?php echo app('translator')->get('common.search'); ?>
                            </button>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </section>
    <?php if(isset($marks)): ?>
        <?php if(isset($single)): ?>
            <section class="student-details mt-20">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-30 mt-30"> 
                                    <?php echo app('translator')->get('reports.tabulation_sheet_report'); ?>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-8 pull-right mt-20">
                            <div class="print_button pull-right">
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'tabulation-sheet/print', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student', 'target' => '_blank'])); ?>

                                <input type="hidden" name="exam_term_id" value="<?php echo e($exam_term_id); ?>">
                                <input type="hidden" name="class_id" value="<?php echo e($class_id); ?>">
                                <input type="hidden" name="section_id" value="<?php echo e($section_id); ?>">
                                <?php if(!empty($student_id)): ?>
                                    <input type="hidden" name="student_id" value="<?php echo e($student_id); ?>">
                                <?php endif; ?>
                                <button type="submit" class="primary-btn small fix-gr-bg"><i class="ti-printer"> </i> <?php echo app('translator')->get('common.print'); ?></button>
                            <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="single-report-admit">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
                                            <img class="logo-img" src="<?php echo e(generalSetting()->logo); ?>" alt="<?php echo e(generalSetting()->school_name); ?>">
                                        </div>
                                        <div class=" col-lg-8 text-left text-lg-right mt-30-md">
                                            <h3 class="text-white"> <?php echo e(isset(generalSetting()->school_name)?generalSetting()->school_name:'Infix School Management ERP'); ?> </h3>
                                            <p class="text-white mb-0"> <?php echo e(isset(generalSetting()->address)?generalSetting()->address:'Infix School Adress'); ?> </p>
                                            <p class="text-white mb-0"> <?php echo app('translator')->get('common.email'); ?>: <?php echo e(isset(generalSetting()->email)?generalSetting()->email:'admin@demo.com'); ?> , <?php echo app('translator')->get('common.phone'); ?>: <?php echo e(isset(generalSetting()->phone)?generalSetting()->phone:'+8801841412141'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="exam_title text-center text-uppercase"> <?php echo app('translator')->get('reports.tabulation_sheet_of'); ?> <?php echo e($tabulation_details['exam_term']); ?> <?php echo app('translator')->get('reports.in'); ?> <?php echo e($year); ?></h4>
                                        <hr>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <ul class="student_info">
                                                    <li>
                                                        <p> <?php echo app('translator')->get('common.name'); ?></p>  
                                                        <p class="bold_text">: <?php echo e($tabulation_details['student_name']); ?></p>
                                                    </li>
                                                    <li>
                                                        <p><?php echo app('translator')->get('common.search'); ?></p>
                                                        <p class="bold_text">: <?php echo e($tabulation_details['student_class']); ?></p>
                                                    </li>
                                                    <li>
                                                        <p><?php echo app('translator')->get('common.section'); ?></p>
                                                        <p class="bold_text">: <?php echo e($tabulation_details['student_section']); ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3">
                                                <ul class="student_info info2">
                                                    <li>
                                                        <p><?php echo app('translator')->get('student.roll_no'); ?></p>
                                                        <p class="bold_text">: <?php echo e($tabulation_details['student_roll']); ?></p>
                                                    </li>
                                                    <li>
                                                        <p><?php echo app('translator')->get('student.admission_no'); ?></p>
                                                        <p class="bold_text">: <?php echo e($tabulation_details['student_admission_no']); ?></p>
                                                    </li>
                                                    <li>
                                                        <p><?php echo app('translator')->get('exam.exam'); ?></p> 
                                                        <p class="bold_text">: <?php echo e($tabulation_details['exam_term']); ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-report-admit">
                                    <div class="student_marks_table pt-0 mt-0">
                                        <div class="table-responsive">
                                            <table class="mt-0 mb-20 table table-striped table-bordered scrolled_table">
                                                <thead>
                                                    <tr>
                                                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $subject_ID    = $subject->subject_id;
                                                                $subject_Name   = $subject->subject->subject_name;
                                                                $mark_parts      = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                                                            ?>
                                                            <th colspan="<?php echo e(count($mark_parts)+1); ?>" class="subject-list large_spanTh"><?php echo e($subject_Name); ?></th>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <th rowspan="2" class="large_spanTh"><?php echo app('translator')->get('exam.total_mark'); ?></th>
                                                        <?php if($optional_subject_setup!=''): ?>
                                                            <th class="large_spanTh"><?php echo app('translator')->get('exam.gpa'); ?></th>
                                                            <th rowspan="2" class="large_spanTh"><?php echo app('translator')->get('exam.gpa'); ?></th>
                                                            <th rowspan="2" class="large_spanTh"><?php echo app('translator')->get('reports.result'); ?></th>
                                                        <?php else: ?>
                                                            <th rowspan="2" class="large_spanTh"><?php echo app('translator')->get('exam.gpa'); ?></th>
                                                            <th rowspan="2" class="large_spanTh"><?php echo app('translator')->get('reports.result'); ?></th>
                                                        <?php endif; ?>
                                                    </tr>
                                                    <tr>
                                                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $subject_ID     = $subject->subject_id;
                                                                $subject_Name   = $subject->subject->subject_name;
                                                                $mark_parts     = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                                                            ?>
                                                        <?php $__currentLoopData = $mark_parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sigle_part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <th class="large_padding"><?php echo e($sigle_part->exam_title); ?> (<?php echo e($sigle_part->exam_mark); ?>)</th>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <th class="large_padding"><?php echo app('translator')->get('exam.result'); ?></th>
                                                            
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($optional_subject_setup!=''): ?>
                                                            <th class="large_padding"><small><?php echo app('translator')->get('reports.without_additional'); ?></small></th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
                                                        $count=1;  
                                                    ?>
                                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php 
                                                            $this_student_failed=0; 
                                                            $tota_grade_point= 0; 
                                                            $tota_grade_point_main= 0; 
                                                            $marks_by_students = 0;
                                                            $gpa_without_optional_count=0;  
                                                            $main_subject_total_gpa =0;  
                                                            $Optional_subject_count=0;  
                                                            $optional_subject_gpa=0;  
                                                            $opt_sub_gpa=0;
                                                            $optional_subject=App\SmOptionalSubjectAssign::where('student_id','=',$student->id)
                                                                            ->where('session_id','=',$student->session_id)
                                                                            ->first();
                                                        ?>
                                                        <tr>
                                                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $subject_ID     = $subject->subject_id;
                                                                    $subject_Name   = $subject->subject->subject_name;
                                                                    $mark_parts     = App\SmAssignSubject::getMarksOfPart($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);
                                                                    $subject_count= 0;
                                                                    $optional_subject_marks=DB::table('sm_optional_subject_assigns')
                                                                        ->join('sm_mark_stores','sm_mark_stores.subject_id','=','sm_optional_subject_assigns.subject_id')
                                                                        ->where('sm_optional_subject_assigns.student_id','=',$student->id)
                                                                        ->first();
                                                                ?>
                                                            <?php $__currentLoopData = $mark_parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sigle_part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <td class="total"><?php echo e($sigle_part->total_marks); ?></td>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <td class="total">
                                                                <?php
                                                                    $tola_mark_by_subject = App\SmAssignSubject::getSumMark($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);
                                                                    $marks_by_students  = $marks_by_students + $tola_mark_by_subject;
                                                                ?>
                                                                <?php echo e($tola_mark_by_subject); ?>

                                                            </td>
                                                                <?php
                                                                    $value=subjectFullMark($exam_term_id, $subject_ID);
                                                                    $persentage=subjectPercentageMark($tola_mark_by_subject,$value);
                                                                    $mark_grade = markGpa($persentage);

                                                                        $mark_grade_gpa=0;
                                                                        $optional_setup_gpa=0;
                                                                        if (@$optional_subject->subject_id==$subject_ID) {
                                                                            $optional_setup_gpa= @$optional_subject_setup->gpa_above;
                                                                            if (@$mark_grade->gpa >$optional_setup_gpa) {
                                                                                $mark_grade_gpa = @$mark_grade->gpa-$optional_setup_gpa;
                                                                                $tota_grade_point = $tota_grade_point + @$mark_grade_gpa;
                                                                                $tota_grade_point_main = $tota_grade_point_main + @$mark_grade->gpa;
                                                                            } else {
                                                                                $tota_grade_point = $tota_grade_point + @$mark_grade_gpa;
                                                                                $tota_grade_point_main = $tota_grade_point_main + @$mark_grade->gpa;
                                                                            }
                                                                        } else {
                                                                            $tota_grade_point = $tota_grade_point + @$mark_grade->gpa ;
                                                                            if(@$mark_grade->gpa<1){
                                                                                $this_student_failed =1;
                                                                            }
                                                                            $tota_grade_point_main = $tota_grade_point_main + @$mark_grade->gpa;
                                                                        }
                                                                ?>
                                                                
                                                                <?php
                                                                    if(@$optional_subject->subject_id==$subject_ID){
                                                                        $optional_subject_gpa+= @$mark_grade->gpa-$optional_setup_gpa;
                                                                        $opt_sub_gpa+=$optional_setup_gpa;
                                                                    }
                                                                ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <td><?php echo e($marks_by_students); ?></td>
                                                            <?php 
                                                                $marks_by_students = 0; 
                                                            ?>
                                                            <?php if($optional_subject_setup!=''): ?>
                                                                <td>
                                                                    <?php if(isset($this_student_failed) && $this_student_failed==1): ?>
                                                                        <?php if(!empty($tota_grade_point_main)): ?>
                                                                            <p id="main_subject_total_gpa"></p>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <?php
                                                                            if (@$optional_subject!='') {
                                                                                if(!empty($tota_grade_point_main)){
                                                                                    $subject = count($subjects)-1;
                                                                                    $without_optional_subject=($tota_grade_point_main - $opt_sub_gpa) - $optional_subject_gpa;
                                                                                    $number = number_format($without_optional_subject/ $subject , 2, '.', '');
                                                                                }else{
                                                                                    $number = 0;
                                                                                }
                                                                            } else{
                                                                                $subject_count=count($subjects);
                                                                                if(!empty($tota_grade_point_main)){
                                                                                    $number = number_format($tota_grade_point_main/ $subject_count, 2, '.', '');
                                                                                }else{
                                                                                    $number = 0;
                                                                                }
                                                                            }  
                                                                        ?> 
                                                                        <?php echo e($number==0?'0.00':$number); ?>

                                                                        <?php 
                                                                            $subject_count=0;
                                                                            $tota_grade_point_main= 0; 
                                                                            $subject_count =count($subjects)-1;
                                                                        ?>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                        $subject_count=0;
                                                                        $subject_count =count($subjects)-1;
                                                                    ?>
                                                                    <?php if(isset($this_student_failed) && $this_student_failed==1): ?>
                                                                        <?php echo e(number_format($tota_grade_point/ $subject_count, 2, '.', '')); ?>

                                                                    <?php else: ?>
                                                                        <?php
                                                                        if (@$optional_subject!='') {
                                                                            $subject_count=count($subjects)-1;
                                                                            if(!empty($tota_grade_point)){
                                                                                $number = number_format($tota_grade_point/ $subject_count, 2, '.', '');
                                                                            }else{
                                                                                $number = 0;
                                                                            }
                                                                        } else{
                                                                            $subject_count=count($subjects);
                                                                            if(!empty($tota_grade_point)){
                                                                                $number = number_format($tota_grade_point/ $subject_count, 2, '.', '');
                                                                            }else{
                                                                                $number = 0;
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <?php if($number >= $max_grade): ?>
                                                                            <?php echo e($max_grade); ?>

                                                                        <?php else: ?>
                                                                            <?php echo e($number==0?'0.00':$number); ?>

                                                                        <?php endif; ?>
                                                                        <?php 
                                                                            $tota_grade_point= 0; 
                                                                        ?>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if(isset($this_student_failed) && $this_student_failed==1): ?>
                                                                        <span class="text-warning font-weight-bold">
                                                                            <?php echo e($fail_grade_name->grade_name); ?>

                                                                        </span>
                                                                    <?php else: ?>
                                                                        <?php if($number >= $max_grade): ?>
                                                                            <?php echo e(gradeName($max_grade)); ?>

                                                                        <?php else: ?>
                                                                            <?php echo e(gradeName($number)); ?>

                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </td>
                                                            <?php else: ?>
                                                                <td>
                                                                    <?php if(isset($this_student_failed) && $this_student_failed==1): ?>
                                                                        <?php echo e(number_format($tota_grade_point/ count($subjects), 2, '.', '')); ?>

                                                                    <?php else: ?>
                                                                        <?php
                                                                            $subject_count=0;
                                                                            if (@$optional_subject!='') {
                                                                                $subject_count=count($subjects)-1;
                                                                                    if(!empty($tota_grade_point)){
                                                                                        $number = number_format($tota_grade_point/ $subject_count, 2, '.', '');
                                                                                    }else{
                                                                                        $number = 0;
                                                                                    }
                                                                            } else{
                                                                                $subject_count=count($subjects);
                                                                                    if(!empty($tota_grade_point)){
                                                                                        $number = number_format($tota_grade_point/ $subject_count, 2, '.', '');
                                                                                    }else{
                                                                                        $number = 0;
                                                                                    }
                                                                            }
                                                                        ?>    
                                                                            <?php echo e($number==0?'0.00':$number); ?>

                                                                        <?php 
                                                                            $tota_grade_point= 0; 
                                                                        ?>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if(isset($this_student_failed) && $this_student_failed==1): ?>
                                                                        <span class="text-dander font-weight-bold">
                                                                            <?php echo e($fail_grade_name->grade_name); ?>

                                                                        </span>
                                                                    <?php else: ?>
                                                                    <?php
                                                                        $main_subject_total_gpa=0;
                                                                        $Optional_subject_count=0;
                                                                            if($optional_subject_mark!=''){
                                                                                $Optional_subject_count=$subjects->count()-1;
                                                                            }else{
                                                                                $Optional_subject_count=$subjects->count();
                                                                            }
                                                                    ?>
                                                                    <?php $__currentLoopData = $mark_sheet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                            if ($data->subject_id==$optional_subject_mark) { 
                                                                                continue;
                                                                            }
                                                                            $result = markGpa($persentage);
                                                                            $main_subject_total_gpa += $result->gpa;
                                                                        ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php echo e(gradeName($number)); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                                <script>
                                                    function myFunction(value, subject) {
                                                        if (value != "") {
                                                            var res = Number(value / subject).toFixed(2);
                                                        } else {
                                                            var res = 0;
                                                        }
                                                        document.getElementById("main_subject_total_gpa").innerHTML = res;
                                                    }
                                                    myFunction(<?php echo e($main_subject_total_gpa); ?>, <?php echo e($Optional_subject_count); ?>);
                                                </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php elseif(isset($allClass)): ?>
            <section class="student-details mt-20">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-30 mt-30"> 
                                    <?php echo app('translator')->get('reports.tabulation_sheet_report'); ?>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-8 pull-right mt-20">
                            <div class="print_button pull-right">
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'tabulation-sheet/print', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student', 'target' => '_blank'])); ?>

                                <input type="hidden" name="allSection" value="allSection">
                                <input type="hidden" name="exam_term_id" value="<?php echo e($exam_term_id); ?>">
                                <input type="hidden" name="class_id" value="<?php echo e($class_id); ?>">
                                <input type="hidden" name="section_id" value="<?php echo e($section_id); ?>">
                                
                                <button type="submit" class="primary-btn small fix-gr-bg"><i class="ti-printer"> </i> <?php echo app('translator')->get('common.print'); ?>
                                </button>
                            <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="single-report-admit">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
                                            <img class="logo-img" src="<?php echo e(generalSetting()->logo); ?>" alt="<?php echo e(generalSetting()->school_name); ?>">
                                        </div>
                                        <div class="col-lg-4">
                                            <h3 class="text-white"><?php echo app('translator')->get('common.search'); ?> : <?php echo e($tabulation_details['class']); ?></h3>
                                            <p class="text-white mb-0"><?php echo app('translator')->get('common.section'); ?> : <?php echo e($tabulation_details['section']); ?></p>
                                        </div>
                                        <div class=" col-lg-4 text-left text-lg-right mt-30-md">
                                            <h3 class="text-white"> <?php echo e(isset(generalSetting()->school_name)?generalSetting()->school_name:'Infix School Management ERP'); ?> </h3>
                                            <p class="text-white mb-0"> <?php echo e(isset(generalSetting()->address)?generalSetting()->address:'Infix School Adress'); ?> </p>
                                            <p class="text-white mb-0">
                                                <?php echo app('translator')->get('common.email'); ?>: <?php echo e(isset(generalSetting()->email)?generalSetting()->email:'admin@demo.com'); ?> ,
                                                <?php echo app('translator')->get('common.phone'); ?>: <?php echo e(isset(generalSetting()->phone)?generalSetting()->phone:'+8801841412141'); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="white-box">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="exam_title text-center text-uppercase">
                                                <?php echo app('translator')->get('reports.tabulation_sheet_of'); ?> <?php echo e($tabulation_details['exam_term']); ?> <?php echo app('translator')->get('reports.in'); ?> <?php echo e($year); ?>

                                            </h4>
                                            <br>
                                            <div class="row">
                                                <div class="col-lg-7"></div>
                                                <div class="col-lg-5"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="single-report-admit">
                                                <div class="student_marks_table pt-0">
                                                    <div class="table-responsive">
                                                        <table class="mt-30 mb-20 table table-bordered w-100 scrolled_table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="name_field" rowspan="3"><?php echo app('translator')->get('common.name'); ?></th>
                                                                    <th class="roll_field" rowspan="3"><?php echo app('translator')->get('student.roll_no'); ?></th>
                                                                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                            $subject_ID    = $subject->subject_id;
                                                                            $subject_Name   = $subject->subject->subject_name;
                                                                            $mark_parts      = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                                                                        ?>
                                                                    <th class="large_spanTh" colspan="<?php echo e(count($mark_parts)+1); ?>"><?php echo e($subject_Name); ?></th>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <th class="large_spanTh" rowspan="2" colspan="1"><?php echo app('translator')->get('exam.total_mark'); ?></th>
                                                                    <?php if($optional_subject_setup!=''): ?>
                                                                        <th class="large_spanTh"><?php echo app('translator')->get('exam.gpa'); ?></th>
                                                                        <th rowspan="2" class="large_spanTh"><?php echo app('translator')->get('exam.gpa'); ?></th>
                                                                        <th rowspan="2" class="large_spanTh"><?php echo app('translator')->get('reports.result'); ?></th>
                                                                        
                                                                    <?php else: ?>
                                                                        <th rowspan="2" class="large_spanTh"><?php echo app('translator')->get('exam.gpa'); ?></th>
                                                                        <th rowspan="2" class="large_spanTh"><?php echo app('translator')->get('reports.result'); ?></th>
                                                                    <?php endif; ?>
                                                                </tr>
                                                                <tr>
                                                                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                            $subject_ID     = $subject->subject_id;
                                                                            $subject_Name   = $subject->subject->subject_name;
                                                                            $mark_parts     = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                                                                        ?>
                                                                        <?php $__currentLoopData = $mark_parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sigle_part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <th class="large_padding"><?php echo e($sigle_part->exam_title); ?> (<?php echo e($sigle_part->exam_mark); ?>)</th>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <th><?php echo app('translator')->get('exam.result'); ?></th>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($optional_subject_setup!=''): ?>
                                                                        <th><small><?php echo app('translator')->get('reports.without_additional'); ?></small></th>
                                                                    <?php endif; ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $this_student_failed=0; 
                                                                    $tota_grade_point= 0; 
                                                                    $tota_grade_point_main= 0; 
                                                                    $marks_by_students = 0;
                                                                    $gpa_without_optional_count=0;  
                                                                    $main_subject_total_gpa =0;  
                                                                    $Optional_subject_count=0;  
                                                                    $optional_subject_gpa=0;  
                                                                    $opt_sub_gpa=0;
                                                                    $optional_subject=App\SmOptionalSubjectAssign::where('student_id','=',$student->id)
                                                                                    ->where('session_id','=',$student->session_id)
                                                                                    ->first();
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo e($student->full_name); ?></td>
                                                                    <td><?php echo e($student->roll_no); ?></td>
                                                                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php
                                                                                $subject_ID     = $subject->subject_id;
                                                                                $subject_Name   = $subject->subject->subject_name;
                                                                                $mark_parts     = App\SmAssignSubject::getMarksOfPart($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);
                                                                                $subject_count= 0;
                                                                                $optional_subject_marks=DB::table('sm_optional_subject_assigns')
                                                                                    ->join('sm_mark_stores','sm_mark_stores.subject_id','=','sm_optional_subject_assigns.subject_id')
                                                                                    ->where('sm_optional_subject_assigns.student_id','=',$student->id)
                                                                                    ->first();
                                                                            ?>
                                                                        <?php $__currentLoopData = $mark_parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sigle_part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <td class="large_padding"><?php echo e($sigle_part->total_marks); ?></td>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <td>
                                                                        <?php
                                                                            $tola_mark_by_subject = App\SmAssignSubject::getSumMark($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);
                                                                            $marks_by_students  = $marks_by_students + $tola_mark_by_subject;
                                                                        ?>
                                                                        <?php echo e($tola_mark_by_subject); ?>

                                                                    </td>
                                                                    <?php
                                                                        $value=subjectFullMark($exam_term_id, $subject_ID);
                                                                        $persentage=subjectPercentageMark($tola_mark_by_subject,$value);
                                                                        
                                                                        $mark_grade = markGpa($persentage);

                                                                            $mark_grade_gpa=0;
                                                                            $optional_setup_gpa=0;
                                                                            if (@$optional_subject->subject_id==$subject_ID) {
                                                                                $optional_setup_gpa= @$optional_subject_setup->gpa_above;
                                                                                if (@$mark_grade->gpa >$optional_setup_gpa) {
                                                                                    $mark_grade_gpa = @$mark_grade->gpa-$optional_setup_gpa;
                                                                                    $tota_grade_point = $tota_grade_point + @$mark_grade_gpa;
                                                                                    $tota_grade_point_main = $tota_grade_point_main + @$mark_grade->gpa;
                                                                                } else {
                                                                                    $tota_grade_point = $tota_grade_point + @$mark_grade_gpa;
                                                                                    $tota_grade_point_main = $tota_grade_point_main + @$mark_grade->gpa;
                                                                                }
                                                                            } else {
                                                                                $tota_grade_point = $tota_grade_point + @$mark_grade->gpa;
                                                                                if(@$mark_grade->gpa<1){
                                                                                    $this_student_failed =1;
                                                                                }
                                                                                $tota_grade_point_main = $tota_grade_point_main + @$mark_grade->gpa;
                                                                            }
                                                                    ?>
                                                                    <?php
                                                                        if(@$optional_subject->subject_id==$subject_ID){
                                                                            $optional_subject_gpa+= @$mark_grade->gpa-$optional_setup_gpa;
                                                                            $opt_sub_gpa+=$optional_setup_gpa;
                                                                        }
                                                                    ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <td><?php echo e($marks_by_students); ?></td>
                                                                    <?php if($optional_subject_setup!=''): ?>
                                                                        <td>
                                                                            <?php if(isset($this_student_failed) && $this_student_failed==1): ?>
                                                                                <?php if(!empty($tota_grade_point_main)): ?>
                                                                                <p id="main_subject_total_gpa"></p>
                                                                                <?php endif; ?>
                                                                            <?php else: ?>
                                                                                <?php
                                                                                    if (@$optional_subject!='') {
                                                                                        if(!empty($tota_grade_point_main)){
                                                                                            $subject = count($subjects)-1;
                                                                                            $without_optional_subject=($tota_grade_point_main - $opt_sub_gpa) - $optional_subject_gpa;
                                                                                            $number = number_format($without_optional_subject/ $subject , 2, '.', '');
                                                                                        }else{
                                                                                            $number = 0;
                                                                                        }
                                                                                    } else{
                                                                                        $subject_count=count($subjects);
                                                                                        if(!empty($tota_grade_point_main)){
                                                                                            
                                                                                            $number = number_format($tota_grade_point_main/ $subject_count, 2, '.', '');
                                                                                        }else{
                                                                                            $number = 0;
                                                                                        }
                                                                                    }  
                                                                                ?> 
                                                                                    <?php echo e($number==0?'0.00':$number); ?>

                                                                                    <?php 
                                                                                        $subject_count=0;
                                                                                        $tota_grade_point_main= 0; 
                                                                                        $subject_count =count($subjects)-1;
                                                                                    ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    <?php endif; ?>
                                                                    
                                                                    <td>
                                                                        <?php if(isset($this_student_failed) && $this_student_failed==1): ?>
                                                                            <?php echo e(number_format($tota_grade_point/ count($subjects), 2, '.', '')); ?>

                                                                        <?php else: ?>
                                                                            <?php
                                                                                $subject_count=0;
                                                                                if (@$optional_subject!='') {
                                                                                    $subject_count=count($subjects)-1;
                                                                                        if(!empty($tota_grade_point)){
                                                                                            $number = number_format($tota_grade_point/ $subject_count, 2, '.', '');
                                                                                        }else{
                                                                                            $number = 0;
                                                                                        }
                                                                                } else{
                                                                                    $subject_count=count($subjects);
                                                                                        if(!empty($tota_grade_point)){
                                                                                            $number = number_format($tota_grade_point/ $subject_count, 2, '.', '');
                                                                                        }else{
                                                                                            $number = 0;
                                                                                        }
                                                                                }
                                                                            ?>    
                                                                                <?php if($number >= $max_grade): ?>
                                                                                    <?php echo e($max_grade); ?>

                                                                                <?php else: ?>
                                                                                    <?php echo e($number==0?'0.00':$number); ?>

                                                                                <?php endif; ?>
                                                                            <?php 
                                                                                $tota_grade_point= 0;
                                                                            ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if(isset($this_student_failed) && $this_student_failed==1): ?>
                                                                            <span class="text-warning font-weight-bold">
                                                                                <?php echo e($fail_grade_name->grade_name); ?>

                                                                            </span>
                                                                        <?php else: ?>
                                                                            <?php if($number >= $max_grade): ?>
                                                                                <?php echo e(gradeName($max_grade)); ?>

                                                                            <?php else: ?>
                                                                                <?php echo e(gradeName($number)); ?>  
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>
                                                        </table>
                                                        <script>
                                                            function myFunction(value, subject) {
                                                                if (value != "") {
                                                                    var res = Number(value / subject).toFixed(2);
                                                                } else {
                                                                    var res = 0;
                                                                }
                                                                document.getElementById("main_subject_total_gpa").innerHTML = res;
                                                            }
                                                            myFunction(<?php echo e($main_subject_total_gpa); ?>, <?php echo e($Optional_subject_count); ?>);
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/reports/tabulation_sheet_report.blade.php ENDPATH**/ ?>