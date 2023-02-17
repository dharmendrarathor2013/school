<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('academics.class_room'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('academics.class_room'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('academics.academics'); ?></a>
                <a href="#"><?php echo app('translator')->get('academics.class_room'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($class_room)): ?>
          <?php if(userPermission(270)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('class-room')); ?>" class="primary-btn small fix-gr-bg">
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
                                <?php if(isset($class_room)): ?>
                                    <?php echo app('translator')->get('academics.edit_class_room'); ?>
                                 <?php else: ?>
                                    <?php echo app('translator')->get('academics.add_class_room'); ?>
                                <?php endif; ?>
                               
                            </h3>
                        </div>
                        <?php if(isset($class_room)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('class-room-update',@$class_room->id), 'method' => 'PUT'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(270)): ?>
           
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'class-room', 'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                        
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('room_no') ? ' is-invalid' : ''); ?>" type="text" name="room_no" autocomplete="off" value="<?php echo e(isset($class_room)? $class_room->room_no: old('room_no')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($class_room)? $class_room->id: ''); ?>">
                                            <label><?php echo app('translator')->get('academics.room_no'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('room_no')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('room_no')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        
                                         <div class="input-effect">
                                            <input oninput="numberCheckWithDot(this)" class="primary-input form-control<?php echo e($errors->has('capacity') ? ' is-invalid' : ''); ?>" type="text" name="capacity" autocomplete="off" value="<?php echo e(isset($class_room)? $class_room->capacity: old('capacity')); ?>">
                                            <label><?php echo app('translator')->get('academics.capacity'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('capacity')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('capacity')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                  $tooltip = "";
                                  if(userPermission(270)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($class_room)): ?>
                                                <?php echo app('translator')->get('academics.update_class_room'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('academics.save_class_room'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('academics.class_room_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                               
                                <tr>
                                    <th><?php echo app('translator')->get('academics.room_no'); ?></th>
                                    <th><?php echo app('translator')->get('academics.capacity'); ?></th>
                                    <th><?php echo app('translator')->get('common.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $class_rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class_room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td valign="top"><?php echo e(@$class_room->room_no); ?></td>
                                    <td valign="top"><?php echo e(@$class_room->capacity); ?></td>
                                    
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('common.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(271)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('class-room-edit',$class_room->id)); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                               <?php endif; ?>
                                                <?php if(userPermission(272)): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassRoomModal<?php echo e(@$class_room->id); ?>"  href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteClassRoomModal<?php echo e(@$class_room->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('academics.delete_class_room'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                    <?php echo e(Form::open(['route' => array('class-room-delete',$class_room->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.delete'); ?></button>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/academics/class_room.blade.php ENDPATH**/ ?>