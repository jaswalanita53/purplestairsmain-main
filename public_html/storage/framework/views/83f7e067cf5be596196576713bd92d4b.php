<div>
    <div class="mid-contain">
        <div class="container-fluid">
            <div class="main-body">
                <div class="main-body-upper">
                    <div class="form-sec gl-form">
                        <form>
                            <div class="row filter-row">
                                <div class="col mb-3">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle w-100 filter-btn industries_filter_btn" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                                            Industries
                                        </button>
                                        <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuButtonInd">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5>Industries</h5>
                                                </div>
                                                <div class="col-6 float-right"><a href="jasvascript:void(0)" class="float-right">x</a></div>
                                            </div>
                                            <?php $__currentLoopData = $all_industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <!-- <option value=<?php echo e($ind); ?>><?php echo e($key); ?></option> -->

                                            <li class="mb-2">
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <div class="form-check">
                                                        <input class="form-check-input industries_checkbox" type="checkbox" value="<?php echo e($ind); ?>" id="flexCheckDefault<?php echo e($key); ?><?php echo e($ind); ?>">
                                                        <label class="form-check-label" for="flexCheckDefault<?php echo e($key); ?><?php echo e($ind); ?>">
                                                            <?php echo e($key); ?>

                                                        </label>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>
                                    </div>
                                </div>

                                <div class="col mb-3">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle w-100 filter-btn interest_filter_btn" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                                            Area of Interest
                                        </button>
                                        <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuButtonInd">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5>Area of Interest</h5>
                                                </div>
                                                <div class="col-6 float-right"><a href="jasvascript:void(0)" class="float-right">x</a></div>
                                            </div>
                                            <?php $__currentLoopData = $all_interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <!-- <option value=<?php echo e($ind); ?>><?php echo e($key); ?></option> -->

                                            <li class="mb-2">
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <div class="form-check">
                                                        <input class="form-check-input interests_checkbox" type="checkbox" value="<?php echo e($interest); ?>" id="flexCheckDefault<?php echo e($key); ?><?php echo e($interest); ?>">
                                                        <label class="form-check-label" for="flexCheckDefault<?php echo e($key); ?><?php echo e($interest); ?>">
                                                            <?php echo e($key); ?>

                                                        </label>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>
                                    </div>
                                </div>

                                <div class="col mb-3">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle w-100 filter-btn hard_skills_filter_btn" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                                            Hard skills
                                        </button>
                                        <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuButtonInd">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5>Hard skills</h5>
                                                </div>
                                                <div class="col-6 float-right"><a href="jasvascript:void(0)" class="float-right">x</a></div>
                                            </div>
                                            <?php $__currentLoopData = $all_hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <!-- <option value=<?php echo e($ind); ?>><?php echo e($key); ?></option> -->

                                            <li class="mb-2">
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <div class="form-check">
                                                        <input class="form-check-input hard_skills_checkbox" type="checkbox" value="<?php echo e($skill); ?>" id="flexCheckDefault<?php echo e($key); ?><?php echo e($skill); ?>">
                                                        <label class="form-check-label" for="flexCheckDefault<?php echo e($key); ?><?php echo e($skill); ?>">
                                                            <?php echo e($key); ?>

                                                        </label>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>
                                    </div>
                                </div>


                                <div class="col mb-3">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle w-100 filter-btn soft_skills_filter_btn" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                                            Soft skills
                                        </button>
                                        <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuButtonInd">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5>Soft skills</h5>
                                                </div>
                                                <div class="col-6 float-right"><a href="jasvascript:void(0)" class="float-right">x</a></div>
                                            </div>
                                            <?php $__currentLoopData = $all_soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <!-- <option value=<?php echo e($ind); ?>><?php echo e($key); ?></option> -->

                                            <li class="mb-2">
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <div class="form-check">
                                                        <input class="form-check-input soft_skills_checkbox" type="checkbox" value="<?php echo e($skill); ?>" id="flexCheckDefault<?php echo e($key); ?>">
                                                        <label class="form-check-label" for="flexCheckDefault<?php echo e($key); ?>">
                                                            <?php echo e($key); ?>

                                                        </label>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>
                                    </div>
                                </div>

                                <div class="col mb-3">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle w-100 filter-btn languages_filter_btn" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                                            Languages
                                        </button>
                                        <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuButtonInd">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5>Languages</h5>
                                                </div>
                                                <div class="col-6 float-right"><a href="jasvascript:void(0)" class="float-right">x</a></div>
                                            </div>
                                            <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <!-- <option value=<?php echo e($ind); ?>><?php echo e($key); ?></option> -->

                                            <li class="mb-2">
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <div class="form-check">
                                                        <input class="form-check-input languages_checkbox" type="checkbox" value="<?php echo e($language); ?>" id="flexCheckDefault<?php echo e($key); ?>">
                                                        <label class="form-check-label" for="flexCheckDefault<?php echo e($key); ?>">
                                                            <?php echo e($key); ?>

                                                        </label>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>
                                    </div>
                                </div>


                            </div>
                            <!-- <div class="row">
                                <div class="col-md-3">
                                    <label>Industries</label>
                                    <div class="form-group">
                                        <select class="js-example-tags industries" multiple="multiple" wire:model.lazy="selectedIndustries">
                                            <?php $__currentLoopData = $all_industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value=<?php echo e($ind); ?>><?php echo e($key); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Area of Interest</label>
                                    <div class="form-group">
                                        <select class="js-example-tags interests" multiple="multiple" wire:model.lazy="selectedInterests">
                                            <?php $__currentLoopData = $all_interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value=<?php echo e($interest); ?>><?php echo e($key); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Hard skills</label>
                                    <div class="form-group">
                                        <select class="js-example-tags hard_skills" multiple="multiple" wire:model.lazy="selectedHardSkills">
                                            <?php $__currentLoopData = $all_hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value=<?php echo e($skill); ?>><?php echo e($key); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Soft skills</label>
                                        <select class="js-example-tags soft_skills" multiple="multiple" wire:model.lazy="selectedSoftSkills">
                                            <?php $__currentLoopData = $all_soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value=<?php echo e($skill); ?>><?php echo e($key); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Languages</label>
                                        <select class="js-example-tags languages" multiple="multiple" wire:model.lazy="selectedLanguages">
                                            <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value=<?php echo e($language); ?>><?php echo e($key); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="save-btn-otr">
                                    <a class="save-btn new" href="javascript:void(0)" data-bs-target="#saveSearchModal" data-bs-toggle="modal" data-bs-dismiss="modal" class="eyeBall">Save &amp; Name
                                        This Search
                                        <span><img src="<?php echo e(asset('assets/be/images/save-icon.svg')); ?>" alt="" /></span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    

            <div class="view_cancidate_all_set">
                <div class="row view_cancidate_all_set_row gy-3">
                    <div class="col-xl-8 col-lg-9 view_cancidate_all_set_col_lft">
                        <div class="sec_head_mn">
                            <h2>View All Candidates</h2>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-3 view_cancidate_all_set_col_rtt">
                        <div class="view_cancidate_all_set_col_rtt_innr">
                            <div class="dropdown sort-dropdown neww">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort By
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click="$set('sortBy', 'alpha')"> A to Z </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click="$set('sortBy', 'distance')"> Distance </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click="$set('sortBy', 'newest')"> Newest </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" wire:click="$set('sortBy', 'experience')">
                                            Experienced
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="list_grid_wrapper">
                                <ul>
                                    <li class="grid">
                                        <button class="grid" data-target="content1">
                                            <img src="<?php echo e(asset('assets/be/images/grid.svg')); ?>" alt="" />
                                        </button>
                                    </li>
                                    <li class="active list">
                                        <button class="list" data-target="content2">
                                            <img src="<?php echo e(asset('assets/be/images/list.svg')); ?>" alt="" />
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="listgrid_cnt" id="content1">
                    <div class="row candiate_list_view_parent_row gy-4">
                        <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-4 col-md-6 candiate_list_view_parent_col">
                            <div class="candidate_grid_ppl_wppt">
                                <div class="candidate_grid_ppl">
                                    <div class="candidate_top_pnk_ic">
                                        <img src="<?php echo e(asset('assets/be/images/shape_left_pnk.png')); ?>" alt="" />
                                    </div>
                                    <div class="candidate_grid_ppl_icn">
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
                                                        <input type="checkbox" class="manual_add_saved_serach" data-search-id="<?php echo e($search->id); ?>" data-candidate="<?php echo e($candidate->id); ?>" wire:click="changeEvent('<?php echo e($is_checked); ?>', '<?php echo e($search->id); ?>','<?php echo e($candidate->id); ?>')" <?php echo e($is_checked ? 'checked' : ''); ?> />
                                                        <span><?php echo e($search->name); ?></span>
                                                    </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="candidate_grid_ppl_top">
                                        <figure class="main_img">
                                            <?php if($candidate->profile_photo_path): ?>
                                            <img src="<?php echo e(asset($candidate->profile_photo_path)); ?>" alt="" />
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                                            <?php endif; ?>
                                        </figure>
                                        <div class="candidate_grid_ppl_top_rt">
                                            <h6><?php echo e($candidate->name); ?></h6>
                                            <p><?php echo e($candidate->personal ? $candidate->personal->current_title : ''); ?>

                                            </p>
                                        </div>
                                    </div>

                                    <div class="candidate_grid_ppl_top_btm">
                                        <ul>
                                            <li>
                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                    <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <p>5 Yrs Experience</p>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="candidate_grid_ppl_top_btm_wrap">
                                                    <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic2.svg')); ?>" alt="" /></i>
                                                    <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                                        <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>,&nbsp;<?php echo e($candidate->personal ? $candidate->personal->state_abbr : ''); ?></p>
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
                                    <a href="javascript:void(0)" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" class="eyeBall" wire:click="viewProfile(<?php echo e($candidate->id); ?>)"><img src="<?php echo e(asset('assets/be/images/eye_ic.svg')); ?>" alt="" /></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
        </div>

        <a href="#url" class="load_more" wire:click="loadMore"><i><img src="<?php echo e(asset('assets/be/images/load_ic.svg')); ?>" alt="" /></i>Load
            More</a>
    </div>

    <div class="listgrid_cnt  active" id="content2">
        <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="listview_candidate_details_w">
            <div class="listview_candidate_details">
                <div class="layout_back" style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" wire:click="viewProfile(<?php echo e($candidate->id); ?>)">
                </div>
                <div data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" wire:click="viewProfile(<?php echo e($candidate->id); ?>)">
                    <div class="listview_candidate_details_img">
                        <?php if($candidate->profile_photo_path): ?>
                        <img src="<?php echo e(asset($candidate->profile_photo_path)); ?>" alt="" />
                        <?php else: ?>
                        <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                        <?php endif; ?>
                    </div>
                </div>
                <div data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" wire:click="viewProfile(<?php echo e($candidate->id); ?>)">
                    <div class="listview_candidate_details_head">
                        <h6><?php echo e($candidate->name); ?></h6>
                        <p><?php echo e($candidate->personal ? $candidate->personal->current_title : ''); ?></p>
                    </div>
                </div>

                <div data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" wire:click="viewProfile(<?php echo e($candidate->id); ?>)">
                    <div class="ecperice_list">
                        <div class="candidate_grid_ppl_top_btm_wrap">
                            <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic1.svg')); ?>" alt="" /></i>
                            <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                <p>5 Yrs Experience</p>
                            </div>
                        </div>

                        <div class="candidate_grid_ppl_top_btm_wrap">
                            <i class="icon_candt"><img src="<?php echo e(asset('assets/be/images/ic2.svg')); ?>" alt="" /></i>
                            <div class="candidate_grid_ppl_top_btm_wrap_rtt">
                                <p><?php echo e($candidate->personal ? $candidate->personal->address : ''); ?>,<?php echo e($candidate->personal ? $candidate->personal->country_abbr : ''); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="gr_fl" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" wire:click="viewProfile(<?php echo e($candidate->id); ?>)">
                    <div class="ask_salary_sec">
                        <i class="ic_icon">$</i>
                        <div class="ask_salary_sec_rtt">
                            <h6>Asking Salary</h6>
                            <p><?php echo e($candidate->personal ? $candidate->personal->salary_range : ''); ?></p>
                        </div>
                    </div>
                </div>

                <div class="gr_fl2">
                    <div class="candidate_grid_ppl_icn large">
                        <a href="#url" class="clickd_tgl_searches">+</a>
                        <div class="clickd_tgl_searches_open">
                            <div class="clickd_tgl_searches_open_head">
                                <h5>Saved Searches</h5>
                            </div>
                            <div class="clickd_tgl_searches_open_ul">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" checked="" name="check_demo_type" />
                                        <span>General Save (no list)</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="check_demo_type" />
                                        <span>CPA With Experience</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="check_demo_type" />
                                        <span>Noach’s Right Hand Man</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="check_demo_type" />
                                        <span>Director of Operations</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="check_demo_type" />
                                        <span>Lead Operations Sales</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="check_demo_type" />
                                        <span>Noach’s Right Hand Man</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="check_demo_type" />
                                        <span>Director of Operations</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="check_demo_type" />
                                        <span>Lead Operations Sales</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="gr_fl3" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" wire:click="viewProfile(<?php echo e($candidate->id); ?>)">
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
                <a href="javascript:void(0)" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" class="eye-ball2" wire:click="viewProfile(<?php echo e($candidate->id); ?>)">
                    <img src="<?php echo e(asset('assets/be/images/eye_ic.svg')); ?>" alt="" />
                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <a href="#url" class="load_more" wire:click="loadMore"><i><img src="<?php echo e(asset('assets/be/images/load_ic.svg')); ?>" alt="" /></i>Load
            More</a>
    </div>
