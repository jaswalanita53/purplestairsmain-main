<div>
    <div class="mid-contain">
        <div class="container-fluid">
            <div class="main-body">
                <div class="main-body-upper">
                    <div class="nav_breadcrumb_top">
                        <nav style="--bs-breadcrumb-divider: '<'" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(route('company.savedsearches')); ?>">My Searches</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?php echo e($search->name); ?>

                                </li>
                            </ol>
                        </nav>
                    </div>

                    <div class="seacrh_details_describe">
                        <div class="row seacrh_details_describe_row">
                            <div class="col-lg-8 seacrh_details_describe_col_lft">
                                <h3><?php echo e($search->name); ?></h3>
                                <span class="saved-search-count py-1 px-3"><?php echo e($search->match_count); ?></span>
                                <?php if($search->new_match_count > 0): ?>
                                <span class="notificate_total new_link" wire:click="filterNew()"><?php echo e($search->new_match_count); ?> NEW</span>
                                <?php endif; ?>
                            </div>

                            <div class="col-lg-4 seacrh_details_describe_col_rtt">
                                <a href="javascript:void(0)" class="edit_search" data-bs-toggle="modal"
                                    data-bs-target="#searches_modal">edit Search
                                    <i><img src="<?php echo e(asset('assets/be/images/edit_sc.svg')); ?>" alt="" /></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="view_cancidate_all_set">
                        <div class="row view_cancidate_all_set_row gap candidate_row">
                            <div class="col-xl-7 col-lg-7 view_cancidate_all_set_col_lft">
                                <div class="suggestion_search_wrapper">
                                    <ul>
                                        <li>
                                            <a href="#url" class="<?php echo e($category == 'suggested' ? 'active' : ''); ?>" wire:click="filterByCategory('')">
                                                
                                                All
                                            </a>
                                        </li>
                                        
                                        <li><a href="#url" wire:click="filterByCategory('requested')"  class="<?php echo e($category == 'requested' ? 'active' : ''); ?>"><!--Requested--> Masked
                                                (<?php echo e($requested_count); ?>)</a></li>
                                        <li><a href="#url" wire:click="filterByCategory('unmasked')"  class="<?php echo e($category == 'unmasked' ? 'active' : ''); ?>">Unmasked
                                                (<?php echo e($unmasked_count); ?>)</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-xl-5 col-lg-5 view_cancidate_all_set_col_rtt">
                                <div class="view_cancidate_all_set_col_rtt_innr">
                                    <div class="suggestion_search_wrapper">
                                        <ul>
                                            <li>
                                                <a href="#url" class="<?php echo e($category == 'favorites' ? 'active' : ''); ?>" wire:click="filterByCategory('favorites')">
                                                    <span class="ic_award_icn">
                                                        <svg class="not_new" width="20" height="21"
                                                                            viewBox="0 0 20 21" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z"
                                                                fill="#FFAE1A"></path>
                                                        </svg>
                                                    </span> &nbsp;
                                                    My Favorites
                                                    (<?php echo e($favorites_count); ?>)</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="dropdown sort-dropdown neww">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton3"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Sort By
                                        </button>

                                        <ul class="dropdown-menu" aria-
                                        labelledby="dropdownMenuButton3">
                                            <li>
                                                <a class="dropdown-item" href="#"> A to Z </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#"> Distance </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#"> Newest </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    Experienced
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="list_grid_wrapper">
                                        <ul>
                                            <li class="grid">
                                                <button class="grid" data-target="content1">
                                                    <img src="<?php echo e(asset('assets/be/images/grid.svg')); ?>"
                                                        alt="" />
                                                </button>
                                            </li>
                                            <li class="active list">
                                                <button class="list" data-target="content2">
                                                    <img src="<?php echo e(asset('assets/be/images/list.svg')); ?>"
                                                        alt="" />
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="listgrid_cnt" id="content1">
                            <div class="row candiate_list_view_parent_row gy-4">
                                <?php $__currentLoopData = $final_candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($candidate->personal): ?>
                                        <?php if($candidate->personal->hired_status): ?>
                                            <div class="col-xl-4 col-md-6 candiate_list_view_parent_col">
                                                <div class="candidate_grid_ppl hired_sec">
                                                    <div class="candidate_top_pnk_ic">
                                                        <img src="<?php echo e(asset('assets/be/images/shape_left_pnk.png')); ?>"
                                                            alt="" />
                                                    </div>
                                                    <div class="hired_sec_span">Hired</div>
                                                    <div class="candidate_grid_ppl_icn">
                                                        <ul>
                                                            <li>
                                                                <a href="#url" class="flag_ico_sec <?php echo e(in_array($candidate->id, $my_favorites) ? 'hover_fav' : ''); ?>"
                                                                    wire:click="saveFavorite(<?php echo e($candidate->id); ?>)">
                                                                    <svg class="not_new" width="20" height="21"
                                                                        viewBox="0 0 20 21" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z"
                                                                            fill="#FFAE1A"></path>
                                                                    </svg>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#url" class="clickd_tgl_searches">+</a>
                                                                <div class="clickd_tgl_searches_open">
                                                                    <div class="clickd_tgl_searches_open_head">
                                                                        <h5>Saved Searches</h5>
                                                                    </div>
                                                                    <div class="clickd_tgl_searches_open_ul">
                                                                        <div class="form_input_check">
                                                                            <?php $__currentLoopData = $saved_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php $is_checked = in_array($candidate->id, $search->candidate_ids) ? 1 : 0; ?>
                                                                                <label>
                                                                                    <input type="checkbox" 
                                                                                        class="manual_add_saved_serach" 
                                                                                        data-search-id="<?php echo e($search->id); ?>" 
                                                                                        data-candidate="<?php echo e($candidate->id); ?>" 
                                                                                        wire:click="changeEvent('<?php echo e($is_checked); ?>', '<?php echo e($search->id); ?>','<?php echo e($candidate->id); ?>')" 
                                                                                        <?php echo e($is_checked ? 'checked' : ''); ?> 
                                                                                    />
                                                                                    <span><?php echo e($search->name); ?></span>
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
                                                            <?php if($candidate->profile_photo_path): ?>
                                                                <img src="<?php echo e(asset($candidate->profile_photo_path)); ?>"
                                                                    alt="" />
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>"
                                                                    alt="" />
                                                            <?php endif; ?>
                                                        </figure>
                                                        <div class="candidate_grid_ppl_top_rt">
                                                            <h6><?php echo e($candidate->name); ?></h6>
                                                            <p><?php echo e($candidate ? $candidate->personal->current_title : ''); ?>

                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="candidate_grid_ppl_top_btm">
                                                        <ul>
                                                            <li>
                                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                                    <i class="icon_candt"><img
                                                                            src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>"
                                                                            alt="" /></i>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                        <p>5 Yrs Experience</p>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                                    <i class="icon_candt"><img
                                                                            src="<?php echo e(asset('assets/be/images/ic2.svg')); ?>"
                                                                            alt="" /></i>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                        <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>,<?php echo e($candidate->personal ? $candidate->personal->state_abbr : ''); ?></p>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                                    <i class="icon_candt"><img
                                                                            src="<?php echo e('assets/be/images/ic3.svg'); ?>"
                                                                            alt="" /></i>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                        <h6>Asking Salary</h6>
                                                                        <p><?php echo e($candidate ? $candidate->personal->salary_range : ''); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                                    <i class="icon_candt"><img
                                                                            src="<?php echo e('assets/be/images/ic4.svg'); ?>"
                                                                            alt="" /></i>
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
                                            </div>
                                        <?php else: ?>
                                            <div class="col-xl-4 col-md-6 candiate_list_view_parent_col">
                                                <div class="candidate_grid_ppl_wppt">
                                                    <div class="candidate_grid_ppl">
                                                        <div class="candidate_top_pnk_ic">
                                                            <img src="<?php echo e(asset('assets/be/images/shape_left_pnk.png')); ?>"
                                                                alt="" />
                                                        </div>
                                                        <div class="candidate_grid_ppl_icn">
                                                            <ul>
                                                                <li>
                                                                    <a href="#url" class="flag_ico_sec <?php echo e(in_array($candidate->id, $my_favorites) ? 'hover_fav' : ''); ?>"
                                                                        wire:click="saveFavorite(<?php echo e($candidate->id); ?>)">
                                                                        <svg class="not_new" width="20"
                                                                            height="21" viewBox="0 0 20 21"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z"
                                                                                fill="#FFAE1A"></path>
                                                                        </svg>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#url" class="clickd_tgl_searches">+</a>
                                                                    <div class="clickd_tgl_searches_open">
                                                                        <div class="clickd_tgl_searches_open_head">
                                                                            <h5>Saved Searches</h5>
                                                                        </div>
                                                                        <div class="clickd_tgl_searches_open_ul">
                                                                            <div class="form_input_check">
                                                                                <?php $__currentLoopData = $saved_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php $is_checked = in_array($candidate->id, $search->candidate_ids) ? 1 : 0; ?>
                                                                                    <label>
                                                                                        <input type="checkbox" 
                                                                                            class="manual_add_saved_serach" 
                                                                                            data-search-id="<?php echo e($search->id); ?>" 
                                                                                            data-candidate="<?php echo e($candidate->id); ?>" 
                                                                                            wire:click="changeEvent('<?php echo e($is_checked); ?>', '<?php echo e($search->id); ?>','<?php echo e($candidate->id); ?>')" 
                                                                                            <?php echo e($is_checked ? 'checked' : ''); ?> 
                                                                                        />
                                                                                        <span><?php echo e($search->name); ?></span>
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
                                                                <?php if($candidate->profile_photo_path): ?>
                                                                    <img src="<?php echo e(asset($candidate->profile_photo_path)); ?>"
                                                                        alt="" />
                                                                <?php else: ?>
                                                                    <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>"
                                                                        alt="" />
                                                                <?php endif; ?>
                                                            </figure>
                                                            <div class="candidate_grid_ppl_top_rt">
                                                                <h6><?php echo e($candidate->name); ?></h6>
                                                                <p><?php echo e($candidate ? $candidate->personal->current_title : ''); ?>

                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="candidate_grid_ppl_top_btm">
                                                            <ul>
                                                                <li>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                                        <i class="icon_candt"><img
                                                                                src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>"
                                                                                alt="" /></i>
                                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                            <p>5 Yrs Experience</p>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                                        <i class="icon_candt"><img
                                                                                src="<?php echo e(asset('assets/be/images/ic2.svg')); ?>"
                                                                                alt="" /></i>
                                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                            <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>,<?php echo e($candidate->personal ? $candidate->personal->state_abbr : ''); ?></p>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                                        <i class="icon_candt"><img
                                                                                src="<?php echo e(asset('assets/be/images/ic3.svg')); ?>"
                                                                                alt="" /></i>
                                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                                            <h6>Asking Salary</h6>
                                                                            <p><?php echo e($candidate ? $candidate->personal->salary_range : ''); ?>

                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                                        <i class="icon_candt"><img
                                                                                src="<?php echo e(asset('assets/be/images/ic4.svg')); ?>"
                                                                                alt="" /></i>
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
                                                        <a href="javascript:void(0)" data-bs-target="#exampleModalToggle2"
                                                            data-bs-toggle="modal" data-bs-dismiss="modal"
                                                            class="eyeBall" wire:click="viewProfile(<?php echo e($candidate->id); ?>)"><img
                                                                src="<?php echo e(asset('assets/be/images/eye_ic.svg')); ?>"
                                                                alt="" /></a>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="listgrid_cnt active" id="content2">
                            <?php $__currentLoopData = $final_candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(in_array($candidate->id, $past_search_match_users)): ?>
                                    <div class="listview_candidate_details_w" onclick="profile_modal(<?php echo e($candidate->id); ?>)">
                                        <div class="listview_candidate_details">
                                            <div class="layout_back"
                                                style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;">
                                            </div>
                                            <div>
                                                <div class="listview_candidate_details_img">
                                                    <?php if($candidate->profile_photo_path): ?>
                                                        <img src="<?php echo e(asset($candidate->profile_photo_path)); ?>"
                                                            alt="" />
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>"
                                                            alt="" />
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="listview_candidate_details_head">
                                                    <h6><?php echo e($candidate->name); ?></h6>
                                                    <?php if($candidate->personal): ?>
                                                        <p><?php echo e($candidate ? $candidate->personal->current_title : ''); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="ecperice_list">
                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img
                                                                src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>"
                                                                alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <p>5 Yrs Experience</p>
                                                        </div>
                                                    </div>

                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img
                                                                src="<?php echo e(asset('assets/be/images/ic2.svg')); ?>"
                                                                alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>,<?php echo e($candidate->personal ? $candidate->personal->state_abbr : ''); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="gr_fl">
                                                <div class="ask_salary_sec">
                                                    <i class="ic_icon">$</i>
                                                    <div class="ask_salary_sec_rtt">
                                                        <h6>Asking Salary</h6>
                                                        <?php if($candidate->personal): ?>
                                                            <p><?php echo e($candidate ? $candidate->personal->salary_range : ''); ?>

                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="gr_fl2">
                                                <div class="candidate_grid_ppl_icn large">
                                                    <a href="#url" class="ic_award_icn <?php echo e(in_array($candidate->id, $my_favorites) ? 'hover_fav' : ''); ?>" wire:click.stop=<?php echo e(!in_array($candidate->id, $my_favorites) ? "saveFavorite(" . $candidate->id .")" : "removeFavorite(" . $candidate->id . ")"); ?>>
                                                        <svg class="not_new" width="20" height="21"
                                                            viewBox="0 0 20 21" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z"
                                                                fill="#FFAE1A" />
                                                        </svg>

                                                        <svg class="new" width="20" height="21"
                                                            viewBox="0 0 20 21" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4016 1.09835C17.6984 0.395088 16.7446 0 15.75 0Z"
                                                                fill="#FFAE1A" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="gr_fl3">
                                                <a href="#url" class="req_mask_btn">
                                                    <i class="ic_req_m"><img
                                                            src="<?php echo e(asset('assets/be/images/masked.svg')); ?>"
                                                            alt="" /></i>
                                                    <div class="req_mask_btn_rtt">Request Unmask</div>
                                                </a>
                                            </div>
                                            <a href="javascript:void(0)" data-bs-target="#exampleModalToggle2"
                                                data-bs-toggle="modal" data-bs-dismiss="modal" class="eye-ball2" wire:click="viewProfile(<?php echo e($candidate->id); ?>)">
                                                <img src="<?php echo e(asset('assets/be/images/eye_ic.svg')); ?>"
                                                    alt="" />
                                            </a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="listview_candidate_details_w new_hire_part" onclick="profile_modal(<?php echo e($candidate->id); ?>)">
                                        <div class="listview_candidate_details">
                                            <div class="layout_back"
                                                style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;">
                                            </div>
                                            <div>
                                                <div class="new_hire_sec">
                                                    <div class="listview_candidate_details_img">
                                                        <?php if($candidate->profile_photo_path): ?>
                                                            <img src="<?php echo e(asset($candidate->profile_photo_path)); ?>"
                                                                alt="" />
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>"
                                                                alt="" />
                                                        <?php endif; ?>
                                                    </div>
                                                    <span class="new_cnt">NEW</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="listview_candidate_details_head">
                                                    <h6><?php echo e($candidate->name); ?></h6>
                                                    <p><?php echo e($candidate ? $candidate->personal->current_title : ''); ?></p>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="ecperice_list">
                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img
                                                                src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>"
                                                                alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <p>5 Yrs Experience</p>
                                                        </div>
                                                    </div>

                                                    <div class="candidate_grid_ppl_top_btm_wrap">
                                                        <i class="icon_candt"><img
                                                                src="<?php echo e(asset('assets/be/images/ic2.svg')); ?>"
                                                                alt="" /></i>
                                                        <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                            <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>,&nbsp;<?php echo e($candidate->personal ? $candidate->personal->state_abbr : ''); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="gr_fl">
                                                <div class="ask_salary_sec">
                                                    <i class="ic_icon">$</i>
                                                    <div class="ask_salary_sec_rtt">
                                                        <h6>Asking Salary</h6>
                                                        <p><?php echo e($candidate ? $candidate->personal->salary_range : ''); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="gr_fl2">
                                                <div class="candidate_grid_ppl_icn large">
                                                    <a href="#url" class="ic_award_icn <?php echo e(in_array($candidate->id, $my_favorites) ? 'hover_fav' : ''); ?>" wire:click.stop=<?php echo e(!in_array($candidate->id, $my_favorites) ? "saveFavorite(" . $candidate->id .")" : "removeFavorite(" . $candidate->id . ")"); ?>>
                                                        <svg class="not_new" width="20" height="21"
                                                            viewBox="0 0 20 21" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4017 1.09835C17.6984 0.395088 16.7446 0 15.75 0V0ZM12 3.75V18.75L7.2 15.15C7.07018 15.0526 6.91228 15 6.75 15C6.58772 15 6.42982 15.0526 6.3 15.15L1.5 18.75V3.75C1.5 3.15326 1.73705 2.58097 2.15901 2.15901C2.58097 1.73705 3.15326 1.5 3.75 1.5H12.75C12.2641 2.14962 12.0011 2.93879 12 3.75V3.75Z"
                                                                fill="#FFAE1A" />
                                                        </svg>

                                                        <svg class="new" width="20" height="21"
                                                            viewBox="0 0 20 21" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.75 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V20.25C0 20.3893 0.038786 20.5258 0.112012 20.6443C0.185238 20.7628 0.29001 20.8585 0.41459 20.9208C0.539169 20.9831 0.678633 21.0095 0.817354 20.997C0.956075 20.9845 1.08857 20.9336 1.2 20.85L6.75 16.695L12.3 20.85C12.4114 20.9336 12.5439 20.9845 12.6826 20.997C12.8214 21.0095 12.9608 20.9831 13.0854 20.9208C13.21 20.8585 13.3148 20.7628 13.388 20.6443C13.4612 20.5258 13.5 20.3893 13.5 20.25V3.75C13.5 3.15326 13.7371 2.58097 14.159 2.15901C14.581 1.73705 15.1533 1.5 15.75 1.5C16.3467 1.5 16.919 1.73705 17.341 2.15901C17.7629 2.58097 18 3.15326 18 3.75V9H15.75C15.5511 9 15.3603 9.07902 15.2197 9.21967C15.079 9.36032 15 9.55109 15 9.75C15 9.94891 15.079 10.1397 15.2197 10.2803C15.3603 10.421 15.5511 10.5 15.75 10.5H18.75C18.9489 10.5 19.1397 10.421 19.2803 10.2803C19.421 10.1397 19.5 9.94891 19.5 9.75V3.75C19.5 2.75544 19.1049 1.80161 18.4016 1.09835C17.6984 0.395088 16.7446 0 15.75 0Z"
                                                                fill="#FFAE1A" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="gr_fl3">
                                                <a href="#url" class="req_mask_btn">
                                                    <i class="ic_req_m"><img
                                                            src="<?php echo e(asset('assets/be/images/masked.svg')); ?>"
                                                            alt="" /></i>
                                                    <div class="req_mask_btn_rtt">Request Unmask</div>
                                                </a>
                                            </div>
                                            <a href="javascript:void(0)" data-bs-target="#exampleModalToggle2"
                                                data-bs-toggle="modal" data-bs-dismiss="modal" class="eye-ball2" wire:click="viewProfile(<?php echo e($candidate->id); ?>)">
                                                <img src="<?php echo e(asset('assets/be/images/eye_ic.svg')); ?>"
                                                    alt="" />
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <a href="<?php echo e(route('company.dashboard')); ?>" class="vbtn_finding">Not finding what you are looking
                        for? click here to view
                        entire candidate database</a>
                </div>

                <div class="main-body-footer">
                    <div class="footer-para new">
                        <p>
                            <a href="index.html">© 2022 Purple Stairs</a>Website by
                            <a href="https://www.brand-right.com/" target="_blank" class="brand">
                                BrandRight Marketing Group</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('inc.candidateProfile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        window.addEventListener('close-notes', event => {
            $('#notesModal').modal('hide');
            $('#exampleModalToggle2').modal('show');
        });

        function profile_modal(id) {
            Livewire.emit('viewProfile', id);
        }

        window.addEventListener('open-profile-modal', event => {
            $('#exampleModalToggle2').modal('show');
        })
    </script>
<?php $__env->stopPush(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/saved-search.blade.php ENDPATH**/ ?>