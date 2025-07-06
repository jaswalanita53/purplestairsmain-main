@extends('layouts.app')
@section('content')
@php
$user_type = Session::get('usertype');
if(Session::has('usertype')){
    Session::forget('usertype');
}

if(Session::has('user_type')){
    Session::forget('user_type');
}
@endphp
<div class="login-sec log-h-sec ban-up ban-up2">
    <div class="login-sec-wrap">
        <div class="container">
            <div class="log-wrap" style="background-image: url(assets/fe/images/log-back.png)">
                <div class="login-outr">

                <div class="employerLogin" id="employerLogin">
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <span class="text-purple" style="color:#7e50a7;">
                        <strong>{{ session('error') }}</strong>
                    </span>
                    @endif

                    @error('success')
                    <span class="text-purple" style="color:#7e50a7;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    @error('msg')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <h2 class="mb-4">Hello Employer!</h2>
                    <div class="social-login">
                    <ul>
                        <li>
                        <a href="{{ url('/login/google') }}"
                            ><em><img src="{{asset('assets/fe/images/google.svg')}}" alt="" /></em
                            ><span>Log In With Google</span>
                        </a>
                        </li>
                        <li>
                        <a href="{{ url('/login/azure') }}"
                            ><em><img src="{{asset('assets/fe/images/microsoft.svg')}}" alt="" /></em>
                            <span>Log In With Microsoft</span>
                        </a>
                        </li>
                        <li>
                        <a href="{{ url('/login/linkedin') }}"
                            ><em><img src="{{asset('assets/fe/images/linkdin.svg')}}" alt="" /></em>
                            <span>Log In With Linkedin</span>
                        </a>
                        </li>
                    </ul>
                    </div>

                    <div class="not-acnt">
                    <p>Don’t have an account? <a href="{{route('signupselect')}}">Sign up!</a></p>
                    </div>
                </div>
          <div class="candidateLogin" id="candidateLogin">
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <span class="text-purple" style="color:#7e50a7;">

                        <strong>{{ session('error') }}</strong>
                    </span>
                    @endif

                    @error('success')
                    <span class="text-purple" style="color:#7e50a7;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    @error('msg')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <h2>Hello Candidate!</h2>
                    <form method="POST" action="{{ route('login') }}" id="candidateForm">
                        @csrf
                        <input type="hidden" name="sleep_status" id="sleep_status" value="2">
                        <div class="form-input">
                            <input type="email" placeholder="Email Address" class="form-control email @error('email') is-invalid @enderror" name="email" required value="{{ old('email') }}" autocomplete="email" autofocus />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <!-- <input type="password" placeholder="Password" class="form-control pass" /> -->
                            <div class="form_ipp_passwordd">
                                <input type="password" class="password-field pass_chk form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                                <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="forgot">
                            <label class="check-inn">Remember Me
                                <input type="checkbox" class="open" name="remember" checked {{ old('remember') ? 'checked' : '' }} />
                                <span class="checkmark"></span>
                            </label>
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                        <div class="form-input">
                            <input type="submit" value="Login" class="sub-btn" />
                        </div>
                    </form>
                    <div class="login-txt">
                        <span>Or Login With</span>
                    </div>
                    <div class="social-logo">
                        <ul>
                            <li>
                                <a href="{{ url('/login/google') }}"><img src="{{asset('assets/fe/images/google.svg')}}" alt="" /></a>
                            </li>
                            <li>
                                <a href="{{ url('/login/azure') }}"><img src="{{asset('assets/fe/images/microsoft.svg')}}" alt="" /></a>
                            </li>
                            <li>
                                <a href="{{ url('/login/linkedin') }}"><img src="{{asset('assets/fe/images/linkdin.svg')}}" alt="" /></a>
                            </li>
                        </ul>
                    </div>
                    <div class="not-acnt">
                        <p>Don’t have an account? <a href="{{route('signupselect')}}">Sign up!</a></p>
                    </div>

                     </div>
                      <div class="employ desktop-v2">
                        <div class="toggle-switch-block twb">
                            <span>Are you an Employer?</span>
                            <div class="switch_box box_1">
                                <input type="checkbox" class="switch_1 case_slide_change" data-target="employer/login" {{ $user_type=="employer" ? "checked" : "" }}/>
                            </div>
                            <span>Are you a Candidate?</span>
                        </div>
                    </div>
                    <div class="employ tab-v">
                        <div class="toggle-switch-block twb">
                            <span>Employer?</span>
                            <div class="switch_box box_1">
                               <input type="checkbox" class="switch_1 case_slide_change" data-target="employer/login" {{ $user_type=="employer" ? "checked" : "" }}/>
                            </div>
                            <span>Candidate?</span>
                        </div>
                    </div>
                </div>
                <img src="{{asset('assets/fe/images/log1.png')}}" alt="" class="mobile-v log1">
                <img src="{{asset('assets/fe/images/log2.png')}}" alt="" class="mobile-v log2">

            </div>
        </div>
    </div>
