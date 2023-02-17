<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('lesson::lesson.lesson_plan'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <link rel="stylesheet" href="<?php echo e(url('Modules/Lesson/Resources/assets/css/lesson_plan.css')); ?>">
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lesson::lesson.lesson_plan'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lesson::lesson.lesson_plan'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <!-- Start Student Details -->
                <div class="col-lg-12 student-details up_admin_visitor">
                    <ul class="nav nav-tabs tabs_scroll_nav ml-0" role="tablist">

                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if($key == 0): ?> active <?php endif; ?> " href="#tab<?php echo e($key); ?>" role="tab"
                                    data-toggle="tab"><?php echo e($record->class->class_name); ?>

                                    (<?php echo e($record->section->section_name); ?>) </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>


                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Fees Tab -->
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div role="tabpanel" class="tab-pane fade  <?php if($key == 0): ?> active show <?php endif; ?>"
                                id="tab<?php echo e($key); ?>">
                                <div class="container-fluid p-0 mt-40">
                                    <div class="white-box ">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="main-title">
                                                    <?php
                                                    $dates[6];
                                                    if (isset($week_number)) {
                                                        $week_number = $week_number;
                                                    } else {
                                                        $week_number = $this_week;
                                                    }
                                                    
                                                    ?>

                                                    <h3 class="text-center "><a
                                                            href="<?php echo e(url('/lesson/dicrease-week/' . $dates[0])); ?>"> <
                                                            </a> week <?php echo e($week_number); ?> | <span class="yearColor">
                                                                    <?php echo e(date('Y', strtotime($dates[0]))); ?> </span><a
                                                                    href="<?php echo e(url('/lesson/change-week/' . $dates[6])); ?>"> > </a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">

                                                <table id="" class="display school-table " cellspacing="0"
                                                    width="100%">
                                                    <thead>
                                                        <tr>
                                                            <?php
                                                                $height = 0;
                                                                $tr = [];
                                                            ?>
                                                            <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $studentClassRoutine = App\SmWeekend::studentClassRoutineFromRecord($record->class_id, $record->section_id, $sm_weekend->id);
                                                                ?>
                                                                <?php if($studentClassRoutine->count() > $height): ?>
                                                                    <?php
                                                                        $height = $studentClassRoutine->count();
                                                                    ?>
                                                                <?php endif; ?>

                                                                <th><?php echo e(@$sm_weekend->name); ?> <br>
                                                                    <?php echo e(date('d-M-y', strtotime($dates[$key]))); ?>

                                                                </th>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </tr>
                                                    </thead>
                                                    <?php
                                                        $used = [];
                                                        $tr = [];
                                                        
                                                    ?>
                                                    <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            
                                                            $i = 0;
                                                            $studentClassRoutine = App\SmWeekend::studentClassRoutineFromRecord($record->class_id, $record->section_id, $sm_weekend->id);
                                                        ?>
                                                        <?php $__currentLoopData = $studentClassRoutine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                if (!in_array($routine->id, $used)) {
                                                                    $tr[$i][$sm_weekend->name][$loop->index]['subject'] = $routine->subject ? $routine->subject->subject_name : '';
                                                                    $tr[$i][$sm_weekend->name][$loop->index]['subject_code'] = $routine->subject ? $routine->subject->subject_code : '';
                                                                    $tr[$i][$sm_weekend->name][$loop->index]['class_room'] = $routine->classRoom ? $routine->classRoom->room_no : '';
                                                                    $tr[$i][$sm_weekend->name][$loop->index]['teacher'] = $routine->teacherDetail ? $routine->teacherDetail->full_name : '';
                                                                    $tr[$i][$sm_weekend->name][$loop->index]['start_time'] = $routine->start_time;
                                                                    $tr[$i][$sm_weekend->name][$loop->index]['end_time'] = $routine->end_time;
                                                                    $tr[$i][$sm_weekend->name][$loop->index]['is_break'] = $routine->is_break;
                                                                    $used[] = $routine->id;
                                                                    $tr[$i][$sm_weekend->name][$loop->index]['subject_id'] = $routine->subject ? $routine->subject->id : null;
                                                                    $tr[$i][$sm_weekend->name][$loop->index]['routine_id'] = $routine->id;
                                                                }
                                                                
                                                            ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        <?php
                                                            
                                                            $i++;
                                                        ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php for($i = 0; $i < $height; $i++): ?>
                                                        <tr>
                                                            <?php $__currentLoopData = $tr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $days): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                    <td>
                                                                        <?php
                                                                            $lesson_date = $dates[$key];
                                                                            $classes = gv($days, $sm_weekend->name);
                                                                        ?>
                                                                        <?php if($classes && gv($classes, $i)): ?>
                                                                            <?php if($classes[$i]['is_break']): ?>
                                                                                <strong> <?php echo app('translator')->get('lesson::lesson.break'); ?> </strong>

                                                                                <span class="">
                                                                                    (<?php echo e(date('h:i A', strtotime(@$classes[$i]['start_time']))); ?>

                                                                                    -
                                                                                    <?php echo e(date('h:i A', strtotime(@$classes[$i]['end_time']))); ?>)
                                                                                    <br> </span>
                                                                            <?php else: ?>
                                                                                <span class="">
                                                                                    <strong><?php echo app('translator')->get('common.time'); ?> :</strong>
                                                                                    <?php echo e(date('h:i A', strtotime(@$classes[$i]['start_time']))); ?>

                                                                                    -
                                                                                    <?php echo e(date('h:i A', strtotime(@$classes[$i]['end_time']))); ?>

                                                                                    <br> </span>
                                                                                <span class=""> <strong>
                                                                                        <?php echo e($classes[$i]['subject']); ?>

                                                                                    </strong>
                                                                                    (<?php echo e($classes[$i]['subject_code']); ?>) <br>
                                                                                </span>
                                                                                <?php if($classes[$i]['class_room']): ?>
                                                                                    <span class="">
                                                                                        <strong><?php echo app('translator')->get('common.room'); ?> :</strong>
                                                                                        <?php echo e($classes[$i]['class_room']); ?> <br>
                                                                                    </span>
                                                                                <?php endif; ?>
                                                                                <?php if($classes[$i]['teacher']): ?>
                                                                                    <span class="">
                                                                                        <?php echo e($classes[$i]['teacher']); ?> <br>
                                                                                    </span>
                                                                                <?php endif; ?>
                                                                                <?php
                                                                                    $subject_id = $classes[$i]['subject_id'];
                                                                                    $routine_id = $classes[$i]['routine_id'];
                                                                                    
                                                                                    $lessonPlan = DB::table('lesson_planners')
                                                                                        ->where('lesson_date', $lesson_date)
                                                                                        ->where('class_id', $record->class_id)
                                                                                        ->where('section_id', $record->section_id)
                                                                                        ->where('subject_id', $subject_id)
                                                                                        ->where('routine_id', $routine_id)
                                                                                        ->where('academic_id', getAcademicId())
                                                                                        ->where('school_id', Auth::user()->school_id)
                                                                                        ->first();
                                                                                    
                                                                                ?>
                                                                                <?php if($lessonPlan): ?>


                                                                                    <a href="<?php echo e(route('view-lesson-planner-lesson', [$lessonPlan->id])); ?>"
                                                                                        class="primary-btn small tr-bg icon-only mr-10 modalLink"
                                                                                        title="<?php echo app('translator')->get('lesson::lesson.lesson_overview'); ?> "
                                                                                        data-modal-size="modal-lg">
                                                                                        <span class="ti-eye"
                                                                                            id=""></span>
                                                                                    </a>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>

                                                                        <?php endif; ?>

                                                                    </td>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tr>

                                                    <?php endfor; ?>
                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- End Fees Tab -->
                    </div>

                </div>
                <!-- End Student Details -->
            </div>


        </div>
    </section>

  


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/Modules/Lesson/Resources/views/student/student_lesson_plan.blade.php ENDPATH**/ ?>