<div class="modal fade" id="manageuModal" aria-hidden="true" aria-label="manageuModalLabel"
    tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Current Subscription - <?php if(!empty($active_plan['number_of_users'])): ?><?php echo e($active_plan['number_of_users']); ?> <?php if($active_plan['number_of_users']==1): ?> User <?php else: ?> Users <?php endif; ?> <?php endif; ?> <h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="cmn-form">
                        <div class="form-sec gl-form">
                            <form wire:submit.prevent="updateUsers()" id="nou-form">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="gl-frm-outr mb-0">
                                            <div class="form-group my-3 num-users">
                                                <label>Add Users</label>
                                                <!-- <input type="number" placeholder="" class="form-control search-name" value="<?php echo e($number_of_users); ?>"
                                                    wire:model.lazy="number_of_users" min="<?php echo e($active_plan['plan_period'] == 'month' ? 1 : $active_plan['number_of_users']); ?>" wire:change="update_amount_onusers()"/> -->
                                                <input type="number" placeholder="" class="form-control search-name" value="<?php echo e($number_of_users); ?>"
                                                    wire:model.lazy="number_of_users" min="<?php echo e($active_plan['plan_period'] == 'month' ? 1 : $active_plan['number_of_users']); ?>" wire:change="update_amount_onusers()"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="gl-frm-outr mb-0">
                                            <div class="form-group my-3">
                                                <label>Additional Charge ($)</label>
                                                <input type="number" placeholder="Amount($)" class="form-control search-name" value="<?php echo e($price_on_number_of_users); ?>" readonly
                                                    wire:model.lazy="price_on_number_of_users" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-submit-btn mb-0 mt-2">
                                    <input type="submit" value="Process Payment" class="submit-btn" wire:loading.remove wire:target="updateUsers" <?php echo e(empty($active_card) ? 'disabled' : ''); ?>/>
                                    <input type="button" value="Processing..." class="submit-btn" wire:loading wire:target="updateUsers"/>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/app/resources/views/inc/manage_users.blade.php ENDPATH**/ ?>