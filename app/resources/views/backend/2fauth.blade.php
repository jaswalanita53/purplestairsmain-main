@extends('layouts.backendLogin')

@section('content')
  <!-- /.login-logo -->
  <div class="login-box-body">

    <p class="login-box-msg">{{ __('Two factore authentication') }}</p>

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

    <form action="{{ url('/admin/2fa') }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="text" id="tfa_code" class="form-control @error('tfa_code') is-invalid @enderror" placeholder="{{ __('Two Factore Code') }}" name="tfa_code" value="{{ old('tfa_code') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('tfa_code')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Sign In') }}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
@endsection
