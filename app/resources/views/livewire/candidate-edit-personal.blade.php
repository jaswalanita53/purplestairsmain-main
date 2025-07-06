<div>
<style >
.remove-avata-hidden{
            display: none;
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
        {{-- #86a1rttk7 --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/css/intlTelInput.css">
    <section class="main-form-sec back-clr main-form2 cmn-gap pb-0 ban-up ban-up3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb edit-personal justify-content-center justify-content-md-start">
                    <li class="active mb-2 mb-md-0" aria-current="page">Edit Personal Information</li>
                    <li class=" mb-2 mb-md-0"><a href="{{route("candidates.editpreferences")}}">Edit Position Preferences</a></li>
                    <li class=" mb-2 mb-md-0"><a href="{{route("candidates.editresume")}}">Edit Resume Information</a></li>

                </ol>
            </nav>
            <div class="sec-hdr mb-4 mb-md-5 d-flex align-items-center justify-content-between">
                <h2 class="mb-0">Edit Personal Information</h2>
                <div class="profile-btn ms-btn text-nowrap">
                    @if(Auth::user()->current_step==9)
                    <a href="{{route("candidatestep9")}}" class="px-3 px-md-5"> Preview Profile</a>
                    @else
                        {{-- task - 86a0jby08 --}}
                        {{-- <a href="{{route("candidateProfile")}}" wire:click="validateProfile()"> View Profile</a> --}}
                        <a href="javascript:;" wire:click="validateProfile()" class="px-3 px-md-5"> View Profile</a>
                    @endif

                </div>
            </div>

            <div class="cmn-form">
                <div class="cmn-head">
                    <h5>Personal Information</h5>
                    {{-- task - 86a0hxg00 @include('inc.autoSaveLoader') --}}
                </div>

                {{-- task - 86a0hxg00 --}}
                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif

                @if (session('error'))
                <span class="alert alert-danger">

                    <strong>{{ session('error') }}</strong>
                </span>
                @endif
                {{-- task - 86a0hxg00 end --}}

                <div class="form-sec gl-form-">
                    <form wire:submit.prevent="savePersonal()" id="savePersonal">
                        <div class="row form-sec gl-form">
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Name*</label>
                                    <div class="form-group disable-form- mb-0">
                                        <input type="text" placeholder="" class="form-control user-name-field" wire:model.lazy="name" />
                                        @include('inc.error', [
                                        'field_name' => 'name',
                                        ])
                                        @if($name_status)
                                            <span class="visibility-alert m-0"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                                            @endif
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="name_status" tabindex="-1" data-value="{{$name_status}}"/>

                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $name_status ? '' : 'show' }}">
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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Email*</label>
                                    <div class="form-group disable-form- mb-0">
                                        <input type="email" placeholder="" class="form-control readonly-email" wire:model.lazy="email" readonly />
                                        @if($email_status)
                                            <span class="visibility-alert m-0"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                                            @endif
                                        @include('inc.error', [
                                        'field_name' => 'email',
                                        ])
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="email_status" tabindex="-1" data-value="{{$email_status}}"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $email_status ? '' : 'show' }}">
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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Phone*</label>
                                    <div class="form-group disable-form- mb-0">
                                        @if($user_country=='US')
                                            <input type="tel" placeholder="xxx-xxx-xxxx" id="telle" maxlength="14" class="form-control" wire:model.defer="phone" />
                                            @else
                                            <input type="tel" placeholder="" id="tellee" maxlength="16" class="form-control" wire:model.defer="phone" />
                                            @endif
                                        @if($phone_status)
                                            <span class="visibility-alert m-0"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                                            @endif
                                        @include('inc.error', [
                                        'field_name' => 'phone',
                                        ])
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="phone_status" tabindex="-1" data-value="{{$phone_status}}"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $phone_status ? '' : 'show' }}">
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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Current Position/Title*</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.lazy="current_title" />
                                        @include('inc.error', [
                                        'field_name' => 'current_title',
                                        ])
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="current_title_status" tabindex="-1" data-value="{{$current_title_status}}"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $current_title_status ? '' : 'show' }}">
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

                            </div>
                             @if ($user_country == 'US')
                            <div class="col-lg-6">
                                {{-- task - 86a0xw1z1 disabled --}}

                                <div class="gl-frm-outr mb-2">
                                    <label>Zip code* (Center of Work Radius)</label>
                                    <div class="form-group mb-0 disable-form">
                                        <input type="text" placeholder="" class="form-control zip_code_field-" wire:model.lazy="zip_code" id="zipcode" maxlength="10"/>
                                        @if($zip_code_status)
                                            <span class="visibility-alert m-0"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                                            @endif
                                        @include('inc.error', [
                                        'field_name' => 'zip_code',
                                        ])
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="zip_code_status" tabindex="-1"  data-value="{{$zip_code_status}}"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
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


                            </div>
                            @else
                            <div class="col-lg-6">
                            <div class="gl-frm-outr mb-3">
                        <label>Country*</label>
                        <div class="disable-form- form-group">
                            {{-- task 86a1j9na7 --}}
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
                                    <input type="checkbox" class="switch_1"  wire:model.lazy="country_name_status" tabindex="-1" data-value="{{$country_name_status}}"/>
                                </div>
                                <span>Hide</span>
                            </div>
                            @if($country_name_status)
                            <span class="visibility-alert m-0"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
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
                    </div>
                             @endif
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Linkedin URL</label>
                                    <div class="form-group disable-form- mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.lazy="linkedin_url" />
                                        @include('inc.error', [
                                        'field_name' => 'linkedin_url',
                                        ])
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="linkedin_url_status" tabindex="-1" data-value="{{$linkedin_url_status}}"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $linkedin_url_status ? '' : 'show' }}">
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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Additional URL or Portfolio Link</label>
                                    <div class="form-group disable-form- mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.lazy="additional_url" />
                                        @include('inc.error', [
                                        'field_name' => 'additional_url',
                                        ])
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="additional_url_status" tabindex="-1" data-value="{{$additional_url_status}}"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $additional_url_status ? '' : 'show' }}">
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

                            </div>
                            <div class="form-submit-btn mb-0">
                                    <input type="submit" value="Save" class="submit-btn formNextBtn" wire:loading.remove wire:target="savePersonal"/>
                                    <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="savePersonal">
                                </div>
                        </div>
                        <div class="cmn-form row mt-4">
                            <div class="cmn-head">
                                <h5>More About Me</h5>
                            </div>
                            <div class="form-sec gl-form">
                                <div class="row align-items-baseline ">

                                    <div class="col-lg-2 col-md-3 info-error">
                                        {{-- task - 86a0xw1z1 disabled --}}
                                        <div class="form-group f-up new_uploaded_frm disable-form">
                                            <div class="upload-wrp" wire:loading.remove wire:target="profile">

                                                @if (!empty(Auth::user()->profile_photo_path))
                                                <a href="javascript:void(0)">
                                                    {{-- 86a2ymdej --}}
                                                   @if(!$profile_status)
                                                    <img src="{{ asset('/assets/be/images/masked_ic.png') }}"  id="preview" alt="masked_ic" style="border-radius:50%; width:100px !important; height:100px !important;" width="70%" />
                                                    @else
                                                    <img src="{{asset(Auth::user()->profile_photo_path)}}"  id="preview" alt="picture" style="border-radius:50%; width:100px !important; height:100px !important;" />
                                                    @endif

                                                </a>
                                                <span class="remove-avatar" wire:click.stop="removeAvatar()"><img src="{{asset('assets/fe/images/del2.svg')}}" class="del-pic" alt="" /></span>
                                                @else
                                                @if(!$profile_status)
                                                    <img src="{{ asset('/assets/be/images/masked_ic.png') }}"  id="preview" alt="masked_ic" style="border-radius:50%; width:100px !important; height:100px !important;" width="70%" />
                                                    @else
                                                    <a href="javascript:void(0)"><img src="{{asset('assets/fe/images/up-photo.png')}}" id="preview"alt="" style="border-radius:50%; width:100px !important; height:100px !important;" width="70%"/></a>
                                                    @endif

                                                <img src="{{asset('assets/fe/images/up-plus.png')}}" alt="" class="up-plus" />
                                                 <span class="remove-avatar remove-avata-hidden" wire:click.stop="removeAvatar()"><img src="{{asset('assets/fe/images/del2.svg')}}" class="del-pic" alt="" /></span>
                                                @endif

                                            </div>
                                            <div class="upload-wrp" wire:loading wire:target="profile">

                                              <img src="{{ asset('/assets/be/images/loading.gif') }}"  id="preview" alt="masked_ic" style="border-radius:50%; width:100px !important; height:100px !important;" width="70%" />

                                            </div>

                                            <!-- <h5>Upload Photo</h5> -->
                                            <a href="javascript:void(0)" class="upload_btn nw_upldd">


                                                @if (Auth::user()->profile_photo_path)
                                                <input type="file" wire:model="profile" class="change-photo"> Replace Photo
                                                @else
                                                <input type="file" wire:model="profile" class="change-photo"> Upload Photo (Please upload JPG/PNG format. Maximum size must be 1MB)
                                                @endif

                                            </a>

                                            <div class="toggle-switch-block" style="right: 0;top: 0; position: relative; background: none;">
                                                <span>show</span>
                                                <div class="switch_box box_1">
                                                    <input type="checkbox" class="switch_1 profile_status " data-value="{{$profile_status}}" {{ $profile_status ? 'checked' : '' }} wire:model.lazy="profile_status" />
                                                </div>
                                                <span>Hide</span>
                                            </div>
                                            @if($profile_status)
                                            <span class="visibility-alert m-0"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                                            @endif
                                            <div class="hiden {{ $profile_status ? '' : 'show' }}">
                                                <div class="d-span">
                                                    <img src="{{asset('assets/fe/images/hidden.svg')}}" alt="" />Hidden to everyone

                                                    <div class="in-ap">
                                                        <p>
                                                            This information will only be unmasked to a Requesting
                                                            company <strong>upon your approval.</strong>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- @include('inc.error', [
                                        'field_name' => 'profile',
                                        ]) --}}
                                        @if(session('profile-error'))
                                            <div class="text-danger error" >
                                            {{ session('profile-error') }}
                                            </div>
                                        @endif

                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <div class="gl-frm-outr mb-0">
                                            <label>Short Bio</label>
                                            {{-- disable-form- --}}
                                            <div class="form-group mb-0">
                                                <input type="text" placeholder="" class="form-control" wire:model="short_bio" />
                                                <div class="toggle-switch-block">
                                                    <span>show</span>
                                                    <div class="switch_box box_1">
                                                        <input type="checkbox" class="switch_1" wire:model="short_bio_status" {{ $short_bio_status ? 'checked' : '' }} data-value="{{ $short_bio_status }}" />
                                                    </div>
                                                    <span>Hide</span>
                                                </div>
                                                @if($short_bio_status)
                                            <span class="visibility-alert m-0"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                                            @endif
                                                <div class="hiden {{ $short_bio_status ? '' : 'show' }}">
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

                                    </div>
                                </div>

                                <div class="form-submit-btn mb-0" >
                                    <span wire:loading.remove wire:target="profile">
                                    <input type="submit" value="Save" class="submit-btn formNextBtn" wire:loading.remove wire:target="savePersonal"/>
                                    <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="savePersonal">
                                    </span>
                                    <span wire:loading wire:target="profile">
                                    <input type="button" value="Uploading..." class="submit-btn"/>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="cmn-form-btm">
                <!-- <div class="ftr-btm-lft">
                    <p>© 2024 Purple Stairs</p>
                    <span>Website by <a href="https://www.brand-right.com/" target="_blank"> BrandRight Marketing Group</a></span>
                </div> -->
            </div>
        </div>
    </section>
