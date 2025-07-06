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
                <h2>Put Account To Sleep</h2>
                <!-- <p>Sleep mode will make your profile invisible. You may wake up your account at any time.?</p> -->
                <p>Sleep mode will make your profile invisible. You may wake up your account at any time. Why are you snoozing?</p>
                <form method="POST">

                  @csrf
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                  <div class="form-input">
                    <select class="form-select" name="reason">
                      <option>Trouble getting started</option>
                      <option>I found a position with Purple Stairs</option>
                      <option>I found a position on my own</option>
                      <option>I want privacy but am still looking</option>
                      <option>I did not like your platform</option>
                    </select>
                  </div>
                  @if($reason == 'I did not like your platform')
                  <div class="form-input">
                    <input
                      type="text"
                      placeholder="What did you not like about Purple Stairs?"
                      class="form-control"
                      name="other"
                    />
                  </div>
                  @endif

                  @if($user->password != '')
                  <div class="form-input">
                    <div class="form_ipp_passwordd">
                      <input type="password" class="pass_chk form-control" placeholder="To continue please enter account password." >
                      <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                    </div>
                  </div>
                  @endif

                  <div class="form-input">
                    <input
                      type="submit"
                      value="Temporarily Sleep Account"
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
