<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-profile',compact('user_id'))->html();
} elseif ($_instance->childHasBeenRendered('yEJp13Z')) {
    $componentId = $_instance->getRenderedChildComponentId('yEJp13Z');
    $componentTag = $_instance->getRenderedChildComponentTagName('yEJp13Z');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('yEJp13Z');
} else {
    $response = \Livewire\Livewire::mount('candidate-profile',compact('user_id'));
    $html = $response->html();
    $_instance->logRenderedChild('yEJp13Z', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/resources/views/pages/candidateprofile.blade.php ENDPATH**/ ?>