<div>
    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
            <div class="form-points">
                <?php
                $step = 7; $current_step = auth()->user()->current_step;
                ?>
                <?php echo $__env->make('inc.steps', compact('step', 'current_step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </section>

    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>References</h5>
                    <div>
                        
                        <a class="skip"  href="<?php echo e(route('candidatestep8')); ?>">Skip <em><img src="<?php echo e(asset('assets/fe/images/skip-arrw.svg')); ?>" alt="" /></em></a>
                    </div>
                </div>
                <form wire:submit.prevent="saveReference()">
                <div class="gl-form form-sec">
                    <!-- <div class="warn-txt text-end">
                        <img src="images/warn.svg" alt="" />
                        <span>Add most recent First</span>
                    </div> -->

                    <?php $__currentLoopData = $references; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key > 0): ?>
                    
                    <h6>Enter Additional Reference <button type="button" class="remove_additional_sec" wire:click="removeRef(<?php echo e($reference->id); ?>)"><img src="<?php echo e(asset('assets/fe/images/delete.svg')); ?>" alt="Remove Section" /></button></h6>
                    <?php endif; ?>
                    <div class="gl-frm-outr mb-3">
                        <label>Name</label>
                        <div class="form-group disable-form">
                            <input type="text" placeholder="" class="form-control input-name" wire:model.defer="name.<?php echo e($reference->id); ?>" />
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
                            <?php if(!empty($reference_name_error[$reference->id])): ?>
                                            <span class="text-danger error"><?php echo e($reference_name_error[$reference->id]); ?></span>
                                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="gl-frm-outr mb-3">
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

                    <div class="gl-frm-outr mb-3">
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
                    <div class="gl-frm-outr mb-3">
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
                        <input type="submit" value="Next" class="nxt-btn" wire:loading.remove wire:target="saveReference"/>
                        <input type="button" value="Saving..." class="nxt-btn" wire:loading wire:target="saveReference"/>
                    </div>
                </div>
                </form>
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
        // $(".nxt-btn").click(function(e) {
        //     // e.preventDefault();
        //     // location.replace('/candidate/about')
        //     window.location.href='<?php echo e(url("/candidate/about")); ?>';
        // })
        $("body").delegate(".nxt-btn", "click", function(e) {
            // e.preventDefault();
            var count = 0;
            count=$('.text-danger').length;
            $(this).parents(".common-form-outr").find(".telle").each(function() {
                var regex = /^\d{3}-\d{3}-\d{4}$/;
                if($(this).val()!=""){
                    if (!regex.test($(this).val())) {
                        $(this).parents(".form-group").find(".text-danger").remove();
                        $(this).parents(".form-group").find("input:first").focus();
                        $(this)
                            .parents(".form-group")
                            .append(
                                '<div class="text-danger" style=""> The phone field format is invalid.</div>'
                            );
                        count++;
                    }
                }
            });

            if (count > 0) {
                $('.text-danger:first').parents(".form-group").find("input:first").focus();
                return false;
            }
            // window.location.href='<?php echo e(url("/candidate/about")); ?>';
            return true;
        })
    }

    function addDashes() {
        //Add dashes to phone input
        // $(".telle").keyup(function(event) {
        //     event.preventDefault();
        //     if (event.key != 'Backspace' && ($(this).val().length === 3 || $(this).val().length === 7)) {
        //         $(this).val($(this).val() + '-');
        //     }
        // });
    }

    $("body").delegate(".telle", "keypress", function(e) {
                var inputValue = $(this).val();
                var charCode = event.which;

                if (
                    (charCode < 48 || charCode > 57) && // Not a number
                    charCode !== 45 && // Not a hyphen
                    charCode !== 8 && // Backspace
                    charCode !== 0 && // Arrow keys, function keys, etc.
                    !event.ctrlKey // Control key combination
                ) {
                    event.preventDefault();
                    return false;
                }

            });
    document.addEventListener("livewire:load", () => {

    $("body").delegate(".telle", "keyup paste", function(e) {
      var v = $(this).val().replace(/\D/g, ''); // Remove non-numerics
      if(v.length<10){
      v = v.replace(/(\d{3})(?=\d)/g, '$1-'); // Add dashes every 4th digit
      $(this).val(v)
      }
    //   if(v.length>10){
    //   v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
    //   $(this).val(v.substr(0, 12))
    //   }
    v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
      $(this).val(v.substr(0, 12))
});
});

document.addEventListener("livewire:load", () => {

$("body").delegate(".input-name", "keyup", function(e) {

        $(this).parents('.form-group').find('.text-danger').remove();

    });
});


    //Add dashes to phone input
    // $("body").delegate(".telle", "keyup", function(event) {
    //     var tele=$(this).val();
    //     if (event.key != 'Backspace' && (tele.length === 3 || tele.length === 7)) {
    //     tele += '-';
    //     $(this).val(tele);
    //     console.log('tele',tele);
    //     }
    // })

</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidate-step7.blade.php ENDPATH**/ ?>