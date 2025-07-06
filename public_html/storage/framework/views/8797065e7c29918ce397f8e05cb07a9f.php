<?php $__errorArgs = [$field_name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<div class="text-danger error" style="<?php echo e(isset($style) ? $style : ''); ?>">
   <?php echo e($message); ?>

</div>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<?php /**PATH /var/www/html/app/resources/views/inc/error.blade.php ENDPATH**/ ?>