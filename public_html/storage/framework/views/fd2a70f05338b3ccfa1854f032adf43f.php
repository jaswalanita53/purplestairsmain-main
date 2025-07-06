<div>
    <!-- select2 filters -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/be/search-page.css')); ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.js"></script>
    <div class="mid-contain">
        <div class="container-fluid">
            <div class="main-body">
                <div class="main-body-upper">
                    <div class="view_cancidate_all_set">
                        <div class="row view_cancidate_all_set_row gap candidate_row-">
                            <div class="col-xl-4 col-lg-6 view_cancidate_all_set_col_lft">
                                <h2 class="col-8">UNMASKED</h2>
                            </div>

                            <div class="col-xl-8 col-lg-6 view_cancidate_all_set_col_rtt">
                                <div class="view_cancidate_all_set_col_rtt_innr">
                                    <div class="dropdown sort-dropdown neww">
                                    <?php
                                        $sort_by_arr = array(
                                            '' => '',
                                            'alpha' => 'A to Z',
                                            'distance' => 'Distance',
                                            'newest' => 'Newest',
                                            'experience' => 'Experienced',
                                        );
                                    ?>
                                    <a href="javascript:;" id="change_order" class="p-2"><img src="<?php echo e(asset('assets/be/images/'.$sort_icon)); ?>" alt="" /></a>
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort By <span class="sort_by_val"><?php echo e($sort_by_arr[$sortBy]); ?></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        
                                        <li>
                                            <a class="dropdown-item sort-tab py-2 <?php echo e($sortBy=="distance" ? 'bg-purple text-white' : ''); ?>" href="#" data-type="distance"> Distance </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item sort-tab py-2 <?php echo e($sortBy=="newest" ? 'bg-purple text-white' : ''); ?>" href="#" data-type="newest"> Newest </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item sort-tab py-2 <?php echo e($sortBy=="experience" ? 'bg-purple text-white' : ''); ?>" href="#" data-type="experience">
                                                Experienced
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                    <div class="list_grid_wrapper" ppppppp<?php echo e($active_tab); ?>>
                                    <ul>
                                        <li class="<?php echo e(($active_tab==1) ? 'active' : ''); ?> grid">
                                            <button class="grid" data-target="content-1">
                                                <img src="<?php echo e(asset('assets/be/images/grid.svg')); ?>" alt="" />
                                            </button>
                                        </li>
                                        <li class="<?php echo e(($active_tab==2) ? 'active' : ''); ?> list">
                                            <button class="list" data-target="content-2">
                                                <img src="<?php echo e(asset('assets/be/images/list.svg')); ?>" alt="" />
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="listgrid_cnt <?php echo e(($active_tab==1) ? 'active' : ''); ?>" id="content-1">
                            <div class="row candiate_list_view_parent_row gy-4">
                                <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                

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
                                


                                <?php if($candidate->personal): ?>
                                <?php if($candidate->personal->hired_status): ?>
                                <div class="col-xl-4 col-md-6 candiate_list_view_parent_col candidate-card" data-id="<?php echo e($candidate->id); ?>">
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
                                    <?php if($candidate->companyStatus->first()->pivot->status == 0): ?>
                                    <span class="pending-label"><span class="hired">Requested</span><span class="hired-flag"><i class="iconc"><img src="<?php echo e(asset('assets/be/images/clock-white.svg')); ?>" alt=""></i></span></span>
                                    <?php else: ?>
                                    <span class="unmasked-flag">
                                        <span class="hired">Unmasked</span><span class="hired-flag"></span>
                                    </span>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="candidate_grid_ppl_wppt <?php echo e($hired_employee); ?>" data-url="<?php echo e(route('company.candidateprofile', ['user_id' => $candidate->id])); ?> " data-id="<?php echo e($candidate->id); ?>">
                                        <div class="candidate_grid_ppl hired_sec ">
                                            <div class="candidate_top_pnk_ic">
                                                <img src="<?php echo e(asset('assets/be/images/shape_left_pnk.png')); ?>" alt="" />
                                            </div>
                                            <div class="hired_sec_span">Hired</div>
                                            <div class="candidate_grid_ppl_icn">
                                                <ul>
                                                    <li>

                                                        <a href="#url" class="flag_ico_sec <?php echo e(in_array($candidate->id, $my_favorites) ? 'hover_fav' : ''); ?>" wire:click.lazy=<?php echo e(!in_array($candidate->id, $my_favorites) ? "saveFavorite(" . $candidate->id .",".$search->id.")" : "removeFavorite(" . $candidate->id . ",".$search->id.")"); ?>>
                                                            <svg class="not_new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z" fill="#FFAE1A"></path>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#url" class="clickd_tgl_searches"><svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="ellipsis-icon">
                                                                <circle cx="17.5" cy="12" r="1.5" />
                                                                <circle cx="12" cy="12" r="1.5" />
                                                                <circle cx="6.5" cy="12" r="1.5" />
                                                            </svg></a>
                                                        <div class="clickd_tgl_searches_open">
                                                            <div class="clickd_tgl_searches_open_head">
                                                                <h5>Manage Matched Searches</h5>
                                                            </div>
                                                            <div class="clickd_tgl_searches_open_ul">
                                                                <div class="form_input_check">
                                                                    <?php $__currentLoopData = $saved_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $searchSingle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php $is_checked = in_array($candidate->id, $searchSingle->candidate_ids) ? 1 : 0; ?>
                                                                    <label>
                                                                        <input type="checkbox" class="manual_add_saved_serach" data-search-id="<?php echo e($searchSingle->id); ?>" data-candidate="<?php echo e($candidate->id); ?>" wire:click="changeEvent('<?php echo e($is_checked); ?>', '<?php echo e($searchSingle->id); ?>','<?php echo e($candidate->id); ?>')" <?php echo e($is_checked ? 'checked' : ''); ?> />
                                                                        <span><?php echo e($searchSingle->name); ?></span>
                                                                    </label>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="candidate_grid_ppl_top">
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
                                                <div class="candidate_grid_ppl_top_rt">
                                                        <span class="d-flex">
                                                        <span class="grid-box-detail">
                                                        <?php if($candidate->companyStatus->first()): ?>
                                                        <?php if($candidate->companyStatus->first()->pivot->status == 0): ?>
                                                        <?php if(!empty($candidate->name)): ?>
                                                        <?php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); ?>
                                                        <h6 class="blured_txt"><?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)); ?></h6>
                                                        <?php else: ?>
                                                        <h6 class="blured_txt">Candidate Name</h6>
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                        <?php if(!empty($candidate->name )): ?><?php echo e(strlen($candidate->name ) > 20 ? substr($candidate->name , 0, 20) . '...' : $candidate->name); ?> <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                         <?php if(!empty($candidate->name)): ?>
                                                        <?php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); ?>
                                                        <h6 class="blured_txt"><?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)); ?></h6>
                                                        <?php else: ?>
                                                        <h6 class="blured_txt">Candidate Name</h6>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                        <p><?php if(!empty($candidate->personal->current_title)): ?><?php echo e(strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title); ?> <?php endif; ?>

                                                        </p>
                                                        </span>
                                                        <span class="grid-exp"> <?php
                                                            expGraphic($yrs_of_exp);
                                                            ?>
                                                        </span>
                                                        </span>
                                                    </div>
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

                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="candidate_grid_ppl_top_btm_wrap">
                                                            <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>" alt="" /></i>
                                                            <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                <?php if(isset($candidate->industries)): ?>
                                                                <p><?php echo e($candidate->industries->first() ? $candidate->industries->first()->name : ''); ?>

                                                                </p>
                                                                <?php endif; ?>
                                                                <!-- <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>,<?php echo e($candidate->personal ? $candidate->personal->state_abbr : ''); ?></p> -->
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="candidate_grid_ppl_top_btm_wrap">
                                                            <i class="icon_candt"><img src="<?php echo e('assets/be/images/ic3.svg'); ?>" alt="" /></i>
                                                            <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                <h6>Asking Salary</h6>
                                                                <p><?php echo e($candidate ? $candidate->personal->salary_range : ''); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="candidate_grid_ppl_top_btm_wrap">
                                                            <i class="icon_candt"><img src="<?php echo e('assets/be/images/ic4.svg'); ?>" alt="" /></i>
                                                            <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                <h6>Area of Interest</h6>
                                                                <?php if(isset($candidate->interests)): ?>
                                                                <?php if($candidate->interests->first()): ?>
                                                                <p><?php echo e($candidate->interests->first()->name); ?></p>
                                                                <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php echo $__env->make('inc.candidateProfile', ['userId' => $candidate->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-xl-4 col-md-6 candiate_list_view_parent_col candidate-card" data-id="<?php echo e($candidate->id); ?>">
                            <?php $hired_employee=""; ?>
                            <?php if(!empty($candidate->delete_status)): ?>
                            <!-- <?php if($candidate->delete_status->type=='sleep'): ?>
                            <span class="hired">Hired</span><span class="hired-flag"></span>
                            <?php $hired_employee="blured_box";?> -->
                            <!-- <?php endif; ?> -->
                            <span class="hired">Hired</span><span class="hired-flag"></span>
                            <?php $hired_employee="blured_box";?>
                            <?php elseif(time() - strtotime($candidate->created_at) < 60*60*24): ?>
                                <span class="hired bg-danger">New!</span><span class="hired-flag bg-danger"></span>
                                    <?php $hired_employee="flaged";?>
                            <?php else: ?>
                            <?php if($candidate->companyStatus->first()): ?>
                            <?php if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2): ?>
                            <span class="pending-label"><span class="hired">Requested</span><span class="hired-flag"><i class="iconc"><img src="<?php echo e(asset('assets/be/images/clock-white.svg')); ?>" alt=""></i></span></span>
                                <?php $hired_employee="requested";?>
                            <?php else: ?>
                            <span class="unmasked-flag">
                                <span class="hired">Unmasked</span><span class="hired-flag"></span>
                                <?php $hired_employee="flaged";?>
                            </span>

                            <?php endif; ?>
                            <?php else: ?>
                            <?php endif; ?>
                            <?php endif; ?>



                            <div class="candidate_grid_ppl_wppt <?php echo e($hired_employee); ?>" data-url="<?php echo e(route('company.candidateprofile', ['user_id' => $candidate->id])); ?> " data-id="<?php echo e($candidate->id); ?>">
                                <div class="candidate_grid_ppl">
                                    <div class="candidate_top_pnk_ic">
                                        <img src="<?php echo e(asset('assets/be/images/shape_left_pnk.png')); ?>" alt="" />
                                    </div>

                                    
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
                                    

                                    <div class="candidate_grid_ppl_top row">
                                        <div class="col-8 d-flex">
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
                                            <?php if(!empty($candidate->name)): ?>
                                            <?php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); ?>
                                            <h6 class="blured_txt"><?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)); ?></h6>
                                            <?php else: ?>
                                            <h6 class="blured_txt">Candidate Name</h6>
                                            <?php endif; ?>
                                            <?php else: ?>
                                            <?php if(!empty($candidate->name )): ?><?php echo e(strlen($candidate->name ) > 20 ? substr($candidate->name , 0, 20) . '...' : $candidate->name); ?> <?php endif; ?>
                                            <?php endif; ?>
                                            <?php else: ?>
                                            <?php if(!empty($candidate->name)): ?>
                                            <?php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); ?>
                                            <h6 class="blured_txt"><?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)); ?></h6>
                                            <?php else: ?>
                                            <h6 class="blured_txt">Candidate Name</h6>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <p><?php if(!empty($candidate->personal->current_title)): ?><?php echo e(strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title); ?> <?php endif; ?>

                                            </p>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-4 align-self-center- pt-3 lign-height-point-e"> <span class="grid-exp grid-exp-<?php echo e($hired_employee); ?>"> <?php
                                        expGraphic($yrs_of_exp);
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
                                    
                                </div>

                            </div>
                            <?php echo $__env->make('inc.candidateProfile', ['userId' => $candidate->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <?php if(count($candidates) <= 0): ?>
                                <p class="text-center text-muted m-2">No More Candidate Matches Found</p>
                                <?php endif; ?>
                            </div>

                            <div class="listgrid_cnt  <?php echo e(($active_tab==2) ? 'active' : ''); ?> candidate_box_parent" id="content-2">
                                <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                
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
                                
                                <?php if(!in_array($candidate->id, $new_candidates_ids)): ?>
                                <?php $hired_employee=""; ?>
                                <?php if(!empty($candidate->delete_status)): ?>
                                <?php if($candidate->delete_status->type=='sleep'): ?>
                                <?php $hired_employee="blured_box";?>
                                <?php endif; ?>
                                <?php endif; ?>
                                <div class="listview_candidate_details_w detail_<?php echo e($hired_employee); ?> candidate-card" data-id="<?php echo e($candidate->id); ?>">
                                <!-- <div class="listview_candidate_details_w "> -->
                                    <?php $hired_employee=""; ?>
                                    <?php if(!empty($candidate->delete_status)): ?>
                                    <?php if($candidate->delete_status->type=='sleep'): ?>
                                    <span class="hired">Hired</span><span class="hired-flag"></span>
                                    <?php $hired_employee="blured_box";?>
                                    <?php endif; ?>
                                    <?php endif; ?>



                                    <div class="listview_candidate_details  <?php echo e($hired_employee); ?>" data-url="<?php echo e(route('company.candidateprofile', ['user_id' => $candidate->id])); ?> " data-id="<?php echo e($candidate->id); ?>">

                                        <div class="layout_back" style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;"  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                        </div>
                                        <div  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                            <div class="listview_candidate_details_img">
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
                                            </div>
                                        </div>
                                        <div  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                            <div class="listview_candidate_details_head">
                                                <?php if($candidate->companyStatus->first()): ?>
                                                <?php if($candidate->companyStatus->first()->pivot->status == 0): ?>
                                                <?php if(!empty($candidate->name)): ?>
                                                <?php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); ?>
                                                <h6 class="blured_txt"><?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)); ?></h6>
                                                <?php else: ?>
                                                <h6 class="blured_txt">Candidate Name</h6>
                                                <?php endif; ?>
                                                <?php else: ?>
                                                <?php if(!empty($candidate->name )): ?><?php echo e(strlen($candidate->name ) > 20 ? substr($candidate->name , 0, 20) . '...' : $candidate->name); ?> <?php endif; ?>
                                                <?php endif; ?>
                                                <?php else: ?>
                                                <?php if(!empty($candidate->name)): ?>
                                                <?php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); ?>
                                                <h6 class="blured_txt"><?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)); ?></h6>
                                                <?php else: ?>
                                                <h6 class="blured_txt">Candidate Name</h6>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                <p><?php if(!empty($candidate->personal->current_title)): ?><?php echo e(strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title); ?> <?php endif; ?>
