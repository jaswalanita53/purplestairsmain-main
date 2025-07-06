<header class="main-head">
  
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand me-auto" href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(asset("assets/fe/images/new_logo.svg")); ?>" alt="" />
            </a>
            <style>
                .rotate-180 {
                    transform: rotate(180deg);
                }

                .hdr-rgt .dropdown-item .download-btn i {
                    margin-right: 14px;
                }
            </style>

    <?php if(!request()->is('login', 'signup-select')): ?>
    <button class="navbar-toggler navbar-toggler-main order-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <!-- <span class="navbar-toggler-icon"></span> -->
        <span class="stick"></span>
    </button>
<?php endif; ?>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="stick"></span>
                </button>
                <?php if(!Auth::check()): ?>
                <?php if(!Route::is('signupselect') && !Route::is('login') && !Route::is('register')  && !Route::is('employer.login') && !Route::is('employer.signup')): ?>
                <ul class="navbar-nav ms-auto">
                    <li class="<?php echo e(Route::is('welcome') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route('welcome')); ?>">Home</a></li>
                    <li class="<?php echo e(Route::is('mission') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route("mission")); ?>">Our Mission</a></li>
                    <li class="<?php echo e(Route::is('pricing') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route("pricing")); ?>"> Employer Pricing</a></li>
                    <li class="<?php echo e(Route::is('features') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route("features")); ?>">Features</a></li>
                    <li class="mobile-li"> <a href="<?php echo e(route("login")); ?>" class="btn hdr-btn hdr-bn2"  href="<?php echo e(route('login')); ?>">Login<span><img src="<?php echo e(asset("assets/fe/images/log.svg")); ?>" alt="" /></span></a></li>
                    <li class="mobile-li"> <a href="<?php echo e(route("signupselect")); ?>" class="btn hdr-btn">Sign Up<span><img src="<?php echo e(asset("assets/fe/images/btn-img.svg")); ?>" alt="" /></span></a></li>
                </ul>
                <?php endif; ?>
                <?php else: ?>
                        <ul class="navbar-nav ms-auto navbar-nav-sidebar" aria-labelledby="dropdownMenuButton2" data-popper-placement="bottom-end">
