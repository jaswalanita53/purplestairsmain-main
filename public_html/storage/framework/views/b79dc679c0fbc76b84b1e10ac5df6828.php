<div class="c-left">
    <div class="left-panel-main new_h">
        <div class="top-logo1">
            <a href="<?php echo e(url('/')); ?>" class="logo">
                <img src="<?php echo e(asset('assets/be/images/folded-p.svg')); ?>" alt="" class="logo_for_small_bar" />
                <img src="<?php echo e(asset('assets/be/images/new_log.svg')); ?>" alt="" class="default_logo" />
            </a>

            <button class="menu_toggle mbl">
                <img src="<?php echo e(asset('assets/be/images/left-arrw.svg')); ?>" alt="" class="arrow-left"/>
            </button>


        </div>

        <div class="left-menu">
            <ul class="sidebar-nav ms-auto">

                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('searches')->html();
} elseif ($_instance->childHasBeenRendered('qRqK0UE')) {
    $componentId = $_instance->getRenderedChildComponentId('qRqK0UE');
    $componentTag = $_instance->getRenderedChildComponentTagName('qRqK0UE');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qRqK0UE');
} else {
    $response = \Livewire\Livewire::mount('searches');
    $html = $response->html();
    $_instance->logRenderedChild('qRqK0UE', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <!-- <li class="left-menu-one11">
                    <a href="<?php echo e(route('company.savedsearches')); ?>" class="left-menu-one">
                        <span class="menu-icon"><img src="<?php echo e(asset('assets/be/images/new_dash_icon1.svg')); ?>" alt="" /></span>
                        <em>My Searches</em></a>



                </li>

                <li class="left-menu-one11">
                    <a href="<?php echo e(route('company.archivedsearches')); ?>" class="left-menu-one">
                        <span class="menu-icon"><img src="<?php echo e(asset('assets/be/images/new_dash_icon3.svg')); ?>" alt="" /></span>
                        <em>Archived Searches</em></a>
                </li> -->
            </ul>

            <div class="float_menu">
                <ul class="sidebar-nav ms-auto sidebar-nav-bottom">
                    <?php if(auth()->user()->reference > 0): ?>
                    <?php else: ?>
                    <li class="left-menu-one11">
                        <a href="<?php echo e(route('company.editprofile')); ?>" class="left-menu-one">
                            <span class="menu-icon"><img src="<?php echo e(asset('assets/be/images/user_icon.svg')); ?>" alt="" /></span>
                            <em>Edit Profile </em></a>
                    </li>
                    <li class="left-menu-one11">
                        <a href="<?php echo e(route('company.manage.subsciption')); ?>" class="left-menu-one">
                            <span class="menu-icon"><img src="<?php echo e(asset('assets/be/images/settings_icon.svg')); ?>" alt="" /></span>
                            <em> Manage Subscription </em></a>
                    </li>
                    <?php endif; ?>
                    <li class="left-menu-one11">
                        <a href="#url" class="left-menu-one logoutBtn">
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
<style>
  div#swal2-html-container {

    margin-bottom: 23px !important;

}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $('.menu_toggle').click(function(e) {
        alert();
    });


    $("body").delegate(".logoutBtn", "click", function(e) {
    Swal.fire({
    // title: "Opting out of this section causes you to appear as an entry-level candidate. To avoid this without revealing your position, add your information and select the hide option.",
    text: 'Are you sure you want to log out?',
    icon: 'warning',
    iconHtml: "<img src='<?php echo e(asset('assets/fe/images/warning.png')); ?>'>",
    showCancelButton: true,
    confirmButtonColor: '#7E50A7',
    cancelButtonColor: '#4A2D64',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    showCloseButton: true,
    }).then((result) => {
    if (result.isConfirmed) {
    $('#logout-form').submit();
    } else {
    return false;
    }
    });
    });
</script>
<?php /**PATH /var/www/html/app/resources/views/inc/sidebar.blade.php ENDPATH**/ ?>