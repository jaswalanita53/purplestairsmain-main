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
          Candidates </a></li>

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
            <h3 class="box-title">Candidate Deleted Accounts</h3>
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
                  <th>Deleted Date</th>
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
        url :"{{ route('admin.deleted_account_candidate.data') }}",
        type: "POST",
        data: {
          '_token': '{{ csrf_token() }}',
          order_columns: ['id','name', 'email', 'date', 'status', 'action'],
          cols: ['name', 'email'],
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
        { data: "role" },
        { data: "date" },
        { data: "del_date" },
      ],
    });

    $('#discountTable').DataTable().column( 0 ).visible( false );
  // });
</script>
@endsection
