<!DOCTYPE html>
<html lang="en" class="<?php echo e(session('sidebar')); ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Purple Stairs</title>

    <!-- fabicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/fe/images/fav.png')); ?>" />
    <!-- All CSS -->

    <!-- fontawesome -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/be/css/all.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/be/css/brands.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/be/css/fontawesome.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/be/css/regular.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/be/css/solid.css')); ?>" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/be/css/slick.css')); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/be/css/bootstrap.min.css')); ?>" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/be/style.css')); ?>" />
    <script src="<?php echo e(asset('assets/be/js/jquery-3.5.1.min.js')); ?>"></script>
    <style>
        .listview_candidate_details_w .candidate_grid_ppl_icn {
            z-index: auto;
        }

        span.avatar-img img {
            width: 50px;
            height: 50px;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo \Livewire\Livewire::styles(); ?>

</head>

<body class="<?php echo e(session('sidebar')); ?>">
    <div class="c-body">
        <?php echo $__env->make('inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="c-right">
            <div class="right-panel-main">
                <?php echo $__env->make('inc.headbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
    <div class="c_overlay"></div>

    <!-- Jquery-->
    <script src="<?php echo e(asset('assets/be/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/be/js/slick.min.js')); ?>"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?php echo e(asset('assets/be/js/common.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo \Livewire\Livewire::scripts(); ?>

</body>

</html><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/layouts/master.blade.php ENDPATH**/ ?>