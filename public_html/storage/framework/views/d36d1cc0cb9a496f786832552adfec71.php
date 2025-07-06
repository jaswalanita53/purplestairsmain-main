<?php if(!empty($field)): ?>

<div class="d-flex flex-wrap filter-row">
    <!-- <div class="col-  filter-col-box">
        <select class="js-select2 current_position_filter_btn" multiple="multiple">

            <?php if(!empty($field->selectCurrentPosition)): ?>
            <option value="<?php echo e($field->selectCurrentPosition[0]); ?>" class="industries_checkbox" selected=true> <?php echo e($field->selectCurrentPosition[0]); ?></option>
            <?php endif; ?>
        </select>
    </div> -->

    <div class="col- filter-col-box tag-input-field">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js" integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <div class="col- filter-col-box form-group position-input">
            <input class="js-select2 current_position_filter_btn2 form-control" data-role="tagsinput" placeholder="Current Position/Title" value="<?php echo e((is_array($field->selectCurrentPosition)) ? implode(',', $field->selectCurrentPosition) : $field->selectCurrentPosition); ?>" />
        </div>
    </div>

    <div class="col- filter-col-box">
        <div class="dropdown">
            <button class=" filter-btn m-0 select2-selection__rendered dd_year_of_exp w-100 text-left" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                Yrs of exp
            </button>
            <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButtonInd">
                <div class="row m-0 p-2">
                    
                    <div class="col-6">
                        <h5>Years of experience</h5>

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
                            <input type="range"  value="<?php echo e($field->selectMinYearOfExperience); ?>" max="40" min="0" step="1" oninput="
                                                        this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                                        let value = (this.value/parseInt(this.max))*100
                                                        var children = this.parentNode.childNodes[1].childNodes;
                                                        children[1].style.width=value+'%';
                                                        children[5].style.left=value+'%';
                                                        children[7].style.left=value+'%';children[11].style.left=value+'%';
                                                        children[11].childNodes[1].innerHTML=this.value;" class="min-range " />

                            <input type="range" value="<?php echo e($field->selectMaxYearOfExperience); ?>" max="40" min="0" step="1" oninput="
                                                        this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                                                        let value = (this.value/parseInt(this.max))*100
                                                        var children = this.parentNode.childNodes[1].childNodes;
                                                        children[3].style.width=(100-value)+'%';
                                                        children[5].style.right=(100-value)+'%';
                                                        children[9].style.left=value+'%';children[13].style.left=value+'%';
                                                        children[13].childNodes[1].innerHTML=this.value;" class="max-range " />
                        </div>
                    </div>
                    <div class="col-6 float-right"><a href="jasvascript:void(0)" class="float-right cut-range">x</a></div>
                </div>
            </ul>
        </div>
    </div>

    <!-- <div class="col-  filter-col-box">

        <select class="js-select2 seeking_position_filter_btn" multiple="multiple">

        </select>
    </div> -->

    <div class="col-   filter-col-box">
        <select class="js-select2 salary_range_filter_btn" multiple="multiple">
            <?php $__currentLoopData = $all_salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <option value="<?php echo e($key); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($salary); ?>" class="industries_checkbox" <?php if(!empty($field->selectSalaryRange)): ?> <?php if(in_array($key,$field->selectSalaryRange)): ?> selected=true <?php endif; ?> <?php endif; ?>> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-  filter-col-box">
        <select class="js-select2 compensation_filter_btn" multiple="multiple">
            <?php $__currentLoopData = $all_compensations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $compensation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($compensation); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($compensation); ?>" class="industries_checkbox" <?php if(!empty($field->selectCompensation)): ?> <?php if(in_array($compensation,$field->selectCompensation)): ?> selected=true <?php endif; ?> <?php endif; ?>> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-  filter-col-box">
        <div class="dropdown">
            <button class=" filter-btn m-0 select2-selection__rendered dd_year_of_exp-dist w-100 text-left" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                Distance
            </button>
            <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButtonInd">
                <div class="row m-0 p-2">
                    <div class="col-6">
                        <h5>Distance</h5>

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
                            <input type="range" value="<?php echo e($field->selectMinDistance); ?>" max="100" min="0" step="1" oninput="
                                                        this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                                        let value = (this.value/parseInt(this.max))*100
                                                        var children = this.parentNode.childNodes[1].childNodes;
                                                        children[1].style.width=value+'%';
                                                        children[5].style.left=value+'%';
                                                        children[7].style.left=value+'%';children[11].style.left=value+'%';
                                                        children[11].childNodes[1].innerHTML=this.value;" class="min-range-distance " />

                            <input type="range" value="<?php echo e($field->selectMaxDistance); ?>" max="100" min="0" step="1" oninput="
                                                        this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                                                        let value = (this.value/parseInt(this.max))*100
                                                        var children = this.parentNode.childNodes[1].childNodes;
                                                        children[3].style.width=(100-value)+'%';
                                                        children[5].style.right=(100-value)+'%';
                                                        children[9].style.left=value+'%';children[13].style.left=value+'%';
                                                        children[13].childNodes[1].innerHTML=this.value;" class="max-range-distance " />
                        </div>
                    </div>
                    <div class="col-6 float-right"><a href="jasvascript:void(0)" class="float-right cut-range-dist">x</a></div>
                </div>
            </ul>
        </div>
    </div>

    <div class="col-  filter-col-box">
        <select class="js-select2 schedule_filter_btn" multiple="multiple">
            <?php $__currentLoopData = $all_schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($schedule); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($schedule); ?>" class="industries_checkbox" <?php if(!empty($field->selectSchedule)): ?> <?php if(in_array($schedule,$field->selectSchedule)): ?> selected=true <?php endif; ?> <?php endif; ?>> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-   filter-col-box">
        <select class="js-select2 interest_filter_btn" multiple="multiple">
            <?php $__currentLoopData = $all_interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($interest); ?>" data-badge="" class="industries_checkbox" <?php if(!empty($field->selectedInterests)): ?> <?php if(in_array($interest,$field->selectedInterests)): ?> selected=true <?php endif; ?> <?php endif; ?>> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col- filter-col-box">
        <select class="js-select2 industries_filter_btn" multiple="multiple">
            <?php $__currentLoopData = $all_industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($ind); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($ind); ?>" class="industries_checkbox" <?php if(!empty($field->selectedIndustries)): ?> <?php if(in_array($ind,$field->selectedIndustries)): ?> selected=true <?php endif; ?> <?php endif; ?>> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-  filter-col-box">
        <select class="js-select2 hard_skills_filter_btn" multiple="multiple" name="selectedHardSkills">
            <?php $__currentLoopData = $all_hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($skill); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($skill); ?>" class="industries_checkbox" <?php if(!empty($field->selectedHardSkills)): ?> <?php if(in_array($skill,$field->selectedHardSkills)): ?> selected=true <?php endif; ?> <?php endif; ?>> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


    <div class="col-  filter-col-box">
        <select class="js-select2 soft_skills_filter_btn" multiple="multiple" wire:model="selectedSoftSkills">
            <?php $__currentLoopData = $all_soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($skill); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($skill); ?>" class="industries_checkbox" <?php if(!empty($field->selectedSoftSkills)): ?> <?php if(in_array($skill,$field->selectedSoftSkills)): ?> selected=true <?php endif; ?> <?php endif; ?>> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-  filter-col-box">
        <select class="js-select2 work_environment_filter_btn" multiple="multiple">
            <?php $__currentLoopData = $all_work_environments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $environment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($environment); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($environment); ?>" class="industries_checkbox" <?php if(!empty($field->selectWorkEnvironment)): ?> <?php if(in_array($environment,$field->selectWorkEnvironment)): ?> selected=true <?php endif; ?> <?php endif; ?>> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-  filter-col-box">
        <select class="js-select2 languages_filter_btn" multiple="multiple" form="save-search" name="selectedLanguages">
            <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($language); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($language); ?>" class="industries_checkbox" <?php if(!empty($field->selectedLanguages)): ?> <?php if(in_array($language,$field->selectedLanguages)): ?> selected=true <?php endif; ?> <?php endif; ?>> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

