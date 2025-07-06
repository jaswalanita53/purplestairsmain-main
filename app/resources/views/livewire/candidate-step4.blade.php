@push('styles')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <style>
        .no-degree {
            float: inline-end;
            text-align: end;
            color: black;
            font-size: 11pt !important;
        }

        .optional-fields-edu-hidden {
            display: none;
        }

        .button-add-optional {
            cursor: pointer;
        }

        .button-add-optional:hover .add-c-p {
            color: black;

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

        .start-btn img {
            margin-left: 0px;
            filter: brightness(0) invert(1);
        }

        .start-btn {
            padding: 7px 6px 6px 8px;
            font-size: 13px;

        }

        input#fileInput {
            display: none;
        }

        .start-btn {
            padding: 7px 6px 6px 8px;
            font-size: 14px;
            width: 30%;
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
        .swal2-close{
            border:none !important;
        }
    </style>
@endpush

<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="form-points">
                @php
                    $step = 4;
                    $current_step = auth()->user()->current_step;
                @endphp
                @include('inc.steps', compact('step', 'current_step'))
            </div>
            <div class="profile-outr">
                {{-- <span>NOW IS NOT THE TIME TO BE HUMBLE</span> --}}
                <h1>You Are Halfway Done! </h1>

                <img src="{{ asset('assets/fe/images/info1.svg') }}" alt="" class="pic6" />
                <img src="{{ asset('assets/fe/images/info2.svg') }}" alt="" class="pic0" />
            </div>
        </div>
    </section>
    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
            <div class="common-form-outr">
                {{-- @error('fileInput')
                <div class="row">
                    <div class="col text-danger">{{ $message }}</div>
                </div>
                @enderror --}}

                <div class="row">
                    <div class="col">
                        <p class="no-degree mb-2">No degree? No problem. <br> Brilliance is often self-taught.</p>
                    </div>
                </div>

                <div class="form-hdr">
                    <h5 >Education <button class="start-btn-purple w-auto h-auto resume-parser-btn"
                            style="padding: 8px 15px; text-wrap: nowrap;">USE RESUME PARSER</button></h5>

                    <div>

                        {{-- task - 86a0hxg00 @include('inc.autoSaveLoader') --}}
                        <a {{-- data-fancybox
                        data-src="#open1" --}} href="{{ route('candidatestep5') }}" class="skip">Skip <em><img
                                    src="{{ asset('assets/fe/images/skip-arrw.svg') }}" alt="" /></em></a>

                        {{-- task - 86a1hvpcy --}}
                        <button type="button" class="btn save-later" wire:click="finish_later" style="">
                            <img src="{{ url('assets/be/images/save-icon.svg') }}" />
                            &nbsp;{{ $profileSaved ? 'Profile Saved' : 'Finish Later' }}
                        </button>
                    </div>
                </div>
                <form wire:submit.prevent="saveEducation()" id="saveEducation">
                    <div class="gl-form form-sec">
                        @foreach ($educations as $key => $education)
                            <div class="main-edu-sec-{{ $education->id }} main-edu-sec-common">
                                @if ($key > 0)
                                    <h6>
                                        Enter Previous Education
                                        {{-- task - 86a0d8bft --}}
                                        <button type="button" class="remove_additional_sec"
                                            wire:click="removeEdu({{ $education->id }})"><img
                                                src="{{ asset('assets/fe/images/delete.svg') }}"
                                                alt="Remove Section" /></button>
                                    </h6>
                                @endif
                                <div class="warn-txt ">
                                    <img src="{{ asset('assets/fe/images/warn.svg') }}" alt="" />
                                    <span>Add most recent first</span>
                                </div>
                                <div class="gl-frm-outr mb-2">
                                    <label>School/Organization Name <span class="text-grey">(Ex. Touro)</span></label>
                                    <div class="form-group">
                                        <input type="text" placeholder="" class="form-control edu-input"
                                            wire:model.defer="organization_name.{{ $education->id }}" checked />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox"
                                                    class="switch_1 organization_name_status_{{ $education->id }}"
                                                    data-value="{{ $education->organization_name_status }}"
                                                    checked=""
                                                    wire:model.defer="organization_name_status.{{ $education->id }}"
                                                    tabindex="-1" data-id="{{ $education->id }}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $education->organization_name_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="{{ asset('assets/fe/images/hidden.svg') }}"
                                                    alt="" />Hidden
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
                                    {{-- task 86a1hvn48 --}}
                                    <span class="d-flex">
                                        <label>Program Duration <span class="text-grey">(Dates)</span></label>
                                        {{-- <div class="form-group" style="margin-top: {{ isset($end_year_error[$education->id]) ? '' : '-15px !important' }};">
                                <label>
                                    <input type="checkbox" class="currently_studying" {{$education->currently_studying ? 'checked' : ''}} wire:model="currently_studying.{{ $education->id }}" data-value="{{$education->currently_studying}}"/>
                                    &nbsp;<span>I am currently studying here</span>
                                </label>
                            </div> --}}
                                        <label>
                                            <input type="checkbox" class="currently_studying"
                                                {{ $education->currently_studying ? 'checked' : '' }}
                                                wire:model="currently_studying.{{ $education->id }}"
                                                data-value="{{ $education->currently_studying }}" />
                                            &nbsp;<span class="text-grey">I am currently studying here</span>
                                        </label>
                                    </span>

                                    {{-- task 86a1hvn48 --}}
                                    <div class="form-group for-dropdown-option for-abs-label">
                                        <div class="input-field-dropdown">
                                            <div class="input-daterange">
                                                <div class="yr-field">
                                                    <input type="text" class="form-control input1 edu-input"
                                                        placeholder="Start Date"
                                                        wire:model.defer="start_year.{{ $education->id }}"
                                                        onchange="this.dispatchEvent(new InputEvent('input'))"
                                                        wire:key="start_year.{{ $education->id }}" wire:ignore />
                                                </div>
                                                {{-- @if ($education->currently_studying) --}}
                                                @php
                                                    $currently_std = isset($currently_studying[$education->id]) ? $currently_studying[$education->id] : $education->currently_studying;
                                                @endphp
                                                @if ($currently_std)
                                                    <div class="">
                                                        <input type="text" class="form-control"
                                                            placeholder="End Date " value="PRESENT"
                                                            wire:key="end_year_studying.{{ $education->id }}" />
                                                    </div>
                                                @else
                                                    <div class="yr-field">
                                                        <input type="text" class="form-control input2 edu-input" hhh
                                                            placeholder="End Date "
                                                            wire:model.defer="end_year.{{ $education->id }}"
                                                            onchange="this.dispatchEvent(new InputEvent('input'))"
                                                            wire:key="end_year.{{ $education->id }}" wire:ignore />
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox"
                                                    class="switch_1 start_year_status_{{ $education->id }}"
                                                    data-value="{{ $education->start_year_status }}" checked=""
                                                    wire:model.defer="start_year_status.{{ $education->id }}"
                                                    tabindex="-1" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $education->start_year_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="{{ asset('assets/fe/images/hidden.svg') }}"
                                                    alt="" />Hidden
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
                                    @if (isset($end_year_error[$education->id]))
                                        {{-- <div class="error" style="margin-top: -10px;">
                                <small class="text-danger">{{ $end_year_error[$education->id] }} </small>
                            </div> --}}
                                    @endif

                                </div>
                                @if (empty($education->program_name) && empty($education->course_description))
                                    <span class="button-add-optional mt-3 font-bold">
                                        <p class="mb-3 add-c-p"><span class="add-c-s">+</span> Add Course Program Name
                                            and Description (Optional)</p>
                                    </span>
                                @endif

                                <span
                                    class="optional-fields-edu @if (!empty($education->program_name) || !empty($education->course_description)) optional-fields-edu-show @else optional-fields-edu-hidden @endif">
                                    <div class="gl-frm-outr mb-2">
                                        <label>Course/Program Name <span class="text-grey">(Ex. Accounting,
                                                BA)</span></label>
                                        <div class="form-group">
                                            <input type="text" placeholder="" class="form-control edu-input"
                                                wire:model.defer="program_name.{{ $education->id }}" checked />
                                            <div class="toggle-switch-block">
                                                <span>show</span>
                                                <div class="switch_box box_1">
                                                    <input type="checkbox"
                                                        class="switch_1 program_name_status_{{ $education->id }}"
                                                        data-value="{{ $education->program_name_status }}"
                                                        checked=""
                                                        wire:model.defer="program_name_status.{{ $education->id }}"
                                                        tabindex="-1" />
                                                </div>
                                                <span>Hide</span>
                                            </div>
                                            <div class="hiden {{ $education->program_name_status ? '' : 'show' }}">
                                                <div class="d-span">
                                                    <img src="{{ asset('assets/fe/images/hidden.svg') }}"
                                                        alt="" />Hidden to
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
                                        <label>Course Description</label>
                                        <div class="form-group">
                                            <textarea placeholder="" class="lg-textarea edu-input" wire:model.defer="course_description.{{ $education->id }}"></textarea>
                                            <div class="toggle-switch-block">
                                                <span>show</span>
                                                <div class="switch_box box_1">
                                                    <input type="checkbox"
                                                        class="switch_1 course_description_status_{{ $education->id }}"
                                                        data-value="{{ $education->course_description_status }}"
                                                        checked=""
                                                        wire:model.defer="course_description_status.{{ $education->id }}"
                                                        tabindex="-1" />
                                                </div>
                                                <span>Hide</span>
                                            </div>
                                            <div
                                                class="hiden {{ $education->course_description_status ? '' : 'show' }}">
                                                <div class="d-span">
                                                    <img src="{{ asset('assets/fe/images/hidden.svg') }}"
                                                        alt="" />Hidden
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
                                </span>
                                <hr>
                            </div>
                        @endforeach

                        <div class="gl-frm-btn">
                            <a href="#" class="pos-btn" wire:click.prevent="add()">
                                Enter Previous Education
                                <span>+</span>
                            </a>
                        </div>
                        <div class="whole-btn-wrap dual-btn">
                            <input type="submit" value="Back" class="prev-btn" />
                            <input type="submit" value="Add Employment" class="nxt-btn" wire:loading.remove
                                wire:target="saveEducation" />
                            <input type="button" value="Saving..." class="nxt-btn" wire:loading
                                wire:target="saveEducation" />
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
        background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
        background-size: 1rem 1rem;
    }
