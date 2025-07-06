<?php $__env->startSection('content'); ?>
<div class="login-sec sign-up back-clr log-h-sec ban-up">
    <div class="login-sec-wrap">
      <div class="container">
        <div
          class="log-wrap lg-wrp2"
          style="background-image: url(/assets/fe/images/log-back2.png)"
        >
          <div class="login-outr congo">
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
          <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1 log12">
          <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2">
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/employerlogin.blade.php ENDPATH**/ ?>