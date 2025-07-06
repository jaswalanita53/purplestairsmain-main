<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step5')->html();
} elseif ($_instance->childHasBeenRendered('y5QzftA')) {
    $componentId = $_instance->getRenderedChildComponentId('y5QzftA');
    $componentTag = $_instance->getRenderedChildComponentTagName('y5QzftA');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('y5QzftA');
} else {
    $response = \Livewire\Livewire::mount('company-step5');
    $html = $response->html();
    $_instance->logRenderedChild('y5QzftA', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/companystep5.blade.php ENDPATH**/ ?>