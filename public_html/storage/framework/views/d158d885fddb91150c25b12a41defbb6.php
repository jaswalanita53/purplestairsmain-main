<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('requested-list')->html();
} elseif ($_instance->childHasBeenRendered('PV6FwCU')) {
    $componentId = $_instance->getRenderedChildComponentId('PV6FwCU');
    $componentTag = $_instance->getRenderedChildComponentTagName('PV6FwCU');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('PV6FwCU');
} else {
    $response = \Livewire\Livewire::mount('requested-list');
    $html = $response->html();
    $_instance->logRenderedChild('PV6FwCU', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/requested_list.blade.php ENDPATH**/ ?>