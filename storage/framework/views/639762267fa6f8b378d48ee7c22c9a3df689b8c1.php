<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('css'); ?>
    <?php echo Charts::styles(); ?>

    <?php \Actions::do_action('dashboard_styles') ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_header'); ?>
    <?php $__env->startComponent('components.content_header'); ?>

        <?php $__env->slot('page_title'); ?>
            <?php echo e($title); ?>

        <?php $__env->endSlot(); ?>

        <?php $__env->slot('breadcrumb'); ?>
            <?php echo e(Breadcrumbs::render('dashboard')); ?>

        <?php $__env->endSlot(); ?>

    <?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Charts::scripts(); ?>

    <?php \Actions::do_action('pre_display_dashboard') ?>

    <?php $__env->startComponent('components.box',['box_class'=>'no-block-ui']); ?>
        <?php echo $dashboard_content; ?>

    <?php echo $__env->renderComponent(); ?>

    <?php \Actions::do_action('post_display_dashboard') ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    ##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
    <?php \Actions::do_action('dashboard_scripts') ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>