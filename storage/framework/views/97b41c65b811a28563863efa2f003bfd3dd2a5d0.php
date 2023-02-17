<?php if(userPermission(1) && menuStatus(1)): ?>
    <li data-position="<?php echo e(menuPosition(1)); ?>" class="sortable_li">
        <a href="<?php echo e(route('student-dashboard')); ?>">
            <div class="nav_icon_small">
                <span class="flaticon-resume"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('common.dashboard'); ?>
                </div>
        </a>
    </li>
<?php endif; ?>
<?php if(userPermission(11) && menuStatus(11)): ?>
    <li data-position="<?php echo e(menuPosition(11)); ?>" class="sortable_li">
        <a href="<?php echo e(route('student-profile')); ?>">
            
            <div class="nav_icon_small">
                <span class="flaticon-resume"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('student.my_profile'); ?>
                </div>
        </a>
    </li>
<?php endif; ?>
<?php if(generalSetting()->fees_status == 0): ?>
    <?php if(userPermission(20) && menuStatus(20)): ?>
        <li data-position="<?php echo e(menuPosition(20)); ?>" class="sortable_li">
            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">                
                
                <div class="nav_icon_small">
                    <span class="flaticon-wallet"></span>
                    </div>
                    <div class="nav_title">
                        <?php echo app('translator')->get('fees.fees'); ?>
                    </div>
            </a>
            <ul class="list-unstyled" >
                <?php if(moduleStatusCheck('FeesCollection')== false ): ?>
                    <li data-position="<?php echo e(menuPosition(21)); ?>">
                        <a href="<?php echo e(route('student_fees')); ?>"><?php echo app('translator')->get('fees.pay_fees'); ?></a>
                    </li>
                <?php else: ?>
                    <li data-position="<?php echo e(menuPosition(21)); ?>">
                        <a href="<?php echo e(route('feescollection/student-fees')); ?>"><?php echo app('translator')->get('fees.pay_fees'); ?></a>
                    </li>

                <?php endif; ?>
            </ul>
        </li>
    <?php endif; ?>
<?php endif; ?>

