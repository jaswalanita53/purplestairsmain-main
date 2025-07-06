<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('saved-searches')->html();
} elseif ($_instance->childHasBeenRendered('m9iijgr')) {
    $componentId = $_instance->getRenderedChildComponentId('m9iijgr');
    $componentTag = $_instance->getRenderedChildComponentTagName('m9iijgr');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('m9iijgr');
} else {
    $response = \Livewire\Livewire::mount('saved-searches');
    $html = $response->html();
    $_instance->logRenderedChild('m9iijgr', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/savedsearches.blade.php ENDPATH**/ ?>