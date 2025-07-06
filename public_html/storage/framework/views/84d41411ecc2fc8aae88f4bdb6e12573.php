<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step1')->html();
} elseif ($_instance->childHasBeenRendered('MvIzGOl')) {
    $componentId = $_instance->getRenderedChildComponentId('MvIzGOl');
    $componentTag = $_instance->getRenderedChildComponentTagName('MvIzGOl');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('MvIzGOl');
} else {
    $response = \Livewire\Livewire::mount('candidate-step1');
    $html = $response->html();
    $_instance->logRenderedChild('MvIzGOl', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidatestep1.blade.php ENDPATH**/ ?>