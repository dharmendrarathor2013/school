
<style>
    table.dataTable tfoot th, table.dataTable tfoot td.walletAmount{
        padding: 20px 10px 20px 30px !important;
    }
</style>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>
                <?php if(isset($status) && $status =='pending'): ?>
                    <?php echo app('translator')->get('common.pending'); ?> 
                <?php elseif(isset($status) && $status =='approve'): ?>
                    <?php echo app('translator')->get('wallet::wallet.approve_deposit'); ?>
                <?php else: ?>
                    <?php echo app('translator')->get('wallet::wallet.reject_deposit'); ?>
                <?php endif; ?>
               
            </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('wallet::wallet.wallet'); ?></a>
                <a href="#">
                    <?php if(isset($status) && $status =='pending'): ?>
                        <?php echo app('translator')->get('common.pending'); ?> 
                    <?php elseif(isset($status) && $status =='approve'): ?>
                        <?php echo app('translator')->get('wallet::wallet.approve_deposit'); ?>
                    <?php else: ?>
                        <?php echo app('translator')->get('wallet::wallet.reject_deposit'); ?> 
                    <?php endif; ?>
                   
                </a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_st_admin_visitor mt-20">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('common.sl'); ?></th>
                            <th><?php echo app('translator')->get('common.name'); ?></th>
                            <th><?php echo app('translator')->get('wallet::wallet.method'); ?></th>
                            <th><?php echo app('translator')->get('wallet::wallet.amount'); ?></th>
                            <th><?php echo app('translator')->get('common.status'); ?></th>
                            <th><?php echo app('translator')->get('wallet::wallet.note'); ?></th>
                            <?php if(isset($status) && $status =='reject'): ?>
                                <th><?php echo app('translator')->get('wallet::wallet.reject_note'); ?></th>
                            <?php endif; ?>
                            <th><?php echo app('translator')->get('common.file'); ?></th>
                            <th><?php echo app('translator')->get('common.date'); ?></th>
                            <?php if(isset($status) && $status =='approve'): ?>
                                <th><?php echo app('translator')->get('wallet::wallet.approve_date'); ?></th>
                            <?php endif; ?>
                            <?php if(isset($status) && $status =='reject'): ?>
                                <th><?php echo app('translator')->get('wallet::wallet.reject_date'); ?></th>
                            <?php endif; ?>
                            <?php if(isset($status) && $status =='pending'): ?>
                                <th><?php echo app('translator')->get('common.action'); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $totalAmount = 0;
                        ?>
                        <?php $__currentLoopData = $walletAmounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$walletAmount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td><?php echo e(@$walletAmount->userName->full_name); ?></td>
                                <td><?php echo e($walletAmount->payment_method); ?></td>
                                <td>
                                    <?php echo e(generalSetting()->currency_symbol); ?><?php echo e(number_format($walletAmount->amount, 2, '.', '')); ?>

                                    <?php
                                        $totalAmount+= $walletAmount->amount;
                                    ?>
                                </td>
                                <td>
                                    <?php if($walletAmount->status == 'pending'): ?>
                                        <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('common.pending'); ?></button> 
                                    <?php elseif($walletAmount->status == 'approve'): ?>
                                        <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('wallet::wallet.approve'); ?></button>
                                    <?php else: ?>
                                        <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->get('wallet::wallet.reject'); ?></button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($walletAmount->note): ?>
                                        <a class="text-color" data-toggle="modal" data-target="#note<?php echo e($walletAmount->id); ?>"  href="#"><?php echo app('translator')->get('common.view'); ?></a>
                                    <?php endif; ?>
                                </td>
                                
                                <?php if(isset($status) && $status =='reject'): ?>
                                    <td>
                                        <?php if($walletAmount->reject_note): ?>
                                            <a class="text-color" data-toggle="modal" data-target="#rejectNote<?php echo e($walletAmount->id); ?>"  href="#"><?php echo app('translator')->get('common.view'); ?></a>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                                <th>
                                    <?php if(file_exists($walletAmount->file)): ?>
                                        <a class="text-color" data-toggle="modal" data-target="#showFile<?php echo e($walletAmount->id); ?>"  href="#"><?php echo app('translator')->get('common.view'); ?></a>
                                    <?php endif; ?>
                                </th>
                                <td><?php echo e(dateConvert($walletAmount->created_at)); ?></td>
                                <?php if(isset($status) && $status !='pending'): ?>
                                    <td>
                                        <?php if($walletAmount->status == 'approve' || $walletAmount->status == 'reject'): ?>
                                            <?php echo e(dateConvert($walletAmount->updated_at)); ?>

                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                                <?php if(isset($status) && $status =='pending'): ?>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('common.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <?php if(userPermission(1111)): ?>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#approvePayment<?php echo e($walletAmount->id); ?>" href=""><?php echo app('translator')->get('wallet::wallet.approve'); ?></a>
                                                <?php endif; ?>
                                                <?php if(userPermission(1112)): ?>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#rejectwalletPayment<?php echo e($walletAmount->id); ?>" href="#"><?php echo app('translator')->get('wallet::wallet.reject'); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>

                            
                            <div class="modal fade admin-query" id="note<?php echo e($walletAmount->id); ?>">
                                <div class="modal-dialog modal-dialog-centered large-modal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo app('translator')->get('common.view_note'); ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body p-0 mt-30">
                                            <div class="container student-certificate">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-12 text-center">
                                                        <p><?php echo e($walletAmount->note); ?></p>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="modal fade admin-query" id="rejectNote<?php echo e($walletAmount->id); ?>">
                                <div class="modal-dialog modal-dialog-centered large-modal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo app('translator')->get('common.view_reject_note'); ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body p-0 mt-30">
                                            <div class="container student-certificate">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-12 text-center">
                                                        <p><?php echo e($walletAmount->reject_note); ?></p>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="modal fade admin-query" id="showFile<?php echo e($walletAmount->id); ?>">
                                <div class="modal-dialog modal-dialog-centered large-modal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo app('translator')->get('common.view_file'); ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body p-0 mt-30">
                                            <div class="container student-certificate">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-12 text-center">
                                                        <?php
                                                            $pdf = $walletAmount->file ? explode('.', @$walletAmount->file) : ""." . "."";
                                                            $for_pdf =  $pdf[1];
                                                        ?>
                                                        <?php if(@$for_pdf=="pdf"): ?>
                                                            <div class="mb-5">
                                                                <?php if(isset($status) && $status =='approve'): ?>
                                                                    <?php if(userPermission(1114)): ?>
                                                                        <a href="<?php echo e(url(@$walletAmount->file)); ?>" download><?php echo app('translator')->get('common.download'); ?> <span class="pl ti-download"></span></a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <?php if(isset($status) && $status =='reject'): ?>
                                                                    <?php if(userPermission(1116)): ?>
                                                                        <a href="<?php echo e(url(@$walletAmount->file)); ?>" download><?php echo app('translator')->get('common.download'); ?> <span class="pl ti-download"></span></a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <?php if(isset($status) && $status =='pending'): ?>
                                                                    <?php if(userPermission(1112)): ?>
                                                                        <a href="<?php echo e(url(@$walletAmount->file)); ?>" download><?php echo app('translator')->get('common.download'); ?> <span class="pl ti-download"></span></a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <?php if(file_exists($walletAmount->file)): ?>
                                                                <div class="mb-5">
                                                                    <img class="img-fluid" src="<?php echo e(asset($walletAmount->file)); ?>">
                                                                </div>
                                                                <br>
                                                                <div class="mb-5">
                                                                    <?php if(isset($status) && $status =='approve'): ?>
                                                                    <?php if(userPermission(1114)): ?>
                                                                            <a href="<?php echo e(url(@$walletAmount->file)); ?>" download><?php echo app('translator')->get('common.download'); ?> <span class="pl ti-download"></span></a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php if(isset($status) && $status =='reject'): ?>
                                                                        <?php if(userPermission(1116)): ?>
                                                                            <a href="<?php echo e(url(@$walletAmount->file)); ?>" download><?php echo app('translator')->get('common.download'); ?> <span class="pl ti-download"></span></a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php if(isset($status) && $status =='pending'): ?>
                                                                        <?php if(userPermission(1113)): ?>
                                                                            <a href="<?php echo e(url(@$walletAmount->file)); ?>" download><?php echo app('translator')->get('common.download'); ?> <span class="pl ti-download"></span></a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <?php if(isset($status) && $status =='pending'): ?>
                                
                                <div class="modal fade admin-query" id="approvePayment<?php echo e($walletAmount->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('wallet::wallet.approve'); ?> <?php echo e($walletAmount->payment_method); ?> <?php echo app('translator')->get('wallet::wallet.payment'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('wallet::wallet.are_you_sure_to_approve'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                                                    <?php echo e(Form::open(['method' => 'POST','route' =>'wallet.approve-payment'])); ?>

                                                        <input type="hidden" name="id" value="<?php echo e($walletAmount->id); ?>">
                                                        <input type="hidden" name="user_id" value="<?php echo e($walletAmount->user_id); ?>">
                                                        <input type="hidden" name="amount" value="<?php echo e($walletAmount->amount); ?>">
                                                        <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('wallet::wallet.approve'); ?></button>
                                                    <?php echo e(Form::close()); ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                

                                <div class="modal fade admin-query" id="rejectwalletPayment<?php echo e($walletAmount->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('wallet::wallet.reject'); ?> <?php echo e($walletAmount->payment_method); ?> <?php echo app('translator')->get('wallet::wallet.payment'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center">
                                                        <h4><?php echo app('translator')->get('wallet::wallet.are_you_sure_to_reject'); ?></h4>
                                                    </div>
                                                <?php echo e(Form::open(['route' => 'wallet.reject-payment', 'method' => 'POST'])); ?>

                                                        <input type="hidden" name="id" value="<?php echo e($walletAmount->id); ?>">
                                                        <input type="hidden" name="user_id" value="<?php echo e($walletAmount->user_id); ?>">
                                                        <input type="hidden" name="amount" value="<?php echo e($walletAmount->amount); ?>">
                                                    <div class="form-group">
                                                        <label><strong><?php echo app('translator')->get('wallet::wallet.reject_note'); ?></strong></label>
                                                        <textarea name="reject_note" class="form-control" rows="6"></textarea>
                                                    </div>
                                    
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.close'); ?></button>
                                                        <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('common.submit'); ?></button>
                                                    </div>
                                                <?php echo e(Form::close()); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade admin-query" id="showReasonModal" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('common.view'); ?> <?php echo app('translator')->get('fees.bank_payment_reject_note'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label><strong><?php echo app('translator')->get('wallet::wallet.reject_note'); ?></strong></label>
                                                    <textarea readonly class="form-control" rows="4"></textarea>
                                                </div>
                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn fix-gr-bg" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="walletAmount"></td>
                            <td class="walletAmount"></td>
                            <td class="walletAmount"><?php echo app('translator')->get('exam.result'); ?></td>
                            <td class="walletAmount"><?php echo e(generalSetting()->currency_symbol); ?><?php echo e(number_format($totalAmount,2,'.','')); ?></td>
                            <td class="walletAmount"></td>
                            <td class="walletAmount"></td>
                            <td class="walletAmount"></td>
                            <td class="walletAmount"></td>
                            <td class="walletAmount"></td>
                            <?php if(isset($status) && $status =='reject'): ?>
                                <td class="walletAmount"></td>
                            <?php endif; ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/Modules/Wallet/Resources/views/_walletRequest.blade.php ENDPATH**/ ?>