<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('lesson::lesson.lesson_plan_overview'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>


    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo e($student_detail->full_name); ?>-<?php echo app('translator')->get('lesson::lesson.lesson_plan_overview'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lesson::lesson.lesson'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lesson::lesson.lesson_plan_overview'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">

        </div>
        <div class="row mt-40">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('lesson::lesson.lesson'); ?></th>
                            <th><?php echo app('translator')->get('lesson::lesson.topic'); ?></th>
                            <th>
                                <?php if(generalSetting()->sub_topic_enable): ?>
                                    <?php echo app('translator')->get('lesson::lesson.sup_topic'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('common.note'); ?>
                                <?php endif; ?>
                            </th>
                            <th><?php echo app('translator')->get('lesson::lesson.completed_date'); ?> </th>
                            <th><?php echo app('translator')->get('lesson::lesson.upcoming_date'); ?> </th>
                            <th><?php echo app('translator')->get('common.status'); ?></th>

                        </tr>
                        </thead>

                        <tbody>
                        <?php $__currentLoopData = $lessonPlanner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                            <tr>
                                <td><?php echo e(@$data->lessonName !=""?@$data->lessonName->lesson_title:""); ?></td>

                                <td>
                                    <?php if(count($data->topics) > 0): ?>
                                    <?php $__currentLoopData = $data->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($topic->topicName->topic_title); ?> </br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php echo e($data->topicName->topic_title); ?>

                                    <?php endif; ?>

                                </td>

                                <td>
                                    <?php if(generalSetting()->sub_topic_enable): ?>
                                    <?php if(count($data->topics) > 0): ?>
                                    <?php $__currentLoopData = $data->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($topic->sub_topic_title); ?> </br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php echo e($data->sub_topic); ?>

                                    <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo e($data->note); ?>

                                    <?php endif; ?>
                                </td>
                                <td>


                                    <?php echo e(@$data->competed_date !=""?@$data->competed_date:""); ?><br>


                                </td>
                                <td>


                                    <?php if(date('Y-m-d')< $data->lesson_date && $data->competed_date==""): ?>
                                        <?php echo app('translator')->get('lesson::lesson.upcoming'); ?>     (<?php echo e($data->lesson_date); ?>)<br>
                                    <?php elseif($data->competed_date==""): ?>
                                        <?php echo app('translator')->get('lesson::lesson.assigned_date'); ?>(<?php echo e($data->lesson_date); ?>)
                                        <br>
                                    <?php else: ?>

                                    <?php endif; ?>

                                </td>
                                <td>

                                    <?php if(date('Y-m-d')< $data->lesson_date && $data->competed_date==""): ?>
                                        <?php echo app('translator')->get('lesson::lesson.upcoming'); ?> <br>
                                    <?php elseif($data->competed_date==""): ?>
                                        <?php echo app('translator')->get('lesson::lesson.incomplete'); ?>
                                        <br>
                                    <?php else: ?>
                                        <strong><?php echo app('translator')->get('lesson::lesson.completed'); ?></strong> <br>
                                    <?php endif; ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/Modules/Lesson/Resources/views/parent/parent_lesson_plan_overview.blade.php ENDPATH**/ ?>