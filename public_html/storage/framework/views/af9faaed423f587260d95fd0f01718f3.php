<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step1')->html();
} elseif ($_instance->childHasBeenRendered('nSOOSZp')) {
    $componentId = $_instance->getRenderedChildComponentId('nSOOSZp');
    $componentTag = $_instance->getRenderedChildComponentTagName('nSOOSZp');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('nSOOSZp');
} else {
    $response = \Livewire\Livewire::mount('company-step1');
    $html = $response->html();
    $_instance->logRenderedChild('nSOOSZp', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/companystep1.blade.php ENDPATH**/ ?>