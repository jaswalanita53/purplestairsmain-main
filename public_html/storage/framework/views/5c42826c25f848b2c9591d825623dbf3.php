<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step3')->html();
} elseif ($_instance->childHasBeenRendered('AlXu5YQ')) {
    $componentId = $_instance->getRenderedChildComponentId('AlXu5YQ');
    $componentTag = $_instance->getRenderedChildComponentTagName('AlXu5YQ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('AlXu5YQ');
} else {
    $response = \Livewire\Livewire::mount('company-step3');
    $html = $response->html();
    $_instance->logRenderedChild('AlXu5YQ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/viewcompanyprofile.blade.php ENDPATH**/ ?>