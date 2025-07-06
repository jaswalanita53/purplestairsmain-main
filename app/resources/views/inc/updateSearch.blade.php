<style type="text/css">
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

    /*  task - 86a2vxnfa  */
    .distance-text { font-size: 14px; }
</style>
@if(!empty($field))

<div class="d-flex flex-wrap filter-row">
    <!-- <div class="col-  filter-col-box">
        <select class="js-select2 current_position_filter_btn" multiple="multiple">

            @if(!empty($field->selectCurrentPosition))
            <option value="{{$field->selectCurrentPosition[0]}}" class="industries_checkbox" selected=true> {{$field->selectCurrentPosition[0]}}</option>
            @endif
        </select>
    </div> -->

    <div class="col- filter-col-box tag-input-field animated-background">
        <script src="{{asset('assets/be/taginput/bootstrap-tagsinput.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('assets/be/taginput/bootstrap-tagsinput.css')}}"/>
        <div class="col- filter-col-box form-group position-input">
            <input class="js-select2 current_position_filter_btn2 form-control" data-role="tagsinput" placeholder="Search by Current Title" value="{{ (is_array($field->selectCurrentPosition)) ? implode(',', $field->selectCurrentPosition) : $field->selectCurrentPosition }}" />
        </div>
    </div>

    <div class="col- filter-col-box animated-background">
        <div class="dropdown">
            <button class=" filter-btn m-0 select2-selection__rendered dd_year_of_exp w-100 text-left" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                Yrs of exp
            </button>
            <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButtonInd">
                <div class="row m-0 p-2">
                    {{-- task - 86a0btjx8 --}}
                    <div class="col-6">
                        <h5>Years of experience</h5>
                        <input type="hidden" name="filterYearOfExperience" id="filterYearOfExperience" value="{{ isset($field->filterYearOfExperience) ? $field->filterYearOfExperience : 0 }}">
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
                            <input type="range"  value="{{$field->selectMinYearOfExperience}}" max="40" min="0" step="1" oninput="
                                                        this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                                        let value = (this.value/parseInt(this.max))*100
                                                        var children = this.parentNode.childNodes[1].childNodes;
                                                        children[1].style.width=value+'%';
                                                        children[5].style.left=value+'%';
                                                        children[7].style.left=value+'%';children[11].style.left=value+'%';
                                                        children[11].childNodes[1].innerHTML=this.value;" class="min-range " />

                            <input type="range" value="{{$field->selectMaxYearOfExperience}}" max="40" min="0" step="1" oninput="
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

    <div class="col-   filter-col-box animated-background">
        <select class="js-select2 salary_range_filter_btn" multiple="multiple">
            @foreach ($all_salaries as $key => $salary)

            <option value="{{ $key }}" data-badge="" id="flexCheckDefault{{$key}}{{$salary}}" class="industries_checkbox" @if(!empty($field->selectSalaryRange)) @if(in_array($key,$field->selectSalaryRange)) selected=true @endif @endif> {{ $key }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-  filter-col-box animated-background">
        <select class="js-select2 compensation_filter_btn" multiple="multiple">
            @foreach ($all_compensations as $key => $compensation)
            <option value="{{ $compensation }}" data-badge="" id="flexCheckDefault{{$key}}{{$compensation}}" class="industries_checkbox" @if(!empty($field->selectCompensation)) @if(in_array($compensation,$field->selectCompensation)) selected=true @endif @endif> {{ $key }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-  filter-col-box animated-background">
        <div class="dropdown">
            <button class=" filter-btn m-0 select2-selection__rendered dd_year_of_exp-dist w-100 text-left" type="button" id="dropdownMenuButtonInd" data-bs-toggle="dropdown" aria-expanded="false">
                Distance
            </button>
            <ul class="dropdown-menu px-2 " aria-labelledby="dropdownMenuButtonInd">
                <div class="row m-0 p-2">
                    <div class="col-6">
                        <h5>Distance</h5>
                        <input type="hidden" name="filterDistance" id="filterDistance" value="{{ isset($field->filterDistance) ? $field->filterDistance : 0 }}">
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
                            <input type="range" value="{{$field->selectMinDistance}}" max="100" min="0" step="1" oninput="
                                                        this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                                        let value = (this.value/parseInt(this.max))*100
                                                        var children = this.parentNode.childNodes[1].childNodes;
                                                        children[1].style.width=value+'%';
                                                        children[5].style.left=value+'%';
                                                        children[7].style.left=value+'%';children[11].style.left=value+'%';
                                                        children[11].childNodes[1].innerHTML=this.value;" class="min-range-distance " />

                            <input type="range" value="{{$field->selectMaxDistance}}" max="100" min="0" step="1" oninput="
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

                    {{-- task - 86a2vxnfa --}}
                    <div class="col-12">
                        <p class="text-danger distance-text">Distance is calculated from zip code associated with your subscription.</p>
                    </div>
                </div>
            </ul>
        </div>
    </div>

    <div class="col-  filter-col-box animated-background">
        <select class="js-select2 schedule_filter_btn" multiple="multiple">
            @foreach ($all_schedules as $key => $schedule)
            <option value="{{ $schedule }}" data-badge="" id="flexCheckDefault{{$key}}{{$schedule}}" class="industries_checkbox" @if(!empty($field->selectSchedule)) @if(in_array($schedule,$field->selectSchedule)) selected=true @endif @endif> {{ $key }}</option>
            @endforeach
        </select>
    </div>
<div class="col- filter-col-box animated-background">
        <select class="js-select2 zipcode_filter_btn" multiple="multiple" placeholder="fsafas" >
            @foreach (array_unique($all_zipcodes) as $key => $zipcode)
            <option value="{{ $zipcode }}" data-badge="" class="industries_checkbox" @if(!empty($field->selectZipCode)) @if(in_array($zipcode,$field->selectZipCode)) selected=true @endif @endif> {{ $zipcode }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-   filter-col-box animated-background">
        <select class="js-select2 interest_filter_btn" multiple="multiple">
            @foreach ($all_interests as $key => $interest)
            <option value="{{ $interest }}" data-badge="" class="industries_checkbox" @if(!empty($field->selectedInterests)) @if(in_array($interest,$field->selectedInterests)) selected=true @endif @endif> {{ $key }}</option>
            @endforeach
        </select>
    </div>

    <div class="col- filter-col-box animated-background">
        <select class="js-select2 industries_filter_btn" multiple="multiple">
            @foreach ($all_industries as $key => $ind)
            <option value="{{ $ind }}" data-badge="" id="flexCheckDefault{{$key}}{{$ind}}" class="industries_checkbox" @if(!empty($field->selectedIndustries)) @if(in_array($ind,$field->selectedIndustries)) selected=true @endif @endif> {{ $key }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-  filter-col-box animated-background">
        <select class="js-select2 hard_skills_filter_btn" multiple="multiple" name="selectedHardSkills">
            @foreach ($all_hard_skills as $key => $skill)
            <option value="{{ $skill }}" data-badge="" id="flexCheckDefault{{$key}}{{$skill}}" class="industries_checkbox" @if(!empty($field->selectedHardSkills)) @if(in_array($skill,$field->selectedHardSkills)) selected=true @endif @endif> {{ $key }}</option>
            @endforeach
        </select>
    </div>


    <div class="col-  filter-col-box animated-background">
        <select class="js-select2 soft_skills_filter_btn" multiple="multiple" wire:model="selectedSoftSkills">
            @foreach ($all_soft_skills as $key => $skill)
            <option value="{{ $skill }}" data-badge="" id="flexCheckDefault{{$key}}{{$skill}}" class="industries_checkbox" @if(!empty($field->selectedSoftSkills)) @if(in_array($skill,$field->selectedSoftSkills)) selected=true @endif @endif> {{ $key }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-  filter-col-box animated-background">
        <select class="js-select2 work_environment_filter_btn" multiple="multiple">
            @foreach ($all_work_environments as $key => $environment)
            <option value="{{ $environment }}" data-badge="" id="flexCheckDefault{{$key}}{{$environment}}" class="industries_checkbox" @if(!empty($field->selectWorkEnvironment)) @if(in_array($environment,$field->selectWorkEnvironment)) selected=true @endif @endif> {{ $key }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-  filter-col-box animated-background">
        <select class="js-select2 languages_filter_btn" multiple="multiple" form="save-search" name="selectedLanguages">
            @foreach ($all_languages as $key => $language)
            <option value="{{ $language }}" data-badge="" id="flexCheckDefault{{$key}}{{$language}}" class="industries_checkbox" @if(!empty($field->selectedLanguages)) @if(in_array($language,$field->selectedLanguages)) selected=true @endif @endif> {{ $key }}</option>
            @endforeach
        </select>
    </div>

</div>
@else

<div class="d-flex flex-wrap filter-row">
    <!-- <div class="col- filter-col-box">

        <select class="js-select2 current_position_filter_btn" multiple="multiple" placeholder="">
    </select>
    </div> -->

    <div class="col- filter-col-box tag-input-field animated-background">
        <script src="{{asset('assets/be/taginput/bootstrap-tagsinput.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('assets/be/taginput/bootstrap-tagsinput.css')}}"/>
        <div class="col- filter-col-box form-group position-input">
            <input class="js-select2 current_position_filter_btn2 form-control" data-role="tagsinput" placeholder="Search by Current Title" value="{{ $selectCurrentPosition }}" />
        </div>
    </div>

    <div class="col- filter-col-box animated-background">
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

    <div class="col- filter-col-box animated-background">
        <select class="js-select2 salary_range_filter_btn" multiple="multiple" placeholder="">
            @foreach ($all_salaries as $key => $salary)
            <option value="{{ $key }}" data-badge="" id="flexCheckDefault{{$key}}{{$salary}}" class="industries_checkbox"> {{ $key }}</option>
            @endforeach
        </select>

    </div>

    <div class="col-  filter-col-box animated-background">
        <select class="js-select2 compensation_filter_btn" multiple="multiple" placeholder="">
            @foreach ($all_compensations as $key => $compensation)
            <option value="{{ $compensation }}" data-badge="" id="flexCheckDefault{{$key}}{{$compensation}}" class="industries_checkbox"> {{ $key }}</option>
            @endforeach
        </select>
    </div>


    <div class="col- filter-col-box animated-background">
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

                    {{-- task - 86a2vxnfa --}}
                    <div class="col-12">
                        <p class="text-danger distance-text">Distance is calculated from zip code associated with your subscription.</p>
                    </div>
                </div>
            </ul>
        </div>
    </div>

    <div class="col- filter-col-box animated-background">

        <select class="js-select2 schedule_filter_btn" multiple="multiple" placeholder="">
            @foreach ($all_schedules as $key => $schedule)
            <option value="{{ $schedule }}" data-badge="" id="flexCheckDefault{{$key}}{{$schedule}}" class="industries_checkbox"> {{ $key }}</option>
            @endforeach
        </select>
    </div>

    <div class="col- filter-col-box animated-background">

        <select class="js-select2 interest_filter_btn" multiple="multiple" placeholder="">
            @foreach ($all_interests as $key => $interest)
            <option value="{{ $interest }}" data-badge="" id="flexCheckDefault{{$key}}{{$interest}}" class="industries_checkbox"> {{ $key }}</option>
            @endforeach
        </select>
    </div>


    <div class="col- filter-col-box animated-background">
        <select class="js-select2 industries_filter_btn" multiple="multiple" placeholder="fsaffgsdgfsgfas">
            @foreach ($all_industries as $key => $ind)
            <option value="{{ $ind }}" data-badge="" id="flexCheckDefault{{$key}}{{$ind}}" class="industries_checkbox"> {{ $key }}</option>
            @endforeach
        </select>
    </div>

    <div class="col- filter-col-box animated-background">
        <select class="js-select2 hard_skills_filter_btn" multiple="multiple" placeholder="">
            @foreach ($all_hard_skills as $key => $skill)
            <option value="{{ $skill }}" data-badge="" id="flexCheckDefault{{$key}}{{$skill}}" class="industries_checkbox"> {{ $key }}</option>
            @endforeach
        </select>
    </div>


    <div class="col- filter-col-box animated-background">
        <select class="js-select2 soft_skills_filter_btn" multiple="multiple" placeholder="">
            @foreach ($all_soft_skills as $key => $skill)
            <option value="{{ $skill }}" data-badge="" id="flexCheckDefault{{$key}}{{$skill}}" class="industries_checkbox"> {{ $key }}</option>
            @endforeach
        </select>
    </div>
    <div class="col- filter-col-box animated-background">
        <select class="js-select2 work_environment_filter_btn" multiple="multiple" placeholder="">
            @foreach ($all_work_environments as $key => $environment)
            <option value="{{ $environment }}" data-badge="" id="flexCheckDefault{{$key}}{{$environment}}" class="industries_checkbox"> {{ $key }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-  filter-col-box animated-background">

        <select class="js-select2 languages_filter_btn" multiple="multiple" placeholder="" form="save-search" wire:model="selectedLanguages" name="selectedLanguages">
            @foreach ($all_languages as $key => $language)
            <option value="{{ $language }}" data-badge="" id="flexCheckDefault{{$key}}{{$language}}" class="industries_checkbox"> {{ $key }}</option>
            @endforeach
        </select>

    </div>
</div>
@endif

<script>
    $('.js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)').each(function() {
        $(this).val($(this).val()).trigger('change', true);
    })

    // task - 86a1uf3ar
    function init_filters() {
        setTimeout(function() {
            let loaded_filters = 0; let total_filters = $('.filter-row .filter-col-box:not(.filter-btn,.range-input)').length;
            animInterval = setInterval(function() {
                $('.filter-row .filter-col-box:not(.filter-btn,.range-input)').each(function(index, el) {
                    let _FEL = $(el).find('.js-select2');
                    if(_FEL.length) {
                        if($(_FEL)[0].tagName == "SELECT") {
                            if($(_FEL).hasClass('select2-hidden-accessible')) {
                                $(_FEL).trigger('change', true);
                                loaded_filters ++;
                            }
                        } else if($(_FEL)[0].tagName == "INPUT") {
                            if($(_FEL).hasClass('current_position_filter_btn2')) {
                                if($(_FEL).parent().find('.bootstrap-tagsinput').length) {
                                    loaded_filters ++;
                                }
                            } else {
                                loaded_filters ++;
                            }
                        }
                    }

                    if(loaded_filters >= total_filters) {
                        $('.filter-row .filter-col-box:not(.filter-btn)').removeClass('animated-background');
                        clearInterval(animInterval);
                    }
                });                    
            }, 100);
        }, 500);
    }
</script>
