<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('communicate.sms_template'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<?php $__env->startPush('css'); ?>
    <style>
        .custom_nav li a.active {
            background-color: #fbfbfb;
        }
    </style>
<?php $__env->stopPush(); ?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('communicate.sms_template'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('communicate.communicate'); ?></a>
                <a href="#"><?php echo app('translator')->get('communicate.sms_template'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">    
        <div class="row">
            <div class="col-lg-4">
                <div class="white-box">
                    <div class="add-visitor">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="nav custom_nav flex-column" id="myTab" role="tablist">
                                    <?php $__currentLoopData = $smsTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$smsTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!$smsTemplate->module || moduleStatusCheck($smsTemplate->module)==TRUE): ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?php echo e($key==0 ? "active" : ""); ?>" id="<?php echo e($smsTemplate->purpose); ?>-tab" data-toggle="tab" href="#<?php echo e($smsTemplate->purpose); ?>" role="tab" aria-controls="<?php echo e($smsTemplate->purpose); ?>" aria-selected="<?php echo e($key==0 ? "true" : "false"); ?>">
                                                    <?php echo app('translator')->get('communicate.'.$smsTemplate->purpose); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <div class="tab-content" id="myTabContent">
                                <?php $__currentLoopData = $smsTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$smsTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!$smsTemplate->module||moduleStatusCheck($smsTemplate->module)== TRUE): ?>
                                        <div class="tab-pane fade white_box_30px <?php echo e($key==0 ? "active show" : ""); ?>" id="<?php echo e($smsTemplate->purpose); ?>" role="tabpanel">
                                            <?php echo e(Form::open(['class' => 'form-horizontal', 'route' => 'templatesettings.sms-template-update', 'method' => 'POST'])); ?>

                                                <div class="row">
                                                    <div class="col-lg-10 mb-20">
                                                        <label> <strong><?php echo app('translator')->get('communicate.variables'); ?> :</strong>  </label>
                                                        <span class="text-primary">
                                                            <?php echo e($smsTemplate->variable); ?>

                                                        </span>
                                                    </div>
                                                    <div class="col-lg-2 mb-20">
                                                        <div class="input-effect">
                                                            <input type="checkbox" id="email_enable<?php echo e($smsTemplate->id); ?>" class="common-checkbox exam-checkbox" name="status" value="1" <?php echo e(isset($smsTemplate)? ($smsTemplate->status == 1? 'checked':''):''); ?>>
                                                            <label for="email_enable<?php echo e($smsTemplate->id); ?>"><?php echo app('translator')->get('communicate.enable'); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="id" value="<?php echo e($smsTemplate->id); ?>">
                                                        <input type="hidden" name="purpose" value="<?php echo e($smsTemplate->purpose); ?>">
                                        
                                                        <div class="input-effect mt-20">
                                                            <label><?php echo app('translator')->get('communicate.body'); ?></label>
                                                                <textarea class="primary-input form-control<?php echo e($errors->has('body') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="body" maxlength="500"><?php echo e(isset($smsTemplate)? $smsTemplate->body: old($smsTemplate->body)); ?></textarea>
                                                            <span class="focus-border textarea"></span>
                                                            <?php if($errors->has('body')): ?>
                                                                <span class="error text-danger"><strong><?php echo e($errors->first('body')); ?></strong></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <div class="row mt-40">
                                                    <div class="col-lg-12 text-center">
                                                        <button class="primary-btn fix-gr-bg" title="<?php echo app('translator')->get('communicate.update'); ?>">
                                                            <span class="ti-check"></span>
                                                            <?php echo app('translator')->get('communicate.update'); ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php echo e(Form::close()); ?>

                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        // back to top
        $(".custom_nav li").on("click", function () {
            $("body,html").animate({scrollTop: 0,},1000);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/Modules/TemplateSettings/Resources/views/smsTemplate.blade.php ENDPATH**/ ?>