<div class="modal fade" id="manageuModal" aria-hidden="true" aria-label="manageuModalLabel"
    tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Current Subscription - @if(!empty($active_plan['number_of_users'])){{$active_plan['number_of_users']}} @if($active_plan['number_of_users']==1) User @else Users @endif @endif <h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="cmn-form">
                        <div class="form-sec gl-form pt-0">
                            <form wire:submit.prevent="updateUsers()" id="nou-form">
                                <div class="row">
                                    {{-- task - 86a23ebne --}}
                                    <div class="col-md-12">
                                        <div class="gl-frm-outr mb-0">
                                            <label>Credit Card</label>
                                            {{-- 86a27ze33 --}}
                                            <div class="cc_row">
                                                @foreach($cards as $cc)
                                                    @include('inc.card_row_add_user')
                                                @endforeach
                                            </div>
                                            <div class="credit_card_error">
                                                @include('inc.error', [
                                                 'field_name' => 'active_credit_card',
                                                ])

                                                <div class="text-danger" style="font-size: smaller;">
                                                    @if($active_cc_error) {{  $active_cc_error }} @endif
                                                </div>
                                               <div class="row mt-4 mb-4 px-3">
                                                <button type="button" class="btn custom-outline-btn btn-purple-bg " data-bs-target="#addCardModal" data-bs-toggle="modal" data-bs-dismiss="modal" wire:click="clearCardModel()">
                                                Add A Card <span class="plus-icom"><img src="{{asset('/assets/fe/images/+.svg')}}" alt="" /></span>
                                                </button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- task - 86a23ebne end --}}
                                    
                                    <div class="col-md-5">
                                        <div class="gl-frm-outr mb-0">
                                            <div class="form-group my-3 num-users">
                                                <label>Add Users</label>
                                                <!-- <input type="number" placeholder="" class="form-control search-name" value="{{ $number_of_users }}"
                                                    wire:model.lazy="number_of_users" min="{{ $active_plan['plan_period'] == 'month' ? 1 : $active_plan['number_of_users'] }}" wire:change="update_amount_onusers()"/> -->
                                                                                                    {{-- 86a26mnw9 --}}
                                                <input type="number" placeholder="" class="form-control search-name" value="{{ $number_of_users }}"
                                                    wire:model.lazy="number_of_users" min="1" wire:change="update_amount_onusers()"/>
                                                    {{-- 86a26mnw9 --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="gl-frm-outr mb-0">
                                            <div class="form-group my-3">
                                                <label>Additional Charge ($)</label>
                                                <input type="number" placeholder="Amount($)" class="form-control search-name" value="{{ $price_on_number_of_users }}" readonly
                                                    wire:model.lazy="price_on_number_of_users" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-submit-btn mb-0 mt-2 d-flex justify-content-end">
                                    <input type="submit" value="Process Payment" class="submit-btn" wire:loading.remove wire:target="updateUsers" {{ empty($active_card) ? 'disabled' : '' }}/>
                                    <input type="button" value="Processing..." class="submit-btn" wire:loading wire:target="updateUsers"/>
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
        $('#active_credit_card').keyup(function() {
              var v = $(this).val().replace(/\D/g, ''); // Remove non-numerics
              v = v.replace(/(\d{4})(?=\d)/g, '$1-'); // Add dashes every 4th digit
              $(this).val(v)
        });

        Livewire.hook('message.processed', (el, component) => {
            // $('#save-card-form').find('.text-danger').html('');
        });
    });
</script>