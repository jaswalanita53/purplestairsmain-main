<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step7')->html();
} elseif ($_instance->childHasBeenRendered('m5nE7wn')) {
    $componentId = $_instance->getRenderedChildComponentId('m5nE7wn');
    $componentTag = $_instance->getRenderedChildComponentTagName('m5nE7wn');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('m5nE7wn');
} else {
    $response = \Livewire\Livewire::mount('candidate-step7');
    $html = $response->html();
    $_instance->logRenderedChild('m5nE7wn', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidatestep7.blade.php ENDPATH**/ ?>