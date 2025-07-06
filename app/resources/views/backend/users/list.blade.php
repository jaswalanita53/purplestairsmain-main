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
        {{-- 86a2uj4hw --}}
        @if(session()->has('errors'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          {{ session()->get('errors') }}
        </div>

        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          {{ session()->get('error') }}
          <br/>
          <small>User will be redirected to their payment page with an alert message.</small>
        </div>

        @endif
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Employers </h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            {{-- task - 86a3d37f9 --}}
            <div class="row" style="margin-bottom: 10px;">
              <div class="col-xs-12 col-md-12 col-sm-12 text-right">
                <button class="btn btn-primary btn-flat" type="button" id="migrate_to_intercom">
                  Migrate To Intercom
                </button>
              </div>
            </div>
            {{-- end task - 86a3d37f9 --}}

          {{-- 86a2u6hhu --}}
          <div style="position: absolute;left: 11%;z-index:9999;">
                {{-- <span class="label label-success" style="font-size:14px;">Number of Subscribers: {{ $totalActive }}</span> --}}
                <a class="btn btn-info btn-flat filterStatusBtn @if(request('type')=="Charge_In_30_Days") active @endif" data-type="Charge_In_30_Days" href="{{ route('admin.employers') }}?type=Charge_In_30_Days">Charges in 30 Days ({{ $totalNextCharge }})</a>
                <a class="btn btn-success btn-flat filterStatusBtn @if(request('type')=="Active") active @endif"  data-type="Active" href="{{ route('admin.employers') }}?type=Active">Active {{ $totalActive }}</a>
                <a class="btn btn-warning btn-flat filterStatusBtn @if(request('type')=="Pending") active @endif" data-type="Pending" href="{{ route('admin.employers') }}?type=Pending">Pending {{ $totalPending }}</a>
                <a class="btn btn-primary btn-flat filterStatusBtn @if(request('type')=="All") active @endif" data-type="All" href="{{ route('admin.employers') }}?type=All">All {{ $totalPending+$totalActive }}</a>
            </div>
            {{-- end 86a2u6hhu --}}
            <div class="table-responsive">
                <table id="employersTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Company</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Join Date</th>
                    {{-- task - 8678fd0em --}}
                    <th>Last Match On</th>
                    <th>Last Unmask Request On</th>
                    <th>Subscribe Status</th>
                    <th>Next Charge Amount</th>
                    <th>Status</th>
                    <th style="">Action</th>
                    </tr>
                </thead>
                </table>
            </div>
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
  // task - 86a3d37f9
  $('#migrate_to_intercom').on('click', function(event) {
    $(this).prop('disabled', true);
    $(this).append(' <i class="fa fa-refresh fa-spin"></i>');
    $(this).after('<span style="color:red;"><br>Please do not refresh the page until complete the migration.</span>');
    $.ajax({
        url: '{{ route('admin.employers.migrate_intercome') }}',
        type: 'get',
        dataType: 'json',
        success: function (data) {
          console.log(data);
          $('#migrate_to_intercom').prop('disabled', false);
          $('#migrate_to_intercom').find('.fa').remove();
          $('#migrate_to_intercom').parent().find('span').remove();
        }
      });
  });
  // task - 86a3d37f9 end

  // $(function () {
    // $('#discountTable').DataTable();
    $('#employersTable').DataTable({
      "serverSide": true,
      "ajax":{
        url :"{{ route('admin.employers.data') }}?Type="+$('.filterStatusBtn.active').attr('data-type'),
        type: "POST",
        data: {
          '_token': '{{ csrf_token() }}',
          order_columns: ['id','name', 'email', 'date','subscribe_status','next_charge_amount', 'status', 'action'],
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
        { data: "company" },
        { data: "name" },
        { data: "email" },
        { data: "date" },
        { data: "last_matches_on", render: function(data, type, row, meta) {
          if(row.match_days < 7) {
            return '<span class="label label-success">'+row.last_matches_on+'</span>';
          } else {
            return '<span class="label label-danger">'+row.last_matches_on+'</span>';
          }
        } },
        { data: "last_unmask_req", render: function(data, type, row, meta) {
          if(row.request_days < 7) {
            return '<span class="label label-success">'+row.last_unmask_req+'</span>';
          } else {
            return '<span class="label label-danger">'+row.last_unmask_req+'</span>';
          }
        } },
        { data: "subscribe_status", orderable: false, render: function(data, type, row, meta) {
            console.log("sdds",row);
          if(row.subcribe_status >0) {
            return '<span class="label label-success">Subscribed</span>';
          } else{
            return '<span class="label label-danger">Not Subscribed</span>';
          }
        } },
        { data: "next_charge_amount", orderable: false, render: function(data, type, row, meta) {
            console.log('row.next_charge_amount',row.next_charge_amount)
            if(row.next_charge_amount!=""){
           return '$'+row.next_charge_amount;
           }else{
            return '-';
           }

        } },
        { data: "status", orderable: false, render: function(data, type, row, meta) {
          if(row.status == 1) {
            return '<span class="label label-success">Approved</span>';
          } if(row.status == 2) {
            return '<span class="label label-danger">Suspend</span>';
          } else {
            return '<span class="label label-warning">Pending</span>';
          }
        } },
        { data: null, orderable: false, render: function(data, type, row, meta) {
          let _actions = "";
          _actions += '<a class="btn btn-primary btn-sm" href="{{ url('admin/employers/view') }}/'+row.id+'">View</a> '; // task - 86a1hvak1
          if(row.status == 1) {
            _actions += '<a class="btn btn-danger btn-sm" href="{{ url('admin/employers/deactive') }}/'+row.id+'" style="width:64px;">Deny</a>';
          } else {
            _actions += '<a class="btn btn-success btn-sm" href="{{ url('admin/employers/active') }}/'+row.id+'" style="width:64px;">Approve</a>';
          }
           _actions +=' <a class="btn btn-danger btn-sm " href="{{ url('admin/employers/prdelete') }}/'+row.id+'" onclick="return confirm(\'Are you sure to delete this employer permanently ?\');"> <i class="fa fa-trash" aria-hidden="true"></i></a>';
          return _actions;
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
