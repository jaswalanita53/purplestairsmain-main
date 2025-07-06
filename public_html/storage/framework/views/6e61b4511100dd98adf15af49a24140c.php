<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step5')->html();
} elseif ($_instance->childHasBeenRendered('LDpaReb')) {
    $componentId = $_instance->getRenderedChildComponentId('LDpaReb');
    $componentTag = $_instance->getRenderedChildComponentTagName('LDpaReb');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('LDpaReb');
} else {
    $response = \Livewire\Livewire::mount('candidate-step5');
    $html = $response->html();
    $_instance->logRenderedChild('LDpaReb', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidatestep5.blade.php ENDPATH**/ ?>