<div>
    <div class="login-sec pt-4 log-h-sec ban-up ban-up3 ht_center_div">
        <div class="login-sec-wrap">
            <div class="container">
                <div class="log-wrap" style="background-image: url(/assets/fe/images/log-back.png)">
                    <div class="login-outr">
                        <?php if(session()->has('message')): ?>
                        <h2>password was updated</h2>
                        <?php else: ?>
                        <h2>Create New Password</h2>
                        <?php endif; ?>
                        <p>
                            Your new password must be different from previously used
                            passwords.
                        </p>
                        <form wire:submit.prevent="updatePassword()">
                            <div class="form-input">
                             <div class="form_ipp_passwordd">
                                 <input type="password" class="pass_chk form-control" placeholder="Current Password" wire:model.lazy="current_password" >
                                 <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                             </div>
                                 <?php echo $__env->make('inc.error', [
                                 'field_name' => 'current_password',
                                 ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="form-input">
                             <div class="form_ipp_passwordd">
                                 <input type="password" class="pass_chk form-control" placeholder="New Password" wire:model.lazy="password" >
                                 <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                             </div>
                                 <?php echo $__env->make('inc.error', [
                                 'field_name' => 'password',
                                 ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <!-- <div class="form-input">
                                <input type="password" placeholder="Current Password" class="form-control pass_chk"
                                    wire:model.lazy="current_password" />
                                    <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                                <?php echo $__env->make('inc.error', [
                                    'field_name' => 'current_password',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div> -->
                            <!-- <div class="form-input">
                                <input type="password" placeholder="New Password" class="form-control pass"
                                    wire:model.lazy="password" />
                                <?php echo $__env->make('inc.error', [
                                    'field_name' => 'password',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div> -->
                            <p class="text-start noti-txt">Must be at lease 8 characters</p>
                            <div class="form-input">
                             <div class="form_ipp_passwordd">
                                 <input type="password" class="pass_chk form-control" placeholder="Confirm New Password" wire:model.lazy="confirmPassword" >
                                 <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                             </div>
                                 <?php echo $__env->make('inc.error', [
                                 'field_name' => 'confirmPassword',
                                 ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                            <!-- <div class="form-input">
                                <input type="password" placeholder="Confirm New Password" class="form-control"
                                    wire:model.lazy="confirmPassword" />
                                <?php echo $__env->make('inc.error', [
                                    'field_name' => 'confirmPassword',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div> -->
                            <p class="text-start noti-txt">Both password must match.</p>

                            <div class="form-input">

                                <input type="submit" value="Reset Password" class="sub-btn" />
                            </div>
                        </form>
                    </div>
                    <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1">
                    <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2">
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/reset-password.blade.php ENDPATH**/ ?>