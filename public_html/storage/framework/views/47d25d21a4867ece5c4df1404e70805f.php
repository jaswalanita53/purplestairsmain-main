<?php $__currentLoopData = $ncandidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    
    <?php
        $employments = []; $yrs_of_exp = 0; $exp_months = 0;
        if($candidate->employments->count()) {
            $employments = $candidate->employments->toArray();
            $start_years = array_column($employments, 'start_year');
            $end_years = array_column($employments, 'end_year');
            $st_year = null;
            $ed_year = null;
            // print_r($employments);
            if(count($start_years)) {
                $tmp_years = [];
                foreach($start_years as $idx => $syear) {
                    if($syear !== '') {
                        $date1 = date('Y-m-01', strtotime($employments[$idx]['start_year']));
                        $date2 = date('Y-m-d');
                        if ($employments[$idx]['end_year'] == '' && $employments[$idx]['currently_working']) {
                            $date2 = date('Y-m-01');
                        } elseif ($employments[$idx]['end_year'] == '' && $employments[$idx]['currently_working'] == 0) {
                            $date2 = $date1;
                        } elseif ($employments[$idx]['end_year'] !== '') {
                            $date2 = date('Y-m-01', strtotime($employments[$idx]['end_year']));
                        }

                        if ($date1 && $date2) {
                            $diff = abs(strtotime($date2) - strtotime($date1));
                            $years = floor($diff / (365 * 60 * 60 * 24));
                            // $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                            $exp_months += $years;
                        }
                    }
                }
                $yrs_of_exp = $exp_months;
            }
        }
    ?>
    

    <?php $hired_employee=""; ?>
        <?php if(!empty($candidate->delete_status)): ?>
        <?php if($candidate->delete_status->type=='sleep'): ?>
        <?php $hired_employee="blured_box";?>
        <?php endif; ?>
        <?php endif; ?>
    <div class="listview_candidate_details_w detail_<?php echo e($hired_employee); ?>">
        <?php if(!empty($candidate->delete_status)): ?>
        <?php if($candidate->delete_status->type=='sleep'): ?>
        <span class="hired">Hired</span><span class="hired-flag"></span>
        <?php $hired_employee="blured_box";?>
        <?php endif; ?>
        <?php endif; ?>



        <div class="listview_candidate_details  <?php echo e($hired_employee); ?>" data-url="<?php echo e(route('company.candidateprofile', ['user_id' => $candidate->id])); ?>">
            <div class="layout_back" style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;" >
            </div>
            <div >
                <div class="listview_candidate_details_img">
                    <?php if($candidate->companyStatus->first()): ?>

                    <?php if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2): ?>
                    <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" class="unmasked-p img-thumbnail" />
                    <?php else: ?>
                    <?php if($candidate->profile_photo_path): ?>
                    <img src="<?php echo e(asset($candidate->profile_photo_path)); ?>" alt="" class="" />
                    <?php else: ?>
                    <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" class="" />
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php else: ?>
                    <img src="<?php echo e(asset('/assets/be/images/masked_ic.png')); ?>" alt="" class="unmasked-p img-thumbnail" />
                    <?php endif; ?>
                </div>
            </div>
            <div >
                <div class="listview_candidate_details_head">


                    <?php if($candidate->companyStatus->first()): ?>
                    <!-- <?php echo e($candidate->companyStatus); ?> -->
                    <?php if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2): ?>

                    <?php if(!empty($candidate->name)): ?>
                                            <h6 class="blured_txt"><?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, strlen($candidate->name))); ?></h6>
                                            <?php else: ?>
                                            <h6 class="blured_txt">Candidate Name</h6>
                                            <?php endif; ?>
                    <?php else: ?>
                    <h6><?php echo e($candidate->name); ?> </h6>
                    <?php endif; ?>
                    <?php else: ?>
                    <?php if(!empty($candidate->name)): ?>
                                            <h6 class="blured_txt"><?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, strlen($candidate->name))); ?></h6>
                                            <?php else: ?>
                                            <h6 class="blured_txt">Candidate Name</h6>
                                            <?php endif; ?>
                    <?php endif; ?>

                    <p><?php echo e($candidate->personal ? $candidate->personal->current_title : ''); ?></p>
                </div>
            </div>

            <div onclick="/*window.location.href='<?php echo e(route('company.candidateprofile', ['user_id' => $candidate->id])); ?>'*/">
                <div class="ecperice_list">
                    <div class="candidate_grid_ppl_top_btm_wrap">
                        <!-- <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>" alt="" /></i>
                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                            <p><?php echo e($yrs_of_exp); ?> Yrs Experience</p>
                        </div> -->
                        <?php
                                            $worksetting="";
                                            $worksettingIcon="";
                                            if(!empty($candidate->personal->work_environment_remote)){
                                                $worksetting .="Remote/" ;
                                            }
                                            if(!empty($candidate->personal->work_environment_in_office)){
                                                $worksetting .="In Office/" ;
                                            }
                                            if(!empty($candidate->personal->work_environment_hybrid)){
                                                $worksetting .="Hybrid" ;
                                            }
                                            if(!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)){
                                                $worksettingIcon= "location";
                                            }
                                            if(!empty($candidate->personal->work_environment_hybrid)){
                                                $worksettingIcon= "location";
                                            }
                                            ?>
                                            <i class="primary-icon fa fa-map-marker" aria-hidden="true"></i>
                                            <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                <p><?php echo e(rtrim($worksetting, '/')); ?></p>
                                            </div>
                    </div>

                    <div class="candidate_grid_ppl_top_btm_wrap">
                        <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>" alt="" /></i>
                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                            <!-- <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>, <?php echo e($candidate->personal ? $candidate->personal->state_abbr : ''); ?></p>
                         -->
                         <?php if(isset($candidate->industries)): ?>
                                                    <p><?php echo e($candidate->industries->first() ? $candidate->industries->first()->name : ''); ?>

                                                    </p>
                                                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gr_fl" >
                <div class="ask_salary_sec">
                    <i class="ic_icon">$</i>
                    <div class="ask_salary_sec_rtt">
                        <h6>Asking Salary</h6>
                        <p><?php echo e($candidate->personal ? $candidate->personal->salary_range : ''); ?></p>
                    </div>
                </div>
            </div>

            <div class="gr_fl2">
                <?php if(count($saved_searches)>0): ?>
                <div class="candidate_grid_ppl_icn large">
                    <a href="#url" class="clickd_tgl_searches">
                        <svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="ellipsis-icon">
                            <circle cx="17.5" cy="12" r="1.5" />
                            <circle cx="12" cy="12" r="1.5" />
                            <circle cx="6.5" cy="12" r="1.5" />
                        </svg></a>
                    <div class="clickd_tgl_searches_open">
                        <div class="clickd_tgl_searches_open_head">
                            <h5>Manage Matched Searches</h5>
                        </div>
                        <div class="clickd_tgl_searches_open_ul arr_grey">
                            <div class="form_input_check">
                                <?php $__currentLoopData = $saved_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $is_checked = in_array($candidate->id, $search->candidate_ids) ? 1 : 0; ?>
                                <label>
                                    <input type="checkbox" class="manual_add_saved_serach" data-search-id="<?php echo e($search->id); ?>" data-candidate="<?php echo e($candidate->id); ?>" wire:click="changeEvent('<?php echo e($is_checked); ?>', '<?php echo e($search->id); ?>','<?php echo e($candidate->id); ?>')" <?php echo e($is_checked ? 'checked' : ''); ?> />
                                    <span><?php echo e($search->name); ?></span>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="gr_fl3">
                <?php if($candidate->companyStatus->first()): ?>
                <?php if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2): ?>
                <div class="pending_unmask">
                    <i class="iconc"><img src="<?php echo e(asset('assets/be/images/clock.svg')); ?>" alt=""></i>
                    <div class="pending_unmask_rt">
                        <h6>Pending Unmask</h6>
                        <p>Profile Saved In Requested</p>
                    </div>
                </div>
                <?php else: ?>
                <div class="unmasked_div_ic">
                    <i class="iconc"><img src="<?php echo e(asset('assets/be/images/unmasked.svg')); ?>" alt=""></i>
                    <div class="unmasked_div_ic_rtt">
                        <h6>Unmasked</h6>
                        <p>View Unmasked Profile Now</p>
                    </div>
                </div>
                <?php endif; ?>
                <?php else: ?>
                <!-- <a href="javascript:void(0)" class="req_mask_btn" wire:click.prevent="sendRequest(<?php echo e($candidate->id); ?>)"> -->
                <a href="javascript:void(0)" class="req_mask_btn">
                    <i class="ic_req_m"><img src="<?php echo e(asset('assets/be/images/masked.svg')); ?>" alt="" /></i>
                    <div class="req_mask_btn_rtt">Request Unmask</div>
                </a>
                <div class="modal fade inline-table-modal" id="send-request-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <button type="button" class="close float-right send-rew-cut" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body">

                                <div class="position_form" wire:ignore.self>

                                    <form wire:submit.prevent="sendRequest(<?php echo e($candidate->id); ?>)">
                                        <div class="form-group">
                                            <label>Position Available*</label>
                                            <input type="text" class="form-control" placeholder="Job title here" wire:model.defer="position_hiring" />
                                            <input type="hidden" class="form-control" placeholder="Job title here" wire:model.lazy="user_id" value="<?php echo e($candidate->id); ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Message to Candidate</label>
                                            <textarea placeholder="I reviewed your resume..." wire:model.lazy="message"></textarea>
                                        </div>
                                        <div class="position-submit-btn-otr" wire:loading.remove wire:target="sendRequest">
                                            <input type="submit" value="Send to Candidate" class="position_submit_btn" />
                                        </div>
                                        <div class="position-submit-btn-otr" wire:loading wire:target="sendRequest">
                                            <input type="submit" value="Sending..." disabled class="position_submit_btn" />
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endif; ?>


                <?php if(time() - strtotime($candidate->created_at) < 60*60*24): ?>
                    <span class="text-danger"><b>NEW!</b></span>
                <?php endif; ?>
            </div>

            <a href="javascript:void(0)" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" class="eye-ball2 eyeBall" wire:click="viewProfile(<?php echo e($candidate->id); ?>)" data-id="<?php echo e($candidate->id); ?>">
                
                <?php
                    $exp = $yrs_of_exp;
			        $fistBar=0;
			        $secondBar=0;
			        $thirddBar=0;

			        if($exp<=4){
			            $fistBar=0;
			            $secondBar=0;
			            $thirddBar=0;
			        }
			        if($exp>=5 && $exp<=10){
			            $fistBar=100;
			            $secondBar=0;
			            $thirddBar=0;
			        }
			        if($exp>=11 && $exp<=19){
			            $fistBar=100;
			            $secondBar=100;
			            $thirddBar=0;
			        }
			        if($exp>=20){
			            $fistBar=100;
			            $secondBar=100;
			            $thirddBar=100;
			        }
					$yrs='Yrs';
			        if($exp<=1){
			            $yrs='Yr';
			        }
					echo    '<span>'.$exp.' '.$yrs.' Experience</span>
					        <div class="d-flex exp-progress-bar">
					            <div class="progress first-bar">
					                <div class="progress-bar w-'.$fistBar.'" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
					                </div>
					            <div class="progress second-bar">
					                <div class="progress-bar w-'.$secondBar.'" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
					                </div>
					            <div class="progress third-bar">
					                <div class="progress-bar w-'.$thirddBar.'" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
					                </div>
					        </div>';
					    
    			?>
            </a>
        </div>

    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/html/app/resources/views/ajax/candidate_list_2.blade.php ENDPATH**/ ?>