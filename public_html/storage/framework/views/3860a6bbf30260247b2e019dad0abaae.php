<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
<?php $__env->stopPush(); ?>
<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="form-points">
                <?php
                $step = 4; $current_step = auth()->user()->current_step;
                ?>
                <?php echo $__env->make('inc.steps', compact('step', 'current_step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                        
                        <a  href="<?php echo e(route('candidatestep5')); ?>" class="skip">Skip <em><img src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em></a>
                    </div>
                </div>
                <form wire:submit.prevent="saveEducation()" id="saveEducation">
                <div class="gl-form form-sec">
                    <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="main-edu-sec-<?php echo e($education->id); ?>">
                        <?php if($key > 0): ?>
                        <h6>
                            Enter Previous Education
                            
                            <button type="button" class="remove_additional_sec" wire:click="removeEdu(<?php echo e($education->id); ?>)"><img src="<?php echo e(asset('assets/fe/images/delete.svg')); ?>" alt="Remove Section" /></button>
                        </h6>
                        <?php endif; ?>
                        <div class="warn-txt ">
                            <img src="<?php echo e(asset('assets/fe/images/warn.svg')); ?>" alt="" />
                            <span>Add most recent First</span>
                        </div>
                        <div class="gl-frm-outr mb-2">
                            <label>School/Organization Name <span class="text-grey">(Ex. Touro)</span></label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" wire:model.lazy="organization_name.<?php echo e($education->id); ?>" checked />
                                <div class="toggle-switch-block">
                                    <span>show</span>
                                    <div class="switch_box box_1">
                                        <input type="checkbox" class="switch_1 organization_name_status_<?php echo e($education->id); ?>" data-value="<?php echo e($education->organization_name_status); ?>" checked="" wire:model.lazy="organization_name_status.<?php echo e($education->id); ?>" tabindex="-1" data-id="<?php echo e($education->id); ?>"/>
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
                            <label>Course/Program Name <span class="text-grey">(Ex. Accounting, BA)</span></label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" wire:model.lazy="program_name.<?php echo e($education->id); ?>" checked />
                                <div class="toggle-switch-block">
                                    <span>show</span>
                                    <div class="switch_box box_1">
                                        <input type="checkbox" class="switch_1 program_name_status_<?php echo e($education->id); ?>" data-value="<?php echo e($education->program_name_status); ?>" checked="" wire:model.lazy="program_name_status.<?php echo e($education->id); ?>" tabindex="-1" />
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
                            <label>Years: </label>
                            <div class="form-group for-dropdown-option for-abs-label">
                                <div class="input-field-dropdown">
                                    <div class="input-daterange">
                                        <div class="yr-field">
                                            <input type="text" class="form-control input1" placeholder="Start Date" wire:model.defer="start_year.<?php echo e($education->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="start_year.<?php echo e($education->id); ?>" wire:ignore />
                                        </div>
                                        
                                        <?php
                                            $currently_std = (isset($currently_studying[$education->id])) ? $currently_studying[$education->id] : $education->currently_studying;
                                        ?>
                                        <?php if($currently_std): ?>
                                        <div class="">
                                            <input type="text" class="form-control"  placeholder="End Date " value="PRESENT" wire:key="end_year_studying.<?php echo e($education->id); ?>" />
                                        </div>
                                        <?php else: ?>
                                        <div class="yr-field">
                                            <input type="text" class="form-control input2" hhh placeholder="End Date " wire:model.defer="end_year.<?php echo e($education->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="end_year.<?php echo e($education->id); ?>" wire:ignore />
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="toggle-switch-block">
                                    <span>show</span>
                                    <div class="switch_box box_1">
                                        <input type="checkbox" class="switch_1 start_year_status_<?php echo e($education->id); ?>" data-value="<?php echo e($education->start_year_status); ?>" checked="" wire:model.lazy="start_year_status.<?php echo e($education->id); ?>" tabindex="-1" />
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
                            <?php if(isset($end_year_error[$education->id])): ?>
                            
                            <?php endif; ?>
                            <div class="form-group" style="margin-top: <?php echo e(isset($end_year_error[$education->id]) ? '' : '-15px !important'); ?>;">
                                <label>
                                    <input type="checkbox" class="currently_studying" <?php echo e($education->currently_studying ? 'checked' : ''); ?> wire:model="currently_studying.<?php echo e($education->id); ?>" data-value="<?php echo e($education->currently_studying); ?>"/>
                                    &nbsp;<span>I am currently studying here</span>
                                </label>
                            </div>
                        </div>

                        <div class="gl-frm-outr mb-2">
                            <label>Course Description</label>
                            <div class="form-group">
                                <textarea placeholder="" class="lg-textarea" wire:model.lazy="course_description.<?php echo e($education->id); ?>"></textarea>
                                <div class="toggle-switch-block">
                                    <span>show</span>
                                    <div class="switch_box box_1">
                                        <input type="checkbox" class="switch_1 course_description_status_<?php echo e($education->id); ?>" data-value="<?php echo e($education->course_description_status); ?>" checked="" wire:model.lazy="course_description_status.<?php echo e($education->id); ?>" tabindex="-1" />
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
                        <hr>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="gl-frm-btn">
                        <a href="#" class="pos-btn" wire:click.prevent="add()">
                            Enter Previous Education
                            <span>+</span>
                        </a>
                    </div>
                    <div class="whole-btn-wrap dual-btn">
                        <input type="submit" value="Back" class="prev-btn" />
                        <input type="submit" value="Add Employment" class="nxt-btn" wire:loading.remove wire:target="saveEducation"/>
                        <input type="button" value="Saving..." class="nxt-btn" wire:loading wire:target="saveEducation"/>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

<script>
    $('#saveEducation').submit(function (e) {

    });

    //initiate languages select2
    document.addEventListener("livewire:load", () => {
        initDates();
        changePage();
        triggerSwitch();
        initCheckbox();

        Livewire.on('newEducationAdded', function() {
            initDates();
            changePage();
            // triggerSwitch();
            initCheckbox();
        });
    });

    /*document.addEventListener("livewire:load", () => {
    });*/
    $(document).ready(function(){
        $('.warn-txt').addClass('blink');
    })

    window.addEventListener('load-switches', event => {
        initCheckbox();
        document.querySelectorAll('.switch_1').forEach(function(el,i){
            console.log($(el).attr('data-value'));
            if ($(el).attr('data-value') == 1) {
                $(el).parents(".toggle-switch-block").next().removeClass("show");
                $(el).prop('checked', true);
                $(el).attr('checked', 'checked');
            } else {
                $(el).parents(".toggle-switch-block").next().addClass("show");
                $(el).prop('checked', false);
                $(el).removeAttr('checked', 'checked');
            }
        });
    });

    $(document).on('change', '.switch_1', function () {
        console.log($(this).prop('checked'));
        if($(this).prop('checked')) {
            $(this).parents(".toggle-switch-block").next().removeClass("show");
        } else {
            $(this).parents(".toggle-switch-block").next().addClass("show");
        }
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
            var currecnt=$(this).parents('.gl-frm-outr').find('.input-daterange').find('input:last');

            if(typeof attr !== 'undefined' && attr !== false) {
                $(el).prop('checked', true);
                currecnt.attr('readonly',true);
            }else{
                currecnt.attr('readonly',false);
            }
        });
    }

    window.addEventListener('init-dates', event => {
        initDates()
    });

    function initDates() {
        let el = $('.input-daterange .yr-field .form-control')
        initDate();
        Livewire.hook('message.processed', (message, component) => {
            initDate();

            let course_description_status = component.serverMemo.data.course_description_status;
            let organization_name_status = component.serverMemo.data.organization_name_status;
            let program_name_status = component.serverMemo.data.program_name_status;
            let start_year_status = component.serverMemo.data.start_year_status;

            $.each(course_description_status, function(index, val) {
                /* iterate through array or object */
                if(val) {
                    $('.course_description_status_'+index).parents(".toggle-switch-block").next().removeClass("show");
                } else {
                    $('.course_description_status_'+index).parents(".toggle-switch-block").next().addClass("show");
                }
            });
            $.each(organization_name_status, function(index, val) {
                if(val) {
                    $('.organization_name_status_'+index).parents(".toggle-switch-block").next().removeClass("show");
                } else {
                    $('.organization_name_status_'+index).parents(".toggle-switch-block").next().addClass("show");
                }
            });
            $.each(program_name_status, function(index, val) {
                if(val) {
                    $('.program_name_status_'+index).parents(".toggle-switch-block").next().removeClass("show");
                } else {
                    $('.program_name_status_'+index).parents(".toggle-switch-block").next().addClass("show");
                }
            });
            $.each(start_year_status, function(index, val) {
                if(val) {
                    $('.start_year_status_'+index).parents(".toggle-switch-block").next().removeClass("show");
                } else {
                    $('.start_year_status_'+index).parents(".toggle-switch-block").next().addClass("show");
                }
                console.log(index, val);
            });

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
           // window.location.href='<?php echo e(url("/candidate/education-employment")); ?>';
            window.location.href='<?php echo e(url("/candidate/position-preferences")); ?>';  // Task #86a0h5rvz
        })

    $("body").delegate(".nxt-btn", "click", function(e) {
            // e.preventDefault(); task - 86a0hxg00
            var count = 0;
            count=$('.text-danger').length;
            $('.input-daterange').each(function(){
               var start =$(this).find('input:first');
               var end =$(this).find('input:last');

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
            })




        if (count > 0) {
            $('html, body').animate({
                scrollTop: $(".text-danger:first").offset().top - 200
            }, 500);
            return false;
        }

        return true;
            // window.location.href='<?php echo e(url("/candidate/employment")); ?>'; task - 86a0hxg00

        })
    }
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidate-step4.blade.php ENDPATH**/ ?>