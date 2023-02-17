<li>
    <a  href="javascript:void(0)" class="has-arrow" aria-expanded="false">       
        <div class="nav_icon_small">
            <span class="flaticon-reading"></span>
        </div>
        <div class="nav_title">
            <?php echo app('translator')->get('menumanage::menuManage.menu'); ?>  
        </div>
    </a>
    <ul class="list-unstyled" id="subMenuPosition">            
            <li>
                <a href="<?php echo e(route('menumanage.index')); ?>"> <?php echo app('translator')->get('menumanage::menuManage.manage_position'); ?></a>
            </li>      
        
    </ul>
</li><?php /**PATH /var/www/html/impact-eschool-erp-main/Modules/MenuManage/Resources/views/menu/sidebar.blade.php ENDPATH**/ ?>