<?php $__env->startSection('content'); ?>
<div class="login-sec pt-4 log-h-sec ban-up ban-up3 ht_center_div">
    <div class="login-sec-wrap">
      <div class="container">
        <div
          class="log-wrap"
          style="background-image: url(images/log-back.png)"
        >
          <div class="login-outr">
            <h2><?php echo e(__('Reset Password')); ?></h2>
            <p>
              Your new password must be different from previously used
              passwords.
            </p>
            <form class="mt-4" method="POST" action="<?php echo e(route('password.update')); ?>">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="token" value="<?php echo e($token); ?>">
              <div class="form-input">
                <input
                  type="email"
                  placeholder="Email Address"
                  class="form-control email"
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  name="email" value="<?php echo e($email ?? old('email')); ?>" required autocomplete="email" autofocus
                />
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
              </div>
              <div class="form-input">
                <input
                  type="password"
                  placeholder="Password"
                  class="password-field form-control pass <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                  name="password" required autocomplete="new-password"
                />
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
              </div>
              <p class="text-start noti-txt">Must be at lease 8 characters</p>
              <div class="form-input">
                <input
                  type="password"
                  placeholder="Confirm Password"
                  class="password-field form-control"
                  name="password_confirmation" required autocomplete="new-password"
                />
              </div>
              <p class="text-start noti-txt">Both password must match.</p>

              <div class="form-input">
                <input type="submit" value="Reset Password" class="sub-btn" />
              </div>
            </form>
          </div>
          <img src="images/log1.png" alt="" class="mobile-v log1">
          <img src="images/log2.png" alt="" class="mobile-v log2">
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/auth/passwords/reset.blade.php ENDPATH**/ ?>