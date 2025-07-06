<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-requests')->html();
} elseif ($_instance->childHasBeenRendered('wIJf0fS')) {
    $componentId = $_instance->getRenderedChildComponentId('wIJf0fS');
    $componentTag = $_instance->getRenderedChildComponentTagName('wIJf0fS');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('wIJf0fS');
} else {
    $response = \Livewire\Livewire::mount('candidate-requests');
    $html = $response->html();
    $_instance->logRenderedChild('wIJf0fS', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidateRequests.blade.php ENDPATH**/ ?>