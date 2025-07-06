<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-edit-preferences')->html();
} elseif ($_instance->childHasBeenRendered('weomtsz')) {
    $componentId = $_instance->getRenderedChildComponentId('weomtsz');
    $componentTag = $_instance->getRenderedChildComponentTagName('weomtsz');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('weomtsz');
} else {
    $response = \Livewire\Livewire::mount('candidate-edit-preferences');
    $html = $response->html();
    $_instance->logRenderedChild('weomtsz', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidateEditPreferences.blade.php ENDPATH**/ ?>