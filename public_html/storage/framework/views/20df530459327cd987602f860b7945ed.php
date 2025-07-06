<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step7')->html();
} elseif ($_instance->childHasBeenRendered('xT3taj2')) {
    $componentId = $_instance->getRenderedChildComponentId('xT3taj2');
    $componentTag = $_instance->getRenderedChildComponentTagName('xT3taj2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('xT3taj2');
} else {
    $response = \Livewire\Livewire::mount('candidate-step7');
    $html = $response->html();
    $_instance->logRenderedChild('xT3taj2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidatestep7.blade.php ENDPATH**/ ?>