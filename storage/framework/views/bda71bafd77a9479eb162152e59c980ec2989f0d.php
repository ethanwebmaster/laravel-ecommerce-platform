<?php $__env->startSection('title',trans('corals-admin::labels.auth.login')); ?>

<?php $__env->startSection('css'); ?>
    <style type="text/css">
        .login-box, .register-box {
            width: 720px;
            margin: 6% auto;
        }

        .login-left {
            border-right: 4px solid #ddd;
        }

        @media (max-width: 470px) {
            .login-box, .register-box {
                width: 340px;
            }

            .login-left {
                border-right: none;
            }
        }

        .or-separator {
            text-align: center;
            margin: 10px 0;
            text-transform: uppercase;
        }

        .or-separator:after, .or-separator:before {
            content: ' -- ';
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h4 class="login-box-msg"><?php echo app('translator')->getFromJson('corals-admin::labels.auth.sign_in_start_session'); ?></h4>
    <?php \Actions::do_action('pre_login_form') ?>
    <div class="row">
        <div class="col-md-6 login-left">
            <form method="POST" action="<?php echo e(route('login')); ?>" id="login-form">
                <?php echo e(csrf_field()); ?>

                <div class="form-group has-feedback <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <input type="email" name="email" id="email"
                           class="form-control" placeholder="<?php echo app('translator')->getFromJson('User::attributes.user.email'); ?>"
                           value="<?php echo e(old('email')); ?>" autofocus/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    <?php if($errors->has('email')): ?>
                        <div class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group has-feedback <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <input type="password" name="password" class="form-control"
                           placeholder="<?php echo app('translator')->getFromJson('User::attributes.user.password'); ?>" id="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    <?php if($errors->has('password')): ?>
                        <div class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn bg-purple btn-block">
                            <span class="fa fa-sign-in"></span>
                            <?php echo app('translator')->getFromJson('corals-admin::labels.auth.login'); ?>
                        </button>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xs-12">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"
                                       name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> /> <?php echo app('translator')->getFromJson('corals-admin::labels.auth.remember_me'); ?>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 login-right">
            <a href="<?php echo e(route('register')); ?>"
               class="btn bg-olive btn-social btn-block">
                <span class="fa fa-user-o"></span>
                <?php echo app('translator')->getFromJson('corals-admin::labels.auth.register_new_account'); ?>
            </a>
            <a href="<?php echo e(route('password.request')); ?>"
               class="btn bg-yellow btn-social btn-block">
                <span class="fa fa-question"></span>
                <?php echo app('translator')->getFromJson('corals-admin::labels.auth.forget_password'); ?>
            </a>
            <div class="or-separator"><?php echo app('translator')->getFromJson('Corals::labels.or'); ?></div>
            <div class="socials-buttons">
                <?php if(config('services.facebook.client_id')): ?>
                    <a class="btn btn-block btn-social btn-facebook" href="<?php echo e(route('auth.social', 'facebook')); ?>">
                        <span class="fa fa-facebook"></span> <?php echo app('translator')->getFromJson('corals-admin::labels.auth.sign_in_facebook'); ?>
                    </a>
                <?php endif; ?>
                <?php if(config('services.twitter.client_id')): ?>
                    <a class="btn btn-block btn-social btn-twitter" href="<?php echo e(route('auth.social', 'twitter')); ?>">
                        <span class="fa fa-twitter"></span> <?php echo app('translator')->getFromJson('corals-admin::labels.auth.sign_in_twitter'); ?>
                    </a>
                <?php endif; ?>
                <?php if(config('services.google.client_id')): ?>
                    <a class="btn btn-block btn-social btn-google" href="<?php echo e(route('auth.social', 'google')); ?>">
                        <span class="fa fa-google"></span> <?php echo app('translator')->getFromJson('corals-admin::labels.auth.sign_in_google'); ?>
                    </a>
                <?php endif; ?>
                <?php if(config('services.github.client_id')): ?>
                    <a class="btn btn-block btn-social btn-github" href="<?php echo e(route('auth.social', 'github')); ?>">
                        <span class="fa fa-github"></span> <?php echo app('translator')->getFromJson('corals-admin::labels.auth.sign_in_github'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {
            if (!$(".socials-buttons").children().length > 0) {
                $(".or-separator").remove();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>