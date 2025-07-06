<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step3')->html();
} elseif ($_instance->childHasBeenRendered('N0sCEos')) {
    $componentId = $_instance->getRenderedChildComponentId('N0sCEos');
    $componentTag = $_instance->getRenderedChildComponentTagName('N0sCEos');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('N0sCEos');
} else {
    $response = \Livewire\Livewire::mount('company-step3');
    $html = $response->html();
    $_instance->logRenderedChild('N0sCEos', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/companystep3.blade.php ENDPATH**/ ?>