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

                        <form  method="POST" action="{{ url('no-sso-employers') }}">
                            @csrf
                            {{-- <input type="hidden" value="candidate" name="user_type">
                            {{-- identify human OR robot --}
                            <div class="form-input honeypot_field">
                                <input type="text" name="honeypot_value" value="" />
                            </div> --}}
                            @php
                                $session_email = null;
                                if(session('employer_email')) {
                                    $session_email = session('employer_email');
                                }
                            @endphp
                            <div class="form-input">
                                <input
                                  type="text"
                                  placeholder="Email"
                                  class="form-control email"
                                  name="email"
                                  value="{{ old('email', $session_email) }}" required autocomplete="email" autofocus {{ $session_email ? 'readonly' : '' }}
                                />
                                @include('inc.error', [
                                    'field_name' => 'email',
                                ])
                            </div>

                            @if (session('employer_email') && session('allow_otp'))
                                <div class="form-input">
                                    <div class="form_ipp_passwordd">
                                        <input type="password" class=" password-field pass_chk form-control" placeholder="Password" name="password" required autocomplete="new-password">
                                        <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                                    </div>
                                    @include('inc.error', [
                                        'field_name' => 'password',
                                    ])
                                </div>

                                <div class="form-input">
                                    <input
                                      type="text"
                                      placeholder="OTP"
                                      class="form-control otp"
                                      name="otp"
                                      value="{{ old('otp') }}" required autocomplete="otp" autofocus
                                    />
                                </div>
                            @endif

                            <div class="form-input">
                                @if (session('employer_email') && session('allow_otp'))
                                    <input type="submit" value="Sign Up" class="sub-btn" />
                                @else
                                    <input type="submit" value="Send OTP" class="sub-btn" />
                                @endif
                            </div>
                        </form>
                    </div>
                    <img src="{{asset('assets/fe/images/log1.png')}}" alt="" class="mobile-v log1">
                    <img src="{{asset('assets/fe/images/log2.png')}}" alt="" class="mobile-v log2">
                </div>
            </div>
        </div>
    </div>
</div>




<script>

// $(document).ready(function () {
    // Initially hide the employerLogin div
    // $('#employerLogin').hide();
// });

</script>
@endsection
