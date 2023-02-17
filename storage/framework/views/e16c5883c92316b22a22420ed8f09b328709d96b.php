<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lesson::lesson.topic_overview'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lesson::lesson.topic_overview'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lesson::lesson.lesson'); ?></a>
                <a href="#"><?php echo app('translator')->get('lesson::lesson.topic_overview'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
  
    </div>

            <div class="row">
                <div class="col-lg-12">
            
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'search-topic-overview', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_lesson_Plan'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-3 mt-30-md">
                                    <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('lesson') ? ' is-invalid' : ''); ?>" name="lesson">
                                        <option data-display="<?php echo app('translator')->get('lesson::lesson.lesson'); ?> *" value=""><?php echo app('translator')->get('lesson::lesson.lesson'); ?> *</option>
                                    <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lesson->id); ?>"  <?php echo e(isset($lesson_id)? ($lesson_id == $lesson->id? 'selected':''):''); ?>><?php echo e($lesson->lesson_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                    </select>
                                    <?php if($errors->has('lesson')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('lesson')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                              
    
    
                                
                                <div class="col-lg-3 mt-20 text-right">
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
            <?php if(isset($topics_detail)): ?>
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title" style="padding-left: 15px;">
                                
                            
                           
                           
                            </div>
                        </div>
                    </div>
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table school-table-style" cellspacing="0" width="100%">

                        <thead>
                        
                            <tr>
                                <th><?php echo app('translator')->get('lesson::lesson.lesson'); ?></th>
                                <th><?php echo app('translator')->get('lesson::lesson.topic'); ?></th>
                                <th><?php echo app('translator')->get('lesson::lesson.completed_date'); ?> </th>
                                <th><?php echo app('translator')->get('lesson::lesson.teacher'); ?> </th>
                                <th><?php echo app('translator')->get('common.status'); ?></th>
                           
                            </tr>
                        </thead>

                    <tbody>
                        <?php $__currentLoopData = $topics_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  
                        <tr>
                            <td><?php echo e($data->lesson_title !=""? $data->lesson_title->lesson_title:""); ?></td>
                            <td> <?php echo e(@$data->topic_title !=""?@$data->topic_title:""); ?></td>

                            <td>
                                <?php $__currentLoopData = $data->lessonPlan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php if($status->competed_date !="" && $status->completed_status !=""): ?> 
                                   <?php echo e($status->competed_date); ?> <br>
                                   <?php else: ?>
                                        <?php if(date('Y-m-d')< $status->lessonDetail->lesson_date): ?>
                                        Assign
                                        <?php else: ?>
                                        Assigned
                                        <?php endif; ?>

                                     Date (<?php echo e($status->lessonDetail->lesson_date); ?>)<br>
                                   <?php endif; ?>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                             <td>
                            <?php $__currentLoopData = $data->lessonPlan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php if($status->lessonDetail->competed_date !="" && $status->lessonDetail->completed_status !=""): ?> 
                                   
                                  <strong>
                                     <?php echo e($status->lessonDetail->teacherName->full_name); ?>

                                    </strong> <br>
                                   <?php else: ?>
                                   <span> 
                                    <?php echo e($status->lessonDetail->teacherName->full_name); ?>

                                    </span><br>
                                   <?php endif; ?>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td>
                            <?php $__currentLoopData = $data->lessonPlan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php if($status->lessonDetail->competed_date !="" && $status->lessonDetail->completed_status !=""): ?> 
                                   
                                  <strong class="gradient-color2"><?php echo app('translator')->get('lesson::lesson.completed'); ?></strong> <br>
                                   <?php else: ?>
                                   <span class="gradient-color"><?php echo app('translator')->get('lesson::lesson.incomplete'); ?></span><br>
                                   <?php endif; ?>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                           
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </tbody>
                    </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/Modules/Lesson/Resources/views/lessonPlan/manage_lesson.blade.php ENDPATH**/ ?>