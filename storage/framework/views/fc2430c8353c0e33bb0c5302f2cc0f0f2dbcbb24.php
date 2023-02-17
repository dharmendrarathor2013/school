<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/')); ?>/frontend/css/new_style.css"/>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('main_content'); ?>
    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="banner-area" style="background: linear-gradient( 0deg, rgba(124, 50, 255, 0.6), rgba(199, 56, 216, 0.6)), url(<?php echo e(asset($news->image)); ?>) no-repeat center;">
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

   <!--================ News Details Area =================-->
    <section class="news-details-area section-gap-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h1><?php echo e($news->news_title); ?></h1>
                    <div class="meta mb-30 d-flex flex-md-row flex-column">
                        <div class="date text-uppercase">
                            <span class="ti-calendar mr-10"></span>   
                            <?php echo e($news->publish_date != ""? dateConvert($news->publish_date):''); ?>

                        </div>
                        <div class="date text-uppercase">
                            <span class="ti-map-alt mr-10"></span>
                            <?php echo e($news->category->category_name); ?>

                        </div>
                    </div>
                    <div class="news-img">
                        <img class="img-fluid news-image" src="<?php echo e(asset($news->image)); ?>" alt="<?php echo e($news->news_title); ?>">
                    </div>
                    <p class="mt-2">
                        <?php echo $news->news_body; ?>

                    </p>

                </div>

                <div class="col-lg-3 notice-board-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">><?php echo app('translator')->get('communicate.notice_board'); ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="notice-board">
                                <?php if(isset($notice_board)): ?>
                                <?php $__currentLoopData = $notice_board; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="notice-item">
                                        <p class="date">
                                            
            <?php echo e($notice->publish_on != ""? dateConvert($notice->publish_on):''); ?>


                                        </p>
                                        <h4><?php echo e($notice->notice_title); ?></h4>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End News Details Area =================-->
    
    <!--================ Related News Area =================-->
    <section class="news-area section-gap-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title"><?php echo app('translator')->get('front_settings.related_news'); ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $otherNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theNews): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="news-item">
                                <div class="news-img">
                                    <img class="img-fluid w-100 news-image" src="<?php echo e(asset($theNews->image)); ?>" alt="">
                                </div>
                                <div class="news-text">
                                    <p class="date">
                                        
<?php echo e($theNews->publish_date != ""? dateConvert($theNews->publish_date):''); ?>


                                    </p>
                                    <h4>
                                        <a href="<?php echo e(url('news-details/'.$theNews->id)); ?>">
                                            <?php echo e($theNews->news_title); ?>

                                        </a>
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
    <!--================ End Related News Area =================-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\InfixEduv6.6.1\resources\views/frontEnd/home/light_news_details.blade.php ENDPATH**/ ?>