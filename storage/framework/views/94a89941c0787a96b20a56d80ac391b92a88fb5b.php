<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('system_settings.holiday_list'); ?>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('system_settings.holiday_list'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('system_settings.system_settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('system_settings.holiday_list'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($editData)): ?>
                <?php if(userPermission(441)): ?>
                    <div class="row">
                        <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                            <a href="<?php echo e(url('holiday')); ?>" class="primary-btn small fix-gr-bg">
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
                                <h3 class="mb-30"><?php if(isset($editData)): ?>
                                        <?php echo app('translator')->get('system_settings.edit_holiday'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('system_settings.add_holiday'); ?>
                                    <?php endif; ?>
                                   
                                </h3>
                            </div>
                            <?php if(isset($editData)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'holiday/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                            <?php else: ?>
                                <?php if(userPermission(441)): ?>
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'holiday',
                                    'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row">
                                       
                                        <div class="col-lg-12 mb-20">
                                            <div class="input-effect">
                                                <input class="primary-input form-control<?php echo e($errors->has('holiday_title') ? ' is-invalid' : ''); ?>"
                                                       type="text" name="holiday_title" autocomplete="off"
                                                       value="<?php echo e(isset($editData)? $editData->holiday_title : ''); ?>">
                                                <label><?php echo app('translator')->get('system_settings.holiday_title'); ?> <span>*</span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('holiday_title')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('holiday_title')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('from_date') ? ' is-invalid' : ''); ?>"
                                                       id="event_from_date" type="text"
                                                       name="from_date"
                                                       value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->from_date)): date('m/d/Y')); ?>"
                                                       autocomplete="off">
                                                <label><?php echo app('translator')->get('system_settings.from_date'); ?> <span></span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('from_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('from_date')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="event_start_date"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row no-gutters input-right-icon mb-30">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('to_date') ? ' is-invalid' : ''); ?>"
                                                       id="event_to_date" type="text"
                                                       name="to_date"
                                                       value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->to_date)): date('m/d/Y')); ?>"
                                                       autocomplete="off">
                                                <label><?php echo app('translator')->get('system_settings.to_date'); ?><span></span> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('to_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('to_date')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="event_end_date"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-20">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <textarea
                                                        class="primary-input form-control <?php echo e($errors->has('details') ? ' is-invalid' : ''); ?>"
                                                        cols="0" rows="4"
                                                        name="details"><?php echo e(isset($editData)? $editData->details: ''); ?></textarea>
                                                <label><?php echo app('translator')->get('common.description'); ?> <span>*</span> </label>
                                                <span class="focus-border textarea"></span>
                                                <?php if($errors->has('details')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('details')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mb-30">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input form-control" name="upload_file_name"
                                                       type="text"
                                                       placeholder="<?php echo e(isset($editData->upload_image_file) && $editData->upload_image_file != ""? getFilePath3($editData->upload_image_file):trans('common.attach_file')); ?>"
                                                       id="placeholderHolidayFile" readonly>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('upload_file_name')): ?>
                                                    <span class="invalid-feedback d-block" role="alert">
                                                    <strong><?php echo e($errors->first('upload_file_name')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="upload_holiday_image"><?php echo app('translator')->get('common.browse'); ?></label>
                                                <input type="file" class="d-none form-control" name="upload_file_name"
                                                       id="upload_holiday_image">
                                            </button>

                                        </div>
                                    </div>
                                    <?php
                                        $tooltip = "";
                                        if(userPermission(441)){
                                                $tooltip = "";
                                            }else{
                                                $tooltip = "You have no permission to add";
                                            }
                                    ?>
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip"
                                                    title="<?php echo e(@$tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php if(isset($editData)): ?>
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
                                <h3 class="mb-0"><?php echo app('translator')->get('system_settings.holiday_list'); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>
                               
                                <tr>
                                    <th><?php echo app('translator')->get('common.sl'); ?></th>
                                    <th><?php echo app('translator')->get('system_settings.holiday_title'); ?></th>
                                    <th><?php echo app('translator')->get('system_settings.from_date'); ?></th>
                                    <th><?php echo app('translator')->get('system_settings.to_date'); ?></th>
                                    <th><?php echo app('translator')->get('common.days'); ?></th>
                                    <th><?php echo app('translator')->get('system_settings.details'); ?></th>
                                    <th><?php echo app('translator')->get('common.action'); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php if(isset($holidays)): ?>
                                    <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php

                                            $start = strtotime($value->from_date);
                                            $end = strtotime($value->to_date);

                                            $days_between = ceil(abs($end - $start) / 86400);
                                            $days = $days_between + 1;

                                        ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e($value->holiday_title); ?></td>
                                            <td data-sort="<?php echo e(strtotime($value->from_date)); ?>">
                                                <?php echo e($value->from_date != ""? dateConvert($value->from_date):''); ?>


                                            </td>
                                            <td data-sort="<?php echo e(strtotime($value->to_date)); ?>">
                                                <?php echo e($value->to_date != ""? dateConvert($value->to_date):''); ?>


                                            </td>
                                            <td><?php echo e($days == 1? $days.' day':$days.' days'); ?></td>
                                            <td><?php echo e(Illuminate\Support\Str::limit(@$value->details, 50)); ?></td>


                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <?php echo app('translator')->get('common.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if(userPermission(442)): ?>
                                                            <a class="dropdown-item"
                                                               href="<?php echo e(url('holiday/'.$value->id.'/edit')); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                        <?php endif; ?>
                                                        <?php if(userPermission(443)): ?>
                                                            <a class="deleteUrl dropdown-item"
                                                               data-modal-size="modal-md" title="<?php echo app('translator')->get('system_settings.delete_holiday'); ?>"
                                                               href="<?php echo e(url('delete-holiday-data-view/'.$value->id)); ?>"><?php echo app('translator')->get('common.delete'); ?></a>
                                                        <?php endif; ?>
                                                        <?php if($value->upload_image_file != ""): ?>
                                                            <a class="dropdown-item"
                                                               href="<?php echo e(url($value->upload_image_file)); ?>" download>
                                                                <?php echo app('translator')->get('system_settings.download'); ?> <span
                                                                        class="pl ti-download"></span>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/holidays/holidaysList.blade.php ENDPATH**/ ?>