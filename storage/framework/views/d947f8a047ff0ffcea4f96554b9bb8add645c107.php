<div class="container-fluid">
   <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'savePayrollPaymentData',
   'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validateForm()'])); ?>


   <div class="row">
    <div class="col-lg-12">
        <div class="row mt-25">
            <div class="col-lg-6" id="sibling_class_div">
                <div class="input-effect">
                    <input readonly class="read-only-input primary-input form-control<?php echo e($errors->has('amount') ? ' is-invalid' : ''); ?>" type="text" name="amount" value="<?php echo e($payrollDetails->staffs->full_name); ?> (<?php echo e($payrollDetails->staffs->staff_no); ?>)">
                    <input type="hidden" name="payroll_generate_id" value="<?php echo e($payrollDetails->id); ?>">
                    <input type="hidden" name="role_id" value="<?php echo e($role_id); ?>">
                    <input type="hidden" name="payroll_month" value="<?php echo e($payrollDetails->payroll_month); ?>">
                    <input type="hidden" name="payroll_year" value="<?php echo e($payrollDetails->payroll_year); ?>">
                    <label><?php echo app('translator')->get('hr.staff_name'); ?>dddd <span></span> </label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('amount')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('amount')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6" id="">
                <div class="input-effect">
                    <select class="niceSelect1 w-100 bb form-control<?php echo e($errors->has('expense_head_id') ? ' is-invalid' : ''); ?>" name="expense_head_id" id="expense_head_id">
                        <option data-display="Expense Head*" value=""><?php echo app('translator')->get('accounts.expense_head'); ?> *</option>
                        <?php if(isset($chart_of_accounts)): ?>
                        <?php $__currentLoopData = $chart_of_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>" ><?php echo e($value->head); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <span class="modal_input_validation red_alert"></span>

                </div>
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-6" id="">
                <div class="input-effect">
                    <input readonly class="read-only-input primary-input form-control<?php echo e($errors->has('amount') ? ' is-invalid' : ''); ?>" type="text" name="amount" value="<?php echo e($payrollDetails->payroll_month); ?> - <?php echo e($payrollDetails->payroll_year); ?>">
                    <label><?php echo app('translator')->get('hr.month_year'); ?> <span></span> </label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('amount')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('amount')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-6" id="">
                <div class="input-effect">
                    <input class="read-only-input primary-input date form-control<?php echo e($errors->has('apply_date') ? ' is-invalid' : ''); ?>" id="payment_date" type="text"
                    name="payment_date" value="<?php echo e(date('m/d/Y')); ?>">
                    <label><?php echo app('translator')->get('fees.payment_date'); ?> <span>*</span> </label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('payment_date')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('payment_date')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>

            
        </div>

        <div class="row mt-25">
            <div class="col-lg-6">
                <div class="input-effect">
                    <input class="read-only-input primary-input form-control<?php echo e($errors->has('discount') ? ' is-invalid' : ''); ?>" type="text" name="" value="<?php echo e($payrollDetails->net_salary); ?>" readonly>
                    <label><?php echo app('translator')->get('accounts.payment_amount'); ?> <span>*</span> </label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('discount')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('discount')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-effect">
                    <select class="niceSelect1 w-100 bb form-control<?php echo e($errors->has('payment_mode') ? ' is-invalid' : ''); ?>" name="payment_mode" id="payment_mode">
                        <option data-display="Payment Method *" value=""><?php echo app('translator')->get('accounts.payment_method'); ?> *</option>
                        <?php if(isset($paymentMethods)): ?>
                        <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>" ><?php echo e($value->method); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <span class="modal_input_validation red_alert"></span>
                </div>
            </div>
        </div>
        <div class="row mt-25" id="bankOption">
            <div class="col-lg-12">
                <div class="input-effect">
                    <select class="niceSelect1 w-100 bb form-control<?php echo e($errors->has('bank_id') ? ' is-invalid' : ''); ?>" name="bank_id" id="account_id">
                    <?php if(isset($account_id)): ?>
                    <?php $__currentLoopData = $account_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->bank_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    </select>
                    <span class="focus-border"></span>
                    <?php if($errors->has('bank_id')): ?>
                    <span class="invalid-feedback invalid-select" role="alert">
                        <strong><?php echo e($errors->first('bank_id')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-12" id="sibling_name_div">
                <div class="input-effect mt-20">
                    <textarea class="primary-input form-control" cols="0" rows="3" name="note" id="note"></textarea>
                    <label><?php echo app('translator')->get('common.note'); ?> </label>
                    <span class="focus-border textarea"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 text-center mt-40">
        <div class="mt-40 d-flex justify-content-between">
            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
            <input class="primary-btn fix-gr-bg" type="submit" value="save information">
        </div>
    </div>
</div>
<?php echo e(Form::close()); ?>

</div>

<script>

 //Payroll proceed to pay
 $(document).ready(function(){
        $('#bankOption').hide();
    });

    $(document).ready(function(){
        $("#payment_mode").on("change", function() {
            if ($(this).val() == "3") {
                $('#bankOption').show();
            } else {
                $('#bankOption').hide();
            }
        });
    });



$("#search-icon").on("click", function() {
        $("#search").focus();
    });

    $("#start-date-icon").on("click", function() {
        $("#startDate").focus();
    });

    $("#end-date-icon").on("click", function() {
        $("#endDate").focus();
    });

    $(".primary-input.date").datepicker({
        autoclose: true,
        setDate: new Date(),
    });
    $(".primary-input.date").on("changeDate", function(ev) {
        // $(this).datepicker('hide');
        $(this).focus();
    });

    $(".primary-input.time").datetimepicker({
        format: "LT",
    });

    if ($(".niceSelect1").length) {
        $(".niceSelect1").niceSelect();
    }
</script><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/humanResource/payroll/paymentPayroll.blade.php ENDPATH**/ ?>