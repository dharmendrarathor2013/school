<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('communicate.notice_board'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('communicate.notice_board'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                
                <a href="#"><?php echo app('translator')->get('communicate.notice_board'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="mb-40 sms-accordion">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('communicate.all_notices'); ?></h3>
                </div>
            </div>
        </div>
         
        <div class="row">
            <div class="col-lg-12">
                <div id="accordion">
                   <?php $i = 0; ?>
                   <?php if(isset($allNotices)): ?>
                   <?php $__currentLoopData = $allNotices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <div class="card">
                     <a class="card-link" data-toggle="collapse" href="#notice<?php echo e($value->id); ?>">
                        <div class="card-header d-flex justify-content-between">

                            <?php echo e($value->notice_title); ?>

                        </div>
                    </a>
                    <?php $i++; ?>
                    <div id="notice<?php echo e($value->id); ?>" class="collapse <?php echo e($i ==  1 ? 'show' : ''); ?>" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <?php echo $value->notice_message; ?>

                                </div>
                                <div class="col-lg-4">
                                    <p class="mb-0">
                                        <span class="ti-calendar mr-10"></span>
                                        <?php echo app('translator')->get('communicate.publish_date'); ?> :  <?php echo e($value->publish_on != ""? dateConvert($value->publish_on):''); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/parentPanel/parentNoticeboard.blade.php ENDPATH**/ ?>