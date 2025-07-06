<div class="c-left">
    <div class="left-panel-main new_h">
        <div class="top-logo1">
            <a href="index.html" class="logo">
                <img src="<?php echo e(asset('assets/be/images/folded-p.svg')); ?>" alt="" class="logo_for_small_bar" />
                <img src="<?php echo e(asset('assets/be/images/new_log.svg')); ?>" alt="" class="default_logo" />
            </a>
            <button class="menu_toggle mbl">
                <img src="<?php echo e(asset('assets/be/images/left-arrw.svg')); ?>" alt="" />
            </button>
        </div>

        <div class="left-menu">
            <ul class="sidebar-nav ms-auto">
                <li class="<?php echo e(Route::is('company.dashboard') ? 'current-menu-item' : ''); ?>left-menu-one11">
                    <a href="<?php echo e(route('company.dashboard')); ?>" class="left-menu-one">
                        <span class="menu-icon">
                            <img src="<?php echo e(asset('assets/be/images/new_dash_icon1.svg')); ?>" alt="" />
                        </span><em>All
                            Candidates</em>
                    </a>
                </li>

                <li class="left-menu-one11">
                    <a href="<?php echo e(route('company.savedsearches')); ?>" class="left-menu-one">
                        <span class="menu-icon"><img src="<?php echo e(asset('assets/be/images/new_dash_icon1.svg')); ?>" alt="" /></span>
                        <em>My Searches</em></a>

                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('searches')->html();
} elseif ($_instance->childHasBeenRendered('0vkA7CW')) {
    $componentId = $_instance->getRenderedChildComponentId('0vkA7CW');
    $componentTag = $_instance->getRenderedChildComponentTagName('0vkA7CW');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('0vkA7CW');
} else {
    $response = \Livewire\Livewire::mount('searches');
    $html = $response->html();
    $_instance->logRenderedChild('0vkA7CW', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

                </li>

                <li class="left-menu-one11">
                    <a href="<?php echo e(route('company.archivedsearches')); ?>" class="left-menu-one">
                        <span class="menu-icon"><img src="<?php echo e(asset('assets/be/images/new_dash_icon3.svg')); ?>" alt="" /></span>
                        <em>Archived Searches</em></a>
                </li>
            </ul>

            <div class="float_menu">
                <ul class="sidebar-nav ms-auto">
                    <li class="left-menu-one11">
                        <a href="<?php echo e(route('company.editprofile')); ?>" class="left-menu-one">
                            <span class="menu-icon"><img src="<?php echo e(asset('assets/be/images/user_icon.svg')); ?>" alt="" /></span>
                            <em>Edit Profile </em></a>
                    </li>
                    <li class="left-menu-one11">
                        <a href="#url" class="left-menu-one">
                            <span class="menu-icon"><img src="<?php echo e(asset('assets/be/images/settings_icon.svg')); ?>" alt="" /></span>
                            <em> Manage Subsciption </em></a>
                    </li>
                    <li class="left-menu-one11">
                        <a href="#url" class="left-menu-one" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <span class="menu-icon"><img src="<?php echo e(asset('assets/be/images/logout.svg')); ?>" alt="" /></span>
                            <em>Log Out</em></a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.menu_toggle').click(function(e) {
        alert();
    });
</script><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/inc/sidebar.blade.php ENDPATH**/ ?>