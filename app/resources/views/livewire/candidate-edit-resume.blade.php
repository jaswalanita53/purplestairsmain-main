@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
{{-- task 86a1k82ux --}}
<style>
.select2-container .select2-search--inline .select2-search__field {
   margin-top: 0px;
    height: 16px;
}
span.select2-selection.select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--multiple {
   background-position: right 10px center;
       padding: 5px 30px;
}

.select2-selection__choice__display {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.intl-tel-input.allow-dropdown {
    width: 100%;
}
</style>
{{-- task 86a1k82ux --}}
@endpush
<div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/css/intlTelInput.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/intlTelInput.min.js"></script>
        <section class="back-clr resume-sec cmn-gap pb-0 ban-up ban-up3 main-form-sec">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb edit-personal justify-content-center justify-content-md-start">
                    <li class=" mb-2 mb-md-0"><a href="{{ route('candidates.editpersonal') }}">Edit Personal Information</a></li>
                    <li class=" mb-2 mb-md-0"><a href="{{route("candidates.editpreferences")}}">Edit Position Preferences</a></li>
                    <li class="active mb-2 mb-md-0" aria-current="page">Edit Resume Information</li>

                </ol>
            </nav>
            <div class="sec-hdr mb-4 mb-md-5 d-flex align-items-center justify-content-between">
                <h2 class="mb-0">
                    Edit Resume information
                </h2>
                    <div class="profile-btn ms-btn text-nowrap">
                        @if(Auth::user()->current_step==9)
                        <a href="{{route("candidatestep9")}}"> Preview Profile</a>
                        @else
                            {{-- task - 86a0jby08 --}}
                            @php
                                $error1 = array_filter($end_year_error);
                                $error2 = array_filter($employment_end_year_error);
                            @endphp

                            @if(!empty($error1) || !empty($error2))
                                <a href="javascript:;" onclick="validatePage()" class="px-3 px-md-5"> View Profile</a>
                            @else
                                <a href="{{route("candidateProfile")}}" class="px-3 px-md-5"> View Profile</a>
                            @endif
                            {{-- task - 86a0jby08 end --}}
                        @endif
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

            <form wire:submit.prevent="updateResume()" id="updateCandidateResume">
                <div class="cmn-form">
                    <div class="cmn-head">
                        <h5>Most Recent Education</h5>
                        {{-- task - 86a0hxg00 @include('inc.autoSaveLoader') --}}
                    </div>
                    <div class="form-sec gl-form ">
                        @foreach ($educations as $key => $education)
                        <div class="row main-edu-sec">
                            {{-- task - 86a0d8bft --}}
                            @if($key > 0)
                            <div class="col-lg-12">
                                <button type="button" class="remove_additional_sec" wire:click="removeEdu({{$education->id}})"><img src="{{ asset('assets/fe/images/delete.svg') }}" alt="Remove Section" /></button>
                            </div>
                            @endif

                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Course Name</label>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" @if(!empty($program_name[$education->id])) value--="{{$program_name[$education->id]}}" @endif  class="form-control" wire:model.defer="program_name.{{ $education->id }}" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">

                                                <input type="checkbox" class="switch_1" data-value="@if(!empty($program_name_status[$education->id])){{$program_name_status[$education->id]}} @endif" checked="" wire:model.defer="program_name_status.{{ $education->id }}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $education->program_name_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>School/Organization Name</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.defer="organization_name.{{ $education->id }}" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" @if(!empty($organization_name_status[$education->id])) data-value="{{$organization_name_status[$education->id]}}" @endif wire:model.defer="organization_name_status.{{ $education->id }}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $education->organization_name_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Short Description</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.defer="course_description.{{ $education->id }}" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" @if(!empty($course_description_status[$education->id]))data-value="{{$course_description_status[$education->id]}}" @endif wire:model.defer="course_description_status.{{ $education->id }}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $education->course_description_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>

                            <div class="col-lg-6">

                                <div class="gl-frm-outr mb-0">
                                    {{-- task 86a1hvn48 --}}
                                    <label>Program Duration (Dates):</label>
                                    {{-- task 86a1hvn48 --}}
                                    <div class="form-group for-dropdown-option for-abs-label">
                                        <div class="input-field-dropdown">
                                            <div class=" input-daterange">
                                                <div class="yr-field">
                                                    <input type="text" class="form-control input1" placeholder="Start Date" wire:model.defer="start_year.{{ $education->id }}" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="start_year.{{ $education->id }}" wire:ignore />
                                                </div>
                                                @if(!empty($currently_studying[$education->id]))
                                                <div class="">
                                                    <input type="text" class="form-control"  placeholder="End Date " value="PRESENT" wire:key="end_year_current.{{ $education->id }}" />
                                                </div>
                                                @else
                                                <div class="yr-field">
                                                    <input type="text" class="form-control input2" placeholder="End Date " wire:model.defer="end_year.{{ $education->id }}" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="end_year.{{ $education->id }}" wire:ignore />
                                                </div>
                                                @endif

                                            </div>

                                        </div>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" @if(!empty($start_year_status[$education->id])) data-value="{{$start_year_status[$education->id]}}" @endif wire:model.defer="start_year_status.{{ $education->id }}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $education->start_year_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

                                                <div class="in-ap">
                                                    <p>
                                                        This information will only be unmasked to a Requesting
                                                        company <strong>upon your approval.</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($end_year_error[$education->id]))
                                      <div class="error" style="margin-top: -10px;">
                                          <small class="text-danger">{{ $end_year_error[$education->id] }} </small>
                                      </div>
                                    @endif
                                    <div class="form-group" style="margin-top: {{ isset($end_year_error[$education->id]) ? '' : '-15px !important' }};">
                                        <label for="">I am currently studying here</label>
                                        <input type="checkbox" class="present currently_studying" @if(!empty($currently_studying[$education->id])) data-value="{{$currently_studying[$education->id]}}" @endif checked="" wire:model="currently_studying.{{ $education->id }}" data-eduid="{{$education->id}}"/>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <hr/>
                        @endforeach
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="gl-frm-btn">
                                    <a href="#" class="pos-btn" wire:click.prevent="add()">
                                        Add Previous Position
                                        <span>+</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="form-submit-btn mb-0">
                            @if(!empty($error1) || !empty($error2))
                            <input type="button" value="Save" class="submit-btn" onclick="validatePage()"/>
                            @else
                            <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="updateResume"/>
                            @endif
                            <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume"/>
                        </div>
                    </div>
                </div>

                <div class="cmn-form">
                    <div class="cmn-head">
                        <h5>Most Recent Position</h5>
                    </div>
                    <div class="form-sec gl-form">
                        @foreach($employments as $key => $employment)

                        <div class="row">
                            {{-- task - 86a0d8bft --}}
                            @if($key > 0)
                            <div class="col-lg-12">
                                <button type="button" class="remove_additional_sec" wire:click="removeEmp({{$employment->id}})"><img src="{{ asset('assets/fe/images/delete.svg') }}" alt="Remove Section" /></button>
                            </div>
                            @endif

                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Company Name</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.defer="company_name.{{$employment->id}}" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" @if(!empty($company_name_status[$employment->id])) data-value="{{$company_name_status[$employment->id]}}" @endif wire:model.defer="company_name_status.{{$employment->id}}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $employment->company_name_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Position/Title</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.defer="position.{{$employment->id}}" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" @if(!empty($position_status[$employment->id])) data-value="{{$position_status[$employment->id]}}" @endif wire:model.defer="position_status.{{$employment->id}}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $employment->position_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>

                            <div class="col-lg-6">

                                <div class="gl-frm-outr mb-0">
                                    {{-- task 86a1hvn48 --}}
                                    <label>Employment Duration (Dates):</label>
                                    {{-- task 86a1hvn48 --}}
                                    <div class="form-group for-dropdown-option for-abs-label">
                                        <div class="input-field-dropdown">
                                            <div class=" input-daterange">
                                                <div class="yr-field" wire:ignore:self>
                                                    <input type="text" class="form-control input1" placeholder="Start Date" wire:model.defer="employment_start_year.{{$employment->id}}" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="employment_start_year.{{ $employment->id }}" />
                                                </div>


                                                @if(!empty($currently_working[$employment->id]))
                                                <div class="">
                                                    <input type="text" class="form-control" placeholder="End Date " value="PRESENT" wire:key="employment_end_year_current.{{ $employment->id }}" />
                                                </div>
                                                @else
                                                <div class="yr-field" wire:ignore:self> <input type="text" class="form-control input2" placeholder="End Date " wire:model.defer="employment_end_year.{{$employment->id}}" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="employment_end_year.{{ $employment->id }}" /> </div>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" @if(!empty($employment_start_year_status[$employment->id])) data-value="{{$employment_start_year_status[$employment->id]}}" @endif wire:model.defer="employment_start_year_status.{{$employment->id}}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $employment->employment_start_year_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

                                                <div class="in-ap">
                                                    <p>
                                                        This information will only be unmasked to a Requesting
                                                        company <strong>upon your approval.</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($employment_end_year_error[$employment->id]))
                                      <div class="error" style="margin-top: -10px;">
                                          <small class="text-danger">{{ $employment_end_year_error[$employment->id] }} </small>
                                      </div>
                                    @endif
                                    <div class="form-group" style="margin-top: {{ isset($employment_end_year_error[$employment->id]) ? '' : '-15px !important' }};">
                                        <label for="">I am currently working here</label>
                                        <input type="checkbox" class="currently_working" data-empid="{{ $employment->id }}" checked="" wire:model="currently_working.{{ $employment->id }}" />
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Position Responsibilities</label>
                                    <div class="form-group mb-0">
                                        <textarea placeholder="" class="lg-textarea" wire:model.defer="responsibilities.{{$employment->id}}"></textarea>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" @if(!empty($responsibilities_status[$employment->id])) data-value="{{$responsibilities_status[$employment->id]}}" @endif wire:model.defer="responsibilities_status.{{$employment->id}}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $employment->responsibilities_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Position Accomplishments</label>
                                    <div class="form-group cus-frm-gp mb-0">
                                        <textarea placeholder="" class="lg-textarea" wire:model.defer="accomplishments.{{$employment->id}}"></textarea>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" @if(!empty($accomplishments_status[$employment->id])) data-value="{{$accomplishments_status[$employment->id]}}" @endif checked="" wire:model.defer="accomplishments_status.{{$employment->id}}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $employment->accomplishments_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

                                                <div class="in-ap">
                                                    <p>
                                                        This information will only be unmasked to a Requesting
                                                        company <strong>upon your approval.</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="custom-tool">
                                            <span>?</span>

                                            <div class="tool-info">
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry.
                                                </p>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr/>
                        @endforeach
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="gl-frm-btn">
                                    <a href="#" class="pos-btn" wire:click.prevent="addEmployment()">
                                        Add Previous Position
                                        <span>+</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-submit-btn m-0 mt-1">
                            @if(!empty($error1) || !empty($error2))
                            <input type="button" value="Save" class="submit-btn" onclick="validatePage()"/>
                            @else
                            <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="updateResume"/>
                            @endif
                            <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume"/>
                        </div>
                    </div>
                </div>
                <div class="cmn-form">
                    <div class="form-sec gl-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="skil-hdr  custom-skill-wrap">
                                    <h5>hard skills*</h5>
                                    <span class="custom-tool">
                        <span>?</span>

                        <div class="tool-info">
                            <p>
                                <strong>Hard skills </strong>are technical skills
                                aquired through education or experience.
                            </p>
                        </div>
                    </span>
                                </div>
                                <div class="form-group">
                                    <select class="js-example-tags hard_skills" multiple="multiple" wire:model.defer="selectedHardSkills" id="selectedHardSkills">
                                        @foreach ($all_hard_skills as $key => $skill)
                                        <option value="{{ $skill }}" @if(in_array($skill,$selectedHardSkills))  selected @endif >{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    @include('inc.error', [
                                        'field_name' => 'selectedHardSkills',
                                        ])
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="skil-hdr custom-skill-wrap">
                                    <h5>Soft skills*</h5>
                                    <span class="custom-tool">
                                        <span>?</span>

                                        <div class="tool-info">
                                            <p>
                                            <strong>Soft skills  </strong>are personal qualities and people skills.
                                            </p>
                                        </div>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <select class="js-example-tags soft_skills" multiple="multiple" wire:model.defer="selectedSoftSkills" id="selectedSoftSkills">
                                        @foreach ($all_soft_skills as $key => $skill)
                                        <option value="{{ $skill }}" @if(in_array($skill,$selectedSoftSkills))  selected @endif >{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    @include('inc.error', [
                                        'field_name' => 'selectedSoftSkills',
                                        ])
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="skil-hdr ">
                                    <h5>Languages</h5>
                                </div>
                                <div class="form-group">
                                    <select class="js-example-tags languages" multiple="multiple" wire:model.defer="selectedLanguages" id="selectedLanguages">
                                        @foreach ($all_languages as $key => $language)
                                        <option value="{{ $language }}" @if(in_array($language,$selectedLanguages))  selected @endif>{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    @include('inc.error', [
                                        'field_name' => 'selectedLanguages',
                                        ])
                                </div>
                            </div>


                        </div>
                        <div class="form-submit-btn m-0 mt-1">
                            @if(!empty($error1) || !empty($error2))
                            <input type="button" value="Save" class="submit-btn" onclick="validatePage()"/>
                            @else
                            <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="updateResume"/>
                            @endif
                            <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume"/>
                        </div>
                    </div>

                </div>
                <div class="cmn-form">
                    <div class="cmn-head">
                        <h5>@if(count($references)>1) References @else Reference @endif</h5>
                    </div>
                    <div class="form-sec gl-form">
                        @foreach($references as $key => $reference)
                        <div class="row align-items-baseline">
                        @if($key > 0)
                            <div class="col-lg-12">
                                <button type="button" class="remove_additional_sec" wire:click="removeRef({{$reference->id}})"><img src="{{ asset('assets/fe/images/delete.svg') }}" alt="Remove Section" /></button>
                            </div>
                            @endif
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-3">
                                    <label>Name</label>
                                    <div class="form-group disable-form- mb-0">
                                        <input type="text" placeholder="" class="form-control name-input" wire:model.defer="name.{{ $reference->id }}" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" data-value="{{$name_status[$reference->id]}}" wire:model.defer="name_status.{{ $reference->id }}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $reference->name_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

                                                <div class="in-ap">
                                                    <p>
                                                        This information will only be unmasked to a Requesting
                                                        company <strong>upon your approval.</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!empty($reference_name_error[$reference->id]))
                                            <span class="text-danger error">{{ $reference_name_error[$reference->id] }}</span>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-3">
                                    <label>Relationship</label>
                                    <div class="form-group disable-form- mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.defer="relationship.{{ $reference->id }}" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1 relationship-input" data-value="{{$relationship_status[$reference->id]}}" wire:model.defer="relationship_status.{{ $reference->id }}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $reference->relationship_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-3">
                                    <label>Email</label>
                                    <div class="form-group disable-form- mb-0">
                                        <input type="email" placeholder="" class="form-control email-input" wire:model.defer="email.{{ $reference->id }}" />
                                        @include('inc.error', [
                                        'field_name' => 'email.'.$reference->id,
                                        ])
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" data-value="{{$email_status[$reference->id]}}" wire:model.defer="email_status.{{ $reference->id }}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $reference->email_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-3">
                                    <label>Phone</label>
                                    <div class="form-group disable-form- mb-0">
                                        <div class="form-group disable-form-- mb-0">
                                    {{-- 86a2ym4hk --}}
                                        <span>
                                            <input type="tel" placeholder="" maxlength="16" class="form-control telle-edit phone-input " wire:model.defer="phone.{{ $reference->id }}" data-val="{{ $phone[$reference->id] }}" id="telle.{{ $phone[$reference->id] }}" >
                                        </span>
                                    @include('inc.error', [
                                        'field_name' => 'phone.'.$reference->id,
                                        ])
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" data-value="{{$phone_status[$reference->id]}}" wire:model.defer="phone_status.{{ $reference->id }}" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $reference->phone_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>

                        </div>
                        <hr/>
                        @endforeach
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="gl-frm-btn">
                                    <a href="#" class="pos-btn" wire:click.prevent="addReference()">
                                        Add Reference
                                        <span>+</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- task - 86a0fxn2y --}}
                        <div class="form-submit-btn m-0 mt-1">
                            @if(!empty($error1) || !empty($error2))
                            <input type="button" value="Save" class="submit-btn" onclick="validatePage()"/>
                            @else
                            <input type="submit" value="Save" class="submit-btn formNextBtn" wire:loading.remove wire:target="updateResume"/>
                            @endif
                            <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume"/>
                        </div>
                    </div>

                </div>

                <!-- <div class="cmn-form">
                    <div class="cmn-head">
                        <h5>More About Me</h5>
                    </div>
                    <div class="form-sec gl-form">
                        <div class="row align-items-baseline">

                            <div class="col-lg-2 col-md-3">
                                <div class="form-group f-up new_uploaded_frm">
                                    <div class="upload-wrp">
                                        @if (Auth::user()->profile_photo_path)
                                        <a href="javascript:void(0)">
                                            @if(!$profile_status)
                                                <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" style="border-radius:50%; width-:114px !important; height-:114px !important;" width="70%"/>
                                            @else
                                                <img src="{{asset(Auth::user()->profile_photo_path)}}" alt="" style="border-radius:50%; width-:114px !important; height-:114px !important;" />
                                            @endif

                                        </a>
                                        <span class="remove-avatar" wire:click.stop="removeAvatar()"><img src="{{asset('assets/fe/images/del2.svg')}}" class="del-pic" alt="" /></span>
                                        @else
                                        <a href="javascript:void(0)"><img src="{{asset('assets/fe/images/up-photo.png')}}" alt="" /></a>
                                        <img src="{{asset('assets/fe/images/up-plus.png')}}" alt="" class="up-plus" />
                                        @endif
                                    </div>

                                    <a href="javascript:void(0)" class="upload_btn nw_upldd">
                                        @if (Auth::user()->profile_photo_path)
                                        <input type="file" wire:model.defer="profile" class="change-photo"> Replace Photo
                                        @else
                                        <input type="file" wire:model.defer="profile" class="change-photo"> Upload Photo (Please upload JPG/PNG format. Maximum size must be 1MB)
                                        @endif
                                    </a>

                                    <div class="toggle-switch-block" style="right: 0;top: 0; position: relative; background: none;">
                                      <span>show</span>
                                      <div class="switch_box box_1">
                                        <input type="checkbox" class="switch_1" data-value="{{$profile_status}}" {{ $profile_status ? 'checked' : '' }}  wire:model.defer.lazy="profile_status"/>
                                      </div>
                                      <span>Hide</span>
                                    </div>
                                    <div class="hiden {{ $profile_status ? '' : 'show' }}">
                                      <div class="d-span">
                                        <img src="{{asset('assets/fe/images/hidden.svg')}}" alt="" />Hidden to everyone

                                        <div class="in-ap">
                                          <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                          </p>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                @include('inc.error', [
                                'field_name' => 'profile',
                                ])
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="gl-frm-outr mb-0">
                                    <label>Short Bio</label>
                                    {{-- disable-form --}}
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model.defer="short_bio" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model.defer="short_bio_status" {{ $short_bio_status ? 'checked' : '' }} data-value="{{ $short_bio_status }}"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden {{ $short_bio_status ? '' : 'show' }}">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                        </div>
                        <div class="form-submit-btn mb-0 mob-sve">
                            <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="updateResume" />
                            <input type="submit" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume" />
                        </div>
                    </div>
                </div> -->
            </form>
        </div>
        @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

        <script>
        $("body").delegate(".input2,.input1", "click", function(e) {
            $(this).parents('.gl-frm-outr').find('.error').remove();
        })
            // task - 86a0jby08
            function validatePage() {
                // $('.relationship-input,.email-input,.email-input,.phone-input')
                // $('.align-items-baseline').each(function(){
                //     var relationship_input= $(this).find('.relationship-input').val();
                //     var email_input= $(this).find('.email-input').val();
                //     var phone_input= $(this).find('.phone-input').val();
                //     var name_input= $(this).find('.name_input').val();
                //     if((relationship_input!='' || email_input!='' || phone_input!='') && name_input==''){
                //            $(this).find('. name-input').parents('.form-group').append('<div class="text-danger" style=""> This field is required.</div>');
                //     }
                // })
                $('html, body').animate({
                    scrollTop: $("div.error:first").offset().top - 200
                  }, 500);
                  return false;
            }

            // task - 86a0pwt5m
             //showing undefined error
             let openLang;
            let openSoft;
            let openHard;
            document.addEventListener("livewire:load", () => {
                Livewire.hook('message.processed', (message, component) => {
                    console.log('hook loads...');
                    $('select').select2({
                        closeOnSelect: false,
                        tags: false
                    });

                    let lang = @this.get('selectedLanguages');
                    let hard = @this.get('selectedHardSkills');
                    let soft = @this.get('selectedSoftSkills');

                    console.log(openLang, lang);
                    console.log(openSoft, soft);
                    console.log(openHard, hard);
                    if(openLang && lang.length == 0) {
                        $('#selectedLanguages').select2('open');
                        $('#selectedHardSkills, #selectedSoftSkills').select2('close');
                    } else if(openSoft && soft.length == 0) {
                        $('#selectedSoftSkills').select2('open');
                        $('#selectedInterests, #selectedLanguages').select2('close');
                    } else if(openHard && hard.length == 0) {
                        $('#selectedHardSkills').select2('open');
                        $('#selectedInterests, #selectedSoftSkills').select2('close');
                    } else {
                        $('#selectedHardSkills,#selectedInterests,#selectedIndustries').select2('close');
                    }

                    setTimeout(() => {
                        if($("div.error:first").length) {
                            validatePage();
                        }
                    }, 250);
                });
            })

            window.addEventListener('keep-open-language', event => {
                openLang = true; openSoft = false; openHard = false;
            });
            window.addEventListener('keep-open-soft', event => {
                openLang = false; openSoft = true; openHard = false;
            });
            window.addEventListener('keep-open-hard', event => {
                openLang = false; openSoft = false; openHard = true;
            });
            window.addEventListener('close-multiselect', event => {
                openLang = false; openSoft = false; openHard = false;
            });

            @if(request()->get('navigate') == 'error')
                validatePage();
                var cur_url = window.location.href.split('?');
                window.history.pushState(null, "", cur_url[0]);
            @endif
            // task - 86a0jby08 end

            $(document).on('change', '.currently_studying', function (e) {
                let edu_id = $(this).attr('data-eduid');
                if(!$(this).prop('checked')) {
                    @this.set('end_year.' + edu_id, null);
                }
                console.log($(this).prop('checked'),edu_id );
            });

            $(document).on('change', '.currently_working', function (e) {
                let emp_id = $(this).attr('data-empid');
                if(!$(this).prop('checked')) {
                    @this.set('employment_end_year.' + emp_id, null);
                }
                console.log($(this).prop('checked'),emp_id );
            });

            // task - 86a0fxn2y
            /* task - 86a0hxg00 $('.submit-btn').click(function(event) {
                $('html, body').animate({
                    scrollTop: $("div.cmn-head:first").offset().top - 200
                }, 500);
            });*/
            // task - 86a0fxn2y end

            //initiate languages select2
            document.addEventListener("livewire:load", () => {
                initDates();
                changePage();

                Livewire.on('newEducationAdded', function() {
                    initDates();
                    changePage();
                });

                Livewire.on('newEmploymentAdded', function() {
                    initDates();
                    changePage();
                });

                triggerSwitch();
            })

            function triggerSwitch() {
                $('.switch_1').each(function(index, el) {
                    if ($(el).attr('data-value') == 1) {
                        $(el).parents(".toggle-switch-block").next().removeClass("show");
                        $(el).prop('checked', true);
                    } else {
                        $(el).parents(".toggle-switch-block").next().addClass("show");
                        $(el).prop('checked', false);
                    }
                });
            }

            window.addEventListener('load-switches', event => {
                document.querySelectorAll('.switch_1').forEach(function(el,i){
                    // console.log($(el).attr('data-value'));
                    if ($(el).attr('data-value') == 1) {
                        $(el).parents(".toggle-switch-block").next().removeClass("show");
                        $(el).prop('checked', true);
                    } else {
                        $(el).parents(".toggle-switch-block").next().addClass("show");
                        $(el).prop('checked', false);
                    }
                });

                // document.querySelectorAll('.present').forEach(function(el,i){
                //     console.log($(el).attr('data-value'));
                //     if ($(el).attr('data-value') == 1) {
                //         $(el).parents(".toggle-switch-block").next().removeClass("show");
                //         $(el).attr('checked', true);
                //     } else {
                //         $(el).parents(".toggle-switch-block").next().addClass("show");
                //         $(el).attr('checked', false);
                //     }
                // });
            });

            document.addEventListener("livewire:load", () => {
                $("body").delegate(".change-photo", "change", function(e) {
                    $("body").delegate(".present", "click", function(e) {
                        if( $(this).prop("checked")){
                            $(this).parents('.gl-frm-outr').find('.input-daterange').find('input:last').val('PRESENT');
                        }
                    });
                });
            });

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

            function changePage() {
                $(".prev-btn").click(function(e) {
                    e.preventDefault();
                    location.replace('/candidate/education-employment')
                })
                $(".nxt-btn").click(function(e) {
                    e.preventDefault();
                    location.replace('/candidate/employment')
                })
            }
        </script>
        <script>
            // task - 862k3f2fe
            /*var hardSelect2, softSelect2, languageSelect2;
            var openHard = false;
            var openSoft = false;
            var openLang = false;

            var parent_id, child_id;
            let selected1 = [];
            let selected2 = [];
            let selected3 = [];

            //initiate languages select2
            document.addEventListener("livewire:load", () => {
                // initSelect2Languages();
                let el = $('.languages');
                initSelect();

                let el1 = $('.soft_skills');
                initSelectSoft();

                let el2 = $('.hard_skills');
                initSelectHard();

                $(document).on('click', '.select2-results__option', function(event) {
                    parent_id = $(this).parent().attr('id');
                    child_id = $(this).text();
                });
            // })

                // function initSelect2Languages() {
                    initSelect();
                    $('.languages').on('change', function(e) {
                        var data = $('.languages').select2("val");
                        var _old = @this.get('selectedLanguages');

                        var tmp_data = data.map(Number);
                        _old = _old.map(Number);
                        let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
                        let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

                        const values = tmp_data;
                        selected1 = selected1.filter((value) => values.includes(value));
                        const lastSelected = values.filter((value) => !selected1.includes(value));
                        selected1.push(lastSelected[0]);

                        let child_ = $('.languages option[value='+lastSelected[0]+']').text();
                        parent_id = $(".select2-results__option:contains('"+child_+"')").parent().attr('id');
                        child_id = child_;

                        if(diff1.length > 0 || diff2.length > 0) { @this.set('selectedLanguages', data); }
                    });
                    Livewire.hook('message.processed', (message, component) => {
                        console.log(openLang);

                        if(openLang) { initSelect(1); } else {
                            initSelect();
                            initSelectSoft();
                            initSelectHard();
                        }
                    });

                    window.addEventListener('keep-open-language', event => {
                        var selected_items = @this.get('selectedLanguages');
                        if(selected_items.length) {
                            openLang = true;
                        } else {
                            openLang = false;
                        }
                        openSoft = false;
                        openHard = false;
                        // initSelect(1);
                    });

                    function initSelect(open = 0) {
                        languageSelect2 = el.select2({
                            closeOnSelect: false,
                            tags: false
                        });

                        // task - 86a114e9r
                        el.on('select2:select', function (e) {
                            $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
                        });

                        console.log(open);
                        if(open) {
                            el.select2("open");
                            console.log('here ...');
                            if(document.getElementById(parent_id)) {
                                document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('"+child_id+"')").outerHeight() * $(".select2-results__option:contains('"+child_id+"')").index() - 100;
                            }
                            /*initSelectSoft();
                            initSelectHard();*
                        }
                    }
                // }

                //initiate soft skills select2
                // function initSelect2Soft() {
                    initSelectSoft();
                    $('.soft_skills').on('change', function(e) {
                        var data = $('.soft_skills').select2("val");
                        var _old = @this.get('selectedSoftSkills');

                        var tmp_data = data.map(Number);
                        _old = _old.map(Number);
                        let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
                        let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

                        const values = tmp_data;
                        selected2 = selected2.filter((value) => values.includes(value));
                        const lastSelected = values.filter((value) => !selected2.includes(value));
                        selected2.push(lastSelected[0]);

                        let child_ = $('.soft_skills option[value='+lastSelected[0]+']').text();
                        parent_id = $(".select2-results__option:contains('"+child_+"')").parent().attr('id');
                        child_id = child_;

                        if(diff1.length > 0 || diff2.length > 0) { @this.set('selectedSoftSkills', data); }
                    });
                    Livewire.hook('message.processed', (message, component) => {
                        if(openSoft) { initSelectSoft(1); } else {
                            initSelectSoft();
                            initSelect();
                            initSelectHard();
                        }
                    });

                    window.addEventListener('keep-open-soft', event => {
                        var selected_items = @this.get('selectedSoftSkills');
                        if(selected_items.length) {
                            openSoft = true;
                        } else {
                            openSoft = false;
                        }
                        console.log(openSoft);
                        openLang = false;
                        openHard = false;
                        // initSelectSoft(1);
                    });

                    function initSelectSoft(open = 0) {
                        softSelect2 = el1.select2({
                            closeOnSelect: false,
                            tags: false
                        });

                        // task - 86a114e9r
                        el1.on('select2:select', function (e) {
                            $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
                        });

                        if(open) {
                            softSelect2.select2("open");
                            if(document.getElementById(parent_id)) {
                                /*if($(".select2-results__option:contains('"+child_id+"')").length > 1) {
                                    let exact_match = $(".select2-results__option:contains('"+child_id+"')").filter(function(){
                                        return $(this).text() === child_id ? child_id : $(this).text();
                                    });
                                    console.log(exact_match);
                                } else {*
                                    document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('"+child_id+"')").outerHeight() * $(".select2-results__option:contains('"+child_id+"')").index() - 100;
                                // }
                            }
                            initSelect(openLang);
                            initSelectHard();
                        }
                    }
                // }

                //initiate hard skills select2

                // function initSelect2Hard() {
                    initSelectHard();
                    $('.hard_skills').on('change', function(e) {
                        var data = $('.hard_skills').select2("val");
                        var _old = @this.get('selectedHardSkills');

                        var tmp_data = data.map(Number);
                        _old = _old.map(Number);
                        let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
                        let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

                        const values = tmp_data;
                        selected3 = selected3.filter((value) => values.includes(value));
                        const lastSelected = values.filter((value) => !selected3.includes(value));
                        selected3.push(lastSelected[0]);

                        let child_ = $('.hard_skills option[value='+lastSelected[0]+']').text();
                        parent_id = $(".select2-results__option:contains('"+child_+"')").parent().attr('id');
                        child_id = child_;

                        if(diff1.length > 0 || diff2.length > 0) { @this.set('selectedHardSkills', data); }
                    });
                    Livewire.hook('message.processed', (message, component) => {
                        if(openHard) { initSelectHard(1); } else {
                            initSelectHard();
                            initSelectSoft();
                            initSelect();
                        }
                    });

                    window.addEventListener('keep-open-hard', event => {
                        var selected_items = @this.get('selectedHardSkills');
                        if(selected_items.length) {
                            openHard = true;
                        } else {
                            openHard = false;
                        }
                        console.log(openHard);
                        openLang = false;
                        openSoft = false;
                        // initSelectHard(1);
                    });

                    function initSelectHard(open = 0) {
                        hardSelect2 = el2.select2({
                            closeOnSelect: false,
                            tags: false
                        });

                        // task - 86a114e9r
                        el2.on('select2:select', function (e) {
                            $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
                        });

                        if(open) {
                            hardSelect2.select2("open");
                            if(document.getElementById(parent_id)) {
                                /*if($(".select2-results__option:contains('"+child_id+"')").length > 1) {
                                    let exact_match = $(".select2-results__option:contains('"+child_id+"')").filter(function(){
                                        return $(this).text() === child_id ? child_id : $(this).text();
                                    });
                                    console.log(exact_match);
                                } else {*
                                    document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('"+child_id+"')").outerHeight() * $(".select2-results__option:contains('"+child_id+"')").index() - 100;
                                // }
                            }
                            initSelect();
                            initSelectSoft();
                        }
                    }
                // }
            });*/

            $('select').select2({
                closeOnSelect: false,
                tags: false
            });


            // task - 86a114e9r
            $('select').on('select2:select', function (e) {
                console.log($(this).val());
                $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
            });

            $('select').on('select2:unselect', function (e) {
                console.log($(this).val());
                let _val = $(this).val();
                if(_val.length == 0) {
                    // task #86a1kvyc7
                    {{-- $(this).select2('open'); --}}
                    // task #86a1kvyc7
                }
                // $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
            });



            /*$('select').on('select2:open', function (e) {
                let id = $(this).attr('id');
                console.log($('textarea[aria-describedby="select2-'+id+'-container"]').is(":focus"));
                if(!$(this).find('option:selected').length) {
                    console.log($(this).find('option:selected').length);
                    $('#' + id).select2('close');
                }
            });*/

            /*$('select').on('select2:close', function (e) {
                let id = $(this).attr('id');
                console.log($('[aria-owns=select2-'+id+'-results]').parent('.'));
                console.log($('#' + id).is(":focus"), id);
                if($(this).find('option:selected').length) {
                    console.log($(this).find('option:selected').length);
                    $('#' + id).select2('open');
                }
            });*/

            $('select').on('select2:unselect', function (e) {
                let val = $(this).val();
                let id = $(this).attr('id');
                if($(this).find('option:selected').length) {
                    // task #86a1kvyc7
                    {{-- $('#' + id).select2('open'); --}}
                    // task #86a1kvyc7
                } else {
                    $('#' + id).select2('close');
                }
            });

        </script>


        <script>
            // Reload component every 2 seconds
            document.addEventListener("livewire:load", () => {

                $("body").delegate(".change-photo", "change", function(e) {
                    console.log('1st');
                    Livewire.hook('message.processed', (message, component) => {
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

                        /*setTimeout(() => {
                            var src = $('.upload-wrp').find('img').attr('src');
                            $('.avatar-img').find('img').attr('src', src);
                        }, 1000);*/
                    });


                });
            });

            // task - 8678eggpf
            var mask_img = "{{asset('/assets/be/images/masked_ic.png')}}";
            window.addEventListener('temp-update-avatar', event => {
              setTimeout(() => {
                  $('.upload-wrp').find('a').find('img').attr('src', '{{asset('')}}' + event.detail.newPath);
                  var src = $('.upload-wrp').find('a').find('img').attr('src');
                  $('.avatar-img').find('img').attr('src', src);
              }, 1000);

              setTimeout(() => {
                  var _status = '{{ $profile_status }}';
                  if(_status == '0') {
                    $('.avatar-img').find('img').attr('src', mask_img);
                    $('.upload-wrp').find('a').find('img').attr('src', mask_img);
                  }
              }, 2000);
            });

            window.addEventListener('update-avatar', event => {
                setTimeout(() => {
                    var src = $('.upload-wrp').find('img').attr('src');
                    $('.avatar-img').find('img').attr('src', src);
                }, 1000);
            });

            $("body").delegate(".upload-wrp", "click", function(e) {
                $('.change-photo').trigger('click')
            })


