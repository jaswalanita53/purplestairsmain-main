<?php $__env->startSection('content'); ?>
<?php
$user_type = Session::get('usertype');
if(Session::has('usertype')){
    Session::forget('usertype');
}

if(Session::has('user_type')){
    Session::forget('user_type');
}
?>
<div class="login-sec log-h-sec ban-up ban-up2">
    <div class="login-sec-wrap">
        <div class="container">
            <div class="log-wrap" style="background-image: url(assets/fe/images/log-back.png)">
                <div class="login-outr">

                <div class="employerLogin" id="employerLogin">
                    <?php if(session('message')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('message')); ?>

                    </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                    <span class="text-purple" style="color:#7e50a7;">
                        <strong><?php echo e(session('error')); ?></strong>
                    </span>
                    <?php endif; ?>

                    <?php $__errorArgs = ['success'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-purple" style="color:#7e50a7;">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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

                    <h2 class="mb-4">Hello Employer!</h2>
                    <div class="social-login">
                    <ul>
                        <li>
                        <a href="<?php echo e(url('/login/google')); ?>"
                            ><em><img src="<?php echo e(asset('assets/fe/images/google.svg')); ?>" alt="" /></em
                            ><span>Log In With Google</span>
                        </a>
                        </li>
                        <li>
                        <a href="<?php echo e(url('/login/azure')); ?>"
                            ><em><img src="<?php echo e(asset('assets/fe/images/microsoft.svg')); ?>" alt="" /></em>
                            <span>Log In With Microsoft</span>
                        </a>
                        </li>
                        <li>
                        <a href="<?php echo e(url('/login/linkedin')); ?>"
                            ><em><img src="<?php echo e(asset('assets/fe/images/linkdin.svg')); ?>" alt="" /></em>
                            <span>Log In With Linkedin</span>
                        </a>
                        </li>
                    </ul>
                    </div>

                    <div class="not-acnt">
                    <p>Don’t have an account? <a href="<?php echo e(route('signupselect')); ?>">Sign up!</a></p>
                    </div>
                </div>
          <div class="candidateLogin" id="candidateLogin">
                    <?php if(session('message')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('message')); ?>

                    </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                    <span class="text-purple" style="color:#7e50a7;">

                        <strong><?php echo e(session('error')); ?></strong>
                    </span>
                    <?php endif; ?>

                    <?php $__errorArgs = ['success'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-purple" style="color:#7e50a7;">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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
unset($__errorArgs, $__bag); ?>" name="email" required value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus />
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
                                <input type="password" class="password-field pass_chk form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Password" name="password" required autocomplete="current-password">
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
                                <input type="checkbox" class="open" name="remember" checked <?php echo e(old('remember') ? 'checked' : ''); ?> />
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

                     </div>
                      <div class="employ desktop-v2">
                        <div class="toggle-switch-block twb">
                            <span>Are you an Employer?</span>
                            <div class="switch_box box_1">
                                <input type="checkbox" class="switch_1 case_slide_change" data-target="employer/login" <?php echo e($user_type=="employer" ? "checked" : ""); ?>/>
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
                <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1">
                <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2">

            </div>
        </div>
    </div>
</div>




<script>

// $(document).ready(function () {
    // Initially hide the employerLogin div
    $('#employerLogin').hide();

    // Listen for changes in the checkbox state
    $('.case_slide_change').change(function () {
        var isChecked = $(this).is(':checked');
        if (isChecked) {
            $('#employerLogin').show();
            $('#candidateLogin').hide();
        } else {
            $('#employerLogin').hide();
            $('#candidateLogin').show();
        }
    }).trigger('change');
// });










</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/auth/login.blade.php ENDPATH**/ ?>