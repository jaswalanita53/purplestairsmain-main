<?php

namespace App\Http\Livewire;

use App\Models\Note;
use App\Models\Industry;
use App\Models\Interest;
use App\Models\Language;
use App\Models\Search;
use App\Models\Skill;
use App\Models\WorkEnvironment;
use App\Models\Schedule;
use App\Models\Compensation;
use App\Models\Salary;
use App\Models\IdealJobAttribute;
use App\Models\User;
use App\Models\Company;
use App\Models\Personal;
use App\Models\Subscription;
use App\Models\Employment;
use App\Models\CompanyUser;
use App\Models\ZipCode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Delete;
use App\services\slug;
use Illuminate\Support\Carbon;
use DB;
use Searches;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Schema; // task - 86a1tzdqv
use App\Models\Favorite; // task - 86a2vwzh3

class CompanyDashboard extends Component
{
    public User $candidateProfile;

    public $count = 6;

    public $search_name;
    public $candidates_count;

    protected $listeners = ['updatePage' => '$refresh', 'loadMore', 'updateFavorites' => '$refresh']; // task - 86a2vwzh3

    public $sort_order = "DESC",
    $sort_icon = "down-icon.svg",
    $sort_icon2 = "up-icon-gr.svg"; // task - 86a2vxfb2

    public $rand = "1";
    public $save_click = 0;

    //search entities
    public
        $all_industries,
        $selectedIndustries,
        $all_interests,
        $selectedInterests,
        $selectDistance,
        $selectSeekingPosition,
        $selectSchedule,
        $selectSalaryRange,
        $selectWorkEnvironment,
        $selectMinYearOfExperience = 0,
        $selectMaxYearOfExperience = 40,
        $filterYearOfExperience = 0, // task - 86a0btjx8
        $selectMinDistance = 0,
        $selectMaxDistance = 100,
        $filterDistance = 0, // task - 86a0btjx8
        $selectCompensation,
        $selectCurrentPosition,
        $user_id,
        $position_hiring,
        $message,

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
        $all_schedules,
        $all_compensations,
        $all_salaries,
        $all_ideal_job_attributes,
        $all_work_environments,
        $all_current_position,
        $all_zipcodes,
        $selectZipCode;

    //note section
    public $notes;
    public $note;

    //sorting
    public $sortBy = 'newest';

    public $users_id = [];
    public $firstSearch = false;
    public $searchCount = 0;

    // saved search
    public $login_user = '';
    public $auth_user = '';
    public $company = '';
    public $saved_searches = [];
    public $view_id = '';
    public $searched_users_id;
    public $api_failed;

    public $array = [];

    //unmask requests

    public $messageSent = false;
    public $requestCompany = false;
    public $is_filtered = false;
    public $is_submit = false;
    public $is_save = false;
    public $is_run = false;

    public $active_tab = 2; // task - 86a0b69ev

    public $active_subscription = [];

    public $page = 1, $offset = 0, $temp_candidates = []; // task - 86a1uf3ar
    public $personal_status_ = [], $edu_status_ = [], $emp_status_ = [], $ref_status_ = []; // task - 86a2rvv8z

    // task - 86a2vwzh3
    public $category = '';
    public $my_favorites = [];
    public $favorite_load = 0;

    public $candidate_dist = []; // task - 86a2ynnvw

    public $relevants = []; // task - 86a309hbq
    public $non_relevants = []; // task - 86a309hbq
    public $applied_filter = []; // task - 86a309hbq
    public $unmarked = []; // task - 86a309hbq

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
        if ($this->auth_user->reference > 0) {
            $subscription = Subscription::where('user_id', $this->auth_user->reference)->where('status', 1)->orderBy('id', 'desc')->first();
        } else {
            $subscription = Subscription::where('user_id', $this->login_user)->where('status', 1)->orderBy('id', 'desc')->first();
        }
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

        $this->all_zipcodes = ZipCode::pluck('zip_code', 'zip_code')->toArray();

