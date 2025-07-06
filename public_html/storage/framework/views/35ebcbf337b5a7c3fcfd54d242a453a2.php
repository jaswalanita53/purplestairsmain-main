<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
          <div class="form-points">
            <?php
            $step = 8; $current_step = auth()->user()->current_step;
            ?>
            <?php echo $__env->make('inc.steps',compact('step', 'current_step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
      </section>

      <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
          <div class="common-form-outr">
            <div class="form-hdr">
              <h5>More About Me</h5>
              <div>
                
                <a
                  class="skip"
                  
                  href="<?php echo e(route('candidatestep9')); ?>"
                  >Skip <em><img src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em
                ></a>
              </div>
            </div>
            <form wire:submit.prevent="saveAbout()">
            <div class="gl-form form-sec">
              
              <div class="gl-frm-outr mb-5 disable-form"> 
                <label>Upload Photo</label>
                <div class="toggle-switch-block" style="right: 0;top: 0; position: relative; float: right;">
                  <span>show</span>
                  <div class="switch_box box_1">
                    <input type="checkbox" class="switch_1 profile_switch" <?php echo e($profile_status ? 'checked' : ''); ?> data-value="<?php echo e($profile_status); ?>" wire:model.lazy="profile_status"/>
                  </div>
                  <span>Hide</span>
                </div>
                <div class="hiden <?php echo e($profile_status ? '' : 'show'); ?>">
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

                <div class="up-outr-wrp">
                  <div class="upload-wrp">
                      <?php if(Auth::user()->profile_photo_path): ?>
                        <a href="javascript:;">
                          <?php if($profile_status): ?>
                            <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>"  id="preview" alt="" style="border-radius: 50%; width:114px !important; height:114px !important;"/>
                          <?php else: ?>
                            <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>"  id="preview" alt="" width="50px" height="50px" style="border-radius:50%; width:114px !important; height:114px !important;" />
                          <?php endif; ?>
                        </a>
                        <span class="remove-avatar text-center" wire:click.stop="removeAvatar()"><img src="<?php echo e(asset('assets/fe/images/del2.svg')); ?>" class="del-pic" alt="" /></span>
                      <?php else: ?>
                        <a href="javascript:;">
                          <img src="<?php echo e(asset('assets/fe/images/profile-pic.png')); ?>"  id="preview" alt="" style="border-radius: 50%"/>
                          <img src="<?php echo e(asset('assets/fe/images/up-plus.png')); ?>"   alt="" class="up-plus" />
                        </a>
                      <?php endif; ?>
                  </div>

                  <a href="javascript:void(0)" class="photo-btn upld">
                    <input type="file" class="change-photo" wire:model.lazy="profile">

                    <?php if(Auth::user()->profile_photo_path): ?>
                    Replace Photo
                    <?php else: ?>
                    Upload Photo
                    <?php endif; ?>
                  </a>
                </div>
                <div style="margin-left: 135px; margin-top: -25px; color: #8f8f8f !important; font-size: 12px; " class="info-error">
                    <p class="mb-2">Acceptable file formats: JPG/PNG, max size 1MB</p>
                    <?php echo $__env->make('inc.error', [
                      'field_name' => 'profile',
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
              <div class="gl-frm-outr mb-0">
                <label>Short Bio</label>
                <div class="form-group short_bio_div">
                  <textarea placeholder="" class="lg-textarea" wire:model.lazy="short_bio"></textarea>
                  <div class="toggle-switch-block">
                    <span>show</span>
                    <div class="switch_box box_1">
                      <input type="checkbox" class="switch_1 bio_switch" <?php echo e($short_bio_status ? 'checked' : ''); ?> data-value="<?php echo e($short_bio_status); ?>" wire:model.lazy="short_bio_status"/>
                    </div>
                    <span>Hide</span>
                  </div>
                  <div class="hiden <?php echo e($short_bio_status ? '' : 'show'); ?>">
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
                <input type="submit" value="Preview Profile" class="nxt-btn" wire:loading.remove wire:target="saveAbout"/>
                <input type="button" value="Saving..." class="nxt-btn" wire:loading wire:target="saveAbout"/>
              </div>
            </div>
            </form>
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
        // e.preventDefault(); task - 86a0hxg00
        // location.replace('/candidate/approval')
        // window.location.href='<?php echo e(url("/candidate/approval")); ?>'; task - 86a0hxg00
    })

    document.addEventListener("livewire:load", () => {
      triggerSwitch();
    });

    function triggerSwitch() {
        $('.switch_1').each(function(index, el) {
            if ($(el).attr('data-value') == 1) {
                $(el).parents(".toggle-switch-block").next().removeClass("show");
                $(el).prop('checked', true);
            } else {
                $(el).parents(".toggle-switch-block").next().addClass("show");
                $(el).prop('checked', false);
            }
        });
    }

    window.addEventListener('load-switches', event => {
        document.querySelectorAll('.switch_1').forEach(function(el,i){
            console.log($(el).attr('data-value'));
            if ($(el).attr('data-value') == 1) {
                $(el).parents(".toggle-switch-block").next().removeClass("show");
                $(el).prop('checked', true);
            } else {
                $(el).parents(".toggle-switch-block").next().addClass("show");
                $(el).prop('checked', false);
            }
        });
    });

    var mask_img = "<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>";
    $("body").delegate(".change-photo", "change", function(e) {
 triggerSwitch();
   var file = this.files[0];

            var preview = $('#preview');
    var errorMessage = $('<div class="text-danger error file-error">File must be an image. Maximum size must be 1MB.</div>');

    // Listen for changes in the file input

        var file = this.files[0];

            Livewire.hook('message.processed', (message, component) => {
                  if (file) {
            if (file.type.match(/^image\/(jpeg|png)$/)) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var image = $(preview).attr('src', e.target.result);

                    $(preview).css('width', '116px');
                    $(preview).css('height', '116px');

                    if($('.up-plus').is(':visible')) {
                      $('.up-plus').hide();
                    }
                };

                var fileSizeInBytes = file.size;
                var fileSizeInMB = fileSizeInBytes / (1024 * 1024); // Convert to MB


                if (fileSizeInMB > 1) {
                    $('.change-photo').val('');
                    $('.text-danger').remove();
                    $('.info-error').append(errorMessage);
                }else{
                reader.readAsDataURL(file);
                $('.text-danger').remove();
            }

            } else {
                // If it's not an image, display the error message
                $('.change-photo').val('');
                $('.text-danger').remove();
                $('.info-error').append(errorMessage);
            }
        } else {
              $('.text-danger').remove();
        }
    });
});

    $("body").delegate(".upload-wrp", "click", function(e) {
        $('.change-photo').trigger('click')
    });

    // task - 8678eggpf
    window.addEventListener('temp-update-avatar', event => {
      setTimeout(() => {
          $('.upload-wrp').find('a').find('img').attr('src', '<?php echo e(asset('')); ?>' + event.detail.newPath );
          var src = $('.upload-wrp').find('a').find('img').attr('src');
          $('.avatar-img').find('img').attr('src', src);
      }, 1000);

      setTimeout(() => {
          var _status = '<?php echo e($profile_status); ?>';
          if(_status == '0') {
            $('.avatar-img').find('img').attr('src', mask_img);
            $('.upload-wrp').find('a').find('img').attr('src', mask_img);
          }
      }, 2000);
    });

    window.addEventListener('update-avatar', event => {
      setTimeout(() => {
          var src = $('.upload-wrp').find('img').attr('src');
          $('.avatar-img').find('img').attr('src', src);
      }, 1000);
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidate-step8.blade.php ENDPATH**/ ?>