<?php if(generalSetting()->fees_status == 1): ?>
    <?php if ($__env->exists('fees::sidebar.feesStudentSidebar')) echo $__env->make('fees::sidebar.feesStudentSidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>



<?php if(moduleStatusCheck('Lms') == true): ?>
    <?php if(userPermission(1500) && menuStatus(1500)): ?>
        <li data-position="<?php echo e(menuPosition(1500)); ?>" class="sortable_li">
            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                <div class="nav_icon_small">
                    <span class="flaticon-reading"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('lms::lms.lms'); ?>
                </div>
            </a>
            <ul class="list-unstyled" id="lmsButtonMenu">
                <?php if(userPermission(1500) && menuStatus(1500)): ?>
                    <li data-position="<?php echo e(menuPosition(1555)); ?>">
                        <a href="<?php echo e(route('lms.allCourse', [auth()->user()->id])); ?>"><?php echo app('translator')->get('lms::lms.all_course'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(userPermission(1500) && menuStatus(1500)): ?>
                    <li data-position="<?php echo e(menuPosition(1555)); ?>">
                        <a href="<?php echo e(route('lms.enrolledCourse',[auth()->user()->id] )); ?>"><?php echo app('translator')->get('lms::lms.my_course'); ?></a>
                    </li>
                <?php endif; ?>    
                <?php if(userPermission(1500) && menuStatus(1500)): ?>
                    <li data-position="<?php echo e(menuPosition(1555)); ?>">
                        <a href="<?php echo e(route('lms.student.purchaseLog', [auth()->user()->id])); ?>"><?php echo app('translator')->get('lms::lms.purchase_history'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(userPermission(1500) && menuStatus(1504)): ?>
                    <li data-position="<?php echo e(menuPosition(1504)); ?>">
                        <a href="<?php echo e(route('lms.student.quiz')); ?>"><?php echo app('translator')->get('lms::lms.my_quiz'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(userPermission(1500) && menuStatus(1505)): ?>
                    <li data-position="<?php echo e(menuPosition(1505)); ?>">
                        <a href="<?php echo e(route('lms.student.quizReport')); ?>"><?php echo app('translator')->get('lms::lms.quiz_report'); ?></a>
                    </li>
                <?php endif; ?>

                <?php if(userPermission(1500) && menuStatus(1505)): ?>
                    <li data-position="<?php echo e(menuPosition(1505)); ?>">
                        <a href="<?php echo e(route('lms.student.certificate', auth()->id())); ?>"><?php echo app('translator')->get('lms::lms.certificate'); ?></a>
                    </li>
                <?php endif; ?>

                
            </ul>
        </li>
    <?php endif; ?>
<?php endif; ?>



<?php if(moduleStatusCheck('Wallet') == true): ?>
    <li data-position="<?php echo e(menuPosition(56)); ?>" class="sortable_li">
        <a href="<?php echo e(route('wallet.my-wallet')); ?>">
            <div class="nav_icon_small">
                <span class="flaticon-wallet"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('wallet::wallet.my_wallet'); ?>
            </div>
        </a>
    </li>
<?php endif; ?>


<?php if(userPermission(22) && menuStatus(22)): ?>
    <li data-position="<?php echo e(menuPosition(22)); ?>" class="sortable_li">
        <a href="<?php echo e(route('student_class_routine')); ?>">
          
            
            <div class="nav_icon_small">
                <span class="flaticon-calendar-1"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('academics.class_routine'); ?>
                </div>
        </a>
    </li>
<?php endif; ?>

<?php if(userPermission(800) && menuStatus(800)): ?>
    <li data-position="<?php echo e(menuPosition(800)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
            
            <div class="nav_icon_small">
                <span class="flaticon-calendar-1"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('lesson::lesson.lesson'); ?>
                </div>
        </a>
        <ul class="list-unstyled" >
            <?php if(userPermission(810) && menuStatus(810)): ?>
                <li data-position="<?php echo e(menuPosition(810)); ?>">
                    <a href="<?php echo e(route('lesson-student-lessonPlan')); ?>"><?php echo app('translator')->get('lesson::lesson.lesson_plan'); ?></a>
                </li>
            <?php endif; ?>
            <?php if(userPermission(815) && menuStatus(815)): ?>
                <li data-position="<?php echo e(menuPosition(815)); ?>">
                    <a
                        href="<?php echo e(route('lesson-student-lessonPlan-overview')); ?>"><?php echo app('translator')->get('lesson::lesson.lesson_plan_overview'); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<?php if(userPermission(23) && menuStatus(23)): ?>
    <li data-position="<?php echo e(menuPosition(23)); ?>" class="sortable_li">
        <a href="<?php echo e(route('student_homework')); ?>">           
            <div class="nav_icon_small">
                <span class="flaticon-book"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('homework.home_work'); ?>
                </div>
        </a>
    </li>
<?php endif; ?>
<?php if(userPermission(26) && menuStatus(26)): ?>
    <li data-position="<?php echo e(menuPosition(26)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
           
            
            <div class="nav_icon_small">
                <span class="flaticon-data-storage"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('study.download_center'); ?>
                </div>
        </a>
        <ul class="list-unstyled" id="subMenuDownloadCenter">
            <?php if(userPermission(27) && menuStatus(27)): ?>
                <li data-position="<?php echo e(menuPosition(27)); ?>">
                    <a href="<?php echo e(route('student_assignment')); ?>"><?php echo app('translator')->get('study.assignment'); ?></a>
                </li>
            <?php endif; ?>
            
            <?php if(userPermission(31) && menuStatus(31)): ?>
                <li data-position="<?php echo e(menuPosition(31)); ?>">
                    <a href="<?php echo e(route('student_syllabus')); ?>"><?php echo app('translator')->get('study.syllabus'); ?></a>
                </li>
            <?php endif; ?>
            <?php if(userPermission(33) && menuStatus(33)): ?>
                <li data-position="<?php echo e(menuPosition(33)); ?>">
                    <a href="<?php echo e(route('student_others_download')); ?>"><?php echo app('translator')->get('study.other_download'); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<?php if(userPermission(35) && menuStatus(35)): ?>
    <li data-position="<?php echo e(menuPosition(35)); ?>" class="sortable_li">
        <a href="<?php echo e(route('student_my_attendance')); ?>">
         
          
            <div class="nav_icon_small">
                <span class="flaticon-authentication"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('student.attendance'); ?>
                </div>
        </a>
    </li>
<?php endif; ?>
<?php if(userPermission(36) && menuStatus(36)): ?>
    <li data-position="<?php echo e(menuPosition(36)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
           
            
            <div class="nav_icon_small">
                <span class="flaticon-test"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('exam.examinations'); ?>
                </div>
        </a>
        <ul class="list-unstyled" id="subMenuStudentExam">
            <?php if(userPermission(37) && menuStatus(37)): ?>
                <li data-position="<?php echo e(menuPosition(37)); ?>">
                    <a href="<?php echo e(route('student_result')); ?>"><?php echo app('translator')->get('reports.result'); ?></a>
                </li>
            <?php endif; ?>
            <?php if(userPermission(38) && menuStatus(38)): ?>
                <li data-position="<?php echo e(menuPosition(38)); ?>">
                    <a href="<?php echo e(route('student_exam_schedule')); ?>"><?php echo app('translator')->get('exam.exam_schedule'); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>


<?php if(moduleStatusCheck('ExamPlan') == true): ?>
    <li data-position="<?php echo e(menuPosition(2501)); ?>" class="sortable_li">
        <a href="<?php echo e(route('examplan.admitCard')); ?>">
            <span class="flaticon-book-1"></span>
            <?php echo app('translator')->get('examplan::exp.admit_card'); ?>
        </a>
    </li>
<?php endif; ?>

<?php if(userPermission(39) && menuStatus(39)): ?>
    <li data-position="<?php echo e(menuPosition(39)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
            
            
            <div class="nav_icon_small">
                <span class="flaticon-slumber"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('leave.leave'); ?>
                </div>
        </a>
        <ul class="list-unstyled" id="subMenuLeaveManagement">

            <?php if(userPermission(40) && menuStatus(40)): ?>

                <li data-position="<?php echo e(menuPosition(40)); ?>">
                    <a href="<?php echo e(route('student-apply-leave')); ?>"><?php echo app('translator')->get('leave.apply_leave'); ?></a>
                </li>
            <?php endif; ?>

            <?php if(userPermission(44) && menuStatus(44)): ?>

                <li data-position="<?php echo e(menuPosition(44)); ?>">
                    <a href="<?php echo e(route('student-pending-leave')); ?>"><?php echo app('translator')->get('leave.pending_leave_request'); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<?php if(moduleStatusCheck('OnlineExam') == true || (userPermission(45) && menuStatus(45))): ?>
    <li data-position="<?php echo e(menuPosition(45)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
            
           
            <div class="nav_icon_small">
                <span class="flaticon-test-1"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('exam.online_exam'); ?>
                </div>
        </a>
        <ul class="list-unstyled" id="subMenuStudentOnlineExam">

            <?php if(moduleStatusCheck('OnlineExam') == false): ?>
                <?php if(userPermission(46) && menuStatus(46)): ?>
                    <li data-position="<?php echo e(menuPosition(46)); ?>">
                        <a href="<?php echo e(route('student_online_exam')); ?>"><?php echo app('translator')->get('exam.active_exams'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(userPermission(47) && menuStatus(47)): ?>
                    <li data-position="<?php echo e(menuPosition(47)); ?>">
                        <a href="<?php echo e(route('student_view_result')); ?>"><?php echo app('translator')->get('exam.view_result'); ?></a>
                    </li>
                <?php endif; ?>

            <?php elseif(moduleStatusCheck('OnlineExam') == true ): ?>

                <?php if(userPermission(2046) && menuStatus(2046)): ?>
                    <li data-position="<?php echo e(menuPosition(2046)); ?>">
                        <a href="<?php echo e(route('om_student_online_exam')); ?>"> <?php echo app('translator')->get('exam.active_exams'); ?> </a>
                    </li>
                <?php endif; ?>

                <?php if(userPermission(2047) && menuStatus(2047)): ?>
                    <li data-position="<?php echo e(menuPosition(2047)); ?>">
                        <a href=" <?php echo e(route('om_student_view_result')); ?> "> <?php echo app('translator')->get('exam.view_result'); ?> </a>
                    </li>
                <?php endif; ?>

                <?php if(userPermission(2048) && menuStatus(2048)): ?>
                    <li data-position="<?php echo e(menuPosition(2048)); ?>">
                        <a href="<?php echo e(route('student_pdf_exam')); ?> " class="active"> PDF <?php echo app('translator')->get('exam.exam'); ?> </a>
                    </li>
                <?php endif; ?>

                <?php if(userPermission(2049) && menuStatus(2049)): ?>
                    <li data-position="<?php echo e(menuPosition(2049)); ?>">
                        <a href=" <?php echo e(route('student_view_pdf_result')); ?> "> PDF <?php echo app('translator')->get('exam.exam_result'); ?> </a>
                    </li>
                <?php endif; ?>

            <?php endif; ?>

        </ul>
    </li>
<?php endif; ?>
<?php if(userPermission(48) && menuStatus(48)): ?>
    <li data-position="<?php echo e(menuPosition(48)); ?>" class="sortable_li">
        <a href="<?php echo e(route('student_noticeboard')); ?>">
            <div class="nav_icon_small">
                <span class="flaticon-poster"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('communicate.notice_board'); ?>
                </div>
        </a>
    </li>
<?php endif; ?>
<?php if(userPermission(49) && menuStatus(49)): ?>
    <li data-position="<?php echo e(menuPosition(49)); ?>" class="sortable_li">
        <a href="<?php echo e(route('student_subject')); ?>">
            <div class="nav_icon_small">
                <span class="flaticon-reading-1"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('common.subjects'); ?>
                </div>
        </a>
    </li>
<?php endif; ?>
<?php if(userPermission(50) && menuStatus(50)): ?>
    <li data-position="<?php echo e(menuPosition(50)); ?>" class="sortable_li">
        <a href="<?php echo e(route('student_teacher')); ?>">
           
           
            <div class="nav_icon_small">
                <span class="flaticon-professor"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('common.teacher'); ?>
                </div>
        </a>
    </li>
<?php endif; ?>
<?php if(userPermission(51) && menuStatus(51)): ?>
    <li data-position="<?php echo e(menuPosition(51)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
           
            <div class="nav_icon_small">
                <span class="flaticon-book-1"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('library.library'); ?>
                </div>
        </a>
        <ul class="list-unstyled" id="subMenuStudentLibrary">
            <?php if(userPermission(52) && menuStatus(52)): ?>
                <li data-position="<?php echo e(menuPosition(52)); ?>">
                    <a href="<?php echo e(route('student_library')); ?>"> <?php echo app('translator')->get('library.book_list'); ?></a>
                </li>
            <?php endif; ?>
            <?php if(userPermission(53) && menuStatus(53)): ?>
                <li data-position="<?php echo e(menuPosition(53)); ?>">
                    <a href="<?php echo e(route('student_book_issue')); ?>"><?php echo app('translator')->get('library.book_issue'); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<?php if(userPermission(54) && menuStatus(54)): ?>
    <li data-position="<?php echo e(menuPosition(54)); ?>" class="sortable_li">
        <a href="<?php echo e(route('student_transport')); ?>">
            
           
            
            <div class="nav_icon_small">
                <span class="flaticon-bus"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('transport.transport'); ?>
                </div>
        </a>
    </li>
<?php endif; ?>
<?php if(userPermission(55) && menuStatus(55)): ?>
    <li data-position="<?php echo e(menuPosition(55)); ?>" class="sortable_li">
        <a href="<?php echo e(route('student_dormitory')); ?>">
           
           
            <div class="nav_icon_small">
                <span class="flaticon-hotel"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('dormitory.dormitory'); ?>
                </div>
        </a>
    </li>
<?php endif; ?>

<?php echo $__env->make('chat::menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Zoom Menu -->
<?php if(moduleStatusCheck('Zoom') == true): ?>

    <?php echo $__env->make('zoom::menu.Zoom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<!-- BBB Menu -->
<?php if(moduleStatusCheck('BBB') == true): ?>
    <?php echo $__env->make('bbb::menu.bigbluebutton_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>



<!-- Jitsi Menu -->
<?php if(moduleStatusCheck('Jitsi') == true): ?>
    <?php echo $__env->make('jitsi::menu.jitsi_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/partials/student_sidebar.blade.php ENDPATH**/ ?>