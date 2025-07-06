<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step4')->html();
} elseif ($_instance->childHasBeenRendered('atrJHzI')) {
    $componentId = $_instance->getRenderedChildComponentId('atrJHzI');
    $componentTag = $_instance->getRenderedChildComponentTagName('atrJHzI');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('atrJHzI');
} else {
    $response = \Livewire\Livewire::mount('company-step4');
    $html = $response->html();
    $_instance->logRenderedChild('atrJHzI', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/companystep4.blade.php ENDPATH**/ ?>