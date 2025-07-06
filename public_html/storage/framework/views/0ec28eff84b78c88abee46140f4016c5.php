<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step1')->html();
} elseif ($_instance->childHasBeenRendered('urq9IFo')) {
    $componentId = $_instance->getRenderedChildComponentId('urq9IFo');
    $componentTag = $_instance->getRenderedChildComponentTagName('urq9IFo');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('urq9IFo');
} else {
    $response = \Livewire\Livewire::mount('company-step1');
    $html = $response->html();
    $_instance->logRenderedChild('urq9IFo', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/companystep1.blade.php ENDPATH**/ ?>