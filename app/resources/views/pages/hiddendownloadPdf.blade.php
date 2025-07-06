<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="{{ asset('assets/fe/css/bootstrap.min.css') }}" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/fe/pdf-style.css') }}" />
    <style>
        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('fonts/Poppins-Regular.ttf') format("truetype");
        }

        {{-- @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('fonts/Poppins-Bold.ttf') format("truetype");
        }
        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('Poppins-Medium.ttf') format("truetype");
        }
        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('Poppins-SemiBold.ttf') format("truetype");
        }
        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('Poppins-Black.ttf') format("truetype");
        }
        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('Poppins-ExtraBold.ttf') format("truetype");
        }
        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('Poppins-ExtraLight.ttf') format("truetype");
        }
        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('Poppins-Light.ttf') format("truetype");
        } --}} body {
            font-family: "Poppins" !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            font-family: "Poppins" !important;
        }

        .no-page-break {
            page-break-before: always;
        }

        @page {
            margin: 0mm;
            /* Set custom margins in millimeters */
        }

        #contentToPrint {
            font-family: "Poppins" !important;
            background-color: white !important;
        }



        .main-resume-head {
            margin-bottom: 0px;
        }

        .defination_list ul li {
            font-size: 10px;
            margin: 2px 0px;
        }

        .work_list_inner_txt {
            padding: 10px 14px;
        }

        .work_list_inner_txt p {
            font-size: 10px;
        }

        .work_list_inner p {
            font-size: 10px;
            padding-left: 4px;
        }

        .skills_list li {
            font-size: 10px;
            margin: 3px 0px;
            padding: 3px 6px;

        }

        .sub-heading-resume-name {
            margin-bottom: 0px;
        }

        .work_list_inner {
            border-left: 1px solid #7e50a7;
        }

        ul.work_list li .work_list_inner:last-child {
            border-left: 1px solid #7e50a7;
        }



    </style>
</head>


