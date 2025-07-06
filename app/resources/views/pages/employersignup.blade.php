@extends('layouts.app')
@section('content')
<div class="login-sec sign-up back-clr log-h-sec ban-up">
    <div class="login-sec-wrap">
      <div class="container">
        <div
          class="log-wrap lg-wrp2"
          style="background-image: url(/assets/fe/images/log-back2.png)"
        >
          <div class="login-outr congo">
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
                    ><span>Sign Up With Google</span>
                  </a>
                </li>
                <li>
                  <a href="{{ url('/login/azure') }}"
                    ><em><img src="{{asset('assets/fe/images/microsoft.svg')}}" alt="" /></em>
                    <span>Sign Up With Microsoft</span>
                  </a>
                </li>
                <li>
                  <a href="{{ url('/login/linkedin') }}"
                    ><em><img src="{{asset('assets/fe/images/linkdin.svg')}}" alt="" /></em>
                    <span>Sign Up With Linkedin</span>
                  </a>
                </li>
              </ul>
            </div>

            <div class="not-acnt">
              <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
            </div>
          </div>
          <img src="{{asset('assets/fe/images/log1.png')}}" alt="" class="mobile-v log1 log12">
          <img src="{{asset('assets/fe/images/log2.png')}}" alt="" class="mobile-v log2">
        </div>
      </div>
    </div>
  </div>
@endsection
