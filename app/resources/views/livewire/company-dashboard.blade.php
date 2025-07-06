<div>
    <!-- select2 filters -->
    <link rel="stylesheet" href="{{asset('assets/be/search-page.css')}}" />
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/intlTelInput.min.js"></script>
    <script>
        // task - 86a21hge8
        window.onload = function() {
            $('.bootstrap-tagsinput').find('input').on('keyup', function(event) {
                /* Act on the event */
                if(event.keyCode == 188) {
                    $(this).val('');
                }
            });
        }
        // task - 86a21hge8 end
    </script>

    <style>
        /* task - 86a21hge8 .position-input { overflow: hidden; }*/
        .select2-container--default .select2-selection--multiple {
            background: transparent;
        }

        .tag-input-field .form-group { margin-bottom: 0px !important; }

        .background-masker {
            background-color: #fff;
            position: absolute;
        }

        @keyframes placeHolderShimmer {
              0% {
                background-position: -800px 0
              }
              100% {
                background-position: 800px 0
              }
        }

        .animated-background {
            animation-duration: 2s;
            animation-fill-mode: forwards;
            animation-iteration-count: infinite;
            animation-name: placeHolderShimmer;
            animation-timing-function: linear;
            background-color: #f6f7f8;
            background: linear-gradient(to right, #f2f2f2 8%, #ebebeb 18%, #f2f2f2 33%);
            background-size: 800px 104px;
            height: 45px !important;
            border-radius: 50px;
            position: relative;
            margin: 0px 3px 5px 0px;
            max-width: 150px;
        }

        .animated-background > * {
            visibility: hidden;
        }

        .animated-background:after {
            content: " ";
            visibility: visible;
            position: absolute;
        }
        .select2-results {
width: 100% !important;
box-shadow: 1px 1px 1px 1px 3px lightgray !important;
}
.select2-results__options{
  background-color: white !important;
 box-shadow: 1px 1px 1px 1px 3px lightgray !important;
 border:1px solid lightgray !important;

  {{-- box-sizing: border-box; --}}
}
.select2-dropdown{

    {{-- width:100% !important; --}}
}
    /* task - 86a1uf3ar */
    .close-open-select2 {
        color: #7e50a7; cursor: pointer; font-size: 14px;
    }
    .searched-count{
    font-size: 14px;
    margin-left: 29px;
    }
/* 86a2p9aqa */
@media (max-width: 1535px){
    .ecperice_list .candidate_grid_ppl_top_btm_wrap
    {
     padding: unset !important;
    }
}
    /*  task - 86a2vxnfa  */
    .distance-text { font-size: 14px; }
    .zip-code-p .fa{
        color: var(--purple);
        font-size: 27px;
    }
    .zip-code-p{
        display:flex;
        gap:13px;
    }
    .zip-code-p span{
        font-size: 12px;
        font-weight: 400;
        color: var(--black3);
        margin-top: auto;
        margin-bottom: auto;
    }
    </style>

    <div class="mid-contain">
        <div class="container-fluid">
            <div class="main-body">
                <div class="main-body-upper">
                    @if($api_failed>0)
                    <!-- <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
                        Distance filter failed for {{$api_failed}} candidates (API failed or data missing).
                        <button type="button" class="close float-right cut-btn-alert" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    @endif

                    <div class="form-sec gl-form p-3 filter-div" style="background: #f8f4fb;">
                        <div class="filter-loader"></div>
                        <div class="sec_head_mn mb-3 ">
                            <h2 class="filter-search-h2">Filter Your Search</h2>
                        </div>
                        <form id="filters-form">
                            <div class="row ">
                                <div class="col-md-9">
                                    <div class="d-flex flex-wrap filter-row">
                                        <input type="hidden" id="past_tags" value="{{ $selectCurrentPosition }}">
                                        <input type="hidden" id="live_tags">
                                        <div class="col- filter-col-box tag-input-field animated-background">
                                            <script src="{{asset('assets/be/taginput/bootstrap-tagsinput.min.js')}}"></script>
                                            <link rel="stylesheet" href="{{asset('assets/be/taginput/bootstrap-tagsinput.css')}}"/>
                                            <div class="col- filter-col-box form-group position-input">
                                                <input class="js-select2 current_position_filter_btn2 form-control" data-role="tagsinput" placeholder="Search by Current Title" value="{{ $selectCurrentPosition }}"/>
                                                {{-- task - 86a26mx9v <span class="tag-input-msg" style="font-size: 13px; color: red;display: none;">After text input press enter</span> --}}
                                            </div>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <div class="dropdown">
                                                <button class=" filter-btn m-0 select2-selection__rendered dd_year_of_exp w-100 text-left" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Yrs of exp
                                                </button>
                                                <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButtonInd">
                                                    <div class="row m-0 p-2">
                                                        <div class="col-11">
                                                            <h5>Years of experience</h5>
                                                            {{-- task - 86a1n50af --}}
                                                            <div class="range-slider-field">
                                                            <input type="text" id="experience-slide" class="js-range-slider" name="my_range" value=""
                                                                data-type="double"
                                                                data-min="0"
                                                                data-max="40"
                                                                data-from="0"
                                                                data-to="40"
                                                                data-grid="false"
                                                            />
                                                            </div>
                                                            <input type="hidden" id="filterYearOfExperience" value="{{$filterYearOfExperience}}">
                                                            <input type="hidden" class="js-select2 min-range" id="min-range" value="{{$selectMinYearOfExperience}}">
                                                            <input type="hidden" class="js-select2 max-range" id="max-range" value="{{$selectMaxYearOfExperience}}">
                                                        </div>
                                                        <div class="col-1 float-right"><a href="jasvascript:void(0)" class="float-right cut-range">x</a></div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 salary_range_filter_btn" multiple="multiple" placeholder="fsafas">
                                                @foreach ($all_salaries as $key => $salary)
                                                <option value="{{ $key }}" data-badge="" id="flexCheckDefault{{$key}}{{$salary}}" class="industries_checkbox"> {{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-  filter-col-box animated-background">
                                            <select class="js-select2 compensation_filter_btn" multiple="multiple" placeholder="fsafas">
                                                @foreach ($all_compensations as $key => $compensation)
                                                <option value="{{ $compensation }}" data-badge="" id="flexCheckDefault{{$key}}{{$compensation}}" class="industries_checkbox"> {{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- task - 86a0qfnhg --}}
                                        <input type="hidden" id="is_run" value="{{ $is_run }}">
                                        <input type="hidden" name="is_submit" id="is_submit" value="{{$is_submit}}">
                                        <input type="hidden" name="is_filtered" id="is_filtered" value="{{$is_filtered}}">
                                        <div class="col- filter-col-box animated-background">
                                            <div class="dropdown">
                                                <button class=" filter-btn m-0 select2-selection__rendered dd_year_of_exp-dist  text-left" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Distance
                                                </button>
                                                <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButtonInd">
                                                    <div class="row m-0 p-2">
                                                        <div class="col-11">
                                                            <h5>Distance By Mile</h5>
                                                            {{-- task - 86a1n50af --}}
                                                            <div class="range-slider-field2">
                                                            <input type="text" id="distance-slide" class="js-range-slider" name="my_range" value=""
                                                                data-type="double"
                                                                data-min="0"
                                                                data-max="100"
                                                                data-from="0"
                                                                data-to="100"
                                                                data-grid="false"
                                                            />
                                                            </div>
                                                            <input type="hidden" id="filterDistance" value="{{$filterDistance}}">
                                                            <input type="hidden" class="js-select2 min-range-distance" id="min-range-distance" value="{{$selectMinDistance}}">
                                                            <input type="hidden" class="js-select2 max-range-distance" id="max-range-distance" value="{{$selectMaxDistance}}">
                                                        </div>
                                                        <div class="col-1 float-right"><a href="jasvascript:void(0)" class="float-right cut-range-dist">x</a></div>

                                                        {{-- task - 86a2vxnfa --}}
                                                        <div class="col-12">
                                                            <p class="text-danger distance-text">Distance is calculated from zip code associated with your subscription.</p>
                                                        </div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col- filter-col-box animated-background">

                                            <select class="js-select2 schedule_filter_btn" multiple="multiple" placeholder="fsafas">
                                                @foreach ($all_schedules as $key => $schedule)
                                                <option value="{{ $schedule }}" data-badge="" id="flexCheckDefault{{$key}}{{$schedule}}" class="industries_checkbox"> {{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 zipcode_filter_btn" multiple="multiple" placeholder="fsafas" >
                                                @foreach (array_unique($all_zipcodes) as $key => $zipcode)
                                                <option value="{{ $zipcode }}" data-badge="" id="flexCheckDefault{{$key}}{{$zipcode}}" class="industries_checkbox" > {{ $zipcode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 interest_filter_btn" multiple="multiple" placeholder="fsafas">
                                                @foreach ($all_interests as $key => $interest)
                                                <option value="{{ $interest }}" data-badge="" id="flexCheckDefault{{$key}}{{$interest}}" class="industries_checkbox"> {{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 industries_filter_btn" multiple="multiple" placeholder="fsaffgsdgfsgfas">
                                                @foreach ($all_industries as $key => $ind)
                                                <option value="{{ $ind }}" data-badge="" id="flexCheckDefault{{$key}}{{$ind}}" class="industries_checkbox"> {{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 hard_skills_filter_btn" multiple="multiple" placeholder="fsafas">
                                                @foreach ($all_hard_skills as $key => $skill)
                                                <option value="{{ $skill }}" data-badge="" id="flexCheckDefault{{$key}}{{$skill}}" class="industries_checkbox"> {{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 soft_skills_filter_btn" multiple="multiple" placeholder="fsafas">
                                                @foreach ($all_soft_skills as $key => $skill)
                                                <option value="{{ $skill }}" data-badge="" id="flexCheckDefault{{$key}}{{$skill}}" class="industries_checkbox"> {{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 work_environment_filter_btn" multiple="multiple" placeholder="fsafas">
                                                @foreach ($all_work_environments as $key => $environment)
                                                <option value="{{ $environment }}" data-badge="" id="flexCheckDefault{{$key}}{{$environment}}" class="industries_checkbox"> {{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-  filter-col-box animated-background">
                                            <select class="js-select2 languages_filter_btn" multiple="multiple" placeholder="fsafas" form="save-search" wire:model="selectedLanguages" name="selectedLanguages">
                                                @foreach ($all_languages as $key => $language)
                                                <option value="{{ $language }}" data-badge="" id="flexCheckDefault{{$key}}{{$language}}" class="industries_checkbox"> {{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" class="firstSearch" value="true">
                                        <span class="mt-2">
                                            <a href="javascript:void(0)" class="clear-filter-btn float-right mr-2 hide-clr-btn"><span class="m-0"><i class="fa fa-times"></i></span>
                                                Clear All Filters</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 text-end">
                                    <div class="col-  filter-col-box filter-btn">
                                        <button class="save-btn save-search-btn blue_btn" type="submit">
                                           Run Search
                                            <span><i class="fa fa-search"></i></span>
                                        </button>
                                    </div>

                                    <div class="save-btn-otr col hidden-btn-filter filter-btn">
                                        {{-- wire:click="clearMessage()" --}}
                                        <a class="save-btn new float-right open-save-search-btn" href="javascript:void(0)" data-bs-target="#saveSearchModal" data-bs-toggle="modal" data-bs-dismiss="modal" class="eyeBall">Save & Name Search
                                            <span><img src="{{ asset('assets/be/images/save-icon.svg') }}" alt="" /></span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

            <div class="view_cancidate_all_set">
                <div class="row view_cancidate_all_set_row gy-3">
                    <div class="col-xl-5 col-lg-9 view_cancidate_all_set_col_lft">
                        <div class="sec_head_mn sec_head_mn-all mt-2">
                            <h2>View All Candidates</h2>
                        </div>

                        {{-- 86a2p9nh0 --}}
                        @if(!empty($filteredUserCount) && !empty(count($searched_users_id)))
                            @if($filteredUserCount>0)
                                <div class="sec_head_mn  mt-2">
                                    <h6 class="searched-count">{{ $filteredUserCount }} @if($filteredUserCount==1) Candidate @else Candidates @endif  Match Your Search</h6>
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="col-xl-7 col-lg-3 view_cancidate_all_set_col_rtt">
                        <div class="view_cancidate_all_set_col_rtt_innr">
                            {{-- task - 86a2vwzh3 --}}
                            <div class="suggestion_search_wrapper">
                                <ul>
                                    <li>
                                        <a href="javascript:;" class="{{$category == 'favorites' ? 'active' : ''}}" wire:click="filterByCategory('{{$category == 'favorites' ? '' : 'favorites'}}')">
                                            {{-- task - 86a31kyba --}}
                                            <span class="ic_award_icn {{ $category == 'favorites'  ? 'hover_fav' : ''}}">
                                                <svg class="not_new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z" fill="#FFAE1A"></path>
                                                </svg>
                                            </span> &nbsp;
                                            My Favorites
                                            (<span id="favorite_cnt">{{ $favorites_count }}</span>)</a>
                                    </li>
                                </ul>
                            </div>
                            {{-- task - 86a2vwzh3 end --}}

                            <div class="dropdown sort-dropdown neww">
                                @php
                                    $sort_by_arr = array(
                                        '' => '',
                                        'alpha' => 'A to Z',
                                        'distance' => 'Distance',
                                        'newest' => 'Newest',
                                        'experience' => 'Experience',
                                    );
                                @endphp
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort By <span class="sort_by_val">{{ $sort_by_arr[$sortBy] }}</span>
                                </button>
                                {{-- task - 86a2vxfb2 --}}
                                <a href="javascript:;" id="change_order" class="p-2">
                                    <img src="{{asset('assets/be/images/'.$sort_icon)}}" alt="" />
                                    <img src="{{asset('assets/be/images/'.$sort_icon2)}}" alt="" />
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    {{-- task - 8678ffjx0 <li>
                                        <a class="dropdown-item sort-tab" href="#" data-type="alpha"> A to Z </a>
                                    </li> --}}
                                    <li>
                                        <a class="dropdown-item sort-tab py-2 {{ $sortBy=="distance" ? 'bg-purple text-white' : '' }}" href="javascript:;" data-type="distance"> Distance </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item sort-tab py-2 {{ $sortBy=="newest" ? 'bg-purple text-white' : '' }}" href="javascript:;" data-type="newest"> Newest </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item sort-tab py-2 {{ $sortBy=="experience" ? 'bg-purple text-white' : '' }}" href="javascript:;" data-type="experience">
                                            Experience
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="list_grid_wrapper">
                                <ul class="ps-0">
                                    <li class="{{($active_tab==1) ? 'active' : '' }} grid">
                                        <button class="grid" data-target="content-1">
                                            <img src="{{ asset('assets/be/images/grid.svg') }}" alt="" />
                                        </button>
                                    </li>
                                    <li class="{{($active_tab==2) ? 'active' : '' }} list">
                                        <button class="list" data-target="content-2">
                                            <img src="{{ asset('assets/be/images/list.svg') }}" alt="" />
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $com_user_arr = array_column($company_users, 'deleted_at', 'user_id');
                @endphp
                <div class="listgrid_cnt {{($active_tab==1) ? 'active' : '' }}" id="content-1">
                    <div class="row candiate_list_view_parent_row gy-4 candidate_box_parent">

                        @foreach ($candidates as $candidate)
                        {{-- task - 86a0unh6f --}}
                        @php
                            $list_row = 1;
                            if(array_key_exists($candidate->id ,$com_user_arr)) {
                                $u_key = array_search($candidate->id, array_column($company_users, 'user_id'));
                                if(!is_null($com_user_arr[$candidate->id])) {
                                    $list_row = 0;
                                } elseif($u_key >= 0) { // task - 86a0unmm4
                                    if($company_users[$u_key]['status'] == 2) {
                                        $list_row = 0;
                                    }
                                }
                            }
                        @endphp

                        @if($list_row == 1)

                        {{-- yrs of Experience login --}}
                        @php
                            $employments = []; $yrs_of_exp = 0; $exp_months = 0;
                            if($candidate->employments->count()) {
                                $employments = $candidate->employments->toArray();

                                $currently_working = array_values($candidate->employments->where('currently_working', 1)->toArray());
                                $currently_start_years = (array_column($currently_working, 'start_year'));
                                $currently_end_years = (array_column($currently_working, 'end_year'));

                                $manual_records = array_values($candidate->employments->where('currently_working', 0)->toArray());
                                $manual_start_years = (array_column($manual_records, 'start_year'));
                                $manual_end_years = (array_column($manual_records, 'end_year'));

                                $tmp_year = [];
                                if(count($currently_working)) {
                                    $currently_start_years = array_map(function($element) {
                                            $_yr = substr($element, -4);
                                            return date('Y', strtotime('Jan ' . $_yr));
                                        },
                                        $currently_start_years
                                    );
                                    $c_min_year = min($currently_start_years);
                                    $c_max_year = date('Y');

                                    for($y=$c_min_year; $y<= $c_max_year; $y++) {
                                        $tmp_year[$y] = $y;
                                    }
                                }

                                if(count($manual_records)) {
                                    $manual_start_years = array_map(function($element) {
                                            $_yr = substr($element, -4);
                                            return date('Y', strtotime('Jan ' . $_yr));
                                        },
                                        $manual_start_years
                                    );

                                    $manual_end_years = array_map(function($element) {
                                            $_yr = substr($element, -4);
                                            return date('Y', strtotime('Jan ' . $_yr));
                                        },
                                        $manual_end_years
                                    );
                                    $m_min_year = min($manual_start_years);
                                    $m_max_year = max($manual_end_years);

                                    for($y=$m_min_year; $y<= $m_max_year; $y++) {
                                        $tmp_year[$y] = $y;
                                    }
                                }

                                if($tmp_year) {
                                    $min_year = min($tmp_year);
                                    $max_year = max($tmp_year);

                                    $yrs_of_exp = $max_year - $min_year;
                                }
                            }
                        @endphp
                        {{-- yrs of Experience login end --}}

                        {{-- 86a3pydn9 dashboard  --}}
                        <div class="col-xl-4 col-md-6 candiate_list_view_parent_col candidate-card" data-id="{{ $candidate->id }}">
                                    @php $hired_employee=""; @endphp
                                        @if(!empty($candidate->delete_status))
                                        <!-- @if($candidate->delete_status->type=='sleep')
                                        <span class="hired">Hired</span><span class="hired-flag"></span>
                                        @php $hired_employee="blured_box";@endphp -->
                                        <!-- @endif -->
                                        <span class="hired">Hired</span><span class="hired-flag"></span>
                                        @php $hired_employee="blured_box";@endphp
                                        @elseif (time() - strtotime($candidate->created_at) < 60*60*24)
                                            <span class="hired bg-danger ">New!</span><span class="hired-flag bg-danger"></span>
                                                @php $hired_employee="flaged";@endphp
                                        @else
                                        @if($candidate->companyStatus->first())
                                        @if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2)
                                        <span class="pending-label position-static" ><span class="hired">Requested</span><span class="hired-flag"><i class="iconc"><img src="{{asset('assets/be/images/clock-white.svg')}}" alt=""></i></span></span>
                                            @php $hired_employee="requested";@endphp
                                        @else
                                        <span class="unmasked-flag position-static">
                                            <span class="hired">Unmasked</span><span class="hired-flag"></span>
                                            @php $hired_employee="flaged";@endphp
                                        </span>

                                        @endif
                                        @else
                                        @endif
                                        @endif

                                    <!-- card grid -->
                                    <div class="text-capitalize candidate_grid_ppl_wppt {{$hired_employee}}" data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} " data-id="{{$candidate->id}}"  first-cnt-card>
                                        <div class="candidate_grid_ppl px-2 h-auto" style="background-image:url('{{ asset('assets/be/images/shape_left_pnk.png') }}');background-repeat: no-repeat;padding: 10px;border: 1px solid #ccc;  box-sizing: border-box;min-height: 289px;">
                                        <div class="candidate_grid_ppl_icn">
                                                <ul class="ps-5- " style="">
                                                    <li>
                                                        <a href="#url" class="clickd_tgl_searches"><svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="ellipsis-icon">
                                                                <circle cx="17.5" cy="12" r="1.5" />
                                                                <circle cx="12" cy="12" r="1.5" />
                                                                <circle cx="6.5" cy="12" r="1.5" />
                                                            </svg></a>
                                                        <div class="clickd_tgl_searches_open">
                                                            <div class="clickd_tgl_searches_open_head">
                                                                <h5>Manage Matched Searches</h5>
                                                                {{-- task - 86a1gr1cr --}}
                                                                {{-- task - 86a2vxac0 --}}
                                                                @if(count($saved_searches) == 0)
                                                                <h5 class="text-muted"><small>Create a search & save it to use this function</small></h5>
                                                                @endif
                                                            </div>
                                                            <div class="clickd_tgl_searches_open_ul">
                                                                <div class="form_input_check">
                                                                    @foreach($saved_searches as $key => $searchSingle)
                                                                    @php $is_checked = in_array($candidate->id, $searchSingle->candidate_ids) ? 1 : 0; @endphp
                                                                    <label>
                                                                        <input type="checkbox" class="manual_add_saved_serach" data-search-id="{{ $searchSingle->id }}" data-candidate="{{ $candidate->id }}" wire:click="changeEvent('{{ $is_checked }}', '{{ $searchSingle->id }}','{{ $candidate->id }}')" {{ $is_checked ? 'checked' : '' }} />
                                                                        <span>{{ $searchSingle->name }}</span>
                                                                    </label>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="float-right me-1">
                                                        <a href="#url" class="m-0 flag_ico_sec favorite_{{$candidate->id}} {{ in_array($candidate->id, $my_favorites) ? 'hover_fav' : '' }} @if($hired_employee) flag_ico_sec_flaged @endif" onclick="{{ !in_array($candidate->id, $my_favorites) ? "saveFavorite(" . $candidate->id .")" : "removeFavorite(" . $candidate->id . ")"}}">
                                                    <svg class="not_new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z" fill="#FFAE1A"></path>
                                                    </svg>
                                                </a>
                                                    </li>

                                                </ul>
                                            </div>
                                            {{-- <div class="candidate_top_pnk_ic">
                                                <img src="{{ asset('assets/be/images/shape_left_pnk.png') }}" alt="" />
                                            </div> --}}


                                            <div class="candidate_grid_ppl_top- ">
                                                <div class="row w-100 mt-3">
                                                <div class="col-3 mt-3 ps-1">
                                                    <figure class="main_img rounded-circle">
                                                        @if($candidate->companyStatus->first())
                                                            @if($candidate->companyStatus->first()->pivot->status == 0)
                                                                <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail rounded-circle" />
                                                                {{-- <img src="{{ asset($candidate->profile_photo_path) }}" alt="" class="" /> --}}
                                                            @else
                                                                @if($candidate->profile_photo_path)
                                                                    <img src="{{ asset($candidate->profile_photo_path) }}" alt="" class="rounded-circle" />
                                                                @else
                                                                    <img src="{{asset('assets/fe/images/default_user.png')}}" alt="" class="rounded-circle" />
                                                                @endif
                                                            @endif
                                                        @else
                                                            {{-- task - 86a1tzdqv - POINT - 8 --}}
                                                            @if($candidate->personal->profile_status == 0)
                                                                <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail rounded-circle" />
                                                            @else
                                                                <img src="{{ asset($candidate->profile_photo_path) }}" alt="" class="rounded-circle" />
                                                            @endif
                                                        @endif
                                                    </figure>
                                                </div>
                                                <div class="col-5 ps-3">
                                                    <div class="candidate_grid_ppl_top_rt-  mt-3">
                                                        <span class="grid-box-detail">
                                                            @if(empty($candidate->companyStatus->first()->pivot->status))
                                                                @if(!empty($candidate->name))
                                                                    {{-- task - 86a1tzdqv - POINT - 8 --}}
                                                                    @if($candidate->personal->name_status == 0)
                                                                        @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                                        <h6 class="blured_txt mb-1">{{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}}</h6>
                                                                    @else
                                                                        <h6 class=" mb-1">{{ $candidate->name }} </h6>
                                                                    @endif
                                                                @else
                                                                    <h6 class="blured_txt mb-1">Candidate Name</h6>
                                                                @endif
                                                                @else
                                                                <h6 class=" mb-1">{{ $candidate->name }} </h6>
                                                                @endif

                                                                @if(empty($candidate->companyStatus->first()->pivot->status))
                                                                    @if(!empty($candidate->personal))
                                                                    @if($candidate->personal->current_title_status)
                                                                        <p>@if(!empty($candidate->personal->current_title)){{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }} @endif</p>
                                                                    @else
                                                                        @php $length = (strlen($candidate->personal->current_title) > 20) ? 20 : strlen($candidate->personal->current_title); @endphp
                                                                        <p class="blured_txt">@if(!empty($candidate->personal->current_title)) {{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}} @endif</p>
                                                                    @endif
                                                                    @endif
                                                                    @else
                                                            <p>@if(!empty($candidate->personal->current_title)){{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }} @endif</p>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-4 px-0 grid-view-exp">


                                                        <div class="align-self-center-  lign-height-point-e m-0 mt-3">
                                                            <span class="grid-exp -grid-exp{{$hired_employee}} m-0"> @php
                                                                expGraphic($yrs_of_exp);
                                                                @endphp
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                                <div class="row ps-2 mt-1">
                                                    <div class="col-6 mt-2">
                                                        <div class="candidate_grid_ppl_top_btm_wrap">

                                                            @php
                                                            $worksetting="";
                                                            $worksettingIcon="";
                                                            if(!empty($candidate->personal->work_environment_remote)){
                                                                $worksetting .="Remote/" ;
                                                            }
                                                            if(!empty($candidate->personal->work_environment_in_office)){
                                                                $worksetting .="In Office/" ;
                                                            }
                                                            if(!empty($candidate->personal->work_environment_hybrid)){
                                                                $worksetting .="Hybrid" ;
                                                            }
                                                            if((!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)) || !empty($candidate->personal->work_environment_hybrid)){
                                                                $worksettingIcon= "location";
                                                            }
                                                            @endphp

                                                            <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                <p><i class="primary-icon fa fa-map-marker" aria-hidden="true"></i> {{rtrim($worksetting, '/')}}</p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-6 mt-2">
                                                        <div class="candidate_grid_ppl_top_btm_wrap">

                                                            <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                @if (isset($candidate->industries))
                                                                <p > <i class="icon_candt"><img src="{{ asset('assets/be/images/ic1.svg') }}" alt="" /></i> {{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                                </p>
                                                                @endif
                                                                <!-- <p>{{$candidate->personal ? $candidate->personal->address : ''}},{{$candidate->personal ? $candidate->personal->state_abbr : ''}}</p> -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-6 mt-2">
                                                        <div class="candidate_grid_ppl_top_btm_wrap">

                                                            <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                <h6><i class="icon_candt"><img src="{{ asset('assets/be/images/ic3.svg') }}" alt="" /></i> Asking Salary</h6>
                                                                <p class="" >{{ $candidate ? $candidate->personal->salary_range : '' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-6 mt-2">
                                                        <div class="candidate_grid_ppl_top_btm_wrap">

                                                            <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                <h6> <i class="icon_candt"><img src="{{ asset('assets/be/images/ic4.svg') }}" alt="" /></i> Area of Interest</h6>
                                                                @if (isset($candidate->interests))
                                                                @if ($candidate->interests->first())
                                                                <p >{{ $candidate->interests->first()->name }}</p>
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mt-2">
                                                        @if(!empty($candidate->personal->zip_code))
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <h6 class="d-flex gap-1">
                                                        <span class="grid-card-icons">
                                                       <i class="fa fa-map-marker primary-icon" aria-hidden="true" style="font-size:11px;"></i>
                                                       </span>
                                                        ZIPCODE
                                                        <h6>
                                                        <p class="zip-code-p " >  {{ $candidate->personal->zip_code }}</p>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-6 mt-2">
                                                         {{-- ================== gird card --}}

                                                                @if($candidate->companyStatus->first())
                                                                    @if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2)
                                                                        {{-- <div class="pending_unmask">
                                                                            <i class="iconc">
                                                                                <img src="{{ asset('assets/be/images/clock.svg') }}" alt="">
                                                                            </i>
                                                                            <div class="pending_unmask_rt">
                                                                                <h6>Pending Unmask</h6>
                                                                                <p>Profile Saved In Requested</p>
                                                                            </div>
                                                                        </div> --}}
                                                                    @else
                                                                        <div class="unmasked_div_ic p-0 ps-2">
                                                                            <i class="iconc">
                                                                                <img src="{{ asset('assets/be/images/unmasked.svg') }}" alt="">
                                                                            </i>
                                                                            <div class="unmasked_div_ic_rtt">
                                                                                <h6>Unmasked</h6>
                                                                                <p>View Unmasked Profile Now</p>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    @php
                                                                        // task - 86a1tzdqv - POINT - 8 | 86a2rvv8z
                                                                        if(is_null($candidate->personal_status)) {
                                                                            $personal_status = explode(',', $personal_status_[$candidate->id]);
                                                                            $edu_status = explode(',', $edu_status_[$candidate->id]);
                                                                            $emp_status = explode(',', $emp_status_[$candidate->id]);
                                                                            $ref_status = explode(',', $ref_status_[$candidate->id]);
                                                                        } else {
                                                                            $personal_status = explode(',', $candidate->personal_status);
                                                                            $edu_status = explode(',', $candidate->edu_status);
                                                                            $emp_status = explode(',', $candidate->emp_status);
                                                                            $ref_status = explode(',', $candidate->ref_status);
                                                                        }
                                                                        // task - 86a1tzdqv - POINT - 8 end
                                                                    @endphp

                                                                    {{-- task - 86a1tzdqv - POINT - 8 check if fully visible profile --}}
                                                                    @if(in_array('0', $personal_status) || in_array('0', $edu_status) || in_array('0', $emp_status) || in_array('0', $ref_status))
                                                                        <!-- <a href="javascript:void(0)" class="req_mask_btn" wire:click.prevent="sendRequest({{ $candidate->id }})"> -->
                                                                        <a href="javascript:void(0)" class="req_mask_btn req_mask_btn_grid" style="padding: 6px 6px;">
                                                                            <i class="ic_req_m" style="width:25px;height:25px;">
                                                                                <img src="{{ asset('assets/be/images/masked.svg') }}" alt="" />
                                                                            </i>
                                                                            <div class="req_mask_btn_rtt" wire:loading.remove wire:target="sendRequest({{ $candidate->id }})" style="padding-left: 7px; font-size: 11px;">
                                                                                Request Unmask
                                                                            </div>
                                                                            <div class="req_mask_btn_rtt" wire:loading wire:target="sendRequest({{ $candidate->id }})" style=" padding-left: 7px; font-size: 11px;">
                                                                                Sending...
                                                                            </div>
                                                                        </a>

                                                                        <div class="modal fade inline-table-modal" id="send-request-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" wire:ignore.self>
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <button type="button" class="close float-right send-rew-cut" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    <div class="modal-body">
                                                                                        <div class="position_form" wire:ignore.self>
                                                                                            <form wire:submit.prevent="sendRequest({{ $candidate->id }})">
                                                                                                <div class="form-group">
                                                                                                    <label>Subject*</label>
                                                                                                    <input type="text" class="form-control" {{-- task - 86a2rvv8z placeholder="Job title here" --}} wire:model.defer="position_hiring" />
                                                                                                    <input type="hidden" class="form-control" placeholder="Job title here" wire:model.lazy="user_id" value="{{ $candidate->id }}" />
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Message to Candidate</label>
                                                                                                    <textarea {{-- task - 86a2rvv8z placeholder="I reviewed your resume..." --}} wire:model.defer="message"></textarea>
                                                                                                </div>
                                                                                                <div class="position-submit-btn-otr" wire:loading.remove wire:target="sendRequest">
                                                                                                    <input type="submit" value="Send to Candidate" class="position_submit_btn" />
                                                                                                </div>
                                                                                                <div class="position-submit-btn-otr" wire:loading wire:target="sendRequest">
                                                                                                    <input type="submit" value="Sending..." disabled class="position_submit_btn" />
                                                                                                </div>
                                                                                                <span style="color: var(--purple);" class="request_message" wire:ignore></span>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            {{-- ================== gird card --}}
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    {{-- task - 86a1tzdqv @include('inc.candidateProfile', ['userId' => $candidate->id]) --}}

                                    {{-- task - 86a2vx5er --}}
                                    @php $user_id = $candidate->id; $candidate_user = $candidate; $favorites = $my_favorites; $search_id = 0; $company_id = $company; @endphp
                                @livewire('inc-candidates-profile', compact('user_id', 'candidate_user', 'favorites', 'search_id', 'saved_searches', 'company_id', 'relevants', 'non_relevants'), key(time()))
                        </div>
                        {{-- 86a3pydn9 dashboard  --}}

                        @endif
                        @endforeach
        </div>

       @if($filteredUserCount > 0)
            @if(count($candidates)<$filteredUserCount)
                <a href="#url" class="load_more" wire:click="loadMore">
                    <i><img src="{{ asset('assets/be/images/load_ic.svg') }}" alt="" /></i>
                    <span class="loadSpan">Load More</span>
                </a>
            @else
                <p class="text-center text-muted m-2">No More Candidate Matches Found</p>
            @endif
        @else
            <p class="text-center text-muted m-2">No Candidate Matches Found</p>
        @endif
    </div>

        <div class="candidate-card listgrid_cnt  {{($active_tab==2) ? 'active' : '' }} candidate_box_parent" id="content-2">
            @foreach ($candidates as $candidate)
            {{-- task - 86a0unh6f --}}
            @php
                $list_row = 1;
                if(array_key_exists($candidate->id ,$com_user_arr)) {
                    $u_key = array_search($candidate->id, array_column($company_users, 'user_id'));
                    if(!is_null($com_user_arr[$candidate->id])) {
                        $list_row = 0;
                    } elseif($u_key >= 0) { // task - 86a0unmm4
                        if($company_users[$u_key]['status'] == 2) {
                            $list_row = 0;
                        }
                    }
                }
            @endphp

            @if($list_row == 1)

                {{-- yrs of Experience login --}}
                @php
                    $employments = []; $yrs_of_exp = 0; $exp_months = 0;
                    if($candidate->employments->count()) {
                        $employments = $candidate->employments->toArray();

                        $currently_working = array_values($candidate->employments->where('currently_working', 1)->toArray());
                        $currently_start_years = (array_column($currently_working, 'start_year'));
                        $currently_end_years = (array_column($currently_working, 'end_year'));

                        $manual_records = array_values($candidate->employments->where('currently_working', 0)->toArray());
                        $manual_start_years = (array_column($manual_records, 'start_year'));
                        $manual_end_years = (array_column($manual_records, 'end_year'));

                        $tmp_year = [];
                        if(count($currently_working)) {
                            $currently_start_years = array_map(function($element) {
                                    $_yr = substr($element, -4);
                                    return date('Y', strtotime('Jan ' . $_yr));
                                },
                                $currently_start_years
                            );
                            $c_min_year = min($currently_start_years);
                            $c_max_year = date('Y');

                            for($y=$c_min_year; $y<= $c_max_year; $y++) {
                                $tmp_year[$y] = $y;
                            }
                        }

                        if(count($manual_records)) {
                            $manual_start_years = array_map(function($element) {
                                    $_yr = substr($element, -4);
                                    return date('Y', strtotime('Jan ' . $_yr));
                                },
                                $manual_start_years
                            );

                            $manual_end_years = array_map(function($element) {
                                    $_yr = substr($element, -4);
                                    return date('Y', strtotime('Jan ' . $_yr));
                                },
                                $manual_end_years
                            );
                            $m_min_year = min($manual_start_years);
                            $m_max_year = max($manual_end_years);

                            for($y=$m_min_year; $y<= $m_max_year; $y++) {
                                $tmp_year[$y] = $y;
                            }
                        }

                        if($tmp_year) {
                            $min_year = min($tmp_year);
                            $max_year = max($tmp_year);

                            $yrs_of_exp = $max_year - $min_year;
                        }
                    }
                @endphp
                {{-- yrs of Experience login end --}}

                @php $hired_employee=""; @endphp
                @if(!empty($candidate->delete_status))
                    @if($candidate->delete_status->type=='sleep')
                    @php $hired_employee="blured_box";@endphp
                    @endif
                @endif
                {{-- /*Task #86a0cfd7f*/ --}}
                @if (time() - strtotime($candidate->created_at) < 60*60*24)
                    @php $hired_employee="new-employee";@endphp
                @endif
                <div class="listview_candidate_details_w detail_{{$hired_employee}} candidate-card" data-id="{{$candidate->id}}">
                    @if(!empty($candidate->delete_status))
                        @if($candidate->delete_status->type=='sleep')
                        <span class="hired">Hired</span><span class="hired-flag"></span>
                    @endif
                    @endif
                    {{-- /*Task #86a0cfd7f*/ --}}
                    @if (time() - strtotime($candidate->created_at) < 60*60*24)
                        <span class="hired bg-danger">New!</span><span class="hired-flag bg-danger"></span>
                        @endif

                    <div class="text-capitalize listview_candidate_details row mx-0  {{$hired_employee}}" data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} " data-id="{{$candidate->id}}">
                        <div class="layout_back" style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;" >
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                            <div class="listview_candidate_details_img">
                                @if($candidate->companyStatus->first())
                                    @if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2)
                                        @if($candidate->personal->profile_status == 0)
                                         <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail" />
                                        @else
                                         <img src="{{ asset($candidate->profile_photo_path) }}" alt="" class="" />
                                        @endif
                                    @else
                                        @if($candidate->profile_photo_path)
                                            <img src="{{ asset($candidate->profile_photo_path) }}" alt="" class="" />
                                        @else
                                            <img src="{{asset('assets/fe/images/default_user.png')}}" alt="" class="" />
                                        @endif
                                    @endif
                                @else
                                    {{-- task - 86a1tzdqv - POINT - 8 --}}
                                    {{-- @if($candidate->personal->profile_status == 0)
                                        <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail" />
                                    @else
                                    @endif --}}
                                        {{-- <img src="{{ asset($candidate->profile_photo_path) }}" alt="" class="" /> --}}

                                    {{-- task - 86a23ej3p @if($candidate->personal->profile_status == 0)
                                        <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail" />
                                    @else
                                        <img src="{{ asset($candidate->profile_photo_path) }}" alt="" class="" />
                                    @endif --}}

                                    <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail" />
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-6 mb-2 mb-md-0">
                            <div class="listview_candidate_details_head ">
                                {{-- @if($candidate->companyStatus->first())
                                    @if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2)

                                        @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                        @if(!empty($candidate->name))
                                        <h6 class="blured_txt">{{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}}</h6>
                                        @else
                                        <h6 class="blured_txt">Candidate Name</h6>
                                        @endif
                                    @else
                                        <h6>{{ $candidate->name }} </h6>
                                    @endif
                                @else --}}
                                @if(empty($candidate->companyStatus->first()->pivot->status))
                                    @if(!empty($candidate->name))
                                        {{-- task - 86a1tzdqv - POINT - 8 --}}
                                        @if($candidate->personal->name_status == 0)
                                            @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                            <h6 class="blured_txt">{{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}}</h6>
                                        @else
                                            <h6>{{ $candidate->name }} </h6>
                                        @endif
                                    @else
                                        <h6 class="blured_txt">Candidate Name</h6>
                                    @endif
                                    @else
                                     <h6>{{ $candidate->name }} </h6>
                                    @endif
                                {{-- @endif --}}

                                <div class="ask_salary_sec_rtt p-0">
                                        <h6>Current Title:</h6>
                                        @if(empty($candidate->companyStatus->first()->pivot->status))
                                        @if(!empty($candidate->personal))
                                        @if($candidate->personal->current_title_status)
                                            <p>@if(!empty($candidate->personal->current_title)){{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }} @endif</p>
                                        @else
                                            @php $length = (strlen($candidate->personal->current_title) > 20) ? 20 : strlen($candidate->personal->current_title); @endphp
                                            <p class="blured_txt">@if(!empty($candidate->personal->current_title)) {{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}} @endif</p>
                                        @endif
                                        @endif
                                        @else
                                        <p>@if(!empty($candidate->personal->current_title)){{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }} @endif</p>
                                        @endif
                                    </div>
                                {{-- @if($filterDistance) --}}
                                {{-- <small>{{ $candidate->personal->zip_code }}</small> --}}
                                   {{-- @endif --}}
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0" onclick="/*window.location.href='{ { route('company.candidateprofile', ['user_id' => $candidate->id]) }}'*/">
                            <div class="ecperice_list">
                                <div class="candidate_grid_ppl_top_btm_wrap">
                                    @php
                                                        $worksetting="";
                                                        $worksettingIcon="";
                                                        if(!empty($candidate->personal->work_environment_remote)){
                                                            $worksetting .="Remote/" ;
                                                        }
                                                        if(!empty($candidate->personal->work_environment_in_office)){
                                                            $worksetting .="In Office/" ;
                                                        }
                                                        if(!empty($candidate->personal->work_environment_hybrid)){
                                                            $worksetting .="Hybrid" ;
                                                        }
                                                        if(!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)){
                                                            $worksettingIcon= "location";
                                                        }
                                                        if(!empty($candidate->personal->work_environment_hybrid)){
                                                            $worksettingIcon= "location";
                                                        }
                                                        @endphp
                                                        <i class="primary-icon fa fa-map-marker" aria-hidden="true"></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <p>{{rtrim($worksetting, '/')}}</p>
                                                        </div>
                                </div>

                                <div class="candidate_grid_ppl_top_btm_wrap">
                                    <i class="icon_candt"><img src="{{ asset('assets/be/images/ic1.svg') }}" alt="" /></i>
                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                    @if (isset($candidate->industries))
                                                                <p>{{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                                </p>
                                                                @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0" >
                                <div class="ask_salary_sec align-items-center flex-wrap">
                                    <i class="ic_icon">$</i>
                                    <div class="ask_salary_sec_rtt">
                                        <h6>Asking Salary</h6>
                                        <p>{{ $candidate->personal ? $candidate->personal->salary_range : '' }}</p>
                                    </div>
                                    @if(!empty($candidate->personal->zip_code))
                                    <p class="zip-code-p"><i class="fa fa-map-marker" aria-hidden="true"></i> <span>ZIPCODE {{ $candidate->personal->zip_code }}</span></p>
                                    @endif
                                </div>
                            </div>

                        <div class="col-md-1 col-sm-4 col-6 mb-2 d-flex mb-md-0">
                            {{-- task - 86a2vwzh3 --}}
                            <div class="candidate_grid_ppl_icn large">
                                <a href="#url" class="ic_award_icn favorite_{{$candidate->id}} {{ in_array($candidate->id, $my_favorites) ? 'hover_fav' : '' }}" onclick="{{ !in_array($candidate->id, $my_favorites) ? "saveFavorite(" . $candidate->id .")" : "removeFavorite(" . $candidate->id . ")"}}">
                                    <svg class="not_new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z" fill="#FFAE1A" />
                                    </svg>

                                    <svg class="new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4016 1.09835C17.6984 0.395088 16.7446 0 15.75 0Z" fill="#FFAE1A" />
                                    </svg>
                                </a>
                            </div>
                            {{-- task - 86a2vwzh3 end --}}

                            <div class="candidate_grid_ppl_icn large">
                                <a href="#url" class="clickd_tgl_searches">
                                    <svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="ellipsis-icon">
                                        <circle cx="17.5" cy="12" r="1.5" />
                                        <circle cx="12" cy="12" r="1.5" />
                                        <circle cx="6.5" cy="12" r="1.5" />
                                    </svg></a>
                                <div class="clickd_tgl_searches_open">
                                    <div class="clickd_tgl_searches_open_head">
                                        <h5>Manage Matched Searches</h5>
                                        {{-- task - 86a1gr1cr --}}
                                        @if(count($saved_searches) == 0)
                                        <h5 class="text-muted"><small>Create a filter & save it to use this function</small></h5>
                                        @endif
                                    </div>
                                    <div class="clickd_tgl_searches_open_ul arr_grey">
                                        <div class="form_input_check">
                                            @if(!empty($saved_searches))
                                            @foreach($saved_searches as $key => $search)
                                            @php $is_checked = in_array($candidate->id, $search->candidate_ids) ? 1 : 0; @endphp
                                            <label>
                                                <input type="checkbox" class="manual_add_saved_serach" data-search-id="{{ $search->id }}" data-candidate="{{ $candidate->id }}" wire:click="changeEvent('{{ $is_checked }}', '{{ $search->id }}','{{ $candidate->id }}')" {{ $is_checked ? 'checked' : '' }} />
                                                <span>{{ $search->name }}</span>
                                            </label>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                            @if($candidate->companyStatus->first())
                            @if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2)
                            <div class="pending_unmask">
                                <i class="iconc"><img src="{{asset('assets/be/images/clock.svg')}}" alt=""></i>
                                <div class="pending_unmask_rt">
                                    <h6>Pending Unmask</h6>
                                    <p>Profile Saved In Requested</p>
                                </div>
                            </div>
                            @else
                            <div class="unmasked_div_ic">
                                <i class="iconc"><img src="{{asset('assets/be/images/unmasked.svg')}}" alt=""></i>
                                <div class="unmasked_div_ic_rtt">
                                    <h6>Unmasked</h6>
                                    <p>View Unmasked Profile Now</p>
                                </div>
                            </div>
                            @endif
                            @else
                                @php
                                    // task - 86a1tzdqv - POINT - 8 | 86a2rvv8z
                                    if(is_null($candidate->personal_status)) {
                                        $personal_status = explode(',', $personal_status_[$candidate->id]);
                                        $edu_status = explode(',', $edu_status_[$candidate->id]);
                                        $emp_status = explode(',', $emp_status_[$candidate->id]);
                                        $ref_status = explode(',', $ref_status_[$candidate->id]);
                                    } else {
                                        $personal_status = explode(',',$candidate->personal_status);
                                        $edu_status = explode(',',$candidate->edu_status);
                                        $emp_status = explode(',',$candidate->emp_status);
                                        $ref_status = explode(',',$candidate->ref_status);
                                    }
                                    // task - 86a1tzdqv - POINT - 8 end
                                @endphp

                                {{-- task - 86a1tzdqv - POINT - 8 check if fully visible profile --}}
                                {{-- @if(in_array('0', $personal_status) || in_array('0', $edu_status) || in_array('0', $emp_status) || in_array('0', $ref_status)) --}}
                                    <!-- <a href="javascript:void(0)" class="req_mask_btn" wire:click.prevent="sendRequest({{ $candidate->id }})"> -->
                                    {{-- ================== gird card --}}
                                    <a href="javascript:void(0)" class="req_mask_btn req_mask_btn_list">
                                    {{-- ================== gird card --}}
                                        <i class="ic_req_m"><img src="{{ asset('assets/be/images/masked.svg') }}" alt="" /></i>
                                        <div class="req_mask_btn_rtt" wire:loading.remove wire:target="sendRequest({{$candidate->id}})">Request Unmask </div>
                                        <div class="req_mask_btn_rtt" wire:loading wire:target="sendRequest({{$candidate->id}})">Sending...</div>
                                    </a>

                                    <div class="modal fade inline-table-modal" id="send-request-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" wire:ignore.self>
                                        <div class="modal-dialog" role="document" >
                                            <div class="modal-content">
                                                <button type="button" class="close float-right send-rew-cut" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="modal-body">

                                                    <div class="position_form" wire:ignore.self>

                                                        <form wire:submit.prevent="sendRequest({{$candidate->id}})">
                                                            <div class="form-group">
                                                                <label>Subject*</label>
                                                                <input type="text" class="form-control" {{-- task - 86a2rvv8z placeholder="Job title here" --}} wire:model.defer="position_hiring" />
                                                                <input type="hidden" class="form-control" {{-- task - 86a2rvv8z placeholder="Job title here" --}} wire:model.lazy="user_id" value="{{$candidate->id}}" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Message to Candidate</label>
                                                                <textarea {{-- task - 86a2rvv8z placeholder="I reviewed your resume..." --}} wire:model.defer="message"></textarea>
                                                            </div>
                                                            <div class="position-submit-btn-otr" wire:loading.remove wire:target="sendRequest">
                                                                <input type="submit" value="Send to Candidate" class="position_submit_btn" />
                                                            </div>
                                                            <div class="position-submit-btn-otr" wire:loading wire:target="sendRequest">
                                                                <input type="submit" value="Sending..." disabled class="position_submit_btn" />
                                                            </div>
                                                            <span style="color: var(--purple);" class="request_message" wire:ignore></span>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- @endif --}}
                            @endif
                        </div>

                        <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-dismiss="modal" class="eye-ball2 eyeBall"  data-id="{{ $candidate->id }}">
                            {{expGraphic($yrs_of_exp);}}
                        </a>
                    </div>
            @php $new_userId = $candidate->id @endphp

            {{-- @include('inc.candidateProfile') --}}
            @php $user_id = $candidate->id; $candidate_user = $candidate; $favorites = $my_favorites; $search_id = 0; $company_id = $company; @endphp
            @livewire('inc-candidates-profile', compact('user_id', 'candidate_user', 'favorites', 'search_id', 'saved_searches', 'company_id', 'relevants', 'non_relevants'), key(time()))
        </div>

            @endif

            @endforeach

        @if($filteredUserCount > 0)
            @if(count($candidates)<$filteredUserCount)
                <a href="#url" class="load_more" wire:click="loadMore">
                    <i><img src="{{ asset('assets/be/images/load_ic.svg') }}" alt="" /></i>
                    <span class="loadSpan">Load More</span>
                </a>
            @else
                <p class="text-center text-muted m-2">No More Candidate Matches Found</p>
            @endif
        @else
            <p class="text-center text-muted m-2">No Candidate Matches Found</p>
        @endif
    </div>
</div>
</div>

<div class="main-body-footer">
    <div class="footer-para new">
        <p>
            <span class="copyrite-text">© 2024 Purple Stairs</span>Website by
            <a href="https://www.brand-right.com/" target="_blank" class="brand">
                BrandRight Marketing Group</a>
        </p>
    </div>
</div>
</div>
</div>
</div>
<span class="filter-out">
    {{-- <script src="{{asset('assets/be/js/filters.js')}}"></script> --}}
</span>
@php
    function expGraphic($exp){
        $fistBar=0;
        $secondBar=0;
        $thirddBar=0;

        if($exp<=4){
            $fistBar=0;
            $secondBar=0;
            $thirddBar=0;
        }
        if($exp>=5 && $exp<=10){
            $fistBar=100;
            $secondBar=0;
            $thirddBar=0;
        }
        if($exp>=11 && $exp<=19){
            $fistBar=100;
            $secondBar=100;
            $thirddBar=0;
        }
        if($exp>=20){
            $fistBar=100;
            $secondBar=100;
            $thirddBar=100;
        }
        $yrs='Yrs';
        if($exp<=1){
            $yrs='Yr';
        }
        echo '<span>'.$exp.' '.$yrs.' Experience</span>
        <div class="d-flex exp-progress-bar">
            <div class="progress first-bar">
                <div class="progress-bar w-'.$fistBar.'" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            <div class="progress second-bar">
                <div class="progress-bar w-'.$secondBar.'" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            <div class="progress third-bar">
                <div class="progress-bar w-'.$thirddBar.'" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
        </div>';
    }
@endphp

@include('inc.saveSearch')

</div>


<span class="new-tags">
</span>
@push('scripts')
{{-- task - 86a1n50af --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>
    var all_candidate_ids = $.parseJSON('{{ json_encode($all_candidates_ids) }}'); // task - 86a3150au

    // task - 86a2vxfb2
    $('.sort-dropdown #dropdownMenuButton2, .sort-dropdown .dropdown-menu').on('mouseover', function(event) {
        $(this).addClass('show');
        $('.sort-dropdown .dropdown-menu').addClass('show');
    });

    $('.sort-dropdown #dropdownMenuButton2, .sort-dropdown .dropdown-menu').on('mouseout', function(event) {
        $(this).removeClass('show');
        $('.sort-dropdown .dropdown-menu').removeClass('show');
    });
    // task - 86a2vxfb2 end

    var load_more_complete = 0;
    $("#distance-slide").ionRangeSlider({
        onStart: function (data) {},
        onChange: function (data) {
            // Called every time handle position is changed
            // $('#min-range-distance').val(data.from).trigger('input');
            // $('#max-range-distance').val(data.to).trigger('input');
        },
        onFinish: function (data) {
            // Called then action is done and mouse is released
            $('#min-range-distance').val(data.from);//.trigger('input', false);
            $('#max-range-distance').val(data.to).trigger('input', false);
            console.log(data.to);
        },
        onUpdate: function (data) { /* Called then slider is changed using Update public method console.log(data.from_percent); */ }
    });

    $('#experience-slide').ionRangeSlider({
        onStart: function (data) {},
        onChange: function (data) {
            // Called every time handle position is changed
            // $('#min-range').val(data.from).trigger('input');
            // $('#max-range').val(data.to).trigger('input');
        },
        onFinish: function (data) {
            // Called then action is done and mouse is released
            $('#min-range').val(data.from);//.trigger('input', false);
            $('#max-range').val(data.to).trigger('input', false);
            console.log(data.to);
        },
        onUpdate: function (data) { /* Called then slider is changed using Update public method // console.log(data.from_percent); */ }
    });
</script>

<script>
    // task - 86a2vwzh3
    function saveFavorite(id) {
        $.ajax({
            url: '{{ url('dashboard/savefavorite') }}',
            type: 'POST',
            dataType: 'json',
            data: { 'user_id': id, '_token': '{{ csrf_token() }}' },
            success: function(res) {
                // if(res) {
                    $('.favorite_' + id).addClass('hover_fav');
                    $('.favorite_' + id).attr('onclick', 'removeFavorite(' + id + ')');
                    $('#favorite_cnt').text(res.favorite_cnt);
                // }
            }
        })
    }

    function removeFavorite(id) {
        var _cat = '{{$category}}';
        $.ajax({
            url: '{{ url('dashboard/removefavorite') }}',
            type: 'POST',
            dataType: 'json',
            data: { 'user_id': id, '_token': '{{ csrf_token() }}' },
            success: function(res) {
                // if(res) {
                    $('.favorite_' + id).removeClass('hover_fav');
                    $('.favorite_' + id).attr('onclick', 'saveFavorite(' + id + ')');
                    $('#favorite_cnt').text(res.favorite_cnt);
                // }
            }
        })
    }
    // task - 86a2vwzh3 end

    $(document).on('click', '.request_btn', function(event) {
        /* Act on the event */
        $(this).parent().find(".position_form").toggleClass("active")
    });

    // dev
    $(document).on('click', '.close_req_mask', function(event) {
        $(this).parent().parent().parent().find(".position_form").toggleClass("active");
    });

{{-- 86a2p168x --}}
$('.blured_txt:not(.image_blur):not(.condidate-profile-modal .blured_txt)').each(function() {
       var length= $(this).text().length
         var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var result = Array.from({ length: length }, () => charset.charAt(Math.floor(Math.random() * charset.length))).join('');

       var textLength= $(this).text(result);
    })
    // task - 86a0kdnun
    $('.filter-div .filter-col-box:not(.filter-btn)').addClass('animated-background');
    jQuery(document).ready(function ($) {
        $('.filter-div .filter-col-box:not(.filter-btn)').removeClass('animated-background');
    });
    // task - 86a0kdnun end
    /**
        $('.blured_txt:not(.image_blur)').text('Hidden'); // task - 86a0f55cd
    **/

    // task - 86a3150au
    var arrow_click = 0;
    $(document).on('click', function (e) {
        arrow_click = 0;
        if($(e.target).hasClass('right-arrow') || $(e.target).hasClass('fa-chevron-right')) {
            arrow_click = 1;
        }

        if($(e.target).hasClass('left-arrow') || $(e.target).hasClass('fa-chevron-left')) {
            arrow_click = 1;
        }
    });
    // task - 86a3150au end

    document.addEventListener("livewire:load", () => {
        filters();
        saveSearch();

        // task - 86a3150au
        /*$("body").delegate(".right-arrow", "click", function(e) {
            arrow_click = 1;
            var id = $(this).attr('data-id');
            var current_idx = all_candidate_ids.indexOf(parseInt(id));
            var total_candids = all_candidate_ids.length;

            var next_id = current_idx + 1;
            if (next_id == total_candids) {
              next_id = current_idx;
            }

            var next_candid = all_candidate_ids[next_id];
            if($(document).find('.exampleModalToggle' + next_candid).length == 0) {
                $.ajax({
                    url: '{{ url('company/candidate_modal') }}/' + next_candid,
                    type: 'GET',
                    dataType: 'html',
                    success: function(modal) {
                        $('.view_cancidate_all_set').append(modal);
                        $('.condidate-profile-modal').modal('hide');
                        $(document).find('.modal-backdrop').remove();
                        if($(document).find('.modal-backdrop').length == 0) {
                            $('body').append('<div class="modal-backdrop fade show"></div>');
                        }
                        $(document).find('.exampleModalToggle' + next_candid).modal('show');
                    }
                });
            } else {
                var modal_parent = $(document).find('.exampleModalToggle' + next_candid).parent().parent();
                if($(document).find('.exampleModalToggle' + next_candid).length > 1 && $(modal_parent).hasClass('candidate-card')) {
                    $('.condidate-profile-modal').modal('hide');
                    $(document).find('.modal-backdrop').remove();
                    if($(document).find('.modal-backdrop').length == 0) {
                        $('body').append('<div class="modal-backdrop fade show"></div>');
                    }
                    $('.listgrid_cnt.active').find('.exampleModalToggle' + next_candid).modal('show');
                } else {
                    $('.condidate-profile-modal').modal('hide');
                    $(document).find('.modal-backdrop').remove();
                    if($(document).find('.modal-backdrop').length == 0) {
                        $('body').append('<div class="modal-backdrop fade show"></div>');
                    }
                    $(document).find('.exampleModalToggle' + next_candid).modal('show');
                }
            }
        });*/

        /*$("body").delegate(".left-arrow", "click", function(e) {
            arrow_click = 1;
            var id = $(this).attr('data-id');
            var current_idx = all_candidate_ids.indexOf(parseInt(id));
            var total_candids = all_candidate_ids.length;

            var next_id = current_idx - 1;
            if (next_id <= 0) {
              next_id = 0;
            }

            var next_candid = all_candidate_ids[next_id];
            console.log(next_id, current_idx);
            if(next_id == current_idx && next_id == 0) {
                return false;
            }
            if($(document).find('.exampleModalToggle' + next_candid).length == 0) {
                $.ajax({
                    url: '{{ url('company/candidate_modal') }}/' + next_candid,
                    type: 'GET',
                    dataType: 'html',
                    success: function(modal) {
                        $('.view_cancidate_all_set').append(modal);
                        $('.condidate-profile-modal').modal('hide');
                        $(document).find('.modal-backdrop').remove();
                        if($(document).find('.modal-backdrop').length == 0) {
                            $('body').append('<div class="modal-backdrop fade show"></div>');
                        }
                        $(document).find('.exampleModalToggle' + next_candid).modal('show');
                    }
                });
            } else {
                var modal_parent = $(document).find('.exampleModalToggle' + next_candid).parent().parent();
                if($(document).find('.exampleModalToggle' + next_candid).length > 1 && $(modal_parent).hasClass('candidate-card')) {
                    $('.condidate-profile-modal').modal('hide');
                    $(document).find('.modal-backdrop').remove();
                    if($(document).find('.modal-backdrop').length == 0) {
                        $('body').append('<div class="modal-backdrop fade show"></div>');
                    }
                    $('.listgrid_cnt.active').find('.exampleModalToggle' + next_candid).modal('show');
                    setTimeout(function() {
                        $('.listgrid_cnt.active').find('.exampleModalToggle' + next_candid).modal('show');
                    }, 500);
                    console.log($('.listgrid_cnt.active').find('.exampleModalToggle' + next_candid));
                } else {
                    $('.condidate-profile-modal').modal('hide');
                    $(document).find('.modal-backdrop').remove();
                    if($(document).find('.modal-backdrop').length == 0) {
                        $('body').append('<div class="modal-backdrop fade show"></div>');
                    }
                    $(document).find('.exampleModalToggle' + next_candid).modal('show');
                }
            }
        });*/
        // task - 86a3150au end

        document.querySelector('#filters-form').onkeypress = function(e) {
            if(e.keyCode == 13) {
                e.preventDefault();
            }
        }

        $(document).on('show.bs.modal', '#saveSearchModal', function(event) {
            $('#save-search-form')[0].reset();
            $('.text-danger').remove();
            $('#search_name_error').html('');
        });
    });

    $("body").delegate(".clear-filter-btn", "click", function (e) { // task - 86a0qfnhg
        @this.set('is_run', false);
        // task - 86a1uf3ar
        // @this.set('count', 6);
        @this.set('page', 1);
    });

    var old_tags = [], diff = [], diff2 = [], __tags = []; // task - 86a26mx9v
    $(document).on('change', '.current_position_filter_btn2', function(e){
        console.log($(this).val());
    });

    function filters() {
        $("body").delegate("#filters-form", "submit", function(e, isTrigger = false) {
            $('.inline-table-modal').modal('hide');
            /*console.log('submit E : ' + e);
            console.log('isTrigger : ' + isTrigger);*/
            var industries_filter_btn = $('.industries_filter_btn').val();
            var interest_filter_btn = $('.interest_filter_btn').val();
            var hard_skills_filter_btn = $('.hard_skills_filter_btn').val();
            var soft_skills_filter_btn = $('.soft_skills_filter_btn').val();
            var languages_filter_btn = $('.languages_filter_btn').val();
            var distance_filter_btn = $('.distance_filter_btn').val();
            var current_position_filter_btn = $('.current_position_filter_btn2').val();
            // var seeking_position_filter_btn = $('.seeking_position_filter_btn').val(); task - 862k2tf2f
            var schedule_filter_btn = $('.schedule_filter_btn').val();
            var zipcode_filter_btn = $('.zipcode_filter_btn').val();
            var salary_range_filter_btn = $('.salary_range_filter_btn').val();
            var work_environment_filter_btn = $('.work_environment_filter_btn').val();
            var min_range = $('.min-range').val();
            var max_range = $('.max-range ').val();
            var min_distance = $('.min-range-distance').val();
            var max_distance = $('.max-range-distance').val();
            var compensation_filter_btn = $('.compensation_filter_btn ').val();
            var firstSearch = $('.firstSearch ').val();
            var filterDistance = $('#filterDistance').val(); // task - 86a0btjx8
            var filterYearOfExperience = $('#filterYearOfExperience').val(); // task - 86a0btjx8

            $('#running_search').val(1);

            @this.set('selectedIndustries', industries_filter_btn)
            @this.set('selectedInterests', interest_filter_btn);
            @this.set('selectedInterests', interest_filter_btn);
            @this.set('selectedHardSkills', hard_skills_filter_btn);
            @this.set('selectedSoftSkills', soft_skills_filter_btn);
            @this.set('selectedLanguages', languages_filter_btn);
            @this.set('selectDistance', distance_filter_btn);
            // @this.set('selectSeekingPosition', seeking_position_filter_btn); task - 862k2tf2f
            @this.set('selectCurrentPosition', current_position_filter_btn);
            @this.set('selectSchedule', schedule_filter_btn);
            @this.set('selectZipCode', zipcode_filter_btn);
            @this.set('selectSalaryRange', salary_range_filter_btn);
            @this.set('selectWorkEnvironment', work_environment_filter_btn);
            @this.set('selectMinYearOfExperience', min_range);
            @this.set('selectMaxYearOfExperience', max_range);
            @this.set('selectMinDistance', min_distance);
            @this.set('selectMaxDistance', max_distance);
            @this.set('selectCompensation', compensation_filter_btn);
            @this.set('firstSearch', firstSearch);
            @this.set('is_filtered', true);
            @this.set('is_submit', true);
            @this.set('is_save', true);
            if(!isTrigger) { // task - 86a0qfnhg
                @this.set('is_run', true);
                // task - 86a1uf3ar - LOAD MORE
                // @this.set('count', 6);
                @this.set('page', 1);
            }
            @this.set('filterDistance', filterDistance); // task - 86a0btjx8
            @this.set('filterYearOfExperience', filterYearOfExperience); // task - 86a0btjx8
            $('.sec_head_mn-all ').hide();
            $('.sec_head_mn-filter').show();
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
            $('#overlay').show();
            $('.save-search-btn.shake').css('animation-iteration-count', 'unset'); // task - 862k2tf2f
            // Livewire.hook('message.processed', (message, component) => {
            Livewire.hook('element.updated', (el, component) => {

                if($(el).hasClass('js-select2') || $(el).hasClass('js-range-slider')) {
                    $('.current_position_filter_btn2').val(component.serverMemo.data.selectCurrentPosition);
                    console.log(component.serverMemo.data.selectCurrentPosition, current_position_filter_btn);
                    // console.log('submit');
                    // afterLoad($(this));

                    setTimeout(function() {
                        // console.log('{{$firstSearch}} - ff');
                        if($('#is_run').val() == '1') {
                            $('.save-search-btn').css('display', 'none'); // task - 862k2tf2f
                            // console.log('here .....');
                            $('.hidden-btn-filter').css({'display':'inline-block !important', 'margin-top':'60px'});

                            $('.hidden-btn-filter').attr('style', 'display:inline-block !important;margin-top:60px;');
                            // $('.hidden-btn-filter').css('margin-top', '60px');
                            $('.hidden-btn-filter a.open-save-search-btn').addClass("shake");
                            // $('.clear-filter-btn').removeClass('hide-clr-btn'); ************
                            // $('.save-search-btn').addClass("enable-save-btn");
                            $('.sec_head_mn-all ').hide();
                            $('.sec_head_mn-filter').show();
                        }
                        // hideClearFilterBtn(false);
                    }, 100);

                    setTimeout(function () {
                        $(".hidden-btn-filter a.open-save-search-btn").removeClass("shake");

                    }, 4000);
                }
            })

            return false;
            e.preventDefault();
        });
    };

    window.addEventListener('loadAfterload', event => {
        // console.log('loadAfterload');
        afterLoad($(this));
    });

    // task - 86a2ykzx3
    var req_id = null;
    document.addEventListener("livewire:load", () => {
        if(req_id) {
            Livewire.hook('element.updated', (el, component) => {
                if($(el).hasClass('exampleModalToggle'+ req_id)) {
                    afterLoad($(this));
                }
            })
        }
    });

    window.addEventListener('reqID', event => {
        req_id = event.detail.id;
    });
    // task - 86a2ykzx3 end

    // task - 86a32ur5v
    $(document).on('hidden.bs.modal', '.condidate-profile-modal',function(event) {
        /* Act on the event */
        Livewire.emit('updateFavorites');
        setTimeout(function(){
            // afterLoad();
            // $('.modal-backdrop').remove();
        }, 3000);
    });

    function saveSearch() {

        // $("body").delegate("#save-search-form", "submit", function(e) {
        $(".savesearchbtn").on("click", function(e) {
            // e.preventDefault();
            var search_name = $('.search-name').val();

            if($.trim(search_name) == "") {
                $(this).parents('.modal-content').find('#search_name_error').html('The search name field is required.'); // task - 86a0wte46
                return false;
            }

            var industries_filter_btn = $('.industries_filter_btn').val();
            var interest_filter_btn = $('.interest_filter_btn').val();
            var hard_skills_filter_btn = $('.hard_skills_filter_btn').val();
            var soft_skills_filter_btn = $('.soft_skills_filter_btn').val();
            var languages_filter_btn = $('.languages_filter_btn').val();
            var distance_filter_btn = $('.distance_filter_btn').val();
            var current_position_filter_btn = $('.current_position_filter_btn2').val();
            // var seeking_position_filter_btn = $('.seeking_position_filter_btn').val(); task - 862k2tf2f
            var schedule_filter_btn = $('.schedule_filter_btn').val();
            var zipcode_filter_btn = $('.zipcode_filter_btn').val();
            var salary_range_filter_btn = $('.salary_range_filter_btn').val();
            var work_environment_filter_btn = $('.work_environment_filter_btn').val();
            var min_range = $('.min-range').val();
            var max_range = $('.max-range ').val();
            var min_distance = $('.min-range-distance').val();
            var max_distance = $('.max-range-distance').val();
            var compensation_filter_btn = $('.compensation_filter_btn ').val();

            @this.set('selectedIndustries', industries_filter_btn)
            @this.set('selectedInterests', interest_filter_btn);
            @this.set('selectedInterests', interest_filter_btn);
            @this.set('selectedHardSkills', hard_skills_filter_btn);
            @this.set('selectedSoftSkills', soft_skills_filter_btn);
            @this.set('selectedLanguages', languages_filter_btn);
            @this.set('selectDistance', distance_filter_btn);
            // @this.set('selectSeekingPosition', seeking_position_filter_btn); task - 862k2tf2f
            @this.set('selectCurrentPosition', current_position_filter_btn);
            @this.set('selectSchedule', schedule_filter_btn);
            @this.set('selectZipCode', zipcode_filter_btn);
            @this.set('selectSalaryRange', salary_range_filter_btn);
            @this.set('selectWorkEnvironment', work_environment_filter_btn);
            @this.set('selectMinYearOfExperience', min_range);
            @this.set('selectMaxYearOfExperience', max_range);
            @this.set('selectMinDistance', min_distance);
            @this.set('selectMaxDistance', max_distance);
            @this.set('selectCompensation', compensation_filter_btn);
            @this.set('search_name', search_name);

            if(search_name) { $('.btn-close').trigger('click'); } // task - 86a0wte46

            Livewire.hook('element.updated', (el, component) => {
                if($(el).hasClass('sidebar-nav')) {
                    $('.current_position_filter_btn2').val(component.serverMemo.data.selectCurrentPosition);
                    $('.search-name').val('');

                    // task - 86a2qrtan
                    setTimeout(function(){
                        if(!$("#content_2").hasClass('mCustomScrollbar')) {
                            $("#content_2").mCustomScrollbar({
                                scrollButtons:{
                                    enable:false
                                },
                                theme:"dark"
                            });
                        }
                    }, 50);
                }
            });
        });
    };
</script>



<script>
    $(".prev-btn").click(function(e) {
        e.preventDefault();
        // location.replace('/candidate/personal-information')
        window.location.href='{{url("/candidate/personal-information")}}';
    })
    $(".nxt-btn").click(function(e) {
        e.preventDefault();
        // location.replace('/candidate/education-employment')
        window.location.href='{{url("/candidate/education-employment")}}';

    })
</script>

<script>
    window.addEventListener('close-search', event => {
        $('#saveSearchModal').modal('hide');
        $('body, html').removeClass('sidebar_show');
        $('body').addClass('sidebar_extended'); // task - 86a0qvtc0
    })


    window.addEventListener('openSaveSearchPopUp', event => {
        $('.firstSearch ').val();
        setTimeout(function() {
            if (!localStorage.getItem('saveSearchOpened')) { // task - 86a1uf3ar
                $('#saveSearchModal').modal('show');

                localStorage.setItem('saveSearchOpened', true); // task - 86a1uf3ar
            }

        },1000)

     })
</script>

<script>
    window.addEventListener('close-notes', event => {
        $('#notesModal').modal('hide');
        // $('#exampleModalToggle2').modal('show');
    })
</script>



<script>
    // active sort tab

    var activeTab = "_";
    $("body").delegate(".list_grid_wrapper li", "click", function(e) {
        /*var _target = $(this).find('button').attr('data-target');
        var _EL = _target.split("-");*/

        var type = $(this).attr('data-type');
        activeTab = $(this).attr('class');
        activeTab = activeTab.split(" ");
        activeTab = activeTab[0];
    });


    $("body").delegate(".close", "click", function(e) {
        $('.modal').modal('hide');
    })

    document.addEventListener("livewire:load", () => {
        $(document).on('click', '#change_order', function(event) {
            // $('.clear-filter-btn').addClass('hide-clr-btn'); // Task 86a0jvgw4
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
            $('#overlay').show();
            // @this.set('count', 6); task - 86a1uf3ar
            @this.set('page', 1);
            if(!@this.get('is_filtered')) @this.set('is_filtered', true);
            var current_order = @this.get('sort_order');

            if(current_order == "ASC") {
                @this.set('sort_order', 'DESC');
                // task - 86a2vxfb2
                @this.set('sort_icon', 'down-icon.svg');
                @this.set('sort_icon2', 'up-icon-gr.svg');
            } else {
                @this.set('sort_order', 'ASC');
                // task - 86a2vxfb2
                @this.set('sort_icon', 'down-icon-gr.svg');
                @this.set('sort_icon2', 'up-icon.svg');
            }

            Livewire.hook('message.processed', (message, component) => {
                console.log('change_order');
                hideClearFilterBtn(false); // Task 86a0jvgw4
                // afterLoad($(this));
            })
        });

        $("body").delegate(".sort-tab", "click", function(e) {
            // $('.clear-filter-btn').addClass('hide-clr-btn'); // Task 86a0jvgw4
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
            $('#overlay').show();
            var type = $(this).attr('data-type');
            @this.set('sortBy', type);
            // @this.set('count', 6); task - 86a1uf3ar
            @this.set('page', 1);
            if(!@this.get('is_filtered')) @this.set('is_filtered', true);
            if(type == "newest") {
                @this.set('sort_order', 'DESC');
                @this.set('sort_icon', 'down-icon.svg');
            }

            Livewire.hook('message.processed', (message, component) => {
                $('.current_position_filter_btn2').val(component.serverMemo.data.selectCurrentPosition);
                hideClearFilterBtn(false); // Task 86a0jvgw4
                // afterLoad($(this));
            })
        })
    })
    document.addEventListener("livewire:load", () => {
            /*$("body").delegate(".manual_add_saved_serach", "click", function(e) {
                Livewire.hook('message.processed', (message, component) => {
                    afterLoad($(this));
                })
            })*/
        })

    function afterLoad() {
        var html = " <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js'><\/script><script src='{{asset('assets/be/js/filters.js')}}'><\/script>";
        $('.filter-out').html(html);
        $('.' + activeTab).trigger('click');
        // let flag = @this.get('is_filtered');
        let flag = @this.get('is_submit');

        $('.filter-col-box').parent('div').css('opacity', '0.7');
        let prefilled_tags = $('.current_position_filter_btn2').val();
        setTimeout(function() {
            var html2 = '<script src="{{asset('assets/be/taginput/bootstrap-tagsinput.min.js')}}">'+
                '<\/script><link rel="stylesheet" href="{{asset('assets/be/taginput/bootstrap-tagsinput.css')}}"/>' +
            '<div class="col- filter-col-box form-group position-input ">' +
                '<input class="current_position_filter_btn2 form-control js-select2" data-role="tagsinput" value="'+prefilled_tags+'" placeholder="Search by Current Title"/>' +
            '</div>';
            $('.tag-input-field').html(html2);

            var _SInterval = setInterval(function(){
                var H3 = '<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"><\/script><input type="text" id="experience-slide" class="js-range-slider" name="my_range" value="" '
                        + 'data-type="double"'
                        + 'data-min="0"'
                        + 'data-max="40"'
                        + 'data-from="'+@this.get('selectMinYearOfExperience')+'"'
                        + 'data-to="'+@this.get('selectMaxYearOfExperience')+'"'
                        + 'data-grid="false"'
                    +'/>';
                $('.range-slider-field').html(H3);

                var H4 = '<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"><\/script><input type="text" id="distance-slide" class="js-range-slider" name="my_range" value=""'
                        + 'data-type="double"'
                        + 'data-min="0"'
                        + 'data-max="100"'
                        + 'data-from="'+@this.get('selectMinDistance')+'"'
                        + 'data-to="'+@this.get('selectMaxDistance')+'"'
                        + 'data-grid="false"'
                    +'/>';
                $('.range-slider-field2').html(H4);
                if(!$('.range-slider-field').find("#experience-slide").hasClass('irs-hidden-input')) {
                    $('.range-slider-field').find("#experience-slide").ionRangeSlider({
                        onStart: function (data) {},
                        onChange: function (data) {
                            // Called every time handle position is changed
                            // $('#min-range').val(data.from).change();
                            // $('#max-range').val(data.to).change();
                        },
                        onFinish: function (data) {
                            // Called then action is done and mouse is released
                            $('#min-range').val(data.from);//.trigger('input', false);
                            $('#max-range').val(data.to).trigger('input', false);
                            console.log(data.to);
                        },
                        onUpdate: function (data) { /* Called then slider is changed using Update public method console.log(data.from_percent); */ }
                    });
                }

                if(!$('.range-slider-field2').find("#distance-slide").hasClass('irs-hidden-input')) {
                    $('.range-slider-field2').find("#distance-slide").ionRangeSlider({
                        onStart: function (data) {},
                        onChange: function (data) {
                            // Called every time handle position is changed
                            // $('#min-range-distance').val(data.from).change();
                            // $('#max-range-distance').val(data.to).change();
                        },
                        onFinish: function (data) {
                            // Called then action is done and mouse is released
                            $('#min-range-distance').val(data.from);//.trigger('input', false);
                            $('#max-range-distance').val(data.to).trigger('input', false);
                            console.log(data.to);
                        },
                        onUpdate: function (data) { /* Called then slider is changed using Update public method console.log(data.from_percent); */ }
                    });
                }

                if($('.range-slider-field').find("#experience-slide").hasClass('irs-hidden-input') && $('.range-slider-field2').find("#distance-slide").hasClass('irs-hidden-input')) {
                    clearInterval(_SInterval);
                }
            }, 100);

            // window.onload = function() {
            console.log('Afterload - 001');
            console.log(prefilled_tags, @this.get('selectCurrentPosition'));
            // }

            var _Interval = setInterval(function(){
                var div = document.querySelector('.bootstrap-tagsinput');

                if(div) {
                    div.addEventListener('wheel', function(event) {
                        event.preventDefault();
                        div.scrollLeft += event.deltaY;
                    });

                    clearInterval(_Interval);
                    $('.bootstrap-tagsinput').find('input').addClass('js-select2');
                }
            }, 50);

            setTimeout(function() {
                $('body').removeAttr('style');
                $('#overlay').hide();
                // $('.hidden-btn-filter').css('margin-top', '60px');

            }, 50);
            setTimeout(function () {
                $(".hidden-btn-filter a.open-save-search-btn").removeClass("shake");
            }, 4000);

            $('.' + activeTab).trigger('click');
        }, 80);

        setTimeout(function() {
            $('.js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)').each(function() {
                // console.log('select2', $(this));
                if( $(this).val()[0]==null || $(this).val()[0]==undefined || $(this).val()[0]==''){
                     if(!$(this).hasClass('zipcode_filter_btn')) { 
                        $(this).val('').trigger('change', true); 
                    } else {
                        // task - 86a3q2kqq
                        let result_arr = $(this).val();
                        result_arr = result_arr.filter(filterArr);

                        function filterArr(v) {
                            return (v != '' && v != null);
                        }
                        
                        $(this).val(result_arr).trigger('change', true); 
                    }
                    // $(this).html('');
                } else {
                    $(this).val($(this).val()).trigger('change', true);
                }
                $('.' + activeTab).trigger('click');
            })
            $('.min-range').val($('.min-range').val());//.trigger('input', true);
            $('.max-range').val($('.max-range').val()).trigger('input', true);

            $('.min-range-distance').val($('.min-range-distance').val());//.trigger('input', true);
            $('.max-range-distance').val($('.max-range-distance').val()).trigger('input', true);

            $('.' + activeTab).trigger('click');

            hideClearFilterBtn(false); // Task 86a0jvgw4
            $('.filter-col-box').parent('div').css('opacity', '1');

            // task - 86a1uf3ar
            setTimeout(function() {
                let loaded_filters = 0; let total_filters = $('.filter-div .filter-col-box:not(.filter-btn)').length;
                animInterval = setInterval(function() {
                    $('.filter-div .filter-col-box:not(.filter-btn)').each(function(index, el) {
                        let _FEL = $(el).find('.js-select2');
                        if($(_FEL)[0].tagName == "SELECT") {
                            if($(_FEL).hasClass('select2-hidden-accessible')) {
                                $(_FEL).trigger('change', true);
                                loaded_filters ++;
                            }
                        } else if($(_FEL)[0].tagName == "INPUT") {
                            if($(_FEL).hasClass('current_position_filter_btn2')) {
                                if($(_FEL).parent().find('.bootstrap-tagsinput').length) {
                                    loaded_filters ++;
                                }
                            } else {
                                loaded_filters ++;
                            }
                        }

                        if(loaded_filters >= total_filters) {
                            $('.filter-div .filter-col-box:not(.filter-btn)').removeClass('animated-background');
                            clearInterval(animInterval);
                        }
                    });
                }, 100);
            }, 500);
            // $('.filter-div .filter-col-box:not(.filter-btn)').removeClass('animated-background'); // task - 86a0kdnun
            // task - 86a1uf3ar end
        }, 100);
    }

    window.addEventListener('closeSecondaryModal', event => {
        $("#notesModal").modal("hide");
    });

    $(document).ready(function() {
        $(document).on("click", function(e) {
            if (!$('.inline-table-modal').is(e.target) && $('.inline-table-modal').has(e.target).length === 0) {
                // Click occurred outside the modal, so close it
                $(".inline-table-modal").modal("hide");
            }
        });
    });

    // task - 86a10bj8u
    window.addEventListener('close-request-modal', event => {
        $('#send-request-modal .request_message').html('REQUEST SUBMITTED');
        setTimeout(function() {
            $('#send-request-modal .request_message').html('');
            $('#send-request-modal form')[0].reset();
            $('#send-request-modal').modal('hide');
            $('#send-request-modal').removeClass('show');
            $('#send-request-modal').hide();
        }, 1500);
    });
    // task - 86a10bj8u end

    window.addEventListener('enableBody', event => {
        $('body').removeAttr('style');
        // $('.inline-table-modal').modal('hide');
        $('#overlay').hide();
});

    window.addEventListener('blockBody', event => {
        $('#overlay').show();
        $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
    })


    window.addEventListener('updateLoadMore', event => {
        load_more_complete = 0;
    })

document.addEventListener("livewire:load", (e) => {

    $(window).scroll(function() {
        var scrollCount=0;
        // if($(document).height()-$(window).scrollTop() + $(window).height()>1925) {
        if (((window.innerHeight + Math.round(window.scrollY))+100 >= document.body.offsetHeight) && ($('.listgrid_cnt.active > .load_more').length) && load_more_complete == 0) {
                load_more_complete = 1;
                $('.load_more').html('<span class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true" style="margin-right:10px;"></span><span class="loadSpan">Loading...</span></a>')
            // Trigger a Livewire function
            scrollCount++;
            if(scrollCount==1){
                $('.' + activeTab).trigger('click');
                /*$('#overlay').show();
                $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');*/
                // $('.inline-table-modal').modal('hide');
                livewire.emit('loadMore');
            }
            scrollCount=0;
            Livewire.hook('message.processed', (message, component) => {
                {{-- 86a2yxuh3 --}}
                $('.listview_candidate_details').removeClass('activeCard');
                $('.listview_candidate_details[data-id="' + activeCardId + '"]').addClass('activeCard');
                $('.' + activeTab).trigger('click');
                scrollCount=0;
                // console.log('load more');
                // afterLoad($(this));
            })


        }
    });
});
</script>

@endpush
