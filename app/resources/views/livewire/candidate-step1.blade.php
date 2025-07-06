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
        .pl-0 {
            padding-left: 0px !important;
        }

        .pl-5px {
            padding-left: 5px !important;
        }

        .intl-tel-input.allow-dropdown {
            width: 100%;
        }
    </style>
    <!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
{{-- #86a1rttk7 --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/css/intlTelInput.css">


    <div class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="sec-hdr">
                <h1>Candidate Profile</h1>
            </div>
            <div class="form-points mb-5">
                @php
                $step = 1; $current_step = auth()->user()->current_step;
                @endphp
                @include('inc.steps',compact('step', 'current_step'))
            </div>
            <div class="profile-popup-wrap cutsom-purple-wrap">
                <div class="row align-items-center ps-5 pe-5">
                    <div class="col-md-10">
                        <div class="profile-popup-rgt">
                            <p style="padding: 0;">
                                <strong> You decide what will be shown or hidden </strong>
                                An employer who is interested in learning more about you will submit a request. You can choose to allow or deny a request to show all your information to that specific employer.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="profile-popup">
                            <div class="toggle-switch-block">
                                <span>Show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" checked="" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="common-form-wrap cmn-gap">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>Personal Information</h5>
                    {{-- task - 86a0hxg00 @include('inc.autoSaveLoader') --}}

                    {{-- task - 86a1hvpcy --}}
                    <button type="button" class="btn save-later" wire:click="finish_later" style="" >
                        <img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp;{{ $profileSaved ? 'Profile Saved' : 'Finish Later' }}
                    </button>
                    {{-- <button wire:loading type="button" class="btn save-later" style="{{ $profileSaved ? 'display: block;' : 'display: none;' }}">
                        <img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp;Profile Saved
                    </button> --}}
                </div>
                <form wire:submit.prevent="saveProfile()" id="saveProfile">
                <div class="gl-form form-sec">
                    <div class="gl-frm-outr mb-3">
                        <label>Name*</label>
                        <div class="form-group disable-form-">
                            <input type="text" placeholder="" class="form-control user-name-field" wire:model.lazy="name" />
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1 name-status" tabindex="-1" @if($name_status) checked @endif />
                                </div>
                                <span>Hide</span>
                            </div>
                            @if($name_status)
                            <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                            @include('inc.error', [
                            'field_name' => 'name',
                            ])
                        </div>
                        <div class="hiden {{ $name_status ? '' : 'show' }}">
                            <div class="d-span">
                                <img src="{{asset("assets/fe/images/hidden.svg")}}" alt="" />Hidden to everyone

                                <div class="in-ap">
                                    <p>
                                        This information will only be unmasked to a Requesting
                                        company <strong>upon your approval.</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr mb-3">
                        <label>Email*</label>
                        <div class="form-group disable-form-">
                            <input type="email" placeholder="" class="form-control readonly-email" wire:model.lazy="email" readonly />
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" wire:model.defer="email_status" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            @if($email_status)
                            <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                            @include('inc.error', [
                            'field_name' => 'email',
                            ])
                        </div>
                        <div class="hiden {{ $email_status ? '' : 'show' }}">
                            <div class="d-span">
                                <img src="{{asset("assets/fe/images/hidden.svg")}}" alt="" />Hidden to everyone

                                <div class="in-ap">
                                    <p>
                                        This information will only be unmasked to a Requesting
                                        company <strong>upon your approval.</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr mb-3">
                        <label>Phone*</label>
                        <div class="form-group disable-form-">
                        @if($user_country=='US')
                        <input type="tel" placeholder="xxx-xxx-xxxx" id="telle" maxlength="14" class="form-control" wire:model.defer="phone" />
                        @else
                        <input type="tel" placeholder="" id="tellee" maxlength="16" class="form-control" wire:model.defer="phone" />
                        @endif

                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" wire:model.defer="phone_status" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            @if($phone_status)
                            <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                            @include('inc.error', [
                            'field_name' => 'phone',
                            ])
                        </div>
                        <div class="hiden {{ $phone_status ? '' : 'show' }}">
                            <div class="d-span">
                                <img src="{{asset("assets/fe/images/hidden.svg")}}" alt="" />Hidden to everyone

                                <div class="in-ap">
                                    <p>
                                        This information will only be unmasked to a Requesting
                                        company <strong>upon your approval.</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr mb-3">
                        <label>Current Title*</label>
                        <div class="form-group disable-form-">
                            <input type="text" placeholder="" class="form-control" wire:model.lazy="current_title" />
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" checked="" wire:model.defer="current_title_status" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            {{-- task - 86a2fhvp8 --}}
                            @if($current_title_status)
                                <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                            {{-- task - 86a2vwxam --}}
                            @include('inc.error', [
                                'field_name' => 'current_title',
                            ])

                            <div class="hiden {{ $current_title_status ? '' : 'show' }}">
                                <div class="d-span">
                                    <img src="{{asset("assets/fe/images/hidden.svg")}}" alt="" />Hidden to everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Task 862k42apk
                      <div class="form-bulb">
                        <span><img src="{{asset('assets/fe/images/mega-phone.png')}}" alt="" /></span>
                        <p>
                          First Impressions Count. Put your best foot forward with a title
                          that says it awesomely!
                        </p>
                      </div> -->
                    @if($user_country=='US')
                    <div class="gl-frm-outr">
                        {{-- task - 86a0xw1z1 disabled --}}
                        <label>Zipcode* <em> (Center of Work Radius)</em></label>
                        <div class="form-group disable-form-">
                            <input type="text" placeholder="" class="form-control zip_code_field-" wire:model.lazy="zip_code" id="zipcode" maxlength="10"/>
                            @include('inc.error', [
                            'field_name' => 'zip_code',
                            ])
                            <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.defer="zip_code_status" tabindex="-1"  data-value="{{$zip_code_status}}"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                         @if($zip_code_status)
                            <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                                        <div class="hiden {{ $zip_code_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

                                                <div class="in-ap">
                                                    <p>
                                                        This information will only be unmasked to a Requesting
                                                        company <strong>upon your approval.</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                        </div>
                    </div>
                    @else
                    <div class="gl-frm-outr mb-3">
                        <label>Country*</label>
                        <div class="disable-form- form-group">
                            {{-- task 86a1j9na7 --}}
                            {{-- <input type="text" placeholder="" class="form-control country-name" wire:model.lazy="country" /> --}}
                            <select class="form-control country-name" wire:model="country">
                            <option value=""  selected>Select</option>
                            @foreach ($countryNames as $code=>$countryName)
                                <option value="{{ $countryName }}" data-code="{{ $code }}">{{ $countryName }}</option>

                            @endforeach
                            </select>
                            {{-- task 86a1j9na7 --}}
                            @include('inc.error', [
                            'field_name' => 'country',
                            ])
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" checked="" wire:model.defer="country_name_status" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            @if($country_name_status)
                            <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                            <div class="hiden {{ $country_name_status ? '' : 'show' }}">
                                <div class="d-span">
                                    <img src="{{asset("assets/fe/images/hidden.svg")}}" alt="" />Hidden to everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="gl-frm-outr mb-3">
                        <label>LinkedIn URL </label>
                        <div class="disable-form- form-group">
                            {{-- task 86a1j9na7 --}}
                            <input type="text" placeholder="" class="form-control" wire:model.lazy="linkedin_url" />
                            {{-- task 86a1j9na7 --}}
                            @include('inc.error', [
                            'field_name' => 'linkedin_url',
                            ])
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" checked="" wire:model.defer="linkedin_url_status" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            @if($linkedin_url_status)
                            <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                            <div class="hiden {{ $linkedin_url_status ? '' : 'show' }}">
                                <div class="d-span">
                                    <img src="{{asset("assets/fe/images/hidden.svg")}}" alt="" />Hidden to everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr mb-0">
                        <label>Additional URL <em>(or Portfolio Link)</em> </label>
                        <div class="disable-form- form-group">
                            {{-- task 86a1j9na7 --}}
                            <input type="text" placeholder="" class="form-control" wire:model.lazy="additional_url" />
                            {{-- task 86a1j9na7 --}}
                            @include('inc.error', [
                            'field_name' => 'additional_url',
                            ])
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" checked="" wire:model.defer="additional_url_status" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            @if($additional_url_status)
                            <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                            @endif
                            <div class="hiden {{ $additional_url_status ? '' : 'show' }}">
                                <div class="d-span">
                                    <img src="{{asset("assets/fe/images/hidden.svg")}}" alt="" />Hidden to everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Task 862k42apk
                      <div class="form-bulb">
                        <span><img src="{{asset('assets/fe/images/star2.png')}}" alt="" /></span>
                        <p>
                          Insert A Link Here That Will Impress.
                        </p>
                      </div> -->
                    <div class="whole-btn-wrap text-end">
                        <input type="submit" value="Next" class="nxt-btn formNextBtn" wire:loading.remove wire:target="saveProfile"/>
                        <input type="button" value="Next..." class="nxt-btn" wire:loading wire:target="saveProfile"/>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<style>
  /* Custom styles for the alert modal */
  #alertModalLabel {
   color: var(--purple);
   padding-top: 0px;
   padding-bottom: 0px;
  }
  #alertModal .modal-dialog {
    max-width: 500px;
    margin: 14.75rem auto;
}
  .alrt-close {
    border: none;
    background: none;
    color: var(--purple);
    padding: 1px;
    font-size: 28px;
    padding-top: 0px !important;
    padding-left: 0px !important;
}
#alertModal .modal-content {

    border-radius: 1.3rem;
    /* outline: 0; */
}
</style>

