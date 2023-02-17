<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('academics.class_routine'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Class Routine </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('academics.class_routine'); ?></a>
            </div>
        </div>
    </div>
</section>

<?php if(isset($class_times)): ?>
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row">
            <!-- Start Student Details -->
            <div class="col-lg-12 student-details up_admin_visitor">
                <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">

                   <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <li class="nav-item">
                        <a class="nav-link <?php if($key== 0): ?> active <?php endif; ?> " href="#tab<?php echo e($key); ?>" role="tab" data-toggle="tab"><?php echo e($record->class->class_name); ?> (<?php echo e($record->section->section_name); ?>) </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>


                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Start Fees Tab -->
                    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div role="tabpanel" class="tab-pane fade  <?php if($key== 0): ?> active show <?php endif; ?>" id="tab<?php echo e($key); ?>">
                            <div class="container-fluid p-0">
                                <div class="row mt-40">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="main-title">
                                            <h3 class="mb-30"><?php echo app('translator')->get('academics.class_routine'); ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pull-right">
                                        <a href="<?php echo e(route('classRoutinePrint', [@$record->class_id, @$record->section_id])); ?>" class="primary-btn small fix-gr-bg pull-right" target="_blank"><i class="ti-printer"> </i> Print</a>
                                        
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table id="default_table" class="display school-table " cellspacing="0" width="100%">
                                                <tr>
                                                    <?php
                                                        $height= 0;
                                                        $tr = [];
                                                    ?>
                                                    <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $studentClassRoutine=App\SmWeekend::studentClassRoutineFromRecord($record->class_id, $record->section_id, $sm_weekend->id);
                                                        ?>
                                                        <?php if($studentClassRoutine->count() > $height): ?>
                                                            <?php
                                                                $height =  $studentClassRoutine->count();
                                                            ?>
                                                        <?php endif; ?>
                                        
                                                        <th><?php echo e(@$sm_weekend->name); ?></th>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                                </tr>
                                               
                                                <?php
                                                    $used = [];
                                                    $tr=[];
                                        
                                                ?>
                                                <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                
                                                    $i = 0;
                                                    $studentClassRoutine=App\SmWeekend::studentClassRoutineFromRecord($record->class_id, $record->section_id, $sm_weekend->id);
                                                ?>
                                                    <?php $__currentLoopData = $studentClassRoutine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                        if(!in_array($routine->id, $used)){
                                                            $tr[$i][$sm_weekend->name][$loop->index]['subject']= $routine->subject ? $routine->subject->subject_name :'';
                                                            $tr[$i][$sm_weekend->name][$loop->index]['subject_code']= $routine->subject ? $routine->subject->subject_code :'';
                                                            $tr[$i][$sm_weekend->name][$loop->index]['class_room']= $routine->classRoom ? $routine->classRoom->room_no : '';
                                                            $tr[$i][$sm_weekend->name][$loop->index]['teacher']= $routine->teacherDetail ? $routine->teacherDetail->full_name :'';
                                                            $tr[$i][$sm_weekend->name][$loop->index]['start_time']=  $routine->start_time;
                                                            $tr[$i][$sm_weekend->name][$loop->index]['end_time']= $routine->end_time;
                                                            $tr[$i][$sm_weekend->name][$loop->index]['is_break']= $routine->is_break;
                                                            $used[] = $routine->id;
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
                                                 <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td>
                                                        <?php
                                                             $classes=gv($days,$sm_weekend->name);
                                                         ?>
                                                         <?php if($classes && gv($classes,$i)): ?>              
                                                           <?php if($classes[$i]['is_break']): ?>
                                                          <strong > <?php echo app('translator')->get('academics.break'); ?> </strong>
                                                             
                                                           <span class=""> (<?php echo e(date('h:i A', strtotime(@$classes[$i]['start_time']))); ?>  - <?php echo e(date('h:i A', strtotime(@$classes[$i]['end_time']))); ?>)  <br> </span> 
                                                            <?php else: ?>
                                                            <span class=""> <strong><?php echo app('translator')->get('common.time'); ?> :</strong> <?php echo e(date('h:i A', strtotime(@$classes[$i]['start_time']))); ?>  - <?php echo e(date('h:i A', strtotime(@$classes[$i]['end_time']))); ?>  <br> </span> 
                                                                <span class=""> <strong>   <?php echo e($classes[$i]['subject']); ?> </strong> (<?php echo e($classes[$i]['subject_code']); ?>) <br>  </span>            
                                                                <?php if($classes[$i]['class_room']): ?>
                                                                    <span class=""> <strong><?php echo app('translator')->get('academics.room'); ?> :</strong>     <?php echo e($classes[$i]['class_room']); ?>  <br>     </span>
                                                                <?php endif; ?>    
                                                                <?php if($classes[$i]['teacher']): ?>
                                                                  <span class=""> <?php echo e($classes[$i]['teacher']); ?>  <br> </span>
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
                     

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <!-- End Fees Tab -->
                </div>
            </div>
            <!-- End Student Details -->
        </div>


    </div>



</section>

<?php endif; ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/studentPanel/class_routine.blade.php ENDPATH**/ ?>