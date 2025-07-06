<div>
    <!-- select2 filters -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/be/search-page.css')); ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.js"></script>
    <style>
        .select2-container--default .select2-selection--multiple {
            background: transparent;
        }

        .tag-input-field .form-group { margin-bottom: 0px !important; }

        .background-masker {
            background-color: #fff;
            position: absolute;
        }

        @keyframes placeHolderShimmer {
              0% {
                background-position: -800px 0
              }
              100% {
                background-position: 800px 0
              }
        }

        .animated-background {
            animation-duration: 2s;
            animation-fill-mode: forwards;
            animation-iteration-count: infinite;
            animation-name: placeHolderShimmer;
            animation-timing-function: linear;
            background-color: #f6f7f8;
            background: linear-gradient(to right, #f2f2f2 8%, #ebebeb 18%, #f2f2f2 33%);
            background-size: 800px 104px;
            height: 45px !important;
            border-radius: 50px;
            position: relative;
            margin: 0px 3px 5px 0px;
            max-width: 150px;
        }

        .animated-background > * {
            visibility: hidden;
        }

        .animated-background:after {
            content: " ";
            visibility: visible;
            position: absolute;
        }
        .select2-results {
width: 100% !important;
box-shadow: 1px 1px 1px 1px 3px lightgray !important;
}
.select2-results__options{
  background-color: white !important;
 box-shadow: 1px 1px 1px 1px 3px lightgray !important;
 border:1px solid lightgray !important;

  
}
.select2-dropdown{

    
}
    </style>

    <div class="mid-contain">
        <div class="container-fluid">
            <div class="main-body">
                <div class="main-body-upper">
                    <?php if($api_failed>0): ?>
                    <!-- <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
                        Distance filter failed for <?php echo e($api_failed); ?> candidates (API failed or data missing).
                        <button type="button" class="close float-right cut-btn-alert" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <?php endif; ?>

                    <div class="form-sec gl-form p-3 filter-div" style="background: #f8f4fb;">
                        <div class="filter-loader"></div>
                        <div class="sec_head_mn mb-3 ">
                            <h2 class="filter-search-h2">Filter Your Search</h2>
                        </div>
                        <form id="filters-form">
                            <div class="row ">
                                <div class="col-md-9">
                                    <div class="d-flex flex-wrap filter-row">
                                        
                                        <input type="hidden" id="past_tags" value="<?php echo e($selectCurrentPosition); ?>">
                                        <input type="hidden" id="live_tags">
                                        <div class="col- filter-col-box tag-input-field animated-background">
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js" integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                                            <div class="col- filter-col-box form-group position-input">
                                                <input class="js-select2 current_position_filter_btn2 form-control" data-role="tagsinput" placeholder="Current Position/Title" value="<?php echo e($selectCurrentPosition); ?>"/>
                                            </div>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <div class="dropdown">
                                                <button class=" filter-btn m-0 select2-selection__rendered dd_year_of_exp w-100 text-left" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Yrs of exp
                                                </button>
                                                <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButtonInd">
                                                    <div class="row m-0 p-2">
                                                        <div class="col-11">
                                                            <h5>Years of experience</h5>
                                                            <input type="hidden" id="filterYearOfExperience" value="<?php echo e($filterYearOfExperience); ?>">
                                                            <div slider__ id="slider-distance">
                                                                <div>
                                                                    <div inverse-left style="width:70%;"></div>
                                                                    <div inverse-right style="width:70%;"></div>
                                                                    <div range style="left:0%;right:0%;"></div>
                                                                    <span thumb style="left:0%;"></span>
                                                                    <span thumb style="left:100%;"></span>
                                                                    <div sign style="left:0%;">
                                                                        <span id="value">0</span>
                                                                    </div>
                                                                    <div sign style="left:100%;">
                                                                        <span id="value">40</span>
                                                                    </div>
                                                                </div>
                                                                <input type="range" value="0" max="40" min="0" step="1" oninput="
                                                                this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                                                let value = (this.value/parseInt(this.max))*100
                                                                var children = this.parentNode.childNodes[1].childNodes;
                                                                children[1].style.width=value+'%';
                                                                children[5].style.left=value+'%';
                                                                children[7].style.left=value+'%';children[11].style.left=value+'%';
                                                                children[11].childNodes[1].innerHTML=this.value;" class="min-range js-select2" />

                                                                <input type="range" value="40" max="40" min="0" step="1" oninput="
                                                                this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                                                                let value = (this.value/parseInt(this.max))*100
                                                                var children = this.parentNode.childNodes[1].childNodes;
                                                                children[3].style.width=(100-value)+'%';
                                                                children[5].style.right=(100-value)+'%';
                                                                children[9].style.left=value+'%';children[13].style.left=value+'%';
                                                                children[13].childNodes[1].innerHTML=this.value;" class="max-range js-select2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-1 float-right"><a href="jasvascript:void(0)" class="float-right cut-range">x</a></div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>

                                        

                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 salary_range_filter_btn" multiple="multiple" placeholder="fsafas">
                                                <?php $__currentLoopData = $all_salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($salary); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col-  filter-col-box animated-background">
                                            <select class="js-select2 compensation_filter_btn" multiple="multiple" placeholder="fsafas">
                                                <?php $__currentLoopData = $all_compensations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $compensation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($compensation); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($compensation); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        
                                        <input type="hidden" id="is_run" value="<?php echo e($is_run); ?>">
                                        <input type="hidden" name="is_submit" id="is_submit" value="<?php echo e($is_submit); ?>">
                                        <input type="hidden" name="is_filtered" id="is_filtered" value="<?php echo e($is_filtered); ?>">
                                        <div class="col- filter-col-box animated-background">
                                            <div class="dropdown">
                                                <button class=" filter-btn m-0 select2-selection__rendered dd_year_of_exp-dist  text-left" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Distance
                                                </button>
                                                <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButtonInd">
                                                    <div class="row m-0 p-2">
                                                        <div class="col-11">
                                                            <h5>Distance By Mile</h5>
                                                            <input type="hidden" id="filterDistance" value="<?php echo e($filterDistance); ?>">
                                                            <div slider__ id="slider-distance">
                                                                <div>
                                                                    <div inverse-left style="width:70%;"></div>
                                                                    <div inverse-right style="width:70%;"></div>
                                                                    <div range style="left:0%;right:0%;"></div>
                                                                    <span thumb style="left:0%;"></span>
                                                                    <span thumb style="left:100%;"></span>
                                                                    <div sign style="left:0%;">
                                                                        <span id="value">0</span>
                                                                    </div>
                                                                    <div sign style="left:100%;">
                                                                        <span id="value">100</span>
                                                                    </div>
                                                                </div>
                                                                <input type="range" value="0" max="100" min="0" step="1" oninput="
                                                                this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                                                let value = (this.value/parseInt(this.max))*100
                                                                var children = this.parentNode.childNodes[1].childNodes;
                                                                children[1].style.width=value+'%';
                                                                children[5].style.left=value+'%';
                                                                children[7].style.left=value+'%';children[11].style.left=value+'%';
                                                                children[11].childNodes[1].innerHTML=this.value;" class="min-range-distance js-select2" />

                                                                <input type="range" value="100" max="100" min="0" step="1" oninput="
                                                                this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                                                                let value = (this.value/parseInt(this.max))*100
                                                                var children = this.parentNode.childNodes[1].childNodes;
                                                                children[3].style.width=(100-value)+'%';
                                                                children[5].style.right=(100-value)+'%';
                                                                children[9].style.left=value+'%';children[13].style.left=value+'%';
                                                                children[13].childNodes[1].innerHTML=this.value;" class="max-range-distance js-select2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-1 float-right"><a href="jasvascript:void(0)" class="float-right cut-range-dist">x</a></div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col- filter-col-box animated-background">

                                            <select class="js-select2 schedule_filter_btn" multiple="multiple" placeholder="fsafas">
                                                <?php $__currentLoopData = $all_schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($schedule); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($schedule); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 interest_filter_btn" multiple="multiple" placeholder="fsafas">
                                                <?php $__currentLoopData = $all_interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($interest); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($interest); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 industries_filter_btn" multiple="multiple" placeholder="fsaffgsdgfsgfas">
                                                <?php $__currentLoopData = $all_industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($ind); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($ind); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 hard_skills_filter_btn" multiple="multiple" placeholder="fsafas">
                                                <?php $__currentLoopData = $all_hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($skill); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($skill); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 soft_skills_filter_btn" multiple="multiple" placeholder="fsafas">
                                                <?php $__currentLoopData = $all_soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($skill); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($skill); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col- filter-col-box animated-background">
                                            <select class="js-select2 work_environment_filter_btn" multiple="multiple" placeholder="fsafas">
                                                <?php $__currentLoopData = $all_work_environments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $environment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($environment); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($environment); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <!-- <div class="col- filter-col-box">
                                            <select class="js-select2 years_of_experience_filter_btn" multiple="multiple" placeholder="fsafas">
                                                <?php $__currentLoopData = $all_soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($skill); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($skill); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div> -->

                                        <div class="col-  filter-col-box animated-background">
                                            <select class="js-select2 languages_filter_btn" multiple="multiple" placeholder="fsafas" form="save-search" wire:model="selectedLanguages" name="selectedLanguages">
                                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($language); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($language); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <input type="hidden" class="firstSearch" value="true">
                                        <span class="mt-2">
                                            <a href="javascript:void(0)" class="clear-filter-btn float-right mr-2 hide-clr-btn"><span class="m-0"><i class="fa fa-times"></i></span>
                                                Clear All Filters</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 text-end">
                                    <div class="col-  filter-col-box filter-btn">
                                        <button class="save-btn save-search-btn blue_btn" type="submit">
                                           Run Search
                                            <span><i class="fa fa-search"></i></span>
                                        </button>
                                    </div>

                                    <div class="save-btn-otr col hidden-btn-filter filter-btn">
                                        
                                        <a class="save-btn new float-right open-save-search-btn" href="javascript:void(0)" data-bs-target="#saveSearchModal" data-bs-toggle="modal" data-bs-dismiss="modal" class="eyeBall">Save & Name Search
                                            <span><img src="<?php echo e(asset('assets/be/images/save-icon.svg')); ?>" alt="" /></span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    

            <div class="view_cancidate_all_set">
                <div class="row view_cancidate_all_set_row gy-3">
                    <div class="col-xl-7 col-lg-9 view_cancidate_all_set_col_lft">
                        <div class="sec_head_mn sec_head_mn-all mt-2">
                            <h2>View All Candidates</h2>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-3 view_cancidate_all_set_col_rtt">
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

                                <!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
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
                                </ul> -->
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    
                                    <li>
                                        <a class="dropdown-item sort-tab py-2 <?php echo e($sortBy=="distance" ? 'bg-purple text-white' : ''); ?>" href="javascript:;" data-type="distance"> Distance </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item sort-tab py-2 <?php echo e($sortBy=="newest" ? 'bg-purple text-white' : ''); ?>" href="javascript:;" data-type="newest"> Newest </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item sort-tab py-2 <?php echo e($sortBy=="experience" ? 'bg-purple text-white' : ''); ?>" href="javascript:;" data-type="experience">
                                            Experienced
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="list_grid_wrapper">
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
                <?php
                    $com_user_arr = array_column($company_users, 'deleted_at', 'user_id');
                ?>
                <div class="listgrid_cnt <?php echo e(($active_tab==1) ? 'active' : ''); ?>" id="content-1">
                    <div class="row candiate_list_view_parent_row gy-4 candidate_box_parent">

                        <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <?php
                            $list_row = 1;
                            if(array_key_exists($candidate->id ,$com_user_arr)) {
                                $u_key = array_search($candidate->id, array_column($company_users, 'user_id'));
                                if(!is_null($com_user_arr[$candidate->id])) {
                                    $list_row = 0;
                                } elseif($u_key >= 0) { // task - 86a0unmm4
                                    if($company_users[$u_key]['status'] == 2) {
                                        $list_row = 0;
                                    }
                                }
                            }
                        ?>

                        <?php if($list_row == 1): ?>

                        
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
                                            if(date('Y', strtotime($date1)) <= 1970) { // task - 86a0e41v5
                                                $date1 = null;
                                            }
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
                                                <?php if(!empty($saved_searches)): ?>
                                                    <?php $__currentLoopData = $saved_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $is_checked = in_array($candidate->id, $search->candidate_ids) ? 1 : 0; ?>
                                                    <label>
                                                        <input type="checkbox" class="manual_add_saved_serach" data-search-id="<?php echo e($search->id); ?>" data-candidate="<?php echo e($candidate->id); ?>" wire:click="changeEvent('<?php echo e($is_checked); ?>', '<?php echo e($search->id); ?>','<?php echo e($candidate->id); ?>')" <?php echo e($is_checked ? 'checked' : ''); ?> />
                                                        <span><?php echo e($search->name); ?></span>
                                                    </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                     <?php endif; ?>
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
                                        <div class="col-4 align-self-center- pt-3 lign-height-point-e">
                                            <span class="grid-exp grid-exp-<?php echo e($hired_employee); ?>"> <?php
                                                expGraphic($yrs_of_exp);
                                                ?>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
        </div>

       <?php if(count($candidates)<$filteredUserCount): ?>
       <a href="#url" class="load_more" wire:click="loadMore"><i><img src="<?php echo e(asset('assets/be/images/load_ic.svg')); ?>" alt="" /></i><span class="loadSpan">Load
            More</span></a>

            <?php else: ?>
           <p class="text-center text-muted m-2">No More Candidate Matches Found</p>
            <?php endif; ?>
    </div>

        <div class="candidate-card listgrid_cnt  <?php echo e(($active_tab==2) ? 'active' : ''); ?> candidate_box_parent" id="content-2">
            <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php
                $list_row = 1;
                if(array_key_exists($candidate->id ,$com_user_arr)) {
                    $u_key = array_search($candidate->id, array_column($company_users, 'user_id'));
                    if(!is_null($com_user_arr[$candidate->id])) {
                        $list_row = 0;
                    } elseif($u_key >= 0) { // task - 86a0unmm4
                        if($company_users[$u_key]['status'] == 2) {
                            $list_row = 0;
                        }
                    }
                }
            ?>

            <?php if($list_row == 1): ?>

                
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
                                    if(date('Y', strtotime($date1)) <= 1970) { // task - 86a0e41v5
                                        $date1 = null;
                                    }
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
                
                <?php if(time() - strtotime($candidate->created_at) < 60*60*24): ?>
                    <?php $hired_employee="new-employee";?>
                <?php endif; ?>
                <div class="listview_candidate_details_w detail_<?php echo e($hired_employee); ?> candidate-card" data-id="<?php echo e($candidate->id); ?>">
                    <?php if(!empty($candidate->delete_status)): ?>
                        <?php if($candidate->delete_status->type=='sleep'): ?>
                        <span class="hired">Hired</span><span class="hired-flag"></span>
                    <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if(time() - strtotime($candidate->created_at) < 60*60*24): ?>
                        <span class="hired bg-danger">New!</span><span class="hired-flag bg-danger"></span>
                        <?php endif; ?>

                    <div class="listview_candidate_details row mx-0  <?php echo e($hired_employee); ?>" data-url="<?php echo e(route('company.candidateprofile', ['user_id' => $candidate->id])); ?> " data-id="<?php echo e($candidate->id); ?>">
                        <div class="layout_back" style="background: url(/assets/be/images/lisview_grd.png) no-repeat left top;" >
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
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
                        <div class="col-md-3 col-sm-4 col-6 mb-2 mb-md-0">
                            <div class="listview_candidate_details_head">
                                <?php if($candidate->companyStatus->first()): ?>
                                    <?php if($candidate->companyStatus->first()->pivot->status == 0 || $candidate->companyStatus->first()->pivot->status == 2): ?>

                                        <?php $length = (strlen($candidate->name) > 15) ? 15 : strlen($candidate->name); ?>
                                        <?php if(!empty($candidate->name)): ?>
                                        <h6 class="blured_txt"><?php echo e(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length)); ?></h6>
                                        <?php else: ?>
                                        <h6 class="blured_txt">Candidate Name</h6>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <h6><?php echo e($candidate->name); ?> </h6>
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

                        <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0" onclick="/*window.location.href='<?php echo e(route('company.candidateprofile', ['user_id' => $candidate->id])); ?>'*/">
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

                        <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0" >
                            <div class="ask_salary_sec align-items-center">
                                <i class="ic_icon">$</i>
                                <div class="ask_salary_sec_rtt">
                                    <h6>Asking Salary</h6>
                                    <p><?php echo e($candidate->personal ? $candidate->personal->salary_range : ''); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1 col-sm-4 col-6 mb-2 mb-md-0">

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
                                            <?php if(!empty($saved_searches)): ?>
                                            <?php $__currentLoopData = $saved_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $is_checked = in_array($candidate->id, $search->candidate_ids) ? 1 : 0; ?>
                                            <label>
                                                <input type="checkbox" class="manual_add_saved_serach" data-search-id="<?php echo e($search->id); ?>" data-candidate="<?php echo e($candidate->id); ?>" wire:click="changeEvent('<?php echo e($is_checked); ?>', '<?php echo e($search->id); ?>','<?php echo e($candidate->id); ?>')" <?php echo e($is_checked ? 'checked' : ''); ?> />
                                                <span><?php echo e($search->name); ?></span>
                                            </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-2 col-sm-4 col-6 mb-2 mb-md-0">
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
                                <div class="req_mask_btn_rtt" wire:loading.remove wire:target="sendRequest(<?php echo e($candidate->id); ?>)">Request Unmask </div>
                                <div class="req_mask_btn_rtt" wire:loading wire:target="sendRequest(<?php echo e($candidate->id); ?>)">Sending...</div>
                            </a>

                            <div class="modal fade inline-table-modal" id="send-request-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" wire:ignore.self>
                                <div class="modal-dialog" role="document" >
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
                                                    <span style="color: var(--purple);" class="request_message" wire:ignore></span>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php endif; ?>


                            
                        </div>

                        <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-dismiss="modal" class="eye-ball2 eyeBall"  data-id="<?php echo e($candidate->id); ?>">
                            <?php echo e(expGraphic($yrs_of_exp)); ?>

                        </a>
                    </div>
            <?php $new_userId = $candidate->id ?>

            <?php echo $__env->make('inc.candidateProfile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

            <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if(count($candidates)<$filteredUserCount): ?>
        <a href="#url" class="load_more" wire:click="loadMore">
        <i><img src="<?php echo e(asset('assets/be/images/load_ic.svg')); ?>" alt="" /></i>
        <span class="loadSpan">Load
            More</span></a>

            <?php else: ?>
            <p class="text-center text-muted m-2">No More Candidate Matches Found</p>
            <?php endif; ?>
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
        echo '<span>'.$exp.' '.$yrs.' Experience</span>
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

<?php echo $__env->make('inc.saveSearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>


<span class="new-tags">
</span>
<?php $__env->startPush('scripts'); ?>

<script>
$('.blured_txt:not(.image_blur)').each(function(){
       var length= $(this).text().length
         var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var result = Array.from({ length: length }, () => charset.charAt(Math.floor(Math.random() * charset.length))).join('');

       var textLength= $(this).text(result);
    })
    // task - 86a0kdnun
    $('.filter-div .filter-col-box:not(.filter-btn)').addClass('animated-background');
    jQuery(document).ready(function ($) {
        $('.filter-div .filter-col-box:not(.filter-btn)').removeClass('animated-background');
    });
    // task - 86a0kdnun end
    /**
        $('.blured_txt:not(.image_blur)').text('Hidden'); // task - 86a0f55cd
    **/
    document.addEventListener("livewire:load", () => {
        filters();
        saveSearch();

        document.querySelector('#filters-form').onkeypress = function(e) {
            if(e.keyCode == 13) {
                e.preventDefault();
            }
        }

        $(document).on('show.bs.modal', '#saveSearchModal', function(event) {
            $('#save-search-form')[0].reset();
            $('.text-danger').remove();
            $('#search_name_error').html('');
        });
    });

    $("body").delegate(".clear-filter-btn", "click", function (e) { // task - 86a0qfnhg
        window.livewire.find('<?php echo e($_instance->id); ?>').set('is_run', false);
    });

    function filters() {
        $("body").delegate("#filters-form", "submit", function(e, isTrigger = false) {
            $('.inline-table-modal').modal('hide');
            console.log('submit E : ' + e);
            console.log('isTrigger : ' + isTrigger);
            var industries_filter_btn = $('.industries_filter_btn').val();
            var interest_filter_btn = $('.interest_filter_btn').val();
            var hard_skills_filter_btn = $('.hard_skills_filter_btn').val();
            var soft_skills_filter_btn = $('.soft_skills_filter_btn').val();
            var languages_filter_btn = $('.languages_filter_btn').val();
            var distance_filter_btn = $('.distance_filter_btn').val();
            var current_position_filter_btn = $('.current_position_filter_btn2').val();
            // var seeking_position_filter_btn = $('.seeking_position_filter_btn').val(); task - 862k2tf2f
            var schedule_filter_btn = $('.schedule_filter_btn').val();
            var salary_range_filter_btn = $('.salary_range_filter_btn').val();
            var work_environment_filter_btn = $('.work_environment_filter_btn').val();
            var min_range = $('.min-range').val();
            var max_range = $('.max-range ').val();
            var min_distance = $('.min-range-distance').val();
            var max_distance = $('.max-range-distance').val();
            var compensation_filter_btn = $('.compensation_filter_btn ').val();
            var firstSearch = $('.firstSearch ').val();
            var filterDistance = $('#filterDistance').val(); // task - 86a0btjx8
            var filterYearOfExperience = $('#filterYearOfExperience').val(); // task - 86a0btjx8

            $('#running_search').val(1);

            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedIndustries', industries_filter_btn)
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedInterests', interest_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedInterests', interest_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedHardSkills', hard_skills_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedSoftSkills', soft_skills_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedLanguages', languages_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectDistance', distance_filter_btn);
            // window.livewire.find('<?php echo e($_instance->id); ?>').set('selectSeekingPosition', seeking_position_filter_btn); task - 862k2tf2f
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectCurrentPosition', current_position_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectSchedule', schedule_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectSalaryRange', salary_range_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectWorkEnvironment', work_environment_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMinYearOfExperience', min_range);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMaxYearOfExperience', max_range);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMinDistance', min_distance);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMaxDistance', max_distance);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectCompensation', compensation_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('firstSearch', firstSearch);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('is_filtered', true);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('is_submit', true);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('is_save', true);
            if(!isTrigger) { // task - 86a0qfnhg
                window.livewire.find('<?php echo e($_instance->id); ?>').set('is_run', true);
            }
            window.livewire.find('<?php echo e($_instance->id); ?>').set('filterDistance', filterDistance); // task - 86a0btjx8
            window.livewire.find('<?php echo e($_instance->id); ?>').set('filterYearOfExperience', filterYearOfExperience); // task - 86a0btjx8
            $('.sec_head_mn-all ').hide();
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
            $('#overlay').show();
            $('.save-search-btn.shake').css('animation-iteration-count', 'unset'); // task - 862k2tf2f
            Livewire.hook('message.processed', (message, component) => {
                $('.current_position_filter_btn2').val(component.serverMemo.data.selectCurrentPosition);

                console.log('submit');
                // afterLoad($(this));

                setTimeout(function() {
                    // console.log('<?php echo e($firstSearch); ?> - ff');
                    if($('#is_run').val() == '1') {
                        $('.save-search-btn').css('display', 'none'); // task - 862k2tf2f
                        console.log('here .....');
                        $('.hidden-btn-filter').css({'display':'inline-block !important', 'margin-top':'60px'});

                        $('.hidden-btn-filter').attr('style', 'display:inline-block !important;margin-top:60px;');
                        // $('.hidden-btn-filter').css('margin-top', '60px');
                        $('.hidden-btn-filter a.open-save-search-btn').addClass("shake");
                        // $('.clear-filter-btn').removeClass('hide-clr-btn'); ************
                        $('.save-search-btn').addClass("enable-save-btn");
                        $('.sec_head_mn-all ').hide();
                    }
                    // hideClearFilterBtn(false);
                }, 100);

                setTimeout(function () {
                    $(".hidden-btn-filter a.open-save-search-btn").removeClass("shake");

                }, 4000);

            })

            return false;
            e.preventDefault();
        });
    };

    window.addEventListener('loadAfterload', event => {
        console.log('loadAfterload');
        afterLoad($(this));
    });
    // $(document).ready(function() {
    //     $('.load_more').click(function() {
    //         Livewire.emit('loadMore');
    //         Livewire.hook('message.processed', (message, component) => {
    //             afterLoad($(this));
    //         })
    //     });
    // });




    function saveSearch() {

        // $("body").delegate("#save-search-form", "submit", function(e) {
        $(".savesearchbtn").on("click", function(e) {
            // e.preventDefault();
            var search_name = $('.search-name').val();

            if($.trim(search_name) == "") {
                $(this).parents('.modal-content').find('#search_name_error').html('The search name field is required.'); // task - 86a0wte46
                return false;
            }

            var industries_filter_btn = $('.industries_filter_btn').val();
            var interest_filter_btn = $('.interest_filter_btn').val();
            var hard_skills_filter_btn = $('.hard_skills_filter_btn').val();
            var soft_skills_filter_btn = $('.soft_skills_filter_btn').val();
            var languages_filter_btn = $('.languages_filter_btn').val();
            var distance_filter_btn = $('.distance_filter_btn').val();
            var current_position_filter_btn = $('.current_position_filter_btn2').val();
            // var seeking_position_filter_btn = $('.seeking_position_filter_btn').val(); task - 862k2tf2f
            var schedule_filter_btn = $('.schedule_filter_btn').val();
            var salary_range_filter_btn = $('.salary_range_filter_btn').val();
            var work_environment_filter_btn = $('.work_environment_filter_btn').val();
            var min_range = $('.min-range').val();
            var max_range = $('.max-range ').val();
            var min_distance = $('.min-range-distance').val();
            var max_distance = $('.max-range-distance').val();
            var compensation_filter_btn = $('.compensation_filter_btn ').val();

            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedIndustries', industries_filter_btn)
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedInterests', interest_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedInterests', interest_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedHardSkills', hard_skills_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedSoftSkills', soft_skills_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectedLanguages', languages_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectDistance', distance_filter_btn);
            // window.livewire.find('<?php echo e($_instance->id); ?>').set('selectSeekingPosition', seeking_position_filter_btn); task - 862k2tf2f
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectCurrentPosition', current_position_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectSchedule', schedule_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectSalaryRange', salary_range_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectWorkEnvironment', work_environment_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMinYearOfExperience', min_range);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMaxYearOfExperience', max_range);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMinDistance', min_distance);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMaxDistance', max_distance);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectCompensation', compensation_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('search_name', search_name);

            if(search_name) { $('.btn-close').trigger('click'); } // task - 86a0wte46
            Livewire.hook('message.processed', (message, component) => {
                $('.current_position_filter_btn2').val(component.serverMemo.data.selectCurrentPosition);
                // $('.current_position_filter_btn').html('<option val=' + current_position_filter_btn + ' selected=true>' + current_position_filter_btn + '</option>');
                // $('.seeking_position_filter_btn').html('<option val=' + seeking_position_filter_btn + ' selected=true>' + seeking_position_filter_btn + '</option>'); task - 862k2tf2f
                $('.search-name').val('');
                console.log('save-search-form');
                // afterLoad($(this));

            })
            // return false;
        });
    };
