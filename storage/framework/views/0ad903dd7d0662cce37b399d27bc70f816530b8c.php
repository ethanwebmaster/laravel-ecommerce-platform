<!-- Modal -->
<div id="<?php echo e($id); ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header <?php echo e(isset($hideHeader)?'hidden':''); ?>">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo isset($header) ? $header : ' '; ?></h4>
            </div>

            <div class="modal-body" id="modal-body-<?php echo e($id); ?>">
                <?php echo $slot??''; ?>

            </div>

            <div class="modal-footer <?php echo e(!empty($footer)?'':'hidden'); ?>">
                <?php echo isset($footer) ? $footer : ''; ?>

            </div>
        </div>
    </div>
</div>