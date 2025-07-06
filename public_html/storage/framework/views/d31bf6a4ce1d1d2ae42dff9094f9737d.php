<div>
    <style type="text/css">
        .contact_rgt_side .blured_txt {
            white-space: nowrap !important;
        }
    </style>
    <div>
        <?php if(!$published): ?>
        <div class="preview-sec cmn-gap pt-0 back-clr ban-up mt-0">
            <div class="preview-wrap preview-wrap-final">
                <div class="container">
                    <div class="preview_banner_total">
                        <div class="preview-banner">
                            <div class="preview-banner-fig">
                                <figure>
                                    <img src="<?php echo e(asset('assets/fe/images/candi-banner-img.png')); ?>" alt="" class="desktop-v" />
                                    <img src="<?php echo e(asset('assets/fe/images/ban-mob-image.png')); ?>" alt="" class="mobile-v" />
                                </figure>
                            </div>
                        </div>
                        <div class="preview_banner_btm">
                            <div class="preview_banner_img_sec">
                                <div class="preview_banner_img_sec_left">
                                    
                                        <?php if(!empty($candidate_user->profile_photo_path)): ?>
                                        <figure class="<?php if($never_mode == false): ?> main_img_masked <?php endif; ?>">
                                            <?php if($never_mode == false): ?>
                                            <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" class="masked-img" />
                                            <?php else: ?>
                                            <img src="<?php echo e(asset($candidate_user->profile_photo_path)); ?>" alt="" />
                                            <?php endif; ?>
                                        </figure>
                                        <?php else: ?>
                                        <figure class="<?php if($never_mode == false): ?> main_img_masked <?php endif; ?>">
                                            <?php if($never_mode == false): ?>
                                            <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" class="masked-img" />
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('/assets/fe/images/profile-pic.png')); ?>" alt="" />
                                            <?php endif; ?>
                                        </figure>
                                        <?php endif; ?>
                                    
                                    <?php if($this->mode): ?>
                                    <?php if($requestCompany): ?>
                                    <div class="request_btn_otr">
                                        
                                        <div class="pending_unmask">
                                            <i class="iconc"><img src="<?php echo e(asset('assets/be/images/clock.svg')); ?>" alt=""></i>
                                            <div class="pending_unmask_rt">
                                                <h6>Pending Unmask</h6>
                                                <p>Profile Saved In Requested</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="request_btn_otr">
                                        <a href="#url" class="request_btn"><span><img src="<?php echo e(asset('assets/fe/images/ylw_lock.svg')); ?>" alt="" /></span>Request Unmask</a>
                                        <div class="position_form" wire:ignore.self>
                                            <div class="request_close">
                                                <button type="button" class="close close_req_mask">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form wire:submit.prevent="sendRequest()">
                                                <div class="form-group">
                                                    <label>Position Available*</label>
                                                    <input type="text" class="form-control" placeholder="Job title here" wire:model.lazy="position_hiring" required  />
                                                </div>
                                                <div class="form-group">
                                                    <label>Message to Candidate</label>
                                                    <textarea placeholder="I reviewed your resume..." wire:model.lazy="message" required></textarea>
                                                </div>
                                                <div class="position-submit-btn-otr" wire:loading.remove wire:target="sendRequest">
                                                    <input type="submit" value="Send to Candidate" class="position_submit_btn" />
                                                </div>
                                                <div class="position-submit-btn-otr" wire:loading wire:target="sendRequest">
                                                    <input type="submit" value="Sending..." disabled class="position_submit_btn" />
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

                                                        <h4 gdfgds>
                                                            

                                                            
                                                            

                                                            

                                                            
                                                            <?php if(!empty($personal->name)): ?>
                                                                
                                                                    <?php if($never_mode == false /* && $personal->name_status == 0*/): ?>
                                                                        <?php $length = (strlen($personal->name) > 15) ? 15 : strlen($personal->name); ?>
                                                                        <em class="blured_txt  name-blured-box">
                                                                        <?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)); ?>

                                                                        </em>
                                                                    <?php else: ?>
                                                                        <?php echo e($personal->name); ?>

                                                                    <?php endif; ?>
                                                                
                                                            <?php else: ?>
                                                                <em class="blured_txt name-blured-box">Candidate Name</em>
                                                            <?php endif; ?>



                                                            <?php if(!empty($personal->linkedin_url)): ?>
                                                            <?php if($never_mode == false): ?>
                                                            <em class="blured_txt image_blur"><a><img src="<?php echo e(asset('assets/fe/images/linkdin-ylw.svg')); ?>" alt="" /></a></em>
                                                            <?php else: ?>
                                                                <a href="<?php echo e($personal->linkedin_url); ?>" target="_blank"><img src="<?php echo e(asset('assets/fe/images/linkdin-ylw.svg')); ?>" alt="" /></a>
                                                            <?php endif; ?>
                                                            <?php endif; ?>

                                                            <?php if(!empty($personal->additional_url)): ?>
                                                            <?php if($never_mode == false): ?>
                                                            <em class="blured_txt image_blur"><a><img src="<?php echo e(asset('assets/fe/images/globe-ylw.svg')); ?>" alt="" /></a></em>
                                                            <?php else: ?>
                                                                <a href="<?php echo e($personal->additional_url); ?>" target="_blank"><img src="<?php echo e(asset('assets/fe/images/globe-ylw.svg')); ?>" alt="" /></a>
                                                            <?php endif; ?>
                                                            <?php endif; ?>
                                                        </h4>
                                                        <h5>
                                                            Current Position:
                                                            <?php if(!empty($personal->current_title)): ?>
                                                            <span class="<?php echo e(($mode && $personal->current_title_status == 0) ? 'blured_txt' : ''); ?>"><?php echo e($personal->current_title); ?></span>
                                                            <?php endif; ?>
                                                        </h5>
                                                    </div>
                                                    <div class="preview_contact_sec mobile-v">
                                                        <ul class="preview_contact_list wrpn mb-3">
                                                            <li>
                                                                <span class="contact_icon"><img src="<?php echo e(asset('assets/fe/images/ylw-tell.svg')); ?>" alt="" /></span>
                                                                <div class="contact_rgt_side">
                                                                    <h5>Phone No</h5>
                                                                    <?php if($never_mode == false): ?>
                                                                    <a class="blured_txt" href="tel:">phone
                                                                        no
                                                                    </a>
                                                                    <?php else: ?>
                                                                    <a class="" href="tel:<?php echo e($personal->phone); ?>"><?php echo e($personal->phone); ?>

                                                                    </a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <span class="contact_icon"><img src="<?php echo e(asset('assets/fe/images/prpl-envlp.svg')); ?>" alt="" /></span>
                                                                <div class="contact_rgt_side">
                                                                    <h5>Email</h5>

                                                                    <?php if($never_mode == false): ?>
                                                                    <a class="blured_txt" href="mailto:">Email
                                                                    </a>
                                                                    <?php else: ?>
                                                                    <a href="mailto:info@purplestair.com">info@purplestair.com</a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="defination_list">
                                                        <h5>Industries:</h5>
                                                        <ul>
                                                            <?php if(!empty($industries)): ?>
                                                            <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><?php echo e($industry); ?></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="defination_list">
                                                        <h5>Area of Interest:</h5>
                                                        <ul>
                                                            <?php if(!empty($interests)): ?>
                                                            <?php $__currentLoopData = $interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><?php echo e($interest); ?></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="preview_contact_sec desktop-v">
                                                    <ul class="preview_contact_list wrpn mb-3 d-flex row">
                                                        <li class="col-md-6">
                                                            <span class="contact_icon"><img src="<?php echo e(asset('assets/fe/images/ylw-tell.svg')); ?>" alt="" /></span>
                                                            <div class="contact_rgt_side">
                                                                <h5>Phone No</h5>
                                                                <?php if($never_mode == false): ?>
                                                                <a class="blured_txt" href="tel:">phone
                                                                    no</a>
                                                                <?php else: ?>
                                                                <a href="tel:<?php echo e($personal->phone); ?>"><?php echo e($personal->phone); ?></a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </li>
                                                        <li class="col-md-6">
                                                            <span class="contact_icon"><img src="<?php echo e(asset('assets/fe/images/prpl-envlp.svg')); ?>" alt="" /></span>
                                                            <div class="contact_rgt_side">
                                                                <h5>Email</h5>
                                                                <?php if($never_mode == false): ?>
                                                                <a class="blured_txt" href="mailto:">Email</a>
                                                                <?php else: ?>
                                                                <a href="mailto:<?php echo e($personal->email); ?>"><?php echo e($personal->email); ?></a>
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
                                            <p>
                                                
                                                
                                                <?php if(!empty($personal->address)): ?>
                                                    <?php if($never_mode == false/* && $personal->zip_code_status == 0*/): ?>
                                                        <span class="blured_txt"> <?php echo e($personal->address); ?>,&nbsp;<?php echo e($personal->state_abbr); ?></span>
                                                    <?php else: ?>
                                                        <?php echo e($personal->address); ?>,&nbsp;<?php echo e($personal->state_abbr); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="preview_banner_img_list_inner">
                                            <h6>Asking Salary:</h6>
                                            <?php if(!empty( $personal->salary_range)): ?>
                                            <p><?php echo e($personal->salary_range); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="preview_banner_img_list_inner">
                                            <h6>Compensation:</h6>
                                            <?php if(!empty($personal->compensation_salary)): ?>
                                            <p class="m-0"> Salary</p>
                                            <?php endif; ?>
                                            <?php if(!empty($personal->compensation_hourly)): ?>
                                            <p class="m-0">Hourly</p>
                                            <?php endif; ?>
                                            <?php if(!empty($personal->compensation_comission_based)): ?>
                                            <p class="m-0">Comission Based</p>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="preview_banner_img_list_inner">
                                            <h6>Schedule: &nbsp;</h6>
                                            <?php if(!empty($personal->schedule_full_time)): ?>
                                            <p>Full Time</p>
                                            <?php endif; ?>
                                            <?php if(!empty($personal->schedule_part_time)): ?>
                                            <p>Part Time</p>
                                            <?php endif; ?>
                                            <?php if(!empty($personal->schedule_no_preference)): ?>
                                            <p>No Preference</p>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="preview_banner_img_list_inner">
                                            <h6>Work Setting:</h6>
                                            <ul class="tick_list">
                                                <?php if(!empty($personal->work_environment_remote)): ?>
                                                <li>
                                                    <span><img src="<?php echo e(asset('assets/fe/images/sky_blue.svg')); ?>" alt="" /></span>Remote
                                                </li>
                                                <?php endif; ?>
                                                <?php if(!empty($personal->work_environment_hybrid)): ?>
                                                <li>
                                                    <span><img src="<?php echo e(asset('assets/fe/images/sky_blue.svg')); ?>" alt="" /></span>Hybrid
                                                </li>
                                                <?php endif; ?>
                                                <?php if(!empty($personal->work_environment_in_office)): ?>
                                                <li>
                                                    <span><img src="<?php echo e(asset('assets/fe/images/sky_blue.svg')); ?>" alt="" /></span>In Office
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
                                <?php if(!empty($personal->prefered_benefits_insurance_benefits)): ?>
                                <li>Insurance Benefits</li>
                                <?php endif; ?>
                                <?php if(!empty($personal->prefered_benefits_padi_holidays)): ?>
                                <li>Paid Holidays</li>
                                <?php endif; ?>
                                <?php if(!empty($personal->prefered_benefits_paid_vacation_days)): ?>
                                <li>Paid Vacation Days</li>
                                <?php endif; ?>
                                <?php if(!empty($personal->prefered_benefits_professional_environment)): ?>
                                <li>Official Environment</li>
                                <?php endif; ?>
                                <?php if(!empty($personal->prefered_benefits_casual_environment)): ?>
                                <li>Casual Environment</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="new_block">
                        <div class="row">
                            <div class="col-lg-9">
                                <?php if(!empty($personal->short_bio)): ?>
                                <?php if($never_mode == false && $personal->short_bio_status == 0): ?>
                                <div class="about_candidate blured_txt">
                                    <div class="title">
                                        <h4>About</h4>
                                    </div>
                                    <div class="about_candidate_txt">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta
                                            atque ab veritatis sunt laboriosam, autem iusto, consequatur eum
                                            deserunt alias ducimus velit, eos maiores! Animi et reprehenderit
                                            sit repudiandae libero?
                                        </p>
                                    </div>
                                <?php else: ?>
                                <div class="about_candidate
                                </div>">
                                    <div class="title">
                                        <h4>About <?php if(!$never_mode == false): ?><?php echo e($personal->name); ?> <?php endif; ?></h4>
                                    </div>
                                    <div class="about_candidate_txt">
                                        <p>
                                            <?php echo e($personal->short_bio); ?>

                                        </p>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endif; ?>
                                <div class="skills_list_block">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="skills_list_inner">
                                                <div class="title">
                                                    <h4 style="color: #7e50a7">Hard Skills</h4>
                                                </div>

                                                <ul class="skills_list">
                                                    <?php if(!empty($hard_skills)): ?>
                                                    <?php $__currentLoopData = $hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hard_skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($hard_skill); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="skills_list_inner">
                                                <div class="title">
                                                    <h4 style="color: #009cc8">Soft Skills</h4>
                                                </div>

                                                <ul class="skills_list">
                                                    <?php if(!empty($hard_skills)): ?>
                                                    <?php $__currentLoopData = $soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soft_skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($soft_skill); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="skills_list_inner">
                                                <div class="title">
                                                    <h4 style="color: #00407c">Languages</h4>
                                                </div>

                                                <ul class="skills_list">
                                                    <?php if(!empty($languages)): ?>
                                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($language); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="work_block">
                                    <?php if(!empty($employments)): ?>
                                    <?php if($employments->count()): ?>
                                    <div class="work_block_each">
                                        <div class="title">
                                            <h4>Work Experience</h4>
                                        </div>
                                        <ul class="work_list ps-3">
                                            <?php $__currentLoopData = $employments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($employement->position != ''): ?>
                                            <li>
                                                <span class="list_style"></span>
                                                <div class="work_list_inner">
                                                    <h6 class="<?php echo e(($mode && $employement->start_year_status == 0) ? 'blured_txt' : ''); ?>">
                                                        
                                                        <?php echo e($employement->start_year); ?>

                                                        <?php if($employement->start_year != '' && ($employement->end_year != '' || $employement->currently_working)): ?>
                                                        -
                                                        <?php endif; ?>
                                                        <?php echo e($employement->currently_working ? 'Present' : $employement->end_year); ?>

                                                    </h6>
                                                    <?php if($employement->position != ''): ?>
                                                    <h5>
                                                        <?php if($mode && $employement->position_status == 0): ?>
                                                        <em class="blured_txt">Senior Ux/Ui Designer</em>
                                                        <?php else: ?>
                                                        <?php echo e($employement->position); ?>

                                                        <?php endif; ?>

                                                        <?php if($mode && $employement->company_name_status == 0): ?>
                                                        <span class="blured_txt">Senior Ux/Ui Designer</span>
                                                        <?php else: ?>
                                                        <span><?php echo e($employement->company_name); ?></span>
                                                        <?php endif; ?>
                                                    </h5>
                                                    <?php endif; ?>

                                                    
                                                    <?php if($employement->responsibilities != ''): ?>
                                                    <div class="work_list_inner_txt">
                                                        <h5>Position Responsibilities</h5>
                                                        
                                                        <p class="<?php echo e(($mode && $employement->responsibilities_status == 0) ? 'blured_txt' : ''); ?>">
                                                            <?php echo e($employement->responsibilities); ?>

                                                        </p>
                                                    </div>
                                                    <?php endif; ?>
                                                    

                                                    <?php if($employement->accomplishments != ''): ?>
                                                    <div class="work_list_inner_txt">
                                                        <h5>Position Accomplishments</h5>
                                                        
                                                        <p class="<?php echo e(($mode && $employement->accomplishments_status == 0) ? 'blured_txt' : ''); ?>">
                                                            <?php echo e($employement->accomplishments); ?>

                                                        </p>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
