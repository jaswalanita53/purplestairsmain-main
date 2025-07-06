<div>
<style>
span.visibility-alert {
    text-wrap: nowrap;
}
</style>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
          <div class="form-points">
            @php
            $step = 8; $current_step = auth()->user()->current_step;
            @endphp
            @include('inc.steps',compact('step', 'current_step'))
          </div>
        </div>
      </section>

      <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
          <div class="common-form-outr">
            <div class="form-hdr">
              <h5>More About Me</h5>
              <div>
                {{-- task - 86a0hxg00 @include('inc.autoSaveLoader') --}}
                <a
                  class="skip"
                  {{-- data-fancybox
                  data-src="#open5" --}}
                  href="{{route('candidatestep9')}}"
                  >Skip <em><img src="{{asset('assets/fe/images/skip-arrw.svg')}}" alt="" /></em
                ></a>

                {{-- task - 86a1hvpcy --}}
                <button type="button" class="btn save-later" wire:click="finish_later" style="" >
                    <img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp;{{ $profileSaved ? 'Profile Saved' : 'Finish Later' }}
                </button>
              </div>
            </div>
            <form wire:submit.prevent="saveAbout()" id="saveAbout">
            <div class="gl-form form-sec ">
              {{-- task - 86a0xw1z1 disabled --}}
              <div class="gl-frm-outr mb-5 disable-form-">
                <label>Upload Photo</label>
                <div class="toggle-switch-block" style="right: 0;top: 0; position: relative; float: right;">
                  <span>show</span>
                  <div class="switch_box box_1">
                    <input type="checkbox" class="switch_1 profile_switch" {{ $profile_status ? 'checked' : '' }} data-value="{{ $profile_status }}" {{-- wire:model.lazy="profile_status" --}} wire:ignore/>
                  </div>
                  <span>Hide</span>
                </div>
                   
                <div class="hiden {{ $profile_status ? '' : 'show' }}">
                  <div class="d-span">
                    <img src="{{asset('assets/fe/images/hidden.svg')}}" alt="" />Hidden to everyone

                    <div class="in-ap">
                      <p>
                        This information will only be unmasked to a Requesting
                        company <strong>upon your approval.</strong>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="up-outr-wrp">
                  <div class="upload-wrp" wire:loading.remove wire:target="profile">
                      @if(Auth::user()->profile_photo_path)
                        <a href="javascript:;">
                          @if($profile_status)
                            <img src="{{asset(Auth::user()->profile_photo_path)}}"  id="preview" alt="" style="border-radius: 50%; width:114px !important; height:114px !important;"/>
                          @else
                            <img src="{{asset('/assets/be/images/masked_ic.png')}}"  id="preview" alt="" width="50px" height="50px" style="border-radius:50%; width:114px !important; height:114px !important;" />
                          @endif
                        </a>
                        <span class="remove-avatar text-center" wire:click.stop="removeAvatar()"><img src="{{asset('assets/fe/images/del2.svg')}}" class="del-pic" alt="" /></span>
                      @else
                        <a href="javascript:;">
                          <img src="{{asset('assets/fe/images/profile-pic.png')}}"  id="preview" alt="" style="border-radius: 50%"/>
                          <img src="{{asset('assets/fe/images/up-plus.png')}}"   alt="" class="up-plus" />
                        </a>
                      @endif
                  </div>
                    <div class="upload-wrp" wire:loading wire:target="profile">
                      {{-- <img src="{{ asset('/assets/be/images/loading.gif') }}"  id="preview" alt="masked_ic" style="border-radius:50%; width:100px !important; height:100px !important;" width="70%" /> --}}
                      <img src="{{asset('/assets/be/images/loading.gif')}}"  id="preview" alt="" width="50px" height="50px" style="border-radius:50%; width:114px !important; height:114px !important;" />
                    </div>

                  <a href="javascript:void(0)" class="photo-btn upld">
                    <input type="file" class="change-photo" wire:model.lazy="profile">

                    @if(Auth::user()->profile_photo_path)
                    Replace Photo
                    @else
                    Upload Photo
                    @endif
                  </a>
                </div>
                <div style="margin-left: 135px; margin-top: -25px; color: #8f8f8f !important; font-size: 12px; " class="info-error">
                    <p class="mb-2">Acceptable file formats: JPG/PNG, max size 1MB</p>
                    @include('inc.error', [
                      'field_name' => 'profile',
                    ])
                </div>
                @if($profile_status)
                    <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                @endif
              </div>
              <div class="gl-frm-outr mb-0 disable-form-">
                <label>Short Bio</label>
                <div class="form-group short_bio_div">
                  <textarea placeholder="" class="lg-textarea" wire:model.lazy="short_bio"></textarea>
                  <div class="toggle-switch-block">
                    <span>show</span>
                    <div class="switch_box box_1">
                      <input type="checkbox" class="switch_1 bio_switch" {{ $short_bio_status ? 'checked' : '' }} data-value="{{ $short_bio_status }}" {{-- wire:model.lazy="short_bio_status" --}} wire:ignore/>
                    </div>
                    <span>Hide</span>
                  </div>
                  @if($short_bio_status)
                        <span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>
                    @endif
                  <div class="hiden {{ $short_bio_status ? '' : 'show' }}">
                    <div class="d-span">
                      <img src="{{asset('assets/fe/images/hidden.svg')}}" alt="" />Hidden to everyone

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
                <div class="gl-frm-outr mt-2 ">
                    <label>Allow Recruiters To View My Profile* :</label>
                    <div class="form-sec-left form-group">
                        <div class="form-group-for-custom-checkbox">
                            <div class="form_input_check">
                                <label>
                                    <input type="checkbox" wire:model.defer="allow_recruters_yes" name="active" class="work_environment_checkbox work_environment_remote_checkbox recruters_remote_checkbox "  {{ $allow_recruters_yes ? 'checked' : '' }}/>
                                    <span>Yes</span>
                                </label>
                                <label>
                                    <input type="checkbox" wire:model.defer="allow_recruters_no" name="active" class="work_environment_checkbox work_environment_remote_checkbox recruters_remote_checkbox "  {{ $allow_recruters_no ? 'checked' : '' }} />
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- task - 86a1tzdqv - POINT - 6 --}}
                    <div class="recruiter_message"></div>
                </div>
