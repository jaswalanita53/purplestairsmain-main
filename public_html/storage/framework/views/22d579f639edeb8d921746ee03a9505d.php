<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step9')->html();
} elseif ($_instance->childHasBeenRendered('HlwVgiN')) {
    $componentId = $_instance->getRenderedChildComponentId('HlwVgiN');
    $componentTag = $_instance->getRenderedChildComponentTagName('HlwVgiN');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('HlwVgiN');
} else {
    $response = \Livewire\Livewire::mount('candidate-step9');
    $html = $response->html();
    $_instance->logRenderedChild('HlwVgiN', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidatestep9.blade.php ENDPATH**/ ?>