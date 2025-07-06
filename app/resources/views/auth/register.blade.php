@extends('layouts.app')

@section('content')
@php
if(Session::has('user_type')){
    Session::forget('user_type');
}
@endphp
{{-- @if (request()->usr_type == 'i-am-a-candidate') --}}
<div class="login-sec sign-up log-h-sec ban-up ban-up2">
  <style type="text/css">
    .honeypot_field { height: 0; opacity: 0; position: absolute; left: -2000px; }
  </style>
    <div class="login-sec-wrap">
      <div class="container">
        <div
          class="log-wrap"
          style="background-image: url(assets/fe/images/log-back.png)"
        >
          <div class="login-outr">
           @if (session('error'))
                    <span class="text-purple mb-4" style="color:#7e50a7;">

                        <strong>{{ session('error') }}</strong>
                    </span>
                    @endif
            <h2>Hello Candidate!</h2>

           <p class="blk-p mb-3">Create Account</p>

            <form  method="POST" action="{{ route('register') }}">
              @csrf
              <input type="hidden" value="candidate" name="user_type">
              {{-- identify human OR robot --}}
              <div class="form-input honeypot_field">
                <input type="text" name="honeypot_value" value="" />
              </div>
              <div class="form-input">
                <input
                  type="text"
                  placeholder="Name"
                  class="form-control name"
                  name="name"
                  value="{{ old('name') }}" required autocomplete="name" autofocus
                />
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-input">
                <input
                  type="email"
                  placeholder="Email Address"
                  class="form-control email"
                  name="email"
                  value="{{ old('email') }}" required autocomplete="email"
                />
                @include('inc.error', [
                    'field_name' => 'email',
                  ])
              </div>
              <div class="form-input">
                  <div class="form_ipp_passwordd">
                      <input type="password" class=" password-field pass_chk form-control" placeholder="Password" name="password" required autocomplete="new-password">
                      <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                  </div>
                      @include('inc.error', [
                        'field_name' => 'password',
                      ])
              </div>
              {{-- task - 8678egn9b <div class="form-input">
                  <div class="form_ipp_passwordd">
                      <input type="password" class="pass_chk form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                      <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                  </div>
              </div> --}}

              <div class="forgot">
                <label class="check-inn"
                  >Remember Me
                  <input type="checkbox" class="open" />
                  <span class="checkmark"></span>
                </label>
                <!-- <a href="#">Forgot Password?</a> -->
              </div>
              <div class="form-input">
                <input type="submit" value="Sign Up" class="sub-btn" />
              </div>
            </form>
            <div class="login-txt">
              <span>Or Sign Up With</span>
            </div>
            <div class="social-logo">
              <ul>
                <li>
                  <a href="{{ url('/login/google') }}"><img src="{{asset("assets/fe/images/google.svg")}}" alt="" /></a>
                </li>
                <li>
                  <a href="{{ url('/login/azure') }}"><img src="{{asset("assets/fe/images/microsoft.svg")}}" alt="" /></a>
                </li>
                <li>
                  <a href="{{ url('/login/linkedin') }}"><img src="{{asset("assets/fe/images/linkdin.svg")}}" alt="" /></a>
                </li>
              </ul>
            </div>
            <div class="not-acnt">
              <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
            </div>
            <div class="employ desktop-v2">
              <div class="toggle-switch-block twb">
                <span>Are you an Employer?</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1 case_slide_change" data-target="employer/login" />
                </div>
                <span>Are you a Candidate?</span>
              </div>
            </div>
            <div class="employ tab-v">
              <div class="toggle-switch-block twb">
                <span>Employer?</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1 case_slide_change" data-target="employer/login" />
                </div>
                <span>Candidate?</span>
              </div>
            </div>
          </div>
          <img src="{{asset("assets/fe/images/log1.png")}}" alt="" class="mobile-v log1">
          <img src="{{asset("assets/fe/images/log2.png")}}" alt="" class="mobile-v log2">
        </div>
      </div>
    </div>
  </div>
{{-- @endif --}}
@endsection
