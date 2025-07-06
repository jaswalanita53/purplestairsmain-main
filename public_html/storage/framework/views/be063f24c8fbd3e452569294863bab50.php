<?php $__env->startSection('content'); ?>

<div class="login-sec log-h-sec ban-up ban-up2">
    <div class="login-sec-wrap">
      <div class="container">
        <div class="log-wrap" style="background-image: url(assets/fe/images/log-back.png)">
          <div class="login-outr">
            <?php $__errorArgs = ['msg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">
                <strong><?php echo e($message); ?></strong>
            </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <h2>Hello Candidate!</h2>
            <form method="POST" action="<?php echo e(route('login')); ?>">
              <?php echo csrf_field(); ?>
              <div class="form-input">
                <input type="email" placeholder="Email Address" class="form-control email <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" required value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus/>
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
                <!-- <input type="password" placeholder="Password" class="form-control pass" /> -->
                <div class="form_ipp_passwordd">
                    <input type="password" class="pass_chk form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Password"  name="password" required autocomplete="current-password">
                    <a href="javascript:void(0)" class="pass_chk_toggler"></a>
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
              </div>
              <div class="forgot">
                <label class="check-inn">Remember Me
                  <input type="checkbox" class="open"  name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>/>
                  <span class="checkmark"></span>
                </label>
                <a href="<?php echo e(route('password.request')); ?>">Forgot Password?</a>
              </div>
              <div class="form-input">
                <input type="submit" value="Login" class="sub-btn" />
              </div>
            </form>
            <div class="login-txt">
              <span>Or Login With</span>
            </div>
            <div class="social-logo">
              <ul>
                <li>
                  <a href="<?php echo e(url('/login/google')); ?>"><img src="<?php echo e(asset('assets/fe/images/google.svg')); ?>" alt="" /></a>
                </li>
                <li>
                  <a href="<?php echo e(url('/login/azure')); ?>"><img src="<?php echo e(asset('assets/fe/images/microsoft.svg')); ?>" alt="" /></a>
                </li>
                <li>
                  <a href="<?php echo e(url('/login/linkedin')); ?>"><img src="<?php echo e(asset('assets/fe/images/linkdin.svg')); ?>" alt="" /></a>
                </li>
              </ul>
            </div>
            <div class="not-acnt">
              <p>Don’t have an account? <a href="<?php echo e(route('signupselect')); ?>">Sign up!</a></p>
            </div>
            <div class="employ desktop-v2">
              <div class="toggle-switch-block twb">
                <span>Are you a Candidate?</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1 case_slide_change" data-target="employer/login" />
                </div>
                <span>Are you an Employer?</span>
              </div>
            </div>
            <div class="employ tab-v">
              <div class="toggle-switch-block twb">
                <span>Candidate?</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" checked="" />
                </div>
                <span>Employer?</span>
              </div>
            </div>
          </div>
          <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1">
          <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2">
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/auth/login.blade.php ENDPATH**/ ?>