</div>
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
                $('.formNextBtn').attr('type','submit');
                var selectedCountryData = telInput.intlTelInput('getSelectedCountryData');

                var countryCode = selectedCountryData.iso2.toUpperCase();

                var val=$('.country-name option[data-code="' + countryCode + '"]').attr('value');
            {{-- $('.country-name').val(val); --}}
             {{-- @this.set('country', val); --}}
                // Perform your form submission logic here if the number is valid
            } else {
                $('.formNextBtn').attr('type','button');
            }
        });

        function clearError() {
            telInput.parents(".form-group").find(".text-danger").remove();
        }

        function displayError(message) {

        }

        $("body").delegate(".formNextBtn", "click", function(e) {
        clearError();
        if (telInput.intlTelInput("isValidNumber")) {

            } else {
                 telInput.parents(".form-group").append('<div class="text-danger" style="">Phone number is invalid</div>');
            }

        })
    })
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
    </script>

<script>
    // task - 86a1krdtg
    var original_avatar = '{{url("/")}}/{{ Auth::user()->profile_photo_path }}';
    var pr_status = '{{ $profile_status }}';
    var no_img = '{{ asset('assets/fe/images/profile-pic.png') }}';
    var mask_img = '{{ asset('/assets/be/images/masked_ic.png') }}';

    {{-- $('.upload-wrp').on('mouseover', function(event) {
      if(original_avatar && pr_status==0) {
        $('.upload-wrp #preview').attr('src', original_avatar);
      } else if(original_avatar == "" && pr_status==0) {
        $('.upload-wrp #preview').attr('src', no_img);
      }
    });

    $('.upload-wrp').on('mouseout', function(event) {
      if(pr_status==0) {
        $('.upload-wrp #preview').attr('src', mask_img);
      }
    }); --}}
    // task - 86a1krdtg end

    // task - 86a0jby08
    function validatePage() {
        $('html, body').animate({
            scrollTop: $("div.error:first").offset().top - 200
          }, 500);
          return false;
    }
    // task - 86a0jby08 end

    window.addEventListener('page-load', event => {
        location.reload();
    });


    document.addEventListener("livewire:load", () => {


triggerSwitch();
})
    // task - 86a0fxn2y
    /*$('.submit-btn').click(function(event) {
        $('html, body').animate({
            scrollTop: $("div.cmn-head:first").offset().top - 200
        }, 500);
    });*/
    // task - 86a0fxn2y end

    // Reload component every 2 seconds
    document.addEventListener("livewire:load", () => {
        // task - 86a0pwt5m
        Livewire.hook('message.processed', (message, component) => {
            console.log('hook loads...');
            setTimeout(() => {
                if($("div.text-danger:first").length) {
                    $('html, body').animate({
                        scrollTop: $("div.text-danger:first").offset().top - 200
                    }, 500);
                }
            }, 250);
        });
        // task - 86a0pwt5m end



 var mask_img = "{{ asset('/assets/be/images/masked_ic.png') }}";

// Use jQuery event delegation for dynamically added elements


// You can remove the commented-out code if it's not needed
// document.querySelectorAll('.switch_1').forEach(function(el, i) {
//     if ($(el).attr('data-value') == 1) {
//         $(el).parents(".toggle-switch-block").next().removeClass("show");
//         $(el).prop('checked', true);
//     } else {
//         $(el).parents(".toggle-switch-block").next().addClass("show");
//         $(el).prop('checked', false);
//     }
// });



    });



    // task - 8678eggpf
    var mask_img = "{{asset('/assets/be/images/masked_ic.png')}}";
    window.addEventListener('temp-update-avatar', event => {
        if($('.profile_status').is(':checked')===false) {
            if(event.detail.newPath!=null){
            $('.upload-wrp').find('a').find('img').attr('src', '{{asset('')}}' + event.detail.newPath);
        }else{
            $('.upload-wrp').find('a').find('img').attr('src', '{{asset("/assets/fe/images/up-photo.png")}}');
        }
            setTimeout(() => {
                $('.upload-wrp').find('a').find('img').attr('src', mask_img);
        }, 500);

        }else{

           if(event.detail.newPath!=null){
            $('.upload-wrp').find('a').find('img').attr('src', '{{asset('')}}' + event.detail.newPath);
        }else{
            $('.upload-wrp').find('a').find('img').attr('src', '{{asset("/assets/fe/images/up-photo.png")}}');
        }
        }
        setTimeout(() => {
            var src = $('.upload-wrp').find('a').find('img').attr('src');
            $('.avatar-img').find('img').attr('src', src);
        }, 1000);


        // setTimeout(() => {
        //           var _status = '{{ $profile_status }}';
        //           if(_status == '0') {
        //             $('.avatar-img').find('img').attr('src', mask_img);
        //             $('.upload-wrp').find('a').find('img').attr('src', mask_img);
        //           }
        //       }, 2000);
    });

   {{-- window.addEventListener('update-avatar', event => {
    $('.change-photo').val('');

   setTimeout(() => {
          $('#preview').attr('src',"{{ url('/assets/fe/images/up-photo.png') }}");
          $('.remove-avata-hidden').hide();
        }, 1000);

    }); --}}

    $("body").delegate(".upload-wrp", "click", function(e) {
        $('.change-photo').trigger('click')
    })

    function triggerSwitch() {
                $('.switch_1').each(function(index, el) {
                    console.log($(el), $(el).attr('data-value'));
                    if ($(el).attr('data-value') == 1) {
                        $(el).parents(".toggle-switch-block").next().removeClass("show");
                        $(el).prop('checked', true);
                    } else {
                        $(el).parents(".toggle-switch-block").next().addClass("show");
                        $(el).prop('checked', false);
                    }
                });
            }
    window.addEventListener('load-switches', event => {

                document.querySelectorAll('.switch_1').forEach(function(el,i){
                    if ($(el).attr('data-value') == 1) {
                        $(el).parents(".toggle-switch-block").next().removeClass("show");
                        $(el).prop('checked', true);
                    } else {
                        $(el).parents(".toggle-switch-block").next().addClass("show");
                        $(el).prop('checked', false);
                    }
                });

            });

            document.addEventListener("livewire:load", () => {
                $("body").delegate("#zipcode", "input", function(e) {
                    $(this).parents('.form-group').find('.text-danger').remove();
                });

                const zipcodeInput = document.getElementById("zipcode");

                zipcodeInput.addEventListener("keyup", function() {
                    if ($(this).val() != "") {
                        $('.nxt-btn').attr('disabled', true);
                        $('.nxt-btn').val('Loading...', true);
                    }

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
                    $('.nxt-btn').attr('disabled', false);
                    $('.nxt-btn').val('Next', true);
                });
            });


            document.addEventListener("livewire:load", () => {
                var file;
    var preview ;
    var errorMessage  ;
    var errorMessageSize ;
    $("body").on("change", ".change-photo", function (e) {
     file = this.files[0];
     preview = $('#preview');
     errorMessage = $('<div class="text-danger error file-error">File must be an image with one of the allowed extensions: jpg, png, jpeg</div>');
     errorMessageSize = $('<div class="text-danger error file-error"> File must be less than or equal to 1 MB in size</div>');

    // Reset any previous error messages
    $('.text-danger').remove();
    $('.remove-avata-hidden').hide();


        });

                Livewire.hook('message.processed', (message, component) => {
                    if (file) {
                if (file.type.match(/^image\/(jpeg|png)$/)) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var image = $(preview).attr('src', e.target.result);
                        original_avatar = e.target.result;
                        $('.remove-avata-hidden').show();
                    };

                    var fileSizeInBytes = file.size;
                    var fileSizeInMB = fileSizeInBytes / (1024 * 1024); // Convert to MB

                    if (fileSizeInMB > 1) {
                        $('.change-photo').val('');
                        setTimeout(function () {
                            $('.info-error').append(errorMessageSize);
                        }, 300);
                    } else {
                        reader.readAsDataURL(file);
                    }
                } else {
                    // If it's not an image, display the error message
                    $('.change-photo').val('');
                    setTimeout(function () {
                        $('.info-error').append(errorMessage);
                    }, 300);
                }
            }
                });
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
        {{-- $(document).ready(function(){
             $('.upload-wrp').find('#preview').attr('src',mask_img);
        }); --}}
        window.addEventListener('livewire-upload-finish', event => {
            var mask_img_ = "{{asset('/assets/be/images/masked_ic.png')}}";
            setTimeout(() => {
                // task - 86a1tzdqv - POINT - 7
                // var src = $('.upload-wrp').find('#preview').attr('src',mask_img_);
                var _status = @this.get('profile_status');
                if(!_status) {
                  {{-- $('.avatar-img').find('img').attr('src', mask_img); --}}
                  {{-- $('.upload-wrp').find('#preview').attr('src',mask_img_); --}}
                }
                // task - 86a1tzdqv - POINT - 7 end
            }, 1000);
        })

</script>