<style>
.col-4 .form_input_check label {
    padding-left: 25px;
    /* display: inline-block; */
}
.other-ad-source-text{
    padding-left:20px;
    display:none;
}
</style>
                <div class="gl-frm-outr mt-2 ">
                    <label>Where did you hear about us?</label>
                    <div class="form-sec-left form-group">
                        <div class="form-group-for-custom-checkbox row py-3">
                         <span class="col-4">
                            <div class="form_input_check mb-2">
                                <label>
                                    <input type="checkbox" value="WhatsApp Chat"  wire:model.defer="ad_source_whats_app_chat" name="ad_sources" class=" ad_source_checkbox  ad_source_whats_app_chat"  {{ Auth::user()->ad_source=="WhatsApp Chat" ? 'checked' : '' }}/>
                                    <span>WhatsApp Chat</span>
                                </label>
                             </div>
                            <div class="form_input_check mb-2">
                                <label>
                                    <input type="checkbox" value="WhatsApp Status"  wire:model.defer="ad_source_whats_app_status" name="ad_sources" class=" ad_source_checkbox  ad_source_whats_app_status"  {{ Auth::user()->ad_source=="WhatsApp Status" ? 'checked' : '' }}/>
                                    <span>WhatsApp Status</span>
                                </label>
                             </div>
                             </span>
                        <span class="col-4">
                            <div class="form_input_check mb-2">
                                <label>
                                    <input type="checkbox" value="LinkedIn"  wire:model.defer="ad_source_linked_in" name="ad_sources" class=" ad_source_checkbox  ad_source_linked_in"  {{ Auth::user()->ad_source=="LinkedIn" ? 'checked' : '' }}/>
                                    <span>LinkedIn</span>
                                </label>
                             </div>
                            <div class="form_input_check mb-2">
                                <label>
                                    <input type="checkbox" value="Print Ad"  wire:model.defer="ad_source_print_ad" name="ad_sources" class=" ad_source_checkbox  ad_source_print_ad"  {{ Auth::user()->ad_source=="Print Ad" ? 'checked' : '' }}/>
                                    <span>Print Ad</span>
                                </label>
                             </div>
                             </span>
                             <span class="col-4">
                            <div class="form_input_check mb-2">
                                <label>
                                    <input type="checkbox"  value="Online Ad" wire:model.defer="ad_source_online_ad" name="ad_sources" class=" ad_source_checkbox  ad_source_online_ad"  {{ Auth::user()->ad_source=="Online Ad" ? 'checked' : '' }}/>
                                    <span>Online Ad</span>
                                </label>
                             </div>
                            <div class="form_input_check mb-2">
                                <label>
                                    <input type="checkbox" value="Friend/Family"  wire:model.defer="ad_source_friend_family" name="ad_sources" class=" ad_source_checkbox  ad_source_friend_family" {{  Auth::user()->ad_source }} {{ Auth::user()->ad_source=="Friend/Family" ? 'checked' : '' }}/>
                                    <span>Friend/Family</span>
                                </label>
                             </div>
                             </span>

                             <span class="col-4">
                            <div class="form_input_check mb-2">
                                <label>
                                    <input type="checkbox" value="Other"  wire:model.defer="ad_source_other" name="ad_sources" class=" ad_source_checkbox  ad_source_other"  {{ Auth::user()->ad_source=="Other" ? 'checked' : '' }}/>
                                    <span>Other</span>
                                </label>
                             </div>
                             </span>
                             <div class="gl-frm-outr mb-0 other-ad-source-text" >

                                <div class="form-group ">
                                <input type="text" placeholder="" class="form-control w-50 p-0 px-3" wire:model.defer="other_ad_source_text"  value="{{ Auth::user()->other_ad_source_text }}"  maxlength="100"/>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

              <div class="whole-btn-wrap dual-btn">
                <input type="submit" value="Back" class="prev-btn" />
                <span wire:loading.remove wire:target="profile">
                    <input type="submit" value="Preview Profile" class="nxt-btn" wire:loading.remove wire:target="saveAbout"/>
                    <input type="button" value="Saving..." class="nxt-btn" wire:loading wire:target="saveAbout"/>
                </span>
                <span wire:loading wire:target="profile">
                    <input type="button" value="Uploading..." class="nxt-btn"/>
                </span>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
