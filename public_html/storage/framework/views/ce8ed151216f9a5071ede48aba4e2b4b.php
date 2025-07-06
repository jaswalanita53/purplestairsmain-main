<div class="back-clr ban-up">
    <section class="profile-banner cmn-gap pb-0">
        <div class="container">
            <div class="profile-outr">
                <h1>
                    Edit My Profile
                </h1>
                <img src="<?php echo e(asset('assets/fe/images/pc2.png')); ?>" alt="" class="pic6 pc2" />
                <img src="<?php echo e(asset('assets/fe/images/pc1.png')); ?>" alt="" class="pic0">
            </div>
            <div class="preview-upper pv-ax">
                <div class="preview-uppr-rgt">
                    <a href="<?php echo e(route('company.viewprofile')); ?>" class="blue_btn">Preview Profile
                    </a>
                </div>
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
                            <input type="text" class="form-control" wire:model.lazy="company_name"/>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Company Email*</label>
                        <div class="form-group">
                            <input type="email" class="form-control" wire:model.lazy="company_email"/>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'company_email',
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Company Address*</label>
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model.lazy="company_address"/>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'company_address',
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Company Phone*</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="telle" maxlength="12" wire:model.lazy="company_phone" placeholder="xxx-xxx-xxxx"/>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'company_phone',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Website URL</label>
                        <div class="form-group">
                            <input type="url" class="form-control" wire:model.lazy="website_url"/>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'website_url',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Social Media URL</label>
                        <div class="form-group">
                            <input type="url" class="form-control" wire:model.lazy="social_media_url"/>
                            <?php echo $__env->make('inc.error', [
                                'field_name' => 'social_media_url',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="whole-btn-wrap dual-btn">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
            <div class="common-form-outr">
                <div class="form-hdr">
                    <h5>Company Info</h5>
                    <div>
                        <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="gl-form form-sec">

                    <div class="gl-frm-outr number_of_emp">
                        <label>Number Of Employees</label>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="" wire:model.lazy="number_of_employees"/>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Company Benefits</label>
                        <div class="form-sec-left form-group">
                            <div class="form-group-for-custom-checkbox thrd-form">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" checked="" wire:model.lazy="insurance_benefits">
                                        <span>Insurance Benefits</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="paid_holidays">
                                        <span> Paid Holidays</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="paid_vacation_days">
                                        <span>Paid Vacation Days</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="professional_environment">
                                        <span>Professional Environment</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model.lazy="casual_environment">
                                        <span>Casual Environment</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <label>Short Company Description</label>
                        <div class="form-group">
                            <textarea class="lg-textarea" wire:model.lazy="company_description" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="gl-frm-outr">
                        <div class="up-outr-wrp">
                            <div class="upload-wrp">
                                <a href="#">
                                <?php if(Auth::user()->profile_photo_path): ?>
                        <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" style="border-radius: 50%; width:114px !important; height:114px !important;"/>
                        <?php else: ?>
                        <img src="<?php echo e(asset('assets/fe/images/im-up.svg')); ?>" alt="" style="border-radius: 50%"/>
                        <?php endif; ?>

                            </a>
                            </div>
                            <a href="javascript:void(0)" class="photo-btn upld"><input type="file">Upload Logo</a>
                        </div>
                        <div style="margin-left: 135px; margin-top: -25px; color: #8f8f8f !important; font-size: 12px;">
                    <p>Acceptable file formats: JPG/PNG, max size 1MB</p>
                  </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    //Add dashes to phone input
    var tele = document.querySelector('#telle');

    tele.addEventListener('keyup', function(e){
    if (event.key != 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)){
    tele.value += '-';
     }
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/company-edit.blade.php ENDPATH**/ ?>