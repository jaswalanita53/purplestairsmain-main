<div>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    {{-- #86a1rttk7 --}}
    <div class="login-sec log-h-sec pt-4 ban-up ban-up3 ht_center_div">
        <div class="login-sec-wrap">
          <div class="@if(Route::currentRouteName() != 'company.manageaccount') container @endif">
            <div
              class="log-wrap lg-wrp2"
              style="background-image: url(/assets/fe/images/log-back.png)"
            >
              <div class="login-outr del-outr">
                <h2 style="font-size:32px">Deactivate My Account</h2>
                <p class="mb-2">Why are you deactivating your account?</p>
                <form wire:submit.prevent="deleteAccount()" id="delete_account">

                  <div class="form-input">
                    <select class="form-select select-reason" wire:model.defer="reason">
                      {{-- <option  selcted value="">Select reason</option> --}}
                       @if(Auth::user()->user_type == 'employer')
                        <option value="I found a candidate on Purple Stairs" selected>I found a candidate on Purple Stairs</option>
                        <option value="I found a candidate elsewhere" >I found a candidate elsewhere</option>
                        <option value="I did not find the candidate I was looking for on Purple Stairs" >I did not find the candidate I was looking for on Purple Stairs</option>
                        <option value="I found Purple Stairs hard to use" >I found Purple Stairs hard to use</option>
                        <option value="I didn't want to pay the fee" >I didn't want to pay the fee</option>
                      @else
                      <option value="I found a position with Purple Stairs" selected>I found a position with Purple Stairs</option>
                      <option>I found a position on my own</option>
                      <option class="custom_option">I had difficulty using the site</option>
                      <option class="custom_option">The platform did not fully meet my expectations</option>
                      @endif
                    </select>
                    <div class="gl-frm-outr text-left mt-2 d-none custom-field-parent">
                         <p class="mb-2">Please Specify</p>
                        <div class="form-group">
                            <input type="text" class="form-control custom-field">
                        </div>
                    </div>
                  </div>
                  @if($reason == 'I did not like your platform')
                  <div class="form-input">
                    <input
                      type="text"
                      placeholder="What did you not like about Purple Stairs?"
                      class="form-control"
                      wire:model.defer="other"
                    />
                  </div>
                  @endif
                  @if(Auth::user()->provider_id == '')
                  <div class="form-input">
                  <div class="form_ipp_passwordd">
                                 <input type="password" class="password-field pass_chk form-control" placeholder="To continue please enter account password." wire:model.defer="password" >
                                 <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                             </div>
                    <!-- <input
                      type="password"
                      placeholder="To continue please enter account password."
                      class="form-control password_sm"
                      wire:model.lazy="password"
                    /> -->
                  </div>
                  @endif
                  @include('inc.error', [
                    'field_name' => 'password',
                  ])
                  <div class="form-input">
                    <input
                      type="button"
                      value="Deactivate My Account"
                      class="sub-btn deactivateAccountBtn"
                    />
                  </div>
                </form>
              </div>
              @if(Route::currentRouteName() != 'company.manageaccount')
                        <img src="{{ asset('assets/fe/images/log1.png') }}" alt="" class="mobile-v log1">
                        <img src="{{ asset('assets/fe/images/log2.png') }}" alt="" class="mobile-v log2">
                    @endif
            </div>
          </div>
        </div>
      </div>
</div>
<script>
    $('.select-reason').on('change', function(event) {
        var val=$('.select-reason').val();
        if(val=="I had difficulty using the site" || val=="The platform did not fully meet my expectations"){
            $('.custom-field-parent').removeClass('d-none');
        }else{
            $('.custom-field-parent').addClass('d-none');
        }
    });

    $('.deactivateAccountBtn').on('click', function(event) {
        // task - 86a32nrge
        @if(Auth::user()->user_type == "employer")
        var htmlContant='<p class="px-2">You will have access to your Purple Stairs account until the end of your current billing cycle, which ends on @if(!empty($nextDate)){{ \Carbon\Carbon::parse($nextDate)->format("m/d/Y")  }} @endif</p><p style="font-size: 17px;font-weight: 700;">Are you sure you want to deactivate your account?</p>';

        Swal.fire({
            // title: "Opting out of this section causes you to appear as an entry-level candidate. To avoid this without revealing your position, add your information and select the hide option.",
            html:htmlContant,
            {{-- text: 'Are you sure you want to log out?', --}}
            icon: 'warning',
            iconHtml: "<img src='{{ asset('assets/fe/images/warning.png') }}'>",
            showCancelButton: true,
            confirmButtonColor: '#7E50A7',
            cancelButtonColor: '#4A2D64',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            showCloseButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                var val=$('.select-reason').val();
                if(val=="I had difficulty using the site" || val=="The platform did not fully meet my expectations"){
                    @this.set('reason', val+": "+$('.custom-field').val());
                }
                if(val=="I found a position with Purple Stairs"){
                    @this.set('reason', 'I found a position with Purple Stairs');
                }
                if(val=="I found a candidate on Purple Stairs"){
                    @this.set('reason', 'I found a candidate on Purple Stairs');
                }
                Livewire.emit('deleteAccount');
              {{-- $('#delete_account').submit(); --}}
            } else {
                return false;
            }
        });
        @else
            var val=$('.select-reason').val();
            if(val=="I had difficulty using the site" || val=="The platform did not fully meet my expectations"){
                @this.set('reason', val+": "+$('.custom-field').val());
            }
            if(val=="I found a position with Purple Stairs"){
                @this.set('reason', 'I found a position with Purple Stairs');
            }
            if(val=="I found a candidate on Purple Stairs"){
                @this.set('reason', 'I found a candidate on Purple Stairs');
            }
            Livewire.emit('deleteAccount');
        @endif
    });
    $('#delete_account').on('submit', function(event) {

        var val=$('.select-reason').val();
        if(val=="I had difficulty using the site" || val=="The platform did not fully meet my expectations"){
            @this.set('reason', val+": "+$('.custom-field').val());
        }
        if(val=="I found a position with Purple Stairs"){
            @this.set('reason', 'I found a position with Purple Stairs');
        }
        if(val=="I found a candidate on Purple Stairs"){
            @this.set('reason', 'I found a candidate on Purple Stairs');
        }

    });


</script>
