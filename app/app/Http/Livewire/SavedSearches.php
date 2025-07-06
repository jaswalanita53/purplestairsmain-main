<?php

namespace App\Http\Livewire;

use App\Models\Search;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Skill;
use App\Models\Language;
use App\Models\Interest;
use App\Models\Industry;
use App\Models\WorkEnvironment;
use App\Models\Schedule;
use App\Models\Compensation;
use App\Models\Salary;
use App\Models\IdealJobAttribute;
use App\Models\Personal;
use App\services\slug;
use App\Models\Company;
use App\Models\Subscription;
use App\Models\CompanyUser;
use App\Models\Delete;
use App\Models\ZipCode;
use DB;
use Searches;
use Illuminate\Support\Carbon;

class SavedSearches extends Component
{

    public $search_name;
    public $search_id;
    //search entities
    public
        $all_industries,
        $selectedIndustries,
        $all_interests,
        $selectedInterests,
        $selectDistance,
        $selectSeekingPosition,
        $selectCurrentPosition,
        $selectSchedule,
        $selectSalaryRange,
        $selectWorkEnvironment,
        $selectMinYearOfExperience,
        $selectMaxYearOfExperience,
        $selectMinDistance,
        $selectMaxDistance,
        $selectCompensation,
        $filterYearOfExperience = 0, // task - 86a0btjx8
        $filterDistance = 0, // task - 86a0btjx8

        //skills
        $all_languages,
        $selectedLanguages,
        $all_soft_skills,
        $selectedSoftSkills,
        $all_hard_skills,
        $selectedHardSkills,
        $hard_skills,
        $hard_skills_status,
        $soft_skills,
        $soft_skills_status,
        $all_work_environments,
        $all_schedules,
        $all_compensations,
        $all_salaries,
        $all_ideal_job_attributes,
        $all_zipcodes,
        $selectZipCode,
        $all_current_position;
        public $company = '';
        public $past_search_match_users = [];
        public $users_id = [];
        public $searched_users_id ;
        public $saved_searches = [];
        public $login_user = '';
        public $active_subscription = [];
        public $page = 1, $offset = 0, $temp_searches = [];
        public $count = 6;
        protected $listeners = ['refreshComponent2' => 'render','deleteSearch','loadMore'];

