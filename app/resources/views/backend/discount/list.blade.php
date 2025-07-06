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
          Discounts </a></li>

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
            <h3 class="box-title">Discounts</h3>
            <a href="{{ route('admin.discount.add') }}" class="btn bg-navy btn-flat margin" style="float:right">Add Discounts</a>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            {{-- <form action="{{ route('admin.discount') }}" method="get" id="search-form" class="form-inline" role="form" style="float:right">
              <div class="form-group mx-1">
                <input type="text" class="form-control form-control-sm" name="query" placeholder="Search">
              </div>              
            </form>
            <br><br> --}}
            <table id="discountTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Coupon Code</th>
                  <th>Discount</th>
                  <th>Validity</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              
              {{-- <tbody>
                @foreach ($discounts as $disconut)
                <tr>
                  <td>{{ $disconut->id }}</td>
                  <td>{{ $disconut->coupon_code }}</td>
                  <td>{{ $disconut->discount_value }}{{ $disconut->type == 'fixed' ? '($)' : '(%)' }}</td>
                  <td>{{ date('m-d-Y', strtotime($disconut->validate_from)) . ' - ' . date('m-d-Y', strtotime($disconut->validate_to)) }}</td>
                  <td>
                    @if($disconut->status == 1)
                    <span class="label label-success">Active</span>
                    @else
                    <span class="label label-warning">In-Active</span>
                    @endif
                  </td>
                  <td class="project-actions">
                    <a class="btn btn-info btn-sm" href="{{ route('admin.discount.edit',['id' => $disconut->id])}}">
                      <i class="fa fa-pencil">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#" onclick="set_del({{ $disconut->id }})" data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-trash-o">
                      </i>
                      Delete
                    </a>
                  </td>

                </tr>
                @endforeach
                @if(empty($discounts->toArray()))
                <tr>
                	<td colspan="5" align="center"> No data found. </td>
                </tr>
                @endif
              </tbody> --}}

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
<div class="modal modal-danger" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Warning !</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this Discount ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <input type="hidden" id="DelID" value="{{request()->route('id')}}" />
        <a href="javascript:;" class="btn btn-outline" onclick="delete_details()"><i></i>Delete</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
    $('#discountTable').DataTable({
      "serverSide": true,
      "ajax":{
        url :"{{ route('admin.discount.data') }}",
        type: "POST",
        data: { 
          '_token': '{{ csrf_token() }}',
          order_columns: ['id','coupon_code', 'discount', 'validity', 'status', 'action'], 
          cols: ['coupon_code'], 
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
        { data: "coupon_name" },
        { data: "discount" },
        { data: "validity", orderable: false },
        { data: "status", orderable: false, render: function(data, type, row, meta) {
          if(row.status == 1) {
            return '<span class="label label-success">Active</span>';
          } else if(row.status == 2) {
            return '<span class="label label-primary">Completed</span>';
          } else if(row.status == 3) {
            return '<span class="label label-warning">Scheduled</span>';
          } else {
            return '<span class="label label-danger">In-Active</span>';
          }
        } },
        { data: null, orderable: false, render: function(data, type, row, meta) { 
          let template = "";

          // task - 86a3b0p32
          template += '<a class="btn btn-info btn-sm" href="{{ url('admin/discount/details/') }}/'+row.id+'">' + 
              '<i class="fa fa-eye"></i></a> &nbsp;';
              
          if(row.status != 2) {
            template += '<a class="btn btn-info btn-sm" href="{{ url('admin/discount/edit/') }}/'+row.id+'">'+
            '<i class="fa fa-pencil"></i> Edit</a> &nbsp;';
          }
          template += '<a class="btn btn-danger btn-sm" href="javascript:;" onclick="set_del('+row.id+')" data-toggle="modal" data-target="#myModal">' + 
              '<i class="fa fa-trash-o"></i> Delete</a>';
          return template;
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