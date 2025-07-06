<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
<?php $__env->stopPush(); ?>
<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="form-points">
                <?php
                $step = 4;
                ?>
                <?php echo $__env->make('inc.steps', compact('step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="profile-outr">
                <span>NOW IS NOT THE TIME TO BE HUMBLE</span>
                <h1>Resume Information</h1>

                <img src="<?php echo e(asset('assets/fe/images/info1.svg')); ?>" alt="" class="pic6" />
                <img src="<?php echo e(asset('assets/fe/images/info2.svg')); ?>" alt="" class="pic0" />
            </div>
        </div>
    </section>
    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>Education</h5>
                    <div>
                        <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <a  href="<?php echo e(route('candidatestep5')); ?>" class="skip">Skip <em><img src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em></a>
                    </div>
                </div>
                <div class="gl-form form-sec">
                    <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key > 0): ?>
                    <h6>Enter Previous Education</h6>
                    <?php endif; ?>
                    <div class="warn-txt text-end">
                        <img src="<?php echo e(asset('assets/fe/images/warn.svg')); ?>" alt="" />
                        <span>Add most recent First</span>
                    </div>
                    <div class="gl-frm-outr mb-2">
                        <label>Course/Program Name</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control" wire:model.lazy="program_name.<?php echo e($education->id); ?>" checked />
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" data-value="<?php echo e($education->program_name_status); ?>" checked="" wire:model.lazy="program_name_status.<?php echo e($education->id); ?>" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden <?php echo e($education->program_name_status ? '' : 'show'); ?>">
                                <div class="d-span">
                                    <img src="<?php echo e(asset('assets/fe/images/hidden.svg')); ?>" alt="" />Hidden to
                                    everyone

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
                        <label>School/Organization Name</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control" wire:model.lazy="organization_name.<?php echo e($education->id); ?>" checked />
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" data-value="<?php echo e($education->organization_name_status); ?>" checked="" wire:model.lazy="organization_name_status.<?php echo e($education->id); ?>" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden <?php echo e($education->organization_name_status ? '' : 'show'); ?>">
                                <div class="d-span">
                                    <img src="<?php echo e(asset('assets/fe/images/hidden.svg')); ?>" alt="" />Hidden
                                    to everyone

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
                        <label>Course Description</label>
                        <div class="form-group">
                            <textarea placeholder="" class="lg-textarea" wire:model.lazy="course_description.<?php echo e($education->id); ?>"></textarea>
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" data-value="<?php echo e($education->course_description_status); ?>" checked="" wire:model.lazy="course_description_status.<?php echo e($education->id); ?>" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden <?php echo e($education->course_description_status ? '' : 'show'); ?>">
                                <div class="d-span">
                                    <img src="<?php echo e(asset('assets/fe/images/hidden.svg')); ?>" alt="" />Hidden
                                    to everyone

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
                                <div class="input-daterange">
                                    <div class="yr-field">
                                        <input type="text" class="form-control input1" placeholder="Start Year" wire:model="start_year.<?php echo e($education->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="start_year.<?php echo e($education->id); ?>" wire:ignore />
                                    </div>
                                    <?php if($education->currently_studying): ?>
                                    <div class="">
                                        <input type="text" class="form-control" placeholder="End Year" value="<?php echo e(Carbon\Carbon::now()->format('M Y')); ?>" wire:key="end_year_studying.<?php echo e($education->id); ?>" />
                                    </div>
                                    <?php else: ?>
                                    <div class="yr-field">
                                        <input type="text" class="form-control input2" placeholder="End Year" wire:model="end_year.<?php echo e($education->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="end_year.<?php echo e($education->id); ?>" wire:ignore />
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" data-value="<?php echo e($education->start_year_status); ?>" checked="" wire:model.lazy="start_year_status.<?php echo e($education->id); ?>" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden <?php echo e($education->start_year_status ? '' : 'show'); ?>">
                                <div class="d-span">
                                    <img src="<?php echo e(asset('assets/fe/images/hidden.svg')); ?>" alt="" />Hidden
                                    to everyone

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
                                <input type="checkbox" class="currently_studying" <?php echo e($education->currently_studying ? 'checked' : ''); ?> wire:model.lazy="currently_studying.<?php echo e($education->id); ?>" />
                                &nbsp;<span>I am currently studying here</span>
                            </label>
                        </div>
                    </div>
                    <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="gl-frm-btn" wire:click.prevent="add()">
                        <a href="#" class="pos-btn">
                            Enter Previous Education
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
        triggerSwitch();
        initCheckbox();

        Livewire.on('newEducationAdded', function() {
            initDates();
            changePage();
            triggerSwitch();
            initCheckbox();
        });
    });

    /*$(".switch_1").each(function() {
        $(this).change(function () {
            if ($(this).prop("checked")) {
                // $(this).parents(".toggle-switch-block").next().removeClass("show-check");
                $(this).parents(".toggle-switch-block").next().removeClass("show");
            } else {
                // $(this).parents(".toggle-switch-block").next().addClass("show-check");
                $(this).parents(".toggle-switch-block").next().addClass("show");
            }
        });
    });*/

    window.addEventListener('load-switches', event => {
        initCheckbox();
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

    function triggerSwitch() {
        $('.switch_1').each(function(index, el) {
            console.log(el);
            if ($(el).attr('data-value') == 1) {
                $(el).parents(".toggle-switch-block").next().removeClass("show");
                $(el).prop('checked', true);
            } else {
                $(el).parents(".toggle-switch-block").next().addClass("show");
                $(el).prop('checked', false);
            }
            // $(el).trigger('change');
        });
    }

    function initCheckbox() {
        // let el = $('.currently_studying');
        $('.currently_studying').each(function(index, el) {
            var attr = $(this).attr('checked');
            if(typeof attr !== 'undefined' && attr !== false) {
                $(el).prop('checked', true);
            }
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
            location.replace('/candidate/employment')
        })
        $(".nxt-btn").click(function(e) {
            e.preventDefault();
            location.replace('/candidate/employments')
        })
    }
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-step4.blade.php ENDPATH**/ ?>