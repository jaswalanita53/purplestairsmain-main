<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-dashboard')->html();
} elseif ($_instance->childHasBeenRendered('f5TTbVU')) {
    $componentId = $_instance->getRenderedChildComponentId('f5TTbVU');
    $componentTag = $_instance->getRenderedChildComponentTagName('f5TTbVU');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('f5TTbVU');
} else {
    $response = \Livewire\Livewire::mount('company-dashboard');
    $html = $response->html();
    $_instance->logRenderedChild('f5TTbVU', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/companydashboard.blade.php ENDPATH**/ ?>