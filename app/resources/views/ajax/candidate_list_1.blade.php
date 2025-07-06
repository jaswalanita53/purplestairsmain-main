@foreach ($ncandidates as $candidate)
                        {{-- {{ dd($candidate) }} --}}
                        {{-- yrs of Experience login --}}
                        @php
                            $employments = []; $yrs_of_exp = 0; $exp_months = 0;
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

        <div class="col-xl-4 col-md-6 candiate_list_view_parent_col">
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
                            <span class="pending-label"><span class="hired">Requested</span><span class="hired-flag"><i class="iconc"><img src="{{asset('assets/be/images/clock-white.svg')}}" alt=""></i></span></span>
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



                            <div class="candidate_grid_ppl_wppt {{$hired_employee}}" data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} " data-id="{{$candidate->id}}">
                                <div class="candidate_grid_ppl">
                                    <div class="candidate_top_pnk_ic">
                                        <img src="{{ asset('assets/be/images/shape_left_pnk.png') }}" alt="" />
                                    </div>

                                    @if(count($saved_searches)>0)
                                    <div class="candidate_grid_ppl_icn">
                                        <a href="#url" class="clickd_tgl_searches">
                                            <svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="ellipsis-icon">
                                                <circle cx="17.5" cy="12" r="1.5" />
                                                <circle cx="12" cy="12" r="1.5" />
                                                <circle cx="6.5" cy="12" r="1.5" />
                                            </svg>
                                        </a>
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
                                                    @foreach($saved_searches as $key => $search)
                                                    @php $is_checked = in_array($candidate->id, $search->candidate_ids) ? 1 : 0; @endphp
                                                    <label>
                                                        <input type="checkbox" class="manual_add_saved_serach" data-search-id="{{ $search->id }}" data-candidate="{{ $candidate->id }}" wire:click="changeEvent('{{ $is_checked }}', '{{ $search->id }}','{{ $candidate->id }}')" {{ $is_checked ? 'checked' : '' }} />
                                                        <span>{{ $search->name }}</span>
                                                    </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="candidate_grid_ppl_top row">
                                        <div class="col-8 d-flex">
                                        <figure class="main_img">
                                            @if($candidate->companyStatus->first())
                                            @if($candidate->companyStatus->first()->pivot->status == 0)
                                            <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail" />
                                            @else
                                            @if($candidate->profile_photo_path)
                                            <img src="{{ asset($candidate->profile_photo_path) }}" alt="" class="" />
                                            @else
                                            <img src="{{asset('assets/fe/images/default_user.png')}}" alt="" class="" />
                                            @endif
                                            @endif
                                            @else
                                            <img src="{{ asset('/assets/be/images/masked_ic.png') }}" alt="" class="unmasked-p img-thumbnail" />
                                            @endif
                                        </figure>
                                        <div class="candidate_grid_ppl_top_rt pt-3">
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
                                                @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                                                <h6 class="blured_txt">{{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}}</h6>
                                                @else
                                                <h6 class="blured_txt">Candidate Name</h6>
                                                @endif
                                            @endif
                                            <p>@if(!empty($candidate->personal->current_title)){{ strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title }} @endif

                                            </p>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-4 align-self-center- pt-3 lign-height-point-e"> <span class="grid-exp grid-exp-{{$hired_employee}}"> @php
                                        expGraphic($yrs_of_exp);
                                        @endphp
                                    </span></div>
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
                                                    <!-- <i class="icon_candt"><img src="{{ asset('assets/be/images/ic1.svg') }}" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <p>{{$yrs_of_exp}} Yrs Experience</p>
                                                    </div> -->
                                                </div>
                                            </li>

                                            <li>
                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                    <i class="icon_candt"><img src="{{ asset('assets/be/images/ic1.svg') }}" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <!-- <p>{{$candidate->personal ? $candidate->personal->address : ''}},&nbsp;{{$candidate->personal ? $candidate->personal->state_abbr : ''}}</p> -->
                                                        @if (isset($candidate->industries))
                                                        <p>{{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                    <i class="icon_candt"><img src="{{ asset('assets/be/images/ic3.svg') }}" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <h6>Asking Salary</h6>
                                                        <p>{{ $candidate->personal ? $candidate->personal->salary_range : '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                    <i class="icon_candt"><img src="{{ asset('assets/be/images/ic4.svg') }}" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
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
                        </div>
                        @endforeach
