<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step2')->html();
} elseif ($_instance->childHasBeenRendered('pM0jykk')) {
    $componentId = $_instance->getRenderedChildComponentId('pM0jykk');
    $componentTag = $_instance->getRenderedChildComponentTagName('pM0jykk');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('pM0jykk');
} else {
    $response = \Livewire\Livewire::mount('candidate-step2');
    $html = $response->html();
    $_instance->logRenderedChild('pM0jykk', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidatestep2.blade.php ENDPATH**/ ?>