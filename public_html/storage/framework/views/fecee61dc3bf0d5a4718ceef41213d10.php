<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step2')->html();
} elseif ($_instance->childHasBeenRendered('aqf0ykU')) {
    $componentId = $_instance->getRenderedChildComponentId('aqf0ykU');
    $componentTag = $_instance->getRenderedChildComponentTagName('aqf0ykU');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('aqf0ykU');
} else {
    $response = \Livewire\Livewire::mount('company-step2');
    $html = $response->html();
    $_instance->logRenderedChild('aqf0ykU', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/companystep2.blade.php ENDPATH**/ ?>