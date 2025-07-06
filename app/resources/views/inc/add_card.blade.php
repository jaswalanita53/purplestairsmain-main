<style type="text/css">
    input::placeholder {
      opacity: 0.5;
      color: #D3D3D3 !important;
    }
    .form-group.cvv .form-control {
        background-image: url('{{asset('assets/fe/images/cvv.svg')}}');
        background-position: center right 15px;
        background-repeat: no-repeat;
        background-size: 15px;
    }
    .pay-form .form-group .form-control {
    padding: 0px 25px;
}
</style>
<div class="modal fade" id="addCardModal" aria-hidden="true" aria-label="addCardModalLabel"
    tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Add Card</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="clearCardModel()">
                </button>
            </div>
            <div class="modal-body">
                <div class="cmn-form">
                    <div class="form-sec gl-form">
                        <form wire:submit.prevent="addCard()" id="save-card-form">
                            <div class="row">
                                <div class="col-md-12 pay-form form-group mt-1">
                                    <div class="credit-card">
                                        <div class="cre-lft ">
                                            <!-- <img src="{{asset('assets/fe/images/credit.svg')}}" alt=""> -->
                                            <div class="cre-pan">
                                                <input type="text" autocomplete="off" class="form-control ml-2 cc-width" wire:model.defer="credit_card" id="credit_card" placeholder="2414 7512 3214 4575" minlength="17" maxlength="19" wire:keyup="validate_cc()" wire:keydown="validate_cc()">
                                                {{-- wire:blur="validate_cc()" wire:keydown="validate_cc()" --}}
                                            </div>
                                        </div>
                                        <div class="cre-rgt {{ $is_cc_valid ? '' : 'd-none' }}">
                                            <img src="{{asset('assets/fe/images/tick2.svg')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="credit_card_error">
                                        @include('inc.error', [
                                         'field_name' => 'credit_card',
                                        ])

                                        <div class="text-danger" style="font-size: smaller;">
                                            @if($this->cc_error && $card_save) {{  $this->cc_error }} @endif
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                      <h5 class="mb-3 mt-4">EXP</h5>
                        <div class="col-3">

                          <div class="form-group fg2- m-0">
                              <input type="text" class="form-control numbersInput" placeholder="MM" wire:model.defer="exp_month" minlength="2" maxlength="2" min="1" wire:keyup="validate_cc()" wire:keydown="validate_cc()">
                              @include('inc.error', [
                                'field_name' => 'exp_month'
                              ])
                              {{-- wire:blur="validate_cc()" wire:keydown="validate_cc()" --}}
                            {{-- task - 86a0m88bj --}}
                            <div class="text-danger" style="font-size: smaller;">
                                @if($this->cc_mon_error && $card_save) {{  $this->cc_mon_error }} @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-1 text-center mt-3">  <span class="">/</span></div>
                        <div class="col-3">
                        <div class="form-group fg2- m-0">
                              <input type="text" class="form-control numbersInput" placeholder="YY" wire:model.defer="exp_year" minlength="2" maxlength="2"  wire:keyup="validate_cc()" wire:keydown="validate_cc()">
                              @include('inc.error', [
                                'field_name' => 'exp_year'
                              ])
                              {{-- wire:blur="validate_cc()" wire:keydown="validate_cc()" --}}
                              {{-- task - 86a0m88bj --}}
                              <div class="text-danger" style="font-size: smaller;">
                                @if($this->cc_yr_error && $card_save) {{  $this->cc_yr_error }} @endif
                              </div>
                          </div>
                        </div>
                        <div class="col-5">
                        <!-- <div class="form-group cvv" style="margin-left: 20px; width:170px"> -->
                        <div class="form-group cvv m-0" >
                              <input type="text" class="form-control numbersInput" placeholder="CVV Number" wire:model.defer="cvv" minlength="3" maxlength="4">
                              @include('inc.error', [
                                'field_name' => 'cvv'
                              ])
                          </div>
                        </div>
                      </div>
                                </div>
                            </div>
                            <div class="form-submit-btn mb-0 mt-2">
                                <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="addCard"/>
                                <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="addCard"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
     document.addEventListener("livewire:load", () => {
        $('#credit_card').keyup(function() {
              var v = $(this).val().replace(/\D/g, ''); // Remove non-numerics
              v = v.replace(/(\d{4})(?=\d)/g, '$1-'); // Add dashes every 4th digit
              $(this).val(v)
        });

        Livewire.hook('message.processed', (el, component) => {
            // $('#save-card-form').find('.text-danger').html('');
        });
    });

        /*$('input').input(function() {
     $(this).parents('.form-group').find('.text-danger').remove();
});*/

</script>
