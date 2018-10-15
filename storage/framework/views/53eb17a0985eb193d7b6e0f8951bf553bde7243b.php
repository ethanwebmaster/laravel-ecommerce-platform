<!-- Default box -->
<div class="box <?php echo e($box_class??''); ?>">
    <div class="box-header with-border <?php echo e(empty($box_title) && empty($box_actions)?'hidden':''); ?>">
        <h3 class="box-title <?php echo e(!empty($box_title) || !empty($box_actions)?'':'hidden'); ?>"><?php echo e(isset($box_title) ? $box_title : ''); ?></h3>

        <div class="box-tools pull-right">
            <?php echo e(isset($box_actions) ? $box_actions : ''); ?>

        </div>
    </div>
    <div class="box-body">
        <?php echo e($slot); ?>

    </div>
    <!-- /.box-body -->
    <div class="box-footer <?php echo e(!empty($box_footer)?'':'hidden'); ?>"><?php echo e(isset($box_footer) ? $box_footer : ''); ?></div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->