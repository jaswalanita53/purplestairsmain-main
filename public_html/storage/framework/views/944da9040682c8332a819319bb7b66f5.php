<div class="unmask-sec back-clr cmn-gap ban-up ban-up3">
    <div class="container">
      <div class="height_ofunmask">
        <div class="height_ofunmask_inr">
            <div class="sec-hdr">
              <h1>You have <span><?php echo e(Auth::user()->pending_unmask_request->count()); ?></span> Unmask Requests</h1>
            </div>
            <div class="noti-outr">
              <div class="notification">
                <figure>
                  <img src="<?php echo e(asset('assets/fe/images/bell.svg')); ?>" alt="" />
                </figure>
                <p>
                  Below are requests received to unmask your profile information.
                  Press the unmask button located next to each request to provide
                  full access to your resume without masking details. Your profile
                  will ONLY BE UNMASKED FOR THE REQUESTING COMPANY.
                </p>
              </div>
            </div>
            <div class="unmask-table neww desktop-v">
              <div class="responsive-table">
                <table id="table_id" class="display" wire:ignore.self>
                  <thead>
                    <tr>
                      <th></th>
                      <th class="sort2">Date</th>
                      <th>Requester</th>
                      <th>Position Hiring</th>
                      <th>Message</th>
                      <th>Allow/Deny Access</th>
                      <th>Current Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $unmaskRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $unmask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr wire:key="<?php echo e($key); ?>">
                      <td>
                        <a href="#" wire:click="delete(<?php echo e($unmask->pivot->company_id); ?>)">
                            <img src="<?php echo e(asset('assets/fe/images/dele.svg')); ?>" class="del-pic" alt=""
                        /></a>
                      </td>
                      <td><?php echo e($unmask->created_at->format('m-d-Y')); ?></td>
                      <td>
                        <a href="#" class="stdio">
                          <img src="<?php echo e(asset('assets/fe/images/usr2.png')); ?>" alt="" />
                          <span><?php echo e($unmask->company_name); ?></span>
                        </a>
                      </td>
                      <td>
                        <p class="p1">
                          <?php echo e($unmask->pivot->position_hiring); ?>

                        </p>
                      </td>
                      <td>
                        <p class="p2">
                          <?php echo e($unmask->pivot->message); ?>&nbsp;
                          <a data-fancybox data-src="#open" href="javascript:;" wire:click="viewNote(<?php echo e($unmask); ?>)">
                            READ MORE
                          </a
                          >
                        </p>
                      </td>
                      <?php if($unmask->pivot->status == 0): ?>
                      <td><a href="#" class="btn" wire:click="unmaskProfile(<?php echo e($unmask->pivot->company_id); ?>,1)">Unmask My Profile</a></td>
                      <?php endif; ?>
                      <?php if($unmask->pivot->status == 1): ?>
                      <td><a href="#" class="btn trans-btn" wire:click="unmaskProfile(<?php echo e($unmask->pivot->company_id); ?>,0)">Mask My Profile</a></td>
                      <?php endif; ?>
                      <?php if($unmask->pivot->status == 0): ?>
                      <td><img src="<?php echo e(asset('assets/fe/images/ma1.svg')); ?>" alt="" class="mask" /></td>
                      <?php endif; ?>
                      <?php if($unmask->pivot->status == 1): ?>
                      <td><img src="<?php echo e(asset('assets/fe/images/ma2.svg')); ?>" alt="" class="mask" /></td>
                      <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="un-mob mobile-v">
              <div class="unmask-mobile unmask-table">
                <div class="unmask-mob-wrap">

                  <div class="unmask_quoted_sectn_new">
                      <div class="row unmask_quoted_sectn_new_row gy-3">
                          <div class="col-7 lft">
                              <a href="#url" class="studeio_sec_mbl">
                                  <span class="fig_img"><img src="<?php echo e(asset('assets/fe/images/usr2.png')); ?>" alt=""></span>
                                  <span class="studeo_Sec_cnt">Artistre Studio</span>
                              </a>
                          </div>

                          <div class="col-5 rtt">
                              <a href="#" class="delte_ico_sc"><img src="<?php echo e(asset('assets/fe/images/dele.svg')); ?>" class="del-pic" alt="" /></a>
                          </div>

                          <div class="col-7 lft">
                              <a href="javascript:void(0)" class="btn">Unmask My Profile</a>
                          </div>

                          <div class="col-5 rtt">
                              <span class="date_part_qt">01/11/22</span>
                          </div>


                      </div>
                  </div>


                </div>

              </div>
              <div class="unmask-mobile unmask-table">
                <div class="unmask-mob-wrap">
                    <div class="row unmask_quoted_sectn_new_row gy-3">
                          <div class="col-7 lft">
                              <a href="#url" class="studeio_sec_mbl">
                                  <span class="fig_img"><img src="<?php echo e(asset('assets/fe/images/usr2.png')); ?>" alt=""></span>
                                  <span class="studeo_Sec_cnt">Artistre Studio</span>
                              </a>
                          </div>

                          <div class="col-5 rtt">
                              <a href="#" class="delte_ico_sc"><img src="<?php echo e(asset('assets/fe/images/dele.svg')); ?>" class="del-pic" alt="" /></a>
                          </div>

                          <div class="col-7 lft">
                              <a href="javascript:void(0)" class="btn">Unmask My Profile</a>
                          </div>

                          <div class="col-5 rtt">
                              <span class="date_part_qt">01/11/22</span>
                          </div>


                      </div>

                </div>

              </div>
              <div class="unmask-mobile unmask-table">
                <div class="unmask-mob-wrap">
                    <div class="row unmask_quoted_sectn_new_row gy-3">
                          <div class="col-7 lft">
                              <a href="#url" class="studeio_sec_mbl">
                                  <span class="fig_img"><img src="<?php echo e(asset('assets/fe/images/usr2.png')); ?>" alt=""></span>
                                  <span class="studeo_Sec_cnt">Artistre Studio</span>
                              </a>
                          </div>

                          <div class="col-5 rtt">
                              <a href="#" class="delte_ico_sc"><img src="<?php echo e(asset('assets/fe/images/dele.svg')); ?>" class="del-pic" alt="" /></a>
                          </div>

                          <div class="col-7 lft">
                              <a href="javascript:void(0)" class="btn">Unmask My Profile</a>
                          </div>

                          <div class="col-5 rtt">
                              <span class="date_part_qt">01/11/22</span>
                          </div>


                      </div>
                </div>

              </div>
              <div class="unmask-mobile unmask-table">
                <div class="unmask-mob-wrap">
                    <div class="row unmask_quoted_sectn_new_row gy-3">
                          <div class="col-7 lft">
                              <a href="#url" class="studeio_sec_mbl">
                                  <span class="fig_img"><img src="<?php echo e(asset('assets/fe/images/usr2.png')); ?>" alt=""></span>
                                  <span class="studeo_Sec_cnt">Artistre Studio</span>
                              </a>
                          </div>

                          <div class="col-5 rtt">
                              <a href="#" class="delte_ico_sc"><img src="<?php echo e(asset('assets/fe/images/dele.svg')); ?>" class="del-pic" alt="" /></a>
                          </div>

                          <div class="col-7 lft">
                              <a href="javascript:void(0)" class="btn">Unmask My Profile</a>
                          </div>

                          <div class="col-5 rtt">
                              <span class="date_part_qt">01/11/22</span>
                          </div>


                      </div>
                </div>

              </div>
            </div>

            <div class="delete-btn">
              <a href="#" wire:click="$set('mode', <?php echo e(!$mode); ?>)"><em><img src="<?php echo e(asset('assets/fe/images/del2.svg')); ?>" alt=""/></em>Show Archived
                Requests</a
              >
            </div>
        </div>
      </div>

      <div class="cmn-form-btm">
        <div class="ftr-btm-lft">
          <p>© 2022 <a href="#">Purple Stairs</a></p>
          <span
            >Website by
            <a href="https://www.brand-right.com/" target="_blank">
              BrandRight Marketing Group</a
            ></span
          >
        </div>
      </div>
    </div>
  </div>
  <div class="modal1">
    <div class="fancy-modal-body" id="open">
      <div class="modal-wrap text-center">
        <figure>
          <img src="<?php echo e(asset('assets/fe/images/chat.svg')); ?>" alt="" />
        </figure>
        <h4>Message From Requester</h4>
        <p>
           <?php echo e($currentNote); ?>

        </p>
        <a href="#">Message from: <?php echo e($currentEmployer); ?></a>
      </div>
    </div>
  </div>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/candidate-requests.blade.php ENDPATH**/ ?>