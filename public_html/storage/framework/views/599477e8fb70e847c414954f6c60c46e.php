<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('saved-search',['slug' => $slug])->html();
} elseif ($_instance->childHasBeenRendered('YR3RnPE')) {
    $componentId = $_instance->getRenderedChildComponentId('YR3RnPE');
    $componentTag = $_instance->getRenderedChildComponentTagName('YR3RnPE');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('YR3RnPE');
} else {
    $response = \Livewire\Livewire::mount('saved-search',['slug' => $slug]);
    $html = $response->html();
    $_instance->logRenderedChild('YR3RnPE', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/savedsearch.blade.php ENDPATH**/ ?>