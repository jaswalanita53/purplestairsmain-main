<div class="c-head">
    <div class="top-right row">
        <div class="col-3 ">
            <p class="arrow-box-span-">
            <button class="menu_toggle- <?php if(!empty(session('sidebar'))): ?> closeSidebar <?php else: ?> openSidebar <?php endif; ?>">
                <img src="<?php echo e(asset('assets/be/images/left-arrw.svg')); ?>" alt="" class="arrow-left"/>
            </button>
            </p>
        </div>
        <style>
              .rotate-180 {
                    transform: rotate(180deg);
                }
        </style>
        <div class="col-9 top-header-right">

            <div class="header-rgt hdr-rgt">
                <div class="header-list">
                    <ul class="notification_list">
                        <li class="middle-icon-one">
                            <div class="dropdown avatar-dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="avatar-img">
                                        <?php if(Auth::user()->profile_photo_path): ?>
                                        <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt=""  width="50px" height="50px" style="border-radius:50%" class="mr-1"/>
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                                        <?php endif; ?>
                                    </span>
                                    <span class="user-name" style="margin-left:7px;">
                                    <?php echo e(Auth::user()->company ? Auth::user()->company->company_name : Auth::user()->name); ?>

                                    </span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3" data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('company.dashboard')); ?>">
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/be/images/new_dash_icon2.svg')); ?>" alt="" />My Dashboard
                                            </span>
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a class="dropdown-item" href="#">
                                          <span class="download-btn">
                                            <img src="<?php echo e(asset('assets/fe/images/dp2.svg')); ?>" alt="" />  Account
                                            <em><img src="<?php echo e(asset('assets/fe/images/dp-arrw.svg')); ?>" alt="" /></em>
                                          </span>
                                        </a>
                                        <ul class="sub-drop">
                                          <?php if(Auth::user()->password != ''): ?>
                                          <li><a href="<?php echo e(route('account.resetpassword')); ?>">Reset Password</a></li>
                                          <?php endif; ?>
                                          <li><a href="<?php echo e(route('account.delete')); ?>">Delete My Account</a></li>
                                          <li><a href="<?php echo e(route('account.sleep')); ?>">Put Account To Sleep</a></li>
                                        </ul>
                                      </li> -->
                                      <li class="">
                                        <a class="dropdown-item dropdown-item-custom-menu" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/fe/images/dp2.svg')); ?>" alt="" />Manage My Account
                                                <em><img class="arrow-img-dd" src="<?php echo e(asset('assets/fe/images/dp-arrw.svg')); ?>" alt="" /></em>
                                            </span>

                                        </a>

                                        <div class="collapse custom-collapse-menu" id="collapseExample">
                                            <ul class="sub-drop">
                                                <?php if(Auth::user()->password != ''): ?>
                                                
                                                <?php endif; ?>
                                                <li><a href="<?php echo e(route('account.delete')); ?>">Delete My Account</a></li>
                                                <li><a href="<?php echo e(route('account.sleep')); ?>">Put Account To Sleep</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                      <li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/be/images/dp3.svg')); ?>" alt="" />Log
                                                Out
                                            </span>
                                        </a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).on('click', '.closeSidebar', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // if class means sidebar collapse
        localStorage.setItem("open", "");
        $('.menu_toggle-').addClass('openSidebar');
        $('body').addClass('sidebar_extended');
            $.ajax({
                url: '<?php echo e(route('toggle')); ?>',
                type: 'get',
                data: {'open' : ''},
                        });
            $('.menu_toggle-').removeClass('closeSidebar');

            $('body, html').removeClass('sidebar_show');

        });

    $(document).on('click', '.openSidebar', function (e) {
        e.preventDefault();
        e.stopPropagation();
        localStorage.setItem("open", "sidebar_show");
        $('.menu_toggle-').addClass('closeSidebar');
        $('body, html').addClass('sidebar_show');
        $.ajax({
            url: '<?php echo e(route('toggle')); ?>',
            type: 'get',
            data: {'open' : 'sidebar_show'},

        });

         $('.menu_toggle-').removeClass('openSidebar');

        $('body').removeClass('sidebar_extended');
        // if class means sidebar collapse
    });

    $(document).ready(function (e) {
        e.preventDefault();
         e.stopPropagation();

        var openToggleValue = localStorage.getItem("open");
        // if class means sidebar collapse
         $('.menu_toggle-').addClass('openSidebar');
        $.ajax({
            url: '<?php echo e(route('toggle')); ?>',
            type: 'get',
            data: {'open' : openToggleValue},
                    });
        $('.menu_toggle-').removeClass('closeSidebar');

        $('body, html').removeClass(openToggleValue)
});
</script>

<?php $__env->startPush('scripts'); ?>
<script type="module">
    $(document).ready(function() {

           // $('body, html').addClass('sidebar_extended');
           // $('body, html').removeClass('sidebar_show')
           // $('.menu_toggle-').addClass('closeSidebar');
            //$('.menu_toggle-').removeClass('closeSidebar');



        $('.dropdown-item-custom-menu').click(function() {
            $('.custom-collapse-menu').toggleClass('show');
            $('.arrow-img-dd').toggleClass('rotate-180');
            return false;
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/inc/headbar.blade.php ENDPATH**/ ?>