<!DOCTYPE html>
<html lang="<?php echo e(\Language::getCode()); ?>" dir="<?php echo e(\Language::getDirection()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php if($unreadNotifications = user()->unreadNotifications()->count()): ?>
            (<?php echo e($unreadNotifications); ?>)
        <?php endif; ?>
        <?php echo $__env->yieldContent('title'); ?> | <?php echo e(\Settings::get('site_name', 'Corals')); ?>

    </title>

    <link rel="shortcut icon" href="<?php echo e(\Settings::get('site_favicon')); ?>" type="image/png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php echo $__env->make('partials.scripts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <style type="text/css">
        <?php echo \Settings::get('custom_admin_css', ''); ?>

    </style>
</head>
<body class="skin-purple-light <?php echo e(isset($hide_sidebar) && $hide_sidebar?'sidebar-hidden':'sidebar-mini'); ?>">
<!-- Site wrapper -->
<div class="wrapper">


<?php echo $__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- =============================================== -->
<?php if(!(isset($hide_sidebar) && $hide_sidebar)): ?>
    <!-- Left side column. contains the sidebar -->
    <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <?php echo $__env->yieldContent('content_header'); ?>
    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $__env->yieldContent('custom-actions'); ?>
                </div>
                <div class="col-md-6 text-right" style="padding-bottom: 10px;">
                    <?php echo $__env->yieldContent('actions'); ?>
                </div>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('components.modal',['id'=>'global-modal'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('partials.scripts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script type="text/javascript">
        <?php echo \Settings::get('custom_admin_js', ''); ?>

    </script>
</div>
</body>
</html>