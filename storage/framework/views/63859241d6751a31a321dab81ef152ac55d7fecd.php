<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('admin.complaint'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
  
    <section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('admin.complaint'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('admin.admin_section'); ?></a>
                    <a href="#"><?php echo app('translator')->get('admin.complaint'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <?php if(isset($complaint)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(route('complaint')); ?>" class="primary-btn small fix-gr-bg">
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
                                <h3 class="mb-30"><?php if(isset($complaint)): ?>
                                        <?php echo app('translator')->get('admin.edit_complaint'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('admin.add_complaint'); ?>
                                    <?php endif; ?>
                                   
                                </h3>
                            </div>
                            <?php if(isset($complaint)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'complaint/'.@$complaint->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                            <?php else: ?>
                             <?php if(userPermission(22)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'complaint',
                                'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php endif; ?>
                            <?php endif; ?>
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e(@$errors->has('complaint_by') ? ' is-invalid' : ''); ?>"
                                                    id="apply_date" type="text"
                                                    name="complaint_by"
                                                    value="<?php echo e(isset($complaint)? $complaint->complaint_by: old('complaint_by')); ?>">
                                                <label><?php echo app('translator')->get('admin.complaint_by'); ?> <span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('complaint_by')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('complaint_by')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo e(isset($complaint)? $complaint->id: ''); ?>">
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <select
                                                class="niceSelect w-100 bb form-control<?php echo e(@$errors->has('complaint_type') ? ' is-invalid' : ''); ?>"
                                                name="complaint_type">
                                                <option data-display="<?php echo app('translator')->get('admin.complaint_type'); ?> *" value=""><?php echo app('translator')->get('admin.type'); ?> *</option>
                                                <?php $__currentLoopData = $complaint_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($complaint)): ?>
                                                        <option
                                                            value="<?php echo e(@$complaint_type->id); ?>" <?php echo e(@$complaint_type->id == @$complaint->complaint_type? 'selected':''); ?>><?php echo e(@$complaint_type->name); ?></option>
                                                    <?php else: ?>
                                                        <option
                                                            value="<?php echo e(@$complaint_type->id); ?>" <?php echo e(old('complaint_type') == @$complaint_type->id? 'selected':''); ?>><?php echo e(@$complaint_type->name); ?></option>
                                                    <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('complaint_type')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e(@$errors->first('complaint_type')); ?></strong>
                                        </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <select
                                                class="niceSelect w-100 bb form-control<?php echo e(@$errors->has('complaint_source') ? ' is-invalid' : ''); ?>"
                                                name="complaint_source">
                                                <option data-display="<?php echo app('translator')->get('admin.complaint_source'); ?> *" value=""><?php echo app('translator')->get('admin.complaint_source'); ?> *
                                                </option>
                                                <?php $__currentLoopData = $complaint_sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint_source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($complaint)): ?>
                                                        <option
                                                            value="<?php echo e(@$complaint_source->id); ?>" <?php echo e(@$complaint_source->id == @$complaint->complaint_source? 'selected':''); ?>><?php echo e(@$complaint_source->name); ?></option>
                                                    <?php else: ?>
                                                        <option
                                                            value="<?php echo e(@$complaint_source->id); ?>"><?php echo e(@$complaint_source->name); ?></option>
                                                    <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('complaint_source')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e(@$errors->first('complaint_source')); ?></strong>
                                        </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input oninput="phoneCheck(this)" class="primary-input form-control<?php echo e(@$errors->has('phone') ? ' is-invalid' : ''); ?>"
                                                    id="apply_date" type="text"
                                                    name="phone" value="<?php echo e(isset($complaint)? $complaint->phone: ''); ?>">
                                                <label><?php echo app('translator')->get('admin.phone'); ?></label>
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mt-25">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input date form-control<?php echo e(@$errors->has('date') ? ' is-invalid' : ''); ?>"
                                                    id="startDate" type="text" name="date"
                                                    value="<?php echo e(isset($complaint)? date('m/d/Y', strtotime($complaint->date)): (old('date') != ""? old('date'):date('m/d/Y'))); ?>">
                                                <label><?php echo app('translator')->get('admin.date'); ?> <span></span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('date')); ?></strong>
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

                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e(@$errors->has('action_taken') ? ' is-invalid' : ''); ?>"
                                                    id="apply_date" type="text"
                                                    name="action_taken"
                                                    value="<?php echo e(isset($complaint)? $complaint->action_taken: old('action_taken')); ?>">
                                                <label><?php echo app('translator')->get('admin.actions_taken'); ?> </label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('action_taken')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('action_taken')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e(@$errors->has('assigned') ? ' is-invalid' : ''); ?>"
                                                    id="apply_date" type="text" name="assigned"
                                                    value="<?php echo e(isset($complaint)? $complaint->assigned: old('assigned')); ?>">
                                                <label><?php echo app('translator')->get('admin.assigned'); ?></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('assigned')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('assigned')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <?php if(isset($complaint)): ?>
                                                    <textarea class="primary-input form-control" cols="0" rows="4"
                                                              name="description"><?php echo e(@$complaint->description); ?></textarea>
                                                <?php else: ?>
                                                    <textarea class="primary-input form-control" cols="0" rows="4"
                                                              name="description"><?php echo e(old('description')); ?></textarea>
                                                <?php endif; ?>
                                                <span class="focus-border textarea"></span>
                                                <label><?php echo app('translator')->get('admin.description'); ?> <span></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters input-right-icon mt-35">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input" id="placeholderInput" type="text"
                                                       placeholder="<?php echo e(isset($complaint)? ($complaint->file != ""? getFilePath3($complaint->file):trans('common.file')):trans('common.file')); ?>"
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
                                  $tooltip = "";
                                  if(userPermission(22) ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                           <button class="primary-btn fix-gr-bg now_wrap_lg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                                <span class="ti-check"></span>
                                                <?php if(isset($complaint)): ?>
                                                    <?php echo app('translator')->get('admin.update_complaint'); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get('admin.save_complaint'); ?>
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
                                <h3 class="mb-0"><?php echo app('translator')->get('admin.complaint'); ?> <?php echo app('translator')->get('admin.list'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>
                              
                                <tr>
                                    <th><?php echo app('translator')->get('common.sl'); ?></th>
                                    <th><?php echo app('translator')->get('admin.complaint_by'); ?></th>
                                    <th><?php echo app('translator')->get('admin.complaint_type'); ?></th>
                                    <th><?php echo app('translator')->get('admin.source'); ?></th>
                                    <th><?php echo app('translator')->get('admin.phone'); ?></th>
                                    <th><?php echo app('translator')->get('admin.date'); ?></th>
                                    <th><?php echo app('translator')->get('admin.actions'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = @$complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e(@$complaint->complaint_by); ?></td>
                                        <td><?php echo e(isset($complaint->complaint_type)? @$complaint->complaintType->name:''); ?></td>
                                        <td><?php echo e(isset($complaint->complaint_source)? @$complaint->complaintSource->name:''); ?></td>

                                        <td><?php echo e($complaint->phone); ?></td>
                                        <td data-sort="<?php echo e(strtotime(@$complaint->date)); ?>"><?php echo e(!empty(@$complaint->date)? dateConvert(@$complaint->date):''); ?> </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <?php echo app('translator')->get('common.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if(userPermission(26)): ?>

                                                    <a class="dropdown-item modalLink" title="<?php echo e(__('admin.complaint_details')); ?>"
                                                       data-modal-size="large-modal"
                                                       href="<?php echo e(url('complaint', [@$complaint->id])); ?>"><?php echo app('translator')->get('common.view'); ?></a>
                                                    <?php endif; ?>
                                                       <?php if(userPermission(23)): ?>

                                                       <a class="dropdown-item"
                                                       href="<?php echo e(url('complaint/'.@$complaint->id.'/edit')); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                   <?php endif; ?>
                                                   <?php if(userPermission(24)): ?>

                                                       <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#deleteComplaintModal<?php echo e($complaint->id); ?>"
                                                       href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                                    <?php endif; ?>
                                                       <?php if(@$complaint->file != ""): ?>
                                                     <?php if(userPermission(25)): ?>
                                                   <?php if(@file_exists($complaint->file)): ?>
                                                        <a class="dropdown-item"
                                                            href="<?php echo e(url(@$complaint->file)); ?>" download>
                                                                <?php echo app('translator')->get('common.download'); ?> <span class="pl ti-download"></span>
                                                        </a>
                                                    <?php endif; ?>    
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteComplaintModal<?php echo e(@$complaint->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('admin.delete_complaint'); ?></h4>
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
                                                        <?php echo e(Form::open(['url' => 'complaint/'.$complaint->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                        <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.delete'); ?>
                                                        </button>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/admin/complaint.blade.php ENDPATH**/ ?>