</div>
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
<?php echo $__env->make('inc.saveSearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    //initiate industries select2
    // document.addEventListener("livewire:load", () => {
    //     initSelect2Industries();
    // })

    // function initSelect2Industries() {
    //     let el = $('.industries')
    //     initSelect();
    //     $('.industries').on('change', function(e) {
    //         var data = $('.industries').select2("val");
    //         window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedIndustries', data);
    //     });
    //     Livewire.hook('message.processed', (message, component) => {
    //         initSelect()
    //     })

    //     function initSelect() {
    //         el.select2({
    //             tags: false
    //         })
    //     }
    // }

    //initiate industries select2
    // document.addEventListener("livewire:load", () => {
    //     initSelect2Interests();
    // })

    // function initSelect2Interests() {
    //     let el = $('.interests')
    //     initSelect();
    //     $('.interests').on('change', function(e) {
    //         var data = $('.interests').select2("val");
    //         window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedInterests', data);
    //     });
    //     Livewire.hook('message.processed', (message, component) => {
    //         initSelect()
    //     })

    //     function initSelect() {
    //         el.select2({
    //             tags: false
    //         })
    //     }
    // }

    //initiate languages select2
    // document.addEventListener("livewire:load", () => {
    //     initSelect2Languages();
    // })

    // function initSelect2Languages() {
    //     let el = $('.languages')
    //     initSelect();
    //     $('.languages').on('change', function(e) {
    //         var data = $('.languages').select2("val");
    //         window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedLanguages', data);
    //     });
    //     Livewire.hook('message.processed', (message, component) => {
    //         initSelect()
    //     })

    //     function initSelect() {
    //         el.select2({
    //             tags: false
    //         })
    //     }
    // }

    //initiate soft skills select2
    // document.addEventListener("livewire:load", () => {
    //     initSelect2Soft();
    // })

    // function initSelect2Soft() {
    //     let el = $('.soft_skills')
    //     initSelectSoft();
    //     $('.soft_skills').on('change', function(e) {
    //         var data = $('.soft_skills').select2("val");
    //         window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedSoftSkills', data);
    //     });
    //     Livewire.hook('message.processed', (message, component) => {
    //         initSelectSoft()
    //     })

    //     function initSelectSoft() {
    //         el.select2({
    //             tags: false
    //         })
    //     }
    // }

    //initiate hard skills select2
    // document.addEventListener("livewire:load", () => {
    //     initSelect2Hard();
    // })

    // function initSelect2Hard() {
    //     let el = $('.hard_skills')
    //     initSelectHard();
    //     $('.hard_skills').on('change', function(e) {
    //         var data = $('.hard_skills').select2("val");
    //         window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedHardSkills', data);
    //     });
    //     Livewire.hook('message.processed', (message, component) => {
    //         initSelectHard()
    //     })

    //     function initSelectHard() {
    //         el.select2({
    //             tags: false
    //         })
    //     }
    // }
</script>



<script>
    $(".prev-btn").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/personal-information')
    })
    $(".nxt-btn").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/employment')
    })
