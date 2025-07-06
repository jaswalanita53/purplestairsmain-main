<div>
  <style type="text/css">
    .number_of_emp .form-group { width: 40% !important; }
    .appy-code-btn { font-size: 17px !important; }
    .form_input_check label input[type="checkbox"]:checked + span::before {
      background: none !important;
    }
  </style>
  @if(!$published)
    <section class="payment-sec cmn-gap back-clr ban-up">
        <div class="container">
          <div class="form-points form-points2">
            @php
            $step = 4;
            $current_step = auth()->user()->current_step;
            @endphp
            @include('inc.employersteps',compact('step', 'current_step'))
          </div>
          <div class="sec-hdr text-center">
            <h1>Payment</h1>
          </div>
          <div class="payment-outr">
            <div class="row">
              <div class="col-lg-12 col-md-12">
                @if (session('error_message') !== null)
                  <div class="alert alert-danger" role="alert">
                      {!! session('error_message') !!}
                  </div>
                @endif
              </div>
              {{-- 86a2uj4hw --}}
              @if (!empty(Auth::user()->card_decline_status))
                  <div class="alert alert-danger" role="alert">
                      Your credit card has been declined. Please provide an alternative credit card so your account can be approved.
                  </div>
                @endif

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
                                value="{{$name}}"
                                wire:model.lazy="name"
                              />
                              @include('inc.error', [
                                'field_name' => 'name'
                              ])
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
                                value="{{$email}}"
                                wire:model.lazy="email"
                                readonly
                                disabled
                              />
                              @include('inc.error', [
                                'field_name' => 'email'
                              ])
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
                                value="{{$address}}"
                                wire:model.lazy="address"
                              />
                              @include('inc.error', [
                                'field_name' => 'address'
                              ])
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
                                value="{{$city}}"
                              />
                              @include('inc.error', [
                                'field_name' => 'city'
                              ])
                            </div>
                          </div>

                        </div>

                        <div class="col-md-4">
                          <div class="gl-frm-outr">
                            <label>State</label>
                            <div class="form-group">
                              <select class="form-select" wire:model.lazy="state">
                                <option >State</option>
                                @foreach($all_states as $st)
                                <option value="{{ $st->code }}" @if($state==$st->code) selected @endif>{{ $st->name }}</option>
                                @endforeach
                              </select>
                              @include('inc.error', [
                                'field_name' => 'state'
                              ])
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
                                value="{{$zipcode}}"
                                wire:model.lazy="zipcode"
                              />
                              @include('inc.error', [
                                'field_name' => 'zipcode'
                              ])
                            </div>
                          </div>

                        </div>
                      </div>
                    {{-- </form> --}}
                  </div>
                 {{-- 86a2kvagf --}}
                   @php

                        $period = $plan_data['period'];
                        $amount = $plan_data['amount'];
                        // task - 86a0c14rr
                        $additional_charge = $amount;
                        if ($plan_data['plan'] == 1) {
                            if ($period == 'month') {
                                $additional_charge = 50;
                            } else {
                                $additional_charge = 479;
                            }
                        } else {
                            if ($period == 'month') {
                                $additional_charge = 100;
                            } else {
                                $additional_charge = 949;
                            }
                        }
                        @endphp
                        {{-- end 86a2kvagf --}}
                  <h4><span>Credit Card </span></h4>
                  <div class="pay-form">
                    {{-- <form> --}}

                    <div class="row">
                      <div class="credit-card col mb-1">
                          <div class="cre-lft">
                              <!-- <img src="{{asset('assets/fe/images/credit.svg')}}" alt=""> -->
                              <div class="cre-pan">
                                  {{-- <span>2414 </span> <span> - </span>   <span>7512  </span>        <span>-</span>    <span>3214 </span>     <span> - </span>  <span>  4575</span> --}}
                                  <input type="text"  autocomplete="off" class="form-control cc-width" wire:model.lazy="credit_card" id="credit_card" minlength="17" maxlength="19" placeholder="2414 7512 3214 4575" wire:blur="validate_cc()">
                              </div>
                          </div>
                          <div class="cre-rgt {{ $is_cc_valid ? '' : 'd-none' }}">
                              <img src="{{asset('assets/fe/images/tick2.svg')}}" alt="">
                          </div>
                      </div>
                      </div>
                      <div class="credit_card_error text-danger mb-1">
                          {{-- @include('inc.error', [
                            'field_name' => 'credit_card'
                          ]) --}}
                          @error('credit_card')
                          <div class="text-danger error" >
                          Invalid Card Number
                          </div>
                        @endif
                          @if($this->cc_error) {{ $this->cc_error }} @endif
                      </div>

                      <div class="row mb-5">
                      <h5 class="mb-3 mt-4">EXP</h5>
                        <div class="col-3">

                          <div class="form-group fg2- m-0">
                              <input type="text" class="form-control numbersInput" placeholder="MM" wire:model.lazy="exp_month" wire:blur="validate_cc()"  maxlength="2" >
                              {{-- @include('inc.error', [
                                'field_name' => 'exp_month'
                              ]) --}}
                              @error('exp_month')
                              <div class="text-danger error" >
                          Invalid Expiration Month
                          </div>
                        @endif

                             @if($this->cc_mon_error)
                             <div class="text-danger error" >
                               {{-- {{ $this->cc_mon_error }} --}}
                                Invalid Expiration Month
                                </div>
                                @endif
                          </div>
                        </div>
                        <div class="col-1 text-center mt-3">  <span class="">/</span></div>
                        <div class="col-3">
                        <div class="form-group fg2- m-0">
                              <input type="text" class="form-control numbersInput" placeholder="YY" wire:model.lazy="exp_year" wire:blur="validate_cc()" minlength="2" maxlength="2">
                              {{-- @include('inc.error', [
                                'field_name' => 'exp_year'
                              ]) --}}

                            @error('exp_year')
                            <div class="text-danger error" >
                          Invalid Expiration Year
                          </div>
                        @endif                                 @if($this->cc_yr_error)
                             <div class="text-danger error" >
                               {{-- {{ $this->cc_yr_error }}
                                --}}
                                Invalid Expiration Year
                                </div>
                                @endif

                          </div>
                        </div>
                        <div class="col-5">
                        <!-- <div class="form-group cvv" style="margin-left: 20px; width:170px"> -->
                        <div class="form-group cvv m-0" >
                              <input type="text" class="form-control numbersInput" placeholder="CVV Number" wire:model.lazy="cvv" minlength="3" maxlength="4">
                              {{-- @include('inc.error', [
                                'field_name' => 'cvv'
                              ]) --}}

                              @error('cvv')
                              <div class="text-danger error" >
                         Invalid CVV
                         </div>
                        @endif
                          </div>
                        </div>
                      </div>
                      <!-- <div class="cvv-part">

                          <span>/</span>


                      </div> -->
                    {{-- </form> --}}
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
                              @include('inc.error', [
                                'field_name' => 'discount_code'
                              ])
                              @if($discount_error)
                              <div class="text-danger">{{ $discount_error }}</div>
                              @endif
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
                      <img src="{{asset('assets/fe/images/pay1.svg')}}" alt="" />
                    </figure>
                    <div class="pay-text">
                        @php
                        if(!empty($plan_data)){
                            $plan_data=$plan_data;
                        }
                        else{
                            $plan_data=json_decode(Auth::user()->plan,true);

                        }
                        @endphp
                      <p><span>${{ $plan_data['amount'] }}</span>/{{ $plan_data['period'] }}</p>
                      <em>+${{$additional_charge}} per user</em>
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
                  {{-- <a href="#" class="add-btn"
                    >ADD <em><img src="{{asset('assets/fe/images/white-drop.svg')}}" alt="" /></em
                  ></a> --}}
            {{-- 86a2kcx9d --}}
                  <div class="pat-total">
                  <hr>
                    <ul>
                      <li>
                        <p>Employer Account</p>
                        {{-- 86a2kvagf --}}
                        <p>${{ $plan_data['amount']}}</p>
                      </li>
                      @if($applied_discount)
                      <li>
                        <p> <span class="discount_div"> <img src="{{asset('assets/fe/images/discount.svg')}}" /> {{ $applied_discount_code }} </span></p>
                        <p>- ${{ $discount }}</p>
                      </li>
                      @endif
                      <li>
                        <p>Additional Users</p>
                        <p>${{ ($additional_charge * ($number_of_user-1)) }}</p>
                      </li>
                      <li>
                        <h5>Total</h5>
                        <h5>
                          @if($applied_discount)
                          {{-- 86a2kvagf --}}
                          <span class="original_price">${{ $plan_data['amount']+ ($additional_charge * ($number_of_user-1)) }}</span><br/>
                          <strong>${{ ($plan_data['amount'] + ($additional_charge *( $number_of_user-1))) - $discount }}</strong>
                          @else
                          <strong>${{ $plan_data['amount']+ ($additional_charge *( $number_of_user-1)) }}</strong>
                          @endif
                        </h5>
                      </li>
                    </ul>
                    {{-- <h6>* You Save $200</h6> --}}
                  </div>
            {{-- end 86a2kcx9d --}}

                  <form wire:submit.prevent="processPayment()">
                      <button class="btn" wire:loading.remove wire:target="processPayment"><span class="dol"><img src="{{asset('assets/fe/images/dolar.svg')}}" alt="" /></span>Process Payment</button>
                      <input type="button" value="Processing..." class="btn" wire:loading wire:target="processPayment"/>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  @else
    <div class="login-sec sign-up back-clr pt-4 log-h-sec ban-up ht_center_div">
      <div class="login-sec-wrap">
        <div class="container">
          <div
            class="log-wrap lg-wrp2"
            style="background-image: url(/assets/fe/images/log-back2.png)"
          >
            <div class="login-outr congo">
              <figure>
                <img src="{{asset('assets/fe/images/party.svg')}}" alt="" />
              </figure>
              <h2 class="mb-4">Thank You</h2>

              <p style="color: var(--purple); font-size: 15px;">Your account on Purple Stairs will be activated shortly. Look out for an email to get started with your search. </p>

              <a href="{{ route('companystep3') }}" class="btn mb-3">View My Profile</a>
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
            <img src="{{asset('assets/fe/images/log1.png')}}" alt="" class="mobile-v log1 log12">
            <img src="{{asset('assets/fe/images/log2.png')}}" alt="" class="mobile-v log2 log21">
          </div>
        </div>
      </div>
    </div>
  @endif
</div>

<script>
    @if ($errors->any())
      $('html, body').animate({
        scrollTop: $("div.text-danger:first").parent('div').offset().top - 200
      }, 500);
    @endif

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
