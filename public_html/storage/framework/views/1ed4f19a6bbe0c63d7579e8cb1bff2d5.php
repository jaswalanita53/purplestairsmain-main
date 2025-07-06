<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('reset-password')->html();
} elseif ($_instance->childHasBeenRendered('3C2tnHQ')) {
    $componentId = $_instance->getRenderedChildComponentId('3C2tnHQ');
    $componentTag = $_instance->getRenderedChildComponentTagName('3C2tnHQ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('3C2tnHQ');
} else {
    $response = \Livewire\Livewire::mount('reset-password');
    $html = $response->html();
    $_instance->logRenderedChild('3C2tnHQ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/resetpassword.blade.php ENDPATH**/ ?>