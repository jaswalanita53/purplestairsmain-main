<div class="back-clr ban-up">
    <style type="text/css">
        .form-group-for-custom-checkbox .form_input_check label:not(:last-child) {
            margin-bottom: 15px;
        }
        .form-group-for-custom-checkbox .form_input_check label:not(:last-child) {
            margin-right: 15px !important;
        }
        span.avatar-img img {
            width: 50px !important;
            height: 50px !important;
        }

        input[readonly], input[disabled]
        select[readonly], select[disabled] {
            background: #eee !important; pointer-events: none !important;
        }
        .select2-container--default .select2-selection--single {
            border-radius: 50px !important;
        }
        .remove-avata-hidden{
            display: none;
        }
        .text-center{
            text-align:center;
        }

    </style>

    <section class="profile-banner cmn-gap pb-0">
        <div class="container">
            <div class="profile-outr">
                <h1>
                    Edit My Profile
                </h1>
                <img src="<?php echo e(asset('assets/fe/images/pc2.png')); ?>" alt="" class="pic6 pc2" />
                <img src="<?php echo e(asset('assets/fe/images/pc1.png')); ?>" alt="" class="pic0">
            </div>
            
            <div class="text-center">
                <div class="preview-uppr-rgt">
                    <a href="<?php echo e(route('company.viewprofile')); ?>" class="blue_btn shadow">Preview Profile
                    </a>
                </div>
            </div>
        </div>

    </section>

    <form wire:submit.prevent="saveProfile()" id="saveProfile">
    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">

            <div class="common-form-outr">
             <?php if(session('message')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('message')); ?>

                </div>
                <?php endif; ?>
                <div class="form-hdr">
                    <h5>Contact Information</h5>
                    
                </div>
                <div class="gl-form form-sec emp-form px-4">
                    <div class="gl-frm-outr">
                        <label>Company Name*</label>
                        <div class="form-group">
                            <input type="text" class="form-control user-name-field" wire:model.defer="company_name"/>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'company_name',
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Company Email*</label>
                        <div class="form-group">
                            <input type="email" class="form-control" wire:model.defer="company_email" readonly/>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'company_email',
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Company Address*</label>
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model.defer="company_address" <?php echo e($company_address ? 'readonly' : ''); ?> />
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'company_address',
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>

                    <div class="gl-frm-outr mb-3 ">
                            <label>Company State* </label>
                            <div class="form-group">
                                <select class="" wire:model.defer="company_state" id="company_state" <?php echo e($company_state ? 'disabled' : ''); ?> >
                                    <option value="">Select State</option>
                                    <?php $__currentLoopData = $all_states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option data-badge="" value=<?php echo e($ind); ?>><?php echo e($key); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php echo $__env->make('inc.error', [
                                'field_name' => 'company_state',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Company City*</label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" wire:model.defer="company_city" <?php echo e($company_city ? 'readonly' : ''); ?> />
                                <?php echo $__env->make('inc.error', [
                                'field_name' => 'company_city',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    <div class="gl-frm-outr">
                    <label>Zip code*</label>
                  <div class="form-group">
                    <input type="text" class="form-control zipCode" wire:model.defer="zip_code" <?php echo e($zip_code ? 'readonly' : ''); ?> />
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'zip_code',
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Company Phone*</label>
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model.defer="company_phone" id="telle"/>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'company_phone',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Website URL</label>
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model.defer="website_url"/>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'website_url',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Social Media URL</label>
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model.defer="social_media_url"/>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'social_media_url',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="whole-btn-wrap dual-btn">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>Company Info</h5>
                    
                </div>
                <div class="gl-form form-sec px-4">

                    <div class="gl-frm-outr number_of_emp row align-items-center">
                        <div class="col-4">
                            <label class="ms-0 mb-0">Number Of Employees</label>
                        </div>
                        <div class="col-md-2 col-4">
                            <div class="form-group">
                                <input type="number" class="form-control num_of_emp px-2 text-center" placeholder="" wire:model.defer="number_of_employees" min="0" id="numberInput"/>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Company Benefits</label>
                        <div class="form-sec-left form-group">
                            <div class="form-group-for-custom-checkbox thrd-form">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" checked="" wire:model.defer="insurance_benefits">
                                        <span>Insurance Benefits</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="paid_holidays">
                                        <span> Paid Holidays</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="paid_vacation_days">
                                        <span>Paid Vacation Days</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="professional_environment">
                                        <span>Professional Environment</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="casual_environment">
                                        <span>Casual Environment</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Short Company Description*</label>
                        <div class="form-group">
                            <textarea class="lg-textarea" wire:model.defer="company_description" placeholder=""></textarea>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'company_description',
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                    </div>
                    <div class="gl-frm-outr">
                        <div class="up-outr-wrp" wire:loading.remove wire:target="profile">
                            <div class="upload-wrp" style="cursor: pointer;">
                                <a href="javascript:void(0)" style="width:116px;height:116px;" >
                                    <?php if($showImage && auth()->user()->profile_photo_path): ?>
                                        <img id="preview" src="<?php echo e(asset(auth()->user()->profile_photo_path)); ?>" alt="" style="border-radius: 50%; width:100% !important; height:100% !important; padding:20px ;object-fit: unset;"/>
                                        <span class="remove-avatar text-center" wire:click.stop="removeAvatar()"><img src="<?php echo e(asset('assets/fe/images/del2.svg')); ?>" class="del-pic" alt="" /></span>
                                    <?php else: ?>
                                        <img id="preview" src="<?php echo e(asset('assets/fe/images/im-up.svg')); ?>" alt=""style="border-radius: 50%; width:100% !important; height:100% !important; padding:20px ;object-fit: unset;"/>
                                        <span class="remove-avatar text-center remove-avata-hidden " wire:click.stop="removeAvatar()"><img src="<?php echo e(asset('assets/fe/images/del2.svg')); ?>" class="del-pic" alt="" /></span>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <a href="javascript:void(0)" class="photo-btn upld">
                                <input type="file" wire:model.lazy="profile" class="change-photo" value="">Upload Logo</a>
                        </div>
                        <div class="upload-wrp" wire:loading wire:target="profile">
                            <img src="<?php echo e(asset('/assets/be/images/loading.gif')); ?>"  id="preview" alt="masked_ic" style="border-radius: 50%; width:100% !important; height:100% !important; padding:20px ;object-fit: unset;" width="70%" />
                        </div>
                        <div style="margin-left: 135px; margin-top: -25px; color: #8f8f8f !important; font-size: 12px;" class="info-error">
                            <p>Acceptable file formats: JPG/PNG, max size 1MB</p>
                            <span wire:loading.class="d-none" wire:target="profile" class="error-img">
                                <?php $__errorArgs = ['profile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger error" style="<?php echo e(isset($style) ? $style : ''); ?>" wire:loading.class="d-none">
                                    <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </span>
                        </div>
                        <div class="form-submit-btn mb-2 mt-0 float-right">
                            <span wire:loading wire:target="profile">
                            <input type="button" value="Uploading..." class="submit-btn"/>
                            </span>
                            <span wire:loading.remove wire:target="profile">
                            <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="saveProfile"/>
                            <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="saveProfile">
                            </span>
                        </div>

                    </div>
                    </div>



                </div>
            </div>
        </div>
    </div>

    </form>


</div>
<?php $__env->startPush('scripts'); ?>
<script>
    //Add dashes to phone input
    var tele = document.querySelector('#telle');

    tele.addEventListener('keyup', function(e){
    if (event.key != 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)){
    tele.value += '-';
     }
    });
    // profile avatar image update
    // $(document).on('change', '.photo-btn.upld', function() {
    //     // setTimeout(function(){
    //         console.log('change');
    //     var uploded_img=$('.upload-wrp').find('img').attr('src');
    //     console.log(uploded_img);
    //     setTimeout(function(){
    //         $('.avatar-img img').attr('src',uploded_img);
    //     },1000);
    // });

    // $("body").delegate(".user-name-field", "input", function(e) {
    //     val = $(this).val();
    //     $('.user-name').text(val);
    //     console.log(val)
    // })

//     document.addEventListener("livewire:load", () => {

// $("body").delegate(".change-photo", "change", function(e) {
//        Livewire.hook('message.processed', (message, component) => {
//         setTimeout(() => {
//         var src=$('.upload-wrp').find('img').attr('src');
//         $('.avatar-img').find('img').attr('src',src);
//         }, 1000);
//     });
// })

// })

$("body").delegate(".upload-wrp", "click", function(e) {
       $('.change-photo').trigger('click')
});

    // task - 86a12tj3p
    window.addEventListener('scroll-to-success', event => {
        $('html, body').animate({
            scrollTop: $(".alert-success").offset().top - 200
        }, 100);
    });
    // task - 86a12tj3p end

 window.addEventListener('update-avatar', event => {
    $('.change-photo').val('');
          window.livewire.find('<?php echo e($_instance->id); ?>').set('profile', '');
   setTimeout(() => {
          $('#preview').attr('src',"<?php echo e(url('/assets/fe/images/im-up.svg')); ?>");
          $('.remove-avata-hidden').hide();
        }, 1000);
        console.log('Hiii')

    });


    $('#company_state').select2({
        placeholder: 'Select an option'
    });
    document.addEventListener('livewire:load', function () {
            $('#company_state').select2();

            Livewire.on('select2Updated', function (value) {
                $('#company_state').val(value).trigger('change');
            });
        });

    document.addEventListener("livewire:load", () => {
        $("body").delegate("#company_state", "change", function(e) {
            var val = $(this).val();
            window.livewire.find('<?php echo e($_instance->id); ?>').set('company_state', val);
        });

        var is_validate = 0;
        Livewire.hook('element.updated', (el, component) => {
            setTimeout(() => {
                if($("div.error").length && Object.keys(component.serverMemo.errors).length && !is_validate) {
                    is_validate = 1;
                    validatePage();
                }
            }, 250);
        });

        $('#saveProfile').on('submit', function(event) {
            is_validate = 0;
        });
        Livewire.hook('message.processed', (message, component) => {
            // setTimeout(() => {ewrwerw
                    // console.log(component.serverMemo.errors.length);
                        // if($("div.error").length && component.serverMemo.errors.length) {
                        //     validatePage();
                        // }
                    // }, 250);
            $('#company_state').select2({
        placeholder: 'Select an option'
    });
        // $('#company_state').trigger('change');

            })
    })

$("body").delegate("#telle", "keypress", function(event) {
    var inputValue = $(this).val();
    var charCode = event.which;

    // Check if the key pressed is not a number, hyphen, backspace, or control key combination
    if (
        (charCode < 47 || charCode > 57) && // Not a number
        charCode !== 45 && // Not a hyphen
        charCode !== 8 && // Backspace
        charCode !== 0 && // Arrow keys, function keys, etc.
        !event.ctrlKey // Control key combination
    ) {
        event.preventDefault();
        return false;
    }

    console.log(inputValue.length);

    // Prevent input if the length exceeds 11 characters
    if (inputValue.length > 11) {
        event.preventDefault();
        return false;
    }
});

document.addEventListener("livewire:load", () => {
    $("body").delegate("#telle", "keyup paste", function(e) {
        var v = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters

        // Add hyphens every 4th digit and limit the length to 12 characters
        if (v.length < 10) {
            v = v.replace(/(\d{3})(?=\d)/g, '$1-');
            $(this).val(v);
        }

        v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
        $(this).val(v.substr(0, 12));
    });
});


document.addEventListener("livewire:load", () => {

$(".nxt-btn").click(function(e) {
    var val=$('.lg-textarea').val();
    console.log(val);
    Livewire.hook('message.processed', (message, component) => {
        setTimeout(() => {
                        if($("div.error:first").length) {
                            // validatePage();
                        }
                    }, 250);
    if(val==''){
        $('.lg-textarea').parents('.form-group').find('.text-danger').remove();
        $('.lg-textarea').parents('.form-group').append('<div wire:loading.class="d-none" class="text-danger error dicrip-error" style=""> The company description field is required.</div>');
    }
})
})


})


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
                                    // $('.error-img').append(errorMessageSize);
                                    $('.error-img').html(errorMessageSize);
                                }, 300);
                            } else {
                                reader.readAsDataURL(file);
                            }
                        } else {
                            // If it's not an image, display the error message
                            $('.change-photo').val('');
                            setTimeout(function () {
                                $('.error-img').html(errorMessage);
                                // $('.error-img').append(errorMessage);
                            }, 300);
                        }
                    }
                });
            });


const numberInput = document.getElementById("numberInput");

numberInput.addEventListener("input", function() {
  // Remove leading zeros

    if(this.value!=0){
    this.value = this.value.replace(/^0+/, '');
    }else{
        this.value = 0;
    }


});
numberInput.addEventListener("input", function() {
  // Remove leading zeros

    if(this.value!=0){
    this.value = this.value.replace(/^0+/, '');
    }else{
        this.value = 0;
    }

});

 function validatePage() {
        console.log('scroll...');
        $('html, body').animate({
            scrollTop: $("div.error:first").offset().top - 200
          }, 100);
          // return false;
    }

$("body").delegate(".form-control,textarea", "input", function(e) {
    $(this).parents('.form-group').find('.text-danger').remove();
});

</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/company-edit.blade.php ENDPATH**/ ?>