</div>




<script>

// $(document).ready(function () {
    // Initially hide the employerLogin div
    $('#employerLogin').hide();

    // Listen for changes in the checkbox state
    $("body").delegate(".case_slide_change", "change", function(e) {
        var isChecked = $(this).is(':checked');

        $.ajax({
            url: '{{ url('login/set_usertype/') }}/' + isChecked,
            type: 'GET',
            dataType: 'html',
            success: function(res) {
            },
        });

        if (isChecked) {
            $('#employerLogin').show();
            $('#candidateLogin').hide();
        } else {
            $('#employerLogin').hide();
            $('#candidateLogin').show();
        }
    }).trigger('change');
// });

    // task - 86a32nrge
    $('#candidateForm').on('submit', function(event) {
        var _STS_ = $('#sleep_status').val();

        if(_STS_ == 2) {
            $.ajax({
                url: '{{ url('verify_account') }}',
                type: 'POST',
                dataType: 'html',
                processData: false,
                contentType: false,
                data: new FormData($('#candidateForm')[0]),
                success: function(res) {
                    if(res == '1') {
                        $('#sleep_status').val(1);
                        if(confirm('Do you want to reinstate your account?')) {
                            $('#candidateForm').submit();
                        } else {
                            $('#sleep_status').val(2);
                        }
                    } else {
                        $('#sleep_status').val(0);
                        $('#candidateForm').submit();
                    }
                }
            });
            return false;
        }
    });

{{-- window.addEventListener('beforeunload', function () {
     setTimeout(function () {
        $('.case_slide_change').prop('checked', false);
        console.log('emp2');
        }, 500);
     });

    $(".case_slide_change").change(function (e) {
    var item=$(this);
    if (item.is(':checked')) {

            console.log('emp');
              setTimeout(function () {
            window.location.href = item.data("target");
             }, 10)


    }
    e.preventDefault();
  }); --}}

{{--
$(document).ready(function () {
    // Event handler for the checkbox change
    $(".case_slide_change").change(function (e) {
        var item = $(this);
        if (item.is(':checked')) {
            console.log('emp');
            setTimeout(function () {
                window.location.href = item.data("target");
            }, 10);
        }
        e.preventDefault();
    });

    // Listen for the pageshow event
    window.addEventListener('pageshow', function (event) {
        // Check if this is a back button navigation (not a refresh)
        if (event.persisted) {
            // Uncheck the checkboxes
            alert('Hiii');
            $('.case_slide_change').prop('checked', false);
            console.log('Back button clicked');
        }
    });
}); --}}

{{-- $(document).ready(function () {
    // Check if the "back" state is set in history
    window.addEventListener('popstate', function (event) {
        // Check if the "state" object has a "back" property
        if (event.state && event.state.back) {
            // Display an alert when the user comes back
            alert('Welcome back! You returned using the browser\'s back button.');
        }
    });
}); --}}
{{-- history.pushState({ page: 'mypage' }, 'My Page', window.location.href);
window.addEventListener('popstate', function(event) {
    if (event.state && event.state.page === 'mypage') {
        // The `popstate` event was triggered, which can indicate a back button click.
        // You can handle your JavaScript logic here.
        console.log('Back button may have been clicked');
        // Trigger your custom event or perform other actions.
    }
}); --}}

</script>
@endsection
