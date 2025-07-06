<div>
<style>
.plan-card .toggle-switch-block > span:last-child {
    order: 2 !important;
}
.plan-card .toggle-switch-block > span:first-child {
    order: 0 !important;
}
</style>
    <section class="plan-sec cmn-gap ban-up">
        <div class="container">
          <div class="form-points form-points2">
            @php
            $step = 3;
            $current_step = auth()->user()->current_step;
            @endphp
            @include('inc.employersteps',compact('step', 'current_step'))
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
                      <img src="{{asset('assets/fe/images/p1.svg')}}" alt="" />
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
                      <div class="plan-price price-info-first">
                        <p><span>${{ $plan1_amount }}</span>/{{ ucfirst($plan1_period) }}</p>
                      </div>
                      {{-- task - 86a2cbkkm --}}
                      <p class="h6 fw-bold" style="color: var(--purple);">NO FINDER'S FEE EVER!</p>
                      <div class="toggle-switch-block">
                        <span>Monthly</span>
                        <div class="switch_box box_1">
                          <input type="checkbox" wire:change="updatePlan($event.target.checked, $event.target.getAttribute('ref'))" class="switch_1" ref="price-info-first" wire:ignore/>
                        </div>
                        <span>Annually</span>
                      </div>
                      {{-- <a href="{{route('companystep5')}}" class="plan-btn">Select This Plan</a> --}}
                      <button type="button" class="plan-btn" wire:click="choosePlan(1)">Select This Plan</button>

                      <div class="cancel">
                        @if($plan1_period=="month")
                        <a href="#" >
                            Cancel Anytime
                        </a>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="plan-card">
                    <h3>Employer Plus</h3>
                    <figure>
                      <img src="{{asset('assets/fe/images/p2.svg')}}" alt="" />
                    </figure>

                    <ul class="plan-list">
                      <li>Communicate directly with candidates</li>
                      <li>Easy-to-use interface</li>
                      <li>Search based on skills and experience</li>
                      <li>Utilize multiple filters to find the perfect candidate for your open position</li>
                      <li>Organize and manage candidates of interest</li>
                      <li>View resumes with references and accomplishments</li>
                      <li class="bold-li bold-custom"><strong >Access new candidates 24 hours earlier than employer plan </strong></li>
                    </ul>
                    <hr>
                    <div class="plan-btm">
                      <div class="plan-price price-info-second">
                        <p><span>${{ $plan2_amount }}</span>/{{ ucfirst($plan2_period) }}</p>
                      </div>
                      {{-- task - 86a2cbkkm --}}
                      <p class="h6 fw-bold" style="color: var(--purple);">NO FINDER'S FEE EVER!</p>
                      <div class="toggle-switch-block">
                        <span>Monthly</span>
                        <div class="switch_box box_1">
                          <input type="checkbox" class="switch_1" ref="price-info-second"  wire:change="updatePlan($event.target.checked, $event.target.getAttribute('ref'))" wire:ignore/>
                        </div>
                        <span>Annually</span>
                      </div>
                      {{-- <a href="{{route('companystep5')}}" class="plan-btn">Select This Plan</a> --}}
                      <button type="button" class="plan-btn" wire:click="choosePlan(2)">Select This Plan</button>

                      <div class="cancel">
                        @if($plan2_period=="month")
                          <a href="#" >Cancel Anytime</a>
                           @endif
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <img src="{{asset('assets/fe/images/p-pic.png')}}" alt=""  class="p-pic">
          </div>
        </div>
      </section>
</div>

<script>
document.addEventListener('livewire:load', function () {
    setTimeout(function() {
        @if($plan1_period=='month')
        $('.plan-card .switch_1').prop('checked', false);
        @else
         $('.plan-card .switch_1').prop('checked', true);
        @endif
    }, 500);
});
</script>
