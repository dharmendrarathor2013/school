<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('admin.postal_dispatch'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('admin.postal_dispatch'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('admin.admin_section'); ?></a>
                    <a href="#"><?php echo app('translator')->get('admin.postal_dispatch'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($postal_dispatch)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(route('postal-dispatch')); ?>" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            <?php echo app('translator')->get('common.add'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">
                                    <?php if(isset($postal_dispatch)): ?>
                                        <?php echo app('translator')->get('admin.edit_postal_dispatch'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('admin.add_postal_dispatch'); ?>
                                    <?php endif; ?>

                                </h3>
                            </div>
                            <?php if(isset($postal_dispatch)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => ['postal-dispatch_update', @$postal_dispatch->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                            <?php else: ?>
                                <?php if(userPermission(33)): ?>
                                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'postal-dispatch', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row no-gutters input-right-icon">

                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e(@$errors->has('to_title') ? ' is-invalid' : ''); ?>"
                                                    id="apply_date" type="text" name="to_title"
                                                    value="<?php echo e(isset($postal_dispatch) ? $postal_dispatch->to_title : old('to_title')); ?>">
                                                <label><?php echo app('translator')->get('admin.to_title'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('to_title')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e(@$errors->first('to_title')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <input type="hidden" name="id"
                                        value="<?php echo e(isset($postal_dispatch) ? $postal_dispatch->id : ''); ?>">
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e(@$errors->has('reference_no') ? ' is-invalid' : ''); ?>"
                                                    id="apply_date" type="text" name="reference_no"
                                                    value="<?php echo e(isset($postal_dispatch) ? $postal_dispatch->reference_no : old('reference_no')); ?>">
                                                <label><?php echo app('translator')->get('common.reference_no'); ?> *</label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('reference_no')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e(@$errors->first('reference_no')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e(@$errors->has('address') ? ' is-invalid' : ''); ?>"
                                                    id="apply_date" type="text" name="address"
                                                    value="<?php echo e(isset($postal_dispatch) ? $postal_dispatch->address : old('address')); ?>">
                                                <label><?php echo app('translator')->get('common.address'); ?></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('address')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e(@$errors->first('address')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <?php if(isset($postal_dispatch)): ?>
                                                    <textarea
                                                        class="primary-input form-control<?php echo e(@$errors->has('note') ? ' is-invalid' : ''); ?>"
                                                        cols="0" rows="4"
                                                        name="note"> <?php echo e(@$postal_dispatch->note); ?></textarea>
                                                <?php else: ?>
                                                    <textarea
                                                        class="primary-input form-control<?php echo e(@$errors->has('note') ? ' is-invalid' : ''); ?>"
                                                        cols="0" rows="4" name="note"><?php echo e(old('note')); ?></textarea>
                                                    <?php endif; ?>
                                                    <span class="focus-border textarea"></span>
                                                    <label><?php echo app('translator')->get('common.note'); ?> *</label>
                                                    <?php if($errors->has('note')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e(@$errors->first('note')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-25">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input
                                                        class="primary-input form-control<?php echo e(@$errors->has('from_title') ? ' is-invalid' : ''); ?>"
                                                        id="apply_date" type="text" name="from_title"
                                                        value="<?php echo e(isset($postal_dispatch) ? $postal_dispatch->from_title : old('from_title')); ?>">
                                                    <label><?php echo app('translator')->get('admin.from_title'); ?> *</label>
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('from_title')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e(@$errors->first('from_title')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters input-right-icon mt-25">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input
                                                        class="primary-input date form-control<?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>"
                                                        id="startDate" readonly type="text" name="date"
                                                        value="<?php echo e(isset($postal_dispatch) ? $postal_dispatch->date : date('m/d/Y')); ?>">
                                                    <span class="focus-border"></span>
                                                    <label><?php echo app('translator')->get('common.date'); ?></label>
                                                    <?php if($errors->has('date')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('date')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row no-gutters input-right-icon mt-35">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" id="placeholderInput" type="text"
                                                        placeholder="<?php echo e(isset($postal_dispatch) ? ($postal_dispatch->file != '' ? getFilePath3($postal_dispatch->file) : trans('common.file')) : trans('common.file')); ?>"
                                                        readonly>
                                                    <span class="focus-border"></span>

                                                    <?php if($errors->has('file')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                        for="browseFile"><?php echo app('translator')->get('common.browse'); ?></label>
                                                    <input type="file" class="d-none" id="browseFile" name="file">
                                                </button>
                                            </div>
                                        </div>
                                        <?php
                                            $tooltip = '';
                                            if (userPermission(33)) {
                                                $tooltip = '';
                                            } else {
                                                $tooltip = 'You have no permission to add';
                                            }
                                        ?>
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center">
                                                <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip"
                                                    title="<?php echo e(@$tooltip); ?>">
                                                    <span class="ti-check"></span>
                                                    <?php if(isset($postal_dispatch)): ?>
                                                        <?php echo app('translator')->get('admin.update_postal_dispatch'); ?>
                                                    <?php else: ?>
                                                        <?php echo app('translator')->get('admin.save_postal_dispatch'); ?>
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
                                    <h3 class="mb-0"><?php echo app('translator')->get('admin.postal_dispatch_list'); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                    <thead>

                                        <tr>
                                            <th><?php echo app('translator')->get('admin.to_title'); ?></th>
                                            <th><?php echo app('translator')->get('common.reference_no'); ?></th>
                                            <th><?php echo app('translator')->get('common.address'); ?></th>
                                            <th><?php echo app('translator')->get('admin.from_title'); ?></th>
                                            <th><?php echo app('translator')->get('common.note'); ?></th>
                                            <th><?php echo app('translator')->get('common.date'); ?></th>
                                            <th><?php echo app('translator')->get('common.actions'); ?></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__currentLoopData = $postal_dispatchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postal_dispatch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(@$postal_dispatch->to_title); ?></td>
                                                <td><?php echo e(@$postal_dispatch->reference_no); ?></td>
                                                <td><?php echo e(@$postal_dispatch->address); ?></td>
                                                <td><?php echo e(@$postal_dispatch->from_title); ?></td>
                                                <td><?php echo e(@$postal_dispatch->note); ?></td>
                                                <td data-sort="<?php echo e(strtotime(@$postal_dispatch->date)); ?>">
                                                    <?php echo e(!empty($postal_dispatch->date) ? dateConvert(@$postal_dispatch->date) : ''); ?>

                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            <?php echo app('translator')->get('common.select'); ?>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <?php if(userPermission(34)): ?>
                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('postal-dispatch_edit', @$postal_dispatch->id)); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                            <?php endif; ?>
                                                            <?php if(userPermission(35)): ?>
                                                                <a class="dropdown-item" data-toggle="modal"
                                                                    data-target="#deletePostalReceiveModal<?php echo e(@$postal_dispatch->id); ?>"
                                                                    href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                                            <?php endif; ?>
                                                            <?php if(@$postal_dispatch->file != ''): ?>
                                                                <?php if(userPermission(40)): ?>
                                                                    <?php if(@file_exists($postal_dispatch->file)): ?>
                                                                        <a class="dropdown-item"
                                                                            href="<?php echo e(url(@$postal_dispatch->file)); ?>"
                                                                            download>
                                                                            <?php echo app('translator')->get('common.download'); ?> <span
                                                                                class="pl ti-download"></span>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade admin-query"
                                                id="deletePostalReceiveModal<?php echo e(@$postal_dispatch->id); ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo app('translator')->get('common.delete'); ?>
                                                                <?php echo app('translator')->get('admin.postal_dispatch'); ?></h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                            </div>

                                                            <div class="mt-40 d-flex justify-content-between">
                                                                <button type="button" class="primary-btn tr-bg"
                                                                    data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                                <?php echo e(Form::open(['route' => ['postal-dispatch_delete', @$postal_dispatch->id], 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                                <button class="primary-btn fix-gr-bg"
                                                                    type="submit"><?php echo app('translator')->get('common.delete'); ?></button>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/admin/postal_dispatch.blade.php ENDPATH**/ ?>