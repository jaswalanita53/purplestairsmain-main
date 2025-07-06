<div class="modal not_in_searches fade" id="exampleModalToggle2" aria-hidden="true"
aria-label="exampleModalToggleLabel2" tabindex="-1" wire:ignore.self>
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <?php if($candidateProfile): ?>
    <div class="modal-content">
        <div class="modal-body">
            <div class="not_in_searches_wrap">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="not_searches_slider_ptt">
                    <div>
                        <div class="not_in_searches_wrap_edit">
                            <ul>
                                <li>
                                    <div class="not_in_searches_wrap_edit_ancc">
                                        <a onclick="OpenNotes()" href="javascript:void(0)"
                                            class="edit_ico_note clickd_tgl_searches"><img
                                                src="<?php echo e(asset('assets/be/images/edited.svg')); ?>" alt="" /></a>
                                        <div class="edit_ico_note_inner clickd_tgl_searches_open">
                                            <form wire:submit.prevent="saveNote()">
                                                <div class="edit_ico_note_inner_note">
                                                    <div class="edit_ico_note_inner_note_top">
                                                        <textarea placeholder="Note Here" wire:model.lazy="note"></textarea>
                                                    </div>

                                                    <div class="edit_ico_note_inner_note_btm">
                                                        <a href="#url" class="emoji_btn"><img
                                                                src="<?php echo e(asset('assets/be/images/emoji.png')); ?>" alt="" /></a>
                                                        <button type="submit" class="submit_ott">
                                                            <img src="<?php echo e(asset('assets/be/images/send_white.svg')); ?>"
                                                                alt="" />
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="candidate_grid_ppl_icn">
                                        <a href="#url" class="clickd_tgl_searches">+</a>
                                        <div class="clickd_tgl_searches_open">
                                            <div class="clickd_tgl_searches_open_head">
                                                <h5>Saved Searches</h5>
                                            </div>
                                            <div class="clickd_tgl_searches_open_ul">
                                                <div class="form_input_check">
                                                    <?php $__currentLoopData = $saved_searches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $is_checked = in_array($view_id, $search->candidate_ids) ? 1 : 0; ?>
                                                        <label>
                                                            <input type="checkbox" 
                                                                class="manual_add_saved_serach" 
                                                                data-search-id="<?php echo e($search->id); ?>" 
                                                                data-candidate="<?php echo e($view_id); ?>" 
                                                                wire:click="changeEvent('<?php echo e($is_checked); ?>', '<?php echo e($search->id); ?>','<?php echo e($view_id); ?>')" 
                                                                <?php echo e($is_checked ? 'checked' : ''); ?> 
                                                            />
                                                            <span><?php echo e($search->name); ?></span>
                                                        </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="not_in_searches_prfl">
                            <figure class="main_img">
                                <?php if($candidateProfile->companyStatus->first()): ?>
                                <?php if($candidateProfile->companyStatus->first()->pivot->status == 0): ?>
                                <img src="<?php echo e(asset('assets/be/images/masked_ic.png')); ?>" alt="" />
                                <?php else: ?>
                                <img src="<?php echo e(asset('assets/fe/images/ma2.svg')); ?>" alt="" />
                                <?php endif; ?>
                                <?php else: ?>
                                <img src="<?php echo e(asset('assets/be/images/masked_ic.png')); ?>" alt="" />
                                <?php endif; ?>
                            </figure>
                            <div class="not_in_searches_prfl_rtt">
                                <div class="top_search_profile_dmm">
                                    <div class="row top_search_profile_dmm_row">
                                        <div class="col-lg-8 top_search_profile_dmm_col_lft">
                                            <div class="name_essn_head">
                                                <h4><?php echo e($candidateProfile->name); ?></h4>
                                                <ul class="social_ul">
                                                    <li>
                                                        <a href="#url"><img src="<?php echo e(asset('assets/be/images/linkedin.svg')); ?>"
                                                                alt="" /></a>
                                                    </li>
                                                    <li>
                                                        <a href="#url"><img src="<?php echo e(asset('assets/be/images/website.svg')); ?>"
                                                                alt="" /></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <span class="posn_crn">Current Position: <?php echo e($candidateProfile->personal->current_title); ?></span>
                                            <div class="industries_build_wrap">
                                                <h6>Industries:</h6>
                                                <div class="industries_build_wrap_rtt">
                                                    <ul>
                                                        <?php $__currentLoopData = $candidateProfile->industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <span class="inus_inner_dtls"><?php echo e($industry->name); ?></span>
                                                        </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="industries_build_wrap">
                                                <h6>Area of Interest:</h6>
                                                <div class="industries_build_wrap_rtt">
                                                    <ul>
                                                        <?php $__currentLoopData = $candidateProfile->interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <span class="inus_inner_dtls"><?php echo e($interest->name); ?></span>
                                                        </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 top_search_profile_dmm_col_rght">
                                            <ul>
                                                <li>
                                                    <a href="<?php echo e(route('company.candidateprofile',$candidateProfile->id)); ?>" class="vtbnd">View Full Profile</a>
                                                </li>
                                                <li>
                                                    <?php if($candidateProfile->companyStatus->first()): ?>
                                                    <?php if($candidateProfile->companyStatus->first()->pivot->status == 0): ?>
                                                    <a href="#url" class="vtbnd ylw">Pending</a>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <a href="#url" class="vtbnd ylw" wire:click.prevent="sendRequest(<?php echo e($candidateProfile->id); ?>)">Request Unmask</a>
                                                    <?php endif; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="btm_search_profile_dmm">
                                    <ul>
                                        <li>
                                            <h6>Location:</h6>
                                            <p><?php echo e($candidateProfile->personal->address); ?>,&nbsp;<?php echo e($candidateProfile->personal->state_abbr); ?></p>
                                        </li>
                                        <li>
                                            <h6>Asking Salary:</h6>
                                            <p><?php echo e($candidateProfile->personal->salary_range); ?></p>
                                        </li>
                                        <li>
                                            <h6>Hours:</h6>
                                            <?php if($candidateProfile->personal->schedule_full_time): ?>
                                            <p>Full Time</p>
                                            <?php endif; ?>
                                            <?php if($candidateProfile->personal->schedule_part_time): ?>
                                            <p>Part Time</p>
                                            <?php endif; ?>
                                            <?php if($candidateProfile->personal->schedule_no_preference): ?>
                                            <p>No Preference</p>
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            <h6>Open to:</h6>
                                            <div class="open_to_demos">
                                                <?php if($candidateProfile->personal->work_environment_remote): ?>
                                                <span class="open_to_demos_in">Remote</span>
                                                <?php endif; ?>
                                                <?php if($candidateProfile->personal->work_environment_hybrid): ?>
                                                <span class="open_to_demos_in">Hybrid</span>
                                                <?php endif; ?>
                                                <?php if($candidateProfile->personal->work_environment_in_office): ?>
                                                <span class="open_to_demos_in">Inoffice</span>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="not_in_searches_wrap_skills">
                            <div class="row not_in_searches_wrap_skills_row gx-lg-5">
                                <div class="col-lg-4 not_in_searches_wrap_skills_col">
                                    <div class="skills_require_innner prpl">
                                        <h3>hard skills</h3>
                                        <div class="skills_require_innner_ul">
                                            <?php $__currentLoopData = $candidateProfile->hardSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hard_skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="skills_require_innner_li"><?php echo e($hard_skill->name); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 not_in_searches_wrap_skills_col">
                                    <div class="skills_require_innner lt_bl">
                                        <h3>soft skills</h3>
                                        <div class="skills_require_innner_ul">
                                            <?php $__currentLoopData = $candidateProfile->softSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soft_skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="skills_require_innner_li"><?php echo e($soft_skill->name); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 not_in_searches_wrap_skills_col">
                                    <div class="skills_require_innner drk_bl">
                                        <h3>Languages</h3>
                                        <div class="skills_require_innner_ul">
                                            <?php $__currentLoopData = $candidateProfile->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="skills_require_innner_li"><?php echo e($language->name); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="not_in_searches_prfl_job_attr">
                            <h3>Ideal Job Attributes:</h3>
                            <div class="not_in_searches_prfl_job_attr_ul">
                                <?php if($candidateProfile->personal->prefered_benefits_insurance_benefits): ?>
                                <span class="not_in_searches_prfl_job_attr_li">Insurance Benefits</span>
                                <?php endif; ?>
                                <?php if($candidateProfile->personal->prefered_benefits_padi_holidays): ?>
                                <span class="not_in_searches_prfl_job_attr_li">Paid Holidays</span>
                                <?php endif; ?>
                                <?php if($candidateProfile->personal->prefered_benefits_paid_vacation_days): ?>
                                <span class="not_in_searches_prfl_job_attr_li">Paid Vacation Days</span>
                                <?php endif; ?>
                                <?php if($candidateProfile->personal->prefered_benefits_professional_environment): ?>
                                <span class="not_in_searches_prfl_job_attr_li">Official Environment</span>
                                <?php endif; ?>
                                <?php if($candidateProfile->personal->prefered_benefits_casual_environment): ?>
                                <span class="not_in_searches_prfl_job_attr_li">Casual Environment</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
</div>

<div class="modal fade" id="notesModal" aria-hidden="true"
aria-label="notesModal" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <div class="not_in_searches_wrap">
                    <form wire:submit.prevent="saveNote()">
                        <div class="modal-note">
                            <div class="form-group">
                                <label>Add Note</label>
                                <textarea wire:model.lazy="note"></textarea>
                            </div>
                            <div class="form-submit-btn mb-0 mt-3">
                                <input type="submit" value="Add" class="submit-btn" wire:loading.remove wire:target="saveNote">
                                <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="saveNote">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function OpenNotes() {
    // $('#exampleModalToggle2').modal('hide');
    // $('#notesModal').modal('show');
}
</script><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/inc/candidateProfile.blade.php ENDPATH**/ ?>