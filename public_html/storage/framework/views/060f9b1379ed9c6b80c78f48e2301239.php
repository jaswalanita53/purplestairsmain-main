<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step4')->html();
} elseif ($_instance->childHasBeenRendered('8fpdoSW')) {
    $componentId = $_instance->getRenderedChildComponentId('8fpdoSW');
    $componentTag = $_instance->getRenderedChildComponentTagName('8fpdoSW');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('8fpdoSW');
} else {
    $response = \Livewire\Livewire::mount('candidate-step4');
    $html = $response->html();
    $_instance->logRenderedChild('8fpdoSW', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidatestep4.blade.php ENDPATH**/ ?>