<?php if(!empty($educations)): ?>
                                    <?php if($educations->count()): ?>
                                    <div class="work_block_each">
                                        <div class="title">
                                            <h4>Education & Training</h4>
                                        </div>
                                        <ul class="work_list ps-3">
                                            <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($education->organization_name != ''): ?>
                                            <li>
                                                <span class="list_style"></span>
                                                <div class="work_list_inner">
                                                    <h6 class="<?php echo e(($mode && $education->start_year_status == 0) ? 'blured_txt' : ''); ?>">
                                                        <?php echo e($education->start_year); ?>

                                                        <?php if($education->start_year != '' && ($education->end_year != '' || $education->currently_studying)): ?> - <?php endif; ?>
                                                        <?php echo e($education->currently_studying ? 'Present' : $education->end_year); ?>

                                                    </h6>
                                                    <?php if($education->organization_name != ''): ?>
                                                    <h5>
                                                        <?php if($mode && $education->organization_name_status == 0): ?>
                                                        <em class="blured_txt"><?php echo e($education->organization_name); ?></em>
                                                        <?php else: ?>
                                                        <?php echo e($education->organization_name); ?>

                                                        <?php endif; ?>
                                                        <span class="<?php echo e($mode && $education->program_name_status == 0 ? 'blured_txt' : ''); ?>"><?php echo e($education->program_name); ?></span>
                                                    </h5>
                                                    <?php endif; ?>
                                                    <?php if($education->course_description != ''): ?>
                                                    <p class="<?php echo e(($mode && $education->course_description_status == 0) ? 'blured_txt' : ''); ?>">
                                                        <?php echo e($education->course_description); ?>

                                                    </p>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
