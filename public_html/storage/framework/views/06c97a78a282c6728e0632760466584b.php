<div>
    <div class="back-clr ban-up">    <section class="profile-banner cmn-gap pb-0">
        <div class="container">
            <div class="form-points">
                <?php
                $step = 2
                ?>
                <?php echo $__env->make('inc.employersteps',compact('step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
          <div class="profile-outr">

            <h1>
                Employer Information
            </h1>

            <img src="<?php echo e(asset('assets/fe/images/pc2.png')); ?>" alt="" class="pic6 pc2" />
            <img src="<?php echo e(asset('assets/fe/images/pc1.png')); ?>" alt="" class="pic0">
        </div>
        </div>
      </section>

    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
          <div class="common-form-outr">
            <div class="form-hdr">
              <h5>Company Info</h5>
              <div>
                <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
            </div>
            <div class="gl-form form-sec">

              <div class="gl-frm-outr number_of_emp">
                  <label>Number Of Employees</label>
                  <div class="form-group">
                    <input
                      type="number"
                      placeholder=""
                      class="form-control"
                      wire:model.lazy="number_of_employees"
                    />

                  </div>
                </div>
                <div class="gl-frm-outr">
                    <label>Company Benefits</label>
                    <div class="form-sec-left form-group">
                      <div class="form-group-for-custom-checkbox thrd-form">
                        <div class="form_input_check">
                          <label>
                            <input type="checkbox" checked="" wire:model.lazy="insurance_benefits">
                            <span>Insurance Benefits</span>
                          </label>
                          <label>
                            <input type="checkbox" wire:model.lazy="paid_holidays">
                            <span> Paid Holidays</span>
                          </label>
                          <label>
                            <input type="checkbox" wire:model.lazy="paid_vacation_days">
                            <span>Paid Vacation Days</span>
                          </label>
                          <label>
                            <input type="checkbox" wire:model.lazy="professional_environment">
                            <span>Professional Environment</span>
                          </label>
                          <label>
                            <input type="checkbox" wire:model.lazy="casual_environment">
                            <span>Casual Environment</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
              <div class="gl-frm-outr">
                <label>Short Company Description</label>
                <div class="form-group">
                  <textarea placeholder="" class="lg-textarea" wire:model.lazy="company_description" ></textarea>

                </div>
              </div>
              <div class="gl-frm-outr">

              <div class="up-outr-wrp">
                  <div class="upload-wrp">
                      <?php if(Auth::user()->profile_photo_path): ?>
                      <a href="#"><img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" style="border-radius: 50%; width:114px !important; height:114px !important;"></a>
                      <?php else: ?>
                      <a href="#"><img src="<?php echo e(asset('assets/fe/images/im-up.svg')); ?>" alt=""></a>
                      <?php endif; ?>
                  </div>
                  <a href="javascript:void(0)" class="photo-btn upld"><input type="file" wire:model.lazy="profile">
                    <?php if(Auth::user()->profile_photo_path): ?>
                    Replace Logo
                    <?php else: ?>
                    Upload Logo
                    <?php endif; ?>
                  </a>
                  <?php echo $__env->make('inc.error', [
                    'field_name' => 'profile',
                  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
 <div style="margin-left: 135px; margin-top: -25px; color: #8f8f8f !important; font-size: 12px;">                       
                    <p>Acceptable file formats: JPG/PNG, max size 1MB</p>
                  </div>

              </div>
              <div class="whole-btn-wrap dual-btn">
                  <input type="submit" value="Back" class="prev-btn">
                  <input type="submit" value="Preview Profile" class="nxt-btn">
                </div>
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
        location.replace('/company/contact-info')
    })
    $(".nxt-btn").click(function(e) {
        e.preventDefault();
        location.replace('/company/review')
    })
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/company-step2.blade.php ENDPATH**/ ?>