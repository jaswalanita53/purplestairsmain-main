<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step3')->html();
} elseif ($_instance->childHasBeenRendered('3TcjwP3')) {
    $componentId = $_instance->getRenderedChildComponentId('3TcjwP3');
    $componentTag = $_instance->getRenderedChildComponentTagName('3TcjwP3');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('3TcjwP3');
} else {
    $response = \Livewire\Livewire::mount('candidate-step3');
    $html = $response->html();
    $_instance->logRenderedChild('3TcjwP3', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidatestep3.blade.php ENDPATH**/ ?>