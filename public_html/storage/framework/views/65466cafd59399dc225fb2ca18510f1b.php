<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step4')->html();
} elseif ($_instance->childHasBeenRendered('OEPHdhG')) {
    $componentId = $_instance->getRenderedChildComponentId('OEPHdhG');
    $componentTag = $_instance->getRenderedChildComponentTagName('OEPHdhG');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('OEPHdhG');
} else {
    $response = \Livewire\Livewire::mount('candidate-step4');
    $html = $response->html();
    $_instance->logRenderedChild('OEPHdhG', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidatestep4.blade.php ENDPATH**/ ?>