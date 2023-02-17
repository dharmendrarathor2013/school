<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('hr.generate_payroll'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

<?php  $setting = generalSetting(); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('hr.staffs_payroll'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="<?php echo e(route('payroll')); ?>"><?php echo app('translator')->get('hr.payroll'); ?></a>
                <a href="#"><?php echo app('translator')->get('hr.generate_payroll'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="student-details mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30"><?php echo app('translator')->get('hr.generate_payroll'); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="student-meta-box">
                    <div class="student-meta-top staff-meta-top"></div>
                    <img class="student-meta-img img-100" src="<?php echo e(asset($staffDetails->staff_photo)); ?>"  alt="">
                    <div class="white-box">
                        <div class="single-meta mt-20">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->get('common.name'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->full_name); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->get('hr.staff_no'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->staff_no); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-3 col-3">
                                    <div class="value text-left">
                                        <?php echo app('translator')->get('hr.month'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-9 d-flex col-9">
                                    <div class="value ml-20" data-toggle="tooltip" title="Present!">
                                        P
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Late!">
                                        L
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Absent!">
                                        A
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Half Day!">
                                        F
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Holiday!">
                                        H
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="Approved Leave!">
                                        V
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->get('common.mobile'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                       <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->mobile); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->get('common.email'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->email); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-3 col-3">
                                    <div class="value text-left">
                                        <?php echo e($payroll_month); ?>

                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-9 d-flex col-9">
                                    <div class="value ml-20">
                                        
                                        <?php echo e($p); ?>

                                    </div>
                                    <div class="value ml-20">
                                        
                                        <?php echo e($l); ?>

                                    </div>
                                    <div class="value ml-20">
                                        
                                        <?php echo e($a); ?>

                                    </div>
                                    <div class="value ml-20">
                                        
                                        <?php echo e($f); ?>

                                    </div>
                                    <div class="value ml-20">
                                        
                                        <?php echo e($h); ?>

                                    </div>
                                    <div class="value ml-20">
                                        V
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->get('hr.role'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->roles->name); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->get('hr.department'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->departments?$staffDetails->departments->name:''); ?><?php endif; ?>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->get('hr.designation'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                       <?php if(isset($staffDetails)): ?><?php echo e($staffDetails->designations ? $staffDetails->designations->title :''); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        <?php echo app('translator')->get('hr.date_of_joining'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        <?php if(isset($staffDetails)): ?>
                                           <?php echo e($staffDetails->date_of_joining != ""? dateConvert($staffDetails->date_of_joining):''); ?>


                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(moduleStatusCheck('Lms')==true): ?>
                             <?php if(in_array($staffDetails->role_id,[4])): ?>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lms::lms.total_course'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="value text-left"><?php echo app('translator')->get('lms::lms.total_sell'); ?> </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="name">
                                                <?php echo app('translator')->get('lms::lms.this_month_sell'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->get('lms::lms.this_month_revenue'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="value text-left">
                                                <?php echo app('translator')->get('lms::lms.payable_amount'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-6">
                                            <div class="name">
                                            <?php echo e($totalCourse); ?>

                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="value text-left"> <?php echo e($totalSellCourseCount); ?> </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="name">
                                                <?php echo e(generalSetting()->currency_symbol); ?> <?php echo e($thisMonthSell); ?>

                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="value text-left">
                                                <?php echo e(generalSetting()->currency_symbol); ?> <?php echo e($thisMonthRevenue); ?>

                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="value text-left">
                                                <?php echo e(generalSetting()->currency_symbol); ?> <?php echo e($staffDetails->lms_balance); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>    
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'savePayrollData', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

<section class="">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3><?php echo app('translator')->get('hr.earnings'); ?></h3>
                    </div>

                    <div>
                        <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addMoreEarnings()">
                            <span class="ti-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="white-box">
                    <table class="w-100 table-responsive" id="tableID">
                        <tbody id="addEarningsTableBody">
                            <?php if($staffDetails->lms_balance && moduleStatusCheck('Lms')==true): ?>
                                <tr id="rowLms">
                                    <td width="80%" class="pr-30">
                                        <div class="input-effect mt-10">
                                            <input class="primary-input form-control infi_input" type="hidden" id="earningsType0" name="earningsType[]" value="lms_balance">
                                            <label for="earningsType0"><?php echo app('translator')->get('lms::lms.lms_balance'); ?></label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </td>
                                    <td width="20%">
                                        <div class="input-effect mt-10">
                                            <input oninput="numberCheckWithDot(this)" class="primary-input form-control" type="text" oninput="this.value = Math.abs(this.value)" id="earningsValue0"  name="earningsValue[]" value="<?php echo e($staffDetails->lms_balance); ?>">
                                            <label for="earningsValue0"><?php echo app('translator')->get('hr.value'); ?></label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <tr id="row0">
                                    <td width="80%" class="pr-30">
                                        <div class="input-effect mt-10">
                                            <input class="primary-input form-control infi_input" type="text" id="earningsType0" name="earningsType[]">
                                            <label for="earningsType0"><?php echo app('translator')->get('common.type'); ?></label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </td>
                                    <td width="20%">
                                        <div class="input-effect mt-10">
                                            <input oninput="numberCheckWithDot(this)" class="primary-input form-control" type="text" oninput="this.value = Math.abs(this.value)" id="earningsValue0"  name="earningsValue[]">
                                            <label for="earningsValue0"><?php echo app('translator')->get('hr.value'); ?></label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </td>
                                    
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3><?php echo app('translator')->get('hr.deductions'); ?></h3>
                    </div>

                    <div>
                        <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addDeductions()">
                            <span class="ti-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="white-box">
                <table class="w-100 table-responsive" id="tableDeduction">
                        <tbody id="addDeductionsTableBody">
                            <tr id="DeductionRow0">
                                <td width="80%" class="pr-30">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="deductionstype0" name="deductionstype[]">
                                        <label for="deductionstype0"><?php echo app('translator')->get('common.type'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" oninput="this.value = Math.abs(this.value)" id="deductionsValue0" name="deductionsValue[]">
                                        <label for="deductionsValue0"><?php echo app('translator')->get('hr.value'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between mb-20">
                    <div class="main-title">
                        <h3><?php echo app('translator')->get('hr.payroll_summary'); ?></h3>
                    </div>

                    <div>
                        <button type="button" class="primary-btn small fix-gr-bg" onclick="calculateSalary()">
                            <?php echo app('translator')->get('hr.calculate'); ?>
                        </button>
                    </div>
                </div>

                <input type="hidden" name="staff_id" value="<?php echo e($staffDetails->id); ?>">
                <input type="hidden" name="payroll_month" value="<?php echo e($payroll_month); ?>">
                <input type="hidden" name="payroll_year" value="<?php echo e($payroll_year); ?>">


                <div class="white-box">
                <table class="w-100 table-responsive">
                        <tbody class="d-block">
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-10">
                                        <input class="primary-input form-control" type="text" id="basicSalary" value="<?php echo e($staffDetails->basic_salary); ?>" name="basic_salary" readonly>
                                        <label for="basicSalary"><?php echo app('translator')->get('hr.basic_salary'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" readonly type="text" id="total_earnings" name="total_earning">
                                        <label for="total_earnings"><?php echo app('translator')->get('hr.earning'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" type="text" readonly id="total_deduction" name="total_deduction">
                                        <label for="total_deduction"><?php echo app('translator')->get('hr.deduction'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" type="text" readonly id="leave_deduction" value="<?php echo e(round(($staffDetails->basic_salary/30) * $extra_days)); ?>" name="leave_deduction">
                                        <input type="hidden" name="extra_leave_taken" value="<?php echo e(@$extra_days); ?>">
                                        <label for="leave_deduction"><?php echo app('translator')->get('hr.leave'); ?> <?php echo app('translator')->get('hr.deduction'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control" readonly type="text" id="gross_salary" value="0">
                                        <input type="hidden" name="final_gross_salary" id="final_gross_salary">
                                        <label for="gross_salary"><?php echo app('translator')->get('hr.gross_salary'); ?>  (<?php echo e(generalSetting()->currency_symbol); ?>)</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30">
                                        <input class="primary-input form-control"  type="text" id="tax" value="0" name="tax">
                                        <label for="tax"><?php echo app('translator')->get('hr.tax'); ?></label>
                                        <span class="focus-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-block">
                                <td width="100%" class="pr-30 d-block">
                                    <div class="input-effect mt-30 mb-30">
                                        <input class="primary-input form-control<?php echo e($errors->has('net_salary') ? ' is-invalid' : ''); ?>" readonly type="text" id="net_salary" name="net_salary">
                                        <label for="net_salary"><?php echo app('translator')->get('hr.net_salary'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</label>
                                        <span class="focus-border"></span>

                                        <?php if($errors->has('net_salary')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('net_salary')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 mt-20 text-right">
                <!-- <button type="submit" class="primary-btn small fix-gr-bg">
                    Submit
                </button> -->

                <?php if(userPermission(175)): ?>

              

                <button class="primary-btn fix-gr-bg">
                    <span class="ti-check"></span>
                    <?php echo app('translator')->get('hr.submit'); ?>
                </button>
                <?php endif; ?>
            </div>
           
            </div>
        </div>
    </div>
</section>
<?php echo e(Form::close()); ?>

<!-- End Modal Area -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/humanResource/payroll/generatePayroll.blade.php ENDPATH**/ ?>