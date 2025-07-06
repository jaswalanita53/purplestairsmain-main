<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step8')->html();
} elseif ($_instance->childHasBeenRendered('wyFvsSq')) {
    $componentId = $_instance->getRenderedChildComponentId('wyFvsSq');
    $componentTag = $_instance->getRenderedChildComponentTagName('wyFvsSq');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('wyFvsSq');
} else {
    $response = \Livewire\Livewire::mount('candidate-step8');
    $html = $response->html();
    $_instance->logRenderedChild('wyFvsSq', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidatestep8.blade.php ENDPATH**/ ?>