<div id="contentToPrint" style="width:700px;padding:20px; margin:0px auto; background-color: white;">
    <div class="preview-sec">
        <div class="preview-wrap">
            <div class="container-">
                <div class="preview-banner">
                    <div class="preview-banner-fig">
                        <figure>
                            <img src="{{ asset('assets/fe/images/candi-banner-img.png') }}" alt=""
                                class="" style="width: 100%;height: 100px; object-fit: contain;" />
                        </figure>
                    </div>
                </div>
                <div class="" style="padding: 0 15px;">
                    <div class="preview_banner_btm">
                        <div class="preview_banner_img_sec" style="margin-bottom: 10px;">
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 25%">
                                        <div class="preview_banner_img_sec_left">
                                            <figure class="@if (empty($user->profile_photo_path)) main_img_masked @endif"
                                                style="z-index:9;">
                                                {{-- @if (!empty($user->profile_photo_path))
                                                    <img src="{{ asset($user->profile_photo_path) }}"
                                                        alt="" />
                                                @else --}}
                                                    <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                        alt="" class="masked-img" />
                                                {{-- @endif --}}
                                            </figure>
                                        </div>
                                    </td>
                                    <td style="width: 75%">
                                        <div class="preview_banner_img_sec_rgt">
                                            <div class="preview_banner_img_sec_rgt_wrapper">
                                                <div class="defination-sec">
                                                    <div class="title">
                                                        <h5 class="main-resume-head">
                                                            @if ($mode)
                                                                @if (!empty($personal->name))
                                                                    <em
                                                                        class="blured_txt"><img src="{{ asset('/assets/be/images/blur1.png') }}"></em>
                                                                @else
                                                                    <em class="blured_txt"><img src="{{ asset('/assets/be/images/blur1.png') }}"></em>
                                                                @endif
                                                            @else
                                                                {{ $personal->name }}
                                                            @endif

                                                            </h5>

                                                    </div>
                                                    @if(!empty($personal->current_title))
                                                    <div class="blured_txt">
                                                        <p>
                                                            Current Position:
                                                            <span><img src="{{ asset('/assets/be/images/blur1.png') }}"></span>
                                                        </p>

                                                    </div>
                                                    @endif

                                                    <div class="">
                                                        <div class="preview_contact_sec">
                                                            <table style="width: 100%;margin-top: 5px;">
                                                                <tr>
                                                                    <td>
                                                                        <div>
                                                                            <table style="width: 100%">
                                                                                <tr>
                                                                                    <td style="width: 44px;">
                                                                                        <span class="contact_icon"
                                                                                            style="background-color: rgb(255 174 26 / 20%);height: 40px;width: 40px;border-radius:50%;display:block">
                                                                                            <i class="fa fa-phone"
                                                                                                aria-hidden="true"
                                                                                                style="margin: 9px;color:#FFAE19;font-size:24px;  "></i>
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="contact_rgt_side ">
                                                                                            <h5>Phone No</h5>
                                                                                            @if ($mode)
                                                                                                <a class="blured_txt"
                                                                                                    href="tel:"><img src="{{ asset('/assets/be/images/blur1.png') }}"></a>
                                                                                            @else
                                                                                                <a class="blured_txt" href="tel:{{ $personal->phone }}"
                                                                                                    style="word-break: break-all;">{{ $personal->phone }}</a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div>
                                                                            <table style="width: 100%">
                                                                                <tr>
                                                                                    <td style="width: 44px;">

                                                                                        <span class="contact_icon"
                                                                                            style="background-color: rgba(126, 80, 167, 0.1);height: 40px;width: 40px;border-radius:50%;display:block">
                                                                                            <i class="fa fa-envelope"
                                                                                                aria-hidden="true"
                                                                                                style="margin: 8px;color:#7E50A7;font-size:24px;  "></i>
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="contact_rgt_side">
                                                                                            <h5>Email</h5>
                                                                                            @if ($mode)
                                                                                                <a class="blured_txt"
                                                                                                    href="mailto:"><img src="{{ asset('/assets/be/images/blur1.png') }}"></a>
                                                                                            @else
                                                                                                <a class="blured_txt"
                                                                                                    href="mailto:{{ $personal->email }}">
                                                                                                    <p>{{ $personal->email }}
                                                                                                    </p>
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            @if(!empty($personal->additional_url) || !empty($personal->linkedin_url) )
                                                            <table style="width: 100%;margin-top: 5px;">
                                                                <tr>
                                                                @if ($personal->additional_url)
                                                                    <td  class="td-social-" style="width:37%;">
                                                                        <div>
                                                                            <table style="width: 100%">
                                                                                <tr>
                                                                                    <td style="width: 10px;">
                                                                                        <span class="contact_icon"
                                                                                            style="background-color: #c3e1fe;height: 40px;width: 40px;border-radius:50%;display:block">

                                                                                        <i class="fa fa-globe"
                                                                                                aria-hidden="true"
                                                                                                style="margin: 9px;color:#00407C;font-size:24px;  "></i>
                                                                                        </span>

                                                                                    </td>
                                                                                    <td class="">
                                                                                        <div class="contact_rgt_side blured_txt" style="margin-left:5px;">
                                                                                                                                                                                        @php
                                                                                            $valueAddintionalUrl=$personal->additional_url;
                                                                                            if (strpos($valueAddintionalUrl, 'http://') === 0) {
                                                                                                $valueAddintionalUrl = substr($valueAddintionalUrl, 7);
                                                                                            } elseif (strpos($valueAddintionalUrl, 'https://') === 0) {
                                                                                                $valueAddintionalUrl = substr($valueAddintionalUrl, 8);
                                                                                            }

                                                                                            @endphp
                                                                                            <a href="{{ $personal->additional_url }}" class="blured_txt" target="_blank" style="font-size:13px;word-break: break-word;"><img src="{{ asset('/assets/be/images/blur1.png') }}"></a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                    @endif
                                                                @if ($personal->linkedin_url)
                                                                    <td>
                                                                        <div>
                                                                            <table style="width: 100%">
                                                                                <tr>
                                                                                    <td style="width: 10px;">
                                                                                        <span class="contact_icon"
                                                                                            style="background-color: #c1ebfa;height: 40px;width: 40px;border-radius:50%;display:block">

                                                                                                <i class="fa fa-linkedin"
                                                                                                aria-hidden="true"
                                                                                                style="margin: 9px;color:#029CC8;font-size:24px;  "></i>
                                                                                        </span>

                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="contact_rgt_side blured_txt" style="margin-left:5px;">
                                                                                            @php
                                                                                            $valueLinkedIn=$personal->linkedin_url;
                                                                                            if (strpos($valueLinkedIn, 'http://') === 0) {
                                                                                                $valueLinkedIn = substr($valueLinkedIn, 7);
                                                                                            } elseif (strpos($valueLinkedIn, 'https://') === 0) {
                                                                                                $valueLinkedIn = substr($valueLinkedIn, 8);
                                                                                            }

                                                                                            @endphp
                                                                                            <a href="{{ $personal->linkedin_url }}" class="blured_txt" target="_blank" style="font-size:13px;word-break: break-word;"><img src="{{ asset('/assets/be/images/blur1.png') }}"></a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                    @endif

                                                                </tr>
                                                            </table>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>


                        </div>


                        <table style="width: 100%">
                            <tr>
                            @if(!empty($industries))
                                <td style="width: 50%;padding: 5px; vertical-align: top;">
                                    <div class="defination_list">
                                        <h5 class="main-resume-head">Industries:</h5>
                                        <ul style="margin: 5px 0px;">
                                            @foreach ($industries as $industry)
                                                <li>{{ $industry }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                @endif
                                @if(!empty($interests))
                                <td style="width: 50%;padding: 5px; vertical-align: top;">
                                    <div class="defination_list">
                                        <h5 class="main-resume-head">Area of Interest:</h5>
                                        <ul style="margin: 5px 0px 5px -4px">
                                            @foreach ($interests as $interest)
                                                <li>{{ $interest }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                @endif
                            </tr>
                        </table>
                        <div class="preview_banner_img_btm">
                            <ul class="preview_banner_img_list">
                                <table style="width: 100%;">
                                    <tr>
                                        <td
                                            style="width: 20%;border-right: 1px solid #0000001a;padding: 5px;vertical-align: top;">
                                            <li>
                                                <div class="preview_banner_img_list_inner">
                                                    <h6>Location:</h6>
                                                    <p class="blured_txt" ><img src="{{ asset('/assets/be/images/blur1.png') }}"></p>
                                                </div>
                                            </li>
                                        </td>
                                        <td
                                            style="width: 20%;border-right: 1px solid #0000001a;padding: 5px;vertical-align: top;">
                                            <li>
                                                <div class="preview_banner_img_list_inner">
                                                    <h6>Asking Salary:</h6>
                                                    <p>{{ $personal->salary_range }}</p>
                                                </div>
                                            </li>
                                        </td>
                                        <td
                                            style="width: 20%;border-right: 1px solid #0000001a;padding: 5px;vertical-align: top;">
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

                                        </td>
                                        <td
                                            style="width: 20%;border-right: 1px solid #0000001a;padding: 5px;vertical-align: top;">
                                            <li>
                                                <div class="preview_banner_img_list_inner">
                                                    <h6>Schedule: &nbsp;</h6>
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
                                        </td>
                                        <td style="width: 20%;padding: 5px;vertical-align: top;">
                                            <li>
                                                <div class="preview_banner_img_list_inner">
                                                    <h6>Work Setting:</h6>
                                                    <ul class="tick_list">
                                                        @if ($personal->work_environment_remote)
                                                            <li style="display: inline-block;">
                                                                <span><img
                                                                        src="{{ asset('assets/fe/images/sky_blue.png') }}"
                                                                        alt="" /></span>Remote
                                                            </li>
                                                        @endif
                                                        @if ($personal->work_environment_hybrid)
                                                            <li style="display: inline-block;">
                                                                <span><img
                                                                        src="{{ asset('assets/fe/images/sky_blue.png') }}"
                                                                        alt="" /></span>Hybrid
                                                            </li>
                                                        @endif
                                                        @if ($personal->work_environment_in_office)
                                                            <li style="display: inline-block;">
                                                                <span><img
                                                                        src="{{ asset('assets/fe/images/sky_blue.png') }}"
                                                                        alt="" /></span>In Office
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </li>
                                        </td>
                                    </tr>
                                </table>
                            </ul>
                        </div>
                    </div>


                    @if (!empty($personal->short_bio))
                        @if ($mode /*&& $personal->short_bio_status == 0*/)
                            <div class="about_candidate blured_txt">
                                <div class="title">
                                    <h4 class="main-resume-head">About</h4>
                                </div>
                                <div class="about_candidate_txt">
                                    <p>
                                        <img src="{{ asset('/assets/be/images/blur3.png') }}">
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="about_candidate" style="margin-bottom: 20px;">
                                <div class="title">
                                    <h4 class="main-resume-head">About {{ $user->name }}</h4>
                                </div>
                                <div class="about_candidate_txt">
                                    <p>
                                        {{ $personal->short_bio }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endif

                    <div class="work_block mt-5">
                        @if(count($employments) >0 && !empty($employments))
                        <div class="work_block_each">
                            <div class="title" style="margin-bottom: 10px;">
                                <h5 class="main-resume-head">Work Experience</h5>
                            </div>
                            <ul class="work_list">
                                @foreach ($employments as $employement)
                                    @if ($employement->position != '')
                                        <li>
                                            <table style="-webkit-border-vertical-spacing: 0;padding-left: 10px;">
                                                <tr>
                                                    <td style="vertical-align: baseline;">
                                                        <span class="list_style"
                                                            style="margin-top: -2px;width: 24px;height: 24px;  border-radius: 100%;background: rgb(126 80 167 / 20%);display: block;text-align: center;padding: 0px;">
                                                            <span class=""
                                                                style="background: #7e50a7;height: 10px;width: 10px;display: inline-block;border-radius: 50%;margin: 7px auto 0;"></span>
                                                        </span>
                                                    </td>
                                                    <td style="vertical-align: baseline;">
                                                        <div class="work_list_inner" {{-- style="margin-bottom: 10px;" --}}
                                                            style="margin-left: -17px;padding-left: 22px;margin-top: -5px;">
                                                            <table style="width: 100%;">
                                                                <tr>
                                                                    <td>
                                                                        @if ($employement->position != '')
                                                                            <h5>
                                                                                <span class="blured_txt"><img src="{{ asset('/assets/be/images/blur1.png') }}"></span>

                                                                            </h5>
                                                                            <span class="blured_txt"
                                                                                style="color: black;font-weight: 400;font-size: 10px;">
                                                                                @if ($mode)
                                                                                    <em class="blured_txt"><img src="{{ asset('/assets/be/images/blur1.png') }}"></em>
                                                                                @else
                                                                                    {{ $employement->position }}
                                                                                @endif
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td style="vertical-align: baseline;padding-top:5px;">
                                                                        <span class="blured_txt"
                                                                            style=" font-weight: 400; ;font-size: 12px;    margin: 0;"><img src="{{ asset('/assets/be/images/blur1.png') }}">
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            {{-- task - 86a0hfdhj --}}
                                                            @if ($employement->responsibilities != '')
                                                                <div class="work_list_inner_txt">
                                                                    <h6 class="main-resume-head">Position
                                                                        Responsibilities</h6>
                                                                    {{-- task - 86a0hfdhj --}}
                                                                    <p class="blured_txt">
                                                                        <img src="{{ asset('/assets/be/images/blur2.png') }}">
                                                                    </p>
                                                                </div>
                                                            @endif
                                                            {{-- task - 86a0hfdhj end --}}

                                                            @if ($employement->accomplishments != '')
                                                                <div class="work_list_inner_txt">
                                                                    <h6 class="main-resume-head">Position
                                                                        Accomplishments</h6>
                                                                    <p class="blured_txt">
                                                                        <img src="{{ asset('/assets/be/images/blur2.png') }}">
                                                                    </p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="work_block_each" style="margin-top: 10px;">
                         @if(count($educations)>0 && !empty($educations))
                            <div class="title" style="margin-bottom: 10px;">
                                <h5 class="main-resume-head">Education & Training</h5>
                            </div>
                            <ul class="work_list">
                                @foreach ($educations as $education)
                                    @if ($education->organization_name != '')
                                        <li>

                                            <table style="-webkit-border-vertical-spacing: 0;padding-left: 10px;">
                                                <tr>
                                                    <td style="vertical-align: baseline;">
                                                        <span class="list_style"
                                                            style="margin-top: -2px;width: 24px;height: 24px;  border-radius: 100%;background: rgb(126 80 167 / 20%);display: block;text-align: center;padding: 0px;">
                                                            <span class=""
                                                                style="background: #7e50a7;height: 10px;width: 10px;display: inline-block;border-radius: 50%;margin: 7px auto 0;"></span>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="work_list_inner"
                                                            style="margin-left: -17px;padding-left: 22px;margin-top: 5px;">
                                                            <table style="width: 100%;">
                                                                <tr>
                                                                    <td style="">
                                                                        @if ($education->organization_name != '')
                                                                            <h5 style="margin-bottom: 0;">
                                                                                <span class="blured_txt"
                                                                                    style="color: black;font-weight: 400;font-size: 10px"><img src="{{ asset('/assets/be/images/blur1.png') }}"></span>

                                                                                <span class="" style="color: black;font-weight: 400;font-size: 10px">
                                                                                    <img src="{{ asset('/assets/be/images/blur1.png') }}"></span>
                                                                                </span>
                                                                            </h5>
                                                                        @endif
                                                                    </td>
                                                                    <td style="vertical-align: baseline;padding-top:5px;">
                                                                        <span class="blured_txt"
                                                                            style=" font-weight: 400; font-size: 12px;    margin: 0;"><img src="{{ asset('/assets/be/images/blur1.png') }}">
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            @if ($education->course_description != '')
                                                                <p class="blured_txt">
                                                                    <img src="{{ asset('/assets/be/images/blur2.png') }}">
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>




                    <div class="skills_list_block pt-0 pb-0">
                        <table>
                            <tr>
                                <td style="width:33.33%;vertical-align:top">
                                    <div class="skills_list_inner">
                                        <div class="title">
                                            <h5 class="sub-heading-resume">Hard Skills</h4>
                                        </div>

                                        <ul class="skills_list">
                                            @foreach ($hard_skills as $hard_skill)
                                                <li>{{ $hard_skill }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                <td style="width:33.33%;vertical-align:top">
                                    <div class="skills_list_inner">
                                        <div class="title">
                                            <h4 class="sub-heading-resume">Soft Skills</h4>
                                        </div>

                                        <ul class="skills_list">
                                            @foreach ($soft_skills as $soft_skill)
                                                <li style="background-color: rgba(0, 157, 200, 0.2);">
                                                    {{ $soft_skill }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                                <td style="width:33.33%;vertical-align:top">
                                    <div class="skills_list_inner">
                                        <div class="title">
                                            <h4 class="sub-heading-resume">Languages</h4>
                                        </div>

                                        <ul class="skills_list">
                                            @foreach ($languages as $language)
                                                <li style="background-color: rgba(45, 107, 165, 0.2);">
                                                    {{ $language }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    {{-- task - 86a2vxjff --}}
                    @if ($personal->prefered_benefits_insurance_benefits ||$personal->prefered_benefits_padi_holidays || $personal->prefered_benefits_paid_vacation_days|| $personal->prefered_benefits_professional_environment || $personal->prefered_benefits_casual_environment)
                    <div class="preffered_block">
                        <div class="preffered_block_left" style="padding-right: 15px">
                            <h4 class="main-resume-head-box">Preferred Benefits:</h4>
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

@if(count($references)>0 && !empty($references))
                    <div class="reference_block">
                        <div class="title">
                            <h4 class="sub-heading-resume">@if(count($references)>1) References @else Reference @endif</h4>
                        </div>
                        @foreach ($references as $reference)
                            <div class="reference_block_inner">
                                @if ($reference->name != '')
                                    @if ($mode)
                                        <h4 class="blured_txt"><img src="{{ asset('/assets/be/images/blur1.png') }}"></h4>
                                    @else
                                        <h4 class="blured_txt sub-heading-resume sub-heading-resume-name">{{ $reference->name }}
                                        </h4>
                                    @endif
                                @endif
                                <ul class="preview_contact_list">
                                    <table style="">
                                        <tr>
                                            <td style="padding: 5px;">
                                                @if ($reference->name != '')
                                                    <li>
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td style="width: 44px;">
                                                                    <span class="contact_icon"
                                                                        style="background-color: rgb(255 174 26 / 20%);height: 40px;width: 40px;border-radius:50%;display:block"><i
                                                                            class="fa fa-phone" aria-hidden="true"
                                                                            style="margin: 9px;color:#FFAE19;font-size:24px;  "></i></span>
                                                                </td>
                                                                <td>
                                                                    <div class="contact_rgt_side">
                                                                        <h5>Phone No</h5>
                                                                        @if ($mode)
                                                                            <a class="blured_txt"
                                                                                href="tel:"><img src="{{ asset('/assets/be/images/blur1.png') }}"></a>
                                                                        @else
                                                                            <a class="blured_txt"
                                                                                href="tel:{{ $reference->phone }}">{{ $reference->phone }}</a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </li>
                                                @endif
                                            </td>
                                            <td style="padding: 5px;">
                                                @if ($reference->email != '')
                                                    <li>
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td style="width: 44px;">
                                                                    <span class="contact_icon"
                                                                        style="background-color: rgba(126, 80, 167, 0.1);height: 40px;width: 40px;border-radius:50%;display:block"><i
                                                                            class="fa fa-envelope" aria-hidden="true"
                                                                            style="margin: 8px;color:#7E50A7;font-size:24px;  "></i></span>
                                                                </td>
                                                                <td>
                                                                    <div class="contact_rgt_side">
                                                                        <h5>Email</h5>
                                                                        @if ($mode)
                                                                            <a class="blured_txt"
                                                                                href="mailto:"><img src="{{ asset('/assets/be/images/blur1.png') }}"></a>
                                                                        @else
                                                                            <a class="blured_txt" href="mailto:{{ $reference->email }}"
                                                                                style="color: #000;">{{ $reference->email }}</a>
                                                                        @endif
                                                                    </div>
                                                                <td>
                                                            </tr>
                                                        </table>
                                                    </li>
                                                @endif

                                            </td>
                                            <td style="padding: 5px;">
                                                @if ($reference->relationship != '')
                                                    <li>
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td style="width: 44px;">
                                                                    <span class="contact_icon"
                                                                        style="background-color: rgba(0, 157, 200, 0.1);height: 40px;width: 40px;border-radius:50%;display:block"><i
                                                                            class="fa fa-handshake-o"
                                                                            aria-hidden="true"
                                                                            style="    margin: 9px 5px;color:#00407C;font-size:24px;  "></i></span>
                                                                </td>
                                                                <td>
                                                                    <div class="contact_rgt_side">
                                                                        <h5>Relationship</h5>
                                                                        @if ($mode)
                                                                            <p class="blured_txt"><img src="{{ asset('/assets/be/images/blur1.png') }}"></p>
                                                                        @else
                                                                            <a class="blured_txt" href="javascript:void(0)"
                                                                                style="color: #000;cursor:default;">{{ $reference->relationship }}</a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </li>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>

                                </ul>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div style="text-align: center;
    padding: 5px;
    font-size: 12px;">Find Me At: &nbsp;<a
                href="http://purplestairs.com">www.purplestairs.com</a></div>
    </div>

</div>

<script src="{{ asset('assets/be/js/jquery-3.5.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
    integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    savePdf();
    window.jsPDF = window.jspdf.jsPDF;
    // Convert HTML content to PDF

    // Convert HTML content to PDF
    function savePdf() {
        // Calculate the content dimensions and scale factor
        var contentWidth = $("#contentToPrint").width();
        var contentHeight = $("#contentToPrint").height();

        // A4 page dimensions in points (1 inch = 72 points)
        var PDF_Width = contentWidth;
        var PDF_Height = 841.890;
        var top_left_margin = 0;

        var scale = Math.min((PDF_Width - 2 * top_left_margin) / contentWidth, (PDF_Height - 2 * top_left_margin) /
            contentHeight);

        scale = 2;
        console.log(scale, scale);
        // Create a canvas with scaled dimensions
        var canvas = document.createElement("canvas");
        canvas.width = contentWidth * scale;
        canvas.height = contentHeight * scale;

        // Scale the content and draw it on the canvas
        var canvasContext = canvas.getContext("2d");
        canvasContext.scale(scale, scale);

        html2canvas($("#contentToPrint")[0], {
            allowTaint: true,
            useCORS: true,
            dpi: 300
        }).then(function(contentCanvas) {
            canvasContext.drawImage(contentCanvas, 0, 0);

            // Calculate the number of pages needed
            var numPages = Math.ceil(contentCanvas.height / PDF_Height);

            // Create a PDF with A4 dimensions for each page
            var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);

            for (var i = 0; i < numPages; i++) {
                if (i > 0) {
                    pdf.addPage(); // Add a new page for subsequent pages
                }

                // Calculate the y-coordinate for the current page
                var offsetY = -i * PDF_Height;

                // Add the scaled image to the PDF
                pdf.addImage(canvas, 'JPEG', top_left_margin, top_left_margin + offsetY, contentWidth,
                    contentHeight);
            }

            // Save or display the PDF as needed
            pdf.save("curriculum-vitae.pdf");

        });
    }
</script>

</html>
