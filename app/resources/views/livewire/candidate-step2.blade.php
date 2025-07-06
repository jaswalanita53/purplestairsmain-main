<div>
<style>
.alert-txt{
    display:none;
}
.select2-container--open .select2-dropdown {
    z-index: 10000 !important;
}

</style>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="form-points mb-0">
                @php
                $step = 2;$current_step = auth()->user()->current_step;
                @endphp
                @include('inc.steps', compact('step', 'current_step'))
            </div>
        </div>
    </section>

    <div class="common-form-wrap cmn-gap">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>Position Preferences</h5>
                    <div>
                        {{-- @include('inc.autoSaveLoader') --}}
                        {{-- <a href="javascript:void(0)" class="skip">Skip <em><img src="{{ asset('assets/fe/images/skip-arrw.svg') }}" alt="" /></em></a> --}}
                        <!-- <a href="{{route('candidatestep3')}}" class="skip">Skip <em><img src="{{ asset('assets/fe/images/skip-arrw.svg') }}" alt="" /></em></a> -->

                        {{-- task - 86a1hvpcy --}}
                        <button type="button" class="btn save-later" wire:click="finish_later" style="" >
                            <img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp;{{ $profileSaved ? 'Profile Saved' : 'Finish Later' }}
                        </button>
                    </div>
                </div>
                <div class="gl-form form-sec">
                {{-- <div class="gl-frm-outr">
                        <label>Primary Industry* </label>
                        <div class="form-group">

                            <select class="js-example-tags form-control"  wire:model.defer="selectedPrimaryIndustry" id="selectedPrimaryIndustry" >
                            <option  value=>Select </option>
                                @foreach ($all_industries as $key => $ind)

                                <option data-badge="" value={{ $ind }}>{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        @include('inc.error', [
                            'field_name' => 'selectedIndustries',
                        ])
                    </div> --}}
                    <div class="gl-frm-outr">
                        <label>Industries* <span class="text-grey">(Select multiple and check a primary)</span></label>
                        <div class="form-group">
                            <select class="js-example-tags industries" multiple="multiple" wire:model.defer="selectedIndustries" id="selectedIndustries">
                                @foreach ($all_industries as $key => $ind)

                                   <option data-badge="" value={{ $ind }}>{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        @include('inc.error', [
                            'field_name' => 'selectedIndustries',
                        ])
                    </div>

                    <div class="gl-frm-outr mb-3 bottom-none-interest-gl">
                        <label>Area of Interest* <span class="text-grey">(select multiple)</span></label>
                        <div class="form-group">
                            <select class="js-example-tags interests" multiple="multiple" wire:model.defer="selectedInterests" id="selectedInterests">
                                @foreach ($all_interests as $key => $interest)
                                <option value={{ $interest }}>{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        @include('inc.error', [
                            'field_name' => 'selectedInterests',
                        ])
                    </div>
                    <!-- Task 862k42apk
                    <div class="form-bulb">
                        <span><img src="{{ asset('assets/fe/images/heart2.png') }}" alt="" /></span>
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
                            <select class="form-select" wire:model.defer="salary_range">
                                <option value="">Choose Salary Range</option>
                                @foreach ($all_salaries as $key => $salary)
                                <option value="{{ $key }}"> {{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        @include('inc.error', [
                            'field_name' => 'salary_range',
                        ])
                    </div>
                    <!-- Task 862k42apk
                    <div class="form-bulb">
                        <span><img src="{{ asset('assets/fe/images/muscle-arm.png') }}" alt="" /></span>
                        <p>
                            If you could pen a letter to your salary, how much would you
                            tell it you are worth?
                        </p>
                    </div> -->
                    <style>
                        .form_input_check label .work_environment_non_us[type="checkbox"]+span::before {
                            border: 1px solid gray !important;
                            background: lightgray !important;
                        }
                    </style>
                    <div class="gl-frm-outr ">
                        <label>Work Setting* @if ($user_country != 'US') <small class="text-danger">Non USA Candidates Can Only Display As Remote</small> @endif
                            </label>
                        <div class="form-sec-left form-group">
                            <div class="form-group-for-custom-checkbox">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" wire:model.defer="work_environment_remote"
                                            id="work_environment_remote"
                                            class="work_environment_checkbox work_environment_remote_checkbox " />
                                        <span>Remote</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="work_environment_in_office"
                                            id="work_environment_in_office"
                                            class="work_environment_checkbox @if ($user_country != 'US') work_environment_non_us @endif" />
                                        <span> In Office</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="work_environment_hybrid"
                                            id="work_environment_hybrid" class="work_environment_checkbox @if ($user_country != 'US') work_environment_non_us @endif" />
                                        <span>Hybrid</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr pos-r">
                        <label>Schedule*</label>
                        <span class="custom-tool-">
                            <span class="text-purple alert-txt" style="color:#7e50a7;font-size: 14px; margin-left: 11px;">Selecting both will indicate no preference</span>

                        </span>
                        <div class="form-sec-left form-group">
                            <div class="form-group-for-custom-checkbox">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" checked="" wire:model.defer="schedule_full_time" id="schedule_full_time"/>
                                        <span>Full Time</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="schedule_part_time" id="schedule_part_time"/>
                                        <span> Part Time</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="schedule_no_preference" id="schedule_no_preference"/>
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
                                        <input type="checkbox" checked="" wire:model.defer="compensation_salary" />
                                        <span>Salary</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="compensation_hourly" />
                                        <span> Hourly</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="compensation_comission_based" />
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
                                        <input type="checkbox" checked="" wire:model.defer="prefered_benefits_insurance_benefits" />
                                        <span>Insurance Benefits</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="prefered_benefits_padi_holidays" />
                                        <span> Paid Holidays</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="prefered_benefits_paid_vacation_days" />
                                        <span>Paid Vacation Days</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="prefered_benefits_professional_environment" />
                                        <span>Professional Environment</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.defer="prefered_benefits_casual_environment" />
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
                                                <div id="slider-range-min" wire:model.defer="distance">
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

                        <input type="submit" value="Next" class="nxt-btn nxt-sbmt-btn" wire:loading.remove wire:target="savePreference"/>
                        <input type="button" value="Next..." class="nxt-btn" wire:loading wire:target="savePreference"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
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



        // task - 86a114e9r
        $('.industries').on('select2:select', function (e) {
            $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
        });

        $('.interests').on('select2:select', function (e) {
            $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
        });
        // task - 86a114e9r end

        // task - 86a1gwqft
        $('.industries').on('select2:open', function (e) {

            var _val = $(this).val();
            if(_val.length) {
                $('button[aria-describedby="select2-selectedIndustries-container"]').show();
            } else {
                $('button[aria-describedby="select2-selectedIndustries-container"]').hide();
            }
        });

        $('.interests').on('select2:open', function (e) {
            var _val = $(this).val();
            if(_val.length) {
                $('button[aria-describedby="select2-selectedInterests-container"]').show();
            } else {
                $('button[aria-describedby="select2-selectedInterests-container"]').hide();
            }
        });

        $('.industries').on('select2:close', function (e) {
            $('button[aria-describedby="select2-selectedIndustries-container"]').hide();
        });

        $('.interests').on('select2:close', function (e) {
            $('button[aria-describedby="select2-selectedInterests-container"]').hide();
        });
        // task - 86a1gwqft end

        Livewire.hook('message.processed', (message, component) => {
            if (openIndustry) {
                initSelectIndustry(1);
            } else {
                initSelectIndustry();
            }
        });

        {{-- window.addEventListener('keep-open-industries', event => {
            openIndustry = true;
            openInterest = false;
        }); --}}

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
        {{-- $('.interests').on('change', function(e) { --}}


        Livewire.hook('message.processed', (message, component) => {
            if (openInterest) {
                initSelectInterest(1);
            } else {
                initSelectInterest();
            }
        });

        {{-- window.addEventListener('keep-open-interests', event => {
            openIndustry = false;
            openInterest = true;
        }); --}}

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
            {{-- workEnv(); --}}
            Livewire.hook('message.processed', (message, component) => {
                if ($('.work_environment_remote_checkbox').is(':checked')) {
                    var count = $('.work_environment_remote_checkbox').parents('.form_input_check').find(
                        'input[type="checkbox"]:checked').length;
                    if (count == 1) {
                        $('.custom-value').text('100');
                        $('.slider-total-sec-col').css('display', 'none');
                    } else {
                        // $('.custom-value').text('0');
                        $('.slider-total-sec-col').css('display', 'block');
                    }
                    // console.log(@this.get('distance'));
                } else {
                    // console.log(@this.get('distance'));
                    // task - task - 86a0yje1d
                    var count = $('.work_environment_checkbox:checked').length;
                    {{-- $('.custom-value').text(@this.get('distance')); --}}
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
                var count = $('.work_environment_remote_checkbox').parents('.form_input_check').find(
                    'input[type="checkbox"]:checked').length;
                if (count == 1) {
                    {{-- @this.set('distance', 100); --}}
                    $('.slider-total-sec-col').css('display', 'none');
                } else {
                    // @this.set('distance', 0);
                    $('.slider-total-sec-col').css('display', 'block');
                }
            } else {
                // task - task - 86a0yje1d
                var count = $('.work_environment_checkbox:checked').length;
                {{-- @this.set('distance', $('.custom-value').text()); --}}
                if (count > 0) {
                    $('.slider-total-sec-col').css('display', 'block');
                } else {
                    $('.slider-total-sec-col').css('display', 'none');
                    $('.slider-total-sec-col').hide();
                }
            }
            {{-- $("#slider-range-min").slider({ value : @this.get('distance') }).trigger('change'); // task - 86a0d8ad0 --}}
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

                }
            });
        };
    </script>

    <script>
        $(".prev-btn").click(function(e) {
            e.preventDefault();
            // location.replace('/candidate/personal-information')
            window.location.href = '{{ url('/candidate/personal-information') }}';
        })
        // $(".nxt-btn").click(function(e) {
        //     e.preventDefault();
        //     location.replace('/candidate/education-employment')
        // })

        // task - 86a1hvpcy
        $('.save-later').click(function(e) {
            industriesData();
            interrestData();
        });

        $('select').on('select2:select, select2:unselect', function(e) {
            $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp; Finish Later');
        });

        $('select').on('select2:unselect', function(e) {
            $(this).select2('close');
        });

        $('input, select').on('change', function(event) {
            $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp; Finish Later');
        });
        // task - 86a1hvpcy end

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
                                return false;
                            }
                        });
                    }

                });

            if (count) {
                return false;
            }


            if (parseInt($(".custom-value").text()) < 1) {

                $('.distance').find(".text-danger").remove();
                if ($('.distance').is(':visible')) {
                    $('.distance').append(
                        '<div class="text-danger" style=""> Distance must be greater than or equal to 1 mile.</div>'
                    );
                    count++;
                    return false;
                }




            }
            {{-- 86a3d361e --}}
            if ($('.primary-industry:checked').length < 1) {
                $('.primary-industry').parents(".form-group").find('.text-danger').remove();
                $('.primary-industry:first').focus();
                $('.primary-industry').css('outline','1px solid red');
                $('.primary-industry').parents(".form-group").append(
                    '<div class="text-danger" style=""> Select primary industry.</div>'
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
                // window.location.href='{{ url('/candidate/education-employment') }}';
                industriesData();
                interrestData();
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
            /* task 86a1gwqft */
            {{-- $('.industries').select2({
                closeOnSelect: false
            }); --}}

            {{-- =========== --}}
            $('.industries').select2({
                closeOnSelect: false,
                templateSelection: formatState
            });

            var selectedId = "";

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    '<span><input type="checkbox" class="primary-industry"> <span></span> <p class="primary-label" style="font-size: 10px;margin: -4px 0px;padding: 1px 18px;color: green;"></p></span>'
                );

                $state.find("span").text(state.text);
                $state.find("input").attr('data-value', state.element.value);

                @if(!empty($selectedPrimaryIndustry))
                selectedId={{ $selectedPrimaryIndustry}}
                @endif
                if ((state.element.value == selectedId)) {
                    $state.find("input").prop('checked', true);
                    $state.find("p").text('Primary');

                }

                return $state;
            }

            // Prevent the dropdown from closing when clicking the checkbox
            $("body").on("click", ".primary-industry", function(e) {
                    $('.primary-label').text('');
                     $('.primary-industry').css('outline','unset');
                if ($(this).is(':checked')) {
                    $('.primary-industry').prop('checked', false);
                    $(this).prop('checked', true);
                    selectedId = $(this).attr('data-value');
                    $(this).parent('span').find('.primary-label').text('Primary');
                }else{
                    selectedId="";
                }
                e.stopPropagation(); // Prevent the dropdown from closing
            });

            $('.industries').on('select2:selecting', function(e) {
                if ($(e.params.args.originalEvent.target).hasClass('primary-industry')) {
                    e.preventDefault(); // Prevent the default select behavior
                }
            });

            $('.industries').on('select2:unselecting', function(e) {
                if ($(e.params.args.originalEvent.target).hasClass('primary-industry')) {
                    e.preventDefault(); // Prevent the default unselect behavior
                }
            });


            {{-- =========== --}}


            $('.interests').select2({
                closeOnSelect: false
            });
            /* task 86a1gwqft */
            if ($('.work_environment_checkbox:checked').length === 1) {
                if ($('.work_environment_checkbox:first').is(':checked')) {
                    $('.slider-total-sec-col').css('display', 'none');
                    {{-- @this.set('distance', 100); --}}
                }
            }
        });


        $("body").delegate("input,select", "change", function(e) {

            $(this).parents('.form-group').find(".text-danger").remove();

        });

        $(document).ready(function() {
            $("#work_environment_remote,#work_environment_in_office").on("click", function(e) {
                if ($('#work_environment_remote').is(':checked') && $('#work_environment_in_office').is(
                        ':checked')) {
                    $('#work_environment_hybrid').prop('checked', true);
                }

            });

            $("#work_environment_hybrid").on("click", function(e) {
                if ($('#work_environment_hybrid').is(':checked')) {
                    $('#work_environment_in_office').prop('checked', true);
                    $('#work_environment_remote').prop('checked', true);
                    //$('#work_environment_hybrid').prop('checked', true);
                }
            });
$("#schedule_part_time,#schedule_full_time,#schedule_no_preference").on("click", function(e) {
                $('.alert-txt').hide();
                if ($('#schedule_part_time').is(':checked') && $('#schedule_full_time').is(':checked')) {
                    $('.alert-txt').show().delay(4000).fadeOut('slow');

                    $('#schedule_no_preference').prop('checked', true);
                    $('#schedule_full_time').prop('checked', false);
                    $('#schedule_part_time').prop('checked', false);
                }
                if (($('#schedule_part_time').is(':checked') || $('#schedule_full_time').is(':checked')) &&
                    $('#schedule_no_preference').is(':checked')) {
                    $('.alert-txt').show().delay(4000).fadeOut('slow');

                    $('#schedule_no_preference').prop('checked', false);
                    $(this).prop('checked', true);
                    {{-- $('#schedule_full_time').prop('checked', false);
                    $('#schedule_part_time').prop('checked', false); --}}
                }
                if ($('#schedule_no_preference').is(':checked')) {
                    {{-- $('.alert-txt').show().delay(4000).fadeOut('slow'); --}}

                    $('#schedule_full_time').prop('checked', false);
                    $('#schedule_part_time').prop('checked', false);
                }
            });


        });
        $('#savePreferences').on('submit', function(event) {
            @this.set('schedule_no_preference', $('#schedule_no_preference').is(':checked'));
            @this.set('schedule_no_preference', $('#schedule_no_preference').is(':checked'));
            @this.set('schedule_full_time', $('#schedule_full_time').is(':checked'));
            @this.set('work_environment_remote', $('#work_environment_remote').is(':checked'));
            @this.set('work_environment_in_office', $('#work_environment_in_office').is(':checked'));
            @this.set('work_environment_hybrid', $('#work_environment_hybrid').is(':checked'));
            @this.set('selectedIndustries', $('.industries').val());
            @this.set('selectedInterests', $('.interests').val());
            @this.set('selectedPrimaryIndustry', $('.primary-industry:checked').attr('data-value'));
        });

        function industriesData() {
            var data = $('.industries').select2("val");
            var _old = @this.get('selectedIndustries');

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
                @this.set('selectedIndustries', data);
            }
        };


        function interrestData() {
            var data = $('.interests').select2("val");

            var tmp_data = data.map(Number);
            var _old = @this.get('selectedInterests');
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
                @this.set('selectedInterests', data);
            }

            var distanceValue = parseInt($(".custom-value").text());
            @this.set('distance', distanceValue);
        };
    </script>

    @if ($user_country != 'US')
        <script>
            $('#work_environment_in_office').prop('checked', true).attr('disabled', true);
            $('#work_environment_remote').prop('checked', true);
            $('#work_environment_hybrid').prop('checked', true).attr('disabled', true);
        </script>
    @else
    @endif
@endpush

