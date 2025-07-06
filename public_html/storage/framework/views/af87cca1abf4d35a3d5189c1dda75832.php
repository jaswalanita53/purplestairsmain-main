<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step5')->html();
} elseif ($_instance->childHasBeenRendered('CLlACdf')) {
    $componentId = $_instance->getRenderedChildComponentId('CLlACdf');
    $componentTag = $_instance->getRenderedChildComponentTagName('CLlACdf');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('CLlACdf');
} else {
    $response = \Livewire\Livewire::mount('company-step5');
    $html = $response->html();
    $_instance->logRenderedChild('CLlACdf', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/companystep5.blade.php ENDPATH**/ ?>