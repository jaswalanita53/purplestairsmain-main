<div>
  <?php if(!$published): ?>
    <div class="preview-sec prev2-sec prev-sec-new cmn-gap back-clr ban-up">
      <div class="preview-wrap">
        <div class="container">
          <?php if(!Route::is('companystep3') && !Route::is('company.viewprofile')): ?>
          <div class="form-points mb-3 form-points2">
              <?php
              $step = 5;
              $current_step = auth()->user()->current_step;
              ?>
              <?php echo $__env->make('inc.employersteps',compact('step', 'current_step'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
          <div class="preview-upper">
            <div class="preview-uppr-rgt">
              
              
            </div>
          </div>
          <?php endif; ?>
          <div class="prev-ban-wrap">
            <div class="preview-banner">
              <div class="preview-banner-fig">
                <figure>
                  <img src="<?php echo e(asset('assets/fe/images/ban1.png')); ?>" alt="" />
                </figure>
              </div>
              <div class="preview-banner-txt"></div>
            </div>
            <div class="preview_banner_btm">
              <div class="preview_banner_img_sec">
                <div class="preview_banner_img_sec_left pev2 ">
                  <figure>
                    <?php if($company_profile): ?>
                    <img src="<?php echo e(asset($company_profile)); ?>" alt="" />
                    <?php else: ?>
                    <img src="<?php echo e(asset('assets/fe/images/up-photo.png')); ?>" alt="" />
                    <?php endif; ?>
                  </figure>
                  <?php if($company->user_id==Auth::id()): ?>
                  <div class="add_btn_otr">
                    <!-- <a href="<?php echo e(Auth::user()->status ? route('company.editprofile') : route('companystep1')); ?>" class="add_btn"
                      ><span><img src="<?php echo e(asset('assets/fe/images/pen.svg')); ?>" alt="" /></span> Edit My
                      Profile</a
                    > -->
                    <a href="javascript:void(0)" class="add_btn" wire:click="viewProfileApprove()"
                      ><span><img src="<?php echo e(asset('assets/fe/images/pen.svg')); ?>" alt="" /></span> Edit My
                      Profile</a
                    >

                  </div>
                  <?php endif; ?>
                </div>
                <div class="preview_banner_img_sec_rgt">
                  <div class="preview_banner_img_sec_rgt_wrapper">
                    <div class="defination-sec">
                      <div class="title">
                        <h4>
                          <?php echo e($company->company_name); ?>

                          <?php if($company->social_media_url != ''): ?>
                          <a href="<?php echo e(fix_url_protocol($company->social_media_url)); ?>"
                            ><img src="<?php echo e(asset('assets/fe/images/linkdin-ylw.svg')); ?>" alt=""
                          /></a>
                          <?php endif; ?>
                          <?php if($company->website_url != ''): ?>
                          <a href="<?php echo e(fix_url_protocol($company->website_url)); ?>"><img src="<?php echo e(asset('assets/fe/images/globe-ylw.svg')); ?>" alt="" /></a>
                          <?php endif; ?>
                        </h4>
                        <p><?php echo e(ucwords(Auth::user()->name)); ?></p>
                      </div>
                      <div class="preview_banner_img_btm">
                        <ul class="preview_banner_img_list pv1">
                          <li>
                            <div class="preview_banner_img_list_inner">
                              <h6>Email</h6>
                              <p>
                                <a href="mailto:<?php echo e($company->company_email); ?>"
                                  ><?php echo e($company->company_email); ?></a
                                >
                              </p>
                            </div>
                          </li>
                          <li>
                            <div class="preview_banner_img_list_inner">
                              <h6>Phone</h6>
                              <p><a href="tel:<?php echo e($company->company_phone); ?>"><?php echo e($company->company_phone); ?></a></p>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="preview_banner_img_btm">
                      <ul class="preview_banner_img_list pv2">
                        <li>
                          <div class="preview_banner_img_list_inner">
                            <h6>Address</h6>
                            <p><?php echo e($company->company_address); ?></p>
                          </div>
                        </li>
                        <?php if($company->website_url != ''): ?>
                        <li>
                          <div class="preview_banner_img_list_inner">
                            <h6>Website</h6>
                            <p>
                              <a href="<?php echo e(fix_url_protocol($company->website_url)); ?>"
                                ><?php echo e($company->website_url); ?></a
                              >
                            </p>
                          </div>
                        </li>
                        <?php endif; ?>
                        <li>
                          <div class="preview_banner_img_list_inner">
                            <h6>Number Of Employees</h6>
                            <p><?php echo e($company->number_of_employees); ?></p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pv-btm-blck">
              <div class="preffered_block mt-0">
                <div class="preffered_block_left">
                  <h4>Company Benefits:</h4>
                </div>
                <div class="preffered_block_right">
                  <ul>
                    <?php if($company->paid_holidays): ?>
                    <li>Paid Holidays</li>
                    <?php endif; ?>
                    <?php if($company->insurance_benefits): ?>
                    <li>Insurance Benefits</li>
                    <?php endif; ?>
                    <?php if($company->casual_environment): ?>
                    <li>Casual Environment</li>
                    <?php endif; ?>
                    <?php if($company->paid_vacation_days): ?>
                    <li>Paid Vacation Days</li>
                    <?php endif; ?>
                    <?php if($company->professional_environment): ?>
                    <li>Professional Environment</li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
              <div class="about_candidate abt-can2">
                <div class="title">
                  <h4>About The Company</h4>
                </div>
                <div class="about_candidate_txt">
                  <p>
                    <?php echo e($company->company_description); ?>

                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="login-sec sign-up back-clr pt-4 log-h-sec ban-up ht_center_div">
      <div class="login-sec-wrap">
        <div class="container">
          <div
            class="log-wrap lg-wrp2"
            style="background-image: url(/assets/fe/images/log-back2.png)"
          >
            <div class="login-outr congo">
              <figure>
                <img src="<?php echo e(asset('assets/fe/images/party.svg')); ?>" alt="" />
              </figure>
              <h2 class="mb-4">Thank You</h2>
              <form>
                <div class="form-input">
                  <input
                    type="submit"
                    value="Start Browsing Candidates"
                    class="sub-btn sub2"
                  />
                </div>
              </form>
            </div>
            <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1 log12">
            <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2 log21">
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php /**PATH /var/www/html/app/resources/views/livewire/company-step3.blade.php ENDPATH**/ ?>