<div class="row edu-row" id="edu-first-row">
	<div class="col-md-12 col-xs-12 col-lg-12 text-right remove-edu-btn" style="display: none;">
		<button type="button" class="btn btn-danger btn-social-icon btn-sm remove-edu-row"><i class="fa fa-trash"></i></button>
	</div>
		
	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>School/Organization Name <span class="text-muted">(Ex. Touro)</span></label>
		<div class="input-group">
		  <input type="text" class="form-control" name="organization_name[]">
		  <span class="input-group-addon">
		    <input type="checkbox" value="1" name="organization_name_status[]" checked> Show
		  </span>
		</div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Course/Program Name <span class="text-muted">(Ex. Accounting, BA)</span></label>
		<div class="input-group">
		  <input type="text" class="form-control" name="program_name[]">
		  <span class="input-group-addon">
		    <input type="checkbox" value="1" name="program_name_status[]" checked> Show
		  </span>
		</div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Program Duration <span class="text-muted">(Dates)</span></label>
		<div class="input-group">
		  <input type="text" class="form-control st_datepicker" name="start_year[]" style="width: 50%;">
		  <input type="text" class="form-control ed_datepicker" name="end_year[]" style="width: 50%;">
		  <span class="input-group-addon">
		    <input type="checkbox" value="1" name="start_year_status[]" checked> Show
		  </span>
		</div>
    <span class="dt-err text-red"></span>
		<div class="checkbox">
      <label>
        <input type="checkbox" value="1" name="currently_studying[]" class="currently_studying"> I am currently studying here
      </label>
    </div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label style="width: 100%">Course Description
			<span class="pull-right">
        <label>
          <input type="checkbox" value="1" name="course_description_status[]" class="course_description_status" checked> Show
        </label>
      </span>
		</label>
		<textarea name="course_description[]" class="form-control"></textarea>
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
    })
	$('.ed_datepicker').datepicker({
      format: 'M yyyy',
      updateViewDate: true,
      autoclose: true,
      viewMode: "months",
      minViewMode: "months",
      endDate: new Date()
    })
</script>