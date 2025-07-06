<div wire:poll.5s>
    <ul class="sidebar-tabs sidebar-tabs-show- text-center">
        <li class="r-left left-menu-one11"><a href="<?php echo e(route('company.requested')); ?>"
                class="<?php echo e(Route::is('company.requested') ? 'active' : ''); ?> left-menu-one ">
                <span class="sidebar-tabs-icon menu-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                <em class="sidebar-tabs-text">Requested(<span class="req-count"><?php echo e($requested_count); ?></span>)</em>
            </a>

        </li>
        <li class="r-left left-menu-one11"><a href="<?php echo e(route('company.unmasked')); ?>"
                class="<?php echo e(Route::is('company.unmasked') ? 'active' : ''); ?> left-menu-one unmasked_icon">
                <span class="sidebar-tabs-icon icon-container menu-icon">
                    <img class="sidebar-tabs-icon" src="<?php echo e(asset('assets/be/images/new_dash_icon1.svg')); ?>"
                        alt="" height="14" width="20" />
                    
                </span>
                <em class="sidebar-tabs-text">Unmasked(<span class="unm-count"><?php echo e($unmasked_count); ?></span>)
                    <?php if($new_unmask_candidates): ?>
                        <small>NEW <?php echo e($new_unmask_candidates); ?></small>
                    <?php endif; ?>
                </em>
            </a>
        </li>
    </ul>
</div>
<?php /**PATH /var/www/html/app/resources/views/livewire/update-request-count.blade.php ENDPATH**/ ?>