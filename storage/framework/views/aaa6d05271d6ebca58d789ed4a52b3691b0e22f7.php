<?php $__env->startSection('main_content'); ?>
<?php $__env->startPush('css'); ?>
<style>
    .academic-img{
            height: 220px;
            background-size : cover !important;
            background-position: top center !important; 
        }
</style>
<?php $__env->stopPush(); ?>

    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="banner-area" style="background: linear-gradient(0deg, rgba(124, 50, 255, 0.6), rgba(199, 56, 216, 0.6)), url(<?php echo e($course->image != ""? asset($course->image) : '../img/client/common-banner1.jpg'); ?>) no-repeat center;">
            <div class="banner-inner">
                <div class="banner-content">
                    <h2><?php echo e($course->title); ?></h2>
                    
                    
                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Course Overview Area =================-->
    <section class="overview-area student-details section-gap-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs mb-50 ml-0" role="tablist">
                        <?php if($course->overview): ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="#overviewTab" role="tab" data-toggle="tab"><?php echo app('translator')->get('front_settings.overview'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($course->outline): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#outlineTab" role="tab" data-toggle="tab"><?php echo app('translator')->get('front_settings.outline'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($course->prerequisites): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#prerequisitesTab" role="tab" data-toggle="tab"><?php echo app('translator')->get('front_settings.prerequisites'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($course->resources): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#resourcesTab" role="tab" data-toggle="tab"><?php echo app('translator')->get('front_settings.resources'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($course->stats ): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#statsTab" role="tab" data-toggle="tab"><?php echo app('translator')->get('front_settings.stats'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Overview Tab -->
                        <div role="tabpanel" class="tab-pane fade show active" id="overviewTab">
                            <p>
                               <?php echo $course->overview; ?>

                            </p>
                        </div>
                        <!-- End Overview Tab -->

                        <!-- Start Outline Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="outlineTab">
                            <p>
                                <?php echo $course->outline; ?>

                            </p>
                        </div>
                        <!-- End Outline Tab -->

                        <!-- Start Prerequisites Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="prerequisitesTab">
                            <p>
                                <?php echo $course->prerequisites; ?>

                            </p>
                        </div>
                        <!-- End Prerequisites Tab -->

                        <!-- Start Resources Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="resourcesTab">
                            <p>
                                <?php echo $course->resources; ?>

                            </p>
                        </div>
                        <!-- End Resources Tab -->

                        <!-- Start Stats Tab -->
                        <div role="tabpanel" class="tab-pane fade" id="statsTab">
                            <p>
                                <?php echo $course->stats; ?>

                            </p>
                        </div>
                        <!-- End Stats Tab -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Course Overview Area =================-->

    <!--================ Related Course Area =================-->
    <section class="academics-area section-gap-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title"><?php echo app('translator')->get('front_settings.related_courses'); ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img"
                                style="background:  
                                url(<?php echo e($course->image != ""? asset($course->image) : '../img/client/common-banner1.jpg'); ?>) 
                                            no-repeat top;">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="<?php echo e(url('course-Details/'.$course->id)); ?>"><?php echo e($course->title); ?></a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Related Course Area =================-->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/frontEnd/home/light_course_details.blade.php ENDPATH**/ ?>