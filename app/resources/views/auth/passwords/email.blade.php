@extends('layouts.app')

@section('content')

<div class="login-sec pt-4 log-h-sec ban-up ban-up3 ht_center_div">
    <div class="login-sec-wrap">
      <div class="container">
        <div
          class="log-wrap lg-wrp2"
          style="background-image: url({{asset('assets/fe/images/lg-back.png')}})"
        >
          <div class="login-outr">
            <h2>Reset Password</h2>
            <p>
              Enter the email associated with your account and we’ll send an
              email with instructions to reset your password.
            </p>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="form-input mt-4">
                <input
                  type="email"
                  placeholder="Email Address"
                  class="form-control email"
                  @error('email') is-invalid @enderror
                  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                />
                {{-- task - 86a0hxhat --}}
                @error('email')
                <span class="invalid-feedback d-flex" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-input">
                <input type="submit" value="{{ __('Send Password Reset Link') }}" class="sub-btn" />
              </div>
            </form>
          </div>
          <img src="{{asset('assets/fe/images/log1.png')}}" alt="" class="mobile-v log1 log12">
          <img src="{{asset('assets/fe/images/log2.png')}}" alt="" class="mobile-v log2">
        </div>
      </div>
    </div>
  </div>
@endsection
