@extends('layouts.app')
@section('content')
{{-- @livewire('keep-active-cron') --}}
<div>
    <div class="login-sec log-h-sec pt-4 ban-up ban-up3 ht_center_div">
        <div class="login-sec-wrap">
          <div class="container">
            <div>
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div
              class="log-wrap lg-wrp2"
              style="background-image: url(/assets/fe/images/log-back.png)"
            >
              <div class="login-outr del-outr">
                <h2>Keep My Account Active</h2>
                <!-- <p>Sleep mode will make your profile invisible. You may wake up your account at any time.?</p> -->
                <p>These will notify you to keep your profile up to date.</p>
                <form method="POST">
                  @csrf
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                  <div class="form-input">
                    <input
                      type="submit"
                      value="Keep Me Active"
                      class="sub-btn"
                    />
                  </div>
                </form>
              </div>
              <img src="{{asset('assets/fe/images/log1.png')}}" alt="" class="mobile-v log1 log12">
              <img src="{{asset('assets/fe/images/log2.png')}}" alt="" class="mobile-v log2">
            </div>
          </div>
        </div>
      </div>
</div>

@endsection
