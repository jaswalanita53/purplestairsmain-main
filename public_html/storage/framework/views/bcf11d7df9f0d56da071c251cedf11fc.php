<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('manage-subsciption')->html();
} elseif ($_instance->childHasBeenRendered('VXJoQ8W')) {
    $componentId = $_instance->getRenderedChildComponentId('VXJoQ8W');
    $componentTag = $_instance->getRenderedChildComponentTagName('VXJoQ8W');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('VXJoQ8W');
} else {
    $response = \Livewire\Livewire::mount('manage-subsciption');
    $html = $response->html();
    $_instance->logRenderedChild('VXJoQ8W', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/managesubsciption.blade.php ENDPATH**/ ?>