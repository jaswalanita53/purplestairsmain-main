<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-edit-resume')->html();
} elseif ($_instance->childHasBeenRendered('8puJ28q')) {
    $componentId = $_instance->getRenderedChildComponentId('8puJ28q');
    $componentTag = $_instance->getRenderedChildComponentTagName('8puJ28q');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('8puJ28q');
} else {
    $response = \Livewire\Livewire::mount('candidate-edit-resume');
    $html = $response->html();
    $_instance->logRenderedChild('8puJ28q', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidateEditResume.blade.php ENDPATH**/ ?>