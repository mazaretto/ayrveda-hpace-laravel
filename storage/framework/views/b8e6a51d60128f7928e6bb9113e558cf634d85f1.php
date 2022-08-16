<?php $page = "register"; ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Content -->
    <div class="content account-page" style="padding: 50px 0;">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Register Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="/assets/img/login-banner.png" class="img-fluid" alt="<?php echo e(env('APP_NAME')); ?> Register">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <?php if(isset($doctor)): ?>
                                        <h3><?php echo e(__('auth.doctor-register')); ?> <a href="<?php echo e(route('register')); ?>"><?php echo e(__('auth.patient-question')); ?></a></h3>
                                    <?php else: ?>
                                        <h3><?php echo e(__('auth.patient-register')); ?> <a href="<?php echo e(route('register.doctor')); ?>"><?php echo e(__('auth.doctor-question')); ?></a></h3>
                                    <?php endif; ?>
                                </div>

                                <!-- Register Form -->
                                <form method="POST" action="<?php echo e(route('register')); ?>">
                                    <?php echo csrf_field(); ?>

                                    <?php if(isset($doctor)): ?>
                                        <input type="hidden" name="doctor" value="1">
                                    <?php endif; ?>
                                    <div class="form-group form-focus">
                                        <input id="name" type="text"
                                               class="form-control floating <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               name="name" value="<?php echo e(old('name')); ?>" required autocomplete autofocus>
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="focus-label"><?php echo e(__('auth.name')); ?></label>
                                    </div>

                                    <div class="form-group form-focus">
                                        <input id="email" type="email"
                                               class="form-control floating <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               name="email" value="<?php echo e(old('email')); ?>" required autocomplete>

                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="focus-label"><?php echo e(__('auth.email')); ?></label>
                                    </div>

                                    <div class="form-group form-focus">
                                        <input id="phone" type="tel"
                                               class="form-control floating <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               name="phone" value="<?php echo e(old('phone')); ?>" required autocomplete>

                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="focus-label"><?php echo e(__('auth.phone')); ?></label>
                                    </div>

                                    <div class="form-group form-focus">
                                        <input id="password" type="password"
                                               class="form-control floating <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               name="password" required>

                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="focus-label"><?php echo e(__('auth.password')); ?></label>
                                    </div>

                                    <div class="form-group form-focus">
                                        <input id="password-confirm" type="password"
                                               class="form-control floating <?php $__errorArgs = ['password-confirm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               name="password_confirmation" required>
                                        <label class="focus-label"><?php echo e(__('auth.password_confirm')); ?></label>
                                    </div>

                                    <div class="text-right">
                                        <a class="forgot-link" href="
                                        <?php if(isset($doctor)): ?>
                                            <?php echo e(route('login.doctor')); ?>

                                        <?php else: ?>
                                            <?php echo e(route('login')); ?>

                                        <?php endif; ?>"><?php echo e(__('auth.acc_exist')); ?></a>
                                    </div>

                                    <button class="btn btn-primary btn-block btn-lg login-btn" type="submit"><?php echo e(__('auth.Signup')); ?>

                                    </button>
                                    <div class="login-or">
                                        <span class="or-line"></span>
                                        <span class="span-or"><?php echo e(__('auth.or')); ?></span>
                                    </div>
                                    <div class="row form-row social-login">
                                        <div class="col-6">
                                            <a href="#" class="btn btn-facebook btn-block"><i
                                                    class="fab fa-facebook-f mr-1"></i> <?php echo e(__('auth.Login')); ?></a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-google btn-block"><i
                                                    class="fab fa-google mr-1"></i> <?php echo e(__('auth.Login')); ?></a>
                                        </div>
                                    </div>
                                </form>
                                <!-- /Register Form -->

                            </div>
                        </div>
                    </div>
                    <!-- /Register Content -->

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/auth/register.blade.php ENDPATH**/ ?>