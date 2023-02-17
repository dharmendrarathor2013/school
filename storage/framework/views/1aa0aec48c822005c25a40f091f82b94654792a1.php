    <?php $__env->startSection('title'); ?> 
        <?php echo app('translator')->get('fees.fees_group'); ?>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('fees.fees_group'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('fees.fees'); ?></a>
                <?php if(isset($feesGroup)): ?>
                    <a href="#"><?php echo app('translator')->get('fees.edit_fees_group'); ?></a>
                <?php else: ?>
                    <a href="#"><?php echo app('translator')->get('fees.fees_group'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($feesGroup)): ?>
            <?php if(userPermission(1132)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(route('fees.fees-group')); ?>" class="primary-btn small fix-gr-bg"><span class="ti-plus pr-2"></span><?php echo app('translator')->get('common.add'); ?></a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                <?php if(isset($feesGroup)): ?>
                                    <?php echo app('translator')->get('fees.edit_fees_group'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('fees.add_fees_group'); ?>
                                <?php endif; ?>
                                 
                            </h3>
                        </div>
                        <?php if(isset($feesGroup)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'route' => 'fees.fees-group-update', 'method' => 'POST'])); ?>

                            <input type="hidden" name="id" value="<?php echo e(isset($feesGroup)? $feesGroup->id: ''); ?>">
                        <?php else: ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'route' => 'fees.fees-group-store', 'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" type="text" name="name" autocomplete="off" value="<?php echo e(isset($feesGroup)? $feesGroup->name: old('name')); ?>">
                                            <label><?php echo app('translator')->get('common.name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                name="description"><?php echo e(isset($feesGroup)? $feesGroup->description: old('description')); ?></textarea>
                                                <label><?php echo app('translator')->get('common.description'); ?></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <?php if(userPermission(1132) || userPermission(1133)): ?>
                                            <button class="primary-btn fix-gr-bg submit">
                                                <span class="ti-check"></span>
                                                <?php if(isset($feesGroup)): ?>
                                                    <?php echo app('translator')->get('common.update'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('common.save'); ?>
                                                <?php endif; ?>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"> <?php echo app('translator')->get('fees.fees_group_list'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th> <?php echo app('translator')->get('common.name'); ?></th>
                                    <th> <?php echo app('translator')->get('common.description'); ?></th>
                                    <th> <?php echo app('translator')->get('common.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $feesGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feesGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($feesGroup->name); ?></td>
                                    <td><?php echo e(@$feesGroup->description); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('common.select'); ?>
                                            </button>
                                         
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(1133)): ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('fees.fees-group-edit', [$feesGroup->id])); ?>"> <?php echo app('translator')->get('common.edit'); ?></a>
                                                <?php endif; ?>

                                                <?php if(userPermission(1134)): ?>
                                                    <a class="dropdown-item deleteFeesGroupModal" data-toggle="modal" data-target="#deleteFeesGroupModal<?php echo e($feesGroup->id); ?>" href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                                <?php endif; ?>
                                            </div> 
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade admin-query" id="deleteFeesGroupModal<?php echo e($feesGroup->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"> <?php echo app('translator')->get('fees.delete_fees_group'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                
                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4> <?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                </div>
                                
                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => 'fees.fees-group-delete', 'method' => 'POST',])); ?>

                                                        <input type="hidden" name="id" value="<?php echo e($feesGroup->id); ?>">
                                                        <button class="primary-btn fix-gr-bg" type="submit"> <?php echo app('translator')->get('common.delete'); ?></button>
                                                     <?php echo e(Form::close()); ?>

                                                </div>
                                            </div>
                                
                                        </div>
                                    </div>
                                </div>
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
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/Modules/Fees/Resources/views/feesGroup.blade.php ENDPATH**/ ?>