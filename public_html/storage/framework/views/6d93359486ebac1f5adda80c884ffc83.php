<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('company-step3')->html();
} elseif ($_instance->childHasBeenRendered('JvuyTL8')) {
    $componentId = $_instance->getRenderedChildComponentId('JvuyTL8');
    $componentTag = $_instance->getRenderedChildComponentTagName('JvuyTL8');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('JvuyTL8');
} else {
    $response = \Livewire\Livewire::mount('company-step3');
    $html = $response->html();
    $_instance->logRenderedChild('JvuyTL8', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/viewcompanyprofile.blade.php ENDPATH**/ ?>