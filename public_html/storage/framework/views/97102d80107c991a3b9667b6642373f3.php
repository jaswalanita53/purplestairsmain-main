<?php $__env->startSection('content'); ?>

<div class="login-sec pt-4 log-h-sec ban-up ban-up3 ht_center_div">
    <div class="login-sec-wrap">
      <div class="container">
        <div
          class="log-wrap lg-wrp2"
          style="background-image: url(<?php echo e(asset('assets/fe/images/lg-back.png')); ?>)"
        >
          <div class="login-outr">
            <h2>Reset Password</h2>
            <p>
              Enter the email associated with your account and we’ll send an
              email with instructions to reset your password.
            </p>
            <?php if(session('status')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session('status')); ?>

            </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('password.email')); ?>">
              <?php echo csrf_field(); ?>
              <div class="form-input mt-4">
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
                  name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus
                />
                
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback d-flex" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="form-input">
                <input type="submit" value="<?php echo e(__('Send Password Reset Link')); ?>" class="sub-btn" />
              </div>
            </form>
          </div>
          <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1 log12">
          <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2">
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>