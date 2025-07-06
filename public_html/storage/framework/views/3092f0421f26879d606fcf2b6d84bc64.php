<div>
    <div class="login-sec log-h-sec pt-4 ban-up ban-up3 ht_center_div">
        <div class="login-sec-wrap">
          <div class="container">
            <div>
                <?php if(session()->has('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
            </div>
            <div
              class="log-wrap lg-wrp2"
              style="background-image: url(/assets/fe/images/log-back.png)"
            >
              <div class="login-outr del-outr">
                <h2>Put Account To Sleep</h2>
                <!-- <p>Sleep mode will make your profile invisible. You may wake up your account at any time.?</p> -->
                <p>Sleep mode will make your profile invisible. You may wake up your account at any time. Why are you snoozing?</p>
                <form wire:submit.prevent="sleepAccount()">

                  <div class="form-input">
                    <select class="form-select" wire:model.lazy="reason">
                      <option>Trouble getting started</option>
                      <option>I found a position with Purple Stairs</option>
                      <option>I found a position on my own</option>
                      <option>I want privacy but am still looking</option>
                      <option>I did not like your platform</option>
                    </select>
                  </div>
                  <?php if($reason == 'I did not like your platform'): ?>
                  <div class="form-input">
                    <input
                      type="text"
                      placeholder="What did you not like about Purple Stairs?"
                      class="form-control"
                      wire:model.lazy="other"
                    />
                  </div>
                  <?php endif; ?>

                  <?php if(Auth::user()->password != ''): ?>
                  <div class="form-input">
                  <div class="form_ipp_passwordd">
                                 <input type="password" class="password-field pass_chk form-control" placeholder="To continue please enter account password." wire:model.lazy="password" >
                                 <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                             </div>
                    <!-- <input
                      type="password"
                      placeholder="To continue please enter account password."
                      class="form-control password_sm"
                      wire:model.lazy="password"
                    /> -->
                  </div>
                  <?php endif; ?>

                  <div class="form-input">
                    <input
                      type="submit"
                      value="Temporarily Sleep Account"
                      class="sub-btn"
                    />
                  </div>
                </form>
              </div>
              <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1 log12">
              <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2">
            </div>
          </div>
        </div>
      </div>
</div>
<?php /**PATH /var/www/html/app/resources/views/livewire/sleep-account.blade.php ENDPATH**/ ?>