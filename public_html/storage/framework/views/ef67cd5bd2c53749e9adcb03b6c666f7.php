<?php $__env->startSection('content'); ?>

<div>
    <div class="login-sec log-h-sec pt-4 ban-up ban-up3 ht_center_div">
        <div class="login-sec-wrap">
          <div class="container">
            <div>
                <?php if(session()->has('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
            </div>
            <div
              class="log-wrap lg-wrp2"
              style="background-image: url(/assets/fe/images/log-back.png)"
            >
              <div class="login-outr del-outr">
                <h2>Keep My Account Active</h2>
                <!-- <p>Sleep mode will make your profile invisible. You may wake up your account at any time.?</p> -->
                <p>These will notify you to keep your profile up to date.</p>
                <form method="POST">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                  <div class="form-input">
                    <input
                      type="submit"
                      value="Keep Me Active"
                      class="sub-btn"
                    />
                  </div>
                </form>
              </div>
              <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1 log12">
              <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2">
            </div>
          </div>
        </div>
      </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/keepactivebycron.blade.php ENDPATH**/ ?>