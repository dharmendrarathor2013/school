<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('exam.online_exam'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('exam.online_exam'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('exam.examinations'); ?></a>
                <a href="#"><?php echo app('translator')->get('exam.online_exam'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($online_exam)): ?>
         <?php if(userPermission(239)): ?>    
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('online-exam')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('common.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($online_exam)): ?>
                                    <?php echo app('translator')->get('exam.edit_online_exam'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('exam.add_online_exam'); ?>
                                <?php endif; ?>
                                
                            </h3>
                        </div>
                        <?php if(isset($online_exam)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('online-exam-update',$online_exam->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                         <?php if(userPermission(239)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'online-exam',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                       
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="title" autocomplete="off"  value="<?php echo e(isset($online_exam)? $online_exam->title: old('title')); ?>">
                                            <input type="hidden" name="id"  value="<?php echo e(isset($online_exam)? $online_exam->id: ''); ?>">
                                            <label><?php echo app('translator')->get('exam.exam_title'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('title')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('title')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="classSelectStudentHomeWork" name="class">
                                            <option data-display="<?php echo app('translator')->get('common.select_class'); ?> *" value=""><?php echo app('translator')->get('common.select_class'); ?> *</option>
                                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($class->id); ?>" <?php echo e(isset($online_exam)? ($class->id == $online_exam->class_id? 'selected':''): (old('class') == $class->id? 'selected':'')); ?>><?php echo e($class->class_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('class')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('class')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>

                                   
                                </div>
                           
                                <div class="row mt-25">
                                    <div class="col-lg-12" id="subjectSelecttHomeworkDiv">
                                        <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?>" id="subjectSelect" name="subject">
                                            <option data-display="<?php echo app('translator')->get('common.select_subjects'); ?> *" value=""><?php echo app('translator')->get('common.select_subjects'); ?>  *</option>
                                            <?php if(isset($online_exam)): ?>
                                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($subject->subject_id); ?>" <?php echo e($online_exam->subject_id == $subject->subject_id? 'selected': ''); ?>><?php echo e($subject->subject->subject_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="pull-right loader loader_style" id="select_subject_loader">
                                            <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                        </div>
                                        <?php if($errors->has('subject')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert" >
                                            <strong><?php echo e($errors->first('subject')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <?php if(isset($online_exam)): ?> 
                                    <div class="col-lg-12 mt-30-md" id="select_section_div">
                                        <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                            <option data-display="<?php echo app('translator')->get('common.select_section'); ?> *" value=""><?php echo app('translator')->get('common.select_section'); ?> *</option>
                                            <?php if(isset($online_exam)): ?>
                                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($section->section_id); ?>" <?php echo e($online_exam->section_id == $section->section_id? 'selected': ''); ?>><?php echo e($section->section->section_name); ?></option>
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
                                   <?php else: ?>

                                    <div class="col-lg-12" id="selectSectionsDiv">
                                        <label for="checkbox" class="mb-2"><?php echo app('translator')->get('common.section'); ?> *</label>
                                        <select multiple id="selectSectionss" name="section[]" style="width:300px">
                                                                                  

                                         </select>
                                        <div class="">
                                            <input type="checkbox" id="checkbox_section" class="common-checkbox">
                                            <label for="checkbox_section" class="mt-3"><?php echo app('translator')->get('exam.select_all'); ?></label>
                                        </div>
                                        <?php if($errors->has('section')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert" style="display:block">
                                                <strong style="top:-25px"><?php echo e($errors->first('section')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                     </div>    
                                     <?php endif; ?>                               
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>" id="startDate" type="text" name="date" autocomplete="off" value="<?php echo e(isset($online_exam)? date('m/d/Y', strtotime($online_exam->date)): (old('date') != ""? old('date'): date('m/d/Y'))); ?>" >
                                            <label><?php echo app('translator')->get('common.date'); ?>  <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                    
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('end_date') ? ' is-invalid' : ''); ?>" id="end_date" type="text" name="end_date" autocomplete="off" value="<?php echo e(isset($online_exam)? date('m/d/Y', strtotime($online_exam->end_date_time)): (old('end_date') != ""? old('end_date'): date('m/d/Y'))); ?>" >
                                            <label><?php echo app('translator')->get('exam.end_date'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('end_date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('end_date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                    
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input time form-control<?php echo e($errors->has('start_time') ? ' is-invalid' : ''); ?>" type="text" name="start_time" value="<?php echo e(isset($online_exam)? $online_exam->start_time: old('start_time')); ?>">
                                            <label><?php echo app('translator')->get('exam.start_time'); ?> *</label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('start_time')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('start_time')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-timer"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-25">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input time  form-control<?php echo e($errors->has('end_time') ? ' is-invalid' : ''); ?>" type="text" name="end_time"  value="<?php echo e(isset($online_exam)? date('H:i', strtotime($online_exam->end_date_time)): (old('end_date') != ""? old('end_date'): date('H:i'))); ?>">
                                                <label><?php echo app('translator')->get('exam.end_time'); ?></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('end_time')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('end_time')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-timer"></i>
                                            </button>
                                        </div>
                                    </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="numberCheckWithDot(this)" class="primary-input form-control<?php echo e($errors->has('percentage') ? ' is-invalid' : ''); ?>"
                                                type="text" name="percentage" autocomplete="off" value="<?php echo e(isset($online_exam)? $online_exam->percentage: old('percentage')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($online_exam)? $online_exam->id: ''); ?>">
                                            <label><?php echo app('translator')->get('exam.minimum_percentage'); ?> *</label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('percentage')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('percentage')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control<?php echo e($errors->has('instruction') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="instruction"><?php echo e(isset($online_exam)? $online_exam->instruction: old('instruction')); ?></textarea>
                                            <label><?php echo app('translator')->get('exam.instruction'); ?> <span>*</span></label>
                                            <span class="focus-border textarea"></span>
                                            <?php if($errors->has('instruction')): ?>
                                                <span class="error text-danger"><strong><?php echo e($errors->first('instruction')); ?></strong></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input type="checkbox" id="auto_mark"
                                                    class="common-checkbox form-control<?php echo e(@$errors->has('auto_mark') ? ' is-invalid' : ''); ?>" <?php echo e(isset($online_exam) && $online_exam->auto_mark == 1? 'checked': ''); ?>  name="auto_mark" value="1">
                                            <label for="auto_mark"><?php echo app('translator')->get('exam.auto_mark_register'); ?></label>
                                            <span> (<?php echo app('translator')->get('exam.only_for_multiple'); ?>)</span>
                                        </div>
                                    </div>
                                </div>
                                
                                 <?php 
                                  $tooltip = "";
                                  if(userPermission(239)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                         <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($online_exam)): ?>
                                                <?php echo app('translator')->get('exam.update_online_exam'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('exam.save_online_exam'); ?>
                                            <?php endif; ?>
                                          
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="url" value="<?php echo e(Request::url()); ?>">
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('exam.online_exam_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                               
                                <tr>
                                    <th><?php echo app('translator')->get('exam.title'); ?></th>
                                    <th><?php echo app('translator')->get('common.class_Sec'); ?></th>
                                    <th><?php echo app('translator')->get('exam.subject'); ?></th>
                                    <th><?php echo app('translator')->get('exam.exam_date'); ?></th>
                                    <th><?php echo app('translator')->get('exam.duration'); ?></th>
                                    <th><?php echo app('translator')->get('exam.minimum_percentage'); ?></th>
                                    <th><?php echo app('translator')->get('common.status'); ?></th>
                                    <th><?php echo app('translator')->get('common.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $online_exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $online_exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($online_exam->title); ?></td>
                                    <td>
                                        <?php
                                        if($online_exam->class !="" && $online_exam->section !="" ){
                                         echo $online_exam->class->class_name.'  ('.$online_exam->section->section_name.')';
                                        }
                                        ?>
                                       </td>
                                    <td><?php echo e($online_exam->subject!=""?$online_exam->subject->subject_name:""); ?></td>
                                    <td>
                                        
                                    <?php echo e($online_exam->date != ""? dateConvert($online_exam->date):''); ?>


                                     <br> <?php echo app('translator')->get('exam.time'); ?>: <?php echo e(date("h:i A", strtotime($online_exam->start_time))); ?> -<?php echo e($online_exam->end_date_time !='NULL' ? date("h:i A", strtotime($online_exam->end_date_time)):'Unlimited'); ?></td>

                                     <?php 
                                   
                                       $totalDuration = $online_exam->end_time !='NULL' ? Carbon::parse($online_exam->end_time)->diffinminutes( Carbon::parse($online_exam->start_time) ) : 0;

                                      ?>
                                    <td>
                                        <?php echo e($online_exam->end_time !='NULL' ? gmdate($totalDuration) : 'Unlimited'); ?> Min
                                    </td>
                                    <td>
                                        <?php echo e(@$online_exam->percentage); ?>

                                    </td>
                                    <td>
                                        <?php if($online_exam->status == 0): ?>
                                         <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('common.pending'); ?></button>
                                         <?php else: ?>
                                         <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('exam.published'); ?></button>
                                         <?php endif; ?>
                                    </td>
                                    <td style="width: 30%">
                                        <div class="dropdown d-flex">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('common.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <?php 
                                                    $is_set_online_exam_questions = DB::table('sm_online_exam_question_assigns')->where('online_exam_id', $online_exam->id)->first();
                                                    $startTime = strtotime($online_exam->date . ' ' . $online_exam->start_time);
                                                    $endTime = strtotime($online_exam->date . ' ' . $online_exam->end_time);
                                                    $now = date('h:i:s');
                                                    $now =  strtotime("now");
                                                ?>
                                                <?php if($startTime < $now && $online_exam->status == 1): ?>
                                                    
                                                <?php else: ?>
                                                    <?php if(!empty($is_set_online_exam_questions)): ?> 
                                                        <?php if(userPermission(242)): ?> 
                                                        <a class="dropdown-item" href="<?php echo e(route("manage_online_exam_question", [$online_exam->id])); ?>"><?php echo app('translator')->get('exam.manage_question'); ?></a>
                                                        
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                
                                                <?php if($startTime < $now && $online_exam->status == 1): ?>
                                                    <?php if(userPermission(243)): ?>

                                                    <a class="dropdown-item" href="<?php echo e(route("online_exam_marks_register", [$online_exam->id])); ?>"><?php echo app('translator')->get('exam.marks_register'); ?></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if($startTime < $now && $online_exam->status == 1): ?>
                                                    
                                                <?php else: ?>
                                                    <?php if(userPermission(240)): ?>

                                                    <a class="dropdown-item" href="<?php echo e(route("online-exam-edit",$online_exam->id)); ?>"><?php echo app('translator')->get('common.edit'); ?></a>

                                                    <?php endif; ?>
                                                    <?php if(userPermission(241)): ?>
                                                
                                                    <a onclick="examDelete(<?php echo e($online_exam->id); ?>)" href="javascript:void(0)" class="dropdown-item "  ><?php echo app('translator')->get('common.delete'); ?></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if(!empty($is_set_online_exam_questions)): ?> 
                                                        <?php if(userPermission(242)): ?> 
                                                            <a class="dropdown-item" href="<?php echo e(route("online-exam-question-view", [$online_exam->id])); ?>"><?php echo app('translator')->get('common.view_question'); ?></a>
                                                        <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if($online_exam->end_date_time < $present_date_time && $online_exam->status == 1): ?>
                                                <?php if(userPermission(244)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('online_exam_result', [$online_exam->id])); ?>"><?php echo app('translator')->get('exam.result'); ?></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            </div> 
                                            <?php if(empty($is_set_online_exam_questions)): ?> 
                                                <?php if(userPermission(242)): ?> 
                                                    <a class="primary-btn small bg-success text-white border-0 ml-3" href="<?php echo e(route("manage_online_exam_question", [$online_exam->id])); ?>">
                                                         <?php echo app('translator')->get('exam.set_question'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                            
                                                <?php if($online_exam->status == 0): ?>
                                                    <a class="ml-3" href="<?php echo e(route('online_exam_publish', [$online_exam->id])); ?>">
                                                        <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('exam.published_now'); ?> </button>
                                                    </a> 
                                                <?php endif; ?>
                                             <?php endif; ?>
                                        </div>
                                        
                                    </td>
                                </tr>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade admin-query" id="deleteOnlineExam">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('exam.delete_online_exam'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                     <?php echo e(Form::open(['route' => 'online-exam-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="online_exam_id" id="online_exam_id">
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.delete'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    function examDelete(id){
        var modal = $('#deleteOnlineExam');
         modal.find('input[name=online_exam_id]').val(id)
         modal.modal('show');
    }
</script>    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/examination/online_exam.blade.php ENDPATH**/ ?>