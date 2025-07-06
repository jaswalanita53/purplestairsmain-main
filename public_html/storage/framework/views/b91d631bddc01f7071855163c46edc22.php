<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
          <div class="form-points">
            <?php
            $step = 8
            ?>
            <?php echo $__env->make('inc.steps',compact('step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
      </section>

      <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
          <div class="common-form-outr">
            <div class="form-hdr">
              <h5>More About Me</h5>
              <div>
                <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <a
                  class="skip"
                  
                  href="<?php echo e(route('candidatestep9')); ?>"
                  >Skip <em><img src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em
                ></a>
              </div>
            </div>
            <div class="gl-form form-sec">
              <div class="gl-frm-outr">
                <label>Upload Photo</label>
                <div class="up-outr-wrp">
                  <div class="upload-wrp">
                    <a href="#">
                        <?php if(Auth::user()->profile_photo_path): ?>
                        <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" style="border-radius: 50%; width:114px !important; height:114px !important;"/>
                        <?php else: ?>
                        <img src="<?php echo e(asset('assets/fe/images/profile-pic.png')); ?>" alt="" style="border-radius: 50%"/>
                        <?php endif; ?>
                    </a>
                    <img src="<?php echo e(asset('assets/fe/images/up-plus.png')); ?>" alt="" class="up-plus" />
                  </div>
                 
                  <a href="javascript:void(0)" class="photo-btn upld">
                    <input type="file" wire:model.lazy="profile">
              
                    <?php if(Auth::user()->profile_photo_path): ?>
                    Replace Photo 
                    <?php else: ?>
                    Upload Photo
                    <?php endif; ?>
                  </a>
                </div>
                <div style="margin-left: 135px; margin-top: -25px; color: #8f8f8f !important; font-size: 12px;">                       
                    <p>Acceptable file formats: JPG/PNG, max size 1MB</p>
                  </div>
                  <?php echo $__env->make('inc.error', [
                    'field_name' => 'profile',
                  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
              <div class="gl-frm-outr mb-0">
                <label>Short Bio</label>
                <div class="form-group">
                  <textarea placeholder="" class="lg-textarea" wire:model.lazy="short_bio"></textarea>
                  <div class="toggle-switch-block">
                    <span>show</span>
                    <div class="switch_box box_1">
                      <input type="checkbox" class="switch_1" checked=""  wire:model.lazy="short_bio_status"/>
                    </div>
                    <span>Hide</span>
                  </div>
                  <div class="hiden">
                    <div class="d-span">
                      <img src="<?php echo e(asset('assets/fe/images/hidden.svg')); ?>" alt="" />Hidden to everyone

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

              <div class="whole-btn-wrap dual-btn">
                <input type="submit" value="Back" class="prev-btn" />
                <input type="submit" value="Preview Profile" class="nxt-btn" />
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    $(".prev-btn").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/references')
    })
    $(".nxt-btn").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/approval')
    })
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-step8.blade.php ENDPATH**/ ?>