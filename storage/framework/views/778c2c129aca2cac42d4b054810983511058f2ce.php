    <?php $__env->startSection('title'); ?>
        <?php echo app('translator')->get('transport.transport_route'); ?>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  
    $setting = app('school_info');
    if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } 
?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('transport.transport_route'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('transport.transport'); ?></a>
                <a href="#"><?php echo app('translator')->get('transport.transport_route'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($route)): ?>
            <?php if(userPermission(350)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(route('transport-route')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">
                                <?php if(isset($route)): ?>
                                    <?php echo app('translator')->get('transport.edit_route'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('transport.add_route'); ?>
                                <?php endif; ?>
                                
                            </h3>
                        </div>
                        <?php if(isset($route)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('transport-route-update',@$route->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                            <?php if(userPermission(350)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'transport-route', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>" type="text" name="title" autocomplete="off" value="<?php echo e(isset($route)? @$route->title:old('title')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($route)? @$route->id: ''); ?>">
                                            <label><?php echo app('translator')->get('transport.route_title'); ?> <span>*</span></label>
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
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('far') ? ' is-invalid' : ''); ?>" type="number" step="0.1" name="far" autocomplete="off" value="<?php echo e(isset($route)? @$route->far:old('far')); ?>">
                                            <label><?php echo app('translator')->get('transport.fare'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('far')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('far')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $tooltip = "";
                                    if(userPermission(350)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                                <?php if(isset($route)): ?>
                                                    <?php echo app('translator')->get('transport.update_route'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('transport.save_route'); ?>
                                                <?php endif; ?>                                          
                                        </button>
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
                            <h3 class="mb-0">  <?php echo app('translator')->get('transport.route_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('common.sl'); ?></th>
                                    <th> <?php echo app('translator')->get('transport.route_title'); ?></th>
                                    <th> <?php echo app('translator')->get('transport.fare'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                    <th> <?php echo app('translator')->get('common.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e(@$route->title); ?></td>
                                    <td><?php echo e(number_format((float)@$route->far, 2, '.', '')); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('common.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(351)): ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('transport-route-edit', [@$route->id])); ?>"> <?php echo app('translator')->get('common.edit'); ?></a>
                                                <?php endif; ?>
                                                <?php if(userPermission(352)): ?>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteRouteModal<?php echo e(@$route->id); ?>" href="#"> <?php echo app('translator')->get('common.delete'); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteRouteModal<?php echo e(@$route->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"> <?php echo app('translator')->get('transport.delete_route'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4> <?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                </div>
                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"> <?php echo app('translator')->get('common.cancel'); ?></button>
                                                    <?php echo e(Form::open(['route' => array('transport-route-delete',@$route->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/transport/route.blade.php ENDPATH**/ ?>