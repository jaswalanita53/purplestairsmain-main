<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li> <a href="<?php echo e(URL('softSkills')); ?>">Soft Skills
      </a></li>
      <li> <a href="#">Add Soft Skills
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
            <h3 class="box-title">Soft Skills Registration</h3>
            <div style="float: right;"><a class="btn bg-navy btn-flat margin" href="<?php echo e(URL('softSkills')); ?>">
            Soft Skills
           </a></div>
           
         </div>
         <!-- /.box-header -->
         <?php echo Form::model($softSkills); ?>

         <div class="box-body">
          <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body">
             <center><p class="lead">Soft Skills Information</p></center>
             <div class="row">
               <div class="col-md-12">
                <div class="form-group">
                  <label>Title</label>
                  <?php echo Form::text('name', null, array('class'=> 'form-control', 'placeholder' => 'Enter ...')); ?>

                  <?php if($errors->has('name')): ?><em class="invalid-feedback"><?php echo $errors->first('name'); ?></em><?php endif; ?>                 
                  
                </div>
                <!-- <div class="form-group">
                  <label>Description</label>
                  <?php echo Form::textarea('description', null, array('class'=> 'form-control', 'placeholder' => 'Enter ...','rows' => '5')); ?>

                <?php if($errors->has('description')): ?><em class="invalid-feedback"><?php echo $errors->first('description'); ?></em><?php endif; ?> 
                </div> -->
                <!-- /.form-group -->              
              </div>              
              <!-- /.col -->
              <!-- <div class="col-md-6"> -->
                <!-- /.form-group -->
                <!-- <div class="form-group">
                  <label>Status</label>
                  <?php echo Form::select('status', ['1'=>'Active','0'=>'In-Active'],null, array('class'=> 'form-control','width'=>'100%')); ?>


                </div> -->
                <!-- /.form-group -->
              <!-- </div> -->
              <!-- /.col -->
              <br> <br> <br> <br>
              <a  href="<?php echo e(URL('softSkills/add')); ?>" class="btn bg-navy btn-flat margin" style="float: right;"><i class="ace-icon fa fa-undo bigger-110"></i> Cancel</a>
              <?php echo Form::submit('Save', array('class'=> 'btn bg-navy btn-flat margin', 'style' => 'float:right')); ?>

            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.box-body -->
      <?php echo Form::close(); ?>

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
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/backend/addSoftSkills.blade.php ENDPATH**/ ?>