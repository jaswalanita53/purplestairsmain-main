<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidates-profile')->html();
} elseif ($_instance->childHasBeenRendered('lmsDfyZ')) {
    $componentId = $_instance->getRenderedChildComponentId('lmsDfyZ');
    $componentTag = $_instance->getRenderedChildComponentTagName('lmsDfyZ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('lmsDfyZ');
} else {
    $response = \Livewire\Livewire::mount('candidates-profile');
    $html = $response->html();
    $_instance->logRenderedChild('lmsDfyZ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidatesProfile.blade.php ENDPATH**/ ?>