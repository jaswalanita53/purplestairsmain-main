@extends('layouts.backend')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li> <a href="{{ route('admin.candidates') }}">Candidates</a> </li>
      <li> <a href="#">Add Candidate</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <!-- /.box -->

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Add Candidate</h3>
            <div style="float: right;"><a class="btn bg-navy btn-flat margin" href="{{ route('admin.candidates') }}">
            Candidates
           </a></div>
           
         </div>
         <!-- /.box-header -->
         {!! Form::open(['method' => 'post', 'files' => true, 'id' => 'candidate_frm', 'route' => ['admin.candidates.create']])!!}
         <div class="box-body">

          @if($errors->any())
          <div class="alert alert-danger">
              {!! implode('', $errors->all('<div>:message</div>')) !!}
          </div>
          @endif

          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-header">
                <h3 class="box-title">Personal Information</h3>
              </div>
             
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Name </label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="name"  value="{{ old('name') }}">
                      <span class="input-group-addon">
                        Hidden To Everyone
                      </span>
                    </div>
                    {{-- {!! Form::text('name', null, array('class'=> 'form-control'))!!} --}}
                    @if ($errors->has('name'))<em class="invalid-feedback">{!!$errors->first('name')!!}</em>@endif
                  </div>            
                </div> 

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email </label>
                    {{-- {!! Form::text('email', null, array('class'=> 'form-control'))!!} --}}
                    <div class="input-group">
                      <input type="text" class="form-control" name="email"  value="{{ old('email') }}">
                      <span class="input-group-addon">
                        Hidden To Everyone
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
                      <input type="text" class="form-control phone_input" name="phone" value="{{ old('phone') }}">
                      <span class="input-group-addon">
                        Hidden To Everyone
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
                      <input type="text" class="form-control" name="current_title" value="{{ old('current_title') }}">
                      <span class="input-group-addon">
                        <input type="checkbox" value="1" name="current_title_status" checked> Show
                      </span>
                    </div>
                    @if ($errors->has('current_title'))<em class="invalid-feedback">{!!$errors->first('current_title')!!}</em>@endif
                  </div>   
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Zipcode  (Center of Work Radius)</label>
                    {{-- {!! Form::text('zipcode', null, array('class'=> 'form-control'))!!} --}}
                    <div class="input-group">
                      <input type="text" class="form-control" name="zipcode"  value="{{ old('zipcode') }}">
                      <span class="input-group-addon">
                        Hidden To Everyone
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
                      <input type="text" class="form-control" name="linkedin_url" value="{{ old('linkedin_url') }}">
                      <span class="input-group-addon">
                        Hidden To Everyone
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
                      <input type="text" class="form-control" name="additional_url" value="{{ old('additional_url') }}">
                      <span class="input-group-addon">
                        Hidden To Everyone
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
                <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                  <label>Industries  <span class="text-muted">(select multiple)</span></label>
                  <select class="select2 industries form-control" name="industries[]" multiple="multiple" id="selectedIndustries" value="" >
                      @foreach ($all_industries as $key => $ind)
                      <option data-badge="" value={{ $ind }}>{{ $key }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                  <label>Area of Interest  <span class="text-muted">(select multiple)</span></label>
                  <select class="select2 interests form-control" name="interests[]" multiple="multiple" id="selectedInterests" value="" >
                      @foreach ($all_interests as $key => $interest)
                      <option value={{ $interest }}>{{ $key }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                  <label>Salary </label>
                  <select class="form-control" name="salary_range" id="salary_range"  value="{{ old('salary_range') }}">
                      <option value="">Choose Salary Range</option>
                      @foreach ($all_salaries as $key => $salary)
                      <option value="{{ $key }}"> {{ $key }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="row">
                    <div class="col-md-12 col-xs-12 col-lg-12">
                      <label>Work Settings </label>
                    </div>
                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="remote" class="work_seting"> Remote
                          </label>
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="in_office" class="work_seting"> In Office
                          </label>
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="hybrid" class="work_seting"> Hybrid
                          </label>
                        </div>
                    </div>
                  </div>
                  <span class="text-red wrk-err"></span>
                </div>

                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="row">
                    <div class="col-md-12 col-xs-12 col-lg-12">
                      <label>Schedule </label>
                    </div>
                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" name="full_time" class="schedule" > Full Time
                        </label>
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" name="part_time" class="schedule"> Part Time
                        </label>
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="1" name="no_preference" class="schedule"> No Preference
                        </label>
                      </div>
                    </div>
                  </div>
                  <span class="text-red sch-err"></span>
                </div>

                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="row">
                    <div class="col-md-12 col-xs-12 col-lg-12 ">
                      <label>Compensation </label>
                    </div>
                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label class="">
                          <input type="checkbox" value="1" name="compensation_salary" class="compensation"> Salary
                        </label>
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label class="">
                          <input type="checkbox" value="1" name="compensation_hourly" class="compensation"> Hourly
                        </label>
                      </div>
                    </div>

                    <div class="col-md-4 col-xs-12 col-lg-4 form-group">
                      <div class="checkbox">
                        <label class="">
                          <input type="checkbox" value="1" name="compensation_comission_based" class="compensation"> Comission Based
                        </label>
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
                      <input type="checkbox" value="1" name="prefered_benefits_insurance_benefits" class="minimal prefered_benefits" > Insurance Benefits                    
                    </label>
                  </div>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4 ">
                  <div class="checkbox">
                    <label class="">
                      <input type="checkbox" value="1" name="prefered_benefits_paid_holidays" class="minimal prefered_benefits"> Paid Holidays
                    </label>
                  </div>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="checkbox">
                    <label class="">
                        <input type="checkbox" value="1" name="prefered_benefits_paid_vacation_days" class="minimal prefered_benefits"> Paid Vacation Days
                    </label>
                  </div>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="checkbox">
                    <label class="">
                      <input type="checkbox" value="1" name="prefered_benefits_professional_environment" class="minimal prefered_benefits"> Professional Environment
                    </label>
                  </div>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                  <div class="checkbox">
                    <label class="">
                      <input type="checkbox" value="1" name="prefered_benefits_casual_environment" class="minimal prefered_benefits"> Casual Environment
                    </label>
                  </div>
                </div>
              </div>

              <div class="row slider-total-sec-col" style="display:none;">
                <div class="col-md-12 col-xs-12 col-lg-12">
                  <label>Distance (I would travel up to x miles)</label>
                  <input type="number" name="distance" value="{{ old('distance') }}" min=0 max=100 class="slider form-control" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="[0]" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
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
                @include('backend.users.snippets.education_tmpl')  
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
                @include('backend.users.snippets.employment_tmpl')  
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
                <div class="col-md-6 col-xs-12 col-lg-6 form-group">
                  <label>Hard Skills  <span class="text-muted">Select 1-5 Hard Skills</span></label>
                  <select class="form-control select2 hard_skill" multiple="multiple" id="hard_skill" name="hard_skill[]" value="">
                      @foreach ($all_hard_skills as $key => $hard)
                      <option value={{ $hard }} {{ old('hard_skill') == $hard ? 'selected' : '' }}>{{ $key }}</option>
                      @endforeach
                  </select>
                </div>     
                <div class="col-md-6 col-xs-12 col-lg-6 form-group">
                  <label>Soft Skills  <span class="text-muted">Select 1-10 Soft Skills</span></label>
                  <select class="form-control select2 soft_skill" multiple="multiple" id="soft_skill" name="soft_skill[]" >
                      @foreach ($all_soft_skills as $key => $soft)
                      <option value={{ $soft }}>{{ $key }}</option>
                      @endforeach
                  </select>
                </div>  
              </div>

              <div class="row">
                <div class="col-md-6 col-xs-12 col-lg-6 form-group">
                  <label>Language <span class="text-muted">(select multiple)</span></label>
                  <select class="form-control select2 language" multiple="multiple" id="language" name="language[]" value="">
                      @foreach ($all_languages as $key => $language)
                      <option value={{ $language }}>{{ $key }}</option>
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
                @include('backend.users.snippets.reference_tmpl')      
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
                    <input type="file" id="profile_upload" name="profile">
                    <p class="help-block">Acceptable file formats: JPG/PNG, max size 1MB</p>

                    <a href="javascript:;">
                      <img src="{{asset('assets/fe/images/profile-pic.png')}}"  id="preview" alt="" style="border-radius: 50%"/>
                      <img src="{{asset('assets/fe/images/up-plus.png')}}"   alt="" class="up-plus" />
                    </a>
                </div>   

                <div class="col-xs-12 col-md-6 col-lg-6 form-group">
                  <label>Short Bio</label>
                  <div class="checkbox">
                    <label> <input type="checkbox" value="1" name="short_bio_status"> Show</label>
                  </div>
                  <textarea name="short_bio" rows="5" class="form-control">{{ old('short_bio') }}</textarea>
                </div>            
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-md-12 col-xs-12">
              {!! Form::submit('Save', array('class'=> 'btn bg-navy btn-flat margin', 'style' => 'float:right'))!!}
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
    $('.slider').slider();

    $('.phone_input').inputmask('999-999-9999');
    // $('#candidate_frm').validate();

    // task - 86a1krdtg
    var avatar = '';
    var original_avatar = '{{ asset('') }}';
    var pr_status = 0;
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
        if($(el).find('.ed_datepicker').val() == "" && $(el).find('.ed_datepicker').val() != "") {
          $(el).find('.dt-err').html('You must select a start date'); is_valid = 0;
        } else if($(el).find('.ed_datepicker').val() != "" && $(el).find('.ed_datepicker').val() == "" && $(el).find('.currently_studying').is(':checked') == false) {
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
      $(new_edu_row).find('.remove-edu-btn').show();
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
      $(new_emp_row).find('.remove-emp-btn').show();
      $('#employment_rows').append(new_edu_row);
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
    });

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
    });
  });
</script>
@endsection