{{-- task 86a1k82ux --}}
                    {{-- $('.soft_skills').on('select2:close', function (event) {
                        var data = $('.soft_skills').select2("val");
                        @this.set('selectedSoftSkills', data);
                    });

                     $('.hard_skills').on('select2:close', function (event) {
                        var data = $('.hard_skills').select2("val");
                         @this.set('selectedHardSkills', data);
                    });
                     $('.hard_skills').on('select2:close', function (event) {
                        var data = $('.hard_skills').select2("val");
                         @this.set('selectedHardSkills', data);
                    });

                      $('.languages').on('select2:close', function (event) {
                        var data = $('.languages').select2("val");
                        @this.set('selectedLanguages', data)
                    }); --}}
{{-- task 86a1k82ux --}}

$('#updateCandidateResume').on('submit', function (event) {
            var data = $('.soft_skills').select2("val");
            @this.set('selectedSoftSkills', data);

            var data2 = $('.hard_skills').select2("val");
            @this.set('selectedHardSkills', data2);

            var data3 = $('.hard_skills').select2("val");
            @this.set('selectedHardSkills', data3);

            var data4 = $('.languages').select2("val");
            @this.set('selectedLanguages', data4)
    });
   {{-- 86a2ym4hk --}}
    $("body").delegate(".telle-edit", "keypress", function(e) {
    var charCode = event.which;
            if (
                (charCode < 48 || charCode > 57) && // Not a number
                charCode !== 45 && // Not a hyphen
                charCode !== 8 && // Backspace
                charCode !== 0 && // Arrow keys, function keys, etc.
                !event.ctrlKey // Control key combination
            ) {
                event.preventDefault();
                return false;
            }
        });
        document.addEventListener("livewire:load", () => {
            $("body").delegate(".telle-edit-", "keyup paste", function(e) {
                var v = $(this).val().replace(/\D/g, ''); // Remove non-numerics
                if (v.length < 10) {
                    v = v.replace(/(\d{3})(?=\d)/g, '$1-'); // Add dashes every 4th digit
                    $(this).val(v);
                }
                v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
                $(this).val(v.substr(0, 12));
            });
        });
           $(document).ready(function () {
    let allValid = 0;
    $('.telle-edit').each(function () {
        let input = $(this);
        input.intlTelInput('destroy');
        input.intlTelInput({
            initialCountry: 'auto',
            preferredCountries: ['us', 'gb', 'br', 'ru', 'cn', 'es', 'it'],
            autoPlaceholder: 'aggressive',
            nationalMode: false,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/utils.js",
            geoIpLookup: function (callback) {
                fetch('https://ipinfo.io/json', {
                    cache: 'reload'
                }).then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Failed: ' + response.status);
                }).then(ipjson => {
                    callback(ipjson.country);
                }).catch(e => {
                    callback('us');
                });
            }
        });
        input.on("countrychange input", function () {
            if (input.intlTelInput("isValidNumber")) {
                clearError();
                var selectedCountryData = input.intlTelInput('getSelectedCountryData');
                var countryCode = selectedCountryData.iso2.toUpperCase();
                var val = $('.country-name option[data-code="' + countryCode + '"]').attr('value');
            } else {
                clearError();
                allValid++;
            }
            if (allValid == $('.telle-edit').length - 1) {
                $('.formNextBtn').attr('type', 'submit');
            } else {
                {{-- $('.formNextBtn').attr('type', 'button'); --}}
            }
        });
        function clearError() {
            input.parents(".form-group").find(".text-danger").remove();
        }
        function displayError(message) {}
    });
    $('.telle-edit').trigger('keyup');
});
document.addEventListener("livewire:load", () => {
    Livewire.hook('message.processed', (message, component) => {
        let allValid = 0;
        $('.telle-edit').each(function (index) {
            let input = $(this);
            console.log(input);
            setTimeout(() => {
                input.intlTelInput('destroy');
                input.intlTelInput({
                    initialCountry: 'auto',
                    preferredCountries: ['us', 'gb', 'br', 'ru', 'cn', 'es', 'it'],
                    autoPlaceholder: 'aggressive',
                    nationalMode: false,
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/utils.js",
                    geoIpLookup: function (callback) {
                        fetch('https://ipinfo.io/json', {
                            cache: 'reload'
                        }).then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error('Failed: ' + response.status);
                        }).then(ipjson => {
                            callback(ipjson.country);
                        }).catch(e => {
                            callback('us');
                        });
                    }
                });
                input.on("countrychange input", function () {
                    if (input.intlTelInput("isValidNumber")) {
                        clearError();
                        var selectedCountryData = input.intlTelInput('getSelectedCountryData');
                        var countryCode = selectedCountryData.iso2.toUpperCase();
                        var val = $('.country-name option[data-code="' + countryCode + '"]').attr('value');
                    } else {
                        clearError();
                        allValid++;
                    }
                    if (allValid == $('.telle-edit').length - 1) {
                        $('.formNextBtn').attr('type', 'submit');
                    } else {
                        {{-- $('.formNextBtn').attr('type', 'button'); --}}
                    }
                });
                function clearError() {
                    input.parents(".form-group").find(".text-danger").remove();
                }
                function displayError(message) {}
            }, index * 100);
        });
        $('.telle-edit').trigger('keyup');
    });
});

        </script>
        @endpush
