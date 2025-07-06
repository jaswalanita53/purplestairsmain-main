<div>
    <?php if(Auth::user()->isPublished() && Auth::user()->isCandidate()): ?>
        <div class="mask-btn ms-btn">
            <a href="<?php echo e(route('candidates.requests')); ?>"><span class="emp-req-text d-md-inline d-none">Employer Requests</span><em class="ms-md-1 ms-0"><img
                        src="<?php echo e(asset('assets/fe/images/mask.png')); ?>" alt="" /></em>
                <sub><?php echo e(Auth::user()->pending_unmask_request->count()); ?></sub></a>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/app/resources/views/livewire/request-count.blade.php ENDPATH**/ ?>