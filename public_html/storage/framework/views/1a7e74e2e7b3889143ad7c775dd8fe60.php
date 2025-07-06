<?php $__env->startSection('content'); ?>
<section class="plan-sec cmn-gap ban-up">
    <div class="container">
      <div class="form-points form-points2">
        <ul class="justify-content-center">
          <li class="active">
            <div class="outr-points">
              <div class="point-wrap"><span>1</span></div>
              <h5>Create Account</h5>
            </div>
          </li>
          <li class="active">
            <div class="outr-points">
              <div class="point-wrap"><span>2</span></div>
              <h5>Add Profile</h5>
            </div>
          </li>
          <li class="active">
            <div class="outr-points">
              <div class="point-wrap"><span>3</span></div>
              <h5>Preview Profile</h5>
            </div>
          </li>
          <li class="active center">
            <div class="outr-points">
              <div class="point-wrap"><span>4</span></div>
              <h5>Choose Plan</h5>
            </div>
          </li>
          <li>
            <div class="outr-points">
              <div class="point-wrap"><span>5</span></div>
              <h5>Payment</h5>
            </div>
          </li>
        </ul>
      </div>
      <div class="plan-outr">
        <div class="sec-hdr text-center">
          <span>Employer</span>
          <h1>Plans</h1>
        </div>
        <div class="plan-inr">
          <div class="row justify-content-center">
            <div class="col-md-5">
              <div class="plan-card">
                <h3>Employer</h3>
                <figure>
                  <img src="<?php echo e(asset("assets/fe/images/p1.svg")); ?>" alt="" />
                </figure>

                <ul class="plan-list">
                  <li>Communicate Directly with Candidates</li>
                  <li>Easy To Use Interface</li>
                  <li>Search based on skills and experience</li>
                  <li>Create filters to fill multiple positions</li>
                  <li>Organize and manage candidates</li>
                  <li>Access resumes with references and accomplishments</li>
                </ul>
                <div class="plan-btm">
                  <div class="plan-price">
                    <p><span>$190</span>/Month</p>
                  </div>
                  <div class="toggle-switch-block">
                    <span>Monthly</span>
                    <div class="switch_box box_1">
                      <input type="checkbox" class="switch_1" checked="" />
                    </div>
                    <span>Annually</span>
                  </div>
                  <a href="#" class="plan-btn">Select This Plan</a>
                  <div class="cancel">
                      <a href="#" >Cancel Anytime</a>
                  </div>

                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="plan-card">
                <h3>Employer Plus</h3>
                <figure>
                  <img src="<?php echo e(asset("assets/fe/images/p2.svg")); ?>" alt="" />
                </figure>

                <ul class="plan-list">
                  <li>Communicate Directly with Candidates</li>
                  <li>Easy To Use Interface</li>
                  <li>Search based on skills and experience</li>
                  <li>Create filters to fill multiple positions</li>
                  <li>Organize and manage candidates</li>
                  <li>Access resumes with references and accomplishments</li>
                  <li class="bold-li"><strong>Access to candidates 24 hours before</strong></li>
                </ul>
                <hr>
                <div class="plan-btm">
                  <div class="plan-price">
                    <p><span>$1200
                  </span>/Year</p>
                  </div>
                  <div class="toggle-switch-block">
                    <span>Monthly</span>
                    <div class="switch_box box_1">
                      <input type="checkbox" class="switch_1" checked="" />
                    </div>
                    <span>Annually</span>
                  </div>
                  <a href="#" class="plan-btn">Select This Plan</a>

                </div>
              </div>
            </div>
          </div>
        </div>
        <img src="<?php echo e(asset("assets/fe/images/p-pic.png")); ?>" alt=""  class="p-pic">
      </div>
    </div>
  </section>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/pricing.blade.php ENDPATH**/ ?>