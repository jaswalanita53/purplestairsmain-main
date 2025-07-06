<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step6')->html();
} elseif ($_instance->childHasBeenRendered('df9kWBh')) {
    $componentId = $_instance->getRenderedChildComponentId('df9kWBh');
    $componentTag = $_instance->getRenderedChildComponentTagName('df9kWBh');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('df9kWBh');
} else {
    $response = \Livewire\Livewire::mount('candidate-step6');
    $html = $response->html();
    $_instance->logRenderedChild('df9kWBh', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidatestep6.blade.php ENDPATH**/ ?>