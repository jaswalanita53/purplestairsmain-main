<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-requests')->html();
} elseif ($_instance->childHasBeenRendered('qQH2G3R')) {
    $componentId = $_instance->getRenderedChildComponentId('qQH2G3R');
    $componentTag = $_instance->getRenderedChildComponentTagName('qQH2G3R');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qQH2G3R');
} else {
    $response = \Livewire\Livewire::mount('candidate-requests');
    $html = $response->html();
    $_instance->logRenderedChild('qQH2G3R', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidateRequests.blade.php ENDPATH**/ ?>