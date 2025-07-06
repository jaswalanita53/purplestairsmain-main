<div>
    <section class="plan-sec cmn-gap ban-up">
        <div class="container">
          <div class="form-points form-points2">
            <?php
            $step = 3;
            $current_step = auth()->user()->current_step;
            ?>
            <?php echo $__env->make('inc.employersteps',compact('step', 'current_step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
          <div class="plan-outr">
            <div class="sec-hdr text-center">
              <span>Employer</span>
              <h1>Plans</h1>
            </div>
            <form>
            <div class="plan-inr">
              <div class="row justify-content-center">
                <div class="col-md-5">
                  <div class="plan-card">
                    <h3>Employer</h3>
                    <figure>
                      <img src="<?php echo e(asset('assets/fe/images/p1.svg')); ?>" alt="" />
                    </figure>

                    <ul class="plan-list">
                      <li>Communicate directly with candidates</li>
                      <li>Easy-to-use interfase</li>
                      <li>Search based on skills and experience</li>
                      <li>Create filters to fill multiple positions</li>
                      <li>Organize and manage candidates of interest</li>
                      <li>View resumes with references and accomplishments</li>
                    </ul>
                    <hr>
                    <div class="plan-btm">
                      <div class="plan-price price-info-first">
                        <p><span>$<?php echo e($plan1_amount); ?></span>/<?php echo e(ucfirst($plan1_period)); ?></p>
                      </div>
                      <div class="toggle-switch-block">
                        <span>Monthly</span>
                        <div class="switch_box box_1">
                          <input type="checkbox" wire:change="updatePlan($event.target.checked, $event.target.getAttribute('ref'))" class="switch_1" ref="price-info-first" checked="" />
                        </div>
                        <span>Annually</span>
                      </div>
                      
                      <button type="button" class="plan-btn" wire:click="choosePlan(1)">Select This Plan</button>

                      <div class="cancel">
                        <?php if($plan1_period=="month"): ?>
                        <a href="#" >
                            Cancel Anytime
                        </a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="plan-card">
                    <h3>Employer Plus</h3>
                    <figure>
                      <img src="<?php echo e(asset('assets/fe/images/p2.svg')); ?>" alt="" />
                    </figure>

                    <ul class="plan-list">
                      <li>Communicate directly with candidates</li>
                      <li>Easy-to-use interfase</li>
                      <li>Search based on skills and experience</li>
                      <li>Create filters to fill multiple positions</li>
                      <li>Organize and manage candidates of interest</li>
                      <li>View resumes with references and accomplishments</li>
                      <li class="bold-li bold-custom"><strong >Access new candidates 24 hours earlier than employer plan </strong></li>
                    </ul>
                    <hr>
                    <div class="plan-btm">
                      <div class="plan-price price-info-second">
                        <p><span>$<?php echo e($plan2_amount); ?></span>/<?php echo e(ucfirst($plan2_period)); ?></p>
                      </div>
                      <div class="toggle-switch-block">
                        <span>Monthly</span>
                        <div class="switch_box box_1">
                          <input type="checkbox" class="switch_1" ref="price-info-second" checked="" wire:change="updatePlan($event.target.checked, $event.target.getAttribute('ref'))"/>
                        </div>
                        <span>Annually</span>
                      </div>
                      
                      <button type="button" class="plan-btn" wire:click="choosePlan(2)">Select This Plan</button>

                      <div class="cancel">
                        <?php if($plan2_period=="month"): ?>
                          <a href="#" >Cancel Anytime</a>
                           <?php endif; ?>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <img src="<?php echo e(asset('assets/fe/images/p-pic.png')); ?>" alt=""  class="p-pic">
          </div>
        </div>
      </section>
</div>
<?php /**PATH /var/www/html/app/resources/views/livewire/company-step4.blade.php ENDPATH**/ ?>