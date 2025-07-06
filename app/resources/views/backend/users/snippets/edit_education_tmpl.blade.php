<div class="row edu-row" id="edu-first-row">
	<div class="col-md-12 col-xs-12 col-lg-12 text-right remove-edu-btn" style="display: {{ $edu_key > 0 ? '' : 'none'}};">
		<button type="button" class="btn btn-danger btn-social-icon btn-sm remove-edu-row"><i class="fa fa-trash"></i></button>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>School/Organization Name <span class="text-muted">(Ex. Touro)</span></label>
		<div class="input-group">
		  <input type="text" class="form-control" name="organization_name[]" value="{{ $education->organization_name }}">
		  <span class="input-group-addon">
		    <input type="checkbox" value="1" name="organization_name_status[]" {{ $education->organization_name_status ? 'checked' : '' }}> Show
		  </span>
		</div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Course/Program Name <span class="text-muted">(Ex. Accounting, BA)</span></label>
		<div class="input-group">
		  <input type="text" class="form-control" name="program_name[]" value="{{ $education->program_name }}">
		  <span class="input-group-addon">
		    <input type="checkbox" value="1" name="program_name_status[]" {{ $education->program_name_status ? 'checked' : '' }}> Show
		  </span>
		</div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Program Duration <span class="text-muted">(Dates)</span></label>
		<div class="input-group">
		  <input type="text" class="form-control st_datepicker" value="{{ $education->start_year }}" name="start_year[]" style="width: 50%;">
		  <input type="text" class="form-control ed_datepicker" value="{{ $education->currently_studying ? 'PRESENT' : $education->end_year }}" name="end_year[]" style="width: 50%;" {{ $education->currently_studying ? 'readonly' : '' }} style="pointer-events: {{ $education->currently_studying ? 'none' : '' }};">
		  <span class="input-group-addon">
		    <input type="checkbox" value="1" name="start_year_status[]" {{ $education->start_year_status ? 'checked' : '' }}> Show
		  </span>
		</div>
    <span class="dt-err text-red"></span>
		<div class="checkbox">
      <label>
        <input type="checkbox" value="1" name="currently_studying[]" class="currently_studying" {{ $education->currently_studying ? 'checked' : '' }}> I am currently studying here
      </label>
      @if(empty($education->currently_studying ))
      <input type="hidden" name="currently_studying[]" value="0" class="currently_studying_hidden">
      @endif
    </div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label style="width: 100%">Course Description
			<span class="pull-right">
	      <label>
	        <input type="checkbox" value="1" name="course_description_status[]" class="course_description_status" {{ $education->course_description_status ? 'checked' : '' }}> Show
	      </label>
	    </span>
		</label>
		<textarea name="course_description[]" class="form-control" >{{ $education->course_description }}</textarea>
	</div>
</div>
<link rel="stylesheet" href="{{ asset('assets/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('assets/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
	$('.st_datepicker').datepicker({
      format: 'M yyyy',
      updateViewDate: true,
      autoclose: true,
      viewMode: "months",
      minViewMode: "months",
      endDate: new Date()
    });
	$('.ed_datepicker').datepicker({
      format: 'M yyyy',
      updateViewDate: true,
      autoclose: true,
      viewMode: "months",
      minViewMode: "months",
      endDate: new Date()
    });
</script>
