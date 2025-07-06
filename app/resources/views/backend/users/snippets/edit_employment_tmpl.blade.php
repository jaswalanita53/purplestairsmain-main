<div class="row emp-row" id="emp-first-row">
	<div class="col-md-12 col-xs-12 col-lg-12  remove-emp-btn" >
    <i class="fa fa-arrows move-icons" aria-hidden="true"></i>
    <span style="float: right;" >
		<button type="button" class="btn btn-danger btn-social-icon btn-sm remove-emp-row" style="display: {{ $emp_key > 0 ? '' : 'none'}};"><i class="fa fa-trash"></i></button>
        </span>
	</div>
		
	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Company Name</label>
		<div class="input-group">
		  <input type="text" class="form-control" name="company_name[]" value="{{ $employment->company_name }}">
		  <span class="input-group-addon">
		    <input type="checkbox" value="1" name="company_name_status[]" {{ $employment->company_name_status ? 'checked' : '' }}> Show
		  </span>
		</div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Position Title</label>
		<div class="input-group">
		  <input type="text" class="form-control" name="position[]" value="{{ $employment->position }}">
		  <span class="input-group-addon">
		    <input type="checkbox" value="1" name="position_status[]" {{ $employment->position_status ? 'checked' : '' }}> Show
		  </span>
		</div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Position Responsibilities</label>
		<div class="checkbox">
      <label>
        <input type="checkbox" value="1" name="responsibilities_status[]" class="responsibilities_status" {{ $employment->responsibilities_status ? 'checked' : '' }}> Show
      </label>
    </div>
		<textarea name="responsibilities[]" class="form-control">{{ $employment->responsibilities }}</textarea>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Employment Duration <span class="text-muted">(Dates)</span></label>
		<div class="input-group">
		  <input type="text" class="form-control e_st_datepicker" name="emp_start_year[]" value="{{$employment->start_year}}" style="width: 50%;">
		  <input type="text" class="form-control e_ed_datepicker" name="emp_end_year[]" value="{{ $employment->currently_working ? 'PRESENT' : $employment->end_year }}" style="width: 50%;" style="pointer-events: {{ $employment->currently_working ? 'none' : '' }};" {{ $employment->currently_working ? 'readonly' : '' }}>
		  <span class="input-group-addon">
		    <input type="checkbox" value="1" name="emp_start_year_status[]" class="" {{ $employment->start_year_status ? 'checked' : ''}}> Show
		  </span>
		</div>
		<span class="dt-err text-red"></span>
		<div class="checkbox">
      <label>
        <input type="checkbox" value="1" name="currently_working[]" class="currently_working" {{ $employment->currently_working ? 'checked' : ''}}> This is my current position
      </label>
    </div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label style="width:100%">Position Accomplishments
			<span class="pull-right">
        <label>
          <input type="checkbox" value="1" name="accomplishments_status[]" class="accomplishments_status" {{ $employment->accomplishments_status ? 'checked' : ''}}> Show
        </label>
      </span>
		</label>
		<textarea name="accomplishments[]" class="form-control">{{ $employment->accomplishments }}</textarea>
	</div>
</div> 
<link rel="stylesheet" href="{{ asset('assets/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('assets/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> 
<script type="text/javascript">
	$('.e_st_datepicker').datepicker({
      format: 'M yyyy',
      updateViewDate: true,
      autoclose: true,
      viewMode: "months",
      minViewMode: "months",
      endDate: new Date()
    })
	$('.e_ed_datepicker').datepicker({
      format: 'M yyyy',
      updateViewDate: true,
      autoclose: true,
      viewMode: "months",
      minViewMode: "months",
      endDate: new Date()
    })
</script>  