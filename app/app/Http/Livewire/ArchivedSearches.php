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
use App\Models\Delete;
use App\Models\Subscription;
use App\Models\ZipCode;
use DB;
use Searches;

class ArchivedSearches extends Component
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
        $all_zipcodes,
        $selectZipCode,

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
        $all_current_position;
    public $company = '';
    public $past_search_match_users = [];
    public $users_id = [];
    public $searched_users_id;
    public $saved_searches = [];
    public $login_user = '';

    public $active_subscription = [];
    public $page = 1, $offset = 0, $temp_searches = [];
    public $count = 6;
    protected $listeners = ['refreshComponent2' => 'render','deleteSearch','loadMore'];

    public function mount()
    {
        $this->login_user = Auth::user()->reference ? Auth::user()->reference : Auth::user()->id;
        $this->company = Company::where('user_id', $this->login_user)->pluck('id')->first();

        /*if (Auth::user()->reference) {
            $ref_user = Auth::user()->reference;
        } else {
            $this->company = Company::where('user_id', Auth::user()->id)->pluck('id')->first();
        }*/

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
        $this->all_zipcodes = ZipCode::pluck('zip_code')->toArray();;
    }

    public function render()
    {
          if ($this->page == 1) {
            $this->temp_searches = [];
        }
        $saved_searches = Search::where('company_id', $this->company)->where('deleted_at', '!=', "")->withTrashed()
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


        return view('livewire.archived-searches', compact('savedSearches','countSearches'));



    }

    public function newCondidate($slug)
    {


        $user_ids = [];
        $search = Search::withTrashed()->where('slug', $slug)->withTrashed()->first();
        $search_fields = json_decode($search->search_fields, true);
        $selectedHardSkills = $search_fields['selectedHardSkills'];
        $selectedSoftSkills = $search_fields['selectedSoftSkills'];
        $selectedIndustries = $search_fields['selectedIndustries'];
        $selectedInterests = $search_fields['selectedInterests'];
        $selectedLanguages = $search_fields['selectedLanguages'];
        $selectSchedule = $search_fields['selectSchedule'];
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
        $salary_range_user_id = [];
        $current_position_user_id = [];
        $work_environment_user_id = [];
        $compensation_user_id = [];
        // get saved serached of company
        if (!empty($selectSchedule)) {

            $schedule_user = \DB::table('personals');
            if (in_array('1', $selectSchedule)) {
                $schedule_user = $schedule_user->where('schedule_full_time', 1);
            }
            if (in_array('2', $selectSchedule)) {
                $schedule_user = $schedule_user->where('schedule_part_time', 1);
            }
            if (in_array('3', $selectSchedule)) {
                $schedule_user = $schedule_user->where('schedule_no_preference', 1);
            }
            $schedule_user = $schedule_user->get();
            if (count($schedule_user) > 0) {
                foreach ($schedule_user as $user) {
                    $schedule_user_id[] = $user->user_id;
                }
            } else {
                $schedule_user_id[] = 0;
            }
        }


        if (!empty($selectWorkEnvironment)) {

            $work_environment_user = \DB::table('personals');
            if (in_array('1', $selectWorkEnvironment)) {
                $work_environment_user = $work_environment_user->where('work_environment_remote', 1);
            }
            if (in_array('2', $selectWorkEnvironment)) {
                $work_environment_user = $work_environment_user->where('work_environment_in_office', 1);
            }
            if (in_array('3', $selectWorkEnvironment)) {
                $work_environment_user = $work_environment_user->where('work_environment_hybrid', 1);
            }
            $work_environment_user = $work_environment_user->get();
            if (count($work_environment_user) > 0) {
                foreach ($work_environment_user as $user) {
                    $work_environment_user_id[] = $user->user_id;
                }
            } else {
                $work_environment_user_id[] = 0;
            }
        }

        if (!empty($selectCompensation)) {

            $compensation_user_user = \DB::table('personals');
            if (in_array('1', $selectCompensation)) {
                $compensation_user_user = $compensation_user_user->where('compensation_salary', 1);
            }
            if (in_array('2', $selectCompensation)) {
                $compensation_user_user = $compensation_user_user->where('compensation_hourly', 1);
            }
            if (in_array('3', $selectCompensation)) {
                $compensation_user_user = $compensation_user_user->where('compensation_comission_based', 1);
            }
            $compensation_user_user = $compensation_user_user->get();
            if (count($compensation_user_user) > 0) {
                foreach ($compensation_user_user as $user) {
                    $compensation_user_id[] = $user->user_id;
                }
            } else {
                $compensation_user_id[] = 0;
            }
        }

        if (!empty($selectSalaryRange)) {

            $salary_range_user = \DB::table('personals');
            $salary_range_user = $salary_range_user->whereIn('salary_range', $selectSalaryRange);
            $salary_range_user = $salary_range_user->get();
            if (count($salary_range_user) > 0) {
                foreach ($salary_range_user as $user) {
                    $salary_range_user_id[] = $user->user_id;
                }
            } else {
                $salary_range_user_id[] = 0;
            }
        }
        if (!empty($selectCurrentPosition)) {
            $positions= explode(',',$selectCurrentPosition[0]);
            $current_position_user = \DB::table('personals')->whereIn('current_title', $positions)->get();
            if (count($current_position_user) > 0) {
                foreach ($current_position_user as $user) {
                    $current_position_user_id[] = $user->user_id;
                }
            } else {
                $current_position_user_id[] = 0;
            }
        }


        if (!empty($selectedHardSkills)) {

            $skill_user = \DB::table('skill_user')->whereIn('skill_id', $selectedHardSkills)->get();
            if (count($skill_user) > 0) {
                foreach ($skill_user as $user) {
                    $hard_skill_user_id[] = $user->user_id;
                }
            } else {
                $hard_skill_user_id[] = 0;
            }
        }

        if (!empty($selectedSoftSkills)) {
            $soft_skill_user_id[] = '';
            $skill_user = \DB::table('skill_user')->whereIn('skill_id', $selectedSoftSkills)->get();
            if (count($skill_user) > 0) {
                foreach ($skill_user as $user) {
                    $soft_skill_user_id[] = $user->user_id;
                }
            } else {
                $soft_skill_user_id[] = 0;
            }
        }

        if (!empty($selectedIndustries)) {
            $industry_user_id[] = '';
            $industry_user = \DB::table('industry_user')->whereIn('industry_id', $selectedIndustries)->get();
            if (count($industry_user) > 0) {
                foreach ($industry_user as $user) {
                    $industry_user_id[] = $user->user_id;
                }
            } else {
                $industry_user_id[] = 0;
            }
        }

        // print_r($industry_user_id);

        if (!empty($selectedInterests)) {
            $interest_user_id[] = '';
            $interest_user = \DB::table('interest_user')->whereIn('interest_id', $selectedInterests)->get();
            if (count($interest_user) > 0) {
                foreach ($interest_user as $user) {
                    $interest_user_id[] = $user->user_id;
                }
            } else {
                $interest_user_id[] = 0;
            }
        }

        if (!empty($selectedLanguages)) {
            $language_user_id[] = '';
            $language_user = \DB::table('language_user')->whereIn('language_id', $selectedLanguages)->get();
            if (count($language_user) > 0) {
                foreach ($language_user as $user) {
                    $language_user_id[] = $user->user_id;
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
            array_unique($salary_range_user_id),
            array_unique($current_position_user_id),
            array_unique($work_environment_user_id),
            array_unique($compensation_user_id),
        ]);

        $searched_users_id = "";
        // Get common items
        if (!empty($arrays)) {

            $searched_users_id = call_user_func_array('array_intersect', $arrays);
        } else {

            $searched_users_id = $arrays;
        }


        $candidates = User::with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal'])
            ->where('user_type', 'candidate');
        if (
            !empty($selectedHardSkills) ||
            !empty($selectedSoftSkills) ||
            !empty($selectedIndustries) ||
            !empty($selectedInterests) ||
            !empty($selectedLanguages) ||
            !empty($selectSchedule) ||
            !empty($selectSalaryRange) ||
            !empty($selectCurrentPosition) ||
            !empty($selectWorkEnvironment) ||
            !empty($selectCompensation)
        ) {

            $candidates = $candidates->whereIn('id', array_unique($searched_users_id));
        }

        // years of experience
        $filteredUser = clone $candidates;
        $new_list = [];
        if (($selectMaxYearOfExperience - $selectMinYearOfExperience) < 100 && ($selectMaxYearOfExperience - $selectMinYearOfExperience) > 0) {
            foreach ($filteredUser->get() as $key => $user) {
                $first = \DB::table('employments')->where('user_id', $user->id)->first();
                if (!empty($first)) {
                    $diff = abs(strtotime(date('M Y')) - strtotime($first->start_year));
                    $diff = floor($diff / (365 * 60 * 60 * 24));
                    if ($diff >= $selectMinYearOfExperience && $diff <= $selectMaxYearOfExperience) {
                        $new_list[] = $user->id;
                    }
                }
            }
            $candidates = $candidates->whereIn('id', $new_list);
        }

        // distance
        $filteredUserForDistance = clone $candidates;
        $new_list_distance = [];
        if (($selectMinDistance - $selectMaxDistance) < 100 && ($selectMinDistance - $selectMaxDistance) > 0) {
            foreach ($filteredUserForDistance->get() as $key => $user) {
                $first = \DB::table('employments')->where('user_id', $user->id)->first();
                if (!empty($first)) {
                    $diff = abs(strtotime(date('M Y')) - strtotime($first->start_year));
                    $diff = floor($diff / (365 * 60 * 60 * 24));
                    if ($diff >= $selectMinDistance && $diff <= $selectMaxDistance) {
                        $new_list[] = $user->id;
                    }
                }
            }
            $candidates = $candidates->whereIn('id', $new_list_distance);
        }

        return array_unique($candidates->pluck('id')->toArray());


        // return $candidates->pluck('id')->toArray();
    }

    public function loadMore()
    {
        $this->page += 1;
    }
    public function unArchiveSearch($id)
    {

        $Search = Search::withTrashed()->find($id);
        if($Search->restore()){
        return redirect('company/archived-searches');
    }
        // return redirect()
    }
}
