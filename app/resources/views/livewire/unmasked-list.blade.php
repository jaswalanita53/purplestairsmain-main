<div>
    <!-- select2 filters -->
    <link rel="stylesheet" href="{{ asset('assets/be/search-page.css') }}" />
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/intlTelInput.min.js"></script>
    <style>
    .bgx-text-align li{
        display:block !important;

    }
    .tool-info-greet{
        bottom: 23px !important;
        right: 0% !important;
    }
    .custom-tool-greet {
        position: unset !important;
        margin: 0px !important;
    }
    .custom-tool span {
        font-weight: 400;
        font-size: 14px;
        color: rgba(0, 0, 0, 0.321);
        background: #f0f0f0;
        height: 16px;
        width: 16px;
        z-index:99999 !important;
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 100%;
    }

    .tool-info {
        background: #eee4f8;
        border: 1px solid #7e50a7;
        border-radius: 3px;
        padding: 0px;
        width: fit-content;
        height: auto !important;
         max-height: fit-content;
        position: absolute;
        /* top: 100%; */
        /*left: 30px !important;*/
        /* bottom: -54px; */
        right: 0;
        opacity: 0;
        top: 70%;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
        z-index: 5;
        pointer-events: all !important;
    }
    .bgx-text-align {
        padding: 9px !important;
    }
    .bgx-text-align li::before {
        content: '\2192'; /* Unicode character for right arrow */
        position: absolute;
        left: -20px; /* Adjust the positioning of the arrow */
    }
    .bgx-text-align li a{
        color: black;
        font-size: 14px;
    }
    .disabled_check_box{
        color: grey;
    }
    .bgx-custom-list a:hover {
        color: var(--bs-link-hover-color);
        text-decoration: underline !important;
        color: black !important;
    }
    /* task - 86a1zmk5b
    .listview_candidate_details_head {
      margin-left: 95px;
    } */
    </style>
    <div class="mid-contain">
        <div class="container-fluid">
            <div class="main-body">
                <div class="main-body-upper">
                    <div class="view_cancidate_all_set">
                        <div class="col-lg-8 seacrh_details_describe_col_lft">
                            <h3 >UNMASKED</h2>
                            <span class="saved-search-count py-1 px-3 "  onclick="filterByCategory('all')" style="line-height: 2;    cursor: pointer;">{{ $unmasked_count }} Candidate{{($unmasked_count > 1) ? 's' : ''}}{{-- task - 86a26ba92 --}}</span>
                            {{-- // 86a2zt9nn new unmasked --}}
                            @if($new_unmask_candidates)
                            <style>
                            .active_new_link{
                                background: orange;
                                color: white;
                            }
                             .new_link:hover{
                                background: orange;
                                color: white;
                            }
                            .saved-search-count:hover{
                                text-decoration: underline;
                            }
                            </style>
                                {{-- <span class="notificate_total @if($category!='new') active_new_link @endif new_link" wire:click="filterByCategory('all')"> All</span> --}}
                                <span class="saved-search-coun py-1">
                                <span class="notificate_total  new_link @if($categoryNew=='new') active_new_link @endif" wire:click="filterByCategoryForNew('new')">{{$new_unmask_candidates}} NEW</span>
                               </span>
                               @endif
                        </div>
                        <div class="row view_cancidate_all_set_row gap candidate_row-">
                            <div class="col-xl-3 col-lg-4 view_cancidate_all_set_col_lft">
                                {{-- <div class="suggestion_search_wrapper">
                                <ul>
                                    <li>
                                        <a href="#url" class="{{$category == 'suggested' ? 'active' : ''}}" wire:click="filterByCategory('')">

                                            All
                                        </a>
                                    </li>
                                </ul>
                            </div> --}}
                            </div>

                            <div class="col-xl-9 col-lg-8 view_cancidate_all_set_col_rtt">
                                <div class="view_cancidate_all_set_col_rtt_innr">
                                    <div class="suggestion_search_wrapper">
                                        <ul class="toggle_label">
                                            <li>
                                            <a href="javascript:;" class="{{in_array('favorites', $category) ? 'active' : ''}}" onclick="filterByCategory('favorites')">
                                                <span class="ic_award_icn {{ in_array('favorites', $category)  ? 'hover_fav' : ''}}">
                                                    <svg class="not_new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z" fill="#FFAE1A"></path>
                                                    </svg>
                                                </span> &nbsp;
                                                Favorites
                                                (<span id="favorite_cnt">{{ $favorites_count }}</span>)</a>
                                        </li>

                                            {{-- task - 86a309hbq --}}
                                        <li>
                                            <a href="javascript:;" class="{{ in_array('relevant', $category)  ? 'active' : ''}}" onclick="filterByCategory('relevant')">
                                                <span class="ic_relevant_inc {{ in_array('relevant', $category)  ? 'hover_relevant' : ''}}">
                                                    <img src="{{ asset('assets/be/images/check.svg') }}">
                                                </span> &nbsp;
                                                Relevant (<span id="relevant_cnt">{{ count($relevants) }}</span>)
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:;" class="{{ in_array('nonrelevant', $category)  ? 'active' : ''}}" onclick="filterByCategory('nonrelevant')">
                                                <span class="ic_nrelevant_inc {{ in_array('nonrelevant', $category)  ? 'hover_nrelevant' : ''}}">
                                                    <img src="{{ asset('assets/be/images/cross.svg') }}">
                                                </span> &nbsp;
                                                Not Relevant (<span id="nrelevant_cnt">{{ count($non_relevants) }}</span>)
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:;" class="{{ in_array('unmarked', $category)  ? 'active' : ''}}" onclick="filterByCategory('unmarked')">
                                                <span class="ic_unmarked_inc {{ in_array('unmarked', $category)  ? 'hover_unmarked' : ''}}">
                                                    <img src="{{ asset('assets/be/images/list2.svg') }}">
                                                </span> &nbsp;
                                                Unmarked (<span id="unmarked_cnt">{{ count($unmarked) }}</span>)
                                            </a>
                                        </li>
                                        {{-- task - 86a309hbq --}}
                                        </ul>
                                    </div>

                                    <div class="dropdown sort-dropdown neww">
                                        @php
                                            $sort_by_arr = [
                                                '' => '',
                                                'alpha' => 'A to Z',
                                                'distance' => 'Distance',
                                                'newest' => 'Newest',
                                                'experience' => 'Experience',
                                            ];
                                        @endphp
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton2"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Sort By <span class="sort_by_val">{{ $sort_by_arr[$sortBy] }}</span>
                                        </button>
                                        {{-- task - 86a2vxfb2 --}}
                                        <a href="javascript:;" id="change_order" class="p-2">
                                            <img src="{{asset('assets/be/images/'.$sort_icon)}}" alt="" />
                                            <img src="{{asset('assets/be/images/'.$sort_icon2)}}" alt="" />
                                        </a>

                                        <!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click="$set('sortBy', 'alpha')"> A to Z </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click="$set('sortBy', 'distance')"> Distance </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click="$set('sortBy', 'newest')"> Newest </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click="$set('sortBy', 'experience')">
                                            Experience
                                        </a>
                                    </li>
                                </ul> -->
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            {{-- task - 8678ffjx0 <li>
                                        <a class="dropdown-item sort-tab" href="#" data-type="alpha"> A to Z </a>
                                    </li> --}}
                                            <li>
                                                <a class="dropdown-item sort-tab py-2 {{ $sortBy == 'distance' ? 'bg-purple text-white' : '' }}"
                                                    href="#" data-type="distance"> Distance </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item sort-tab py-2 {{ $sortBy == 'newest' ? 'bg-purple text-white' : '' }}"
                                                    href="#" data-type="newest"> Newest </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item sort-tab py-2 {{ $sortBy == 'experience' ? 'bg-purple text-white' : '' }}"
                                                    href="#" data-type="experience">
                                                    Experience
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="list_grid_wrapper" ppppppp{{ $active_tab }}>
                                        <ul>
                                            <li class="{{ $active_tab == 1 ? 'active' : '' }} grid">
                                                <button class="grid" data-target="content-1">
                                                    <img src="{{ asset('assets/be/images/grid.svg') }}"
                                                        alt="" />
                                                </button>
                                            </li>
                                            <li class="{{ $active_tab == 2 ? 'active' : '' }} list">
                                                <button class="list" data-target="content-2">
                                                    <img src="{{ asset('assets/be/images/list.svg') }}"
                                                        alt="" />
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="listgrid_cnt {{ $active_tab == 1 ? 'active' : '' }}" id="content-1">
                            <div class="row candiate_list_view_parent_row gy-4">
                                @foreach ($candidates as $candidate)
                                    {{-- yrs of Experience login --}}

                                    @php
                                        $employments = [];
                                        $yrs_of_exp = 0; $exp_months = 0;
                                        if($candidate->employments->count()) {
                                            $employments = $candidate->employments->toArray();
                                            $st_year = null;
                                            $ed_year = null;

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


                                    @if ($candidate->personal)
                                        @if ($candidate->personal->hired_status)
                                            <div class="col-xl-4 col-md-6 candiate_list_view_parent_col candidate-card"
                                                data-id="{{ $candidate->id }}">
                                                @php $hired_employee=""; @endphp
                                                @if (!empty($candidate->delete_status))
                                                    <!-- @if ($candidate->delete_status->type == 'sleep')
}
<span class="hired">Hired</span><span class="hired-flag"></span>
                                @php $hired_employee="blured_box";@endphp -->
                                                    <!--
@endif -->
                                                    <span class="hired">Hired</span><span class="hired-flag"></span>
                                                    @php $hired_employee="blured_box";@endphp
                                                @else
                                                    @if ($candidate->companyStatus->first())
                                                        @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                            <span class="pending-label"><span
                                                                    class="hired">Requested</span><span
                                                                    class="hired-flag"><i class="iconc"><img
                                                                            src="{{ asset('assets/be/images/clock-white.svg') }}"
                                                                            alt=""></i></span></span>
                                                        @else
                                                            <span class="unmasked-flag">
                                                                <span class="hired">Unmasked</span><span
                                                                    class="hired-flag"></span>
                                                            </span>
                                                        @endif
                                                    @else
                                                    @endif
                                                @endif
                                                <div class="text-capitalize candidate_grid_ppl_wppt {{ $hired_employee }}"
                                                    data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} "
                                                    data-id="{{ $candidate->id }}">
                                                    <div class="candidate_grid_ppl hired_sec ">
                                                        <div class="candidate_top_pnk_ic">
                                                            <img src="{{ asset('assets/be/images/shape_left_pnk.png') }}"
                                                                alt="" />
                                                        </div>
                                                        <div class="hired_sec_span">Hired</div>
                                                        <div class="candidate_grid_ppl_icn">
                                                            <ul>
                                                                <li>
                                                                    <a href="#url"
                                                                        class="flag_ico_sec {{ in_array($candidate->id, $my_favorites) ? 'hover_fav' : '' }}"
                                                                        wire:click.lazy={{ !in_array($candidate->id, $my_favorites) ? 'saveFavorite(' . $candidate->id . ',' . $search->id . ')' : 'removeFavorite(' . $candidate->id . ',' . $search->id . ')' }}>
                                                                        <svg class="not_new" width="20"
                                                                            height="21" viewBox="0 0 20 21"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z"
                                                                                fill="#FFAE1A"></path>
                                                                        </svg>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#url" class="clickd_tgl_searches"><svg
                                                                            fill="#000000" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            class="ellipsis-icon">
                                                                            <circle cx="17.5" cy="12"
                                                                                r="1.5" />
                                                                            <circle cx="12" cy="12"
                                                                                r="1.5" />
                                                                            <circle cx="6.5" cy="12"
                                                                                r="1.5" />
                                                                        </svg></a>
                                                                    <div class="clickd_tgl_searches_open">
                                                                        <div class="clickd_tgl_searches_open_head">
                                                                            <h5>Manage Matched Searches</h5>

                                                                            <h5 class="text-muted"><small>Create a
                                                                                    filter & save it to use this
                                                                                    function</small></h5>
                                                                        </div>
                                                                        <div class="clickd_tgl_searches_open_ul">
                                                                            <div class="form_input_check">
                                                                                @foreach ($saved_searches as $key => $searchSingle)
                                                                                    @php $is_checked = in_array($candidate->id, $searchSingle->candidate_ids) ? 1 : 0; @endphp
                                                                                    <label>
                                                                                        <input type="checkbox"
                                                                                            class="manual_add_saved_serach"
                                                                                            data-search-id="{{ $searchSingle->id }}"
                                                                                            data-candidate="{{ $candidate->id }}"
                                                                                            wire:click="changeEvent('{{ $is_checked }}', '{{ $searchSingle->id }}','{{ $candidate->id }}')"
                                                                                            {{ $is_checked ? 'checked' : '' }} />
                                                                                        <span>{{ $searchSingle->name }}</span>
                                                                                    </label>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="candidate_grid_ppl_top">
                                                            <figure class="main_img">
                                                                @if ($candidate->companyStatus->first())
                                                                    @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                                        <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                                            alt=""
                                                                            class="unmasked-p img-thumbnail" />
                                                                    @else
                                                                        @if ($candidate->profile_photo_path)
                                                                            <img src="{{ asset($candidate->profile_photo_path) }}"
                                                                                alt="" class="" />
                                                                        @else
                                                                            <img src="{{ asset('assets/fe/images/default_user.png') }}"
                                                                                alt="" class="" />
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                                        alt=""
                                                                        class="unmasked-p img-thumbnail" />
                                                                @endif
                                                            </figure>
                                                            <div class="candidate_grid_ppl_top_rt">
                                                                <span class="d-flex">
                                                                    <span class="grid-box-detail">
                                                                        @if ($candidate->companyStatus->first())
                                                                            @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                                                @if (!empty($candidate->name))
                                                                                    @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                                                    <h6 class="blured_txt">
                                                                                        {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                                                    </h6>
                                                                                @else
                                                                                    <h6 class="blured_txt">Candidate
                                                                                        Name</h6>
                                                                                @endif
                                                                            @else
                                                                                @if (!empty($candidate->name))
                                                                                    {{ strlen($candidate->name) > 20 ? substr($candidate->name, 0, 20) . '...' : $candidate->name }}
                                                                                @endif
                                                                            @endif
                                                                        @else
                                                                            @if (!empty($candidate->name))
                                                                                @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                                                <h6 class="blured_txt">
                                                                                    {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                                                </h6>
                                                                            @else
                                                                                <h6 class="blured_txt">Candidate Name
                                                                                </h6>
                                                                            @endif
                                                                        @endif
                                                                        <p>
                                                                            @if (!empty($candidate->personal->current_title))
                                                                                {{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }}
                                                                            @endif
                                                                        </p>
                                                                    </span>
                                                                    <span class="grid-exp"> @php
                                                                        expGraphic($yrs_of_exp);
                                                                    @endphp
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="candidate_grid_ppl_top_btm">
                                                            <ul>
                                                                <li>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                                        @php
                                                                            $worksetting = '';
                                                                            $worksettingIcon = '';
                                                                            if (!empty($candidate->personal->work_environment_remote)) {
                                                                                $worksetting .= 'Remote/';
                                                                            }
                                                                            if (!empty($candidate->personal->work_environment_in_office)) {
                                                                                $worksetting .= 'In Office/';
                                                                            }
                                                                            if (!empty($candidate->personal->work_environment_hybrid)) {
                                                                                $worksetting .= 'Hybrid';
                                                                            }
                                                                            if (!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)) {
                                                                                $worksettingIcon = 'location';
                                                                            }
                                                                            if (!empty($candidate->personal->work_environment_hybrid)) {
                                                                                $worksettingIcon = 'location';
                                                                            }
                                                                        @endphp
                                                                        <i class="primary-icon fa fa-map-marker"
                                                                            aria-hidden="true"></i>
                                                                        <div
                                                                            class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                            <p>{{ rtrim($worksetting, '/') }}</p>
                                                                        </div>

                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                                        <i class="icon_candt"><img
                                                                                src="{{ asset('assets/be/images/ic1.svg') }}"
                                                                                alt="" /></i>
                                                                        <div
                                                                            class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                            @if (isset($candidate->industries))
                                                                                <p>{{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                                                </p>
                                                                            @endif
                                                                            <!-- <p>{{ $candidate->personal ? $candidate->personal->address : '' }},{{ $candidate->personal ? $candidate->personal->state_abbr : '' }}</p> -->
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                                        <i class="icon_candt"><img
                                                                                src="{{ 'assets/be/images/ic3.svg' }}"
                                                                                alt="" /></i>
                                                                        <div
                                                                            class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                            <h6>Asking Salary</h6>
                                                                            <p>{{ $candidate ? $candidate->personal->salary_range : '' }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                                        <i class="icon_candt"><img
                                                                                src="{{ 'assets/be/images/ic4.svg' }}"
                                                                                alt="" /></i>
                                                                        <div
                                                                            class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                            <h6>Area of Interest</h6>
                                                                            @if (isset($candidate->interests))
                                                                                @if ($candidate->interests->first())
                                                                                    <p>{{ $candidate->interests->first()->name }}
                                                                                    </p>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    {{-- task - 86a2vx5er --}}
                                                    @php $user_id = $candidate->id; $candidate_user = $candidate; $favorites = $my_favorites; $search_id = 0; $company_id = $company; @endphp
                                                    @livewire('inc-candidates-profile', compact('user_id', 'candidate_user', 'favorites', 'search_id', 'saved_searches', 'company_id', 'relevants', 'non_relevants'), key(time()))
                                                </div>
                                            @else
                                                <div class="col-xl-4 col-md-6 candiate_list_view_parent_col candidate-card"
                                                    data-id="{{ $candidate->id }}">
                                                    @php $hired_employee=""; @endphp
                                                    @if (!empty($candidate->delete_status))
                                                        <!-- @if ($candidate->delete_status->type == 'sleep')
<span class="hired">Hired</span><span class="hired-flag"></span>
                                                                            @php $hired_employee="blured_box";@endphp -->
                                                        <!--
@endif -->
                                                        <span class="hired">Hired</span><span
                                                            class="hired-flag"></span>
                                                        @php $hired_employee="blured_box";@endphp
                                                    @elseif (time() - strtotime($candidate->created_at) < 60 * 60 * 24)
                                                        <span class="hired bg-danger">New!</span><span
                                                            class="hired-flag bg-danger"></span>
                                                        @php $hired_employee="flaged";@endphp
                                                    @else
                                                        @if ($candidate->companyStatus->first())
                                                            @if ($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2)
                                                                <span class="pending-label"><span
                                                                        class="hired">Requested</span><span
                                                                        class="hired-flag"><i class="iconc"><img
                                                                                src="{{ asset('assets/be/images/clock-white.svg') }}"
                                                                                alt=""></i></span></span>
                                                                @php $hired_employee="requested";@endphp
                                                            @else
                                                                <span class="unmasked-flag">
                                                                    <span class="hired">Unmasked</span><span
                                                                        class="hired-flag"></span>
                                                                    @php $hired_employee="flaged";@endphp
                                                                </span>
                                                            @endif
                                                        @else
                                                        @endif
                                                    @endif



                                                    <div class="text-capitalize candidate_grid_ppl_wppt {{ $hired_employee }}"
                                                        data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} "
                                                        data-id="{{ $candidate->id }}">
                                                        <div class="candidate_grid_ppl">
                                                            <div class="candidate_top_pnk_ic">
                                                                <img src="{{ asset('assets/be/images/shape_left_pnk.png') }}"
                                                                    alt="" />
                                                            </div>

                                                            {{-- @if (count($saved_searches) > 0) --}}
                                                            <div class="candidate_grid_ppl_icn">
                                                                <a href="#url" class="clickd_tgl_searches">
                                                                    <svg fill="#000000" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        class="ellipsis-icon">
                                                                        <circle cx="17.5" cy="12"
                                                                            r="1.5" />
                                                                        <circle cx="12" cy="12"
                                                                            r="1.5" />
                                                                        <circle cx="6.5" cy="12"
                                                                            r="1.5" />
                                                                    </svg>
                                                                </a>
                                                                <div class="clickd_tgl_searches_open">
                                                                    <div class="clickd_tgl_searches_open_head">
                                                                        <h5>Manage Matched Searches</h5>
                                                                        {{-- task - 86a1gr1cr --}}
                                                                        <h5 class="text-muted"><small>Create a filter &
                                                                                save it to use this function</small>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="clickd_tgl_searches_open_ul arr_grey">

                                                                        <div class="form_input_check">
                                                                            @foreach ($saved_searches as $key => $search)
                                                                                @php $is_checked = in_array($candidate->id, $search->candidate_ids) ? 1 : 0; @endphp
                                                                                <label>
                                                                                    <input type="checkbox"
                                                                                        class="manual_add_saved_serach"
                                                                                        data-search-id="{{ $search->id }}"
                                                                                        data-candidate="{{ $candidate->id }}"
                                                                                        wire:click="changeEvent('{{ $is_checked }}', '{{ $search->id }}','{{ $candidate->id }}')"
                                                                                        {{ $is_checked ? 'checked' : '' }} />
                                                                                    <span>{{ $search->name }}</span>
                                                                                </label>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- @endif --}}

                                                            <div class="candidate_grid_ppl_top row">
                                                                <div class="col-8 d-flex">
                                                                    <figure class="main_img">
                                                                        @if ($candidate->companyStatus->first())
                                                                            @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                                                <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                                                    alt=""
                                                                                    class="unmasked-p img-thumbnail" />
                                                                            @else
                                                                                @if ($candidate->profile_photo_path)
                                                                                    <img src="{{ asset($candidate->profile_photo_path) }}"
                                                                                        alt=""
                                                                                        class="" />
                                                                                @else
                                                                                    <img src="{{ asset('assets/fe/images/default_user.png') }}"
                                                                                        alt=""
                                                                                        class="" />
                                                                                @endif
                                                                            @endif
                                                                        @else
                                                                            <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                                                alt=""
                                                                                class="unmasked-p img-thumbnail" />
                                                                        @endif
                                                                    </figure>
                                                                    <div class="candidate_grid_ppl_top_rt pt-3">
                                                                        <span class="grid-box-detail">
                                                                            @if ($candidate->companyStatus->first())
                                                                                @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                                                    @if (!empty($candidate->name))
                                                                                        @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                                                        <h6 class="blured_txt">
                                                                                            {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                                                        </h6>
                                                                                    @else
                                                                                        <h6 class="blured_txt">
                                                                                            Candidate Name</h6>
                                                                                    @endif
                                                                                @else
                                                                                    @if (!empty($candidate->name))
                                                                                        {{ strlen($candidate->name) > 20 ? substr($candidate->name, 0, 20) . '...' : $candidate->name }}
                                                                                    @endif
                                                                                @endif
                                                                            @else
                                                                                @if (!empty($candidate->name))
                                                                                    @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                                                    <h6 class="blured_txt">
                                                                                        {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                                                    </h6>
                                                                                @else
                                                                                    <h6 class="blured_txt">Candidate
                                                                                        Name</h6>
                                                                                @endif
                                                                            @endif
                                                                            <p>
                                                                                @if (!empty($candidate->personal->current_title))
                                                                                    {{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }}
                                                                                @endif
                                                                            </p>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-4 align-self-center- pt-3 lign-height-point-e">
                                                                    <span
                                                                        class="grid-exp grid-exp-{{ $hired_employee }}">
                                                                        @php
                                                                            expGraphic($yrs_of_exp);
                                                                        @endphp
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="candidate_grid_ppl_top_btm">
                                                                <ul>
                                                                    <li>
                                                                        <div class="candidate_grid_ppl_top_btm_wrap">
                                                                            @php
                                                                                $worksetting = '';
                                                                                $worksettingIcon = '';
                                                                                if (!empty($candidate->personal->work_environment_remote)) {
                                                                                    $worksetting .= 'Remote/';
                                                                                }
                                                                                if (!empty($candidate->personal->work_environment_in_office)) {
                                                                                    $worksetting .= 'In Office/';
                                                                                }
                                                                                if (!empty($candidate->personal->work_environment_hybrid)) {
                                                                                    $worksetting .= 'Hybrid';
                                                                                }
                                                                                if (!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)) {
                                                                                    $worksettingIcon = 'location';
                                                                                }
                                                                                if (!empty($candidate->personal->work_environment_hybrid)) {
                                                                                    $worksettingIcon = 'location';
                                                                                }
                                                                            @endphp
                                                                            <i class="primary-icon fa fa-map-marker"
                                                                                aria-hidden="true"></i>
                                                                            <div
                                                                                class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                                <p>{{ rtrim($worksetting, '/') }}</p>
                                                                            </div>
                                                                            <!-- <i class="icon_candt"><img src="{{ asset('assets/be/images/ic1.svg') }}" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <p>{{ $yrs_of_exp }} Yrs Experience</p>
                                                    </div> -->
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="candidate_grid_ppl_top_btm_wrap">
                                                                            <i class="icon_candt"><img
                                                                                    src="{{ asset('assets/be/images/ic1.svg') }}"
                                                                                    alt="" /></i>
                                                                            <div
                                                                                class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                                <!-- <p>{{ $candidate->personal ? $candidate->personal->address : '' }},&nbsp;{{ $candidate->personal ? $candidate->personal->state_abbr : '' }}</p> -->
                                                                                @if (isset($candidate->industries))
                                                                                    <p>{{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                                                    </p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="candidate_grid_ppl_top_btm_wrap">
                                                                            <i class="icon_candt"><img
                                                                                    src="{{ asset('assets/be/images/ic3.svg') }}"
                                                                                    alt="" /></i>
                                                                            <div
                                                                                class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                                <h6>Asking Salary</h6>
                                                                                <p>{{ $candidate->personal ? $candidate->personal->salary_range : '' }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="candidate_grid_ppl_top_btm_wrap">
                                                                            <i class="icon_candt"><img
                                                                                    src="{{ asset('assets/be/images/ic4.svg') }}"
                                                                                    alt="" /></i>
                                                                            <div
                                                                                class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                                <h6>Area of Interest</h6>
                                                                                @if (isset($candidate->interests))
                                                                                    <p>{{ $candidate->interests->first() ? $candidate->interests->first()->name : '' }}
                                                                                    </p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            {{-- <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-dismiss="modal" class="eyeBall"  data-id="{{ $candidate->id }}"><img src="{{ asset('assets/be/images/eye_ic.svg') }}" alt="" /></a> --}}
                                                        </div>

                                                    </div>
                                                    {{-- task - 86a2vx5er --}}
                                                    
                                                    @php $user_id = $candidate->id; $candidate_user = $candidate; $favorites = $my_favorites; $search_id = 0; $company_id = $company; @endphp
                                                    @livewire('inc-candidates-profile', compact('user_id', 'candidate_user', 'favorites', 'search_id', 'saved_searches', 'company_id', 'relevants', 'non_relevants'), key(time()))
                                                </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>

                            @if (count($candidates) <= 0)
                                <p class="text-center text-muted m-2">No Candidate Matches Found</p>
                            @endif
                        </div>

                        <div class="listgrid_cnt  {{ $active_tab == 2 ? 'active' : '' }} candidate_box_parent"
                            id="content-2">
                            @foreach ($candidates as $candidate)

                                {{-- yrs of Experience login --}}
                                @php
                                    $employments = []; $yrs_of_exp = 0; $exp_months = 0;
                                    if ($candidate->employments->count()) {
                                        $employments = $candidate->employments->toArray();
                                        $st_year = null;
                                        $ed_year = null;

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
                                @if (!in_array($candidate->id, $new_candidates_ids))
                                    @php $hired_employee=""; @endphp
                                    @if (!empty($candidate->delete_status))
                                        @if ($candidate->delete_status->type == 'sleep')
                                            @php $hired_employee="blured_box";@endphp
                                        @endif
                                    @endif
                                    <div class="listview_candidate_details_w detail_{{ $hired_employee }} candidate-card"
                                        data-id="{{ $candidate->id }}">
                                        <!-- <div class="listview_candidate_details_w "> -->
                                        @php $hired_employee=""; @endphp
                                        @if (!empty($candidate->delete_status))
                                            @if ($candidate->delete_status->type == 'sleep')
                                                <span class="hired">Hired</span><span class="hired-flag"></span>
                                                @php $hired_employee="blured_box";@endphp
                                            @endif
                                        @endif

                                        <div class="listview_candidate_details  {{ $hired_employee }}"
                                            data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} "
                                            data-id="{{ $candidate->id }}">

                                            <div class="layout_back"
                                                style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                            </div>
                                            <div data-bs-toggle="modal" data-bs-dismiss="modal"
                                                class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="listview_candidate_details_img">
                                                    @if ($candidate->companyStatus->first())
                                                        @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                            <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                                alt="" class="unmasked-p img-thumbnail" />
                                                        @else
                                                            @if ($candidate->profile_photo_path)
                                                                <img src="{{ asset($candidate->profile_photo_path) }}"
                                                                    alt="" class="" />
                                                            @else
                                                                <img src="{{ asset('assets/fe/images/default_user.png') }}"
                                                                    alt="" class="" />
                                                            @endif
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                            alt="" class="unmasked-p img-thumbnail" />
                                                    @endif
                                                </div>
                                            </div>
                                            <div data-bs-toggle="modal" data-bs-dismiss="modal"
                                                class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="listview_candidate_details_head">
                                                    @if ($candidate->companyStatus->first())
                                                        @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                            @if (!empty($candidate->name))
                                                                @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                                <h6 class="blured_txt">
                                                                    {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                                </h6>
                                                            @else
                                                                <h6 class="blured_txt">Candidate Name</h6>
                                                            @endif
                                                        @else
                                                            @if (!empty($candidate->name))
                                                               <h6> {{ strlen($candidate->name) > 20 ? substr($candidate->name, 0, 20) . '...' : $candidate->name }}</h6>
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if (!empty($candidate->name))
                                                            @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                            <h6 class="blured_txt">
                                                                {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                            </h6>
                                                        @else
                                                            <h6 class="blured_txt">Candidate Name</h6>
                                                        @endif
                                                    @endif
                                                    <p>
                                                        @if (!empty($candidate->personal->current_title))
                                                            {{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                            <div data-bs-toggle="modal" data-bs-dismiss="modal"
                                                class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="ecperice_list">
                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        @php
                                                            $worksetting = '';
                                                            $worksettingIcon = '';
                                                            if (!empty($candidate->personal->work_environment_remote)) {
                                                                $worksetting .= 'Remote/';
                                                            }
                                                            if (!empty($candidate->personal->work_environment_in_office)) {
                                                                $worksetting .= 'In Office/';
                                                            }
                                                            if (!empty($candidate->personal->work_environment_hybrid)) {
                                                                $worksetting .= 'Hybrid';
                                                            }
                                                            if ((!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)) || !empty($candidate->personal->work_environment_hybrid)) {
                                                                $worksettingIcon = 'location';
                                                            }
                                                        @endphp
                                                        <i class="primary-icon fa fa-map-marker"
                                                            aria-hidden="true"></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <p>{{ rtrim($worksetting, '/') }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img
                                                                src="{{ asset('assets/be/images/ic1.svg') }}"
                                                                alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            @if (isset($candidate->industries))
                                                                <p>{{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                                </p>
                                                            @endif
                                                            <!-- <p>{{ $candidate->personal ? $candidate->personal->address : '' }},{{ $candidate->personal ? $candidate->personal->state_abbr : '' }}</p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="gr_fl col-md-2 col-sm-4 col-6 mb-2 mb-md-0"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
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
                                            <div class="gr_fl d-flex  col-md-2 col-sm-4 col-6 mb-2 mb-md-0 align-items-center">

                                            @if(count($saved_searches)>0)
                                            <div class="candidate_grid_ppl_icn large  save-list-bubble " data-bs-toggle="tooltip" data-bs-placement="top" title="" style=" min-width: 152px;">
                                                @if($candidate->saved_list)
                                                    <p class="mt-3 custom-tool-container">
                                                        Searches Saved
                                                        <span class="custom-tool position-absolute m-0 custom-tool-greet">
                                                            <span class>?</span>

                                                             <div class="tool-info tool-info-greet " style="opacity:0;">

                                                                    {!! removeUnclosedTags($candidate->saved_list) !!}

                                                            </div>
                                                        </span>
                                                    </p>


                                                @else
                                                {{-- 86a2ymb51 --}}
                                                {{-- N/A Saved Search --}}
                                                @endif
                                            </div>
                                            @endif

                                        </div>
                                            <div class="gr_fl d-flex align-items-center col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="candidate_grid_ppl_icn large ps-1">
                                                        <a href="#url"
                                                            class="ic_award_icn {{ in_array($candidate->id, $my_favorites) ? 'hover_fav' : '' }}"
                                                            wire:click.lazy={{ !in_array($candidate->id, $my_favorites) ? 'saveFavorite(' . $candidate->id . ')' : 'removeFavorite(' . $candidate->id . ')' }}>
                                                            <svg class="not_new" width="20" height="21"
                                                                viewBox="0 0 20 21" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z"
                                                                    fill="#FFAE1A" />
                                                            </svg>

                                                            <svg class="new" width="20" height="21"
                                                                viewBox="0 0 20 21" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4016 1.09835C17.6984 0.395088 16.7446 0 15.75 0Z"
                                                                    fill="#FFAE1A" />
                                                            </svg>
                                                        </a>
                                                    </div>

                                                {{-- task - 86a309hbq --}}
                                                <div class="candidate_grid_ppl_icn large ps-1">
                                                    <a href="#url" class="ic_relevant_inc relevant_{{$candidate->id}} {{ in_array($candidate->id, $relevants) ? 'hover_relevant' : '' }}" onclick="{{ !in_array($candidate->id, $relevants) ? "saveRelevant(" . $candidate->id . ")" : "removeRelevant(" . $candidate->id . ")"}}">
                                                        <svg width="20px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    </a>
                                                </div>

                                                <div class="candidate_grid_ppl_icn large ps-1">
                                                    <a href="#url" class="ic_nrelevant_inc nrelevant_{{$candidate->id}} {{ in_array($candidate->id, $non_relevants) ? 'hover_nrelevant' : '' }}" onclick="{{ !in_array($candidate->id, $non_relevants) ? "saveNonRelevant(" . $candidate->id .")" : "removeNonRelevant(" . $candidate->id . ")"}}">
                                                        <svg width="20px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    </a>
                                                </div>
                                                {{-- task - 86a309hbq end --}}
                                            </div>
                                            {{-- <div class="gr_fl col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                @if ($candidate->companyStatus->first())
                                                    @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                        <div class="pending_unmask">
                                                            <i class="iconc"><img
                                                                    src="{{ asset('assets/be/images/clock.svg') }}"
                                                                    alt=""></i>
                                                            <div class="pending_unmask_rt">
                                                                <h6>Pending Unmask</h6>
                                                                <p>Profile Saved In Requested</p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="unmasked_div_ic">
                                                            <i class="iconc"><img
                                                                    src="{{ asset('assets/be/images/unmasked.svg') }}"
                                                                    alt=""></i>
                                                            <div class="unmasked_div_ic_rtt">
                                                                <h6>Unmasked</h6>
                                                                <p>View Unmasked Profile Now</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <a href="javascript:void(0)" class="req_mask_btn">
                                                        <i class="ic_req_m"><img
                                                                src="{{ asset('assets/be/images/masked.svg') }}"
                                                                alt="" /></i>
                                                        <div class="req_mask_btn_rtt">Request Unmask</div>
                                                    </a>
                                                    <div class="modal fade inline-table-modal" id="send-request-modal"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <button type="button"
                                                                    class="close float-right send-rew-cut"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <div class="modal-body">

                                                                    <div class="position_form" wire:ignore.self>

                                                                        <form
                                                                            wire:submit.prevent="sendRequest({{ $candidate->id }})">
                                                                            <div class="form-group">
                                                                                <label>Subject*</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    {{-- task - 86a2rvv8z placeholder="Job title here" --} }
                                                                                    wire:model.defer="position_hiring" />
                                                                                <input type="hidden"
                                                                                    class="form-control"
                                                                                    {{-- task - 86a2rvv8z placeholder="Job title here" --} }
                                                                                    wire:model.lazy="user_id"
                                                                                    value="{{ $candidate->id }}" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Message to Candidate</label>
                                                                                <textarea {{-- task - 86a2rvv8z placeholder="I reviewed your resume..." --} } wire:model.lazy="message"></textarea>
                                                                            </div>
                                                                            <div class="position-submit-btn-otr"
                                                                                wire:loading.remove
                                                                                wire:target="sendRequest">
                                                                                <input type="submit"
                                                                                    value="Send to Candidate"
                                                                                    class="position_submit_btn" />
                                                                            </div>
                                                                            <div class="position-submit-btn-otr"
                                                                                wire:loading wire:targe t="sendRequest">
                                                                                <input type="submit"
                                                                                    value="Sending..." disabled
                                                                                    class="position_submit_btn" />
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div> --}}
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-dismiss="modal" class="eye-ball2 eyeBall"
                                                data-id="{{ $candidate->id }}">
                                                @php
                                                    expGraphic($yrs_of_exp);
                                                @endphp
                                            </a>
                                        </div>

                                        {{-- <div class="listview_candidate_details  {{ $hired_employee }}"
                                            data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} "
                                            data-id="{{ $candidate->id }}">

                                            <div class="layout_back"
                                                style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                            </div>
                                            <div data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <div class="listview_candidate_details_img">
                                                    @if ($candidate->companyStatus->first())
                                                        @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                            <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                                alt="" class="unmasked-p img-thumbnail" />
                                                        @else
                                                            @if ($candidate->profile_photo_path)
                                                                <img src="{{ asset($candidate->profile_photo_path) }}"
                                                                    alt="" class="" />
                                                            @else
                                                                <img src="{{ asset('assets/fe/images/default_user.png') }}"
                                                                    alt="" class="" />
                                                            @endif
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                            alt="" class="unmasked-p img-thumbnail" />
                                                    @endif
                                                </div>
                                            </div>
                                            <div data-bs-toggle="modal" data-bs-dismiss="modal">

                                            </div>
                                            <div data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <div class="listview_candidate_details_head">
                                                    @if ($candidate->companyStatus->first())
                                                        @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                            @if (!empty($candidate->name))
                                                                @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                                <h6 class="blured_txt">
                                                                    {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                                </h6>
                                                            @else
                                                                <h6 class="blured_txt">Candidate Name</h6>
                                                            @endif
                                                        @else
                                                            @if (!empty($candidate->name))
                                                                {{ strlen($candidate->name) > 20 ? substr($candidate->name, 0, 20) . '...' : $candidate->name }}
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if (!empty($candidate->name))
                                                            @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                            <h6 class="blured_txt">
                                                                {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                            </h6>
                                                        @else
                                                            <h6 class="blured_txt">Candidate Name</h6>
                                                        @endif
                                                    @endif
                                                    <p>
                                                        @if (!empty($candidate->personal->current_title))
                                                            {{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                            <div data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <div class="ecperice_list">
                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        @php
                                                            $worksetting = '';
                                                            $worksettingIcon = '';
                                                            if (!empty($candidate->personal->work_environment_remote)) {
                                                                $worksetting .= 'Remote/';
                                                            }
                                                            if (!empty($candidate->personal->work_environment_in_office)) {
                                                                $worksetting .= 'In Office/';
                                                            }
                                                            if (!empty($candidate->personal->work_environment_hybrid)) {
                                                                $worksetting .= 'Hybrid';
                                                            }
                                                            if ((!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)) || !empty($candidate->personal->work_environment_hybrid)) {
                                                                $worksettingIcon = 'location';
                                                            }
                                                        @endphp
                                                        <i class="primary-icon fa fa-map-marker"
                                                            aria-hidden="true"></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <p>{{ rtrim($worksetting, '/') }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img
                                                                src="{{ asset('assets/be/images/ic1.svg') }}"
                                                                alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            @if (isset($candidate->industries))
                                                                <p>{{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                                </p>
                                                            @endif
                                                            <!-- <p>{{ $candidate->personal ? $candidate->personal->address : '' }},{{ $candidate->personal ? $candidate->personal->state_abbr : '' }}</p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="gr_fl" data-bs-toggle="modal" data-bs-dismiss="modal"
                                                >
                                                <div class="ask_salary_sec">
                                                    <i class="ic_icon">$</i>
                                                    <div class="ask_salary_sec_rtt">
                                                        <h6>Asking Salary</h6>
                                                        <p>{{ $candidate->personal ? $candidate->personal->salary_range : '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gr_fl save-list-div">

                                                @if (count($saved_searches) > 0)
                                                    <div class="candidate_grid_ppl_icn large save-list-bubble"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="">
                                                        @if ($candidate->saved_list)
                                                            {!! $candidate->saved_list !!}
                                                        @else
                                                            N/A Saved Search
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="gr_fl">
                                                @if ($candidate->companyStatus->first())
                                                    @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                        <div class="pending_unmask">
                                                            <i class="iconc"><img
                                                                    src="{{ asset('assets/be/images/clock.svg') }}"
                                                                    alt=""></i>
                                                            <div class="pending_unmask_rt">
                                                                <h6>Pending Unmask</h6>
                                                                <p>Profile Saved In Requested</p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="unmasked_div_ic">
                                                            <i class="iconc"><img
                                                                    src="{{ asset('assets/be/images/unmasked.svg') }}"
                                                                    alt=""></i>
                                                            <div class="unmasked_div_ic_rtt">
                                                                <h6>Unmasked</h6>
                                                                <p>View Unmasked Profile Now</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <a href="javascript:void(0)" class="req_mask_btn">
                                                        <i class="ic_req_m"><img
                                                                src="{{ asset('assets/be/images/masked.svg') }}"
                                                                alt="" /></i>
                                                        <div class="req_mask_btn_rtt">Request Unmask</div>
                                                    </a>
                                                    <div class="modal fade inline-table-modal" id="send-request-modal"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <button type="button"
                                                                    class="close float-right send-rew-cut"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <div class="modal-body">

                                                                    <div class="position_form" wire:ignore.self>

                                                                        <form
                                                                            wire:submit.prevent="sendRequest({{ $candidate->id }})">
                                                                            <div class="form-group">
                                                                                <label>Subject*</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    {{-- task - 86a2rvv8z placeholder="Job title here" --} }
                                                                                    wire:model.defer="position_hiring" />
                                                                                <input type="hidden"
                                                                                    class="form-control"
                                                                                    {{-- task - 86a2rvv8z placeholder="Job title here" --} }
                                                                                    wire:model.lazy="user_id"
                                                                                    value="{{ $candidate->id }}" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Message to Candidate</label>
                                                                                <textarea {{-- task - 86a2rvv8z placeholder="I reviewed your resume..." --} wire:model.lazy="message"></textarea>
                                                                            </div>
                                                                            <div class="position-submit-btn-otr"
                                                                                wire:loading.remove
                                                                                wire:target="sendRequest">
                                                                                <input type="submit"
                                                                                    value="Send to Candidate"
                                                                                    class="position_submit_btn" />
                                                                            </div>
                                                                            <div class="position-submit-btn-otr"
                                                                                wire:loading wire:targe t="sendRequest">
                                                                                <input type="submit"
                                                                                    value="Sending..." disabled
                                                                                    class="position_submit_btn" />
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-dismiss="modal" class="eye-ball2 eyeBall"
                                                data-id="{{ $candidate->id }}">
                                                @php
                                                    expGraphic($yrs_of_exp);
                                                @endphp
                                            </a>
                                        </div> --}}
                                        
                                        {{-- task - 86a2vx5er --}}
                                        @php $user_id = $candidate->id; $candidate_user = $candidate; $favorites = $my_favorites; $search_id = 0; $company_id = $company; @endphp
                                        @livewire('inc-candidates-profile', compact('user_id', 'candidate_user', 'favorites', 'search_id', 'saved_searches', 'company_id', 'relevants', 'non_relevants'), key(time()))
                                    </div>
                                @else
                                    <div class="listview_candidate_details_w candidate-card"
                                        data-id="{{ $candidate->id }}">
                                        {{-- <div class="listview_candidate_details"
                                            data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} "
                                            data-id="{{ $candidate->id }}">
                                            <div class="layout_back"
                                                style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                            </div>
                                            <div data-bs-toggle="modal" data-bs-dismiss="modal" class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="listview_candidate_details_img">
                                                    @if ($candidate->profile_photo_path)
                                                        <img src="{{ asset($candidate->profile_photo_path) }}"
                                                            alt="" />
                                                    @else
                                                        <img src="{{ asset('assets/fe/images/default_user.png') }}"
                                                            alt="" />
                                                    @endif
                                                </div>
                                            </div>
                                            <div data-bs-toggle="modal" data-bs-dismiss="modal" class="col-md-3 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="listview_candidate_details_head">
                                                    @if (!empty($candidate->name))
                                                        {{ strlen($candidate->name) > 20 ? substr($candidate->name, 0, 20) . '...' : $candidate->name }}
                                                    @endif
                                                    <p>
                                                        @if (!empty($candidate->personal->current_title))
                                                            {{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                            <div data-bs-toggle="modal" data-bs-dismiss="modal" class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="ecperice_list">
                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        @php
                                                            $worksetting = '';
                                                            $worksettingIcon = '';
                                                            if (!empty($candidate->personal->work_environment_remote)) {
                                                                $worksetting .= 'Remote/';
                                                            }
                                                            if (!empty($candidate->personal->work_environment_in_office)) {
                                                                $worksetting .= 'In Office/';
                                                            }
                                                            if (!empty($candidate->personal->work_environment_hybrid)) {
                                                                $worksetting .= 'Hybrid';
                                                            }
                                                            if ((!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)) || !empty($candidate->personal->work_environment_hybrid)) {
                                                                $worksettingIcon = 'location';
                                                            }
                                                        @endphp
                                                        <i class="primary-icon fa fa-map-marker"
                                                            aria-hidden="true"></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <p>{{ rtrim($worksetting, '/') }}</p>
                                                        </div>

                                                    </div>

                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img
                                                                src="{{ asset('assets/be/images/ic1.svg') }}"
                                                                alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            @if (isset($candidate->industries))
                                                                <p>{{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                                </p>
                                                            @endif
                                                            <!-- <p>{{ $candidate->personal ? $candidate->personal->address : '' }},{{ $candidate->personal ? $candidate->personal->state_abbr : '' }}</p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="gr_fl col-md-2 col-sm-4 col-6 mb-2 mb-md-0" data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <div class="ask_salary_sec">
                                                    <i class="ic_icon">$</i>
                                                    <div class="ask_salary_sec_rtt">
                                                        <h6>Asking Salary</h6>
                                                        <p>{{ $candidate->personal ? $candidate->personal->salary_range : '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gr_fl col-md-1 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="candidate_grid_ppl_icn large">
                                                    <a href="#url"
                                                        class="ic_award_icn {{ in_array($candidate->id, $my_favorites) ? 'hover_fav' : '' }}"
                                                        wire:click.lazy={{ !in_array($candidate->id, $my_favorites) ? 'saveFavorite(' . $candidate->id . ')' : 'removeFavorite(' . $candidate->id . ')' }}>
                                                        <svg class="not_new" width="20" height="21"
                                                            viewBox="0 0 20 21" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z"
                                                                fill="#FFAE1A" />
                                                        </svg>

                                                        <svg class="new" width="20" height="21"
                                                            viewBox="0 0 20 21" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4016 1.09835C17.6984 0.395088 16.7446 0 15.75 0Z"
                                                                fill="#FFAE1A" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gr_fl col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                @if (count($saved_searches) > 0)
                                                    <div class="candidate_grid_ppl_icn large">
                                                        <a href="#url" class="clickd_tgl_searches">
                                                            <svg fill="#000000" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="ellipsis-icon">
                                                                <circle cx="17.5" cy="12" r="1.5" />
                                                                <circle cx="12" cy="12" r="1.5" />
                                                                <circle cx="6.5" cy="12" r="1.5" />
                                                            </svg></a>
                                                        <div class="clickd_tgl_searches_open">
                                                            <div class="clickd_tgl_searches_open_head">
                                                                <h5>Manage Matched Searches</h5>

                                                                <h5 class="text-muted"><small>Create a filter & save it
                                                                        to use this function</small></h5>
                                                            </div>
                                                            <div class="clickd_tgl_searches_open_ul arr_grey">
                                                                <div class="form_input_check">
                                                                    @foreach ($saved_searches as $key => $search)
                                                                        @php $is_checked = in_array($candidate->id, $search->candidate_ids) ? 1 : 0; @endphp
                                                                        <label>
                                                                            <input type="checkbox"
                                                                                class="manual_add_saved_serach"
                                                                                data-search-id="{{ $search->id }}"
                                                                                data-candidate="{{ $candidate->id }}"
                                                                                wire:click="changeEvent('{{ $is_checked }}', '{{ $search->id }}','{{ $candidate->id }}')"
                                                                                {{ $is_checked ? 'checked' : '' }} />
                                                                            <span>{{ $search->name }}</span>
                                                                        </label>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="gr_fl" data-bs-toggle="modal" data-bs-dismiss="modal">
                                                @if ($candidate->companyStatus->first())
                                                    @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                        <div class="pending_unmask">
                                                            <i class="iconc"><img
                                                                    src="{{ asset('assets/be/images/clock.svg') }}"
                                                                    alt=""></i>
                                                            <div class="pending_unmask_rt">
                                                                <h6>Pending Unmask</h6>
                                                                <p>Profile Saved In Requested</p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="unmasked_div_ic">
                                                            <i class="iconc"><img
                                                                    src="{{ asset('assets/be/images/unmasked.svg') }}"
                                                                    alt=""></i>
                                                            <div class="unmasked_div_ic_rtt">
                                                                <h6>Unmasked</h6>
                                                                <p>View Unmasked Profile Now</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <a href="#url" class="req_mask_btn"
                                                        wire:click.prevent="sendRequest({{ $candidate->id }})">
                                                        <i class="ic_req_m"><img
                                                                src="{{ asset('assets/be/images/masked.svg') }}"
                                                                alt="" /></i>
                                                        <div class="req_mask_btn_rtt">Request Unmask</div>
                                                    </a>
                                                @endif
                                            </div>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-dismiss="modal" class="eye-ball2 eyeBall"
                                                data-id="{{ $candidate->id }}">
                                                @php
                                                    expGraphic($yrs_of_exp);
                                                @endphp

                                            </a>
                                        </div> --}}


                                        <div class="listview_candidate_details  {{ $hired_employee }}"
                                            data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} "
                                            data-id="{{ $candidate->id }}">

                                            <div class="layout_back"
                                                style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                            </div>
                                            <div data-bs-toggle="modal" data-bs-dismiss="modal"
                                                class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="listview_candidate_details_img">
                                                    @if ($candidate->companyStatus->first())
                                                        @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                            <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                                alt="" class="unmasked-p img-thumbnail" />
                                                        @else
                                                            @if ($candidate->profile_photo_path)
                                                                <img src="{{ asset($candidate->profile_photo_path) }}"
                                                                    alt="" class="" />
                                                            @else
                                                                <img src="{{ asset('assets/fe/images/default_user.png') }}"
                                                                    alt="" class="" />
                                                            @endif
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('/assets/be/images/masked_ic.png') }}"
                                                            alt="" class="unmasked-p img-thumbnail" />
                                                    @endif
                                                </div>
                                            </div>
                                            <div data-bs-toggle="modal" data-bs-dismiss="modal"
                                                class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="listview_candidate_details_head">
                                                    @if ($candidate->companyStatus->first())
                                                        @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                            @if (!empty($candidate->name))
                                                                @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                                <h6 class="blured_txt">
                                                                    {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                                </h6>
                                                            @else
                                                                <h6 class="blured_txt">Candidate Name</h6>
                                                            @endif
                                                        @else
                                                            @if (!empty($candidate->name))
                                                                <h6>{{ strlen($candidate->name) > 20 ? substr($candidate->name, 0, 20) . '...' : $candidate->name }}</h6>
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if (!empty($candidate->name))
                                                            @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                            <h6 class="blured_txt">
                                                                {{ substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length) }}
                                                            </h6>
                                                        @else
                                                            <h6 class="blured_txt">Candidate Name</h6>
                                                        @endif
                                                    @endif
                                                    <p>
                                                        @if (!empty($candidate->personal->current_title))
                                                            {{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                            <div data-bs-toggle="modal" data-bs-dismiss="modal"
                                                class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                <div class="ecperice_list">
                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        @php
                                                            $worksetting = '';
                                                            $worksettingIcon = '';
                                                            if (!empty($candidate->personal->work_environment_remote)) {
                                                                $worksetting .= 'Remote/';
                                                            }
                                                            if (!empty($candidate->personal->work_environment_in_office)) {
                                                                $worksetting .= 'In Office/';
                                                            }
                                                            if (!empty($candidate->personal->work_environment_hybrid)) {
                                                                $worksetting .= 'Hybrid';
                                                            }
                                                            if ((!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)) || !empty($candidate->personal->work_environment_hybrid)) {
                                                                $worksettingIcon = 'location';
                                                            }
                                                        @endphp
                                                        <i class="primary-icon fa fa-map-marker"
                                                            aria-hidden="true"></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <p>{{ rtrim($worksetting, '/') }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img
                                                                src="{{ asset('assets/be/images/ic1.svg') }}"
                                                                alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            @if (isset($candidate->industries))
                                                                <p>{{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                                </p>
                                                            @endif
                                                            <!-- <p>{{ $candidate->personal ? $candidate->personal->address : '' }},{{ $candidate->personal ? $candidate->personal->state_abbr : '' }}</p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="gr_fl col-md-2 col-sm-4 col-6 mb-2 mb-md-0"
                                            data-bs-toggle="modal" data-bs-dismiss="modal">
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
                                         <div class="gr_fl d-flex align-items-center col-md-2 col-sm-4 col-6 mb-2 mb-md-0">

                                                @if (count($saved_searches) > 0)
                                                    <div class="candidate_grid_ppl_icn save-list-div text-align-center large save-list-bubble "
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="" @if(empty($candidate->saved_list))style="border:none" @endif>
                                                        @if ($candidate->saved_list)
                                                            {!! $candidate->saved_list !!}
                                                        @else
                                                            {{-- 86a2ymb51 --}}
                                                            {{-- N/A Saved Search --}}
                                                        @endif
                                                    </div>
                                                    <div class="candidate_grid_ppl_icn large ps-1">
                                                        <a href="#url"
                                                            class="ic_award_icn {{ in_array($candidate->id, $my_favorites) ? 'hover_fav' : '' }}"
                                                            wire:click.lazy={{ !in_array($candidate->id, $my_favorites) ? 'saveFavorite(' . $candidate->id . ')' : 'removeFavorite(' . $candidate->id . ')' }}>
                                                            <svg class="not_new" width="20" height="21"
                                                                viewBox="0 0 20 21" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z"
                                                                    fill="#FFAE1A" />
                                                            </svg>

                                                            <svg class="new" width="20" height="21"
                                                                viewBox="0 0 20 21" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4016 1.09835C17.6984 0.395088 16.7446 0 15.75 0Z"
                                                                    fill="#FFAE1A" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                @endif

                                                {{-- task - 86a309hbq --}}
                                                <div class="candidate_grid_ppl_icn large">
                                                    <a href="#url" class="ic_relevant_inc relevant_{{$candidate->id}} {{ in_array($candidate->id, $relevants) ? 'hover_relevant' : '' }}" onclick="{{ !in_array($candidate->id, $relevants) ? "saveRelevant(" . $candidate->id . ")" : "removeRelevant(" . $candidate->id . ")"}}">
                                                        <svg width="20px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    </a>
                                                </div>

                                                <div class="candidate_grid_ppl_icn large">
                                                    <a href="#url" class="ic_nrelevant_inc nrelevant_{{$candidate->id}} {{ in_array($candidate->id, $non_relevants) ? 'hover_nrelevant' : '' }}" onclick="{{ !in_array($candidate->id, $non_relevants) ? "saveNonRelevant(" . $candidate->id .")" : "removeNonRelevant(" . $candidate->id . ")"}}">
                                                        <svg width="20px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    </a>
                                                </div>
                                                {{-- task - 86a309hbq end --}}
                                            </div>

                                            {{-- <div class="gr_fl col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                                @if ($candidate->companyStatus->first())
                                                    @if ($candidate->companyStatus->first()->pivot->status == 0)
                                                        <div class="pending_unmask">
                                                            <i class="iconc"><img
                                                                    src="{{ asset('assets/be/images/clock.svg') }}"
                                                                    alt=""></i>
                                                            <div class="pending_unmask_rt">
                                                                <h6>Pending Unmask</h6>
                                                                <p>Profile Saved In Requested</p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="unmasked_div_ic">
                                                            <i class="iconc"><img
                                                                    src="{{ asset('assets/be/images/unmasked.svg') }}"
                                                                    alt=""></i>
                                                            <div class="unmasked_div_ic_rtt">
                                                                <h6>Unmasked</h6>
                                                                <p>View Unmasked Profile Now</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <a href="javascript:void(0)" class="req_mask_btn">
                                                        <i class="ic_req_m"><img
                                                                src="{{ asset('assets/be/images/masked.svg') }}"
                                                                alt="" /></i>
                                                        <div class="req_mask_btn_rtt">Request Unmask</div>
                                                    </a>
                                                    <div class="modal fade inline-table-modal" id="send-request-modal"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <button type="button"
                                                                    class="close float-right send-rew-cut"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <div class="modal-body">

                                                                    <div class="position_form" wire:ignore.self>

                                                                        <form
                                                                            wire:submit.prevent="sendRequest({{ $candidate->id }})">
                                                                            <div class="form-group">
                                                                                <label>Subject*</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    {{-- task - 86a2rvv8z placeholder="Job title here" --} }
                                                                                    wire:model.defer="position_hiring" />
                                                                                <input type="hidden"
                                                                                    class="form-control"
                                                                                    {{-- task - 86a2rvv8z placeholder="Job title here" --} }
                                                                                    wire:model.lazy="user_id"
                                                                                    value="{{ $candidate->id }}" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Message to Candidate</label>
                                                                                <textarea {{-- task - 86a2rvv8z placeholder="I reviewed your resume..." --} } wire:model.lazy="message"></textarea>
                                                                            </div>
                                                                            <div class="position-submit-btn-otr"
                                                                                wire:loading.remove
                                                                                wire:target="sendRequest">
                                                                                <input type="submit"
                                                                                    value="Send to Candidate"
                                                                                    class="position_submit_btn" />
                                                                            </div>
                                                                            <div class="position-submit-btn-otr"
                                                                                wire:loading wire:targe t="sendRequest">
                                                                                <input type="submit"
                                                                                    value="Sending..." disabled
                                                                                    class="position_submit_btn" />
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div> --}}
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-dismiss="modal" class="eye-ball2 eyeBall"
                                                data-id="{{ $candidate->id }}">
                                                @php
                                                    expGraphic($yrs_of_exp);
                                                @endphp
                                            </a>
                                        </div>
                                        {{-- task - 86a2vx5er --}}
                                       @php $user_id = $candidate->id; $candidate_user = $candidate; $favorites = $my_favorites; $search_id = 0; $company_id = $company; @endphp
                                        @livewire('inc-candidates-profile', compact('user_id', 'candidate_user', 'favorites', 'search_id', 'saved_searches', 'company_id', 'relevants', 'non_relevants'), key(time()))
                                    </div>
                                @endif
                            @endforeach

                            @if (count($candidates) <= 0)
                                <p class="text-center text-muted m-2">No Candidate Matches Found</p>
                            @endif
                        </div>
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
    <!-- <script src="{{ asset('assets/be/js/filters.js') }}"></script> -->
</span>

@php
    function expGraphic($exp)
    {
        $fistBar = 0;
        $secondBar = 0;
        $thirddBar = 0;

        if ($exp <= 4) {
            $fistBar = 0;
            $secondBar = 0;
            $thirddBar = 0;
        }
        if ($exp >= 5 && $exp <= 10) {
            $fistBar = 100;
            $secondBar = 0;
            $thirddBar = 0;
        }
        if ($exp >= 11 && $exp <= 19) {
            $fistBar = 100;
            $secondBar = 100;
            $thirddBar = 0;
        }
        if ($exp >= 20) {
            $fistBar = 100;
            $secondBar = 100;
            $thirddBar = 100;
        }
        $yrs = 'Yrs';
        if ($exp <= 1) {
            $yrs = 'Yr';
        }
        echo '<span>' .
            $exp .
            ' ' .
            $yrs .
            ' Experience</span>
        <div class="d-flex exp-progress-bar">
            <div class="progress first-bar">
                <div class="progress-bar w-' .
            $fistBar .
            '" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            <div class="progress second-bar">
                <div class="progress-bar w-' .
            $secondBar .
            '" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            <div class="progress third-bar">
                <div class="progress-bar w-' .
            $thirddBar .
            '" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
        </div>';
    }
@endphp

</div>

@push('scripts')
    <script>
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

        /*$(function () {
                $('[data-bs-toggle="tooltip"]').tooltip();
            })*/

        window.addEventListener('enableBody', event => {
            $('body').removeAttr('style');
        });
        // task - 86a309hbq
        function filterByCategory(filter) {
            $('body').css({
                'opacity': 0.5,
                'pointer-events': 'none'
            });
            Livewire.emit('applyFilter', filter);
        }

        function saveRelevant(id, search = null) {
                var _data_ = {
                    '_token': '{{ csrf_token() }}',
                    'user_id': id,
                    'unmasked':1,
                };

                $.ajax({
                    url: '{{ url('company/saverelevant') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: _data_,
                    success: function(res) {
                        // if(res.length) {
                            $('.relevant_' + id).addClass('hover_relevant');
                            $('.nrelevant_' + id).removeClass('hover_nrelevant');
                            if(search) {
                                $('.relevant_' + id).attr('onclick', 'removeRelevant(' + id + ', '+ search +')');
                            } else {
                                $('.relevant_' + id).attr('onclick', 'removeRelevant(' + id + ')');
                            }
                            $('#relevant_cnt').text(res.relevant_cnt);
                            $('#nrelevant_cnt').text(res.nrelevant_cnt);

                            var old_unmarked = {{ ($candidates_count > 0 ? $candidates_count : 0) }};
                            $('#unmarked_cnt').text(old_unmarked - res.marked_ids);
                            // Livewire.emit('updateFavorites');

                            let category = @this.get('category');
                            var cat_arr = Object.keys(category).map(function (key) { return category[key]; });

                            if($.inArray('unmarked', cat_arr) !== -1) {
                                $('.exampleModalToggle' + id).modal('hide');
                            $('.candidate-card[data-id="' + id +'"]').remove();
                            }
                        // }
                    }
                })
        }

        function removeRelevant(id, search = null) {
            var _data_ = {
                '_token': '{{ csrf_token() }}',
                'user_id': id,
                'unmasked':1,
            };

            $.ajax({
                url: '{{ url('company/removerelevant') }}',
                type: 'POST',
                dataType: 'json',
                data: _data_,
                success: function(res) {
                    // if(res.length) {
                        $('.relevant_' + id).removeClass('hover_relevant');
                        if(search) {
                            $('.relevant_' + id).attr('onclick', 'saveRelevant(' + id + ', '+ search +')');
                        } else {
                            $('.relevant_' + id).attr('onclick', 'saveRelevant(' + id + ')');
                        }
                        $('#relevant_cnt').text(res.relevant_cnt);
                        $('#nrelevant_cnt').text(res.nrelevant_cnt);

                        var old_unmarked = {{ ($candidates_count > 0 ? $candidates_count : 0) }};
                        $('#unmarked_cnt').text(old_unmarked - res.marked_ids);

                        let category = @this.get('category');
                        var cat_arr = Object.keys(category).map(function (key) { return category[key]; });

                        if($.inArray('relevant', cat_arr) !== -1) {
                            $('.exampleModalToggle' + id).modal('hide');
                            $('.candidate-card[data-id="' + id +'"]').remove();
                        }
                    // }
                    // Livewire.emit('updateFavorites');
                }
            })
        }

        function saveNonRelevant(id, search = null) {
            var _data_ = {
                '_token': '{{ csrf_token() }}',
                'user_id': id,
                'unmasked':1,
            };

            $.ajax({
                url: '{{ url('company/savenonerelevant') }}',
                type: 'POST',
                dataType: 'json',
                data: _data_,
                success: function(res) {
                    console.log(res);
                    // if(res.length) {
                        $('.nrelevant_' + id).addClass('hover_nrelevant');
                        $('.relevant_' + id).removeClass('hover_relevant');
                        if(search) {
                            $('.nrelevant_' + id).attr('onclick', 'removeNonRelevant(' + id + ', '+ search +')');
                        } else {
                            $('.nrelevant_' + id).attr('onclick', 'removeNonRelevant(' + id + ')');
                        }
                        $('#relevant_cnt').text(res.relevant_cnt);
                        $('#nrelevant_cnt').text(res.nrelevant_cnt);

                        var old_unmarked = {{ ($candidates_count > 0 ? $candidates_count : 0) }};
                        $('#unmarked_cnt').text(old_unmarked - res.marked_ids);

                        let category = @this.get('category');
                        var cat_arr = Object.keys(category).map(function (key) { return category[key]; });

                        if($.inArray('unmarked', cat_arr) !== -1) {
                            $('.candidate-card[data-id="' + id +'"]').remove();
                        }
                    // }
                    // Livewire.emit('updateFavorites');
                }
            })
        }

        function removeNonRelevant(id, search = null) {
            var _data_ = {
                '_token': '{{ csrf_token() }}',
                'user_id': id,
                'unmasked':1,
            };

            $.ajax({
                url: '{{ url('company/removenonrelevant') }}',
                type: 'POST',
                dataType: 'json',
                data: _data_,
                success: function(res) {
                    // if(res.length) {
                        $('.nrelevant_' + id).removeClass('hover_nrelevant');
                        if(search) {
                            $('.nrelevant_' + id).attr('onclick', 'saveNonRelevant(' + id + ', '+ search +')');
                        } else {
                            $('.nrelevant_' + id).attr('onclick', 'saveNonRelevant(' + id + ')');
                        }
                        $('#relevant_cnt').text(res.relevant_cnt);
                        $('#nrelevant_cnt').text(res.nrelevant_cnt);

                        var old_unmarked = {{ ($candidates_count > 0 ? $candidates_count : 0) }};
                        $('#unmarked_cnt').text(old_unmarked - res.marked_ids);
                    // }
                    let category = @this.get('category');
                    var cat_arr = Object.keys(category).map(function (key) { return category[key]; });

                    if($.inArray('nonrelevant', cat_arr) !== -1) {
                        $('.exampleModalToggle' + id).modal('hide');
                            $('.candidate-card[data-id="' + id +'"]').remove();
                    }

                    // Livewire.emit('updateFavorites');
                }
            })
        }
        // task - 86a309hbq end

        // task - 86a1h4c1h
        // 86a3c455v
        $(document).ready(function(){
            var uri_id = '{{ request()->segment(3) }}';
            if (uri_id) {
                $('.listview_candidate_details[data-id="' + uri_id + '"]').trigger('click');
            }
        })
        // task - 86a1h4c1h end

        var activeTab = "_";
        $("body").delegate(".list_grid_wrapper li", "click", function(e) {
            /*var _target = $(this).find('button').attr('data-target');
            var _EL = _target.split("-");*/

            var type = $(this).attr('data-type');
            activeTab = $(this).attr('class');
            activeTab = activeTab.split(" ");
            activeTab = activeTab[0];
            if (activeTab == 'grid') {
                @this.set('active_tab', 1);
            } else {
                @this.set('active_tab', 2);
            }
        });

        $('#edit-search').on('shown.bs.modal', function(e) {
            afterLoad($(this));
        })

        document.addEventListener("livewire:load", () => {
            $("body").delegate(".flag_ico_sec,.manual_add_saved_serach", "click", function(e) {
                Livewire.hook('message.processed', (message, component) => {
                    afterLoad($(this));

                })
            })
        })

        function afterLoad() {
            var html =
                " <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js'><\/script><script src='{{ asset('assets/be/js/filters.js') }}'><\/script>";
            $('.' + activeTab).trigger('click');
            let flag = @this.get('is_filtered');
            setTimeout(function() {
                $('.js-select2').each(function() {
                    $(this).val($(this).val()).trigger('change');
                })
                $('.max-range').val($('.max-range').val()).trigger('input');
                $('.min-range').val($('.min-range').val()).trigger('input');

                $('.max-range-distance').val($('.max-range-distance').val()).trigger('input');
                $('.min-range-distance').val($('.min-range-distance').val()).trigger('input');
                $('.' + activeTab).trigger('click');
                $('body').removeAttr('style');
                $('#overlay').hide();
            }, 80);

            setTimeout(function() {
                $('body').removeAttr('style');
                $('#overlay').hide();
            }, 100);
        }

        window.addEventListener('close-notes', event => {
            $('#notesModal').modal('hide');
            // $('#exampleModalToggle2').modal('show');
        });

        function profile_modal(id) {
            Livewire.emit('viewProfile', id);
        }

        window.addEventListener('open-profile-modal', event => {
            // $('#exampleModalToggle2').modal('show');
        })

        // document.addEventListener("livewire:load", () => {
        //     $("body").delegate(".candidate_grid_ppl_wppt,.listview_candidate_details,req_mask_btn", "click", function (e) {
        //         var url = $(this).attr("data-url");
        //         var lastSegment = url.split('/').pop();
        //         $('.right-arrow').attr('data-id',lastSegment)
        //         $('.right-arrow').attr('data-id',lastSegment)
        //         if (!$(e.target).is('.clickd_tgl_searches svg, .clickd_tgl_searches circle,.eyeBall,.eyeBall img,.clickd_tgl_searches_open,.clickd_tgl_searches_open label,.clickd_tgl_searches_open h5,.clickd_tgl_searches_open input,.clickd_tgl_searches_open span,.candidate_grid_ppl_icn a,.candidate_grid_ppl_icn svg,.candidate_grid_ppl_icn path,.req_mask_btn,.req_mask_btn i,.req_mask_btn img,.req_mask_btn .req_mask_btn_rtt,.modal.show div,.modal.show button,.modal.show form,.modal.show input,.modal.show label,.modal.show textarea')) {
        //             $('.cpi').attr('src',url);
        //             // $('#exampleModalToggle2').modal('show')
        //         }
        //     });
        // })

        document.addEventListener("livewire:load", () => {
            $(document).on('click', '#change_order', function(event) {
                $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
                $('#overlay').show();
                // @this.set('count', 6);
                if (!@this.get('is_filtered')) @this.set('is_filtered', true);
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
                    // afterLoad($(this));
                    $('body').removeAttr('style');
                    $('#overlay').hide();
                })
            });

            $("body").delegate(".sort-tab", "click", function(e) {
                $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
                $('#overlay').show();
                console.log('activeTabactiveTab', activeTab)
                var type = $(this).attr('data-type');
                @this.set('sortBy', type);
                // @this.set('count', 6);
                if (!@this.get('is_filtered')) @this.set('is_filtered', true);
                if (type == "newest") {
                    @this.set('sort_order', 'DESC');
                    @this.set('sort_icon', 'down-icon.svg');
                }

                Livewire.hook('message.processed', (message, component) => {
                    console.log('sort');
                    $('body').removeAttr('style');
                    $('#overlay').hide();
                    // afterLoad($(this));
                })
            })
        })

        window.addEventListener('close-request-modal', event => {
            $(".modal").modal("hide");
        });

        window.addEventListener('closeSecondaryModal', event => {
            $("#notesModal").modal("hide");
        });

        window.addEventListener('enableBody', event => {
            $('body').removeAttr('style');
            $('#overlay').hide();
        });

        window.addEventListener('blockBody', event => {
            $('#overlay').show();
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
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
    $(document).ready(function() {
        $("body").delegate(".active_new_link", "click", function(e) {
            $('.saved-search-count').trigger('click')
        });
    });

      $(document).ready(function() {
    // Hover event
    $(document).on("mouseenter", ".custom-tool-container, .custom-tool-greet, .custom-tool-greet span", function() {
       $('.tool-info-greet').css('opacity', 0);
       $(this).parents('.candidate_grid_ppl_icn').find('.tool-info-greet').css('opacity', 1);
    });
    $(document).on("mouseleave",".tool-info-greet",function(){
       $('.tool-info-greet').css('opacity', 0);
    });
    $('body').on('mouseleave ', '.listview_candidate_details,.save-list-bubble,.listview_candidate_details  ', function() {
        $('.tool-info-greet').css('opacity', 0);
      });

});
    </script>
    @php
function removeUnclosedTags($html) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); // Disable libxml errors and allow parsing of HTML
    // $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $dom->loadHTML($html);
    //libxml_clear_errors();
    $anchors = $dom->getElementsByTagName('a');
        $listItems = [];
        foreach ($anchors as $anchor) {
            // Get href and text content
            $href = $anchor->getAttribute('href');
            $text = $anchor->textContent;

            // Create a list item
            $listItems[] = "<li class='bgx-custom-list'><a href='$href'>$text</a></li>";
        }
    //$html = preg_replace('/<p\b[^>]*>/', '', $dom->saveHTML());
      // Remove closing </p> tag
    //$html = preg_replace('/<\/p>/', '', $html);
    return "<ul class='bgx-text-align'>" . implode("", $listItems) . "</ul>";
}
@endphp
@endpush
