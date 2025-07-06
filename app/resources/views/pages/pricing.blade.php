@extends('layouts.app')
@section('content')
<style>
.plan-card .toggle-switch-block > span:last-child {
    order: 2 !important;
}
.plan-card .toggle-switch-block > span:first-child {
    order: 0 !important;
}
.annual-saving-first, .annual-saving-second {
      font-size: 15px;
    }
</style>
<section class="plan-sec cmn-gap ban-up banner_main">
    <div class="container">
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
                      <img src="{{url('/')}}/assets/fe/images/p1.svg" alt="">
                    </figure>

                    <ul class="plan-list">
                      <li>Communicate directly with candidates</li>
                      <li>Easy-to-use interface</li>
                      <li>Search based on skills and experience</li>
                      <li>Utilize multiple filters to find the perfect candidate for your open position</li>
                      <li>Organize and manage candidates of interest</li>
                      <li>View resumes with references and accomplishments</li>
                    </ul>
                    <hr>
                    <div class="plan-btm">
                      {{-- task - 86a2p15fh --}}
                      <div class="annual-saving-first text-danger" style="display: none;">
                        Annual plan saves you $589
                      </div>
                      {{-- task - 86a2p15fh end --}}

                      <div class="plan-price price-info-first">
                        <p><span>$299</span>/Month</p>
                      </div>
                      {{-- task - 86a2cbkkm --}}
                      <p class="h6 fw-bold" style="color: var(--purple);">NO FINDER'S FEE EVER!</p>
                      <div class="toggle-switch-block">
                        <span>Monthly</span>
                        <div class="switch_box box_1">
                          <input type="checkbox" wire:change="updatePlan($event.target.checked, $event.target.getAttribute('ref'))" class="switch_1 checkPrice" ref="price-info-first" >
                        </div>
                        <span>Annually</span>
                      </div>

                      <button type="button" class="plan-btn" wire:click="choosePlan(1)">Get Started</button>

                      <div class="cancel">
                                                  <a href="#">
                            Cancel Anytime
                        </a>
                                                </div>


                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="plan-card">
                    <h3>Employer Plus</h3>
                    <figure>
                      <img src="{{url('/')}}/assets/fe/images/p2.svg" alt="">
                    </figure>

                    <ul class="plan-list">
                      <li>Communicate directly with candidates</li>
                      <li>Easy-to-use interface</li>
                      <li>Search based on skills and experience</li>
                      <li>Utilize multiple filters to find the perfect candidate for your open position</li>
                      <li>Organize and manage candidates of interest</li>
                      <li>View resumes with references and accomplishments</li>
                      <li class="bold-li bold-custom"><strong>Access new candidates 24 hours earlier than the standard employer plan </strong></li>
                    </ul>
                    <hr>
                    <div class="plan-btm">
                      {{-- task - 86a2p15fh --}}
                      <div class="annual-saving-second text-danger" style="display: none;">
                        Annual plan saves you $488
                      </div>
                      {{-- task - 86a2p15fh end --}}
                      
                      <div class="plan-price price-info-second">
                        <p><span>$749</span>/Month</p>
                      </div>
                      {{-- task - 86a2cbkkm --}}
                      <p class="h6 fw-bold" style="color: var(--purple);">NO FINDER'S FEE EVER!</p>
                      <div class="toggle-switch-block">
                        <span>Monthly</span>
                        <div class="switch_box box_1">
                          <input type="checkbox" class="switch_1 checkPrice" ref="price-info-second" wire:change="updatePlan($event.target.checked, $event.target.getAttribute('ref'))">
                        </div>
                        <span>Annually</span>
                      </div>

                      <button type="button" class="plan-btn" wire:click="choosePlan(2)">Get Started</button>

                      <div class="cancel">
                                                  <a href="#">Cancel Anytime</a>
                                                 </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
        <img src="{{asset("assets/fe/images/p-pic.png")}}" alt=""  class="p-pic">
      </div>
    </div>
  </section>

  <script>
$("body").delegate(".checkPrice", "click", function(e) {
    $(this).parents('.plan-btm').find('.cancel').toggle();
      {{-- 86a2p14u2 --}}
   if ($(this).attr('ref') !== undefined) {
        var ref_el = $(this).attr('ref');
        var _amount = null;
        var _label = null;
        if (!$(this).prop("checked")) {
          _label = "Month";
          if (ref_el == "price-info-first") { 
            _amount = 299; 
            $('.annual-saving-first').hide(); // task - 86a2p15fh
          } else { 
            _amount = 749; 
            $('.annual-saving-second').hide(); // task - 86a2p15fh
          }

        } else {
          _label = "Year";
          if (ref_el == "price-info-first") { 
            _amount = 2999; 
            $('.annual-saving-first').show(); // task - 86a2p15fh
          } else { 
            _amount = 8500; 
            $('.annual-saving-second').show(); // task - 86a2p15fh
          }
        }
        $('#plan_amount').val(_amount);
        $('#plan_period').val(_label);
        if (ref_el == "price-info-first") {
          $('.' + ref_el).html('<p><span>$'+_amount+'</span>/'+_label+'</p>');
        } else {
          $('.' + ref_el).html('<p><span>$'+_amount+'</span>/'+_label+'</p>');
        }
      }
})
$("body").delegate(".plan-btn", "click", function(e) {
    window.location.href="{{url('/employer/signup')}}"
})

  </script>
  @endsection
