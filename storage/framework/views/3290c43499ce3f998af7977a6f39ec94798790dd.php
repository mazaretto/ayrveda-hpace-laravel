<?php $page = "login"; ?>

<?php $__env->startSection('content'); ?>
  <!-- Page Content -->
  <div class="content account-page" style="padding: 50px 0;">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-8 offset-md-2">

          <!-- Login Tab Content -->
          <div class="account-content">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-7 col-lg-6 login-left">
                <img src="/assets/img/login-banner.png" class="img-fluid"
                     alt="<?php echo e(env('APP_NAME')); ?> Login">
              </div>
              <div class="col-md-12 col-lg-6 login-right">
                <div class="login-header">
                  <h3><?php echo e(__('auth.Login')); ?> <span><?php echo e(env('APP_NAME')); ?></span> <?php if($doctor ?? ''): ?> <?php echo e(__('auth.for-doctor')); ?> <?php endif; ?></h3>
                </div>
                <?php if(session()->has('message')): ?>
                  <p class="text-danger"><?php echo e(session()->get('message')); ?></p>
                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('login')); ?>">
                  <?php echo csrf_field(); ?>
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
                           name="email"
                           value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
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
                    <input id="password" type="password"
                           class="form-control floating <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           name="password" required autocomplete="current-password">

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

                  <div class="form-group">
                    <input type="checkbox" id="show_pass">
                    <label for="show_pass"><?php echo e(__('regular.show_password')); ?></label>
                  </div>

                  <div class="status-toggle">
                    <input type="checkbox" class="check" name="remember"
                           id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label for="remember" class="checktoggle"><?php echo e(__('auth.remember')); ?></label>
                  </div>

                  <?php if(Route::has('password.request')): ?>
                    <div class="text-right">
                      <a class="forgot-link" href="<?php echo e(route('password.request')); ?>">
                        <?php echo e(__('auth.forgot')); ?></a>
                    </div>
                  <?php endif; ?>

                  <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">
                    <?php echo e(__('auth.Login')); ?>

                  </button>

                  
                  <div class="text-center dont-have"><?php echo e(__('auth.no_acc')); ?>

                    <a href="
                                        <?php if(isset($doctor)): ?>
                    <?php echo e(route('register.doctor')); ?>

                    <?php else: ?>
                    <?php echo e(route('register')); ?>

                    <?php endif; ?>"><?php echo e(__('auth.Signup')); ?></a>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /Login Tab Content -->

        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/auth/login.blade.php ENDPATH**/ ?>