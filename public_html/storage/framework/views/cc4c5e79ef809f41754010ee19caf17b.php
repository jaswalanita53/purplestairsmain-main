<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('archived-searches')->html();
} elseif ($_instance->childHasBeenRendered('xNAl9Pv')) {
    $componentId = $_instance->getRenderedChildComponentId('xNAl9Pv');
    $componentTag = $_instance->getRenderedChildComponentTagName('xNAl9Pv');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('xNAl9Pv');
} else {
    $response = \Livewire\Livewire::mount('archived-searches');
    $html = $response->html();
    $_instance->logRenderedChild('xNAl9Pv', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/archivedsearches.blade.php ENDPATH**/ ?>