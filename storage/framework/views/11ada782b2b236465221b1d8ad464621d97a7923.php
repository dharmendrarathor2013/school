<?php
    $school_config = schoolConfig();
    $isSchoolAdmin = Session::get('isSchoolAdmin');
    $activeStyle = Session::get('active_style');
    $sidebar_bg = $activeStyle['sidebar_bg'];
    $sidebar_bg2 = $activeStyle['sidebar_bg2'];
    $title_color = $activeStyle['title_color'];
    $text_color = $activeStyle['text_color'];
$button_color = $activeStyle['primary_color3'];

?>
<!-- sidebar part here -->
<style>
    .sidebar #sidebar_menu li a:hover {
    /* background: #415094; */
    color: #fff;
    background-color:<?php echo $sidebar_bg; ?>;
}
.sidebar #sidebar_menu li.mm-active>a {
    color: #fff;
    background:<?php echo $sidebar_bg; ?>;
}
#sidebar ul li a.active {
    background:<?php echo $sidebar_bg; ?>;
}

.sidebar #sidebar_menu li a:{
    /* background: #415094; */
    /* color: #fff; */
    background-color:<?php echo $sidebar_bg; ?>;
}
#sidebar ul li ul {
    background-color:<?php echo $sidebar_bg; ?>;

}

.main-title h3 {
    color:<?php echo $title_color; ?>;
}

.sms-breadcrumb h1 {
    color:<?php echo $title_color; ?>;
}

element.style {
    /* color: red; */
}
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    color:<?php echo $text_color; ?>;
}
.footer-area {
    color:<?php echo $text_color; ?>;
}
	
	.primary-btn.fix-gr-bg {
		background: <?php echo $button_color; ?>;
	}
	
	.gradient-bg, .school-table .dropdown .dropdown-toggle:hover, .school-table .dropdown .dropdown-toggle:focus, .bootstrap-datetimepicker-widget table td.hour:hover, .bootstrap-datetimepicker-widget table td.minute:hover, .bootstrap-datetimepicker-widget table td span.glyphicon-chevron-up:hover:after, .bootstrap-datetimepicker-widget table td span.glyphicon-chevron-down:hover:after, .datepicker table tr td.active.day, .datepicker table tr td.day:hover, .datepicker thead tr:first-child th:hover, .pagination .page-link:hover, .common-calendar .fc-month-view .fc-day.fc-widget-content.fc-today, .common-calendar .fc-state-default.fc-corner-left:hover, .common-calendar .fc-button.fc-state-default:hover, .primary-btn.white:hover, .nice-select.tr-bg:hover, .admin .navbar .right-navbar .dropdown .badge, .admin .navbar .right-navbar .dropdown .primary-btn, .student-activities .single-activity .title:before, .single-cms-box:hover .single-cms .overlay, .client .events-item:hover .card .card-body .date, .client.light .overview-area .nav-tabs .nav-link:hover, .client.light .overview-area .nav-tabs .nav-link.active, .client.color .overview-area .nav-tabs .nav-link:hover, .client.color .overview-area .nav-tabs .nav-link.active {
	background: <?php echo $button_color; ?>;
	}
	button.dt-button:hover:not(.disabled), div.dt-button:hover:not(.disabled), a.dt-button:hover:not(.disabled) {
		background: <?php echo $button_color; ?>;
	}
	.primary-btn:hover{
	background: <?php echo $button_color; ?>;
	}
	
	table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child::before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child::before {
		background: <?php echo $button_color; ?>;
	}
	table.dataTable td.dataTables_empty {
		color: <?php echo $text_color; ?>;
	}
	
