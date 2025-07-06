<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
<?php $__env->stopPush(); ?>
<div>
    <section class="back-clr resume-sec cmn-gap pb-0 ban-up ban-up3 main-form-sec">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb edit-personal">
              <li class=""><a href="<?php echo e(route('candidates.editpersonal')); ?>">Edit Personal Information</a></li>
              <li class="active" aria-current="page">Edit Resume Information</li>
              <li class=""><a href="<?php echo e(route("candidates.editpreferences")); ?>">Edit Position Preferences</a></li>
            </ol>
          </nav>
          <div class="sec-hdr">
            <h2>
              Edit Resume information
              <div class="profile-btn ms-btn">
                  <a href="<?php echo e(route("candidateProfile")); ?>">View Profile</a>
              </div>
            </h2>
          </div>
          <form wire:submit.prevent="updateResume()">
          <div class="cmn-form">
            <div class="cmn-head">
              <h5>Most Recent Education</h5> 
              <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
            </div>
            <div class="form-sec gl-form ">
                <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="gl-frm-outr mb-0">
                      <label >Course Name</label>
                      <div class="form-group mb-0">
                        <input
                          type="text"
                          placeholder=""
                          class="form-control"
                          wire:model="program_name.<?php echo e($education->id); ?>"
                        />
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" checked=""  wire:model="program_name_status.<?php echo e($education->id); ?>"/>
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
                        <input
                          type="text"
                          placeholder=""
                          class="form-control"
                          wire:model="organization_name.<?php echo e($education->id); ?>"
                        />
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" checked="" wire:model="organization_name_status.<?php echo e($education->id); ?>"/>
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
                        <input
                          type="text"
                          placeholder=""
                          class="form-control"
                          wire:model="course_description.<?php echo e($education->id); ?>"
                        />
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" checked="" wire:model="course_description_status.<?php echo e($education->id); ?>"/>
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
                      <label>Year Duration:</label>
                      <div class="form-group for-dropdown-option for-abs-label">
                        <div class="input-field-dropdown">
                          <div class=" input-daterange">
                            <div class="yr-field">
                            <input
                              type="text"
                              class="form-control input1"
                              placeholder="Start Year"
                              wire:model="start_year.<?php echo e($education->id); ?>"
                              onchange="this.dispatchEvent(new InputEvent('input'))"
                              wire:key="start_year.<?php echo e($education->id); ?>" wire:ignore
                            /></div>
                            <?php if($education->currently_studying): ?>
                            <div class="">
                                <input
                              type="text"
                              class=""
                              placeholder="End Year"
                              value="<?php echo e(Carbon\Carbon::now()->format('M Y')); ?>"
                              wire:key="end_year_current.<?php echo e($education->id); ?>"
                            /> </div>
                            <?php else: ?>
                            <div class="yr-field">
                                <input
                              type="text"
                              class="form-control input2"
                              placeholder="End Year"
                              wire:model="end_year.<?php echo e($education->id); ?>"
                              onchange="this.dispatchEvent(new InputEvent('input'))"
                              wire:key="end_year.<?php echo e($education->id); ?>" wire:ignore
                            /> </div>
                            <?php endif; ?>

                          </div>

                        </div>
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" checked="" wire:model="start_year_status.<?php echo e($education->id); ?>"/>
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
                      <div class="form-group">
                        <label for="">I am currently studying here</label>
                        <input type="checkbox" class="" checked="" wire:model="currently_studying.<?php echo e($education->id); ?>" />
                    </div>
                    </div>

                  </div>
                </div>
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
            </div>
          </div>

          <div class="cmn-form">
            <div class="cmn-head">
              <h5>Most Recent Position</h5>
            </div>
            <div class="form-sec gl-form">
                <?php $__currentLoopData = $employments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="gl-frm-outr mb-0">
                      <label>Company Name</label>
                      <div class="form-group mb-0">
                        <input
                          type="text"
                          placeholder=""
                          class="form-control"
                          wire:model="company_name.<?php echo e($employment->id); ?>"
                        />
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" checked="" wire:model="company_name_status.<?php echo e($employment->id); ?>"/>
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
                        <input
                          type="text"
                          placeholder=""
                          class="form-control"
                          wire:model="position.<?php echo e($employment->id); ?>"
                        />
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" checked="" wire:model="position_status.<?php echo e($employment->id); ?>"/>
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
                      <label>Year Duration:</label>
                      <div class="form-group for-dropdown-option for-abs-label">
                        <div class="input-field-dropdown">
                          <div class=" input-daterange">
                            <div class="yr-field" wire:ignore:self>
                            <input
                              type="text"
                              class="form-control input1"
                              placeholder="Start Year"
                              wire:model="employment_start_year.<?php echo e($employment->id); ?>"
                              onchange="this.dispatchEvent(new InputEvent('input'))"
                              wire:key="employment_start_year.<?php echo e($employment->id); ?>"
                            /></div>

                            <?php if($employment->currently_working): ?>
                            <div class="">
                            <input
                              type="text"
                              class=""
                              placeholder="End Year"
                              value="<?php echo e(Carbon\Carbon::now()->format('M Y')); ?>"
                              wire:key="employment_end_year_current.<?php echo e($employment->id); ?>"
                            /> </div>
                            <?php else: ?>
                            <div class="yr-field" wire:ignore:self>           <input
                                type="text"
                                class="form-control input2"
                                placeholder="End Year"
                                wire:model="employment_end_year.<?php echo e($employment->id); ?>"
                                onchange="this.dispatchEvent(new InputEvent('input'))"
                                wire:key="employment_end_year.<?php echo e($employment->id); ?>"
                              /> </div>
                            <?php endif; ?>
                          </div>

                        </div>
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" checked="" wire:model="employment_start_year_status.<?php echo e($employment->id); ?>"/>
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
                      <div class="form-group">
                        <label for="">I am currently working here</label>
                        <input type="checkbox" class="" checked="" wire:model="currently_working.<?php echo e($employment->id); ?>" />
                    </div>
                    </div>

                  </div>

                  <div class="col-lg-6">
                    <div class="gl-frm-outr mb-0">
                      <label>Position Responsibilities</label>
                      <div class="form-group mb-0">
                        <textarea
                          placeholder=""
                          class="lg-textarea"
                          wire:model="responsibilities.<?php echo e($employment->id); ?>"
                        ></textarea>
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" checked="" wire:model="responsibilities_status.<?php echo e($employment->id); ?>"/>
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
                        <textarea
                          placeholder=""
                          class="lg-textarea"
                          wire:model="accomplishments.<?php echo e($employment->id); ?>"
                        ></textarea>
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" checked="" wire:model="accomplishments_status.<?php echo e($employment->id); ?>"/>
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
                        <div class="custom-tool">
                          <span>?</span>

                          <div class="tool-info">
                            <p>
                              Lorem Ipsum is simply dummy text of the printing and
                              typesetting industry.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
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
            </div>
          </div>
          <div class="cmn-form">
            <div class="form-sec gl-form">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="skil-hdr">
                      <h5>hard skills</h5>
                      <div class="custom-tool">
                        <span>?</span>

                        <div class="tool-info">
                          <p>
                            <strong>Hard Skills are</strong> Technical Skills
                            Aquired Through Education or Experience.
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <select class="js-example-tags hard_skills" multiple="multiple" wire:model="selectedHardSkills">
                            <?php $__currentLoopData = $all_hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value=<?php echo e($skill); ?>><?php echo e($key); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="skil-hdr">
                      <h5>Soft skills</h5>
                      <div class="custom-tool">
                        <span>?</span>

                        <div class="tool-info">
                          <p>
                            Soft skills are personal Qualities and People skills.
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <select class="js-example-tags soft_skills" multiple="multiple" wire:model="selectedSoftSkills">
                            <?php $__currentLoopData = $all_soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value=<?php echo e($skill); ?>><?php echo e($key); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="skil-hdr">
                      <h5>Languages</h5>
                    </div>
                    <div class="form-group">
                        <select class="js-example-tags languages" multiple="multiple" wire:model="selectedLanguages">
                            <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value=<?php echo e($language); ?>><?php echo e($key); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                  </div>


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
                  <div class="col-lg-6">
                    <div class="gl-frm-outr mb-0">
                      <label>Name</label>
                      <div class="form-group disable-form mb-0">
                        <input
                          type="text"
                          placeholder=""
                          class="form-control"
                          wire:model="name.<?php echo e($reference->id); ?>"
                        />
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1"  wire:model="name_status.<?php echo e($reference->id); ?>"/>
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
                      </div>
                    </div>

                  </div>
                  <div class="col-lg-6">
                    <div class="gl-frm-outr mb-0">
                      <label>Relationship</label>
                      <div class="form-group disable-form mb-0">
                        <input
                          type="text"
                          placeholder=""
                          class="form-control"
                          wire:model="relationship.<?php echo e($reference->id); ?>"
                        />
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" wire:model="relationship_status.<?php echo e($reference->id); ?>"/>
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
                    <div class="gl-frm-outr mb-0">
                      <label>Email</label>
                      <div class="form-group disable-form mb-0">
                        <input
                          type="email"
                          placeholder=""
                          class="form-control"
                          wire:model="email.<?php echo e($reference->id); ?>"
                        />
                        <?php echo $__env->make('inc.error', [
                          'field_name' => 'email.'.$reference->id,
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" wire:model="email_status.<?php echo e($reference->id); ?>"/>
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
                    <div class="gl-frm-outr mb-0">
                      <label>Phone</label>
                      <div class="form-group disable-form mb-0">
                        <input
                          type="tel"
                          placeholder=""
                          class="form-control"
                          wire:model="phone.<?php echo e($reference->id); ?>"
                        />
                        <?php echo $__env->make('inc.error', [
                          'field_name' => 'phone.'.$reference->id,
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1"  wire:model="phone_status.<?php echo e($reference->id); ?>"/>
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
            </div>
          </div>
          <div class="cmn-form">
            <div class="cmn-head">
              <h5>More About Me</h5>
            </div>
            <div class="form-sec gl-form">
                <div class="row align-items-baseline">

                  <div class="col-lg-2 col-md-3">
                    <div class="form-group f-up new_uploaded_frm">
                      <div class="upload-wrp">
                        <?php if(Auth::user()->profile_photo_path): ?>
                        <a href="#"><img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" style="border-radius:50%; width:114px !important; height:114px !important;"/></a>
                        <?php else: ?>
                        <a href="#"><img src="<?php echo e(asset('assets/fe/images/up-photo.png')); ?>" alt=""/></a>
                        <img src="<?php echo e(asset('assets/fe/images/up-plus.png')); ?>" alt="" class="up-plus" />
                        <?php endif; ?>
                      </div>
                      <!-- <h5>Upload Photo</h5> -->
                      <a href="javascript:void(0)" class="upload_btn nw_upldd">
                        <?php if(Auth::user()->profile_photo_path): ?>
                        <input type="file" wire:model="profile"> Replace Photo
                        <?php else: ?>
                        <input type="file" wire:model="profile"> Upload Photo (Please upload JPG/PNG format. Maximum size must be 1MB)
                        <?php endif; ?>
                      </a>
                    </div>
                    <?php echo $__env->make('inc.error', [
                        'field_name' => 'profile',
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                  <div class="col-lg-10 col-md-9">
                    <div class="gl-frm-outr mb-0">
                      <label>Short Bio</label>
                      <div class="form-group disable-form mb-0">
                        <input
                          type="text"
                          placeholder=""
                          class="form-control"
                          wire:model="short_bio"
                        />
                        <div class="toggle-switch-block">
                          <span>show</span>
                          <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1" wire:model="short_bio_status"/>
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
                  <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="updateResume"/>
                  <input type="submit" value="Saving..." class="submit-btn" wire:loading wire:target="updateResume"/>
                </div>
            </div>
          </div>
          </form>
</div>
<?php $__env->startPush('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

    <script>
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
        })

        function initDates() {
            let el = $('.input-daterange .yr-field .form-control')
            initDate();
            Livewire.hook('message.processed', (message, component) => {
                initDate()
            })

            function initDate() {
                el.datepicker({
                    format: 'M yyyy',
                    updateViewDate: true,
                    autoclose: true,
                    viewMode: "months",
                    minViewMode: "months",
                    endDate: new Date()
                });
            }
        }

        function changePage(){
            $(".prev-btn").click(function(e) {
                e.preventDefault();
                location.replace('/candidate/employment')
            })
            $(".nxt-btn").click(function(e) {
                e.preventDefault();
                location.replace('/candidate/employments')
            })
        }
    </script>
    <script>
        //initiate languages select2
        document.addEventListener("livewire:load", () => {
            initSelect2Languages();
        })

        function initSelect2Languages() {
            let el = $('.languages')
            initSelect();
            $('.languages').on('change', function(e) {
                var data = $('.languages').select2("val");
                window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedLanguages', data);
            });
            Livewire.hook('message.processed', (message, component) => {
                initSelect()
            })

            function initSelect() {
                el.select2({
                    tags: false
                })
            }
        }

        //initiate soft skills select2
            document.addEventListener("livewire:load", () => {
            initSelect2Soft();
        })

        function initSelect2Soft() {
            let el = $('.soft_skills')
            initSelectSoft();
            $('.soft_skills').on('change', function(e) {
                var data = $('.soft_skills').select2("val");
                window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedSoftSkills', data);
            });
            Livewire.hook('message.processed', (message, component) => {
                initSelectSoft()
            })

            function initSelectSoft() {
                el.select2({
                    tags: false
                })
            }
        }

        //initiate hard skills select2
            document.addEventListener("livewire:load", () => {
            initSelect2Hard();
        })

        function initSelect2Hard() {
            let el = $('.hard_skills')
            initSelectHard();
            $('.hard_skills').on('change', function(e) {
                var data = $('.hard_skills').select2("val");
                window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedHardSkills', data);
            });
            Livewire.hook('message.processed', (message, component) => {
                initSelectHard()
            })

            function initSelectHard() {
                el.select2({
                    tags: false
                })
            }
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-edit-resume.blade.php ENDPATH**/ ?>