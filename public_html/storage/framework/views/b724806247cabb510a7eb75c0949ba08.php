<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('contact')->html();
} elseif ($_instance->childHasBeenRendered('blvs2dU')) {
    $componentId = $_instance->getRenderedChildComponentId('blvs2dU');
    $componentTag = $_instance->getRenderedChildComponentTagName('blvs2dU');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('blvs2dU');
} else {
    $response = \Livewire\Livewire::mount('contact');
    $html = $response->html();
    $_instance->logRenderedChild('blvs2dU', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/contact.blade.php ENDPATH**/ ?>