        public function mount()
        {
            $this->auth_user = Auth::user();
            $this->login_user = Auth::user()->id;

            if ($this->auth_user->reference > 0) {
                $ref_user = $this->auth_user->reference;
                $this->company = User::find($ref_user)->company->id;
            } else {
                $this->company = $this->auth_user->company->id;
            }

            // redirect if company subscription expired
            $subscription = Subscription::where('user_id', $this->login_user)->where('status', 1)->orderBy('id', 'desc')->first();
            $this->active_subscription = $subscription; // task - 862k46g33

        // validate login user
        validateUser($subscription);

        //getting all industries and authenticated users industries
        $this->all_industries = Industry::where('status', 1)->orderBy('name', 'asc')->pluck('id', 'name')->toArray();;

        //getting all interests and authenticated users interests
        $this->all_interests = Interest::orderBy('name', 'asc')->pluck('id', 'name')->toArray();

        //getting all languages and authenticated users languages
        // task - 86a1zbdp7
        // $this->all_languages = Language::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $this->all_languages = Language::orderByRaw('id=1 DESC,id=4 DESC, `name` ASC')->pluck('id', 'name')->toArray();

        //getting all soft skills and authenticated users soft skills
        $this->all_soft_skills = Skill::where('skill_type', 'soft_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();

        //getting all hard skills and authenticated users hard skills
        $this->all_hard_skills = Skill::where('skill_type', 'hard_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();

        //getting all henvironments and authenticated users hard skills
        $this->all_work_environments = WorkEnvironment::where('status', 1)->pluck('id', 'name')->toArray();

        //getting all henvironments and authenticated users hard skills
        $this->all_schedules = Schedule::where('status', 1)->pluck('id', 'name')->toArray();

        //getting all compensations and authenticated users hard skills
        $this->all_compensations = Compensation::where('status', 1)->pluck('id', 'name')->toArray();

        //getting all salaries and authenticated users hard skills
        $this->all_salaries = Salary::where('status', 1)->pluck('id', 'name')->toArray();

        //getting all ideal_job_attributes and authenticated users hard skills
        $this->all_ideal_job_attributes = IdealJobAttribute::where('status', 1)->pluck('id', 'name')->toArray();

        $this->all_current_position = Personal::distinct()->pluck('current_title');
        $this->all_zipcodes = ZipCode::pluck('zip_code')->toArray();
    }

    public function render()
    {
        if ($this->page == 1) {
            $this->temp_searches = [];
        }
        $saved_searches = Search::where('company_id', $this->company)->with('newMatch')->with('searchUser')
                                ->forPage($this->page, $this->count)
                                ->get();
                                $countSearches=count($saved_searches);
                                if(empty($this->temp_searches)){
                                    $saved_searches = $this->temp_searches = $saved_searches;
                                }else{
                                    $saved_searches = $this->temp_searches->merge($saved_searches);
                                    $this->temp_searches = $saved_searches;
                                }



        $savedSearches = [];
        foreach ( $saved_searches as $key => $search) {
            $allUsers=$search->searchUser->pluck('user_id')->toArray();
            $c_candidates = User::whereIn('id', $allUsers)->take(16);
            $savedSearches[$key]['all_matches'] = count($allUsers);
            $savedSearches[$key]['search'] = $search;
            $savedSearches[$key]['new_match_count'] = count($search->newMatch);
            $savedSearches[$key]['candidates_profile_image_path'] = $c_candidates->get();
        }


        return view('livewire.saved-searches', compact('savedSearches','countSearches'));
    }

    public function deleteSearch($id)
    {
        $search=Search::find($id);
        $slug=$search->slug;
        if($search->delete()){
            $this->dispatchBrowserEvent('element_id','saved_search_'.$id);
            // return redirect('company/archived-searches/');
        }
    }

    public function saveSearch()
    {

        $activeUsersId = User::where('user_type', 'candidate')
        ->where('status', '1')
        ->pluck('id')
        ->toArray();

        $hard_skill_user_id = [];
        $soft_skill_user_id = [];
        $industry_user_id = [];
        $interest_user_id = [];
        $language_user_id = [];
        $schedule_user_id = [];
        $zip_code_user_id = [];
        $salary_range_user_id = [];
        $current_position_user_id = [];
        $work_environment_user_id = [];
        $compensation_user_id = [];
        $yrs_exp_user_id = [];

        // get saved serached of company
        if (!empty($this->selectSchedule)) {
            $schedule_user = \DB::table('personals')
            ->whereIn('user_id', $activeUsersId);

            $sch_condition = [];

            if (in_array('1', $this->selectSchedule)) {
                // $schedule_user = $schedule_user->where('schedule_full_time', 1);
                $sch_condition[] = "schedule_full_time = 1";
            }
            if (in_array('2', $this->selectSchedule)) {
                // $schedule_user = $schedule_user->where('schedule_part_time', 1);
                $sch_condition[] = "schedule_part_time = 1";
            }
            if (in_array('3', $this->selectSchedule)) {
                // $schedule_user = $schedule_user->where('schedule_no_preference', 1);
                $sch_condition[] = "schedule_no_preference = 1 OR schedule_full_time = 1 OR schedule_part_time = 1"; // task - 86a1rtted
            }
            if(!empty($sch_condition)) {
                $schedule_user = $schedule_user->whereRaw('(' . implode(' OR ', $sch_condition) . ')');
                $schedule_user = $schedule_user->get();
                if (count($schedule_user) > 0) {
                    foreach ($schedule_user as $user) {
                        $schedule_user_id[] = $user->user_id;
                    }
                } else {
                    $schedule_user_id[] = 0;
                }
            }
        }


        if (!empty($this->selectZipCode)) {
            $this->selectZipCode = array_filter($this->selectZipCode);
            $selectZipCodes = collect($this->selectZipCode)->flatten()->toArray();
            $zip_code_user = \DB::table('personals')->whereIn('user_id', $activeUsersId)
            ->WhereIn('zip_code',$selectZipCodes)->where('zip_code','!=','')->get()->toArray();

            if (count($zip_code_user) > 0) {
                $zip_code_user_id = array_column($zip_code_user, "user_id");
            } else {
                $zip_code_user_id[] = 0;
            }

        }

        if (!empty($this->selectWorkEnvironment)) {
            $work_environment_user = \DB::table('personals')
            ->whereIn('user_id', $activeUsersId);

            $env_condition = [];
            if (in_array('1', $this->selectWorkEnvironment)) {
                // $work_environment_user = $work_environment_user->where('work_environment_remote', 1);
                $env_condition[] = "work_environment_remote = 1";
            }
            if (in_array('2', $this->selectWorkEnvironment)) {
                // $work_environment_user = $work_environment_user->where('work_environment_in_office', 1);
                $env_condition[] = "work_environment_in_office = 1";
            }
            if (in_array('3', $this->selectWorkEnvironment)) {
                // $work_environment_user = $work_environment_user->where('work_environment_hybrid', 1);
                $env_condition[] = "work_environment_hybrid = 1 OR (work_environment_remote = 1 AND work_environment_in_office = 1)"; // task - 86a1rtted
            }
            // $env_condition .= ")";

            if(!empty($env_condition)) {
                $work_environment_user = $work_environment_user->whereRaw('(' . implode(' OR ', $env_condition) . ')');
                $work_environment_user = $work_environment_user->get();
                if (count($work_environment_user) > 0) {
                    foreach ($work_environment_user as $user) {
                        $work_environment_user_id[] = $user->user_id;
                    }
                } else {
                    $work_environment_user_id[] = 0;
                }
            }
        }

        if (!empty($this->selectCompensation)) {
            $compensation_user_user = \DB::table('personals')
            ->whereIn('user_id', $activeUsersId);

            $com_condition = [];
            if (in_array('1', $this->selectCompensation)) {
                // $compensation_user_user = $compensation_user_user->where('compensation_salary', 1);
                $com_condition[] = "compensation_salary = 1";
            }
            if (in_array('2', $this->selectCompensation)) {
                // $compensation_user_user = $compensation_user_user->where('compensation_hourly', 1);
                $com_condition[] = "compensation_hourly = 1";
            }
            if (in_array('3', $this->selectCompensation)) {
                // $compensation_user_user = $compensation_user_user->where('compensation_comission_based', 1);
                $com_condition[] = "compensation_comission_based = 1";
            }

            if (!empty($com_condition)) {
                $compensation_user_user = $compensation_user_user->whereRaw('(' . implode(' OR ', $com_condition) . ')');
                $compensation_user_user = $compensation_user_user->get();
                if (count($compensation_user_user) > 0) {
                    foreach ($compensation_user_user as $user) {
                        $compensation_user_id[] = $user->user_id;
                    }
                } else {
                    $compensation_user_id[] = 0;
                }
            }
        }

        if (!empty($this->selectSalaryRange)) {
            $salary_range_user = \DB::table('personals')
            ->whereIn('user_id', $activeUsersId);

            $salary_range_user = $salary_range_user->whereIn('salary_range', $this->selectSalaryRange);
            $salary_range_user = $salary_range_user->get()->toArray();
            if (count($salary_range_user) > 0) {
                $salary_range_user_id = array_column($salary_range_user, "user_id");
                /*foreach ($salary_range_user as $user) {
                    $salary_range_user_id[] = $user->user_id;
                }*/
                // dd($salary_range_user, $salary_range_user_id);
            } else {
                $salary_range_user_id[] = 0;
            }
        }

        if (!empty($this->selectCurrentPosition)) {
            $positions= explode(',',$this->selectCurrentPosition);
            $current_position_user = \DB::table('personals')->whereIn('user_id', $activeUsersId)
            ->Where(function ($query) use($positions) {
                for ($i = 0; $i < count($positions); $i++){
                    // $query->orwhere('current_title', 'like',  '%' . $positions[$i] . '%'); task - 86a26bch4
                    if(in_array(strtolower(trim($positions[$i])), ['ceo', 'coo', 'cfo'])) { // task - 86a26bch4
                        $query->orwhere('current_title', 'like',  $positions[$i]);
                    } else {
                        $query->orwhere('current_title', 'like',  '%' . $positions[$i] . '%');
                    }
                }
           })

            ->get()->toArray();
            if (count($current_position_user) > 0) {
                $current_position_user_id = array_column($current_position_user, "user_id");
                /*foreach ($current_position_user as $user) {
                    $current_position_user_id[] = $user->user_id;
                }*/
            } else {
                $current_position_user_id[] = 0;
            }
        }


        if (!empty($this->selectedHardSkills)) {
            $skill_user = \DB::table('skill_user')->whereIn('skill_id', $this->selectedHardSkills)->get()->toArray();
            if (count($skill_user) > 0) {
                $hard_skill_user_id = array_column($skill_user, "user_id");
                /*foreach ($skill_user as $user) {
                    $hard_skill_user_id[] = $user->user_id;
                }*/
            } else {
                $hard_skill_user_id[] = 0;
            }
        }

        if (!empty($this->selectedSoftSkills)) {
            $soft_skill_user_id[] = '';
            $skill_user = \DB::table('skill_user')->whereIn('skill_id', $this->selectedSoftSkills)->get()->toArray();
            if (count($skill_user) > 0) {
                $soft_skill_user_id = array_column($skill_user, "user_id");
                /*foreach ($skill_user as $user) {
                    $soft_skill_user_id[] = $user->user_id;
                }*/
            } else {
                $soft_skill_user_id[] = 0;
            }
        }

        if (!empty($this->selectedIndustries)) {
            $industry_user_id[] = '';
            $industry_user = \DB::table('industry_user')->whereIn('industry_id', $this->selectedIndustries)->get()->toArray();
            if (count($industry_user) > 0) {
                $industry_user_id = array_column($industry_user, "user_id");
                /*foreach ($industry_user as $user) {
                    $industry_user_id[] = $user->user_id;
                }*/
            } else {
                $industry_user_id[] = 0;
            }
        }

        if (!empty($this->selectedInterests)) {
            $interest_user_id[] = '';
            $interest_user = \DB::table('interest_user')->whereIn('interest_id', $this->selectedInterests)->get()->toArray();
            if (count($interest_user) > 0) {
                $interest_user_id = array_column($interest_user, "user_id");
                /*foreach ($interest_user as $user) {
                    $interest_user_id[] = $user->user_id;
                }*/
            } else {
                $interest_user_id[] = 0;
            }
        }

        if (!empty($this->selectedLanguages)) {
            $language_user_id[] = '';
            $language_user = \DB::table('language_user')->select('language_user.user_id', \DB::raw('group_concat(language_id) as users_languages'))->whereIn('language_id', $this->selectedLanguages)->groupBy('user_id')->get()->toArray();
            if (count($language_user) > 0) {
                // task - 86a1uf3ar $language_user_id = array_column($language_user, "user_id");
                foreach ($language_user as $user) {
                    $users_langs = explode(',', $user->users_languages);
                    $match_result = array_intersect($this->selectedLanguages, $users_langs);
                    // $language_user_id[] = $user->user_id;

                    if(count($this->selectedLanguages) == count($match_result)) {
                        $language_user_id[] = $user->user_id;
                    }
                }
            } else {
                $language_user_id[] = 0;
            }
        }

        // Remove empty arrays
        $arrays = array_filter([
            array_unique($hard_skill_user_id),
            array_unique($soft_skill_user_id),
            array_unique($industry_user_id),
            array_unique($interest_user_id),
            array_unique($language_user_id),
            array_unique($schedule_user_id),
            array_unique($zip_code_user_id),
            array_unique($salary_range_user_id),
            array_unique($current_position_user_id),
            array_unique($work_environment_user_id),
            array_unique($compensation_user_id),
        ]);

        // Get common items
        if (!empty($arrays)) {
            $this->searched_users_id = call_user_func_array('array_intersect', $arrays);
        } else {
            $this->searched_users_id = $arrays;
        }

        $this->saved_searches = Search::select('searches.*', \DB::raw('(select group_concat(user_id) from search_user where search_id=searches.id) as candidate_ids'))->where('company_id', $this->company)->get();
        foreach ($this->saved_searches as $k => $search_) {
            $this->saved_searches[$k]['candidate_ids'] = explode(',', $search_->candidate_ids);
            /*$search_candidate = $search_->users->toArray();
            $this->saved_searches[$k]['candidate_ids'] = array_column($search_candidate, 'id');*/
        }


        $candidates = User::with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal'])
            ->where('user_type', 'candidate')->where('status', '1');
        $candidates->whereNull('deleted_at');
        if (
            !empty($this->selectedHardSkills) ||
            !empty($this->selectedSoftSkills) ||
            !empty($this->selectedIndustries) ||
            !empty($this->selectedInterests) ||
            !empty($this->selectedLanguages) ||
            !empty($this->selectSchedule) ||
            !empty($this->selectZipCode) ||
            !empty($this->selectSalaryRange) ||
            !empty($this->selectCurrentPosition) ||
            !empty($this->selectWorkEnvironment) ||
            !empty($this->selectCompensation)
        ) {

            $candidates = $candidates->whereIn('id', array_unique($this->searched_users_id));
        }

                $candidates = $candidates->orderBy('created_at', 'desc');


        // years of experience
        $filteredUser = clone $candidates;
        $filteredUsersExp = $filteredUser->get();
        $new_list = [];
        $exp_sorting_arr = [];
        if ($this->filterYearOfExperience) {
            if (($this->selectMaxYearOfExperience - $this->selectMinYearOfExperience) <= 40 && ($this->selectMaxYearOfExperience - $this->selectMinYearOfExperience) >= 0) {
                foreach ($filteredUsersExp as $key => $user) {
                    // task - 862k3eurn
                    $employments = $user->employments->toArray();
                    $yrs_of_exp = 0;
                    $exp_months = 0;
                    if (count($employments)) {
                        $currently_working = array_values($user->employments->where('currently_working', 1)->toArray());
                        $currently_start_years = (array_column($currently_working, 'start_year'));
                        $currently_end_years = (array_column($currently_working, 'end_year'));

                        $manual_records = array_values($user->employments->where('currently_working', 0)->toArray());
                        $manual_start_years = (array_column($manual_records, 'start_year'));
                        $manual_end_years = (array_column($manual_records, 'end_year'));

                        $tmp_year = [];
                        if(count($currently_working)) {
                            $currently_start_years = array_map(function($element) {
                                    $_yr = substr($element, -4);
                                    return date('Y', strtotime('Jan ' . $_yr));
                                },
                                $currently_start_years
                            );
                            $c_min_year = min($currently_start_years);
                            $c_max_year = date('Y');

                            for($y=$c_min_year; $y<= $c_max_year; $y++) {
                                $tmp_year[$y] = $y;
                            }
                        }

                        if(count($manual_records)) {
                            $manual_start_years = array_map(function($element) {
                                    $_yr = substr($element, -4);
                                    return date('Y', strtotime('Jan ' . $_yr));
                                },
                                $manual_start_years
                            );

                            $manual_end_years = array_map(function($element) {
                                    $_yr = substr($element, -4);
                                    return date('Y', strtotime('Jan ' . $_yr));
                                },
                                $manual_end_years
                            );
                            $m_min_year = min($manual_start_years);
                            $m_max_year = max($manual_end_years);

                            for($y=$m_min_year; $y<= $m_max_year; $y++) {
                                $tmp_year[$y] = $y;
                            }
                        }

                        if($tmp_year) {
                            $min_year = min($tmp_year);
                            $max_year = max($tmp_year);

                            $yrs_of_exp = $max_year - $min_year;
                        }
                    }
                    if ($yrs_of_exp >= $this->selectMinYearOfExperience && $yrs_of_exp <= $this->selectMaxYearOfExperience) {
                        $new_list[] = $user->id;
                        $exp_sorting_arr[$user->id] = $yrs_of_exp;
                    }
                }
                $candidates = $candidates->whereIn('id', $new_list);
            }

            // task - 862k3m8tj sort by experience
            if ($exp_sorting_arr) {
                if($this->sort_order == "ASC") {
                    asort($exp_sorting_arr);
                } else {
                    arsort($exp_sorting_arr);
                }
                $order_by_keys = array_keys($exp_sorting_arr);
                $candidates->orderByRaw("FIELD(id, " . implode(',', $order_by_keys) . ")");
            }
        }

          // distance
        $filteredUserForDistance = clone $candidates;
        $filteredUsersDist = $filteredUserForDistance->get();
        $new_list_distance = [];
        $sorting_arr = [];
        $api_failed_count = 0;
        if ($this->filterDistance) { // task - 86a0btjx8
            $companyZip = \DB::table('companies')->where('id', $this->company)->first();
            if (($this->selectMaxDistance - $this->selectMinDistance) <= 100 && ($this->selectMaxDistance - $this->selectMinDistance) > 0) {
                foreach ($filteredUserForDistance->get() as $key => $user) {
                    // $first = \DB::table('personals')->where('user_id', $user->id)->first();
                    $first = $user->personal;
                    if (!empty($first)) {
                        // $this->rand = "5";
                        // $dist = $this->calculateDistance($first->zip_code, $companyZip->zip_code);
                        $dist = "Failed";
                        if($first->lat && $first->lng && $companyZip->lng && $companyZip->lng) {
                            $dist = degrees_difference($first->lat, $first->lng, $companyZip->lat, $companyZip->lng);
                            // dd($this->company, $first->id, $dist, $dist2);
                        }
                        // task - 86a2rvvjq
                        if ($dist != "Failed") {
                            if ($dist > $this->selectMinDistance && $dist < $this->selectMaxDistance) {
                                $new_list_distance[] = $user->id;
                                $sorting_arr[$user->id] = $dist;
                            } else {
                                /* task - 86a2yeydc $new_list_distance[] = $user->id;
                                $sorting_arr[$user->id] = $dist;*/
                            }
                        } else {
                            $new_list_distance[] = $user->id;
                            $sorting_arr[$user->id] = 0;
                        }
                        /*if ($dist == "Failed") {
                            $api_failed_count++;
                        } else {
                        }*/
                    }
                }

                $candidates = $candidates->whereIn('id', $new_list_distance);
                $this->api_failed = $api_failed_count;
            }

            // task - 862k3m8tj sort by distance |
            if ($sorting_arr) {
                if($this->sort_order == "ASC") {
                    asort($sorting_arr);
                } else {
                    arsort($sorting_arr);
                }
                $order_by_keys = array_keys($sorting_arr);
                $candidates->orderByRaw("FIELD(id, " . implode(',', $order_by_keys) . ")");
            }
        }


        $this->users_id = $candidates->pluck('id')->toArray();

        $search_fields = [];

        $search_fields['selectedHardSkills'] = $this->selectedHardSkills;
        $search_fields['selectedSoftSkills'] = $this->selectedSoftSkills;
        $search_fields['selectedIndustries'] = $this->selectedIndustries;
        $search_fields['selectedInterests'] = $this->selectedInterests;
        $search_fields['selectedLanguages'] = $this->selectedLanguages;
        $search_fields['selectSchedule'] = $this->selectSchedule;
        $search_fields['selectZipCode'] = $this->selectZipCode;
        $search_fields['selectSalaryRange'] = $this->selectSalaryRange;
        $search_fields['selectCurrentPosition'] = $this->selectCurrentPosition;
        $search_fields['selectWorkEnvironment'] = $this->selectWorkEnvironment;
        $search_fields['selectCompensation'] = $this->selectCompensation;
        $search_fields['selectDistance'] = $this->selectDistance;
        $search_fields['selectMinYearOfExperience'] = $this->selectMinYearOfExperience;
        $search_fields['selectMaxYearOfExperience'] = $this->selectMaxYearOfExperience;
        $search_fields['selectMinDistance'] = $this->selectMinDistance;
        $search_fields['selectMaxDistance'] = $this->selectMaxDistance;
        $search_fields['selectSeekingPosition'] = $this->selectSeekingPosition;
        $search_fields['filterYearOfExperience'] = $this->filterYearOfExperience; // task - 86a2qrx00
        $search_fields['filterDistance'] = $this->filterDistance; // task - 86a2qrx00

        $slug = new Slug();

        $search = Search::find($this->search_id);

        if(empty($search)){
            $search = new Search;
        }

        if ($search) {
            if (trim($this->search_name) != "") { // task - 86a1820kz
                $search->name = $this->search_name;
            }
            if (!empty(json_encode($search_fields))) {
                $search->search_fields = json_encode($search_fields);
            }
            // if(!empty($this->users_id)){
            $search->synced_users = json_encode($this->users_id);
            $search->old_synced_users = json_encode($this->users_id); // task - 86a26mwgd

            // }
            if (!empty($this->candidates_count)) {
                $search->old_match_count = $this->candidates_count;
            }
            if (!empty($this->company)) {
                $search->company_id = $this->company;
            }
            if (trim($this->search_name) != "") { // task - 86a1820kz
                $search->slug = $slug->createSlug($this->search_name);
            }

            if ($search->save()) {
                // $search->users()->sync($this->users_id);
                \DB::table('search_user')->where(['search_id' => $search->id])->delete();
                foreach (json_decode($search->synced_users, true) as $_id) {
                    // $search->users()->sync(['user_id' => $_id, 'last_viewed' => date('Y-m-d H:i:s', strtotime('INTERVAL -24 HOUR'))]);
                    $tmDate = time();
                    \DB::table('search_user')->insert([
                        ['user_id' => $_id, 'search_id' => $search->id, 'last_viewed' => date('Y-m-d H:i:s', strtotime('-1 day', $tmDate))]
                    ]);
                }
                \DB::table('new_search_matches')
                            ->where('search_id', $search->id)
                            ->delete();
                        $this->dispatchBrowserEvent('closeModal');
                        return redirect('company/saved-search/'.$search->slug);
            }
        }
    }

    public function newCondidate($slug)
    {
        $user_ids = [];
        $search = Search::where('slug', $slug)->withTrashed()->first();
        $search_fields = json_decode($search->search_fields, true);

        // task - 86a26mwgd
        $old_synced_users = [];
        if($search->old_synced_users) {
            $old_synced_users = json_decode($search->old_synced_users, true);
        }
        // task - 86a26mwgd end
        $selectedHardSkills = $search_fields['selectedHardSkills'];
        $selectedSoftSkills = $search_fields['selectedSoftSkills'];
        $selectedIndustries = $search_fields['selectedIndustries'];
        $selectedInterests = $search_fields['selectedInterests'];
        $selectedLanguages = $search_fields['selectedLanguages'];
        $selectSchedule = $search_fields['selectSchedule'];
        $selectZipCode = ($search_fields['selectZipCode'])??[];
        $selectSalaryRange = $search_fields['selectSalaryRange'];
        $selectCurrentPosition = $search_fields['selectCurrentPosition'];
        $selectWorkEnvironment = $search_fields['selectWorkEnvironment'];
        $selectCompensation = $search_fields['selectCompensation'];
        $selectDistance = $search_fields['selectDistance'];
        $selectMinYearOfExperience = $search_fields['selectMinYearOfExperience'];
        $selectMaxYearOfExperience = $search_fields['selectMaxYearOfExperience'];
        $selectMinDistance = $search_fields['selectMinDistance'];
        $selectMaxDistance = $search_fields['selectMaxDistance'];
        $selectSeekingPosition = $search_fields['selectSeekingPosition'];

        $hard_skill_user_id = [];
        $soft_skill_user_id = [];
        $industry_user_id = [];
        $interest_user_id = [];
        $language_user_id = [];
        $schedule_user_id = [];
        $zip_code_user_id = [];
        $salary_range_user_id = [];
        $current_position_user_id = [];
        $work_environment_user_id = [];
        $compensation_user_id = [];
        // get saved serached of company
        if (!empty($selectSchedule)) {

            $schedule_user = \DB::table('personals');
            $sch_condition = [];
            if (in_array('1', $selectSchedule)) {
                // $schedule_user = $schedule_user->where('schedule_full_time', 1);
                $sch_condition[] = "schedule_full_time = 1";
            }
            if (in_array('2', $selectSchedule)) {
                // $schedule_user = $schedule_user->where('schedule_part_time', 1);
                $sch_condition[] = "schedule_part_time = 1";
            }
            if (in_array('3', $selectSchedule)) {
                // $schedule_user = $schedule_user->where('schedule_no_preference', 1);
                $sch_condition[] = "schedule_no_preference = 1 OR schedule_full_time = 1 OR schedule_part_time = 1";
            }

            if(!empty($sch_condition)) {
                $schedule_user = $schedule_user->whereRaw('(' . implode(' OR ', $sch_condition) . ')');
                $schedule_user = $schedule_user->get();
                if (count($schedule_user) > 0) {
                    foreach ($schedule_user as $user) {
                        $schedule_user_id[] = $user->user_id;
                    }
                } else {
                    $schedule_user_id[] = 0;
                }
            }
        }
        if (!empty($selectZipCode)) {
            $selectZipCodes = collect($selectZipCode)->flatten()->toArray();
            $zip_code_user = \DB::table('personals')
            ->WhereIn('zip_code',$selectZipCodes)->where('zip_code','!=','')->get()->toArray();

            if (count($zip_code_user) > 0) {
                $zip_code_user_id = array_column($zip_code_user, "user_id");
            } else {
                $zip_code_user_id[] = 0;
            }

        }

        if (!empty($selectWorkEnvironment)) {
            $work_environment_user = \DB::table('personals');
            $env_condition = [];
            if (in_array('1', $selectWorkEnvironment)) {
                // $work_environment_user = $work_environment_user->where('work_environment_remote', 1);
                $env_condition[] = "work_environment_remote = 1";
            }
            if (in_array('2', $selectWorkEnvironment)) {
                // $work_environment_user = $work_environment_user->where('work_environment_in_office', 1);
                $env_condition[] = "work_environment_in_office = 1";
            }
            if (in_array('3', $selectWorkEnvironment)) {
                // $work_environment_user = $work_environment_user->where('work_environment_hybrid', 1);
                $env_condition[] = "work_environment_hybrid = 1 OR (work_environment_remote = 1 AND work_environment_in_office = 1)";
            }
            if(!empty($env_condition)) {
                $work_environment_user = $work_environment_user->whereRaw('(' . implode(' OR ', $env_condition) . ')');
                $work_environment_user = $work_environment_user->get();
                if (count($work_environment_user) > 0) {
                    foreach ($work_environment_user as $user) {
                        $work_environment_user_id[] = $user->user_id;
                    }
                } else {
                    $work_environment_user_id[] = 0;
                }
            }
        }

        if (!empty($selectCompensation)) {
            $compensation_user_user = \DB::table('personals');
            $com_condition = [];
            if (in_array('1', $selectCompensation)) {
                // $compensation_user_user = $compensation_user_user->where('compensation_salary', 1);
                $com_condition[] = "compensation_salary = 1";
            }
            if (in_array('2', $selectCompensation)) {
                // $compensation_user_user = $compensation_user_user->where('compensation_hourly', 1);
                $com_condition[] = "compensation_hourly = 1";
            }
            if (in_array('3', $selectCompensation)) {
                // $compensation_user_user = $compensation_user_user->where('compensation_comission_based', 1);
                $com_condition[] = "compensation_comission_based = 1";
            }
            if (!empty($com_condition)) {
                $compensation_user_user = $compensation_user_user->whereRaw('(' . implode(' OR ', $com_condition) . ')');
                $compensation_user_user = $compensation_user_user->get();
                if (count($compensation_user_user) > 0) {
                    foreach ($compensation_user_user as $user) {
                        $compensation_user_id[] = $user->user_id;
                    }
                } else {
                    $compensation_user_id[] = 0;
                }
            }
        }

        if (!empty($selectSalaryRange)) {
            $salary_range_user = \DB::table('personals');
            $salary_range_user = $salary_range_user->whereIn('salary_range', $selectSalaryRange);
            $salary_range_user = $salary_range_user->get()->toArray();
            if (count($salary_range_user) > 0) {
                $salary_range_user_id = array_column($salary_range_user, "user_id");
                /*foreach ($salary_range_user as $user) {
                    $salary_range_user_id[] = $user->user_id;
                }*/
                // dd($salary_range_user, $salary_range_user_id);
            } else {
                $salary_range_user_id[] = 0;
            }
        }
        if (!empty($selectCurrentPosition)) {

            $positions = explode(',', $selectCurrentPosition);
            /*$positions = $this->selectCurrentPosition;*/
            $current_position_user = \DB::table('personals')
                ->Where(function ($query) use ($positions) {
                    for ($i = 0; $i < count($positions); $i++) {
                        // $query->orwhere('current_title', 'like',  '%' . $positions[$i] . '%'); task - 86a26bch4
                        if(in_array(strtolower(trim($positions[$i])), ['ceo', 'coo', 'cfo'])) { // task - 86a26bch4
                            $query->orwhere('current_title', 'like',  $positions[$i]);
                        } else {
                            $query->orwhere('current_title', 'like',  '%' . $positions[$i] . '%');
                        }
                    }
                })

                ->get()->toArray();

            if (count($current_position_user) > 0) {
                $current_position_user_id = array_column($current_position_user, "user_id");
                /*foreach ($current_position_user as $user) {
                    $current_position_user_id[] = $user->user_id;
                }*/
            } else {
                $current_position_user_id[] = 0;
            }
        }

        if (!empty($selectedHardSkills)) {
            $skill_user = \DB::table('skill_user')->whereIn('skill_id', $selectedHardSkills)->get()->toArray();
            if (count($skill_user) > 0) {
                $hard_skill_user_id = array_column($skill_user, "user_id");
                /*foreach ($skill_user as $user) {
                    $hard_skill_user_id[] = $user->user_id;
                }*/
            } else {
                $hard_skill_user_id[] = 0;
            }
        }

        if (!empty($selectedSoftSkills)) {
            $soft_skill_user_id[] = '';
            $skill_user = \DB::table('skill_user')->whereIn('skill_id', $selectedSoftSkills)->get()->toArray();
            if (count($skill_user) > 0) {
                $soft_skill_user_id = array_column($skill_user, "user_id");
                /*foreach ($skill_user as $user) {
                    $soft_skill_user_id[] = $user->user_id;
                }*/
            } else {
                $soft_skill_user_id[] = 0;
            }
        }

        if (!empty($selectedIndustries)) {
            $industry_user_id[] = '';
            $industry_user = \DB::table('industry_user')->whereIn('industry_id', $selectedIndustries)->get()->toArray();
            if (count($industry_user) > 0) {
                $industry_user_id = array_column($industry_user, "user_id");
                /*foreach ($industry_user as $user) {
                    $industry_user_id[] = $user->user_id;
                }*/
            } else {
                $industry_user_id[] = 0;
            }
        }

        if (!empty($selectedInterests)) {
            $interest_user_id[] = '';
            $interest_user = \DB::table('interest_user')->whereIn('interest_id', $selectedInterests)->get()->toArray();
            if (count($interest_user) > 0) {
                $interest_user_id = array_column($interest_user, "user_id");

                /*foreach ($interest_user as $user) {
                    $interest_user_id[] = $user->user_id;
                }*/
            } else {
                $interest_user_id[] = 0;
            }
        }

        if (!empty($selectedLanguages)) {
            $language_user_id[] = '';
            $language_user = \DB::table('language_user')->select('language_user.user_id', \DB::raw('group_concat(language_id) as users_languages'))->whereIn('language_id', $selectedLanguages)->groupBy('user_id')->get()->toArray();
            if (count($language_user) > 0) {
                foreach ($language_user as $user) {
                    // $language_user_id[] = $user->user_id;
                    $users_langs = explode(',', $user->users_languages);
                    $match_result = array_intersect($selectedLanguages, $users_langs);
                }
            } else {
                $language_user_id[] = 0;
            }
        }

        // Remove empty arrays
        $arrays = array_filter([
            array_unique($hard_skill_user_id),
            array_unique($soft_skill_user_id),
            array_unique($industry_user_id),
            array_unique($interest_user_id),
            array_unique($language_user_id),
            array_unique($schedule_user_id),
            array_unique($zip_code_user_id),
            array_unique($salary_range_user_id),
            array_unique($current_position_user_id),
            array_unique($work_environment_user_id),
            array_unique($compensation_user_id),
        ]);

        // dd($industry_user_id, $schedule_user_id);

        $searched_users_id = "";
        // Get common items
        if (!empty($arrays)) {
            $searched_users_id = call_user_func_array('array_intersect', $arrays);
        } else {

            $searched_users_id = $arrays;
        }

        if (empty($searched_users_id)) {
            $searched_users_id = [];
        }
        $candidates = User::with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal'])
            ->where('user_type', 'candidate');
        if(!empty($this->active_subscription)) {
            $candidates->where('status', 1);
            $candidates->whereNull('deleted_at');
            if ($this->active_subscription->plan_id == 1) {
                $c_HR = date('G');
                if($c_HR < 8) {
                    $candidates->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, users.created_at, NOW()))"), '>', 24);
                } else {
                    $candidates->where(\DB::raw("DATE(users.created_at) < DATE(NOW())"), '=', 1)->where(\DB::raw($c_HR), ">=", 8);
                }
            } elseif ($this->active_subscription->plan_id == 2) {
                // code...
            }elseif ($this->active_subscription->plan_id == 3) {
                // code...
            }

        }
        $candidates = $candidates->whereIn('id', array_unique($searched_users_id))->whereNotIn('id', array_unique($old_synced_users));
        $filteredUser = clone $candidates;
        $filteredUsersExp = [];
        $new_list = [];
        if (($selectMaxYearOfExperience - $selectMinYearOfExperience) < 40 && ($selectMaxYearOfExperience - $selectMinYearOfExperience) > 0) {
            $filteredUsersExp = $filteredUser->get();
            foreach ($filteredUsersExp as $key => $user) {
                // task - 862k3eurn
                $employments = $user->employments->toArray();
                $yrs_of_exp = 0;
                $exp_months = 0;
                if (count($employments)) {
                        $currently_working = array_values($user->employments->where('currently_working', 1)->toArray());
                        $currently_start_years = (array_column($currently_working, 'start_year'));
                        $currently_end_years = (array_column($currently_working, 'end_year'));

                        $manual_records = array_values($user->employments->where('currently_working', 0)->toArray());
                        $manual_start_years = (array_column($manual_records, 'start_year'));
                        $manual_end_years = (array_column($manual_records, 'end_year'));

                        $tmp_year = [];
                        if(count($currently_working)) {
                            $currently_start_years = array_map(function($element) {
                                    $_yr = substr($element, -4);
                                    return date('Y', strtotime('Jan ' . $_yr));
                                },
                                $currently_start_years
                            );
                            $c_min_year = min($currently_start_years);
                            $c_max_year = date('Y');

                            for($y=$c_min_year; $y<= $c_max_year; $y++) {
                                $tmp_year[$y] = $y;
                            }
                        }

                        if(count($manual_records)) {
                            $manual_start_years = array_map(function($element) {
                                    $_yr = substr($element, -4);
                                    return date('Y', strtotime('Jan ' . $_yr));
                                },
                                $manual_start_years
                            );

                            $manual_end_years = array_map(function($element) {
                                    $_yr = substr($element, -4);
                                    return date('Y', strtotime('Jan ' . $_yr));
                                },
                                $manual_end_years
                            );
                            $m_min_year = min($manual_start_years);
                            $m_max_year = max($manual_end_years);

                            for($y=$m_min_year; $y<= $m_max_year; $y++) {
                                $tmp_year[$y] = $y;
                            }
                        }

                        if($tmp_year) {
                            $min_year = min($tmp_year);
                            $max_year = max($tmp_year);

                            $yrs_of_exp = $max_year - $min_year;
                        }
                    }
                if ($yrs_of_exp >= $selectMinYearOfExperience && $yrs_of_exp <= $selectMaxYearOfExperience) {
                    $new_list[] = $user->id;
                    $exp_sorting_arr[$user->id] = $yrs_of_exp;
                }
            }
            $candidates = $candidates->whereIn('id', $new_list);
        }

        // distance
        /*$filteredUserForDistance = clone $candidates;
        $filteredUsersDist = $filteredUsersExp;*/
        $filteredUsersDist = [];
        $new_list_distance = [];
        $sorting_arr = [];
        $api_failed_count = 0;
        $companyZip = \DB::table('companies')->where('id', $this->company)->first();
        if (($selectMaxDistance - $selectMinDistance) < 100 && ($selectMaxDistance - $selectMinDistance) > 0) {
            $filteredUsersDist = (!empty($filteredUsersExp)) ? $filteredUsersExp : $filteredUser->get();
            foreach ($filteredUsersDist as $key => $user) {
                $first = $user->personal;
                if (!empty($first)) {
                    $dist = "Failed";
                    if($first->lat && $first->lng && $companyZip->lng && $companyZip->lng) {
                        $dist = degrees_difference($first->lat, $first->lng, $companyZip->lat, $companyZip->lng);
                    }
                    if ($dist != "Failed") {
                        if ($dist > $selectMinDistance && $dist < $selectMaxDistance) {
                            $new_list_distance[] = $user->id;
                            $sorting_arr[$user->id] = $dist;
                        }
                    }
                }
            }

            $candidates = $candidates->whereIn('id', $new_list_distance);
            $this->api_failed = $api_failed_count;
        }

        return array_unique($candidates->pluck('id')->toArray());
        // return $candidates->pluck('id')->toArray();
    }
    public function loadMore()
    {
        $this->page += 1;
    }
}
