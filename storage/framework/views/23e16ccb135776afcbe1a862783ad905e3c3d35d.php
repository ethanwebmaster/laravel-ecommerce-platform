<?php $__env->startSection('title', '500'); ?>

<?php $__env->startSection('content'); ?>
    <h1 style="color: orangered;">500</h1>
    <div class="title m-b-md">
        <strong>Sorry,</strong> Something went wrong!
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('errors.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>