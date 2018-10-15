<!-- contains the header -->
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(url('/')); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>C</b>o</span>
        <!-- logo for regular state and mobile devices -->
        <img src="<?php echo e(\Settings::get('site_logo')); ?>" class="" style="max-height: 30px;"/>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only"><?php echo app('translator')->getFromJson('corals-admin::labels.partial.toggle_navigation'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php Actions::do_action('show_navbar') ?>
                <?php if(count(\Settings::get('supported_languages', [])) > 1): ?>
                    <li class="dropdown locale">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo \Language::flag(); ?> <?php echo \Language::getName(); ?>

                            <i class="fa fa-angle-down"></i>
                        </a>
                        <?php echo \Language::flags('dropdown-menu'); ?>

                    </li>
                <?php endif; ?>
                <?php if(schemaHasTable('notifications')): ?>

                    <li class="dropdown notifications-menu">
                        <a href="<?php echo e(url('notifications')); ?>" class="_dropdown-toggle" data-_toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <?php if($unreadNotifications = user()->unreadNotifications()->count()): ?>
                                <span class="label label-warning"><?php echo e($unreadNotifications); ?></span>
                            <?php endif; ?>
                        </a>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </li>
                <?php endif; ?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo e(user()->picture_thumb); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo e(user()->name); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo e(user()->picture_thumb); ?>" class="img-circle"
                                 alt="User Image">

                            <p>
                                <?php echo e(user()->name); ?>

                            </p>
                            <p>
                                <?php echo e(user()->email); ?>

                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo e(url('profile')); ?>"
                                   class="btn btn-default btn-flat"><?php echo app('translator')->getFromJson('corals-admin::labels.partial.profile'); ?></a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo e(route('logout')); ?>" data-action="logout"
                                   class="btn btn-default btn-flat">
                                    <?php echo app('translator')->getFromJson('corals-admin::labels.partial.logout'); ?>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>