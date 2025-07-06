@extends('layouts.backend')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="#"> Candidates </a></li>

    </ol>
  </section>
    <style>
        th .tooltip .tooltip-inner {
        width: 419px;
        min-width: 500px;
    }
    .count-icon{
        font-size:18px;
    }
    .uploaded_status .tooltip .tooltip-inner {
        width: 419px;
        min-width: unset;
    }
    </style>
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
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          {{ session()->get('error') }}
        </div>

        @endif
        <style>
        .filterStatusBtn.active {
                border: 2px solid #0e0b03;
                font-size: 15px;
            }
        </style>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Candidates</h3>
            {{-- task - 86a1m4ymb --}}
            <a href="#" class="btn btn-success btn-flat margin" style="float:right;" data-toggle="modal" data-target="#importModal">Import from CSV</a>

            {{-- <a href="{{ route('admin.candidates.import') }}" class="btn btn-success btn-flat margin" style="float:right;">Import from CSV</a> --}}
            <a href="{{ route('admin.candidates.exportCSV') }}" class="btn btn-primary btn-flat margin" style="float:right;">Export to CSV</a>
            <a href="{{ route('admin.candidates.add') }}" class="btn bg-navy btn-flat margin" style="float:right">Create Candidate</a>
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

            <div style="position: absolute;left: 11%;z-index:99;">
                <a class="btn btn-success btn-flat filterStatusBtn @if(request('type')=="Active") active @endif"  data-type="Active" href="{{ route('admin.candidates') }}?type=Active">Active {{ $totalActive }}</a>
                <a class="btn btn-warning btn-flat filterStatusBtn @if(request('type')=="Pending") active @endif" data-type="Pending" href="{{ route('admin.candidates') }}?type=Pending">Pending {{ $totalPending }}</a>
                <a class="btn btn-primary btn-flat filterStatusBtn @if(request('type')=="All") active @endif" data-type="All" href="{{ route('admin.candidates') }}?type=All">All {{ $totalPending+$totalActive }}</a>
            </div>

            <table id="candidatesTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Experience</th>
                  <th>Join Date</th>
                  {{-- task - 86a2kkdyc --}}
                  <th>Status Changed Date</th>
                  <th>Status</th>
                  <th> <i class="fa fa-list-ol count-icon" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" data-html="true"  data-placement="bottom" title='<ul style="list-style-type:none;padding:0;text-align:left;">
                    <li> 0) Name & email</li>
                    <li> 1) Personal info</li>
                    <li> 2) Personal info, Preferences</li>
                    <li> 3) Personal info, Preferences, Education <sup style="color:yellow; ">(filled/skipped)</sup></li>
                    <li> 4) Personal info, Preferences, Education<sup style="color:yellow; ">(filled/skipped)</sup>, Employment<sup style="color:yellow; ">(filled/skipped)</sup></li>
                    <li> 5) Personal info, Preferences, Education<sup style="color:yellow; ">(filled/skipped)</sup> , Employment<sup style="color:yellow; ">(filled/skipped)</sup>, Skills</li>
                    <li> 6) Personal info, Preferences, Education<sup style="color:yellow; ">(filled/skipped)</sup> , Employment<sup style="color:yellow; ">(filled/skipped)</sup>, Skills, references</li>
                    <li>   7) Personal info, Preferences, Education<sup style="color:yellow; ">(filled/skipped)</sup> , Employment<sup style="color:yellow; ">(filled/skipped)</sup>, Skills, references, Image & About<sup style="color:yellow; ">(filled/skipped)</sup></li>
                    </ul>'></i></th>
                  <th>Action</th>
                  <th class="uploaded_status"><i class="fa fa-file-o" aria-hidden="true" data-toggle="tooltip" data-placement="bottom"  data-placement="bottom" title='Resume uploaded'></i></th>
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

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Import CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add your CSV import form or content here -->
        <form action="{{ route('admin.candidates.import') }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="form-group ">
            <input type="file" name="csv_file" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Import CSV</button>
        </form>
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
          url: '{{ route('admin.candidates.migrate_intercome') }}',
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
    
    var ajaxData = {
        '_token': '{{ csrf_token() }}',
        'order_columns': ['id', 'name', 'email', 'date', 'status','step_reached', 'action','resume_uploaded'],
        'cols': ['name', 'email'],
        'status': ""
    };
    function initializeDataTable(statusFilter) {
        ajaxData = {
            '_token': '{{ csrf_token() }}',
            'order_columns': ['id', 'name', 'email', 'date', 'status','step_reached', 'action','resume_uploaded'],
            'cols': ['name', 'email'],
            'status': statusFilter
        };

    }

    $('#candidatesTable').DataTable({
      "serverSide": true,
      "ajax":{
        url :"{{ route('admin.candidates.data') }}?Type="+$('.filterStatusBtn.active').attr('data-type'),
        type: "POST",
        data: ajaxData,
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
        { data: "experiance", orderable: false, }, // task - 86a2ae1kx
        { data: "date" },
        { data: "approved_date" }, // task - 86a2kkdyc
        { data: "status", orderable: false, render: function(data, type, row, meta) {
          if(row.status == 1) {
            return '<span class="label label-success">Active</span>';
          } if(row.status == 2) {
            return '<span class="label label-danger">Suspend</span>';
          } else {
            return '<span class="label label-warning">Pending</span>';
          }
        } },
        { data: "step_reached",className: 'text-center', render: function(data, type, row, meta) {
                 {{-- if(row.step==1){
                    return 1;
                }else if(row.step <= 2 && row.step >=1){
                    return 2;
                }
                else if (row.step<= 4 && row.step>= 2) {
                    return  3;
                } else if (row.step<6 && row.step>= 4 ) {
                    return  4;
                } else if (row.step >= 6) {
                    return 5;
                }else{
                    return 0;
                }; --}}
               return row.step;
        } },
        { data: null, orderable: false, render: function(data, type, row, meta) {
          return '<a class="btn btn-warning btn-sm" href="{{ url('admin/candidates/edit') }}/'+row.id+'">Edit</a> <a class="btn btn-primary btn-sm" href="{{ url('admin/candidates/view') }}/'+row.id+'">View</a> <a class="btn bg-black-active btn-sm" href="{{ url('admin/candidate/download-hidden-cv') }}/'+row.id+'"><i class="fa fa-download" aria-hidden="true"></i> Hiden Resume</a> <a class="btn btn-warning btn-sm" href="{{ url('admin/candidate/download-cv') }}/'+row.id+'"><i class="fa fa-download" aria-hidden="true"></i> Resume</a> <a class="btn btn-danger btn-sm" href="{{ url('admin/candidates/delete') }}/'+row.id+'" onclick="return confirm(\'Are you sure to delete this candidate ?\');">Delete</a> <a class="btn btn-danger btn-sm" href="{{ url('admin/candidates/prdelete') }}/'+row.id+'" onclick="return confirm(\'Are you sure to delete this candidate permanently ?\');">Delete Permanently</a>';
        } },{ data: "resume_uploaded", className: 'text-center', render: function(data, type, row, meta) {
          if(row.resume_uploaded == '1') {
            return '<i class="fa fa-check text-success" aria-hidden="true"></i>';
          } else {
            return '-';
          }
        } },
      ],
    });
    let dataTable = $('#candidatesTable').DataTable();
    $(document).on("click", ".viewTotalActive", function() {
        currentStatusFilter = 1;
         if (dataTable) {
            dataTable.destroy();
        }
        initializeDataTable(currentStatusFilter);
        dataTable.ajax.reload();
    });


    $('#candidatesTable').DataTable().search( 0 ).visible( false );
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
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endsection
