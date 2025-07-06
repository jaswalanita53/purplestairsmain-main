<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-dashboard')->html();
} elseif ($_instance->childHasBeenRendered('WN3Xltz')) {
    $componentId = $_instance->getRenderedChildComponentId('WN3Xltz');
    $componentTag = $_instance->getRenderedChildComponentTagName('WN3Xltz');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('WN3Xltz');
} else {
    $response = \Livewire\Livewire::mount('company-dashboard');
    $html = $response->html();
    $_instance->logRenderedChild('WN3Xltz', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/companydashboard.blade.php ENDPATH**/ ?>