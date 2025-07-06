<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step3')->html();
} elseif ($_instance->childHasBeenRendered('rMxgbHH')) {
    $componentId = $_instance->getRenderedChildComponentId('rMxgbHH');
    $componentTag = $_instance->getRenderedChildComponentTagName('rMxgbHH');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('rMxgbHH');
} else {
    $response = \Livewire\Livewire::mount('candidate-step3');
    $html = $response->html();
    $_instance->logRenderedChild('rMxgbHH', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidatestep3.blade.php ENDPATH**/ ?>