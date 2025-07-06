<?php $__env->startSection('content'); ?>
<?php
if(Session::has('user_type')){
    Session::forget('user_type');
}
?>

<div class="login-sec sign-up log-h-sec ban-up ban-up2">
    <div class="login-sec-wrap">
      <div class="container">
        <div
          class="log-wrap"
          style="background-image: url(assets/fe/images/log-back.png)"
        >
          <div class="login-outr">
           <?php if(session('error')): ?>
                    <span class="text-purple mb-4" style="color:#7e50a7;">

                        <strong><?php echo e(session('error')); ?></strong>
                    </span>
                    <?php endif; ?>
            <h2>Hello Candidate!</h2>

            <p class="blk-p">Create Account</p>

            <form  method="POST" action="<?php echo e(route('register')); ?>">
              <?php echo csrf_field(); ?>
              <input type="hidden" value="candidate" name="user_type">
              <div class="form-input">
                <input
                  type="text"
                  placeholder="Name"
                  class="form-control name"
                  name="name"
                  value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus
                />
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
              </div>
              <div class="form-input">
                <input
                  type="email"
                  placeholder="Email Address"
                  class="form-control email"
                  name="email"
                  value="<?php echo e(old('email')); ?>" required autocomplete="email"
                />
                <?php echo $__env->make('inc.error', [
                    'field_name' => 'email',
                  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
              <div class="form-input">
                  <div class="form_ipp_passwordd">
                      <input type="password" class=" password-field pass_chk form-control" placeholder="Password" name="password" required autocomplete="new-password">
                      <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                  </div>
                      <?php echo $__env->make('inc.error', [
                        'field_name' => 'password',
                      ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
              

              <div class="forgot">
                <label class="check-inn"
                  >Remember Me
                  <input type="checkbox" class="open" />
                  <span class="checkmark"></span>
                </label>
                <!-- <a href="#">Forgot Password?</a> -->
              </div>
              <div class="form-input">
                <input type="submit" value="Sign Up" class="sub-btn" />
              </div>
            </form>
            <div class="login-txt">
              <span>Or Sign Up With</span>
            </div>
            <div class="social-logo">
              <ul>
                <li>
                  <a href="<?php echo e(url('/login/google')); ?>"><img src="<?php echo e(asset("assets/fe/images/google.svg")); ?>" alt="" /></a>
                </li>
                <li>
                  <a href="<?php echo e(url('/login/azure')); ?>"><img src="<?php echo e(asset("assets/fe/images/microsoft.svg")); ?>" alt="" /></a>
                </li>
                <li>
                  <a href="<?php echo e(url('/login/linkedin')); ?>"><img src="<?php echo e(asset("assets/fe/images/linkdin.svg")); ?>" alt="" /></a>
                </li>
              </ul>
            </div>
            <div class="not-acnt">
              <p>Already have an account? <a href="<?php echo e(route('login')); ?>">Login</a></p>
            </div>
            <div class="employ desktop-v2">
              <div class="toggle-switch-block twb">
                <span>Are you an Employer?</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1 case_slide_change" data-target="employer/login" />
                </div>
                <span>Are you a Candidate?</span>
              </div>
            </div>
            <div class="employ tab-v">
              <div class="toggle-switch-block twb">
                <span>Employer?</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" checked="" />
                </div>
                <span>Candidate?</span>
              </div>
            </div>
          </div>
          <img src="<?php echo e(asset("assets/fe/images/log1.png")); ?>" alt="" class="mobile-v log1">
          <img src="<?php echo e(asset("assets/fe/images/log2.png")); ?>" alt="" class="mobile-v log2">
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/auth/register.blade.php ENDPATH**/ ?>