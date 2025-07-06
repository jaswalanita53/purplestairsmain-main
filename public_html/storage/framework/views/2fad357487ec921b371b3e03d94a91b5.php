<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
<?php $__env->stopPush(); ?>
<div>
  <section class="profile-banner cmn-gap pb-0 ban-up">
    <div class="container">
      <div class="form-points">
        <?php
        $step = 5
        ?>
        <?php echo $__env->make('inc.steps',compact('step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>

  <div class="common-form-wrap cmn-gap pt-0">
    <div class="container">
      <div class="common-form-outr">
        <div class="form-hdr">
          <h5>Employment</h5>
          <div>
            <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <a class="skip"  href="<?php echo e(route('candidatestep6')); ?>">Skip <em><img src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em></a>
          </div>
        </div>
        <div class="gl-form form-sec">
          <div class="warn-txt text-end">
            <img src="<?php echo e(asset('assets/fe/images/warn.svg')); ?>" alt="" />
            <span>Add most recent First</span>
          </div>

          <?php $__currentLoopData = $employments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($key > 0): ?>
          <h6>Enter Previous Employment</h6>
          <?php endif; ?>
          <div class="gl-frm-outr mb-2">
            <label>Company name</label>
            <div class="form-group">
              <input type="text" placeholder="" class="form-control" wire:model.lazy="company_name.<?php echo e($employment->id); ?>" />
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($employment->company_name_status); ?>" wire:model.lazy="company_name_status.<?php echo e($employment->id); ?>" tabindex="-1" />
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
                  <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($employment->position_status); ?>" wire:model.lazy="position_status.<?php echo e($employment->id); ?>" tabindex="-1" />
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
                  <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($employment->responsibilities_status); ?>" wire:model.lazy="responsibilities_status.<?php echo e($employment->id); ?>" tabindex="-1" />
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
            <label>Year Duration:</label>
            <div class="form-group for-dropdown-option for-abs-label">
              <div class="input-field-dropdown">
                <div class=" input-daterange">
                  <div class="yr-field" wire:ignore:self> <input type="text" class="form-control input1" placeholder="Start Year" wire:model="start_year.<?php echo e($employment->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="start_year.<?php echo e($employment->id); ?>" /></div>

                  <?php if($employment->currently_working): ?>
                  <div class="">
                    <input type="text" class="form-control input2" placeholder="End Year" value="<?php echo e(Carbon\Carbon::now()->format('M Y')); ?>" wire:key="end_year_currently.<?php echo e($employment->id); ?>" />
                  </div>
                  <?php else: ?>
                  <div class="yr-field" wire:ignore:self> <input type="text" class="form-control input2" placeholder="End Year" wire:model="end_year.<?php echo e($employment->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="end_year.<?php echo e($employment->id); ?>" /> </div>
                  <?php endif; ?>

                </div>

              </div>
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($employment->start_year_status); ?>" wire:model.lazy="start_year_status.<?php echo e($employment->id); ?>" tabindex="-1" />
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
            <div class="form-group">
              <label>
                <input type="checkbox" class="" checked="" wire:model.lazy="currently_working.<?php echo e($employment->id); ?>" />
                &nbsp;<span>This is my current employment</span>
              </label>

            </div>
          </div>
          <div class="gl-frm-outr mb-2">
            <label>Position Accomplishments</label>
            <div class="form-group">
              <textarea placeholder="" class="lg-textarea" wire:model.lazy="accomplishments.<?php echo e($employment->id); ?>"></textarea>
              <div class="toggle-switch-block">
                <span>show</span>
                <div class="switch_box box_1">
                  <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($employment->accomplishments_status); ?>" wire:model.lazy="accomplishments_status.<?php echo e($employment->id); ?>" tabindex="-1" />
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
          <hr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <div class="form-bulb">
            <span><img src="<?php echo e(asset('assets/fe/images/like-up.png')); ?>" alt="" /></span>
            <p>
              You know you’re the best in the field. Share something that lets
              us know it too!
            </p>
          </div>
          <div class="gl-frm-btn">
            <a href="#" class="pos-btn" wire:click.prevent="add()">
              Add Previous Position
              <span>+</span>
            </a>
          </div>
          <div class="whole-btn-wrap dual-btn">
            <input type="submit" value="Back" class="prev-btn" />
            <input type="submit" value="Next" class="nxt-btn" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

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
  })

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
      initDate()
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
    $(".nxt-btn").click(function(e) {
      e.preventDefault();
      location.replace('/candidate/skills')
    })
  }
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-step5.blade.php ENDPATH**/ ?>