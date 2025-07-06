@extends('layouts.backend')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="#">
      zip-codes  </a></li>

    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <!-- /.box -->
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          {{ session()->get('success') }}
        </div>

        @endif
        @if(session()->has('update'))
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-warning"></i> Alert!</h4>
          {{ session()->get('update') }}
        </div>

        @endif
        @if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          {{ session()->get('delete') }}
        </div>

        @endif
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Zip Codes</h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Sr. No</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <script>
                //delete function
                function delete_details() {

                  var id = $("#DelID").val();

                  $.post("zipcode/delete", {
                      delId: id,
                      "_token": "{{ csrf_token() }}"
                    })
                    .done(function(data) {
                      alert("Data deleted" + data.message);
                      location.reload();

                    });
                }

                function set_del(delid) {
                  $("#DelID").val(delid);
                }
              </script>
              <div class="modal modal-danger" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Warning !</h4>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to delete this Zip Code ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                      <input type="hidden" id="DelID" value="{{request()->route('id')}}" />
                      <a href="javascript:void(0)" class="btn btn-outline" onclick="delete_details()"><i></i>Delete</a>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <tbody>
              @php
              $srn=1;
              @endphp
                @foreach ($zipcodes as $zipcode)
                <tr>
                  <td>{{ $srn }}</td>
                  <td>{{ $zipcode->zip_code }}</td>
                  <td>
                   <span class="label label-success">Active</span>

                  </td>
                  <td class="project-actions">
                    <a class="btn btn-danger btn-sm" href="#" onclick="set_del({{ $zipcode->id }})" data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-trash-o">
                      </i>
                      Delete
                    </a>
                  </td>

                </tr>
                @php
                    $srn++;
                @endphp
                @endforeach

              </tbody>

            </table>
          </div>
          <!-- /.box-body -->
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
