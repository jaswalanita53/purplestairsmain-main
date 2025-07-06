<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('delete-account')->html();
} elseif ($_instance->childHasBeenRendered('gIUW2Je')) {
    $componentId = $_instance->getRenderedChildComponentId('gIUW2Je');
    $componentTag = $_instance->getRenderedChildComponentTagName('gIUW2Je');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('gIUW2Je');
} else {
    $response = \Livewire\Livewire::mount('delete-account');
    $html = $response->html();
    $_instance->logRenderedChild('gIUW2Je', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/deleteaccount.blade.php ENDPATH**/ ?>