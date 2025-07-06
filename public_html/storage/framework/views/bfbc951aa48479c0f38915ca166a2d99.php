<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step9')->html();
} elseif ($_instance->childHasBeenRendered('hE69ZcD')) {
    $componentId = $_instance->getRenderedChildComponentId('hE69ZcD');
    $componentTag = $_instance->getRenderedChildComponentTagName('hE69ZcD');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('hE69ZcD');
} else {
    $response = \Livewire\Livewire::mount('candidate-step9');
    $html = $response->html();
    $_instance->logRenderedChild('hE69ZcD', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidatestep9.blade.php ENDPATH**/ ?>