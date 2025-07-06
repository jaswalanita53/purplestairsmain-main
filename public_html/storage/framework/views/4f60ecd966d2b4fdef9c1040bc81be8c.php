<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('saved-searches')->html();
} elseif ($_instance->childHasBeenRendered('gdVPacA')) {
    $componentId = $_instance->getRenderedChildComponentId('gdVPacA');
    $componentTag = $_instance->getRenderedChildComponentTagName('gdVPacA');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('gdVPacA');
} else {
    $response = \Livewire\Livewire::mount('saved-searches');
    $html = $response->html();
    $_instance->logRenderedChild('gdVPacA', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/savedsearches.blade.php ENDPATH**/ ?>