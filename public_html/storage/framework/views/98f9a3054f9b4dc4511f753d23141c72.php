<?php $__env->startSection('content'); ?>
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
        <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          <?php echo e(session()->get('success')); ?>

        </div>

        <?php endif; ?>
        <?php if(session()->has('update')): ?>
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-warning"></i> Alert!</h4>
          <?php echo e(session()->get('update')); ?>

        </div>

        <?php endif; ?>
        <?php if(session()->has('delete')): ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          <?php echo e(session()->get('delete')); ?>

        </div>

        <?php endif; ?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Employers</h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="employersTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>User Type</th>
                  <th>Join Date</th>
                  <th>Status</th>

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
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<script src="<?php echo e(asset('assets/backend/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
<script>

  // $(function () {
    // $('#discountTable').DataTable();
    $('#employersTable').DataTable({
      "serverSide": true,
      "ajax":{
        url :"<?php echo e(route('admin.abandoned.users.data')); ?>",
        type: "POST",
        data: {
          '_token': '<?php echo e(csrf_token()); ?>',
          order_columns: ['id','name', 'email','user_type', 'created_at', 'status'],
          cols: ['name', 'email'],
        },
        error: function(){
          // $("#post_list_processing").css("display","none");
        }
      },


      columns: [
        { data: "id" },
        { data: "name" },
        { data: "email" },
        { data: "user_type" },
        { data: "date" },
        { data: "status" },


      ],
    });

    $('#discountTable').DataTable().column( 0 ).visible( false );
  // });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/backend/users/abandoned-users.blade.php ENDPATH**/ ?>