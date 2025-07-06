<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step2')->html();
} elseif ($_instance->childHasBeenRendered('F7Pdpi6')) {
    $componentId = $_instance->getRenderedChildComponentId('F7Pdpi6');
    $componentTag = $_instance->getRenderedChildComponentTagName('F7Pdpi6');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('F7Pdpi6');
} else {
    $response = \Livewire\Livewire::mount('company-step2');
    $html = $response->html();
    $_instance->logRenderedChild('F7Pdpi6', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/companystep2.blade.php ENDPATH**/ ?>