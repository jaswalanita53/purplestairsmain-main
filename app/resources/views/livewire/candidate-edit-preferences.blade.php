<div>
    <div class="form-sec cmn-gap back-clr main-form-sec pb-0 ban-up ban-up3">
        <div class="container">


            <nav aria-label="breadcrumb">
                <ol class="breadcrumb edit-personal justify-content-center justify-content-md-start">
                    <li class=" mb-2 mb-md-0"><a href="{{ route('candidates.editpersonal') }}">Edit Personal
                            Information</a></li>
                    <li class="active mb-2 mb-md-0" aria-current="page">Edit Position Preferences</li>
                    <li class=" mb-2 mb-md-0"><a href="{{route("candidates.editresume")}}">Edit Resume Information</a></li>
                </ol>
            </nav>
            <div class="sec-hdr mb-md-5 d-flex align-items-center justify-content-between">
                <h2 class="mb-0">  Edit Position Preferences</h2>
                <div class="profile-btn ms-btn text-nowrap">
                    @if(Auth::user()->current_step==9)
                    <a href="{{route("candidatestep9")}}" class="px-3 px-md-5"> Preview Profile</a>
                    @else
                        {{-- task - 86a0jby08 --}}
                        {{-- <a href="{{route("candidateProfile")}}" wire:click="validateProfile()"> View Profile</a> --}}
                        <a href="javascript:;" wire:click="validateProfile()" class="px-3 px-md-5"> View Profile</a>
                    @endif
                </div>
            </div>

            <div class="cmn-form">
                <div class="cmn-head">
                    <h5>&nbsp;</h5>
                    {{-- task - 86a0hxg00 @include('inc.autoSaveLoader') --}}
                </div>
            </div>

            {{-- task - 86a0hxg00 --}}
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            @if (session('error'))
            <span class="alert alert-danger">

                <strong>{{ session('error') }}</strong>
            </span>
            @endif
            {{-- task - 86a0hxg00 end --}}

            <div class="form-sec gl-form">
                <form wire:submit.prevent="savePreference()" id="savePreferences">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Industries*</label>
                            <div class="form-group">
                                <select class="js-example-tags industries" multiple="multiple" wire:model.lazy="selectedIndustries" id="selectedIndustries">
                                    @foreach ($all_industries as $key => $ind)
                                    <option value={{ $ind }} {{in_array($ind, $selectedIndustries) ? 'selected' : ''}}>{{ $key }}</option>
                                    @endforeach
                                </select>
                                @include('inc.error', [
                                'field_name' => 'selectedIndustries',
                                ])
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label>Area of Interest*</label>
                            <div class="form-group">
                                <select class="js-example-tags interests" multiple="multiple" wire:model.lazy="selectedInterests" id="selectedInterests">
                                    @foreach ($all_interests as $key => $interest)
                                    <option value={{ $interest }} {{in_array($interest, $selectedInterests) ? 'selected' : ''}}>{{ $key }}</option>
                                    @endforeach
                                </select>
                                @include('inc.error', [
                                'field_name' => 'selectedInterests',
                                ])
                            </div>
                        </div>
                        <div class="col-md-6">
                        <label>Primary Industry* </label>
                        <div class="form-group">
                            <select class="js-example-tags form-control"  wire:model.defer="selectedPrimaryIndustry" id="selectedPrimaryIndustry" >
                            <option  value=>Select </option>
                                @foreach ($all_industries as $key => $ind)

                                <option value={{ $ind }} @if(!empty($selectedPrimaryIndustry)){{($ind==$selectedPrimaryIndustry) ? 'selected' : ''}} @endif>{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        @include('inc.error', [
                            'field_name' => 'selectedPrimaryIndustry',
                        ])
                        </div>
                        <div class="col-lg-6">
                            <div class="form-sec-left form-group">
                                <label class="mobile-v">Work Setting* </label>
                                <label class="desktop-v">Work Setting* (You may choose more than one)</label>
                                <div class="form-group-for-custom-checkbox">
                                    <div class="form_input_check">
                                        <label>
                                            <input type="checkbox" wire:model.lazy="work_environment_remote" class="work_environment_checkbox work_environment_remote_checkbox"  {{ $work_environment_remote ? 'checked' : '' }}/>
                                            <span>Remote</span>
                                        </label>

                                        <label>
                                            <input type="checkbox" wire:model.lazy="work_environment_in_office" class="work_environment_checkbox" {{ $work_environment_in_office ? 'checked' : '' }}/>
                                            <span> In Office</span>
                                        </label>

                                        <label>
                                            <input type="checkbox" wire:model.lazy="work_environment_hybrid" class="work_environment_checkbox" {{ $work_environment_hybrid ? 'checked' : '' }}/>
                                            <span>Hybrid</span>
                                        </label>
                                    </div>
                                </div>
                                @if($work_env_error)
                                <div class="text-danger">{{ $work_env_error }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-sec-left form-group">
                                <label class="mobile-v">Schedule* </label>
                                <label class="desktop-v">Schedule* (You may choose more than one)</label>
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
                                @if($schedule_error)
                                <div class="text-danger">{{ $schedule_error }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-sec-left form-group">
                                <label class="mobile-v">Compensation* </label>
                                <label class="desktop-v">Compensation* (You may choose more than one)</label>
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
                                @if($compensation_error)
                                <div class="text-danger">{{ $compensation_error }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="gl-frm-outr pos-r">
                                <label>Salary* </label>


                                <!-- <span class="custom-tool">
                                    <span>?</span>

                                    <div class="tool-info">
                                        <p>
                                            Enter your desired salary range - don’t sell yourself short!
                                        </p>
                                    </div>
                                </span> -->

                                <div class="form-group">
                                    <select class="form-select" wire:model.lazy="salary_range">
                                        <option value="">Choose Salary Range</option>
                                        <!-- <option>$20,000 - $40,000</option>
                                        <option>$40,000 - $60,000</option>
                                        <option>$60,000 - $80,000</option>
                                        <option>$80,000 - $100,000</option>
                                        <option>$100,000 - $125,000</option>
                                        <option>$125,000 - $150,000</option>
                                        <option>$150,000- $200,000</option>
                                        <option>$250,000+</option> -->
                                        @foreach ($all_salaries as $key => $salary)
                                        <option value="{{ $key }}"> {{ $key }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                @include('inc.error', [
                                'field_name' => 'salary_range',
                                ])
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Ideal Job Attributes</label>
                            <div class="custom-check-sec">
                                <div class="row">
                                    <div class="col-md-12">
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
                        </div>
                        <div class="col-lg-6">
                            <div class="slide-sec-rgt">
                                <div class="row">
                                    <div class="col-lg-12 slider-total-sec-col" style="display: {{ ($work_environment_in_office || $work_environment_hybrid || (!$work_environment_in_office && !$work_environment_hybrid && !$work_environment_remote)) ? 'block' : 'none' }}" wire:ignore.self>
                                        <div class="form-group">
                                            <div class="slider-total-sec">
                                                <div class="slider-total-left">
                                                    Distance I can travel*
                                                </div>
                                                <br>
                                                <input type="hidden" name="distance" id="distance" value="{{$distance}}" wire:ignore>
                                                <div class="slider-total-right" wire:ignore>
                                                    {{--  wire:model.lazy="distance" --}}
                                                    <div id="slider-range-min">
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
                    </div>
                    <div class="form-submit-btn mb-0">
                        <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="savePreference"/>
                        <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="savePreference"/>
                    </div>
                </form>
            </div>

            <div class="cmn-form-btm">
                <!-- <div class="ftr-btm-lft">
                    <p>© 2024 Purple Stairs</p>
                    <span>Website by
                        <a href="https://www.brand-right.com/" target="_blank">
                            BrandRight Marketing Group</a></span>
                </div> -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // task - 86a0jby08
    function validatePage() {
        $('html, body').animate({
            scrollTop: $("div.text-danger:first").offset().top - 200
          }, 500);
          return false;
    }
    // task - 86a0jby08 end

    $('#savePreferences').on('submit', function(event) {
        @this.set('distance', $("#distance").val());
    });

    var IndustrySelect2;
    var InterestSelect2;
    var openIndustry = false;
    var openInterest = false;

    var parent_id, child_id;
    let selected = [];
    let selected1 = [];

    // task - 86a0pwt5m
    document.addEventListener("livewire:load", () => {
        Livewire.hook('message.processed', (message, component) => {
            console.log('hook loads...');

            // task - 86a12tj3p
            $('#selectedInterests,#selectedIndustries').select2({
                closeOnSelect: false,
                tags: false
            });

            console.log(@this.get('selectedIndustries'));
            let indust = @this.get('selectedIndustries');
            let inter = @this.get('selectedInterests');
            if(openIndustry && indust.length == 0) {
                $('#selectedIndustries').select2('open');
                $('#selectedInterests').select2('close');
            } else if(openInterest && inter.length == 0) {
                $('#selectedIndustries').select2('close');
                $('#selectedInterests').select2('open');
            } else {
                $('#selectedInterests,#selectedIndustries').select2('close');
            }
            setTimeout(() => {
                if($("div.text-danger:first").length) {
                    $('.industries').select2({
                        closeOnSelect: false,
                        tags: false
                    });
                    $('.interests').select2({
                        closeOnSelect: false,
                        tags: false
                    });
                    validatePage();
                }
            }, 250);
        });
    })

    // task - 86a0fxn2y
    /* task - 86a0hxg00 $('.submit-btn').click(function(event) {
        $('html, body').animate({
            scrollTop: $("div.cmn-head:first").offset().top - 200
        }, 500);
    });*/
    // task - 86a0fxn2y end

    console.log("test - new");

    $('select').on('select2:select', function(e) {
        console.log($(this).parents('.form-group').find('.text-danger'));
        $(this).parents('.form-group').find('.text-danger').remove();
    })

    // task - 86a114e9r
    $('.industries').on('select2:select', function (e) {
        $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
    });

    $('.interests').on('select2:select', function (e) {
        $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
    });
    // task - 86a114e9r end

    $('.work_environment_checkbox').on('change', function () {
        if ($('.work_environment_remote_checkbox').is(':checked')) {
            var count = $('.work_environment_remote_checkbox').parents('.form_input_check').find('input[type="checkbox"]:checked').length;
            console.log(count);
            if (count == 1) {
                // @this.set('distance', 100);
                $('.slider-total-sec-col').css('display', 'none');
                $('.slider-total-sec-col').hide();
            } else {
                // @this.set('distance', $('.custom-value').text());
                $('.slider-total-sec-col').css('display', 'block');
            }
        } else {
            // @this.set('distance', $('.custom-value').text());

            // task - task - 86a0yje1d
            var count = $('.work_environment_checkbox:checked').length;
            if (count > 0) {
                $('.slider-total-sec-col').css('display', 'block');
            } else {
                $('.slider-total-sec-col').css('display', 'none');
                $('.slider-total-sec-col').hide();
            }
        }
    }).trigger('change');

    //initiate industries select2
    $('.industries').on('select2:close', function(event) {
        //var data = $('.industries').select2("val");
        //var _old = @this.get('selectedIndustries');

        //var tmp_data = data.map(Number);
        //_old = _old.map(Number);
        //let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
        //let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

        //const values = tmp_data;
        //selected = selected.filter((value) => values.includes(value));
        //const lastSelected = values.filter((value) => !selected.includes(value));
        //selected.push(lastSelected[0]);

        //let child_ = $('.industries option[value=' + lastSelected[0] + ']').text();
        //parent_id = $(".select2-results__option:contains('" + child_ + "')").parent().attr('id');
        //child_id = child_;

        //if (diff1.length > 0 || diff2.length > 0) {
         //   @this.set('selectedIndustries', data);
        //}
        {{-- var data = $('.industries').select2("val"); --}}
        {{-- @this.set('selectedIndustries', data); --}}
    });

    $('.interests').on('select2:close', function(e) {
        //var data = $('.interests').select2("val");
        //var tmp_data = data.map(Number);
        //var _old = @this.get('selectedInterests');
       // _old = _old.map(Number);
       // let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
       // let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

        //const values = tmp_data;
        //selected1 = selected1.filter((value) => values.includes(value));
        //const lastSelected = values.filter((value) => !selected1.includes(value));
        //selected1.push(lastSelected[0]);

        //let child_ = $('.interests option[value=' + lastSelected[0] + ']').text();
        //parent_id = $(".select2-results__option:contains('" + child_ + "')").parent().attr('id');
        //child_id = child_;

        //if (diff1.length > 0 || diff2.length > 0) {
         //   @this.set('selectedInterests', data);
        //}
         {{-- var data = $('.interests').select2("val"); --}}
            {{-- @this.set('selectedInterests', data); --}}
    });

    window.addEventListener('keep-open-industries', event => {
        openIndustry = true;
        openInterest = false;
    });
    window.addEventListener('keep-open-interests', event => {
        openIndustry = false;
        openInterest = true;
    });
    window.addEventListener('close-multiselect', event => {
        openIndustry = false;
        openInterest = false;
    });

    /*document.addEventListener("livewire:load", () => {
        alert('5');
        let el = $('.industries');
        let el1 = $('.interests');

        // initSelectIndustry();
        $(document).on('click', '.select2-results__option', function(event) {
            parent_id = $(this).parent().attr('id');
            child_id = $(this).text();
        });

        $('.industries').on('change', function(e) {
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
        });

        /*Livewire.hook('message.processed', (message, component) => {
            alert('1');
            if (openIndustry) {
                initSelectIndustry(1);
            } else {
                initSelectIndustry();
            }
        })*

        window.addEventListener('keep-open-industries', event => {
            openIndustry = true;
            openInterest = false;
            // initSelectIndustry(1);
        });

        function initSelectIndustry(open = 0) {
            IndustrySelect2 = el.select2({
                closeOnSelect: false,
                tags: false
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
        });

        /*Livewire.hook('message.processed', (message, component) => {
            alert('2');
            if (openInterest) {
                initSelectInterest(1);
            } else {
                initSelectInterest();
            }
        });*

        window.addEventListener('keep-open-interests', event => {
            openIndustry = false;
            openInterest = true;
            // initSelectInterest(1);
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
                // initSelect2Industries();
                initSelectIndustry();
            }
        }

        window.addEventListener('close-multiselect', event => {
            openIndustry = false;
            openInterest = false;
        });
        // }
    })*/
</script>

<script>
    /*document.addEventListener("livewire:load", () => {
        alert('3');
        initSlider();
    })*/

    function initSlider(distanceValue) {
        // let distanceValue = '<?php echo $distance; ?>';
        var handle = $("#custom-handle");
        let popup = $(".custom-value")
        $("#slider-range-min").slider({
            range: "min",
            value: distanceValue,
            min: 0,
            max: 100,
            create: function() {
                console.log('create = ' + $(this).slider("value"));
                handle.text($(this).slider("value"));
                popup.text($(this).slider("value"))
            },
            slide: function(event, ui) {
                console.log(ui.value);
                // @this.set('distance', ui.value);
                // $(".custom-value").text(ui.value);
                $("#distance").val(ui.value);
                $("#slider-range-min").slider('value', ui.value);

                $('.ui-slider-range').css('width', ui.value + '%');
                if (ui.value < 1) {
                    $('.distance').find(".text-danger").remove();
                    $('.distance').append(

                        '<div class="text-danger" style=""> Distance must be greater than or equal to 1 mile.</div>'
                    );
                    // $(".custom-value").text(1)
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

    initSlider('<?php echo $distance; ?>');
</script>

<script>
    $(".prev-btn").click(function(e) {
        e.preventDefault();
        window.location.href='{{url("/candidate/personal-information")}}'
    })
    $(".nxt-btn").click(function(e) {
        e.preventDefault();
        window.location.href='{{url("/candidate/education-employment")}}'
    })

    /*document.addEventListener("livewire:load", () => {
        $("input").click(function(e) {
            var label = $(this).parents('.form-sec-left.form-group').find("label:first").text();

            if (label.includes("*")) {
                var count = $(this).parents('.form_input_check').find('input[type=checkbox]:checked').length;
                $(this).parents('.form-sec-left.form-group').find(".text-danger").remove();
                if (count < 1) {
                    $(this).parents('.form-sec-left.form-group').find("input:first").focus();
                    $(this).parents('.form-sec-left.form-group').find("select:first").focus();
                    $(this).parents('.form-sec-left.form-group').append(
                        '<div class="text-danger" style=""> This field is required.</div>'
                    );
                    // return false;
                }
            }

        });
    })*/


    //   Work Setting on remote
    /*document.addEventListener("livewire:load", () => {
        $("body").delegate(".work_environment_checkbox", "click", function(e) {
            workEnv();
        });
        workEnv();
        /*Livewire.hook('message.processed', (message, component) => {
            alert('4');
            if ($('.work_environment_remote_checkbox').is(':checked')) {
                var count = $('.work_environment_remote_checkbox').parents('.form_input_check').find('input[type="checkbox"]:checked').length;
                if (count == 1) {
                    $('.slider-total-sec-col').css('display', 'none');
                } else {
                    $('.slider-total-sec-col').css('display', 'block');
                }
            } else {
                $('.slider-total-sec-col').css('display', 'block');
            }
        })*
    })*/

    /*function workEnv() {
        if ($('.work_environment_remote_checkbox').is(':checked')) {
            var count = $('.work_environment_remote_checkbox').parents('.form_input_check').find('input[type="checkbox"]:checked').length;
            if (count == 1) {
                @this.set('distance', 100);
                $('.slider-total-sec-col').css('display', 'none');
            } else {
                @this.set('distance', $('.custom-value').text());
                $('.slider-total-sec-col').css('display', 'block');
            }
        } else {
            @this.set('distance', $('.custom-value').text());
            $('.slider-total-sec-col').css('display', 'block');
        }
    }*/

    window.addEventListener('init-select', event => {
        // $('#selectedIndustries,#selectedInterests').select2();
        // initSlider();
    });

    $('#selectedIndustries,#selectedInterests').select2({
        closeOnSelect: false,
        tags: false
    });
     $('#savePreferences').on('submit', function (event) {
            var data = $('.interests').select2("val");
            @this.set('selectedInterests', data);
             var data2 = $('.industries').select2("val");
            @this.set('selectedIndustries', data2);
    });
</script>
@endpush
