<div>
    <style type="text/css">
        .contact_rgt_side .blured_txt { white-space: nowrap !important; }
    </style> 
    <div class="back-clr ban-up">
        <div class="preview-sec cmn-gap pt-0" id="contentToPrint">
            <div class="preview-wrap">
                <div class="container pt-1"><br>
                    <div class="preview-upper">
                        <div class="preview-uppr-left d-flex">
                            <!-- <div class="title">
                            <h4>
                            Preview:

                            </h4> --}}
                            <div class="tool-info-otr">
                            
                            <div class="tool-info">
                                <p>
                                Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.
                                </p>
                            </div>
                            </div>
                        </div> -->
                            <div class="toggle-switch-block"  style="min-width: auto;">
                                <span class="">
                                    <span class="d-none d-sm-inline">Preview </span>
                                    <span>masked </span>
                                </span>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1" <?php echo e($mode ? 'checked' : ''); ?> wire:model.lazy="mode" />
                                </div>
                                <span class="">
                                    <span class="d-none d-sm-inline">Preview </span>
                                    <span>unmasked </span>
                                </span>
                            </div>
                            <div class="tool-info-otr">
                                <span>?</span>
                                <div class="tool-info tool-info-mob">
                                    <p>
                                    “Masked” is exactly how your profile will appear to the public. “Unmasked” is a display of how your profile will appear if you grant permission to a specific employer upon their request.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="preview-uppr-rgt pvr">
                            <a href="<?php echo e(route('candidates.editpersonal')); ?>" class="blue_btn px-3" style="min-width: auto;">
                                <span class="d-none d-sm-inline m-0">Edit Profile</span> <span class="ms-0 ms-sm-2"><img src="<?php echo e(asset('assets/fe/images/edit-icon11.svg')); ?>" alt="" /></span>
                            </a>
                        </div>
                    </div>
                    <div class="preview-banner">
                        <div class="preview-banner-fig">
                            <figure>
                                <img src="<?php echo e(asset('assets/fe/images/candi-banner-img.png')); ?>" alt="" class="desktop-v" />
                                <img src="<?php echo e(asset('assets/fe/images/ban-mob-image.png')); ?>" alt="" class="mobile-v mobile-v-bg" />
                            </figure>
                        </div>
                        <div class="preview-banner-txt ht">
                            <div class="preview-banner-txt-left">
                                <a href="<?php echo e(route('candidates.downloadpdf')); ?>"  class="edge_btn dwnld-btn">Download Resume </a>
                                
                            </div>
                            <!-- <div class="preview-banner-txt-rgt">
                                <a href="<?php echo e(route('candidates.editpersonal')); ?>" class="edit_btn11"
                                >Edit Profile
                                <span><img src="<?php echo e(asset('assets/fe/images/edit-icon11.svg')); ?>" alt="" /></span>
                                </a>
                            </div> -->
                        </div>
                    </div>

                    <div class="preview_banner_btm">
                        <div class="preview_banner_img_sec">
                            <div class="preview_banner_img_sec_left">
                                <?php if(Auth::user()->profile_photo_path): ?>
                                <figure class="<?php if($mode && $never_mode == false): ?> main_img_masked <?php endif; ?>">
                                    <?php if($mode && $never_mode == false): ?>
                                        <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" class="masked-img masked-img-p"/>
                                    <?php else: ?>
                                        <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" />
                                    <?php endif; ?>
                                </figure>
                                <?php else: ?>
                                <?php
                                    $style = '';
                                    if(!$mode) { $style = 'background: #fff; border: 1px dashed;'; }
                                ?>
                                <figure style="<?php echo e($style); ?>" class="<?php echo e(($mode && $never_mode == false ? 'main_img_masked' : '')); ?>">
                                    <?php if($mode && $never_mode == false): ?>
                                        <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" class="masked-img masked-img-p"/>
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/fe/images/profile-pic.png')); ?>" alt="" style="height:80% !important; width: 80% !important;" />
                                    <?php endif; ?>
                                </figure>
                                <?php endif; ?>
                            </div>
                            <div class="preview_banner_img_sec_rgt">
                                <div class="preview_banner_img_sec_rgt_wrapper">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="defination-sec">
                                                <div class="title">
                                                    <h4>
                                                        
                                                        <?php if($mode && $never_mode == false /*&& $personal->name_status == 0*/): ?>
                                                            <?php if(!empty($personal->name)): ?>
                                                                <?php $length = (strlen($personal->name) > 15) ? 15 : strlen($personal->name); ?>
                                                                <em class="blured_txt">
                                                                    
                                                                    <?php echo e((strlen($personal->name) > 15) ? substr($personal->name, 0, 15)."..." : $personal->name); ?>

                                                                </em>
                                                            <?php else: ?>

                                                                <em class="blured_txt">Candidate Name</em>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php echo e($personal->name); ?>

                                                        <?php endif; ?>

                                                        <?php if($personal->linkedin_url): ?>
                                                            
                                                            

                                                            <?php if($mode && $never_mode == false): ?>
                                                                <em class="blured_txt image_blur"><a><img src="<?php echo e(asset('assets/fe/images/linkdin-ylw.svg')); ?>" alt="" /></a></em>
                                                            <?php else: ?>
                                                                <a href="<?php echo e($personal->linkedin_url); ?>" target="_blank"><img src="<?php echo e(asset('assets/fe/images/linkdin-ylw.svg')); ?>" alt="" /></a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                        <?php if($personal->additional_url): ?>
                                                            

                                                            
                                                            <?php if($mode && $never_mode == false): ?>
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
                                                                <?php if($never_mode == false && $mode): ?>
                                                                <a class="blured_txt" href="tel:">phone no
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

                                                                <?php if($never_mode == false && $mode): ?>
                                                                    <a class="blured_txt" href="mailto:">phone no
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
                                                <ul class="preview_contact_list wrpn mb-3">
                                                    <li>
                                                        <span class="contact_icon"><img src="<?php echo e(asset('assets/fe/images/ylw-tell.svg')); ?>" alt="" /></span>
                                                        <div class="contact_rgt_side">
                                                            <h5>Phone No</h5>
                                                            <?php if($mode && $never_mode == false): ?>
                                                            <a class="blured_txt" href="tel:">phone no</a>
                                                            <?php else: ?>
                                                            <a href="tel:<?php echo e($personal->phone); ?>"><?php echo e($personal->phone); ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <span class="contact_icon"><img src="<?php echo e(asset('assets/fe/images/prpl-envlp.svg')); ?>" alt="" /></span>
                                                        <div class="contact_rgt_side">
                                                            <h5>Email</h5>
                                                            <?php if($mode && $never_mode == false): ?>
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
                                                <?php if($mode && $never_mode == false/* && $personal->zip_code_status == 0*/): ?>
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
                                        <p><?php echo e($personal->salary_range); ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="preview_banner_img_list_inner">
                                        <h6>Compensation:</h6>
                                        <?php if($personal->compensation_salary): ?>
                                        <p class="m-0">Salary</p>
                                        <?php endif; ?>
                                        <?php if($personal->compensation_hourly): ?>
                                        <p class="m-0">Hourly</p>
                                        <?php endif; ?>
                                        <?php if($personal->compensation_comission_based): ?>
                                        <p class="m-0">Comission Based</p>
                                        <?php endif; ?>
                                    </div>
                                </li>
                                <li>
                                    <div class="preview_banner_img_list_inner">
                                        <h6>Schedule:</h6>
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
                                        <h6>Work Setting:</h6>
                                        <ul class="tick_list">
                                            <?php if($personal->work_environment_remote): ?>
                                            <li>
                                                <span><img src="<?php echo e(asset('assets/fe/images/sky_blue.svg')); ?>" alt="" /></span>Remote
                                            </li>
                                            <?php endif; ?>
                                            <?php if($personal->work_environment_hybrid): ?>
                                            <li>
                                                <span><img src="<?php echo e(asset('assets/fe/images/sky_blue.svg')); ?>" alt="" /></span>Hybrid
                                            </li>
                                            <?php endif; ?>
                                            <?php if($personal->work_environment_in_office): ?>
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

                    <?php if($personal->short_bio): ?>
                        <?php if($never_mode == false && $mode && $personal->short_bio_status == 0): ?>
                        <div class="about_candidate my-5">
                            <div class="title">
                                <h4>About</h4>
                            </div>
                            <div class="about_candidate_txt blured_txt">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta atque ab
                                    veritatis sunt laboriosam, autem iusto, consequatur eum deserunt alias ducimus
                                    velit, eos maiores! Animi et reprehenderit sit repudiandae libero?
                                </p>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="about_candidate my-5">
                            <div class="title">
                                <h4>About <?php if($never_mode == false && !$mode): ?> <?php echo e(Auth::user()->name); ?> <?php endif; ?></h4>
                            </div>
                            <div class="about_candidate_txt">
                                <p>
                                    <?php echo e($personal->short_bio); ?>

                                </p>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>


                    <div class="work_block">

                        <?php if($employments->count()): ?>
                        <div class="work_block_each">
                            <div class="title">
                                <h4>Work Experience</h4>
                            </div>
                            <ul class="work_list  ps-3">
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
                                            <h6 class="<?php echo e(($mode && $education->start_year_status == 0) ? 'blured_txt' : ''); ?>"><?php echo e($education->start_year); ?>

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
                    </div>




                    <div class="skills_list_block p-0">
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

                    <div class="preffered_block my-5">
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


                    <?php if($references->count()): ?>
                    <div class="reference_block ">
                        <div class="title">
                            <h4>Reference</h4>
                        </div>
                        <?php $__currentLoopData = $references; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reference_block_inner">
                            <?php if($reference->name != ''): ?>
                            <?php if($never_mode == false && $mode): ?>
                            <h5 class="blured_txt">Jenefer Smith</h5>
                            <?php else: ?>
                            <h5><?php echo e($reference->name); ?></h5>
                            <?php endif; ?>
                            <?php endif; ?>
                            <ul class="preview_contact_list">
                                <?php if($reference->name != ''): ?>
                                <li>
                                    <span class="contact_icon"><img src="<?php echo e(asset('assets/fe/images/ylw-tell.svg')); ?>" alt="" /></span>
                                    <div class="contact_rgt_side">
                                        <h5>Phone No</h5>
                                        <?php if($never_mode == false && $mode): ?>
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
                                        <?php if($never_mode == false && $mode): ?>
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
                                        <?php if($never_mode == false && $mode): ?>
                                        <p class="blured_txt">relationship</p>
                                        <?php else: ?>
                                        <p><?php echo e($reference->relationship); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    window.jsPDF = window.jspdf.jsPDF;

    // Convert HTML content to PDF
    function savePdf() {
        var HTML_Width = $("#contentToPrint").width();
        var HTML_Height = $("#contentToPrint").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width + (top_left_margin * 2);
        var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = 0;


        html2canvas($("#contentToPrint")[0], {
            allowTaint: true,
            useCORS: true
        }).then(function(canvas) {
            canvas.getContext('2d');

            console.log(canvas.height + "  " + canvas.width);


            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt', [PDF_Width, canvas_image_height + 50]);
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width,
                canvas_image_height);


            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, canvas_image_height + 100);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4),
                    canvas_image_width, canvas_image_height);
            }

            pdf.save("curriculum-vitae.pdf");
        });
    }
</script>
<script>
    let blur_str = "Hidden";
    /*$('.blured_txt:not(.image_blur)').each(function(index, el) {
        let _str = $.trim($(this).text());
        let _ln = _str.length;
        let _blr_txt = ""; let _idx = 0;
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
    });*/

    // $('.blured_txt:not(.image_blur)').text('Hidden'); // task - 86a0f55cd


    document.addEventListener("livewire:load", (e) => {
        console.log('0000');
        function initBlur() {
            $('.blured_txt:not(.image_blur)').each(function(index, el) {
                let _str = $.trim($(this).text());
                let _ln = _str.length;
                let _blr_txt = ""; let _idx = 0;
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
        Livewire.hook('message.processed', (el, component) => {
            console.log('fgghfsd');
            initBlur();
        });
        setTimeout(() => {
            if($('.switch_1').prop('checked') === false) {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('mode', false);
            }
        }, 500);
    });

    $(".sub2").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/requests')
    })
    $(".dwnld-btn").click(function(e) {
        $(this).text('Downloading...');
        setTimeout(function () {
                $(".dwnld-btn").text('Download Resume');
            }, 5000); // Adjust the delay as needed.
    })


</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidates-profile.blade.php ENDPATH**/ ?>