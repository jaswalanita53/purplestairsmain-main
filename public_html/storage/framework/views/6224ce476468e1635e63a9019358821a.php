<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('delete-account')->html();
} elseif ($_instance->childHasBeenRendered('kyeW3ao')) {
    $componentId = $_instance->getRenderedChildComponentId('kyeW3ao');
    $componentTag = $_instance->getRenderedChildComponentTagName('kyeW3ao');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kyeW3ao');
} else {
    $response = \Livewire\Livewire::mount('delete-account');
    $html = $response->html();
    $_instance->logRenderedChild('kyeW3ao', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/deleteaccount.blade.php ENDPATH**/ ?>