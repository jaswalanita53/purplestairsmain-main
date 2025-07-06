<div>
    <style type="text/css">
        .contact_rgt_side .blured_txt {
            white-space: nowrap !important;
        }

        .intercom-lightweight-app {
            display: none !important;
        }

        .viewMoreButton {
            font-size: 12px;
            text-align: left;
            margin-left: 9px;
            width: 100%;
            margin-top: 3px;
        }

        .viewMoreButton:hover {
            color: black;
        }

        span.bgx-linkedin-text {
            font-size: 12px;
            padding-top: 5px;
            padding-left: 5px;
            color: #ffae19;
        }
                a:hover .bgx-linkedin-text{
            color:black;
            text-decoration: none !important;
        }

        a .bgx-linkedin-text {

    transition: all 0.5s ease;
}
    </style>
    <div>
        @if (!$published)
            <div class="preview-sec cmn-gap pt-0 back-clr ban-up mt-0">
                <div class="preview-wrap preview-wrap-final">
                    <div class="container">
                        <div class="preview_banner_total">
                            <div class="preview-banner">
                                <div class="preview-banner-fig">
                                    <figure>
                                        <img src="{{ asset('assets/fe/images/candi-banner-img.png') }}" alt=""
                                            class="desktop-v" />
                                        <img src="{{ asset('assets/fe/images/ban-mob-image.png') }}" alt=""
                                            class="mobile-v" />
                                    </figure>
                                </div>
                            </div>
                                                                                                                                                 {{-- 86a2zxgm6 --}}
                                            @if(!$mode)
                                            <div class="preview-banner-txt- ht ms-2 mt-2">
                                                <div class="preview-banner-txt-left">
                                                   <a href="{{ route('candidates.downloadpdfEmployer',[$candidate_user->id]) }}"  class="edge_btn dwnld-btn">Download Resume </a>
                                                </div>
                                            </div>
                                            @endif
                                            {{-- 86a2zxgm6 --}}
                            <div class="preview_banner_btm">

                                <div class="preview_banner_img_sec">
                                    <div class="preview_banner_img_sec_left ">
                                        {{-- @if (!empty($candidate_user->profile_photo_path)) --}}
                                        @if(!empty($candidate_user->profile_photo_path))
                                                            @if($mode)
                                                            {{-- 86a2ymdej --}}
                                                            <figure class="@if($personal->profile_status == 0) main_img_masked @endif mb-2 mt-2">
                                                                @if($personal->profile_status == 0)
                                                                <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="masked-img" />
                                                                @else
                                                                <img src="{{ asset($candidate_user->profile_photo_path) }}" alt="" class="rounded-circle"/>
                                                                @endif
                                                            </figure>
                                                            @else
                                                            <figure class=" mt-5">
                                                                <img src="{{ asset($candidate_user->profile_photo_path) }}" alt="" class="rounded-circle"/>
                                                            </figure>
                                                            @endif
                                                            @else

                                                            @if($mode)
                                                            {{-- 86a2ymdej --}}
                                                            <figure class="@if($personal->profile_status == 0) main_img_masked @endif mb-2 mt-2">
                                                                @if($personal->profile_status == 0)
                                                                <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="masked-img" />
                                                                @else
                                                                <img src="{{ asset('/assets/fe/images/profile-pic.png') }}" alt="" />
                                                                @endif
                                                            </figure>
                                                            @else
                                                            <figure class="mt-5">
                                                                <img src="{{ asset('/assets/fe/images/profile-pic.png') }}" alt="" />
                                                            </figure>
                                                            @endif
                                                            @endif
                                        {{-- @endif --}}
                                        @if ($this->mode)
                                            @if ($requestCompany)
                                                <div class="request_btn_otr">
                                                    {{-- task - 862k46fkk <a href="#url" class="request_btn"><span><img src="{{asset('assets/fe/images/ylw_lock.svg')}}" alt="" /></span>Pending</a> --}}
                                                    <div class="pending_unmask">
                                                        <i class="iconc"><img
                                                                src="{{ asset('assets/be/images/clock.svg') }}"
                                                                alt=""></i>
                                                        <div class="pending_unmask_rt">
                                                            <h6>Pending Unmask</h6>
                                                            <p>Profile Saved In Requested</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="request_btn_otr">
                                                    <a href="#url" class="request_btn"><span><img
                                                                src="{{ asset('assets/fe/images/ylw_lock.svg') }}"
                                                                alt="" /></span>Request Unmask</a>
                                                    <div class="position_form" wire:ignore.self>
                                                        <div class="request_close">
                                                            <button type="button" class="close close_req_mask">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <form wire:submit.prevent="sendRequest()">
                                                            <div class="form-group">
                                                                <label>Subject*</label>
                                                                <input type="text" class="form-control"
                                                                    {{-- task - 86a2rvv8z placeholder="Job title here" --}}
                                                                    wire:model.defer="position_hiring" required />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Message to Candidate</label>
                                                                <textarea {{-- task - 86a2rvv8z placeholder="I reviewed your resume..." --}} wire:model.defer="message" required></textarea>
                                                            </div>
                                                            <div class="position-submit-btn-otr" wire:loading.remove
                                                                wire:target="sendRequest">
                                                                <input type="submit" value="Send to Candidate"
                                                                    class="position_submit_btn" />
                                                            </div>
                                                            <div class="position-submit-btn-otr" wire:loading
                                                                wire:target="sendRequest">
                                                                <input type="submit" value="Sending..." disabled
                                                                    class="position_submit_btn" />
                                                            </div>
                                                        </form>
                                                        @if ($messageSent)
                                                            <span class="message_snt_sec">Your Message Has Been
                                                                Sent.</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="preview_banner_img_sec_rgt">
                                        <div class="preview_banner_img_sec_rgt_wrapper">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="defination-sec">
                                                        <div class="title">

                                                            <h4 gdfgds class="testijgn">
                                                                {{-- task - 86a0hfdhj --}}

                                                                {{-- Task #86a0jvhwc --}}
                                                                {{-- task - 86a0hf9zc {{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}} --}}

                                                                {{-- @if (!empty($personal->name_status))
                                                            @if ($mode && $personal->name_status == 0)
                                                            @if (!empty($personal->name))
                                                            @php $length = (strlen($personal->name) > 15) ? 15 : strlen($personal->name); @endphp
                                                            <em class="blured_txt fdsafas">

                                                                {{ (strlen($personal->name) > 15) ? substr($personal->name, 0, 15)."..." : $personal->name }}
                                                            </em>
                                                            @else

                                                            <em class="blured_txt">Candidate Name</em>
                                                            @endif

                                                            @else
                                                            {{ $personal->name }}
                                                            @endif
                                                            @endif --}}

                                                                {{-- task - 86a0xw4t8 --}}
                                                                @if (!empty($personal->name))
                                                                    {{-- @if (!empty($personal->name_status)) --}}
                                                                    @if ($never_mode == false /* && $personal->name_status == 0*/)
                                                                        @php $length = (strlen($personal->name) > 15) ? 15 : strlen($personal->name); @endphp
                                                                        <em class="blured_txt  name-blured-box">
                                                                            {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                                        </em>
                                                                    @else
                                                                        {{ $personal->name }}
                                                                    @endif
                                                                    {{-- @else
                                                                    @php $length = (strlen($personal->name) > 15) ? 15 : strlen($personal->name); @endphp
                                                                    <em class="blured_txt  name-blured-box">
                                                                    {{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}}
                                                                    </em>
                                                                @endif --}}
                                                                @else
                                                                    <em class="blured_txt name-blured-box">Candidate
                                                                        Name</em>
                                                                @endif



                                                                @if (!empty($personal->linkedin_url))
                                                                    @if ($never_mode == false)
                                                                        <em class="blured_txt image_blur"><a><img
                                                                                    src="{{ asset('assets/fe/images/linkdin-ylw.svg') }}"
                                                                                    alt="" /></a></em>
                                                                    @else
                                                                        <a href="{{ $personal->linkedin_url }}"
                                                                            target="_blank"><img
                                                                                src="{{ asset('assets/fe/images/linkdin-ylw.svg') }}"
                                                                                alt="LinkedIn" title="LinkedIn" /><span
                                                                                class="bgx-linkedin-text">LinkedIn</span></a>
                                                                    @endif
                                                                @endif

                                                                @if (!empty($personal->additional_url))
                                                                    @if ($never_mode == false)
                                                                        <em class="blured_txt image_blur"><a><img
                                                                                    src="{{ asset('assets/fe/images/globe-ylw.svg') }}"
                                                                                    alt="" /></a></em>
                                                                    @else
                                                                        <a href="{{ $personal->additional_url }}"
                                                                            target="_blank"><img
                                                                                src="{{ asset('assets/fe/images/globe-ylw.svg') }}"
                                                                                style="padding-top:5px;"
                                                                                alt="Additonal URL"
                                                                                title="Additonal URL" /><span
                                                                                class="bgx-linkedin-text">Additonal
                                                                                URL</span></a>
                                                                    @endif
                                                                @endif
                                                            </h4>
                                                            <h5>
                                                                Current Position:
                                                                @if (!empty($personal->current_title))
                                                                    <span
                                                                        class="{{ $mode && $personal->current_title_status == 0 ? 'blured_txt' : '' }}">{{ $personal->current_title }}</span>
                                                                @endif
                                                            </h5>
                                                        </div>
                                                        <div class="preview_contact_sec mobile-v">
                                                            <ul class="preview_contact_list wrpn mb-3">
                                                                <li>
                                                                    <span class="contact_icon"><img
                                                                            src="{{ asset('assets/fe/images/ylw-tell.svg') }}"
                                                                            alt="" /></span>
                                                                    <div class="contact_rgt_side">
                                                                        <h5>Phone No</h5>
                                                                        @if ($never_mode == false)
                                                                            <a class="blured_txt" href="tel:">phone
                                                                                no
                                                                            </a>
                                                                        @else
                                                                            <a class=""
                                                                                href="tel:{{ $personal->phone }}">{{ $personal->phone }}
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="contact_icon"><img
                                                                            src="{{ asset('assets/fe/images/prpl-envlp.svg') }}"
                                                                            alt="" /></span>
                                                                    <div class="contact_rgt_side">
                                                                        <h5>Email</h5>

                                                                        @if ($never_mode == false)
                                                                            <a class="blured_txt" href="mailto:">Email
                                                                            </a>
                                                                        @else
                                                                            @if(!empty($personal->email))
                                                                    <a href="mailto:{{ $personal->email }}">{{ $personal->email }}</a>
                                                                    @else
                                                                    <a href="mailto:info@purplestair.com">info@purplestair.com</a>
                                                                    @endif
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="defination_list">
                                                            <h5>Industries:</h5>
                                                            <ul>
                                                                @if (!empty($industries))
                                                                    @foreach ($industries as $industry)
                                                                        <li>{{ $industry }}</li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="defination_list">
                                                            <h5>Area of Interest:</h5>
                                                            <ul>
                                                                @if (!empty($interests))
                                                                    @foreach ($interests as $interest)
                                                                        <li>{{ $interest }}</li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="preview_contact_sec desktop-v">
                                                        <ul class="preview_contact_list wrpn mb-3 d-flex row">
                                                            <li class="col-md-6">
                                                                <span class="contact_icon"><img
                                                                        src="{{ asset('assets/fe/images/ylw-tell.svg') }}"
                                                                        alt="" /></span>
                                                                <div class="contact_rgt_side">
                                                                    <h5>Phone No</h5>
                                                                    @if ($never_mode == false)
                                                                        <a class="blured_txt" href="tel:">phone
                                                                            no</a>
                                                                    @else
                                                                        <a
                                                                            href="tel:{{ $personal->phone }}">{{ $personal->phone }}</a>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                            <li class="col-md-6">
                                                                <span class="contact_icon"><img
                                                                        src="{{ asset('assets/fe/images/prpl-envlp.svg') }}"
                                                                        alt="" /></span>
                                                                <div class="contact_rgt_side">
                                                                    <h5>Email</h5>
                                                                    @if ($never_mode == false)
                                                                        <a class="blured_txt" href="mailto:">Email</a>
                                                                    @else
                                                                        <a
                                                                            href="mailto:{{ $personal->email }}">{{ $personal->email }}</a>
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
                                                    {{-- task - 86a0xw4t8 --}}
                                                    {{-- task - 86a0hfdhj | task - 86a0hxdp7 --}}
                                                    @if (!empty($personal->address))
                                                        @if ($never_mode == false /* && $personal->zip_code_status == 0*/)
                                                            <span class="blured_txt">
                                                                {{ $personal->address }},&nbsp;{{ $personal->state_abbr }}</span>
                                                        @else
                                                            {{ $personal->address }},&nbsp;{{ $personal->state_abbr }}
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
                                                @if (!empty($personal->salary_range))
                                                    <p>{{ $personal->salary_range }}</p>
                                                @endif
                                            </div>
                                        </li>
                                        <li>
                                            <div class="preview_banner_img_list_inner">
                                                <h6>Compensation:</h6>
                                                @if (!empty($personal->compensation_salary))
                                                    <p class="m-0"> Salary</p>
                                                @endif
                                                @if (!empty($personal->compensation_hourly))
                                                    <p class="m-0">Hourly</p>
                                                @endif
                                                @if (!empty($personal->compensation_comission_based))
                                                    <p class="m-0">Comission Based</p>
                                                @endif
                                            </div>
                                        </li>
                                        <li>
                                            <div class="preview_banner_img_list_inner">
                                                <h6>Schedule: &nbsp;</h6>
                                                @if (!empty($personal->schedule_full_time))
                                                    <p>Full Time</p>
                                                @endif
                                                @if (!empty($personal->schedule_part_time))
                                                    <p>Part Time</p>
                                                @endif
                                                @if (!empty($personal->schedule_no_preference))
                                                    <p>No Preference</p>
                                                @endif
                                            </div>
                                        </li>
                                        <li>
                                            <div class="preview_banner_img_list_inner">
                                                <h6>Work Setting:</h6>
                                                <ul class="tick_list">
                                                    @if (!empty($personal->work_environment_remote))
                                                        <li>
                                                            <span><img
                                                                    src="{{ asset('assets/fe/images/sky_blue.svg') }}"
                                                                    alt="" /></span>Remote
                                                        </li>
                                                    @endif
                                                    @if (!empty($personal->work_environment_hybrid))
                                                        <li>
                                                            <span><img
                                                                    src="{{ asset('assets/fe/images/sky_blue.svg') }}"
                                                                    alt="" /></span>Hybrid
                                                        </li>
                                                    @endif
                                                    @if (!empty($personal->work_environment_in_office))
                                                        <li>
                                                            <span><img
                                                                    src="{{ asset('assets/fe/images/sky_blue.svg') }}"
                                                                    alt="" /></span>In Office
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- task - 86a2vxjff --}}
                        @if($personal->prefered_benefits_insurance_benefits == 1 || $personal->prefered_benefits_padi_holidays == 1 || $personal->prefered_benefits_paid_vacation_days == 1 || $personal->prefered_benefits_professional_environment == 1 || $personal->prefered_benefits_casual_environment)
                        <div class="preffered_block">
                            <div class="preffered_block_left">
                                <h4>Preferred Benefits:</h4>
                            </div>
                            <div class="preffered_block_right">
                                <ul>
                                    @if (!empty($personal->prefered_benefits_insurance_benefits))
                                        <li>Insurance Benefits</li>
                                    @endif
                                    @if (!empty($personal->prefered_benefits_padi_holidays))
                                        <li>Paid Holidays</li>
                                    @endif
                                    @if (!empty($personal->prefered_benefits_paid_vacation_days))
                                        <li>Paid Vacation Days</li>
                                    @endif
                                    @if (!empty($personal->prefered_benefits_professional_environment))
                                        <li>Official Environment</li>
                                    @endif
                                    @if (!empty($personal->prefered_benefits_casual_environment))
                                        <li>Casual Environment</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endif

                        <div class="new_block">
                            <div class="row">
                                <div class="col-lg-9">
                                    @if (!empty($personal->short_bio))
                                        @if ($never_mode == false && $personal->short_bio_status == 0)
                                            <div class="about_candidate blured_txt">
                                                <div class="title">
                                                    <h4>About</h4>
                                                </div>
                                                <div class="about_candidate_txt">
                                                    <p>
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta
                                                        atque ab veritatis sunt laboriosam, autem iusto, consequatur eum
                                                        deserunt alias ducimus velit, eos maiores! Animi et
                                                        reprehenderit
                                                        sit repudiandae libero?
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="about_candidate">
                                                <div class="title">
                                                    <h4>About @if (!$never_mode == false)
                                                            {{ $personal->name }}
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div class="about_candidate_txt">
                                                    <p>
                                                        {{ $personal->short_bio }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="skills_list_block">
                                        <div class="row">
                                            <div class="col-md-4">
                                                @php $count = 0 @endphp
                                                <div class="skills_list_inner">
                                                    <div class="title">
                                                        <h4 style="color: #7e50a7">Hard Skills</h4>
                                                    </div>

                                                    <ul class="skills_list">
                                                        @if (!empty($hard_skills))
                                                            @foreach ($hard_skills as $hard_skill)
                                                                <li>{{ $hard_skill }}</li>
                                                                @php $count++ @endphp
                                                                @if ($count === 5)
                                                                    <!-- Display "View More" button after the first five items -->
                                                                    <ul class="hidden-skills-list0"
                                                                        style="display:none;">
                                                                @endif
                                                            @endforeach
                                                    </ul>
                                                    @if ($count > 5)
                                                        <span id="viewMoreButton0" class="viewMoreButton"
                                                            onclick="toggleView(0)">CLICK HERE TO VIEW ALL</span>
                                                    @endif
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
            @if (!empty($soft_skills))
                @foreach ($soft_skills as $soft_skill)
                    <li>{{ $soft_skill }}</li>
                    @php $count++ @endphp

                    @if ($count === 5)
                        <!-- Display "View More" button after the first five items -->

                        <ul class="hidden-skills-list1" style="display:none;">
                    @endif
                @endforeach
        </ul>
        @if ($count > 5)
            <span id="viewMoreButton1" class="viewMoreButton" onclick="toggleView(1)">CLICK HERE TO VIEW ALL</span>
        @endif
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
            @if (!empty($languages))
                @foreach ($languages as $language)
                    <li>{{ $language }}</li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
</div>
</div>
<div class="work_block">
    @if (!empty($employments))
        @if ($employments->count())
            <div class="work_block_each">
                <div class="title">
                    <h4>Work Experience</h4>
                </div>
                <ul class="work_list ps-3">
                    @foreach ($employments as $employement)
                        {{-- #Task 86a22q25n issue on testing --}}
                                {{-- @if($employement->position != '') --}}
                            <li>
                                <span class="list_style"></span>
                                <div class="work_list_inner">
                                    <h6
                                        class="{{ $mode && $employement->start_year_status == 0 ? 'blured_txt' : '' }}">
                                        {{-- {{$employement->start_year}} - {{$employement->end_year}} --}}
                                        {{ $employement->start_year }}
                                        @if ($employement->start_year != '' && ($employement->end_year != '' || $employement->currently_working))
                                            -
                                        @endif
                                        {{ $employement->currently_working ? 'Present' : $employement->end_year }}
                                    </h6>
                                    @if ($employement->position != '' || $employement->company_name != '')
                                        <h5>
                                            @if ($mode && $employement->position_status == 0)
                                                <em class="blured_txt">Senior Ux/Ui Designer</em>
                                            @else
                                                {{ $employement->position }}
                                            @endif

                                            @if ($mode && $employement->company_name_status == 0)
                                                <span class="blured_txt">Senior Ux/Ui Designer</span>
                                            @else
                                                <span>{{ $employement->company_name }}</span>
                                            @endif
                                        </h5>
                                    @endif

                                    {{-- task - 86a0hfdhj --}}
                                    @if ($employement->responsibilities != '')
                                        <div class="work_list_inner_txt">
                                            <h5>Position Responsibilities</h5>
                                            {{-- task - 86a0hfdhj --}}
                                            <p
                                                class="{{ $mode && $employement->responsibilities_status == 0 ? 'blured_txt' : '' }}">
                                                {{ $employement->responsibilities }}
                                            </p>
                                        </div>
                                    @endif
                                    {{-- task - 86a0hfdhj end --}}

                                    @if ($employement->accomplishments != '')
                                        <div class="work_list_inner_txt">
                                            <h5>Position Accomplishments</h5>
                                            {{-- task - 86a0hfdhj --}}
                                            <p
                                                class="{{ $mode && $employement->accomplishments_status == 0 ? 'blured_txt' : '' }}">
                                                {{ $employement->accomplishments }}
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
    @endif
    @if (!empty($educations))
        @if ($educations->count())
            <div class="work_block_each">
                <div class="title">
                    <h4>Education & Training</h4>
                </div>
                <ul class="work_list ps-3">
                    @foreach ($educations as $education)
                        @if ($education->organization_name != '')
                            <li>
                                <span class="list_style"></span>
                                <div class="work_list_inner">
                                    <h6
                                        class="{{ $mode && $education->start_year_status == 0 ? 'blured_txt' : '' }}">
                                        {{ $education->start_year }}
                                        @if ($education->start_year != '' && ($education->end_year != '' || $education->currently_studying))
                                            -
                                        @endif
                                        {{ $education->currently_studying ? 'Present' : $education->end_year }}
                                    </h6>
                                    @if ($education->organization_name != '')
                                        <h5>
                                            @if ($mode && $education->organization_name_status == 0)
                                                <em class="blured_txt">{{ $education->organization_name }}</em>
                                            @else
                                                {{ $education->organization_name }}
                                            @endif
                                            <span
                                                class="{{ $mode && $education->program_name_status == 0 ? 'blured_txt' : '' }}">{{ $education->program_name }}</span>
                                        </h5>
                                    @endif
                                    @if ($education->course_description != '')
                                        <p
                                            class="{{ $mode && $education->course_description_status == 0 ? 'blured_txt' : '' }}">
                                            {{ $education->course_description }}
                                        </p>
                                    @endif
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
    @endif
</div>
@if (!empty($references))
    @if ($references->count())
        <div class="reference_block">
            <div class="title">
                <h4>@if(count($references)>1) References @else Reference @endif</h4>
            </div>
            @foreach ($references as $reference)
                @if ($reference->name != '')
                    <div class="reference_block_inner">

                        @if ($never_mode == false)
                            <h5 class="blured_txt">Jenefer Smith</h5>
                        @else
                            <h5>{{ ucwords($reference->name) }}</h5>
                        @endif

                        <ul class="preview_contact_list">
                            @if ($reference->phone != '')
                                <li>
                                    <span class="contact_icon"><img
                                            src="{{ asset('assets/fe/images/ylw-tell.svg') }}"
                                            alt="" /></span>
                                    <div class="contact_rgt_side">
                                        <h5>Phone No</h5>
                                        @if ($never_mode == false)
                                            <a class="blured_txt" href="tel:">phone</a>
                                        @else
                                            <a href="tel:{{ $reference->phone }}">{{ $reference->phone }}</a>
                                        @endif
                                    </div>
                                </li>
                            @endif
                            @if ($reference->email != '')
                                <li>
                                    <span class="contact_icon"><img
                                            src="{{ asset('assets/fe/images/prpl-envlp.svg') }}"
                                            alt="" /></span>
                                    <div class="contact_rgt_side">
                                        <h5>Email</h5>
                                        @if ($never_mode == false)
                                            <a class="blured_txt" href="mailto:">Email</a>
                                        @else
                                            <a href="mailto:{{ $reference->email }}">{{ $reference->email }}</a>
                                        @endif
                                    </div>
                                </li>
                            @endif
                            @if ($reference->relationship != '')
                                <li>
                                    <span class="contact_icon" style="background: rgba(0, 157, 200, 0.1)"><img
                                            src="{{ asset('assets/fe/images/hand_shake.svg') }}"
                                            alt="" /></span>
                                    <div class="contact_rgt_side">
                                        <h5>Relationship</h5>
                                        @if ($never_mode == false)
                                            <p class="blured_txt">relationship</p>
                                        @else
                                            <p>{{ $reference->relationship }}</p>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endif
</div>
<div class="col-lg-3">
    <div class="employer_note_block">
        <div class="title">
            <h5>Employer Notes</h5>
            <p>
                These notes will not be displayed to anyone outside of
                your company.
            </p>
        </div>
        <div class="add_btn_otr">
            <a data-fancybox data-src="#open55" href="javascript:;" class="add_btn">add a
                note<span>+</span></a>
        </div>

        <div class="add_note_list_otr">
            <ul class="add_note_list">
                @foreach ($notes as $note)
                    <li class="active">
                        <div class="add_note_list_item">
                            <div class="add_note_list_item_head">
                                <ul>
                                    <li>
                                        <span><img src="{{ asset('assets/fe/images/prpl_calender.svg') }}"
                                                alt="" /></span>{{ $note->created_at->format('m-d-Y') }}
                                    </li>
                                    <!-- <li>
                                                                        <span><img src="{{ asset('assets/fe/images/prpl_clock.svg') }}"
                                                                                alt="" /></span>{{ $note->created_at->format('g:i A') }}
                                                                    </li> -->
                                </ul>
                            </div>
                            <div class="add_note_list_item_content">
                                {{ $note->note }}
                            </div>
                            <div class="add_note_list_item_ftr">
                                <h6>
                                    <span><img src="{{ asset('assets/fe/images/demo_avatar.svg') }}"
                                            alt="" /></span>{{ $note->author->name }}
                                </h6>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</div>
</div>


</div>
</div>
</div>
@else
@endif
</div>


<div class="modal1">
    <div class="fancy-modal-body1" id="open55">
        <form wire:submit.prevent="saveNote()">
            <div class="modal-note">
                <div class="form-group">
                    <label>Add Note</label>
                    <textarea wire:model.lazy="note"></textarea>
                    @error('note')
                        <div class="text-danger error">

                            {{ $message }}

                        </div>
                    @enderror
                </div>
                <div class="form-submit-btn mb-0 mt-3">
                    <input type="submit" value="Add" class="submit-btn" wire:loading.remove
                        wire:target="saveNote">
                    <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="saveNote">
                </div>
            </div>
        </form>
    </div>
</div>
</div>

@push('scripts')
    <script>
        /**
            $('.blured_txt:not(.image_blur)').text('Hidden'); // task - 86a0f55cd
        **/
        let blur_str = "Hidden";
        document.addEventListener("livewire:load", (e) => {
            function initBlur() {
                $('.blured_txt:not(.image_blur)').each(function(index, el) {
                    let _str = $.trim($(this).text());
                    _str = _str.replace(/\s+/g, "");
                    let _ln = _str.length;
                    let _blr_txt = "";
                    let _idx = 0;

                    // console.log(_str, _ln);
                    for (var i = 0; i <= _ln; i++) {
                        if (_idx == (blur_str.length)) {
                            _blr_txt += ' ';
                        }
                        _idx = (_idx == (blur_str.length)) ? 0 : _idx;
                        _blr_txt += blur_str[_idx];
                        _idx++;
                    }
                    $(this).attr('data-content', _blr_txt);
                    $(this).text('Hidden'); // task - 86a0f55cd
                });
            }
            initBlur();
            /*Livewire.hook('message.processed', (el, component) => {
                console.log('fgghfsd');
                initBlur();
            });*/
        });

        window.addEventListener('close-note', event => {
            $.fancybox.close();
        })
        /*$('.blured_txt:not(.image_blur,h4 .blured_txt)').each(function(){
               var length= $(this).text().length
               // console.log('length',$(this).text());
                 var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                var result = Array.from({ length: length }, () => charset.charAt(Math.floor(Math.random() * charset.length))).join('');

               var textLength= $(this).text(result);
            })*/



        $("body").delegate(".submit-btn", "click", function(e) {
            var val = $.trim($(this).parents('.modal-note').find('textarea').val());
            if (val == "") {
                $(this).parents('.modal-note').find('.form-group').find('.text-danger').remove();
                $(this).parents('.modal-note').find('.form-group').append(
                    '<div class="text-danger error" > The note field is required.</div>');
            }
        })

        $("body").delegate(".modal-note textarea", "keypress", function(e) {
            $(this).parents('.form-group').find('.text-danger').remove();
        })
        $("body").delegate(".modal-note textarea", "keyup", function(e) {
            $(this).val($(this).val().trimStart())
        })
        $("body").delegate(".position_form textarea", "keyup", function(e) {
            $(this).val($(this).val().trimStart())
        })
        $("body").delegate(".position_form input", "keyup", function(e) {
            $(this).val($(this).val().trimStart())
        })
        $(document).ready(function() {
            $(document).on("click", function(e) {
                if (!$('.inline-table-modal').is(e.target) && $('.inline-table-modal').has(e.target)
                    .length === 0) {
                    // Click occurred outside the modal, so close it
                    $(".inline-table-modal").modal("hide");
                }
            });
        });
    </script>
    <script>
        function toggleView(id) {
            var hiddenSkillsList = document.querySelector('.hidden-skills-list' + id);
            var viewMoreButton = document.querySelector('#viewMoreButton' + id);

            if (hiddenSkillsList.style.display === 'none') {
                hiddenSkillsList.style.display = 'block';
                viewMoreButton.innerHTML = 'CLICK HERE TO VIEW LESS';
            } else {
                hiddenSkillsList.style.display = 'none';
                viewMoreButton.innerHTML = 'CLICK HERE TO VIEW ALL';

            }
        }
    </script>
@endpush
