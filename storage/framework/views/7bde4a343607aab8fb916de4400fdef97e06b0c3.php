<?php if(userPermission(56) && menuStatus(56)): ?>
<li data-position="<?php echo e(menuPosition(56)); ?>" class="sortable_li">
   <a href="<?php echo e(route('parent-dashboard')); ?>">       
       <div class="nav_icon_small">
             <span class="flaticon-resume"></span>
        </div>
        <div class="nav_title">
            <?php echo app('translator')->get('common.dashboard'); ?>
        </div>
   </a>
</li>
<?php endif; ?>
<?php if(userPermission(66) && menuStatus(66)): ?>
   <li data-position="<?php echo e(menuPosition(66)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
          <div class="nav_icon_small">
            <span class="flaticon-reading"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('common.my_children'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuParentMyChildren">
           

           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('my_children', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
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
                <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(route('lms.allCourse',[$children->user_id])); ?>"><?php echo app('translator')->get('lms::lms.all_course'); ?> (<?php echo e($children->full_name); ?>)</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('lms.enrolledCourse',[$children->user_id])); ?>"><?php echo e($children->full_name); ?> - <?php echo app('translator')->get('lms::lms.course'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('lms.student.purchaseLog',[$children->user_id])); ?>"><?php echo e($children->full_name); ?> - <?php echo app('translator')->get('lms::lms.purchase_history'); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
    <?php endif; ?>
<?php endif; ?>


<?php if(generalSetting()->fees_status == 0): ?>
    <?php if(userPermission(71) && menuStatus(71)): ?>
        <li data-position="<?php echo e(menuPosition(71)); ?>" class="sortable_li">
            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
               
              
                <div class="nav_icon_small">
                    <span class="flaticon-wallet"></span>
                </div>
                <div class="nav_title">
                        <?php echo app('translator')->get('fees.fees'); ?>
                </div>
            </a>
            <ul class="list-unstyled" id="subMenuParentFees">
                <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(moduleStatusCheck('FeesCollection')== false ): ?>
                    <li>
                        <a href="<?php echo e(route('parent_fees', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo e(route('feescollection/parent-fee-payment', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                    </li>

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
    <?php endif; ?>
<?php endif; ?>

<?php if(moduleStatusCheck('Wallet')): ?>
    <?php if ($__env->exists('wallet::menu.sidebar')) echo $__env->make('wallet::menu.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if(generalSetting()->fees_status == 1): ?>
    <?php if ($__env->exists('fees::sidebar.feesParentSidebar')) echo $__env->make('fees::sidebar.feesParentSidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if(userPermission(72) && menuStatus(72)): ?>
   <li data-position="<?php echo e(menuPosition(72)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">   
           <div class="nav_icon_small">
                <span class="flaticon-calendar-1"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('academics.class_routine'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuParentClassRoutine">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_class_routine', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>

<?php if(userPermission(97) && menuStatus(97)): ?>
   <li data-position="<?php echo e(menuPosition(97)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
           <div class="nav_icon_small">
                <span class="flaticon-calendar-1"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('lesson::lesson.lesson'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuLessonPlan">
            <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>           
             <?php if(userPermission(98) && menuStatus(98)): ?>
               <li data-position="<?php echo e(menuPosition(98)); ?>" >
                  <a href="<?php echo e(route('lesson-parent-lessonPlan',[$children->id])); ?>"> <?php echo e($children->full_name); ?>-Lesson plan</a>
               </li>
               <?php endif; ?>
               <?php if(userPermission(99) && menuStatus(99)): ?>
                 <li data-position="<?php echo e(menuPosition(99)); ?>" >
                 <a href="<?php echo e(route('lesson-parent-lessonPlan-overview',[$children->id])); ?>">  <?php echo e($children->full_name); ?>- Lesson plan overview</a>
               </li>
               <?php endif; ?>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(73) && menuStatus(73)): ?>
   <li data-position="<?php echo e(menuPosition(73)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
           
           <div class="nav_icon_small">
            <span class="flaticon-book"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('homework.home_work'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuParentHomework">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_homework', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(75) && menuStatus(75)): ?>
   <li data-position="<?php echo e(menuPosition(75)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
          
           <div class="nav_icon_small">
            <span class="flaticon-authentication"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('student.attendance'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuParentAttendance">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_attendance', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(76) && menuStatus(76)): ?>
   <li data-position="<?php echo e(menuPosition(76)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
         
           
           <div class="nav_icon_small">
            <span class="flaticon-test"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('exam.exam'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuParentExamination">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php if(userPermission(77) && menuStatus(77)): ?>
                   <li  data-position="<?php echo e(menuPosition(77)); ?>">
                       <a href="<?php echo e(route('parent_examination', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                   </li>
               <?php endif; ?>
               <?php if(userPermission(78) && menuStatus(78)): ?>
                   <li  data-position="<?php echo e(menuPosition(78)); ?>">
                       <a href="<?php echo e(route('parent_exam_schedule', [$children->id])); ?>"><?php echo app('translator')->get('exam.exam_schedule'); ?></a>
                   </li>
               <?php endif; ?>


               


               <hr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>

<?php if(moduleStatusCheck('ExamPlan') == true): ?>
    <?php if(userPermission(2503) && menuStatus(2503)): ?>
    <li data-position="<?php echo e(menuPosition(2503)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
            <div class="nav_icon_small">
                <span class="flaticon-reading"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('examplan::exp.admit_card'); ?>
                </div>
        </a>
        <ul class="list-unstyled" id="subMenuParentMyChildren">
            <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e(route('examplan.admitCardParent', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </li>
    <?php endif; ?>
<?php endif; ?>



<?php if(moduleStatusCheck('OnlineExam') == false): ?>
    
    <?php if(userPermission(2016) && menuStatus(2016)): ?>
    <li data-position="<?php echo e(menuPosition(2016)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">              
           <div class="nav_icon_small">
            <span class="flaticon-test"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('exam.online_exam'); ?>
            </div>
        </a>
        <ul class="list-unstyled" id="subMenuOnlineExam">
            <?php if(moduleStatusCheck('OnlineExam') == false ): ?> 
                <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <?php if(userPermission(2018) && menuStatus(2018)): ?>
                    <li  data-position="<?php echo e(menuPosition(2018)); ?>">
                        <a href="<?php echo e(route('parent_online_examination', [$children->id])); ?>"><?php echo app('translator')->get('exam.online_exam'); ?> - <?php echo e($children->full_name); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if(userPermission(2017) && menuStatus(2017)): ?>
                        <li  data-position="<?php echo e(menuPosition(2017)); ?>">
                        <a href="<?php echo e(route('parent_online_examination_result', [$children->id])); ?>"><?php echo app('translator')->get('exam.online_exam_result'); ?> - <?php echo e($children->full_name); ?></a>
                    </li>
                <?php endif; ?>
                <hr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>      
            </ul>
        </li>
        <?php endif; ?> 
<?php endif; ?>
    <?php if(moduleStatusCheck('OnlineExam') == true): ?>
        
        <?php if(userPermission(2101) && menuStatus(2101)): ?>
        <li data-position="<?php echo e(menuPosition(79)); ?>" class="sortable_li">
            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">                
                <div class="nav_icon_small">
                    <span class="flaticon-test"></span>
                    </div>
                    <div class="nav_title">
                        <?php echo app('translator')->get('onlineexam::onlineExam.online_exam'); ?>
                    </div>
            </a>
            <ul class="list-unstyled" id="subMenuOnlineExamModule">
                
                
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(userPermission(2001) && menuStatus(2001)): ?>                           
                            <li data-position="<?php echo e(menuPosition(2001)); ?>">                                            
                                <a href="<?php echo e(route('om_parent_online_examination',$children->id)); ?>">  <?php echo app('translator')->get('onlineexam::onlineExam.online_exam'); ?> <?php echo e(count($childrens) >1 ? '-'.$children->full_name :''); ?> </a>
                            </li>  
                        <?php endif; ?>
                        <?php if(userPermission(2002) && menuStatus(2002)): ?>                           
                            <li data-position="<?php echo e(menuPosition(2002)); ?>">                                            
                                <a href="<?php echo e(route('om_parent_online_examination_result',$children->id)); ?>">  <?php echo app('translator')->get('onlineexam::onlineExam.online_exam_result'); ?> <?php echo e(count($childrens) >1 ? '-'.$children->full_name :''); ?> </a>
                            </li>  
                        <?php endif; ?>
                        <?php if(userPermission(2103) && menuStatus(2103)): ?>                           
                            <li data-position="<?php echo e(menuPosition(2103)); ?>">                                            
                                <a href="<?php echo e(route('parent_pdf_exam',$children->id)); ?>">  <?php echo app('translator')->get('onlineexam::onlineExam.pdf_exam'); ?> <?php echo e(count($childrens) >1 ? '-'.$children->full_name :''); ?> </a>
                            </li>  
                        <?php endif; ?>                                   
                        <?php if(userPermission(2104) && menuStatus(2104)): ?>   
                            <li data-position="<?php echo e(menuPosition(2104)); ?>"> 
                                <a href="<?php echo e(route('parent_view_pdf_result',$children->id)); ?>"> <?php echo app('translator')->get('onlineexam::onlineExam.pdf_exam_result'); ?>  <?php echo e(count($childrens) >1 ? '-'.$children->full_name :''); ?> </a>
                            </li> 
                        <?php endif; ?> 
                                            
                        <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
                
                </ul>
            </li>
            <?php endif; ?> 
    <?php endif; ?> 


<?php if(userPermission(80) && menuStatus(80)): ?>
   <li data-position="<?php echo e(menuPosition(80)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">           
           <div class="nav_icon_small">
            <span class="flaticon-test"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('leave.leave'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuParentLeave">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li >
                   <a href="<?php echo e(route('parent_leave', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <?php if(userPermission(81) && menuStatus(81)): ?>
               <li  data-position="<?php echo e(menuPosition(81)); ?>">
                   <a href="<?php echo e(route('parent-apply-leave')); ?>"><?php echo app('translator')->get('leave.apply_leave'); ?></a>
               </li>
           <?php endif; ?>
           <?php if(userPermission(82) && menuStatus(82)): ?>
               <li  data-position="<?php echo e(menuPosition(82)); ?>">
                   <a href="<?php echo e(route('parent-pending-leave')); ?>"><?php echo app('translator')->get('leave.pending_leave_request'); ?></a>
               </li>
           <?php endif; ?>
           
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(85) && menuStatus(85)): ?>
   <li data-position="<?php echo e(menuPosition(85)); ?>" class="sortable_li">
       <a href="<?php echo e(route('parent_noticeboard')); ?>">
           <div class="nav_icon_small">
            <span class="flaticon-poster"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('communicate.notice_board'); ?>
            </div>
       </a>
   </li>
<?php endif; ?>
<?php if(userPermission(86) && menuStatus(86)): ?>
   <li data-position="<?php echo e(menuPosition(86)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
           
          
           <div class="nav_icon_small">
            <span class="flaticon-reading-1"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('common.subjects'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuParentSubject">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_subjects', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php echo app('translator')->get('common.teacher_list'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuParentTeacher">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_teacher_list', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(88) && menuStatus(88)): ?>
   <li data-position="<?php echo e(menuPosition(88)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
           <div class="nav_icon_small">
                <span class="flaticon-book-1"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('library.library'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuStudentLibrary">
           <?php if(userPermission(89) && menuStatus(89)): ?>
               <li data-position="<?php echo e(menuPosition(89)); ?>">
                   <a href="<?php echo e(route('parent_library')); ?>"> <?php echo app('translator')->get('library.book_list'); ?></a>
               </li>
           <?php endif; ?>
           <?php if(userPermission(90) && menuStatus(90)): ?>
               <li data-position="<?php echo e(menuPosition(90)); ?>">
                   <a href="<?php echo e(route('parent_book_issue')); ?>"><?php echo app('translator')->get('library.book_issue'); ?></a>
               </li>
           <?php endif; ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(91) && menuStatus(91)): ?>
   <li data-position="<?php echo e(menuPosition(91)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
          
           
           <div class="nav_icon_small">
            <span class="flaticon-bus"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('transport.transport'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuParentTransport">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_transport', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(92) && menuStatus(92)): ?>
   <li data-position="<?php echo e(menuPosition(92)); ?>" class="sortable_li">
       <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
           
          
           <div class="nav_icon_small">
            <span class="flaticon-hotel"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('dormitory.dormitory_list'); ?>
            </div>
       </a>
       <ul class="list-unstyled" id="subMenuParentDormitory">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_dormitory_list', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>

<!-- chat module sidebar -->

 <?php if(userPermission(910) && menuStatus(910)): ?>
<li  data-position="<?php echo e(menuPosition(900)); ?>" class="sortable_li">
    <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
        
        
        <div class="nav_icon_small">
            <span class="flaticon-test"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('chat::chat.chat'); ?>
            </div>
    </a>
    <ul class="list-unstyled" id="subMenuChat">
        <?php if(userPermission(911) && menuStatus(911)): ?>
        <li  data-position="<?php echo e(menuPosition(901)); ?>" >
            <a href="<?php echo e(route('chat.index')); ?>"><?php echo app('translator')->get('chat::chat.chat_box'); ?></a>
        </li>
        <?php endif; ?>

        <?php if(userPermission(913) && menuStatus(913)): ?>
        <li data-position="<?php echo e(menuPosition(903)); ?>" >
            <a href="<?php echo e(route('chat.invitation')); ?>"><?php echo app('translator')->get('chat::chat.invitation'); ?></a>
        </li>
        <?php endif; ?>

        <?php if(userPermission(914) && menuStatus(914)): ?>
            <li data-position="<?php echo e(menuPosition(904)); ?>" >
                <a href="<?php echo e(route('chat.blocked.users')); ?>"><?php echo app('translator')->get('chat::chat.blocked_user'); ?></a>
            </li>
        <?php endif; ?>

     
    </ul>
</li>
<?php endif; ?>

<!-- BBB Menu  -->   
     <?php if(moduleStatusCheck('BBB') == true): ?>
        <?php if(userPermission(105) && menuStatus(105)): ?>
                <li data-position="<?php echo e(menuPosition(105)); ?>" class="sortable_li">
                <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                    
                
                <div class="nav_icon_small">
                    <span class="flaticon-reading"></span>
                    </div>
                    <div class="nav_title">
                        <?php echo app('translator')->get('bbb::bbb.bbb'); ?>
                    </div>
                </a>
                            <ul class="list-unstyled" id="bigBlueButtonMenu">
                                <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(userPermission(106) && menuStatus(106)): ?>
                                        <li data-position="<?php echo e(menuPosition(106)); ?>" >
                                            <a href="<?php echo e(route('bbb.parent.virtual-class',[$children->id])); ?>"><?php if(count($childrens)>1): ?><?php echo e($children->full_name); ?> <?php endif; ?> <?php echo app('translator')->get('common.virtual_class'); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if(userPermission(107) && menuStatus(107)): ?>
                                    <li data-position="<?php echo e(menuPosition(107)); ?>" >
                                        <a href="<?php echo e(route('bbb.meetings')); ?>"><?php echo app('translator')->get('common.virtual_meeting'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(userPermission(115) && menuStatus(115)): ?>
                                    <li data-position="<?php echo e(menuPosition(115)); ?>" >
                                        <a href="<?php echo e(route('bbb.parent.class.recording.list', $children->id)); ?>"><?php if(count($childrens)>1): ?><?php echo e($children->full_name); ?> <?php endif; ?> <?php echo app('translator')->get('common.class_record_list'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                                <?php if(userPermission(116) && menuStatus(116)): ?>
                                    <li data-position="<?php echo e(menuPosition(116)); ?>" >
                                        <a href="<?php echo e(route('bbb.parent.meeting.recording.list')); ?>"> <?php echo app('translator')->get('bbb::bbb.meeting_record_list'); ?></a>
                                    </li>
                                <?php endif; ?>

                            </ul>
                </li>

        <?php endif; ?>    

<?php endif; ?>
<!-- BBB  Menu end -->   
<!-- Jitsi Menu  -->      
    <?php if(moduleStatusCheck('Jitsi')==true): ?>
     <?php if(userPermission(108) && menuStatus(108)): ?>
        <li data-position="<?php echo e(menuPosition(108)); ?>" class="sortable_li">
                <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">                    
                <div class="nav_icon_small">
                    <span class="flaticon-reading"></span>
                    </div>
                    <div class="nav_title">
                        <?php echo app('translator')->get('jitsi::jitsi.jitsi'); ?>
                    </div>
                </a>
                <ul class="list-unstyled" id="subMenuJisti">
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(userPermission(109) && menuStatus(109)): ?>
                            <li data-position="<?php echo e(menuPosition(109)); ?>" >
                                <a href="<?php echo e(route('jitsi.parent.virtual-class',[$children->id])); ?>"><?php if(count($childrens)>1): ?><?php echo e($children->full_name); ?> <?php endif; ?> <?php echo app('translator')->get('common.virtual_class'); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                    <?php if(userPermission(110) && menuStatus(110)): ?>
                        <li data-position="<?php echo e(menuPosition(110)); ?>" >
                            <a href="<?php echo e(route('jitsi.meetings')); ?>"><?php echo app('translator')->get('common.virtual_meeting'); ?></a>
                        </li>
                    <?php endif; ?>
                
                </ul>
        </li>

    <?php endif; ?>        
<?php endif; ?>
<!-- jitsi Menu end -->

<!-- Zomm Menu  start -->
     <?php if(moduleStatusCheck('Zoom') == TRUE): ?>

        <?php if(userPermission(100) && menuStatus(100)): ?>
            <li data-position="<?php echo e(menuPosition(100)); ?>" class="sortable_li">
                <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">                
                <div class="nav_icon_small">
                    <span class="flaticon-reading"></span>
                    </div>
                    <div class="nav_title">
                        <?php echo app('translator')->get('zoom::zoom.zoom'); ?>
                    </div>
                </a>
                <ul class="list-unstyled" id="zoomMenu">
                    
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(userPermission(101) && menuStatus(101)): ?>
                            <li data-position="<?php echo e(menuPosition(101)); ?>" >
                                <a href="<?php echo e(route('zoom.parent.virtual-class',[$children->id])); ?>"><?php if(count($childrens)>1): ?><?php echo e($children->full_name); ?> <?php endif; ?> <?php echo app('translator')->get('common.virtual_class'); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    <?php if(userPermission(103) && menuStatus(103)): ?>
                        <li data-position="<?php echo e(menuPosition(103)); ?>" >
                            <a href="<?php echo e(route('zoom.meetings')); ?>"><?php echo app('translator')->get('common.virtual_meeting'); ?></a>
                        </li>
                    <?php endif; ?>

                </ul>
            </li>
        <?php endif; ?>
<?php endif; ?>
<!-- zoom Menu  --><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/partials/parents_sidebar.blade.php ENDPATH**/ ?>