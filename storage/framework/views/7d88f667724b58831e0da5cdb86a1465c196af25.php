<?php if(userPermission(900) && menuStatus(900)): ?>
    <li  data-position="<?php echo e(menuPosition(900)); ?>" class="sortable_li">
        <a href="javascript:void(0)" class="has-arrow" aria-expanded="false">
            <div class="nav_icon_small">
                <span class="flaticon-test"></span>
            </div>
            <div class="nav_title">
                <?php echo app('translator')->get('chat::chat.chat'); ?>
            </div>
        </a>
        <ul class="list-unstyled" id="subMenuChat">
            <?php if(userPermission(901) && menuStatus(901)): ?>
                <li  data-position="<?php echo e(menuPosition(901)); ?>" >
                    <a href="<?php echo e(route('chat.index')); ?>"><?php echo app('translator')->get('chat::chat.chat_box'); ?></a>
                </li>
            <?php endif; ?>

            <?php if(userPermission(903) && menuStatus(903)): ?>
                <li data-position="<?php echo e(menuPosition(903)); ?>" >
                    <a href="<?php echo e(route('chat.invitation')); ?>"><?php echo app('translator')->get('chat::chat.invitation'); ?></a>
                </li>
            <?php endif; ?>

            <?php if(userPermission(904) && menuStatus(904)): ?>
                <li data-position="<?php echo e(menuPosition(904)); ?>" >
                    <a href="<?php echo e(route('chat.blocked.users')); ?>"><?php echo app('translator')->get('chat::chat.blocked_user'); ?></a>
                </li>
            <?php endif; ?>

            <?php if(userPermission(905) && menuStatus(905)): ?>
                <li data-position="<?php echo e(menuPosition(905)); ?>" >
                    <a href="<?php echo e(route('chat.settings')); ?>"><?php echo app('translator')->get('chat::chat.settings'); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\InfixEduv6.6.1\Modules/Chat\Resources/views/menu.blade.php ENDPATH**/ ?>