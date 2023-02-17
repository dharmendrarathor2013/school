<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lesson::lesson.lesson_plan_create'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

<link rel="stylesheet" href="<?php echo e(url('Modules/Lesson/Resources/assets/css/lesson_plan.css')); ?>">

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lesson::lesson.lesson_plan_create'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lesson::lesson.lesson_plan'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lesson::lesson.lesson_plan_create'); ?></a>
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
            <div class="row">
                <div class="col-lg-12">
                  
                   <?php if(userPermission(810) ): ?>
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'lesson-planner', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            
                            <div class="col-lg-6 mt-30-md">
                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="teacher">
                                    <option data-display="<?php echo app('translator')->get('common.select_teacher'); ?> *" value=""><?php echo app('translator')->get('common.select_teacher'); ?> *</option>
                                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$teacher->id); ?>"  <?php echo e(isset($teacher_id)? ($teacher_id == $teacher->id?'selected':''):''); ?>><?php echo e(@$teacher->full_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('teacher')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('teacher')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-lg-6 mt-20 text-left">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    <?php echo app('translator')->get('common.search'); ?>
                                </button>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php if(isset($class_times)): ?>
<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-12 col-md-12">
                <div class="main-title">
                    <?php
                  
                     $dates[6];
                    if(isset($week_number)){
                        $week_number=$week_number;
                    } else{
                        $week_number=$this_week;
                    } 

                     ?>

                    <h3 class="text-center "><a href="<?php echo e(url('/lesson/dicrease-week/'.$teacher_id.'/'.$dates[0])); ?>"><</a> Week <?php echo e($week_number); ?> | <span class="yearColor"> <?php echo e(date('Y', strtotime($dates[0]))); ?> </span><a href="<?php echo e(url('/lesson/change-week/'.$teacher_id.'/'.$dates[6])); ?>"> > </a></h3> 
                
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                       
                        <tr>
                           
                            <?php
                                $height= 0;
                                $tr = [];
                            ?>
                            <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                    $teacherClassRoutineById=App\SmWeekend::teacherClassRoutineById($sm_weekend->id,$teacher_id);
                            ?>
                                <?php if( $teacherClassRoutineById->count() >$height): ?>
                                    <?php
                                        $height =  $teacherClassRoutineById->count();
                                    ?>
                                <?php endif; ?>

                            <th><?php echo e(@$sm_weekend->name); ?> <br>
                                <?php echo e(date('d-M-y', strtotime($dates[$key]))); ?> 
                            </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $used = [];
                        $tr=[];
            
                    ?>
                    <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    
                        $i = 0;
                        $teacherClassRoutineById=App\SmWeekend::teacherClassRoutineById($sm_weekend->id,$teacher_id);
                    ?>
                        <?php $__currentLoopData = $teacherClassRoutineById; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            if(!in_array($routine->id, $used)){
                                $tr[$i][$sm_weekend->name][$loop->index]['subject']= $routine->subject ? $routine->subject->subject_name :'';
                                $tr[$i][$sm_weekend->name][$loop->index]['subject_code']= $routine->subject ? $routine->subject->subject_code :'';
                                $tr[$i][$sm_weekend->name][$loop->index]['class_room']= $routine->classRoom ? $routine->classRoom->room_no : '';
                                $tr[$i][$sm_weekend->name][$loop->index]['teacher']= $routine->teacherDetail ? $routine->teacherDetail->full_name :'';
                                $tr[$i][$sm_weekend->name][$loop->index]['start_time']=  $routine->start_time;
                                $tr[$i][$sm_weekend->name][$loop->index]['end_time']  = $routine->end_time;
                                $tr[$i][$sm_weekend->name][$loop->index]['class_name']= $routine->class ? $routine->class->class_name : '';                               
                                $tr[$i][$sm_weekend->name][$loop->index]['section_name']= $routine->section ? $routine->section->section_name : '';
                                $tr[$i][$sm_weekend->name][$loop->index]['is_break']= $routine->is_break;
                                $used[] = $routine->id;

                                $tr[$i][$sm_weekend->name][$loop->index]['class_id']= $routine->class ? $routine->class->id : null;
                                $tr[$i][$sm_weekend->name][$loop->index]['section_id']= $routine->section ? $routine->section->id : null;
                                $tr[$i][$sm_weekend->name][$loop->index]['subject_id']= $routine->subject ? $routine->subject->id :null;
                                $tr[$i][$sm_weekend->name][$loop->index]['class_room_id']= $routine->classRoom ? $routine->classRoom->id : null;
                                $tr[$i][$sm_weekend->name][$loop->index]['teacher_id']= $routine->teacherDetail ? $routine->teacherDetail->id : null;
                                $tr[$i][$sm_weekend->name][$loop->index]['routine_id']= $routine->id;
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
                     <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                 $lesson_date=$dates[$key]
                            ?>
                        <td>
                            <?php
                                 $classes=gv($days,$sm_weekend->name);
                             ?>
                             <?php if($classes && gv($classes,$i)): ?>              
                               <?php if($classes[$i]['is_break']): ?>
                              <strong > <?php echo app('translator')->get('lesson::lesson.break'); ?> </strong>
                                 
                               <span class=""> (<?php echo e(date('h:i A', strtotime(@$classes[$i]['start_time']))); ?>  - <?php echo e(date('h:i A', strtotime(@$classes[$i]['end_time']))); ?>)  <br> </span> 
                                <?php else: ?>
                                <span class=""><?php echo e(date('h:i A', strtotime(@$classes[$i]['start_time']))); ?>  - <?php echo e(date('h:i A', strtotime(@$classes[$i]['end_time']))); ?>  <br> </span> 
                                    <span class="">  <strong>  <?php echo e($classes[$i]['subject']); ?> </strong>  (<?php echo e($classes[$i]['subject_code']); ?>) <br>  </span>            
                                    <?php if($classes[$i]['class_room']): ?>
                                        <span class=""> <strong><?php echo app('translator')->get('common.room'); ?> :</strong>     <?php echo e($classes[$i]['class_room']); ?>  <br>     </span>
                                    <?php endif; ?>    
                                    <?php if($classes[$i]['class_name']): ?>
                                    <span class=""> <?php echo e($classes[$i]['class_name']); ?>   <?php if($classes[$i]['section_name']): ?> ( <?php echo e($classes[$i]['section_name']); ?> )   <?php endif; ?>  <br> </span>
                                    <?php endif; ?>    
                                    
                                    <?php
                                        
                                    $class_id      =  $classes[$i]['class_id'];
                                    $section_id    =  $classes[$i]['section_id'];   
                                    $subject_id    =  $classes[$i]['subject_id']; 
                                    $start_time    =  $classes[$i]['start_time'];
                                    $end_time      =  $classes[$i]['end_time'];
                                    $routine_id    =  $classes[$i]['routine_id'];
                                    

                              
                                    $lessonPlan    =  DB::table('lesson_planners')
                                                        ->where('lesson_date',$lesson_date) 
                                                        ->where('class_id',$class_id)     
                                                        ->where('section_id',$section_id)    
                                                        ->where('subject_id',$subject_id)                                             
                                                        ->where('routine_id',$routine_id)                                             
                                                        ->where('academic_id', getAcademicId())
                                                        ->where('school_id',Auth::user()->school_id)
                                                        ->first();
                                            ?>
                                    <?php if($lessonPlan): ?>
                                    <div class="row">
                                           <?php if(userPermission(814)): ?>
                                        <div class="col-lg-2 text-right">
                                            <a href="<?php echo e(route('view-lesson-planner-lesson', [$lessonPlan->id])); ?>" 
                                                class="primary-btn small tr-bg icon-only modalLink"
                                                title="<?php echo app('translator')->get('lesson::lesson.lesson_overview'); ?> " data-modal-size="modal-lg" >
                                                <span class="ti-eye" id=""></span>
                                            </a>
                                        </div>
                                         <?php endif; ?>
                                           <?php if(userPermission(813)): ?>
                                                 <div class="col-lg-2 text-right">
                                                    <a href="<?php echo e(route('delete-lesson-planner-lesson', [$lessonPlan->id])); ?>" 
                                                        class="primary-btn small tr-bg icon-only  modalLink" data-modal-size="modal-md" 
                                                        title="<?php echo app('translator')->get('lesson::lesson.delete_lesson_plan'); ?>">
                                                        <span class="ti-close" id=""></span>
                                                    </a>
                                                </div>
                                         <?php endif; ?>
                                           <?php if(userPermission(812)): ?>
                                                <div class="col-lg-2 text-right">
                                                    <a href="<?php echo e(route('edit-lesson-planner-lesson', [$lessonPlan->id])); ?>" 
                                                        class="primary-btn small tr-bg icon-only mr-10 modalLink" data-modal-size="modal-lg" 
                                                        title="<?php echo app('translator')->get('lesson::lesson.edit_lesson_plan'); ?> <?php echo e(date('d-M-y',strtotime($lesson_date))); ?> ( <?php echo e(date('h:i A', strtotime(@$start_time))); ?>-<?php echo e(date('h:i A', strtotime(@$end_time))); ?> )">
                                                        <span class="ti-pencil" id=""></span>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                    </div>
                                    <?php else: ?>
                                   
                                        <?php if(userPermission(811)): ?>
                                            <div class="col-lg-6 text-right">
                                                <a href="<?php echo e(route('add-lesson-planner-lesson', [$sm_weekend->id,$teacher_id,$routine_id,$lesson_date])); ?>" 
                                                    class="primary-btn small tr-bg icon-only mr-10 modalLink" data-modal-size="modal-lg" 
                                                    title="<?php echo app('translator')->get('lesson::lesson.add_lesson_plan'); ?> <?php echo e(date('d-M-y',strtotime($lesson_date))); ?> ( <?php echo e(date('h:i A', strtotime(@$start_time))); ?>-<?php echo e(date('h:i A', strtotime(@$end_time))); ?> )">
                                                    <span class="ti-plus" id="addClassRoutine"></span>
                                                </a>
                                            </div>
                                         <?php endif; ?>
                                    <?php endif; ?>
            
                                 <?php endif; ?>
            
                            <?php endif; ?>
                            
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
              
                                
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </tr>
            
                   <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

    

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/Modules/Lesson/Resources/views/lessonPlan/lesson_planner.blade.php ENDPATH**/ ?>