<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('sleep-account')->html();
} elseif ($_instance->childHasBeenRendered('yKlSxgU')) {
    $componentId = $_instance->getRenderedChildComponentId('yKlSxgU');
    $componentTag = $_instance->getRenderedChildComponentTagName('yKlSxgU');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('yKlSxgU');
} else {
    $response = \Livewire\Livewire::mount('sleep-account');
    $html = $response->html();
    $_instance->logRenderedChild('yKlSxgU', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/sleepaccount.blade.php ENDPATH**/ ?>