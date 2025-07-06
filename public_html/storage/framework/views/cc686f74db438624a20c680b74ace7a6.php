<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step1')->html();
} elseif ($_instance->childHasBeenRendered('ON9RLVo')) {
    $componentId = $_instance->getRenderedChildComponentId('ON9RLVo');
    $componentTag = $_instance->getRenderedChildComponentTagName('ON9RLVo');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ON9RLVo');
} else {
    $response = \Livewire\Livewire::mount('candidate-step1');
    $html = $response->html();
    $_instance->logRenderedChild('ON9RLVo', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidatestep1.blade.php ENDPATH**/ ?>