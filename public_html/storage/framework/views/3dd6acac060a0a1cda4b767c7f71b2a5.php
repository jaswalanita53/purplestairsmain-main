<?php $__env->startSection('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-step6')->html();
} elseif ($_instance->childHasBeenRendered('qJDQBpP')) {
    $componentId = $_instance->getRenderedChildComponentId('qJDQBpP');
    $componentTag = $_instance->getRenderedChildComponentTagName('qJDQBpP');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qJDQBpP');
} else {
    $response = \Livewire\Livewire::mount('candidate-step6');
    $html = $response->html();
    $_instance->logRenderedChild('qJDQBpP', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/candidatestep6.blade.php ENDPATH**/ ?>