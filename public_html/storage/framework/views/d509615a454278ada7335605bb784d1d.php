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
                    <div class="add_searches_home">
                        <div class="row add_searches_home_row">
                            <div class="col-lg-6 add_searches_home_col_lft">
                                <div class="sec_head_mn">
                                    <h2>Archived Searches</h2>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6 add_searches_home_col_rtt">
                                <a href="#url" class="add_search_vbtn"><span><i class="ic11"><img src="<?php echo e(asset('assets/be/images/search_ic1.png')); ?>" alt=""></i>Add
                                        Search</span><i class="ic12">+</i></a>
                            </div> -->
                        </div>
                    </div>

                    <div class="saved_searches_accountant">
                        <?php $__currentLoopData = $archivedSearches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $searches): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="saved_searches_accountant_outr" data-url="<?php echo e(url('/company/archived-search/')); ?>/<?php echo e($searches['search']->slug); ?>">
                            <div class="saved_sc_accountant_outr_top">
                                <div class="saved_sc_accountant_outr_top_row row">
                                    <div class="col-lg-6 saved_sc_accountant_outr_top_col_lft">
                                        <a href="<?php echo e(url('/company/archived-search/')); ?>/<?php echo e($searches['search']->slug); ?>">
                                            <h4><?php echo e($searches['search']->name); ?></h4>
                                        </a>
                                    </div>

                                    <div class="col-lg-6 saved_sc_accountant_outr_top_col_rght">
                                        <div class="dowpdown_click_bts">
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="<?php echo e(asset('assets/be/images/toggle_ic.svg')); ?>" alt="">
                                            </button>
                                            <ul class="dropdown-menu">
                                                <!-- <li>
                                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#edit-search<?php echo e($searches['search']->id); ?>">
                                                        <i class="icon"><img src="<?php echo e(asset('assets/be/images/search_e_ico.svg')); ?>" alt=""></i>Edit Search
                                                    </a>
                                                </li> -->
                                                <li>
                                                    <a class="dropdown-item" href="#" wire:click.prevent="unArchiveSearch(<?php echo e($searches['search']->id); ?>)">
                                                        <i class="icon"><img src="<?php echo e(asset('assets/be/images/search_e_ico2.svg')); ?>" alt=""></i>Unarchive Search
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
                                            <span class="candidate_numners_list1"><?php echo e($searches['new_candidate']); ?></span>
                                            <div class="candidate_numners_list1_rt">
                                                <h6>New Candidates</h6>
                                                <span class="total_match_nm"><?php echo e($searches['all_matches']); ?> Total Matches</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 saved_sc_accountant_outr_mdll_col_rt">
                                    <div class="all_candidates_igs_sc">
                                            <?php $__currentLoopData = $searches['candidates_profile_image_path']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $img_path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($key < 15): ?>
                                                <?php if($img_path['profile_photo_path']): ?>
                                                    <figure class="maind_img">
                                                    <?php if(!empty($img_path->companyStatus()->first()->pivot->status)): ?>
                                                        <?php if($img_path->companyStatus()->first()->pivot->status==1): ?>
                                                            <img src="<?php echo e(asset($img_path['profile_photo_path'])); ?>" alt="">
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('assets/be/images/searches_im2.png')); ?>" alt="">
                                                    <?php endif; ?>
                                                    </figure>
                                                <?php else: ?>
                                                    <figure class="maind_img"><img src="<?php echo e(asset('assets/be/images/searches_im2.png')); ?>" alt="">
                                                    </figure>
                                                <?php endif; ?>
                                                
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(count($searches['candidates_profile_image_path'])>15): ?>
                                            <a href="#url" class="extra_add_pl">+</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="saved_sc_accountant_outr_bttm">
                                <span class="date_ctt">Date created: <?php echo e($searches['search']->created_at->format('m-d-Y')); ?></span>
                            </div>


                        </div>

                        <!-- Modal -->
                        <div class="modal fade edit-search" id="edit-search<?php echo e($searches['search']->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <form wire:submit.prevent="saveSearch()">
                                        <div class="modal-body">
                                            <div class="row">
                                                <p><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button></p>
                                                <h3 class="search-pop-h mb-3">Edit Search <span class="float-right time-search">Search created: <?php echo e($searches['search']->created_at->format('m/d/Y')); ?></span></h3>
                                            </div>
                                            <div class="gl-frm-outr">
                                                <label class="mb-2">Search Name</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control edit-search-name" value="<?php echo e($searches['search']->name); ?>">
                                                </div>
                                            </div>
                                            <input type="hidden" class="search_id" value="<?php echo e($searches['search']->id); ?>">
                                            <?php
                                            $field=json_decode($searches['search']->search_fields);
                                            ?>
                                            <?php echo $__env->make('inc.updateSearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>

                                        <div class="modal-footer- py-5 px-3">
                                            <button type="button" class="btn btn-secondary float-left archive-btn" wire:click.prevent="unArchiveSearch(<?php echo e($searches['search']->id); ?>)">Unarchive Search</button>
                                            <button type="submit" class="btn btn-primary float-right search-update-btn">Update Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="main-body-footer">
                    <div class="footer-para new">
                        <p><span class="copyrite-text">© 2023 Purple Stairs</span>Website by <a href="https://www.brand-right.com/" target="_blank" class="brand">
                                BrandRight Marketing Group</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span class="filter-out">
        <!-- <script src="<?php echo e(asset('assets/be/js/filters.js')); ?>"></script> -->
    </span>

</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<script>
    $('#edit-search,.edit-search').on('shown.bs.modal', function(e) {
        afterLoad($(this));
    })

    function afterLoad() {
        var html = " <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js'><\/script><script src='<?php echo e(asset('assets/be/js/filters.js')); ?>'><\/script>";
        $('.filter-out').html(html)
        setTimeout(function() {
            $('.js-select2').each(function() {

                $(this).val($(this).val()).trigger('change');

            })
            $('.max-range').val($('.max-range').val()).trigger('input');
            $('.min-range').val($('.min-range').val()).trigger('input');
        }, 100);

    }
    document.addEventListener("livewire:load", () => {
        saveSearch();

    })

    function saveSearch() {

        $("body").delegate(".search-update-btn", "click", function(e) {

            var search_name = $(this).parents('.modal-content').find('.edit-search-name').val();
            var search_id = $(this).parents('.modal-content').find('.search_id').val();
            var industries_filter_btn = $('.industries_filter_btn').val();
            var interest_filter_btn = $('.interest_filter_btn').val();
            var hard_skills_filter_btn = $('.hard_skills_filter_btn').val();
            var soft_skills_filter_btn = $('.soft_skills_filter_btn').val();
            var languages_filter_btn = $('.languages_filter_btn').val();
            var distance_filter_btn = $('.distance_filter_btn').val();
            var current_position_filter_btn = $('.current_position_filter_btn').val();
            var seeking_position_filter_btn = $('.seeking_position_filter_btn').val();
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
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectSeekingPosition', seeking_position_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectCurrentPosition', current_position_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectSchedule', schedule_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectSalaryRange', salary_range_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectWorkEnvironment', work_environment_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMinYearOfExperience', min_range);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMaxYearOfExperience', max_range);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMinDistance', min_distance);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMaxDistance', max_distance);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectMaxYearOfExperience', max_range);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('selectCompensation', compensation_filter_btn);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('search_name', search_name);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('search_id', search_id);




            Livewire.hook('message.processed', (message, component) => {
                afterLoad($(this));

            })
            // return false;
            // e.preventDefault();
        });
    };

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
<?php /**PATH /var/www/html/app/resources/views/livewire/archived-searches.blade.php ENDPATH**/ ?>