<?php if(!empty($references)): ?>
                                <?php if($references->count()): ?>
                                <div class="reference_block">
                                    <div class="title">
                                        <h4>Reference</h4>
                                    </div>
                                    <?php $__currentLoopData = $references; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($reference->name != ''): ?>
                                    <div class="reference_block_inner">

                                        <?php if($never_mode == false): ?>
                                        <h5 class="blured_txt">Jenefer Smith</h5>
                                        <?php else: ?>
                                        <h5><?php echo e(ucwords($reference->name)); ?></h5>
                                        <?php endif; ?>

                                        <ul class="preview_contact_list">
                                            <?php if($reference->phone != ''): ?>
                                            <li>
                                                <span class="contact_icon"><img src="<?php echo e(asset('assets/fe/images/ylw-tell.svg')); ?>" alt="" /></span>
                                                <div class="contact_rgt_side">
                                                    <h5>Phone No</h5>
                                                    <?php if($never_mode == false): ?>
                                                    <a class="blured_txt" href="tel:">phone</a>
                                                    <?php else: ?>
                                                    <a href="tel:<?php echo e($reference->phone); ?>"><?php echo e($reference->phone); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                            <?php if($reference->email != ''): ?>
                                            <li>
                                                <span class="contact_icon"><img src="<?php echo e(asset('assets/fe/images/prpl-envlp.svg')); ?>" alt="" /></span>
                                                <div class="contact_rgt_side">
                                                    <h5>Email</h5>
                                                    <?php if($never_mode == false): ?>
                                                    <a class="blured_txt" href="mailto:">Email</a>
                                                    <?php else: ?>
                                                    <a href="mailto:<?php echo e($reference->email); ?>"><?php echo e($reference->email); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                            <?php if($reference->relationship != ''): ?>
                                            <li>
                                                <span class="contact_icon" style="background: rgba(0, 157, 200, 0.1)"><img src="<?php echo e(asset('assets/fe/images/hand_shake.svg')); ?>" alt="" /></span>
                                                <div class="contact_rgt_side">
                                                    <h5>Relationship</h5>
                                                    <?php if($never_mode == false): ?>
                                                    <p class="blured_txt">relationship</p>
                                                    <?php else: ?>
                                                    <p><?php echo e($reference->relationship); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                     <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php endif; ?>
                                <?php endif; ?>
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
                                        <a data-fancybox data-src="#open55" href="javascript:;" class="add_btn">add a
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
                                                                <span><img src="<?php echo e(asset('assets/fe/images/prpl_calender.svg')); ?>" alt="" /></span><?php echo e($note->created_at->format('m-d-Y')); ?>

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
                                                            <span><img src="<?php echo e(asset('assets/fe/images/demo_avatar.svg')); ?>" alt="" /></span><?php echo e($note->author->name); ?>

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
                        <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                            <div class="text-danger error" >

                            <?php echo e($message); ?>


                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<script>/**
    $('.blured_txt:not(.image_blur)').text('Hidden'); // task - 86a0f55cd
**/
    let blur_str = "Hidden";
    document.addEventListener("livewire:load", (e) => {
        function initBlur() {
            $('.blured_txt:not(.image_blur)').each(function(index, el) {
                let _str = $.trim($(this).text());
                _str = _str.replace(/\s+/g, "");
                let _ln = _str.length;
                let _blr_txt = ""; let _idx = 0;

                console.log(_str, _ln);
                for (var i = 0; i <= _ln; i++) {
                    if(_idx == (blur_str.length)) {
                        _blr_txt += ' ';
                    }
                    _idx = (_idx == (blur_str.length)) ? 0 : _idx;
                    _blr_txt += blur_str[_idx];
                    _idx++;
                }
                $(this).attr('data-content', _blr_txt);
                $(this).text('Hidden');  // task - 86a0f55cd
            });
        }
        initBlur();
        /*Livewire.hook('message.processed', (el, component) => {
            console.log('fgghfsd');
            initBlur();
        });*/
    });

    window.addEventListener('close-note', event => {
        $.fancybox.close();
    })
