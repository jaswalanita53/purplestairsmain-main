<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-edit-resume')->html();
} elseif ($_instance->childHasBeenRendered('IGItBMm')) {
    $componentId = $_instance->getRenderedChildComponentId('IGItBMm');
    $componentTag = $_instance->getRenderedChildComponentTagName('IGItBMm');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('IGItBMm');
} else {
    $response = \Livewire\Livewire::mount('candidate-edit-resume');
    $html = $response->html();
    $_instance->logRenderedChild('IGItBMm', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidateEditResume.blade.php ENDPATH**/ ?>