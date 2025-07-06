<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('saved-search',['slug' => $slug])->html();
} elseif ($_instance->childHasBeenRendered('5NQFeLy')) {
    $componentId = $_instance->getRenderedChildComponentId('5NQFeLy');
    $componentTag = $_instance->getRenderedChildComponentTagName('5NQFeLy');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('5NQFeLy');
} else {
    $response = \Livewire\Livewire::mount('saved-search',['slug' => $slug]);
    $html = $response->html();
    $_instance->logRenderedChild('5NQFeLy', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/savedsearch.blade.php ENDPATH**/ ?>