/*$('.blured_txt:not(.image_blur,h4 .blured_txt)').each(function(){
       var length= $(this).text().length
       // console.log('length',$(this).text());
         var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var result = Array.from({ length: length }, () => charset.charAt(Math.floor(Math.random() * charset.length))).join('');

       var textLength= $(this).text(result);
    })*/



$("body").delegate(".submit-btn", "click", function(e) {
var val=$.trim($(this).parents('.modal-note').find('textarea').val());
    if(val==""){
        $(this).parents('.modal-note').find('.form-group').find('.text-danger').remove();
        $(this).parents('.modal-note').find('.form-group').append('<div class="text-danger error" > The note field is required.</div>');
    }
})

$("body").delegate(".modal-note textarea", "keypress", function(e) {
    $(this).parents('.form-group').find('.text-danger').remove();
})
$("body").delegate(".modal-note textarea", "keyup", function(e) {
      $(this).val($(this).val().trimStart())
})
$("body").delegate(".position_form textarea", "keyup", function(e) {
    $(this).val($(this).val().trimStart())
})
$("body").delegate(".position_form input", "keyup", function(e) {
    $(this).val($(this).val().trimStart())
})
$(document).ready(function() {
    $(document).on("click", function(e) {
        if (!$('.inline-table-modal').is(e.target) && $('.inline-table-modal').has(e.target).length === 0) {
            // Click occurred outside the modal, so close it
            $(".inline-table-modal").modal("hide");
        }
    });
});

</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidate-profile.blade.php ENDPATH**/ ?>