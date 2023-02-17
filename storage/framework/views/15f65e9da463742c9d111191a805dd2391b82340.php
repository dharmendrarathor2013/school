<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('style.background_settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('style.background_settings'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('style.style'); ?></a>
                    <a href="#"><?php echo app('translator')->get('style.background_settings'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($visitor)): ?>
                <?php if(userPermission(487)): ?>
                    <div class="row">
                        <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                            <a href="<?php echo e(route('visitor')); ?>" class="primary-btn small fix-gr-bg">
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
                                    <?php echo app('translator')->get('style.add_style'); ?>
                                </h3>
                            </div>
                            <?php if(isset($visitor)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'background-settings-update',
                                'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php else: ?>
                                <?php if(userPermission(487)): ?>
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'background-settings-store',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('style') ? ' is-invalid' : ''); ?>" name="style" id="style">
                                                <option data-display="<?php echo app('translator')->get('style.select_position'); ?> *" value=""><?php echo app('translator')->get('style.select_position'); ?> *</option>
                                                <option value="1" <?php echo e(old('style') == 1? 'selected': ''); ?>><?php echo app('translator')->get('style.dashboard_background'); ?></option>
                                                <option value="2" <?php echo e(old('style') == 2? 'selected': ''); ?>><?php echo app('translator')->get('style.login_page_background'); ?></option>
                                                <?php if(moduleStatusCheck('Lead')==true): ?>
                                                <option value="3" <?php echo e(old('style') == 3? 'selected': ''); ?>><?php echo app('translator')->get('lead::lead.lead_form_background'); ?></option>
                                                <?php endif; ?>
                                            </select>
                                            <?php if($errors->has('style')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('style')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <div class="row mt-40">
                                        <div class="col-lg-12"> 
                                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('background_type') ? ' is-invalid' : ''); ?>" name="background_type" id="background-type">
                                                <option data-display="<?php echo app('translator')->get('style.background_type'); ?> *" value=""><?php echo app('translator')->get('style.background_type'); ?> *</option>            
                                                <option value="color" <?php echo e(old('background_type') == 'color'? 'selected': ''); ?>><?php echo app('translator')->get('style.color'); ?></option>
                                                <option value="image" <?php echo e(old('background_type') == 'image'? 'selected': ''); ?>><?php echo app('translator')->get('common.image'); ?> (1920x1400)</option>
                                            </select>
                                            <?php if($errors->has('background_type')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong><?php echo e($errors->first('background_type')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>



                                    <div class="row mt-40" id="background-color">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('color') ? ' is-invalid' : ''); ?>" type="color" name="color" autocomplete="off" value="<?php echo e(isset($visitor)? $visitor->purpose: old('color')); ?>">
                                                <input type="hidden" name="id" value="<?php echo e(isset($visitor)? @$visitor->id: ''); ?>">
                                                <label><?php echo app('translator')->get('style.color'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('color')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('color')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row no-gutters input-right-icon mt-35" id="background-image">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input" id="placeholderInput" type="text" placeholder="<?php echo e(isset($visitor)? (@$visitor->file != ""? getFilePath3(@$visitor->file): trans('style.background_image').' *'): trans('style.background_image').' *'); ?>"
                                                       readonly>
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg" for="browseFile"><?php echo app('translator')->get('common.browse'); ?></label>
                                                <input type="file" class="d-none" id="browseFile" name="image">
                                            </button>
                                        </div>
                                    </div>


                                    
                                    <?php 
                                        $tooltip = "";
                                        if(userPermission(487)){
                                                $tooltip = "";
                                            }else{
                                                $tooltip = "You have no permission to add";
                                            }
                                    ?>

                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php if(isset($visitor)): ?>
                                                    <?php echo app('translator')->get('common.update'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('common.save'); ?>
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
                                <h3 class="mb-0"><?php echo app('translator')->get('common.view'); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>
                              
                                <tr>
                                    <th><?php echo app('translator')->get('common.title'); ?></th>
                                    <th><?php echo app('translator')->get('common.type'); ?></th>
                                    <th><?php echo app('translator')->get('common.image'); ?></th> 
                                    <th><?php echo app('translator')->get('common.status'); ?></th>
                                    <th><?php echo app('translator')->get('common.action'); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $background_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $background_setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$background_setting->title); ?></td>
                                        <td><p class="primary-btn small tr-bg"><?php echo e(@$background_setting->type); ?></p></td>
                                        <td>
                                            <?php if(@$background_setting->type == 'image'): ?>
                                            <img src="<?php echo e(asset($background_setting->image)); ?>" width="200px" height="100px">
                                            <?php else: ?>
                                             <div style="width: 200px; height: 100px; background-color:<?php echo e(@$background_setting->color); ?> "></div>
                                            <?php endif; ?>
                                        </td> 
                                        <td>
                                            <div class="col-md-12">
                                            
                                            <?php if(@$background_setting->is_default==1): ?> 
                                                <a  class="primary-btn small fix-gr-bg " href="<?php echo e(route('background_setting-status',@$background_setting->id)); ?>"> <?php echo app('translator')->get('style.activated'); ?> </a> 
                                            <?php else: ?>
                                            <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> 
                                                <?php if(userPermission(489)): ?>
                                                <a  class="primary-btn small tr-bg" href="#"> <?php echo app('translator')->get('style.make_default'); ?></a> 
                                                </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                            <?php if(userPermission(489)): ?>
                                            <a  class="primary-btn small tr-bg" href="<?php echo e(route('background_setting-status',@$background_setting->id)); ?>"> <?php echo app('translator')->get('style.make_default'); ?></a> 
                                           
                                            <?php endif; ?>
                                            <?php endif; ?>
                                           

                                            <?php endif; ?>
                                        </div>
                                        </td>

                                        <td>
                                            <?php if(@$background_setting->id==1): ?>
                                            <p class="primary-btn small tr-bg"><?php echo app('translator')->get('common.disable'); ?></p>
                                            <?php else: ?>

                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <?php echo app('translator')->get('common.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if(userPermission(488)): ?>
                                                    <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#deletebackground_settingModal<?php echo e(@$background_setting->id); ?>"
                                                       href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            
                                            <?php endif; ?>
                                        </td>
                                        <div class="modal fade admin-query" id="deletebackground_settingModal<?php echo e(@$background_setting->id); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo app('translator')->get('common.delete'); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?>
                                                            </button>

                                                            <a href="<?php echo e(route('background-setting-delete',@$background_setting->id)); ?>"
                                                               class="primary-btn fix-gr-bg"><?php echo app('translator')->get('common.delete'); ?></a>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/style/background_setting.blade.php ENDPATH**/ ?>