@extends('layouts.app')
@section('content')
    <div class="login-sec pt-4 log-h-sec ban-up ban-up3 ht_center_div">
        <div class="login-sec-wrap">
            <div class="container">

                <div class="log-wrap lg-wrp2" style="background-image: url({{ asset('assets/fe/images/log-back.png') }}">
                    <div class="login-outr">
                    @if (session('error'))
                        <p class="text-danger" role="alert">
                            {{ session('error') }}
                        </p>
                    @endif
                        <figure class="reset-fig">
                            <img src="{{ asset('assets/fe/images/email-pic.svg') }}" alt="" />
                        </figure>
                        <h2>{{ __('Verify Your Email Address') }}</h2>
                        <p>
                        {{-- {{ dd(session('resent')) }} --}}
                            @if (session('resent'))
                                <div class="alert" role="alert" style="color:#7e50a7;">
                                   A new verification link has been sent to your email address
                                 </div>
                            @endif
                        </p>

                        <div class="form-input">
                            {{ __('Please check your email for a verification link.') }}
                             @if(!empty(Auth::user()->email))
                                <span class="table-o-c" style="font-size: 14px;color:var(--purple)"> {{ Auth::user()->email }}</span>
                            @endif
                            <!-- {{ __('If you did not receive the email') }}, -->
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                @if(!session('error'))
                                  <input type="submit" value="{{ __('Resend') }} in 01:00" class="sub-btn" id="resend-btn" disabled />
                                  @else
                                  <input type="submit" value="{{ __('Click Here To Resend') }}" class="sub-btn"  />
                                  @endif
                            </form>
                        </div>

                    </div>
                    <img src="{{ asset('assets/fe/images/log1.png') }}" alt="" class="mobile-v log1 log12">
                    <img src="{{ asset('assets/fe/images/log2.png') }}" alt="" class="mobile-v log2">
                </div>
            </div>
        </div>

    </div>
     <script>
        function startCountdown(duration, button) {
            let timer = duration, minutes, seconds;
            const interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                button.value = `{{ __('Resend') }} in ${minutes}:${seconds}`;

                if (--timer < 0) {
                    clearInterval(interval);
                    button.disabled = false;
                    button.value = "{{ __('Click Here To Resend') }}";
                }
            }, 1000);
        }

        window.onload = function () {
            const resendButton = document.getElementById('resend-btn');
            const oneMinute = 60; // 1 minute in seconds
            startCountdown(oneMinute, resendButton);
        };
    </script>
@endsection
