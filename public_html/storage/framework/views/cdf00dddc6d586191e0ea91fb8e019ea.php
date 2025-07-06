<div>
    <div class="mid-contain">
        <div class="container-fluid">
            <div class="main-body">
                <div class="main-body-upper">
                    <div class="add_searches_home">
                        <div class="row add_searches_home_row">
                            <div class="col-lg-6 add_searches_home_col_lft">
                                <div class="sec_head_mn">
                                    <h2>Saved Searches</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 add_searches_home_col_rtt">
                                <a href="#url" class="add_search_vbtn"><span><i class="ic11"><img src="<?php echo e(asset('assets/be/images/search_ic1.png')); ?>" alt=""></i>Add
                                        Search</span><i class="ic12">+</i></a>
                            </div>
                        </div>
                    </div>

                    <div class="saved_searches_accountant">
                        <?php $__currentLoopData = $savedSearches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $searches): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="saved_searches_accountant_outr">
                            <div class="saved_sc_accountant_outr_top">
                                <div class="saved_sc_accountant_outr_top_row row">
                                    <div class="col-lg-6 saved_sc_accountant_outr_top_col_lft">
                                        <a href="<?php echo e(url('/company/saved-search/')); ?>/<?php echo e($searches['search']->slug); ?>">
                                            <h4><?php echo e($searches['search']->name); ?></h4>
                                        </a>
                                    </div>

                                    <div class="col-lg-6 saved_sc_accountant_outr_top_col_rght">
                                        <div class="dowpdown_click_bts">
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="<?php echo e(asset('assets/be/images/toggle_ic.svg')); ?>" alt="">
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="icon"><img src="<?php echo e(asset('assets/be/images/search_e_ico.svg')); ?>" alt=""></i>Edit Search
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#" wire:click.prevent="deleteSearch(<?php echo e($searches['search']->id); ?>)">
                                                        <i class="icon"><img src="<?php echo e(asset('assets/be/images/search_e_ico2.svg')); ?>" alt=""></i>Archive Search
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="saved_sc_accountant_outr_mdll">
                                <div class="row saved_sc_accountant_outr_mdll_row">
                                    <div class="col-lg-6 saved_sc_accountant_outr_mdll_col_lft">
                                        <div class="candidate_numners_list">
                                            <span class="candidate_numners_list1"><?php echo e($searches['candidates_new_count']); ?></span>
                                            <div class="candidate_numners_list1_rt">
                                                <h6>New Candidates</h6>
                                                <span class="total_match_nm"><?php echo e($searches['search']->old_match_count); ?> Total Matches</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 saved_sc_accountant_outr_mdll_col_rt">
                                        <div class="all_candidates_igs_sc">
                                            <?php $__currentLoopData = $searches['candidates_profile_image_path']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img_path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($img_path): ?>
                                            <figure class="maind_img"><img src="<?php echo e(asset($img_path)); ?>" alt="">
                                            </figure>
                                            <?php else: ?>
                                            <figure class="maind_img"><img src="<?php echo e(asset('assets/be/images/searches_im2.png')); ?>" alt="">
                                            </figure>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <a href="#url" class="extra_add_pl">+</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="saved_sc_accountant_outr_bttm">
                                <span class="date_ctt">Date created: <?php echo e($searches['search']->created_at->format('m-d-Y')); ?></span>
                            </div>


                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="main-body-footer">
                    <div class="footer-para new">
                        <p><a href="index.html">© 2022 Purple Stairs</a>Website by <a href="https://www.brand-right.com/" target="_blank" class="brand">
                                BrandRight Marketing Group</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade searches_modal_wrapper" id="searches_modal" tabindex="-1" role="dialog" aria-label="searches_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="searches_modal_wrapper_head">
                        <div class="row searches_modal_wrapper_head_row">
                            <div class="col-lg-6 searches_modal_wrapper_head_cl_lft">
                                <div class="pay_heading_cmn">
                                    <h4>Edit Search</h4>
                                </div>
                            </div>

                            <div class="col-lg-6 searches_modal_wrapper_head_cl_rt">
                                <p>Search created: 2/10/22</p>
                            </div>
                        </div>
                    </div>

                    <div class="searches_modal_wrapper_input">
                        <div class="search_short_head">
                            <h5>Search Name</h5>
                        </div>
                        <input type="text" placeholder="Junior Accountant non CPA">
                    </div>

                    <div class="searches_modal_wrapper_filters">
                        <div class="search_short_head">
                            <h5>Edit Filters</h5>
                        </div>
                        <div class="select_dropdown_list_otr gap_cmn_btm">
                            <ul class="select_dropdown_list">
                                <li class="dropdown-active">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton71" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="for-not-active">Fields of Interest</span>
                                            <span class="for-active">: HealthCare</span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton71">
                                            <li><a class="dropdown-item" href="#">HealthCare</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton72" data-bs-toggle="dropdown" aria-expanded="false">
                                            Distance
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton72">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton73" data-bs-toggle="dropdown" aria-expanded="false">
                                            Current Position/Title
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton73">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton75" data-bs-toggle="dropdown" aria-expanded="false">
                                            Position/Title Seeking
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton75">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton76" data-bs-toggle="dropdown" aria-expanded="false">
                                            Soft Skills
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton76">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton77" data-bs-toggle="dropdown" aria-expanded="false">
                                            Schedule
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton77">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton78" data-bs-toggle="dropdown" aria-expanded="false">
                                            Salary Range
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton78">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton79" data-bs-toggle="dropdown" aria-expanded="false">
                                            Hard Skills
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton79">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton80" data-bs-toggle="dropdown" aria-expanded="false">
                                            Work Environment
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton80">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton81" data-bs-toggle="dropdown" aria-expanded="false">
                                            Years of Experience
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton81">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton82" data-bs-toggle="dropdown" aria-expanded="false">
                                            Languages
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton82">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton83" data-bs-toggle="dropdown" aria-expanded="false">
                                            College Name
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton83">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton84" data-bs-toggle="dropdown" aria-expanded="false">
                                            Ideal Benefits
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton84">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton85" data-bs-toggle="dropdown" aria-expanded="false">
                                            Compensation
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton85">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>


                        </div>

                    </div>

                    <div class="searches_modal_update_srchhs">
                        <div>
                            <a href="#url" class="search_arc_btn"><i><img src="<?php echo e(asset('assets/be/images/search_ac_img.svg')); ?>" alt=""></i>Archive Search</a>
                        </div>

                        <div>
                            <a href="#url" class="search_arc_btn2">Update Search</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/livewire/saved-searches.blade.php ENDPATH**/ ?>