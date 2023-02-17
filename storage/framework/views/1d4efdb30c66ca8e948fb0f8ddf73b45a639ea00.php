<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('common.academic_year'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('common.academic_year'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('system_settings.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('common.academic_year'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($academic_year)): ?>
            <?php if(userPermission(433)): ?>
            <div class="row">
                <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                    <a href="<?php echo e(route('academic-year')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($academic_year)): ?>
                                    <?php echo app('translator')->get('system_settings.edit_academic_year'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('system_settings.add_academic_year'); ?>
                                <?php endif; ?>
                               
                            </h3>
                        </div>
                        <?php if(isset($academic_year)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('academic-year-update',@$academic_year->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                        <?php if(userPermission(433)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'academic-year',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('year') ? ' is-invalid' : ''); ?>"
                                                type="text" name="year" autocomplete="off" value="<?php echo e(isset($academic_year)? @$academic_year->year:''); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($academic_year)? @$academic_year->id: ''); ?>">
                                            <label><?php echo app('translator')->get('common.year'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('year')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('year')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>"
                                                type="text" name="title" autocomplete="off" value="<?php echo e(isset($academic_year)? @$academic_year->title:old('academic_year')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($academic_year)? @$academic_year->id: ''); ?>">
                                            <label> <?php echo app('translator')->get('system_settings.year_title'); ?><span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('title')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('title')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mt-40">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('starting_date') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                placeholder=" <?php echo app('translator')->get('system_settings.starting_date'); ?> *" name="starting_date" value="<?php echo e(isset($academic_year)? date('m/d/Y',strtotime($academic_year->starting_date)): date('01/01/Y')); ?>">

                                            <label><?php echo app('translator')->get('system_settings.starting_date'); ?><span class="focus-border"></span>
                                            <?php if($errors->has('starting_date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('starting_date')); ?></strong>
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
                                <div class="row no-gutters input-right-icon mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('ending_date') ? ' is-invalid' : ''); ?>" id="startDate" type="text"
                                                placeholder="<?php echo app('translator')->get('system_settings.ending_date'); ?>*" name="ending_date" value="<?php echo e(isset($academic_year)? date('m/d/Y',strtotime($academic_year->ending_date)): date('12/31/Y')); ?>">

                                            <label><?php echo app('translator')->get('system_settings.ending_date'); ?><span>*</span></label>
                                                <span class="focus-border"></span>
                                            <?php if($errors->has('ending_date')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('ending_date')); ?></strong>
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
                                <?php
                                if (isset($academic_year)) {
                                    $copy_with_academic_year=explode(',',@$academic_year->copy_with_academic_year);
                                }
                                ?>
                                <div class="row no-gutters input-right-icon mt-40">
                                    <label for="checkbox" class="mb-2"><?php echo app('translator')->get('system_settings.copy_with_academic_year'); ?></label>
                                    <select multiple id="e1" name="copy_with_academic_year[]" style="width:300px">
                                        <option value="App\SmClass"  <?php if(isset($academic_year)): ?> <?php if(in_array("App\SmClass", @$copy_with_academic_year)): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo app('translator')->get('common.class'); ?> </option>
                                        <option value="App\SmSection" <?php if(isset($academic_year)): ?> <?php if(in_array("App\SmSection", @$copy_with_academic_year)): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo app('translator')->get('common.section'); ?></option>
                                        <option value="App\SmSubject" <?php if(isset($academic_year)): ?> <?php if(in_array("App\SmSubject", @$copy_with_academic_year)): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo app('translator')->get('common.subject'); ?></option>
                                        <option value="App\SmExamType" <?php if(isset($academic_year)): ?> <?php if(in_array("App\SmExamType", @$copy_with_academic_year)): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo app('translator')->get('exam.exam_type'); ?> </option>
                                        <option value="App\SmStudentCategory" <?php if(isset($academic_year)): ?> <?php if(in_array("App\SmStudentCategory", @$copy_with_academic_year)): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo app('translator')->get('student.student_category'); ?></option>
                                        <option value="App\SmFeesGroup" <?php if(isset($academic_year)): ?> <?php if(in_array("App\SmFeesGroup", @$copy_with_academic_year)): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo app('translator')->get('fees.fees_group'); ?></option>
                                        <option value="App\SmLeaveType" <?php if(isset($academic_year)): ?> <?php if(in_array("App\SmLeaveType", @$copy_with_academic_year)): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo app('translator')->get('leave.leave_type'); ?></option>
                                    </select>
                                    <div class="">
                                    <input type="checkbox" id="checkbox" class="common-checkbox">
                                    <label for="checkbox" class="mt-3"><?php echo app('translator')->get('common.select_all'); ?> </label>
                                    </div>
                                </div>

                                <?php
                                    $tooltip = "";
                                    if(userPermission(433)){
                                            $tooltip = "";
                                        }else{
                                            $tooltip = "You have no permission to add";
                                        }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($academic_year)): ?>
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
                            <h3 class="mb-0"> <?php echo app('translator')->get('system_settings.academic_year_list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                               
                                <tr>
                                    <th><?php echo app('translator')->get('common.year'); ?></th>
                                    <th><?php echo app('translator')->get('common.title'); ?></th>
                                    <th><?php echo app('translator')->get('system_settings.starting_date'); ?></th>
                                    <th><?php echo app('translator')->get('system_settings.ending_date'); ?></th>
                                    <th><?php echo app('translator')->get('common.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = academicYears(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academic_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$academic_year->year); ?></td>
                                    <td><?php echo e(@$academic_year->title); ?></td>
                                    <td  data-sort="<?php echo e(strtotime(@$academic_year->starting_date)); ?>" >
                                        <?php echo e(@$academic_year->starting_date != ""? dateConvert(@$academic_year->starting_date):''); ?>


                                    </td>
                                    <td  data-sort="<?php echo e(strtotime(@$academic_year->ending_date)); ?>" >
                                       <?php echo e(@$academic_year->ending_date != ""? dateConvert(@$academic_year->ending_date):''); ?>


                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('common.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(434)): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('academic-year-edit', [@$academic_year->id])); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                <?php endif; ?>
                                                <?php if(userPermission(435)): ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteAcademicYearModal<?php echo e(@$academic_year->id); ?>"
                                                    href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                               <!--  -->

                                <div class="modal fade admin-query" id="deleteAcademicYearModal<?php echo e(@$academic_year->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('system_settings.delete_academic_year'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                    <h5 class="text-danger">( <?php echo app('translator')->get('system_settings.academic_year_delete_confirmation'); ?> )</h5>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>

                                                    <?php echo e(Form::open(['route' => array('academic-year-delete',@$academic_year->id), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/impact-eschool-erp-main/resources/views/backEnd/systemSettings/academic_year.blade.php ENDPATH**/ ?>