
<?php if(auth()->user()->role_id == 1): ?>
    <?php if(userPermission(1109) && menuStatus(1109)): ?>
        <li data-position="<?php echo e(menuPosition(1109)); ?>" class="sortable_li">
            <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
                <div class="nav_icon_small">
                    <span class="flaticon-accounting"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('wallet::wallet.wallet_deposit'); ?>
                </div>
            </a>
            <ul class="list-unstyled" id="subMenuWallet">
                <?php if(userPermission(1110) && menuStatus(1110)): ?>
                    <li data-position="<?php echo e(menuPosition(1110)); ?>">
                        <a href="<?php echo e(route('wallet.pending-diposit')); ?>"> <?php echo app('translator')->get('wallet::wallet.pending_deposit'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(userPermission(1114) && menuStatus(1114)): ?>
                    <li data-position="<?php echo e(menuPosition(1114)); ?>">
                        <a href="<?php echo e(route('wallet.approve-diposit')); ?>"> <?php echo app('translator')->get('wallet::wallet.approve_deposit'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(userPermission(1116) && menuStatus(1116)): ?>
                    <li data-position="<?php echo e(menuPosition(1116)); ?>">
                        <a href="<?php echo e(route('wallet.reject-diposit')); ?>"> <?php echo app('translator')->get('wallet::wallet.reject_deposit'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(userPermission(1118) && menuStatus(1118)): ?>
                    <li data-position="<?php echo e(menuPosition(1118)); ?>">
                        <a href="<?php echo e(route('wallet.wallet-transaction')); ?>"> <?php echo app('translator')->get('wallet::wallet.wallet_transaction'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(userPermission(1119) && menuStatus(1119)): ?>
                    <li data-position="<?php echo e(menuPosition(1119)); ?>">
                        <a href="<?php echo e(route('wallet.wallet-refund-request')); ?>"> <?php echo app('translator')->get('wallet::wallet.refund_request'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(userPermission(1123) && menuStatus(1123)): ?>
                    <li data-position="<?php echo e(menuPosition(1123)); ?>">
                        <a href="<?php echo e(route('wallet.wallet-report')); ?>"> <?php echo app('translator')->get('wallet::wallet.wallet_report'); ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>
    <?php endif; ?>
<?php elseif(auth()->user()->role_id == 2 || auth()->user()->role_id == 3): ?>
    <?php if(userPermission(1124) && menuStatus(1124) || userPermission(1127) && menuStatus(1127)): ?>
        <li data-position="
        <?php if(userPermission(1124)): ?>
            <?php echo e(menuPosition(1124)); ?>

        <?php elseif(userPermission(1127)): ?>
            <?php echo e(menuPosition(1124)); ?>

        <?php endif; ?>
        " class="sortable_li">
            <a href="<?php echo e(route('wallet.my-wallet')); ?>">                
                <div class="nav_icon_small">
                    <span class="flaticon-wallet"></span>
                </div>
                <div class="nav_title">
                    <?php echo app('translator')->get('wallet::wallet.my_wallet'); ?>
                </div>
            </a>
        </li>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\InfixEduv6.6.1\Modules/Wallet\Resources/views/menu/sidebar.blade.php ENDPATH**/ ?>