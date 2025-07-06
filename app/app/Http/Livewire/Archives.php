<?php

namespace App\Http\Livewire;


use App\Models\Search;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Subscription;
use App\Models\NewSearchMatch;

class Archives extends Component
{


    public $company = '';
    public $active_subscription = '';
    public $auth_user = '';
    public $login_user = '';


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

        $subscription = Subscription::where('user_id', $this->login_user)->where('status', 1)->orderBy('id', 'desc')->first();
        $this->active_subscription = $subscription;
    }

    public function render()
    {
        $searches = Search::where('company_id', $this->company)->with('newMatch')->with('searchUser')->withTrashed()->get();


        return view('livewire.archives',compact('searches'));
    }

    public function update_search()
    {
        $side_searches = [];
        return view('livewire.searches',compact('side_searches'));
    }

    // 86a2qrw1r
    public function newCondidate($slug)
    {
        $user_ids = [];
        $search = Search::where('slug', $slug)->withTrashed()->first();
        // dd($search->search_fields);
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
                    $match_result = array_intersect($this->selectedLanguages, $users_langs);
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
        $filteredUsersExp = $filteredUser->get();
        $new_list = [];
        if (($selectMaxYearOfExperience - $selectMinYearOfExperience) < 40 && ($selectMaxYearOfExperience - $selectMinYearOfExperience) > 0) {
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
        $filteredUserForDistance = clone $candidates;
        // $filteredUsersDist = $filteredUserForDistance->get();
        $filteredUsersDist = $filteredUsersExp;
        $new_list_distance = [];
        $sorting_arr = [];
        $api_failed_count = 0;
        $companyZip = \DB::table('companies')->where('id', $this->company)->first();
        if (($selectMaxDistance - $selectMinDistance) < 100 && ($selectMaxDistance - $selectMinDistance) > 0) {
            foreach ($filteredUsersDist as $key => $user) {
                // $first = \DB::table('personals')->where('user_id', $user->id)->first();
                $first = $user->personal;
                if (!empty($first)) {
                    // $rand = "5";
                    // $dist = $calculateDistance($first->zip_code, $companyZip->zip_code);
                    $dist = "Failed";
                    if($first->lat && $first->lng && $companyZip->lng && $companyZip->lng) {
                        $dist = degrees_difference($first->lat, $first->lng, $companyZip->lat, $companyZip->lng);
                        // dd($company, $first->id, $dist, $dist2);
                    }
                    if ($dist != "Failed") {
                        if ($dist > $selectMinDistance && $dist < $selectMaxDistance) {
                            $new_list_distance[] = $user->id;
                            $sorting_arr[$user->id] = $dist;
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

        return array_unique($candidates->pluck('id')->toArray());


        // return $candidates->pluck('id')->toArray();
    }
}
