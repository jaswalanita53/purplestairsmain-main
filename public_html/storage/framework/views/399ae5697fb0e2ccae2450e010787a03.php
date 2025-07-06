<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <link rel="stylesheet" href="<?php echo e(asset('assets/fe/pdf-style.css')); ?>" />
    <style>
        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url('fonts/Poppins-Regular.ttf') format("truetype");
        }
        
        body {
            font-family: "Poppins" !important;
        }
        h1,h2,h3,h4,h5,h6,p{
            font-family: "Poppins" !important;
        }
.no-page-break {
    page-break-before: always;
}
@page {
        margin: 0mm; /* Set custom margins in millimeters */
    }

#contentToPrint{
        font-family: "Poppins" !important;
        background-color: white !important;
}
    </style>
</head>


    <div id="contentToPrint" style="width:700px;padding:20px; margin:0px auto; background-color: white;">
      <div class="preview-sec">
                <div class="preview-wrap">
                    <div class="container-">
                        <div class="preview-banner">
                            <div class="preview-banner-fig">
                                <figure>
                                    <img src="<?php echo e(asset('assets/fe/images/candi-banner-img.png')); ?>" alt=""
                                        class="" style="width: 100%;height: 100px; object-fit: contain;" />
                                </figure>
                            </div>
                        </div>
                        <div class="" style="padding: 0 15px;">
                            <div class="preview_banner_btm">
                                <div class="preview_banner_img_sec" style="margin-bottom: 10px;">
                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 25%">
                                            <div class="preview_banner_img_sec_left">
                                                <figure class="<?php if(empty(Auth::user()->profile_photo_path)): ?> main_img_masked <?php endif; ?>">
                                                    <?php if(!empty(Auth::user()->profile_photo_path)): ?>
                                                        <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" />
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" class="masked-img" />
                                                    <?php endif; ?>
                                                </figure>
                                            </div>
                                        </td>
                                        <td style="width: 75%">
                                            <div class="preview_banner_img_sec_rgt">
                                                <div class="preview_banner_img_sec_rgt_wrapper">
                                                    <div class="defination-sec">
                                                        <div class="title">
                                                            <h5 class="main-resume-head">
                                                                <?php if($mode): ?>
                                                                <?php if(!empty($personal->name)): ?>
                                                                <em class="blured_txt"><?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, strlen($personal->name))); ?></em>
                                                                <?php else: ?>

                                                                <em class="blured_txt">Candidate Name</em>
                                                                <?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php echo e($personal->name); ?>

                                                                <?php endif; ?>

                                                                <?php if($personal->linkedin_url): ?>
                                                                <a href="<?php echo e($personal->linkedin_url); ?>" target="_blank">
                                                                    <img src="<?php echo e(asset('assets/fe/images/linkdinylw2.png')); ?>" alt="" />
                                                                </a>
                                                                <?php endif; ?>

                                                                <?php if($personal->additional_url): ?>
                                                                <a href="<?php echo e($personal->additional_url); ?>" target="_blank" ><img
                                                                        src="<?php echo e(asset('assets/fe/images/globe-ylw.png')); ?>"
                                                                        alt="" /></a>
                                                                <?php endif; ?>
                                                            </h4>

                                                        </div>
                                                        <div class="title-">
                                                            <p>
                                                                Current Position:
                                                                <span><?php echo e($personal->current_title); ?></span>
                                                            </p>

                                                        </div>

                                                        <div class="">
                                                            <div class="preview_contact_sec">
                                                                <table style="width: 100%;margin-top: 10px;">
                                                                    <tr>
                                                                        <td>
                                                                            <div>
                                                                                <table style="width: 100%">
                                                                                    <tr>
                                                                                        <td style="width: 44px;">
                                                                                            <span class="contact_icon" style="background-color: rgb(255 174 26 / 20%);height: 40px;width: 40px;border-radius:50%;display:block">

                                                                                            <img
                                                                                                src="<?php echo e(asset('assets/fe/images/ylw-tell.png')); ?>"
                                                                                                alt="" style="margin: 12px;" />
                                                                                                
                                                                                                </span>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="contact_rgt_side">
                                                                                                <h5>Phone No</h5>
                                                                                                <?php if($mode): ?>
                                                                                                    <a class="blured_txt" href="tel:">phone no</a>
                                                                                                <?php else: ?>
                                                                                                    <a
                                                                                                        href="tel:<?php echo e($personal->phone); ?>" style="word-break: break-all;"><?php echo e($personal->phone); ?></a>
                                                                                                <?php endif; ?>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div>
                                                                                <table style="width: 100%">
                                                                                    <tr>
                                                                                        <td style="width: 44px;">

                                                                                            <span class="contact_icon" style="background-color: rgba(126, 80, 167, 0.1);height: 40px;width: 40px;border-radius:50%;display:block"><img
                                                                                                    src="<?php echo e(asset('assets/fe/images/prpl-envlp.png')); ?>"
                                                                                                    alt=""  style="margin: 12px;"/></span>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="contact_rgt_side">
                                                                                                <h5>Email</h5>
                                                                                                <?php if($mode): ?>
                                                                                                    <a class="blured_txt" href="mailto:">Email</a>
                                                                                                <?php else: ?>
                                                                                                    <a
                                                                                                        href="mailto:<?php echo e($personal->email); ?>" ><p><?php echo e($personal->email); ?></p></a>
                                                                                                <?php endif; ?>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>


                                </div>


                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 50%;padding: 5px; vertical-align: top;">
                                            <div class="defination_list" >
                                                <h5 class="main-resume-head">Industries:</h5>
                                                <ul style="margin: 5px 0px;">
                                                    <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($industry); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </td>
                                        <td style="width: 50%;padding: 5px; vertical-align: top;">
                                            <div class="defination_list">
                                                <h5 class="main-resume-head">Area of Interest:</h5>
                                                <ul style="margin: 5px 0px 5px -4px">
                                                    <?php $__currentLoopData = $interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($interest); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="preview_banner_img_btm">
                                    <ul class="preview_banner_img_list">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="width: 20%;border-right: 1px solid #0000001a;padding: 5px;text-align: center;vertical-align: top;">
                                                    <li>
                                                        <div class="preview_banner_img_list_inner">
                                                            <h6>Location:</h6>
                                                            <p><?php echo e($personal->address); ?>,<?php echo e($personal->state_abbr); ?></p>
                                                        </div>
                                                    </li>
                                                </td>
                                                <td style="width: 20%;border-right: 1px solid #0000001a;padding: 5px;text-align: center;vertical-align: top;">
                                                    <li>
                                                        <div class="preview_banner_img_list_inner">
                                                            <h6>Asking Salary:</h6>
                                                            <p><?php echo e($personal->salary_range); ?></p>
                                                        </div>
                                                    </li>
                                                </td>
                                                <td style="width: 20%;border-right: 1px solid #0000001a;padding: 5px;text-align: center;vertical-align: top;">
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

                                                </td>
                                                <td style="width: 20%;border-right: 1px solid #0000001a;padding: 5px;text-align: center;vertical-align: top;">
                                                    <li>
                                                        <div class="preview_banner_img_list_inner">
                                                            <h6>Schedule: &nbsp;</h6>
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
                                                </td>
                                                <td style="width: 20%;padding: 5px;text-align: center;vertical-align: top;">
                                                    <li>
                                                        <div class="preview_banner_img_list_inner">
                                                            <h6>Work Setting:</h6>
                                                            <ul class="tick_list">
                                                                <?php if($personal->work_environment_remote): ?>
                                                                    <li style="display: inline-block;">
                                                                        <span><img src="<?php echo e(asset('assets/fe/images/sky_blue.png')); ?>"
                                                                                alt="" /></span>Remote
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if($personal->work_environment_hybrid): ?>
                                                                    <li style="display: inline-block;">
                                                                        <span><img src="<?php echo e(asset('assets/fe/images/sky_blue.png')); ?>"
                                                                                alt="" /></span>Hybrid
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if($personal->work_environment_in_office): ?>
                                                                    <li style="display: inline-block;">
                                                                        <span><img src="<?php echo e(asset('assets/fe/images/sky_blue.png')); ?>"
                                                                                alt="" /></span>In Office
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </td>
                                            </tr>
                                        </table>
                                    </ul>
                                </div>
                            </div>


                            <?php if(!empty($personal->short_bio)): ?>
                                <?php if($mode && $personal->short_bio_status == 0): ?>
                                    <div class="about_candidate blured_txt">
                                        <div class="title">
                                            <h4 class="main-resume-head">About</h4>
                                        </div>
                                        <div class="about_candidate_txt">
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta atque ab
                                                veritatis sunt laboriosam, autem iusto, consequatur eum deserunt alias ducimus
                                                velit, eos maiores! Animi et reprehenderit sit repudiandae libero?
                                            </p>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="about_candidate" style="margin-bottom: 20px;">
                                        <div class="title">
                                            <h4 class="main-resume-head">About <?php echo e(Auth::user()->name); ?></h4>
                                        </div>
                                        <div class="about_candidate_txt">
                                            <p>
                                                <?php echo e($personal->short_bio); ?>

                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="work_block mt-5">
                                <div class="work_block_each">
                                    <div class="title" style="margin-bottom: 10px;">
                                        <h5 class="main-resume-head">Work Experience</h5>
                                    </div>
                                    <ul class="work_list">
                                        <?php $__currentLoopData = $employments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($employement->position != ''): ?>
                                            <li>
                                                <table style="-webkit-border-vertical-spacing: 0;padding-left: 10px;">
                                                    <tr>
                                                        <td style="vertical-align: baseline;">
                                                            <span class="list_style" style="margin-top: -2px;width: 24px;height: 24px;  border-radius: 100%;background: rgb(126 80 167 / 20%);display: block;text-align: center;padding: 0px;">
                                                                <span class="" style="background: #7e50a7;height: 10px;width: 10px;display: inline-block;border-radius: 50%;margin: 7px auto 0;"></span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="work_list_inner" 
                                                            style="border-left: 1px solid #7e50a7;margin-left: -17px;padding-left: 22px;margin-top: 5px;">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="">
                                                                            <?php if($employement->position != ''): ?>
                                                                            <h5 >
                                                                                <?php if($mode): ?>
                                                                                <em class="blured_txt">Senior Ux/Ui Designer</em>
                                                                                <?php else: ?>
                                                                                <?php echo e($employement->position); ?>

                                                                                <?php endif; ?>
                                                                                <span><?php echo e($employement->company_name); ?></span>
                                                                            </h5>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <h5 style=" font-weight: 400;padding-left: 10px; font-size:12px"><?php echo e($employement->start_year); ?>

                                                                                <?php if($employement->start_year != '' && ($employement->end_year != '' || $employement->currently_working)): ?>
                                                                                -
                                                                                <?php endif; ?>
                                                                                <?php echo e($employement->currently_working ? 'Present' : $employement->end_year); ?>

                                                                            </h5>
                                                                        </td>
                                                                    </tr>
                                                                </table>

                                                                
                                                                <?php if($employement->responsibilities != ''): ?>
                                                                <div class="work_list_inner_txt">
                                                                    <h6 class="main-resume-head">Position Responsibilities</h6>
                                                                    
                                                                    <p>
                                                                        <?php echo e($employement->responsibilities); ?>

                                                                    </p>
                                                                </div>
                                                                <?php endif; ?>
                                                                

                                                                <?php if($employement->accomplishments != ''): ?>
                                                                <div class="work_list_inner_txt">
                                                                    <h6 class="main-resume-head">Position Accomplishments</h6>
                                                                    <p>
                                                                        <?php echo e($employement->accomplishments); ?>

                                                                    </p>
                                                                </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <div class="work_block_each" style="margin-top: 10px;">
                                    <div class="title" style="margin-bottom: 10px;">
                                        <h5 class="main-resume-head">Education & Training</h5>
                                    </div>
                                    <ul class="work_list">
                                        <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($education->organization_name != ''): ?>
                                            <li>

                                                <table style="-webkit-border-vertical-spacing: 0;padding-left: 10px;">
                                                    <tr>
                                                        <td style="vertical-align: baseline;">
                                                            <span class="list_style" style="margin-top: -2px;width: 24px;height: 24px;  border-radius: 100%;background: rgb(126 80 167 / 20%);display: block;text-align: center;padding: 0px;">
                                                                <span class="" style="background: #7e50a7;height: 10px;width: 10px;display: inline-block;border-radius: 50%;margin: 7px auto 0;"></span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="work_list_inner"
                                                            style="border-left: 1px solid #7e50a7;margin-left: -17px;padding-left: 22px;margin-top: 5px;">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td style="">
                                                                            <?php if($education->organization_name != ''): ?>
                                                                            <h5 style="margin-bottom: 0;"><?php echo e($education->organization_name); ?>

                                                                                <span><?php echo e($education->program_name); ?></span>
                                                                            </h5>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td style="">
                                                                            <h5 style="font-size: 12px;font-weight: 400;margin-bottom:0;padding-left: 10px;"><?php echo e($education->start_year); ?>

                                                                                <?php if($education->start_year != '' && ($education->end_year != '' || $education->currently_studying)): ?> - <?php endif; ?>
                                                                                <?php echo e($education->currently_studying ? 'Present' : $education->end_year); ?>

                                                                            </h5>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <?php if($education->course_description != ''): ?>
                                                                <p>
                                                                    <?php echo e($education->course_description); ?>

                                                                </p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>




                            <div class="skills_list_block pt-0 pb-0">
                                <table>
                                    <tr>
                                        <td style="width:33.33%;vertical-align:top">
                                            <div class="skills_list_inner">
                                                <div class="title">
                                                    <h5 class="sub-heading-resume">Hard Skills</h4>
                                                </div>

                                                <ul class="skills_list">
                                                    <?php $__currentLoopData = $hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hard_skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($hard_skill); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </td>
                                        <td style="width:33.33%;vertical-align:top">
                                            <div class="skills_list_inner">
                                                <div class="title">
                                                    <h4 class="sub-heading-resume">Soft Skills</h4>
                                                </div>

                                                <ul class="skills_list">
                                                    <?php $__currentLoopData = $soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soft_skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li style="background-color: rgba(0, 157, 200, 0.2);"><?php echo e($soft_skill); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </td>
                                        <td style="width:33.33%;vertical-align:top">
                                            <div class="skills_list_inner">
                                                <div class="title">
                                                    <h4 class="sub-heading-resume">Languages</h4>
                                                </div>

                                                <ul class="skills_list">
                                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li style="background-color: rgba(45, 107, 165, 0.2);"><?php echo e($language); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="preffered_block">
                                <div class="preffered_block_left" style="padding-right: 15px">
                                    <h4 class="main-resume-head-box">Preferred Benefits:</h4>
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


                            <div class="reference_block">
                                <div class="title">
                                    <h4 class="sub-heading-resume">Reference</h4>
                                </div>
                                <?php $__currentLoopData = $references; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="reference_block_inner">
                                        <?php if($reference->name != ''): ?>
                                    <?php if($mode): ?>
                                    <h4 class="blured_txt">Jenefer Smith</h4>
                                    <?php else: ?>
                                    <h4 class="sub-heading-resume"><?php echo e($reference->name); ?></h4>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <ul class="preview_contact_list">
                                <table style="">
                                    <tr>
                                        <td style="padding: 5px;">
                                            <?php if($reference->name != ''): ?>
                                                <li>
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td style="width: 44px;">
                                                            <span class="contact_icon" style="background-color: rgb(255 174 26 / 20%);height: 40px;width: 40px;border-radius:50%;display:block"><img src="<?php echo e(asset('assets/fe/images/ylw-tell.png')); ?>" alt="" style="margin: 12px;" /></span>
                                                        </td>
                                                        <td>
                                                            <div class="contact_rgt_side">
                                                                <h5>Phone No</h5>
                                                                <?php if($mode): ?>
                                                                <a class="blured_txt" href="tel:">phone</a>
                                                                <?php else: ?>
                                                                <a href="tel:<?php echo e($reference->phone); ?>"><?php echo e($reference->phone); ?></a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                </li>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding: 5px;">
                                            <?php if($reference->email != ''): ?>
                                                <li>
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 44px;">
                                                                <span class="contact_icon" style="background-color: rgba(126, 80, 167, 0.1);height: 40px;width: 40px;border-radius:50%;display:block"><img src="<?php echo e(asset('assets/fe/images/prpl-envlp.png')); ?>" alt="" style="margin: 12px;" /></span>
                                                            </td>
                                                            <td>
                                                                <div class="contact_rgt_side">
                                                                    <h5>Email</h5>
                                                                    <?php if($mode): ?>
                                                                    <a class="blured_txt" href="mailto:">Email</a>
                                                                    <?php else: ?>
                                                                    <a href="mailto:<?php echo e($reference->email); ?>" style="color: #000;"><?php echo e($reference->email); ?></a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <td>
                                                        </tr>
                                                    </table>
                                                </li>
                                            <?php endif; ?>

                                        </td>
                                        <td style="padding: 5px;">
                                            <?php if($reference->relationship != ''): ?>
                                                <li>
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 44px;">
                                                                <span class="contact_icon" style="background-color: rgba(0, 157, 200, 0.1);height: 40px;width: 40px;border-radius:50%;display:block"><img src="<?php echo e(asset('assets/fe/images/hand_shake.png')); ?>" alt="" style="margin: 12px 7px;" /></span>
                                                            </td>
                                                            <td>
                                                                <div class="contact_rgt_side">
                                                                    <h5 >Relationship</h5>
                                                                    <?php if($mode): ?>
                                                                    <p class="blured_txt">relationship</p>
                                                                    <?php else: ?>
                                                                    <p style="color: #000;font-weight: 300;"><?php echo e($reference->relationship); ?></p>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </li>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>

                                </ul>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="text-align: center;
    padding: 40px 0 20px;
    font-size: 12px;">Find Me At: &nbsp;<a href="http://purplestairs.com">www.purplestairs.com</a></div>
            </div>

    </div>