</div>
<?php else: ?>

<div class="d-flex flex-wrap filter-row">
    <!-- <div class="col- filter-col-box">

        <select class="js-select2 current_position_filter_btn" multiple="multiple" placeholder="">
    </select>
    </div> -->

    <div class="col- filter-col-box tag-input-field">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js" integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <div class="col- filter-col-box form-group position-input">
            <input class="js-select2 current_position_filter_btn2 form-control" data-role="tagsinput" placeholder="Current Position/Title" value="<?php echo e($selectCurrentPosition); ?>" />
        </div>
    </div>

    <div class="col- filter-col-box">
        <div class="dropdown">
            <button class=" filter-btn m-0 select2-selection__rendered dd_year_of_exp w-100 text-left" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                Yrs of exp
            </button>
            <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButtonInd">
                <div class="row m-0 p-2">
                    <div class="col-6">
                        <h5>Years of experience</h5>
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
                            <input type="range"  value="0" max="40" min="0" step="1" ttt oninput="
                                                        this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                                        let value = (this.value/parseInt(this.max))*100
                                                        var children = this.parentNode.childNodes[1].childNodes;
                                                        children[1].style.width=value+'%';
                                                        children[5].style.left=value+'%';
                                                        children[7].style.left=value+'%';children[11].style.left=value+'%';
                                                        children[11].childNodes[1].innerHTML=this.value;" class="min-range " />

                            <input type="range" value="40" max="40" min="0" step="1" oninput="
                                                        this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                                                        let value = (this.value/parseInt(this.max))*100
                                                        var children = this.parentNode.childNodes[1].childNodes;
                                                        children[3].style.width=(100-value)+'%';
                                                        children[5].style.right=(100-value)+'%';
                                                        children[9].style.left=value+'%';children[13].style.left=value+'%';
                                                        children[13].childNodes[1].innerHTML=this.value;" class="max-range " />
                        </div>
                    </div>
                    <div class="col-6 float-right"><a href="jasvascript:void(0)" class="float-right cut-range">x</a></div>
                </div>
            </ul>
        </div>
    </div>



    <!-- <div class="col- filter-col-box">
        <select class="js-select2 seeking_position_filter_btn" multiple="multiple">

        </select>
    </div> -->

    <div class="col- filter-col-box">
        <select class="js-select2 salary_range_filter_btn" multiple="multiple" placeholder="">
            <?php $__currentLoopData = $all_salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($salary); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

    </div>

    <div class="col-  filter-col-box">
        <select class="js-select2 compensation_filter_btn" multiple="multiple" placeholder="">
            <?php $__currentLoopData = $all_compensations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $compensation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($compensation); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($compensation); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


    <div class="col- filter-col-box">
        <div class="dropdown">
            <button class=" filter-btn m-0 select2-selection__rendered dd_year_of_exp-dist  text-left" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                Distance
            </button>
            <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButtonInd">
                <div class="row m-0 p-2">
                    <div class="col-6">
                        <h5>Distance</h5>
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
                                                        children[11].childNodes[1].innerHTML=this.value;" class="min-range-distance " />

                            <input type="range" value="100" max="100" min="0" step="1" oninput="
                                                        this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                                                        let value = (this.value/parseInt(this.max))*100
                                                        var children = this.parentNode.childNodes[1].childNodes;
                                                        children[3].style.width=(100-value)+'%';
                                                        children[5].style.right=(100-value)+'%';
                                                        children[9].style.left=value+'%';children[13].style.left=value+'%';
                                                        children[13].childNodes[1].innerHTML=this.value;" class="max-range-distance " />
                        </div>
                    </div>
                    <div class="col-6 float-right"><a href="jasvascript:void(0)" class="float-right cut-range-dist">x</a></div>
                </div>
            </ul>
        </div>
    </div>

    <div class="col- filter-col-box">

        <select class="js-select2 schedule_filter_btn" multiple="multiple" placeholder="">
            <?php $__currentLoopData = $all_schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($schedule); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($schedule); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col- filter-col-box">

        <select class="js-select2 interest_filter_btn" multiple="multiple" placeholder="">
            <?php $__currentLoopData = $all_interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($interest); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($interest); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


    <div class="col- filter-col-box">
        <select class="js-select2 industries_filter_btn" multiple="multiple" placeholder="fsaffgsdgfsgfas">
            <?php $__currentLoopData = $all_industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($ind); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($ind); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col- filter-col-box">
        <select class="js-select2 hard_skills_filter_btn" multiple="multiple" placeholder="">
            <?php $__currentLoopData = $all_hard_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($skill); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($skill); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


    <div class="col- filter-col-box">
        <select class="js-select2 soft_skills_filter_btn" multiple="multiple" placeholder="">
            <?php $__currentLoopData = $all_soft_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($skill); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($skill); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col- filter-col-box">
        <select class="js-select2 work_environment_filter_btn" multiple="multiple" placeholder="">
            <?php $__currentLoopData = $all_work_environments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $environment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($environment); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($environment); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-  filter-col-box">

        <select class="js-select2 languages_filter_btn" multiple="multiple" placeholder="" form="save-search" wire:model="selectedLanguages" name="selectedLanguages">
            <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($language); ?>" data-badge="" id="flexCheckDefault<?php echo e($key); ?><?php echo e($language); ?>" class="industries_checkbox"> <?php echo e($key); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

    </div>
</div>
<?php endif; ?>

<script>
$('.js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)').each(function() {
                $(this).val($(this).val()).trigger('change', true);
            })
</script>
<?php /**PATH /var/www/html/app/resources/views/inc/updateSearch.blade.php ENDPATH**/ ?>