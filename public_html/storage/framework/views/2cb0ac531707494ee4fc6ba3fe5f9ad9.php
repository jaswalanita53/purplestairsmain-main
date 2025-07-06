<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step3')->html();
} elseif ($_instance->childHasBeenRendered('xQk4zuZ')) {
    $componentId = $_instance->getRenderedChildComponentId('xQk4zuZ');
    $componentTag = $_instance->getRenderedChildComponentTagName('xQk4zuZ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('xQk4zuZ');
} else {
    $response = \Livewire\Livewire::mount('company-step3');
    $html = $response->html();
    $_instance->logRenderedChild('xQk4zuZ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/companystep3.blade.php ENDPATH**/ ?>