<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(user()->picture_thumb); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><a href="<?php echo e(url('profile')); ?>" title="Profile"><?php echo e(user()->name); ?></a></p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="<?php echo e(\Request::is('dashboard')?'active':''); ?>">
                <a href="<?php echo e(url('dashboard')); ?>">
                    <i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span>
                </a>
            </li>
            <?php echo $__env->make('partials.menu.menu_item', ['menus'=>Menus::getMenu('sidebar','active') ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
