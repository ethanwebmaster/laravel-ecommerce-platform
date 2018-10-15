<ul class="<?php echo e($ul_class??''); ?>">
    <?php $__currentLoopData = \Language::allowed(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="<?php echo e($li_class??''); ?>">
            <a href="<?php echo e(\Language::getLocaleUrl($code)); ?>">
                <?php echo \Language::flag($code); ?> <?php echo $name; ?>

            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>