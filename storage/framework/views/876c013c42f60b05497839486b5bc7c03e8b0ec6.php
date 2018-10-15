<!-- Bootstrap 3.3.7 -->
<?php echo Theme::css('plugins/bootstrap/dist/css/bootstrap.min.css'); ?>

<!-- animate.css -->
<?php echo Theme::css('plugins/animate.css/animate.min.css'); ?>

<!-- Font Awesome -->
<?php echo Theme::css('plugins/font-awesome/css/font-awesome.min.css'); ?>


<?php echo Theme::css('plugins/select2/dist/css/select2.min.css'); ?>

<!-- Theme style -->
<?php echo Theme::css('css/AdminLTE.css'); ?>

<!-- iCheck -->
<?php echo Theme::css('plugins/iCheck/all.css'); ?>

<!-- AdminLTE Skins. Choose a skin from the css/skins

<!-- Pace style -->
<?php echo Theme::css('plugins/pace/pace.min.css'); ?>


<!-- Ladda  -->
<?php echo Theme::css('plugins/Ladda/ladda-themeless.min.css'); ?>



<!-- toastr -->
<?php echo Theme::css('plugins/toastr/toastr.min.css'); ?>

<!-- sweetalert2 -->
<?php echo Theme::css('plugins/sweetalert2/dist/sweetalert2.css'); ?>

<?php echo \Html::style('assets/corals/plugins/lightbox2/css/lightbox.min.css'); ?>


<?php echo Theme::css('css/core.css'); ?>

<?php echo Theme::css('css/custom.css'); ?>




<?php echo \Assets::css(); ?>


<?php if(\Language::isRTL()): ?>
    <?php echo Theme::css('css/style-rtl.css'); ?>

    <?php echo Theme::css('plugins/bootstrap/dist/css/bootstrap-rtl.css'); ?>


<?php endif; ?>


<?php echo $__env->yieldContent('css'); ?>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></link>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script type="text/javascript">
    window.base_url = '<?php echo url('/'); ?>';
</script>

<?php echo \Html::script('assets/corals/js/corals_header.js'); ?>


<?php if(\Settings::get('google_analytics_id')): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async
            src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(\Settings::get('google_analytics_id')); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', "<?php echo e(\Settings::get('google_analytics_id')); ?>");
    </script>
<?php endif; ?>