</script>

<script>
    window.addEventListener('close-search', event => {
        $('#saveSearchModal').modal('hide');

        $('body, html').removeClass('sidebar_show');
    })
</script>

<script>
    window.addEventListener('close-notes', event => {
        $('#notesModal').modal('hide');
        $('#exampleModalToggle2').modal('show');
    })
</script>

<script src="
https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.js
"></script>
<script>
    $(document).ready(function() {
        $("body").delegate(".right-arrow,.left-arrow", "click", function(e) {
            $.LoadingOverlay("show");
            setTimeout(function() {

                $.LoadingOverlay("hide");
            }, 3000);
        })
    })
</script>
<script>
    document.addEventListener("livewire:load", () => {
        initSelect2Industries();
    })

    function initSelect2Industries(e) {
        var html = "";
        var firstItem = "";
        $("body").delegate(".industries_checkbox", "click", function(e) {
            $.LoadingOverlay("show");
            var industiesIds = [];
            var industiesNames = [];

            $('.industries_checkbox').each(function(index) {
                if ($(this).is(':checked')) {
                    industiesIds.push($(this).val())
                    industiesNames.push($.trim($(this).next().text()))
                }
            })

            var first = $.trim(industiesNames[0]).substr(0, 12);
            firstItem = first;
            $('.industries_filter_btn').addClass("selecedItems")
            if (industiesNames.length <= 1) {
                html = '<span>' + first + '<span><span class="float-right"> <a href="javascript:void(0)" class="reset-filter">X<a/>';
            } else {
                html = '<span>' + first + '+ ' + industiesNames.length + '<span class="float-right"> <a href="javascript:void(0)" class="reset-filter">X<a/>';

            }

            if (firstItem !== "") {
                $('.industries_filter_btn').addClass("selecedItems")
                $('.industries_filter_btn').html(html)
            }
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedIndustries', industiesIds);

        })
        setInterval(function() {
            if (firstItem !== "") {
                $('.industries_filter_btn').addClass("selecedItems")
                $('.industries_filter_btn').html(html)
            }
        }, 500);

        setInterval(function() {
            $.LoadingOverlay("hide");
        }, 3000);

    }



    document.addEventListener("livewire:load", () => {
        initSelect2Interests();
    })

    function initSelect2Interests(e) {

        var html = "";
        var firstItem = "";
        $("body").delegate(".interests_checkbox", "click", function(e) {
            $.LoadingOverlay("show");
            var interestIds = [];
            var interestNames = [];

            $('.interests_checkbox').each(function(index) {
                if ($(this).is(':checked')) {
                    interestIds.push($(this).val())
                    interestNames.push($.trim($(this).next().text()))
                }
            })

            var first = $.trim(interestNames[0]).substr(0, 12);
            firstItem = first;
            console.log('interestNames', first)
            $('.interest_filter_btn').addClass("selecedItems")
            if (interestNames.length <= 1) {
                html = '<span>' + first + '<span><span class="float-right"> <a href="javascript:void(0)" class="reset-filter">X<a/>';
            } else {
                html = '<span>' + first + '+ ' + interestNames.length + '<span class="float-right"> <a href="javascript:void(0)" class="reset-filter">X<a/>';
            }

            if (firstItem !== "") {
                $('.interest_filter_btn').addClass("selecedItems")
                $('.interest_filter_btn').html(html)
            }
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedInterests', interestIds);
        })
        setInterval(function() {
            if (firstItem !== "") {
                $('.interest_filter_btn').addClass("selecedItems")
                $('.interest_filter_btn').html(html)
            }
        }, 500);
        setInterval(function() {
            $.LoadingOverlay("hide");
        }, 3000);

    }


    document.addEventListener("livewire:load", () => {
        initSelect2Hard();
    })

    function initSelect2Hard(e) {

        var html = "";
        var firstItem = "";
        $("body").delegate(".hard_skills_checkbox", "click", function(e) {
            $.LoadingOverlay("show");
            var hard_skillsIds = [];
            var hard_skillsNames = [];

            $('.hard_skills_checkbox').each(function(index) {
                if ($(this).is(':checked')) {
                    hard_skillsIds.push($(this).val())
                    hard_skillsNames.push($.trim($(this).next().text()))
                }
            })


            var first = $.trim(hard_skillsNames[0]).substr(0, 12);
            firstItem = first;

            $('.hard_skills_filter_btn').addClass("selecedItems")
            if (hard_skillsNames.length <= 1) {
                html = '<span>' + first + '<span><span class="float-right"> <a href="javascript:void(0)" class="reset-filter">X<a/>';
            } else {
                html = '<span>' + first + '+ ' + hard_skillsNames.length + '<span class="float-right"> <a href="javascript:void(0)" class="reset-filter">X<a/>';
            }
            if (firstItem !== "") {
                $('.hard_skills_filter_btn').addClass("selecedItems")
                $('.hard_skills_filter_btn').html(html)
            }
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedHardSkills', hard_skillsIds);
        })

        setInterval(function() {
            if (firstItem !== "") {
                $('.hard_skills_filter_btn').addClass("selecedItems")
                $('.hard_skills_filter_btn').html(html)
            }
        }, 500);
        setInterval(function() {
            $.LoadingOverlay("hide");
        }, 3000);
    }


    document.addEventListener("livewire:load", () => {
        initSelect2Soft();
    })

    function initSelect2Soft(e) {

        var html = "";
        var firstItem = "";
        $("body").delegate(".soft_skills_checkbox", "click", function(e) {
            $.LoadingOverlay("show");
            var soft_skillsIds = [];
            var soft_skillsNames = [];

            $('.soft_skills_checkbox').each(function(index) {
                if ($(this).is(':checked')) {
                    soft_skillsIds.push($(this).val())
                    soft_skillsNames.push($.trim($(this).next().text()))
                }
            })


            var first = $.trim(soft_skillsNames[0]).substr(0, 12);
            firstItem = first;
            console.log('soft_skillsNames', first)
            $('.soft_skills_filter_btn').addClass("selecedItems")
            if (soft_skillsNames.length <= 1) {
                html = '<span>' + first + '<span><span class="float-right"> <a href="javascript:void(0)" class="reset-filter">X<a/>';
            } else {
                html = '<span>' + first + '+ ' + soft_skillsNames.length + '<span class="float-right"> <a href="javascript:void(0)" class="reset-filter">X<a/>';
            }

            if (firstItem !== "") {
                $('.soft_skills_filter_btn').addClass("selecedItems")
                $('.soft_skills_filter_btn').html(html)
            }
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedSoftSkills', soft_skillsIds);
        })
        setInterval(function() {
            if (firstItem !== "") {
                $('.soft_skills_filter_btn').addClass("selecedItems")
                $('.soft_skills_filter_btn').html(html)
            }
        }, 500);
        setInterval(function() {
            $.LoadingOverlay("hide");
        }, 3000);
    }


    document.addEventListener("livewire:load", () => {
        initSelect2Languages();
    })

    function initSelect2Languages(e) {


        var html = "";
        var firstItem = "";
        $("body").delegate(".languages_checkbox", "click", function(e) {
            $.LoadingOverlay("show");
            var languagesIds = [];
            var languagesNames = [];
            $('.languages_checkbox').each(function(index) {
                if ($(this).is(':checked')) {
                    languagesIds.push($(this).val())
                    languagesNames.push($.trim($(this).next().text()))
                }
            })

            var first = $.trim(languagesNames[0]).substr(0, 12);
            firstItem = first;
            console.log('languagesNames', first)
            $('.languages_filter_btn').addClass("selecedItems")
            if (languagesNames.length <= 1) {
                html = '<span>' + first + '<span><span class="float-right"> <a href="javascript:void(0)" class="reset-filter">X<a/>';
            } else {
                html = '<span>' + first + '+ ' + languagesNames.length + '<span class="float-right"> <a href="javascript:void(0)" class="reset-filter">X<a/>';
            }
            if (firstItem !== "") {
                $('.languages_filter_btn').addClass("selecedItems")
                $('.languages_filter_btn').html(html)
            }
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedLanguages', languagesIds);
        })


        setInterval(function() {
            if (firstItem !== "") {
                $('.languages_filter_btn').addClass("selecedItems")
                $('.languages_filter_btn').html(html)
            }
        }, 500);
        setInterval(function() {
            $.LoadingOverlay("hide");
        }, 3000);
    }


    $("body").delegate(".reset-filter", "click", function(e) {

        $(this).parents('.dropdown').find('.dropdown-menu').find('.form-check-input').each(function() {
            if ($(this).is(':checked')) {
                $(this).trigger('click')
            }
        })
    })
    // setInterval(function() {
    //     $('.languages_checkbox').trigger('click')
    // }, 500);
</script>

<?php $__env->stopPush(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/company-dashboard.blade.php ENDPATH**/ ?>