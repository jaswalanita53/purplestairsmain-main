<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('contact')->html();
} elseif ($_instance->childHasBeenRendered('CEYgdFp')) {
    $componentId = $_instance->getRenderedChildComponentId('CEYgdFp');
    $componentTag = $_instance->getRenderedChildComponentTagName('CEYgdFp');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('CEYgdFp');
} else {
    $response = \Livewire\Livewire::mount('contact');
    $html = $response->html();
    $_instance->logRenderedChild('CEYgdFp', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/contact.blade.php ENDPATH**/ ?>