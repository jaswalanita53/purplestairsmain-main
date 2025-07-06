<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step2')->html();
} elseif ($_instance->childHasBeenRendered('JNNT6Fg')) {
    $componentId = $_instance->getRenderedChildComponentId('JNNT6Fg');
    $componentTag = $_instance->getRenderedChildComponentTagName('JNNT6Fg');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('JNNT6Fg');
} else {
    $response = \Livewire\Livewire::mount('candidate-step2');
    $html = $response->html();
    $_instance->logRenderedChild('JNNT6Fg', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidatestep2.blade.php ENDPATH**/ ?>