</style>
<div class="modal fade my-auto mx-auto" id="uploadcvModal" tabindex="-1" role="dialog"
    aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center" id="alertModalBody">
                <span class="pt-3" style="color:#7e50a7;">
                    <br>
                    <b style="font-weight: 600;font-size: 14pt;"> Auto fill can take 1 to 2 minutes</b>
                </span>
                <p class="pt-3">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
                </p>
                <br>
                <p style="color:#7e50a7; font-size: 10pt; line-height: 1.8;font-weight: 500;">Please do not leave this
                    page.</p>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

    <script>

        function resumeParser(fileInput_error = '') {
                // You can customize the confirmation message here
                var confirmationMessage =
                    '<div><b style="font-weight: 600;font-size: 14pt; color: #7e50a7;"> NEW! Effortless Profile Setup!</b><br><p style="margin-top: 22px">Upload your latest resume and we will auto generate <br>the remaining fields for you to review.</span></p><br></div>' +
                    '<form id="uploadCV" method="post" action="{{ route('candidates.uploadpdf') }}" enctype="multipart/form-data">' +
                    '@csrf' +
                    '<span class="d-flex flex-wrap flex-sm-nowrap">' +
                    '<label for="fileInput" class="custom-file-input-">' +
                    '<input type="file" id="fileInput-" name="fileInput" wire:model="fileInput" style="background:#F7F7F7;padding:8px 7px; margin-bottom:5px;width:100% " />' +
                    '</label>' +
                    '<button class="start-btn-purple" type="submit" wire:loading.attr="disabled" style=" margin-bottom:5px">Upload Resume</button>' +
                    '</span>' +
                    '<div class="pt-2" style="color: #7e50a7;">Acceptable files are .pdf, .doc and .docx</div>' +
                    '<div class="text-danger pt-3">' + fileInput_error + '</div>' +
                    '</form>';
                    // task - 86a1vjkmk - point - 7

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

                // CHANGE FOR => When uploading a resume if they don't have any education after its done uploading the uploader will pop up again even though the next page is already filled out
                $('[name=fileInput]').on('change', function(event) {
                    /* Act on the event */
                    var file = $(this)[0].files[0];
                    var fname = file.name;
                    var splitnm = fname.split('.');

                    $(this).parents('#uploadCV').find('span.text-danger').remove();
                    if($.inArray(splitnm[1], ['pdf','doc','docx','zip']) === -1) {
                        $(this).parents('#uploadCV').append('<span class="text-danger">Error: parser only accepts .doc, .docx and .pdf</span>');
                        $(this).val('');
                    }
                });
            }

        // task - 86a1hvpcy
        $('input, textarea').on('change', function(event) {
            $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp; Finish Later');
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
        $(document).ready(function() {
            $('.warn-txt').addClass('blink');
        })

        window.addEventListener('load-switches', event => {
            initCheckbox();
            document.querySelectorAll('.switch_1').forEach(function(el, i) {
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

        $(document).on('change', '.switch_1', function() {
            console.log($(this).prop('checked'));
            if ($(this).prop('checked')) {
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
                var currecnt = $(this).parents('.gl-frm-outr').find('.input-daterange').find('input:last');

                if (typeof attr !== 'undefined' && attr !== false) {
                    $(el).prop('checked', true);
                    currecnt.attr('readonly', true);
                } else {
                    currecnt.attr('readonly', false);
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
                    if (val) {
                        $('.course_description_status_' + index).parents(".toggle-switch-block").next()
                            .removeClass("show");
                    } else {
                        $('.course_description_status_' + index).parents(".toggle-switch-block").next()
                            .addClass("show");
                    }
                });
                $.each(organization_name_status, function(index, val) {
                    if (val) {
                        $('.organization_name_status_' + index).parents(".toggle-switch-block").next()
                            .removeClass("show");
                    } else {
                        $('.organization_name_status_' + index).parents(".toggle-switch-block").next()
                            .addClass("show");
                    }
                });
                $.each(program_name_status, function(index, val) {
                    if (val) {
                        $('.program_name_status_' + index).parents(".toggle-switch-block").next()
                            .removeClass("show");
                    } else {
                        $('.program_name_status_' + index).parents(".toggle-switch-block").next().addClass(
                            "show");
                    }
                });
                $.each(start_year_status, function(index, val) {
                    if (val) {
                        $('.start_year_status_' + index).parents(".toggle-switch-block").next().removeClass(
                            "show");
                    } else {
                        $('.start_year_status_' + index).parents(".toggle-switch-block").next().addClass(
                            "show");
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
                // window.location.href='{{ url('/candidate/education-employment') }}';
                window.location.href = '{{ url('/candidate/position-preferences') }}'; // Task #86a0h5rvz
            })

            $("body").delegate(".nxt-btn", "click", function(e) {
                // e.preventDefault(); task - 86a0hxg00
                var count = 0;
                count = $('.text-danger').length;
                $('.input-daterange').each(function() {
                    var start = $(this).find('input:first');
                    var end = $(this).find('input:last');

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
                })




                if (count > 0) {
                    $('html, body').animate({
                        scrollTop: $(".text-danger:first").offset().top - 200
                    }, 500);
                    return false;
                }

                return true;
                // window.location.href='{{ url('/candidate/employment') }}'; task - 86a0hxg00

            })
        }

        $("body").delegate(".input2,.input1", "click", function(e) {
            $(this).parents('.gl-frm-outr').find('.error').remove();
        })
        $("body").delegate(".button-add-optional", "click", function(e) {
            $(this).parents('.main-edu-sec-common').find('.optional-fields-edu').show();
            $(this).hide();
        })


        $(document).ready(function() {
            // Check if resumeParser has already been called
            if (!localStorage.getItem('resumeParserCalled')) {
                setTimeout(function() {
                    var leaving = false;

                    if ($('.text-purple').length > 0) {
                        leaving = true;
                    }

                    @if (session('messagePdf'))
                        leaving = true;
                    @endif
                    @if (session('messagePdfError'))
                        leaving = true;
                    @endif
                    @if (auth()->user()->resume_uploaded)
                        leaving = true;
                    @endif

                    var fileInput_error = "";
                    @error('fileInput')
                        fileInput_error = "{{ $message }}";
                    @enderror

                    if (!leaving) {
                        // Call resumeParser function
                        resumeParser(fileInput_error);

                        // Set the flag in localStorage to indicate that resumeParser has been called
                        localStorage.setItem('resumeParserCalled', true);
                    }
                }, 500);
            }
            // task - 86a1tnfve 6000


               setTimeout(function() {
                var leaving2 = false;
                $('.edu-input').each(function() {
                    if ($(this).val() !== "") {
                    leaving2 = true;
                    }
                });
                @if (session('messagePdf'))
                    leaving2 = true;
                @endif
                @if (session('messagePdfError'))
                    leaving2 = true;
                @endif

                // CHANGE FOR => When uploading a resume if they don't have any education after its done uploading the uploader will pop up again even though the next page is already filled out
                var is_resumeParserCalled = false;
                if(localStorage.getItem('resumeParserCalled')) {
                    is_resumeParserCalled = localStorage.getItem('resumeParserCalled');
                }

                if (!leaving2 && !is_resumeParserCalled) {
                    resumeParser();
                }
            }, 500);


            $("body").delegate(".resume-parser-btn", "click", function(e) {
                $('#uploadcvModal .progress-bar').css('width', '0%')
                resumeParser();
            })
            $("body").delegate("form .start-btn-purple", "click", function(e) {
                if ($('#fileInput-').val() != "") {
                    $(this).text('Uploading...');
                } else {
                    $('#uploadCV span.text-danger').remove();
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

        $("body").delegate(".upload_profile_path", "click", function(e) {
            let file = $("#fileInput").val();
            if (file) {

            } else {
                alert("please upload the file");
                // $('.bgx-text-danger').remove();
            }
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
                showConfirmButton: true, // task - 86a1tnfve
                confirmButtonText: 'Continue', // task - 86a1tnfve
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

        });



   $("body").delegate("#uploadCV", "submit", function(e) {
        e.preventDefault();
swal.close();
            var progress = 0;
            var progressInterval = setInterval(function() {
                let x = Math.floor((Math.random() * 3) + 1);
                progress += x;
                if (progress > 100) progress = 100;
                // $('#uploadcvModal span#response_progress').html(progress.toFixed(2));
                $('#uploadcvModal .progress-bar').css('width', progress + '%');
                if (progress >= 95) {
                    clearInterval(progressInterval);
                }
            }, 2000);

            $('#uploadcvModal span').addClass('text-purple');
            $('#uploadcvModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#uploadcvModal').modal('show');
        // Get the form data
        var formData = new FormData(this);

        // Create XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Set up the request
        xhr.open('POST', '{{ url("candidate/upload-cv") }}', true);

        // Set up headers
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

        // Track the upload progress if needed
        xhr.upload.onprogress = function (event) {
            if (event.lengthComputable) {
                var percentCompleted = Math.round((event.loaded * 100) / event.total);
                console.log(percentCompleted);
            }
        };

        // Define what happens on successful data submission
        xhr.onload = function () {
Swal.close();
$('.modal').modal('hide');
clearInterval(progressInterval);
            if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            if (response.messagePdfError !== "" && response.messagePdfError !=undefined) {

                var htmlMessage =
                '<span style="color:red;"><b style="font-weight: 400;font-size: 14pt;"> '+response.messagePdfError+'</b></span>';
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
            }
           if (response.messagePdf !== "" && response.messagePdf !=undefined) {

            var htmlMessage =
                '<p class="text-purple pt-5" style="color:#7e50a7;"><b style="font-weight: 600;font-size: 14pt;"> '+response.messagePdf+'</b></p><br><p  style="color:#7e50a7; font-size: 10pt; line-height: 1.8;font-weight: 500;" class="pb-3">Click continue to review your auto-filled profile.</p>';
            // Show a SweetAlert2 confirmation popup
            Swal.fire({
                html: htmlMessage,
                text: 'Are you sure you want to skip?',
                // icon: 'success',
                // iconHtml: "<img src='{{ asset('assets/fe/images/warning.png') }}'>",
                showCancelButton: false,
                showConfirmButton: true, // task - 86a1tnfve
                confirmButtonText: 'Continue', // task - 86a1tnfve
                confirmButtonColor: '#7E50A7',
                cancelButtonColor: '#4A2D64',
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });

            }
                }
        else {
                // Handle error response
                console.error(xhr.statusText);
            }
        };

        // Handle network errors
        xhr.onerror = function () {
            console.error('Network error occurred.');
        };

        // Send the request
        xhr.send(formData);
    });


    </script>
    @if ($errors->has('fileInput'))
        <script>
            swal.close();
        </script>
    @endif
@endpush
