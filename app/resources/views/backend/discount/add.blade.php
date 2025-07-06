@extends('layouts.backend')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/iCheck/all.css') }}">
<script src="{{ asset('assets/backend/plugins/iCheck/icheck.min.js') }}"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li> <a href="{{ route('admin.discount') }}">Discounts
      </a></li>
      <li> <a href="#">Add Discount
      </a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Discounts Registration</h3>
            <div style="float: right;">
              <a class="btn bg-navy btn-flat margin" href="{{ route('admin.discount') }}">Discounts</a>
            </div>           
          </div>

          <!-- /.box-header -->
          {!! Form::open(['method' => 'post', 'id' => 'discount_frm', 'route' => 'admin.discount.store']) !!}
          <div class="box-body">

            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group {{ ($errors->has('coupon_code')) ? 'has-error' : ''}}">
                  <label>Coupon Code <span class="text-red">*</span></label>
                  {!! Form::text('coupon_code', old('coupon_code'), array('class'=> 'form-control', 'placeholder' => 'Enter Coupon Code'))!!}

                  @if ($errors->has('coupon_code'))
                    <span class="help-block">{!!$errors->first('coupon_code')!!}</span>
                  @endif                 
                </div>
              </div>              
                  <!-- /.col -->
              <div class="col-md-6 col-sm-6">
                <!-- /.form-group -->
                <div class="form-group {{ ($errors->has('status')) ? 'has-error' : ''}}">
                  <label>Status</label>
                  {!! Form::select('status', ['1'=>'Active','0'=>'In-Active'], old('status'), array('class'=> 'form-control','width'=>'100%'))!!}

                  @if ($errors->has('status'))
                    <span class="help-block">{!!$errors->first('status')!!}</span>
                  @endif
                </div>
                <!-- /.form-group -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 col-sm-6 form-group">
                <label>Discount Type</label>

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <input type="radio" name="discount_type" id="r_per" checked="" value="percentage">
                    Percentage
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <input type="radio" name="discount_type" id="r_fix" value="fixed">
                    Fixed
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 form-group {{ ($errors->has('discount_value')) ? 'has-error' : ''}}">
                <label>Discount Value <span class="text-red">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <span class="input-group-text" id='dollar' style="display:none">$</span>
                    <span class="input-group-text" id='percentage'>%</span>
                  </div>
                  <input type="text" class="form-control" value="{{ old('discount_value') }}" name="discount_value" placeholder="Discount Value">
                  <div class="input-group-addon">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>

                @if ($errors->has('discount_value'))
                  <span class="help-block">{!!$errors->first('discount_value')!!}</span>
                @endif
              </div>

              <div class="col-md-6 col-sm-6">
                <div class="form-group {{ ($errors->has('validity')) ? 'has-error' : ''}}">
                  <label>Validity <span class="text-red">*</span></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" value="{{ old('validity') }}" class="form-control float-right" id="reservation" name="validity">
                  </div>

                  @if ($errors->has('validity'))
                    <span class="help-block">{!!$errors->first('validity')!!}</span>
                  @endif
                </div>
              </div>

              <div class="col-md-6 col-sm-6"></div>

              <div class="col-md-6 col-sm-6">
                <div class="row">
                  <div class="col-md-3 col-sm-6">
                    <div class="form-group" style="line-height: 5;">
                      One Time Use
                      <input type="checkbox" class="" name="one_time_used" checked="" value="1">
                    </div>
                  </div>
                  <div class="col-md-9 col-sm-6">
                    <div class="form-group {{ ($errors->has('use_limit')) ? 'has-error' : ''}}">
                      <label>Set Limit</label>
                      <input type="text" name="use_limit" class="form-control" id="use_limit" disabled placeholder="Set usage limit" value="{{ old('use_limit') }}">
                      <p class="help-block" style="display: none;"><i class="fa fa-bell-o"></i> Leave this field blank if you have to set no limit to use this coupon code.</p>

                      @if ($errors->has('use_limit'))
                        <span class="help-block">{!!$errors->first('use_limit')!!}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group {{ ($errors->has('discount_duration')) ? 'has-error' : ''}}">
                  <label>Discount Duration <small class="text-muted"> (Months)<small></label>
                  {!! Form::number('discount_duration', old('discount_duration'), array('class'=> 'form-control', 'placeholder' => 'Enter Number of months'))!!}

                  @if ($errors->has('discount_duration'))
                    <span class="help-block">{!!$errors->first('discount_duration')!!}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <a  href="{{ route('admin.discount.add') }}" class="btn bg-navy btn-flat margin" style="float: right;"><i class="ace-icon fa fa-undo bigger-110"></i> Cancel</a>
                  {!! Form::submit('Save', array('class'=> 'btn bg-navy btn-flat margin', 'style' => 'float:right'))!!}
                </div>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  $('input[name=discount_type]').change(function(event) {
    let _V = $('input[name=discount_type]:checked').val();
    if(_V == "percentage") {
      $('#percentage').show();
      $('#dollar').hide();
    } else if(_V == "fixed") {
      $('#percentage').hide();
      $('#dollar').show();
    }
  });

  $('input[name=one_time_used]').change(function(event) {
    console.log($('#use_limit').closest('form-group'), $('#use_limit').closest('form-group').find('p.help-block'));
    if($(this).prop('checked')) {
      $('#use_limit').prop('disabled', true);
      $('p.help-block').hide();
    } else {
      $('#use_limit').prop('disabled', false);
      $('p.help-block').show();
    }
  });
</script>
@endsection