<div>
  <section class="main-form-sec back-clr main-form2 cmn-gap pb-0 ban-up ban-up3">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb edit-personal">
          <li class="active" aria-current="page">Edit Personal Information</li>
          <li class=""><a href="<?php echo e(route("candidates.editresume")); ?>">Edit Resume Information</a></li>
          <li class=""><a href="<?php echo e(route("candidates.editpreferences")); ?>">Edit Position Preferences</a></li>
        </ol>
      </nav>
      <div class="sec-hdr">
        <h2>Edit Personal Information
          <div class="profile-btn ms-btn">
            <a href="<?php echo e(route("candidateProfile")); ?>">View Profile</a>
          </div>
        </h2>
      </div>

      <div class="cmn-form">
        <div class="cmn-head">
          <h5>Personal Information</h5>
          <?php echo $__env->make('inc.autoSaveLoader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="form-sec gl-form">
          <form wire:submit.prevent="savePersonal()">
            <div class="row">
              <div class="col-lg-6">
                <div class="gl-frm-outr mb-2">
                  <label>Name*</label>
                  <div class="form-group mb-0">
                    <input type="text" placeholder="" class="form-control" wire:model.lazy="name" />
                    <div class="toggle-switch-block">
                      <span>show</span>
                      <div class="switch_box box_1">
                        <input type="checkbox" class="switch_1" wire:model.lazy="name_status" tabindex="-1" />
                      </div>
                      <span>Hide</span>
                    </div>
                    <div class="hiden <?php echo e($name_status ? '' : 'show'); ?>">
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
                <div class="gl-frm-outr mb-2">
                  <label>Email*</label>
                  <div class="form-group disable-form mb-0">
                    <input type="email" placeholder="" class="form-control" wire:model.lazy="email" />
                    <div class="toggle-switch-block">
                      <span>show</span>
                      <div class="switch_box box_1">
                        <input type="checkbox" class="switch_1" wire:model.lazy="email_status" tabindex="-1" />
                      </div>
                      <span>Hide</span>
                    </div>
                    <div class="hiden <?php echo e($email_status ? '' : 'show'); ?>">
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
                <div class="gl-frm-outr mb-2">
                  <label>Phone</label>
                  <div class="form-group disable-form mb-0">
                    <input type="text" placeholder="" class="form-control" wire:model.lazy="phone" />
                    <div class="toggle-switch-block">
                      <span>show</span>
                      <div class="switch_box box_1">
                        <input type="checkbox" class="switch_1" wire:model.lazy="phone_status" tabindex="-1" />
                      </div>
                      <span>Hide</span>
                    </div>
                    <div class="hiden <?php echo e($phone_status ? '' : 'show'); ?>">
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
                <div class="gl-frm-outr mb-2">
                  <label>Current Position/Title</label>
                  <div class="form-group mb-0">
                    <input type="text" placeholder="" class="form-control" wire:model.lazy="current_title" />
                    <div class="toggle-switch-block">
                      <span>show</span>
                      <div class="switch_box box_1">
                        <input type="checkbox" class="switch_1" wire:model.lazy="current_title_status" tabindex="-1" />
                      </div>
                      <span>Hide</span>
                    </div>
                    <div class="hiden <?php echo e($current_title_status ? '' : 'show'); ?>">
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
                <div class="gl-frm-outr mb-2">
                  <label>Zip code (Center of Work Radius)</label>
                  <div class="form-group mb-0">
                    <input type="text" placeholder="" class="form-control" wire:model.lazy="zip_code" />
                    <div class="toggle-switch-block">
                      <span>show</span>
                      <div class="switch_box box_1">
                        <input type="checkbox" class="switch_1" wire:model.lazy="zip_code_status" tabindex="-1" />
                      </div>
                      <span>Hide</span>
                    </div>
                    <div class="hiden <?php echo e($zip_code_status ? '' : 'show'); ?>">
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
                <div class="gl-frm-outr mb-2">
                  <label>Linkedin URL</label>
                  <div class="form-group mb-0">
                    <input type="text" placeholder="" class="form-control" wire:model.lazy="linkedin_url" />
                    <div class="toggle-switch-block">
                      <span>show</span>
                      <div class="switch_box box_1">
                        <input type="checkbox" class="switch_1" wire:model.lazy="linkedin_url_status" tabindex="-1" />
                      </div>
                      <span>Hide</span>
                    </div>
                    <div class="hiden <?php echo e($zip_code_status ? '' : 'show'); ?>">
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
                <div class="gl-frm-outr mb-2">
                  <label>Additional URL or Portfolio Link</label>
                  <div class="form-group mb-0">
                    <input type="text" placeholder="" class="form-control" wire:model.lazy="additional_url" />
                    <div class="toggle-switch-block">
                      <span>show</span>
                      <div class="switch_box box_1">
                        <input type="checkbox" class="switch_1" wire:model.lazy="additional_url_status" tabindex="-1" />
                      </div>
                      <span>Hide</span>
                    </div>
                    <div class="hiden <?php echo e($additional_url_status ? '' : 'show'); ?>">
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
            <div class="form-submit-btn mb-0">
              <input type="submit" value="Save" class="submit-btn" />
            </div>
          </form>
        </div>
      </div>
      <div class="cmn-form-btm">
        <div class="ftr-btm-lft">
          <p>© 2022 <a href="#">Purple Stairs</a></p>
          <span>Website by <a href="https://www.brand-right.com/" target="_blank"> BrandRight Marketing Group</a></span>
        </div>
      </div>
    </div>
  </section>
</div><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-edit-personal.blade.php ENDPATH**/ ?>