</script>



<script>
    $(".prev-btn").click(function(e) {
        e.preventDefault();
        // location.replace('/candidate/personal-information')
        window.location.href='<?php echo e(url("/candidate/personal-information")); ?>';
    })
    $(".nxt-btn").click(function(e) {
        e.preventDefault();
        // location.replace('/candidate/education-employment')
        window.location.href='<?php echo e(url("/candidate/education-employment")); ?>';

    })
</script>

<script>
    window.addEventListener('close-search', event => {
        $('#saveSearchModal').modal('hide');
        $('body, html').removeClass('sidebar_show');
        $('body').addClass('sidebar_extended'); // task - 86a0qvtc0
    })


    window.addEventListener('openSaveSearchPopUp', event => {
        $('.firstSearch ').val();
        setTimeout(function() {
        $('#saveSearchModal').modal('show');

        },1000)

     })
</script>

<script>
    window.addEventListener('close-notes', event => {
        $('#notesModal').modal('hide');
        // $('#exampleModalToggle2').modal('show');
    })
</script>



<script>
    // active sort tab

    var activeTab = "_";
    $("body").delegate(".list_grid_wrapper li", "click", function(e) {
        /*var _target = $(this).find('button').attr('data-target');
        var _EL = _target.split("-");*/

        var type = $(this).attr('data-type');
        activeTab = $(this).attr('class');
        activeTab = activeTab.split(" ");
        activeTab = activeTab[0];
        console.log(activeTab);
        /*window.livewire.find('<?php echo e($_instance->id); ?>').set('active_tab', _EL[1]); // task - 86a0b69ev
        Livewire.hook('message.processed', (message, component) => {
            afterLoad($(this));
        });*/
    });


    $("body").delegate(".close", "click", function(e) {
        $('.modal').modal('hide');
    })

    document.addEventListener("livewire:load", () => {
        $(document).on('click', '#change_order', function(event) {
            // $('.clear-filter-btn').addClass('hide-clr-btn'); // Task 86a0jvgw4
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
            $('#overlay').show();
            window.livewire.find('<?php echo e($_instance->id); ?>').set('count', 6);
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
                hideClearFilterBtn(false); // Task 86a0jvgw4
                // afterLoad($(this));
            })
        });

        $("body").delegate(".sort-tab", "click", function(e) {
            // $('.clear-filter-btn').addClass('hide-clr-btn'); // Task 86a0jvgw4
            $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
            $('#overlay').show();
            var type = $(this).attr('data-type');
            window.livewire.find('<?php echo e($_instance->id); ?>').set('sortBy', type);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('count', 6);
            if(!window.livewire.find('<?php echo e($_instance->id); ?>').get('is_filtered')) window.livewire.find('<?php echo e($_instance->id); ?>').set('is_filtered', true);
            if(type == "newest") {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('sort_order', 'DESC');
                window.livewire.find('<?php echo e($_instance->id); ?>').set('sort_icon', 'down-icon.svg');
            }

            Livewire.hook('message.processed', (message, component) => {
                $('.current_position_filter_btn2').val(component.serverMemo.data.selectCurrentPosition);
                // $('.current_position_filter_btn').html('<option val=' + component.serverMemo.data.selectCurrentPosition + ' selected=true>' + component.serverMemo.data.selectCurrentPosition + '</option>');
                console.log('sort');
                hideClearFilterBtn(false); // Task 86a0jvgw4
                // afterLoad($(this));
            })
        })
    })
    document.addEventListener("livewire:load", () => {
            /*$("body").delegate(".manual_add_saved_serach", "click", function(e) {
                Livewire.hook('message.processed', (message, component) => {
                    afterLoad($(this));
                })
            })*/
        })

    function afterLoad() {
        var html = " <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js'><\/script><script src='<?php echo e(asset('assets/be/js/filters.js')); ?>'><\/script>";
        $('.filter-out').html(html);
        $('.' + activeTab).trigger('click');
        // let flag = window.livewire.find('<?php echo e($_instance->id); ?>').get('is_filtered');
        let flag = window.livewire.find('<?php echo e($_instance->id); ?>').get('is_submit');

        $('.filter-col-box').parent('div').css('opacity', '0.7');
        let prefilled_tags = $('.current_position_filter_btn2').val();
        setTimeout(function() {
            var html2 = '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js" integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw==" crossorigin="anonymous" referrerpolicy="no-referrer">'+
                '<\/script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />' +
            '<div class="col- filter-col-box form-group position-input ">' +
                '<input class="current_position_filter_btn2 form-control js-select2" data-role="tagsinput" value="'+prefilled_tags+'" placeholder="Current Position/Title"/>' +
            '</div>';

            $('.tag-input-field').html(html2);

            setTimeout(function() {
                $('body').removeAttr('style');
                $('#overlay').hide();
                // $('.hidden-btn-filter').css('margin-top', '60px');
            }, 50);
            setTimeout(function () {
                $(".hidden-btn-filter a.open-save-search-btn").removeClass("shake");
            }, 4000);

            $('.' + activeTab).trigger('click');
        }, 80);

        /* test : setTimeout(function() {
            if(flag === false) {
                $('.save-search-btn').css('display', 'inline-flex'); // task - 862k2tf2f
                $('.hidden-btn-filter').removeAttr('style');
            } else {
                $('.save-search-btn').css('display', 'none'); // task - 862k2tf2f
                $('.hidden-btn-filter').attr('style', 'display:inline-block !important;margin-top:60px;');
                $('.hidden-btn-filter a.open-save-search-btn').addClass("shake");
                $('.clear-filter-btn').removeClass('hide-clr-btn');
$('.save-search-btn').addClass("enable-save-btn");
            }
        }, 250);*/

        setTimeout(function() {
            $('.js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)').each(function() {
                // console.log('select2', $(this));
                if( $(this).val()[0]=='null'){
                    $(this).val('').trigger('change', true);
                    // $(this).html('');
                } else {
                    $(this).val($(this).val()).trigger('change', true);
                }
                $('.' + activeTab).trigger('click');
            })
            $('.max-range').val($('.max-range').val()).trigger('input', true);
            $('.min-range').val($('.min-range').val()).trigger('input', true);

            $('.min-range-distance').val($('.min-range-distance').val()).trigger('input', true);
            $('.max-range-distance').val($('.max-range-distance').val()).trigger('input', true);

            $('.' + activeTab).trigger('click');

            /*if(flag === false) {
                $('.save-search-btn').css('display', 'inline-flex'); // task - 862k2tf2f
                $('.hidden-btn-filter').removeAttr('style');
            } else {
                $('.save-search-btn').css('display', 'none'); // task - 862k2tf2f
                $('.hidden-btn-filter').attr('style', 'display:inline-block !important;margin-top:60px;');
                $('.hidden-btn-filter a.open-save-search-btn').addClass("shake");
                $('.clear-filter-btn').removeClass('hide-clr-btn');
                $('.save-search-btn').addClass("enable-save-btn");
            }*/

            hideClearFilterBtn(false); // Task 86a0jvgw4
            $('.filter-col-box').parent('div').css('opacity', '1');

            $('.filter-div .filter-col-box:not(.filter-btn)').removeClass('animated-background'); // task - 86a0kdnun
        }, 100);
    }



    window.addEventListener('closeSecondaryModal', event => {

        $("#notesModal").modal("hide");

    });