<!-- Hidden Modal -->
<div class="modal fade my-auto mx-auto" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="alertModalLabel">Your Name Is Not Hidden From Your Current Employer!</h5>
        <button type="button" class="close alrt-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="alertModalBody">
        <p>If you would like more privacy, you can select "Hide" to make your name invisible. You will be able to "Show" all your details to approved employers who specifically request to see your full profile.</p>
      </div>
      <!-- <div class="modal-footer border-0">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div> -->
    </div>
  </div>
</div>
<style>
    h2#swal2-title {
    padding: 0px 16px !important;
    text-align: center !important;
    order: 2;
}
.swal2-close:focus {
    outline: 0;
    box-shadow: unset;
}
div#swal2-html-container {
    margin: 0px !important;
    padding: 13px 10px;
}

.swal2-popup.swal2-modal.swal2-icon-warning.swal2-show {
    width: 30%;
    padding-top: 13px !important;
    {{-- padding-bottom: 41px !important; --}}
}
</style>
<script>
  function showAlert(message) {
var htmlMessage ='<div><b style="font-weight: 600;font-size: 14pt; color: #7e50a7;">Your Name Is Not Hidden From Your Current Employer!</b><br><p style="margin-top: 22px">Choose "Hide" to keep your name hidden for privacy. You will be able to "Show" all your details to approved employers who request to see your full profile.</span></p><br></div>' ;

    // $("#alertModal").modal("show");
    Swal.fire({
html: htmlMessage,
{{-- title: 'If you would like more privacy, you can select "Hide" to make your name invisible. You will be able to "Show" all your details to approved employers who specifically request to see your full profile.', --}}
{{-- text: 'Your Name Is Not Hidden From Your Current Employer!', --}}
icon: 'warning',
iconHtml: "<img src='{{ asset('assets/fe/images/warning.png') }}'>",
showCancelButton: false,
showConfirmButton: false,
confirmButtonColor: '#7E50A7',
cancelButtonColor: '#4A2D64',
confirmButtonText: 'Yes',
cancelButtonText: 'No',
showCloseButton: true,
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = "{{route('candidatestep6')}}"
} else {
  return false;
}
})
  }