<li>
                                <span class="avatar-img px-2">

                                        <?php if(Auth::user()->profile_photo_path): ?>
                                            <?php if(Auth::user()->isEmployer()): ?>
                                            <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" width="50px" height="50px" style="border-radius:50%" />
                                            <?php else: ?>
                                                <?php if(Auth::user()->personal->profile_status): ?>
                                                <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                <?php else: ?>
                                                <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                        <?php if(!empty(Auth::user()->personal->profile_status)): ?>
                                        <?php if(Auth::user()->personal->profile_status): ?>
                                                <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                                                <?php else: ?>
                                                <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                <?php endif; ?>
                                                <?php else: ?>
                                        <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                                        <?php endif; ?>
                                        <?php endif; ?>

                                    </span>
                                    <span class="user-name">
                                        <?php echo e(Auth::user()->name); ?>

                                    </span>
                                    <hr/>
                                    </li>
                                    <?php if(Auth::user()->isEmployer()): ?>
                                    <li class="<?php echo e(Route::is('candidates.requests') ? 'current-menu-item' : ''); ?>">
                                        <a class="dropdown-item" href="<?php echo e(route('company.dashboard')); ?>">
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/be/images/new_dash_icon2.svg')); ?>" alt="" /> My Dashboard
                                            </span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->isCandidate()): ?>
                                    <li class="<?php echo e(Route::is('candidateProfile') ? 'current-menu-item' : ''); ?>">
                                        <a class="dropdown-item" href="<?php echo e(route('candidateProfile')); ?>">
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/fe/images/user-profile-18.png')); ?>" alt="" width="18" /> My Profile
                                            </span>
                                        </a>
                                    </li>

                                    <li class="unmaskReq <?php if(Auth::user()->status==0): ?> d-none <?php endif; ?> <?php echo e(Route::is('candidates.requests') ? 'current-menu-item' : ''); ?>" >
                                        <a class="dropdown-item" href="<?php echo e(route('candidates.requests')); ?>">
                                            <span class="download-btn">
                                                <i class="fa fa-eye"></i> Employer Requests
                                            </span>
                                        </a>
                                    </li>

                                    <!-- <li>
                      <a class="dropdown-item" href="<?php echo e(route('candidates.editpersonal')); ?>">
                        <span class="download-btn">
                          <img src="<?php echo e(asset('assets/fe/images/dp1.svg')); ?>" alt="" />Edit My Profile
                        </span>
                      </a>
                    </li> -->
                                    <?php endif; ?>
                                    <li class="<?php echo e(Route::is('account.resetpassword') ? 'current-menu-item' : ''); ?> <?php echo e(Route::is('account.delete') ? 'current-menu-item' : ''); ?> <?php echo e(Route::is('account.sleep') ? 'current-menu-item' : ''); ?>">
                                        <a class="dropdown-item dropdown-item-custom-menu" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/fe/images/dp2.svg')); ?>" alt="" /> Manage My Account
                                                <em><img class="arrow-img-dd" src="<?php echo e(asset('assets/fe/images/dp-arrw.svg')); ?>" alt="" /></em>
                                            </span>

                                        </a>

                                        <div class="collapse custom-collapse-menu" id="collapseExample">
                                            <ul class="sub-drop">
                                                <?php if(Auth::user()->password != ''): ?>
                                                <li class="<?php echo e(Route::is('account.resetpassword') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route('account.resetpassword')); ?>"> Reset Password</a></li>
                                                <?php endif; ?>
                                                <li class="<?php echo e(Route::is('account.delete') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route('account.delete')); ?>"> Delete My Account</a></li>
                                                <li class="<?php echo e(Route::is('account.sleep') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route('account.sleep')); ?>"> Put Account To Sleep</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                            </form>
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/fe/images/dp3.svg')); ?>" alt="" /> Log Out
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                <?php endif; ?>
            </div>
            <?php if(!Route::is('signupselect') && !Route::is('login') && !Route::is('register') && !Auth::check() && !Route::is('employer.login') && !Route::is('employer.signup')): ?>
            <div class="hdr-rgt">
                <a href="<?php echo e(route('login')); ?>" class="btn hdr-btn hdr-bn2">Login<span><img src="<?php echo e(asset("assets/fe/images/log.svg")); ?>" alt="" /></span></a>
                <a href="<?php echo e(route("signupselect")); ?>" class="btn hdr-btn">Sign Up<span><img src="<?php echo e(asset("assets/fe/images/btn-img.svg")); ?>" alt="" /></span></a>
            </div>
            <?php endif; ?>

            <?php if(Auth::check() && !Route::is('verification.notice')): ?>
            <div class="hdr-rgt hdr-rgt2 order-1">
                <div class="header-list">
                    <ul class="notification_list">
                        <li class="middle-icon-one">
                            <div class="dropdown avatar-dropdown">
                                <button class="btn btn-secondary dropdown-toggle d-none d-lg-flex" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="true">
                                    <span class="avatar-img ">

                                        <?php if(Auth::user()->profile_photo_path): ?>
                                            <?php if(Auth::user()->isEmployer()): ?>
                                            <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" width="50px" height="50px" style="border-radius:50%" />
                                            <?php else: ?>
                                                <?php if(Auth::user()->personal->profile_status): ?>
                                                <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                <?php else: ?>
                                                <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                        <?php if(!empty(Auth::user()->personal->profile_status)): ?>
                                        <?php if(Auth::user()->personal->profile_status): ?>
                                                <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                                                <?php else: ?>
                                                <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                <?php endif; ?>
                                                <?php else: ?>
                                        <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                                        <?php endif; ?>
                                        <?php endif; ?>

                                    </span>
                                    <span class="user-name">
                                        <?php echo e(Auth::user()->name); ?>

                                    </span>
                                    <hr/>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2" data-popper-placement="bottom-end">
                                <li>
                                
                                    </li>
                                    <?php if(Auth::user()->isEmployer()): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('company.dashboard')); ?>">
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/be/images/new_dash_icon2.svg')); ?>" alt="" />My Dashboard
                                            </span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->isCandidate()): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('candidateProfile')); ?>">
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/fe/images/user-profile-18.png')); ?>" alt="" width="18" />My Profile
                                            </span>
                                        </a>
                                    </li>

                                    <li class="unmaskReq <?php if(Auth::user()->status==0): ?> d-none <?php endif; ?>" >
                                        <a class="dropdown-item" href="<?php echo e(route('candidates.requests')); ?>">
                                            <span class="download-btn">
                                                <i class="fa fa-eye"></i> Employer Requests
                                            </span>
                                        </a>
                                    </li>

                                    <!-- <li>
                      <a class="dropdown-item" href="<?php echo e(route('candidates.editpersonal')); ?>">
                        <span class="download-btn">
                          <img src="<?php echo e(asset('assets/fe/images/dp1.svg')); ?>" alt="" />Edit My Profile
                        </span>
                      </a>
                    </li> -->
                                    <?php endif; ?>
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
                                                <li><a href="<?php echo e(route('account.resetpassword')); ?>">Reset Password</a></li>
                                                <?php endif; ?>
                                                <li><a href="<?php echo e(route('account.delete')); ?>">Delete My Account</a></li>
                                                <li><a href="<?php echo e(route('account.sleep')); ?>">Put Account To Sleep</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                            </form>
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/fe/images/dp3.svg')); ?>" alt="" />Log Out
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('request-count')->html();
} elseif ($_instance->childHasBeenRendered('DeWI2nv')) {
    $componentId = $_instance->getRenderedChildComponentId('DeWI2nv');
    $componentTag = $_instance->getRenderedChildComponentTagName('DeWI2nv');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('DeWI2nv');
} else {
    $response = \Livewire\Livewire::mount('request-count');
    $html = $response->html();
    $_instance->logRenderedChild('DeWI2nv', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php endif; ?>
        </nav>
    </div>

    <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></button>
</header>





<?php $__env->startPush('scripts'); ?>
<script type="module">
    $(document).ready(function() {
        $('.dropdown-item-custom-menu').click(function() {
            $('.custom-collapse-menu').toggleClass('show');
            $('.arrow-img-dd').toggleClass('rotate-180');
            return false;
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/inc/header.blade.php ENDPATH**/ ?>