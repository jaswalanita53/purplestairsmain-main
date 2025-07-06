<div>
  <div class="profile-banner cmn-gap pb-0 ban-up">
    <div class="container">
      <div class="sec-hdr">
        <h1>Candidate Profile</h1>
      </div>
      <div class="form-points mb-5">
        <?php
        $step = 1
        ?>
        <?php echo $__env->make('inc.steps',compact('step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <div class="profile-popup-wrap">
        <div class="row align-items-center">
          <div class="col-md-2">
            <div class="profile-popup">
              <div class="toggle-switch-block">
                <span>Show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" checked="" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
            </div>
          </div>
          <div class="col-md-10">
            <div class="profile-popup-rgt">
              <p>
                <strong> You decide what will be shown and hidden </strong> An
                employer who is interested in learning more about you will
                submit a request. You can choose to allow or deny an unmask
                request which will display your information to that employer
                only.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="common-form-wrap cmn-gap">
    <div class="container">
      <div class="common-form-outr">
        <div class="form-hdr">
          <h5>Personal Information</h5>
          <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="gl-form form-sec">
          <div class="gl-frm-outr mb-0">
            <label>Name</label>
            <div class="form-group disable-form">
              <input type="text" placeholder="" class="form-control" wire:model.lazy="name" />
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" wire:model.lazy="name_status" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
            </div>
            <div class="hiden <?php echo e($name_status ? '' : 'show'); ?>">
              <div class="d-span">
                <img src="<?php echo e(asset("assets/fe/images/hidden.svg")); ?>" alt="" />Hidden to everyone

                <div class="in-ap">
                  <p>
                    This information will only be unmasked to a Requesting
                    company <strong>upon your approval.</strong>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="gl-frm-outr mb-0">
            <label>Email</label>
            <div class="form-group disable-form">
              <input type="email" placeholder="" class="form-control" wire:model.lazy="email" />
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" wire:model.lazy="email_status" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
              <?php echo $__env->make('inc.error', [
              'field_name' => 'email',
              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="hiden <?php echo e($email_status ? '' : 'show'); ?>">
              <div class="d-span">
                <img src="<?php echo e(asset("assets/fe/images/hidden.svg")); ?>" alt="" />Hidden to everyone

                <div class="in-ap">
                  <p>
                    This information will only be unmasked to a Requesting
                    company <strong>upon your approval.</strong>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="gl-frm-outr mb-0">
            <label>Phone</label>
            <div class="form-group disable-form">
              <input type="tel" placeholder="xxx-xxx-xxxx" id="telle" maxlength="12" class="form-control" wire:model.lazy="phone" />
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" wire:model.lazy="phone_status" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
              <?php echo $__env->make('inc.error', [
              'field_name' => 'phone',
              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="hiden <?php echo e($phone_status ? '' : 'show'); ?>">
              <div class="d-span">
                <img src="<?php echo e(asset("assets/fe/images/hidden.svg")); ?>" alt="" />Hidden to everyone

                <div class="in-ap">
                  <p>
                    This information will only be unmasked to a Requesting
                    company <strong>upon your approval.</strong>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="gl-frm-outr mb-0">
            <label>Current Title</label>
            <div class="form-group">
              <input type="text" placeholder="" class="form-control" wire:model.lazy="current_title" />
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" checked="" wire:model.lazy="current_title_status" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
              <div class="hiden <?php echo e($current_title_status ? '' : 'show'); ?>">
                <div class="d-span">
                  <img src="<?php echo e(asset("assets/fe/images/hidden.svg")); ?>" alt="" />Hidden to everyone

                  <div class="in-ap">
                    <p>
                      This information will only be unmasked to a Requesting
                      company <strong>upon your approval.</strong>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-bulb">
            <span><img src="<?php echo e(asset('assets/fe/images/mega-phone.png')); ?>" alt="" /></span>
            <p>
              First Impressions Count. Put your best foot forward with a title
              that says it awesomely!
            </p>
          </div>
          <div class="gl-frm-outr">
            <label>Zipcode <em> (Center of Work Radius)</em></label>
            <div class="form-group">
              <input type="text" placeholder="" class="form-control" wire:model.lazy="zip_code" />
            </div>
          </div>
          <div class="gl-frm-outr mb-0">
            <label>Linkedin URL </label>
            <div class="form-group">
              <input type="url" placeholder="" class="form-control" wire:model.lazy="linkedin_url" />
              <?php echo $__env->make('inc.error', [
              'field_name' => 'linkedin_url',
              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" checked="" wire:model.lazy="linkedin_url_status" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
              <div class="hiden <?php echo e($linkedin_url_status ? '' : 'show'); ?>">
                <div class="d-span">
                  <img src="<?php echo e(asset("assets/fe/images/hidden.svg")); ?>" alt="" />Hidden to everyone

                  <div class="in-ap">
                    <p>
                      This information will only be unmasked to a Requesting
                      company <strong>upon your approval.</strong>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="gl-frm-outr mb-0">
            <label>Additional URL <em>(or Portfolio Link)</em> </label>
            <div class="form-group">
              <input type="url" placeholder="" class="form-control" wire:model.lazy="additional_url" />
              <?php echo $__env->make('inc.error', [
              'field_name' => 'additional_url',
              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" checked="" wire:model.lazy="additional_url_status" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
              <div class="hiden <?php echo e($additional_url_status ? '' : 'show'); ?>">
                <div class="d-span">
                  <img src="<?php echo e(asset("assets/fe/images/hidden.svg")); ?>" alt="" />Hidden to everyone

                  <div class="in-ap">
                    <p>
                      This information will only be unmasked to a Requesting
                      company <strong>upon your approval.</strong>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-bulb">
            <span><img src="<?php echo e(asset('assets/fe/images/star2.png')); ?>" alt="" /></span>
            <p>
              Your talents talk to your industry. Share them with us as well!
            </p>
          </div>
          <div class="whole-btn-wrap text-end">
            <input type="submit" value="Next" class="nxt-btn" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
  $(".nxt-btn").click(function(e) {
    e.preventDefault();
    location.replace('/candidate/position-preferences')
  })

  //Add dashes to phone input
  var tele = document.querySelector('#telle');

  tele.addEventListener('keyup', function(e) {
    if (event.key != 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)) {
      tele.value += '-';
    }
  });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-step1.blade.php ENDPATH**/ ?>