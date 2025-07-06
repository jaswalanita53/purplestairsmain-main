@extends('layouts.backend')

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
 <style>
 .ui-sortable-handle{
    cursor: grabbing;
    border-bottom:1px solid lightgray;
    margin-bottom:10px ;
    }
    .move-icons{
        font-size: 21px;
        color:#367fa9;
    }
 </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li> <a href="{{ route('admin.candidates') }}">Candidates</a> </li>
      <li> <a href="#">Edit Candidate</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          {{ session()->get('success') }}
        </div>
        @endif

        <!-- /.box -->
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Edit Candidate</h3>
            <div style="float: right;"><a class="btn bg-navy btn-flat margin" href="{{ route('admin.candidates') }}">
            Candidates
           </a>
           @if($user->status==1)
            @if(!empty($nextUser->id))
                <a class="btn btn-flat pull-right btn-warning margin" href="{{ url('admin/candidates/edit') }}/{{ $nextUser->id }}"> Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                @endif
            @if(!empty($prevUser->id))
                <a class="btn btn-left  btn-warning margin" href="{{ url('admin/candidates/edit') }}/{{ $prevUser->id }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev </a>
            @endif
            @endif
           </div>

         </div>
         <!-- /.box-header -->
         {!! Form::open(['method' => 'post', 'files' => true, 'id' => 'candidate_frm', 'route' => ['admin.candidates.update', $user->id]])!!}
         <div class="box-body">

          {{-- @if($errors->any())
          <div class="alert alert-danger">
              {{ implode('', $errors->all('<div>:message</div>')) }}
          </div>
          @endif --}}

          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-header">
                <h3 class="box-title">Personal Information</h3>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Name</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="name"  value="{{ old('name', $user->name) }}">
                      <span class="input-group-addon">
                        <input type="checkbox" value="1" name="name_status" {{ $personal ? ($personal->name_status ? 'checked' : '') : ''; }}> Show
                      </span>
                    </div>
                    {{-- {!! Form::text('name', null, array('class'=> 'form-control'))!!} --}}
                    @if ($errors->has('name'))<em class="invalid-feedback">{!!$errors->first('name')!!}</em>@endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email</label>
                    {{-- {!! Form::text('email', null, array('class'=> 'form-control'))!!} --}}
                    <div class="input-group">
                      <input type="text" class="form-control" name="email"  readonly value="{{ old('email', $user->email) }}">
                      <span class="input-group-addon">
                        <input type="checkbox" value="1" name="email_status" {{ $personal ? ($personal->email_status ? 'checked' : '') : ''; }}> Show
                      </span>
                    </div>
                    @if ($errors->has('email'))<em class="invalid-feedback">{!!$errors->first('email')!!}</em>@endif
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Phone </label>
                    {{-- {!! Form::text('phone', null, array('class'=> 'form-control'))!!} --}}
                    <div class="input-group">
                      <input type="text" class="form-control phone_input" name="phone"  value="{{ old('phone', $personal->phone)}}">
                      <span class="input-group-addon">
                        <input type="checkbox" value="1" name="phone_status" {{ $personal ? ($personal->phone_status ? 'checked' : '') : ''; }}> Show
                      </span>
                    </div>
                    @if ($errors->has('phone'))<em class="invalid-feedback">{!!$errors->first('phone')!!}</em>@endif
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Current Title</label>

                    {{-- {!! Form::text('current_title', null, array('class'=> 'form-control'))!!} --}}
                    <div class="input-group">
                      <input type="text" class="form-control" name="current_title" value="{{old('current_title', $personal->current_title); }}">
                      <span class="input-group-addon">
                        <input type="checkbox" value="1" name="current_title_status" {{ $personal ?  ($personal->current_title_status ? 'checked' : '') : ''; }}> Show
                      </span>
                    </div>
                    @if ($errors->has('current_title'))<em class="invalid-feedback">{!!$errors->first('current_title')!!}</em>@endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Zipcode (Center of Work Radius)</label>
                    {{-- {!! Form::text('zipcode', null, array('class'=> 'form-control'))!!} --}}
                    <div class="input-group">
                      <input type="text" class="form-control" name="zipcode" value="{{old('zipcode',  $personal->zip_code ); }}" >
                      <span class="input-group-addon">
                        <input type="checkbox" value="1" name="zip_code_status" {{ $personal ?  ($personal->zip_code_status ? 'checked' : '') : ''; }}> Show
                      </span>
                    </div>
                    @if ($errors->has('zipcode'))
                      <em class="invalid-feedback">{!!$errors->first('zipcode')!!}</em>
                    @endif
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>LinkedIN URL</label>
                    {{-- {!! Form::text('linkedin_url', null, array('class'=> 'form-control'))!!} --}}
                    <div class="input-group">
                      <input type="text" class="form-control" name="linkedin_url" value="{{old('linkedin_url',  $personal->linkedin_url); }}">
                      <span class="input-group-addon">
                        <input type="checkbox" value="1" name="linkedin_url_status" {{ $personal ?  ($personal->linkedin_url_status ? 'checked' : '') : ''; }}> Show
                      </span>
                    </div>
                    @if ($errors->has('linkedin_url'))<em class="invalid-feedback">{!!$errors->first('linkedin_url')!!}</em>@endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Additional URL (or Portfolio Link)</label>
                    {{-- {!! Form::text('additional_url', null, array('class'=> 'form-control'))!!} --}}
                    <div class="input-group">
                      <input type="text" class="form-control" name="additional_url" value="{{old('additional_url', $personal->additional_url); }}" >
                      <span class="input-group-addon">
                        <input type="checkbox" value="1" name="additional_url_status" {{ $personal ?  ($personal->additional_url_status ? 'checked' : '') : ''; }}> Show
                      </span>
                    </div>
                    @if ($errors->has('additional_url'))<em class="invalid-feedback">{!!$errors->first('additional_url')!!}</em>@endif
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-header">
                <h3 class="box-title">Position Preferences</h3>
              </div>



              <div class="row">


                <div class="col-md-6">
                    <label>Additional Industries <span class="text-muted">(select multiple)</span></label>
                    <div class="form-group">
                        <select class="select2 industries form-control" name="industries[]" multiple="multiple" id="selectedIndustries">
                            @foreach ($all_industries as $key => $ind)
                            <option data-badge="" value="{{ $ind }}" {{ in_array($ind, $sel_industries) ? 'selected' : '' }}>{{ $key }}</option>
                            @endforeach
                        </select>
                        @include('inc.error', [
                        'field_name' => 'industries',
                        ])
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Primary Industry</label>
                    <div class="form-group">
                        <select class="select2 js-example-tags form-control" name="primaryIndustry" id="selectedPrimaryIndustry">
                            @foreach ($all_industries as $key => $ind)
                            @if(in_array($ind, $sel_industries))
                            <option value="{{ $ind }}" @if(!empty($sel_prim_industries)) {{ ($ind == $sel_prim_industries[0]) ? 'selected' : '' }} @endif>{{ $key }}</option>
                            @endif
                            @endforeach
                        </select>
                        @include('inc.error', [
                        'field_name' => 'primaryIndustry',
                        ])
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Area of Interest <span class="text-muted">(select multiple)</span></label>
                    <div class="form-group">
                        <select class="select2 interests form-control" name="interests[]" multiple="multiple" id="selectedInterests">
                            @foreach ($all_interests as $key => $interest)
                            <option value="{{ $interest }}" {{ in_array($interest, $sel_interests) ? 'selected' : '' }}>{{ $key }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Salary</label>
                        <div class="form-group">
                            <select class="form-control" name="salary_range" id="salary_range">
                                <option value="">Choose Salary Range</option>
                                @foreach ($all_salaries as $key => $salary)
                                <option value="{{ $key }}" {{ isset($personal->salary_range) && $personal->salary_range == $key ? 'selected' : '' }}>{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
            </div>
<div class="row">
                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="row">
                    <div class="col-md-12 col-xs-12 col-lg-12">
                      <label>Work Settings</label>
                    </div>
                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                        <div class="checkbox">
                          <label>

                            <input type="checkbox" value="1" name="remote" class="work_seting " {{ !empty($personal->work_environment_remote ) ? 'checked' : '';}}> Remote
                          </label>
                          @if(empty($personal->work_environment_remote ))
                            <input type="hidden" name="remote" value="0" class="work_seting_hidden">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="in_office" class="work_seting " {{!empty($personal->work_environment_in_office) ? 'checked' : '';}}> In Office
                          </label>
                          @if(empty($personal->work_environment_in_office ))
                            <input type="hidden" name="in_office" value="0" class="work_seting_hidden">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="hybrid" class="work_seting " {{!empty($personal->work_environment_hybrid) ? 'checked' : '';}}> Hybrid
                          </label>
                          @if(empty($personal->work_environment_hybrid ))
                            <input type="hidden" name="hybrid" value="0" class="work_seting_hidden">
                            @endif
                        </div>
                    </div>
                  </div>
                  <span class="text-red wrk-err"></span>
                </div>

                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="row">
                    <div class="col-md-12 col-xs-12 col-lg-12">
                      <label>Schedule</label>
                    </div>
                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" name="full_time" class="schedule" {{isset($personal->schedule_full_time) && $personal->schedule_full_time == '1' ? 'checked' : ''}}> Full Time
                        </label>
                        @if(empty($personal->schedule_full_time ))
                            <input type="hidden" name="full_time" value="0" class="work_seting_hidden">
                            @endif
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" name="part_time" class="schedule" {{isset($personal->schedule_part_time) && $personal->schedule_part_time == '1' ? 'checked' : ''}}> Part Time
                        </label>
                        @if(empty($personal->schedule_part_time ))
                            <input type="hidden" name="part_time" value="0" class="work_seting_hidden">
                            @endif
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" name="no_preference" class="schedule" {{isset($personal->schedule_no_preference) && $personal->schedule_no_preference == '1' ? 'checked' : ''}}> No Preference
                        </label>
                        @if(empty($personal->schedule_no_preference ))
                            <input type="hidden" name="no_preference" value="0" class="work_seting_hidden">
                            @endif
                      </div>
                    </div>
                  </div>
                  <span class="text-red sch-err"></span>
                </div>

                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="row">
                    <div class="col-md-12 col-xs-12 col-lg-12 ">
                      <label>Compensation</label>
                    </div>
                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label class="">
                          <input type="checkbox" value="1" name="compensation_salary" class="compensation" {{isset($personal->compensation_salary) && $personal->compensation_salary == '1' ? 'checked' : ''}}> Salary
                        </label>
                        @if(empty($personal->compensation_salary ))
                            <input type="hidden" name="compensation_salary" value="0" class="work_seting_hidden">
                            @endif
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label class="">
                          <input type="checkbox" value="1" name="compensation_hourly" class="compensation" {{isset($personal->compensation_hourly) && $personal->compensation_hourly == '1' ? 'checked' : ''}}> Hourly
                        </label>
                        @if(empty($personal->compensation_hourly ))
                            <input type="hidden" name="compensation_hourly" value="0" class="work_seting_hidden">
                            @endif
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label class="">
                          <input type="checkbox" value="1" name="compensation_comission_based" class="compensation" {{isset($personal->compensation_comission_based) &&  $personal->compensation_comission_based == '1' ? 'checked' : ''}}> Comission Based
                        </label>
                        @if(empty($personal->compensation_comission_based ))
                            <input type="hidden" name="compensation_comission_based" value="0" class="work_seting_hidden">
                            @endif
                      </div>
                    </div>
                  </div>
                  <span class="text-red com_err"></span>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 col-xs-12 col-lg-12">
                  <label>Preferred Benefits</label>
                </div>

                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="checkbox">
                    <label class="">
                      <input type="checkbox" value="1" name="prefered_benefits_insurance_benefits" class="minimal prefered_benefits" {{isset($personal->prefered_benefits_insurance_benefits) &&  $personal->prefered_benefits_insurance_benefits == '1' ? 'checked' : ''}}> Insurance Benefits
                    </label>
                    @if(empty($personal->prefered_benefits_insurance_benefits ))
                            <input type="hidden" name="prefered_benefits_insurance_benefits" value="0" class="work_seting_hidden">
                            @endif
                  </div>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4 ">
                  <div class="checkbox">
                    <label class="">
                      <input type="checkbox" value="1" name="prefered_benefits_paid_holidays" class="minimal prefered_benefits" {{isset($personal->prefered_benefits_padi_holidays) && $personal->prefered_benefits_padi_holidays == '1' ? 'checked' : ''}}> Paid Holidays
                    </label>
                     @if(empty($personal->prefered_benefits_paid_holidays ))
                            <input type="hidden" name="prefered_benefits_paid_holidays" value="0" class="work_seting_hidden">
                            @endif
                  </div>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="checkbox">
                    <label class="">
                        <input type="checkbox" value="1" name="prefered_benefits_paid_vacation_days" class="minimal prefered_benefits" {{isset($personal->prefered_benefits_paid_vacation_days) && $personal->prefered_benefits_paid_vacation_days == '1' ? 'checked' : ''}}> Paid Vacation Days
                    </label>
                    @if(empty($personal->prefered_benefits_paid_vacation_days ))
                            <input type="hidden" name="prefered_benefits_paid_vacation_days" value="0" class="work_seting_hidden">
                            @endif
                  </div>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="checkbox">
                    <label class="">
                      <input type="checkbox" value="1" name="prefered_benefits_professional_environment" class="minimal prefered_benefits" {{isset($personal->prefered_benefits_professional_environment) && $personal->prefered_benefits_professional_environment == '1' ? 'checked' : ''}}> Professional Environment
                    </label>
                    @if(empty($personal->prefered_benefits_professional_environment ))
                            <input type="hidden" name="prefered_benefits_professional_environment" value="0" class="work_seting_hidden">
                            @endif
                  </div>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="checkbox">
                    <label class="">
                      <input type="checkbox" value="1" name="prefered_benefits_casual_environment" class="minimal prefered_benefits" {{isset($personal->prefered_benefits_casual_environment) && $personal->prefered_benefits_casual_environment == '1' ? 'checked' : ''}}> Casual Environment
                    </label>
                    @if(empty($personal->prefered_benefits_casual_environment ))
                            <input type="hidden" name="prefered_benefits_casual_environment" value="0" class="work_seting_hidden">
                            @endif
                  </div>
                </div>
              </div>



              <div class="row slider-total-sec-col" style="display: {{ (isset($personal) && $personal->work_environment_remote == '1' && $personal->work_environment_in_office == '0' && $personal->work_environment_hybrid == '0') ? 'none' : 'block' }};">
                <div class="col-md-12 col-xs-12 col-lg-12">
                  <label>Distance (I would travel up to x miles)</label>
                  <input type="number" name="distance" min=0 max=100 value="{{$personal->distance}}" class="slider form-control" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="[0]" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
                </div>
              </div>
            </div>
          </div>

          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-header">
                <h3 class="box-title">Education</h3>
              </div>

              <div id="education_rows">
                @if(count($educations))
                  @foreach($educations as $edu_key => $education)
                    @include('backend.users.snippets.edit_education_tmpl', compact('edu_key', 'education'))
                  @endforeach
                @else
                  @include('backend.users.snippets.education_tmpl')
                @endif
              </div>

              <div class="row">
                <div class="col-md-2 col-xs-6 col-lg-2">
                  <button type="button" id="add_education" class="btn btn-flat btn-primary">Enter Previous Education</button>
                </div>
              </div>
            </div>
          </div>

          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-header">
                <h3 class="box-title">Employment</h3>
              </div>

              <div id="employment_rows">
                @if(count($employments))
                  @foreach($employments as $emp_key => $employment)
                    @include('backend.users.snippets.edit_employment_tmpl', compact('emp_key', 'employment'))
                  @endforeach
                @else
                  @include('backend.users.snippets.employment_tmpl')
                @endif
              </div>

              <div class="row">
                <div class="col-md-2 col-xs-6 col-lg-2">
                  <button type="button" id="add_employment" class="btn btn-flat btn-primary">Enter Previous Position</button>
                </div>
              </div>
            </div>
          </div>

          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-header">
                <h3 class="box-title">Skills</h3>
              </div>

              <div class="row">
                <div class="col-md-6 col-xs-12 col-lg-6">
                  <label>Hard Skills <span class="text-muted">Select 1-5 Hard Skills</span></label>
                  <select class="form-control select2 hard_skill" multiple="multiple" id="hard_skill" name="hard_skill[]">
                      @foreach ($all_hard_skills as $key => $hard)
                      <option value={{ $hard }} {{ in_array($hard, $sel_hardskill) ? 'selected' : ''}}>{{ $key }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="col-md-6 col-xs-12 col-lg-6">
                  <label>Soft Skills <span class="text-muted">Select 1-10 Soft Skills</span></label>
                  <select class="form-control select2 soft_skill" multiple="multiple" id="soft_skill" name="soft_skill[]">
                      @foreach ($all_soft_skills as $key => $soft)
                      <option value={{ $soft }} {{ in_array($soft, $sel_softskill) ? 'selected' : ''}}>{{ $key }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-xs-12 col-lg-6">
                  <label>Language <span class="text-muted">(select multiple)</span></label>
                  <select class="form-control select2 language" multiple="multiple" id="language" name="language[]">
                      @foreach ($all_languages as $key => $language)
                      <option value={{ $language }} {{ in_array($language, $sel_languages) ? 'selected' : ''}}>{{ $key }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-header">
                <h3 class="box-title">References</h3>
              </div>

              <div id="references_rows">
                @if(count($references))
                  @foreach($references as $ref_key => $reference)
                    @include('backend.users.snippets.edit_reference_tmpl', compact('ref_key', 'reference'))
                  @endforeach
                @else
                  @include('backend.users.snippets.reference_tmpl')
                @endif
              </div>

              <div class="row">
                <div class="col-md-2 col-xs-6 col-lg-2">
                  <button type="button" id="add_reference" class="btn btn-flat btn-primary">Add Reference</button>
                </div>
              </div>
            </div>
          </div>

          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-header">
                <h3 class="box-title">About Me</h3>
              </div>

              <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-6 form-group info-error">
                    <label for="profile_upload">Upload Photo</label>
                    <div class="checkbox">
                      <label> <input type="checkbox" value="1" name="profile_status" {{ $personal ? ($personal->profile_status ? 'checked' : '') : '' }}> Show</label>
                    </div>
                    <input type="file" id="profile_upload" name="profile">
                    <p class="help-block">Acceptable file formats: JPG/PNG, max size 1MB</p>

                    @if($user->profile_photo_path)
                      <a href="javascript:;">
                        @if($personal->profile_status)

                          <img src="{{asset($personal->profile_photo_path)}}"  id="preview" alt="" style="border-radius: 50%; width:114px !important; height:114px !important;"/>
                        @else
                          <img src="{{asset('/assets/be/images/masked_ic.png')}}"  id="preview" alt="" width="50px" height="50px" style="border-radius:50%; width:114px !important; height:114px !important;" />
                        @endif
                      </a>
                      {{-- <span class="remove-avatar text-center" wire:click.stop="removeAvatar()"><img src="{{asset('assets/fe/images/del2.svg')}}" class="del-pic" alt="" /></span> --}}
                    @else
                      <a href="javascript:;">
                        <img src="{{asset('assets/fe/images/profile-pic.png')}}"  id="preview" alt="" style="border-radius: 50%"/>
                        <img src="{{asset('assets/fe/images/up-plus.png')}}"   alt="" class="up-plus" />
                      </a>
                    @endif
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 form-group">
                  <label>Short Bio</label>
                  <div class="checkbox">

                    <label> <input type="checkbox"  value="1" name="short_bio_status" {{ !empty($personal->short_bio_status) ? 'checked' : ''}}> Show</label>
                  </div>
                  <textarea name="short_bio" rows="5" class="form-control">{{$personal->short_bio}}</textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-md-12 col-xs-12">
              {!! Form::submit('Publish Profile', array('class'=> 'btn btn-success btn-flat margin', 'style' => 'float:right', 'name' => 'save', 'onclick' => 'return confirm("Are you sure to publish this profile?\\nThis action can not be undone.")'))!!}

              <a class="btn btn-flat pull-right bg-black-active margin" href="{{ route('admin.candidates.downloadhiddenpdf', $user->id) }}"><i class="fa fa-download" aria-hidden="true"></i> Hiden Resume</a>

              <a class="btn btn-flat pull-right btn-warning margin" href="{{ route('admin.candidates.downloadpdf', $user->id) }}"><i class="fa fa-download" aria-hidden="true"></i> Resume</a>

              {!! Form::submit('Save', array('class'=> 'btn bg-navy btn-flat margin', 'style' => 'float:right', 'name' => 'save'))!!}
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        {!! Form::close() !!}
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{ asset('assets/backend/plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/plugins/bootstrap-slider/slider.css') }}">
<script type="text/javascript">
  $(function () {
    $('.select2').select2();
;

{{-- ======================================= --}}
$('#selectedIndustries').on('select2:select', function(e) {
    var allOptions = "";
    var allInds = {!! json_encode($all_industries) !!}; // Corrected variable declaration and JSON encoding for the array
    var selPrimIndustries = {!! json_encode($sel_prim_industries) !!}; // Encode the $sel_prim_industries array

    $(this).find(':selected').each(function() {
        var selectedText = $(this).text(); // Correctly define the selectedText variable
        if (allInds[selectedText]) { // Check if the selected text exists as a key in the object
            var isSelected = selPrimIndustries && selPrimIndustries[0] === selectedText ? 'selected' : '';
            allOptions += `<option value="${allInds[selectedText]}" ${isSelected}>${selectedText}</option>`;
        }
    });

    var val = $('#selectedPrimaryIndustry').val();
    $('#selectedPrimaryIndustry').html(allOptions).val(val).select2();
});

$('#selectedIndustries').on('select2:unselect', function(e) {
    var deselectedText = e.params.data.text;
    $('#selectedPrimaryIndustry option').filter(function() {
        return $(this).text() === deselectedText;
    }).remove();

    $('#selectedPrimaryIndustry').select2();
});



{{-- ======================================= --}}

    $('.slider').slider();

    $('.phone_input').inputmask('999-999-9999');
    // $('#candidate_frm').validate();

    // task - 86a1krdtg
    var avatar = '{{ $user->profile_photo_path }}';
    var original_avatar = '{{ asset($user->profile_photo_path) }}';
    var pr_status = '{{ isset($personal->profile_status)?? $personal->profile_status }}';
    var no_img = '{{ asset('assets/fe/images/profile-pic.png') }}';
    var mask_img = '{{ asset('/assets/be/images/masked_ic.png') }}';

    $('#preview').on('mouseover', function(event) {
      if(avatar && pr_status==0) {
        $(this).attr('src', original_avatar);
      } else if(avatar == "" && pr_status==0) {
        $(this).attr('src', no_img);
      }
    });

    $('#preview').on('mouseout', function(event) {
      if(avatar && pr_status==0) {
        $(this).attr('src', mask_img);
      }
    });

    $('#profile_upload').on('change', function(event) {
      var file = this.files[0];
      if (file) {
        if (file.type.match(/^image\/(jpeg|png)$/)) {
          var reader = new FileReader();
          reader.onload = function(e) {
              var image = $('#preview').attr('src', e.target.result);
              original_avatar = e.target.result;
              avatar = e.target.result;
              $('#preview').css('width', '116px');
              $('#preview').css('height', '116px');

              if($('.up-plus').is(':visible')) {
                $('.up-plus').hide();
              }

              setTimeout(() => {
                  $('#preview').attr('src', mask_img );
              }, 1000);
          };

          var fileSizeInBytes = file.size;
          var fileSizeInMB = fileSizeInBytes / (1024 * 1024); // Convert to MB
          if (fileSizeInMB > 1) {
            $('#profile_upload').val('');
            $('.text-danger').remove();
            $('.info-error').append('<div class="text-red file-error">File must be an image. Maximum size must be 1MB.</div>');
          } else {
            reader.readAsDataURL(file);
            $('.text-danger').remove();
          }
        } else {
          // If it's not an image, display the error message
          $('#profile_upload').val('');
          $('.text-danger').remove();
          $('.info-error').append('<div class="text-red file-error">File must be an image. Maximum size must be 1MB.</div>');
        }
      }
    });
    // task - 86a1krdtg end

    $('#candidate_frm').submit(function(e){
      var wrk_err, sch_err, com_err;
      var is_valid = 1;

      /*if($('.work_seting:checked').length == 0) {
        wrk_err = "This field is required";
        $('.wrk-err').html(wrk_err);
        is_valid = 0;
      }

      if($('.schedule:checked').length == 0) {
        sch_err = "This field is required";
        $('.sch-err').html(sch_err);
        is_valid = 0;
      }

      if($('.compensation:checked').length == 0) {
        com_err = "This field is required";
        $('.com_err').html(com_err);
        is_valid = 0;
      }*/

      $('.edu-row').each(function(index, el) {
        let st_dt = new Date($(el).find('.st_datepicker').val());
        let ed_dt = new Date($(el).find('.ed_datepicker').val());
        let cur_chk = $(el).find('.currently_studying').val();
        $(el).find('.dt-err').html('');
        if($(el).find('.st_datepicker').val() == "" && $(el).find('.ed_datepicker').val() != "") {
          $(el).find('.dt-err').html('You must select a start date'); is_valid = 0;
        } else if($(el).find('.st_datepicker').val() != "" && $(el).find('.ed_datepicker').val() == "" && $(el).find('.currently_studying').is(':checked') == false) {
          $(el).find('.dt-err').html('You must select an end date'); is_valid = 0;
        }

        if($(el).find('.currently_studying').is(':checked')) { ed_dt = new Date(); }
        // console.log(ed_dt, st_dt,ed_dt < st_dt, st_dt < date)
        if(ed_dt < st_dt) {
          $(el).find('.dt-err').html('End month can not be before the start month'); is_valid = 0;
        }
      });

      $('.emp-row').each(function(index, el) {
        let st_dt = new Date($(el).find('.e_st_datepicker').val());
        let ed_dt = new Date($(el).find('.e_ed_datepicker').val());
        let cur_chk = $(el).find('.currently_working').val();
        $(el).find('.dt-err').html('');
        console.log($(el).find('.e_st_datepicker').val(), $(el).find('.e_ed_datepicker').val());
        console.log(st_dt, ed_dt);
        if($(el).find('.e_st_datepicker').val() == "" && $(el).find('.e_ed_datepicker').val() != "") {
          $(el).find('.dt-err').html('You must select a start date'); is_valid = 0;
        } else if($(el).find('.e_st_datepicker').val() != "" && $(el).find('.e_ed_datepicker').val() == "" && $(el).find('.currently_working').is(':checked') == false) {
          $(el).find('.dt-err').html('You must select an end date'); is_valid = 0;
        }

        if($(el).find('.currently_working').is(':checked')) { ed_dt = new Date(); }
        // console.log(ed_dt, st_dt,ed_dt < st_dt, st_dt < date)
        if(ed_dt < st_dt) {
          $(el).find('.dt-err').html('End month can not be before the start month'); is_valid = 0;
        }
      });
      // return false;
      if(!is_valid) {
        $('html, body').animate({
            scrollTop: $(".dt-err:not(:empty):first").offset().top - 200
        }, 500);
        return false;
      }
    });

    $(document).on('change', '.work_seting', function(event) {
      if($('.work_seting[name=remote]').is(':checked') && $('.work_seting[name=in_office]').is(':checked') == false && $('.work_seting[name=hybrid]').is(':checked') == false) {
        $('input[name=distance]').val(100);
        $('.slider-total-sec-col').css('display', 'none');
      } else if($('.work_seting:checked').length == 0) {
        $('.slider-total-sec-col').css('display', 'none');
      } else {
        $('.slider-total-sec-col').css('display', 'block');
      }
    });

    // add education
    $('#add_education').on('click', function(event) {
      var new_edu_row = $("#edu-first-row").clone().prop('id', '');
      $(new_edu_row).find('input[type=text]').val('');
      $(new_edu_row).find('textarea').val('');
      $(new_edu_row).find('input.ed_datepicker').prop('readonly', false);
      $(new_edu_row).find('input[type=checkbox]').prop('checked', false);
      $(new_edu_row).find('.remove-edu-btn').show();

      $(new_edu_row).find('.st_datepicker').datepicker({
        format: 'M yyyy',
        updateViewDate: true,
        autoclose: true,
        viewMode: "months",
        minViewMode: "months",
        endDate: new Date()
      });

      $(new_edu_row).find('.ed_datepicker').datepicker({
        format: 'M yyyy',
        updateViewDate: true,
        autoclose: true,
        viewMode: "months",
        minViewMode: "months",
        endDate: new Date()
      });

      $('#education_rows').append(new_edu_row);

    });

    // remove education
    $(document).on('click', '.remove-edu-row', function(event) {
      $(this).closest('.edu-row').remove();
    });

    // add employment
    $('#add_employment').on('click', function(event) {
      var new_emp_row = $("#emp-first-row").clone().prop('id', '');
      $(new_emp_row).find('input[type=text]').val('');
      $(new_emp_row).find('textarea').val('');
      $(new_emp_row).find('input.e_ed_datepicker').prop('readonly', false);
      $(new_emp_row).find('input[type=checkbox]').prop('checked', false);
      $(new_emp_row).find('.remove-emp-btn').show();

      $(new_emp_row).find('.e_st_datepicker').datepicker({
        format: 'M yyyy',
        updateViewDate: true,
        autoclose: true,
        viewMode: "months",
        minViewMode: "months",
        endDate: new Date()
      });

      $(new_emp_row).find('.e_ed_datepicker').datepicker({
        format: 'M yyyy',
        updateViewDate: true,
        autoclose: true,
        viewMode: "months",
        minViewMode: "months",
        endDate: new Date()
      });
      $('#employment_rows').append(new_emp_row);
    });

    // remove employment
    $(document).on('click', '.remove-emp-row', function(event) {
      $(this).closest('.emp-row').remove();
    });

    // add references
    $('#add_reference').on('click', function(event) {
      var new_ref_row = $("#reference-first-row").clone().prop('id', '');
      $(new_ref_row).find('input[type=text]').val('');
      $(new_ref_row).find('input[type=checked]').prop('checked', false);
      $(new_ref_row).find('.phone_input').inputmask('999-999-9999');
      $(new_ref_row).find('.remove-ref-btn').show();
      $('#references_rows').append(new_ref_row);
    });

    // remove referances
    $(document).on('click', '.remove-ref-row', function(event) {
      $(this).closest('.ref-row').remove();
    });
    $(document).on('click', '.currently_studying', function(event) {
        if($(this).is(':checked')){

      $(this).parents('.checkbox').find('.currently_studying_hidden').remove();

      }else{
        $(this).parents('.checkbox').append('<input type="hidden" name="currently_studying[]" value="0" class="currently_studying_hidden">');
      }
    });


    $(document).on('click', ".work_seting,.schedule,.compensation,.prefered_benefits", function(event) {
        var name=$(this).attr('name');
        if($(this).is(':checked')){

      $(this).parents('.checkbox').find('.work_seting_hidden').remove();

      }else{
        $(this).parents('.checkbox').append('<input type="hidden" name="'+name+'" value="0" class="work_seting work_seting_hidden">');
      }
    });

    $(document).on('change', '.currently_studying', function () {
      var _EL = $(this).closest('.edu-row');
      $(_EL).find('.ed_datepicker').val('');
      $(_EL).find('.ed_datepicker').css('pointer-events', 'all');
      $(_EL).find('.ed_datepicker').attr('readonly', false);
      console.log($(this).prop('checked'))
      if($(this).prop('checked')) {
        $(_EL).find('.ed_datepicker').val('PRESENT');
        $(_EL).find('.ed_datepicker').css('pointer-events', 'none');
        $(_EL).find('.ed_datepicker').prop('readonly', true);
      }
    }).trigger('change');

    $(document).on('change', '.currently_working', function () {
      var _EL = $(this).closest('.emp-row');
      $(_EL).find('.e_ed_datepicker').val('');
      $(_EL).find('.e_ed_datepicker').css('pointer-events', 'all');
      $(_EL).find('.e_ed_datepicker').attr('readonly', false);
      console.log($(this).prop('checked'))
      if($(this).prop('checked')) {
        $(_EL).find('.e_ed_datepicker').val('PRESENT');
        $(_EL).find('.e_ed_datepicker').css('pointer-events', 'none');
        $(_EL).find('.e_ed_datepicker').prop('readonly', true);
      }
    }).trigger('change');
  });
  $( function() {
    $( "#employment_rows" ).sortable();
  } );
</script>
@endsection
