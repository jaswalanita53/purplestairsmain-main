<?php

namespace App\Http\Livewire;

use App\Models\Note;
use App\Models\Favorite;
use App\Models\Search;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Industry;
use App\Models\Interest;
use App\Models\Language;
use App\Models\Skill;
use App\Models\WorkEnvironment;
use App\Models\Schedule;
use App\Models\Compensation;
use App\Models\Salary;
use App\Models\IdealJobAttribute;
use App\Models\Personal;
use App\services\slug;
use App\Models\Subscription;
use App\Models\CompanyUser;
use App\Models\Delete;
use DB;
use Searches;
use Log;
use Illuminate\Support\Carbon;

class RequestedList extends Component
{
    public $slug;

    public User $candidateProfile;

    public $count = 100;

    public $search_name;
    public $search_id;
    public $candidates_count;



    //search entities
    public
        $all_industries,
        $selectedIndustries,
        $all_interests,
        $selectedInterests,
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
        $selectDistance,
        $selectSeekingPosition,
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
        $all_work_environments,
        $all_schedules,
        $all_compensations,
        $all_salaries,
        $all_ideal_job_attributes,
        $all_current_position;


    //note section
    public $notes;
    public $note;
    public $api_failed;

    //sorting
     public $sortBy = 'newest';

    //filter section goes
    public $category = 'suggested';

    // saved search
    public $login_user = '';
    public $auth_user = '';
    public $company = '';
    public $saved_searches = [];
    public $view_id = '';
    public $past_search_match_users = [];
    public $users_id = [];
    public $my_favorites = [];
    public $searched_users_id;

    public $active_subscription = [];

    protected $listeners = ['viewProfile', 'updateFavorites' => '$refresh'];

    public $sort_order = "DESC",
    $sort_icon = "down-icon.svg",
    $is_filtered = false,
    $sort_icon2 = "up-icon-gr.svg"; // task - 86a2vxfb2
    
    public $active_tab = 2;

    public function mount()
    {
        $this->auth_user = Auth::user();
        $this->login_user = Auth::user()->id;

        if (Auth::user()->reference) {
            $ref_user = Auth::user()->reference;
            $company_id = User::find($ref_user)->company->id;
        } else {
            $company_id = Auth::user()->company->id;
        }

        if ($this->auth_user->reference > 0) {
            $this->company = Company::where('user_id', $this->auth_user->reference)->pluck('id')->first();
        } else {
            $this->company = Company::where('user_id', $this->login_user)->pluck('id')->first();
        }


        // redirect if company subscription expired
        $sub_user_id = Auth::user()->reference ? Auth::user()->reference : Auth::user()->id;
        $subscription = Subscription::where('user_id', $sub_user_id)->where('status', 1)->orderBy('id', 'desc')->first();
        $this->active_subscription = $subscription; // task - 862k46g33
        
        // validate login user
        validateUser($subscription);

        //get saved search
        $search = Search::where('slug', $this->slug)->first();

        if ($search) {

        } else {
            $archive_search = Search::where('slug', $this->slug)->onlyTrashed()->first();
        }
        // $search = Search::where('slug', $this->slug)->first();
        //getting all industries and authenticated users industries
        $this->all_industries = Industry::where('status', 1)->orderBy('name', 'asc')->pluck('id', 'name')->toArray();;

        //getting all interests and authenticated users interests
        $this->all_interests = Interest::orderBy('name', 'asc')->pluck('id', 'name')->toArray();

        //getting all languages and authenticated users languages
        $this->all_languages = Language::orderBy('name', 'asc')->pluck('id', 'name')->toArray();

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
    }

