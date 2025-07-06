<header class="main-head">
    <div class="container">
      <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
          <img src="<?php echo e(asset("assets/fe/images/new_logo.svg")); ?>" alt="" />
        </a>
        <button
          class="navbar-toggler navbar-toggler-main"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <!-- <span class="navbar-toggler-icon"></span> -->
          <span class="stick"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <button
            class="navbar-toggler navbar-toggler-main"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <!-- <span class="navbar-toggler-icon"></span> -->
            <span class="stick"></span>
          </button>
          <?php if(!Route::is('signupselect') && !Route::is('login') && !Route::is('register') && !Auth::check() && !Route::is('employer.login')): ?>
          <ul class="navbar-nav ms-auto">
            <li class="<?php echo e(Route::is('welcome') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route('welcome')); ?>">Home</a></li>
            <li class="<?php echo e(Route::is('mission') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route("mission")); ?>">Our Mission</a></li>
            <li class="<?php echo e(Route::is('pricing') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route("pricing")); ?>"> Pricing</a></li>
            <li class="<?php echo e(Route::is('features') ? 'current-menu-item' : ''); ?>"><a href="<?php echo e(route("features")); ?>">Features</a></li>
            <li class="mobile-li">            <a href="" class="btn hdr-btn hdr-bn2"
              >Login<span><img src="<?php echo e(asset("assets/fe/images/log.svg")); ?>" alt="" /></span
            ></a></li>
            <li class="mobile-li">        <a href="<?php echo e(route("signupselect")); ?>" class="btn hdr-btn"
              >Sign Up<span><img src="<?php echo e(asset("assets/fe/images/btn-img.svg")); ?>" alt="" /></span
            ></a></li>
          </ul>
          <?php endif; ?>
        </div>
        <?php if(!Route::is('signupselect') && !Route::is('login') && !Route::is('register') && !Auth::check() && !Route::is('employer.login')): ?>
        <div class="hdr-rgt">
          <a href="<?php echo e(route('login')); ?>" class="btn hdr-btn hdr-bn2"
          >Login<span><img src="<?php echo e(asset("assets/fe/images/log.svg")); ?>" alt="" /></span
        ></a>
          <a href="<?php echo e(route("signupselect")); ?>" class="btn hdr-btn"
            >Sign Up<span><img src="<?php echo e(asset("assets/fe/images/btn-img.svg")); ?>" alt="" /></span
          ></a>
        </div>
        <?php endif; ?>

        <?php if(Auth::check() && !Route::is('verification.notice')): ?>
        <div class="hdr-rgt hdr-rgt2">
            <div class="header-list">
              <ul class="notification_list">
                <li class="middle-icon-one">
                  <div class="dropdown avatar-dropdown">
                    <button
                      class="btn btn-secondary dropdown-toggle"
                      type="button"
                      id="dropdownMenuButton2"
                      data-bs-toggle="dropdown"
                      aria-expanded="true"
                    >
                      <span class="avatar-img">
                        <?php if(Auth::user()->profile_photo_path): ?>
                        <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" width="50px" height="50px" style="border-radius:50%"/>
                        <?php else: ?>
                        <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt=""/>
                        <?php endif; ?>
                      </span>
                      <?php echo e(Auth::user()->name); ?>

                    </button>
                    <ul
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton2"
                    data-popper-placement="bottom-end"
                  >
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
                          <img src="<?php echo e(asset('assets/fe/images/user-profile-18.png')); ?>" alt="" width="18"/>My Profile
                        </span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?php echo e(route('candidates.editpersonal')); ?>">
                        <span class="download-btn">
                          <img src="<?php echo e(asset('assets/fe/images/dp1.svg')); ?>" alt="" />Edit My Profile
                        </span>
                      </a>
                    </li>
                    <?php endif; ?>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="download-btn">
                          <img src="<?php echo e(asset('assets/fe/images/dp2.svg')); ?>" alt="" />Manage My Account
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
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                      onclick="event.preventDefault();
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
} elseif ($_instance->childHasBeenRendered('EWPjzTl')) {
    $componentId = $_instance->getRenderedChildComponentId('EWPjzTl');
    $componentTag = $_instance->getRenderedChildComponentTagName('EWPjzTl');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('EWPjzTl');
} else {
    $response = \Livewire\Livewire::mount('request-count');
    $html = $response->html();
    $_instance->logRenderedChild('EWPjzTl', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php endif; ?>
      </nav>
    </div>

    <button
      class="navbar-toggler"
      id="navoverlay"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    ></button>
  </header>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/inc/header.blade.php ENDPATH**/ ?>