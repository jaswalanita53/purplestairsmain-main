@extends('layouts.backend')
<Style>
.list-group-item {
    padding: 20px 15px !important;
}</Style>
@section('content')
<div class="content-wrapper" style="/*min-height: 1136.28px;*/">
  <section class="content-header">
    <h1> Candidate Profile </h1>
    <ol class="breadcrumb">
      <li>
        <a href="#">
          <i class="fa fa-dashboard"></i> Home </a>
      </li>
      <li>
        <a href="{{ route('admin.candidates') }}">Users</a>
      </li>
      <li class="active">Candidate profile</li>
    </ol>
  </section>
  @php
    $colors = ['danger', 'success','warning', 'info', 'primary'];
  @endphp
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-body box-profile">
            @if($user->profile_photo_path)
            <img class="profile-user-img img-responsive img-circle" src="{{ asset($user->profile_photo_path) }}" alt="Profile picture">
            @else
            <img class="profile-user-img img-responsive img-circle" src="{{asset('assets/fe/images/profile-pic.png')}}" alt="Profile picture">
            @endif
            <h3 class="profile-username text-center">
              @if(!empty($user->personal->name))
              {{ ucwords($user->personal->name) }}
              @endif
            </h3>
            <p class="text-muted text-center">
              @if(!empty($user->personal->current_title))
              {{ ucwords($user->personal->current_title) }}
              @endif
            </p>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Phone No</b>
                <span class="pull-right">{{ $user->personal->phone }}</span>
              </li>

              <li class="list-group-item">
                <b>Email</b>
                <span class="pull-right">{{ $user->personal->email }}</span>
              </li>

              @if($user->personal->linkedin_url)
              <li class="list-group-item">
                <b>Linked IN</b>
                <a class="pull-right" href="{{ $user->personal->linkedin_url }}">{{ $user->personal->linkedin_url }}</a>
              </li>
              @endif

              @if($user->personal->additional_url)
              <li class="list-group-item">
                <b>Portfolio Link</b>
                <a class="pull-right" href="{{ $user->personal->additional_url }}">{{ $user->personal->additional_url }}</a>
              </li>
              @endif

              @php $industries = $user->industries->pluck('name')->toArray(); $i = 0; @endphp
              <li class="list-group-item">
                <b>Industries</b>
                <span class="pull-right">
                  @foreach($industries as $industry)
                  <span class="label label-{{ array_key_exists($i,$colors)? $colors[$i] : $colors[1]  }}">{{$industry}}</span>
                  @php if(array_key_exists($i,$colors)){ $i++; }else{ $i = 0;} @endphp
                  @endforeach
                </span>
              </li>

              @php $interests = $user->interests->pluck('name')->toArray(); $i = 0; @endphp
              <li class="list-group-item">
                <b>Area Of Interest</b>
                <span class="pull-right">
                  @foreach($interests as $interest)
                  <span class="label label-{{ array_key_exists($i,$colors)? $colors[$i] : $colors[1]  }}">{{$interest}}</span>
                  @php if(array_key_exists($i,$colors)){ $i++; }else{ $i = 0;} @endphp
                  @endforeach
                </span>
              </li>

              <li class="list-group-item">
                <b>Asking Salary</b>
                <a class="pull-right">{{ $user->personal->salary_range }}</a>
              </li>

              {{-- task - 86a1hvak1 --}}
              <li class="list-group-item">
                <b>Last login at</b>
                <span class="label label-info pull-right">{{ ($user->last_login) ? date('m-d-Y h:i A', strtotime($user->last_login)) : 'N/A' }}</span>
              </li>
            </ul>
            {{-- <a href="#" class="btn btn-primary btn-block">
              <b>Follow</b>
            </a> --}}
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Candidate Info</h3>
          </div>
          <div class="box-body">
            <strong><i class="fa fa-map-marker margin-r-5"></i> Location </strong>
            <p class="text-muted">{{$user->personal->address}},&nbsp;{{$user->personal->state_abbr}}</p>
            <hr>

            <strong><i class="fa fa-money margin-r-5"></i> Compensation </strong>
              <p>
                @if ($user->personal->compensation_salary)
                <span class="label label-success">Salary</span>
                @endif
                @if ($user->personal->compensation_hourly)
                <span class="label label-warning">Hourly</span>
                @endif
                @if ($user->personal->compensation_comission_based)
                <span class="label label-danger">Comission Based</span>
                @endif
              </p>
            <hr>

            <strong><i class="fa fa-clock-o margin-r-5"></i> Schedule </strong>
              <p>
                @if ($user->personal->schedule_full_time)
                <span class="label label-info">Full Time</span>
                @endif
                @if ($user->personal->schedule_part_time)
                <span class="label label-primary">Part Time</span>
                @endif
                @if ($user->personal->schedule_no_preference)
                <span class="label label-danger">No Preference</span>
                @endif
              </p>
            <hr>

            <strong><i class="fa fa-calendar-o margin-r-5"></i> Work Setting </strong>
              <p>
                @if ($user->personal->work_environment_remote)
                <span class="label label-success">Remote</span>
                @endif
                @if ($user->personal->work_environment_hybrid)
                <span class="label label-info">Hybrid</span>
                @endif
                @if ($user->personal->work_environment_in_office)
                <span class="label label-primary">In Office</span>
                @endif
              </p>
            <hr>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        @php
          $references = $user->references;
          $educations = $user->educations;
          $employments = $user->employments;
        @endphp

        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li>
              <a href="#experience" data-toggle="tab">Work Experience</a>
            </li>

            @if($educations->count())
            <li>
              <a href="#education" data-toggle="tab">Education & Training</a>
            </li>
            @endif

            <li>
              <a href="#skills" data-toggle="tab">Skills</a>
            </li>
          </ul>
          <div class="tab-content">
            @if($employments->count())
            <div class="tab-pane" id="experience">
              <ul class="timeline timeline-inverse">
                @foreach ($employments as $employement)
                  @if ($employement->position != '')
                    <li class="time-label">
                      <span class="bg-purple">
                        {{ $employement->start_year }}
                        @if ($employement->start_year != '' && ($employement->end_year != '' || $employement->currently_working))
                        -
                        @endif
                        {{ $employement->currently_working ? 'Present' : $employement->end_year }}
                      </span>
                    </li>
                    <li>
                      <div class="timeline-item">
                        <div class="timeline-body">
                          @if ($employement->position != '')
                            <h5>{{ $employement->position }}</h5>
                            <p>{{ $employement->company_name }}</p>
                          @endif
                        </div>
                      </div>
                    </li>

                    @if ($employement->responsibilities != '')
                    <li>
                      <div class="timeline-item">
                        <h5 class="timeline-header">Position Responsibilities</h5>
                        <div class="timeline-body">
                            <p class="text-muted">{!! nl2br($employement->responsibilities) !!}</p>
                        </div>
                      </div>
                    </li>
                    @endif

                    @if ($employement->accomplishments != '')
                    <li>
                      <div class="timeline-item">
                        <h5 class="timeline-header">Position Accomplishments</h5>
                        <div class="timeline-body">
                            <p class="text-muted">{!! nl2br($employement->accomplishments) !!}</p>
                        </div>
                      </div>
                    </li>
                    @endif
                  @endif
                @endforeach
              </ul>
            </div>
            @endif

            @if($educations->count())
            <div class="tab-pane" id="education">
              <ul class="timeline timeline-inverse">
              @foreach ($educations as $education)
                @if ($education->organization_name != '')
                  <li class="time-label">
                    <span class="bg-purple">
                      {{$education->start_year}}
                      @if($education->start_year != '' && ($education->end_year != '' || $education->currently_studying)) - @endif
                      {{$education->currently_studying ? 'Present' : $education->end_year}}
                    </span>
                  </li>
                  <li>
                    <div class="timeline-item">
                      <div class="timeline-body">
                        @if ($education->organization_name != '')
                          <h5>{{ $education->organization_name }}</h5>
                          <p>{{ $education->program_name }}</p>
                        @endif
                        @if ($education->course_description != '')
                          <p class="text-muted">{!! nl2br($education->course_description) !!}</p>
                        @endif
                      </div>
                    </div>
                  </li>
                @endif
              @endforeach
              </ul>
            </div>
            @endif

            <div class="tab-pane" id="skills">
              <div class="box-body">
                <h4>Hard Skills</h4>
                <p>
                  @php $hard_skills = $user->hardSkills->pluck('name')->toArray(); @endphp
                  @foreach ($hard_skills as $hard_skill)
                  <span class="label label-info">{{ $hard_skill }}</span>
                  @endforeach
                </p>
              </div>
              <hr>
              <div class="box-body">
                <h4>Soft Skills</h4>
                <p>
                  @php $soft_skills = $user->softSkills->pluck('name')->toArray(); @endphp
                  @foreach ($soft_skills as $soft_skill)
                  <span class="label label-primary">{{ $soft_skill }}</span>
                  @endforeach
                </p>
              </div>
              <hr>
              <div class="box-body">
                <h4>Language</h4>

                <p>
                  @php $languages = $user->languages->pluck('name')->toArray(); @endphp
                  @foreach ($languages as $language)
                  <span class="label label-primary">{{ $language }}</span>
                  @endforeach
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
       <div class="col-md-9">
        @php
          $personal = $user->personal;
        @endphp
        @if($references->count() || $user->personal->short_bio)
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                @if($user->personal->short_bio)
                <li class="active">
                <a href="#about-info" data-toggle="tab">About {{ $user->personal->name }}</a>
                </li>
                @endif
                @if($references->count())
                <li>
                <a href="#references" data-toggle="tab">References</a>
                </li>
                @endif
            </ul>
            <div class="tab-content">
                    @if($user->personal->short_bio)
                        <div class="active tab-pane" id="about-info">
                            <div class="post">
                                <p class="text-muted">{!! nl2br($user->personal->short_bio) !!}</p>
                            </div>
                        </div>
                    @endif
                    @if($references->count())
                        <div class="tab-pane" id="references">
                            @foreach ($references as $reference)
                                @if ($reference->name != '')
                                <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{ $reference->name }}</h3>
                                    <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>

                                <div class="box-body">
                                    <p>Phone No : {{ $reference->phone }} </p>
                                    <p>Email : {{ $reference->email }} </p>
                                    <p>Relationship : {{ $reference->relationship }}</p>
                                </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
            </div>
            </div>
        @endif
      </div>
    </div>
  </section>
</div>
@endsection
