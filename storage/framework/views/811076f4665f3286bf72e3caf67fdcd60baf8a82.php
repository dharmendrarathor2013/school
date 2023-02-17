
<?php if(userPermission(1130) && menuStatus(1130)): ?>
    <li data-position="<?php echo e(menuPosition(1130)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
            <div class="nav_icon_small">
                <span class="flaticon-test"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('fees.fees'); ?>
            </div>
        </a>
        <ul class="list-unstyled" id="subMenuFees">
            <?php if(userPermission(1131) && menuStatus(1131)): ?>
                <li data-position="<?php echo e(menuPosition(1131)); ?>">
                    <a href="<?php echo e(route('fees.fees-group')); ?>"><?php echo app('translator')->get('fees.fees_group'); ?></a>
                </li>
            <?php endif; ?>

            <?php if(userPermission(1135) && menuStatus(1135)): ?>
                <li data-position="<?php echo e(menuPosition(1135)); ?>">
                    <a href="<?php echo e(route('fees.fees-type')); ?>"><?php echo app('translator')->get('fees.fees_type'); ?></a>
                </li>
            <?php endif; ?>

            <?php if(userPermission(1139) && menuStatus(1139)): ?>
                <li data-position="<?php echo e(menuPosition(1139)); ?>">
                    <a href="<?php echo e(route('fees.fees-invoice-list')); ?>"><?php echo app('translator')->get('fees::feesModule.fees_invoice'); ?></a>
                </li>
            <?php endif; ?>

            <?php if(userPermission(1148) && menuStatus(1148)): ?>
                <li data-position="<?php echo e(menuPosition(1148)); ?>">
                    <a href="<?php echo e(route('fees.bank-payment')); ?>"><?php echo app('translator')->get('fees.bank_payment'); ?></a>
                </li>
            <?php endif; ?>

            <?php if(userPermission(1152) && menuStatus(1152)): ?>
                <li data-position="<?php echo e(menuPosition(1152)); ?>">
                    <a href="<?php echo e(route('fees.fees-invoice-settings')); ?>"><?php echo app('translator')->get('fees::feesModule.fees_invoice_settings'); ?></a>
                </li>
            <?php endif; ?>

            <li>
                <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                    <?php echo app('translator')->get('reports.report'); ?>
                </a>
                <ul class="list-unstyled">
                    <?php if(userPermission(1155) && menuStatus(1155)): ?>
                        <li data-position="<?php echo e(menuPosition(1155)); ?>">
                            <a href="<?php echo e(route('fees.due-fees')); ?>">
                                <?php echo app('translator')->get('fees::feesModule.fees_due_report'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(userPermission(1158) && menuStatus(1158)): ?>
                        <li data-position="<?php echo e(menuPosition(1158)); ?>">
                            <a href="<?php echo e(route('fees.fine-report')); ?>">
                                <?php echo app('translator')->get('accounts.fine_report'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(userPermission(1159) && menuStatus(1159)): ?>
                        <li data-position="<?php echo e(menuPosition(1159)); ?>">
                            <a href="<?php echo e(route('fees.payment-report')); ?>">
                                <?php echo app('translator')->get('fees::feesModule.payment_report'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(userPermission(1160) && menuStatus(1160)): ?>
                        <li data-position="<?php echo e(menuPosition(1160)); ?>">
                            <a href="<?php echo e(route('fees.balance-report')); ?>">
                                <?php echo app('translator')->get('fees::feesModule.balance_report'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(userPermission(1161) && menuStatus(1161)): ?>
                        <li data-position="<?php echo e(menuPosition(1161)); ?>">
                            <a href="<?php echo e(route('fees.waiver-report')); ?>">
                                <?php echo app('translator')->get('fees::feesModule.waiver_report'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
    </li>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\school_erp\Modules/Fees\Resources/views/sidebar/adminSidebar.blade.php ENDPATH**/ ?>