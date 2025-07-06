<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-edit-personal')->html();
} elseif ($_instance->childHasBeenRendered('wOdZa6d')) {
    $componentId = $_instance->getRenderedChildComponentId('wOdZa6d');
    $componentTag = $_instance->getRenderedChildComponentTagName('wOdZa6d');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('wOdZa6d');
} else {
    $response = \Livewire\Livewire::mount('candidate-edit-personal');
    $html = $response->html();
    $_instance->logRenderedChild('wOdZa6d', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidateEditPersonal.blade.php ENDPATH**/ ?>