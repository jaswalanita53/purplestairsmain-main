<div>
    <style type="text/css">
        .profile-popup {
            pointer-events: none;
            opacity: 0.5;
        }
    </style>
    <!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>


    <div class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="sec-hdr">
                <h1>Candidate Profile</h1>
            </div>
            <div class="form-points mb-5">
                <?php
                $step = 1; $current_step = auth()->user()->current_step;
                ?>
                <?php echo $__env->make('inc.steps',compact('step', 'current_step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="profile-popup-wrap cutsom-purple-wrap">
                <div class="row align-items-center ps-5 pe-5">
                    <div class="col-md-10">
                        <div class="profile-popup-rgt">
                            <p style="padding: 0;">
                                <strong> You decide what will be shown or hidden </strong>
                                An employer who is interested in learning more about you will submit a request. You can choose to allow or deny a request to show all your information to that specific employer.
                            </p>
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
    <div class="common-form-wrap cmn-gap">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>Personal Information</h5>
                    
                </div>
                <form wire:submit.prevent="saveProfile()" id="saveProfile">
                <div class="gl-form form-sec">
                    <div class="gl-frm-outr mb-3">
                        <label>Name*</label>
                        <div class="form-group disable-form">
                            <input type="text" placeholder="" class="form-control user-name-field" wire:model.defer="name" />
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1 name-status" tabindex="-1" <?php if($name_status): ?> checked <?php endif; ?> />
                                </div>
                                <span>Hide</span>
                            </div>
                            <?php echo $__env->make('inc.error', [
                            'field_name' => 'name',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                    <div class="gl-frm-outr mb-3">
                        <label>Email*</label>
                        <div class="form-group disable-form">
                            <input type="email" placeholder="" class="form-control readonly-email" wire:model.defer="email" readonly />
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
                    <div class="gl-frm-outr mb-3">
                        <label>Phone*</label>
                        <div class="form-group disable-form">
                            <input type="tel" placeholder="xxx-xxx-xxxx" id="telle" maxlength="12" class="form-control" wire:model.defer="phone" />
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
                    <div class="gl-frm-outr mb-3">
                        <label>Current Title</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control" wire:model.defer="current_title" />
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

                    <!-- Task 862k42apk
                      <div class="form-bulb">
                        <span><img src="<?php echo e(asset('assets/fe/images/mega-phone.png')); ?>" alt="" /></span>
                        <p>
                          First Impressions Count. Put your best foot forward with a title
                          that says it awesomely!
                        </p>
                      </div> -->

                    <div class="gl-frm-outr">
                        
                        <label>Zipcode* <em> (Center of Work Radius)</em></label>
                        <div class="form-group disable-form">
                            <input type="text" placeholder="" class="form-control zip_code_field-" wire:model.defer="zip_code" id="zipcode" maxlength="10"/>
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

                    <div class="gl-frm-outr mb-3">
                        <label>Linkedin URL </label>
                        <div class="disable-form form-group">
                            <input type="url" placeholder="" class="form-control" wire:model.defer="linkedin_url" />
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
                        <div class="disable-form form-group">
                            <input type="url" placeholder="" class="form-control" wire:model.defer="additional_url" />
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
                    <!-- Task 862k42apk
                      <div class="form-bulb">
                        <span><img src="<?php echo e(asset('assets/fe/images/star2.png')); ?>" alt="" /></span>
                        <p>
                          Insert A Link Here That Will Impress.
                        </p>
                      </div> -->
                    <div class="whole-btn-wrap text-end">
                        <input type="submit" value="Next" class="nxt-btn" wire:loading.remove wire:target="saveProfile"/>
                        <input type="button" value="Next..." class="nxt-btn" wire:loading wire:target="saveProfile"/>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<style>
  /* Custom styles for the alert modal */
  #alertModalLabel {
   color: var(--purple);
   padding-top: 0px;
   padding-bottom: 0px;
  }
  #alertModal .modal-dialog {
    max-width: 500px;
    margin: 14.75rem auto;
}
  .alrt-close {
    border: none;
    background: none;
    color: var(--purple);
    padding: 1px;
    font-size: 28px;
    padding-top: 0px !important;
    padding-left: 0px !important;
}
#alertModal .modal-content {

    border-radius: 1.3rem;
    /* outline: 0; */
}
</style>

<!-- Hidden Modal -->
<div class="modal fade my-auto mx-auto" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="alertModalLabel">Your Name Is Not Hidden From Your Current Employer!</h5>
        <button type="button" class="close alrt-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="alertModalBody">
        <p>If you would like more privacy, you can select "Hide" to make your name invisible. You will be able to "Show" all your details to approved employers who specifically request to see your full profile.</p>
      </div>
      <!-- <div class="modal-footer border-0">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div> -->
    </div>
  </div>
</div>
<style>
    h2#swal2-title {
    padding: 0px 16px !important;
    text-align: center !important;
    order: 2;
}
.swal2-close:focus {
    outline: 0;
    box-shadow: unset;
}
div#swal2-html-container {
    margin: 0px !important;
    padding: 13px 10px;
}

