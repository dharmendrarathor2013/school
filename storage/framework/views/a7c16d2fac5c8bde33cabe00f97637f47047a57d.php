<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('student.my_profile'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <?php  @$setting = generalSetting(); if(!empty(@$setting->currency_symbol)){ @$currency = @$setting->currency_symbol; }else{ @$currency = '$'; }   ?>
    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Start Student Meta Information -->
                    <div class="main-title">
                        <h3 class="mb-20"><?php echo app('translator')->get('student.welcome_to'); ?> <strong> <?php echo e(@$student_detail->full_name); ?></strong>
                        </h3>
                    </div>

                </div>
            </div>
            <div class="row">
                <?php if(userPermission(2)): ?>
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo e(route('student_subject')); ?>" class="d-block">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3><?php echo app('translator')->get('common.subject'); ?></h3>
                                        <p class="mb-0"><?php echo app('translator')->get('student.total_subject'); ?></p>
                                    </div>
                                    <h1 class="gradient-color2">

                                        <?php if(isset($totalSubjects)): ?>
                                            <?php echo e(count(@$totalSubjects)); ?>

                                        <?php endif; ?>
                                    </h1>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if(userPermission(3)): ?>
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo e(route('student_noticeboard')); ?>" class="d-block">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3><?php echo app('translator')->get('student.notice'); ?></h3>
                                        <p class="mb-0"><?php echo app('translator')->get('student.total_notice'); ?></p>
                                    </div>
                                    <h1 class="gradient-color2">
                                        <?php if(isset($totalNotices)): ?>
                                            <?php echo e(count(@$totalNotices)); ?>

                                        <?php endif; ?>
                                    </h1>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if(userPermission(4)): ?>
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo e(route('student_exam_schedule')); ?>" class="d-block">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3><?php echo app('translator')->get('student.exam'); ?></h3>
                                        <p class="mb-0"><?php echo app('translator')->get('student.total_exam'); ?></p>
                                    </div>
                                    <h1 class="gradient-color2">
                                        <?php if(isset($exams)): ?>
                                            <?php echo e(count(@$exams)); ?>

                                        <?php endif; ?>
                                    </h1>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if(userPermission(5)): ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="white-box single-summery">
                            <?php if(moduleStatusCheck('OnlineExam')): ?>
                                <a href="<?php echo e(route('om_student_online_exam')); ?>" class="d-block">
                                    <?php else: ?>
                                        <a href="<?php echo e(route('student_online_exam')); ?>" class="d-block">
                                            <?php endif; ?>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h3><?php echo app('translator')->get('student.online_exam'); ?></h3>
                                                    <p class="mb-0"><?php echo app('translator')->get('student.total_online_exam'); ?></p>
                                                </div>
                                                <h1 class="gradient-color2">
                                                    <?php if(isset($online_exams)): ?>
                                                        <?php echo e(count(@$online_exams)); ?>

                                                    <?php endif; ?>
                                                </h1>
                                            </div>
                                        </a>
                        </div>

                    </div>
                <?php endif; ?>
                <?php if(userPermission(6)): ?>

                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo e(route('student_teacher')); ?>" class="d-block">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3><?php echo app('translator')->get('student.teachers'); ?></h3>
                                        <p class="mb-0"><?php echo app('translator')->get('student.total_teachers'); ?></p>
                                    </div>
                                    <h1 class="gradient-color2"> <?php if(isset($teachers)): ?>
                                            <?php echo e(count(@$teachers)); ?>

                                        <?php endif; ?></h1>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if(userPermission(7)): ?>
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo e(route('student_book_issue')); ?>" class="d-block">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3><?php echo app('translator')->get('student.issued_book'); ?></h3>
                                        <p class="mb-0"><?php echo app('translator')->get('student.total_issued_book'); ?></p>
                                    </div>
                                    <h1 class="gradient-color2">
                                        <?php if(isset($issueBooks)): ?>
                                            <?php echo e(count(@$issueBooks)); ?>

                                        <?php endif; ?>
                                    </h1>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if(userPermission(8)): ?>
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo e(route('student_homework')); ?>" class="d-block">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3><?php echo app('translator')->get('student.pending_home_work'); ?></h3>
                                        <p class="mb-0"><?php echo app('translator')->get('student.total_pending_home_work'); ?></p>
                                    </div>
                                    <h1 class="gradient-color2">
                                        <?php if(isset($homeworkLists)): ?>
                                            <?php echo e(count(@$homeworkLists)); ?>

                                        <?php endif; ?>
                                    </h1>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if(userPermission(9)): ?>
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo e(route('student_my_attendance')); ?>" class="d-block">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3><?php echo app('translator')->get('student.attendance_in_current_month'); ?></h3>
                                        <p class="mb-0"><?php echo app('translator')->get('student.total_attendance_in_current_month'); ?></p>
                                    </div>
                                    <h1 class="gradient-color2">
                                        <?php if(isset($attendances)): ?>
                                            <?php echo e(count(@$attendances)); ?>

                                        <?php endif; ?>
                                    </h1>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>


            </div>
            <?php if(userPermission(10)): ?>
                <section class="mt-50">
                    <div class="container-fluid p-0">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <h3 class="mb-30"><?php echo app('translator')->get('student.calendar'); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="white-box">
                                            <div class='common-calendar'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </div>
        </div>
    </section>

    <div id="fullCalModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span
                                class="sr-only">close</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div class="modal-body text-center">
                    <img src="" alt="There are no image" id="image" height="150" width="auto">
                    <div id="modalBody"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <?php

    $count_event = 0;
    @$calendar_events = array();

    foreach ($holidays as $k => $holiday) {

        @$calendar_events[$k]['title'] = $holiday->holiday_title;

        $calendar_events[$k]['start'] = $holiday->from_date;

        $calendar_events[$k]['end'] = Carbon::parse($holiday->to_date)->addDays(1)->format('Y-m-d');

        $calendar_events[$k]['description'] = $holiday->details;

        $calendar_events[$k]['url'] = $holiday->upload_image_file;

        $count_event = $k;
        $count_event++;
    }



    foreach ($events as $k => $event) {
        @$calendar_events[$count_event]['title'] = $event->event_title;

        $calendar_events[$count_event]['start'] = $event->from_date;

        $calendar_events[$count_event]['end'] = Carbon::parse($event->to_date)->addDays(1)->format('Y-m-d');
        $calendar_events[$count_event]['description'] = $event->event_des;
        $calendar_events[$count_event]['url'] = $event->uplad_image_file;
        $count_event++;
    }





    ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

    <script type="text/javascript">
        /*-------------------------------------------------------------------------------
           Full Calendar Js
        -------------------------------------------------------------------------------*/
        if ($('.common-calendar').length) {
            $('.common-calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                eventClick: function (event, jsEvent, view) {
                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);
                    $('#image').attr('src', event.url);
                    $('#fullCalModal').modal();
                    return false;
                },
                height: 650,
                events: <?php echo json_encode($calendar_events);?> ,
            });
        }


    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/studentPanel/studentProfile.blade.php ENDPATH**/ ?>