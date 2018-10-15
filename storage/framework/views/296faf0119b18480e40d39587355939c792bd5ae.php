<!-- jQuery 3 -->
<?php echo Theme::js('plugins/jquery/dist/jquery.min.js'); ?>

<!-- Bootstrap 3.3.7 -->
<?php echo Theme::js('plugins/bootstrap/dist/js/bootstrap.min.js'); ?>


<?php echo Assets::js(); ?>


<!-- iCheck -->
<?php echo Theme::js('plugins/iCheck/icheck.min.js'); ?>

<!-- Pace -->
<?php echo Theme::js('plugins/pace/pace.min.js'); ?>


<!-- Jquery BlockUI -->
<?php echo Theme::js('plugins/jquery-block-ui/jquery.blockUI.min.js'); ?>


<!-- Ladda -->
<?php echo Theme::js('plugins/Ladda/spin.min.js'); ?>

<?php echo Theme::js('plugins/Ladda/ladda.min.js'); ?>


<!-- toastr -->
<?php echo Theme::js('plugins/toastr/toastr.min.js'); ?>

<!-- SlimScroll -->
<?php echo Theme::js('plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>

<!-- FastClick -->
<?php echo Theme::js('plugins/fastclick/lib/fastclick.js'); ?>


<?php echo Theme::js('plugins/sweetalert2/dist/sweetalert2.all.min.js'); ?>

<?php echo Theme::js('plugins/select2/dist/js/select2.full.min.js'); ?>

<!-- AdminLTE App -->
<?php echo Theme::js('js/adminlte.min.js'); ?>


<?php echo Theme::js('js/functions.js'); ?>

<?php echo Theme::js('js/main.js'); ?>

<!-- corals js -->
<?php echo Theme::js('plugins/lodash/lodash.js'); ?>

<?php echo \Html::script('assets/corals/plugins/lightbox2/js/lightbox.min.js'); ?>

<?php echo \Html::script('assets/corals/plugins/clipboard/clipboard.min.js'); ?>

<?php echo \Html::script('assets/corals/js/corals_functions.js'); ?>

<?php echo \Html::script('assets/corals/js/corals_main.js'); ?>

<?php echo $__env->make('Corals::corals_main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('js'); ?>

<?php  \Actions::do_action('admin_footer_js') ?>

<?php echo $__env->make('partials.notifications', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>