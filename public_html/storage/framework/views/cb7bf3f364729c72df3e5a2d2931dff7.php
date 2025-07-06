<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="form-points">
                <?php
                $step = 7;
                ?>
                <?php echo $__env->make('inc.steps', compact('step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </section>

    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>References</h5>
                    <div>
                        <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <a class="skip"  href="<?php echo e(route('candidatestep8')); ?>">Skip <em><img src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em></a>
                    </div>
                </div>
                <div class="gl-form form-sec">
                    <div class="warn-txt text-end">
                        <img src="images/warn.svg" alt="" />
                        <span>Add most recent First</span>
                    </div>

                    <?php $__currentLoopData = $references; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key > 0): ?>
                    <h6>Enter Additional Reference</h6>
                    <?php endif; ?>
                    <div class="gl-frm-outr mb-2">
                        <label>Name</label>
                        <div class="form-group disable-form">
                            <input type="text" placeholder="" class="form-control" wire:model.lazy="name.<?php echo e($reference->id); ?>" />
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" wire:model.lazy="name_status.<?php echo e($reference->id); ?>" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden <?php echo e($reference->name_status ? '' : 'show'); ?>">
                                <div class="d-span">
                                    <img src="<?php echo e(asset('assets/fe/images/hidden.svg')); ?>" alt="" />Hidden to
                                    everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr mb-2">
                        <label>Relationship</label>
                        <div class="form-group disable-form">
                            <input type="text" placeholder="" class="form-control" wire:model.lazy="relationship.<?php echo e($reference->id); ?>" />
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" wire:model.lazy="relationship_status.<?php echo e($reference->id); ?>" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden <?php echo e($reference->relationship_status ? '' : 'show'); ?>">
                                <div class="d-span">
                                    <img src="<?php echo e(asset('assets/fe/images/hidden.svg')); ?>" alt="" />Hidden to
                                    everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gl-frm-outr mb-2">
                        <label>Phone</label>
                        <div class="form-group disable-form">

                            <input type="text" placeholder="xxx-xxx-xxxx" maxlength="12" class="form-control telle" wire:model.lazy="phone.<?php echo e($reference->id); ?>" />

                            <?php echo $__env->make('inc.error', [
                            'field_name' => 'phone.' . $reference->id,
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" wire:model.lazy="phone_status.<?php echo e($reference->id); ?>" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden <?php echo e($reference->phone_status ? '' : 'show'); ?>">
                                <div class="d-span">
                                    <img src="<?php echo e(asset('assets/fe/images/hidden.svg')); ?>" alt="" />Hidden
                                    to everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr mb-0">
                        <label>Email</label>
                        <div class="form-group disable-form">
                            <input type="text" placeholder="" class="form-control" wire:model.lazy="email.<?php echo e($reference->id); ?>" />
                            <?php echo $__env->make('inc.error', [
                            'field_name' => 'email.' . $reference->id,
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="toggle-switch-block">
                                <span>show</span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" wire:model.lazy="email_status.<?php echo e($reference->id); ?>" tabindex="-1" />
                                </div>
                                <span>Hide</span>
                            </div>
                            <div class="hiden <?php echo e($reference->email_status ? '' : 'show'); ?>">
                                <div class="d-span">
                                    <img src="<?php echo e(asset('assets/fe/images/hidden.svg')); ?>" alt="" />Hidden
                                    to everyone

                                    <div class="in-ap">
                                        <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="gl-frm-btn">
                        <a href="#" class="pos-btn" wire:click.prevent="add()">
                            Add Reference
                            <span>+</span>
                        </a>
                    </div>
                    <div class="whole-btn-wrap dual-btn">
                        <input type="submit" value="Back" class="prev-btn" />
                        <input type="submit" value="Next" class="nxt-btn" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    //initiate languages select2
    document.addEventListener("livewire:load", () => {
        changePage();
        addDashes();
        Livewire.on('newReferenceAdded', function() {
            changePage();
            addDashes();
        });
    })

    function changePage() {
        $(".prev-btn").click(function(e) {
            e.preventDefault();
            location.replace('/candidate/skills')
        })
        $(".nxt-btn").click(function(e) {
            e.preventDefault();
            location.replace('/candidate/about')
        })
    }

    function addDashes() {
        //Add dashes to phone input
        $(".telle").keyup(function(event) {
            event.preventDefault();
            if (event.key != 'Backspace' && ($(this).val().length === 3 || $(this).val().length === 7)) {
                $(this).val($(this).val() + '-');
            }
        });
    }
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-step7.blade.php ENDPATH**/ ?>