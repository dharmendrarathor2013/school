<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(url('Modules\Fees\Resources\assets\css\feesStyle.css')); ?>"/>
<?php $__env->stopPush(); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('fees::feesModule.fees_invoice'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('fees.fees'); ?></a>
                <a href="#"><?php echo app('translator')->get('fees::feesModule.fees_invoice'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($role) && $role =='admin'): ?>
            <?php if(userPermission(1140)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-25">
                        <a href="<?php echo e(route('fees.fees-invoice')); ?>" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            <?php echo app('translator')->get('common.add'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <?php if(isset($role) && $role =='admin' || $role=='lms'): ?>
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('common.sl'); ?></th>
                            <th><?php echo app('translator')->get('common.student'); ?></th>
                            
                            <th><?php echo app('translator')->get('accounts.amount'); ?></th>
                            <th><?php echo app('translator')->get('fees::feesModule.waiver'); ?></th>
                            <th><?php echo app('translator')->get('fees.fine'); ?></th>
                            <th><?php echo app('translator')->get('fees.paid'); ?></th>
                            <th><?php echo app('translator')->get('accounts.balance'); ?></th>
                            <th><?php echo app('translator')->get('common.status'); ?></th>
                            <th><?php echo app('translator')->get('common.date'); ?></th>
                            <th><?php echo app('translator')->get('common.action'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($studentInvoices)): ?>
                                <?php $__currentLoopData = $studentInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$studentInvoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $amount = $studentInvoice->Tamount;
                                        $weaver = $studentInvoice->Tweaver;
                                        $fine = $studentInvoice->Tfine;
                                        $paid_amount = $studentInvoice->Tpaidamount;
                                        $sub_total = $studentInvoice->Tsubtotal;
                                        $balance = ($amount+ $fine) - ($paid_amount + $weaver);
                                    ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('fees.fees-invoice-view',['id'=>$studentInvoice->id,'state'=>'view'])); ?>" target="_blank">
                                                <?php echo e(@$studentInvoice->studentInfo->full_name); ?>

                                            </a>
                                        </td>
                                        
                                        <td><?php echo e($amount); ?></td>
                                        <td><?php echo e($weaver); ?></td>
                                        <td><?php echo e($fine); ?></td>
                                        <td><?php echo e($paid_amount); ?></td>
                                        <td><?php echo e($balance); ?></td>
                                        <td>
                                            <?php if($balance == 0): ?>
                                                <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('fees.paid'); ?></button>
                                            <?php else: ?>
                                                <?php if($paid_amount > 0): ?>
                                                    <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('fees.partial'); ?></button>
                                                <?php else: ?>
                                                    <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->get('fees.unpaid'); ?></button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(dateConvert($studentInvoice->create_date)); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo app('translator')->get('common.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if(isset($role) && $role =='admin' || $role=='lms'): ?>
                                                        <?php if(userPermission(1141)): ?>
                                                            <a class="dropdown-item viewPaymentDetail" data-id="<?php echo e($studentInvoice->id); ?>"><?php echo app('translator')->get('inventory.view_payment'); ?></a>
                                                        <?php endif; ?>
                                                        <?php if($balance == 0): ?>
                                                            <?php if(userPermission(1142)): ?>
                                                                <a class="dropdown-item" href="<?php echo e(route('fees.fees-invoice-view',['id'=>$studentInvoice->id,'state'=>'view'])); ?>"><?php echo app('translator')->get('common.view'); ?></a>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php if($paid_amount > 0): ?>
                                                                <?php if(userPermission(1142)): ?>
                                                                    <a class="dropdown-item" href="<?php echo e(route('fees.fees-invoice-view',['id'=>$studentInvoice->id,'state'=>'view'])); ?>"><?php echo app('translator')->get('common.view'); ?></a>
                                                                <?php endif; ?>
                                                                <?php if(userPermission(1144)): ?>
                                                                    <a class="dropdown-item" href="<?php echo e(route('fees.add-fees-payment',$studentInvoice->id)); ?>"><?php echo app('translator')->get('inventory.add_payment'); ?></a>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if(userPermission(1142)): ?>
                                                                    <a class="dropdown-item" href="<?php echo e(route('fees.fees-invoice-view',['id'=>$studentInvoice->id,'state'=>'view'])); ?>"><?php echo app('translator')->get('common.view'); ?></a>
                                                                <?php endif; ?>
                                                                <?php if(userPermission(1144)): ?>
                                                                    <a class="dropdown-item" href="<?php echo e(route('fees.add-fees-payment',$studentInvoice->id)); ?>"><?php echo app('translator')->get('inventory.add_payment'); ?></a>
                                                                <?php endif; ?>

                                                                <?php if(userPermission(1145)): ?>
                                                                    <a class="dropdown-item" href="<?php echo e(route('fees.fees-invoice-edit',$studentInvoice->id)); ?>"><?php echo app('translator')->get('common.edit'); ?></a>
                                                                <?php endif; ?>

                                                                <?php if(userPermission(1146)): ?>
                                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteFeesPayment<?php echo e($studentInvoice->id); ?>" href="#"><?php echo app('translator')->get('common.delete'); ?></a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    <div class="modal fade admin-query" id="deleteFeesPayment<?php echo e($studentInvoice->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('fees::feesModule.delete_fees_invoice'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                        <?php echo e(Form::open(['method' => 'POST','route' =>'fees.fees-invoice-delete'])); ?>

                                                            <input type="hidden" name="id" value="<?php echo e($studentInvoice->id); ?>">
                                                            <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.delete'); ?></button>
                                                        <?php echo e(Form::close()); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="modal fade admin-query" id="viewFeesPayment">
                        <div class="modal-dialog modal-dialog-centered max_modal">
                            <div class="modal-content">
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-lg-12 student-details up_admin_visitor">
                    <ul class="nav nav-tabs tabs_scroll_nav ml-0" role="tablist">
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if($key== 0): ?> active <?php endif; ?> " href="#tab<?php echo e($key); ?>" role="tab" data-toggle="tab"><?php echo e($record->class->class_name); ?> (<?php echo e($record->section->section_name); ?>) </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                    <div class="tab-content mt-40">
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div role="tabpanel" class="tab-pane fade  <?php if($key== 0): ?> active show <?php endif; ?>" id="tab<?php echo e($key); ?>">
                                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('common.sl'); ?></th>
                                        <th><?php echo app('translator')->get('common.student'); ?></th>
                                        <th><?php echo app('translator')->get('student.class_section'); ?></th>
                                        <th><?php echo app('translator')->get('accounts.amount'); ?></th>
                                        <th><?php echo app('translator')->get('fees::feesModule.waiver'); ?></th>
                                        <th><?php echo app('translator')->get('fees.fine'); ?></th>
                                        <th><?php echo app('translator')->get('fees.paid'); ?></th>
                                        <th><?php echo app('translator')->get('accounts.balance'); ?></th>
                                        <th><?php echo app('translator')->get('common.status'); ?></th>
                                        <th><?php echo app('translator')->get('common.date'); ?></th>
                                        <th><?php echo app('translator')->get('common.action'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $record->feesInvoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$studentInvoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $amount = $studentInvoice->Tamount;
                                                $weaver = $studentInvoice->Tweaver;
                                                $fine = $studentInvoice->Tfine;
                                                $paid_amount = $studentInvoice->Tpaidamount;
                                                $sub_total = $studentInvoice->Tsubtotal;
                                                $balance = ($amount+ $fine) - ($paid_amount + $weaver);
                                            ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('fees.fees-invoice-view',['id'=>$studentInvoice->id,'state'=>'view'])); ?>" target="_blank">
                                                        <?php echo e(@$studentInvoice->studentInfo->full_name); ?>

                                                    </a>
                                                </td>
                                                <td><?php echo e(@$studentInvoice->recordDetail->class->class_name); ?> (<?php echo e(@$studentInvoice->recordDetail->section->section_name); ?>)</td>
                                                <td><?php echo e($amount); ?></td>
                                                <td><?php echo e($weaver); ?></td>
                                                <td><?php echo e($fine); ?></td>
                                                <td><?php echo e($paid_amount); ?></td>
                                                <td><?php echo e($balance); ?></td>
                                                <td>
                                                    <?php if($balance == 0): ?>
                                                        <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('fees.paid'); ?></button>
                                                    <?php else: ?>
                                                        <?php if($paid_amount > 0): ?>
                                                            <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('fees.partial'); ?></button>
                                                        <?php else: ?>
                                                            <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->get('fees.unpaid'); ?></button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(dateConvert($studentInvoice->create_date)); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                            <?php echo app('translator')->get('common.select'); ?>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="<?php echo e(route('fees.fees-invoice-view',['id'=>$studentInvoice->id,'state'=>'view'])); ?>"><?php echo app('translator')->get('common.view'); ?></a>
                                                            <?php if($balance != 0): ?>
                                                                <a class="dropdown-item" href="<?php echo e(route('fees.student-fees-payment',$studentInvoice->id)); ?>"><?php echo app('translator')->get('inventory.add_payment'); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<script>
    $('.viewPaymentDetail').on('click', function(e) {
        $('#viewFeesPayment').modal('show');
        e.preventDefault();
        let invoiceId = $(this).data('id');

        $.ajax({
            url: "<?php echo e(route('fees.fees-view-payment')); ?>",
            method: "POST",
            data : { invoiceId : invoiceId},
            success: function(response) {
                $('#viewFeesPayment .modal-content').html(response);
            },
        });
    });
    // $('[data-tooltip="tooltip"]').tooltip();
</script><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/Modules/Fees/Resources/views/_allFeesList.blade.php ENDPATH**/ ?>