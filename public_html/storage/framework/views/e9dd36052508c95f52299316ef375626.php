<div>
<style >
.remove-avata-hidden{
            display: none;
        }</style>
    <section class="main-form-sec back-clr main-form2 cmn-gap pb-0 ban-up ban-up3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb edit-personal justify-content-center justify-content-md-start">
                    <li class="active mb-2 mb-md-0" aria-current="page">Edit Personal Information</li>
                    <li class=" mb-2 mb-md-0"><a href="<?php echo e(route("candidates.editpreferences")); ?>">Edit Position Preferences</a></li>
                    <li class=" mb-2 mb-md-0"><a href="<?php echo e(route("candidates.editresume")); ?>">Edit Resume Information</a></li>

                </ol>
            </nav>
            <div class="sec-hdr mb-4 mb-md-5 d-flex align-items-center justify-content-between">
                <h2 class="mb-0">Edit Personal Information</h2>
                <div class="profile-btn ms-btn text-nowrap">
                    <?php if(Auth::user()->current_step==9): ?>
                    <a href="<?php echo e(route("candidatestep9")); ?>" class="px-3 px-md-5"> Preview Profile</a>
                    <?php else: ?>
                        
                        
                        <a href="javascript:;" wire:click="validateProfile()" class="px-3 px-md-5"> View Profile</a>
                    <?php endif; ?>

                </div>
            </div>

            <div class="cmn-form">
                <div class="cmn-head">
                    <h5>Personal Information</h5>
                    
                </div>

                
                <?php if(session('message')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('message')); ?>

                </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                <span class="alert alert-danger">

                    <strong><?php echo e(session('error')); ?></strong>
                </span>
                <?php endif; ?>
                

                <div class="form-sec gl-form-">
                    <form wire:submit.prevent="savePersonal()">
                        <div class="row form-sec gl-form">
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Name*</label>
                                    <div class="form-group disable-form mb-0">
                                        <input type="text" placeholder="" class="form-control user-name-field" wire:model.lazy="name" />
                                        <?php echo $__env->make('inc.error', [
                                        'field_name' => 'name',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="name_status" tabindex="-1" data-value="<?php echo e($name_status); ?>"/>

                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($name_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Email*</label>
                                    <div class="form-group disable-form mb-0">
                                        <input type="email" placeholder="" class="form-control readonly-email" wire:model.lazy="email" readonly />
                                        <?php echo $__env->make('inc.error', [
                                        'field_name' => 'email',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="email_status" tabindex="-1" data-value="<?php echo e($email_status); ?>"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($email_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Phone*</label>
                                    <div class="form-group disable-form mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.lazy="phone" id="telle"/>
                                        <?php echo $__env->make('inc.error', [
                                        'field_name' => 'phone',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="phone_status" tabindex="-1" data-value="<?php echo e($phone_status); ?>"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($phone_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Current Position/Title</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.lazy="current_title" />
                                        <?php echo $__env->make('inc.error', [
                                        'field_name' => 'current_title',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="current_title_status" tabindex="-1" data-value="<?php echo e($current_title_status); ?>"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($current_title_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                
                                <div class="gl-frm-outr mb-2">
                                    <label>Zip code* (Center of Work Radius)</label>
                                    <div class="form-group mb-0 disable-form">
                                        <input type="text" placeholder="" class="form-control zip_code_field-" wire:model.lazy="zip_code" id="zipcode" maxlength="10"/>
                                        <?php echo $__env->make('inc.error', [
                                        'field_name' => 'zip_code',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="zip_code_status" tabindex="-1"  data-value="<?php echo e($zip_code_status); ?>"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($zip_code_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Linkedin URL</label>
                                    <div class="form-group disable-form mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.lazy="linkedin_url" />
                                        <?php echo $__env->make('inc.error', [
                                        'field_name' => 'linkedin_url',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="linkedin_url_status" tabindex="-1" data-value="<?php echo e($linkedin_url_status); ?>"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($linkedin_url_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-2">
                                    <label>Additional URL or Portfolio Link</label>
                                    <div class="form-group disable-form mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.lazy="additional_url" />
                                        <?php echo $__env->make('inc.error', [
                                        'field_name' => 'additional_url',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.lazy="additional_url_status" tabindex="-1" data-value="<?php echo e($additional_url_status); ?>"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($additional_url_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="form-submit-btn mb-0">
                                    <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="savePersonal"/>
                                    <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="savePersonal">
                                </div>
                        </div>
                        <div class="cmn-form row mt-4">
                            <div class="cmn-head">
                                <h5>More About Me</h5>
                            </div>
                            <div class="form-sec gl-form">
                                <div class="row align-items-baseline ">

                                    <div class="col-lg-2 col-md-3 info-error">
                                        
                                        <div class="form-group f-up new_uploaded_frm disable-form">
                                            <div class="upload-wrp" wire:loading.remove wire:target="profile">

                                                <?php if(!empty(Auth::user()->profile_photo_path)): ?>
                                                <a href="javascript:void(0)">
                                                    <?php if(!$profile_status): ?>
                                                    <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>"  id="preview" alt="masked_ic" style="border-radius:50%; width:100px !important; height:100px !important;" width="70%" />
                                                    <?php else: ?>
                                                    <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>"  id="preview" alt="picture" style="border-radius:50%; width:100px !important; height:100px !important;" />
                                                    <?php endif; ?>

                                                </a>
                                                <span class="remove-avatar" wire:click.stop="removeAvatar()"><img src="<?php echo e(asset('assets/fe/images/del2.svg')); ?>" class="del-pic" alt="" /></span>
                                                <?php else: ?>
                                                <?php if(!$profile_status): ?>
                                                    <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>"  id="preview" alt="masked_ic" style="border-radius:50%; width:100px !important; height:100px !important;" width="70%" />
                                                    <?php else: ?>
                                                    <a href="javascript:void(0)"><img src="<?php echo e(asset('assets/fe/images/up-photo.png')); ?>" id="preview"alt="" style="border-radius:50%; width:100px !important; height:100px !important;" width="70%"/></a>
                                                    <?php endif; ?>

                                                <img src="<?php echo e(asset('assets/fe/images/up-plus.png')); ?>" alt="" class="up-plus" />
                                                 <span class="remove-avatar remove-avata-hidden" wire:click.stop="removeAvatar()"><img src="<?php echo e(asset('assets/fe/images/del2.svg')); ?>" class="del-pic" alt="" /></span>
                                                <?php endif; ?>

                                            </div>
                                            <div class="upload-wrp" wire:loading wire:target="profile">

                                              <img src="<?php echo e(asset('/assets/be/images/loading.gif')); ?>"  id="preview" alt="masked_ic" style="border-radius:50%; width:100px !important; height:100px !important;" width="70%" />

                                            </div>

                                            <!-- <h5>Upload Photo</h5> -->
                                            <a href="javascript:void(0)" class="upload_btn nw_upldd">


                                                <?php if(Auth::user()->profile_photo_path): ?>
                                                <input type="file" wire:model="profile" class="change-photo"> Replace Photo
                                                <?php else: ?>
                                                <input type="file" wire:model="profile" class="change-photo"> Upload Photo (Please upload JPG/PNG format. Maximum size must be 1MB)
                                                <?php endif; ?>

                                            </a>

                                            <div class="toggle-switch-block" style="right: 0;top: 0; position: relative; background: none;">
                                                <span>show</span>
                                                <div class="switch_box box_1">
                                                    <input type="checkbox" class="switch_1 profile_status " data-value="<?php echo e($profile_status); ?>" <?php echo e($profile_status ? 'checked' : ''); ?> wire:model.lazy="profile_status" />
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
                                        </div>

                                        
                                        <?php if(session('profile-error')): ?>
                                            <div class="text-danger error" >
                                            <?php echo e(session('profile-error')); ?>

                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <div class="gl-frm-outr mb-0">
                                            <label>Short Bio</label>
                                            
                                            <div class="form-group mb-0">
                                                <input type="text" placeholder="" class="form-control" wire:model="short_bio" />
                                                <div class="toggle-switch-block">
                                                    <span>show</span>
                                                    <div class="switch_box box_1">
                                                        <input type="checkbox" class="switch_1" wire:model="short_bio_status" <?php echo e($short_bio_status ? 'checked' : ''); ?> data-value="<?php echo e($short_bio_status); ?>" />
                                                    </div>
                                                    <span>Hide</span>
                                                </div>
                                                <div class="hiden <?php echo e($short_bio_status ? '' : 'show'); ?>">
                                                    <div class="d-span">
                                                        <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                                    </div>
                                </div>

                                <div class="form-submit-btn mb-0" >
                                    <span wire:loading.remove wire:target="profile">
                                    <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="savePersonal"/>
                                    <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="savePersonal">
                                    </span>
                                    <span wire:loading wire:target="profile">
                                    <input type="button" value="Uploading..." class="submit-btn"/>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="cmn-form-btm">
                <!-- <div class="ftr-btm-lft">
                    <p>© 2023 Purple Stairs</p>
                    <span>Website by <a href="https://www.brand-right.com/" target="_blank"> BrandRight Marketing Group</a></span>
                </div> -->
            </div>
        </div>
    </section>
</div>

<script>


    // task - 86a0jby08
    function validatePage() {
        $('html, body').animate({
            scrollTop: $("div.error:first").offset().top - 200
          }, 500);
          return false;
    }
    // task - 86a0jby08 end

    window.addEventListener('page-load', event => {
        location.reload();
    });


    document.addEventListener("livewire:load", () => {


triggerSwitch();
})
    // task - 86a0fxn2y
    /*$('.submit-btn').click(function(event) {
        $('html, body').animate({
            scrollTop: $("div.cmn-head:first").offset().top - 200
        }, 500);
    });*/
    // task - 86a0fxn2y end

    // Reload component every 2 seconds
    document.addEventListener("livewire:load", () => {
        // task - 86a0pwt5m
        Livewire.hook('message.processed', (message, component) => {
            console.log('hook loads...');
            setTimeout(() => {
                if($("div.text-danger:first").length) {
                    $('html, body').animate({
                        scrollTop: $("div.text-danger:first").offset().top - 200
                    }, 500);
                }
            }, 250);
        });
        // task - 86a0pwt5m end



 var mask_img = "<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>";

// Use jQuery event delegation for dynamically added elements


// You can remove the commented-out code if it's not needed
// document.querySelectorAll('.switch_1').forEach(function(el, i) {
//     if ($(el).attr('data-value') == 1) {
//         $(el).parents(".toggle-switch-block").next().removeClass("show");
//         $(el).prop('checked', true);
//     } else {
//         $(el).parents(".toggle-switch-block").next().addClass("show");
//         $(el).prop('checked', false);
//     }
// });



    });



    // task - 8678eggpf
    var mask_img = "<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>";
    window.addEventListener('temp-update-avatar', event => {
        if($('.profile_status').is(':checked')===false) {
            if(event.detail.newPath!=null){
            $('.upload-wrp').find('a').find('img').attr('src', '<?php echo e(asset('')); ?>' + event.detail.newPath);
        }else{
            $('.upload-wrp').find('a').find('img').attr('src', '<?php echo e(asset("/assets/fe/images/up-photo.png")); ?>');
        }
            setTimeout(() => {
                $('.upload-wrp').find('a').find('img').attr('src', mask_img);
        }, 500);

        }else{

           if(event.detail.newPath!=null){
            $('.upload-wrp').find('a').find('img').attr('src', '<?php echo e(asset('')); ?>' + event.detail.newPath);
        }else{
            $('.upload-wrp').find('a').find('img').attr('src', '<?php echo e(asset("/assets/fe/images/up-photo.png")); ?>');
        }
        }
        setTimeout(() => {
            var src = $('.upload-wrp').find('a').find('img').attr('src');
            $('.avatar-img').find('img').attr('src', src);
        }, 1000);


        // setTimeout(() => {
        //           var _status = '<?php echo e($profile_status); ?>';
        //           if(_status == '0') {
        //             $('.avatar-img').find('img').attr('src', mask_img);
        //             $('.upload-wrp').find('a').find('img').attr('src', mask_img);
        //           }
        //       }, 2000);
    });

   window.addEventListener('update-avatar', event => {
    $('.change-photo').val('');

   setTimeout(() => {
          $('#preview').attr('src',"<?php echo e(url('/assets/fe/images/up-photo.png')); ?>");
          $('.remove-avata-hidden').hide();
        }, 1000);

    });

    $("body").delegate(".upload-wrp", "click", function(e) {
        $('.change-photo').trigger('click')
    })

    function triggerSwitch() {
                $('.switch_1').each(function(index, el) {
                    console.log($(el), $(el).attr('data-value'));
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
                    if ($(el).attr('data-value') == 1) {
                        $(el).parents(".toggle-switch-block").next().removeClass("show");
                        $(el).prop('checked', true);
                    } else {
                        $(el).parents(".toggle-switch-block").next().addClass("show");
                        $(el).prop('checked', false);
                    }
                });

            });

            document.addEventListener("livewire:load", () => {
                $("body").delegate("#zipcode", "input", function(e) {
                    $(this).parents('.form-group').find('.text-danger').remove();
                });

                const zipcodeInput = document.getElementById("zipcode");

                zipcodeInput.addEventListener("keyup", function() {
                    if ($(this).val() != "") {
                        $('.nxt-btn').attr('disabled', true);
                        $('.nxt-btn').val('Loading...', true);
                    }

                    let inputValue = zipcodeInput.value;
                    inputValue = inputValue.replace(/[^0-9]/g, ""); // Remove non-numeric characters

                    if (inputValue.length > 9) {
                        inputValue = inputValue.substring(0, 9); // Limit to 9 digits
                    }

                    if (inputValue.length > 5) {
                        inputValue = inputValue.substring(0, 5) + "-" + inputValue.substring(5); // Format as ZIP+4
                    }

                    zipcodeInput.value = inputValue;
                });

                Livewire.hook('message.processed', (message, component) => {
                    $('.nxt-btn').attr('disabled', false);
                    $('.nxt-btn').val('Next', true);
                });
            });


            document.addEventListener("livewire:load", () => {
                var file;
    var preview ;
    var errorMessage  ;
    var errorMessageSize ;
    $("body").on("change", ".change-photo", function (e) {
     file = this.files[0];
     preview = $('#preview');
     errorMessage = $('<div class="text-danger error file-error">File must be an image with one of the allowed extensions: jpg, png, jpeg</div>');
     errorMessageSize = $('<div class="text-danger error file-error"> File must be less than or equal to 1 MB in size</div>');

    // Reset any previous error messages
    $('.text-danger').remove();
    $('.remove-avata-hidden').hide();


        });

                Livewire.hook('message.processed', (message, component) => {
                    if (file) {
                if (file.type.match(/^image\/(jpeg|png)$/)) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var image = $(preview).attr('src', e.target.result);
                        $('.remove-avata-hidden').show();
                    };

                    var fileSizeInBytes = file.size;
                    var fileSizeInMB = fileSizeInBytes / (1024 * 1024); // Convert to MB

                    if (fileSizeInMB > 1) {
                        $('.change-photo').val('');
                        setTimeout(function () {
                            $('.info-error').append(errorMessageSize);
                        }, 300);
                    } else {
                        reader.readAsDataURL(file);
                    }
                } else {
                    // If it's not an image, display the error message
                    $('.change-photo').val('');
                    setTimeout(function () {
                        $('.info-error').append(errorMessage);
                    }, 300);
                }
            }
                });
            });

            $("body").delegate("#telle", "keyup paste", function(e) {
      var v = $(this).val().replace(/\D/g, ''); // Remove non-numerics
      if(v.length<10){
      v = v.replace(/(\d{3})(?=\d)/g, '$1-'); // Add dashes every 4th digit
      $(this).val(v)
      }
      /*if(v.length>10){
      v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
      $(this).val(v.substr(0, 12))
      }*/

      v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
      $(this).val(v.substr(0, 12))
});

 $("body").delegate("#telle", "keypress", function(e) {
                var inputValue = $(this).val();
                var charCode = event.which;

                if (
                    (charCode < 48 || charCode > 57) && // Not a number
                    charCode !== 45 && // Not a hyphen
                    charCode !== 8 && // Backspace
                    charCode !== 0 && // Arrow keys, function keys, etc.
                    !event.ctrlKey // Control key combination
                ) {
                    event.preventDefault();
                    return false;
                }

            });
</script>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidate-edit-personal.blade.php ENDPATH**/ ?>