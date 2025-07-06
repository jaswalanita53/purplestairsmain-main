<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-edit')->html();
} elseif ($_instance->childHasBeenRendered('P3rQDAx')) {
    $componentId = $_instance->getRenderedChildComponentId('P3rQDAx');
    $componentTag = $_instance->getRenderedChildComponentTagName('P3rQDAx');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('P3rQDAx');
} else {
    $response = \Livewire\Livewire::mount('company-edit');
    $html = $response->html();
    $_instance->logRenderedChild('P3rQDAx', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/editcompanyprofile.blade.php ENDPATH**/ ?>