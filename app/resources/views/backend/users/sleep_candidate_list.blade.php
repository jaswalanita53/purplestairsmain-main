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
          Employers </a></li>

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
            <h3 class="box-title">Candidate Sleep Accounts</h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="employersTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>User Role</th>
                  <th>Join Date</th>
                  {{-- <th>Status</th> --}}
                  <th>Action</th>
                </tr>
              </thead>
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

<div class="modal modal-success fade" id="modal-success">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Discount Deleted.</h4>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-warning fade" id="modal-warning">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Discount Not Found.</h4>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<script src="{{ asset('assets/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>

  // $(function () {
    // $('#discountTable').DataTable();
    $('#employersTable').DataTable({
      "serverSide": true,
      "ajax":{
        url :"{{ route('admin.sleep_account_candidate.data') }}",
        type: "POST",
        data: {
          '_token': '{{ csrf_token() }}',
          order_columns: ['id','name', 'email', 'user_type', 'date', 'status', 'action'],
          cols: ['name', 'email', 'user_type'],
        },
        error: function(){
          // $("#post_list_processing").css("display","none");
        }
      },
      "aLengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      order: [[0, 'desc']],
      "iDisplayLength": 25,
      "language": {
        search: "",
        searchPlaceholder: "Search..."
      },
      columns: [
        { data: "id" },
        { data: "name" },
        { data: "email" },
        { data: "user_type" },
        { data: "date" },
        /*{ data: "status", orderable: false, render: function(data, type, row, meta) {
          if(row.status == 1) {
            return '<span class="label label-success">Approved</span>';
          } if(row.status == 2) {
            return '<span class="label label-danger">Suspend</span>';
          } else {
            return '<span class="label label-warning">Pending</span>';
          }
        } },*/
        { data: null, orderable: false, render: function(data, type, row, meta) {
            return '<a class="btn btn-success btn-sm" href="{{ url('admin/sleep_account/activate') }}/'+row.id+'">Activate</a>';
        } },
      ],
    });

    $('#discountTable').DataTable().column( 0 ).visible( false );
  // });

  //delete function
  function delete_details() {

    var id = $("#DelID").val();
    $.get("discount/delete/" + id)
    .done(function(data) {
      $('#myModal').modal('hide');
      if(data) {
        $('#modal-success').modal('show');
      } else {
        $('#modal-warning').modal('show')
      }
    });
  }

  function set_del(delid) {
    $("#DelID").val(delid);
  }
</script>
@endsection
