<div>
    <div>
        <?php if(!$published): ?>
            <div class="preview-sec cmn-gap pt-0 back-clr ban-up">
                <div class="preview-wrap preview-wrap-final">
                    <div class="container">
                        <div class="preview_banner_total">
                            <div class="preview-banner">
                                <div class="preview-banner-fig">
                                    <figure>
                                        <img src="<?php echo e(asset('assets/fe/images/candi-banner-img.png')); ?>" alt=""
                                            class="desktop-v" />
                                        <img src="<?php echo e(asset('assets/fe/images/ban-mob-image.png')); ?>" alt=""
                                            class="mobile-v" />
                                    </figure>
                                </div>
                            </div>
                            <div class="preview_banner_btm">
                                <div class="preview_banner_img_sec">
                                    <div class="preview_banner_img_sec_left">
                                        <figure>
                                            <?php if($candidate_user->profile_photo_path): ?>
                                            <img src="<?php echo e(asset($candidate_user->profile_photo_path)); ?>" alt="" />
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('/assets/fe/images/profile-pic.png')); ?>" alt="" />
                                            <?php endif; ?>
                                        </figure>
                                        <?php if($this->mode): ?>
                                        <?php if($requestCompany): ?>
                                        <div class="request_btn_otr">
                                            <a href="#url" class="request_btn"><span><img src="<?php echo e(asset('assets/fe/images/ylw_lock.svg')); ?>"
                                                        alt="" /></span>Pending</a>
                                        </div>
                                        <?php else: ?>
                                        <div class="request_btn_otr">
                                            <a href="#url" class="request_btn"><span><img src="<?php echo e(asset('assets/fe/images/ylw_lock.svg')); ?>"
                                                        alt="" /></span>Request Unmask</a>
                                            <div class="position_form" wire:ignore.self>
                                                <div class="request_close">
                                                    <button type="button" class="close close_req_mask">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form wire:submit.prevent="sendRequest()">
                                                    <div class="form-group">
                                                        <label>Position Available*</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Job title here" wire:model.lazy="position_hiring"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Message to Candidate</label>
                                                        <textarea placeholder="I reviewed your resume..." wire:model.lazy="message"></textarea>
                                                    </div>
                                                    <div class="position-submit-btn-otr" wire:loading.remove wire:target="sendRequest">
                                                        <input type="submit" value="Send to Candidate"
                                                            class="position_submit_btn" />
                                                    </div>
                                                    <div class="position-submit-btn-otr" wire:loading wire:target="sendRequest">
                                                        <input type="submit" value="Sending..." disabled
                                                            class="position_submit_btn" />
                                                    </div>
                                                </form>
                                                <?php if($messageSent): ?>
                                                <span class="message_snt_sec">Your Message Has Been Sent.</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="preview_banner_img_sec_rgt">
                                        <div class="preview_banner_img_sec_rgt_wrapper">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="defination-sec">
                                                        <div class="title">
                                                            <h4>
                                                                <?php if($mode): ?>
                                                                    <em class="blured_txt">Name</em>
                                                                <?php else: ?>
                                                                    <?php echo e($personal->name); ?>

                                                                <?php endif; ?>

                                                                <?php if($mode): ?>
                                                                <a href="#">
                                                                    <img src="<?php echo e(asset('assets/fe/images/linkdin-ylw.svg')); ?>" alt=""/>
                                                                </a>
                                                                <a href="#">
                                                                    <img src="<?php echo e(asset('assets/fe/images/globe-ylw.svg')); ?>" alt="" />
                                                                </a>
                                                                <?php else: ?>
                                                                <a href="<?php echo e(fix_url_protocol($personal->linkedin_url)); ?>">
                                                                    <img src="<?php echo e(asset('assets/fe/images/linkdin-ylw.svg')); ?>" alt=""/>
                                                                </a>
                                                                <a href="<?php echo e(fix_url_protocol($personal->additional_url)); ?>">
                                                                    <img src="<?php echo e(asset('assets/fe/images/globe-ylw.svg')); ?>" alt="" />
                                                                </a>
                                                                <?php endif; ?>
                                                            </h4>
                                                            <h5>
                                                                Current Position:
                                                                <span><?php echo e($personal->current_title); ?></span>
                                                            </h5>
                                                        </div>
                                                        <div class="preview_contact_sec mobile-v">
                                                            <ul class="preview_contact_list wrpn">
                                                                <li>
                                                                    <span class="contact_icon"><img
                                                                            src="<?php echo e(asset('assets/fe/images/ylw-tell.svg')); ?>"
                                                                            alt="" /></span>
                                                                    <div class="contact_rgt_side">
                                                                        <h5>Phone No</h5>
                                                                        <?php if($mode): ?>
                                                                            <a class="blured_txt" href="tel:">phone
                                                                                no
                                                                            </a>
                                                                        <?php else: ?>
                                                                            <a class=""
                                                                                href="tel:<?php echo e($personal->phone); ?>"><?php echo e($personal->phone); ?>

                                                                            </a>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="contact_icon"><img
                                                                            src="<?php echo e(asset('assets/fe/images/prpl-envlp.svg')); ?>"
                                                                            alt="" /></span>
                                                                    <div class="contact_rgt_side">
                                                                        <h5>Email</h5>
                                                                        <a
                                                                            href="mailto:info@purplestair.com">info@purplestair.com</a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="defination_list">
                                                            <h5>Industries:</h5>
                                                            <ul>
                                                                <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li><?php echo e($industry); ?></li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        </div>
                                                        <div class="defination_list">
                                                            <h5>Area of Interest:</h5>
                                                            <ul>
                                                                <?php $__currentLoopData = $interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li><?php echo e($interest); ?></li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="preview_contact_sec desktop-v">
                                                        <ul class="preview_contact_list wrpn">
                                                            <li>
                                                                <span class="contact_icon"><img
                                                                        src="<?php echo e(asset('assets/fe/images/ylw-tell.svg')); ?>"
                                                                        alt="" /></span>
                                                                <div class="contact_rgt_side">
                                                                    <h5>Phone No</h5>
                                                                    <?php if($mode): ?>
                                                                        <a class="blured_txt" href="tel:">phone
                                                                            no</a>
                                                                    <?php else: ?>
                                                                        <a
                                                                            href="tel:<?php echo e($personal->phone); ?>"><?php echo e($personal->phone); ?></a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <span class="contact_icon"><img
                                                                        src="<?php echo e(asset('assets/fe/images/prpl-envlp.svg')); ?>"
                                                                        alt="" /></span>
                                                                <div class="contact_rgt_side">
                                                                    <h5>Email</h5>
                                                                    <?php if($mode): ?>
                                                                        <a class="blured_txt" href="mailto:">Email</a>
                                                                    <?php else: ?>
                                                                        <a
                                                                            href="mailto:<?php echo e($personal->email); ?>"><?php echo e($personal->email); ?></a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview_banner_img_btm">
                                    <ul class="preview_banner_img_list">
                                        <li>
                                            <div class="preview_banner_img_list_inner">
                                                <h6>Location:</h6>
                                                <p><?php echo e($personal->address); ?>,<?php echo e($personal->country_abbr); ?></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="preview_banner_img_list_inner">
                                                <h6>Asking Salary:</h6>
                                                <p><?php echo e($personal->salary_range); ?></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="preview_banner_img_list_inner">
                                                <h6>Compensation:</h6>
                                                <?php if($personal->compensation_salary): ?>
                                                    <p>Salary</p>
                                                <?php endif; ?>
                                                <?php if($personal->compensation_hourly): ?>
                                                    <p>Hourly</p>
                                                <?php endif; ?>
                                                <?php if($personal->compensation_comission_based): ?>
                                                    <p>Comission Based</p>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="preview_banner_img_list_inner">
                                                <h6>&nbsp;</h6>
                                                <?php if($personal->schedule_full_time): ?>
                                                    <p>Full Time</p>
                                                <?php endif; ?>
                                                <?php if($personal->schedule_part_time): ?>
                                                    <p>Part Time</p>
                                                <?php endif; ?>
                                                <?php if($personal->schedule_no_preference): ?>
                                                    <p>No Preference</p>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="preview_banner_img_list_inner">
                                                <h6>Open to:</h6>
                                                <ul class="tick_list">
                                                    <?php if($personal->work_environment_remote): ?>
                                                        <li>
                                                            <span><img
                                                                    src="<?php echo e(asset('assets/fe/images/sky_blue.svg')); ?>"
                                                                    alt="" /></span>Remote
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if($personal->work_environment_hybrid): ?>
                                                        <li>
                                                            <span><img
                                                                    src="<?php echo e(asset('assets/fe/images/sky_blue.svg')); ?>"
                                                                    alt="" /></span>Hybrid
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if($personal->work_environment_in_office): ?>
                                                        <li>
                                                            <span><img
                                                                    src="<?php echo e(asset('assets/fe/images/sky_blue.svg')); ?>"
                                                                    alt="" /></span>Inoffice
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="preffered_block">
                            <div class="preffered_block_left">
                                <h4>Preferred Benefits:</h4>
                            </div>
                            <div class="preffered_block_right">
                                <ul>
                                    <?php if($personal->prefered_benefits_insurance_benefits): ?>
                                        <li>Insurance Benefits</li>
                                    <?php endif; ?>
                                    <?php if($personal->prefered_benefits_padi_holidays): ?>
                                        <li>Paid Holidays</li>
                                    <?php endif; ?>
                                    <?php if($personal->prefered_benefits_paid_vacation_days): ?>
                                        <li>Paid Vacation Days</li>
                                    <?php endif; ?>
                                    <?php if($personal->prefered_benefits_professional_environment): ?>
                                        <li>Official Environment</li>
                                    <?php endif; ?>
                                    <?php if($personal->prefered_benefits_casual_environment): ?>
                                        <li>Casual Environment</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="new_block">
                            <div class="row">
                                <div class="col-lg-9">
                                    <?php if($mode): ?>
                                        <div class="about_candidate blured_txt">
                                            <div class="title">
                                                <h4>About Example</h4>
                                            </div>
                                            <div class="about_candidate_txt">
                                                <p>
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta
                                                    atque ab veritatis sunt laboriosam, autem iusto, consequatur eum
                                                    deserunt alias ducimus velit, eos maiores! Animi et reprehenderit
                                                    sit repudiandae libero?
                                                </p>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="about_candidate">
                                            <div class="title">
                                                <h4>About <?php echo e($personal->name); ?></h4>
                                            </div>
                                            <div class="about_candidate_txt">
                                                <p>
                                                    <?php echo e($personal->short_bio); ?>

                                                </p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="skills_list_block">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="skills_list_inner">
                                                    <div class="title">
                                                        <h4 style="color: #7e50a7">Hard Skills</h4>
                                                    </div>

                                                    <ul class="skills_list">
                                                        <?php $__currentLoopData = $hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hard_skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><?php echo e($hard_skill); ?></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="skills_list_inner">
                                                    <div class="title">
                                                        <h4 style="color: #009cc8">Soft Skills</h4>
                                                    </div>

                                                    <ul class="skills_list">
                                                        <?php $__currentLoopData = $soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soft_skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><?php echo e($soft_skill); ?></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="skills_list_inner">
                                                    <div class="title">
                                                        <h4 style="color: #00407c">Languages</h4>
                                                    </div>

                                                    <ul class="skills_list">
                                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><?php echo e($language); ?></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="work_block">
                                        <div class="work_block_each">
                                            <div class="title">
                                                <h4>Work Experience</h4>
                                            </div>
                                            <ul class="work_list">
                                                <?php $__currentLoopData = $employments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <span class="list_style"></span>
                                                        <div class="work_list_inner">
                                                            <h6>2015-2019</h6>
                                                            <h5>
                                                                <?php if($mode): ?>
                                                                    <em class="blured_txt">Senior Ux/Ui Designer</em>
                                                                <?php else: ?>
                                                                    <?php echo e($employement->position); ?>

                                                                <?php endif; ?>
                                                                <span><?php echo e($employement->company_name); ?></span>
                                                            </h5>
                                                            <div class="work_list_inner_txt">
                                                                <h5>Position Accomplishments</h5>
                                                                <p>
                                                                    <?php echo e($employement->accomplishments); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <div class="work_block_each">
                                            <div class="title">
                                                <h4>Education & Training</h4>
                                            </div>
                                            <ul class="work_list">
                                                <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <span class="list_style"></span>
                                                        <div class="work_list_inner">
                                                            <h6>2000-2015</h6>
                                                            <h5><?php echo e($education->organization_name); ?>

                                                                <span><?php echo e($education->organization_name); ?></span>
                                                            </h5>
                                                            <p>
                                                                <?php echo e($education->course_description); ?>

                                                            </p>
                                                        </div>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="reference_block">
                                        <div class="title">
                                            <h4>Reference</h4>
                                        </div>
                                        <?php $__currentLoopData = $references; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="reference_block_inner">
                                                <?php if($mode): ?>
                                                    <h5 class="blured_txt">Jenefer Smith</h5>
                                                <?php else: ?>
                                                    <h5><?php echo e($reference->name); ?></h5>
                                                <?php endif; ?>
                                                <ul class="preview_contact_list">
                                                    <li>
                                                        <span class="contact_icon"><img
                                                                src="<?php echo e(asset('assets/fe/images/ylw-tell.svg')); ?>"
                                                                alt="" /></span>
                                                        <div class="contact_rgt_side">
                                                            <h5>Phone No</h5>
                                                            <?php if($mode): ?>
                                                                <a class="blured_txt" href="tel:">phone</a>
                                                            <?php else: ?>
                                                                <a
                                                                    href="tel:<?php echo e($reference->phone); ?>"><?php echo e($reference->phone); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <span class="contact_icon"><img
                                                                src="<?php echo e(asset('assets/fe/images/prpl-envlp.svg')); ?>"
                                                                alt="" /></span>
                                                        <div class="contact_rgt_side">
                                                            <h5>Email</h5>
                                                            <?php if($mode): ?>
                                                                <a class="blured_txt" href="mailto:">Email</a>
                                                            <?php else: ?>
                                                                <a
                                                                    href="mailto:<?php echo e($reference->email); ?>"><?php echo e($reference->email); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <span class="contact_icon"
                                                            style="background: rgba(0, 157, 200, 0.1)"><img
                                                                src="<?php echo e(asset('assets/fe/images/hand_shake.svg')); ?>"
                                                                alt="" /></span>
                                                        <div class="contact_rgt_side">
                                                            <h5>Relationship</h5>
                                                            <?php if($mode): ?>
                                                                <p class="blured_txt">relationship</p>
                                                            <?php else: ?>
                                                                <p><?php echo e($reference->relationship); ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="employer_note_block">
                                        <div class="title">
                                            <h5>Employer Notes</h5>
                                            <p>
                                                These notes will not be displayed to anyone outside of
                                                your company.
                                            </p>
                                        </div>
                                        <div class="add_btn_otr">
                                            <a data-fancybox data-src="#open55" href="javascript:;"
                                                class="add_btn">add a
                                                note<span>+</span></a>
                                        </div>

                                        <div class="add_note_list_otr">
                                            <ul class="add_note_list">
                                                <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="active">
                                                        <div class="add_note_list_item">
                                                            <div class="add_note_list_item_head">
                                                                <ul>
                                                                    <li>
                                                                        <span><img src="<?php echo e(asset('assets/fe/images/prpl_calender.svg')); ?>"
                                                                                alt="" /></span><?php echo e($note->created_at->format('m-d-Y')); ?>

                                                                    </li>
                                                                    <!-- <li>
                                                                        <span><img src="<?php echo e(asset('assets/fe/images/prpl_clock.svg')); ?>"
                                                                                alt="" /></span><?php echo e($note->created_at->format('g:i A')); ?>

                                                                    </li> -->
                                                                </ul>
                                                            </div>
                                                            <div class="add_note_list_item_content">
                                                                <?php echo e($note->note); ?>

                                                            </div>
                                                            <div class="add_note_list_item_ftr">
                                                                <h6>
                                                                    <span><img src="<?php echo e(asset('assets/fe/images/demo_avatar.svg')); ?>"
                                                                            alt="" /></span><?php echo e($note->author->name); ?>

                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        <?php else: ?>
        <?php endif; ?>
    </div>


    <div class="modal1">
        <div class="fancy-modal-body1" id="open55">
            <form wire:submit.prevent="saveNote()">
                <div class="modal-note">
                    <div class="form-group">
                        <label>Add Note</label>
                        <textarea wire:model.lazy="note"></textarea>
                    </div>
                    <div class="form-submit-btn mb-0 mt-3">
                        <input type="submit" value="Add" class="submit-btn" wire:loading.remove wire:target="saveNote">
                        <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="saveNote">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        window.addEventListener('close-note', event => {
            $.fancybox.close();
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-profile.blade.php ENDPATH**/ ?>