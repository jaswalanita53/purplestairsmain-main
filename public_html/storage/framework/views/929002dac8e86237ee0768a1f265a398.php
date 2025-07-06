<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
<?php $__env->stopPush(); ?>
<div>
    <section class="back-clr resume-sec cmn-gap pb-0 ban-up ban-up3 main-form-sec">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb edit-personal justify-content-center justify-content-md-start">
                    <li class=" mb-2 mb-md-0"><a href="<?php echo e(route('candidates.editpersonal')); ?>">Edit Personal Information</a></li>
                    <li class=" mb-2 mb-md-0"><a href="<?php echo e(route("candidates.editpreferences")); ?>">Edit Position Preferences</a></li>
                    <li class="active mb-2 mb-md-0" aria-current="page">Edit Resume Information</li>

                </ol>
            </nav>
            <div class="sec-hdr mb-4 mb-md-5 d-flex align-items-center justify-content-between">
                <h2 class="mb-0">
                    Edit Resume information
                </h2>
                    <div class="profile-btn ms-btn text-nowrap">
                        <?php if(Auth::user()->current_step==9): ?>
                        <a href="<?php echo e(route("candidatestep9")); ?>"> Preview Profile</a>
                        <?php else: ?>
                            
                            <?php
                                $error1 = array_filter($end_year_error);
                                $error2 = array_filter($employment_end_year_error);
                            ?>

                            <?php if(!empty($error1) || !empty($error2)): ?>
                                <a href="javascript:;" onclick="validatePage()" class="px-3 px-md-5"> View Profile</a>
                            <?php else: ?>
                                <a href="<?php echo e(route("candidateProfile")); ?>" class="px-3 px-md-5"> View Profile</a>
                            <?php endif; ?>
                            
                        <?php endif; ?>
                    </div>
            </div>

            
            <?php if(session('message')): ?>
            <div class="alert alert-success">
                <?php echo e(session('message')); ?>

            </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
            <span class="alert alert-danger">

                <strong><?php echo e(session('error')); ?></strong>
            </span>
            <?php endif; ?>
            

            <form wire:submit.prevent="updateResume()">
                <div class="cmn-form">
                    <div class="cmn-head">
                        <h5>Most Recent Education</h5>
                        
                    </div>
                    <div class="form-sec gl-form ">
                        <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row main-edu-sec">
                            
                            <?php if($key > 0): ?>
                            <div class="col-lg-12">
                                <button type="button" class="remove_additional_sec" wire:click="removeEdu(<?php echo e($education->id); ?>)"><img src="<?php echo e(asset('assets/fe/images/delete.svg')); ?>" alt="Remove Section" /></button>
                            </div>
                            <?php endif; ?>

                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Course Name</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" value--="<?php echo e($program_name[$education->id]); ?>" class="form-control" wire:model="program_name.<?php echo e($education->id); ?>" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">

                                                <input type="checkbox" class="switch_1" data-value="<?php echo e($program_name_status[$education->id]); ?>" checked="" wire:model="program_name_status.<?php echo e($education->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($education->program_name_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>School/Organization Name</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model="organization_name.<?php echo e($education->id); ?>" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($organization_name_status[$education->id]); ?>" wire:model="organization_name_status.<?php echo e($education->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($education->organization_name_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Short Description</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model="course_description.<?php echo e($education->id); ?>" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($course_description_status[$education->id]); ?>" wire:model="course_description_status.<?php echo e($education->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($education->course_description_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>

                            <div class="col-lg-6">

                                <div class="gl-frm-outr mb-0">
                                    <label>Years:</label>
                                    <div class="form-group for-dropdown-option for-abs-label">
                                        <div class="input-field-dropdown">
                                            <div class=" input-daterange">
                                                <div class="yr-field">
                                                    <input type="text" class="form-control input1" placeholder="Start Date" wire:model="start_year.<?php echo e($education->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="start_year.<?php echo e($education->id); ?>" wire:ignore />
                                                </div>
                                                <?php if($currently_studying[$education->id]): ?>
                                                <div class="">
                                                    <input type="text" class="form-control"  placeholder="End Date " value="PRESENT" wire:key="end_year_current.<?php echo e($education->id); ?>" />
                                                </div>
                                                <?php else: ?>
                                                <div class="yr-field">
                                                    <input type="text" class="form-control input2" placeholder="End Date " wire:model="end_year.<?php echo e($education->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="end_year.<?php echo e($education->id); ?>" wire:ignore />
                                                </div>
                                                <?php endif; ?>

                                            </div>

                                        </div>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($start_year_status[$education->id]); ?>" wire:model="start_year_status.<?php echo e($education->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($education->start_year_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

                                                <div class="in-ap">
                                                    <p>
                                                        This information will only be unmasked to a Requesting
                                                        company <strong>upon your approval.</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(isset($end_year_error[$education->id])): ?>
                                      <div class="error" style="margin-top: -10px;">
                                          <small class="text-danger"><?php echo e($end_year_error[$education->id]); ?> </small>
                                      </div>
                                    <?php endif; ?>
                                    <div class="form-group" style="margin-top: <?php echo e(isset($end_year_error[$education->id]) ? '' : '-15px !important'); ?>;">
                                        <label for="">I am currently studying here</label>
                                        <input type="checkbox" class="present currently_studying" data-value="<?php echo e($currently_studying[$education->id]); ?>" checked="" wire:model="currently_studying.<?php echo e($education->id); ?>" data-eduid="<?php echo e($education->id); ?>"/>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <hr/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="gl-frm-btn">
                                    <a href="#" class="pos-btn" wire:click.prevent="add()">
                                        Add Previous Position
                                        <span>+</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="form-submit-btn mb-0">
                            <?php if(!empty($error1) || !empty($error2)): ?>
                            <input type="button" value="Save" class="submit-btn" onclick="validatePage()"/>
                            <?php else: ?>
                            <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="updateResume"/>
                            <?php endif; ?>
                            <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume"/>
                        </div>
                    </div>
                </div>

                <div class="cmn-form">
                    <div class="cmn-head">
                        <h5>Most Recent Position</h5>
                    </div>
                    <div class="form-sec gl-form">
                        <?php $__currentLoopData = $employments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            
                            <?php if($key > 0): ?>
                            <div class="col-lg-12">
                                <button type="button" class="remove_additional_sec" wire:click="removeEmp(<?php echo e($employment->id); ?>)"><img src="<?php echo e(asset('assets/fe/images/delete.svg')); ?>" alt="Remove Section" /></button>
                            </div>
                            <?php endif; ?>

                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Company Name</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model="company_name.<?php echo e($employment->id); ?>" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($company_name_status[$employment->id]); ?>" wire:model="company_name_status.<?php echo e($employment->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($employment->company_name_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Position/Title</label>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model="position.<?php echo e($employment->id); ?>" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($position_status[$employment->id]); ?>" wire:model="position_status.<?php echo e($employment->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($employment->position_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>

                            <div class="col-lg-6">

                                <div class="gl-frm-outr mb-0">
                                    <label>Years:</label>
                                    <div class="form-group for-dropdown-option for-abs-label">
                                        <div class="input-field-dropdown">
                                            <div class=" input-daterange">
                                                <div class="yr-field" wire:ignore:self>
                                                    <input type="text" class="form-control input1" placeholder="Start Date" wire:model="employment_start_year.<?php echo e($employment->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="employment_start_year.<?php echo e($employment->id); ?>" />
                                                </div>


                                                <?php if($currently_working[$employment->id]): ?>
                                                <div class="">
                                                    <input type="text" class="form-control" placeholder="End Date " value="PRESENT" wire:key="employment_end_year_current.<?php echo e($employment->id); ?>" />
                                                </div>
                                                <?php else: ?>
                                                <div class="yr-field" wire:ignore:self> <input type="text" class="form-control input2" placeholder="End Date " wire:model="employment_end_year.<?php echo e($employment->id); ?>" onchange="this.dispatchEvent(new InputEvent('input'))" wire:key="employment_end_year.<?php echo e($employment->id); ?>" /> </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($employment_start_year_status[$employment->id]); ?>" wire:model="employment_start_year_status.<?php echo e($employment->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($employment->employment_start_year_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

                                                <div class="in-ap">
                                                    <p>
                                                        This information will only be unmasked to a Requesting
                                                        company <strong>upon your approval.</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(isset($employment_end_year_error[$employment->id])): ?>
                                      <div class="error" style="margin-top: -10px;">
                                          <small class="text-danger"><?php echo e($employment_end_year_error[$employment->id]); ?> </small>
                                      </div>
                                    <?php endif; ?>
                                    <div class="form-group" style="margin-top: <?php echo e(isset($employment_end_year_error[$employment->id]) ? '' : '-15px !important'); ?>;">
                                        <label for="">I am currently working here</label>
                                        <input type="checkbox" class="currently_working" data-empid="<?php echo e($employment->id); ?>" checked="" wire:model="currently_working.<?php echo e($employment->id); ?>" />
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Position Responsibilities</label>
                                    <div class="form-group mb-0">
                                        <textarea placeholder="" class="lg-textarea" wire:model="responsibilities.<?php echo e($employment->id); ?>"></textarea>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" checked="" data-value="<?php echo e($responsibilities_status[$employment->id]); ?>" wire:model="responsibilities_status.<?php echo e($employment->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($employment->responsibilities_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-0">
                                    <label>Position Accomplishments</label>
                                    <div class="form-group cus-frm-gp mb-0">
                                        <textarea placeholder="" class="lg-textarea" wire:model="accomplishments.<?php echo e($employment->id); ?>"></textarea>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" data-value="<?php echo e($accomplishments_status[$employment->id]); ?>" checked="" wire:model="accomplishments_status.<?php echo e($employment->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($employment->accomplishments_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

                                                <div class="in-ap">
                                                    <p>
                                                        This information will only be unmasked to a Requesting
                                                        company <strong>upon your approval.</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="custom-tool">
                                            <span>?</span>

                                            <div class="tool-info">
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry.
                                                </p>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="gl-frm-btn">
                                    <a href="#" class="pos-btn" wire:click.prevent="addEmployment()">
                                        Add Previous Position
                                        <span>+</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-submit-btn m-0 mt-1">
                            <?php if(!empty($error1) || !empty($error2)): ?>
                            <input type="button" value="Save" class="submit-btn" onclick="validatePage()"/>
                            <?php else: ?>
                            <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="updateResume"/>
                            <?php endif; ?>
                            <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume"/>
                        </div>
                    </div>
                </div>
                <div class="cmn-form">
                    <div class="form-sec gl-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="skil-hdr  custom-skill-wrap">
                                    <h5>hard skills*</h5>
                                    <span class="custom-tool">
                        <span>?</span>

                        <div class="tool-info">
                            <p>
                                <strong>Hard skills </strong>are technical skills
                                aquired through education or experience.
                            </p>
                        </div>
                    </span>
                                </div>
                                <div class="form-group">
                                    <select class="js-example-tags hard_skills" multiple="multiple" wire:model="selectedHardSkills" id="selectedHardSkills">
                                        <?php $__currentLoopData = $all_hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($skill); ?>" <?php if(in_array($skill,$selectedHardSkills)): ?>  selected <?php endif; ?> ><?php echo e($key); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php echo $__env->make('inc.error', [
                                        'field_name' => 'selectedHardSkills',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="skil-hdr custom-skill-wrap">
                                    <h5>Soft skills*</h5>
                                    <span class="custom-tool">
                                        <span>?</span>

                                        <div class="tool-info">
                                            <p>
                                            <strong>Soft skills  </strong>are personal qualities and people skills.
                                            </p>
                                        </div>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <select class="js-example-tags soft_skills" multiple="multiple" wire:model="selectedSoftSkills" id="selectedSoftSkills">
                                        <?php $__currentLoopData = $all_soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($skill); ?>" <?php if(in_array($skill,$selectedSoftSkills)): ?>  selected <?php endif; ?> ><?php echo e($key); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php echo $__env->make('inc.error', [
                                        'field_name' => 'selectedSoftSkills',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="skil-hdr ">
                                    <h5>Languages</h5>
                                </div>
                                <div class="form-group">
                                    <select class="js-example-tags languages" multiple="multiple" wire:model="selectedLanguages" id="selectedLanguages">
                                        <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($language); ?>" <?php if(in_array($language,$selectedLanguages)): ?>  selected <?php endif; ?>><?php echo e($key); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php echo $__env->make('inc.error', [
                                        'field_name' => 'selectedLanguages',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>


                        </div>
                        <div class="form-submit-btn m-0 mt-1">
                            <?php if(!empty($error1) || !empty($error2)): ?>
                            <input type="button" value="Save" class="submit-btn" onclick="validatePage()"/>
                            <?php else: ?>
                            <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="updateResume"/>
                            <?php endif; ?>
                            <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume"/>
                        </div>
                    </div>

                </div>
                <div class="cmn-form">
                    <div class="cmn-head">
                        <h5>Reference</h5>
                    </div>
                    <div class="form-sec gl-form">
                        <?php $__currentLoopData = $references; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row align-items-baseline">
                        <?php if($key > 0): ?>
                            <div class="col-lg-12">
                                <button type="button" class="remove_additional_sec" wire:click="removeRef(<?php echo e($reference->id); ?>)"><img src="<?php echo e(asset('assets/fe/images/delete.svg')); ?>" alt="Remove Section" /></button>
                            </div>
                            <?php endif; ?>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-3">
                                    <label>Name</label>
                                    <div class="form-group disable-form mb-0">
                                        <input type="text" placeholder="" class="form-control name-input" wire:model="name.<?php echo e($reference->id); ?>" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" data-value="<?php echo e($name_status[$reference->id]); ?>" wire:model="name_status.<?php echo e($reference->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($reference->name_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-3">
                                    <label>Relationship</label>
                                    <div class="form-group disable-form mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model="relationship.<?php echo e($reference->id); ?>" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1 relationship-input" data-value="<?php echo e($relationship_status[$reference->id]); ?>" wire:model="relationship_status.<?php echo e($reference->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($reference->relationship_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-3">
                                    <label>Email</label>
                                    <div class="form-group disable-form mb-0">
                                        <input type="email" placeholder="" class="form-control email-input" wire:model="email.<?php echo e($reference->id); ?>" />
                                        <?php echo $__env->make('inc.error', [
                                        'field_name' => 'email.'.$reference->id,
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" data-value="<?php echo e($email_status[$reference->id]); ?>" wire:model="email_status.<?php echo e($reference->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($reference->email_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                            <div class="col-lg-6">
                                <div class="gl-frm-outr mb-3">
                                    <label>Phone</label>
                                    <div class="form-group disable-form mb-0">
                                        <input type="tel" placeholder="" class="form-control telle-edit phone-input" wire:model="phone.<?php echo e($reference->id); ?>" />
                                        <?php echo $__env->make('inc.error', [
                                        'field_name' => 'phone.'.$reference->id,
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" data-value="<?php echo e($phone_status[$reference->id]); ?>" wire:model="phone_status.<?php echo e($reference->id); ?>" />
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($reference->phone_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>

                        </div>
                        <hr/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="gl-frm-btn">
                                    <a href="#" class="pos-btn" wire:click.prevent="addReference()">
                                        Add Reference
                                        <span>+</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-submit-btn m-0 mt-1">
                            <?php if(!empty($error1) || !empty($error2)): ?>
                            <input type="button" value="Save" class="submit-btn" onclick="validatePage()"/>
                            <?php else: ?>
                            <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="updateResume"/>
                            <?php endif; ?>
                            <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume"/>
                        </div>
                    </div>

                </div>

                <!-- <div class="cmn-form">
                    <div class="cmn-head">
                        <h5>More About Me</h5>
                    </div>
                    <div class="form-sec gl-form">
                        <div class="row align-items-baseline">

                            <div class="col-lg-2 col-md-3">
                                <div class="form-group f-up new_uploaded_frm">
                                    <div class="upload-wrp">
                                        <?php if(Auth::user()->profile_photo_path): ?>
                                        <a href="javascript:void(0)">
                                            <?php if(!$profile_status): ?>
                                                <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" style="border-radius:50%; width-:114px !important; height-:114px !important;" width="70%"/>
                                            <?php else: ?>
                                                <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" style="border-radius:50%; width-:114px !important; height-:114px !important;" />
                                            <?php endif; ?>

                                        </a>
                                        <span class="remove-avatar" wire:click.stop="removeAvatar()"><img src="<?php echo e(asset('assets/fe/images/del2.svg')); ?>" class="del-pic" alt="" /></span>
                                        <?php else: ?>
                                        <a href="javascript:void(0)"><img src="<?php echo e(asset('assets/fe/images/up-photo.png')); ?>" alt="" /></a>
                                        <img src="<?php echo e(asset('assets/fe/images/up-plus.png')); ?>" alt="" class="up-plus" />
                                        <?php endif; ?>
                                    </div>

                                    <a href="javascript:void(0)" class="upload_btn nw_upldd">
                                        <?php if(Auth::user()->profile_photo_path): ?>
                                        <input type="file" wire:model="profile" class="change-photo"> Replace Photo
                                        <?php else: ?>
                                        <input type="file" wire:model="profile" class="change-photo"> Upload Photo (Please upload JPG/PNG format. Maximum size must be 1MB)
                                        <?php endif; ?>
                                    </a>

                                    <div class="toggle-switch-block" style="right: 0;top: 0; position: relative; background: none;">
                                      <span>show</span>
                                      <div class="switch_box box_1">
                                        <input type="checkbox" class="switch_1" data-value="<?php echo e($profile_status); ?>" <?php echo e($profile_status ? 'checked' : ''); ?>  wire:model.lazy="profile_status"/>
                                      </div>
                                      <span>Hide</span>
                                    </div>
                                    <div class="hiden <?php echo e($profile_status ? '' : 'show'); ?>">
                                      <div class="d-span">
                                        <img src="<?php echo e(asset('assets/fe/images/hidden.svg')); ?>" alt="" />Hidden to everyone

                                        <div class="in-ap">
                                          <p>
                                            This information will only be unmasked to a Requesting
                                            company <strong>upon your approval.</strong>
                                          </p>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <?php echo $__env->make('inc.error', [
                                'field_name' => 'profile',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="gl-frm-outr mb-0">
                                    <label>Short Bio</label>
                                    
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" wire:model="short_bio" />
                                        <div class="toggle-switch-block">
                                            <span>show</span>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1" wire:model="short_bio_status" <?php echo e($short_bio_status ? 'checked' : ''); ?> data-value="<?php echo e($short_bio_status); ?>"/>
                                            </div>
                                            <span>Hide</span>
                                        </div>
                                        <div class="hiden <?php echo e($short_bio_status ? '' : 'show'); ?>">
                                            <div class="d-span">
                                                <img src="images/hidden.svg" alt="" />Hidden to everyone

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

                            </div>
                        </div>
                        <div class="form-submit-btn mb-0 mob-sve">
                            <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="updateResume" />
                            <input type="submit" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume" />
                        </div>
                    </div>
                </div> -->
            </form>
        </div>
        <?php $__env->startPush('scripts'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

        <script>
            // task - 86a0jby08
            function validatePage() {
                // $('.relationship-input,.email-input,.email-input,.phone-input')
                // $('.align-items-baseline').each(function(){
                //     var relationship_input= $(this).find('.relationship-input').val();
                //     var email_input= $(this).find('.email-input').val();
                //     var phone_input= $(this).find('.phone-input').val();
                //     var name_input= $(this).find('.name_input').val();
                //     if((relationship_input!='' || email_input!='' || phone_input!='') && name_input==''){
                //            $(this).find('. name-input').parents('.form-group').append('<div class="text-danger" style=""> This field is required.</div>');
                //     }
                // })
                $('html, body').animate({
                    scrollTop: $("div.error:first").offset().top - 200
                  }, 500);
                  return false;
            }

            // task - 86a0pwt5m
            document.addEventListener("livewire:load", () => {
                Livewire.hook('message.processed', (message, component) => {
                    console.log('hook loads...');
                    $('select').select2({
                        closeOnSelect: true,
                        tags: false
                    });

                    let lang = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedLanguages');
                    let hard = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedHardSkills');
                    let soft = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedSoftSkills');

                    console.log(openLang, lang);
                    console.log(openSoft, soft);
                    console.log(openHard, hard);
                    if(openLang && lang.length == 0) {
                        $('#selectedLanguages').select2('open');
                        $('#selectedHardSkills, #selectedSoftSkills').select2('close');
                    } else if(openSoft && soft.length == 0) {
                        $('#selectedSoftSkills').select2('open');
                        $('#selectedInterests, #selectedLanguages').select2('close');
                    } else if(openHard && hard.length == 0) {
                        $('#selectedHardSkills').select2('open');
                        $('#selectedInterests, #selectedSoftSkills').select2('close');
                    } else {
                        $('#selectedHardSkills,#selectedInterests,#selectedIndustries').select2('close');
                    }

                    setTimeout(() => {
                        if($("div.error:first").length) {
                            validatePage();
                        }
                    }, 250);
                });
            })

            window.addEventListener('keep-open-language', event => {
                openLang = true; openSoft = false; openHard = false;
            });
            window.addEventListener('keep-open-soft', event => {
                openLang = false; openSoft = true; openHard = false;
            });
            window.addEventListener('keep-open-hard', event => {
                openLang = false; openSoft = false; openHard = true;
            });
            window.addEventListener('close-multiselect', event => {
                openLang = false; openSoft = false; openHard = false;
            });

            <?php if(request()->get('navigate') == 'error'): ?>
                validatePage();
                var cur_url = window.location.href.split('?');
                window.history.pushState(null, "", cur_url[0]);
            <?php endif; ?>
            // task - 86a0jby08 end

            $(document).on('change', '.currently_studying', function (e) {
                let edu_id = $(this).attr('data-eduid');
                if(!$(this).prop('checked')) {
                    window.livewire.find('<?php echo e($_instance->id); ?>').set('end_year.' + edu_id, null);
                }
                console.log($(this).prop('checked'),edu_id );
            });

            $(document).on('change', '.currently_working', function (e) {
                let emp_id = $(this).attr('data-empid');
                if(!$(this).prop('checked')) {
                    window.livewire.find('<?php echo e($_instance->id); ?>').set('employment_end_year.' + emp_id, null);
                }
                console.log($(this).prop('checked'),emp_id );
            });

            // task - 86a0fxn2y
            /* task - 86a0hxg00 $('.submit-btn').click(function(event) {
                $('html, body').animate({
                    scrollTop: $("div.cmn-head:first").offset().top - 200
                }, 500);
            });*/
            // task - 86a0fxn2y end

            //initiate languages select2
            document.addEventListener("livewire:load", () => {
                initDates();
                changePage();

                Livewire.on('newEducationAdded', function() {
                    initDates();
                    changePage();
                });

                Livewire.on('newEmploymentAdded', function() {
                    initDates();
                    changePage();
                });

                triggerSwitch();
            })

            function triggerSwitch() {
                $('.switch_1').each(function(index, el) {
                    if ($(el).attr('data-value') == 1) {
                        $(el).parents(".toggle-switch-block").next().removeClass("show");
                        $(el).prop('checked', true);
                    } else {
                        $(el).parents(".toggle-switch-block").next().addClass("show");
                        $(el).prop('checked', false);
                    }
                });
            }

            window.addEventListener('load-switches', event => {
                document.querySelectorAll('.switch_1').forEach(function(el,i){
                    // console.log($(el).attr('data-value'));
                    if ($(el).attr('data-value') == 1) {
                        $(el).parents(".toggle-switch-block").next().removeClass("show");
                        $(el).prop('checked', true);
                    } else {
                        $(el).parents(".toggle-switch-block").next().addClass("show");
                        $(el).prop('checked', false);
                    }
                });

                // document.querySelectorAll('.present').forEach(function(el,i){
                //     console.log($(el).attr('data-value'));
                //     if ($(el).attr('data-value') == 1) {
                //         $(el).parents(".toggle-switch-block").next().removeClass("show");
                //         $(el).attr('checked', true);
                //     } else {
                //         $(el).parents(".toggle-switch-block").next().addClass("show");
                //         $(el).attr('checked', false);
                //     }
                // });
            });

            document.addEventListener("livewire:load", () => {
                $("body").delegate(".change-photo", "change", function(e) {
                    $("body").delegate(".present", "click", function(e) {
                        if( $(this).prop("checked")){
                            $(this).parents('.gl-frm-outr').find('.input-daterange').find('input:last').val('PRESENT');
                        }
                    });
                });
            });

            window.addEventListener('init-dates', event => {
                initDates()
            });

            function initDates() {
                let el = $('.input-daterange .yr-field .form-control');
                initDate();
                Livewire.hook('message.processed', (message, component) => {
                    initDate()
                })

                function initDate() {
                    // el.datepicker({
                    $('.input1, .input2').datepicker({
                        format: 'M yyyy',
                        updateViewDate: true,
                        autoclose: true,
                        viewMode: "months",
                        minViewMode: "months",
                        endDate: new Date()
                    });
                }
            }

            function changePage() {
                $(".prev-btn").click(function(e) {
                    e.preventDefault();
                    location.replace('/candidate/education-employment')
                })
                $(".nxt-btn").click(function(e) {
                    e.preventDefault();
                    location.replace('/candidate/employment')
                })
            }
        </script>
        <script>
            // task - 862k3f2fe
            /*var hardSelect2, softSelect2, languageSelect2;
            var openHard = false;
            var openSoft = false;
            var openLang = false;

            var parent_id, child_id;
            let selected1 = [];
            let selected2 = [];
            let selected3 = [];

            //initiate languages select2
            document.addEventListener("livewire:load", () => {
                // initSelect2Languages();
                let el = $('.languages');
                initSelect();

                let el1 = $('.soft_skills');
                initSelectSoft();

                let el2 = $('.hard_skills');
                initSelectHard();

                $(document).on('click', '.select2-results__option', function(event) {
                    parent_id = $(this).parent().attr('id');
                    child_id = $(this).text();
                });
            // })

                // function initSelect2Languages() {
                    initSelect();
                    $('.languages').on('change', function(e) {
                        var data = $('.languages').select2("val");
                        var _old = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedLanguages');

                        var tmp_data = data.map(Number);
                        _old = _old.map(Number);
                        let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
                        let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

                        const values = tmp_data;
                        selected1 = selected1.filter((value) => values.includes(value));
                        const lastSelected = values.filter((value) => !selected1.includes(value));
                        selected1.push(lastSelected[0]);

                        let child_ = $('.languages option[value='+lastSelected[0]+']').text();
                        parent_id = $(".select2-results__option:contains('"+child_+"')").parent().attr('id');
                        child_id = child_;

                        if(diff1.length > 0 || diff2.length > 0) { window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedLanguages', data); }
                    });
                    Livewire.hook('message.processed', (message, component) => {
                        console.log(openLang);

                        if(openLang) { initSelect(1); } else {
                            initSelect();
                            initSelectSoft();
                            initSelectHard();
                        }
                    });

                    window.addEventListener('keep-open-language', event => {
                        var selected_items = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedLanguages');
                        if(selected_items.length) {
                            openLang = true;
                        } else {
                            openLang = false;
                        }
                        openSoft = false;
                        openHard = false;
                        // initSelect(1);
                    });

                    function initSelect(open = 0) {
                        languageSelect2 = el.select2({
                            closeOnSelect: false,
                            tags: false
                        });

                        // task - 86a114e9r
                        el.on('select2:select', function (e) {
                            $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
                        });

                        console.log(open);
                        if(open) {
                            el.select2("open");
                            console.log('here ...');
                            if(document.getElementById(parent_id)) {
                                document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('"+child_id+"')").outerHeight() * $(".select2-results__option:contains('"+child_id+"')").index() - 100;
                            }
                            /*initSelectSoft();
                            initSelectHard();*
                        }
                    }
                // }

                //initiate soft skills select2
                // function initSelect2Soft() {
                    initSelectSoft();
                    $('.soft_skills').on('change', function(e) {
                        var data = $('.soft_skills').select2("val");
                        var _old = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedSoftSkills');

                        var tmp_data = data.map(Number);
                        _old = _old.map(Number);
                        let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
                        let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

                        const values = tmp_data;
                        selected2 = selected2.filter((value) => values.includes(value));
                        const lastSelected = values.filter((value) => !selected2.includes(value));
                        selected2.push(lastSelected[0]);

                        let child_ = $('.soft_skills option[value='+lastSelected[0]+']').text();
                        parent_id = $(".select2-results__option:contains('"+child_+"')").parent().attr('id');
                        child_id = child_;

                        if(diff1.length > 0 || diff2.length > 0) { window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedSoftSkills', data); }
                    });
                    Livewire.hook('message.processed', (message, component) => {
                        if(openSoft) { initSelectSoft(1); } else {
                            initSelectSoft();
                            initSelect();
                            initSelectHard();
                        }
                    });

                    window.addEventListener('keep-open-soft', event => {
                        var selected_items = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedSoftSkills');
                        if(selected_items.length) {
                            openSoft = true;
                        } else {
                            openSoft = false;
                        }
                        console.log(openSoft);
                        openLang = false;
                        openHard = false;
                        // initSelectSoft(1);
                    });

                    function initSelectSoft(open = 0) {
                        softSelect2 = el1.select2({
                            closeOnSelect: false,
                            tags: false
                        });

                        // task - 86a114e9r
                        el1.on('select2:select', function (e) {
                            $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
                        });

                        if(open) {
                            softSelect2.select2("open");
                            if(document.getElementById(parent_id)) {
                                /*if($(".select2-results__option:contains('"+child_id+"')").length > 1) {
                                    let exact_match = $(".select2-results__option:contains('"+child_id+"')").filter(function(){
                                        return $(this).text() === child_id ? child_id : $(this).text();
                                    });
                                    console.log(exact_match);
                                } else {*
                                    document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('"+child_id+"')").outerHeight() * $(".select2-results__option:contains('"+child_id+"')").index() - 100;
                                // }
                            }
                            initSelect(openLang);
                            initSelectHard();
                        }
                    }
                // }

                //initiate hard skills select2

                // function initSelect2Hard() {
                    initSelectHard();
                    $('.hard_skills').on('change', function(e) {
                        var data = $('.hard_skills').select2("val");
                        var _old = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedHardSkills');

                        var tmp_data = data.map(Number);
                        _old = _old.map(Number);
                        let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
                        let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

                        const values = tmp_data;
                        selected3 = selected3.filter((value) => values.includes(value));
                        const lastSelected = values.filter((value) => !selected3.includes(value));
                        selected3.push(lastSelected[0]);

                        let child_ = $('.hard_skills option[value='+lastSelected[0]+']').text();
                        parent_id = $(".select2-results__option:contains('"+child_+"')").parent().attr('id');
                        child_id = child_;

                        if(diff1.length > 0 || diff2.length > 0) { window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedHardSkills', data); }
                    });
                    Livewire.hook('message.processed', (message, component) => {
                        if(openHard) { initSelectHard(1); } else {
                            initSelectHard();
                            initSelectSoft();
                            initSelect();
                        }
                    });

                    window.addEventListener('keep-open-hard', event => {
                        var selected_items = window.livewire.find('<?php echo e($_instance->id); ?>').get('selectedHardSkills');
                        if(selected_items.length) {
                            openHard = true;
                        } else {
                            openHard = false;
                        }
                        console.log(openHard);
                        openLang = false;
                        openSoft = false;
                        // initSelectHard(1);
                    });

                    function initSelectHard(open = 0) {
                        hardSelect2 = el2.select2({
                            closeOnSelect: false,
                            tags: false
                        });

                        // task - 86a114e9r
                        el2.on('select2:select', function (e) {
                            $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
                        });

                        if(open) {
                            hardSelect2.select2("open");
                            if(document.getElementById(parent_id)) {
                                /*if($(".select2-results__option:contains('"+child_id+"')").length > 1) {
                                    let exact_match = $(".select2-results__option:contains('"+child_id+"')").filter(function(){
                                        return $(this).text() === child_id ? child_id : $(this).text();
                                    });
                                    console.log(exact_match);
                                } else {*
                                    document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('"+child_id+"')").outerHeight() * $(".select2-results__option:contains('"+child_id+"')").index() - 100;
                                // }
                            }
                            initSelect();
                            initSelectSoft();
                        }
                    }
                // }
            });*/

            $('select').select2({
                closeOnSelect: true,
                tags: false
            });


            // task - 86a114e9r
            $('select').on('select2:select', function (e) {
                console.log($(this).val());
                $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
            });

            $('select').on('select2:unselect', function (e) {
                console.log($(this).val());
                // $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
            });



            /*$('select').on('select2:open', function (e) {
                let id = $(this).attr('id');
                console.log($('textarea[aria-describedby="select2-'+id+'-container"]').is(":focus"));
                if(!$(this).find('option:selected').length) {
                    console.log($(this).find('option:selected').length);
                    $('#' + id).select2('close');
                }
            });*/

            /*$('select').on('select2:close', function (e) {
                let id = $(this).attr('id');
                console.log($('[aria-owns=select2-'+id+'-results]').parent('.'));
                console.log($('#' + id).is(":focus"), id);
                if($(this).find('option:selected').length) {
                    console.log($(this).find('option:selected').length);
                    $('#' + id).select2('open');
                }
            });*/

            $('select').on('select2:unselect', function (e) {
                let val = $(this).val();
                let id = $(this).attr('id');
                if($(this).find('option:selected').length) {
                    $('#' + id).select2('open');
                } else {
                    $('#' + id).select2('close');
                }
            });

        </script>


        <script>
            // Reload component every 2 seconds
            document.addEventListener("livewire:load", () => {

                $("body").delegate(".change-photo", "change", function(e) {
                    console.log('1st');
                    Livewire.hook('message.processed', (message, component) => {
                        document.querySelectorAll('.switch_1').forEach(function(el,i){
                            console.log($(el).attr('data-value'));
                            if ($(el).attr('data-value') == 1) {
                                $(el).parents(".toggle-switch-block").next().removeClass("show");
                                $(el).prop('checked', true);
                            } else {
                                $(el).parents(".toggle-switch-block").next().addClass("show");
                                $(el).prop('checked', false);
                            }
                        });

                        /*setTimeout(() => {
                            var src = $('.upload-wrp').find('img').attr('src');
                            $('.avatar-img').find('img').attr('src', src);
                        }, 1000);*/
                    });


                });
            });

            // task - 8678eggpf
            var mask_img = "<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>";
            window.addEventListener('temp-update-avatar', event => {
              setTimeout(() => {
                  $('.upload-wrp').find('a').find('img').attr('src', '<?php echo e(asset('')); ?>' + event.detail.newPath);
                  var src = $('.upload-wrp').find('a').find('img').attr('src');
                  $('.avatar-img').find('img').attr('src', src);
              }, 1000);

              setTimeout(() => {
                  var _status = '<?php echo e($profile_status); ?>';
                  if(_status == '0') {
                    $('.avatar-img').find('img').attr('src', mask_img);
                    $('.upload-wrp').find('a').find('img').attr('src', mask_img);
                  }
              }, 2000);
            });

            window.addEventListener('update-avatar', event => {
                setTimeout(() => {
                    var src = $('.upload-wrp').find('img').attr('src');
                    $('.avatar-img').find('img').attr('src', src);
                }, 1000);
            });

            $("body").delegate(".upload-wrp", "click", function(e) {
                $('.change-photo').trigger('click')
            })
        $("body").delegate(".telle-edit", "keypress", function(e) {
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


                    $('.soft_skills').on('change', function(e) {
                        var data = $('.soft_skills').select2("val");
                        window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedSoftSkills', data);
                    });

                     $('.hard_skills').on('change', function(e) {
                        var data = $('.hard_skills').select2("val");
                         window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedHardSkills', data);
                    });
                     $('.hard_skills').on('change', function(e) {
                        var data = $('.hard_skills').select2("val");
                         window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedHardSkills', data);
                    });

                      $('.languages').on('change', function(e) {
                        var data = $('.languages').select2("val");
                        window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedLanguages', data)
                    });

        </script>
        <?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidate-edit-resume.blade.php ENDPATH**/ ?>