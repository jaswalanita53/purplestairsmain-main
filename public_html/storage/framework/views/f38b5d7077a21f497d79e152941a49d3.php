<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-edit')->html();
} elseif ($_instance->childHasBeenRendered('GvUVWf9')) {
    $componentId = $_instance->getRenderedChildComponentId('GvUVWf9');
    $componentTag = $_instance->getRenderedChildComponentTagName('GvUVWf9');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('GvUVWf9');
} else {
    $response = \Livewire\Livewire::mount('company-edit');
    $html = $response->html();
    $_instance->logRenderedChild('GvUVWf9', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/editcompanyprofile.blade.php ENDPATH**/ ?>