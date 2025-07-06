@push('styles')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
    <style>
        .optional-fields-emp-hidden,
        .warn-txt-hidden {
            display: none;
        }

        .button-add-optional {
            cursor: pointer;
        }

        .button-add-optional:hover .add-c-p {
            color: black;
            font-weight: 500;
            font-size: 14px;
            margin-left: 30px;
        }

        .add-c-p {
            font-weight: 500;
            font-size: 14px;
            margin-left: 30px;
        }

        .add-c-s {
            color: #ffae1a;
            ;
        }

        .button-add-optional:hover .add-c-s {
            color: purple;
        }

        .custom-tool-swal {
            position: relative !important;
            left: -3px;
            top: -1px;
        }

        .custom-tool-swal .tool-info-swal {
            opacity: 1;
        }

        .tool-info-swal {
            padding: 3px;
        }

        input[type="file"] {
            color: black;
        }

        input[type="file"]::before {
            padding: 5px 10px;
            background-color: #F7F7F7;
            ;
            /* Replace with your desired background color */
            color: black;
            /* Replace with your desired text color */
            border: 2px solid gray;
            /* Match with the border color of the file input */
            border-radius: 5px;
            /* Optional: Add border radius for rounded corners */
            cursor: pointer;
            /* Add a pointer cursor for better user interaction */
        }

        /* Hide the original file input text */
        .start-btn-purple {
            font-weight: 500;
            font-size: 16px;
            text-align: center;
            background: var(--purple);
            border-radius: 35px;
            color: #ffffff;
            height: 40px;
            width: 169px;
            border: 1px solid transparent;
        }

        .start-btn-purple:hover {
            background-color: white;
            color: var(--purple);
            border-color: var(--purple);
        }

        p.error.text-danger.file-err.text-left {
            text-align: left;
            margin-top: 5px;
        }
    div#swal2-html-container {
    line-height: 23px !important;

}
    </style>
