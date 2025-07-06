@extends('layouts.backend')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <br>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.discount') }}"><i class="fa fa-diamond"></i> Discount</a></li>
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
            <table id="employersTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Company</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Join Date</th>
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

<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<script src="{{ asset('assets/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    let table = $('#employersTable').DataTable({
      "serverSide": true,
      "ajax":{
        url :"{{ route('admin.discount.employer_list', ['id' => $discount->id]) }}",
        type: "POST",
        data: {
          '_token': '{{ csrf_token() }}',
          order_columns: ['id','name', 'email', 'date','subscribe_status', 'status', 'action'],
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
      ],
    });

    table.on('click', 'tbody tr', function () {
      let data = table.row(this).data();  
      window.location.href = '{{ url('admin/employers/view/') }}/' + data.id;
    });
</script>
@endsection
