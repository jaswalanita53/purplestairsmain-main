    <ul class="menu-sub">
    <?php $__currentLoopData = $side_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <a href="<?php echo e(route('company.savedsearch',$search['slug'])); ?>" class="submenu-innner">
                <span class="submenu-innner-lft"><?php echo e($search['name']); ?></span>
                <span class="submenu-innner-rght">
                    <span class="notificate_number"><?php echo e($search['match_count']); ?></span>
                    <?php if($search['new_match_count'] > 0): ?>
                    <span class="notificate_total"><?php echo e($search['new_match_count']); ?> NEW</span>
                    <?php endif; ?>
                </span>
            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/searches.blade.php ENDPATH**/ ?>