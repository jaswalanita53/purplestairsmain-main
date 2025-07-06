<div>
    <style type="text/css">
        .whole-btn-wrap.dual-btn {
            display: block;
        }

        input[readonly], input[disabled]
        select[readonly], select[disabled] {
            background: #eee !important; pointer-events: none !important;
        }
        .select2-container--default .select2-selection--single {
            border-radius: 50px !important;
        }
    </style>
    <div class="back-clr ban-up">
        <section class="profile-banner cmn-gap pb-0">
            <div class="container">
                <div class="form-points">
                    @php
                    $step = 1;
                    $current_step = auth()->user()->current_step;
                    @endphp
                    @include('inc.employersteps',compact('step', 'current_step'))
                </div>
                <div class="profile-outr">

                    <h1>
                        Employer Information
                    </h1>

                    <img src="{{asset('assets/fe/images/pc2.png')}}" alt="" class="pic6 pc2" />
                    <img src="{{asset('assets/fe/images/pc1.png')}}" alt="" class="pic0">
                </div>
            </div>
        </section>

        <div class="common-form-wrap cmn-gap pt-0">
            <div class="container">
                <div class="common-form-outr">
                    <div class="form-hdr">
                        <h5>Contact Information</h5>
                        <div>
                            <!-- @include('inc.autoSaveLoader') -->
                        </div>
                    </div>
                    <div class="gl-form form-sec emp-form">
                    <form wire:submit.prevent="saveProfile()" id="saveProfile">
                        <div class="gl-frm-outr">
                            <label>Employer Name*</label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control user-name-field" wire:model="employer_name" />
                                @include('inc.error', [
                                    'field_name' => 'employer_name',
                                ])
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Company Name*</label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" wire:model="company_name" />
                                @include('inc.error', [
                                    'field_name' => 'company_name',
                                ])
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Company Email*</label>
                            <div class="form-group">
                                <input type="email" placeholder="" class="form-control" wire:model="company_email" readonly disabled/>
                                @include('inc.error', [
                                    'field_name' => 'company_email',
                                ])
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Company Address*</label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" wire:model="company_address" />
                                @include('inc.error', [
                                    'field_name' => 'company_address',
                                ])
                            </div>
                        </div>

                        <div class="gl-frm-outr">
                            <label>Company City*</label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" wire:model="company_city"  />
                                @include('inc.error', [
                                    'field_name' => 'company_city',
                                ])
                            </div>
                        </div>

                        <div class="gl-frm-outr mb-3">
                            <label>Company State* </label>
                            <div class="form-group">
                                <select class="" wire:model.defer="company_state" id="company_state"  >
                                    <option value="">Select State</option>
                                    @foreach ($all_states as $key => $ind)
                                    <option data-badge="" value={{ $ind }}>{{ $key }}</option>
                                    @endforeach
                                </select>
                                @include('inc.error', [
                                    'field_name' => 'company_state',
                                ])
                            </div>
                        </div>

                        <div class="gl-frm-outr">
                            <label>Company Zipcode* </label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control zip_code_field" wire:model="zip_code"   />
                                @include('inc.error', [
                                    'field_name' => 'zip_code',
                                ])
                            </div>
                        </div>

                        <div class="gl-frm-outr">
                            <label>Company Phone*</label>
                            <div class="form-group">
                                <input type="text" placeholder="xxx-xxx-xxxx" id="telle" maxlength="12" class="form-control" wire:model="company_phone" />
                                @include('inc.error', [
                                    'field_name' => 'company_phone',
                                ])
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Website URL</label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" wire:model="website_url" />
                                @include('inc.error', [
                                'field_name' => 'website_url',
                                ])
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Social Media URL</label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" wire:model="social_media_url" />
                                @include('inc.error', [
                                    'field_name' => 'social_media_url',
                                ])
                            </div>
                        </div>

                        <!-- <div class="whole-btn-wrap dual-btn text-end">
                            {{-- <input type="submit" value="Back" class="prev-btn"> --}}
                            <input type="submit" value="Next" class="nxt-btn">
                        </div> -->
                        <div class="whole-btn-wrap text-end">
                        <input type="submit" value="Next" class="nxt-btn" wire:loading.remove wire:target="saveProfile"/>
                        <input type="button" value="Next..." class="nxt-btn" wire:loading wire:target="saveProfile"/>
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    //Add dashes to phone input
    //Add dashes to phone input
    var tele = document.querySelector('#telle');

    tele.addEventListener('keyup', function(e) {
        if (event.key != 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)) {
            tele.value += '-';
        }
    });
  document.addEventListener("livewire:load", () => {
            $("body").delegate("#telle", "keypress", function(e) {
                var inputValue = $(this).val();
                var charCode = event.which;

                if (
                    (charCode < 48 || charCode > 57) && // Not a number
                    charCode !== 45 && // Not a hyphen
                    charCode !== 8 && // Backspace
                    charCode !== 0 && // Arrow keys, function keys, etc.
                    !event.ctrlKey // Control key combination
                ) {
                    event.preventDefault();
                    return false;
                }

            });
    $("body").delegate("#telle", "keyup paste", function(e) {
      var v = $(this).val().replace(/\D/g, ''); // Remove non-numerics
      if(v.length<10){
      v = v.replace(/(\d{3})(?=\d)/g, '$1-'); // Add dashes every 4th digit
      $(this).val(v)
      }
      /*if(v.length>10){
      v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
      $(this).val(v.substr(0, 12))
      }*/

      v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
      $(this).val(v.substr(0, 12))
});
});
    $(".nxt-btnb").click(function(e) {
        e.preventDefault();
        var count = 0;
        $(this)
            .parents(".common-form-outr")
            .find(".gl-frm-outr")
            .each(function() {
                var label = $(this).find("label").text();

                if (label.includes("*")) {
                    if ($(this).find('input').val() == "") {
                        $(this).find(".form-group").find(".text-danger").remove();
                        $(this).find(".form-group").find("input").focus();
                        $(this)
                            .find(".form-group")
                            .append(
                                '<div class="text-danger" style=""> This field is required.</div>'
                            );
                        count++;
                        // return false; task - 862k30j2e
                    } else if ($(this).find('select').val() == "") {
                        $(this).find(".form-group").find(".text-danger").remove();
                        $(this).find(".form-group").find("select").focus();
                        $(this)
                            .find(".form-group")
                            .append(
                                '<div class="text-danger" style=""> This field is required.</div>'
                            );
                        count++;
                    }
                }

            });

        if (count > 0) {
            return false;
        }
        var errosCount = $(".text-danger").length;
        if (errosCount < 1) {
            location.replace("/company/company-info");
        } else {
            $(".text-danger").each(function() {
                $(this).parents(".form-group").find("input").focus();
                return false;
            });
        }
        return false;
    });
    $("body").delegate(".user-name-field", "input", function(e) {
        val = $(this).val();
        $('.user-name').text(val);
        console.log(val)
    })

    $('#company_state').select2({
        placeholder: 'Select an option'
    });
    document.addEventListener('livewire:load', function () {
            $('#company_state').select2();

            Livewire.on('select2Updated', function (value) {
                $('#company_state').val(value).trigger('change');
            });
        });

    document.addEventListener("livewire:load", () => {
        $("body").delegate("#company_state", "change", function(e) {
            var val = $(this).val();
            @this.set('company_state', val);
        })
        Livewire.hook('message.processed', (message, component) => {
            $('#company_state').select2({
        placeholder: 'Select an option'
    });
        // $('#company_state').trigger('change');

            })
    })
// $(document).ready(function(){

//     $('#company_state').trigger('change');
// })

</script>
@endpush
