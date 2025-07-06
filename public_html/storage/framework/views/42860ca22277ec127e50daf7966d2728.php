<div>
    <div class="form-sec cmn-gap back-clr main-form-sec pb-0 ban-up ban-up3">
        <div class="container">


            <nav aria-label="breadcrumb">
                <ol class="breadcrumb edit-personal">
                    <li class=""><a href="<?php echo e(route('candidates.editpersonal')); ?>">Edit Personal
                            Information</a></li>
                    <li class=""><a href="<?php echo e(route("candidates.editresume")); ?>">Edit Resume Information</a></li>
                    <li class="active" aria-current="page">Edit Position Preferences</li>
                </ol>
            </nav>
            <div class="sec-hdr">
                <h2>
                  Edit Position Preferences
                  <div class="profile-btn ms-btn">
                    <a href="<?php echo e(route("candidateProfile")); ?>">View Profile</a>
                  </div>
                </h2>
            </div>

            <div class="cmn-form">
                <div class="cmn-head">
                <h5>&nbsp;</h5>
                <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>              
                </div>
            </div>
            
            <div class="form-sec gl-form">
                <form wire:submit.prevent="savePreference()">
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                        <div class="col-lg-6">
                            <div class="form-sec-left form-group">
                                <label class="mobile-v">Work environment </label>
                                <label class="desktop-v">Work environment (You may choose more than one)</label>
                                <div class="form-group-for-custom-checkbox">
                                    <div class="form_input_check">
                                        <label>
                                            <input type="checkbox" wire:model.lazy="work_environment_remote" />
                                            <span>Remote</span>
                                        </label>
                                        <label>
                                            <input type="checkbox" wire:model.lazy="work_environment_in_office"/>
                                            <span> In Office</span>
                                        </label>
                                        <label>
                                            <input type="checkbox" wire:model.lazy="work_environment_hybrid"/>
                                            <span>Hybrid</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-sec-left form-group">
                                <label class="mobile-v">Schedule </label>
                                <label class="desktop-v">Schedule (You may choose more than one)</label>
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

                        <div class="col-lg-6">
                            <div class="form-sec-left form-group">
                                <label class="mobile-v">Compensation </label>
                                <label class="desktop-v">Compensation (You may choose more than one)</label>
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

                        <div class="col-lg-6">
                            <div class="gl-frm-outr pos-r">
                                <label>Salary </label>
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
                                        <!-- <option>Salary Range</option> -->
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
                        </div>
                        <div class="col-md-12">
                            <label>Ideal Job Attributes</label>
                            <div class="custom-check-sec">
                                <div class="row">
                                    <div class="col-md-12">
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
                        </div>
                        <div class="col-lg-6">
                            <div class="slide-sec-rgt">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="slider-total-sec">
                                                <div class="slider-total-left">
                                                    Distance I can travel:
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
                    </div>
                    <div class="form-submit-btn mb-0">
                        <input type="submit" value="Save" class="submit-btn" />
                    </div>
                </form>
            </div>

            <div class="cmn-form-btm">
                <div class="ftr-btm-lft">
                    <p>© 2022 <a href="#">Purple Stairs</a></p>
                    <span>Website by
                        <a href="https://www.brand-right.com/" target="_blank">
                            BrandRight Marketing Group</a></span>
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
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-edit-preferences.blade.php ENDPATH**/ ?>