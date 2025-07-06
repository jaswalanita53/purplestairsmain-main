<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Purple Stairs</title>

    <!-- fabicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/fe/images/fav.png')); ?>" />
    <!-- All CSS -->

    <!-- fontawesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/css/all.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/css/brands.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/css/fontawesome.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/css/regular.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/css/solid.min.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/css/slick.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/css/slick-theme.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/css/easy-responsive-tabs.css')); ?>">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/style.css')); ?>" />
    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo \Livewire\Livewire::styles(); ?>

</head>

<body>
    <?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="app">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php if(!Route::is('candidates.requests')): ?>
    <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- Jquery-->
    <script src="<?php echo e(asset('assets/fe/js/jquery-3.5.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/fe/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/fe/js/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/fe/js/easyResponsiveTabs.js')); ?>"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/fe/js/common.js')); ?>"></script>
    <?php echo $__env->yieldContent('js'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo \Livewire\Livewire::scripts(); ?>

</body>

</html>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/layouts/app.blade.php ENDPATH**/ ?>