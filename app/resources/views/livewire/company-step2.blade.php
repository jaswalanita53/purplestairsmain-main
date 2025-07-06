<div>
    <div class="back-clr ban-up">    <section class="profile-banner cmn-gap pb-0">
        <div class="container">
            <div class="form-points">
                @php
                $step = 2;
                $current_step = auth()->user()->current_step;
                @endphp
                @include('inc.employersteps',compact('step', 'current_step'))
              </div>
          <div class="profile-outr">

            <h1>
                Employer Information
            </h1>

            <img src="{{asset('assets/fe/images/pc2.png')}}" alt="" class="pic6 pc2" />
            <img src="{{asset('assets/fe/images/pc1.png')}}" alt="" class="pic0">
        </div>
        </div>
      </section>

    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
          <div class="common-form-outr">
            <div class="form-hdr">
              <h5>Company Info</h5>
              <div>
                {{-- @include('inc.autoSaveLoader') --}}
              </div>
            </div>
            <div class="gl-form form-sec">
            <form wire:submit.prevent="saveProfile()" id="saveProfile">
              <div class="gl-frm-outr number_of_emp">
                  <label>Number Of Employees</label>
                  <div class="form-group">
                    <input
                      type="number"
                      placeholder=""
                      class="form-control num_of_emp"
                      wire:model.defer="number_of_employees"
                      min="0"
                      id="numberInput"
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
                <label>Short Company Description*</label>
                <div class="form-group">
                  <textarea class="lg-textarea" wire:model.lazy="company_description" ></textarea>
                  @include('inc.error', [
                                    'field_name' => 'company_description',
                                ])
                </div>
              </div>
              <div class="gl-frm-outr">

              <div class="up-outr-wrp">
                  <div class="upload-wrp" style="cursor: pointer;" wire:loading.remove wire:target="profile">
                      @if(Auth::user()->profile_photo_path)
                      <a href="javascript:;"><img src="{{asset(Auth::user()->profile_photo_path)}}" id="preview"  alt="" style="border-radius: 50%; width:114px !important; height:114px !important;"></a>
                      <span class="remove-avatar text-center" wire:click.stop="removeAvatar()"><img src="{{asset('assets/fe/images/del2.svg')}}" id="preview" class="del-pic" alt="" /></span>
                      @else
                      <a href="javascript:;"><img src="{{asset('assets/fe/images/im-up.svg')}}" alt="" id="preview" style="border-radius: 50%; width:114px !important; height:114px !important;"></a>
                      @endif
                  </div>

                  <div class="upload-wrp" style="cursor: pointer;" wire:loading wire:target="profile">
                     <img src="{{ asset('/assets/be/images/loading.gif') }}"  id="preview" alt="masked_ic" style="border-radius: 50%; width:100% !important; height:100% !important; padding:20px ;object-fit: unset;" width="70%" />
                  </div>
                  <a href="javascript:void(0)" class="photo-btn upld">
                  <input type="file" class="change-photo" wire:model.defer="profile" value="">
                    @if(Auth::user()->profile_photo_path)
                    Replace Logo
                    @else
                    Upload Logo
                    @endif
                  </a>

              </div>
                  <div style="margin-left: 135px; margin-top: -25px; color: #8f8f8f !important; font-size: 12px;" class="info-error ">
                    <p class="mb-2">Acceptable file formats: JPG/PNG, max size 1MB</p>
                    <span wire:loading.class="d-none" wire:target="profile" class="error-img">
                            @error('profile')
<div class="text-danger error" style="{{isset($style) ? $style : ''}}" wire:loading.class="d-none">
   {{ $message }}
</div>
@enderror
                        </span>
                  </div>

              </div>
              <div class="whole-btn-wrap dual-btn">
                  <input type="submit" value="Back" class="prev-btn">
                 <input type="submit" value="Next" class="nxt-btn" wire:loading.remove wire:target="saveProfile"/>
                <input type="button" value="Next..." class="nxt-btn" wire:loading wire:target="saveProfile"/>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@push('scripts')
<script>
    $(".prev-btn").click(function(e) {
        e.preventDefault();
        location.replace('/company/contact-info')
    })

    document.addEventListener("livewire:load", () => {

    $(".nxt-btn").click(function(e) {
        var val=$('.lg-textarea').val();
        console.log(val);
        Livewire.hook('message.processed', (message, component) => {
        if(val==''){
            $('.lg-textarea').parents('.form-group').find('.text-danger').remove();
            $('.lg-textarea').parents('.form-group').append('<div class="text-danger error dicrip-error" style=""> The company description field is required.</div>');
        }
    })
    })

    {{-- var mask_img = "{{asset('/assets/be/images/masked_ic.png')}}";
    $("body").delegate(".change-photo", "change", function(e) {

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
}); --}}
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
                            $('.error-img').append(errorMessageSize);
                        }, 300);
                    } else {
                        reader.readAsDataURL(file);
                    }
                } else {
                    // If it's not an image, display the error message
                    $('.change-photo').val('');
                    setTimeout(function () {
                        $('.error-img').append(errorMessage);
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

//     $(".nxt-btn").click(function (e) {
//   e.preventDefault();
//   var count = 0;
//   $(this)
//     .parents(".common-form-outr")
//     .find(".gl-frm-outr")
//     .each(function () {
//           var label = $(this).find("label").text();

//         if (label.includes("*")) {
//           if ($(this).find('textarea').val()=="") {
//           $(this).find(".form-group").find(".text-danger").remove();
//           $(this).find(".form-group").find("input").focus();
//           $(this)
//             .find(".form-group")
//             .append(
//               '<div class="text-danger" style=""> This field is required.</div>'
//             );
//           count++;
//           return false;
//             }
//         }

//     });

//   if (count > 0) {
//     $('html, body').animate({
//       scrollTop: $("div.text-danger:first").parent('div').offset().top - 200
//     }, 500);
//     return false;
//   }
//   var errosCount = $(".text-danger").length;
//   if (errosCount < 1) {
//     // location.replace('/company/choose-plan')
//   } else {
//     $('html, body').animate({
//       scrollTop: $("div.text-danger:first").parent('div').offset().top - 200
//     }, 500);
//     $(".text-danger").each(function () {
//       $(this).parents(".form-group").find("input").focus();
//       return false;
//     });
//   }
//   return false;
// });
    // $("body").delegate(".change-photo", "change", function(e) {
    //     Livewire.hook('message.processed', (message, component) => {
    //         setTimeout(() => {
    //             var src = $('.upload-wrp').find('img').attr('src');
    //             $('.avatar-img').find('img').attr('src', src);
    //         }, 1000);
    //     });
    // });

    $("body").delegate(".upload-wrp", "click", function(e) {
        $('.change-photo').trigger('click')
    });

    window.addEventListener('update-avatar', event => {
        console.log('fdsfa');
        $('.upload-wrp').find('img').attr('src',"{{ url('/assets/fe/images/im-up.svg') }}");
          $('.change-photo').val('');
    });
</script>
@endpush
