<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('sleep-account')->html();
} elseif ($_instance->childHasBeenRendered('Tv4DHCj')) {
    $componentId = $_instance->getRenderedChildComponentId('Tv4DHCj');
    $componentTag = $_instance->getRenderedChildComponentTagName('Tv4DHCj');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Tv4DHCj');
} else {
    $response = \Livewire\Livewire::mount('sleep-account');
    $html = $response->html();
    $_instance->logRenderedChild('Tv4DHCj', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/sleepaccount.blade.php ENDPATH**/ ?>