</style>
<!-- sidebar part here -->
<nav id="sidebar" class="sidebar" style="background:<?php echo $sidebar_bg2; ?>;">

    <div class="sidebar-header update_sidebar">
        <?php if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3): ?>
            <?php if(userPermission(1)): ?>
                <?php if(moduleStatusCheck('Saas') == true && Auth::user()->is_administrator == 'yes' && Session::get('isSchoolAdmin') == false && Auth::user()->role_id == 1): ?>
                    <a href="<?php echo e(route('superadmin-dashboard')); ?>" id="superadmin-dashboard">
                <?php else: ?>
                    <a href="<?php echo e(route('admin-dashboard')); ?>" id="admin-dashboard">
                <?php endif; ?>
            <?php else: ?>
                <a href="<?php echo e(url('/')); ?>" id="admin-dashboard">
            <?php endif; ?>
        <?php else: ?>
            <a href="<?php echo e(url('/')); ?>" id="admin-dashboard">
        <?php endif; ?>
            <?php if(!is_null($school_config->logo)): ?>
                <img src="<?php echo e(asset($school_config->logo)); ?>" alt="logo">
            <?php else: ?>
                <img src="<?php echo e(asset('public/uploads/settings/logo.png')); ?>" alt="logo">
            <?php endif; ?>
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>

    </div>
    <?php if(Auth::user()->is_saas == 0): ?>

        <ul class="list-unstyled components" id="sidebar_menu">
            <input type="hidden" name="" id="default_position" value="<?php echo e(menuPosition('is_submit')); ?>">
            <?php if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3): ?>
                <?php if(userPermission(1)): ?>
                    <li>
                        <?php if(moduleStatusCheck('Saas') == true && Auth::user()->is_administrator == 'yes' && Session::get('isSchoolAdmin') == false && Auth::user()->role_id == 1): ?>
                            <a href="<?php echo e(route('superadmin-dashboard')); ?>" id="superadmin-dashboard">
                                <?php else: ?>
                                    <a href="<?php echo e(route('admin-dashboard')); ?>" id="admin-dashboard">
                                        <?php endif; ?>
                                        <div class="nav_icon_small">
                                            <span class="flaticon-speedometer"></span>
                                        </div>
                                        <div class="nav_title">
                                            <?php echo app('translator')->get('common.dashboard'); ?>
                                        </div>

                                    </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(moduleStatusCheck('InfixBiometrics') == true && Auth::user()->role_id == 1): ?>
                <?php echo $__env->make('infixbiometrics::menu.InfixBiometrics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            




            
            <?php if(moduleStatusCheck('SaasSubscription') == true && Auth::user()->is_administrator != 'yes'): ?>
                <?php echo $__env->make('saassubscription::menu.SaasSubscriptionSchool', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            
            <?php if(moduleStatusCheck('Saas') == true && Auth::user()->is_administrator == 'yes' && Session::get('isSchoolAdmin') == false && Auth::user()->role_id == 1): ?>
                <?php echo $__env->make('saas::menu.Saas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>

                 <?php if( Auth::user()->role_id == 1): ?>
                <?php echo $__env->make('menumanage::menu.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <?php endif; ?>

                <?php if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3): ?>

                    
                    <?php if(moduleStatusCheck('ParentRegistration') == true): ?>
                        <?php echo $__env->make('parentregistration::menu.ParentRegistration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <?php if(userPermission(11) && menuStatus(11)): ?>
                        <li data-position="<?php echo e(menuPosition(11)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-analytics"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('admin.admin_section'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled">
                                <?php if(userPermission(12) && menuStatus(12)): ?>
                                    <li data-position="<?php echo e(menuPosition(12)); ?>">
                                        <a href="<?php echo e(route('admission_query')); ?>"><?php echo app('translator')->get('admin.admission_query'); ?> </a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(16) && menuStatus(16)): ?>
                                    <li data-position="<?php echo e(menuPosition(16)); ?>">
                                        <a href="<?php echo e(route('visitor')); ?>"><?php echo app('translator')->get('admin.visitor_book'); ?> </a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(21) && menuStatus(21)): ?>
                                    <li data-position="<?php echo e(menuPosition(21)); ?>">
                                        <a href="<?php echo e(route('complaint')); ?>"><?php echo app('translator')->get('admin.complaint'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(27) && menuStatus(27)): ?>
                                    <li data-position="<?php echo e(menuPosition(27)); ?>">
                                        <a href="<?php echo e(route('postal-receive')); ?>"><?php echo app('translator')->get('admin.postal_receive'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(32) && menuStatus(32)): ?>
                                    <li data-position="<?php echo e(menuPosition(32)); ?>">
                                        <a href="<?php echo e(route('postal-dispatch')); ?>"><?php echo app('translator')->get('admin.postal_dispatch'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(36) && menuStatus(36)): ?>
                                    <li data-position="<?php echo e(menuPosition(36)); ?>">
                                        <a href="<?php echo e(route('phone-call')); ?>"><?php echo app('translator')->get('admin.phone_call_log'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(41) && menuStatus(41)): ?>
                                    <li data-position="<?php echo e(menuPosition(41)); ?>">
                                        <a href="<?php echo e(route('setup-admin')); ?>"><?php echo app('translator')->get('admin.admin_setup'); ?></a>
                                    </li>
                                <?php endif; ?>
                                    <?php if(userPermission(49) && menuStatus(49)): ?>
                                        <li data-position="<?php echo e(menuPosition(49)); ?>">
                                            <a href="<?php echo e(route('student-certificate')); ?>"><?php echo app('translator')->get('admin.student_certificate'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(53) && menuStatus(53)): ?>
                                        <li data-position="<?php echo e(menuPosition(53)); ?>">
                                            <a href="<?php echo e(route('generate_certificate')); ?>"><?php echo app('translator')->get('admin.generate_certificate'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php if(userPermission(45) && menuStatus(45)): ?>
                                    <li data-position="<?php echo e(menuPosition(45)); ?>">
                                        <a href="<?php echo e(route('student-id-card')); ?>"><?php echo app('translator')->get('admin.id_card'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(57) && menuStatus(57)): ?>
                                    <li data-position="<?php echo e(menuPosition(57)); ?>">
                                        <a href="<?php echo e(route('generate_id_card')); ?>"><?php echo app('translator')->get('admin.generate_id_card'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(moduleStatusCheck('Lead') == true): ?>
                        <?php if ($__env->exists('lead::menu.lead_menu')) echo $__env->make('lead::menu.lead_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    
                    <?php if(userPermission(61) && menuStatus(61)): ?>
                        <li data-position="<?php echo e(menuPosition(61)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-reading"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('student.student_information'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuStudent">
                                <?php if(userPermission(71) && menuStatus(71)): ?>
                                    <li data-position="<?php echo e(menuPosition(71)); ?>">
                                        <a href="<?php echo e(route('student_category')); ?>">
                                            <?php echo app('translator')->get('student.student_category'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(62) && menuStatus(62)): ?>
                                    <li data-position="<?php echo e(menuPosition(62)); ?>">
                                        <a href="<?php echo e(route('student_admission')); ?>"><?php echo app('translator')->get('student.add_student'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(64) && menuStatus(64)): ?>
                                    <li data-position="<?php echo e(menuPosition(64)); ?>">
                                        <a href="<?php echo e(route('student_list')); ?>"> <?php echo app('translator')->get('student.student_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(68) && menuStatus(68)): ?>
                                    <li data-position="<?php echo e(menuPosition(68)); ?>">
                                        <a href="<?php echo e(route('student_attendance')); ?>">
                                            <?php echo app('translator')->get('student.student_attendance'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(70) && menuStatus(70)): ?>
                                    <li data-position="<?php echo e(menuPosition(70)); ?>">
                                        <a href="<?php echo e(route('student_attendance_report')); ?>">
                                            <?php echo app('translator')->get('student.student_attendance_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(533) && menuStatus(533)): ?>
                                    <li data-position="<?php echo e(menuPosition(533)); ?>">
                                        <a href="<?php echo e(route('subject-wise-attendance')); ?>">
                                            <?php echo app('translator')->get('student.subject_wise_attendance'); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(535) && menuStatus(535)): ?>

                                    <li data-position="<?php echo e(menuPosition(535)); ?>">
                                        <a href="<?php echo e(url('subject-attendance-average-report')); ?>">
                                            <?php echo app('translator')->get('student.subject_attendance_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(76) && menuStatus(76)): ?>
                                    <li data-position="<?php echo e(menuPosition(76)); ?>">
                                        <a href="<?php echo e(route('student_group')); ?>"><?php echo app('translator')->get('student.student_group'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(81) && menuStatus(81)): ?>
                                    <li data-position="<?php echo e(menuPosition(81)); ?>">
                                        <a href="<?php echo e(route('student_promote')); ?>"><?php echo app('translator')->get('student.student_promote'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(83) && menuStatus(83)): ?>
                                    <li data-position="<?php echo e(menuPosition(83)); ?>">
                                        <a href="<?php echo e(route('disabled_student')); ?>"><?php echo app('translator')->get('student.disabled_student'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(663) && menuStatus(663)): ?>
                                    <li data-position="<?php echo e(menuPosition(663)); ?>">
                                        <a href="<?php echo e(route('all-student-export')); ?>"><?php echo app('translator')->get('student.student_export'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(950) && menuStatus(950)): ?>
                                    <li data-position="<?php echo e(menuPosition(950)); ?>">
                                        <a href="<?php echo e(route('notification_time_setup')); ?>"><?php echo app('translator')->get('student.sms_sending_time'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(951) && menuStatus(951)): ?>
                                    <li data-position="<?php echo e(menuPosition(951)); ?>">
                                        <a href="<?php echo e(route('student_settings')); ?>"><?php echo app('translator')->get('student.settings'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(245) && menuStatus(245)): ?>
                        <li data-position="<?php echo e(menuPosition(245)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-book"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('academics.academics'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuAcademic">
                                <?php if(userPermission(537) && menuStatus(537)): ?>
                                    <li data-position="<?php echo e(menuPosition(537)); ?>">
                                        <a href="<?php echo e(route('optional-subject')); ?>"> <?php echo app('translator')->get('academics.optional_subject'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(265) && menuStatus(265)): ?>
                                    <li data-position="<?php echo e(menuPosition(265)); ?>">
                                        <a href="<?php echo e(route('section')); ?>"> <?php echo app('translator')->get('common.section'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(261) && menuStatus(261)): ?>
                                    <li data-position="<?php echo e(menuPosition(261)); ?>">
                                        <a href="<?php echo e(route('class')); ?>"> <?php echo app('translator')->get('common.class'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(257) && menuStatus(257)): ?>
                                    <li data-position="<?php echo e(menuPosition(257)); ?>">
                                        <a href="<?php echo e(route('subject')); ?>"> <?php echo app('translator')->get('common.subjects'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(253) && menuStatus(253)): ?>
                                    <li data-position="<?php echo e(menuPosition(253)); ?>">
                                        <a href="<?php echo e(route('assign-class-teacher')); ?>">
                                            <?php echo app('translator')->get('academics.assign_class_teacher'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(250) && menuStatus(250)): ?>
                                    <li data-position="<?php echo e(menuPosition(250)); ?>">
                                        <a href="<?php echo e(route('assign_subject')); ?>"> <?php echo app('translator')->get('academics.assign_subject'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(269) && menuStatus(269)): ?>
                                    <li data-position="<?php echo e(menuPosition(269)); ?>">
                                        <a href="<?php echo e(route('class-room')); ?>"> <?php echo app('translator')->get('academics.class_room'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if(userPermission(246) && menuStatus(246)): ?>
                                    <li data-position="<?php echo e(menuPosition(246)); ?>">
                                        <a href="<?php echo e(route('class_routine')); ?>"> <?php echo app('translator')->get('academics.class_routine'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Auth::user()->role_id != 4): ?>
                                    <?php if(userPermission(387) && menuStatus(387)): ?>
                                        <li data-position="<?php echo e(menuPosition(387)); ?>">
                                            <a
                                                    href="<?php echo e(route('teacher_class_routine_report')); ?>"><?php echo app('translator')->get('academics.teacher_class_routine'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <!-- only for teacher -->
                                <?php if(Auth::user()->role_id == 4): ?>
                                    <li>
                                        <a
                                                href="<?php echo e(route('view-teacher-routine')); ?>"><?php echo app('translator')->get('academics.view_class_routine'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(87) && menuStatus(87)): ?>
                        <li data-position="<?php echo e(menuPosition(87)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-professor"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('study.study_material'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuTeacher">
                                <?php if(userPermission(88) && menuStatus(87)): ?>
                                    <li data-position="<?php echo e(menuPosition(88)); ?>">
                                        <a href="<?php echo e(route('upload-content')); ?>"> <?php echo app('translator')->get('study.upload_content'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(92) && menuStatus(92)): ?>
                                    <li data-position="<?php echo e(menuPosition(92)); ?>">
                                        <a href="<?php echo e(route('assignment-list')); ?>"><?php echo app('translator')->get('study.assignment'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(100) && menuStatus(100)): ?>
                                    <li data-position="<?php echo e(menuPosition(100)); ?>">
                                        <a href="<?php echo e(route('syllabus-list')); ?>"><?php echo app('translator')->get('study.syllabus'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(105) && menuStatus(105)): ?>
                                    <li data-position="<?php echo e(menuPosition(105)); ?>">
                                        <a href="<?php echo e(route('other-download-list')); ?>"><?php echo app('translator')->get('study.other_download'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(800) && menuStatus(800)): ?>
                        <li data-position="<?php echo e(menuPosition(800)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-professor"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('lesson::lesson.lesson_plan'); ?>
                                </div>
                            </a>

                            <ul class="list-unstyled" id="subMenuTeacherLesson">
                                <?php if(userPermission(801) && menuStatus(801)): ?>
                                    <li data-position="<?php echo e(menuPosition(801)); ?>">
                                        <a href="<?php echo e(route('lesson')); ?>"> <?php echo app('translator')->get('lesson::lesson.lesson'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(805) && menuStatus(805)): ?>
                                    <li data-position="<?php echo e(menuPosition(805)); ?>">
                                        <a href="<?php echo e(route('lesson.topic')); ?>"> <?php echo app('translator')->get('lesson::lesson.topic'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(809) && menuStatus(809)): ?>
                                    <li data-position="<?php echo e(menuPosition(809)); ?>">
                                        <a href="<?php echo e(route('topic-overview')); ?>">
                                            <?php echo app('translator')->get('lesson::lesson.topic_overview'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(810) && menuStatus(810)): ?>
                                    <li data-position="<?php echo e(menuPosition(810)); ?>">
                                        <a href="<?php echo e(route('lesson.lesson-planner')); ?>">
                                            <?php echo app('translator')->get('lesson::lesson.lesson_plan'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(815) && menuStatus(815)): ?>
                                    <li data-position="<?php echo e(menuPosition(815)); ?>">
                                        <a href="<?php echo e(route('lesson.lessonPlan-overiew')); ?>">
                                            <?php echo app('translator')->get('lesson::lesson.lesson_plan_overview'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(835) && menuStatus(835)): ?>
                                    <li data-position="<?php echo e(menuPosition(835)); ?>">
                                        <a href="<?php echo e(route('lesson.lessonPlan-setting')); ?>">
                                            <?php echo app('translator')->get('lesson::lesson.lesson_plan_setting'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Auth::user()->role_id == 4): ?>
                                    <li>
                                        <a href="<?php echo e(route('view-teacher-lessonPlan')); ?>"><?php echo app('translator')->get('lesson::lesson.my_lesson_plan'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                                href="<?php echo e(route('view-teacher-lessonPlan-overview')); ?>"><?php echo app('translator')->get('lesson::lesson.my_lesson_plan_overview'); ?></a>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </li>
                    <?php endif; ?>

                    


                    <?php if(moduleStatusCheck('FeesCollection') == true): ?>
                        <?php echo $__env->make('feescollection::menu.FeesCollection', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                       
                        <?php if(generalSetting()->fees_status == 0 || !moduleStatusCheck('Fees')): ?>
                            <?php if(userPermission(108) && menuStatus(108)): ?>
                                <li data-position="<?php echo e(menuPosition(108)); ?>" class="sortable_li">
                                    <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                        <div class="nav_icon_small">
                                            <span class="flaticon-wallet"></span>
                                        </div>
                                        <div class="nav_title">
                                            <?php echo app('translator')->get('fees.fees_collection'); ?>
                                        </div>
                                    </a>
                                    <ul class="list-unstyled" id="subMenuFeesCollection">
                                        <?php if(userPermission(123) && menuStatus(123)): ?>
                                            <li data-position="<?php echo e(menuPosition(123)); ?>">
                                                <a href="<?php echo e(route('fees_group')); ?>"> <?php echo app('translator')->get('fees.fees_group'); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(userPermission(127) && menuStatus(127)): ?>
                                            <li data-position="<?php echo e(menuPosition(127)); ?>">
                                                <a href="<?php echo e(route('fees_type')); ?>"> <?php echo app('translator')->get('fees.fees_type'); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(userPermission(131) && menuStatus(131)): ?>
                                            <li data-position="<?php echo e(menuPosition(131)); ?>">
                                                <a href="<?php echo e(route('fees-master')); ?>"> <?php echo app('translator')->get('fees.fees_master'); ?></a>
                                            </li>
                                        <?php endif; ?>


                                        <?php if(userPermission(118) && menuStatus(118)): ?>
                                            <li data-position="<?php echo e(menuPosition(118)); ?>">
                                                <a href="<?php echo e(route('fees_discount')); ?>"> <?php echo app('translator')->get('fees.fees_discount'); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(userPermission(109) && menuStatus(109)): ?>
                                            <li data-position="<?php echo e(menuPosition(109)); ?>">
                                                <a href="<?php echo e(route('collect_fees')); ?>"> <?php echo app('translator')->get('fees.collect_fees'); ?></a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if(userPermission(113) && menuStatus(113)): ?>
                                            <li data-position="<?php echo e(menuPosition(113)); ?>">
                                                <a href="<?php echo e(route('search_fees_payment')); ?>">
                                                    <?php echo app('translator')->get('fees.search_fees_payment'); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(userPermission(116) && menuStatus(116)): ?>
                                            <li data-position="<?php echo e(menuPosition(116)); ?>">
                                                <a href="<?php echo e(route('search_fees_due')); ?>">
                                                    <?php echo app('translator')->get('fees.search_fees_due'); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <a href="<?php echo e(route('bank-payment-slip')); ?>"> <?php echo app('translator')->get('fees.bank_payment'); ?></a>
                                        </li>

                                        <?php if(userPermission(136) && menuStatus(136)): ?>
                                            <li data-position="<?php echo e(menuPosition(136)); ?>">
                                                <a href="<?php echo e(route('fees_forward')); ?>"> <?php echo app('translator')->get('fees.fees_forward'); ?></a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if(userPermission(383) && menuStatus(383)): ?>
                                            <li data-position="<?php echo e(menuPosition(383)); ?>">
                                                <a
                                                        href="<?php echo e(route('transaction_report')); ?>"><?php echo app('translator')->get('fees.collection_report'); ?></a>
                                            </li>
                                        <?php endif; ?>

                                        
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(generalSetting()->fees_status == 1 && moduleStatusCheck('Fees')): ?>
                        <?php if ($__env->exists('fees::sidebar.adminSidebar')) echo $__env->make('fees::sidebar.adminSidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    

                    <?php if ($__env->exists('wallet::menu.sidebar')) echo $__env->make('wallet::menu.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php if(moduleStatusCheck('Lms')== true): ?>
                        <?php echo $__env->make('lms::menu.lms_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                  
                  


                    <?php if(moduleStatusCheck('BulkPrint') == true): ?>
                        <?php echo $__env->make('bulkprint::menu.bulk_print_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    
                    <?php if(userPermission(137) && menuStatus(137)): ?>
                        <li data-position="<?php echo e(menuPosition(137)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-accounting"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('accounts.accounts'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuAccount">
                                <?php if(userPermission(148) && menuStatus(148)): ?>
                                    <li data-position="<?php echo e(menuPosition(148)); ?>">
                                        <a href="<?php echo e(route('chart-of-account')); ?>">
                                            <?php echo app('translator')->get('accounts.chart_of_account'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(156) && menuStatus(156)): ?>
                                    <li data-position="<?php echo e(menuPosition(156)); ?>">
                                        <a href="<?php echo e(route('bank-account')); ?>"> <?php echo app('translator')->get('accounts.bank_account'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(139) && menuStatus(139)): ?>
                                    <li data-position="<?php echo e(menuPosition(139)); ?>">
                                        <a href="<?php echo e(route('add_income')); ?>"> <?php echo app('translator')->get('accounts.income'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(138) && menuStatus(138)): ?>
                                    <li data-position="<?php echo e(menuPosition(138)); ?>">
                                        <a href="<?php echo e(route('profit')); ?>"> <?php echo app('translator')->get('accounts.profit_&_loss'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(143) && menuStatus(143)): ?>
                                    <li data-position="<?php echo e(menuPosition(143)); ?>">
                                        <a href="<?php echo e(route('add-expense')); ?>"> <?php echo app('translator')->get('accounts.expense'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if(userPermission(704) && menuStatus(704)): ?>
                                    <li data-position="<?php echo e(menuPosition(704)); ?>">
                                        <a href="<?php echo e(route('fund-transfer')); ?>"><?php echo app('translator')->get('accounts.fund_transfer'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(700) && menuStatus(700)): ?>
                                    <?php
                                        $subMenuAccountReport = ['fine-report', 'accounts-payroll-report', 'transaction'];
                                        $subMenuAccount = array_merge(['lead.index'], $subMenuAccountReport);
                                    ?>
                                    <li data-position="<?php echo e(menuPosition(700)); ?>">
                                        <a href="javascript:void(0)"
                                           class="has-arrow <?php echo e(spn_nav_item_open($subMenuAccount, 'active')); ?>"
                                           aria-expanded="false">
                                            <?php echo app('translator')->get('reports.report'); ?>
                                        </a>
                                        <ul class="list-unstyled <?php echo e(spn_nav_item_open($subMenuAccount, 'show')); ?>"
                                            id="subMenuAccountReport">
                                            <?php if(userPermission(701) && menuStatus(701)): ?>
                                                <li>
                                                    <a href="<?php echo e(route('fine-report')); ?>">
                                                        <?php echo app('translator')->get('accounts.fine_report'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(userPermission(702) && menuStatus(702)): ?>
                                                <li>
                                                    <a href="<?php echo e(route('accounts-payroll-report')); ?>">
                                                        <?php echo app('translator')->get('accounts.payroll_report'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(userPermission(703) && menuStatus(703)): ?>
                                                <li>
                                                    <a href="<?php echo e(route('transaction')); ?>">
                                                        <?php echo app('translator')->get('accounts.transaction'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(userPermission(160) && menuStatus(160)): ?>
                        <li data-position="<?php echo e(menuPosition(160)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-consultation"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('hr.human_resource'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuHumanResource">
                                <?php if(userPermission(180) && menuStatus(180)): ?>
                                    <li data-position="<?php echo e(menuPosition(180)); ?>">
                                        <a href="<?php echo e(route('designation')); ?>"> <?php echo app('translator')->get('hr.designation'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(184) && menuStatus(184)): ?>
                                    <li data-position="<?php echo e(menuPosition(184)); ?>">
                                        <a href="<?php echo e(route('department')); ?>"> <?php echo app('translator')->get('hr.department'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(162) && menuStatus(162)): ?>
                                    <li data-position="<?php echo e(menuPosition(162)); ?>">
                                        <a href="<?php echo e(route('addStaff')); ?>"> <?php echo app('translator')->get('common.add_staff'); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(161) && menuStatus(161)): ?>
                                    <li data-position="<?php echo e(menuPosition(161)); ?>">
                                        <a href="<?php echo e(route('staff_directory')); ?>"> <?php echo app('translator')->get('hr.staff_directory'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(165) && menuStatus(162)): ?>
                                    <li data-position="<?php echo e(menuPosition(165)); ?>">
                                        <a href="<?php echo e(route('staff_attendance')); ?>"> <?php echo app('translator')->get('hr.staff_attendance'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(169) && menuStatus(169)): ?>
                                    <li data-position="<?php echo e(menuPosition(169)); ?>">
                                        <a href="<?php echo e(route('staff_attendance_report')); ?>">
                                            <?php echo app('translator')->get('hr.staff_attendance_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(170) && menuStatus(170)): ?>
                                    <li data-position="<?php echo e(menuPosition(170)); ?>">
                                        <a href="<?php echo e(route('payroll')); ?>"> <?php echo app('translator')->get('hr.payroll'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(178) && menuStatus(178)): ?>
                                    <li data-position="<?php echo e(menuPosition(178)); ?>">
                                        <a href="<?php echo e(route('payroll-report')); ?>"> <?php echo app('translator')->get('hr.payroll_report'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(952) && menuStatus(952)): ?>
                                <li data-position="<?php echo e(menuPosition(951)); ?>">
                                    <a href="<?php echo e(route('staff_settings')); ?>"><?php echo app('translator')->get('student.settings'); ?></a>
                                </li>
                            <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(188) && menuStatus(188)): ?>
                        <li data-position="<?php echo e(menuPosition(188)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-slumber"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('leave.leave'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuLeaveManagement">
                                <?php if(userPermission(203) && menuStatus(203)): ?>
                                    <li data-position="<?php echo e(menuPosition(203)); ?>">
                                        <a href="<?php echo e(route('leave-type')); ?>"> <?php echo app('translator')->get('leave.leave_type'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(199) && menuStatus(199)): ?>
                                    <li data-position="<?php echo e(menuPosition(199)); ?>">
                                        <a href="<?php echo e(route('leave-define')); ?>"> <?php echo app('translator')->get('leave.leave_define'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(189) && menuStatus(189)): ?>
                                    <li data-position="<?php echo e(menuPosition(189)); ?>">
                                        <a
                                                href="<?php echo e(route('approve-leave')); ?>"><?php echo app('translator')->get('leave.approve_leave_request'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(196) && menuStatus(196)): ?>
                                    <li data-position="<?php echo e(menuPosition(196)); ?>">
                                        <a
                                                href="<?php echo e(route('pending-leave')); ?>"><?php echo app('translator')->get('leave.pending_leave_request'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Auth::user()->role_id != 1): ?>

                                    <?php if(userPermission(193) && menuStatus(193)): ?>
                                        <li data-position="<?php echo e(menuPosition(193)); ?>">
                                            <a href="<?php echo e(route('apply-leave')); ?>"><?php echo app('translator')->get('leave.apply_leave'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(1100) && menuStatus(1100)): ?>
                        <li data-position="<?php echo e(menuPosition(1100)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-slumber"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('student.custom_field'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuCustomField">
                                <?php if(moduleStatusCheck('Lead') == true): ?>
                                    <?php if(userPermission(1441) && menuStatus(1441)): ?>
                                        <li data-position="<?php echo e(menuPosition(1441)); ?>">
                                            <a href="<?php echo e(route('lead.lead-reg-custom-field')); ?>">
                                                <?php echo app('translator')->get('lead::lead.lead_registration'); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if(userPermission(1101) && menuStatus(1101)): ?>
                                    <li data-position="<?php echo e(menuPosition(1101)); ?>">
                                        <a href="<?php echo e(route('student-reg-custom-field')); ?>">
                                            <?php echo app('translator')->get('student.student_registration'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(1105) && menuStatus(1105)): ?>
                                    <li data-position="<?php echo e(menuPosition(1105)); ?>">
                                        <a href="<?php echo e(route('staff-reg-custom-field')); ?>">
                                            <?php echo app('translator')->get('hr.staff_registration'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    

                    

                    <?php if(moduleStatusCheck('Chat') == true): ?>
                        <?php echo $__env->make('chat::menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    
                    <?php if(userPermission(207) && menuStatus(207)): ?>
                        <li data-position="<?php echo e(menuPosition(207)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-test"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('exam.examination'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuExam">
                                <?php if(userPermission(225) && menuStatus(225)): ?>
                                    <li data-position="<?php echo e(menuPosition(225)); ?>">
                                        <a href="<?php echo e(route('marks-grade')); ?>"> <?php echo app('translator')->get('exam.marks_grade'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if(userPermission(208) && menuStatus(208)): ?>
                                    <li data-position="<?php echo e(menuPosition(208)); ?>">
                                        <a href="<?php echo e(route('exam-type')); ?>"> <?php echo app('translator')->get('exam.exam_type'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(214) && menuStatus(214)): ?>
                                    <li data-position="<?php echo e(menuPosition(214)); ?>">
                                        <a href="<?php echo e(route('exam')); ?>"> <?php echo app('translator')->get('exam.exam_setup'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(217) && menuStatus(217)): ?>
                                    <li data-position="<?php echo e(menuPosition(217)); ?>">
                                        <a href="<?php echo e(route('exam_schedule')); ?>"> <?php echo app('translator')->get('exam.exam_schedule'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(221) && menuStatus(221)): ?>
                                    <li data-position="<?php echo e(menuPosition(221)); ?>">
                                        <a href="<?php echo e(route('exam_attendance')); ?>"> <?php echo app('translator')->get('exam.exam_attendance'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(222) && menuStatus(222)): ?>
                                    <li data-position="<?php echo e(menuPosition(222)); ?>">
                                        <a href="<?php echo e(route('marks_register')); ?>"> <?php echo app('translator')->get('exam.marks_register'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(229) && menuStatus(229)): ?>
                                    <li data-position="<?php echo e(menuPosition(229)); ?>">
                                        <a href="<?php echo e(route('send_marks_by_sms')); ?>">
                                            <?php echo app('translator')->get('exam.send_marks_by_sms'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if((userPermission(436) && menuStatus(436)) || (userPermission(706) && menuStatus(706))): ?>
                                    <?php
                                        $examSettings = ['custom-result-setting', 'exam-settings'];
                                        $subMenuExam = array_merge(['lead.index'], $examSettings);
                                    ?>
                                    <li>
                                        <a href="javascript:void(0)"
                                           class="has-arrow <?php echo e(spn_nav_item_open($subMenuExam, 'active')); ?>"
                                           aria-expanded="false">
                                            <?php echo app('translator')->get('exam.settings'); ?>
                                        </a>
                                        <ul class="list-unstyled <?php echo e(spn_nav_item_open($subMenuExam, 'show')); ?>"
                                            id="examSettings">
                                            <?php if(userPermission(436) && menuStatus(436)): ?>
                                                <li data-position="<?php echo e(menuPosition(436)); ?>">
                                                    <a
                                                            href="<?php echo e(route('custom-result-setting')); ?>"><?php echo app('translator')->get('exam.setup_exam_rule'); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(userPermission(706) && menuStatus(706)): ?>
                                                <li data-position="<?php echo e(menuPosition(706)); ?>">
                                                    <a
                                                            href="<?php echo e(route('exam-settings')); ?>"><?php echo app('translator')->get('exam.format_settings'); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </li>
                    <?php endif; ?>

                    


                    
                    <?php if(moduleStatusCheck('ExamPlan')): ?>
                    <?php echo $__env->make('examplan::menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                     

                    <?php if(moduleStatusCheck('OnlineExam') == true): ?>
                        <?php echo $__env->make('onlineexam::menu_onlineexam', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php if(userPermission(875) && menuStatus(875)): ?>
                            <li data-position="<?php echo e(menuPosition(875)); ?>" class="sortable_li">
                                <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                    <div class="nav_icon_small">
                                        <span class="flaticon-book-1"></span>
                                    </div>
                                    <div class="nav_title">
                                        <?php echo app('translator')->get('exam.online_exam'); ?>
                                    </div>
                                </a>
                                <ul class="list-unstyled" id="subMenuOnlineExam">
                                    <?php if(userPermission(230) && menuStatus(230)): ?>
                                        <li data-position="<?php echo e(menuPosition(230)); ?>">
                                            <a href="<?php echo e(route('question-group')); ?>"><?php echo app('translator')->get('exam.question_group'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(234) && menuStatus(234)): ?>
                                        <li data-position="<?php echo e(menuPosition(234)); ?>">
                                            <a href="<?php echo e(route('question-bank')); ?>"><?php echo app('translator')->get('exam.question_bank'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(238) && menuStatus(238)): ?>
                                        <li data-position="<?php echo e(menuPosition(238)); ?>">
                                            <a href="<?php echo e(route('online-exam')); ?>"><?php echo app('translator')->get('exam.online_exam'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    
                    <?php if(userPermission(277) && menuStatus(277)): ?>
                        <li data-position="<?php echo e(menuPosition(277)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-book"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('homework.home_work'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuHomework">
                                <?php if(userPermission(278) && menuStatus(278)): ?>
                                    <li data-position="<?php echo e(menuPosition(278)); ?>">
                                        <a href="<?php echo e(route('add-homeworks')); ?>"> <?php echo app('translator')->get('homework.add_homework'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(280) && menuStatus(280)): ?>
                                    <li data-position="<?php echo e(menuPosition(280)); ?>">
                                        <a href="<?php echo e(route('homework-list')); ?>"> <?php echo app('translator')->get('homework.homework_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(284) && menuStatus(284)): ?>
                                    <li data-position="<?php echo e(menuPosition(284)); ?>">
                                        <a href="<?php echo e(route('evaluation-report')); ?>">
                                            <?php echo app('translator')->get('homework.evaluation_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(userPermission(286) && menuStatus(286)): ?>
                        <li data-position="<?php echo e(menuPosition(286)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-email"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('communicate.communicate'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuCommunicate">
                                <?php if(userPermission(287) && menuStatus(287)): ?>
                                    <li data-position="<?php echo e(menuPosition(287)); ?>">
                                        <a href="<?php echo e(route('notice-list')); ?>"><?php echo app('translator')->get('communicate.notice_board'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(moduleStatusCheck('Saas') == true && Auth::user()->is_administrator != 'yes'): ?>
                                    <li>
                                        <a
                                                href="<?php echo e(route('administrator-notice')); ?>"><?php echo app('translator')->get('communicate.administrator_notice'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(291) && menuStatus(291)): ?>
                                    <li data-position="<?php echo e(menuPosition(291)); ?>">
                                        <a
                                                href="<?php echo e(route('send-email-sms-view')); ?>"><?php echo app('translator')->get('communicate.send_email_\/_sms'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(293) && menuStatus(293)): ?>
                                    <li data-position="<?php echo e(menuPosition(293)); ?>">
                                        <a href="<?php echo e(route('email-sms-log')); ?>"><?php echo app('translator')->get('communicate.email_sms_log'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(294) && menuStatus(294)): ?>
                                    <li data-position="<?php echo e(menuPosition(294)); ?>">
                                        <a href="<?php echo e(route('event')); ?>"><?php echo app('translator')->get('communicate.event'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if(userPermission(710) && menuStatus(710)): ?>
                                    <li data-position="<?php echo e(menuPosition(710)); ?>">
                                        <a
                                                href="<?php echo e(route('templatesettings.sms-template')); ?>"><?php echo app('translator')->get('communicate.sms_template'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(480) && menuStatus(480)): ?>
                                    <li data-position="<?php echo e(menuPosition(480)); ?>">
                                        <a href="<?php echo e(route('templatesettings.email-template')); ?>">
                                            <?php echo app('translator')->get('communicate.email_template'); ?>
                                        </a>
                                    </li>
                                    
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(298) && menuStatus(298)): ?>
                        <li data-position="<?php echo e(menuPosition(298)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-book-1"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('library.library'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenulibrary">
                                <?php if(userPermission(304) && menuStatus(304)): ?>
                                    <li data-position="<?php echo e(menuPosition(304)); ?>">
                                        <a href="<?php echo e(route('book-category-list')); ?>">
                                            <?php echo app('translator')->get('library.book_category'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(579) && menuStatus(579)): ?>
                                    <li data-position="<?php echo e(menuPosition(529)); ?>">
                                        <a href="<?php echo e(route('library_subject')); ?>"> <?php echo app('translator')->get('library.subject'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(299) && menuStatus(299)): ?>
                                    <li data-position="<?php echo e(menuPosition(299)); ?>">
                                        <a href="<?php echo e(route('add-book')); ?>"> <?php echo app('translator')->get('library.add_book'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(301) && menuStatus(301)): ?>
                                    <li data-position="<?php echo e(menuPosition(301)); ?>">
                                        <a href="<?php echo e(route('book-list')); ?>"> <?php echo app('translator')->get('library.book_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(308) && menuStatus(308)): ?>
                                    <li data-position="<?php echo e(menuPosition(308)); ?>">
                                        <a href="<?php echo e(route('library-member')); ?>"> <?php echo app('translator')->get('library.library_member'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(311) && menuStatus(311)): ?>
                                    <li data-position="<?php echo e(menuPosition(311)); ?>">
                                        <a href="<?php echo e(route('member-list')); ?>"> <?php echo app('translator')->get('library.member_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(314) && menuStatus(314)): ?>
                                    <li data-position="<?php echo e(menuPosition(314)); ?>">
                                        <a href="<?php echo e(route('all-issed-book')); ?>"> <?php echo app('translator')->get('library.all_issued_book'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(315) && menuStatus(315)): ?>
                        <li data-position="<?php echo e(menuPosition(315)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-inventory"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('inventory.inventory'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuInventory">
                                <?php if(userPermission(316) && menuStatus(316)): ?>
                                    <li data-position="<?php echo e(menuPosition(316)); ?>">
                                        <a href="<?php echo e(route('item-category')); ?>"> <?php echo app('translator')->get('inventory.item_category'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(320) && menuStatus(320)): ?>
                                    <li data-position="<?php echo e(menuPosition(320)); ?>">
                                        <a href="<?php echo e(route('item-list')); ?>"> <?php echo app('translator')->get('inventory.item_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(324) && menuStatus(324)): ?>
                                    <li data-position="<?php echo e(menuPosition(324)); ?>">
                                        <a href="<?php echo e(route('item-store')); ?>"> <?php echo app('translator')->get('inventory.item_store'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(328) && menuStatus(328)): ?>
                                    <li data-position="<?php echo e(menuPosition(328)); ?>">
                                        <a href="<?php echo e(route('suppliers')); ?>"> <?php echo app('translator')->get('inventory.supplier'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(332) && menuStatus(332)): ?>
                                    <li data-position="<?php echo e(menuPosition(332)); ?>">
                                        <a href="<?php echo e(route('item-receive')); ?>"> <?php echo app('translator')->get('inventory.item_receive'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(334) && menuStatus(334)): ?>
                                    <li data-position="<?php echo e(menuPosition(334)); ?>">
                                        <a href="<?php echo e(route('item-receive-list')); ?>">
                                            <?php echo app('translator')->get('inventory.item_receive_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(339) && menuStatus(339)): ?>
                                    <li data-position="<?php echo e(menuPosition(339)); ?>">
                                        <a href="<?php echo e(route('item-sell-list')); ?>"> <?php echo app('translator')->get('inventory.item_sell'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(345) && menuStatus(345)): ?>
                                    <li data-position="<?php echo e(menuPosition(345)); ?>">
                                        <a href="<?php echo e(route('item-issue')); ?>"> <?php echo app('translator')->get('inventory.item_issue'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(348) && menuStatus(348)): ?>
                        <li data-position="<?php echo e(menuPosition(348)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-bus"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('transport.transport'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuTransport">
                                <?php if(userPermission(349) && menuStatus(349)): ?>
                                    <li data-position="<?php echo e(menuPosition(349)); ?>">
                                        <a href="<?php echo e(route('transport-route')); ?>"> <?php echo app('translator')->get('transport.routes'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(353) && menuStatus(353)): ?>
                                    <li data-position="<?php echo e(menuPosition(353)); ?>">
                                        <a href="<?php echo e(route('vehicle')); ?>"> <?php echo app('translator')->get('transport.vehicle'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(357) && menuStatus(357)): ?>
                                    <li data-position="<?php echo e(menuPosition(357)); ?>">
                                        <a href="<?php echo e(route('assign-vehicle')); ?>"> <?php echo app('translator')->get('transport.assign_vehicle'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(361) && menuStatus(361)): ?>
                                    <li data-position="<?php echo e(menuPosition(361)); ?>">
                                        <a href="<?php echo e(route('student_transport_report')); ?>">
                                            <?php echo app('translator')->get('transport.student_transport_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(362) && menuStatus(362)): ?>
                        <li data-position="<?php echo e(menuPosition(362)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-hotel"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('dormitory.dormitory'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuDormitory">
                                <?php if(userPermission(371) && menuStatus(371)): ?>
                                    <li data-position="<?php echo e(menuPosition(371)); ?>">
                                        <a href="<?php echo e(route('room-type')); ?>"> <?php echo app('translator')->get('dormitory.room_type'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(367) && menuStatus(367)): ?>
                                    <li data-position="<?php echo e(menuPosition(367)); ?>">
                                        <a href="<?php echo e(route('dormitory-list')); ?>"> <?php echo app('translator')->get('dormitory.dormitory'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(363) && menuStatus(363)): ?>
                                    <li data-position="<?php echo e(menuPosition(363)); ?>">
                                        <a href="<?php echo e(route('room-list')); ?>"> <?php echo app('translator')->get('dormitory.dormitory_rooms'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(375) && menuStatus(375)): ?>
                                    <li data-position="<?php echo e(menuPosition(375)); ?>">
                                        <a href="<?php echo e(route('student_dormitory_report')); ?>">
                                            <?php echo app('translator')->get('dormitory.student_dormitory_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(376) && menuStatus(376)): ?>
                        <li data-position="<?php echo e(menuPosition(376)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-analysis"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('reports.reports'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenusystemReports">
                                <?php if(userPermission(538) && menuStatus(538)): ?>
                                    <li data-position="<?php echo e(menuPosition(538)); ?>">
                                        <a href="<?php echo e(route('student_report')); ?>"><?php echo app('translator')->get('reports.student_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(377) && menuStatus(377)): ?>
                                    <li data-position="<?php echo e(menuPosition(377)); ?>">
                                        <a href="<?php echo e(route('guardian_report')); ?>"><?php echo app('translator')->get('reports.guardian_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(378) && menuStatus(378)): ?>
                                    <li data-position="<?php echo e(menuPosition(378)); ?>">
                                        <a href="<?php echo e(route('student_history')); ?>"><?php echo app('translator')->get('reports.student_history'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(379) && menuStatus(379)): ?>
                                    <li data-position="<?php echo e(menuPosition(379)); ?>">
                                        <a
                                                href="<?php echo e(route('student_login_report')); ?>"><?php echo app('translator')->get('reports.student_login_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(!generalSetting()->fees_status): ?>
                                    <?php if(userPermission(381) && menuStatus(381)): ?>
                                        <li data-position="<?php echo e(menuPosition(381)); ?>">
                                            <a
                                                    href="<?php echo e(route('fees_statement')); ?>"><?php echo app('translator')->get('reports.fees_statement'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(userPermission(382) && menuStatus(382)): ?>
                                        <li data-position="<?php echo e(menuPosition(382)); ?>">
                                            <a
                                                    href="<?php echo e(route('balance_fees_report')); ?>"><?php echo app('translator')->get('reports.balance_fees_report'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if(userPermission(384) && menuStatus(384)): ?>
                                    <li data-position="<?php echo e(menuPosition(384)); ?>">
                                        <a href="<?php echo e(route('class_report')); ?>"><?php echo app('translator')->get('reports.class_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(385) && menuStatus(385)): ?>
                                    <li data-position="<?php echo e(menuPosition(385)); ?>">
                                        <a
                                                href="<?php echo e(route('class_routine_report')); ?>"><?php echo app('translator')->get('reports.class_routine'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(386) && menuStatus(386)): ?>
                                    <li data-position="<?php echo e(menuPosition(386)); ?>">
                                        <a href="<?php echo e(route('exam_routine_report')); ?>"><?php echo app('translator')->get('reports.exam_routine'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(388) && menuStatus(388)): ?>
                                    <li data-position="<?php echo e(menuPosition(388)); ?>">
                                        <a
                                                href="<?php echo e(route('merit_list_report')); ?>"><?php echo app('translator')->get('reports.merit_list_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if(userPermission(389) && menuStatus(389)): ?>
                                    <li data-position="<?php echo e(menuPosition(389)); ?>">
                                        <a
                                                href="<?php echo e(route('online_exam_report')); ?>"><?php echo app('translator')->get('reports.online_exam_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(390) && menuStatus(390)): ?>
                                    <li data-position="<?php echo e(menuPosition(390)); ?>">
                                        <a
                                                href="<?php echo e(route('mark_sheet_report_student')); ?>"><?php echo app('translator')->get('reports.mark_sheet_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(391) && menuStatus(391)): ?>
                                    <li data-position="<?php echo e(menuPosition(391)); ?>">
                                        <a
                                                href="<?php echo e(route('tabulation_sheet_report')); ?>"><?php echo app('translator')->get('reports.tabulation_sheet_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(392) && menuStatus(392)): ?>
                                    <li data-position="<?php echo e(menuPosition(392)); ?>">
                                        <a
                                                href="<?php echo e(route('progress_card_report')); ?>"><?php echo app('translator')->get('reports.progress_card_report'); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php if(userPermission(394) && menuStatus(394)): ?>
                                    <li data-position="<?php echo e(menuPosition(394)); ?>">
                                        <a href="<?php echo e(route('user_log')); ?>"><?php echo app('translator')->get('reports.user_log'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(539) && menuStatus(539)): ?>
                                    <li data-position="<?php echo e(menuPosition(539)); ?>">
                                        <a href="<?php echo e(route('previous-class-results')); ?>"><?php echo app('translator')->get('reports.previous_result'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(540) && menuStatus(540)): ?>
                                    <li data-position="<?php echo e(menuPosition(540)); ?>">
                                        <a href="<?php echo e(route('previous-record')); ?>"><?php echo app('translator')->get('reports.previous_record'); ?> </a>
                                    </li>
                                <?php endif; ?>
								

                                   <!-- student Log -->

                                <li data-position="">
                                    <a href="<?php echo e(url('student-log')); ?>">Student Log</a>
                                </li>

                                <!-- end student Log -->


                                
                                <?php if(Auth::user()->role_id == 1): ?>
                                    <?php if(moduleStatusCheck('ResultReports') == true): ?>
                                        
                                        <li>
                                            <a
                                                    href="<?php echo e(route('resultreports/cumulative-sheet-report')); ?>"><?php echo app('translator')->get('reports.cumulative_sheet_report'); ?></a>
                                        </li>
                                        <li>
                                            <a
                                                    href="<?php echo e(route('resultreports/continuous-assessment-report')); ?>"><?php echo app('translator')->get('lang.contonuous_assessment_report'); ?></a>
                                        </li>
                                        <li>
                                            <a
                                                    href="<?php echo e(route('resultreports/termly-academic-report')); ?>"><?php echo app('translator')->get('lang.termly_academic_report'); ?></a>
                                        </li>
                                        <li>
                                            <a
                                                    href="<?php echo e(route('resultreports/academic-performance-report')); ?>"><?php echo app('translator')->get('lang.academic_performance_report'); ?></a>
                                        </li>
                                        <li>
                                            <a
                                                    href="<?php echo e(route('resultreports/terminal-report-sheet')); ?>"><?php echo app('translator')->get('lang.terminal_report_sheet'); ?></a>
                                        </li>
                                        <li>
                                            <a
                                                    href="<?php echo e(route('resultreports/continuous-assessment-sheet')); ?>"><?php echo app('translator')->get('lang.continuous_assessment_sheet'); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('resultreports/result-version-two')); ?>"><?php echo app('translator')->get('lang.result_version'); ?>
                                                V2</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('resultreports/result-version-three')); ?>"><?php echo app('translator')->get('lang.result_version'); ?>
                                                V3
                                            </a>
                                        </li>
                                        
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(417) && menuStatus(417)): ?>
                        <li data-position="<?php echo e(menuPosition(417)); ?>" class="sortable_li">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-authentication"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('rolepermission::role.role_&_permission'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenuUserManagement">
                                <?php if(userPermission(585) && menuStatus(585)): ?>
                                    <li data-position="<?php echo e(menuPosition(585)); ?>">
                                        <a
                                                href="<?php echo e(route('rolepermission/role')); ?>"><?php echo app('translator')->get('rolepermission::role.role'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(421) && menuStatus(421)): ?>
                                    <li data-position="<?php echo e(menuPosition(421)); ?>">
                                        <a
                                                href="<?php echo e(route('login-access-control')); ?>"><?php echo app('translator')->get('rolepermission::role.login_permission'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(userPermission(398) && menuStatus(398)): ?>
                        <li data-position="<?php echo e(menuPosition(398)); ?>" class="sortable_li metis_submenu_up_collaspe">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-settings"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('system_settings.system_settings'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenusystemSettings">

                                <?php if(moduleStatusCheck('Saas') == true && auth()->user()->is_administrator == 'yes'): ?>
                                    <?php if(userPermission(405) && menuStatus(405)): ?>
                                        <li data-position="<?php echo e(menuPosition(405)); ?>">
                                            <a href="<?php echo e(route('school-general-settings')); ?>">
                                                <?php echo app('translator')->get('system_settings.general_settings'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if(userPermission(405) && menuStatus(405)): ?>

                                        <li data-position="<?php echo e(menuPosition(405)); ?>">
                                            <a href="<?php echo e(route('general-settings')); ?>">
                                                <?php echo app('translator')->get('system_settings.general_settings'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                
                                <?php if(userPermission(424)  && menuStatus(424)): ?>
                                    <li data-position="<?php echo e(menuPosition(424)); ?>">
                                        <a href="<?php echo e(route('class_optional')); ?>"><?php echo app('translator')->get('system_settings.optional_subject'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(121) && menuStatus(121)): ?>
                                    
                                <?php endif; ?>

                                <?php if(userPermission(432) && menuStatus(432)): ?>
                                    <li data-position="<?php echo e(menuPosition(432)); ?>">
                                        <a href="<?php echo e(route('academic-year')); ?>"><?php echo app('translator')->get('common.academic_year'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(440) && menuStatus(440)): ?>
                                    <li data-position="<?php echo e(menuPosition(440)); ?>">
                                        <a href="<?php echo e(route('holiday')); ?>"><?php echo app('translator')->get('system_settings.holiday'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(401) && menuStatus(401)): ?>
                                    <li data-position="<?php echo e(menuPosition(401)); ?>">
                                        <a
                                                href="<?php echo e(route('manage-currency')); ?>"><?php echo app('translator')->get('system_settings.manage_currency'); ?></a>
                                    </li>
                                <?php endif; ?>


                                


                                <?php if(userPermission(448) && menuStatus(448)): ?>
                                    <li data-position="<?php echo e(menuPosition(448)); ?>">
                                        <a href="<?php echo e(url('weekend')); ?>"><?php echo app('translator')->get('system_settings.weekend'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(451) && menuStatus(451)): ?>

                                    <li data-position="<?php echo e(menuPosition(451)); ?>">
                                        <a
                                                href="<?php echo e(route('language-settings')); ?>"><?php echo app('translator')->get('system_settings.language_settings'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(463) && menuStatus(463)): ?>
                                    <li data-position="<?php echo e(menuPosition(463)); ?>">
                                        <a href="<?php echo e(route('button-disable-enable')); ?>"><?php echo app('translator')->get('system_settings.dashboard_setup'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>


                                <?php if(userPermission(412) && menuStatus(412)): ?>
                                    <li data-position="<?php echo e(menuPosition(412)); ?>">
                                        <a
                                                href="<?php echo e(route('payment-method-settings')); ?>"><?php echo app('translator')->get('system_settings.payment_settings'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(410) && menuStatus(410)): ?>

                                    <li data-position="<?php echo e(menuPosition(410)); ?>">
                                        <a
                                                href="<?php echo e(route('email-settings')); ?>"><?php echo app('translator')->get('system_settings.email_settings'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(444) && menuStatus(444)): ?>

                                    <li data-position="<?php echo e(menuPosition(444)); ?>">
                                        <a
                                                href="<?php echo e(route('sms-settings')); ?>"><?php echo app('translator')->get('system_settings.sms_settings'); ?></a>
                                    </li>
                                <?php endif; ?>
								

                                    <!-- google drive backup -->

                                <li data-position="">
                                    <a href="<?php echo e(url('google-backup')); ?>">google backup</a>
                                </li>

                                <!-- end google drive backup -->


								
                                <?php if(userPermission(2200) && menuStatus(2200)): ?>
                                    <li data-position="<?php echo e(menuPosition(2200)); ?>">
                                        <a href="<?php echo e(route('setting.preloader')); ?>"><?php echo app('translator')->get('system_settings.Preloader Settings'); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(moduleStatusCheck('Saas') and config('app.allow_custom_domain')): ?>
                                    <li>
                                        <a
                                                href="<?php echo e(route('saas.custom-domain')); ?>"><?php echo app('translator')->get('saas::saas.custom_domain'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(moduleStatusCheck('Saas')): ?>
                                    <?php if(userPermission(486) && menuStatus(486)): ?>
                                        <li data-position="<?php echo e(menuPosition(486)); ?>">
                                            <a
                                                    href="<?php echo e(route('background-setting')); ?>"><?php echo app('translator')->get('style.background_settings'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                
                                <?php if(moduleStatusCheck('Saas') == false): ?>
                                    <?php echo $__env->make('backEnd.partials.without_saas_school_admin_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    
                    <?php if(userPermission(485) && menuStatus(485)): ?>
                        <li data-position="<?php echo e(menuPosition(485)); ?>" class="sortable_li metis_submenu_up_collaspe">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-consultation"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('style.style'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenusystemStyle">
                                <?php if(userPermission(486) && menuStatus(486)): ?>
                                    <li data-position="<?php echo e(menuPosition(486)); ?>">
                                        <a
                                                href="<?php echo e(route('background-setting')); ?>"><?php echo app('translator')->get('style.background_settings'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(490) && menuStatus(490)): ?>
                                    <li data-position="<?php echo e(menuPosition(490)); ?>">
                                        <a href="<?php echo e(route('color-style')); ?>"><?php echo app('translator')->get('style.color_theme'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    

                    
                    
                    <?php if(userPermission(492) && menuStatus(492)): ?>
                        <li data-position="<?php echo e(menuPosition(492)); ?>" class="sortable_li metis_submenu_up_collaspe">
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-software"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('front_settings.front_settings'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="subMenufrontEndSettings">
                                <?php if(userPermission(650) && menuStatus(650)): ?>
                                    <li data-position="<?php echo e(menuPosition(650)); ?>">
                                        <a
                                                href="<?php echo e(route('header-menu-manager')); ?>"><?php echo app('translator')->get('front_settings.header_menu_manager'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(493) && menuStatus(493)): ?>
                                    <li data-position="<?php echo e(menuPosition(498)); ?>">
                                        <a href="<?php echo e(route('admin-home-page')); ?>"> <?php echo app('translator')->get('front_settings.home_page'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(523) && menuStatus(523)): ?>
                                    <li data-position="<?php echo e(menuPosition(528)); ?>">
                                        <a
                                                href="<?php echo e(route('news-heading-update')); ?>"><?php echo app('translator')->get('front_settings.news_heading'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(500) && menuStatus(500)): ?>
                                    <li data-position="<?php echo e(menuPosition(500)); ?>">
                                        <a href="<?php echo e(route('news-category')); ?>"><?php echo app('translator')->get('front_settings.news'); ?>
                                            <?php echo app('translator')->get('student.category'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(moduleStatusCheck('AppSlider') == true): ?>
                                    <?php if(userPermission(930) && menuStatus(930)): ?>
                                        <li data-position="<?php echo e(menuPosition(930)); ?>">
                                            <a
                                                    href="<?php echo e(route('appslider.index')); ?>"><?php echo app('translator')->get('front_settings.app_slider'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if(userPermission(495) && menuStatus(495)): ?>
                                    <li data-position="<?php echo e(menuPosition(495)); ?>">
                                        <a href="<?php echo e(route('news_index')); ?>"><?php echo app('translator')->get('front_settings.news_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(525) && menuStatus(525)): ?>
                                    <li data-position="<?php echo e(menuPosition(525)); ?>">
                                        <a
                                                href="<?php echo e(route('course-heading-update')); ?>"><?php echo app('translator')->get('front_settings.course_heading'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(525) && menuStatus(525)): ?>
                                    <li data-position="<?php echo e(menuPosition(525)); ?>">
                                        <a
                                                href="<?php echo e(route('course-details-heading')); ?>"><?php echo app('translator')->get('front_settings.course_details_heading'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(673) && menuStatus(673)): ?>
                                    <li data-position="<?php echo e(menuPosition(673)); ?>">
                                        <a
                                                href="<?php echo e(route('course-category')); ?>"><?php echo app('translator')->get('front_settings.course_category'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(509) && menuStatus(509)): ?>
                                    <li data-position="<?php echo e(menuPosition(509)); ?>">
                                        <a href="<?php echo e(route('course-list')); ?>"><?php echo app('translator')->get('front_settings.course_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(504) && menuStatus(504)): ?>
                                    <li data-position="<?php echo e(menuPosition(504)); ?>">
                                        <a
                                                href="<?php echo e(route('testimonial_index')); ?>"><?php echo app('translator')->get('front_settings.testimonial'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(514) && menuStatus(514)): ?>
                                    <li data-position="<?php echo e(menuPosition(514)); ?>">
                                        <a href="<?php echo e(route('conpactPage')); ?>"><?php echo app('translator')->get('front_settings.contact_page'); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(517) && menuStatus(517)): ?>
                                    <li data-position="<?php echo e(menuPosition(517)); ?>">
                                        <a
                                                href="<?php echo e(route('contactMessage')); ?>"><?php echo app('translator')->get('front_settings.contact_message'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(520) && menuStatus(520)): ?>
                                    <li data-position="<?php echo e(menuPosition(520)); ?>">
                                        <a href="<?php echo e(route('about-page')); ?>"> <?php echo app('translator')->get('front_settings.about_us'); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(529) && menuStatus(529)): ?>
                                    <li data-position="<?php echo e(menuPosition(529)); ?>">
                                        <a href="<?php echo e(route('social-media')); ?>"> <?php echo app('translator')->get('front_settings.social_media'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(654) && menuStatus(654)): ?>
                                    <li data-position="<?php echo e(menuPosition(654)); ?>">
                                        <a href="<?php echo e(route('page-list')); ?>"><?php echo app('translator')->get('front_settings.pages'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(527) && menuStatus(527)): ?>
                                    <li data-position="<?php echo e(menuPosition(527)); ?>">
                                        <a href="<?php echo e(route('custom-links')); ?>"> <?php echo app('translator')->get('front_settings.footer_widget'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    

                    
                    <?php if(moduleStatusCheck('Saas') == true && Auth::user()->is_administrator != 'yes'): ?>
                        <li>
                            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                                <div class="nav_icon_small">
                                    <span class="flaticon-settings"></span>
                                </div>
                                <div class="nav_title">
                                    <?php echo app('translator')->get('saas::saas.ticket_system'); ?>
                                </div>
                            </a>
                            <ul class="list-unstyled" id="Ticket">
                                <li>
                                    <a href="<?php echo e(route('school/ticket-view')); ?>"><?php echo app('translator')->get('saas::saas.ticket_list'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                <!-- Zoom Menu -->
                    <?php if(moduleStatusCheck('Zoom') == true): ?>
                        <?php echo $__env->make('zoom::menu.Zoom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                <!-- Zoom Menu -->
                    <?php if(moduleStatusCheck('GoogleMeet') == true): ?>

                        <?php echo $__env->make('googlemeet::menu.google_meet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                <!-- BBB Menu -->
                    <?php if(moduleStatusCheck('BBB') == true): ?>
                        <?php echo $__env->make('bbb::menu.bigbluebutton_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                <!-- Jitsi Menu -->
                    <?php if(moduleStatusCheck('Jitsi') == true): ?>
                        <?php echo $__env->make('jitsi::menu.jitsi_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>



                <?php endif; ?>

            <!-- Student Panel -->
                <?php if(Auth::user()->role_id == 2): ?>
                    <?php echo $__env->make('backEnd/partials/student_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

            <!-- Parents Panel Menu -->
                <?php if(Auth::user()->role_id == 3): ?>
                    <?php echo $__env->make('backEnd/partials/parents_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
</nav>
<!-- sidebar part end -->
 <?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/partials/sidebar.blade.php ENDPATH**/ ?>