.swal2-popup.swal2-modal.swal2-icon-warning.swal2-show {
    width: 30%;
    padding-top: 13px !important;
    padding-bottom: 41px !important;
}
</style>
<script>
  function showAlert(message) {

    // $("#alertModal").modal("show");
    Swal.fire({

title: 'If you would like more privacy, you can select "Hide" to make your name invisible. You will be able to "Show" all your details to approved employers who specifically request to see your full profile.',
text: 'Your Name Is Not Hidden From Your Current Employer!',
icon: 'warning',
iconHtml: "<img src='<?php echo e(asset('assets/fe/images/warning.png')); ?>'>",
showCancelButton: false,
showConfirmButton: false,
confirmButtonColor: '#7E50A7',
cancelButtonColor: '#4A2D64',
confirmButtonText: 'Yes',
cancelButtonText: 'No',
showCloseButton: true,
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = "<?php echo e(route('candidatestep6')); ?>"
} else {
  return false;
}
})
  }
</script>


<?php $__env->startPush('scripts'); ?>
<script>
    //   $(".nxt-btn").click(function(e) {
    //     e.preventDefault();
    //     location.replace('/candidate/position-preferences')
    //   })

    // $(".nxt-btn").click(function(e) {
    //     e.preventDefault();
    $('#saveProfile').on('submit', function(event) {
        console.log('test');
        /* Act on the event */
        $(".text-danger").remove();
        var count = 0;
        $(this)
            .parents(".common-form-outr")
            .find(".gl-frm-outr")
            .each(function() {
                var label = $(this).find("label").text();

                if (label.includes("*")) {
                    if ($(this).find('input ').val() == "") {
                        $(this).find(".form-group").find(".text-danger").remove();
                        $(this).find(".form-group").find("input:first").focus();
                        $(this)
                            .find(".form-group")
                            .append(
                                '<div class="text-danger" style=""> This field is required.</div>'
                            );
                        count++;
                        // return false;
                    }
                }

            });

        if (count > 0) {
            return false;
        }
        var errosCount = $(".text-danger").length;
        if (errosCount < 1) {
            // location.replace('/candidate/position-preferences')
            // window.location.href='<?php echo e(url("/candidate/position-preferences")); ?>';
            // return true;
        } else {
            $('html, body').animate({
                scrollTop: $("div.text-danger:first").offset().top - 200
            }, 800);
            $(".text-danger").each(function() {
                $(this).parents(".form-group").find("input").focus();
                return false;
            });
        }
        return false;
    });

    //Add dashes to phone input
    var tele = document.querySelector('#telle');

    tele.addEventListener('keyup', function(e) {
        if (event.key != 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)) {
            tele.value += '-';
        }
    });

    

    $("body").delegate(".alrt-close", "click", function(e) {
        $('.modal').modal('hide');
    })


    document.addEventListener("livewire:load", () => {
        $("body").delegate(".name-status", "click", function(e) {
            if ($(this).prop('checked')) {
                showAlert();
                val = true;
            } else {
                val = false;
            }
            window.livewire.find('<?php echo e($_instance->id); ?>').set('name_status', val)


        })

        /*document.querySelector('#filters-form').onkeypress = function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        }*/
    });

  document.addEventListener("livewire:load", () => {
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
});
  document.addEventListener("livewire:load", () => {
    $("body").delegate("#zipcode", "input", function(e) {
        $(this).parents('.form-group').find('.text-danger').remove();
    });
    const zipcodeInput = document.getElementById("zipcode");
    zipcodeInput.addEventListener("keyup", function() {
            
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
            console.log(Object.keys(component.serverMemo.errors).length);
            if(!Object.keys(component.serverMemo.errors).length) {
                $(".text-danger").remove();
            }

            var errosCount = $(".text-danger").length;
            if (errosCount < 1) {
                // location.replace('/candidate/position-preferences')
                // window.location.href='<?php echo e(url("/candidate/position-preferences")); ?>';
                return true;
            } else {
                $('html, body').animate({
                    scrollTop: $("div.text-danger:first").offset().top - 200
                }, 800);
                $(".text-danger").each(function() {
                    $(this).parents(".form-group").find("input").focus();
                    return false;
                });
            }
               
        })
});




</script>


<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidate-step1.blade.php ENDPATH**/ ?>