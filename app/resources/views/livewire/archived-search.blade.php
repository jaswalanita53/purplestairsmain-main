<div>
    <!-- select2 filters -->
    <link rel="stylesheet" href="{{asset('assets/be/search-page.css')}}" />
    {{-- removed duplicate cdns to load --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/intlTelInput.min.js"></script>
    <div class="mid-contain">
        {{-- task - 86a1uf3ar --}}
        <style type="text/css">
            .select2-container--open, span.select2-dropdown {
                z-index: 1500 !important;
            }

            /* task - 86a2cbmr8 */
            .notification-div {
                background: rgba(var(--yellow-opacity), 0.15); display: inline-flex; line-height: 30px; font-weight: 500; font-family: 'poppins';
            }
            .notification-div span.pulse-1 {
                background: #ffab1942;border-radius: 50%;height: 32px;width: 32px;display: inline-block;font-size: 15px;text-align: center; position: relative; flex: 0 0 32px;
            }
            .notification-div span.pulse-2 {
                background: #ffab19;border-radius: 50%;height: 22px;width: 22px;display: inline-block;font-size: 15px;text-align: center; position: absolute; top: 50%; left: 50%; margin: -11px 0px 0px -11px; line-height: 19px;
            }
            .notification-div img {
                width: 12px;
            }
            /*  task - 86a309hbq  */
            .candidate_grid_ppl_icn-top .clickd_tgl_searches {
                background: none;
            }
            {{-- 86a2tw83k --}}
            @media (max-width: 1399px) {
                .sidebar_extended .seacrh_details_describe .notification-div {
                    font-size: 14px ;
                    width:100%;
                    line-height: normal;
                    align-items: center;
                    padding-left:4px !important

                }
            }
            .notification-div span.pulse-1 {
                margin-right: 5px !important;
            }
        {{-- 86a2tw83k --}}
        </style>
        <div class="container-fluid">
            <div class="main-body">
                <div class="main-body-upper">
                    @php
                    $field=json_decode($search->search_fields);
                    @endphp

                    <div class="seacrh_details_describe">
                        <div class="row seacrh_details_describe_row">
                            <div class="col-lg-8 seacrh_details_describe_col_lft">
                                <h3 class="text-capitalize">{{ $search->name }}</h3>
                                                                {{-- //86a2zt9nn new match --}}
                                <span style="cursor:pointer" onclick="filterByCategory('')" class="saved-search-count py-1 px-3">{{ count($search->searchUser) }} Candidate{{(count($search->searchUser) > 1) ? 's' : ''}}{{-- task - 86a26ba92 --}}</span>

                                {{-- // start 86a2qrw1r --}}
                                {{-- @if($search->new_match_count > 0)
                                <span class="notificate_total new_link" wire:click="filterNew()">{{$search->new_match_count}} NEW</span>
                                @endif --}}
                                 @if(!empty($search->newMatch))
                                @if(!empty(count($search->newMatch)))
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

                                {{-- wire:click="filterByCategoryForNew('new')" --}}
                                {{--  @if($categoryNew=='new') active_new_link @endif  --}}
                                <span class="notificate_total new_link {{ in_array('new', $category) ? 'active_new_link' : '' }}" onclick="filterByCategory('new')">{{count($search->newMatch)}} NEW</span>
                                @endif
                                @endif
                                {{-- // 86a2qrw1r end --}}
                                {{-- 86a2zt9nn --}}

                            </div>

                            <div class="col-lg-4 seacrh_details_describe_col_rtt">
                                <a href="javascript:void(0)" wire:click.prevent="unArchiveSearch({{$search->id}})" class="unarchive-s-btn">Unarchive Search
                                    <!-- <i><img src="{ { asset('assets/be/images/edit_sc.svg') }}" alt="" /></i> -->
                                </a>
                            </div>
                             <span>
                            @php
                            $showCount=0;
                            @endphp
                            @if (in_array('new', $category))
                                @php
                                 $showCount=count($search->newMatch)
                                 @endphp
                            @elseif (in_array('favorites', $category))
                                 @php
                                  $showCount=$favorites_count
                                  @endphp
                            @elseif (in_array('relevant', $category))
                                @php
                                 $showCount=count($relevants)
                                 @endphp
                            @elseif (in_array('nonrelevant', $category))
                                @php
                                 $showCount=count($non_relevants)
                                 @endphp
                            @elseif (in_array('unmarked', $category))
                                @php
                                 $showCount=count($unmarked)
                                 @endphp
                            @elseif (in_array('requested', $category))
                                @php
                                 $showCount=$requested_count
                                 @endphp
                            @elseif (in_array('unmasked', $category))
                                @php
                                 $showCount=$unmasked_count
                                 @endphp
                            @else
                                 @php
                                  $showCount=$candidates_count
                                  @endphp
                            @endif
                            {{ $showCount }}  @if($showCount>1)candidates are @else candidate is @endif  shown</span>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex flex-wrap-- float-right filter-row selected-filters-items mb-">

                                    @php
                                    $currentPosition="";
                                    @endphp
                                    @if(!empty($field->selectCurrentPosition) && $field->selectCurrentPosition!="null")
                                    @php
                                    $currentPosition=$field->selectCurrentPosition;
                                    @endphp
                                    @endif
                                    @if(!empty($currentPosition))
                                    <div class="col-  filter-col-box">
                                        <span class="filter-type">Current Position:</span> {{$currentPosition}} <span class="filter-seperate">|</span>
                                    </div>
                                    @endif

                                    @php
                                    $yrsOfExp="";
                                    @endphp
                                    {{-- task - 86a0btjx8 --}}
                                    @if($field->selectMaxYearOfExperience-$field->selectMinYearOfExperience!=40)
                                    @php
                                    $yrsOfExp=$field->selectMinYearOfExperience.' - '. $field->selectMaxYearOfExperience;
                                    @endphp
                                    @endif
                                    @if(!empty($yrsOfExp))
                                    <div class="col- filter-col-box">
                                        <span class="filter-type">Yrs Of Exp:</span> {{$yrsOfExp}} <span class="filter-seperate">|</span>
                                    </div>
                                    @endif
                                @php
                                $salaryRange="";
                                @endphp
                                @foreach ($all_salaries as $key => $salary)

                                @if(in_array($key,$field->selectSalaryRange))
                                @php
                                $salaryRange.=$key.', ';
                                @endphp
                                @endif

                                @endforeach
                                @if(!empty($salaryRange))
                                <div class="col-  filter-col-box">
                                    <span class="filter-type">Salary Range:</span> {{substr($salaryRange, 0, -2)}} <span class="filter-seperate">|</span>
                                </div>
                                @endif

                                @php
                                $compensationType="";
                                @endphp
                                @foreach ($all_compensations as $key => $compensation)

                                @if(in_array($compensation,$field->selectCompensation))
                                @php
                                $compensationType.=$key.', ';
                                @endphp
                                @endif

                                @endforeach
                                @if(!empty($compensationType))
                                <div class="col-  filter-col-box">
                                    <span class="filter-type">Compensation Type:</span> {{substr($compensationType, 0, -2)}} <span class="filter-seperate">|</span>
                                </div>
                                @endif

                                @php
                                $distance="";
                                @endphp
                                @if($field->selectMaxDistance-$field->selectMinDistance!=100)
                                @php
                                $distance=$field->selectMinDistance.' - '. $field->selectMaxDistance;
                                @endphp
                                @endif
                                @if(!empty($distance))
                                <div class="col- filter-col-box">
                                    <span class="filter-type">Distance:</span> {{$distance}} miles <span class="filter-seperate">|</span>
                                </div>
                                @endif

                                @php
                                $schedules="";
                                @endphp
                                @foreach ($all_schedules as $key => $schedule)

                                @if(in_array($schedule,$field->selectSchedule))
                                @php
                                $schedules.=$key.', ';
                                @endphp
                                @endif

                                @endforeach
                                @if(!empty($schedules))
                                <div class="col-  filter-col-box">
                                    <span class="filter-type">Schedule:</span> {{substr($schedules, 0, -2)}} <span class="filter-seperate">|</span>
                                </div>
                                @endif

                                @php
                                $interests="";
                                @endphp
                                @foreach ($all_interests as $key => $interest)

                                @if(in_array($interest,$field->selectedInterests))
                                @php
                                $interests.=$key.', ';
                                @endphp
                                @endif

                                @endforeach
                                @if(!empty($interests))
                                <div class="col-  filter-col-box">
                                    <span class="filter-type">Interests:</span> {{substr($interests, 0, -2)}} <span class="filter-seperate">|</span>
                                </div>
                                @endif

                                @php
                                $industries="";
                                @endphp
                                @foreach ($all_industries as $key => $ind)

                                @if(in_array($ind,$field->selectedIndustries))
                                @php
                                $industries.=$key.', ';
                                @endphp
                                @endif

                                @endforeach
                                @if(!empty($industries))
                                <div class="col-  filter-col-box">
                                    <span class="filter-type">Industries:</span> {{substr($industries, 0, -2)}} <span class="filter-seperate">|</span>
                                </div>
                                @endif

                                @php
                                $hardSkills="";
                                @endphp
                                @foreach ($all_hard_skills as $key => $skill)

                                @if(in_array($skill,$field->selectedHardSkills))
                                @php
                                $hardSkills.=$key.', ';
                                @endphp
                                @endif

                                @endforeach
                                @if(!empty($hardSkills))
                                <div class="col-  filter-col-box">

                                    <span class="filter-type">Hard Skills:</span> {{substr($hardSkills, 0, -2)}}<span class="filter-seperate">|</span>
                                </div>
                                @endif

                                @php
                                $softSkills="";
                                @endphp
                                @foreach ($all_soft_skills as $key => $skill)

                                @if(in_array($skill,$field->selectedSoftSkills))
                                @php
                                $softSkills.=$key.', ';
                                @endphp
                                @endif

                                @endforeach
                                @if(!empty($softSkills))
                                <div class="col-  filter-col-box">
                                    <span class="filter-type">Soft Skills:</span> {{substr($softSkills, 0, -2)}}<span class="filter-seperate">|</span>
                                </div>
                                @endif



                                @php
                                $workEnvironment="";
                                @endphp
                                @foreach ($all_work_environments as $key => $environment)

                                @if(in_array($environment,$field->selectWorkEnvironment))
                                @php
                                $workEnvironment.=$key.', ';
                                @endphp
                                @endif

                                @endforeach
                                @if(!empty($workEnvironment))
                                <div class="col-  filter-col-box">
                                    <span class="filter-type">Work Setting:</span> {{substr($workEnvironment, 0, -2)}} <span class="filter-seperate">|</span>
                                </div>
                                @endif

                                @php
                                $languages="";
                                @endphp
                                @foreach ($all_languages as $key => $language)
                                @if(in_array($language,$field->selectedLanguages))
                                @php
                                $languages.=$key.', ';
                                @endphp
                                @endif
                                @endforeach
                                @if(!empty($languages))
                                <div class="col-  filter-col-box">
                                    <span class="filter-type">Languages:</span> {{substr($languages, 0, -2)}}
                                </div>
                                @endif

                                @php
                                $zip_codes="";
                                @endphp
                                @if(!empty($field->selectZipCode))
                                @foreach ($all_zipcodes as $key => $zipcode)
                                @if(in_array($zipcode,$field->selectZipCode))
                                @php
                                $zip_codes.=$zipcode.', ';
                                @endphp
                                @endif
                                @endforeach
                                @if(!empty($zip_codes))
                                <div class="col-  filter-col-box">
                                    <span class="filter-type">Zip Codes:</span> {{substr($zip_codes, 0, -2)}}
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- task - 86a2cbmr8 --}}
                    <div class="col-md-12 px-3 py-2 notification-div my-3">
                        <span class="pulse-1">
                            <span class="pulse-2">
                                <img src="{{ asset('assets/be/images/wht-notification.svg') }}" />
                            </span>
                        </span> &nbsp;New candidates are signing up daily. If a candidate matches your saved search criteria you will receive an email with their profile.
                    </div>
                    {{-- task - 86a2cbmr8 end --}}
                </div>


                <!-- Modal -->
                <div class="modal fade" id="edit-search" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <form wire:submit.prevent="saveSearch()" id="update-search-form">
                                <div class="modal-body ">
                                    <div class="row">
                                        <p><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button></p>
                                        <h3 class="search-pop-h mb-3">Edit Search <span class="float-right time-search">Search created: {{$search->created_at->format('m/d/Y')}}</span></h3>
                                    </div>

                                    {{-- task - 86a0y5twp --}}
                                    @if ($archive_search_message)
                                    <div class="alert alert-purple mt-3" role="alert">
                                        {{ $archive_search_message }}
                                    </div>
                                    @endif

                                    @if (session('success'))
                                    <div class="alert alert-purple mt-3" role="alert">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    <div class="gl-frm-outr">
                                        <label class="mb-2">Search Name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control edit-search-name" value="{{$search->name }}" />
                                            <span id="search_name_error" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <input type="hidden" class="search_id" value="{{$search->id}}">
                                    @include('inc.updateSearch')
                                </div>
                                <div class="modal-footer- py-5 px-3">
                                    {{-- task - 86a0y5twp --}}
                                    {{-- <button type="button" class="btn btn-secondary float-left archive-btn" wire:click="deleteSearch({{$search->id}})">Archive Search</button> --}}
                                    <a href="javascript:;" class="btn btn-secondary float-left archive-search" wire:click="deleteSearch({{$search->id}})">Archive Search</a>

                                    {{-- task - 86a1h4d9k --}}
                                    <a href="javascript:;" class="btn btn-secondary float-left archive-search my-2" onclick="return confirm('Are you sure you want to delete this search?') || event.stopImmediatePropagation()" wire:click="delete_Search({{$search->id}})">Delete Search</a>

                                    <button type="submit" class="btn btn-primary float-right search-update-btn update-search my-2 my-sm-0">Update Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="view_cancidate_all_set">
                    <div class="row view_cancidate_all_set_row gap candidate_row-">
                        {{-- task - 86a38ddyb --}}
                        <div class="col-xl-3 col-lg-5 view_cancidate_all_set_col_lft">
                            <div class="suggestion_search_wrapper suggestion_search_wrapper-left">
                                <ul>
                                    <li>
                                        <a href="#url" class="{{in_array('', $category) || empty($category) ? 'active' : ''}}" onclick="filterByCategory('')">
                                            {{-- Suggested ({{ $candidates_count }}) --}}
                                            All ({{ $candidates_count }})
                                        </a>
                                    </li>
                                    {{-- <li><a href="#url" wire:click="filterByCategory('favorites')" class="{{$category == 'favorites' ? 'active' : ''}}">My Favorites
                                    ({{ $favorites_count }})</a></li> --}}
                                    <li><a href="#url" onclick="filterByCategory('requested')" class="{{in_array('requested', $category) ? 'active' : ''}}"><!--Requested--> Requested
                                            ({{ $requested_count }})</a></li>
                                    <li><a href="#url" onclick="filterByCategory('unmasked')" class="{{in_array('unmasked', $category) ? 'active' : ''}}">Unmasked
                                            ({{ $unmasked_count }})</a></li>
                                </ul>
                            </div>
                        </div>

                        {{-- task - 86a38ddyb --}}
                        <div class="col-xl-9 col-lg-7 view_cancidate_all_set_col_rtt">
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
                                    $sort_by_arr = array(
                                        '' => '',
                                        'alpha' => 'A to Z',
                                        'distance' => 'Distance',
                                        'newest' => 'Newest',
                                        'experience' => 'Experience',
                                    );
                                @endphp
                                <span class="d-flex-1340">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort By <span class="sort_by_val">{{ $sort_by_arr[$sortBy] }}</span>
                                </button>
                                {{-- task - 86a2vxfb2 --}}
                                <a href="javascript:;" id="change_order" class="p-2 d-flex justify-content-end" style="flex:none">
                                    <img src="{{asset('assets/be/images/'.$sort_icon)}}" alt="" />
                                    <img src="{{asset('assets/be/images/'.$sort_icon2)}}" alt="" />
                                </a>
                                 </span>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    {{-- task - 8678ffjx0 <li>
                                        <a class="dropdown-item sort-tab" href="#" data-type="alpha"> A to Z </a>
                                    </li> --}}
                                    <li>
                                        <a class="dropdown-item sort-tab py-2 {{ $sortBy=="distance" ? 'bg-purple text-white' : '' }}" href="#" data-type="distance"> Distance </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item sort-tab py-2 {{ $sortBy=="newest" ? 'bg-purple text-white' : '' }}" href="#" data-type="newest"> Newest </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item sort-tab py-2 {{ $sortBy=="experience" ? 'bg-purple text-white' : '' }}" href="#" data-type="experience">
                                            Experience
                                        </a>
                                    </li>
                                </ul>
                            </div>

                                <div class="list_grid_wrapper" ppppppp{{ $active_tab }}>
                                <ul>
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
                        {{-- ========================= ====== grid card view 86a3pydn9 --}}
                        <style>
                        .grid-card-icons{
                                width: 15px;
                                border: 1px solid;
                                border-radius: 50%;
                                height: 15px;
                                text-align: center;

                        }
                        .candidate_grid_ppl_wppt .main_img img{
                                height: 95px;
                                width: 95px;
                                object-fit: cover;
                        }
                        </style>
                        <div class="row candiate_list_view_parent_row gy-4">
                            @foreach ($candidates as $candidate)
                            {{-- task - 86a0qvtjx --}}
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


                            @if($candidate->personal)
                            @if ($candidate->personal->hired_status)
                            <div class="col-xl-4 col-md-6 candiate_list_view_parent_col candidate-card candidate-grid-card" data-id="{{ $candidate->id }}">
                                @php $hired_employee=""; @endphp
                            @if(!empty($candidate->delete_status))
                            <!-- @if($candidate->delete_status->type=='sleep')
                            <span class="hired">Hired</span><span class="hired-flag"></span>
                            @php $hired_employee="blured_box";@endphp -->
                            <!-- @endif -->
                            <span class="hired">Hired</span><span class="hired-flag"></span>
                            @php $hired_employee="blured_box";@endphp
                            @elseif (time() - strtotime($candidate->created_at) < 60*60*24)
                                <span class="hired bg-danger">New!</span><span class="hired-flag bg-danger"></span>
                                    @php $hired_employee="flaged";@endphp
                            @else
                            @if($candidate->companyStatus->first())
                            @if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2)
                            <span class="pending-label position-static" style="margin-top: 5px;"><span class="hired">Requested</span><span class="hired-flag"><i class="iconc"><img src="{{asset('assets/be/images/clock-white.svg')}}" alt=""></i></span></span>
                                @php $hired_employee="requested";@endphp
                            @else
                            <span class="unmasked-flag">
                                <span class="hired">Unmasked</span><span class="hired-flag"></span>
                                @php $hired_employee="flaged";@endphp
                            </span>

                            @endif
                            @else
                            @endif
                            @endif
                                <div class="text-capitalize candidate_grid_ppl_wppt {{$hired_employee}}" data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} " data-id="{{$candidate->id}}">
                                    <div class="candidate_grid_ppl hired_sec ">
                                        <div class="candidate_top_pnk_ic">
                                            <img src="{{ asset('assets/be/images/shape_left_pnk.png') }}" alt="" />
                                        </div>
                                        <div class="hired_sec_span">Hired</div>
                                        <div class="candidate_grid_ppl_icn">
                                            <ul>
                                                <li>

                                                    <a href="#url" style="width:34px;height:34px;" class="flag_ico_sec favorite_{{$candidate->id}} {{ in_array($candidate->id, $my_favorites) ? 'hover_fav' : '' }}" onclick="{{ !in_array($candidate->id, $my_favorites) ? "saveFavorite(" . $candidate->id .",".$search->id.")" : "removeFavorite(" . $candidate->id . ",".$search->id.")"}}">
                                                        <svg class="not_new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z" fill="#FFAE1A"></path>
                                                        </svg>
                                                    </a>
                                                </li>
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
                                                            @if(count($saved_searches) == 0)
                                                            <h5 class="text-muted"><small>Create a filter & save it to use this function</small></h5>
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
                                            </ul>
                                        </div>

                                        <div class="candidate_grid_ppl_top">
                                                <figure class="main_img">
                                                    @if($candidate->companyStatus->first())
                                                        @if($candidate->companyStatus->first()->pivot->status == 0)
                                                            <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail rounded-circle" />
                                                        @else
                                                            @if($candidate->profile_photo_path)
                                                                <img src="{{ asset($candidate->profile_photo_path) }}" alt="" class=" rounded-circle" />
                                                            @else
                                                                <img src="{{asset('assets/fe/images/default_user.png')}}" alt="" class=" rounded-circle" />
                                                            @endif
                                                        @endif
                                                    @else
                                                    {{-- showing error Attempt to read property "profile_status" on null --}}
                                                    @if(!empty($candidate->personal))
                                                        {{-- task - 86a1tzdqv - POINT - 8 --}}
                                                        @if($candidate->personal->profile_status == 0)
                                                            <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail rounded-circle" />
                                                        @else
                                                            <img src="{{ asset($candidate->profile_photo_path) }}" alt="" class=" rounded-circle" />
                                                        @endif
                                                        @endif
                                                    @endif
                                                </figure>
                                                <div class="candidate_grid_ppl_top_rt">
                                                        <span class="d-flex">
                                                        <span class="grid-box-detail">
                                                        @if($candidate->companyStatus->first())
                                                        @if($candidate->companyStatus->first()->pivot->status == 0)
                                                        @if(!empty($candidate->name))
                                                        @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                        <h6 class="blured_txt">{{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}}</h6>
                                                        @else
                                                        <h6 class="blured_txt">Candidate Name</h6>
                                                        @endif
                                                        @else
                                                        @if(!empty($candidate->name )){{ strlen($candidate->name ) > 20 ? substr($candidate->name , 0, 20) . '...' : $candidate->name }} @endif
                                                        @endif
                                                        @else
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
                                                        @endif
                                                        <p>@if(!empty($candidate->personal->current_title)){{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }} @endif

                                                        </p>
                                                        </span>
                                                        <span class="grid-exp grid-exp-{{$hired_employee}}"> @php
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
                                                </li>

                                                <li>
                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img src="{{ asset('assets/be/images/ic1.svg') }}" alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            @if (isset($candidate->industries))
                                                            <p>{{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                            </p>
                                                            @endif
                                                            <!-- <p>{{$candidate->personal ? $candidate->personal->address : ''}},{{$candidate->personal ? $candidate->personal->state_abbr : ''}}</p> -->
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img src="{{ 'assets/be/images/ic3.svg' }}" alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <h6>Asking Salary</h6>
                                                            <p>{{ $candidate ? $candidate->personal->salary_range : '' }}
                                                            </p>
                                                        </div>
                                                        {{-- ================== gird card --}}
                                                    @if(!empty($candidate->personal->zip_code))
                                                     <p class="zip-code-p mt-2 candidate_grid_ppl_top_btm_wrap_rtt"><i class="fa fa-map-marker" aria-hidden="true" style="font-size:16px;"></i> <span>ZIPCODE {{ $candidate->personal->zip_code }}</span></p>
                                                    @endif
                                                    {{-- ================== gird card --}}
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img src="{{ 'assets/be/images/ic4.svg' }}" alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <h6>Area of Interest</h6>
                                                            @if (isset($candidate->interests))
                                                            @if ($candidate->interests->first())
                                                            <p>{{ $candidate->interests->first()->name }}</p>
                                                            @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- task - 86a1tzdqv @include('inc.candidateProfile', ['userId' => $candidate->id]) --}}

                                    {{-- task - 86a2vx5er --}}
                                    @php $user_id = $candidate->id; $candidate_user = $candidate; $favorites = $my_favorites; $search_id = $search->id; $company_id = $company; @endphp
                                    @livewire('inc-candidates-profile', compact('user_id', 'candidate_user', 'favorites', 'search_id', 'saved_searches', 'company_id', 'relevants', 'non_relevants'), key(time()))
                                </div>
                                @else
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
                            <span class="pending-label position-static" style="margin-top: 5px;"><span class="hired">Requested</span><span class="hired-flag"><i class="iconc"><img src="{{asset('assets/be/images/clock-white.svg')}}" alt=""></i></span></span>
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
                                                        <a href="#url" style="width:34px;height:34px;" class="flag_ico_sec favorite_{{$candidate->id}} {{ in_array($candidate->id, $my_favorites) ? 'hover_fav' : '' }}"   onclick="{{ !in_array($candidate->id, $my_favorites) ? "saveFavorite(" . $candidate->id .",".$search->id.")" : "removeFavorite(" . $candidate->id . ",".$search->id.")"}}">
                                                            <svg class="not_new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z" fill="#FFAE1A"></path>
                                                            </svg>
                                                        </a>
                                                    </li>

                                                    {{-- task - 86a309hbq --}}
                                                    <li  class="float-right me-1">
                                                        <a href="#url" class="ic_relevant_inc relevant_{{$candidate->id}} {{ in_array($candidate->id, $relevants) ? 'hover_relevant' : '' }}" onclick="{{ !in_array($candidate->id, $relevants) ? "saveRelevant(" . $candidate->id .")" : "removeRelevant(" . $candidate->id . ")"}}">
                                                            <svg width="20px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                        </a>
                                                    </li>

                                                    <li  class="float-right me-1">
                                                        <a href="#url" class="ic_nrelevant_inc nrelevant_{{$candidate->id}} {{ in_array($candidate->id, $non_relevants) ? 'hover_nrelevant' : '' }}" onclick="{{ !in_array($candidate->id, $non_relevants) ? "saveNonRelevant(" . $candidate->id .")" : "removeNonRelevant(" . $candidate->id . ")"}}">
                                                            <svg width="20px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                        </a>
                                                    </li>
                                                    {{-- task - 86a309hbq end --}}
                                                </ul>
                                            </div>
                                            {{-- <div class="candidate_top_pnk_ic">
                                                <img src="{{ asset('assets/be/images/shape_left_pnk.png') }}" alt="" />
                                            </div> --}}


                                            <div class="candidate_grid_ppl_top- ">
                                                <div class="row w-100 mt-3">
                                                <div class="col-3  mt-3 ps-1">
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
                                                                <h6 class="mb-1">{{ $candidate->name }} </h6>
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
                                    @php $user_id = $candidate->id; $candidate_user = $candidate; $favorites = $my_favorites; $search_id = $search->id; $company_id = $company; @endphp
                                    @livewire('inc-candidates-profile', compact('user_id', 'candidate_user', 'favorites', 'search_id', 'saved_searches', 'company_id', 'relevants', 'non_relevants'), key(time()))
                                </div>
                                @endif
                                @endif
                                @endif
                                @endforeach

                            </div>
                            {{-- task - 86a2qrtan --}}
                                @if($filteredUserCount > 0)
                                    @if(count($candidates)<$filteredUserCount)
                                        <a href="#url" class="load_more" wire:click="loadMore">
                                            <i><img src="{{ asset('assets/be/images/load_ic.svg') }}" alt="" /></i>
                                            <span class="loadSpan">Load More</span>
                                        </a>
                                    @else
                                        <p class="text-center text-muted m-2">No More Candidate Matches Found</p>
                                    @endif
                                @endif
                        </div>
                    {{-- ================================= grid card view --}}
                        <div class="listgrid_cnt  {{($active_tab==2) ? 'active' : '' }} candidate_box_parent" id="content-2">
                            @foreach ($candidates as $candidate)

                            {{-- task - 86a0qvtjx --}}
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
                            {{-- @if (!in_array($candidate->id, $new_candidates_ids)) --}}
                            @php $hired_employee=""; @endphp
                            @if(!empty($candidate->delete_status))
                                @if($candidate->delete_status->type=='sleep')
                                    @php $hired_employee="blured_box";@endphp
                                @endif
                            @endif

                            {{-- task - 86a0t9838 --}}
                            @if (time() - strtotime($candidate->created_at) < 60*60*24)
                                @php $hired_employee="new-employee";@endphp
                            @endif
                            <div class="listview_candidate_details_w detail_{{$hired_employee}} candidate-card" data-id="{{$candidate->id}}">
                            <!-- <div class="listview_candidate_details_w "> -->
                                @php $hired_employee=""; @endphp
                                @if(!empty($candidate->delete_status))
                                    @if($candidate->delete_status->type=='sleep')
                                        <span class="hired">Hired</span><span class="hired-flag"></span>
                                        @php $hired_employee="blured_box";@endphp
                                    @endif
                                @elseif (time() - strtotime($candidate->created_at) < 60*60*24)
                                {{-- task - 86a0t9838 --}}
                                    <span class="hired bg-danger">New!</span><span class="hired-flag bg-danger"></span>
                                    @php $hired_employee="flaged";@endphp
                                @endif

                                <div class="text-capitalize listview_candidate_details row mx-0  {{$hired_employee}}" data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} " data-id="{{$candidate->id}}">

                                    <div class="layout_back" style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" >
                                    </div>
                                    @if(count($saved_searches)>0)
                                            <div class="candidate_grid_ppl_icn-top large searches-manage" style="margin: -10px;">
                                                <a href="#url" class="clickd_tgl_searches">
                                                    <svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="ellipsis-icon-" width="25px" height="25px">
                                                        <circle cx="17.5" cy="12" r="1.5" />
                                                        <circle cx="12" cy="12" r="1.5" />
                                                        <circle cx="6.5" cy="12" r="1.5" />
                                                    </svg></a>
                                                <div class="clickd_tgl_searches_open clickd_tgl_searches_open_search">
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
                                            </div>
                                            @endif
                                    <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                        <div data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" >

                                            {{-- $candidate->personal['profile_status'] --}}
                                                <div class="listview_candidate_details_img">
                                                {{-- 86a2ymdej --}}
                                                @if($candidate->companyStatus->first())
                                                    @if($candidate->companyStatus->first()->pivot->status == 0)
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
                                                    <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                        {{-- <div data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" > --}}
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
                                        {{-- </div> --}}
                                    </div>

                                    <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                        <div data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" >
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
                                                    if((!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)) || !empty($candidate->personal->work_environment_hybrid)){
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
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                        <div class="gr_fl" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" >
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
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0 d-flex gap-2">
                                        <div class="candidate_grid_ppl_icn large">
                                            <a href="#url" class="ic_award_icn favorite_{{$candidate->id}} {{ in_array($candidate->id, $my_favorites) ? 'hover_fav' : '' }}" onclick="{{ !in_array($candidate->id, $my_favorites) ? "saveFavorite(" . $candidate->id .",".$search->id.")" : "removeFavorite(" . $candidate->id . ",".$search->id.")"}}">
                                                <svg class="not_new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z" fill="#FFAE1A" />
                                                </svg>

                                                <svg class="new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4016 1.09835C17.6984 0.395088 16.7446 0 15.75 0Z" fill="#FFAE1A" />
                                                </svg>
                                            </a>
                                        </div>

                                        {{-- task - 86a309hbq --}}
                                        <div class="candidate_grid_ppl_icn large">
                                            <a href="#url" class="ic_relevant_inc relevant_{{$candidate->id}} {{ in_array($candidate->id, $relevants) ? 'hover_relevant' : '' }}" onclick="{{ !in_array($candidate->id, $relevants) ? "saveRelevant(" . $candidate->id .",". $search->id .")" : "removeRelevant(" . $candidate->id . ",". $search->id .")"}}">
                                                <svg width="20px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                            </a>
                                        </div>

                                        <div class="candidate_grid_ppl_icn large">
                                            <a href="#url" class="ic_nrelevant_inc nrelevant_{{$candidate->id}} {{ in_array($candidate->id, $non_relevants) ? 'hover_nrelevant' : '' }}" onclick="{{ !in_array($candidate->id, $non_relevants) ? "saveNonRelevant(" . $candidate->id .",". $search->id .")" : "removeNonRelevant(" . $candidate->id . ",". $search->id .")"}}">
                                                <svg width="20px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                            </a>
                                        </div>
                                        {{-- task - 86a309hbq end --}}

                                        {{-- this section moved on top | task - 86a309hbq --}}
                                    </div>

                                    <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
                                        @if($candidate->companyStatus->first())
                                        @if($candidate->companyStatus->first()->pivot->status == 0)
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
                                            // task - 86a1tzdqv - POINT - 8
                                        @endphp

                                        {{-- task - 86a1tzdqv - POINT - 8 check if fully visible profile --}}
                                        {{-- @if(in_array('0', $personal_status) || in_array('0', $edu_status) || in_array('0', $emp_status) || in_array('0', $ref_status)) --}}
                                        <a href="javascript:void(0)" class="req_mask_btn req_mask_btn_list">
                                            <i class="ic_req_m"><img src="{{ asset('assets/be/images/masked.svg') }}" alt="" /></i>
                                            <div class="req_mask_btn_rtt">Request Unmask</div>
                                        </a>
                                        <div class="modal fade inline-table-modal" id="send-request-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
                                            <div class="modal-dialog" role="document" wire:ignore>
                                                <div class="modal-content">
                                                    <button type="button" class="close float-right send-rew-cut" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <div class="modal-body">

                                                        <div class="position_form" wire:ignore>

                                                            <form wire:submit.prevent="sendRequest({{$candidate->id}})">
                                                                <div class="form-group">
                                                                    <label>Subject*</label>
                                                                    <input type="text" class="form-control" {{-- task - 86a2rvv8z placeholder="Job title here" --}} wire:model.defer="position_hiring" />
                                                                    <input type="hidden" class="form-control" {{-- task - 86a2rvv8z placeholder="Job title here" --}} wire:model.lazy="user_id" value="{{$candidate->id}}" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Message to Candidate</label>
                                                                    <textarea {{-- task - 86a2rvv8z placeholder="I reviewed your resume..." --}} wire:model.lazy="message"></textarea>
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
                                    <a href="javascript:void(0)" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" class="eye-ball2 eyeBall"  data-id="{{ $candidate->id }}">
                                    @php
                                     expGraphic($yrs_of_exp);
                                    @endphp

                                    </a>
                                </div>
                                {{-- task - 86a1tzdqv @include('inc.candidateProfile', ['userId' => $candidate->id]) --}}

                                @php $user_id = $candidate->id; $candidate_user = $candidate; $favorites = $my_favorites; $search_id = $search->id; $company_id = $company; @endphp
                                @livewire('inc-candidates-profile', compact('user_id', 'candidate_user', 'favorites', 'search_id', 'saved_searches', 'company_id', 'relevants', 'non_relevants'), key(time()))
                            </div>

                            @endif
                            @endforeach

                            {{-- task - 86a2qrtan --}}
                            @if($filteredUserCount > 0)
                                @if(count($candidates)<$filteredUserCount)
                                    <a href="#url" class="load_more" wire:click="loadMore">
                                        <i><img src="{{ asset('assets/be/images/load_ic.svg') }}" alt="" /></i>
                                        <span class="loadSpan">Load More</span>
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>

                    @if($category=='suggested' || $category=='')
                        <a href="{{ route('company.dashboard') }}" class="vbtn_finding">Not finding who you're looking for? Click here to view our entire candidate database</a>
                    @endif
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
        <!-- <script src="{ {asset('assets/be/js/filters.js')} }"></script> -->
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
echo    '<span>'.$exp.' '.$yrs.' Experience</span>
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
    {{-- @include('inc.candidateProfile') --}}
</div>

@push('scripts')
<script>
    var all_candidate_ids = $.parseJSON('{{ json_encode($all_candidates_ids) }}'); // task - 86a3150au
    var old_tags = [], diff = [], diff2 = [], __tags = []; // task - 86a26mx9v

    // task - 86a2qrtan
    var load_more_complete = 0;

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

    window.addEventListener('enableBody', event => {
        $('body').removeAttr('style');
        // $('.inline-table-modal').modal('hide');
        $('#overlay').hide();
    });

    window.addEventListener('blockBody', event => {
        $('#overlay').show();
        $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
    });

    window.addEventListener('updateLoadMore', event => {
        load_more_complete = 0;
    });
    // task - 86a2qrtan end

    $(document).on('click', '.request_btn', function(event) {
        /* Act on the event */
        $(this).parent().find(".position_form").toggleClass("active")
    });

    // dev
    $(document).on('click', '.close_req_mask', function(event) {
        $(".request_btn").parent().find(".position_form").removeClass("active")
    });

    document.addEventListener("livewire:load", () => {
        // filters();
        saveSearch();

        Livewire.hook('message.received', (message, component) => {
            console.log('message.received');
            all_candidate_ids = @this.get('all_candidates_ids');
        });

        // task - 86a3150au
        $(document).on('click', '.popup-prof-cut', function(event) {
            if($('.modal-backdrop').length) {
                $('.modal-backdrop').remove();
            }
        });

        $("body").delegate(".right-arrow", "click", function(e) {
            arrow_click = 1;
            var id = $(this).attr('data-id');
            var current_idx = all_candidate_ids.indexOf(parseInt(id));
            var total_candids = all_candidate_ids.length;

            var next_id = current_idx + 1;
            if (next_id == total_candids) {
              next_id = current_idx;
            }

            var next_candid = all_candidate_ids[next_id];

            if($(document).find('.listgrid_cnt.active').find('.exampleModalToggle' + next_candid).length == 0) {
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
                        // console.log((next_id+1), total_candids, ((next_id+1) < total_candids));
                        if ((next_id+1) < total_candids) {
                            $(document).find('.exampleModalToggle' + next_candid).find('.right-arrow').show();
                        } else {
                            $(document).find('.exampleModalToggle' + next_candid).find('.right-arrow').hide();
                        }
                        $(document).find('.exampleModalToggle' + next_candid).modal('show');
                    }
                });
            } else {
                // console.log('next_candid - ' + 2);
                var modal_parent = $(document).find('.exampleModalToggle' + next_candid).parent().parent();
                if($(document).find('.exampleModalToggle' + next_candid).length > 1 && $(modal_parent).hasClass('candidate-card')) {
                    $('.condidate-profile-modal').modal('hide');
                    $(document).find('.modal-backdrop').remove();
                    if($(document).find('.modal-backdrop').length == 0) {
                        $('body').append('<div class="modal-backdrop fade show"></div>');
                    }
                    if ((next_id+1) < total_candids) {
                      $(document).find('.exampleModalToggle' + next_candid).find('.right-arrow').show();
                    } else {
                        $(document).find('.exampleModalToggle' + next_candid).find('.right-arrow').hide();
                    }
                    $('.listgrid_cnt.active').find('.exampleModalToggle' + next_candid).modal('show');
                } else {
                    $('.condidate-profile-modal').modal('hide');
                    $(document).find('.modal-backdrop').remove();
                    if($(document).find('.modal-backdrop').length == 0) {
                        $('body').append('<div class="modal-backdrop fade show"></div>');
                    }

                    if ((next_id+1) < total_candids) {
                      $(document).find('.exampleModalToggle' + next_candid).find('.right-arrow').show();
                    } else {
                        $(document).find('.exampleModalToggle' + next_candid).find('.right-arrow').hide();
                    }
                    $(document).find('.exampleModalToggle' + next_candid).modal('show');
                }
            }
        });

        $("body").delegate(".left-arrow", "click", function(e) {
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
        });
        // task - 86a3150au end
    });
    var activeTab = "_";
    $("body").delegate(".list_grid_wrapper li", "click", function(e) {
        /*var _target = $(this).find('button').attr('data-target');
        var _EL = _target.split("-");*/

        var type = $(this).attr('data-type');
        activeTab = $(this).attr('class');
        activeTab = activeTab.split(" ");
        activeTab = activeTab[0];
    });

    // task - 86a2qrtan
    document.addEventListener("livewire:load", (e) => {
        $(window).scroll(function() {
            var scrollCount=0;
            if (((window.innerHeight + Math.round(window.scrollY))+100 >= document.body.offsetHeight) && ($('.listgrid_cnt.active > .load_more').length) && load_more_complete == 0) {
                    load_more_complete = 1;
                    $('.load_more').html('<span class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true" style="margin-right:10px;"></span><span class="loadSpan">Loading...</span></a>')
                // Trigger a Livewire function
                scrollCount++;

                if(scrollCount==1){
                    $('.' + activeTab).trigger('click');
                    // $('.inline-table-modal').modal('hide');
                    Livewire.emit('loadMore');
                }

                scrollCount=0;
                Livewire.hook('message.processed', (message, component) => {
                    {{-- 86a2yxuh3 --}}
                    $('.listview_candidate_details').removeClass('activeCard');
                    $('.listview_candidate_details[data-id="' + activeCardId + '"]').addClass('activeCard');
                    $('.' + activeTab).trigger('click');
                    scrollCount=0;

                    setTimeout(function() {
                        $('.listgrid_cnt.active').find('.candidate-card[data-id='+open_req_modal+']').find('.req_mask_btn').click();
                    }, 1000);
                });
            }
        });
    });
    // task - 86a2qrtan end

    // loom video updates : 19/03/24
    {{-- 86a37wg0r --}}
    var timegap=3000;
    var removedCard=[];
    function saveFavorite(id, search_id) {
        $('.favorite_' + id).toggleClass('hover_fav');

        /* as per chaya's requirement for video updates
        if ($('.condidate-profile-modal.show').length > 0 || $('.toggle_label a.active').length ==0) {
         timegap = 50;
        }else{
        timegap = 3000;
                $('.favorite_' + id).parents('.listview_candidate_details').css('background', '#e5dcf287');
        }*/

        // setTimeout(function () {
            if ($('.favorite_' + id).hasClass('hover_fav')) {
                $.ajax({
                    url: '{{ url('company/savefavorite') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: { 'user_id': id, 'search_id': search_id, '_token': '{{ csrf_token() }}' },
                    success: function (res) {
                        if (res) {
                            // setTimeout(function () {
                                $('.favorite_' + id).attr('onclick', 'removeFavorite(' + id + ',' + search_id + ')');
                                $('#favorite_cnt').text(res.favorite_cnt);

                                var old_unmarked = {{ ($candidates_count > 0 ? $candidates_count : 0) }};
                                $('#unmarked_cnt').text(old_unmarked - res.marked_ids);

                                let category = @this.get('category');
                                var cat_arr = Object.keys(category).map(function (key) { return category[key]; });

                                if ($.inArray('unmarked', cat_arr) !== -1) {
                                    /*if (timegap > 100) {
                                        $('.candidate-card[data-id="' + id + '"]').remove();*/
                                        $('.candidate-card[data-id="' + id + '"]').hide('slow', function(){ $('.candidate-card[data-id="' + id + '"]').remove();
                                            if($('.modal-backdrop').length) {
                                                $('.modal-backdrop').remove();
                                                $('body').removeClass('modal-open position-fixed');
                                            }
                                        });
                                    /*} else {
                                        removedCard.push($('.candidate-card[data-id="' + id + '"]'));
                                    }*/
                                }

                            // }, timegap);
                        }
                        // Livewire.emit('updateFavorites');
                    }
                });
            } else {
                $('.favorite_' + id).parents('.listview_candidate_details').css('background', 'unset');
            }
        // }, timegap);
    }

    function removeFavorite(id, search_id) {
        $('.favorite_' + id).toggleClass('hover_fav');
        /*if ($('.condidate-profile-modal.show').length > 0 || $('.toggle_label a.active').length ==0) {
        timegap = 50;
        }else{
        timegap = 3000;
                $('.favorite_' + id).parents('.listview_candidate_details').css('background', '#e5dcf287');
            }*/

        // setTimeout(function () {
            if (!$('.favorite_' + id).hasClass('hover_fav')) {
                $.ajax({
                    url: '{{ url('company/removefavorite') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: { 'user_id': id, 'search_id': search_id, '_token': '{{ csrf_token() }}' },
                    success: function (res) {
                        if (res) {
                            $('.favorite_' + id).attr('onclick', 'saveFavorite(' + id + ',' + search_id + ')');
                            $('#favorite_cnt').text(res.favorite_cnt);

                            var old_unmarked = {{ ($candidates_count > 0 ? $candidates_count : 0) }};
                            $('#unmarked_cnt').text(old_unmarked - res.marked_ids);

                            let category = @this.get('category');
                            var cat_arr = Object.keys(category).map(function (key) { return category[key]; });

                            if ($.inArray('favorites', cat_arr) !== -1) {
                                /*if (timegap > 100) {
                                    $('.candidate-card[data-id="' + id + '"]').remove();*/
                                    $('.candidate-card[data-id="' + id + '"]').hide('slow', function(){ $('.candidate-card[data-id="' + id + '"]').remove();
                                        if($('.modal-backdrop').length) {
                                            $('.modal-backdrop').remove();
                                            $('body').removeClass('modal-open position-fixed');
                                        }
                                    });
                                /*} else {
                                    removedCard.push($('.candidate-card[data-id="' + id + '"]'));
                                }*/
                            }
                        }
                        // Livewire.emit('updateFavorites');
                    }
                });
            } else {
                $('.favorite_' + id).parents('.listview_candidate_details').css('background', 'unset');
            }
        // }, timegap);
    }
        // loom video updates : 19/03/24 end

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
            'user_id': id
        };

        if (search) {
            _data_.search_id = search;
        }

        $('.relevant_' + id).toggleClass('hover_relevant');
        $('.nrelevant_' + id).removeClass('hover_nrelevant');
        /*if ($('.condidate-profile-modal.show').length > 0 || $('.toggle_label a.active').length ==0) {
        timegap = 50;
        }else{
        timegap = 3000;
                $('.relevant_' + id).parents('.listview_candidate_details').css('background', '#e5dcf287');
            }*/

        // setTimeout(function () {
            if ($('.relevant_' + id).hasClass('hover_relevant')) {
                $.ajax({
                    url: '{{ url('company/saverelevant') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: _data_,
                    success: function (res) {
                        if (search) {
                            $('.relevant_' + id).attr('onclick', 'removeRelevant(' + id + ', ' + search + ')');
                        } else {
                            $('.relevant_' + id).attr('onclick', 'removeRelevant(' + id + ')');
                        }
                        $('#relevant_cnt').text(res.relevant_cnt);
                        $('#nrelevant_cnt').text(res.nrelevant_cnt);

                        var old_unmarked = {{ ($candidates_count > 0 ? $candidates_count : 0) }};
                        $('#unmarked_cnt').text(old_unmarked - res.marked_ids);

                        let category = @this.get('category');
                        var cat_arr = Object.keys(category).map(function (key) { return category[key]; });

                        if ($.inArray('unmarked', cat_arr) !== -1) {
                            /*if (timegap > 100) {
                                $('.candidate-card[data-id="' + id + '"]').remove();*/
                                $('.candidate-card[data-id="' + id + '"]').hide('slow', function(){ $('.candidate-card[data-id="' + id + '"]').remove();
                                    if($('.modal-backdrop').length) {
                                        $('.modal-backdrop').remove();
                                        $('body').removeClass('modal-open position-fixed');
                                    }
                                });
                            /*} else {
                                removedCard.push($('.candidate-card[data-id="' + id + '"]'));
                            }*/
                        }

                    }
                });
            }else{
                $('.listview_candidate_details').css('background', 'unset');
            }
        // }, timegap);
    }

    function removeRelevant(id, search = null) {
        var _data_ = {
            '_token': '{{ csrf_token() }}',
            'user_id': id
        };

        if (search) {
            _data_.search_id = search;
        }

        $('.relevant_' + id).toggleClass('hover_relevant');
        /*if ($('.condidate-profile-modal.show').length > 0 || $('.toggle_label a.active').length ==0) {
        timegap = 50;
        }else{
        timegap = 3000;
                $('.relevant_' + id).parents('.listview_candidate_details').css('background', '#e5dcf287');
        }*/

        // setTimeout(function () {
            if (!$('.relevant_' + id).hasClass('hover_relevant')) {
                $.ajax({
                    url: '{{ url('company/removerelevant') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: _data_,
                    success: function (res) {
                        if (search) {
                            $('.relevant_' + id).attr('onclick', 'saveRelevant(' + id + ', ' + search + ')');
                        } else {
                            $('.relevant_' + id).attr('onclick', 'saveRelevant(' + id + ')');
                        }
                        $('#relevant_cnt').text(res.relevant_cnt);
                        $('#nrelevant_cnt').text(res.nrelevant_cnt);

                        var old_unmarked = {{ ($candidates_count > 0 ? $candidates_count : 0) }};
                        $('#unmarked_cnt').text(old_unmarked - res.marked_ids);

                        let category = @this.get('category');
                        var cat_arr = Object.keys(category).map(function (key) { return category[key]; });

                        if ($.inArray('relevant', cat_arr) !== -1) {
                            /*if (timegap > 100) {
                                $('.candidate-card[data-id="' + id + '"]').remove();*/
                                $('.candidate-card[data-id="' + id + '"]').hide('slow', function(){ $('.candidate-card[data-id="' + id + '"]').remove();
                                    if($('.modal-backdrop').length) {
                                        $('.modal-backdrop').remove();
                                        $('body').removeClass('modal-open position-fixed');
                                    }
                                });
                            /*} else {
                                removedCard.push($('.candidate-card[data-id="' + id + '"]'));
                            }*/
                        }
                    }
                });
            } else {
                $('.listview_candidate_details').css('background', 'unset');
            }
        // }, timegap);
    }

    function saveNonRelevant(id, search = null) {
        var _data_ = {
            '_token': '{{ csrf_token() }}',
            'user_id': id
        };

        if (search) {
            _data_.search_id = search;
        }

        $('.nrelevant_' + id).toggleClass('hover_nrelevant');
        $('.relevant_' + id).removeClass('hover_relevant');
        /*if ($('.condidate-profile-modal.show').length > 0 || $('.toggle_label a.active').length ==0) {
        timegap = 50;
        }else{
            timegap = 3000;
            $('.nrelevant_' + id).parents('.listview_candidate_details').css('background', '#e5dcf287');
        }*/

        // setTimeout(function () {
            if ($('.nrelevant_' + id).hasClass('hover_nrelevant')) {
                $.ajax({
                    url: '{{ url('company/savenonerelevant') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: _data_,
                    success: function (res) {
                        if (search) {
                            $('.nrelevant_' + id).attr('onclick', 'removeNonRelevant(' + id + ', ' + search + ')');
                        } else {
                            $('.nrelevant_' + id).attr('onclick', 'removeNonRelevant(' + id + ')');
                        }
                        $('#relevant_cnt').text(res.relevant_cnt);
                        $('#nrelevant_cnt').text(res.nrelevant_cnt);

                        var old_unmarked = {{ ($candidates_count > 0 ? $candidates_count : 0) }};
                        $('#unmarked_cnt').text(old_unmarked - res.marked_ids);

                        let category = @this.get('category');
                        var cat_arr = Object.keys(category).map(function (key) { return category[key]; });

                        if ($.inArray('unmarked', cat_arr) !== -1) {
                            /*if (timegap > 100) {
                                $('.candidate-card[data-id="' + id + '"]').remove();*/
                                $('.candidate-card[data-id="' + id + '"]').hide('slow', function(){ $('.candidate-card[data-id="' + id + '"]').remove();
                                    if($('.modal-backdrop').length) {
                                        $('.modal-backdrop').remove();
                                        $('body').removeClass('modal-open position-fixed');
                                    }
                                });
                            /*} else {
                                removedCard.push($('.candidate-card[data-id="' + id + '"]'));
                            }*/
                        }
                    }
                });
            }else
            {
                $('.listview_candidate_details').css('background', 'unset');
            }
        // }, timegap);
    }

    function removeNonRelevant(id, search = null) {
        var _data_ = {
            '_token': '{{ csrf_token() }}',
            'user_id': id
        };

        if (search) {
            _data_.search_id = search;
        }

        $('.nrelevant_' + id).toggleClass('hover_nrelevant');
        /*if ($('.condidate-profile-modal.show').length > 0 || $('.toggle_label a.active').length ==0) {
        timegap = 50;
        }else{
            timegap = 3000;
            $('.nrelevant_' + id).parents('.listview_candidate_details').css('background', '#e5dcf287');
        }*/

        // setTimeout(function () {
            if (!$('.nrelevant_' + id).hasClass('hover_nrelevant')) {
                $.ajax({
                    url: '{{ url('company/removenonrelevant') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: _data_,
                    success: function (res) {
                        if (search) {
                            $('.nrelevant_' + id).attr('onclick', 'saveNonRelevant(' + id + ', ' + search + ')');
                        } else {
                            $('.nrelevant_' + id).attr('onclick', 'saveNonRelevant(' + id + ')');
                        }
                        $('#relevant_cnt').text(res.relevant_cnt);
                        $('#nrelevant_cnt').text(res.nrelevant_cnt);

                        var old_unmarked = {{ ($candidates_count > 0 ? $candidates_count : 0) }};
                        $('#unmarked_cnt').text(old_unmarked - res.marked_ids);

                        let category = @this.get('category');
                        var cat_arr = Object.keys(category).map(function (key) { return category[key]; });

                        if ($.inArray('nonrelevant', cat_arr) !== -1) {
                            /*if (timegap > 100) {
                                $('.candidate-card[data-id="' + id + '"]').remove();*/
                                $('.candidate-card[data-id="' + id + '"]').hide('slow', function(){ $('.candidate-card[data-id="' + id + '"]').remove();
                                    if($('.modal-backdrop').length) {
                                        $('.modal-backdrop').remove();
                                        $('body').removeClass('modal-open position-fixed');
                                    }
                                });
                            /*} else {
                                removedCard.push($('.candidate-card[data-id="' + id + '"]'));
                            }*/
                        }

                        // Livewire.emit('updateFavorites');
                    }
                });
            } else {
                $('.listview_candidate_details').css('background', 'unset');
            }
        // }, timegap);
    }
    $('.condidate-profile-modal').on('hidden.bs.modal', function (e) {
        if(!arrow_click) {
            Livewire.emit('updateFavorites');
            setTimeout(function(){
                // afterLoad();
                $('.modal-backdrop').remove();
            }, 3000);
        }

        $.each(removedCard, function(index, value) {
            value.remove();
            // Do something with each ID
        });
    });
   {{-- 86a37wg0r --}}

    // task - 86a309hbq end

    $('#edit-search').on('shown.bs.modal', function(e) {
        afterLoad($(this));
    })

    window.addEventListener('show-edit-modal', event => {
        // $('#edit-search').modal('show');
        afterLoad($(this));
    })

    $('#edit-search').on('hide.bs.modal', function(e) {
        @this.set('archive_search_message', null);
    });


    document.addEventListener("livewire:load", () => {
        $("body").delegate(".flag_ico_sec,.manual_add_saved_serach", "click", function(e) {
            Livewire.hook('message.processed', (message, component) => {
                console.log('hook 1');
                afterLoad($(this));

            })
        })
    })


    function afterLoad() {
        // console.log('activeTabactiveTab',activeTab);
        var html = " <script src='{{asset('assets/be/js/select2.full.js')}}'><\/script><script src='{{asset('assets/be/js/filters.js')}}'><\/script>";
        $('.filter-out').html(html);
        $('.' + activeTab).trigger('click');
        // let flag = @this.get('is_filtered');
        let flag = @this.get('is_submit');

        $('.filter-col-box').parent('div').css('opacity', '0.7');
        setTimeout(function() {
            var html2 = '<script src="{{asset('assets/be/taginput/bootstrap-tagsinput.min.js')}}"><\/script><link rel="stylesheet" href="{{asset('assets/be/taginput/bootstrap-tagsinput.css')}}"/>' +
            '<div class="col- filter-col-box form-group position-input ">' +
                '<input class="current_position_filter_btn2 form-control js-select2" data-role="tagsinput" value="'+$('.current_position_filter_btn2').val()+'" placeholder="Search by Current Title"/>' +
            '</div>';

            $('.tag-input-field').html(html2);

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
                // console.log('select2');
                if( $(this).val()[0]=='null'){
                    $(this).val('').trigger('change', true);
                    // $(this).html('');
                } else {
                    $(this).val($(this).val()).trigger('change', true);
                }
                $('.' + activeTab).trigger('click');
            })
            $('.max-range').val($('.max-range').val()).trigger('input');
            $('.min-range').val($('.min-range').val()).trigger('input');

            $('.min-range-distance').val($('.min-range-distance').val()).trigger('input');
            $('.max-range-distance').val($('.max-range-distance').val()).trigger('input');

            $('.' + activeTab).trigger('click');

            hideClearFilterBtn(false); // Task 86a0jvgw4
            $('.filter-col-box').parent('div').css('opacity', '1');

            // task - 86a1uf3ar
            setTimeout(function() {
                let loaded_filters = 0; let total_filters = $('.filter-row .filter-col-box:not(.filter-btn,.range-input)').length;
                animInterval = setInterval(function() {
                    $('.filter-row .filter-col-box:not(.filter-btn,.range-input)').each(function(index, el) {
                        let _FEL = $(el).find('.js-select2');
                        if(_FEL.length) {
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
                        }

                        if(loaded_filters >= total_filters) {
                            $('.filter-row .filter-col-box:not(.filter-btn)').removeClass('animated-background');
                            clearInterval(animInterval);
                        }
                    });
                }, 100);
            }, 500);
        }, 80);
    }
    document.addEventListener("livewire:load", () => {
        saveSearch();

    })

    $(document).on('hide.bs.modal', '#edit-search', function(event) {
        $(this).find('form')[0].reset();
        $(this).find('#search_name_error').html(''); // task - 86a0wte46
    });

    function saveSearch() {

        $("body").delegate(".update-search", "click", function(e) {
            $(this).parents('.modal-content').find('#search_name_error').html(''); // task - 86a0wte46
            var search_name = $('.edit-search-name').val();
            if(search_name==""){
                $(this).parents('.modal-content').find('#search_name_error').html('The search name field is required.'); // task - 86a0wte46
                return false;
            }
            $(this).text('Updating...');

            var search_id = $('.search_id').val();
            var industries_filter_btn = $('.industries_filter_btn').val();
            var interest_filter_btn = $('.interest_filter_btn').val();
            var hard_skills_filter_btn = $('.hard_skills_filter_btn').val();
            var soft_skills_filter_btn = $('.soft_skills_filter_btn').val();
            var languages_filter_btn = $('.languages_filter_btn').val();
            var distance_filter_btn = $('.distance_filter_btn').val();
            var current_position_filter_btn = $('.current_position_filter_btn2').val(); // task - 86a21hge8
            // var current_position_filter_btn = $('.current_position_filter_btn').val();
            var seeking_position_filter_btn = $('.seeking_position_filter_btn').val();
            var schedule_filter_btn = $('.schedule_filter_btn').val();
            var zipcode_filter_btn = $('.zipcode_filter_btn').val();
            var salary_range_filter_btn = $('.salary_range_filter_btn').val();
            var work_environment_filter_btn = $('.work_environment_filter_btn').val();
            var min_range = $('.min-range').val();
            var max_range = $('.max-range ').val();
            var min_distance = $('.min-range-distance').val();
            var max_distance = $('.max-range-distance').val();
            var compensation_filter_btn = $('.compensation_filter_btn ').val();
            var filterDistance = $('#filterDistance').val(); // task - 86a2qrx00
            var filterYearOfExperience = $('#filterYearOfExperience').val(); // task - 86a2qrx00

            @this.set('selectedIndustries', industries_filter_btn)
            @this.set('selectedInterests', interest_filter_btn);
            @this.set('selectedInterests', interest_filter_btn);
            @this.set('selectedHardSkills', hard_skills_filter_btn);
            @this.set('selectedSoftSkills', soft_skills_filter_btn);
            @this.set('selectedLanguages', languages_filter_btn);
            @this.set('selectDistance', distance_filter_btn);
            @this.set('selectSeekingPosition', seeking_position_filter_btn);
            @this.set('selectCurrentPosition', current_position_filter_btn);
            @this.set('selectSchedule', schedule_filter_btn);
            @this.set('selectZipCode', zipcode_filter_btn);
            @this.set('selectSalaryRange', salary_range_filter_btn);
            @this.set('selectWorkEnvironment', work_environment_filter_btn);
            @this.set('selectMinYearOfExperience', min_range);
            @this.set('selectMaxYearOfExperience', max_range);
            @this.set('selectMaxYearOfExperience', max_range);
            @this.set('selectMinDistance', min_distance);
            @this.set('selectMaxDistance', max_distance);
            @this.set('selectCompensation', compensation_filter_btn);
            @this.set('search_name', search_name);
            @this.set('search_id', search_id);
            @this.set('is_filtered', true);
            @this.set('is_submit', true);
            @this.set('is_save', true);
            @this.set('is_run', false);
            @this.set('filterYearOfExperience', filterYearOfExperience); // task - 86a2qrx00
            @this.set('filterDistance', filterDistance); // task - 86a2qrx00



            Livewire.hook('message.processed', (message, component) => {
                console.log('hook 2');
                {{-- afterLoad($(this)); --}}
            })
            // return false;
            // e.preventDefault();
        });
    };

    window.addEventListener('close-notes', event => {
        $('#notesModal').modal('hide');
        $('#exampleModalToggle2').modal('show');
    });
    window.addEventListener('closeModal', event => {
        $('.modal').modal('hide');

    });

    function profile_modal(id) {
        Livewire.emit('viewProfile', id);
    }

    window.addEventListener('open-profile-modal', event => {
        $('#exampleModalToggle2').modal('show');
    })

    document.addEventListener("livewire:load", () => {
        $(document).on('click', '#change_order', function(event) {
            $('.clear-filter-btn').addClass('hide-clr-btn'); // Task 86a0jvgw4
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
            $('#overlay').show();
            // @this.set('count', 6);
            @this.set('page', 1); // task - 86a37wfvx
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
                // console.log('change_order');
                hideClearFilterBtn(false); // Task 86a0jvgw4
                // afterLoad($(this));
            })
        });

        $("body").delegate(".sort-tab", "click", function(e) {
            $('.clear-filter-btn').addClass('hide-clr-btn'); // Task 86a0jvgw4
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
            $('#overlay').show();
            var type = $(this).attr('data-type');
            @this.set('sortBy', type);
            @this.set('count', 6);
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

    window.addEventListener('close-request-modal', event => {
        $('#send-request-modal .request_message').html('REQUEST SUBMITTED');
        setTimeout(function() {
            $('#send-request-modal .request_message').html('');
            $('#send-request-modal form')[0].reset();
            $(".modal").modal("hide");
            $('#send-request-modal').modal('hide');
            $('#send-request-modal').removeClass('show');
            $('#send-request-modal').hide();
        }, 1500);
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

    window.addEventListener('loadAfterload', event => {
        // console.log('loadAfterload');
        afterLoad($(this));
    });

$(document).ready(function(){
        $('.js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)').each(function() {
            $(this).val($(this).val()).trigger('change', true);
        })

        $('.max-range').val($('.max-range').val()).trigger('input', true);
        $('.min-range').val($('.min-range').val()).trigger('input', true);

        $('.max-range-distance').val($('.max-range-distance').val()).trigger('input', true);
        $('.min-range-distance').val($('.min-range-distance').val()).trigger('input', true);
})
$(document).ready(function() {
    $(document).on("click", function(e) {
        if (!$('.inline-table-modal').is(e.target) && $('.inline-table-modal').has(e.target).length === 0) {
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

</script>

@endpush
