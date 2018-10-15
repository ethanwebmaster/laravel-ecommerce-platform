<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($dir.'/css/elfinder.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset($dir.'/css/theme.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_header'); ?>
    <?php $__env->startComponent('components.content_header'); ?>

        <?php $__env->slot('page_title'); ?>
            <?php echo e($title); ?>

        <?php $__env->endSlot(); ?>

        <?php $__env->slot('breadcrumb'); ?>
            <?php echo e(Breadcrumbs::render('file-manager')); ?>

        <?php $__env->endSlot(); ?>

    <?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <!-- Element where elFinder will be created (REQUIRED) -->
            <div id="elfinder"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <!-- elFinder JS (REQUIRED) -->
    <script src="<?php echo e(asset($dir.'/js/elfinder.min.js')); ?>"></script>

    <?php if($locale): ?>
        <!-- elFinder translation (OPTIONAL) -->
        <script src="<?php echo e(asset($dir."/js/i18n/elfinder.$locale.js")); ?>"></script>
    <?php endif; ?>

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript" charset="utf-8">
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        $().ready(function () {
            $('#elfinder').elfinder({
                // set your elFinder options here
                <?php if($locale): ?>
                lang: '<?php echo e($locale); ?>', // locale
                <?php endif; ?>
                customData: {
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                url: '<?php echo e(route("file-manager.connector")); ?>',  // connector URL
                soundPath: '<?php echo e(asset($dir.'/sounds')); ?>'
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>