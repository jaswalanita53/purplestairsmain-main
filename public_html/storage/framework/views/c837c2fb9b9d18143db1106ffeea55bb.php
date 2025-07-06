<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step4')->html();
} elseif ($_instance->childHasBeenRendered('3mRKfJg')) {
    $componentId = $_instance->getRenderedChildComponentId('3mRKfJg');
    $componentTag = $_instance->getRenderedChildComponentTagName('3mRKfJg');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('3mRKfJg');
} else {
    $response = \Livewire\Livewire::mount('company-step4');
    $html = $response->html();
    $_instance->logRenderedChild('3mRKfJg', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/companystep4.blade.php ENDPATH**/ ?>