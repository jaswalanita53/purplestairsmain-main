<div>
  @if(!$published)
    <div class="preview-sec prev2-sec prev-sec-new cmn-gap back-clr ban-up">
      <div class="preview-wrap">
        <div class="container">
          @if(!Route::is('companystep3') && !Route::is('company.viewprofile'))
          <div class="form-points mb-3 form-points2">
              @php
              $step = 5;
              $current_step = auth()->user()->current_step;
              @endphp
              @include('inc.employersteps',compact('step', 'current_step'))
          </div>
          <div class="preview-upper">
            <div class="preview-uppr-rgt">
              {{-- <a href="{{route('companystep4')}}" class="blue_btn blue_btn_plan"
                >Choose Plan To Continue<span><img src="{{asset('assets/fe/images/lap-blue.svg')}}" alt="" /></span>
              </a> --}}
              {{-- <form wire:submit.prevent="approveProfile()">
                  <button class="blue_btn blue_btn_plan" wire:loading.remove wire:target="approveProfile">Approve Profile<span><img src="{{asset('assets/fe/images/profile.svg')}}" alt="" /></span></button>
                  <input type="button" value="Processing..." class="blue_btn blue_btn_plan" wire:loading wire:target="approveProfile"/>
              </form> --}}
            </div>
          </div>
          @endif
           <div class="whole-btn-wrap dual-btn">
                    @if(Auth::user()->user_type=='candidate')
                        @if(!empty($company['companyUsersRequest']['user_id']))
                            @if($company['companyUsersRequest']['user_id']==Auth::id() && $company['companyUsersRequest']['status']==0)
                                {{-- <a href="#" class="btn mb-3 float-end me-2" wire:click="unmaskProfile({{ $company->id }},1)">Unmask for THIS Employer</a> --}}
                            @endif
                        @endif
                    @else
                      {{-- candidate role should not edit company profile --}}
                         <a href="{{ url('/company/profile/edit') }}" class="prev-btn h-auto px-0 edit-profile-back-btn">Back</a>
                    @endif
                    </div>
          <div class="prev-ban-wrap">
            <div class="preview-banner">
              <div class="preview-banner-fig">
                <figure>
                  <img src="{{asset('assets/fe/images/ban1.png')}}" alt="" />
                </figure>
              </div>
              <div class="preview-banner-txt"></div>
            </div>
            <div class="preview_banner_btm">
              <div class="preview_banner_img_sec">
                <div class="preview_banner_img_sec_left pev2 ">
                  <figure>
                    @if($company_profile)
                    <img src="{{asset($company_profile)}}" alt="" />
                    @else
                    <img src="{{asset('assets/fe/images/up-photo.png')}}" alt="" />
                    @endif
                  </figure>
                  @if(!empty($company->user_id))
                    @if($company->user_id==Auth::id())
                    <div class="add_btn_otr">
                        <!-- <a href="{{Auth::user()->status ? route('company.editprofile') : route('companystep1')}}" class="add_btn"
                        ><span><img src="{{asset('assets/fe/images/pen.svg')}}" alt="" /></span> Edit My
                        Profile</a
                        > -->
                        <a href="javascript:void(0)" class="add_btn" wire:click="viewProfileApprove()"
                        ><span><img src="{{asset('assets/fe/images/pen.svg')}}" alt="" /></span> Edit My
                        Profile</a>

                    </div>
                    @endif
                  @endif
                </div>
                <div class="preview_banner_img_sec_rgt">
                  <div class="preview_banner_img_sec_rgt_wrapper">
                    <div class="defination-sec">
                      <div class="title row">
                      <div class="col-md-7 ps-0">
                        <h4>
                          {{$company->company_name}}
                          @if($company->social_media_url != '')
                          <a href="{{fix_url_protocol($company->social_media_url)}}"
                            ><img src="{{asset('assets/fe/images/linkdin-ylw.svg')}}" alt=""
                          /></a>
                          @endif
                          @if($company->website_url != '')
                          <a href="{{fix_url_protocol($company->website_url)}}"><img src="{{asset('assets/fe/images/globe-ylw.svg')}}" alt="" /></a>
                          @endif
                        </h4>
                        @if(Auth::user()->user_type=='employer')
                        <p>{{ ucwords(Auth::user()->name) }}</p>
                        @endif
                        </div>
                        <div class="col-md-5">
                        @if(Auth::user()->user_type=='candidate')
                        @if(!empty($company['companyUsersRequest']['user_id']))
                            @if($company['companyUsersRequest']['user_id']==Auth::id() && $company['companyUsersRequest']['status']==0)
                                <a href="#" class="btn float-end me-4" wire:click="unmaskProfile({{ $company->id }},1)" style="padding: 11px 14px;font-size: 15px;margin-top: 24px;">Unmask for This Employer</a>
                            @endif
                        @endif
                    @endif
                        </div>
                      </div>
                      <div class="preview_banner_img_btm">
                        <ul class="preview_banner_img_list pv1">
                          <li>
                            <div class="preview_banner_img_list_inner">
                              <h6>Email</h6>
                              <p>
                                <a href="mailto:{{$company->company_email}}"
                                  >{{$company->company_email}}</a
                                >
                              </p>
                            </div>
                          </li>
                          <li>
                            <div class="preview_banner_img_list_inner">
                              <h6>Phone</h6>
                              <p><a href="tel:{{$company->company_phone}}">{{$company->company_phone}}</a></p>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="preview_banner_img_btm">
                      <ul class="preview_banner_img_list pv2">
                        <li>
                          <div class="preview_banner_img_list_inner">
                            <h6>Address</h6>
                            <p>{{$company->company_address}}</p>
                          </div>
                        </li>
                        @if($company->website_url != '')
                        <li>
                          <div class="preview_banner_img_list_inner">
                            <h6>Website</h6>
                            <p>
                              <a href="{{fix_url_protocol($company->website_url)}}"
                                >{{$company->website_url}}</a
                              >
                            </p>
                          </div>
                        </li>
                        @endif
                        <li>
                          <div class="preview_banner_img_list_inner">
                            <h6>Number Of Employees</h6>
                            <p>{{$company->number_of_employees}}</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pv-btm-blck">
              <div class="preffered_block mt-0">
                <div class="preffered_block_left">
                  <h4>Company Benefits:</h4>
                </div>
                <div class="preffered_block_right">
                  <ul>
                    @if($company->paid_holidays)
                    <li>Paid Holidays</li>
                    @endif
                    @if($company->insurance_benefits)
                    <li>Insurance Benefits</li>
                    @endif
                    @if($company->casual_environment)
                    <li>Casual Environment</li>
                    @endif
                    @if($company->paid_vacation_days)
                    <li>Paid Vacation Days</li>
                    @endif
                    @if($company->professional_environment)
                    <li>Professional Environment</li>
                    @endif
                  </ul>
                </div>
              </div>
              <div class="about_candidate abt-can2">
                <div class="title">
                  <h4>About The Company</h4>
                </div>
                <div class="about_candidate_txt">
                  <p>
                    {!! nl2br($company->company_description) !!}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="login-sec sign-up back-clr pt-4 log-h-sec ban-up ht_center_div">
      <div class="login-sec-wrap">
        <div class="container">
          <div
            class="log-wrap lg-wrp2"
            style="background-image: url(/assets/fe/images/log-back2.png)">
            <div class="login-outr congo">
              <figure>
                <img src="{{asset('assets/fe/images/party.svg')}}" alt="" />
              </figure>
              <h2 class="mb-4">Thank You</h2>
              <form>
                <div class="form-input">
                  <input
                    type="submit"
                    value="Start Browsing Candidates"
                    class="sub-btn sub2"
                  />
                </div>
              </form>
            </div>
            <img src="{{asset('assets/fe/images/log1.png')}}" alt="" class="mobile-v log1 log12">
            <img src="{{asset('assets/fe/images/log2.png')}}" alt="" class="mobile-v log2 log21">
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