<script src="<?php echo e(asset('assets/be/js/jquery-3.5.1.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
savePdf();
window.jsPDF = window.jspdf.jsPDF;
// Convert HTML content to PDF

// Convert HTML content to PDF
function savePdf() {
    // Calculate the content dimensions and scale factor
    var contentWidth = $("#contentToPrint").width();
    var contentHeight = $("#contentToPrint").height();

    // A4 page dimensions in points (1 inch = 72 points)
    var PDF_Width = contentWidth;
    var PDF_Height = 841.890;
    var top_left_margin = 0;

    var scale = Math.min((PDF_Width - 2 * top_left_margin) / contentWidth, (PDF_Height - 2 * top_left_margin) / contentHeight);

scale=2;
 console.log(scale,scale);
    // Create a canvas with scaled dimensions
    var canvas = document.createElement("canvas");
    canvas.width = contentWidth * scale;
    canvas.height = contentHeight * scale;

    // Scale the content and draw it on the canvas
    var canvasContext = canvas.getContext("2d");
    canvasContext.scale(scale, scale);

  html2canvas($("#contentToPrint")[0], { allowTaint: true, useCORS: true, dpi: 300 }).then(function (contentCanvas) {
        canvasContext.drawImage(contentCanvas, 0, 0);

        // Calculate the number of pages needed
        var numPages = Math.ceil(contentCanvas.height / PDF_Height);

        // Create a PDF with A4 dimensions for each page
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);

        for (var i = 0; i < numPages; i++) {
            if (i > 0) {
                pdf.addPage(); // Add a new page for subsequent pages
            }

            // Calculate the y-coordinate for the current page
            var offsetY = -i * PDF_Height;

            // Add the scaled image to the PDF
            pdf.addImage(canvas, 'JPEG', top_left_margin, top_left_margin + offsetY, contentWidth, contentHeight);
        }

        // Save or display the PDF as needed
        pdf.save("curriculum-vitae.pdf");

    });
}
</script>

</html>
<?php /**PATH /var/www/html/app/resources/views/pages/downloadPdf.blade.php ENDPATH**/ ?>