@foreach ($ncandidates as $candidate)

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
    <div class="listview_candidate_details_w detail_{{$hired_employee}}">
        @if(!empty($candidate->delete_status))
        @if($candidate->delete_status->type=='sleep')
        <span class="hired">Hired</span><span class="hired-flag"></span>
        @php $hired_employee="blured_box";@endphp
        @endif
        @endif



        <div class="listview_candidate_details  {{$hired_employee}}" data-url="{{ route('company.candidateprofile', ['user_id' => $candidate->id]) }} " data-id="{{$candidate->id}}">
            <div class="layout_back" style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;" >
            </div>
            <div >
                <div class="listview_candidate_details_img">
                    @if($candidate->companyStatus->first())

                    @if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2)
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
                </div>
            </div>
            <div >
                <div class="listview_candidate_details_head">


                    @if($candidate->companyStatus->first())
                    <!-- {{ $candidate->companyStatus}} -->
                    @if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2)

                     @if(!empty($candidate->name))
                    @php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); @endphp
                    <h6 class="blured_txt">{{substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)}}</h6>
                    @else
                    <h6 class="blured_txt">Candidate Name</h6>
                    @endif
                    @else
                    <h6>{{ $candidate->name }} </h6>
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
                </div>
            </div>

            <div >
                <div class="ecperice_list">
                    <div class="candidate_grid_ppl_top_btm_wrap">
                        <!-- <i class="icon_candt"><img src="{{ asset('assets/be/images/ic1.svg') }}" alt="" /></i>
                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                            <p>{{$yrs_of_exp}} Yrs Experience</p>
                        </div> -->
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
                            <!-- <p>{{$candidate->personal ? $candidate->personal->address : ''}}, {{$candidate->personal ? $candidate->personal->state_abbr : ''}}</p>
                         -->
                         @if (isset($candidate->industries))
                                                    <p>{{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                                    </p>
                                                    @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="gr_fl" >
                <div class="ask_salary_sec">
                    <i class="ic_icon">$</i>
                    <div class="ask_salary_sec_rtt">
                        <h6>Asking Salary</h6>
                        <p>{{ $candidate->personal ? $candidate->personal->salary_range : '' }}</p>
                    </div>
                </div>
            </div>

            <div class="gr_fl2">
                @if(count($saved_searches)>0)
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
            </div>

            <div class="gr_fl3">
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
                <!-- <a href="javascript:void(0)" class="req_mask_btn" wire:click.prevent="sendRequest({{ $candidate->id }})"> -->
                <a href="javascript:void(0)" class="req_mask_btn">
                    <i class="ic_req_m"><img src="{{ asset('assets/be/images/masked.svg') }}" alt="" /></i>
                    <div class="req_mask_btn_rtt">Request Unmask</div>
                </a>
                <div class="modal fade inline-table-modal" id="send-request-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog" role="document">
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
                                            <textarea {{-- task - 86a2rvv8z placeholder="I reviewed your resume..." --}} wire:model.lazy="message"></textarea>
                                        </div>
                                        <div class="position-submit-btn-otr" wire:loading.remove wire:target="sendRequest">
                                            <input type="submit" value="Send to Candidate" class="position_submit_btn" />
                                        </div>
                                        <div class="position-submit-btn-otr" wire:loading wire:target="sendRequest">
                                            <input type="submit" value="Sending..." disabled class="position_submit_btn" />
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endif


                @if (time() - strtotime($candidate->created_at) < 60*60*24)
                    <span class="text-danger"><b>NEW!</b></span>
                @endif
            </div>

            <a href="javascript:void(0)" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" class="eye-ball2 eyeBall"  data-id="{{ $candidate->id }}">
                {{-- {{expGraphic($yrs_of_exp);}} --}}
                @php
                    $exp = $yrs_of_exp;
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

    			@endphp
            </a>
        </div>

    </div>
@endforeach
