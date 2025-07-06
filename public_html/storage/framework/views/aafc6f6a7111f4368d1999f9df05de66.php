<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
<?php $__env->stopPush(); ?>
<div>
  <section class="profile-banner cmn-gap pb-0 ban-up">
    <div class="container">
      <div class="form-points">
        <?php
        $step = 5; $current_step = auth()->user()->current_step;
        ?>
        <?php echo $__env->make('inc.steps',compact('step', 'current_step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>

  <div class="common-form-wrap cmn-gap pt-0">
    <div class="container">
      <div class="common-form-outr">
        <div class="form-hdr">
          <h5>Employment</h5>
          <div>
            
            <a class="skip skip-5th-step"  href="javascript:void(0)">Skip <em><img src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em></a>
          </div>
        </div>

        <form wire:submit.prevent="saveEmployement()" id="saveEmployement">
        <div class="gl-form form-sec">
          <div class="warn-txt ">
            <img src="<?php echo e(asset('assets/fe/images/warn.svg')); ?>" alt="" />
            <span>Make Sure To Add Your Earliest Position To Qualify As An "Experienced"
                Candidate On Our Platform. <strong>Enter your most recent position first.</strong></span>
          </div>

          <?php $__currentLoopData = $employments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($key > 0): ?>
          <h6>
            Enter Previous Employment

            
            <button type="button" class="remove_additional_sec" wire:click="removeEmp(<?php echo e($employment->id); ?>)"><img src="<?php echo e(asset('assets/fe/images/delete.svg')); ?>" alt="Remove Section" /></button>
          </h6>
          <?php endif; ?>
          <div class="gl-frm-outr mb-2">
            <label>Company name</label>
            <div class="form-group">
              <input type="text" placeholder="" class="form-control" wire:model.lazy="company_name.<?php echo e($employment->id); ?>" />
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1 company_name_status_<?php echo e($employment->id); ?>" checked="" data-value="<?php echo e($employment->company_name_status); ?>" wire:model.lazy="company_name_status.<?php echo e($employment->id); ?>" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
              <div class="hiden <?php echo e($employment->company_name_status ? '' : 'show'); ?>">
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
          <div class="gl-frm-outr mb-2">
            <label>Position/Title</label>
            <div class="form-group">
              <input type="text" placeholder="" class="form-control" wire:model.lazy="position.<?php echo e($employment->id); ?>" />
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1 position_status_<?php echo e($employment->id); ?>" checked="" data-value="<?php echo e($employment->position_status); ?>" wire:model.lazy="position_status.<?php echo e($employment->id); ?>" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
              <div class="hiden <?php echo e($employment->position_status ? '' : 'show'); ?>">
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
          <div class="gl-frm-outr mb-2">
            <label>Position Responsibilities</label>
            <div class="form-group">
              <textarea placeholder="" class="lg-textarea" wire:model.lazy="responsibilities.<?php echo e($employment->id); ?>"></textarea>
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1 responsibilities_status_<?php echo e($employment->id); ?>" checked="" data-value="<?php echo e($employment->responsibilities_status); ?>" wire:model.lazy="responsibilities_status.<?php echo e($employment->id); ?>" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
              <div class="hiden <?php echo e($employment->responsibilities_status ? '' : 'show'); ?>">
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

          <div class="gl-frm-outr mb-2">
            <label>Years:</label>
            <div class="form-group for-dropdown-option for-abs-label">
              <div class="input-field-dropdown">
                <div class=" input-daterange">
                  <div class="yr-field" wire:ignore:self> <input type="text" class="form-control input1" placeholder="Start Date" wire:model.defer="start_year.<?php echo e($employment->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="start_year.<?php echo e($employment->id); ?>" /></div>

                  
                  <?php if($currently_working[$employment->id]): ?>
                  <div class="">
                    <input type="text" class="form-control input2" placeholder="End Date " value="PRESENT" wire:key="end_year_currently.<?php echo e($employment->id); ?>" />
                  </div>
                  <?php else: ?>
                  <div class="yr-field" wire:ignore:self> <input type="text" class="form-control input2" placeholder="End Date " wire:model.defer="end_year.<?php echo e($employment->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="end_year.<?php echo e($employment->id); ?>" /> </div>
                  <?php endif; ?>

                </div>

              </div>
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1 start_year_status_<?php echo e($employment->id); ?>" checked="" data-value="<?php echo e($employment->start_year_status); ?>" wire:model.lazy="start_year_status.<?php echo e($employment->id); ?>" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
              <div class="hiden <?php echo e($employment->start_year_status ? '' : 'show'); ?>">
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
            <?php if(isset($end_year_error[$employment->id])): ?>
            
            <?php endif; ?>
            <div class="form-group">
              <label>
                <input type="checkbox" class="" <?php if($employment->currently_working): ?> checked=true <?php endif; ?> wire:model.lazy="currently_working.<?php echo e($employment->id); ?>" />
                &nbsp;<span>This is my current position</span>
              </label>

            </div>
          </div>
          <div class="gl-frm-outr mb-0">
            <label>Position Accomplishments</label>
            <div class="form-group">
              <textarea placeholder="" class="lg-textarea" wire:model.lazy="accomplishments.<?php echo e($employment->id); ?>"></textarea>
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1 accomplishments_status_<?php echo e($employment->id); ?>" checked="" data-value="<?php echo e($employment->accomplishments_status); ?>" wire:model.lazy="accomplishments_status.<?php echo e($employment->id); ?>" tabindex="-1" />
                </div>
                <span>Hide</span>
              </div>
              <div class="hiden <?php echo e($employment->accomplishments_status ? '' : 'show'); ?>">
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

          <!-- Task 862k42apk
          <div class="form-bulb">
            <span><img src="<?php echo e(asset('assets/fe/images/like-up.png')); ?>" alt="" /></span>
            <p>
              You know you’re the best in the field. Share something that lets
              us know it too!
            </p>
          </div> -->
          <hr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


          <div class="gl-frm-btn">
            <a href="#" class="pos-btn" wire:click.prevent="add()">
              Add Previous Position
              <span>+</span>
            </a>
          </div>
          <div class="whole-btn-wrap dual-btn">
            <input type="submit" value="Back" class="prev-btn" />
            <input type="submit" value="Next" class="nxt-btn" wire:loading.remove wire:target="saveEmployement"/>
            
            <input type="button" value="Saving..." class="nxt-btn" wire:loading wire:target="saveEmployement"/>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  //initiate languages select2
  document.addEventListener("livewire:load", () => {
    initDates();
    changePage();

    Livewire.on('newEmploymentAdded', function() {
      initDates();
      changePage();
      triggerSwitch();
    });

    Livewire.hook('message.processed', (message, component) => {
      let company_name_status = component.serverMemo.data.company_name_status;
      let position_status = component.serverMemo.data.position_status;
      let responsibilities_status = component.serverMemo.data.responsibilities_status;
      let start_year_status = component.serverMemo.data.start_year_status;
      let accomplishments_status = component.serverMemo.data.accomplishments_status;

      console.log('Hook...', component.serverMemo.data);
      $.each(company_name_status, function(index, val) {
        /* iterate through array or object */
        if(val) {
            $('.company_name_status_'+index).parents(".toggle-switch-block").next().removeClass("show");
        } else {
            $('.company_name_status_'+index).parents(".toggle-switch-block").next().addClass("show");
        }
      });

      $.each(position_status, function(index, val) {
        /* iterate through array or object */
        if(val) {
            $('.position_status_'+index).parents(".toggle-switch-block").next().removeClass("show");
        } else {
            $('.position_status_'+index).parents(".toggle-switch-block").next().addClass("show");
        }
      });

      $.each(responsibilities_status, function(index, val) {
        /* iterate through array or object */
        if(val) {
            $('.responsibilities_status_'+index).parents(".toggle-switch-block").next().removeClass("show");
        } else {
            $('.responsibilities_status_'+index).parents(".toggle-switch-block").next().addClass("show");
        }
      });

      $.each(start_year_status, function(index, val) {
        /* iterate through array or object */
        if(val) {
            $('.start_year_status_'+index).parents(".toggle-switch-block").next().removeClass("show");
        } else {
            $('.start_year_status_'+index).parents(".toggle-switch-block").next().addClass("show");
        }
      });

      $.each(accomplishments_status, function(index, val) {
        /* iterate through array or object */
        if(val) {
            $('.accomplishments_status_'+index).parents(".toggle-switch-block").next().removeClass("show");
        } else {
            $('.accomplishments_status_'+index).parents(".toggle-switch-block").next().addClass("show");
        }
      });
    });
  })

  $(document).on('change', '.switch_1', function () {
      if($(this).prop('checked')) {
          $(this).parents(".toggle-switch-block").next().removeClass("show");
      } else {
          $(this).parents(".toggle-switch-block").next().addClass("show");
      }
  });
  $(document).on('change', '.input2', function () {
      $(this).parents('.gl-frm-outr').find('.text-danger').remove();
  });

  function triggerSwitch() {
    $('.switch_1').each(function(index, el) {
      console.log('change');
      if ($(el).attr('data-value') == 1) {
        $(el).parents(".toggle-switch-block").next().removeClass("show");
        $(el).prop('checked', true);
      } else {
        $(el).parents(".toggle-switch-block").next().addClass("show");
        $(el).prop('checked', false);
      }
      $(el).trigger('change');
    });
  }

  function initDates() {
    let el = $('.input-daterange .yr-field .form-control')
    initDate();
    Livewire.hook('message.processed', (message, component) => {
      initDate();

       console.log('Hook...', component.serverMemo.data);
    })

    function initDate() {
      el.datepicker({
        format: 'M yyyy',
        updateViewDate: true,
        autoclose: true,
        viewMode: "months",
        minViewMode: "months",
        endDate: new Date()
      });
    }
  }

  function changePage() {
    $(".prev-btn").click(function(e) {
      e.preventDefault();
      location.replace('/candidate/education')
    })
    /* task - 862k30hze $(".nxt-btn").click(function(e) {
      e.preventDefault();
      location.replace('/candidate/skills')
    })*/
  }

  var form_submit = false;
  $("body").delegate(".skip-5th-step, .nxt-btn", "click", function(e) {
    var most_employement = 1; other_employement = 0;

    var count = 0;
    count=$('.text-danger').length;
    $('#saveEmployement .input-daterange').each(function(index, el){
       var start =$(this).find('input:first');
       var end =$(this).find('input:last');
       console.log(start, end, start.val(), end.val())
       if(start.val()!=""){

          if(end.val()==""){
              $(this).find('input:last').focus();
              $(this).parents('.gl-frm-outr').find('.error').remove();
              $(this).parents('.gl-frm-outr').find('.form-group:last').prepend('<div class="error" style="margin-top: -10px;"> <small class="text-danger">You must select an end date. </small></div>');
              count++;
         }
       }
       if(end.val()!=""){
        if(start.val()==""){
            $(this).find('input:first').focus();
            $(this).parents('.gl-frm-outr').find('.error').remove();
            $(this).parents('.gl-frm-outr').find('.form-group:last').prepend('<div class="error" style="margin-top: -10px;"><small class="text-danger">You must select a start date. </small></div>');
            count++;
        }
       }

        // task - 86a0fxne0
        if(index == 0 && ((start.val() == '' && end.val() == '') || (start.val() != '' && end.val() == ''))) {
          most_employement = 0;
        } else if((start.val() == '' && end.val() == '') || (start.val() != '' && end.val() == '')) {
          other_employement ++;
        }
    })

    if (count > 0) {
        return false;
    } else {
      // task - 862k3f10h
      let filled_fields = 1;
      $('#saveEmployement input').each(function(index, el) {
        if(el.type == 'text') {  // task #86a0f92wg
          if($.trim($(el).val()) == '') {
            filled_fields = 0;
          }
          if($(el).hasClass('input1')) {
          }
        }
      });

      // task - 862k46fh0
      var end_Y_CNT = 0;

      // task - 86a0d8f9t
      var start_Y_CNT = 0;
      $('#saveEmployement input').each(function(index, el) {
        var end_years2 = window.livewire.find('<?php echo e($_instance->id); ?>').get('end_year');
        var start_years2 = window.livewire.find('<?php echo e($_instance->id); ?>').get('start_year');

        if(el.type == 'checkbox') {
          let _end_Y = null;
          let _start_Y = null;
          if($(el).prop('checked') === false && !$(el).hasClass('switch_1')) {
            let F__ = $(el).attr('wire:model.lazy');
            console.log($(el), F__);
            let spl_ = F__.split('.');
            let idx_ = parseInt(spl_[1]);
            _end_Y = end_years2[idx_];
            _start_Y = start_years2[idx_];

            if(_start_Y && (_end_Y == '' || _end_Y == null)) {
              end_Y_CNT ++;
              Livewire.emit('updateErrors', idx_);
            }
          }
        } else if(el.type == 'text' && $(el).hasClass('input1')) { // task - 86a0d8f9t
          let F__ = $(el).attr('wire:key');
          let spl_ = F__.split('.');
          let idx_ = parseInt(spl_[1]);
          _start_Y = start_years2[idx_];

          if(_start_Y == '' || _start_Y == null) {
            start_Y_CNT ++;
            Livewire.emit('updateValidation', idx_);
          }
        }
      });

      if(end_Y_CNT > 0) {
        $('html, body').animate({
          scrollTop: $("div.error:first").offset().top - 200
        }, 500);

        return false;
      }
      // task - 862k46fh0 end
      // task - 862k3f10h end

      if(form_submit) {
        return form_submit;
      }

      // task - 86a0fxne0
      var alert_title = "Opting out of this section (or years of employment) causes you to appear as an entry-level cabdidate. To avoid this without revealing your position, add your information and select the hide option.";
      if(most_employement == 1 && other_employement > 0) {
        alert_title = "you have added previous employement section but you have not filled up any information in other section(s)."
      }
      // task - 86a0fxne0 end

      var _return_val = false;
      if(filled_fields == 0 || (most_employement == 1 && other_employement > 0)) {
          e.preventDefault();
          Swal.fire({
            title: alert_title,
            text: 'Are you sure you want to skip?',
            icon: 'warning',
            iconHtml: "<img src='<?php echo e(asset('assets/fe/images/warning.png')); ?>'>",
            showCancelButton: true,
            confirmButtonColor: '#7E50A7',
            cancelButtonColor: '#4A2D64',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            showCloseButton: true,
          }).then((result) => {
            if (result.isConfirmed) {
              // window.location.href='<?php echo e(url("/candidate/skills")); ?>'; task - 86a0hxg00
              form_submit = true;
              $('.nxt-btn').trigger('click');
              return true;
            } else {
              $('html, body').animate({
                scrollTop: $("div.error:first").offset().top - 200
              }, 500);
              return false;
            }
          });
      } else {
        // window.location.href='<?php echo e(url("/candidate/skills")); ?>'; task - 86a0hxg00
        return true;
      }
    }
  })

  document.addEventListener("livewire:load", () => {
            $(document).ready(function(){
                $('.warn-txt').addClass('blink');
            })
    });

      $("body").delegate(".skills-step-btn", "click", function(e) {
        $('.skip-5th-step').trigger('click');
        e.preventDefault();
    return false;
      })

       window.addEventListener('init-dates', event => {
                initDates()
            });

            function initDates() {
                let el = $('.input-daterange .yr-field .form-control');
                initDate();
                Livewire.hook('message.processed', (message, component) => {
                    initDate()
                })

                function initDate() {
                    // el.datepicker({
                    $('.input1, .input2').datepicker({
                        format: 'M yyyy',
                        updateViewDate: true,
                        autoclose: true,
                        viewMode: "months",
                        minViewMode: "months",
                        endDate: new Date()
                    });
                }
            }
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidate-step5.blade.php ENDPATH**/ ?>