</script>


@push('scripts')
{{-- #86a1rttk7 --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/intlTelInput.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"></script> --}}
    <script>
    $(document).ready(function () {
        let telInput = $("#tellee");

        // initialize
        telInput.intlTelInput({
            initialCountry: 'auto',
            preferredCountries: ['us', 'gb', 'br', 'ru', 'cn', 'es', 'it'],
            autoPlaceholder: 'aggressive',
            nationalMode: false,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/utils.js",
            geoIpLookup: function(callback) {
                fetch('https://ipinfo.io/json', {
                    cache: 'reload'
                }).then(response => {
                    if (response.ok) {
                        return response.json()
                    }
                    throw new Error('Failed: ' + response.status)
                }).then(ipjson => {
                    callback(ipjson.country)
                }).catch(e => {
                    callback('us')
                })
            }
        });

        // Add event listeners for country change and input
        telInput.on("countrychange input", function () {
            clearError();

            if (telInput.intlTelInput("isValidNumber")) {
            $('.formNextBtn').attr('type', 'submit');
            var selectedCountryData = telInput.intlTelInput('getSelectedCountryData');

            // Extract the ISO2 country code and convert it to uppercase
            var countryCode = selectedCountryData.iso2.toUpperCase();

            // Set the selected option in the select with the class .country-name
            var val=$('.country-name option[data-code="' + countryCode + '"]').attr('value');
            {{-- $('.country-name').val(val); --}}
             {{-- @this.set('country', val); --}}

            // Perform your form submission logic here if the number is valid
        } else {
            $('.formNextBtn').attr('type', 'button');
        }

                });

        function clearError() {
            telInput.parents(".form-group").find(".text-danger").remove();
        }

        function displayError(message) {

        }

        $("body").delegate(".formNextBtn", "click", function(e) {
        clearError();
            telInput.parents(".form-group").append('<div class="text-danger" style="">Phone number is invalid</div>');
        })
    })
    </script>

<script>
$("body").delegate("#tellee", "keyup paste", function(e) {
    var currentValue = $(this).val();

    // Remove non-digit characters except the first plus sign and allow one space in between
    var cleanedValue = currentValue.replace(/[^)(+-\d\s]/g, '');

    // Allow only one plus sign at the beginning
    if (cleanedValue.charAt(0) === '+') {
        cleanedValue = '+' + cleanedValue.slice(1).replace(/\+/g, '');
    } else {
        cleanedValue = cleanedValue.replace(/\+/g, '');
    }

    // Remove space at the beginning
    cleanedValue = cleanedValue.replace(/^\s+/g, '');

    // Allow only one space anywhere else in the string
    cleanedValue = cleanedValue.replace(/\s+/g, ' ');

    // Update the input value
    $(this).val(cleanedValue);
});





    //   $(".nxt-btn").click(function(e) {
    //     e.preventDefault();
    //     location.replace('/candidate/position-preferences')
    //   })

    // $(".nxt-btn").click(function(e) {
    //     e.preventDefault();

    // task - 86a1hvpcy
    $('input').on('change, keydown', function(event) {
        $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp; Finish Later');
    });

    $('#saveProfile').on('submit', function(event) {
        console.log('test');
        /* Act on the event */
        $(".text-danger").remove();
        var count = 0;
        $(this)
            .parents(".common-form-outr")
            .find(".gl-frm-outr")
            .each(function() {
                var label = $(this).find("label").text();

                if (label.includes("*")) {
                    if ($(this).find('input ').val() == "") {
                        $(this).find(".form-group").find(".text-danger").remove();
                        $(this).find(".form-group").find("input:first").focus();
                        $(this)
                            .find(".form-group")
                            .append(
                                '<div class="text-danger" style=""> This field is required.</div>'
                            );
                        count++;
                        // return false;
                    }
                }

            });

        if (count > 0) {
            return false;
        }
        var errosCount = $(".text-danger").length;
        if (errosCount < 1) {

            // location.replace('/candidate/position-preferences')
            // window.location.href='{{url("/candidate/position-preferences")}}';
            // return true;

            return false;
        } else {
            $('html, body').animate({
                scrollTop: $("div.text-danger:first").offset().top - 200
            }, 800);
            $(".text-danger").each(function() {
                $(this).parents(".form-group").find("input").focus();
                return false;
            });
        }
        return false;
    });



    {{-- $("body").delegate(".user-name-field", "input", function(e) {
        val = $(this).val();
        $('.user-name').text(val);
        console.log(val)
    }) --}}

    $("body").delegate(".alrt-close", "click", function(e) {
        $('.modal').modal('hide');
    })


    document.addEventListener("livewire:load", () => {
        $("body").delegate(".name-status", "click", function(e) {

            if ($(this).prop('checked')) {
                showAlert();
                val = true;
            } else {
                val = false;
            }
            @this.set('name_status', val)

        })

        /*document.querySelector('#filters-form').onkeypress = function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        }*/
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

                if (v.startsWith("1") && v.length > 1) {
                    v = "+1 " + v.substring(1);
                }

                // Handle formatting for numbers starting with +1
                if (v.startsWith("+1 ")) {
                    v = v.replace("+1 ", ""); // Remove +1 for formatting
                    if (v.length > 0) {
                        v = "+1 " + v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
                    }
                } else {
                    // Handle formatting for numbers without leading +1
                    if (v.length > 6) {
                        v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
                    } else if (v.length > 3) {
                        v = v.replace(/(\d{3})(\d+)/, "$1-$2");
                    }
                }

                // Set the formatted value
                $(this).val(v); // Ensure the value is correctly formatted
            });

});
  document.addEventListener("livewire:load", () => {
    $("body").delegate("#zipcode", "input", function(e) {
        $(this).parents('.form-group').find('.text-danger').remove();
    });
    const zipcodeInput = document.getElementById("zipcode");
    zipcodeInput.addEventListener("keyup", function() {
            {{-- if($(this).val()!=""){
            $('.nxt-btn').attr('disabled',true)
            $('.nxt-btn').val('Loading...',true)
            } --}}
            let inputValue = zipcodeInput.value;
            inputValue = inputValue.replace(/[^0-9]/g, ""); // Remove non-numeric characters

            if (inputValue.length > 9) {
                inputValue = inputValue.substring(0, 9); // Limit to 9 digits
            }

            if (inputValue.length > 5) {
                inputValue = inputValue.substring(0, 5) + "-" + inputValue.substring(5); // Format as ZIP+4
            }

            zipcodeInput.value = inputValue;
        });
        Livewire.hook('message.processed', (message, component) => {
            console.log(Object.keys(component.serverMemo.errors).length);
            if(!Object.keys(component.serverMemo.errors).length) {
                $(".text-danger").remove();
            }

            var errosCount = $(".text-danger").length;
            if (errosCount < 1) {
                // location.replace('/candidate/position-preferences')
                // window.location.href='{{url("/candidate/position-preferences")}}';
                return true;
            } else {
                $('html, body').animate({
                    scrollTop: $("div.text-danger:first").offset().top - 200
                }, 800);
                $(".text-danger").each(function() {
                    $(this).parents(".form-group").find("input").focus();
                    return false;
                });
            }
               {{-- $('.nxt-btn').attr('disabled',false)
               $('.nxt-btn').val('Next',true) --}}
        })
});


      {{-- var leaving = false;

        window.addEventListener('beforeunload', function (event) {
            if (!leaving) {
                event.preventDefault();
                event.returnValue = ''; // Standard for most browsers

                // You can customize the confirmation message here
                var confirmationMessage = '<div><b>Don\'t Leave Yet! We\'ve Can Do It For You!</b><br> <p>  We know that filling out a profile is a chore. So, let us do it for you. Just upload your resume <span class="text-grey"><button id="button" aria-describedby="tooltip">(?)</button></span>, and we will complete your profile and send it to you for approval. Simple and stress-free! <br>Do It For Me! Upload My Resume</p></div><div id="tooltip" role="tooltip">Your uploaded resume won\'t be stored on our servers. We use its information to shape a new profile for you, which you can edit as per your needs</div>';

                // Show a SweetAlert2 confirmation popup
                Swal.fire({
                    html: confirmationMessage,
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
                        leaving = true;
                        // Uncomment the line below to allow leaving the page
                        // window.location.href = 'https://www.google.com'; // Replace with your desired URL
                    }
                });
            }
        }); --}}

        // Function to handle the beforeunload event
        function handleBeforeUnload(event) {
            event.returnValue = ''; // Standard for most browsers
        }

    /* task - 86a23ej3p */
    /* task - 86a2hay0m */
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
 //Add dashes to phone input
    var tele = document.querySelector('#telle');

    tele.addEventListener('keyup', function(e) {
        if (event.key != 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)) {
            tele.value += '-';
        }
    });
</script>


@endpush
