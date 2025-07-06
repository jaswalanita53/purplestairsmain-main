<div>
  <style type="text/css">
    .number_of_emp .form-group { width: 40% !important; }
    .appy-code-btn { font-size: 17px !important; }
    .form_input_check label input[type="checkbox"]:checked + span::before {
      background: none !important;
    }
  </style>
  <?php if(!$published): ?>
    <section class="payment-sec cmn-gap back-clr ban-up">
        <div class="container">
          <div class="form-points form-points2">
            <?php
            $step = 4;
            $current_step = auth()->user()->current_step;
            ?>
            <?php echo $__env->make('inc.employersteps',compact('step', 'current_step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
          <div class="sec-hdr text-center">
            <h1>Payment</h1>
          </div>
          <div class="payment-outr">
            <div class="row">
              <div class="col-lg-12 col-md-12">
                <?php if(session('error_message') !== null): ?>
                  <div class="alert alert-danger" role="alert">
                      <?php echo session('error_message'); ?>

                  </div>
                <?php endif; ?>
              </div>

              <div class="col-lg-8">
                <div class="pay-lft">
                  <h4><span>Billing Info</span></h4>
                  <div class="pay-form gl-form">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="gl-frm-outr">
                            <label>Name*</label>
                            <div class="form-group">
                              <input
                                type="text"
                                placeholder=""
                                class="form-control"
                                value="<?php echo e($name); ?>"
                                wire:model.lazy="name"
                              />
                              <?php echo $__env->make('inc.error', [
                                'field_name' => 'name'
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                          </div>

                        </div>
                        <div class="col-md-6">
                          <div class="gl-frm-outr">
                            <label>Email*</label>
                            <div class="form-group">
                              <input
                                type="email"
                                placeholder=""
                                class="form-control"
                                value="<?php echo e($email); ?>"
                                wire:model.lazy="email"
                                readonly
                                disabled
                              />
                              <?php echo $__env->make('inc.error', [
                                'field_name' => 'email'
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                          </div>

                        </div>
                        <div class="col-md-12">
                          <div class="gl-frm-outr">
                            <label>Billing Address*</label>
                            <div class="form-group">
                              <input
                                type="text"
                                placeholder=""
                                class="form-control"
                                value="<?php echo e($address); ?>"
                                wire:model.lazy="address"
                              />
                              <?php echo $__env->make('inc.error', [
                                'field_name' => 'address'
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                          </div>

                        </div>
                        <div class="col-md-4">
                          <div class="gl-frm-outr">
                            <label>City*</label>
                            <div class="form-group">
                              <input
                                type="text"
                                placeholder=""
                                class="form-control"
                                wire:model.lazy="city"
                                value="<?php echo e($city); ?>"
                              />
                              <?php echo $__env->make('inc.error', [
                                'field_name' => 'city'
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                          </div>

                        </div>

                        <div class="col-md-4">
                          <div class="gl-frm-outr">
                            <label>State</label>
                            <div class="form-group">
                              <select class="form-select" wire:model.lazy="state">
                                <option >State</option>
                                <?php $__currentLoopData = $all_states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($st->code); ?>" <?php if($state==$st->code): ?> selected <?php endif; ?>><?php echo e($st->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              <?php echo $__env->make('inc.error', [
                                'field_name' => 'state'
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                          </div>

                        </div>
                        <div class="col-md-4">
                          <div class="gl-frm-outr">
                            <label>Zipcode*</label>
                            <div class="form-group">
                              <input
                                type="text"
                                placeholder=""
                                class="form-control"
                                value="<?php echo e($zipcode); ?>"
                                wire:model.lazy="zipcode"
                              />
                              <?php echo $__env->make('inc.error', [
                                'field_name' => 'zipcode'
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                          </div>

                        </div>
                      </div>
                    
                  </div>
                  <h4><span>Credit Card </span></h4>
                  <div class="pay-form">
                    

                    <div class="row">
                      <div class="credit-card col mb-1">
                          <div class="cre-lft">
                              <!-- <img src="<?php echo e(asset('assets/fe/images/credit.svg')); ?>" alt=""> -->
                              <div class="cre-pan">
                                  
                                  <input type="text"  autocomplete="off" class="form-control cc-width" wire:model.lazy="credit_card" id="credit_card" minlength="17" maxlength="19" placeholder="2414 7512 3214 4575" wire:blur="validate_cc()">
                              </div>
                          </div>
                          <div class="cre-rgt <?php echo e($is_cc_valid ? '' : 'd-none'); ?>">
                              <img src="<?php echo e(asset('assets/fe/images/tick2.svg')); ?>" alt="">
                          </div>
                      </div>
                      </div>
                      <div class="credit_card_error text-danger mb-1">
                          
                          <?php $__errorArgs = ['credit_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <div class="text-danger error" >
                          Invalid Card Number
                          </div>
                        <?php endif; ?>
                          <?php if($this->cc_error): ?> <?php echo e($this->cc_error); ?> <?php endif; ?>
                      </div>

                      <div class="row mb-5">
                      <h5 class="mb-3 mt-4">EXP</h5>
                        <div class="col-3">

                          <div class="form-group fg2- m-0">
                              <input type="text" class="form-control numbersInput" placeholder="MM" wire:model.lazy="exp_month" wire:blur="validate_cc()"  maxlength="2" >
                              
                              <?php $__errorArgs = ['exp_month'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <div class="text-danger error" >
                          Invalid Expiration Month
                          </div>
                        <?php endif; ?>

                             <?php if($this->cc_mon_error): ?>
                             <div class="text-danger error" >
                               
                                Invalid Expiration Month
                                </div>
                                <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-1 text-center mt-3">  <span class="">/</span></div>
                        <div class="col-3">
                        <div class="form-group fg2- m-0">
                              <input type="text" class="form-control numbersInput" placeholder="YY" wire:model.lazy="exp_year" wire:blur="validate_cc()" minlength="2" maxlength="2">
                              

                            <?php $__errorArgs = ['exp_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger error" >
                          Invalid Expiration Year
                          </div>
                        <?php endif; ?>                                 <?php if($this->cc_yr_error): ?>
                             <div class="text-danger error" >
                               
                                Invalid Expiration Year
                                </div>
                                <?php endif; ?>

                          </div>
                        </div>
                        <div class="col-5">
                        <!-- <div class="form-group cvv" style="margin-left: 20px; width:170px"> -->
                        <div class="form-group cvv m-0" >
                              <input type="text" class="form-control numbersInput" placeholder="CVV Number" wire:model.lazy="cvv" minlength="3" maxlength="4">
                              

                              <?php $__errorArgs = ['cvv'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <div class="text-danger error" >
                         Invalid CVV
                         </div>
                        <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="cvv-part">

                          <span>/</span>


                      </div> -->
                    
                  </div>
                  <h4><span>Discount Code </span></h4>
                  <div class="pay-form gl-form">
                        <div class="row align-items-center">
                          <div class="col-md-5">
                            <div class="gl-frm-outr">
                              <label>Enter Coupon Code</label>
                              <div class="form-group">
                                <input
                                  type="text"
                                  placeholder=""
                                  class="form-control"
                                  wire:model.lazy="discount_code"
                                />
                              </div>
                              <?php echo $__env->make('inc.error', [
                                'field_name' => 'discount_code'
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                              <?php if($discount_error): ?>
                              <div class="text-danger"><?php echo e($discount_error); ?></div>
                              <?php endif; ?>
                            </div>

                          </div>
                          <div class="col-md-4">
                            <div class="form-input mb-0">
                              <form wire:submit.prevent="applyDiscount()">
                                  <button class="sub-btn- appy-code-btn" wire:loading.remove wire:target="applyDiscount">Apply Code</button>
                                  <input type="button" value="Applying..." class="sub-btn- appy-code-btn" wire:loading wire:target="applyDiscount"/>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="pay-rgt">
                  <h5>Add Users</h5>
                  <div class="pay-rgt-hdr">
                    <figure>
                      <img src="<?php echo e(asset('assets/fe/images/pay1.svg')); ?>" alt="" />
                    </figure>
                    <div class="pay-text">
                        <?php
                        if(!empty($plan_data)){
                            $plan_data=$plan_data;
                        }
                        else{
                            $plan_data=json_decode(Auth::user()->plan,true);

                        }
                        ?>
                      <p><span>$<?php echo e($plan_data['amount']); ?></span>/<?php echo e($plan_data['period']); ?></p>
                      <em>per user</em>
                    </div>
                  </div>
                  <h5>What are the benefits of buying additional users?</h5>
                  <p class="b-para text-justify">
                    Buying additional “users” will allow you to collaborate with others within your company. Your accounts will be linked and your saved searches and notes will be shared internally. <span class="add-user-primary">Add users anytime.</span>
                  </p>
                  <div class="gl-frm-outr number_of_emp">
                    <label for="">Add Users</label>
                      <div class="form-group">
                        <input type="number" placeholder="ADD" class="form-control number_of_user" min="1" wire:model.lazy="number_of_user" wire:change="updateDiscount()">
                      </div>
                    </div>
                  
                  <div class="pay-rgt-btm">
                    <h5>Order Summary</h5>
                    <div class="pay-rgt-btm-hdr">
                      <figure>
                        <img src="<?php echo e(asset('asset/fe/images/pay2.svg')); ?>" alt="" />
                      </figure>
                      <div class="pay-text2">
                        <p><strong> $<?php echo e($plan_data['amount'] * $number_of_user); ?></strong> pay <?php echo e($plan_data['period']); ?>ly</p>
                        <div class="form_input_check">
                          <label>
                            <input type="checkbox" value="1" wire:model.lazy="auto_renew" checked />
                            <span>Auto renew</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pat-total">
                    <ul>
                      <li>
                        <p>Sub Total</p>
                        <p>$<?php echo e($plan_data['amount'] * $number_of_user); ?></p>
                      </li>
                      <?php if($applied_discount): ?>
                      <li>
                        <p> <span class="discount_div"> <img src="<?php echo e(asset('assets/fe/images/discount.svg')); ?>" /> <?php echo e($applied_discount_code); ?> </span></p>
                        <p>- $<?php echo e($discount); ?></p>
                      </li>
                      <?php endif; ?>
                      <li>
                        <p>Tax</p>
                        <p>$0.00</p>
                      </li>
                      <li>
                        <h5>Total</h5>
                        <h5>
                          <?php if($applied_discount): ?>
                          <span class="original_price">$<?php echo e($plan_data['amount'] * $number_of_user); ?></span><br/>
                          <strong>$<?php echo e(($plan_data['amount'] * $number_of_user) - $discount); ?></strong>
                          <?php else: ?>
                          <strong>$<?php echo e($plan_data['amount'] * $number_of_user); ?></strong>
                          <?php endif; ?>
                        </h5>
                      </li>
                    </ul>
                    
                  </div>
                  <form wire:submit.prevent="processPayment()">
                      <button class="btn" wire:loading.remove wire:target="processPayment"><span class="dol"><img src="<?php echo e(asset('assets/fe/images/dolar.svg')); ?>" alt="" /></span>Process Payment</button>
                      <input type="button" value="Processing..." class="btn" wire:loading wire:target="processPayment"/>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  <?php else: ?>
    <div class="login-sec sign-up back-clr pt-4 log-h-sec ban-up ht_center_div">
      <div class="login-sec-wrap">
        <div class="container">
          <div
            class="log-wrap lg-wrp2"
            style="background-image: url(/assets/fe/images/log-back2.png)"
          >
            <div class="login-outr congo">
              <figure>
                <img src="<?php echo e(asset('assets/fe/images/party.svg')); ?>" alt="" />
              </figure>
              <h2 class="mb-4">Thank You</h2>

              <p style="color: var(--purple); font-size: 15px;">Your account on Purple Stairs will be activated shortly. Look out for an email to get started with your search. </p>

              <a href="<?php echo e(route('companystep3')); ?>" class="btn mb-3">View My Profile</a>
              <form wire:submit.prevent="approveCompany()">
                <div class="form-input">
                  <input
                    wire:target="approveCompany"
                    type="submit"
                    value="Start Browsing Candidates"
                    class="sub-btn sub2"
                  />
                </div>
              </form>
            </div>
            <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1 log12">
            <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2 log21">
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>

<script>
    <?php if($errors->any()): ?>
      $('html, body').animate({
        scrollTop: $("div.text-danger:first").parent('div').offset().top - 200
      }, 500);
    <?php endif; ?>

    document.addEventListener("livewire:load", () => {
        $('#credit_card,.numbersInput').keyup(function() {
              var v = $(this).val().replace(/\D/g, ''); // Remove non-numerics
              v = v.replace(/(\d{4})(?=\d)/g, '$1-'); // Add dashes every 4th digit
              $(this).val(v)
        });

    })
    document.addEventListener("livewire:load", () => {
        $('#credit_card,.numbersInput').keypress(function() {
            if (event.which < 48 || event.which > 57) {
            event.preventDefault(); // Prevent the keypress event
        }
        });

    })



//     $("body").delegate("input", "keypress", function(e) {
// $(this).parents('.form-group').find('.text-danger').remove();
//     })


</script>
<?php /**PATH /var/www/html/app/resources/views/livewire/company-step5.blade.php ENDPATH**/ ?>