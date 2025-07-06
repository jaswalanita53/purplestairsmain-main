<div class="sidebar-nav ms-auto">
<style>
.sidebar_extended .show-on-sidebar-open{
display:flex;
}
.sidebar_extended .show-on-sidebar-close{
display:none;
}

.sidebar_show .show-on-sidebar-open{
display:none;
}
.sidebar_show .show-on-sidebar-close{
display:flex;
}
</style>
<script src=" https://use.fontawesome.com/e1fdc7929b.js"></script>


<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('update-request-count', [])->html();
} elseif ($_instance->childHasBeenRendered('l2761664651-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l2761664651-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2761664651-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2761664651-0');
} else {
    $response = \Livewire\Livewire::mount('update-request-count', []);
    $html = $response->html();
    $_instance->logRenderedChild('l2761664651-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

<li class="left-menu-one11 search-sub-menu <?php echo e(Route::is('company.dashboard') ? 'active current-menu-item-' : ''); ?>">
    <a href="<?php echo e(route('company.dashboard')); ?>" class="left-menu-one">
        <span class="menu-icon">
            
            <i class="fa fa-users" aria-hidden="true"></i>
        </span><em>All
            Candidates</em>
    </a>
</li>


<li class="left-menu-one11 <?php if(Request::is('company/saved-searches')): ?> active current-menu-item- <?php elseif(Request::is('company/saved-search/*')): ?> active current-menu-item- <?php else: ?> inactive <?php endif; ?>">
    <a href="<?php echo e(route('company.savedsearches')); ?>" class="left-menu-one">
        <span class="menu-icon"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>
        <em>My Searches</em></a>
    <ul class="menu-sub search-sub-menu ">
        <?php $__currentLoopData = $side_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if($search['status']=='Active'): ?>
        <?php if(!empty($search['slug'])): ?>
        <li>
            <a href="<?php echo e(route('company.savedsearch',$search['slug'])); ?>" class="submenu-innner">
                <?php
                //$searchName=str_replace(' ', '-', strtolower($search['name']));

                $slug='company/saved-search/'.$search['slug']; // 86a0h5r7c
                ?>
                <span class="submenu-innner-lft <?php if(Request::is($slug)): ?> active  <?php endif; ?>"><?php echo e($search['name']); ?></span>
                <span class="submenu-innner-rght">
                    <span class="notificate_number"><?php echo e($search['match_count']); ?></span>
                    <?php if($search['new_match_count'] > 0): ?>
                    <span class="notificate_total"><?php echo e($search['new_match_count']); ?> NEW</span>
                    <?php endif; ?>
                </span>
            </a>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</li>
<li class="left-menu-one11  <?php if(Request::is('company/archived-searches')): ?> active current-menu-item- <?php elseif(Request::is('company/archived-search/*')): ?> current-menu-item- active <?php else: ?> inactive <?php endif; ?>">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <a href="<?php echo e(route('company.archivedsearches')); ?>" class="left-menu-one"> -->
    <a  href="<?php echo e(url('/company/archived-searches')); ?>" class="show-on-sidebar-close left-menu-one  archived-collapse">
        <span class="menu-icon toggle-coll"><img src="<?php echo e(asset('assets/be/images/new_dash_icon3.svg')); ?>" alt=""/></span>
</a>

    <a data-toggle="collapse" href="#collapseExample" role="button" <?php if( Request::is('company/archived-search/*') || Request::is('company/archived-searches')): ?> aria-expanded="true" <?php else: ?> aria-expanded="false" <?php endif; ?>  aria-controls="collapseExample" class="left-menu-one archived-collapse show-on-sidebar-open">
        <span class="menu-icon toggle-coll"><img src="<?php echo e(asset('assets/be/images/new_dash_icon3.svg')); ?>" alt="" /></span>
        <em >Archived Searches</em>
           </a>
    <span class="collapse <?php if(Request::is('company/archived-search/*') || Request::is('company/archived-searches')): ?> show  <?php endif; ?>" id="collapseExample">
    <ul class="side-bar-ul">
        <li class="m-0 p-0 all-archived-pist-btn <?php if(Request::is('company/archived-searches')): ?> active <?php endif; ?>" ><a class="archived-list" href="<?php echo e(route('company.archivedsearches')); ?>"><em class="m-0 p-0">View All Archived Searches</em></a></li>
    </ul>
        <ul class="menu-sub archive-sub-menu">
        <!-- <li><a class="archived-list" data-url="<?php echo e(route('company.archivedsearches')); ?>"><span class="menu-icon"><img src="<?php echo e(asset('assets/be/images/new_dash_icon1.svg')); ?>" alt="" /></span><em >View All Archived Searches</em></a></li> -->
            <?php $__currentLoopData = $side_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($search['status']=='Archive')): ?>
            <?php
            //$searchName=str_replace(' ', '-', strtolower($search['name']));
            $slug='company/archived-search/'.$search['slug']; //86a0h5r7c
            ?>
            <li>
                <a href="<?php echo e(route('company.archivedsearch',$search['slug'])); ?>" class="submenu-innner">
                    <span class="submenu-innner-lft <?php if(Request::is($slug)): ?> active <?php endif; ?>"><?php echo e($search['name']); ?></span>
                    <span class="submenu-innner-rght">
                        <span class="notificate_number"><?php echo e($search['match_count']); ?></span>
                        <?php if($search['new_match_count'] > 0): ?>
                        <span class="notificate_total"><?php echo e($search['new_match_count']); ?> NEW</span>
                        <?php endif; ?>
                    </span>
                </a>
            </li>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </span>
</li>
</div>

<script>
  $("body").delegate(".toggle-coll", "click", function(e) {
      if ($('body').hasClass('sidebar_show')) {
        window.location.href = "<?php echo e(url('/company/archived-searches')); ?>"
    }

    })
</script>
<?php /**PATH /var/www/html/app/resources/views/livewire/searches.blade.php ENDPATH**/ ?>