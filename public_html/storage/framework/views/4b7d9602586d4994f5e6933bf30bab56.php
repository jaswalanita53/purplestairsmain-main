<div>
    <div class="login-sec log-h-sec pt-4 ban-up ban-up3 ht_center_div">
        <div class="login-sec-wrap">
          <div class="container">
            <div
              class="log-wrap lg-wrp2"
              style="background-image: url(/assets/fe/images/log-back.png)"
            >
              <div class="login-outr del-outr">
                <h2>Delete My Account</h2>
                <p>Why are you deleting your account?</p>
                <form wire:submit.prevent="deleteAccount()">

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
                                 <input type="password" class="pass_chk form-control" placeholder="To continue please enter account password." wire:model.lazy="password" >
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
                  <?php echo $__env->make('inc.error', [
                    'field_name' => 'password',
                  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <div class="form-input">
                    <input
                      type="submit"
                      value="Delete My Account"
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
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/delete-account.blade.php ENDPATH**/ ?>