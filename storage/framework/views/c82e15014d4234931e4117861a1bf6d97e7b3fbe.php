<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(\Settings::get('site_name', 'Corals')); ?></title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php echo $__env->make('partials.scripts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <style type="text/css">
        body {
            color: #f8e8e7;
        }

        a {
            color: #3fc3ee;
        }

        .login-box-body, .register-box-body {
            background: #1D2939;
            padding: 20px;
            color: #f8e8e7;
            border: #000 solid 1px;
            border-bottom-right-radius: 50px;
        }

        .login-page, .register-page {
        <?php if($background = \Settings::get('login_background')): ?>
          <?php echo e($background); ?>

        <?php endif; ?>






        }

        .login-box, .register-box {
            margin: 6% auto;
        }

        html, body {
            height: auto;
        }
    </style>

    <?php echo $__env->yieldContent('css'); ?>
    <style type="text/css">
        <?php echo \Settings::get('custom_admin_css', ''); ?>

    </style>
</head>
<body class="hold-transition login-page no-block-ui">

<!-- Main content -->
<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="login-logo text-center">
            <a href="<?php echo e(url('/')); ?>">
                <img class="site_logo img-responsive m-t-20"
                     style="max-width: 290px; margin: 0 auto;"
                     src="<?php echo e(\Settings::get('site_logo')); ?>">
            </a>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.content -->

<?php echo $__env->make('partials.scripts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php \Actions::do_action('admin_footer_js') ?>


<?php echo $__env->yieldContent('js'); ?>

</body>
</html>