@endpush
<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="form-points">
                @php
                    $step = 5;
                    $current_step = auth()->user()->current_step;
                @endphp
                @include('inc.steps', compact('step', 'current_step'))
            </div>
        </div>
    </section>

    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
            <div class="common-form-outr">
                {{-- error message --}}
                {{-- @error('fileInput')
                <div class="row">
                    <div class="col text-danger">{{ $message }}</div>
                </div>
                @enderror --}}

                <div class="form-hdr">
                    <h5>Employment</h5>
                    <div>
                        <a class="skip skip-5th-step" {{-- data-fancybox
                  data-src="#open2" --}} href="javascript:void(0)">Skip <em><img
                                    src="{{ asset('assets/fe/images/skip-arrw.svg') }}" alt="" /></em></a>

                        {{-- task - 86a1hvpcy --}}
                        <button type="button" class="btn save-later" wire:click="finish_later" style="">
                            <img src="{{ url('assets/be/images/save-icon.svg') }}" />
                            &nbsp;{{ $profileSaved ? 'Profile Saved' : 'Finish Later' }}
                        </button>

                    </div>
                </div>
                <form wire:submit.prevent="saveEmployement()" id="saveEmployement">
                    <div class="gl-form form-sec">
                        <div class="warn-txt ">
                            <img src="{{ asset('assets/fe/images/warn.svg') }}" alt="" />
                            {{-- <span>Employers search profiles based on years of experience which will be based on the
                                information you input below. If you leave this section blank, It will appear as if you
                                have zero years of experience. <br> <strong>Note: Enter your most recent position
                                    first.</strong></span> --}}
                            <span>Enter your most recent position first</span>
                        </div>

                        @foreach ($employments as $key => $employment)
                            <span class="main-emp-sec-common">
                                @if ($key > 0)
                                    <h6>
                                        Enter Previous Employment

                                        {{-- task - 86a0d8bft --}}
                                        <button type="button" class="remove_additional_sec"
                                            wire:click="removeEmp({{ $employment->id }})"><img
                                                src="{{ asset('assets/fe/images/delete.svg') }}"
                                                alt="Remove Section" /></button>
                                    </h6>
                                @endif
                                <div class="gl-frm-outr mb-2">
                                    <label>Company name</label>
                                    <div class="form-group">
                                        <input type="text" placeholder="" class="form-control edu-input"
                                            wire:model.defer="company_name.{{ $employment->id }}" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox"
                                                    class="switch_1 company_name_status_{{ $employment->id }}"
                                                    checked="" data-value="{{ $employment->company_name_status }}"
                                                    wire:model.defer="company_name_status.{{ $employment->id }}"
                                                    tabindex="-1" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $employment->company_name_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="{{ asset('assets/fe/images/hidden.svg') }}"
                                                    alt="" />Hidden to everyone

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
                                        <input type="text" placeholder="" class="form-control edu-input"
                                            wire:model.defer="position.{{ $employment->id }}" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox"
                                                    class="switch_1 position_status_{{ $employment->id }}"
                                                    checked="" data-value="{{ $employment->position_status }}"
                                                    wire:model.defer="position_status.{{ $employment->id }}"
                                                    tabindex="-1" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $employment->position_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="{{ asset('assets/fe/images/hidden.svg') }}"
                                                    alt="" />Hidden to everyone

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

                                    <span class="d-flex">
                                        <label>Employment Duration <span class="text-grey">(Dates)</span></label>
                                        <label>
                                            <input type="checkbox" class=""
                                                @if ($employment->currently_working) checked=true @endif
                                                wire:model="currently_working.{{ $employment->id }}" />
                                            &nbsp;<span class="text-grey">This is my current position</span>
                                        </label>
                                    </span>
                                    <div class="warn-txt blink warn-txt-hidden">
                                        <img src="{{ asset('assets/fe/images/warn.svg') }}" alt="">
                                        <span>Omitting may imply zero years of experience in our website filter.</span>
                                    </div>
                                    <div class="form-group for-dropdown-option for-abs-label">
                                        <div class="input-field-dropdown">
                                            <div class=" input-daterange">
                                                <div class="yr-field" wire:ignore:self> <input type="text"
                                                        class="form-control input1 edu-input" placeholder="Start Date"
                                                        wire:model.defer="start_year.{{ $employment->id }}"
                                                        onchange="this.dispatchEvent(new InputEvent('input'))"
                                                        wire:key="start_year.{{ $employment->id }}" /></div>

                                                {{-- @if ($employment->currently_working) --}}
                                                @if ($currently_working[$employment->id])
                                                    <div class="">
                                                        <input type="text" class="form-control input2 edu-input"
                                                            placeholder="End Date " value="PRESENT"
                                                            wire:key="end_year_currently.{{ $employment->id }}" />
                                                    </div>
                                                @else
                                                    <div class="yr-field" wire:ignore:self> <input type="text"
                                                            class="form-control input2 edu-input"
                                                            placeholder="End Date "
                                                            wire:model.defer="end_year.{{ $employment->id }}"
                                                            onchange="this.dispatchEvent(new InputEvent('input'))"
                                                            wire:key="end_year.{{ $employment->id }}" /> </div>
                                                @endif

                                            </div>

                                        </div>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox"
                                                    class="switch_1 start_year_status_{{ $employment->id }}"
                                                    checked="" data-value="{{ $employment->start_year_status }}"
                                                    wire:model.defer="start_year_status.{{ $employment->id }}"
                                                    tabindex="-1" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $employment->start_year_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="{{ asset('assets/fe/images/hidden.svg') }}"
                                                    alt="" />Hidden to everyone
                                                <div class="in-ap">
                                                    <p>
                                                        This information will only be unmasked to a Requesting
                                                        company <strong>upon your approval.</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($end_year_error[$employment->id]))
                                        {{-- <div class="error this" style="margin-top: -10px;">
                <small class="text-danger">{{ $end_year_error[$employment->id] }} </small>
            </div> --}}
                                    @endif

                                </div>
                                @if (empty($employment->responsibilities) && empty($employment->accomplishments))
                                    <span class="button-add-optional mt-3 font-bold">
                                        <p class="mb-3 add-c-p"><span class="add-c-s">+</span> Add Position
                                            Responsibilities and Accomplishments (Optional)</p>
                                    </span>
                                @endif
                                <span
                                    class="optional-fields-emp  @if (!empty($employment->responsibilities) || !empty($employment->accomplishments)) optional-fields-emp-show @else optional-fields-emp-hidden @endif  ">
                                    <div class="gl-frm-outr mb-2">
                                        <label>Position Responsibilities</label>
                                        <div class="form-group">
                                            <textarea placeholder="" class="lg-textarea edu-input" wire:model.defer="responsibilities.{{ $employment->id }}"></textarea>
                                            <div class="toggle-switch-block">
                                                <span>show</span>
                                                <div class="switch_box box_1">
                                                    <input type="checkbox"
                                                        class="switch_1 responsibilities_status_{{ $employment->id }} "
                                                        checked=""
                                                        data-value="{{ $employment->responsibilities_status }}"
                                                        wire:model.defer="responsibilities_status.{{ $employment->id }}"
                                                        tabindex="-1" />
                                                </div>
                                                <span>Hide</span>
                                            </div>
                                            <div
                                                class="hiden {{ $employment->responsibilities_status ? '' : 'show' }}">
                                                <div class="d-span">
                                                    <img src="{{ asset('assets/fe/images/hidden.svg') }}"
                                                        alt="" />Hidden to everyone

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
                                    <div class="gl-frm-outr mb-0">
                                        <label>Position Accomplishments</label>
                                        <div class="form-group">
                                            <textarea placeholder="" class="lg-textarea edu-input" wire:model.defer="accomplishments.{{ $employment->id }}"></textarea>
                                            <div class="toggle-switch-block">
                                                <span>show</span>
                                                <div class="switch_box box_1">
                                                    <input type="checkbox"
                                                        class="switch_1 accomplishments_status_{{ $employment->id }}"
                                                        checked=""
                                                        data-value="{{ $employment->accomplishments_status }}"
                                                        wire:model.defer="accomplishments_status.{{ $employment->id }}"
                                                        tabindex="-1" />
                                                </div>
                                                <span>Hide</span>
                                            </div>
                                            <div
                                                class="hiden {{ $employment->accomplishments_status ? '' : 'show' }}">
                                                <div class="d-span">
                                                    <img src="{{ asset('assets/fe/images/hidden.svg') }}"
                                                        alt="" />Hidden to everyone

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
                                </span>

                                <!-- Task 862k42apk
          <div class="form-bulb">
            <span><img src="{{ asset('assets/fe/images/like-up.png') }}" alt="" /></span>
            <p>
              You know you’re the best in the field. Share something that lets
              us know it too!
            </p>
          </div> -->
                                <hr>
                            </span>
                        @endforeach


                        <div class="gl-frm-btn">
                            <a href="#" class="pos-btn" wire:click.prevent="add()">
                                Add Previous Position
                                <span>+</span>
                            </a>
                        </div>
                        <div class="whole-btn-wrap dual-btn">
                            <input type="submit" value="Back" class="prev-btn" />
                            <input type="submit" value="Next" class="nxt-btn" wire:loading.remove
                                wire:target="saveEmployement" />
                            {{-- skip-5th-step --}}
                            <input type="button" value="Saving..." class="nxt-btn" wire:loading
                                wire:target="saveEmployement" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- task - 86a1tnfve --}}