        //getting all salaries and authenticated users hard skills
        $this->all_salaries = Salary::where('status', 1)->pluck('id', 'name')->toArray();

        //getting all ideal_job_attributes and authenticated users hard skills
        $this->all_ideal_job_attributes = IdealJobAttribute::where('status', 1)->pluck('id', 'name')->toArray();

        $this->all_current_position = Personal::distinct()->pluck('current_title');
        $this->searchCount = Search::where('company_id', $this->company)->count();
    }

    public function viewProfile($user_id)
    {
        $candidateDetail=User::where('id', $user_id)
        ->with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal'])
        ->where('user_type', 'candidate')->first();
            if(!empty($candidateDetail)){
            $this->candidateProfile =$candidateDetail;
        }

        $this->view_id = $user_id;
        // get saved serached of company
        $this->saved_searches = Search::select('searches.*', \DB::raw('(select group_concat(user_id) from search_user where search_id=searches.id) as candidate_ids'))->where('company_id', $this->company)->get();
        foreach ($this->saved_searches as $k => $search_) {
            $this->saved_searches[$k]['candidate_ids'] = explode(',', $search_->candidate_ids);
        }

        $this->dispatchBrowserEvent('show-profile-modal');
    }

    public function render()
    {
        $hard_skill_user_id = [];
        $soft_skill_user_id = [];
        $industry_user_id = [];
        $primary_interest_user_id = [];
        $interest_user_id = [];
        $language_user_id = [];
        $schedule_user_id = [];
        $salary_range_user_id = [];
        $current_position_user_id = [];
        $work_environment_user_id = [];
        $compensation_user_id = [];
        $yrs_exp_user_id = [];
        $zip_code_user_id = [];

        // task - 862k46f46 filter conditions are updated : timing
        // get saved serached of company
        if (!empty($this->selectSchedule)) {
            $schedule_user = \DB::table('personals');
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
            // $sch_condition .= ")";
            if(!empty($sch_condition)) {
                $schedule_user = $schedule_user->whereRaw('(' . implode(' OR ', $sch_condition) . ')');
                $schedule_user = $schedule_user->get();
                // dd(\DB::getQueryLog());
                if (count($schedule_user) > 0) {
                    foreach ($schedule_user as $user) {
                        $schedule_user_id[] = $user->user_id;
                    }
                } else {
                    $schedule_user_id[] = 0;
                }
            }
        }

        if(!empty($this->selectZipCode)) { $this->selectZipCode = array_filter($this->selectZipCode); }
        if (!empty($this->selectZipCode)) {
            $selectZipCodes = collect($this->selectZipCode)->flatten()->toArray();
            $zip_code_user = \DB::table('personals')->WhereIn('zip_code',$selectZipCodes)->where('zip_code','!=','')->get()->toArray();
            if (count($zip_code_user) > 0) {
                $zip_code_user_id = array_column($zip_code_user, "user_id");
            } else {
                $zip_code_user_id[] = 0;
            }
        }

        if (!empty($this->selectWorkEnvironment)) {
            $work_environment_user = \DB::table('personals');
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
            $compensation_user_user = \DB::table('personals');
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
            $salary_range_user = \DB::table('personals');
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
            $positions = explode(',', $this->selectCurrentPosition);
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
                 // 86a3d361e
                 foreach ($industry_user as $user) {
                    $industry_user_id[] = $user->user_id;
                    if (!empty($user->user_id)) {
                        if ($user->primary_status == 1) {
                            $primary_interest_user_id[] = $user->user_id;
                        }
                    }
                }
                // 86a3d361e
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

        if (!empty($this->selectedLanguages)) { // task - 86a1uf3ar
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
        }

        $company_users = CompanyUser::select('user_id','deleted_at','status')->where('company_id', $this->company)->get()->toArray(); // task - 86a0unh6f

        $companyZip = \DB::table('companies')->where('id', $this->company)->first();

        // $candidates = User::withTrashed(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companyUsers'])
        // task - 86a1tzdqv - POINT - 8
        $zipcode_val = ($this->sort_order == 'ASC') ? 0 : 9999999; // task - distance filter
        $candidates = User::select('users.*', \DB::raw('(select group_concat(name_status,",",email_status,",",phone_status,",",current_title_status,",",zip_code_status,",",linkedin_url_status,",",additional_url_status,",",short_bio_status,",",profile_status,",",country_name_status) as personal_status from personals where user_id = users.id  GROUP BY `user_id`) as personal_status'), \DB::raw('(select group_concat(program_name_status,",",organization_name_status,",",course_description_status,",",start_year_status) as edu_status from educations where user_id = users.id) as edu_status'), \DB::raw('(select group_concat(company_name_status,",",position_status,",",responsibilities_status,",",start_year_status,",",accomplishments_status) as emp_status from employments where user_id = users.id) as emp_status'), \DB::raw('(select group_concat(name_status,",", relationship_status,",", phone_status,",", email_status) as ref_status from `references` where user_id = users.id) as ref_status'), \DB::raw('(select IF(lat is null or lat = "", 0, 1) from personals where user_id=users.id) as loc'), \DB::raw('(select IF(zip_code = "'.$companyZip->zip_code.'", '.$zipcode_val.', zip_code) from personals where user_id=users.id) as zipcode'))->withTrashed(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companyUsers'])
            ->where('user_type', 'candidate');
            if (!empty($primary_interest_user_id)) {
                $candidates = $candidates->orderByRaw("FIELD(id, " . implode(',', $primary_interest_user_id) . ") DESC");
            }
            if(!empty($this->active_subscription->plan_id )){
            if ($this->active_subscription->plan_id == 1) {

                // THE RECRUITER THING SHOULD NOT DETERMINE ANYTHING RIGHT NOW. THIS IS DATA WE WILL USE WHEN WE START TO SELL RECRUITER POSITIONS!
                // $candidates= $candidates->where('allow_recuiters','!=',1); task - 86a2qrx00
            } if ($this->active_subscription->plan_id == 2) {
                /* task - https://app.clickup.com/t/86a1zmk5b?comment=90130022720538&threadedComment=90130023364650
                $candidates= $candidates->where('allow_recuiters','!=',1); */
            }
        }
        $candidates->whereNull('deleted_at'); // task - 86a0qvr0b
        if(!empty($this->active_subscription)) { // task - 862k46g33
            $candidates->where('status', 1); // task - 86a0qvqdk
            $candidates->whereNull('deleted_at'); // task - 86a0qvr0b
            if ($this->active_subscription->plan_id == 1) {
                // $candidates->where('created_at', '<=', Carbon::now()->subHours(24)->toDateTimeString());
                $c_HR = date('G');
                // var_dump($c_HR);
                if($c_HR < 8) {
                    $candidates->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, users.created_at, NOW()))"), '>', 24);
                } else {
                    // $candidates->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, users.created_at, NOW()))"), '>', 24)
                              // ->where(\DB::raw($c_HR), ">=", 8);
                    $candidates->where(\DB::raw("DATE(users.created_at) < DATE(NOW())"), '=', 1)->where(\DB::raw($c_HR), ">=", 8);
                }
                /*$candidates->where(function($q) {
                    $q->where(function($query) {
                        $query->where('created_at', '<=', Carbon::now()->subHours(48)->toDateTimeString());
                    })
                    ->orWhere(function($query) {
                        $query->where('created_at', '<=', Carbon::now()->subHours(24)->toDateTimeString())
                              ->where(\DB::raw('HOUR(NOW())'), ">=", 8);
                    });
                });*/
            } elseif ($this->active_subscription->plan_id == 2) {
                // code...
            } elseif ($this->active_subscription->plan_id == 3) {
                // code...
            }

        }

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

        /*$candidates->whereHas('companiesFoUnmasked', function ($q) {
            return $q->where('company_id', $this->company)
                ->whereNull('deleted_at') // task - 86a0unh6f
                ->where('status', 1);
        });*/

        if(!$this->filterDistance && $this->sortBy != 'distance') {
            if($this->sortBy == 'newest') { // task - 86a37wfvx
                // $candidates = $candidates->orderBy('loc', 'DESC'); // task - 86a2yeydc
            }
        } else {
            $candidates = $candidates->orderBy('zipcode', ($this->sort_order == 'ASC' ? 'DESC' : 'ASC'));
            $candidates = $candidates->havingRaw('zipcode != ""');
        }
        if (!empty($this->sortBy)) {
            if ($this->sortBy == 'alpha') {
                $candidates = $candidates->orderBy('name', $this->sort_order);
            } /*elseif ($this->sortBy == 'distance') {
            }*/ elseif ($this->sortBy == 'newest') {
                $candidates = $candidates->orderBy('created_at', $this->sort_order);
            } /*else {
            }*/
        } else {
            $candidates = $candidates->orderBy('id', $this->sort_order);
        }
        // $this->candidates_count = $candidates->count();
        if ($this->sortBy != 'experience' && !$this->filterYearOfExperience) {
            $this->users_id = $candidates->pluck('id')->toArray();
        }

        // years of experience
        $filteredUser = clone $candidates;
        $filteredUsersExp = [];
        // $filteredUsersExp = $filteredUser->get();

        $new_list = [];
        $exp_sorting_arr = [];
        if ($this->sortBy == 'experience' || $this->filterYearOfExperience) {
            $filteredUsersExp = $filteredUser->get();
            $this->users_id = $filteredUsersExp->pluck('id')->toArray();
            if (($this->selectMaxYearOfExperience - $this->selectMinYearOfExperience) <= 40 && ($this->selectMaxYearOfExperience - $this->selectMinYearOfExperience) >= 0) {
                foreach ($filteredUsersExp as $key => $user) {
                    // task - 862k3eurn
                    $employments = $user->employments->toArray();
                    $yrs_of_exp = 0; $exp_months = 0;

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

            // task - 86a2vc36u
            if ($new_list) {
                if (empty($this->searched_users_id)) {
                    $this->searched_users_id = $new_list;
                } else {
                    $this->searched_users_id = array_merge($this->searched_users_id, $new_list);
                }
            }
        }

        $this->candidates_count = count($this->users_id);

        // distance
        /*$filteredUserForDistance = clone $candidates;
        $filteredUsersDist = $filteredUsersExp; // task - 86a2tvv3d*/
        $new_list_distance = [];
        $sorting_arr = [];
        $api_failed_count = 0;
        $_temp_distance = []; // task - 86a2ynnvw
        if ($this->sortBy == 'distance' || $this->filterDistance) { // task - 86a0btjx8
            $filteredUsersDist = (!empty($filteredUsersExp)) ? $filteredUsersExp : $filteredUser->get();
            // $companyZip = \DB::table('companies')->where('id', $this->company)->first();
            if (($this->selectMaxDistance - $this->selectMinDistance) <= 100 && ($this->selectMaxDistance - $this->selectMinDistance) > 0) {
                foreach ($filteredUsersDist as $key => $user) {
                    // $first = \DB::table('personals')->where('user_id', $user->id)->first();
                    $first = $user->personal;
                    if (!empty($first)) {
                        $dist = "Failed";
                        if($first->lat && $first->lng && $companyZip->lng && $companyZip->lng) {
                            $dist = degrees_difference($first->lat, $first->lng, $companyZip->lat, $companyZip->lng);
                        }

                        $_temp_distance[$user->id] = (is_numeric($dist)) ? round($dist, 2) : (($this->sort_order == "ASC") ? 500 : -1); // task - 86a2ynnvw

                        // task - 86a2rvvjq
                        if ($dist != "Failed") {
                            if ($dist >= $this->selectMinDistance && $dist <= $this->selectMaxDistance) {
                                $new_list_distance[] = $user->id;
                                $sorting_arr[$user->id] = $dist;
                            } else {
                                /* task - 86a2yeydc $new_list_distance[] = $user->id;
                                $sorting_arr[$user->id] = $dist;*/
                            }
                        } else {
                            /*if ($this->selectMinDistance == 0) { // task - 86a2ynnvw
                                $new_list_distance[] = $user->id;
                                $sorting_arr[$user->id] = 0;
                            }*/

                            // task - 86a2yeydc
                            if (!$this->filterDistance) {
                                $new_list_distance[] = $user->id;
                                $sorting_arr[$user->id] = ($this->sort_order == "ASC") ? 500 : -1;
                            }
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
            /*if ($sorting_arr) {
                if($this->sort_order == "ASC") {
                    asort($sorting_arr);
                } else {
                    arsort($sorting_arr);
                }
                $order_by_keys = array_keys($sorting_arr);
                $candidates->orderByRaw("FIELD(id, " . implode(',', $order_by_keys) . ")");
            }*/

            // task - 86a2vc36u
            if ($new_list_distance) {
                if (empty($this->searched_users_id)) {
                    $this->searched_users_id = $new_list_distance;
                } else {
                    $this->searched_users_id = array_merge($this->searched_users_id, $new_list_distance);
                }
            }
        }

        // task - 86a2ynnvw
        if(empty($this->candidate_dist)) {
            $this->candidate_dist = $_temp_distance;
        } else {
            $this->candidate_dist = $this->candidate_dist + $_temp_distance;
        }
        // task - 86a2ynnvw

        $this->searched_users_id = array_filter(array_unique($this->searched_users_id)); // task - 86a2vc36u

        $filteredCount = clone $candidates;
        $filteredUserCount = $filteredCount->count();

        // task - 86a3150au
        // $all_candidates = clone $candidates;
        // $all_candidates_ids = $filteredCount->pluck('id')->toArray();
        $all_candidates_ids = $this->users_id;

        // task - 86a2vwzh3
        // $fav_count_quary = clone $candidates;
        $favorites_count = Favorite::where('company_id', $this->company)->whereIn('candidate_id',$all_candidates_ids)->whereRaw('(search_id IS NULL OR search_id=0)')->count();

        $this->my_favorites = Favorite::where('company_id', $this->company)->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();

        if ($this->category == 'favorites') {
            if($this->favorite_load == 0) { $this->page = 1; }
            $_candidates = $candidates->whereIn('id', $this->my_favorites);

            $filteredCount = clone $_candidates;
            $filteredUserCount = $filteredCount->count();
        }
        // task - 86a2vwzh3 end

        $_candidates = $candidates->forPage($this->page, 6)
            ->get();
        // dd(\DB::getQueryLog());
        if ($this->page == 1) {
            $this->temp_candidates = [];
        }
        if(empty($this->temp_candidates)) {
            $candidates = $this->temp_candidates = $_candidates;

            // task - 86a2rvv8z
            $temp_candid = $_candidates->toArray();
            $p_status_arr = array_column($temp_candid, 'personal_status', 'id');
            $edu_status_arr = array_column($temp_candid, 'edu_status', 'id');
            $emp_status_arr = array_column($temp_candid, 'emp_status', 'id');
            $ref_status_arr = array_column($temp_candid, 'ref_status', 'id');
            $this->personal_status_ = $p_status_arr;
            $this->edu_status_ = $edu_status_arr;
            $this->emp_status_ = $emp_status_arr;
            $this->ref_status_ = $ref_status_arr;
        } else {
            $candidates = $this->temp_candidates->merge($_candidates);
            $this->temp_candidates = $candidates;

            // task - 86a2rvv8z
            $temp_candid = $_candidates->toArray();
            $p_status_arr = array_column($temp_candid, 'personal_status', 'id');
            $edu_status_arr = array_column($temp_candid, 'edu_status', 'id');
            $emp_status_arr = array_column($temp_candid, 'emp_status', 'id');
            $ref_status_arr = array_column($temp_candid, 'ref_status', 'id');

            $this->personal_status_ = $this->personal_status_ + $p_status_arr;
            $this->edu_status_ = $this->edu_status_ + $edu_status_arr;
            $this->emp_status_ = $this->emp_status_ + $emp_status_arr;
            $this->ref_status_ = $this->ref_status_ + $ref_status_arr;
            // dd($this->personal_status, $status_fields_arr);
        }

        if ($this->firstSearch == "true") {
            $mySearches = Search::where('company_id', $this->company)->first();
            // task - 86a1n51ck
            if (empty($mySearches) && ((!empty($this->selectedHardSkills) || !empty($this->selectedSoftSkills) || !empty($this->selectedIndustries) || !empty($this->selectedInterests) || !empty($this->selectedLanguages) || !empty($this->selectSchedule) || !empty($this->selectSalaryRange) || !empty($this->selectCurrentPosition) || !empty($this->selectWorkEnvironment) || !empty($this->selectCompensation)))) {
                //$this->saveSearch();
                $this->dispatchBrowserEvent('openSaveSearchPopUp');
            }
        }

        $this->dispatchBrowserEvent('enableBody');
        $this->dispatchBrowserEvent('updateLoadMore');

        if ($this->is_filtered && !$this->save_click) {
            $this->dispatchBrowserEvent('loadAfterload');
        }

        $this->all_zipcodes = ZipCode::pluck('zip_code')->toArray();
        return view('livewire.company-dashboard', compact('candidates','filteredUserCount','company_users', 'favorites_count', 'all_candidates_ids'));
    }

    public function loadMore()
    {
        // task - 86a1uf3ar - LOAD MORE
        // $this->count += 6;

        // task - 86a2vwzh3
        if ($this->category == "favorites") {
            $this->favorite_load = 1;
        } else {
            $this->favorite_load = 0;
        }
        // task - 86a2vwzh3 end

        $this->page += 1;
        $this->is_filtered = true;
        $this->firstSearch = false;
        $this->dispatchBrowserEvent('blockBody');
        $this->dispatchBrowserEvent('initAfterload');
    }

    // task - 86a2vwzh3
    public function filterByCategory($category)
    {
        $this->category = $category;
        $this->is_filtered = true;
        $this->dispatchBrowserEvent('initAfterload');
    }
    // task - 86a2vwzh3 end

    /*public function calculateDistance($zip1, $zip2)
    {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$zip1&destinations=$zip2&key=" . env('MAP_API_KEY');

        $data = file_get_contents($url);

        $result = json_decode($data, true);
        $distance = "Failed";

        // Extract the distance in meters
        if (!empty($result['rows'][0]['elements'][0]['distance']['value'])) {

            $distance = $result['rows'][0]['elements'][0]['distance']['value'];

            // Convert meters to miles
            $distance = $distance * 0.000621371;
        }
        return $distance;
    }*/

    // function degrees_difference($lat1, $lon1, $lat2, $lon2) {
    //     $theta = $lon1 - $lon2;
    //     $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
    //           cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
    //           cos(deg2rad($theta));

    //     $dist = acos($dist);
    //     $dist = rad2deg($dist);

    //     $distance = $dist * 60 ; // * 1.1515
    //     $distance = $dist / 1.58 ; // 1.609344
    //     return $distance;
    // }

    /*function degrees_difference($lat1, $lon1, $lat2, $lon2) {
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;

        $a = sin($deltaLat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($deltaLon / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Earth radius in nautical miles
        $earthRadius = 3440.065;

        $distance = $earthRadius * $c;

        return $distance;
    }*/

    // task - 86a0wte46
    public function clearMessage()
    {
        $this->save_click = 1;
        $this->resetErrorBag();
        $this->resetValidation();
        return response()->json([]);
    }

    public function saveSearch()
    {
        // task - 86a0wte46
        $this->validate([
            'search_name' => ['required', 'string'],
        ]);

        if(!empty($this->selectZipCode)) { $this->selectZipCode = array_filter($this->selectZipCode); }

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

        // dd('here');
        if (Auth::user()->reference) {
            $ref_user = Auth::user()->reference;
            $company_id = Company::where('user_id', $ref_user)->pluck('id')->first();
        } else {
            $company_id = Company::where('user_id', Auth::user()->id)->pluck('id')->first();
        }

        $slug = new Slug();
        $search = Search::create([
            'name' => trim($this->search_name)!="" ? trim($this->search_name) : 'First Search',
            'search_fields' => json_encode($search_fields),
            'old_match_count' => $this->candidates_count,
            'company_id' => $company_id,
            'synced_users' => json_encode($this->users_id),
            'old_synced_users' => json_encode($this->users_id), // task - 86a26mwgd
            'slug' => $slug->createSlug(trim($this->search_name)!="" ? trim($this->search_name) : 'First Search'),
        ]);

        $this->emit(event:'updateSeraches'); // update seaches on save

        // $search->users()->sync($this->users_id);
        foreach ($this->users_id as $_id) {
            // $search->users()->sync(['user_id' => $_id, 'last_viewed' => date('Y-m-d H:i:s', strtotime('INTERVAL -24 HOUR'))]);
            $tmDate = time();
            \DB::table('search_user')->insert([
                ['user_id' => $_id, 'search_id' => $search->id, 'last_viewed' => date('Y-m-d H:i:s', strtotime('-1 day', $tmDate))]
            ]);
        }

        $this->dispatchBrowserEvent('close-search');
        $this->save_click = 0;
        \Session::put('sidebar', '');

        $this->search_name = '';
    }

    public function sendRequest($id)
    {
        $company_id = 0; $company_name = null;
        if ($this->auth_user->reference > 0) {
            $user_id = $this->auth_user->reference;
            $company_id = Company::where('user_id', $this->auth_user->reference)->pluck('id')->first();
            $company_name = Company::where('user_id', $this->auth_user->reference)->pluck('company_name')->first();
        } else {
            $user_id = Auth::user()->id;
            $company_id = Company::where('user_id', Auth::user()->id)->pluck('id')->first();
            $company_name = Company::where('user_id', Auth::user()->id)->pluck('company_name')->first();
        }
        $existingRequest = CompanyUser::where('user_id', $id)
    ->where('company_id', $company_id)
    ->first();
    if(!$existingRequest){
        $requested=new CompanyUser;
        $requested->company_id=$company_id;
        $requested->user_id=$id;
        $requested->position_hiring=$this->position_hiring;
        $requested->message=$this->message;
        if($requested->save()){
            // task - 8678fd0em
            $tracking = \DB::table('employer_tracking')->where('employer_id', $user_id)->first();
            $track_arr = array(
                'employer_id' => $user_id,
                'last_unmask_req' => date('Y-m-d H:i:s'),
            );
            if ($tracking) {
                \DB::table('employer_tracking')->where('employer_id', $user_id)->update($track_arr);
            } else {
                $track_arr['last_matches_on'] = date('Y-m-d H:i:s');
                \DB::table('employer_tracking')->insert($track_arr);
            }
            // task - 8678fd0em end

            // task - 8678fkau6
            $candidate = User::find($id);
            $name = explode(' ', trim($candidate->name)); // task - 86a15vje7
            $data = array('name' => $name[0]/*candidate->name*/, 'company' => $company_name, 'hiring_position' => $this->position_hiring, 'message_txt' => $this->message, 'date' => date('m-d-Y'));
            $to_mail = $candidate->email;

            \Mail::send(['html'=>'mail.notify_request_unmask'], $data, function($message) use ($to_mail) {
                 $message->to($to_mail, 'Purple Stairs')->subject
                    ('Congrats! An Employer is Interested');
                 $message->from('info@purplestairs.com','Purple Stairs');
            });
            // task - 8678fkau6 end

            $this->position_hiring = '';
            $this->message = '';

            $this->dispatchBrowserEvent('closeSecondaryModal');
            $this->dispatchBrowserEvent('close-request-modal'); // task - 86a10bj8u
            $this->dispatchBrowserEvent('loadAfterload');
            $this->emit(event:'updateCounts'); // task - 86a0yjymm
            $this->emit(event: 'updatePage');
            $this->emit(event: 'updateFavorites'); // task - 86a0yjymm

            $this->dispatchBrowserEvent('reqID', ['id' => $id]); // task - 86a2ykzx3
            $this->emit('updatePopup', $id); // task - 86a2ykzx3
        }
        }else{
        $this->emit(event: 'updatePage');
        $this->dispatchBrowserEvent('close-request-modal');
    }


        // Task 862k46fvz
        // User::find($id)->companies()->syncWithPivotValues(
        //     [
        //         'company_id' => Auth::user()->company->id
        //     ],
        //     [
        //         'position_hiring' => $this->position_hiring,
        //         'message' => $this->message
        //     ]
        // );

        // $this->position_hiring = '';
        // $this->message = '';

        // $this->emit(event: 'updatePage');
        // $this->dispatchBrowserEvent('close-request-modal');
        // return redirect()->route('company.dashboard');
    }

    public function saveNote()
    {
        // task - 862k46fhv
        $company_id = 0;
        if ($this->auth_user->reference > 0) {
            $company_id = Company::where('user_id', $this->auth_user->reference)->pluck('id')->first();
        } else {
            $company_id = Company::where('user_id', Auth::user()->id)->pluck('id')->first();
        }

        Note::create([
            'user_id' => $this->candidateProfile->id,
            'company_id' => $company_id,
            'created_by' => Auth::user()->id,
            'note' => $this->note
        ]);
        $this->dispatchBrowserEvent('close-notes');
        $this->notes = Note::where('user_id', $this->candidateProfile->id)->latest()->get();
        $this->note = '';

        // task - 86a39a7q5
        $this->saved_searches = Search::select('searches.*', \DB::raw('(select group_concat(user_id) from search_user where search_id=searches.id) as candidate_ids'))->where('company_id', $this->company)->get();
        foreach ($this->saved_searches as $k => $search_) {
            $this->saved_searches[$k]['candidate_ids'] = explode(',', $search_->candidate_ids);
        }
    }

    // dev
    public function changeEvent($is_checked, $search_id, $candidate_id)
    {
        $search_user = \DB::table('search_user')->where(['search_id' => $search_id, 'user_id' => $candidate_id])->first();
        // if already in saved search user
        if (!empty($search_user) && $is_checked == 1) {
            // \DB::table('search_user')->where('id', $search_user->id)->delete();
            \DB::table('search_user')->where(['search_id' => $search_id, 'user_id' => $candidate_id])->delete();
        } elseif (empty($search_user) && $is_checked == 0) {
            \DB::table('search_user')->insert([
                'search_id' => $search_id,
                'user_id' => $candidate_id
            ]);
        }

        $search = Search::find($search_id);

        if ($is_checked == 0) {
            $userIds=json_decode($search->synced_users);
            if(!in_array($candidate_id, $userIds)) { $userIds[]=$candidate_id; };

            $userIds2 = json_decode($search->old_synced_users);
            if(!in_array($candidate_id, $userIds2)) { $userIds2[]=$candidate_id; };
            $search->synced_users=$userIds;
            $search->old_synced_users=$userIds2;
        } elseif ($is_checked == 1) {
            $userIds=json_decode($search->synced_users);
             $index = array_search($candidate_id, $userIds);
            if ($index !== false) {
                array_splice($userIds, $index, 1);
            }

            // task - 86a2rvvjz
            $userIds2 = json_decode($search->old_synced_users);
            if(!in_array($candidate_id, $userIds2)) { $userIds2[]=$candidate_id; };
            $search->old_synced_users=$userIds2;

            $search->synced_users=$userIds;
        }
        $search->save();

        $search_count = \DB::table('search_user')->where(['search_id' => $search_id])->count();
        $search = Search::find($search_id);
        $search->old_match_count = $search_count;
        if ($search->save()) {
            $this->dispatchBrowserEvent('loadAfterload');
            $this->emit(event: 'updateSeraches');
        }
        // $this->emit(event: 'updateSearchCount');
        //return Searches::render();
    }
}