</div>

@push('scripts')
<script>
    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('active');
        checkboxes.forEach((item) => {
            if (item !== checkbox)
            item.checked = false;
        })
    }
     $("body").delegate(".recruters_remote_checkbox", "click", function(e) {
        $('.recruters_remote_checkbox').prop('checked', false);
        $(this).prop('checked', true);


        // task - https://app.clickup.com/t/86a1xw9vh?comment=90130022400560&threadedComment=90130022712443
        $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp;Finish Later');
     })

     $("body").delegate(".ad_source_checkbox", "click", function(e) {
        $('.ad_source_checkbox').prop('checked', false);
        $(this).prop('checked', true);
 if($('.ad_source_other').is(':checked')){
            $('.other-ad-source-text').css('display','block');
        }else{
            $('.other-ad-source-text').css('display','none');
        }
        // task - https://app.clickup.com/t/86a1xw9vh?comment=90130022400560&threadedComment=90130022712443
        $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp;Finish Later');
     })

      // task - https://app.clickup.com/t/86a1xw9vh?comment=90130022400560&threadedComment=90130022712443
      $('.switch_1').on('change', function(event) {
        $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp;Finish Later');
      });
      // task - 86a1xw9vh end

        // task - 86a22j69e
        $(document).on('keyup', 'textarea', function(event) {
            $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp;Finish Later');
        });
        // task - 86a22j69e end

      $('#saveAbout').on('submit', function(e) {
           e.preventDefault();
           @this.set('ad_source_linked_in', $('.ad_source_linked_in:checked').val());
           @this.set('ad_source_print_ad', $('.ad_source_print_ad:checked').val());
           @this.set('ad_source_online_ad', $('.ad_source_online_ad:checked').val());
           @this.set('ad_source_friend_family', $('.ad_source_friend_family:checked').val());
           @this.set('ad_source_whats_app_chat', $('.ad_source_whats_app_chat:checked').val());
           @this.set('ad_source_whats_app_status', $('.ad_source_whats_app_status:checked').val());
           @this.set('ad_source_other', $('.ad_source_other:checked').val());
           @this.set('other_ad_source_text', $('.other-ad-source-text input').val());
           @this.set('allow_recruters_yes', $('.recruters_remote_checkbox:first').is(':checked'));
           @this.set('allow_recruters_no', $('.recruters_remote_checkbox:last').is(':checked'));
           @this.set('allow_recruters_no', $('.recruters_remote_checkbox:last').is(':checked'));

           // task - 86a1xw9vh
           @this.set('profile_status', $('.profile_switch').prop('checked'));
           @this.set('short_bio_status', $('.bio_switch').prop('checked'));
      })

      // task - 86a1xw9vh
      $(".save-later").click(function(e) {
        @this.set('profile_status', $('.profile_switch').prop('checked'));
        @this.set('short_bio_status', $('.bio_switch').prop('checked'));
      });

    $(".prev-btn").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/references')
    })
    $(".nxt-btn,.skip").click(function(e) {
        // e.preventDefault(); task - 86a0hxg00
        // location.replace('/candidate/approval')
        // window.location.href='{{url("/candidate/approval")}}'; task - 86a0hxg00

        // task - 86a1tzdqv - POINT - 6
        $('.recruiter_message').html('');
        if($('.recruters_remote_checkbox:checked').length == 0) {
          $('.recruiter_message').html('<div class="error" style="font-size: 14px"> <small class="text-danger">This field is required</small></div>');
          return false;
        }
        // task - 86a1tzdqv - POINT - 6 end
    });

    // task - 86a1krdtg
    var original_avatar = '{{ Auth::user()->profile_photo_path ? asset(Auth::user()->profile_photo_path) : "" }}';
    var pr_status = '{{ $profile_status }}';
    var no_img = '{{ asset('assets/fe/images/profile-pic.png') }}';
    var mask_img = '{{ asset('/assets/be/images/masked_ic.png') }}';

    $('.upload-wrp').on('mouseover', function(event) {
      // pr_status = @this.get('profile_status');
      pr_status = $('.profile_switch').prop('checked') ? 1 : 0;
      if(original_avatar && pr_status==0) {
        $('.upload-wrp #preview').attr('src', original_avatar);
      } else if(original_avatar == "" && pr_status==0) {
        $('.upload-wrp #preview').attr('src', no_img);
      }
    });

    $('.upload-wrp').on('mouseout', function(event) {
      // pr_status = @this.get('profile_status');
      pr_status = $('.profile_switch').prop('checked') ? 1 : 0;
      if(pr_status==0) {
        $('.upload-wrp #preview').attr('src', mask_img);
      }
    });
    // task - 86a1krdtg end


    document.addEventListener("livewire:load", () => {
$('.ad_source_checkbox').each(function(){
    if ($(this).val() == '{{ Auth::user()->ad_source }}') {
        $(this).prop('checked', true);
        if($(this).val()=='Other'){
         $('.other-ad-source-text').css('display','block');
         }
    }
});
$('.other-ad-source-text input').val('{{ Auth::user()->other_ad_source_text }}');

      triggerSwitch();
    });

    function triggerSwitch() {
        $('.switch_1').each(function(index, el) {
            if ($(el).attr('data-value') == 1) {
                $(el).parents(".toggle-switch-block").next().removeClass("show");
                $(el).prop('checked', true);

                // task - 86a2ej6uy
                if($(el).hasClass('profile_switch')) {
                    $(el).parents('.disable-form-').find('.info-error').after('<span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>');
                } else {
                    $(el).parents('.toggle-switch-block').after('<span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>');
                }
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

    // check which switch is changed
    var is_valid_switch = true;
    $('.profile_switch').on('change', function(event) {
      pr_status = $(this).prop('checked') ? 1 : 0;
      if(original_avatar && pr_status==0) {
        $('.upload-wrp').find('a').find('#preview').attr('src', mask_img);
      } else if(original_avatar && pr_status==1) {
        $('.upload-wrp').find('a').find('#preview').attr('src', original_avatar);
      } else if(original_avatar == "" && pr_status==0) {
        $('.upload-wrp').find('a').find('#preview').attr('src', no_img);
      }
    });

    var mask_img = "{{asset('/assets/be/images/masked_ic.png')}}";

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
                    original_avatar = e.target.result;
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
          $('.upload-wrp').find('a').find('#preview').attr('src', '{{asset('')}}' + event.detail.newPath );
          var src = $('.upload-wrp').find('a').find('#preview').attr('src');
          $('.avatar-img').find('img').attr('src', src);
      }, 1000);

      setTimeout(() => {
          var _status = '{{ $profile_status }}';
          if(_status == '0') {
            $('.avatar-img').find('img').attr('src', mask_img);
            $('.upload-wrp').find('a').find('#preview').attr('src', mask_img);
          }
      }, 2000);
    });

    window.addEventListener('update-avatar', event => {
      setTimeout(() => {
          original_avatar = ""; // task - 86a1xw9vh
          var src = $('.upload-wrp').find('#preview').attr('src');
          $('.avatar-img').find('img').attr('src', src);
      }, 1000);
    });


    document.addEventListener("livewire:load", function () {
    /*Livewire.hook("element.updating", (el, component) => {
        // Check if the updating element has the wire:target="profile" attribute
        if ($(el).is('[wire\\:target="profile"]')) {
            console.log("Element with wire:target='profile' is updating (loading)");
            // Your logic for when the specific element is updating

            // task - 86a1tzdqv - POINT - 7
            var mask_img_ = "{{asset('/assets/be/images/masked_ic.png')}}";
            var _status = @this.get('profile_status');
            setTimeout(() => {
              if(!_status) {
                $('.avatar-img').find('img').attr('src', mask_img_);
                $('.upload-wrp').find('a').find('#preview').attr('src',mask_img_); console.log(mask_img_);
              }
            }, 500);
            // task - 86a1tzdqv - POINT - 7 end
        }
    });*/

    {{-- Livewire.hook("element.updated", (el, component) => {
        // Check if the updated element has the wire:target="profile" attribute
         var mask_img_ = "{{asset('/assets/be/images/masked_ic.png')}}";
         console.log('el',el);
        if ($(el).is('[wire\\:target="profile"]')) {
            setTimeout(() => {
          var src = $('.upload-wrp').find('#preview').attr('src',mask_img_);

      }, 2000);
        }
    }); --}}
});

  window.addEventListener('livewire-upload-finish', event => {
    var mask_img_ = "{{asset('/assets/be/images/masked_ic.png')}}";
     setTimeout(() => {
        // task - 86a1tzdqv - POINT - 7
        // var src = $('.upload-wrp').find('#preview').attr('src',mask_img_);
        var _status = @this.get('profile_status');
        if(!_status) {
          $('.avatar-img').find('img').attr('src', mask_img);
          $('.upload-wrp').find('#preview').attr('src',mask_img_);
        }
        // task - 86a1tzdqv - POINT - 7 end
      }, 1000);
  })

    $("body").delegate(".disable-form- .switch_1", "click", function(e) {
        if($(this).is(':checked')){
            $(this).parents('.gl-frm-outr').find('.hiden.show').remove();
            $(this).parents('.disable-form-').find('.visibility-alert').remove();

            // task - 86a2ej6uy
            if($(this).hasClass('profile_switch')) {
                $(this).parents('.disable-form-').find('.info-error').after('<span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>');
            } else {
                $(this).parents('.toggle-switch-block').after('<span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>');
            }
         }else{
            $(this).parents('.disable-form-').find('.visibility-alert').remove();
            $(this).parents('.gl-frm-outr').find('.hiden.show').remove();
            $(this).parents('.toggle-switch-block').after('<div class="hiden show"><div class="d-span"><img src="{{asset("assets/fe/images/hidden.svg")}}" alt="">Hidden to everyone<div class="in-ap"> <p>This information will only be unmasked to a Requesting company <strong>upon your approval.</strong> </p>    </div>   </div>                        </div>');

        }

    });
    /* task - 86a23ej3p $("body").delegate(".disable-form- .switch_1", "click", function(e) {
        if($(this).is(':checked')){
            $(this).parents('.gl-frm-outr').find('.hiden.show').remove();
            $(this).parents('.disable-form-').find('.visibility-alert').remove();
            $(this).parents('.toggle-switch-block').after('<span class="visibility-alert"><i class="fa  fa-eye-slash"></i> Public Visibility Alert: This field is visible to everyone. If privacy is important to you, select "Hide".</span>');
         }else{
            $(this).parents('.disable-form-').find('.visibility-alert').remove();
            $(this).parents('.gl-frm-outr').find('.hiden.show').remove();
            $(this).parents('.toggle-switch-block').after('<div class="hiden show"><div class="d-span"><img src="{{asset("assets/fe/images/hidden.svg")}}" alt="">Hidden to everyone<div class="in-ap"> <p>This information will only be unmasked to a Requesting company <strong>upon your approval.</strong> </p>    </div>   </div>                        </div>');

        }
    });*/
</script>
@endpush
