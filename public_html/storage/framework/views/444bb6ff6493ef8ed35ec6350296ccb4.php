<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step8')->html();
} elseif ($_instance->childHasBeenRendered('beAPpAg')) {
    $componentId = $_instance->getRenderedChildComponentId('beAPpAg');
    $componentTag = $_instance->getRenderedChildComponentTagName('beAPpAg');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('beAPpAg');
} else {
    $response = \Livewire\Livewire::mount('candidate-step8');
    $html = $response->html();
    $_instance->logRenderedChild('beAPpAg', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidatestep8.blade.php ENDPATH**/ ?>