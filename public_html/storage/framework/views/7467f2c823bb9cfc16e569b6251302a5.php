<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('unmasked-list')->html();
} elseif ($_instance->childHasBeenRendered('iJ0gEFw')) {
    $componentId = $_instance->getRenderedChildComponentId('iJ0gEFw');
    $componentTag = $_instance->getRenderedChildComponentTagName('iJ0gEFw');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('iJ0gEFw');
} else {
    $response = \Livewire\Livewire::mount('unmasked-list');
    $html = $response->html();
    $_instance->logRenderedChild('iJ0gEFw', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/unmasked_list.blade.php ENDPATH**/ ?>