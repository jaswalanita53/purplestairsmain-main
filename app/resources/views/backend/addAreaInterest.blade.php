@extends('layouts.backend')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="{{ URL('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li> <a href="{{ URL('areaInterest') }}">AreaInterest
      </a></li>
      <li> <a href="#">Add AreaInterest
      </a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <!-- /.box -->

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">AreaInterest Registration</h3>
            <div style="float: right;"><a class="btn bg-navy btn-flat margin" href="{{ URL('areaInterest') }}">
            AreaInterest
           </a></div>
           
         </div>
         <!-- /.box-header -->
         {!! Form::model($areaInterest)!!}
         <div class="box-body">
          <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body">
             <center><p class="lead">AreaInterest Information</p></center>
             <div class="row">
               <div class="col-md-6">
                <div class="form-group">
                  <label>Title</label>
                  {!! Form::text('name', null, array('class'=> 'form-control', 'placeholder' => 'Enter ...'))!!}
                  @if ($errors->has('name'))<em class="invalid-feedback">{!!$errors->first('name')!!}</em>@endif                 
                  
                </div>
                <!-- <div class="form-group">
                  <label>Description</label>
                  {!! Form::textarea('description', null, array('class'=> 'form-control', 'placeholder' => 'Enter ...','rows' => '5'))!!}
                @if ($errors->has('description'))<em class="invalid-feedback">{!!$errors->first('description')!!}</em>@endif 
                </div> -->
                <!-- /.form-group -->              
              </div>              
              <!-- /.col -->
              <div class="col-md-6">
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Status</label>
                  {!! Form::select('status', ['1'=>'Active','0'=>'In-Active'],null, array('class'=> 'form-control','width'=>'100%'))!!}

                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <br> <br> <br> <br>
              <a  href="{{ URL('areaInterest/add') }}" class="btn bg-navy btn-flat margin" style="float: right;"><i class="ace-icon fa fa-undo bigger-110"></i> Cancel</a>
              {!! Form::submit('Save', array('class'=> 'btn bg-navy btn-flat margin', 'style' => 'float:right'))!!}
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
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
@endsection