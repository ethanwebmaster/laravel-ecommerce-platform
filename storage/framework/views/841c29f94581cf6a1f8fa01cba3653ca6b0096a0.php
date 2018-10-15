<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($menu->hasChildren('active') && $menu->user_can_access): ?>
        <li class="treeview <?php echo e(\Request::is(explode(',',$menu->active_menu_url))?'active menu-open':''); ?>">
            <a href="#">
                <?php if($menu->icon): ?><i class="<?php echo e($menu->icon); ?> fa-fw"></i><?php endif; ?> <span><?php echo e($menu->name); ?></span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <?php echo $__env->make('partials.menu.menu_item', ['menus'=>$menu->getChildren('active')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </ul>
        </li>
    <?php elseif($menu->user_can_access): ?>
        <li class="<?php echo e(\Request::is(explode(',',$menu->active_menu_url))?'active':''); ?>">
            <a href="<?php echo e(url($menu->url)); ?>" target="<?php echo e($menu->target??'_self'); ?>">
                <?php if($menu->icon): ?><i class="<?php echo e($menu->icon); ?> fa-fw"></i><?php endif; ?> <span><?php echo e($menu->name); ?></span>
            </a>
        </li>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>