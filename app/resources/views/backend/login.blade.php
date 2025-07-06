@extends('layouts.backendLogin')

@section('content')
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>

    {{-- task - 86a1kxrnw --}}
    @error('msg')
    <p class="text-red text-center"> <strong>{{ $message }}</strong> </p>
    @enderror

    @if (session('error'))
    <span class="text-red text-center">
        <strong>{{ session('error') }}</strong>
    </span>
    @endif
    {{-- end task - 86a1kxrnw --}}

    <form action="{{ route('admin.login') }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input id="password" type="password" class="password-field form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" name="password" required autocomplete="current-password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">

          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Sign In') }}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <div class="social-auth-links text-center">
      <p>- OR -</p>
<br>
<a href="{{url('/')}}">
      {{ __('Back To Purple Stairs') }}
    </a>
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
@endsection
