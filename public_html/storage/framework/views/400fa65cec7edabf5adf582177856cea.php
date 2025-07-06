<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="#">
      Hard Skills </a></li>

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
            <h3 class="box-title">Hard Skills</h3>
            <a href="<?php echo e(URL('hardSkills/add')); ?>" class="btn bg-navy btn-flat margin" style="float:right">Add Hard Skills</a>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <form action="<?php echo e(URL('searchHardSkills')); ?>" method="get" id="search-form" class="form-inline" role="form" style="float:right">
              <div class="form-group mx-1">
                <input type="text" class="form-control form-control-sm" name="query" placeholder="Search">
              </div>              
            </form>
            <br><br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </thead>
              <script>
                //delete function
                function delete_details() {

                  var id = $("#DelID").val();
                  $.post("hardSkills/delete", {
                      delId: id,
                      "_token": "<?php echo e(csrf_token()); ?>"
                    })
                    .done(function(data) {
                      alert("Data deleted" + data);
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
                      <p>Are you sure you want to delete this Skill ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                      <input type="hidden" id="DelID" value="<?php echo e(request()->route('id')); ?>" />
                      <a href="" class="btn btn-outline" onclick="delete_details()"><i></i>Delete</a>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <tbody>
                <?php $__currentLoopData = $skillList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skillDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($skillDetail->name); ?></td>                  
                  <td class="project-actions">
                    <a class="btn btn-info btn-sm" href="<?php echo e(URL('hardSkills/'.$skillDetail->id.'/edit')); ?>">
                      <i class="fa fa-pencil">
                      </i>
                      Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#" onclick="set_del(<?php echo e($skillDetail->id); ?>)" data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-trash-o">
                      </i>
                      Delete
                    </a>
                  </td>

                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/backend/viewHardSkills.blade.php ENDPATH**/ ?>