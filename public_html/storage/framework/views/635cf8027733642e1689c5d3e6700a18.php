<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('archived-search',['slug' => $slug])->html();
} elseif ($_instance->childHasBeenRendered('x2eLPGw')) {
    $componentId = $_instance->getRenderedChildComponentId('x2eLPGw');
    $componentTag = $_instance->getRenderedChildComponentTagName('x2eLPGw');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('x2eLPGw');
} else {
    $response = \Livewire\Livewire::mount('archived-search',['slug' => $slug]);
    $html = $response->html();
    $_instance->logRenderedChild('x2eLPGw', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/archivedsearch.blade.php ENDPATH**/ ?>