<style type="text/css">
    .modal#uploadcvModal {
        top: 35%;
    }
    #uploadcvModal .modal-content {
        border-radius: 22px !important;
        border: none;
    }

    #uploadcvModal .progress-bar {
        background: #7e50a7;
    }

    #uploadcvModal .progress-bar-striped {
        background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
        background-size: 1rem 1rem;
    }
</style>
<div class="modal fade my-auto mx-auto" id="uploadcvModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center" id="alertModalBody">
        <span class="pt-3" style="color:#7e50a7;">
            <br>
            <b style="font-weight: 600;font-size: 14pt;"> Auto fill can take 1 to 2 minutes</b>
        </span>
        <p class="pt-3">
            <div class="progress">
              <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
            </div>
        </p>
        <br>
        <p style="color:#7e50a7; font-size: 10pt; line-height: 1.8;font-weight: 500;">Please do not leave this page.</p>
      </div>

    </div>
  </div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // task - 86a1hvpcy
        $('input, textarea').on('change', function(event) {
            $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp; Finish Later');
        });

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
                    if (val) {
                        $('.company_name_status_' + index).parents(".toggle-switch-block").next()
                            .removeClass("show");
                    } else {
                        $('.company_name_status_' + index).parents(".toggle-switch-block").next()
                            .addClass("show");
                    }
                });

                $.each(position_status, function(index, val) {
                    /* iterate through array or object */
                    if (val) {
                        $('.position_status_' + index).parents(".toggle-switch-block").next()
                            .removeClass("show");
                    } else {
                        $('.position_status_' + index).parents(".toggle-switch-block").next()
                            .addClass("show");
                    }
                });

                $.each(responsibilities_status, function(index, val) {
                    /* iterate through array or object */
                    if (val) {
                        $('.responsibilities_status_' + index).parents(".toggle-switch-block")
                            .next().removeClass("show");
                    } else {
                        $('.responsibilities_status_' + index).parents(".toggle-switch-block")
                            .next().addClass("show");
                    }
                });

                $.each(start_year_status, function(index, val) {
                    /* iterate through array or object */
                    if (val) {
                        $('.start_year_status_' + index).parents(".toggle-switch-block").next()
                            .removeClass("show");
                    } else {
                        $('.start_year_status_' + index).parents(".toggle-switch-block").next()
                            .addClass("show");
                    }
                });

                $.each(accomplishments_status, function(index, val) {
                    /* iterate through array or object */
                    if (val) {
                        $('.accomplishments_status_' + index).parents(".toggle-switch-block").next()
                            .removeClass("show");
                    } else {
                        $('.accomplishments_status_' + index).parents(".toggle-switch-block").next()
                            .addClass("show");
                    }
                });
            });
        })

        $(document).on('change', '.switch_1', function() {
            if ($(this).prop('checked')) {
                $(this).parents(".toggle-switch-block").next().removeClass("show");
            } else {
                $(this).parents(".toggle-switch-block").next().addClass("show");
            }
        });
        $(document).on('change', '.input2', function() {
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
            var most_employement = 1;
            other_employement = 0;

            var count = 0;
            count = $('.text-danger').length;

            $('#saveEmployement .input-daterange').each(function(index, el) {
                var start = $(this).find('input:first');
                var end = $(this).find('input:last');
                console.log(start, end, start.val(), end.val())
                if (start.val() != "") {

                    if (end.val() == "") {
                        $(this).find('input:last').focus();
                        $(this).parents('.gl-frm-outr').find('.error').remove();
                        $(this).parents('.gl-frm-outr').find('.form-group:last').prepend(
                            '<div class="error" style="margin-top: -10px;"> <small class="text-danger">You must select an end date. </small></div>'
                        );
                        count++;
                    }
                }
                if (end.val() != "") {
                    if (start.val() == "") {
                        $(this).find('input:first').focus();
                        $(this).parents('.gl-frm-outr').find('.error').remove();
                        $(this).parents('.gl-frm-outr').find('.form-group:last').prepend(
                            '<div class="error" style="margin-top: -10px;"><small class="text-danger">You must select a start date. </small></div>'
                        );
                        count++;
                    }
                }
                if (end.val() != "" && end.val()) {
                    var startDateString = start.val();
                    var endDateString = end.val();

                    // Convert date strings to a format that the Date constructor recognizes
                    var startDate = new Date("01 " + startDateString);
                    var endDate = new Date("01 " + endDateString);

                    // Check if end date is smaller than start date

                    if (endDate < startDate) {
                        $(this).find('input:last').focus();
                        $(this).parents('.gl-frm-outr').find('.error').remove();
                        $(this).parents('.gl-frm-outr').find('.form-group:last').prepend(
                            '<div class="error" style="margin-top: -10px;"><small class="text-danger">End month can not be before the start month.. </small></div>'
                        );
                        count++;
                        return false;

                    }
                }


                // task - 86a0fxne0
                if (index == 0 && ((start.val() == '' && end.val() == '') || (start.val() != '' && end
                        .val() == ''))) {
                    most_employement = 0;
                } else if ((start.val() == '' && end.val() == '') || (start.val() != '' && end.val() ==
                        '')) {
                    other_employement++;
                }
            })

            if (count > 0) {
                return false;
            } else {
                // task - 862k3f10h
                let filled_fields = 1;
                let old_emp = null;
                $('#saveEmployement input').each(function(index, el) {

                    if (el.type == 'text') { // task #86a0f92wg
                        /*let F__ = $(el).attr('wire:model.defer');
                        let spl_ = F__.split('.');
                        old_emp = parseInt(spl_[1]);*/
                        if ($.trim($(el).val()) == '') {
                            filled_fields = 0;
                        }
                        if ($(el).hasClass('input1')) {}
                    }
                });

                // task - 862k46fh0
                var end_Y_CNT = 0;

                // task - 86a0d8f9t
                var start_Y_CNT = 0;
                $('#saveEmployement input').each(function(index, el) {
                    var end_years2 = @this.get('end_year');
                    var start_years2 = @this.get('start_year');

                    if (el.type == 'checkbox') {
                        let _end_Y = null;
                        let _start_Y = null;
                        if ($(el).prop('checked') === false && !$(el).hasClass('switch_1')) {
                            let F__ = $(el).attr('wire:model.defer');
                            {{-- let F__ = $(el).attr('wire:model'); --}}
                            if (F__ != undefined) {
                                let spl_ = F__.split('.');
                                let idx_ = parseInt(spl_[1]);
                                _end_Y = end_years2[idx_];
                                _start_Y = start_years2[idx_];

                                if (_start_Y && (_end_Y == '' || _end_Y == null)) {
                                    end_Y_CNT++;
                                    Livewire.emit('updateErrors', idx_);
                                }
                            }
                        }
                    } else if (el.type == 'text' && $(el).hasClass('input1')) { // task - 86a0d8f9t
                        let F__ = $(el).attr('wire:key');
                        let spl_ = F__.split('.');
                        let idx_ = parseInt(spl_[1]);
                        _start_Y = start_years2[idx_];

                        if (_start_Y == '' || _start_Y == null) {
                            start_Y_CNT++;
                            Livewire.emit('updateValidation', idx_);
                        }
                    }
                });

                if (end_Y_CNT > 0) {
                    $('html, body').animate({
                        scrollTop: $("div.error:first").offset().top - 200
                    }, 500);

                    return false;
                }
                // task - 862k46fh0 end
                // task - 862k3f10h end

                if (form_submit) {
                    return form_submit;
                }
                {{-- console.log(most_employement, other_employement); exit() --}}
                // task - 86a0fxne0
                var alert_title =
                    "The system will calculate and display your total years of experience based on the start date of your first position you provide in this section.";
                /* task - 86a1tp6e5 P-3 if (most_employement == 1 && other_employement > 0) {
                    alert_title =
                        "you have added previous employement section but you have not filled up any information in other section(s)."
                }*/
                // task - 86a0fxne0 end

                var _return_val = false;
                if ((filled_fields == 0 && most_employement == 0) || (most_employement == 1 && other_employement > 0)) {
                    e.preventDefault();
                    var confirmationMessage =
                        '<div><p style="margin-top: 22px" class="mb-2">The system will calculate and display your total years of experience based on the start date of your first position you provide in this section.</p><b style="font-weight: 600;font-size: 14pt; color: #7e50a7;">Are you sure you want to skip?</b> <br></div>';

                    Swal.fire({
                        html: confirmationMessage,
                        {{-- title: alert_title, --}}
                        {{-- text: 'Are you sure you want to skip?', --}}
                        icon: 'warning',
                        iconHtml: "<img src='{{ asset('assets/fe/images/warning.png') }}'>",
                        showCancelButton: true,
                        confirmButtonColor: '#7E50A7',
                        cancelButtonColor: '#4A2D64',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        showCloseButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // window.location.href='{{ url('/candidate/skills') }}'; task - 86a0hxg00
                            form_submit = true;
                            $('.nxt-btn').trigger('click');
                            return true;
                        } else {
                            Livewire.hook('message.processed', (message, component) => {

                                $('#saveEmployement .input-daterange').each(function(index, el) {
                                    var start2 = $(this).find('input:first');
                                    var end2 = $(this).find('input:last');
                                    if (start2.val() == "" && end2.val() == "") {
                                        $(this).parents('.gl-frm-outr').find('.warn-txt')
                                            .removeClass('warn-txt-hidden');
                                    }
                                })
                            })
                            setTimeout(function() {
                                $('#saveEmployement .input-daterange').each(function(index, el) {
                                    var start2 = $(this).find('input:first');
                                    var end2 = $(this).find('input:last');
                                    if (start2.val() == "" && end2.val() == "") {
                                        $(this).parents('.gl-frm-outr').find('.warn-txt')
                                            .removeClass('warn-txt-hidden');
                                    }
                                })
                            }, 500);
                            $('html, body').animate({
                                scrollTop: $("div.error:first").offset().top - 200
                            }, 500);
                            return false;
                        }
                    });
                } else {
                    // window.location.href='{{ url('/candidate/skills') }}'; task - 86a0hxg00
                    return true;
                }
            }
        })

        document.addEventListener("livewire:load", () => {
            $(document).ready(function() {
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
        $("body").delegate(".input2,.input1", "click", function(e) {
            $(this).parents('.gl-frm-outr').find('.error').remove();
        })
        $("body").delegate(".button-add-optional", "click", function(e) {
            $(this).parents('.main-emp-sec-common').find('.optional-fields-emp').show();
            $(this).hide();
        })

        {{-- $("body").delegate(".nxt-btn,.skip-5th-step", "mouseover", function(e) {
            $('#saveEmployement .input-daterange').each(function(index, el) {
                var start2 = $(this).find('input:first');
                var end2 = $(this).find('input:last');
                if (start2.val() == "" && end2.val() == "") {
                    $(this).parents('.gl-frm-outr').find('.warn-txt').removeClass('warn-txt-hidden');
                }
            })
        }) --}}

        $(document).ready(function() {
            // Check if resumeParser has already been called | task - 86a1vjkmk - point - 3
            if (!localStorage.getItem('resumeParserCalled')) {
                setTimeout(function() {
                    var leaving = false;
                    /* task - 86a1tnfve $('.edu-input').each(function() {
                        console.log('sdafasfsaffasfsafsf=======', $(this).val());
                        if ($(this).val() !== "") {
                            leaving = true;
                        }
                    });*/
                    if ($('.text-purple').length > 0) {
                        leaving = true;
                    }

                    @if (session('messagePdf'))
                        leaving = true;
                    @endif
                    @if (session('messagePdfError'))
                        leaving = true;
                    @endif
                    @if(auth()->user()->resume_uploaded)
                        leaving = true;
                    @endif

                    var fileInput_error = "";
                    @error('fileInput')
                    fileInput_error = "{{ $message }}";
                    @enderror

                    if (!leaving) {
                        /* task - 86a1vjkmk - point - 3
                        // Call resumeParser function */
                        resumeParser(fileInput_error);

                        // Set the flag in localStorage to indicate that resumeParser has been called
                        localStorage.setItem('resumeParserCalled', true);
                        // task - 86a1vjkmk - point - 3 end
                    }
                }, 6000);
            }


            setTimeout(function() {
                    var leaving2 = false;
                    $('.edu-input').each(function() {
                        if ($(this).val() !== "") {
                        leaving2 = true;
                        }
                    });
                    if (!leaving2) {
                        resumeParser();
                    }
                }, 6000);
            // task - 86a1vjkmk - point - 3
            function resumeParser(fileInput_error = '') {
                // You can customize the confirmation message here
                var confirmationMessage =
                    '<div><b style="font-weight: 600;font-size: 14pt; color: #7e50a7;"> NEW! Effortless Profile Setup!</b><br><p style="margin-top: 22px">Upload your latest resume and we will auto generate <br>the remaining fields for you to review.</span></p><br></div>' +
                    '<form id="uploadCV" method="post" action="{{ route('candidates.uploadpdf') }}" enctype="multipart/form-data">'+
                        '@csrf'+
                        '<span class="d-flex">'+
                            '<label for="fileInput" class="custom-file-input-">'+
                                '<input type="file" id="fileInput-" name="fileInput" wire:model="fileInput" style="background:#F7F7F7;padding:8px 7px;" />'+
                            '</label>'+
                            '<button class="start-btn-purple" type="submit" wire:loading.attr="disabled">Upload Resume</button>'+
                        '</span>'+
                        '<div class="pt-2" style="color: #7e50a7;">Acceptable files are .pdf, .doc and .docx</div>' +
                        '<div class="text-danger pt-3">'+fileInput_error+'</div>'+
                    '</form>'; // task - 86a1vjkmk - point - 7

                // Show a SweetAlert2 confirmation popup
                Swal.fire({
                    html: confirmationMessage,
                    text: 'Are you sure you want to skip?',
                    icon: 'warning',
                    iconHtml: "<img src='{{ asset('assets/fe/images/warning.png') }}'>",
                    showCancelButton: false,
                    showConfirmButton: false,
                    confirmButtonColor: '#7E50A7',
                    cancelButtonColor: '#4A2D64',
                    showCloseButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        leaving = true;
                        // Uncomment the line below to allow leaving the page
                        // window.location.href = 'https://www.google.com'; // Replace with your desired URL
                    }
                });
            }

            $("body").delegate(".start-btn-purple", "click", function(e) {
                if ($('#fileInput-').val() != "") {
                    $(this).text('Uploading...');
                } else {
                    $('.file-err').remove();
                    $('#uploadCV').append(
                        '<p class="error text-danger file-err text-left">This field is required</p>');
                    e.preventDefault();
                }
            })
            $("body").delegate("#fileInput-", "change", function(e) {
                $('.file-err').remove();
            })
        });


        $("body").delegate(".custom-tool-swal", "mouseenter", function(e) {
            $('.tool-info-swal').css('opacity', 1);
        })
        $("body").delegate(".custom-tool-swal", "mouseleave", function(e) {
            $('.tool-info-swal').css('opacity', 0);
        })
    </script>
   @if (session('messagePdf'))

        <script>
            var htmlMessage =
                 '<p class="text-purple pt-5" style="color:#7e50a7;"><b style="font-weight: 600;font-size: 14pt;"> {{ session('messagePdf') }}</b></p><br><p  style="color:#7e50a7; font-size: 10pt; line-height: 1.8;font-weight: 500;" class="pb-3">Click continue to review your auto-filled profile.</p>';
            // Show a SweetAlert2 confirmation popup
            Swal.fire({
                html: htmlMessage,
                text: 'Are you sure you want to skip?',
                // icon: 'success',
                // iconHtml: "<img src='{{ asset('assets/fe/images/warning.png') }}'>",
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonText: 'Continue',
                confirmButtonColor: '#7E50A7',
                cancelButtonColor: '#4A2D64',
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {

                }
            });
        </script>
    @endif

    @if (session('messagePdfError'))
        <script>
            var htmlMessage =
                '<span style="color:red;"><b style="font-weight: 400;font-size: 14pt;"> {{ session('messagePdfError') }}</b></span>';
            // Show a SweetAlert2 confirmation popup
            Swal.fire({
                html: htmlMessage,
                // text: 'Are you sure you want to skip?',
                icon: 'success',
                iconHtml: "<img src='{{ asset('assets/fe/images/warning.png') }}'>",
                showCancelButton: false,
                showConfirmButton: false,
                confirmButtonColor: '#7E50A7',
                cancelButtonColor: '#4A2D64',
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {

                }
            });
        </script>
    @endif

    <script>
    $("body").delegate("#uploadCV", "submit", function(e) {
        swal.close();
        var progress = 0;
        var progressInterval = setInterval(function(){
            let x = Math.floor((Math.random() * 3) + 1);
            progress += x;
            if(progress > 100) progress = 100;
            // $('#uploadcvModal span#response_progress').html(progress.toFixed(2));
            $('#uploadcvModal .progress-bar').css('width', progress + '%');
            if(progress >= 95) {
                clearInterval(progressInterval);
            }
        }, 2000);

        $('#uploadcvModal span').addClass('text-purple');
        $('#uploadcvModal').modal({backdrop: 'static', keyboard: false});
        $('#uploadcvModal').modal('show');
    });
    </script>
    @if ($errors->has('fileInput'))
        <script>
            swal.close();
        </script>
    @endif
@endpush