$(document).ready(function() {
    $(document).on("click", function(e) {
        if (!$('.inline-table-modal').is(e.target) && $('.inline-table-modal').has(e.target).length === 0) {
            // Click occurred outside the modal, so close it
            $(".inline-table-modal").modal("hide");
        }
    });
});




    // task - 86a10bj8u
    window.addEventListener('close-request-modal', event => {
        $('#send-request-modal .request_message').html('REQUEST SUBMITTED');
        setTimeout(function() {
            $('#send-request-modal .request_message').html('');
            $('#send-request-modal form')[0].reset();
            $('#send-request-modal').modal('hide');
            $('#send-request-modal').removeClass('show');
            $('#send-request-modal').hide();
        }, 1500);
    });
    // task - 86a10bj8u end

    window.addEventListener('enableBody', event => {
        $('body').removeAttr('style');
        $('.inline-table-modal').modal('hide');
        $('#overlay').hide();
    });

    window.addEventListener('blockBody', event => {
        $('#overlay').show();
        $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');
    })

document.addEventListener("livewire:load", (e) => {

    $(window).scroll(function() {
        var scrollCount=0;
        // if($(document).height()-$(window).scrollTop() + $(window).height()>1925) {
        if (((window.innerHeight + Math.round(window.scrollY))+100 >= document.body.offsetHeight) && ($('.listgrid_cnt.active > .load_more').length)) {
                $('.load_more').html('<span class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true" style="margin-right:10px;"></span><span class="loadSpan">Loading...</span></a>')
            // Trigger a Livewire function
            scrollCount++;
            if(scrollCount==1){
                $('.' + activeTab).trigger('click');
                /*$('#overlay').show();
                $('body').attr('style', 'opacity: 0.7;pointer-events: none;position: absolute;');*/
                $('.inline-table-modal').modal('hide');
                livewire.emit('loadMore');
            }
            scrollCount=0;
            Livewire.hook('message.processed', (message, component) => {
                $('.' + activeTab).trigger('click');
                scrollCount=0;
                // console.log('load more');
                // afterLoad($(this));
            })


        }
    });
});




