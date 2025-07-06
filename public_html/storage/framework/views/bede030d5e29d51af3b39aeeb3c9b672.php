<div>
    <?php if(Auth::user()->isPublished() && Auth::user()->isCandidate()): ?>
        <div class="mask-btn ms-btn">
            <a href="<?php echo e(route('candidates.requests')); ?>">Unmask Requests <em><img
                        src="<?php echo e(asset('assets/fe/images/mask.png')); ?>" alt="" /></em>
                <sub><?php echo e(Auth::user()->pending_unmask_request->count()); ?></sub></a>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/request-count.blade.php ENDPATH**/ ?>