<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-profile',compact('user_id'))->html();
} elseif ($_instance->childHasBeenRendered('JcvR4x8')) {
    $componentId = $_instance->getRenderedChildComponentId('JcvR4x8');
    $componentTag = $_instance->getRenderedChildComponentTagName('JcvR4x8');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('JcvR4x8');
} else {
    $response = \Livewire\Livewire::mount('candidate-profile',compact('user_id'));
    $html = $response->html();
    $_instance->logRenderedChild('JcvR4x8', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidateprofile.blade.php ENDPATH**/ ?>