<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step5')->html();
} elseif ($_instance->childHasBeenRendered('mQsXIkD')) {
    $componentId = $_instance->getRenderedChildComponentId('mQsXIkD');
    $componentTag = $_instance->getRenderedChildComponentTagName('mQsXIkD');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('mQsXIkD');
} else {
    $response = \Livewire\Livewire::mount('candidate-step5');
    $html = $response->html();
    $_instance->logRenderedChild('mQsXIkD', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidatestep5.blade.php ENDPATH**/ ?>