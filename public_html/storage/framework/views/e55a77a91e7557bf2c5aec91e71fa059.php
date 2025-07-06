<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="form-points mb-0">
                <?php
                    $step = 2;
                ?>
                <?php echo $__env->make('inc.steps', compact('step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </section>

    <div class="common-form-wrap cmn-gap">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>Position Preferences</h5>
                    <div>
                        <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <a href="<?php echo e(route('candidatestep3')); ?>" class="skip">Skip <em><img
                                    src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em></a>
                    </div>
                </div>
                <div class="gl-form form-sec">
                    <div class="gl-frm-outr">
                        <label>Industries</label>
                        <div class="form-group">
                            <select class="js-example-tags industries" multiple="multiple"
                                wire:model.lazy="selectedIndustries">
                                <?php $__currentLoopData = $all_industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value=<?php echo e($ind); ?>><?php echo e($key); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Area of Interest</label>
                        <div class="form-group">
                            <select class="js-example-tags interests" multiple="multiple"
                                wire:model.lazy="selectedInterests">
                                <?php $__currentLoopData = $all_interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value=<?php echo e($interest); ?>><?php echo e($key); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-bulb">
                        <span><img src="<?php echo e(asset('assets/fe/images/heart2.png')); ?>" alt="" /></span>
                        <p>Find a job you love and never work a day in your life!</p>
                    </div>
                    <div class="gl-frm-outr pos-r">
                        <label>Salary</label>
                        <div class="custom-tool">
                            <span>?</span>

                            <div class="tool-info">
                                <p>
                                    Enter your desired salary range - don’t sell yourself short!
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-select" wire:model.lazy="salary_range">
                                <option>Salary Range</option>
                                <option>$20,000 - $40,000</option>
                                <option>$40,000 - $60,000</option>
                                <option>$60,000 - $80,000</option>
                                <option>$80,000 - $100,000</option>
                                <option>$100,000 - $125,000</option>
                                <option>$125,000 - $150,000</option>
                                <option>$150,000- $200,000</option>
                                <option>$250,000+</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-bulb">
                        <span><img src="<?php echo e(asset('assets/fe/images/muscle-arm.png')); ?>" alt="" /></span>
                        <p>
                            If you could pen a letter to your salary, how much would you
                            tell it you are worth?
                        </p>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Work Environment</label>
                        <div class="form-sec-left form-group">
                            <div class="form-group-for-custom-checkbox">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" wire:model.lazy="work_environment_remote" />
                                        <span>Remote</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="work_environment_in_office" />
                                        <span> In Office</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="work_environment_hybrid" />
                                        <span>Hybrid</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Schedule</label>
                        <div class="form-sec-left form-group">
                            <div class="form-group-for-custom-checkbox">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" checked="" wire:model.lazy="schedule_full_time" />
                                        <span>Full Time</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="schedule_part_time" />
                                        <span> Part Time</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="schedule_no_preference" />
                                        <span>No Preference</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Compensation</label>
                        <div class="form-sec-left form-group">
                            <div class="form-group-for-custom-checkbox">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" checked="" wire:model.lazy="compensation_salary" />
                                        <span>Salary</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="compensation_hourly" />
                                        <span> Hourly</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="compensation_comission_based" />
                                        <span>Comission Based</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Preferred Benefits</label>
                        <div class="form-sec-left form-group">
                            <div class="form-group-for-custom-checkbox scnd-form">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" checked=""
                                            wire:model.lazy="prefered_benefits_insurance_benefits" />
                                        <span>Insurance Benefits</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="prefered_benefits_padi_holidays" />
                                        <span> Paid Holidays</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="prefered_benefits_paid_vacation_days" />
                                        <span>Paid Vacation Days</span>
                                    </label>
                                    <label>
                                        <input type="checkbox"
                                            wire:model.lazy="prefered_benefits_professional_environment" />
                                        <span>Professional Environment</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="prefered_benefits_casual_environment" />
                                        <span>Casual Environment</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <div class="slide-sec-rgt">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="slider-total-sec">
                                            <div class="slider-total-left">
                                                Distance I Would Travel:
                                            </div>
                                            <br>
                                            <div class="slider-total-right" wire:ignore>
                                                <div id="slider-range-min" wire:model.lazy="distance">
                                                    <div class="ui-slider-handle">
                                                        <div class="handle-ongoing-text">
                                                            <span class="custom-value"></span>Miles
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="distance">
                                                    <ul>
                                                        <li>1 Mile</li>
                                                        <li>100 Miles</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        //initiate industries select2
        document.addEventListener("livewire:load", () => {
            initSelect2Industries();
        })

        function initSelect2Industries() {
            let el = $('.industries')
            initSelect();
            $('.industries').on('change', function(e) {
                var data = $('.industries').select2("val");
                window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedIndustries', data);
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

        //initiate industries select2
        document.addEventListener("livewire:load", () => {
            initSelect2Interests();
        })

        function initSelect2Interests() {
            let el = $('.interests')
            initSelect();
            $('.interests').on('change', function(e) {
                var data = $('.interests').select2("val");
                window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedInterests', data);
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
    </script>

    <script>
        document.addEventListener("livewire:load", () => {
            initSlider();
        })
        function initSlider() {
            let distanceValue = '<?php echo $distance; ?>';
            var handle = $("#custom-handle");
            let popup = $(".custom-value")
            $("#slider-range-min").slider({
                range: "min",
                value: distanceValue,
                min: 1,
                max: 100,
                create: function() {
                    handle.text($(this).slider("value"));
                    popup.text($(this).slider("value"))
                },
                slide: function(event, ui) {
                    $("#amount").val("$" + ui.value);
                    handle.text(ui.value);
                    popup.text(ui.value);
                    window.livewire.find('<?php echo e($_instance->id); ?>').set('distance', ui.value);
                }
            });
        };
    </script>

    <script>
        $(".prev-btn").click(function(e) {
            e.preventDefault();
            location.replace('/candidate/personal-information')
        })
        $(".nxt-btn").click(function(e) {
            e.preventDefault();
            location.replace('/candidate/employment')
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-step2.blade.php ENDPATH**/ ?>