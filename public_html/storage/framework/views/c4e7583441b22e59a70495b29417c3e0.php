<div>
    <div class="back-clr ban-up">
        <section class="profile-banner cmn-gap pb-0">
            <div class="container">
                <div class="form-points">
                    <?php
                    $step = 1
                    ?>
                    <?php echo $__env->make('inc.employersteps',compact('step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="profile-outr">

                    <h1>
                        Employer Information
                    </h1>

                    <img src="<?php echo e(asset('assets/fe/images/pc2.png')); ?>" alt="" class="pic6 pc2" />
                    <img src="<?php echo e(asset('assets/fe/images/pc1.png')); ?>" alt="" class="pic0">
                </div>
            </div>
        </section>

        <div class="common-form-wrap cmn-gap pt-0">
            <div class="container">
                <div class="common-form-outr">
                    <div class="form-hdr">
                        <h5>Contact Information</h5>
                        <div>
                            <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="gl-form form-sec">
                        <div class="gl-frm-outr">
                            <label>Company Name*</label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" wire:model.lazy="company_name"/>
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Company Email*</label>
                            <div class="form-group">
                                <input type="email" placeholder="" class="form-control" wire:model.lazy="company_email"/>
                                <?php echo $__env->make('inc.error', [
                                    'field_name' => 'company_email',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Company Address*</label>
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" wire:model.lazy="company_address"/>
                                <?php echo $__env->make('inc.error', [
                                    'field_name' => 'company_address',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Company Phone*</label>
                            <div class="form-group">
                                <input type="text" placeholder="xxx-xxx-xxxx" id="telle" maxlength="12" class="form-control" wire:model.lazy="company_phone"/>
                                <?php echo $__env->make('inc.error', [
                                    'field_name' => 'company_phone',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Website URL</label>
                            <div class="form-group">
                                <input type="url" placeholder="" class="form-control" wire:model.lazy="website_url"/>
                                <?php echo $__env->make('inc.error', [
                                    'field_name' => 'website_url',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <div class="gl-frm-outr">
                            <label>Social Media URL</label>
                            <div class="form-group">
                                <input type="url" placeholder="" class="form-control" wire:model.lazy="social_media_url"/>
                                <?php echo $__env->make('inc.error', [
                                    'field_name' => 'social_media_url',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>

                        <div class="whole-btn-wrap dual-btn">
                            <input type="submit" value="Back" class="prev-btn">
                            <input type="submit" value="Next" class="nxt-btn">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    $(".nxt-btn").click(function(e){
        e.preventDefault();
        location.replace('/company/company-info')
    })

     //Add dashes to phone input
     var tele = document.querySelector('#telle');

     tele.addEventListener('keyup', function(e){
     if (event.key != 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)){
     tele.value += '-';
     }
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/company-step1.blade.php ENDPATH**/ ?>