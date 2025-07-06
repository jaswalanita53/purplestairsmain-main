<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('archived-searches')->html();
} elseif ($_instance->childHasBeenRendered('hL8mza1')) {
    $componentId = $_instance->getRenderedChildComponentId('hL8mza1');
    $componentTag = $_instance->getRenderedChildComponentTagName('hL8mza1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('hL8mza1');
} else {
    $response = \Livewire\Livewire::mount('archived-searches');
    $html = $response->html();
    $_instance->logRenderedChild('hL8mza1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/archivedsearches.blade.php ENDPATH**/ ?>