<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('reset-password')->html();
} elseif ($_instance->childHasBeenRendered('6yy2cCN')) {
    $componentId = $_instance->getRenderedChildComponentId('6yy2cCN');
    $componentTag = $_instance->getRenderedChildComponentTagName('6yy2cCN');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('6yy2cCN');
} else {
    $response = \Livewire\Livewire::mount('reset-password');
    $html = $response->html();
    $_instance->logRenderedChild('6yy2cCN', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/resetpassword.blade.php ENDPATH**/ ?>