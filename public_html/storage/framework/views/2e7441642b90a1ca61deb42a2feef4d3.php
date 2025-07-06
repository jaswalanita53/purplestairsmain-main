<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-edit-preferences')->html();
} elseif ($_instance->childHasBeenRendered('BQG0ICp')) {
    $componentId = $_instance->getRenderedChildComponentId('BQG0ICp');
    $componentTag = $_instance->getRenderedChildComponentTagName('BQG0ICp');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('BQG0ICp');
} else {
    $response = \Livewire\Livewire::mount('candidate-edit-preferences');
    $html = $response->html();
    $_instance->logRenderedChild('BQG0ICp', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidateEditPreferences.blade.php ENDPATH**/ ?>