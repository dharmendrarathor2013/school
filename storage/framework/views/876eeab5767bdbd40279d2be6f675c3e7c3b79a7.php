<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('communicate.add_notice'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('communicate.add_notice'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('communicate.communicate'); ?></a>
                <a href="#"><?php echo app('translator')->get('communicate.add_notice'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
     <?php if(userPermission(288) ): ?>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('communicate.add_notice'); ?></h3>
                </div>
            </div>
            <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                <a href="<?php echo e(route('notice-list')); ?>" class="primary-btn small fix-gr-bg">
                    <?php echo app('translator')->get('communicate.notice_board'); ?>
                </a>
            </div>
        </div>
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'save-notice-data', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

        <div class="row">
            <div class="col-lg-12">
             
              <div class="white-box">
                <div class="">
                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="input-effect mb-30">
                                <input class="primary-input form-control<?php echo e($errors->has('notice_title') ? ' is-invalid' : ''); ?>"
                                type="text" name="notice_title" autocomplete="off" value="<?php echo e(isset($leave_type)? $leave_type->type:''); ?>">
                                <label><?php echo app('translator')->get('common.title'); ?> <span>*</span> </label>
                                <span class="focus-border"></span>
                                <?php if($errors->has('notice_title')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('notice_title')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="input-effect mt-0">
                                <label><?php echo app('translator')->get('communicate.notice'); ?> <span></span> </label>
                                <textarea class="primary-input form-control" cols="0" rows="5" name="notice_message" id="article-ckeditor"></textarea>
                                
                                
                            </div>

                           
                                <div class="input-effect mt-40"> 
                                    <input type="checkbox" id="is_published" class="common-checkbox" value="1" name="is_published">
                                    <label for="is_published"><?php echo app('translator')->get('communicate.is_published_web_site'); ?></label> 
                                </div>
                           

                        </div>


                        <div class="col-lg-5">
                         <div class="no-gutters input-right-icon mb-30">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control<?php echo e($errors->has('notice_date') ? ' is-invalid' : ''); ?>" id="notice_date" type="text" autocomplete="off" 
                                    name="notice_date" value="<?php echo e(date('m/d/Y')); ?>">
                                    <label><?php echo app('translator')->get('communicate.notice_date'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('notice_date')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('notice_date')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-calendar" id="notice_date_icon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="no-gutters input-right-icon">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control<?php echo e($errors->has('publish_on') ? ' is-invalid' : ''); ?>" id="publish_on" type="text" autocomplete="off" 
                                    name="publish_on" value="<?php echo e(date('m/d/Y')); ?>">
                                    <label><?php echo app('translator')->get('communicate.publish_on'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('publish_on')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('publish_on')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="" type="button">
                                    <i class="ti-calendar" id="publish_on_icon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-50">
                            <label><?php echo app('translator')->get('communicate.message_to'); ?></label><br>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($role->name == 'Super admin'): ?>
                                                <div class="" style="display: none;">
                                                   
                                                </div>
                                                <?php else: ?>
                                                <div class="">
                                                    <input type="checkbox" id="role_<?php echo e(@$role->id); ?>"
                                                        class="common-checkbox" value="<?php echo e(@$role->id); ?>" name="role[]">
                                                    <label for="role_<?php echo e(@$role->id); ?>"><?php echo e(@$role->name); ?></label>
                                                </div>
                                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($errors->has('section')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('section')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg submit">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('communicate.save_content'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>

<?php endif; ?>
</section>
<?php $__env->stopSection(); ?> 

<?php $__env->startPush('scripts'); ?>
<script>
    CKEDITOR.replace( 'notice_message' );
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/communicate/sendMessage.blade.php ENDPATH**/ ?>