    public function render()
    {
        // find new candidates
        $new_candidates = User::with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companies'])
            ->where('user_type', 'candidate')
            ->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, NOW(), users.created_at))"), "<", 24);

        if(!empty($this->active_subscription)) { // task - 862k46g33
            if ($this->active_subscription->plan_id == 1) {
                $c_HR = date('G');
                if($c_HR < 8) {
                    $new_candidates->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, users.created_at, NOW()))"), '>', 24);
                } else {
                    $new_candidates->where(\DB::raw("DATE(users.created_at) < DATE(NOW())"), '=', 1)->where(\DB::raw($c_HR), ">=", 8);
                }
            } elseif ($this->active_subscription->plan_id == 2) {
                // code...
            }
        }
        $new_candidates_count = $new_candidates->count();
        $new_candidates_ids = $new_candidates->pluck('id')->toArray();

        $this->my_favorites = Favorite::where('company_id', $this->company)->whereNull('search_id')->where('req_flag', 0)->pluck('candidate_id')->toArray();

        $requested_count = 0;
        $unmasked_count = 0;

        $this->saved_searches = Search::where('company_id', $this->company)->get();
        foreach ($this->saved_searches as $k => $search_) {
            $search_candidate = $search_->users->toArray();
            $this->saved_searches[$k]['candidate_ids'] = array_column($search_candidate, 'id');
        }

        $companyZip = \DB::table('companies')->where('id', $this->company)->first(); // task - 86a36x5ra
        $zipcode_val = ($this->sort_order == 'DESC') ? 0 : 9999999; // task - 86a36x5ra

        $candidates = User::select('users.*', \DB::raw('(SELECT GROUP_CONCAT(CONCAT("<a href=\''.url('company/saved-search/').'/", slug, "\'>", name, "</a>")) FROM searches WHERE id IN (SELECT GROUP_CONCAT(search_id) FROM search_user WHERE user_id = users.id GROUP BY search_id) AND company_id = '.$this->company.') AS saved_list'),\DB::raw('(select IF(zip_code = "'.$companyZip->zip_code.'" and 1='.($this->sort_order == 'DESC' ? 1 : 0).', '.$zipcode_val.', zip_code) from personals where user_id=users.id) as zipcode'))
        ->with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companies'])
        ->withTrashed()
        ->where('user_type', 'candidate');

            $candidates->where('status', 1); // task - 86a0qvr0b
            $candidates->whereNull('deleted_at'); // task - 86a0qvr0b

            if(/*$this->filterDistance && */$this->sortBy == 'distance') { // task - 86a36x5ra
                $candidates = $candidates->orderBy('zipcode', ($this->sort_order == 'ASC' ? 'DESC' : 'ASC'));
                $candidates = $candidates->havingRaw('zipcode != ""');
            }
            
            if (!empty($this->sortBy)) {
                if ($this->sortBy == 'alpha') {
                    $candidates = $candidates->orderBy('name', $this->sort_order);
                } elseif ($this->sortBy == 'distance') {
                } elseif ($this->sortBy == 'newest') {
                    $candidates = $candidates->orderBy('created_at', $this->sort_order);
                } else {
                }
            } else {
                $candidates = $candidates->orderBy('id', $this->sort_order);
            }
            // $this->candidates_count = $candidates->count();
            $this->users_id = $candidates->pluck('id')->toArray();

        // years of experience
        $filteredUser = clone $candidates;
        $filteredUsersExp = $filteredUser->get();
        $new_list = [];
        $exp_sorting_arr = [];
        if ($this->sortBy == 'experience' || $this->filterYearOfExperience) {
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

        if ($this->sortBy == 'distance' || $this->filterDistance) { // task - 86a0btjx8
            $companyZip = \DB::table('companies')->where('id', $this->company)->first();
            if (($this->selectMaxDistance - $this->selectMinDistance) <= 100 && ($this->selectMaxDistance - $this->selectMinDistance) > 0) {
                foreach ($filteredUserForDistance->get() as $key => $user) {
                    // $first = \DB::table('personals')->where('user_id', $user->id)->first();
                    $first = $user->personal;
                    if (!empty($first)) {
                        // $dist = $this->calculateDistance($first->zip_code, $companyZip->zip_code);
                        $dist = "Failed";
                        if($first->lat && $first->lng && $companyZip->lng && $companyZip->lng) {
                            $dist = degrees_difference($first->lat, $first->lng, $companyZip->lng, $companyZip->lng);
                                    // dd($this->company, $first->id, $dist, $dist2);
                                    // dd( $dist);
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
                            if (!$this->filterDistance) {
                                $new_list_distance[] = $user->id;
                                $sorting_arr[$user->id] = ($this->sort_order == "ASC") ? 500 : -1;
                            }
                        }
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
        $existing_candidates = $candidates->pluck('id')->toArray();
        foreach ($new_candidates_ids as $_id) {
            if (!in_array($_id, $existing_candidates)) {
                $tmDate = time();
                if(isset($search)) {
                    \DB::table('search_user')->insert([
                        'user_id' => $_id,
                        'search_id' => $search->id ,
                        'viewed' => 0,
                        'last_viewed' => date('Y-m-d H:i:s', strtotime('-1 day', $tmDate))
                    ]);
                }
            }
        }

        $requested_count_quary = clone $candidates;
        $requested_count = $requested_count_quary->whereHas('companies', function ($q) {
            return $q->where('company_id', $this->company)
                ->where('status', 0);
        })->count();
        $unmasked_count_quary = clone $candidates;
        $unmasked_count = $unmasked_count_quary->whereHas('companies', function ($q) {
            return $q->where('company_id', $this->company)
                ->where('status', 1);
        })->count();

        $fav_count_quary = clone $candidates;
        // task - 86a1gw5uh
        $fav_count_quary = clone $candidates;
        $fav_count_quary->whereHas('companies', function ($q) {
            return $q->where('company_id', $this->company)
                ->where('status', 0);
        })->get();
        $favorites_count = Favorite::where('company_id', $this->company)->whereIn('candidate_id',$fav_count_quary->pluck('id'))->whereNull('search_id')->count();

        if ($this->category == 'favorites') {
            $candidates = $candidates->whereIn('id', $this->my_favorites);
        } else {
        }

        $candidates = $candidates->whereHas('companies', function ($q) {
            return $q->where('company_id', $this->company)
                ->where('status', 0);
        })->get();

        return view('livewire.requested-list', compact('candidates', 'favorites_count', 'requested_count', 'unmasked_count', 'new_candidates_ids'));
    }

    public function viewProfile($user_id)
    {
        $this->view_id = $user_id;
        // get saved serached of company
        $this->saved_searches = Search::where('company_id', $this->company)->get();
        foreach ($this->saved_searches as $k => $search_) {
            $search_candidate = $search_->users->toArray();
            $this->saved_searches[$k]['candidate_ids'] = array_column($search_candidate, 'id');
        }

        $this->candidateProfile = User::where('id', $user_id)
            ->with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companies'])
            ->where('user_type', 'candidate')->first();

        $this->dispatchBrowserEvent('open-profile-modal');
        $this->dispatchBrowserEvent('show-profile-modal');
    }

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

        if ($is_checked == 0) { // task - 86a26mwgd
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
            $this->emit(event: 'updateSeraches');
            //return response()->json([]);
            die();
            // exit();
        }
        //return Searches::render();
    }

    // task - 86a1gw5uh
    public function saveFavorite($user_id)
    {
        $favorite = Favorite::where(['company_id' => $this->company, 'candidate_id' => $user_id,'search_id' => null, 'req_flag' => 0])->first();
        if(empty($favorite)){
            $favorite = Favorite::create([
                'company_id' => $this->company,
                'candidate_id' => $user_id,
                'search_id' => null,
                'req_flag' => 0,
            ]);
        }
        return response()->json();
    }

    public function removeFavorite($user_id)
    {
        $favorite = Favorite::where(['company_id' => $this->company, 'candidate_id' => $user_id,'search_id' => null,'req_flag' => 0])->first();
        if ($favorite) {
            $favorite->delete();
        }

        $this->my_favorites = Favorite::where('company_id', $this->company)->whereNull('search_id')->where('req_flag', 0)->pluck('candidate_id')->toArray();
        $this->emit(event: 'updateFavorites');

        return response()->json();
    }

    public function filterByCategory($category)
    {
        $this->category = $category;
    }
}
