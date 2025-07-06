<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-edit-personal')->html();
} elseif ($_instance->childHasBeenRendered('Yjt7YxR')) {
    $componentId = $_instance->getRenderedChildComponentId('Yjt7YxR');
    $componentTag = $_instance->getRenderedChildComponentTagName('Yjt7YxR');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Yjt7YxR');
} else {
    $response = \Livewire\Livewire::mount('candidate-edit-personal');
    $html = $response->html();
    $_instance->logRenderedChild('Yjt7YxR', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidateEditPersonal.blade.php ENDPATH**/ ?>