<?php $__env->startSection('content'); ?>
    <div class="login-sec pt-4 log-h-sec ban-up ban-up3 ht_center_div">
        <div class="login-sec-wrap">
            <div class="container">
                <div class="log-wrap lg-wrp2" style="background-image: url(<?php echo e(asset('assets/fe/images/log-back.png')); ?>">
                    <div class="login-outr">
                        <figure class="reset-fig">
                            <img src="<?php echo e(asset('assets/fe/images/email-pic.svg')); ?>" alt="" />
                        </figure>
                        <h2><?php echo e(__('Verify Your Email Address')); ?></h2>
                        <p>
                            <?php if(session('resent')): ?>
                                <div class="alert" role="alert" style="color:#7e50a7;">
                                    A new verification link has been sent to your email address
                                </div>
                            <?php endif; ?>
                        </p>

                        <div class="form-input">
                            <?php echo e(__('Please check your email for a verification link.')); ?>

                            <!-- <?php echo e(__('If you did not receive the email')); ?>, -->
                            <form class="d-inline" method="POST" action="<?php echo e(route('verification.resend')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="submit" value="<?php echo e(__('Click Here To Resend')); ?>" class="sub-btn"  style="margin-top: 10px;"/>
                            </form>
                        </div>
                    </div>
                    <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1 log12">
                    <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/auth/verify.blade.php ENDPATH**/ ?>