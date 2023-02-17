<?php $__env->startSection('mainContent'); ?>


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('rolepermission::role.role_permission'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('rolepermission::role.role_permission'); ?></a>
                <a href="#"><?php echo app('translator')->get('rolepermission::role.role'); ?></a> 
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($role)): ?>
                                    <?php echo app('translator')->get('rolepermission::role.edit_role'); ?>

                                <?php else: ?>
                                    <?php echo app('translator')->get('rolepermission::role.add_role'); ?>

                                <?php endif; ?>
                              
                            </h3>
                        </div>
                        <?php if(isset($role)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'rolepermission/role-update',
                        'method' => 'POST'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(418) ): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'rolepermission/role-store', 'method'
                        => 'POST'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                       
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="name" autocomplete="off" value="<?php echo e(isset($role)? @$role->name: ''); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($role)? @$role->id: ''); ?>">
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
                                <?php 
                                    $tooltip = "";
                                    if(userPermission(418) ){
                                            $tooltip = "";
                                        }else{
                                            $tooltip = "You have no permission to add";
                                        }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php echo e(!isset($role) ? 'save': 'update'); ?>

                                            
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
                            <h3 class="mb-0"><?php echo app('translator')->get('rolepermission::role.role_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                              
                                <tr>
                                    <th width="30%"><?php echo app('translator')->get('rolepermission::role.role'); ?></th>
                                    <th width="40%"><?php echo app('translator')->get('common.type'); ?></th>
                                    <th width="30%"><?php echo app('translator')->get('common.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$role->name); ?></td>
                                    <td><?php echo e(@$role->type); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <?php if(@$role->type != "System"): ?>
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('common.select'); ?>
                                            </button>
                                            <?php endif; ?>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                
                                                <?php if(userPermission(419)): ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('rolepermission/role-edit', [@$role->id])); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                <?php endif; ?>
                                                <?php if(userPermission(420)): ?>
                                                    <a class="dropdown-item deleteRole" data-toggle="modal" href="#" data-id="<?php echo e(@$role->id); ?>" data-target="#deleteRole"><?php echo app('translator')->get('common.delete'); ?></a>
                                               <?php endif; ?>
                                            </div>
                                            <?php if(@$role->id != 1): ?>
                                                <?php if(userPermission(541)): ?>
                                                    <a href="<?php echo e(route('rolepermission/assign-permission', [@$role->id])); ?>" class=""   >
                                                        <button type="button" class="primary-btn small fix-gr-bg"> <?php echo app('translator')->get('rolepermission::role.assign_permission'); ?> </button>
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

<div class="modal fade admin-query" id="deleteRole" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('common.delete_item'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                     <?php echo e(Form::open(['route' => 'rolepermission/role-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" id="role_id">
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.delete'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/Modules/RolePermission/Resources/views/role.blade.php ENDPATH**/ ?>