<div>
<style type="text/css">
        .profile-popup {
            pointer-events: none;
            opacity: 0.5;
        }
        span.text-danger.visibility-alert {
    margin-left: 30px;
    font-size: 11px;
}
        .intl-tel-input.allow-dropdown {
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/css/intlTelInput.css">
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/intlTelInput.min.js"></script>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="form-points">
                @php
                $step = 7; $current_step = auth()->user()->current_step;
                @endphp
                @include('inc.steps', compact('step', 'current_step'))
            </div>
        </div>
    </section>

    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>References</h5>
                    <div>
                        {{-- task - 86a0hxg00 @include('inc.autoSaveLoader') --}}
                        <a class="skip" {{-- data-fancybox
                  data-src="#open4" --}} href="{{ route('candidatestep8') }}">Skip <em><img src="{{ asset('assets/fe/images/skip-arrw.svg') }}" alt="" /></em></a>

                        {{-- task - 86a1hvpcy --}}
                        <button type="button" class="btn save-later" wire:click="finish_later" style="" >
                            <img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp;{{ $profileSaved ? 'Profile Saved' : 'Finish Later' }}
                        </button>
                    </div>
                </div>
                <form wire:submit.prevent="saveReference()">
                <div class="gl-form form-sec">
                    <!-- <div class="warn-txt text-end">
                        <img src="images/warn.svg" alt="" />
                        <span>Add most recent first</span>
                    </div> -->

                    @foreach ($references as $key => $reference)
                    @if ($key > 0)
                    {{-- // Task #86a0hf5r4 --}}
                    <h6>Enter Additional Reference <button type="button" class="remove_additional_sec" wire:click="removeRef({{$reference->id}})"><img src="{{ asset('assets/fe/images/delete.svg') }}" alt="Remove Section" /></button></h6>
                    @endif
                    <div class="gl-frm-outr mb-3">
                        <label>Name</label>
                        <div class="form-group disable-form-">
                            <input type="text" placeholder="" class="form-control input-name" wire:model.defer="name.{{ $reference->id }}" />
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" wire:model.lazy="name_status.{{ $reference->id }}" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden {{ $reference->name_status ? '' : 'show' }}">
                                <div class="d-span">
                                    <img src="{{ asset('assets/fe/images/hidden.svg') }}" alt="" />Hidden to
                                    everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if(!empty($reference_name_error[$reference->id]))
                                            <span class="text-danger error">{{ $reference_name_error[$reference->id] }}</span>
                                        @endif
                            @if($reference->name_status)
                                <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                        </div>
                    </div>
                    <div class="gl-frm-outr mb-3">
                        <label>Relationship</label>
                        <div class="form-group disable-form-">
                            <input type="text" placeholder="" class="form-control" wire:model.lazy="relationship.{{ $reference->id }}" />
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" wire:model.lazy="relationship_status.{{ $reference->id }}" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden {{ $reference->relationship_status ? '' : 'show' }}">
                                <div class="d-span">
                                    <img src="{{ asset('assets/fe/images/hidden.svg') }}" alt="" />Hidden to
                                    everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if($reference->relationship_status)
                                <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                        </div>
                    </div>

                    <div class="gl-frm-outr mb-3">
                        <label>Phone</label>
                        <div class="form-group disable-form-">
                            <span>
                            <input type="tel" placeholder="xxx-xxx-xxxx" maxlength="16" class="form-control telle tellee{{ $reference->id }}" wire:model.lazy="phone.{{ $reference->id }}" id="tellee{{ $reference->id }}"/>
                            </span>
                            @include('inc.error', [
                            'field_name' => 'phone.' . $reference->id,
                            ])
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" wire:model.lazy="phone_status.{{ $reference->id }}" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden {{ $reference->phone_status ? '' : 'show' }}">
                                <div class="d-span">
                                    <img src="{{ asset('assets/fe/images/hidden.svg') }}" alt="" />Hidden
                                    to everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if($reference->phone_status)
                                <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                        </div>
                    </div>
                    <div class="gl-frm-outr mb-3">
                        <label>Email</label>
                        <div class="form-group disable-form-">
                            <input type="text" placeholder="" class="form-control" wire:model.lazy="email.{{ $reference->id }}" />
                            @include('inc.error', [
                            'field_name' => 'email.' . $reference->id,
                            ])
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" wire:model.lazy="email_status.{{ $reference->id }}" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden {{ $reference->email_status ? '' : 'show' }}">
                                <div class="d-span">
                                    <img src="{{ asset('assets/fe/images/hidden.svg') }}" alt="" />Hidden
                                    to everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if($reference->email_status)
                                <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    @endforeach

                    <div class="gl-frm-btn">
                        <a href="#" class="pos-btn" wire:click.prevent="add()">
                            Add Reference
                            <span>+</span>
                        </a>
                    </div>
                    <div class="whole-btn-wrap dual-btn">
                        <input type="submit" value="Back" class="prev-btn" />
                        <input type="submit" value="Next" class="nxt-btn formNextBtn-" wire:loading.remove wire:target="saveReference"/>
                        <input type="button" value="Saving..." class="nxt-btn" wire:loading wire:target="saveReference"/>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
     // task - 86a1hvpcy
    $('input').on('change, keydown', function(event) {
        $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp; Finish Later');
    });

    //initiate languages select2
    document.addEventListener("livewire:load", () => {
        changePage();
        addDashes();
        Livewire.on('newReferenceAdded', function() {
            changePage();
            addDashes();
        });

        // task - 86a2bvb88
        function triggerSwitch() {
            $('.switch_1').each(function(index, el) {
                if ($(el).is(':checked')) {
                    $(el).parents('.gl-frm-outr').find('.hiden.show').remove();
                    $(el).parents('.disable-form-').find('.visibility-alert').remove();
                    $(el).parents('.toggle-switch-block').after('<span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>');
                } else {
                    $(el).parents('.disable-form-').find('.visibility-alert').remove();
                    $(el).parents('.gl-frm-outr').find('.hiden.show').remove();
                    $(el).parents('.toggle-switch-block').after('<div class="hiden show"><div class="d-span"><img src="{{asset("assets/fe/images/hidden.svg")}}" alt="">Hidden to everyone<div class="in-ap"> <p>This information will only be unmasked to a Requesting company <strong>upon your approval.</strong> </p>    </div>   </div>                        </div>');
                }
            });
        }

        Livewire.hook('message.processed', (message, component) => {
            triggerSwitch();
        });
        // task - 86a2bvb88 end
    })

    function changePage() {
        $(".prev-btn").click(function(e) {
            e.preventDefault();
            location.replace('/candidate/skills')

        })
        // $(".nxt-btn").click(function(e) {
        //     // e.preventDefault();
        //     // location.replace('/candidate/about')
        //     window.location.href='{{url("/candidate/about")}}';
        // })
        $("body").delegate(".nxt-btn-", "click", function(e) {
            // e.preventDefault();
            var count = 0;
            count=$('.text-danger').length;
            $(this).parents(".common-form-outr").find(".telle").each(function() {
                var regex = /^\d{3}-\d{3}-\d{4}$/;
                if($(this).val()!=""){
                    if (!regex.test($(this).val())) {
                        $(this).parents(".form-group").find(".text-danger").remove();
                        $(this).parents(".form-group").find("input:first").focus();
                        $(this)
                            .parents(".form-group")
                            .append(
                                '<div class="text-danger" style=""> The phone field format is invalid.</div>'
                            );
                        count++;
                    }
                }
            });

            if (count > 0) {
                $('.text-danger:first').parents(".form-group").find("input:first").focus();
                return false;
            }
            // window.location.href='{{url("/candidate/about")}}';
            return true;
        })
    }

    function addDashes() {
        //Add dashes to phone input
        // $(".telle").keyup(function(event) {
        //     event.preventDefault();
        //     if (event.key != 'Backspace' && ($(this).val().length === 3 || $(this).val().length === 7)) {
        //         $(this).val($(this).val() + '-');
        //     }
        // });
    }

    $("body").delegate(".telle-", "keypress", function(e) {
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
    document.addEventListener("livewire:load", () => {


    $("body").delegate(".telle-", "keyup paste", function(e) {
      var v = $(this).val().replace(/\D/g, ''); // Remove non-numerics
      if(v.length<10){
      v = v.replace(/(\d{3})(?=\d)/g, '$1-'); // Add dashes every 4th digit
      $(this).val(v)
      }
    //   if(v.length>10){
    //   v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
    //   $(this).val(v.substr(0, 12))
    //   }
    v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
      $(this).val(v.substr(0, 12))
});
});

document.addEventListener("livewire:load", () => {

$("body").delegate(".input-name", "keyup", function(e) {

        $(this).parents('.form-group').find('.text-danger').remove();

    });
});


    //Add dashes to phone input
    // $("body").delegate(".telle", "keyup", function(event) {
    //     var tele=$(this).val();
    //     if (event.key != 'Backspace' && (tele.length === 3 || tele.length === 7)) {
    //     tele += '-';
    //     $(this).val(tele);
    //     console.log('tele',tele);
    //     }
    // })
$("body").delegate(".disable-form- .switch_1", "click", function(e) {
        if($(this).is(':checked')){
            $(this).parents('.gl-frm-outr').find('.hiden.show').remove();
            $(this).parents('.disable-form-').find('.visibility-alert').remove();
            $(this).parents('.disable-form-').append('<span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>');
         }else{
            $(this).parents('.disable-form-').find('.visibility-alert').remove();
            $(this).parents('.gl-frm-outr').find('.hiden.show').remove();
            $(this).parents('.disable-form-').append('<div class="hiden show"><div class="d-span"><img src="{{asset("assets/fe/images/hidden.svg")}}" alt="">Hidden to everyone<div class="in-ap"> <p>This information will only be unmasked to a Requesting company <strong>upon your approval.</strong> </p>    </div>   </div>                        </div>');

        }

    });
   $(document).ready(function () {
    let allValid = 0;

    $('.telle').each(function () {
        let input = $(this);

        input.intlTelInput('destroy');
        input.intlTelInput({
            initialCountry: 'auto',
            preferredCountries: ['us', 'gb', 'br', 'ru', 'cn', 'es', 'it'],
            autoPlaceholder: 'aggressive',
            nationalMode: false,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/utils.js",
            geoIpLookup: function (callback) {
                fetch('https://ipinfo.io/json', {
                    cache: 'reload'
                }).then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Failed: ' + response.status);
                }).then(ipjson => {
                    callback(ipjson.country);
                }).catch(e => {
                    callback('us');
                });
            }
        });

        input.on("countrychange input", function () {
            if (input.intlTelInput("isValidNumber")) {
                clearError();
                var selectedCountryData = input.intlTelInput('getSelectedCountryData');
                var countryCode = selectedCountryData.iso2.toUpperCase();
                var val = $('.country-name option[data-code="' + countryCode + '"]').attr('value');
            } else {
                clearError();
                allValid++;
            }

            if (allValid == $('.telle').length - 1) {
                $('.formNextBtn').attr('type', 'submit');
            } else {
                $('.formNextBtn').attr('type', 'button');
            }
        });

        function clearError() {
            input.parents(".form-group").find(".text-danger").remove();
        }

        function displayError(message) {}
    });

    $('.telle').trigger('keyup');
});

document.addEventListener("livewire:load", () => {
    Livewire.hook('message.processed', (message, component) => {
        let allValid = 0;

        $('.telle').each(function (index) {
            let input = $(this);
            setTimeout(() => {
                input.intlTelInput('destroy');
                input.intlTelInput({
                    initialCountry: 'auto',
                    preferredCountries: ['us', 'gb', 'br', 'ru', 'cn', 'es', 'it'],
                    autoPlaceholder: 'aggressive',
                    nationalMode: false,
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/utils.js",
                    geoIpLookup: function (callback) {
                        fetch('https://ipinfo.io/json', {
                            cache: 'reload'
                        }).then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error('Failed: ' + response.status);
                        }).then(ipjson => {
                            callback(ipjson.country);
                        }).catch(e => {
                            callback('us');
                        });
                    }
                });

                input.on("countrychange input", function () {
                    if (input.intlTelInput("isValidNumber")) {
                        clearError();
                        var selectedCountryData = input.intlTelInput('getSelectedCountryData');
                        var countryCode = selectedCountryData.iso2.toUpperCase();
                        var val = $('.country-name option[data-code="' + countryCode + '"]').attr('value');
                    } else {
                        clearError();
                        allValid++;
                    }

                    if (allValid == $('.telle').length - 1) {
                        $('.formNextBtn').attr('type', 'submit');
                    } else {
                        $('.formNextBtn').attr('type', 'button');
                    }
                });

                function clearError() {
                    input.parents(".form-group").find(".text-danger").remove();
                }

                function displayError(message) {}
            }, index * 100);
        });

        $('.telle').trigger('keyup');
    });
});

</script>


@endpush
