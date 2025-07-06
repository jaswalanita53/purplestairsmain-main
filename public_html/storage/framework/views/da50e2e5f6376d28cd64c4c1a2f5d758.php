<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/plugins/iCheck/all.css')); ?>">
<script src="<?php echo e(asset('assets/backend/plugins/iCheck/icheck.min.js')); ?>"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <br>

    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li> <a href="<?php echo e(route('admin.discount')); ?>">Discounts
      </a></li>
      <li> <a href="#">Add Discount
      </a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Discounts Registration</h3>
            <div style="float: right;">
              <a class="btn bg-navy btn-flat margin" href="<?php echo e(route('admin.discount')); ?>">Discounts</a>
            </div>           
          </div>

          <!-- /.box-header -->
          <?php echo Form::open(['method' => 'post', 'id' => 'discount_frm', 'route' => ['admin.discount.update', $discount->id]]); ?>

          <div class="box-body">

            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group <?php echo e(($errors->has('coupon_code')) ? 'has-error' : ''); ?>">
                  <label>Coupon Code <span class="text-red">*</span></label>
                  <?php echo Form::text('coupon_code', old('coupon_code', $discount->coupon_code), array('class'=> 'form-control', 'placeholder' => 'Enter Coupon Code')); ?>


                  <?php if($errors->has('coupon_code')): ?>
                    <span class="help-block"><?php echo $errors->first('coupon_code'); ?></span>
                  <?php endif; ?>                 
                </div>
              </div>              
                  <!-- /.col -->
              <div class="col-md-6 col-sm-6">
                <!-- /.form-group -->
                <div class="form-group <?php echo e(($errors->has('status')) ? 'has-error' : ''); ?>">
                  <label>Status</label>
                  <?php echo Form::select('status', ['1'=>'Active','0'=>'In-Active'], old('status', $discount->status), array('class'=> 'form-control','width'=>'100%')); ?>


                  <?php if($errors->has('status')): ?>
                    <span class="help-block"><?php echo $errors->first('status'); ?></span>
                  <?php endif; ?>
                </div>
                <!-- /.form-group -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 col-sm-6 form-group">
                <label>Discount Type</label>

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <input type="radio" name="discount_type" id="r_per" <?php echo e($discount->type == 'percentage' ? 'checked' : ''); ?> value="percentage">
                    Percentage
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <input type="radio" name="discount_type" id="r_fix" <?php echo e($discount->type == 'fixed' ? 'checked' : ''); ?> value="fixed">
                    Fixed
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 form-group <?php echo e(($errors->has('discount_value')) ? 'has-error' : ''); ?>">
                <label>Discount Value <span class="text-red">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <span class="input-group-text" id='dollar' style="display:none">$</span>
                    <span class="input-group-text" id='percentage'>%</span>
                  </div>
                  <input type="text" class="form-control" value="<?php echo e(old('discount_value', $discount->discount_value)); ?>" name="discount_value" placeholder="Discount Value">
                  <div class="input-group-addon">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>

                <?php if($errors->has('discount_value')): ?>
                  <span class="help-block"><?php echo $errors->first('discount_value'); ?></span>
                <?php endif; ?>
              </div>

              <div class="col-md-6 col-sm-6">
                <div class="form-group <?php echo e(($errors->has('validity')) ? 'has-error' : ''); ?>">
                  <label>Validity <span class="text-red">*</span></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <?php
                      $validity = date('m/d/Y', strtotime($discount->validate_from)) . ' - ' . date('m/d/Y', strtotime($discount->validate_to));
                    ?>
                    <input type="text" value="<?php echo e(old('validity', $validity)); ?>" class="form-control float-right" id="reservation" name="validity">
                  </div>

                  <?php if($errors->has('validity')): ?>
                    <span class="help-block"><?php echo $errors->first('validity'); ?></span>
                  <?php endif; ?>
                </div>
              </div>

              <div class="col-md-6 col-sm-6"></div>

              <div class="col-md-6 col-sm-6">
                <div class="row">
                  <div class="col-md-3 col-sm-6">
                    <div class="form-group" style="line-height: 5;">
                      One Time Use
                      <input type="checkbox" class="" name="one_time_used" <?php echo e($discount->one_time_only == '1' ? 'checked' : ''); ?> value="1">
                    </div>
                  </div>
                  <div class="col-md-9 col-sm-6">
                    <div class="form-group <?php echo e(($errors->has('use_limit')) ? 'has-error' : ''); ?>">
                      <label>Set Limit</label>
                      <input type="text" name="use_limit" class="form-control" id="use_limit" disabled placeholder="Set usage limit" value="<?php echo e(old('use_limit', ($discount->one_time_only != '1' && $discount->maximum_allow) ? $discount->maximum_allow : '')); ?>">
                      <p class="help-block" style="display: none;"><i class="fa fa-bell-o"></i> Leave this field blank if you have to set no limit to use this coupon code.</p>

                      <?php if($errors->has('use_limit')): ?>
                        <span class="help-block"><?php echo $errors->first('use_limit'); ?></span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <a  href="<?php echo e(route('admin.discount.add')); ?>" class="btn bg-navy btn-flat margin" style="float: right;"><i class="ace-icon fa fa-undo bigger-110"></i> Cancel</a>
                  <?php echo Form::submit('Save', array('class'=> 'btn bg-navy btn-flat margin', 'style' => 'float:right')); ?>

                </div>
              </div>
            </div>
          </div>
          <?php echo Form::close(); ?>

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  $('input[name=discount_type]').change(function(event) {
    let _V = $('input[name=discount_type]:checked').val();
    if(_V == "percentage") {
      $('#percentage').show();
      $('#dollar').hide();
    } else if(_V == "fixed") {
      $('#percentage').hide();
      $('#dollar').show();
    }
  }).trigger('change');

  $('input[name=one_time_used]').change(function(event) {
    console.log($('#use_limit').closest('form-group'), $('#use_limit').closest('form-group').find('p.help-block'));
    if($(this).prop('checked')) {
      $('#use_limit').prop('disabled', true);
      $('p.help-block').hide();
    } else {
      $('#use_limit').prop('disabled', false);
      $('p.help-block').show();
    }
  }).trigger('change');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/backend/discount/edit.blade.php ENDPATH**/ ?>