<div class="row ref-row" id="reference-first-row">
	<div class="col-md-12 col-xs-12 col-lg-12 text-right remove-ref-btn" style="display: {{ $ref_key > 0 ? '' : 'none'}};">
		<button type="button" class="btn btn-danger btn-social-icon btn-sm remove-ref-row"><i class="fa fa-trash"></i></button>
	</div>
		
	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Name</label>
		<div class="input-group">
		  <input type="text" class="form-control" name="ref_name[]" value="{{ $reference->name }}">
		  <span class="input-group-addon">
		    Hidden To Everyone
		  </span>
		</div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Relationship</label>
		<div class="input-group">
		  <input type="text" class="form-control" name="ref_relationship[]" value="{{ $reference->relationship }}">
		  <span class="input-group-addon">
		    Hidden To Everyone
		  </span>
		</div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Phone</label>
		<div class="input-group">
		  <input type="text" class="form-control phone_input" name="ref_phone[]" value="{{ $reference->phone }}">
		  <span class="input-group-addon">
		    Hidden To Everyone
		  </span>
		</div>
	</div>

	<div class="col-md-6 col-xs-12 col-lg-6 form-group">
		<label>Email</label>
		<div class="input-group">
		  <input type="text" class="form-control" name="ref_email[]" value="{{ $reference->email }}">
		  <span class="input-group-addon">
		    Hidden To Everyone
		  </span>
		</div>
	</div>
</div>    