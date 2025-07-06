<div>
    <style type="text/css">
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

        .loop-sec .nav-tabs-otr {
            margin: 0;
        }
        .bg-nav-tabs-border{
            border: 1px solid #7e50a7;
            border-radius: 35px;
            -webkit-border-radius: 35px;
            -moz-border-radius: 35px;
            -ms-border-radius: 35px;
            -o-border-radius: 35px;
        }
        .bgx-custom-font{
            width: 32% !important;
        }
    </style>
    <div class="back-clr ban-up">
        <div class="preview-sec cmn-gap pt-0" id="contentToPrint">
            <div class="preview-wrap">
                <div class="container pt-1"><br>
                    <div class="preview-upper loop-sec">
                        <div class="preview-uppr-left d-flex">
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
                            {{-- task - 86a1jhgrv --}}
                            <div class="nav-tabs-otr">
                                <div class="container">
                                    <ul class="nav nav-tabs">
                                      <li class="nav-item">
                                        <a class="nav-link {{ $mode ? 'active' : '' }} employer-nav" data-bs-toggle="tab" href="#masked" onclick="@this.set('mode', 1)">{{ 'Current View'}}</a
                                        >
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link {{ !$mode ? 'active' : '' }} candidate-nav" data-bs-toggle="tab" href="#unmasked" onclick="@this.set('mode', 0)"
                                          >{{'After Unmask View'}}</a>
                                      </li>
                                    </ul>
                                </div>
                                <div class="d-flex ps-3 pt-2">
                                <img src="{{ asset('assets/fe/images/warn.svg') }}" alt="" />
                                <p class="bgx-notify-text">{{ !$mode ? 'This is what an employer will see after you unmask your Profile for them.' : 'This is currently how your profile looks to every Purple Stairs employer.'}}
                                    </p>
                                </div>
                            </div>
                            {{-- <div class="toggle-switch-block"  style="min-width: auto;">
                                <span class="">
                                    <span class="d-none d-sm-inline">Preview </span>
                                    <span>masked </span>
                                </span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" {{ $mode ? 'checked' : '' }} wire:model.lazy="mode" />
                                </div>
                                <span class="">
                                    <span class="d-none d-sm-inline">Preview </span>
                                    <span>unmasked </span>
                                </span>
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
                        {{-- task - 86a1jhgrv <div class="preview-uppr-rgt pvr">
                            <a href="{{ route('candidates.editpersonal') }}" class="blue_btn px-3" style="min-width: auto;">
                                <span class="d-none d-sm-inline m-0">Edit Profile</span> <span class="ms-0 ms-sm-2"><img src="{{ asset('assets/fe/images/edit-icon11.svg') }}" alt="" /></span>
                            </a>
                        </div> --}}
                    </div>
                    <div class="preview-banner">
                        <div class="preview-banner-fig">
                            <figure>
                                <img src="{{ asset('assets/fe/images/candi-banner-img.png') }}" alt="" class="desktop-v" />
                                <img src="{{ asset('assets/fe/images/ban-mob-image.png') }}" alt="" class="mobile-v mobile-v-bg" />
                            </figure>
                        </div>
                        <div class="preview-banner-txt ht">
                            <div class="preview-banner-txt-left">
                                <a href="{{ route('candidates.downloadpdf') }}"  class="edge_btn dwnld-btn">Download Resume </a>
                                {{-- <a class="edge_btn" onclick="savePdf()">Download Resume </a> --}}
                            </div>
                            <div class="preview-banner-txt-rgt">
                                <a href="{{ route('candidates.editpersonal') }}" class="edit_btn11 edit-profile-btn"
                                >Edit Profile <span><img src="{{ asset('assets/fe/images/edit-icon11.svg') }}" alt="" /></span></a>
                            </div>
                        </div>
                    </div>

                    <div class="preview_banner_btm">
                        <div class="preview_banner_img_sec">
                            <div class="preview_banner_img_sec_left">

                                @if(Auth::user()->profile_photo_path)
                                <figure class="@if($mode && $never_mode == false) main_img_masked @endif">
                                {{-- 86a2c4wvd --}}
                                    {{-- @if($mode && $never_mode == false) --}}
                                    @if($mode && !$personal->profile_status)
                                        <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="masked-img masked-img-p"/>
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
                                {{-- 86a2c4wvd --}}
                                    {{-- @if($mode && $never_mode == false) --}}
                                    @if($mode && !$personal->profile_status)
                                        <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="masked-img masked-img-p"/>
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
                                                        @if($mode)
                                                        @if($mode && $never_mode == false /*&& $personal->name_status == 0*/)
                                                            @if(!empty($personal->name))
                                                                @php $length = (strlen($personal->name) > 15) ? 15 : strlen($personal->name); @endphp
                                                                <em class="blured_txt bgx-custom-font">
                                                                    {{-- task - 86a0hf9zc {{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}} --}}
                                                                    {{ (strlen($personal->name) > 15) ? substr($personal->name, 0, 15)."..." : $personal->name }}
                                                                </em>
                                                            @else

                                                                <em class="blured_txt">Candidate Name</em>
                                                            @endif
                                                        @else
                                                        {{-- Task #86a1wp720 --}}
                                                        @if(!$personal->name_status)
                                                         @php $length = (strlen($personal->name) > 15) ? 15 : strlen($personal->name); @endphp
                                                                <em class="blured_txt bgx-custom-font">
                                                                    {{-- task - 86a0hf9zc {{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}} --}}
                                                                    {{ (strlen($personal->name) > 15) ? substr($personal->name, 0, 15)."..." : $personal->name }}
                                                                </em>
                                                        @else
                                                        {{$personal->name}}
                                                        @endif

                                                        @endif
                                                        @else
                                                        {{$personal->name}}
                                                        @endif

                                                        @if($personal->linkedin_url)
                                                            {{-- @if($mode && $personal->linkedin_url_status == 0) --}}
                                                            {{-- @else
                                                            <a href="{{$personal->linkedin_url}}"><img src="{{asset('assets/fe/images/linkdin-ylw.svg')}}" alt="" /></a>
                                                            @endif --}}
                                                            @if($mode)
                                                            @if($mode && $never_mode == false)
                                                                <em class="blured_txt image_blur"><a><img src="{{asset('assets/fe/images/linkdin-ylw.svg')}}" alt="" /></a></em>
                                                            @else
                                                            {{-- Task #86a1wp720 --}}
                                                            @if(!$personal->linkedin_url_status)
                                                                 <em class="blured_txt image_blur"><a><img src="{{asset('assets/fe/images/linkdin-ylw.svg')}}" alt="" /></a></em>
                                                            @else
                                                            <a href="{{$personal->linkedin_url}}" target="_blank"><img src="{{asset('assets/fe/images/linkdin-ylw.svg')}}" alt="" /></a>
                                                            @endif
                                                            @endif
                                                            @else
                                                            <a href="{{$personal->linkedin_url}}" target="_blank"><img src="{{asset('assets/fe/images/linkdin-ylw.svg')}}" alt="" /></a>
                                                            @endif
                                                        @endif

                                                        @if($personal->additional_url)
                                                            {{-- @if($mode && $personal->additional_url_status == 0) --}}

                                                            {{-- @else
                                                            <a href="{{$personal->additional_url}}"><img src="{{asset('assets/fe/images/globe-ylw.svg')}}" alt="" /></a>
                                                            @endif --}}
                                                            @if($mode)
                                                            @if($mode && $never_mode == false)
                                                                <em class="blured_txt image_blur"><a><img src="{{asset('assets/fe/images/globe-ylw.svg')}}" alt="" /></a></em>
                                                            @else
                                                            {{-- Task #86a1wp720 --}}
                                                            @if(!$personal->additional_url_status)
                                                            <em class="blured_txt image_blur"><a><img src="{{asset('assets/fe/images/globe-ylw.svg')}}" alt="" /></a></em>
                                                            @else
                                                                <a href="{{$personal->additional_url}}" target="_blank"><img src="{{asset('assets/fe/images/globe-ylw.svg')}}" alt="" /></a>
                                                           @endif

                                                            @endif
                                                            @else
                                                            <a href="{{$personal->additional_url}}" target="_blank"><img src="{{asset('assets/fe/images/globe-ylw.svg')}}" alt="" /></a>
                                                            @endif
                                                        @endif
                                                    </h4>
                                                    <h5>
                                                        Current Position:
                                                        @if(!empty($personal->current_title))
                                                        <span class="{{ ($mode && $personal->current_title_status == 0) ? 'blured_txt' : '' }}">{{ $personal->current_title }}</span>
                                                        @endif
                                                    </h5>
                                                </div>
                                                <div class="preview_contact_sec mobile-v">
                                                    <ul class="preview_contact_list wrpn mb-3">
                                                        <li>
                                                            <span class="contact_icon"><img src="{{asset('assets/fe/images/ylw-tell.svg')}}" alt="" /></span>
                                                            <div class="contact_rgt_side">
                                                                <h5>Phone No</h5>
                                                                @if($mode)
                                                                @if($never_mode == false && $mode)
                                                                <a class="blured_txt" href="tel:">phone number
                                                                </a>
                                                                @else

                                                                {{-- Task #86a1wp720 --}}
                                                                @if(!$personal->phone_status)
                                                                <a class="blured_txt" href="tel:">phone number
                                                                    </a>
                                                                @else
                                                                <a class="" href="tel:{{$personal->phone}}">{{$personal->phone}}
                                                                    </a>
                                                                @endif

                                                                @endif
                                                                @else
                                                                <a class="" href="tel:{{$personal->phone}}">{{$personal->phone}}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <span class="contact_icon"><img src="{{asset('assets/fe/images/prpl-envlp.svg')}}" alt="" /></span>
                                                            <div class="contact_rgt_side">
                                                                <h5>Email</h5>
                                                                @if($mode)
                                                                @if($never_mode == false && $mode)
                                                                    <a class="blured_txt" href="mailto:">email address
                                                                    </a>
                                                                @else
                                                                    @if(!empty($personal->email))
                                                                    <a href="mailto:{{ $personal->email }}">{{ $personal->email }}</a>
                                                                    @else
                                                                    <a href="mailto:info@purplestair.com">info@purplestair.com</a>
                                                                    @endif
                                                                @endif
                                                                @else
                                                                <a href="mailto:{{ $personal->email }}">{{ $personal->email }}</a>
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
                                                            @if($mode)
                                                            @if($mode && $never_mode == false)
                                                            <a class="blured_txt" href="tel:">phone Number</a>
                                                            @else
                                                            {{-- Task #86a1wp720 --}}
                                                                @if(!$personal->phone_status)
                                                                <a class="blured_txt" href="tel:">phone number
                                                                    </a>
                                                                @else
                                                                <a class="" href="tel:{{$personal->phone}}">{{$personal->phone}}
                                                                    </a>
                                                                @endif
                                                            @endif
                                                            @else
                                                             <a class="" href="tel:{{$personal->phone}}">{{$personal->phone}}</a>
                                                            @endif
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <span class="contact_icon"><img src="{{asset('assets/fe/images/prpl-envlp.svg')}}" alt="" /></span>
                                                        <div class="contact_rgt_side">
                                                            <h5>Email</h5>
                                                        @if($mode)
                                                            @if($mode && $never_mode == false)
                                                            <a class="blured_txt" href="mailto:">Email Addresses</a>
                                                            @else

                                                            {{-- Task #86a1wp720 --}}
                                                                @if(!$personal->email_status)
                                                                <a class="blured_txt" href="mailto:">Email Addresses</a>
                                                                @else
                                                                <a href="mailto:{{$personal->email}}">{{$personal->email}}</a>
                                                                @endif

                                                            @endif
                                                        @else
                                                            <a href="mailto:{{$personal->email}}">{{$personal->email}}</a>
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
                                            @if($mode)
                                                @if($mode && $never_mode == false/* && $personal->zip_code_status == 0*/)
                                                    <span class="blured_txt"> {{$personal->address}},&nbsp;{{$personal->state_abbr}}</span>
                                                @else
                                                    {{$personal->address}},&nbsp;{{$personal->state_abbr}}
                                                @endif
                                                {{-- Task #86a21dpn9 --}}
                                                @else
                                                 {{$personal->address}},&nbsp;{{$personal->state_abbr}}
                                                @endif
                                            @else
                                            @if($mode)
                                                @if($personal->country_name_status == 0)
                                                    <span class="blured_txt"> {{$personal->country}}</span>
                                                @else
                                                    {{$personal->country}}
                                                @endif
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
                                        <p>{{ $personal->salary_range }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="preview_banner_img_list_inner">
                                        <h6>Compensation:</h6>
                                        @if ($personal->compensation_salary)
                                        <p class="m-0">Salary</p>
                                        @endif
                                        @if ($personal->compensation_hourly)
                                        <p class="m-0">Hourly</p>
                                        @endif
                                        @if ($personal->compensation_comission_based)
                                        <p class="m-0">Comission Based</p>
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div class="preview_banner_img_list_inner">
                                        <h6>Schedule:</h6>
                                        @if ($personal->schedule_full_time)
                                        <p>Full Time</p>
                                        @endif
                                        @if ($personal->schedule_part_time)
                                        <p>Part Time</p>
                                        @endif
                                        @if ($personal->schedule_no_preference)
                                        <p>No Preference</p>
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div class="preview_banner_img_list_inner">
                                        <h6>Work Setting:</h6>
                                        <ul class="tick_list">
                                            @if ($personal->work_environment_remote)
                                            <li>
                                                <span><img src="{{ asset('assets/fe/images/sky_blue.svg') }}" alt="" /></span>Remote
                                            </li>
                                            @endif
                                            @if ($personal->work_environment_hybrid)
                                            <li>
                                                <span><img src="{{ asset('assets/fe/images/sky_blue.svg') }}" alt="" /></span>Hybrid
                                            </li>
                                            @endif
                                            @if ($personal->work_environment_in_office)
                                            <li>
                                                <span><img src="{{ asset('assets/fe/images/sky_blue.svg') }}" alt="" /></span>In Office
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if($personal->short_bio)
                        @if($mode)
                            {{-- @if ($never_mode == false && $mode && $personal->short_bio_status == 0) --}}
                            @if (empty($personal->short_bio_status))
                                <div class="about_candidate my-5">
                                    <div class="title">
                                        <h4>About <span class="@if(!$personal->name_status) blured_txt @endif">{{ Auth::user()->name }}</span></h4>
                                    </div>
                                    <div class="about_candidate_txt blured_txt">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta atque ab
                                            veritatis sunt laboriosam, autem iusto, consequatur eum deserunt alias ducimus
                                            velit, eos maiores! Animi et reprehenderit sit repudiandae libero?
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="about_candidate my-5">
                                    <div class="title">
                                        <h4>About <span class="">{{ Auth::user()->name }}</span></h4>
                                    </div>
                                    <div class="about_candidate_txt ">
                                        <p>
                                            {{ $personal->short_bio }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @else
                             <div class="about_candidate my-5">
                                    <div class="title">
                                        <h4>About <span class="">{{ Auth::user()->name }}</span></h4>
                                    </div>
                                    <div class="about_candidate_txt ">
                                        <p>
                                            {{ $personal->short_bio }}
                                        </p>
                                    </div>
                                </div>
                        @endif
                    @endif




                    <div class="work_block">

                        @if($employments->count())
                        <div class="work_block_each">
                            <div class="title">
                                <h4>Work Experience</h4>
                            </div>
                            <ul class="work_list  ps-3">
                                @foreach ($employments as $employement)
                                {{-- #Task 86a22q25n issue on testing --}}
                                    {{-- @if($employement->position != '') --}}
                                    <li>
                                        <span class="list_style"></span>
                                        <div class="work_list_inner">
                                            <h6 class="{{ ($mode && $employement->start_year_status == 0) ? 'blured_txt' : '' }}">
                                                {{ $employement->start_year }}
                                                @if ($employement->start_year != '' && ($employement->end_year != '' || $employement->currently_working))
                                                -
                                                @endif
                                                {{ $employement->currently_working ? 'Present' : $employement->end_year }}
                                            </h6>
                                            @if ($employement->position != '' || $employement->company_name != '')
                                            <h5>
                                                {{-- task - 86a0hxdp7 --}}
                                                @if ($mode && $employement->position_status == 0)
                                                <em class="blured_txt">Senior Ux/Ui Designer</em>
                                                @else
                                                {{ $employement->position }}
                                                @endif

                                                {{-- task - 86a0hxdp7 --}}
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
                                                    {{$employement->responsibilities}}
                                                </p>
                                            </div>
                                            @endif
                                            {{-- task - 86a0hfdhj end --}}

                                            @if ($employement->accomplishments != '')
                                            <div class="work_list_inner_txt">
                                                {{-- task - 86a0hfdhj --}}
                                                <h5>Position Accomplishments</h5>
                                                <p class="{{ ($mode && $employement->accomplishments_status == 0) ? 'blured_txt' : '' }}">
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

                        @if($educations->count())
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
                                            <h6 class="{{ ($mode && $education->start_year_status == 0) ? 'blured_txt' : '' }}">{{$education->start_year}}
                                                @if($education->start_year != '' && ($education->end_year != '' || $education->currently_studying)) - @endif
                                                {{$education->currently_studying ? 'Present' : $education->end_year}}
                                            </h6>
                                            @if ($education->organization_name != '')
                                            <h5>
                                                @if($mode && $education->organization_name_status == 0)
                                                <em class="blured_txt">{{ $education->organization_name }}</em>
                                                @else
                                                {{ $education->organization_name }}
                                                @endif
                                                <span class="{{ $mode && $education->program_name_status == 0 ? 'blured_txt' : '' }}">{{ $education->program_name }}</span>
                                            </h5>
                                            @endif
                                            @if ($education->course_description != '')
                                            <p class="{{ ($mode && $education->course_description_status == 0) ? 'blured_txt' : '' }}">
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
                    </div>




                    <div class="skills_list_block p-0">
                        <div class="row">
                            <div class="col-md-4">
                                @php $count = 0 @endphp
                                <div class="skills_list_inner">
                                    <div class="title">
                                        <h4 style="color: #7e50a7">Hard Skills</h4>
                                    </div>

                                    <ul class="skills_list">
                                        @foreach ($hard_skills as $hard_skill)
                                        <li>{{ $hard_skill }}</li>
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
                                        @foreach ($soft_skills as $soft_skill)
                                            <li>{{ $soft_skill }}</li>
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
                                        @foreach ($languages as $language)
                                        <li>{{ $language }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($personal->prefered_benefits_insurance_benefits ||$personal->prefered_benefits_padi_holidays || $personal->prefered_benefits_paid_vacation_days ||$personal->prefered_benefits_professional_environment || $personal->prefered_benefits_casual_environment)
                    <div class="preffered_block my-5">
                        <div class="preffered_block_left">
                            <h4>Preferred Benefits:</h4>
                        </div>
                        <div class="preffered_block_right">
                            <ul>
                                @if ($personal->prefered_benefits_insurance_benefits)
                                <li>Insurance Benefits</li>
                                @endif
                                @if ($personal->prefered_benefits_padi_holidays)
                                <li>Paid Holidays</li>
                                @endif
                                @if ($personal->prefered_benefits_paid_vacation_days)
                                <li>Paid Vacation Days</li>
                                @endif
                                @if ($personal->prefered_benefits_professional_environment)
                                <li>Official Environment</li>
                                @endif
                                @if ($personal->prefered_benefits_casual_environment)
                                <li>Casual Environment</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endif


                    @if($references->count())
                    <div class="reference_block ">
                        <div class="title">
                            <h4>@if(count($references)>1) References @else Reference @endif</h4>
                        </div>
                        @foreach ($references as $reference)
                        <div class="reference_block_inner">

                            @if ($reference->name != '')
                            {{-- 86a2c4xx2 --}}
                            {{-- @if ($never_mode == false && $mode) --}}
                            @if($mode)
                            @if (empty($reference->name_status))
                            <h5 class="blured_txt">Jenefer Smith</h5>
                            @else
                            <h5>{{ $reference->name }}</h5>
                            @endif
                            @else
                            <h5>{{ $reference->name }}</h5>
                            @endif
                            @endif
                            <ul class="preview_contact_list">
                                @if ($reference->phone != '')
                                <li>
                                    <span class="contact_icon"><img src="{{ asset('assets/fe/images/ylw-tell.svg') }}" alt="" /></span>
                                    <div class="contact_rgt_side">
                                        <h5>Phone No</h5>
                                        {{-- 86a2c4xx2 --}}
                                        {{-- @if ($never_mode == false && $mode) --}}
                                        @if($mode)
                                        @if (empty($reference->phone_status))
                                        <a class="blured_txt" href="tel:">phone</a>
                                        @else
                                        <a href="tel:{{ $reference->phone }}">{{ $reference->phone }}</a>
                                        @endif
                                        @else
                                        <a href="tel:{{ $reference->phone }}">{{ $reference->phone }}</a>
                                        @endif
                                    </div>
                                </li>
                                @endif
                                @if ($reference->email != '')
                                <li>
                                    <span class="contact_icon"><img src="{{ asset('assets/fe/images/prpl-envlp.svg') }}" alt="" /></span>
                                    <div class="contact_rgt_side">
                                        <h5>Email</h5>
                                        {{-- 86a2c4xx2 --}}
                                        {{-- @if ($never_mode == false && $mode) --}}
                                        @if($mode)
                                        @if (empty($reference->email_status))
                                        <a class="blured_txt" href="mailto:">Email address</a>
                                        @else
                                        <a href="mailto:{{ $reference->email }}">{{ $reference->email }}</a>
                                        @endif
                                        @else
                                        <a href="mailto:{{ $reference->email }}">{{ $reference->email }}</a>
                                        @endif
                                    </div>
                                </li>
                                @endif
                                @if ($reference->relationship != '')
                                <li>
                                    <span class="contact_icon" style="background: rgba(0, 157, 200, 0.1)"><img src="{{ asset('assets/fe/images/hand_shake.svg') }}" alt="" /></span>
                                    <div class="contact_rgt_side">
                                        <h5>Relationship</h5>
                                       {{-- 86a2c4xx2 --}}
                                        {{-- @if ($never_mode == false && $mode) --}}
                                        @if($mode)
                                        @if (empty($reference->relationship_status))
                                        <p class="blured_txt">relationship</p>
                                        @else
                                        <p>{{ $reference->relationship }}</p>
                                        @endif
                                        @else
                                         <p>{{ $reference->relationship }}</p>
                                        @endif
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width,
                canvas_image_height);


            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, canvas_image_height + 100);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4),
                    canvas_image_width, canvas_image_height);
            }

            pdf.save("curriculum-vitae.pdf");
        });
    }
</script>
<script>
    let blur_str = "Hidden";
    /*$('.blured_txt:not(.image_blur)').each(function(index, el) {
        let _str = $.trim($(this).text());
        let _ln = _str.length;
        let _blr_txt = ""; let _idx = 0;
        for (var i = 0; i <= _ln; i++) {
            if(_idx == (blur_str.length)) {
                _blr_txt += ' ';
            }
            _idx = (_idx == (blur_str.length)) ? 0 : _idx;
            _blr_txt += blur_str[_idx];
            _idx++;
        }
        $(this).attr('data-content', _blr_txt);
        $(this).text('Hidden');  // task - 86a0f55cd
    });*/

    // $('.blured_txt:not(.image_blur)').text('Hidden'); // task - 86a0f55cd

    function simpleEncrypt(text) {
        // Simple substitution cipher
        const key = {
        'a': 'x',
        'b': 'y',
        'c': 'z',
        // Add more substitutions as needed
        };

        const encryptedText = text.split('').map(char => key[char] || char).join('');
        return encryptedText;
    }
    document.addEventListener("livewire:load", (e) => {
        {{-- 86a2p168x --}}
        function initBlur() {
            $('.blured_txt:not(.image_blur)').each(function() {
                var text = $(this).text();
                var result = "";
                for (var i = 0; i < text.length; i++) {
                    var char = text.charAt(i);
                if (char.match(/[a-zA-Z0-9]/)) {
                    var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    char = charset.charAt(Math.floor(Math.random() * charset.length));
                }
                    result += char;
                }
                    $(this).text(result);
            });
        }

        initBlur();
        Livewire.hook('message.processed', (el, component) => {

            initBlur();
        });
        setTimeout(() => {
            if($('.switch_1').prop('checked') === false) {
                @this.set('mode', false);
            }
        }, 500);
    });

    $(".sub2").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/requests')
    })
    $(".dwnld-btn").click(function(e) {
        $(this).text('Downloading...');
        setTimeout(function () {
            $(".dwnld-btn").text('Download Resume');
        }, 5000); // Adjust the delay as needed.
    })


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
