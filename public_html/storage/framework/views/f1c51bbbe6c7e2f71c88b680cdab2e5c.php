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
            /* width: 50px; */
            /* height: 50px; */
        }
    </style>

    
    <style type="text/css">
        @media print {
             html,
             body {
                display: none;
             }
          }
        html {
         user-select: none;
      }
    </style>
    

    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo \Livewire\Livewire::styles(); ?>

</head>

<body class="<?php echo e(session('sidebar')?session('sidebar'):'sidebar_extended'); ?> ">
    <!-- GRADIENT SPINNER -->
    
    <div id="overlay" style="display: none;"><span class="loader"></span></div>

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
    <?php if(Request::is('company/dashboard') || Request::is('company/saved-search/*') || Request::is('company/saved-searches') || Request::is('company/archived-search/*') || Request::is('company/archived-searches') || Request::is('company/manage-subsciption')): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.js"></script>
    <?php else: ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <?php endif; ?>
    <script src="<?php echo e(asset('assets/be/js/filters.js')); ?>"></script>
    <script src="
https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.js
"></script>
<script>
    var asset_url="<?php echo e(asset('assets/be/js/filters.js')); ?>";

</script>
    <script src="<?php echo e(asset('assets/be/js/common.js')); ?>"></script>
    
    <script type="text/javascript">
        $(document).on('keyup', function (e) {
            if(e.key == "PrintScreen") {
                navigator.clipboard.writeText('');
                return false;
            }
            // console.log(e.key);
        });
    </script>
    

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo \Livewire\Livewire::scripts(); ?>


    <script>
         $(document).ready(function (e) {

        // $('body, html').removeClass('sidebar_show');
    });
    </script>
</body>

</html>
<?php /**PATH /var/www/html/app/resources/views/layouts/master.blade.php ENDPATH**/ ?>