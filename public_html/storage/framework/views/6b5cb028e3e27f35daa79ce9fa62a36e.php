<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="form-points mb-0">
                <?php
                $step = 2;$current_step = auth()->user()->current_step;
                ?>
                <?php echo $__env->make('inc.steps', compact('step', 'current_step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </section>

    <div class="common-form-wrap cmn-gap">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>Position Preferences</h5>
                    <div>
                        
                        
                        <!-- <a href="<?php echo e(route('candidatestep3')); ?>" class="skip">Skip <em><img src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em></a> -->
                    </div>
                </div>
                <div class="gl-form form-sec">
                    <div class="gl-frm-outr">
                        <label>Industries* <span class="text-grey">(select multiple)</span></label>
                        <div class="form-group">
                            <select class="js-example-tags industries" multiple="multiple" wire:model.defer="selectedIndustries" id="selectedIndustries">
                                <?php $__currentLoopData = $all_industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option data-badge="" value=<?php echo e($ind); ?>><?php echo e($key); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php echo $__env->make('inc.error', [
                            'field_name' => 'selectedIndustries',
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="gl-frm-outr mb-3 bottom-none-interest-gl">
                        <label>Area of Interest* <span class="text-grey">(select multiple)</span></label>
                        <div class="form-group">
                            <select class="js-example-tags interests" multiple="multiple" wire:model.defer="selectedInterests" id="selectedInterests">
                                <?php $__currentLoopData = $all_interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value=<?php echo e($interest); ?>><?php echo e($key); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php echo $__env->make('inc.error', [
                            'field_name' => 'selectedInterests',
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!-- Task 862k42apk
                    <div class="form-bulb">
                        <span><img src="<?php echo e(asset('assets/fe/images/heart2.png')); ?>" alt="" /></span>
                        <p>Find a job you love and never work a day in your life!</p>
                    </div> -->
                    <div class="gl-frm-outr pos-r mb-3">
                        <label>Salary*</label>
                        <span class="custom-tool">
                            <span>?</span>

                            <div class="tool-info">
                                <p>
                                    Enter your desired salary range - don’t sell yourself short!
                                </p>
                            </div>
                        </span>
                        <div class="form-group">
                            <select class="form-select" wire:model.lazy="salary_range">
                                <option value="">Choose Salary Range</option>
                                <?php $__currentLoopData = $all_salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"> <?php echo e($key); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php echo $__env->make('inc.error', [
                            'field_name' => 'salary_range',
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!-- Task 862k42apk
                    <div class="form-bulb">
                        <span><img src="<?php echo e(asset('assets/fe/images/muscle-arm.png')); ?>" alt="" /></span>
                        <p>
                            If you could pen a letter to your salary, how much would you
                            tell it you are worth?
                        </p>
                    </div> -->
                    <div class="gl-frm-outr">
                        <label>Work Setting*</label>
                        <div class="form-sec-left form-group">
                            <div class="form-group-for-custom-checkbox">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" wire:model.lazy="work_environment_remote" class="work_environment_checkbox work_environment_remote_checkbox" />
                                        <span>Remote</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="work_environment_in_office" class="work_environment_checkbox" />
                                        <span> In Office</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="work_environment_hybrid" class="work_environment_checkbox" />
                                        <span>Hybrid</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Schedule*</label>
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
                        <label>Compensation*</label>
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
                                        <input type="checkbox" checked="" wire:model.lazy="prefered_benefits_insurance_benefits" />
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
                                        <input type="checkbox" wire:model.lazy="prefered_benefits_professional_environment" />
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
                                <div class="col-lg-12 slider-total-sec-col">
                                    <div class="form-group">
                                        <div class="slider-total-sec mt-3">
                                            <div class="slider-total-left w-100">
                                                Distance (I would travel up to x miles)*
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
                                                        <li>0 Mile</li>
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

                    <form wire:submit.prevent="savePreference()" id="savePreferences">
                    <div class="whole-btn-wrap dual-btn">
                        <input type="submit" value="Back" class="prev-btn" wire:loading.remove wire:target="savePreference"/>
                        <input type="button" value="Processing..." class="prev-btn" wire:loading wire:target="savePreference"/>

                        <input type="submit" value="Next" class="nxt-btn" wire:loading.remove wire:target="savePreference"/>
                        <input type="button" value="Next..." class="nxt-btn" wire:loading wire:target="savePreference"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    var IndustrySelect2;
    var InterestSelect2;
    var openIndustry = false;
    var openInterest = false;
    var lt_Ind = 0;

    var parent_id, child_id;
    let selected = [];
    let selected1 = [];

    //initiate industries select2
    document.addEventListener("livewire:load", () => {
        let el = $('.industries');
        let el1 = $('.interests');

        $(document).on('click', '.select2-results__option', function(event) {
            parent_id = $(this).parent().attr('id');
            child_id = $(this).text();
        });

        $('.industries').on('change', function(e) {
            var data = $('.industries').select2("val");
            var _old = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedIndustries');

            var tmp_data = data.map(Number);
            _old = _old.map(Number);
            let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
            let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

            const values = tmp_data;
            selected = selected.filter((value) => values.includes(value));
            const lastSelected = values.filter((value) => !selected.includes(value));
            selected.push(lastSelected[0]);

            let child_ = $('.industries option[value=' + lastSelected[0] + ']').text();
            parent_id = $(".select2-results__option:contains('" + child_ + "')").parent().attr('id');
            child_id = child_;
            if (diff1.length > 0 || diff2.length > 0) {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedIndustries', data);
            }
        });

        // task - 86a114e9r
        $('.industries').on('select2:select', function (e) {
            $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
        });

        $('.interests').on('select2:select', function (e) {
            $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
        });
        // task - 86a114e9r end

        Livewire.hook('message.processed', (message, component) => {
            if (openIndustry) {
                initSelectIndustry(1);
            } else {
                initSelectIndustry();
            }
        });

        

        function initSelectIndustry(open = 0) {
            IndustrySelect2 = el.select2({
                closeOnSelect: false,
                tags: false,
            });

            if (open) {
                IndustrySelect2.select2("open");
                if (document.getElementById(parent_id)) {
                    document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('" + child_id + "')").outerHeight() * $(".select2-results__option:contains('" + child_id + "')").index() - 100;
                }
                initSelectInterest();
            }
        }
        $('.interests').on('change', function(e) {
            var data = $('.interests').select2("val");

            var tmp_data = data.map(Number);
            var _old = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedInterests');
            _old = _old.map(Number);
            let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
            let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

            const values = tmp_data;
            selected1 = selected1.filter((value) => values.includes(value));
            const lastSelected = values.filter((value) => !selected1.includes(value));
            selected1.push(lastSelected[0]);

            let child_ = $('.interests option[value=' + lastSelected[0] + ']').text();
            parent_id = $(".select2-results__option:contains('" + child_ + "')").parent().attr('id');
            child_id = child_;

            if (diff1.length > 0 || diff2.length > 0) {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedInterests', data);
            }
        });

        Livewire.hook('message.processed', (message, component) => {
            if (openInterest) {
                initSelectInterest(1);
            } else {
                initSelectInterest();
            }
        });

        

        function initSelectInterest(open = 0) {
            InterestSelect2 = el1.select2({
                closeOnSelect: false,
                tags: false
            });

            if (open) {
                InterestSelect2.select2("open");
                if (document.getElementById(parent_id)) {
                    document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('" + child_id + "')").outerHeight() * $(".select2-results__option:contains('" + child_id + "')").index() - 100;
                }
                initSelectIndustry();
            }
        }

        window.addEventListener('close-multiselect', event => {
            openIndustry = false;
            openInterest = false;
        });
    });
</script>

<script>
    document.addEventListener("livewire:load", () => {

        initSlider();
    })


    //   Work Setting on remote
    document.addEventListener("livewire:load", () => {
        $("body").delegate(".work_environment_checkbox", "change", function(e) {
            workEnv();
        });
        workEnv();
        Livewire.hook('message.processed', (message, component) => {
            if ($('.work_environment_remote_checkbox').is(':checked')) {
                var count = $('.work_environment_remote_checkbox').parents('.form_input_check').find('input[type="checkbox"]:checked').length;
                if (count == 1) {
                    $('.custom-value').text('100');
                    $('.slider-total-sec-col').css('display', 'none');
                } else {
                    // $('.custom-value').text('0');
                    $('.slider-total-sec-col').css('display', 'block');
                }
                // console.log(window.livewire.find('<?php echo e($_instance->id); ?>').get('distance'));
            } else {
                // console.log(window.livewire.find('<?php echo e($_instance->id); ?>').get('distance'));
                // task - task - 86a0yje1d
                var count = $('.work_environment_checkbox:checked').length;
                $('.custom-value').text(window.livewire.find('<?php echo e($_instance->id); ?>').get('distance'));
                if (count > 0) {
                    $('.slider-total-sec-col').css('display', 'block');
                } else {
                    $('.slider-total-sec-col').css('display', 'none');
                    $('.slider-total-sec-col').hide();
                }
            }
        })
    })

    function workEnv() {
        if ($('.work_environment_remote_checkbox').is(':checked')) {
            var count = $('.work_environment_remote_checkbox').parents('.form_input_check').find('input[type="checkbox"]:checked').length;
            if (count == 1) {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('distance', 100);
                $('.slider-total-sec-col').css('display', 'none');
            } else {
                // window.livewire.find('<?php echo e($_instance->id); ?>').set('distance', 0);
                $('.slider-total-sec-col').css('display', 'block');
            }
        } else {
            // task - task - 86a0yje1d
            var count = $('.work_environment_checkbox:checked').length;
            window.livewire.find('<?php echo e($_instance->id); ?>').set('distance', $('.custom-value').text());
            if (count > 0) {
                $('.slider-total-sec-col').css('display', 'block');
            } else {
                $('.slider-total-sec-col').css('display', 'none');
                $('.slider-total-sec-col').hide();
            }
        }
        $("#slider-range-min").slider({ value : window.livewire.find('<?php echo e($_instance->id); ?>').get('distance') }).trigger('change'); // task - 86a0d8ad0
    }



    function initSlider() {
        let distanceValue = '<?php echo $distance; ?>';
        var handle = $("#custom-handle");
        let popup = $(".custom-value")
        $("#slider-range-min").slider({
            range: "min",
            value: distanceValue,
            min: 0,
            max: 100,
            create: function() {
                handle.text($(this).slider("value"));
                popup.text($(this).slider("value"))
            },
            change: function(event, ui) { // task - 86a0d8ad0
                console.log(ui, event);
                if (ui.value >= 1) {
                    $('.distance').find(".text-danger").remove();
                }
            },
            slide: function(event, ui) {
                if (ui.value < 1) {

                    $('.distance').find(".text-danger").remove();
                    $('.distance').append(
                        '<div class="text-danger" style=""> Distance must be greater than or equal to 1 mile.</div>'
                    );

                    // return false;
                } else {
                    $('.distance').find(".text-danger").remove();
                }
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
        // location.replace('/candidate/personal-information')
        window.location.href='<?php echo e(url("/candidate/personal-information")); ?>';
    })
    // $(".nxt-btn").click(function(e) {
    //     e.preventDefault();
    //     location.replace('/candidate/education-employment')
    // })

    $(".nxt-btn,.skip").click(function(e) { //task - 86a0hxg00
        // e.preventDefault();
        var count = 0;
        $(this)
            .parents(".common-form-outr")
            .find(".gl-frm-outr")
            .each(function() {
                var label = $(this).find("label").text();
                if (label.includes("*")) {
                    if ($(this).find('input').val() == "" || $(this).find('select').val() == "") {
                        $(this).find(".form-group").find(".text-danger").remove();
                        $(this).find(".form-group").find("input:first").focus();
                        $(this).find(".form-group").find("select:first").focus();
                        $(this)
                            .find(".form-group")
                            .append(
                                '<div class="text-danger" style=""> This field is required.</div>'
                            );
                        count++;
                        // return false;
                    }

                    $(this).find(".form-sec-left.form-group").each(function() {
                        vals = $(this).find('input[type=checkbox]:checked').length;
                        if (vals < 1) {
                            $(this).find(".text-danger").remove();
                            $(this).find("input:first").focus();
                            $(this).find("select:first").focus();
                            $(this).append(
                                '<div class="text-danger" style=""> This field is required.</div>'
                            );
                            count++;
                            // return false;
                        }
                    });
                }

            });

        if (count) {
            // return false;
        }


        if (parseInt($(".custom-value").text()) < 1) {

            $('.distance').find(".text-danger").remove();
            $('.distance').append(
                '<div class="text-danger" style=""> Distance must be greater than or equal to 1 mile.</div>'
            );
            count++;
            return false;
        }


        if (count > 0) {
            $('html, body').animate({
                scrollTop: $("div.text-danger:first").offset().top - 200
            }, 500);
            return false;
        }
        var errosCount = $(".text-danger").length;
        if (errosCount < 1) {
            // location.replace('/candidate/education-employment')
            // window.location.href='<?php echo e(url("/candidate/education-employment")); ?>';
            return true;
        } else {
            $('html, body').animate({
                scrollTop: $("div.text-danger:first").offset().top - 200
            }, 500);

            $(".text-danger").each(function() {
                $(this).parents(".form-group").find("input").focus();
                return false;
            });
        }
        return false;
    });

$(document).ready(function() {
  $('.industries').select2({closeOnSelect: true});
  $('.interests').select2({closeOnSelect: true});

});
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidate-step2.blade.php ENDPATH**/ ?>