<script type="text/javascript">
    $(document).ready(function () {
        // handle validation messages

        var msg = '';

        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            msg = msg + "- <?php echo e($error); ?> <br/>";
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        if (msg.length) {
            themeNotify({
                'level': 'error',
                'message': msg
            });
        }

        // handle status messages
        <?php if(session('status')): ?>
        themeNotify({
            'level': 'info',
            'message': "<?php echo e(session('status')); ?>"
        });
        <?php endif; ?>

        <?php if($message = session('notification')): ?>
        themeNotify({
            'level': "<?php echo e($message['level']); ?>",
            'message': "<?php echo $message['message']; ?>"
        });
        <?php endif; ?>

        // handle flash messages
        <?php $__currentLoopData = session('flash_notification', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        themeNotify({
            'level': "<?php echo e($message['level']); ?>",
            'message': "<?php echo $message['message']; ?>"
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php echo e(session()->forget('flash_notification')); ?>

        <?php echo e(session()->forget('notification')); ?>

    });
</script>