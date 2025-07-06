<ul class="justify-content-center">
    <li class="<?php echo e($step == 1 ? 'active center' : ''); ?>">
    <a href="<?php echo e(url('/company/contact-info')); ?>">
      <div class="outr-points">
        <div class="point-wrap"><span style="background: <?php echo e($current_step < $step && $step > 1 ? 'rgba(229, 220, 237)' : ''); ?>;">1</span></div>
        <h5>Create Account</h5>
      </div>
    </a>
    </li>
    <li class="<?php echo e($step == 2 ? 'active center' : ''); ?>">
    <a href="<?php echo e(url('/company/company-info')); ?>">
      <div class="outr-points">
        <div class="point-wrap"><span style="background: <?php echo e($current_step < $step && $step > 2 ? 'rgba(229, 220, 237)' : ''); ?>;">2</span></div>
        <h5>Add Profile</h5>
      </div>
    </a>
    </li>
    <li class="<?php echo e($step == 3 ? 'active center' : ''); ?>">
      <a href="<?php echo e(url('/company/choose-plan')); ?>">
      <div class="outr-points">
        <div class="point-wrap"><span style="background: <?php echo e($current_step < $step && $step > 3 ? 'rgba(229, 220, 237)' : ''); ?>;">3</span></div>
        <h5>Choose Plan</h5>
      </div>
      </a>
    </li>
    <li class="<?php echo e($step == 4 ? 'active center' : ''); ?>">
      <div class="outr-points">
        <div class="point-wrap" ><span style="background: <?php echo e($current_step < $step && $step > 4 ? 'rgba(229, 220, 237)' : ''); ?>;">4</span></div>
        <h5>Payment</h5>
      </div>
    </li>
    
  </ul>
<?php /**PATH /var/www/html/app/resources/views/inc/employersteps.blade.php ENDPATH**/ ?>