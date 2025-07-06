<div>
<style>
.tool-info {

  pointer-events: all !important;
}
.tool-info-greet{

  {{-- position: absolute; --}}
  bottom: 23px !important;
  right: 0% !important;
}
.viewMoreButton{
  font-size: 12px;
    text-align: left;
    margin-left: 9px;
    width: 100%;
    margin-top: 3px;
}
.viewMoreButton:hover{
    color:black;
}
.bgx-custom-font{
    width: 32% !important;
}
</style>
    @if(!$published)
    <div class="back-clr ban-up">
        <div class="profile-banner cmn-gap pb-0">
            <div class="container">
                <div class="form-points mb-5">
                    @php
                    $step = 9; $current_step = auth()->user()->current_step;
                    @endphp
                    @include('inc.steps',compact('step', 'current_step'))
                </div>
            </div>
        </div>

        <div class="preview-sec cmn-gap pt-0" id="contentToPrint">
            <div class="preview-wrap">
                <div class="container">
                    <div class="preview-upper">
                        <div class="preview-uppr-left">
                            <!-- <div class="title">
                                    <h4>
                                    Preview:

                                    </h4> --}}
                                    <div class="tool-info-otr">
                                    {{-- <span>?</span> --}}
                                    <div class="tool-info">
                                        <p>
                                        Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry.
                                        </p>
                                    </div>
                                    </div>
                                </div> -->

                                {{-- <div class="toggle-switch-block">
                                <span class="d-sm-inline d-none">Preview </span><span>masked</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" data-checked="{{$mode ? 1 : 0}}" {{$mode ? 'checked' : ''}} wire:model.lazy="mode" />
                                </div>
                                <span class="d-sm-inline d-none">Preview</span>
                                <span> unmasked</span>
                            </div>  --}}

                            {{-- task - 86a1jhgrv <div class="toggle-switch-block" style="min-width: auto;">
                                <span><span class="d-none d-sm-inline">Preview </span> <span> masked </span></span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" data-checked="{{$mode ? 1 : 0}}" {{$mode ? 'checked' : ''}} wire:model.lazy="mode" />
                                </div>
                                <span><span class="d-none d-sm-inline">Preview </span> <span> unmasked </span></span>
                            </div>
                            <div class="tool-info-otr">
                                <span>?</span>
                                <div class="tool-info tool-info-mob">
                                    <p>
                                        “Masked” is exactly how your profile will appear to the public. “Unmasked” is a display of how your profile will appear if you grant permission to a specific employer upon their request.
                                    </p>
                                </div>
                            </div> --}}
                        </div>
                        <div class="preview-uppr-rgt pvr">
                             {{-- task 86a1hv19h --}}
                            <a href="#url" class="blue_btn publish_profile_btn px-3" style="min-width: auto;"><span class="d-sm-none m-0">APPROVE PROFILE</span><span class="d-none d-sm-inline m-0">Click To Publish</span> <span class="d-none d-sm-inline m-1"> Your Profile</span>
                                 <span class="ms-0 ms-sm-2"><img src="{{asset('assets/fe/images/blue-rocket.svg')}}" alt="" /></span>
                            </a>
                            {{-- task 86a1hv19h --}}

                        </div>
                    </div>
                    <div class="preview-banner">
                        <div class="preview-banner-fig">
                            <figure>
                                <img src="{{asset('assets/fe/images/candi-banner-img.png')}}" alt="" class="desktop-v" />
                                <img src="{{asset('assets/fe/images/ban-mob-image.png')}}" alt="" class="mobile-v" />
                            </figure>
                        </div>
                        <div class="preview-banner-txt ht">
                            <div class="preview-banner-txt-left">
                                <a href="{{route('candidates.downloadpdf')}}" class="edge_btn" target="_blank">Download Resume </a>
                                {{-- <a class="edge_btn" onclick="savePdf()">Download Resume </a> --}}
                            </div>
                            <div class="preview-banner-txt-rgt">
                                <a href="{{ route('candidatestep1') }}" class="edit_btn11 edit-profile-btn">Edit Profile
                                    <span><img src="{{asset('assets/fe/images/edit-icon11.svg')}}" alt="" /></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="preview_banner_btm">
                        <div class="preview_banner_img_sec">
                            <div class="preview_banner_img_sec_left">
                                @if(Auth::user()->profile_photo_path)
                                <figure class="@if($mode && $never_mode == false) main_img_masked @endif">
                                    @if($mode && $personal->profile_status == 0)
                                    <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="masked-img" />
                                    @else
                                    <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="" />
                                    @endif
                                </figure>
                                @else
                                    @php
                                        $style = '';
                                        if(!$mode) { $style = 'background: #fff; border: 1px dashed;'; }
                                    @endphp
                                    <figure style="{{ $style }}" class="{{($mode && $never_mode == false ? 'main_img_masked' : '')}}">
                                        @if($mode && $personal->profile_status == 0)
                                            <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="masked-img"/>
                                        @else
                                            <img src="{{asset('assets/fe/images/profile-pic.png')}}" alt="" style="height:80% !important; width: 80% !important;" />
                                        @endif
                                    </figure>
                                @endif
                            </div>
                            <div class="preview_banner_img_sec_rgt">
                                <div class="preview_banner_img_sec_rgt_wrapper">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="defination-sec">
                                                <div class="title">
                                                    <h4>
                                                        {{-- task - 86a0hfdhj --}}
                                                                @if(!empty($personal->name))
                                                                    @if(empty($personal->name_status))
                                                                        @php $length = (strlen($personal->name) > 15) ? 15 : strlen($personal->name); @endphp
                                                                        <em class="blured_txt bgx-custom-font">
                                                                        {{ (strlen($personal->name) > 15) ? substr($personal->name, 0, 15)."..." : $personal->name }}
                                                                        </em>
                                                                        @else
                                                                        {{ $personal->name }}
                                                                        @endif
                                                                @else
                                                                    <em class="blured_txt">Candidate Name</em>
                                                                @endif

                                                       @if($personal->linkedin_url)
                                                            @if(empty($personal->linkedin_url_status))
                                                                <em class="blured_txt image_blur"><a><img src="{{asset('assets/fe/images/linkdin-ylw.svg')}}" alt="" /></a></em>
                                                            @else
                                                                <a href="{{$personal->linkedin_url}}" target="_blank"><img src="{{asset('assets/fe/images/linkdin-ylw.svg')}}" alt="" /></a>
                                                            @endif
                                                        @endif

                                                        @if($personal->additional_url)
                                                            @if(empty($personal->additional_url_status))
                                                                <em class="blured_txt image_blur"><a><img src="{{asset('assets/fe/images/globe-ylw.svg')}}" alt="" /></a></em>
                                                            @else
                                                                <a href="{{$personal->additional_url}}" target="_blank"><img src="{{asset('assets/fe/images/globe-ylw.svg')}}" alt="" /></a>
                                                            @endif
                                                        @endif
                                                    </h4>

                                                    <h5>
                                                        Current Position:
                                                        <span class="{{ ($mode && $personal->current_title_status == 0) ? 'blured_txt' : '' }}">{{$personal->current_title}}</span>
                                                    </h5>
                                                </div>
                                                <div class="preview_contact_sec mobile-v">
                                                    <ul class="preview_contact_list wrpn">
                                                        <li>
                                                            <span class="contact_icon">
                                                                <img src="{{asset('assets/fe/images/ylw-tell.svg')}}" alt="" />
                                                            </span>
                                                            <div class="contact_rgt_side">
                                                                <h5>Phone No</h5>

                                                                    @if(empty($personal->phone_status))
                                                                            <a class="blured_txt" href="tel:00000">phone number</a>
                                                                        @else
                                                                            <a class="" href="tel:{{$personal->phone}}">{{$personal->phone}}</a>
                                                                        @endif

                                                            </div>
                                                        </li>

                                                        <li>
                                                            <span class="contact_icon"><img src="{{asset('assets/fe/images/prpl-envlp.svg')}}" alt="" /></span>
                                                            <div class="contact_rgt_side">
                                                                <h5>Email</h5>
                                                                {{-- task - 86a0xw1z1 --}}
                                                                @if(!empty($personal->email))
                                                                @if(empty($personal->email_status))
                                                                    <a class="blured_txt" href="mailto:info@purplestair.com">example@email.com</a>
                                                                    @else
                                                                    <a href="mailto:{{ $personal->email }}">{{ $personal->email }}</a>

                                                                    @endif
                                                                    @else
                                                                    <a href="mailto:info@purplestair.com">info@purplestair.com</a>
                                                                    @endif
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="defination_list">
                                                    <h5>Industries:</h5>
                                                    <ul>
                                                        @foreach($industries as $industry)
                                                        <li>{{$industry}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="defination_list">
                                                    <h5>Area of Interest:</h5>
                                                    <ul>
                                                        @foreach($interests as $interest)
                                                        <li>{{$interest}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview_contact_sec desktop-v">
                                                <ul class="preview_contact_list wrpn mb-3">
                                                    <li>
                                                        <span class="contact_icon"><img src="{{asset('assets/fe/images/ylw-tell.svg')}}" alt="" /></span>
                                                        <div class="contact_rgt_side">
                                                                <h5>Phone No</h5>
                                                                @if(empty($personal->phone_status))
                                                                            <a class="blured_txt" href="tel:00000">phone number</a>
                                                                        @else
                                                                            @if(!empty($personal->phone))
                                                                                <a class="" href="tel:{{$personal->phone}}">{{$personal->phone}}</a>
                                                                            @endif
                                                                        @endif
                                                            </div>
                                                    </li>
                                                    <li>
                                                        <span class="contact_icon"><img src="{{asset('assets/fe/images/prpl-envlp.svg')}}" alt="" /></span>
                                                        <div class="contact_rgt_side">
                                                            <h5>Email</h5>
                                                            @if(!empty($personal->email))
                                                                @if(empty($personal->email_status))
                                                                    <a class="blured_txt" href="mailto:info@purplestair.com">example@email.com</a>
                                                                @else
                                                                    <a href="mailto:{{ $personal->email }}">{{ $personal->email }}</a>

                                                                @endif
                                                            @else
                                                                <a href="mailto:info@purplestair.com">info@purplestair.com</a>
                                                            @endif
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="preview_banner_img_btm">
                            <ul class="preview_banner_img_list">
                                <li>
                                    <div class="preview_banner_img_list_inner">
                                        <h6>Location:</h6>
                                        <p>
                                            {{-- task - 86a0hfdhj | task - 86a0hxdp7 --}}
                                            @if(!empty($personal->address))
                                                @if($mode && $never_mode == false/* task - 86a0xw1z1 $personal->zip_code_status == 0 */ )
                                                    <span class="blured_txt"> {{$personal->address}},&nbsp;{{$personal->state_abbr}}</span>
                                                @else
                                                    {{$personal->address}},&nbsp;{{$personal->state_abbr}}
                                                @endif
                                                 {{-- Task #86a21dpn9 --}}
                                                    @else
                                                    @if($personal->country_name_status == 0)
                                                        <span class="blured_txt"> {{$personal->country}}</span>
                                                    @else
                                                        {{$personal->country}}
                                                    @endif
                                            @endif
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="preview_banner_img_list_inner">
                                        <h6>Asking Salary:</h6>
                                        <p>{{$personal->salary_range}}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="preview_banner_img_list_inner">
                                        <h6>Compensation:</h6>
                                        <ul class="tick_list">
                                            @if($personal->compensation_salary)
                                            <li>
                                                <span><img src="{{asset('assets/fe/images/sky_blue.svg')}}" alt="" /></span>Salary
                                            </li>
                                            @endif
                                            @if($personal->compensation_hourly)
                                            <li>
                                                <span><img src="{{asset('assets/fe/images/sky_blue.svg')}}" alt="" /></span>Hourly
                                            </li>
                                            @endif
                                            @if($personal->compensation_comission_based)
                                            <li>
                                                <span><img src="{{asset('assets/fe/images/sky_blue.svg')}}" alt="" /></span>Comission Based
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="preview_banner_img_list_inner">
                                        <h6>Schedule:</h6>
                                        <ul class="tick_list">
                                            @if($personal->schedule_full_time)
                                            <li>
                                                <span><img src="{{asset('assets/fe/images/sky_blue.svg')}}" alt="" /></span>Full Time
                                            </li>
                                            @endif
                                            @if($personal->schedule_part_time)
                                            <li>
                                                <span><img src="{{asset('assets/fe/images/sky_blue.svg')}}" alt="" /></span>Part Time
                                            </li>
                                            @endif
                                            @if($personal->schedule_no_preference)
                                            <li>
                                                <span><img src="{{asset('assets/fe/images/sky_blue.svg')}}" alt="" /></span>No Preference
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="preview_banner_img_list_inner">
                                        <h6>Work Setting:</h6>
                                        <ul class="tick_list">
                                            @if($personal->work_environment_remote)
                                            <li>
                                                <span><img src="{{asset('assets/fe/images/sky_blue.svg')}}" alt="" /></span>Remote
                                            </li>
                                            @endif
                                            @if($personal->work_environment_hybrid)
                                            <li>
                                                <span><img src="{{asset('assets/fe/images/sky_blue.svg')}}" alt="" /></span>Hybrid
                                            </li>
                                            @endif
                                            @if($personal->work_environment_in_office)
                                            <li>
                                                <span><img src="{{asset('assets/fe/images/sky_blue.svg')}}" alt="" /></span>In office
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if($personal->prefered_benefits_insurance_benefits ||$personal->prefered_benefits_padi_holidays || $personal->prefered_benefits_paid_vacation_days ||$personal->prefered_benefits_professional_environment || $personal->prefered_benefits_casual_environment)
                    <div class="preffered_block">
                        <div class="preffered_block_left">
                            <h4>Preferred Benefits:</h4>
                        </div>
                        <div class="preffered_block_right">
                            <ul>
                                @if($personal->prefered_benefits_insurance_benefits)
                                <li>Insurance Benefits</li>
                                @endif
                                @if($personal->prefered_benefits_padi_holidays)
                                <li>Paid Holidays</li>
                                @endif
                                @if($personal->prefered_benefits_paid_vacation_days)
                                <li>Paid Vacation Days</li>
                                @endif
                                @if($personal->prefered_benefits_professional_environment)
                                <li>Official Environment</li>
                                @endif
                                @if($personal->prefered_benefits_casual_environment)
                                <li>Casual Environment</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endif
                    @if($personal->short_bio)
                        <div class="about_candidate">
                            <div class="title">
                                <h4>About
                                {{-- @if($never_mode == false && !$mode)  --}}
                                @if(empty($personal->name_status))
                                <span class="blured_txt">
                                Candidate Name
                                </span>
                                @else
                                <span>
                                {{ Auth::user()->name }}
                                </span>
                                @endif
                                {{-- @endif --}}
                                </h4>
                            </div>
                            <div class="about_candidate_txt">
                            @if(empty($personal->short_bio_status))
                                <p class="blured_txt">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta atque ab veritatis sunt laboriosam, autem iusto, consequatur eum deserunt alias ducimus velit, eos maiores! Animi et reprehenderit sit repudiandae libero?
                                </p>
                                @else
                                <p>
                                    {{$personal->short_bio}}
                                </p>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="skills_list_block">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="skills_list_inner">
                                    <div class="title">
                                        <h4 style="color: #7e50a7">Hard Skills</h4>
                                    </div>
                                    <ul class="skills_list">
                                        @php $count = 0 @endphp
                                        @foreach($hard_skills as $hard_skill)
                                            <li>{{$hard_skill}}</li>
                                            @php $count++ @endphp

                                            @if ($count === 6)

                                                <!-- Display "View More" button after the first five items -->

                                                <ul class="hidden-skills-list0" style="display:none;">
                                            @endif
                                        @endforeach

                                        </ul>
                                        @if ($count > 6)
                                            <span id="viewMoreButton0" class="viewMoreButton" onclick="toggleView(0)">CLICK HERE TO VIEW ALL</span>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @php $count = 0 @endphp
                                <div class="skills_list_inner">
                                    <div class="title">
                                        <h4 style="color: #009cc8">Soft Skills</h4>
                                    </div>

                                    <ul class="skills_list">
                                        @foreach($soft_skills as $soft_skill)
                                        <li>{{$soft_skill}}</li>
                                             @php $count++ @endphp

                                            @if ($count === 6)

                                                <!-- Display "View More" button after the first five items -->

                                                <ul class="hidden-skills-list1" style="display:none;">
                                            @endif
                                        @endforeach

                                        </ul>
                                        @if ($count > 6)
                                            <span id="viewMoreButton1" class="viewMoreButton" onclick="toggleView(1)">CLICK HERE TO VIEW ALL</span>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="skills_list_inner">
                                    <div class="title">
                                        <h4 style="color: #00407c">Languages</h4>
                                    </div>

                                    <ul class="skills_list">
                                        @foreach($languages as $language)
                                        <li>{{$language}}</li>
                                        @endforeach

                                    </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="work_block">
                        @if($employments->count())
                        <div class="work_block_each">
                            <div class="title">
                                <h4>Work Experience</h4>
                            </div>
                            <ul class="work_list ps-3">
                                @foreach($employments as $employement)
                                {{-- #Task 86a22q25n issue on testing --}}
                                {{-- @if($employement->position != '') --}}
                                <li>
                                    <span class="list_style"></span>
                                    <div class="work_list_inner">
                                        <h6 class="{{ ($mode && $employement->start_year_status == 0) ? 'blured_txt' : '' }}">
                                            {{-- {{$employement->start_year}} - {{$employement->end_year}} --}}
                                            {{ $employement->start_year }}
                                            @if ($employement->start_year != '' && ($employement->end_year != '' || $employement->currently_working))
                                            -
                                            @endif
                                            {{ $employement->currently_working ? 'Present' : $employement->end_year }}
                                        </h6>
                                        @if($employement->position != '')
                                        <h5>
                                            @if($mode && $employement->position_status == 0)
                                            <em class="blured_txt">Senior Ux/Ui Designer</em>
                                            @else
                                            {{$employement->position}}
                                            @endif

                                            @if($mode && $employement->company_name_status == 0)
                                            <span class="blured_txt">Senior Ux/Ui Designer</span>
                                            @else
                                            <span>{{$employement->company_name}}</span>
                                            @endif
                                        </h5>
                                        @endif

                                        {{-- task - 86a0hfdhj --}}
                                        @if($employement->responsibilities != '')
                                        <div class="work_list_inner_txt">
                                            <h5>Position Responsibilities</h5>
                                            {{-- task - 86a0hfdhj --}}
                                            <p class="{{ ($mode && $employement->responsibilities_status == 0) ? 'blured_txt' : '' }}">
                                               {!! nl2br($employement->responsibilities)!!}
                                            </p>
                                        </div>
                                        @endif
                                        {{-- task - 86a0hfdhj end --}}

                                        @if($employement->accomplishments != '')
                                        <div class="work_list_inner_txt">
                                            <h5>Position Accomplishments</h5>
                                            {{-- task - 86a0hfdhj --}}
                                            <p class="{{ ($mode && $employement->accomplishments_status == 0) ? 'blured_txt' : '' }}">
                                                {!! nl2br($employement->accomplishments)!!}
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                </li>
                                {{-- @endif --}}
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($educations->count())
                        <div class="work_block_each">
                            <div class="title">
                                <h4>Education & Training</h4>
                            </div>
                            <ul class="work_list ps-3">
                                @foreach($educations as $education)
                                @if ($education->organization_name != '')
                                <li>
                                    <span class="list_style"></span>
                                    <div class="work_list_inner">
                                        <h6 class="{{ ($mode && $education->start_year_status == 0) ? 'blured_txt' : '' }}">
                                            {{$education->start_year}}
                                            @if($education->start_year != '' && ($education->end_year != '' || $education->currently_studying)) - @endif
                                            {{$education->currently_studying ? 'Present' : $education->end_year}}
                                        </h6>
                                        @if ($education->organization_name != '')
                                        <h5>@if($mode && $education->organization_name_status == 0)
                                            <em class="blured_txt">{{ $education->organization_name }}</em>
                                            @else
                                            {{ $education->organization_name }}
                                            @endif
                                            <span class="{{ $mode && $education->program_name_status == 0 ? 'blured_txt' : '' }}">{{$education->program_name}}</span>
                                        </h5>
                                        @endif
                                        @if ($education->course_description != '')
                                        <p class="{{ ($mode && $education->course_description_status == 0) ? 'blured_txt' : '' }}">
                                            {{$education->course_description}}
                                        </p>
                                        @endif
                                    </div>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    @if($references->count())
                    <div class="reference_block">
                        <div class="title">
                            <h4>@if(count($references)>1) References @else Reference @endif</h4>
                        </div>
                        @foreach ($references as $reference)
                        <div class="reference_block_inner">
                            @if($reference->name != '')
                            {{-- task - 86a1tzdqv - POINT - 7 --}}
                            @if($mode && $reference->name_status == 0)
                            <h5 class="blured_txt">Jenefer Smith</h5>
                            @else
                            <h5>{{ucwords($reference->name)}}</h5>
                            @endif
                            @endif
                            <ul class="preview_contact_list">
                                @if($reference->phone != '')
                                <li>
                                    <span class="contact_icon"><img src="{{asset('assets/fe/images/ylw-tell.svg')}}" alt="" /></span>
                                    <div class="contact_rgt_side">
                                        <h5>Phone No</h5>
                                        {{-- task - 86a1tzdqv - POINT - 7 --}}
                                        @if($mode && $reference->phone_status == 0)
                                        <a class="blured_txt" href="tel:">phone</a>
                                        @else
                                        <a href="tel:{{$reference->phone}}">{{$reference->phone}}</a>
                                        @endif
                                    </div>
                                </li>
                                @endif
                                @if($reference->email != '')
                                <li>
                                    <span class="contact_icon"><img src="{{asset('assets/fe/images/prpl-envlp.svg')}}" alt="" /></span>
                                    <div class="contact_rgt_side">
                                        <h5>Email</h5>
                                        {{-- task - 86a1tzdqv - POINT - 7 --}}
                                        @if($mode && $reference->email_status == 0)
                                        <a class="blured_txt" href="mailto:">Email</a>
                                        @else
                                        <a href="mailto:{{$reference->email}}">{{$reference->email}}</a>
                                        @endif
                                    </div>
                                </li>
                                @endif
                                @if($reference->relationship != '')
                                <li>
                                    <span class="contact_icon" style="background: rgba(0, 157, 200, 0.1)"><img src="{{asset('assets/fe/images/hand_shake.svg')}}" alt="" /></span>
                                    <div class="contact_rgt_side">
                                        <h5>Relationship</h5>
                                        {{-- task - 86a1tzdqv - POINT - 7 --}}
                                        @if($mode && $reference->relationship_status == 0)
                                        <p class="blured_txt">relationship</p>
                                        @else
                                        <p>{{$reference->relationship}}</p>
                                        @endif
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div><br>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else

    <div class="login-sec sign-up back-clr log-h-sec pt-4 ban-up ht_center_div">
        <div class="login-sec-wrap">
            <div class="container">
                <div class="log-wrap" style="background-image: url(/assets/fe/images/log-back2.png)">
                    <div class="login-outr congo position-relative--">
                        <figure>
                            <img src="{{asset('assets/fe/images/party.svg')}}" alt="" />
                        </figure>
                        <h2>Profile Complete</h2>
                        <p style="color: #8f8f8f;">
                            Purple Stairs does not list jobs. Employers review candidates and request additional information from those they are interested in.
                        </p>
                        <span class="position-relative h-0">
                            <p style=" font-weight: bold;color: #8f8f8f;">
                                You will be notified of an employer request <span class="custom-tool position-absolute m-0 custom-tool-greet">
                                    <span class>?</span>
                                </span>
                                <br>
                                via email and on your dashboard.
                            </p>
                            <div class="tool-info tool-info-greet ">
                                <p>
                                    An employer request is a message from a specific employer interested in learning more about you. Go To  <a class="primary-color" href="{{url('/candidate/requests')}}">My Dashboard</a>
                                </p>
                            </div>
                        </span>


                        <p style="color: var(--purple);">
                            You can edit your settings anytime by logging In.
                        </p>
                        <!-- <p>
                            <a href="{{ route('candidates.editpersonal') }}" class="sub-btn sub2">Edit Profile Now</a>
                        </p> -->



                        {{-- <form>
                  <div class="form-input">
                    <input
                      type="submit"
                      value="Go To Candidate Dashboard"
                      class="sub-btn sub2"
                    />
                  </div>
                </form> --}}
                    </div>
                    <img src="{{asset('assets/fe/images/log1.png')}}" alt="" class="mobile-v log1">
                    <img src="{{asset('assets/fe/images/log2.png')}}" alt="" class="mobile-v log2">
                </div>
            </div>
        </div>
    </div>
    <script>

                        </script>
    @endif
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.blured_txt:not(.image_blur)').text('Hidden'); // task - 86a0f55cd

    window.jsPDF = window.jspdf.jsPDF;

    // Convert HTML content to PDF
    function savePdf() {
        var HTML_Width = $("#contentToPrint").width();
        var HTML_Height = $("#contentToPrint").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width + (top_left_margin * 2);
        var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = 0;


        html2canvas($("#contentToPrint")[0], {
            allowTaint: true,
            useCORS: true
        }).then(function(canvas) {
            canvas.getContext('2d');

            console.log(canvas.height + "  " + canvas.width);


            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt', [PDF_Width, canvas_image_height + 50]);
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);


            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, canvas_image_height + 100);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4), canvas_image_width, canvas_image_height);
            }

            pdf.save("curriculum-vitae.pdf");
        });
    }
</script>
<script>
    $(".sub2").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/requests')
    });
    document.addEventListener("livewire:load", (e) => {
        setTimeout(() => {
            if($('.switch_1').prop('checked') === false) {
                @this.set('mode', false);
            }
    }, 500);
    $("body").delegate(".publish_profile_btn", "click", function(e) {
            livewire.emit('publish');
            Livewire.hook('message.processed', (message, component) => {
            $('.unmaskReq').removeClass('d-none');

        });
    });
});

$(document).ready(function() {
    $("body").delegate(".custom-tool", "mouseenter", function(e) {
        $('.tool-info-greet').css('opacity',1)
    });
    $("body").delegate(".tool-info-greet", "mouseenter", function(e) {
         $('.tool-info-greet').css('opacity',1)
    });
    $("body").on("click", function(event) {
        var tooltip = $(".tool-info-greet");
        var isClickInside = tooltip.is(event.target);
        if (!isClickInside) {
            tooltip.css("opacity", 0);
        }
    });
});



</script>

<script>
    function toggleView(id) {
         var hiddenSkillsList = document.querySelector('.hidden-skills-list'+id);
        var viewMoreButton = document.querySelector('#viewMoreButton'+id);

        if (hiddenSkillsList.style.display === 'none') {
            hiddenSkillsList.style.display = 'block';
            viewMoreButton.innerHTML =  'CLICK HERE TO VIEW LESS';
        } else {
            hiddenSkillsList.style.display = 'none';
            viewMoreButton.innerHTML = 'CLICK HERE TO VIEW ALL';

        }
    }
</script>

@endpush