</p>
                                            </div>
                                        </div>

                                        <div  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                            <div class="ecperice_list">
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
                                                    if((!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)) || !empty($candidate->personal->work_environment_hybrid)){
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
                                                        <?php if(isset($candidate->industries)): ?>
                                                        <p><?php echo e($candidate->industries->first() ? $candidate->industries->first()->name : ''); ?>

                                                        </p>
                                                        <?php endif; ?>
                                                        <!-- <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>,<?php echo e($candidate->personal ? $candidate->personal->state_abbr : ''); ?></p> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="gr_fl"  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                            <div class="ask_salary_sec">
                                                <i class="ic_icon">$</i>
                                                <div class="ask_salary_sec_rtt">
                                                    <h6>Asking Salary</h6>
                                                    <p><?php echo e($candidate->personal ? $candidate->personal->salary_range : ''); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gr_fl save-list-div" style="width: 200px;">

                                            <?php if(count($saved_searches)>0): ?>
                                            <div class="candidate_grid_ppl_icn large save-list-bubble" data-bs-toggle="tooltip" data-bs-placement="top" title="">
                                                <?php if($candidate->saved_list): ?>
                                                <?php echo $candidate->saved_list; ?>

                                                <?php else: ?>
                                                N/A Saved Search
                                                <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="gr_fl">
                                            <?php if($candidate->companyStatus->first()): ?>
                                            <?php if($candidate->companyStatus->first()->pivot->status == 0): ?>
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
                                            <a href="javascript:void(0)" class="req_mask_btn">
                                                <i class="ic_req_m"><img src="<?php echo e(asset('assets/be/images/masked.svg')); ?>" alt="" /></i>
                                                <div class="req_mask_btn_rtt">Request Unmask</div>
                                            </a>
                                            <div class="modal fade inline-table-modal" id="send-request-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    <div class="position-submit-btn-otr" wire:loading wire:targe    t="sendRequest">
                                                                        <input type="submit" value="Sending..." disabled class="position_submit_btn" />
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-dismiss="modal" class="eye-ball2 eyeBall"  data-id="<?php echo e($candidate->id); ?>">
                                        <?php
                                         expGraphic($yrs_of_exp);
                                        ?>

                                        </a>
                                    </div>
                                    <?php echo $__env->make('inc.candidateProfile', ['userId' => $candidate->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <?php else: ?>

                                <div class="listview_candidate_details_w candidate-card" data-id="<?php echo e($candidate->id); ?>">
                                    <div class="listview_candidate_details" data-url="<?php echo e(route('company.candidateprofile', ['user_id' => $candidate->id])); ?> " data-id="<?php echo e($candidate->id); ?>">
                                        <div class="layout_back" style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;"  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                        </div>
                                        <div  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                            <div class="listview_candidate_details_img">
                                                <?php if($candidate->profile_photo_path): ?>
                                                <img src="<?php echo e(asset($candidate->profile_photo_path)); ?>" alt="" />
                                                <?php else: ?>
                                                <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                            <div class="listview_candidate_details_head">
                                                <?php if(!empty($candidate->name )): ?><?php echo e(strlen($candidate->name ) > 20 ? substr($candidate->name , 0, 20) . '...' : $candidate->name); ?> <?php endif; ?>
                                                <p><?php if(!empty($candidate->personal->current_title)): ?><?php echo e(strlen($candidate->personal->current_title) > 20 ? substr($candidate->personal->current_title, 0, 20) . '...' : $candidate->personal->current_title); ?> <?php endif; ?>
</p>
                                            </div>
                                        </div>

                                        <div  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                            <div class="ecperice_list">
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
                                                    if((!empty($candidate->personal->work_environment_remote) && !empty($candidate->personal->work_environment_in_office)) || !empty($candidate->personal->work_environment_hybrid)){
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
                                                        <?php if(isset($candidate->industries)): ?>
                                                        <p><?php echo e($candidate->industries->first() ? $candidate->industries->first()->name : ''); ?>

                                                        </p>
                                                        <?php endif; ?>
                                                        <!-- <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>,<?php echo e($candidate->personal ? $candidate->personal->state_abbr : ''); ?></p> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="gr_fl"  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                            <div class="ask_salary_sec">
                                                <i class="ic_icon">$</i>
                                                <div class="ask_salary_sec_rtt">
                                                    <h6>Asking Salary</h6>
                                                    <p><?php echo e($candidate->personal ? $candidate->personal->salary_range : ''); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gr_fl">
                                            <div class="candidate_grid_ppl_icn large">
                                                <a href="#url" class="ic_award_icn <?php echo e(in_array($candidate->id, $my_favorites) ? 'hover_fav' : ''); ?>" wire:click.lazy=<?php echo e(!in_array($candidate->id, $my_favorites) ? "saveFavorite(" . $candidate->id .")" : "removeFavorite(" . $candidate->id . ")"); ?>>
                                                    <svg class="not_new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z" fill="#FFAE1A" />
                                                    </svg>

                                                    <svg class="new" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4016 1.09835C17.6984 0.395088 16.7446 0 15.75 0Z" fill="#FFAE1A" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="gr_fl">
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

                                        <div class="gr_fl"  data-bs-toggle="modal" data-bs-dismiss="modal" >
                                            <?php if($candidate->companyStatus->first()): ?>
                                            <?php if($candidate->companyStatus->first()->pivot->status == 0): ?>
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
                                            <a href="#url" class="req_mask_btn" wire:click.prevent="sendRequest(<?php echo e($candidate->id); ?>)">
                                                <i class="ic_req_m"><img src="<?php echo e(asset('assets/be/images/masked.svg')); ?>" alt="" /></i>
                                                <div class="req_mask_btn_rtt">Request Unmask</div>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                        <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-dismiss="modal" class="eye-ball2 eyeBall"  data-id="<?php echo e($candidate->id); ?>">
                                         <?php
                                         expGraphic($yrs_of_exp);
                                        ?>

                                        </a>
                                    </div>
                                    <?php echo $__env->make('inc.candidateProfile', ['userId' => $candidate->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if(count($candidates) <= 0): ?>
                                <p class="text-center text-muted m-2">No More Candidate Matches Found</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="main-body-footer">
                    <div class="footer-para new">
                        <p>
                            <span class="copyrite-text">© 2023 Purple Stairs</span>Website by
                            <a href="https://www.brand-right.com/" target="_blank" class="brand">
                                BrandRight Marketing Group</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span class="filter-out">
        <!-- <script src="<?php echo e(asset('assets/be/js/filters.js')); ?>"></script> -->
    </span>

    <?php
    function expGraphic($exp){

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
    }
    ?>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
    /*$(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    })*/

    var activeTab = "_";
    $("body").delegate(".list_grid_wrapper li", "click", function(e) {
        /*var _target = $(this).find('button').attr('data-target');
        var _EL = _target.split("-");*/

        var type = $(this).attr('data-type');
        activeTab = $(this).attr('class');
        activeTab = activeTab.split(" ");
        activeTab = activeTab[0];
        if(activeTab=='grid'){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('active_tab', 1);
        }else{
            window.livewire.find('<?php echo e($_instance->id); ?>').set('active_tab', 2);
        }
    });

    $('#edit-search').on('shown.bs.modal', function(e) {
        afterLoad($(this));
    })

    document.addEventListener("livewire:load", () => {
        $("body").delegate(".flag_ico_sec,.manual_add_saved_serach", "click", function(e) {
            Livewire.hook('message.processed', (message, component) => {
                afterLoad($(this));

            })
        })
    })

    function afterLoad() {
        var html = " <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js'><\/script><script src='<?php echo e(asset('assets/be/js/filters.js')); ?>'><\/script>";
        $('.' + activeTab).trigger('click');
        let flag = window.livewire.find('<?php echo e($_instance->id); ?>').get('is_filtered');
        setTimeout(function() {
            $('.js-select2').each(function() {
                $(this).val($(this).val()).trigger('change');
            })
            $('.max-range').val($('.max-range').val()).trigger('input');
            $('.min-range').val($('.min-range').val()).trigger('input');

            $('.max-range-distance').val($('.max-range-distance').val()).trigger('input');
            $('.min-range-distance').val($('.min-range-distance').val()).trigger('input');
            $('.' + activeTab).trigger('click');
            $('body').removeAttr('style');
                $('#overlay').hide();
        }, 80);

        setTimeout(function() {
            $('body').removeAttr('style');
            $('#overlay').hide();
        }, 100);
    }

    window.addEventListener('close-notes', event => {
        $('#notesModal').modal('hide');
        // $('#exampleModalToggle2').modal('show');
    });

    function profile_modal(id) {
        Livewire.emit('viewProfile', id);
    }

    window.addEventListener('open-profile-modal', event => {
        // $('#exampleModalToggle2').modal('show');
    })

    // document.addEventListener("livewire:load", () => {
    //     $("body").delegate(".candidate_grid_ppl_wppt,.listview_candidate_details,req_mask_btn", "click", function (e) {
    //         var url = $(this).attr("data-url");
    //         var lastSegment = url.split('/').pop();
    //         $('.right-arrow').attr('data-id',lastSegment)
    //         $('.right-arrow').attr('data-id',lastSegment)
    //         if (!$(e.target).is('.clickd_tgl_searches svg, .clickd_tgl_searches circle,.eyeBall,.eyeBall img,.clickd_tgl_searches_open,.clickd_tgl_searches_open label,.clickd_tgl_searches_open h5,.clickd_tgl_searches_open input,.clickd_tgl_searches_open span,.candidate_grid_ppl_icn a,.candidate_grid_ppl_icn svg,.candidate_grid_ppl_icn path,.req_mask_btn,.req_mask_btn i,.req_mask_btn img,.req_mask_btn .req_mask_btn_rtt,.modal.show div,.modal.show button,.modal.show form,.modal.show input,.modal.show label,.modal.show textarea')) {
    //             $('.cpi').attr('src',url);
    //             // $('#exampleModalToggle2').modal('show')
    //         }
    //     });
    // })

    document.addEventListener("livewire:load", () => {
        $(document).on('click', '#change_order', function(event) {
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
            $('#overlay').show();
            // window.livewire.find('<?php echo e($_instance->id); ?>').set('count', 6);
            if(!window.livewire.find('<?php echo e($_instance->id); ?>').get('is_filtered')) window.livewire.find('<?php echo e($_instance->id); ?>').set('is_filtered', true);
            var current_order = window.livewire.find('<?php echo e($_instance->id); ?>').get('sort_order');

            if(current_order == "ASC") {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('sort_order', 'DESC');
                window.livewire.find('<?php echo e($_instance->id); ?>').set('sort_icon', 'down-icon.svg');
            } else {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('sort_order', 'ASC');
                window.livewire.find('<?php echo e($_instance->id); ?>').set('sort_icon', 'up-icon.svg');
            }

            Livewire.hook('message.processed', (message, component) => {
                console.log('change_order');
                // afterLoad($(this));
                $('body').removeAttr('style');
                $('#overlay').hide();
            })
        });

        $("body").delegate(".sort-tab", "click", function(e) {
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
            $('#overlay').show();
            console.log('activeTabactiveTab',activeTab)
            var type = $(this).attr('data-type');
            window.livewire.find('<?php echo e($_instance->id); ?>').set('sortBy', type);
            // window.livewire.find('<?php echo e($_instance->id); ?>').set('count', 6);
            if(!window.livewire.find('<?php echo e($_instance->id); ?>').get('is_filtered')) window.livewire.find('<?php echo e($_instance->id); ?>').set('is_filtered', true);
            if(type == "newest") {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('sort_order', 'DESC');
                window.livewire.find('<?php echo e($_instance->id); ?>').set('sort_icon', 'down-icon.svg');
            }

            Livewire.hook('message.processed', (message, component) => {
                console.log('sort');
                $('body').removeAttr('style');
                $('#overlay').hide();
                // afterLoad($(this));
            })
        })
    })

    window.addEventListener('close-request-modal', event => {
        $(".modal").modal("hide");
    });

    window.addEventListener('closeSecondaryModal', event => {
        $("#notesModal").modal("hide");
    });

    window.addEventListener('enableBody', event => {
        $('body').removeAttr('style');
        $('#overlay').hide();
    });

    window.addEventListener('blockBody', event => {
        $('#overlay').show();
        $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
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
<?php /**PATH /var/www/html/app/resources/views/livewire/unmasked-list.blade.php ENDPATH**/ ?>