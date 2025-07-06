<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('manage-subsciption')->html();
} elseif ($_instance->childHasBeenRendered('fJZIxG2')) {
    $componentId = $_instance->getRenderedChildComponentId('fJZIxG2');
    $componentTag = $_instance->getRenderedChildComponentTagName('fJZIxG2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('fJZIxG2');
} else {
    $response = \Livewire\Livewire::mount('manage-subsciption');
    $html = $response->html();
    $_instance->logRenderedChild('fJZIxG2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/managesubsciption.blade.php ENDPATH**/ ?>