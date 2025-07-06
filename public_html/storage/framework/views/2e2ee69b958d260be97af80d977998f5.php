<div>
    <?php if(!$published): ?>
    <section class="payment-sec cmn-gap back-clr ban-up">
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
              <li class="active">
                <div class="outr-points">
                  <div class="point-wrap"><span>4</span></div>
                  <h5>Choose Plan</h5>
                </div>
              </li>
              <li class="active center">
                <div class="outr-points">
                  <div class="point-wrap"><span>5</span></div>
                  <h5>Payment</h5>
                </div>
              </li>
            </ul>
          </div>
          <div class="sec-hdr text-center">
            <h1>Payment</h1>
          </div>
          <div class="payment-outr">
            <div class="row">
              <div class="col-lg-8">
                <div class="pay-lft">
                  <h4><span>Billing Info</span></h4>
                  <div class="pay-form gl-form">
                    <form>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="gl-frm-outr">
                            <label>Name*</label>
                            <div class="form-group">
                              <input
                                type="text"
                                placeholder=""
                                class="form-control"
                              />
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
                              />
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
                              />
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
                              />
                            </div>
                          </div>

                        </div>

                        <div class="col-md-4">
                          <div class="gl-frm-outr">
                            <label>State</label>
                            <div class="form-group">
                              <select class="form-select">
                                <option >State</option>
                                <option >New York</option>
                                <option >demo</option>
                                <option >demo</option>
                              </select>

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
                              />
                            </div>
                          </div>

                        </div>
                      </div>
                    </form>
                  </div>
                  <h4><span>Credit Card </span></h4>
                  <div class="pay-form">
                    <form>
                      <div class="credit-card">
                          <div class="cre-lft">
                              <img src="<?php echo e(asset('assets/fe/images/credit.svg')); ?>" alt="">
                              <div class="cre-pan">
                                  <span>2414 </span> <span> - </span>   <span>7512  </span>        <span>-</span>    <span>3214 </span>     <span> - </span>  <span>  4575</span>
                              </div>
                          </div>
                          <div class="cre-rgt">
                              <img src="<?php echo e(asset('assets/fe/images/tick2.svg')); ?>" alt="">
                          </div>
                      </div>
                      <div class="cvv-part">
                          <div class="form-group cvv">
                              <input type="text" class="form-control" placeholder="CVV Number">
                          </div>
                          <h5>EXP</h5>
                          <div class="form-group fg2">
                              <input type="text" class="form-control" placeholder="09">
                          </div>
                          <span>/</span>
                          <div class="form-group fg2">
                              <input type="text" class="form-control" placeholder="22">
                          </div>
                      </div>
                    </form>
                  </div>
                  <h4><span>Discount Code </span></h4>
                  <div class="pay-form gl-form">
                      <form>
                        <div class="row align-items-center">




                          <div class="col-md-5">
                            <div class="gl-frm-outr">
                              <label>Enter Coupon Code</label>
                              <div class="form-group">
                                <input
                                  type="text"
                                  placeholder=""
                                  class="form-control"
                                />
                              </div>
                            </div>

                          </div>
                          <div class="col-md-4">
                            <div class="form-input mb-0">
                              <input type="submit" value="Apply Code" class="sub-btn">
                            </div>
                          </div>
                        </div>
                      </form>
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
                      <p><span>$69</span>/mo</p>
                      <em>per user</em>
                    </div>
                  </div>
                  <h5>What are the benefits of buying additional users?</h5>
                  <p class="b-para">
                    Buying additional “users” will allow you to collaborate with others within your company. Your accounts will be linked and your saved searches and notes will be shared internally. .
                  </p>
                  <a href="#" class="add-btn"
                    >ADD <em><img src="<?php echo e(asset('assets/fe/images/white-drop.svg')); ?>" alt="" /></em
                  ></a>
                  <div class="pay-rgt-btm">
                    <h5>Order Summary</h5>
                    <div class="pay-rgt-btm-hdr">
                      <figure>
                        <img src="<?php echo e(asset('asset/fe/images/pay2.svg')); ?>" alt="" />
                      </figure>
                      <div class="pay-text2">
                        <p><strong> $1200</strong> pay annually</p>
                        <div class="form_input_check">
                          <label>
                            <input type="checkbox" />
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
                        <p>$1200</p>
                      </li>
                      <li>
                        <p>Tax</p>
                        <p>$0.00</p>
                      </li>
                      <li>
                        <h5>Total</h5>
                        <h5><strong>$1200</strong></h5>
                      </li>
                    </ul>
                    <h6>* You Save $200</h6>
                  </div>
                  <a href="#" class="btn" wire:click="processPayment()"
                    ><span class="dol"><img src="<?php echo e(asset('assets/fe/images/dolar.svg')); ?>" alt="" /></span
                    >Process Payment</a
                  >
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
                <form>
                  <div class="form-input">
                    <input
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
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/company-step5.blade.php ENDPATH**/ ?>