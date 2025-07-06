{{-- <link rel="stylesheet" href="{{asset('assets/be/css/all.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/brands.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/regular.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/solid.css')}}" />
    
    <link rel="stylesheet" href="{{asset('assets/be/css/bootstrap.min.css')}}" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --} }
    <link rel="stylesheet" href="{{asset('assets/be/style.css')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{asset('assets/be/js/jquery-3.5.1.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" /> --}}
@if(!empty($candidate_user->id))
<div id="{{$candidate_user->id}}" wire:id="profile_{{$candidate_user->id}}" wire:key="{{$candidate_user->id}}">
    <style>
        .cpi{
          height: 100vh;
        }
        .popup-prof-cut span{
          color:var(--purple);
          font-size: 28px;
        }
        .popup-prof-cut{
          text-align: right;
          /* margin-right: 13%; */
          opacity: 1 !important;
          /* position: fixed; */
          top: 20px;
          right: 0%;
          z-index: 99;
        }
        .arrow-box {
            top: calc(50% - 24px);
        }
        button.close.popup-prof-cut {
            float: none;
            position: absolute;
            right: 20px;
            top: 10px;
        }
        button.close.popup-prof-cut {
            float: right;
            font-size: 23px;
            font-weight: 500;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            filter: alpha(opacity = 20);
            opacity: .2;
            border: none;
            background: none;
        }
        .request_close button.close_req_mask {
            padding: 0;
            margin: 0;
            color: var(--purple) !important;
            position: absolute;
            right: 17px;
            top: 15px;
            background: transparent;
            border: 0;
            height: auto;
            width: auto;
            font-size: 30px;
            line-height: 1;
        }
        /*    task - 86a2ykzx3    */
        .request_btn_otr- { text-align: center; }
        .request_btn_otr- div.position_form {
            display: flex !important;
            text-align: center !important;
        }
        .request_btn_otr- .pending_unmask_rt {
            display: block !important;
        }

        /*    task - 86a2vx5er    */
        .popup_fav_wrapper {
            margin-top: -10px;
        }
        .popup_fav_wrapper ul li {
            margin-bottom: 7px;
        }
        .popup_fav_wrapper ul li.psuggestion_search_wrapper a {
            background: rgba(126, 80, 167, 0.1);
            font-size: 14px;
            font-weight: 400;
            color: var(--purple);
            padding: 7px 13px;
            border-radius: 33px;
            display: inline-block;
            display: -webkit-box;
            line-height: 2.3;
            padding: 0;
        }
        .popup_fav_wrapper ul li a {
            display: flex; line-height: 2; color : var(--purple); font-size: 15px;
        }
        .popup_fav_wrapper ul li a.btn-blue {
            background: var(--white5); color : var(--blue2); border-radius: 50px; padding: 0 15px;
        }
        .inc_saved_searches { position: relative; }
        .inc_saved_searches .clickd_tgl_searches_open { box-shadow: 0px 3.18954px 19.1373px rgb(94 139 255 / 25%); -webkit-box-shadow: 0px 3.18954px 19.1373px rgb(94 139 255 / 25%); }
    </style>
    @php
        $personal = $candidate_user->personal;
        $mode = true; $never_mode = true; $requestCompany = false;

        $company_user = \DB::table('company_user')->where('user_id', $candidate_user->id)->where('company_id', $company_id)->first();
        $mode = $company_user ? $company_user->status : false;
        $mode = !$mode;

        if ($company_user) { // task - 862k30j85
            if ($company_user->status == 2) {
                $mode = true;
            }

            // task - 86a2enuvn
            if ($company_user->status == 1) {
                $mode = false;
            }

            if ($company_user->status == 1) { // task - 86a0xw4t8
                $never_mode = true;
            }
        } else {
            $name_mode = false; // task - 86a0xw4t8 | task - 86a1tzdqv - POINT - 7 (before false)
        }

        $requestCompany = $company_user ? true : false;
    @endphp
    {{-- @if(!empty($candidate_user->id)) data-id={{$candidate_user->id}} @else data-id="" @endif --}}
    <div data-id="{{$candidate_user->id}}" class=" modal not_in_searches- fade condidate-profile-modal exampleModalToggle{{$candidate_user->id}}" aria-hidden="true" aria-label="exampleModalToggleLabel2" @if(!empty($candidate_user->id)) data-id={{$candidate_user->id}} @else data-id="" @endif tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-fullscreen- modal-xl">


            <div class="modal-content">
                <button type="button" class="close popup-prof-cut" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="modal-body p-1 d-flex">

                    <div class="position-absolute start-0 arrow-box"> <a href="javascript:void(0)" class="eyeball22 left-arrow px-4" data-id="{{$candidate_user->id}}"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></div>

                    <div>
                        <style type="text/css">
                            .contact_rgt_side .blured_txt {
                                white-space: nowrap !important;
                            }
                            .intercom-lightweight-app {
                                display: none !important;
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
                            .cpi {
                                max-height: 100vh; overflow: auto;
                            }
                        </style>
                        <div class="cpi">
                            @if (!$published)
                            <div class="preview-sec cmn-gap back-clr ban-up ">
                                <div class="preview-wrap preview-wrap-final">
                                    <div class="container" style="/*padding: 0 95px;*/">
                                        <div class="preview_banner_total">
                                            <div class="preview-banner">
                                                <div class="preview-banner-fig">
                                                    <figure>
                                                        <img src="{{ asset('assets/fe/images/candi-banner-img.png') }}" alt="" class="desktop-v" />
                                                        <img src="{{ asset('assets/fe/images/ban-mob-image.png') }}" alt="" class="mobile-v" />
                                                    </figure>
                                                </div>
                                            </div>
                                            <div class="preview_banner_btm" style="position: relative;">
                                                {{-- @if($search_id) --}}
                                                <div class="candidate_grid_ppl_icn large" style="position: absolute;">
                                                    <a href="javascript:;" class="btn-blue clickd_tgl_searches">
                                                        <svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="ellipsis-icon">
                                                            <circle cx="17.5" cy="12" r="1.5"></circle>
                                                            <circle cx="12" cy="12" r="1.5"></circle>
                                                            <circle cx="6.5" cy="12" r="1.5"></circle>
                                                        </svg>
                                                    </a>

                                                    <div class="clickd_tgl_searches_open">
                                                        <div class="clickd_tgl_searches_open_head">
                                                            <h5>Manage Matched Searches</h5>
                                                            {{-- task - 86a1gr1cr --}}
                                                            {{-- task - 86a2vxac0 --}}
                                                            @if(count($saved_searches) == 0)
                                                            <h5 class="text-muted"><small>Create a search & save it to use this function</small></h5> 
                                                            @endif
                                                        </div>
                                                        <div class="clickd_tgl_searches_open_ul arr_grey">

                                                            <div class="form_input_check">
                                                            @if(!empty($saved_searches))
                                                                @foreach($saved_searches as $key => $search)
                                                                @php 
                                                                    $search_ids = $search->candidate_ids;
                                                                    $is_checked = in_array($candidate_user->id, $search->candidate_ids) ? 1 : 0; 
                                                                @endphp
                                                                <label>
                                                                    <input type="checkbox" class="manual_add_saved_serach" data-search-id="{{ $search->id }}" data-candidate="{{ $candidate_user->id }}" wire:click="changeEvent('{{ $is_checked }}', '{{ $search->id }}','{{ $candidate_user->id }}')" {{ $is_checked ? 'checked' : '' }} />
                                                                    <span>{{ $search->name }}</span>
                                                                </label>
                                                                @endforeach
                                                                 @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- @endif --}}
                                                <div class="preview_banner_img_sec">
                                                    <div class="preview_banner_img_sec_left">
                                                        {{-- @if(!empty($candidate_user->profile_photo_path)) --}}
                                                            @if(!empty($candidate_user->profile_photo_path))
                                                            <figure class="@if($personal->profile_status == 0) main_img_masked @endif">
                                                                @if($personal->profile_status == 0)
                                                                <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="masked-img" />
                                                                @else
                                                                <img src="{{ asset($candidate_user->profile_photo_path) }}" alt="" />
                                                                @endif
                                                            </figure>
                                                            @else
                                                            <figure class="@if($personal->profile_status == 0) main_img_masked @endif">
                                                                @if($personal->profile_status == 0)
                                                                <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="masked-img" />
                                                                @else
                                                                <img src="{{ asset('/assets/fe/images/profile-pic.png') }}" alt="" />
                                                                @endif
                                                            </figure>
                                                            @endif
                                                        {{-- @endif --}}
                                                        @if($mode)
                                                        
                                                        @if($requestCompany)
                                                        <div class="request_btn_otr-">
                                                            {{-- task - 862k46fkk <a href="#url" class="request_btn"><span><img src="{{asset('assets/fe/images/ylw_lock.svg')}}" alt="" /></span>Pending</a> --}}
                                                            <div class="pending_unmask">
                                                                <i class="iconc"><img src="{{asset('assets/be/images/clock.svg')}}" alt=""></i>
                                                                <div class="pending_unmask_rt">
                                                                    <h6>Pending Unmask</h6>
                                                                    <p>Profile Saved In Requested</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!$requestCompany)
                                                        @php
                                                            // task - 86a1tzdqv - POINT - 8
                                                            $personal_status = explode(',',$candidate_user->personal_status);
                                                            $edu_status = explode(',',$candidate_user->edu_status);
                                                            $emp_status = explode(',',$candidate_user->emp_status);
                                                            $ref_status = explode(',',$candidate_user->ref_status);
                                                            // task - 86a1tzdqv - POINT - 8 end
                                                        @endphp
                                                        {{-- task - 86a1tzdqv - POINT - 8 check if fully visible profile --}}
                                                        @if(in_array('0', $personal_status) || in_array('0', $edu_status) || in_array('0', $emp_status) || in_array('0', $ref_status))
                                                        <div class="request_btn_otr">
                                                            <a href="#url" class="request_btn"><span><img src="{{asset('assets/fe/images/ylw_lock.svg')}}" alt="" /></span>Request Unmask</a>
                                                            <div class="position_form" wire:ignore.self>
                                                                <div class="request_close">
                                                                    <button type="button" class="close_req_mask">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                {{-- <form wire:submit.prevent="incsendRequest()" class="mt-3"> --}}
                                                                <form id="unmask_request_{{$candidate_user->id}}" class="mt-3">
                                                                    <div class="form-group">
                                                                        <label>Subject*</label>
                                                                        <input type="text" class="form-control" {{-- task - 86a2rvv8z placeholder="Job title here" --}} wire:model.defer="position_hiring" required  />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Message to Candidate</label>
                                                                        <textarea {{-- task - 86a2rvv8z placeholder="I reviewed your resume..."--}} wire:model.defer="message" required></textarea>
                                                                    </div>
                                                                    <div class="position-submit-btn-otr" wire:loading.remove wire:target="incsendRequest" onclick="sendRequest()">
                                                                        <input type="button" value="Send to Candidate" class="position_submit_btn" />
                                                                    </div>
                                                                    <div class="position-submit-btn-otr" wire:loading wire:target="incsendRequest">
                                                                        <input type="submit" value="Sending..." disabled class="position_submit_btn" />
                                                                    </div>
                                                                </form>
                                                                {{-- @if($messageSent) --}}
                                                                <span class="message_snt_sec" style="display:none;">Your Message Has Been Sent.</span>
                                                                {{-- @endif --}}
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endif
                                                        @endif
                                                    </div>
                                                    <div class="preview_banner_img_sec_rgt">
                                                        <div class="preview_banner_img_sec_rgt_wrapper">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="defination-sec">
                                                                        {{-- task - 86a2vx5er --}}
                                                                        <div class="row">
                                                                            <div class="col-md-7 col-lg-7 col-sm-6">
                                                                                <div class="title">
                                                                                    <h4 gdfgds>
                                                                                        {{-- task - 86a0xw4t8 --}}
                                                                                        @if(!empty($personal->name))
                                                                                            {{-- @if(!empty($personal->name_status)) --}}
                                                                                                @if (/* task - 86a2enuvn */$mode && $personal->name_status == 0)
                                                                                                    @php $length = (strlen($personal->name) > 15) ? 15 : strlen($personal->name); @endphp
                                                                                                    <em class="blured_txt  name-blured-box">
                                                                                                    {{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}}
                                                                                                    </em>
                                                                                                @else
                                                                                                    {{ $personal->name }}
                                                                                                @endif
                                                                                        @else
                                                                                            <em class="blured_txt name-blured-box">Candidate Name</em>
                                                                                        @endif

                                                                                        @if(!empty($personal->linkedin_url))
                                                                                        @if(/* task - 86a2enuvn */$mode && $personal->linkedin_url_status == 0)
                                                                                        <em class="blured_txt image_blur"><a><img src="{{asset('assets/fe/images/linkdin-ylw.svg')}}" alt="" /></a></em>
                                                                                        @else
                                                                                            <a href="{{$personal->linkedin_url}}" target="_blank"><img src="{{asset('assets/fe/images/linkdin-ylw.svg')}}" alt="" /></a>
                                                                                        @endif
                                                                                        @endif

                                                                                        @if(!empty($personal->additional_url))
                                                                                        @if(/* task - 86a2enuvn */$mode && $personal->additional_url_status == 0)
                                                                                        <em class="blured_txt image_blur"><a><img src="{{asset('assets/fe/images/globe-ylw.svg')}}" alt="" /></a></em>
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
                                                                            </div>
                                                                            <div class="col-md-5 col-lg-5 col-sm-6">
                                                                                <div class="popup_fav_wrapper">
        <ul>
            <li class="psuggestion_search_wrapper">
                <a href="javascript:;" >
                    <span class="favorite_{{$candidate_user->id}} ic_award_icn {{ in_array($candidate_user->id, $favorites) ? 'hover_fav' : '' }}" onclick="{{ !in_array($candidate_user->id, $favorites) ? "saveFavorite(" . $candidate_user->id . ", ". $search_id .")" : "removeFavorite(" . $candidate_user->id . ", ". $search_id .")"}}">
                        <svg class="not_new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z" fill="#FFAE1A"></path>
                        </svg>
                    </span>Favorite</a>
            </li>

            {{-- task - 86a309hbq --}}
            @if($search_id)
            <li class="psuggestion_search_wrapper">
                <a href="javascript:;" onclick="{{ !in_array($candidate_user->id, $relevants) ? "saveRelevant(" . $candidate_user->id .",".$search_id.")" : "removeRelevant(" . $candidate_user->id .",".$search_id . ")"}}">
                    <span class="ic_relevant_inc relevant_{{$candidate_user->id}} {{ in_array($candidate_user->id, $relevants) ? 'hover_relevant' : '' }}">
                        <svg width="20px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </span>Relevant</a>
            </li>

            <li class="psuggestion_search_wrapper">
                <a href="javascript:;" onclick="{{ !in_array($candidate_user->id, $non_relevants) ? "saveNonRelevant(" . $candidate_user->id .",".$search_id .")" : "removeNonRelevant(" . $candidate_user->id .",".$search_id . ")"}}">
                    <span class="ic_nrelevant_inc nrelevant_{{$candidate_user->id}} {{ in_array($candidate_user->id, $non_relevants) ? 'hover_nrelevant' : '' }}">
                        <svg width="20px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </span>Not Relevant</a>
            </li>
            @endif
            {{-- task - 86a309hbq end --}}
        </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="preview_contact_sec mobile-v">
                                                                            <ul class="preview_contact_list wrpn mb-3">
                                                                                <li>
                                                                                    <span class="contact_icon"><img src="{{ asset('assets/fe/images/ylw-tell.svg') }}" alt="" /></span>
                                                                                    <div class="contact_rgt_side">
                                                                                        <h5>Phone No</h5>
                                                                                        @if (/* task - 86a2enuvn */$mode &&  $personal->phone_status == 0)
                                                                                        <a class="blured_txt" href="tel:">phone
                                                                                            no
                                                                                        </a>
                                                                                        @else
                                                                                        <a class="" href="tel:{{ $personal->phone }}">{{ $personal->phone }}
                                                                                        </a>
                                                                                        @endif
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="contact_icon"><img src="{{ asset('assets/fe/images/prpl-envlp.svg') }}" alt="" /></span>
                                                                                    <div class="contact_rgt_side">
                                                                                        <h5>Email</h5>

                                                                                        @if(/* task - 86a2enuvn */$mode && $personal->email_status == 0)
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
                                                                                @if(!empty($industries))
                                                                                @foreach ($industries as $industry)
                                                                                <li>{{ $industry }}</li>
                                                                                @endforeach
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                        <div class="defination_list">
                                                                            <h5>Area of Interest:</h5>
                                                                            <ul>
                                                                                @if(!empty($interests))
                                                                                @foreach ($interests as $interest)
                                                                                <li>{{ $interest }}</li>
                                                                                @endforeach
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="preview_contact_sec desktop-v">
                                                                        <ul class="preview_contact_list wrpn mb-3 d-flex row">
                                                                            <li class="col-md-6">
                                                                                <span class="contact_icon"><img src="{{ asset('assets/fe/images/ylw-tell.svg') }}" alt="" /></span>
                                                                                <div class="contact_rgt_side">
                                                                                    <h5>Phone No</h5>
                                                                                    @if (/* task - 86a2enuvn */$mode && $personal->phone_status == 0)
                                                                                    <a class="blured_txt" href="tel:">phone
                                                                                        no</a>
                                                                                    @else
                                                                                    <a href="tel:{{ $personal->phone }}">{{ $personal->phone }}</a>
                                                                                    @endif
                                                                                </div>
                                                                            </li>
                                                                            <li class="col-md-6">
                                                                                <span class="contact_icon"><img src="{{ asset('assets/fe/images/prpl-envlp.svg') }}" alt="" /></span>
                                                                                <div class="contact_rgt_side">
                                                                                    <h5>Email</h5>
                                                                                    @if (/* task - 86a2enuvn */$mode && $personal->email_status == 0)
                                                                                    <a class="blured_txt" href="mailto:">Email</a>
                                                                                    @else
                                                                                    <a href="mailto:{{ $personal->email }}">{{ $personal->email }}</a>
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
                                                                    @if(!empty($personal->address))
                                                                        @if(/* $never_mode == false&& *//* task - 86a2enuvn */$mode && $personal->zip_code_status == 0)
                                                                            <span class="blured_txt"> {{$personal->address}},&nbsp;{{$personal->state_abbr}}</span>
                                                                        @else
                                                                            {{$personal->address}},&nbsp;{{$personal->state_abbr}}
                                                                        @endif
                                                                         {{-- Task #86a21dpn9 --}}
                                                                        @else
                                                                        @if(/* task - 86a2enuvn */$mode && $personal->country_name_status == 0)
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
                                                                @if(!empty( $personal->salary_range))
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
                                                                <p class="m-0">Full Time</p>
                                                                @endif
                                                                @if (!empty($personal->schedule_part_time))
                                                                <p class="m-0">Part Time</p>
                                                                @endif
                                                                @if (!empty($personal->schedule_no_preference))
                                                                <p class="m-0">No Preference</p>
                                                                @endif
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="preview_banner_img_list_inner">
                                                                <h6 class="text-center">Work Setting:</h6>
                                                                <ul class="tick_list">
                                                                    @if (!empty($personal->work_environment_remote))
                                                                    <li>
                                                                        <span><img src="{{ asset('assets/fe/images/sky_blue.svg') }}" alt="" /></span>Remote
                                                                    </li>
                                                                    @endif
                                                                    @if (!empty($personal->work_environment_hybrid))
                                                                    <li>
                                                                        <span><img src="{{ asset('assets/fe/images/sky_blue.svg') }}" alt="" /></span>Hybrid
                                                                    </li>
                                                                    @endif
                                                                    @if (!empty($personal->work_environment_in_office))
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
                                        @else
                                        <div class="my-5"></div>
                                        @endif
                                        {{-- task - 86a2vxjff end --}}

                                        <div class="new_block">
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    @if(!empty($personal->short_bio))
                                                    @if (/*$never_mode == false && */ /* task - 86a2enuvn */$mode && $personal->short_bio_status == 0)
                                                    <div class="about_candidate blured_txt">
                                                        <div class="title">
                                                            <h4>About</h4>
                                                        </div>
                                                        <div class="about_candidate_txt">
                                                            <p>
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta
                                                                atque ab veritatis sunt laboriosam, autem iusto, consequatur eum
                                                                deserunt alias ducimus velit, eos maiores! Animi et reprehenderit
                                                                sit repudiandae libero?
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="about_candidate">
                                                        <div class="title">
                                                            <h4>About @if (/* task - 86a2enuvn */$mode && $personal->name_status){{ $personal->name }} @endif</h4>
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
                                                        <div class="row" style="margin-right: -35px">
                                                            <div class="col-md-4">
                                                             @php $count = 0 @endphp
                                                                <div class="skills_list_inner">
                                                                    <div class="title">
                                                                        <h4 style="color: #7e50a7">Hard Skills</h4>
                                                                    </div>

                                                                    <ul class="skills_list">
                                                                        @if(!empty($hard_skills))
                                                                            @foreach ($hard_skills as $hard_skill)
                                                                                <li>{{ $hard_skill }}</li>
                                                                                  @php $count++ @endphp
                                                                                  @if ($count === 5)
                                                                                    <!-- Display "View More" button after the first five items -->
                                                                                    <ul class="hidden-skills-list0_{{$candidate_user->id}} ps-0" style="display:none;">
                                                                                @endif
                                                                            @endforeach
                                                                            </ul>
                                                                            @if ($count > 5)
                                                                            <span id="viewMoreButton0_{{$candidate_user->id}}" class="viewMoreButton viewMoreButton0_{{$candidate_user->id}}" onclick="toggleView('0_'+{{$candidate_user->id}})">CLICK HERE TO VIEW ALL</span>
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
                                                                        @if(!empty($soft_skills))
                                                                            @foreach ($soft_skills as $soft_skill)
                                                                            <li>{{ $soft_skill }}</li>
                                                                            @php $count++ @endphp

                                                                                @if ($count === 5)

                                                                                <!-- Display "View More" button after the first five items -->

                                                                                    <ul class="hidden-skills-list1_{{$candidate_user->id}} ps-0" style="display:none;">
                                                                                @endif
                                                                            @endforeach
                                                                            </ul>
                                                                            @if ($count > 5)
                                                                            <span id="viewMoreButton1_{{$candidate_user->id}}" class="viewMoreButton viewMoreButton1_{{$candidate_user->id}}" onclick="toggleView('1_'+{{$candidate_user->id}})">CLICK HERE TO VIEW ALL</span>
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
                                                                        @if(!empty($languages))
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
                                                        @if(!empty($employments))
                                                        @if($employments->count())
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
                                                                                {{$employement->responsibilities}}
                                                                            </p>
                                                                        </div>
                                                                        @endif
                                                                        {{-- task - 86a0hfdhj end --}}

                                                                        @if($employement->accomplishments != '')
                                                                        <div class="work_list_inner_txt">
                                                                            <h5>Position Accomplishments</h5>
                                                                            {{-- task - 86a0hfdhj --}}
                                                                            <p class="{{ ($mode && $employement->accomplishments_status == 0) ? 'blured_txt' : '' }}">
                                                                                {{$employement->accomplishments}}
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
                                                        @if(!empty($educations))
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
                                                                        <h6 class="{{ ($mode && $education->start_year_status == 0) ? 'blured_txt' : '' }}">
                                                                            {{$education->start_year}}
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
                                                        @endif
                                                    </div>
                                                    @if(!empty($references))
                                                    @if($references->count())
                                                    <div class="reference_block">
                                                        <div class="title">
                                                            <h4>Reference</h4>
                                                        </div>
                                                        @foreach ($references as $reference)
                                                        @if($reference->name != '')
                                                        <div class="reference_block_inner">

                                                            @if (/* task - 86a2enuvn */$mode && $reference->name_status == 0)
                                                            <h5 class="blured_txt">Jenefer Smith</h5>
                                                            @else
                                                            <h5>{{ ucwords($reference->name) }}</h5>
                                                            @endif

                                                            <ul class="preview_contact_list">
                                                                @if($reference->phone != '')
                                                                <li>
                                                                    <span class="contact_icon"><img src="{{asset('assets/fe/images/ylw-tell.svg')}}" alt="" /></span>
                                                                    <div class="contact_rgt_side">
                                                                        <h5>Phone No</h5>
                                                                        @if(/* task - 86a2enuvn */$mode && $reference->phone_status == 0)
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
                                                                        @if(/* task - 86a2enuvn */$mode && $reference->email_status == 0)
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
                                                                        @if(/* task - 86a2enuvn */$mode && $reference->relationship_status == 0)
                                                                        <p class="blured_txt">relationship</p>
                                                                        @else
                                                                        <p>{{$reference->relationship}}</p>
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
                                                            {{-- task - 86a22j70y <a data-fancybox data-src="#open55" href="javascript:;" class="add_btn">add a
                                                                note<span>+</span></a> --}}
                                                            <a onclick="$('.note_modal_{{$candidate_user->id}}').show();" href="javascript:;" class="add_btn">add a
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
                                                                                    <span><img src="{{asset('assets/fe/images/prpl_calender.svg')}}" alt="" /></span>{{$note->created_at->format('m-d-Y')}}
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="add_note_list_item_content">
                                                                            {{ $note->note }}
                                                                        </div>
                                                                        <div class="add_note_list_item_ftr">
                                                                            <h6>
                                                                                <span><img src="{{asset('assets/fe/images/demo_avatar.svg')}}" alt="" /></span>{{$note->author->name}}
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

                                    {{-- task - 86a22j70y --}}
                                    <div class="custom_modal note_modal_{{$candidate_user->id}}" style="display:none;" wire:ignore.self>
                                        <div style="">
                                            <div>
                                                <button type="button" class="popup-prof-cut" onclick="$('.note_modal_{{$candidate_user->id}}').hide();">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            {{-- <form wire:submit.prevent="saveNote()"> --}}
                                            <form id="save-note" method="post">
                                                <div class="modal-note">
                                                    <div class="form-group">
                                                        <label>Add Note</label>
                                                        <textarea wire:model="note"></textarea>
                                                        @error('note')

                                                            <div class="text-danger error" >

                                                            {{ $message }}

                                                            </div>
                                                            @enderror
                                                    </div>
                                                    <div class="form-submit-btn mb-0 mt-3">
                                                        <input type="button" value="Add" class="submit-btn add_notes" onclick="disable_btn_{{$candidate_user->id}}(this)">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- task - 86a22j70y <div class="modal1">
                            <div class="fancy-modal-body1" id="open55">
                                <form wire:submit.prevent="saveNote()">
                                    <div class="modal-note">
                                        <div class="form-group">
                                            <label>Add Note</label>
                                            <textarea wire:model.lazy="note"></textarea>
                                            @error('note')

                                                <div class="text-danger error" >

                                                {{ $message }}

                                                </div>
                                                @enderror
                                        </div>
                                        <div class="form-submit-btn mb-0 mt-3">
                                            <input type="submit" value="Add" class="submit-btn" wire:loading.remove wire:target="saveNote">
                                            <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="saveNote">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
                    </div>

                    {{-- @push('scripts') --}}
                    <script>
                        // task - 86a2tvcpz
                        function disable_btn_{{$candidate_user->id}}(el) {
                            $(el).val('Saving...');
                            var note = $(el).parent().find('.textarea').val();
                            if(note) {
                                
                            }
                        }

                        $('#unmask_request_{{$candidate_user->id}} input, #unmask_request_{{$candidate_user->id}} textarea').on("keypress", function(e) {
                            $(this).parent().find('text-danger').remove();
                        });

                        function sendRequest() {
                            let subject = $('#unmask_request_{{$candidate_user->id}} input').val();
                            let message = $('#unmask_request_{{$candidate_user->id}} textarea').val();
                            console.log(subject, message);
                            if(subject && message) {
                                $.ajax({
                                    url: '{{ url('company') }}/request_unmask/{{ $candidate_user->id }}',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: { 'company_id': {{ $company_id }}, 'subject': subject, 'message': message, '_token': '{{csrf_token()}}' },
                                    success: function(req) {
                                        $('.exampleModalToggle{{ $candidate_user->id }}').find('.request_btn_otr').html(req);
                                        $('#unmask_request_{{$candidate_user->id}} input').val('');
                                        $('#unmask_request_{{$candidate_user->id}} textarea').val('');
                                    }
                                });
                            }
                        }

                        var blur_str = "Hidden";
                        document.addEventListener("livewire:load", (e) => {
                            {{-- 86a2p168x --}}
                            function initBlur() {
                            $('.condidate-profile-modal .blured_txt:not(.image_blur)').each(function() {
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
                            /*Livewire.hook('message.processed', (el, component) => {
                                console.log('fgghfsd');
                                initBlur();
                            });*/
                        });

                        window.addEventListener('close-note', event => {
                            // $.fancybox.close();
                            $('.note_modal_' + event.detail.hide_id).hide();
                            $('.note_modal_' + event.detail.hide_id).find('.modal-note').find('.form-group').find('.text-danger').remove();
                            $('.note_modal_' + event.detail.hide_id).find('.modal-note').find('.form-group').find('textarea').val('');
                        })


                        $("body").delegate(".note_modal_{{ $candidate_user->id }} .submit-btn", "click", function(e) {
                            var val=$.trim($(this).parents('.modal-note').find('textarea').val());
                            if(val==""){
                                $(this).parents('.modal-note').find('.form-group').find('.text-danger').remove();
                                $(this).parents('.modal-note').find('.form-group').append('<div class="text-danger error" > The note field is required.</div>');
                                console.log($(this));
                                $(this).val('Add');
                            } else {
                                $.ajax({
                                    url: '{{ url('company') }}/add_note/{{ $candidate_user->id }}',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: { 'company_id': {{ $company_id }}, 'note': val, '_token': '{{csrf_token()}}' },
                                    success: function(note) {
                                        $('.exampleModalToggle{{ $candidate_user->id }}').find('#save-note textarea').val('');
                                        $('.exampleModalToggle{{ $candidate_user->id }}').find('.add_note_list').append(note);
                                        $('.note_modal_{{ $candidate_user->id }}').find('button.popup-prof-cut').click();

                                    }
                                });
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
                                if (!$('.inline-table-modal').is(e.target) && $('.inline-table-modal').has(e.target).length === 0) {
                                    // Click occurred outside the modal, so close it
                                    $(".inline-table-modal").modal("hide");
                                }
                            });
                        });
                    </script>
                    <script>
                        function toggleView(id) {
                            if($('.hidden-skills-list'+id).is(':visible')) {
                                $('.hidden-skills-list'+id).hide();
                                $('.viewMoreButton'+id).html('CLICK HERE TO VIEW ALL');
                            } else {
                                $('.hidden-skills-list'+id).show();
                                $('.viewMoreButton'+id).html('CLICK HERE TO VIEW LESS');
                            }
                        }
                    </script>
                    {{-- @endpush --}}

                    <div class=" position-absolute end-0 arrow-box"><a href="javascript:void(0)" class="eyeball22 px-4 right-arrow" data-id="{{ $candidate_user->id }}"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
                </div>

            </div>


        </div>
    </div>
</div>
@endif
<!-- Jquery-->
    {{-- <script src="{{asset('assets/be/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/be/js/slick.min.js')}}"></script>
    { {- - <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> - -} }
    @if(!Request::is('company/saved-search/*'))
    <script src="{{asset('assets/be/js/jquery-ui.js')}}"></script>
    @endif
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    @if(Request::is('company/dashboard') || Request::is('company/saved-search/*') || Request::is('company/saved-searches') || Request::is('company/archived-search/*') || Request::is('company/archived-searches') || Request::is('company/manage-subsciption'))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.js"></script>
    @else
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endif
    <script src="{{asset('assets/be/js/filters.js')}}"></script>
    <script src="
https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.js
"></script> --}}