<div class="row">
    <div class="col-12">
        <div class="d-flex mb-25 align-items-center justify-content-between">
            <?php if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3): ?>
                <button class="primary-btn small fix-gr-bg">
                        <?php echo app('translator')->get('wallet::wallet.balance'); ?>: <?php echo e(generalSetting()->currency_symbol); ?><?php echo e((Auth::user()->wallet_balance != null) ? number_format(Auth::user()->wallet_balance, 2, '.', ''): 0.00); ?>

                </button>

                <?php if(userPermission(1125) || userPermission(1128)): ?>
                    <button class="primary-btn small fix-gr-bg mr-2 ml-auto" data-toggle="modal" data-target="#addWalletPayment">
                        <span class="ti-plus pr-2"></span>
                        <?php echo app('translator')->get('wallet::wallet.add_balance'); ?>
                    </button>
                <?php endif; ?>
                <?php if(userPermission(1126) || userPermission(1129)): ?>
                    <button class="primary-btn small fix-gr-bg" data-toggle="modal" data-target="#refundRequest">
                        <?php echo app('translator')->get('wallet::wallet.refund_request'); ?>
                    </button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row mt-30">
    <div class="col-lg-12">
        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('common.sl'); ?></th>
                    <th><?php echo app('translator')->get('wallet::wallet.method'); ?> </th>
                    <th><?php echo app('translator')->get('wallet::wallet.amount'); ?></th>
                    <th><?php echo app('translator')->get('common.status'); ?></th>
                    <th><?php echo app('translator')->get('wallet::wallet.issue_date'); ?></th>
                    <th><?php echo app('translator')->get('wallet::wallet.note'); ?></th>
                    <th><?php echo app('translator')->get('common.file'); ?></th>
                    <th><?php echo app('translator')->get('wallet::wallet.approve_date'); ?></th>
                    <th><?php echo app('translator')->get('wallet::wallet.feedback'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $walletAmounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$walletAmount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td><?php echo e($walletAmount->payment_method); ?></td>
                    <td><?php echo e(generalSetting()->currency_symbol); ?><?php echo e(number_format($walletAmount->amount, 2, '.', '')); ?></td>
                    <td>
                        <?php if($walletAmount->status == 'pending'): ?>
                            <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('common.pending'); ?></button> 
                        <?php elseif($walletAmount->type == 'diposit' && $walletAmount->status == 'approve'): ?>
                            <button class="primary-btn small bg-success text-white border-0"><?php echo app('translator')->get('wallet::wallet.approve'); ?></button>
                        <?php elseif($walletAmount->status == 'reject'): ?>
                            <button class="primary-btn small bg-danger text-white border-0"><?php echo app('translator')->get('wallet::wallet.reject'); ?></button>
                        <?php elseif($walletAmount->type == 'refund' && $walletAmount->status == 'approve'): ?>
                            <button class="primary-btn small bg-primary text-white border-0"><?php echo app('translator')->get('wallet::wallet.refund'); ?></button>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e(dateConvert($walletAmount->created_at)); ?></td>
                    <td>
                        <?php if(file_exists($walletAmount->file)): ?>
                            <a class="text-color" data-toggle="modal" data-target="#showNote<?php echo e($walletAmount->id); ?>"  href="#"><?php echo app('translator')->get('common.view'); ?></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(file_exists($walletAmount->file)): ?>
                            <a class="text-color" data-toggle="modal" data-target="#showFile<?php echo e($walletAmount->id); ?>"  href="#"><?php echo app('translator')->get('common.view'); ?></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($walletAmount->status == 'approve' || $walletAmount->status == 'reject'): ?>
                            <?php echo e(dateConvert($walletAmount->updated_at)); ?>

                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($walletAmount->reject_note): ?>
                            <a class="text-color" data-toggle="modal" data-target="#feedBack<?php echo e($walletAmount->id); ?>"  href="#"><?php echo app('translator')->get('common.view'); ?></a>
                        <?php endif; ?>
                    </td>
                </tr>

                
                <div class="modal fade admin-query" id="showNote<?php echo e($walletAmount->id); ?>">
                    <div class="modal-dialog modal-dialog-centered large-modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo app('translator')->get('wallet::wallet.view_note'); ?></h4>
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
                

                
                <div class="modal fade admin-query" id="showFile<?php echo e($walletAmount->id); ?>">
                    <div class="modal-dialog modal-dialog-centered large-modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo app('translator')->get('wallet::wallet.view_file'); ?></h4>
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
                                                    <a href="<?php echo e(url(@$walletAmount->file)); ?>" download><?php echo app('translator')->get('common.download'); ?> <span class="pl ti-download"></span></a>
                                                </div>
                                            <?php else: ?>
                                                <?php if(file_exists($walletAmount->file)): ?>
                                                    <div class="mb-5">
                                                        <img class="img-fluid" src="<?php echo e(asset($walletAmount->file)); ?>">
                                                    </div>
                                                    <br>
                                                    <div class="mb-5">
                                                        <a href="<?php echo e(url(@$walletAmount->file)); ?>" download><?php echo app('translator')->get('common.download'); ?> <span class="pl ti-download"></span></a>
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

                

                
                <div class="modal fade admin-query" id="feedBack<?php echo e($walletAmount->id); ?>">
                    <div class="modal-dialog modal-dialog-centered large-modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo app('translator')->get('wallet::wallet.view_feedback'); ?></h4>
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
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade admin-query" id="addWalletPayment">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('wallet::wallet.add_amount'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'wallet.add-wallet-amount', 'method' => 'POST', 'enctype' => 'multipart/form-data','id'=> 'addWalletAmount' ])); ?>

                    <div class="row mt-25">
                        <div class="col-lg-12">
                            <div class="input-effect">
                                <input class="primary-input form-control" type="text" name="amount" id="walletAmount">
                                <label><?php echo app('translator')->get('wallet::wallet.amount'); ?> <span>*</span> </label>
                                <span class="walletError" id="walletAmountError"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-20">
                        <div class="col-lg-12">
                            <select class="niceSelect w-100 bb form-control" name="payment_method" id="addWalletPaymentMethod">
                                <option data-display="<?php echo app('translator')->get('fees.payment_method'); ?> *" value=""><?php echo app('translator')->get('fees.payment_method'); ?> *</option>
                                <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($paymentMethod->method); ?>"><?php echo e($paymentMethod->method); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="walletError" id="paymentMethodError"></span>
                        </div>
                    </div>

                    <div class="row mt-20 addWalletBank d-none">
                        <div class="col-lg-12">
                            <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('bank') ? ' is-invalid' : ''); ?>" name="bank">
                                <option data-display="<?php echo app('translator')->get('fees.select_bank'); ?>*" value=""><?php echo app('translator')->get('fees.select_bank'); ?>*</option>
                                <?php $__currentLoopData = $bankAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bankAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($bankAccount->id); ?>" <?php echo e(old('bank') == $bankAccount->id ? 'selected' : ''); ?>><?php echo e($bankAccount->bank_name); ?> (<?php echo e($bankAccount->account_number); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="walletError" id="bankError"></span>
                        </div>
                    </div>

                    <div class="row mt-20 AddWalletChequeBank d-none">
                        <div class="col-lg-12">
                            <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="3" name="note" id="note"><?php echo e(old('note')); ?></textarea>
                                <label><?php echo app('translator')->get('wallet::wallet.note'); ?> <span></span> </label>
                                <span class="focus-border textarea"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row no-gutters input-right-icon mt-25 AddWalletChequeBank d-none">
                        <div class="col">
                            <div class="input-effect">
                                <input class="primary-input form-control <?php echo e($errors->has('file') ? ' is-invalid' : ''); ?>" readonly="true" type="text"
                                    placeholder="<?php echo e(isset($editData->upload_file) && @$editData->upload_file != ""? getFilePath3(@$editData->upload_file):trans('common.file').''); ?>"
                                    id="placeholderUploadContent">
                                <span class="focus-border"></span>
                                <?php if($errors->has('file')): ?>
                                    <span class="invalid-feedback mb-10" role="alert">
                                        <strong><?php echo e($errors->first('file')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="primary-btn-small-input" type="button">
                                <label class="primary-btn small fix-gr-bg" for="upload_content_file"><?php echo app('translator')->get('common.browse'); ?></label>
                                <input type="file" class="d-none form-control" name="file" id="upload_content_file">
                            </button>
                        </div>
                        <br>
                    </div>

                    <div class="AddWalletChequeBank d-none text-center">
                        <code>(JPG, JPEG, PNG, PDF are allowed for upload)</code>
                    </div>
                    <span class="walletError" id="fileError"></span>

                    <div class="stripeInfo d-none">
                        <div class="row mt-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('name_on_card') ? ' is-invalid' : ''); ?>" type="text" name="name_on_card" id="name_on_card" autocomplete="off" value="<?php echo e(old('name_on_card')); ?>">
                                    <label><?php echo app('translator')->get('accounts.name_on_card'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('name_on_card')): ?>
                                        <span class="invalid-feedback" role="alert"> <strong><?php echo e($errors->first('name_on_card')); ?></strong></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input form-control card-number" type="text" name="card-number" id="card-number" autocomplete="off" value="<?php echo e(old('card-number')); ?>">
                                    <label><?php echo app('translator')->get('accounts.card_number'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('card_number')): ?>
                                        <span class="invalid-feedback" role="alert"> <strong><?php echo e($errors->first('card_number')); ?></strong></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input form-control card-cvc" type="text" name="card-cvc" id="card-cvc" autocomplete="off" value="<?php echo e(old('card-cvc')); ?>">
                                    <label><?php echo app('translator')->get('accounts.cvc'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('cvc')): ?>
                                        <span class="invalid-feedback" role="alert"> <strong><?php echo e($errors->first('cvc')); ?></strong></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input form-control card-expiry-month" type="text" name="card-expiry-month" id="card-expiry-month" autocomplete="off" value="<?php echo e(old('card-expiry-month')); ?>">
                                    <label><?php echo app('translator')->get('accounts.expiration_month'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('expiration_month')): ?>
                                        <span class="invalid-feedback" role="alert"> <strong><?php echo e($errors->first('expiration_month')); ?></strong></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input form-control card-expiry-year" type="text" name="card-expiry-year" id="card-expiry-year" autocomplete="off" value="<?php echo e(old('card-expiry-year')); ?>">
                                    <label><?php echo app('translator')->get('accounts.expiration_year'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('expiration_year')): ?>
                                        <span class="invalid-feedback" role="alert"> <strong><?php echo e($errors->first('expiration_year')); ?></strong></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-30">
                        <div class="col-lg-12 text-center">
                            <button class="primary-btn fix-gr-bg submit addWallet generalPay" title="<?php echo app('translator')->get('common.add'); ?>">
                                <span class="ti-check"></span><?php echo app('translator')->get('common.add'); ?>
                            </button>
                        </div>
                    </div>
                <?php echo e(Form::close()); ?>


            </div>
        </div>
    </div>
</div>

<div class="modal fade admin-query" id="refundRequest">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('wallet::wallet.refund_request'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'wallet.wallet-refund-request-store', 'method' => 'POST', 'enctype' => 'multipart/form-data','id'=> 'refundAmount'])); ?>

                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                <div class="modal-body">
                    <div class="row mt-25">
                        <div class="col-lg-12">
                            <div class="input-effect">
                                <input class="primary-input border-0" type="text" value="<?php echo e((Auth::user()->wallet_balance != null) ? number_format(Auth::user()->wallet_balance, 2, '.', ''): 0.00); ?>" name="refund_amount" readonly>
                                <label><?php echo app('translator')->get('wallet::wallet.wallet_balance'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>)</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-20">
                        <div class="col-lg-12">
                            <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="3" name="refund_note" id="refundNote"><?php echo e(old('refund_note')); ?></textarea>
                                <label><?php echo app('translator')->get('wallet::wallet.note'); ?><span>*</span> </label>
                                <span class="focus-border textarea"></span>
                                <span class="walletError" id="refundNoteError"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row no-gutters input-right-icon mt-25">
                        <div class="col">
                            <div class="input-effect sm2_mb_20 md_mb_20">
                                    <input class="primary-input form-control <?php echo e($errors->has('refund_file') ? ' is-invalid' : ''); ?>" readonly="true" type="text"
                                        placeholder="<?php echo e(isset($editData->upload_file) && @$editData->upload_file != ""? getFilePath3(@$editData->upload_file):trans('common.file').''); ?>"
                                        id="placeholderRefund">
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('refund_file')): ?>
                                        <span class="invalid-feedback mb-10" role="alert">
                                            <strong><?php echo e($errors->first('refund_file')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="primary-btn-small-input" type="button">
                                <label class="primary-btn small fix-gr-bg" for="wallet_refund"><?php echo app('translator')->get('common.browse'); ?></label>
                                <input type="file" id="wallet_refund" class="d-none cutom-photo" name="refund_file">
                            </button>
                        </div>
                    </div>
                    <div class="text-center">
                        <code>(JPG, JPEG, PNG, PDF are allowed for upload)</code>
                    </div>
                    <span class="walletError" id="refundFileError"></span>
                    <span class="walletError" id="existsError"></span>
                    <?php if(Auth::user()->wallet_balance > 0): ?>
                        <div class="row mt-30">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg submit addWallet" title="<?php echo app('translator')->get('common.add'); ?>">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('common.submit'); ?>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>



<?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/Modules/Wallet/Resources/views/_addWallet.blade.php ENDPATH**/ ?>