// document.addEventListener("livewire:load", () => {

// $("body").delegate(".candidate_grid_ppl_wppt,.listview_candidate_details,req_mask_btn", "click", function (e) {
// var url = $(this).attr("data-url");
// var lastSegment = url.split('/').pop();
// $('.right-arrow').attr('data-id',lastSegment)
// $('.right-arrow').attr('data-id',lastSegment)
// if (!$(e.target).is('.clickd_tgl_searches svg, .clickd_tgl_searches circle,.eyeBall,.eyeBall img,.clickd_tgl_searches_open,.clickd_tgl_searches_open label,.clickd_tgl_searches_open h5,.clickd_tgl_searches_open input,.clickd_tgl_searches_open span,.candidate_grid_ppl_icn a,.candidate_grid_ppl_icn svg,.candidate_grid_ppl_icn path,.req_mask_btn,.req_mask_btn i,.req_mask_btn img,.req_mask_btn .req_mask_btn_rtt,.modal.show div,.modal.show button,.modal.show form,.modal.show input,.modal.show label,.modal.show textarea')) {
// $('.cpi').attr('src',url);
// // $('#exampleModalToggle2').modal('show')
// }
// })

// })



</script>

<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/app/resources/views/livewire/company-dashboard.blade.php ENDPATH**/ ?>