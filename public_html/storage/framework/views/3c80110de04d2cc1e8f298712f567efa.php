<?php $__currentLoopData = $ncandidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        
                        <?php
                            $employments = []; $yrs_of_exp = 0; $exp_months = 0;
                            if($candidate->employments->count()) {
                                $employments = $candidate->employments->toArray();
                                $start_years = array_column($employments, 'start_year');
                                $end_years = array_column($employments, 'end_year');
                                $st_year = null;
                                $ed_year = null;

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
                        

                        <div class="col-xl-4 col-md-6 candiate_list_view_parent_col">
                            <?php $hired_employee=""; ?>
                            <?php if(!empty($candidate->delete_status)): ?>
                            <!-- <?php if($candidate->delete_status->type=='sleep'): ?>
                            <span class="hired">Hired</span><span class="hired-flag"></span>
                            <?php $hired_employee="blured_box";?> -->
                            <!-- <?php endif; ?> -->
                            <span class="hired">Hired</span><span class="hired-flag"></span>
                            <?php $hired_employee="blured_box";?>
                            <?php else: ?>
                            <?php if($candidate->companyStatus->first()): ?>
                            <?php if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2): ?>
                            <span class="pending-label"><span class="hired">Requested</span><span class="hired-flag"><i class="iconc"><img src="<?php echo e(asset('assets/be/images/clock-white.svg')); ?>" alt=""></i></span></span>

                            <?php else: ?>
                            <span class="unmasked-flag">
                                <span class="hired">Unmasked</span><span class="hired-flag"></span>
                            </span>

                            <?php endif; ?>
                            <?php else: ?>
                            <?php endif; ?>
                            <?php endif; ?>


                            <div class="candidate_grid_ppl_wppt <?php echo e($hired_employee); ?>" data-url="<?php echo e(route('company.candidateprofile', ['user_id' => $candidate->id])); ?>">
                                <div class="candidate_grid_ppl">
                                    <div class="candidate_top_pnk_ic">
                                        <img src="<?php echo e(asset('assets/be/images/shape_left_pnk.png')); ?>" alt="" />
                                    </div>

                                    <?php if(count($saved_searches)>0): ?>
                                    <div class="candidate_grid_ppl_icn">
                                        <a href="#url" class="clickd_tgl_searches">
                                            <svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="ellipsis-icon">
                                                <circle cx="17.5" cy="12" r="1.5" />
                                                <circle cx="12" cy="12" r="1.5" />
                                                <circle cx="6.5" cy="12" r="1.5" />
                                            </svg>
                                        </a>
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

                                    <div class="candidate_grid_ppl_top row">
                                        <div class="col-6 d-flex">
                                        <figure class="main_img">
                                            <?php if($candidate->companyStatus->first()): ?>
                                            <?php if($candidate->companyStatus->first()->pivot->status == 0): ?>
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
                                        </figure>
                                        <div class="candidate_grid_ppl_top_rt pt-3">
                                            <span class="grid-box-detail">
                                            <?php if($candidate->companyStatus->first()): ?>
                                            <?php if($candidate->companyStatus->first()->pivot->status == 0): ?>
                                            <h6 class="blured_txt">Name</h6>
                                            <?php else: ?>
                                            <h6><?php echo e($candidate->name); ?></h6>
                                            <?php endif; ?>
                                            <?php else: ?>
                                            <h6 class="blured_txt">Name</h6>
                                            <?php endif; ?>
                                            <p><?php echo e($candidate->personal ? $candidate->personal->current_title : ''); ?>

                                            </p>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6 align-self-center- pt-3 lign-height-point-e"> <span class="grid-exp">
                                    	<?php $exp = $yrs_of_exp;
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
                                    </span></div>
                                    </div>

                                    <div class="candidate_grid_ppl_top_btm">
                                        <ul>
                                            <li>
                                                <div class="candidate_grid_ppl_top_btm_wrap">
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
                                                    <!-- <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <p><?php echo e($yrs_of_exp); ?> Yrs Experience</p>
                                                    </div> -->
                                                </div>
                                            </li>

                                            <li>
                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                    <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <!-- <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>,&nbsp;<?php echo e($candidate->personal ? $candidate->personal->state_abbr : ''); ?></p> -->
                                                        <?php if(isset($candidate->industries)): ?>
                                                        <p><?php echo e($candidate->industries->first() ? $candidate->industries->first()->name : ''); ?>

                                                        </p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                    <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic3.svg')); ?>" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <h6>Asking Salary</h6>
                                                        <p><?php echo e($candidate->personal ? $candidate->personal->salary_range : ''); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                    <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic4.svg')); ?>" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <h6>Area of Interest</h6>
                                                        <?php if(isset($candidate->interests)): ?>
                                                        <p><?php echo e($candidate->interests->first() ? $candidate->interests->first()->name : ''); ?>

                                                        </p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0)" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" class="eyeBall" wire:click="viewProfile(<?php echo e($candidate->id); ?>)" data-id="<?php echo e($candidate->id); ?>"><img src="<?php echo e(asset('assets/be/images/eye_ic.svg')); ?>" alt="" /></a>
                                </div>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/html/app/resources/views/ajax/candidate_list_1.blade.php ENDPATH**/ ?>