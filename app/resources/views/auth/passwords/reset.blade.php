@extends('layouts.app')
@section('content')
<div class="login-sec pt-4 log-h-sec ban-up ban-up3 ht_center_div">
    <div class="login-sec-wrap">
      <div class="container">
        <div
          class="log-wrap"
          style="background-image: url(images/log-back.png)"
        >
          <div class="login-outr">
            <h2>{{ __('Reset Password') }}</h2>
            <p>
              Your new password must be different from previously used
              passwords.
            </p>
            <form class="mt-4" method="POST" action="{{ route('password.update') }}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="form-input">
                <input
                  type="email"
                  placeholder="Email Address"
                  class="form-control email"
                  @error('email') is-invalid @enderror
                  name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                />
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-input">
                <input
                  type="password"
                  placeholder="Password"
                  class="password-field form-control pass @error('password') is-invalid @enderror"
                  name="password" required autocomplete="new-password"
                />
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <p class="text-start noti-txt">Must be at lease 8 characters</p>
              <div class="form-input">
                <input
                  type="password"
                  placeholder="Confirm Password"
                  class="password-field form-control"
                  name="password_confirmation" required autocomplete="new-password"
                />
              </div>
              <p class="text-start noti-txt">Both password must match.</p>

              <div class="form-input">
                <input type="submit" value="Reset Password" class="sub-btn" />
              </div>
            </form>
          </div>
          <img src="images/log1.png" alt="" class="mobile-v log1">
          <img src="images/log2.png" alt="" class="mobile-v log2">
        </div>
      </div>
    </div>
  </div>
@endsection
