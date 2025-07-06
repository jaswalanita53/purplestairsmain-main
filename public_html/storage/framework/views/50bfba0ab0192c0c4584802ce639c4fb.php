<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
          <div class="form-points">
            <?php
            $step = 6
            ?>
            <?php echo $__env->make('inc.steps',compact('step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
      </section>

      <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
          <div class="common-form-outr">
            <div class="form-hdr">
              <h5>Skills</h5>
              <div>
                <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <a
                  class="skip"
                  
                  href="<?php echo e(route('candidatestep7')); ?>"
                  >Skip <em><img src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em
                ></a>
              </div>
            </div>
            <div class="gl-form form-sec">
              <div class="warn-txt text-end">
                <img src="<?php echo e(asset('assets/fe/images/warn.svg')); ?>" alt="" />
                <span>Add most recent First</span>
              </div>
              <div class="gl-frm-outr">
                <label>Hard Skills</label>
                <div class="form-group">
                  <select class="js-example-tags hard_skills" multiple="multiple" wire:model.lazy="selectedHardSkills">
                    <?php $__currentLoopData = $all_hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value=<?php echo e($skill); ?>><?php echo e($key); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <div class="form-bulb">
                <span><img src="<?php echo e(asset('assets/fe/images/graduation-cap2.png')); ?>" alt="" /></span>
                <p>
                  Hard Skills are technical skills acquired through education or
                  experience.
                </p>
              </div>
              <div class="gl-frm-outr">
                <label>Soft Skills</label>
                <div class="form-group">
                  <select class="js-example-tags soft_skills" multiple="multiple" wire:model.lazy="selectedSoftSkills">
                    <?php $__currentLoopData = $all_soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value=<?php echo e($skill); ?>><?php echo e($key); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <div class="form-bulb">
                <span><img src="<?php echo e(asset('assets/fe/images/happiness-face.png')); ?>" alt="" /></span>
                <p>
                  Soft skills are personal qualities and Interactive people skills
                </p>
              </div>
              <div class="gl-frm-outr">
                <label>Languages</label>
                <div class="form-group">
                  <select class="js-example-tags languages" multiple="multiple" wire:model.lazy="selectedLanguages">
                    <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value=<?php echo e($language); ?>><?php echo e($key); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
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
<script>
    //initiate languages select2
    document.addEventListener("livewire:load", () => {
        initSelect2Languages();
    })

    function initSelect2Languages() {
        let el = $('.languages')
        initSelect();
        $('.languages').on('change', function(e) {
            var data = $('.languages').select2("val");
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedLanguages', data);
        });
        Livewire.hook('message.processed', (message, component) => {
            initSelect()
        })

        function initSelect() {
            el.select2({
                tags: false
            })
        }
    }

    //initiate soft skills select2
        document.addEventListener("livewire:load", () => {
        initSelect2Soft();
    })

    function initSelect2Soft() {
        let el = $('.soft_skills')
        initSelectSoft();
        $('.soft_skills').on('change', function(e) {
            var data = $('.soft_skills').select2("val");
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedSoftSkills', data);
        });
        Livewire.hook('message.processed', (message, component) => {
            initSelectSoft()
        })

        function initSelectSoft() {
            el.select2({
                tags: false
            })
        }
    }

    //initiate hard skills select2
        document.addEventListener("livewire:load", () => {
        initSelect2Hard();
    })

    function initSelect2Hard() {
        let el = $('.hard_skills')
        initSelectHard();
        $('.hard_skills').on('change', function(e) {
            var data = $('.hard_skills').select2("val");
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedHardSkills', data);
        });
        Livewire.hook('message.processed', (message, component) => {
            initSelectHard()
        })

        function initSelectHard() {
            el.select2({
                tags: false
            })
        }
    }
</script>

<script>
    $(".prev-btn").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/employments')
    })
    $(".nxt-btn").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/references')
    })
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-step6.blade.php ENDPATH**/ ?>