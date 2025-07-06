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
use App\Models\ZipCode;
use DB;
use Searches;
use Log;
use Illuminate\Support\Carbon;
use Session; //86a2qrw1r
// use Illuminate\Support\Facades\Schema; // task - 86a1tzdqv

class SavedSearch extends Component
{
    public $slug;

    public User $candidateProfile;

    public $count = 9; // task - 86a2qrtan

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
        $all_zip_codes,
        $all_current_position;


    //note section
    public $notes;
    public $note;
    public $api_failed;

    //sorting
     public $sortBy = 'newest';

    //filter section goes
    public $category = ['unmarked'];

    //86a2zt9nn new match
    public $categoryNew = [''];

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

    protected $listeners = ['viewProfile', 'updateFavorites' => '$refresh', 'loadMore', 'applyFilter' => 'applyFilter']; // task - 86a2qrtan | 86a309hbq

    public $sort_order = "DESC",
    $sort_icon = "down-icon.svg",
    $sort_icon2 = "up-icon-gr.svg"; // task - 86a2vxfb2

    public $archive_search_message = null;

    public $is_filtered = false;
    public $is_submit = false;
    public $is_save = false;
    public $is_run = true;

    public $active_tab = 2; // task - 86a0b69ev
    public $page = 1, $offset = 0, $temp_candidates = []; // task - 86a2qrtan
    public $personal_status_ = [], $edu_status_ = [], $emp_status_ = [], $ref_status_ = []; // task - 86a2rvv8z

    public $relevants = []; // task - 86a309hbq
    public $non_relevants = []; // task - 86a309hbq
    public $unmarked = []; // task - 86a309hbq
    public $applied_filter = []; // task - 86a309hbq

    public $search;
    public $new_condidate_ids = [];
    public $all_candidates_ids;
    public function mount()
    {
        $this->auth_user = Auth::user();
        $this->login_user = Auth::user()->id;

        if (Auth::user()->reference) {
            $ref_user = Auth::user()->reference;
            $company_id = User::find($ref_user)->company->id;
        } else {
            $company_id = $this->auth_user->company->id;
        }

        $this->company = $company_id;
        /*if ($this->auth_user->reference > 0) {
            $this->company = Company::where('user_id', $this->auth_user->reference)->pluck('id')->first();
        } else {
            $this->company = Company::where('user_id', $this->login_user)->pluck('id')->first();
        }*/

        // redirect if company subscription expired
        // $sub_user_id = Auth::user()->reference ? Auth::user()->reference : Auth::user()->id;
        $sub_user_id = ($this->auth_user->reference > 0) ? $this->auth_user->reference : $this->auth_user->id;
        $subscription = Subscription::where('user_id', $sub_user_id)->where('status', 1)->orderBy('id', 'desc')->first();
        $this->active_subscription = $subscription; // task - 862k46g33

        // validate login user
        validateUser($subscription);

        //get saved search
        $this->search = Search::where('slug', $this->slug)->first();
        $search = $this->search;
        // dd($search);
        if ($search) {

        } else {
            $archive_search = Search::where('slug', $this->slug)->onlyTrashed()->first();
            if ($archive_search) {
                echo "<script>window.location.href = '" . url('/company/archived-search/'.$this->slug) . "';</script>"; die();
            } else {
                echo "<script>window.location.href = '" . url('/company/saved-searches') . "';</script>"; die();
            }
        }

        // $search = Search::where('slug', $this->slug)->first();
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

        $this->all_zip_codes = ZipCode::distinct()->pluck('zip_code');
        $this->all_zipcodes = ZipCode::pluck('zip_code')->toArray();

        // 86a2qrw1r
        // $search = Search::where('slug', $this->slug)->first(); // task - 86a0t9838

        $old_synced_search_users = [];
        if($search->old_synced_users)
        {
            $old_synced_search_users = json_decode($search->old_synced_users, true);
            $past_search_match_users = json_decode($search->synced_users, true);
            $this->past_search_match_users = $past_search_match_users;
        } else {
            $search = $archive_search = Search::where('slug', $this->slug)->onlyTrashed()->first();
            $past_search_match_users = json_decode($archive_search->synced_users, true);
            $old_synced_search_users = json_decode($archive_search->old_synced_users, true);
        }

        $this->new_condidate_ids = $this->newCondidate();
        $new_candidates = User::with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companies'])
        ->where('user_type', 'candidate')
        ->whereIn('id', $this->new_condidate_ids);
        // ->whereNotIn('id', $old_synced_search_users);

        $not_in_ids = array_merge($old_synced_search_users, $past_search_match_users);
        $not_in_ids = array_unique($not_in_ids);

        $allNewCan = clone $new_candidates;
        $allNewCan=$allNewCan->whereNotIn('id', $not_in_ids)->get();
        if(!empty($allNewCan)){
            foreach($allNewCan as $singleNewCan){
                \DB::table('search_user')->insert([
                    'search_id' => $search->id,
                    'user_id' => $singleNewCan->id
                ]);
            }
            // end 86a2qrw1r
        }
    }

    public function render()
    {
        // get saved searched of company
        // $this->saved_searches = Search::where('company_id', $this->company)->get();?
        $company_users = [];
        //get saved search
        $search = Search::where('slug', $this->slug)->first();
        // $new_condidates = $this->newCondidate();
        $new_condidates = $this->new_condidate_ids;
        $search_fields = [];
        if ($search) {
            $userIds=json_decode($search->synced_users);
            //86a2zt9nn new match
            $searchFirst = Search::with('newMatch')->find($search->id);
            $searchUsers = DB::table('search_user')->where('search_id',$search->id)->pluck('user_id')->toArray();

            foreach($new_condidates as $candidate_id){
                if(in_array($candidate_id,$searchUsers)){
                    $userIds[]=$candidate_id;
                    $userIds=array_unique($userIds);
                    if($searchFirst) $searchFirst->synced_users=$userIds;
                }
            }
            if($searchFirst) $searchFirst->save();

            //86a2zt9nn new match
            $search = Search::where('slug', $this->slug)->with('newMatch')->first(); // task - 86a0t9838

            $search_fields = json_decode($search->search_fields, true);
            $old_synced_search_users = []; // task - 86a26mwgd
            if($search->old_synced_users) $old_synced_search_users = json_decode($search->old_synced_users, true); // task - 86a26mwgd
            $past_search_match_users = json_decode($search->synced_users, true);

            $company_users = CompanyUser::select('user_id','deleted_at','status')->whereIn('user_id', $past_search_match_users)->whereNotIn('user_id', $old_synced_search_users)->where('company_id', $this->company)->get()->toArray(); // task - 86a0qvtjx

            $this->past_search_match_users = $past_search_match_users;
        } else {
            //86a2zt9nn new match
            $search = $archive_search = Search::where('slug', $this->slug)->with('newMatch')->onlyTrashed()->first();
            if (!empty($archive_search->synced_users)) {
                $past_search_match_users = json_decode($archive_search->synced_users, true);
            } else {
                $past_search_match_users = [];
            }

            if (!empty($archive_search->old_synced_users)) {
                $old_synced_search_users = json_decode($archive_search->old_synced_users, true);
            } else {
                $old_synced_search_users = [];
            }
        }

        // find new candidates
       $new_candidates = User::with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companies'])
            ->where('user_type', 'candidate')
            ->whereIn('id', $new_condidates)
            ->whereNotIn('id', $old_synced_search_users);
            // ->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, NOW(), users.created_at))"), "<", 24)

        if(!empty($this->active_subscription)) { // task - 862k46g33
            if ($this->active_subscription->plan_id == 1) {
                // $new_candidates->where('created_at', '<=', Carbon::now()->subHours(24)->toDateTimeString());
                $c_HR = date('G');
                if($c_HR < 8) {
                    $new_candidates->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, users.created_at, NOW()))"), '>', 24);
                } else {
                    // $new_candidates->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, users.created_at, NOW()))"), '>', 24)
                    //           ->where(\DB::raw($c_HR), ">=", 8);
                    $new_candidates->where(\DB::raw("DATE(users.created_at) < DATE(NOW())"), '=', 1)->where(\DB::raw($c_HR), ">=", 8);
                }
            } elseif ($this->active_subscription->plan_id == 2) {
                // code...
            }
        }
        $new_candidates_ids = $new_candidates->whereNotIn('id', $past_search_match_users)->pluck('id')->toArray();
        $new_candidates_count = count($new_candidates_ids);

        // \DB::enableQueryLog();
        if(!empty($search->id)){
        $this->my_favorites = Favorite::where('company_id', $this->company)->where('search_id',$search->id)->pluck('candidate_id')->toArray();
        }

        // get new count after de-select from + sign for manual add/remove
        $search_count = \DB::table('search_user')->where(['search_id' => $search->id])->count();
        $search->match_count = $search_count;
        $search->new_match_count = $new_candidates_count;

        $requested_count = 0;
        $unmasked_count = 0;
        //86a2zt9nn new match
        $this->saved_searches = Search::select('searches.*', \DB::raw('(select group_concat(user_id) from search_user where search_id=searches.id) as candidate_ids'))->where('company_id', $this->company)->with('newMatch')->get();
        foreach ($this->saved_searches as $k => $search_) {
            $this->saved_searches[$k]['candidate_ids'] = explode(',', $search_->candidate_ids);
            /*$search_candidate = $search_->users->toArray();
            $this->saved_searches[$k]['candidate_ids'] = array_column($search_candidate, 'id');*/
        }

        $companyZip = \DB::table('companies')->where('id', $this->company)->first(); // task - 86a36x5ra
        $search_uids =  \DB::table('search_user')->where(['search_id' => $search->id])->pluck('user_id')->toArray(); // task - 86a1gr1p8
        $zipcode_val = ($this->sort_order == 'DESC') ? 0 : 9999999; // task - 86a36x5ra

        $candidates = User::select('users.*', \DB::raw('(select group_concat(name_status,",",email_status,",",phone_status,",",current_title_status,",",zip_code_status,",",linkedin_url_status,",",additional_url_status,",",short_bio_status,",",profile_status,",",country_name_status) as personal_status from personals where user_id = users.id  GROUP BY `user_id`) as personal_status'), \DB::raw('(select group_concat(program_name_status,",",organization_name_status,",",course_description_status,",",start_year_status) as edu_status from educations where user_id = users.id) as edu_status'), \DB::raw('(select group_concat(company_name_status,",",position_status,",",responsibilities_status,",",start_year_status,",",accomplishments_status) as emp_status from employments where user_id = users.id) as emp_status'), \DB::raw('(select group_concat(name_status,",", relationship_status,",", phone_status,",", email_status) as ref_status from `references` where user_id = users.id) as ref_status'),\DB::raw('(select IF(zip_code = "'.$companyZip->zip_code.'" and 1='.($this->sort_order == 'DESC' ? 1 : 0).', '.$zipcode_val.', zip_code) from personals where user_id=users.id) as zipcode'))->with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companies','companyUsers'])
            ->withTrashed()->where('user_type', 'candidate');
        // $candidates = $candidates->whereIn('id',$past_search_match_users);
        $candidates = $candidates->whereIn('id',$search_uids); // task - 86a1gr1p8
        $candidates->where('status', 1); // task - 86a0qvqdk
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
        // $this->users_id = $candidates->pluck('id')->toArray();

              // years of experience
        $filteredUser = clone $candidates;
        // $filteredUsersExp = $filteredUser->get();
        $filteredUsersExp = [];
        $this->users_id = $filteredUser->pluck('id')->toArray();
        $this->candidates_count = count($this->users_id);

        $new_list = [];
        $exp_sorting_arr = [];
        if ($this->sortBy == 'experience'/* || $search->filterYearOfExperience*/) {
            $filteredUsersExp = $filteredUser->get();
          if (($search_fields['selectMaxYearOfExperience'] - $search_fields['selectMinYearOfExperience']) <= 40 && ($search_fields['selectMaxYearOfExperience'] - $search_fields['selectMinYearOfExperience']) >= 0) {
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
                  if ($yrs_of_exp >= $search_fields['selectMinYearOfExperience'] && $yrs_of_exp <= $search_fields['selectMaxYearOfExperience']) {
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
        /*$filteredUserForDistance = clone $candidates;
        $filteredUsersDist = $filteredUsersExp;*/
        $filteredUsersDist = [];
        $new_list_distance = [];
        $sorting_arr = [];
        $api_failed_count = 0;

        if ($this->sortBy == 'distance' /*|| $search->filterDistance*/) { // task - 86a0btjx8
            $filteredUsersDist = (!empty($filteredUsersExp)) ? $filteredUsersExp : $filteredUser->get();
            // $companyZip = \DB::table('companies')->where('id', $this->company)->first();
            if (($search_fields['selectMaxDistance'] - $search_fields['selectMinDistance']) <= 100 && ($search_fields['selectMaxDistance'] - $search_fields['selectMinDistance']) > 0) {
                foreach ($filteredUsersDist as $key => $user) {
                    // $first = \DB::table('personals')->where('user_id', $user->id)->first();
                    $first = $user->personal;
                    if (!empty($first)) {
                        $dist = "Failed";
                        if($first->lat && $first->lng && $companyZip->lng && $companyZip->lng) {
                            $dist = degrees_difference($first->lat, $first->lng, $companyZip->lng, $companyZip->lng);
                        }
                        // task - 86a2rvvjq
                        if ($dist != "Failed") {
                            if ($dist >= $search_fields['selectMinDistance'] && $dist <= $search_fields['selectMaxDistance']) {
                                $new_list_distance[] = $user->id;
                                $sorting_arr[$user->id] = $dist;
                            } else {
                                /* task - 86a2yeydc $new_list_distance[] = $user->id;
                                $sorting_arr[$user->id] = $dist;*/
                            }
                        } else {
                            if (!$search_fields['filterDistance']) {
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
        // $existing_candidates = $candidates->pluck('id')->toArray();
        $existing_candidates = $this->users_id;
        foreach ($new_candidates_ids as $_id) {
            if (!in_array($_id, $existing_candidates)) {
                $tmDate = time();
                \DB::table('search_user')->insert([
                    'user_id' => $_id,
                    'search_id' => $search->id,
                    'viewed' => 0,
                    'last_viewed' => date('Y-m-d H:i:s', strtotime('-1 day', $tmDate))
                ]);
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

        /*$fav_count_quary = clone $candidates;
        $fav_count_quary_ids = $fav_count_quary->pluck('id');*/
        $fav_count_quary_ids = $this->users_id;
        $favorites_count = Favorite::where('company_id', $this->company)->whereIn('candidate_id',$fav_count_quary_ids)->where('search_id',$search->id)->count();

        // task - 86a309hbq
        $this->relevants = \DB::table('relevant')->where('company_id', $this->company)->whereIn('candidate_id',$fav_count_quary_ids)->where('search_id',$search->id)->pluck('candidate_id')->toArray();
        $this->non_relevants = \DB::table('non_relevant')->where('company_id', $this->company)->whereIn('candidate_id',$fav_count_quary_ids)->where('search_id',$search->id)->pluck('candidate_id')->toArray();

        $unmarked_count_quary = clone $candidates;
        $marked_ids = array_merge($this->my_favorites, $this->relevants, $this->non_relevants);
        $marked_ids = array_unique($marked_ids);
        $this->unmarked = $unmarked_count_quary->whereNotIn('id', $marked_ids)->pluck('id')->toArray();

        $this->applied_filter = [];
        if (in_array('favorites', $this->category)) {
            $this->applied_filter = array_merge($this->applied_filter, $this->my_favorites);
        }

        if (in_array('relevant', $this->category)) {
            $this->applied_filter = array_merge($this->applied_filter, $this->relevants);
        }

        if (in_array('nonrelevant', $this->category)) {
            $this->applied_filter = array_merge($this->applied_filter, $this->non_relevants);
        }

        if (in_array('unmarked', $this->category)) {
            $this->applied_filter = $this->unmarked;
        }
        $this->applied_filter = array_unique($this->applied_filter);

        // task - 86a2qrtan
        if ($this->page == 1) {
            $this->temp_candidates = [];
        }

        if(in_array('unmarked', $this->category) || in_array('requested', $this->category) || in_array('unmasked', $this->category) || in_array('new', $this->category)) {
            if (in_array('requested', $this->category)) {

                // task - 86a2qrtan
                $_candidates = $candidates->whereHas('companies', function ($q) {
                    return $q->where('company_id', $this->company)
                        ->where('status', 0);
                });

                $filteredCount = clone $_candidates;
                $filteredUserCount = $filteredCount->count();

            } elseif (in_array('unmasked', $this->category)) {
                // task - 86a39a9g3
                $_candidates = $candidates->whereHas('companies', function ($q) {
                    return $q->where('company_id', $this->company)
                        ->where('status', 1);
                });

                $filteredCount = clone $_candidates;
                $filteredUserCount = $filteredCount->count();

            } elseif (in_array('new', $this->category)) {
                //86a2zt9nn speed issue
                $new_matche_candidates_ids = \DB::table('new_search_matches')->where('search_id', $search->id)->where('status', 0)->pluck('match_uid');
                // 86a2zt9nn new unmasked

                $candidates = $candidates->whereIn('id', $new_matche_candidates_ids);
                $_candidates = clone $candidates;
                //86a2zt9nn new match
                $new_match_candidates = \DB::table('new_search_matches')->where('search_id', $search->id)->where('status', 0)->get();
                foreach ($new_match_candidates as $new_match_candidate) {
                    if (!empty($new_match_candidate->updated_at)) {
                        $updated_at = Carbon::parse($new_match_candidate->viewed_at);
                        if ($updated_at->diffInHours(\Carbon\Carbon::now()) >= 24) {
                            \DB::table('new_search_matches')
                                ->where('id', $new_match_candidate->id)
                                ->where('search_id', $search->id)
                                ->update(['status' => 1]);
                        }else{
                            \DB::table('new_search_matches')
                                ->where('id', $new_match_candidate->id)
                                ->where('search_id', $search->id)
                                ->update(['viewed_at' => \Carbon\Carbon::now()]);
                        }
                    }
                }

                $filteredCount = clone $candidates;
                $filteredUserCount = $filteredCount->count();
            } elseif (in_array('unmarked', $this->category)) {
                $_candidates = clone $candidates;
                if ($this->applied_filter) {
                    // if($this->favorite_load == 0) { $this->page = 1; }
                    $_candidates = $candidates->whereIn('id', $this->applied_filter);
                }

                $filteredCount = clone $_candidates;
                $filteredUserCount = $filteredCount->count();
            }
        } elseif(in_array('favorites', $this->category) || in_array('relevant', $this->category) || in_array('nonrelevant', $this->category)) {
            $_candidates = clone $candidates;
            // dd($this->applied_filter);
            // if ($this->applied_filter) {
                // if($this->favorite_load == 0) { $this->page = 1; }
                $_candidates = $candidates->whereIn('id', $this->applied_filter);

            // }
            $filteredCount = clone $_candidates;
            $filteredUserCount = $filteredCount->count();
        } else {
            // task - 86a2qrtan
            $filteredCount = clone $candidates;
            $filteredUserCount = $filteredCount->count();

            $_candidates = $candidates->groupBy('users.id');
        }

        $allUser = clone $_candidates;
        $this->all_candidates_ids = $allUser->pluck('id')->toArray();
        $_candidates = $_candidates->forPage($this->page, $this->count)->get();

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
        }
        // dd(\DB::getQueryLog());
        $this->dispatchBrowserEvent('enableBody');
        $this->dispatchBrowserEvent('updateLoadMore');

        if ($this->is_filtered) {
            // $this->dispatchBrowserEvent('loadAfterload');
        }

        $this->all_zipcodes = ZipCode::pluck('zip_code')->toArray();
        return view('livewire.saved-search', compact('candidates', 'search', 'favorites_count', 'requested_count', 'unmasked_count', 'past_search_match_users', 'new_candidates_ids', 'filteredUserCount', 'company_users'));
    }

    // task - 86a2qrtan
    public function loadMore()
    {
        $this->page += 1;
        $this->is_filtered = true;
        $this->dispatchBrowserEvent('blockBody');
        $this->dispatchBrowserEvent('initAfterload');
    }

    public function saveFavorite($user_id,$search_id)
    {
        $this->dispatchBrowserEvent('close-profile-modal');
        $favorite = Favorite::where(['company_id' => $this->company, 'candidate_id' => $user_id,'search_id' => $search_id])->first();
        if(empty($favorite)){
            $favorite = Favorite::create([
                'company_id' => $this->company,
                'candidate_id' => $user_id,
                'search_id' => $search_id
            ]);
        }

        // loom video updates : 19/03/24
        // $this->dispatchBrowserEvent('highlight_favorite', ['id' => $user_id, 'search' => $search_id]);
        // return json_encode([]);
        // exit();
    }

    public function removeFavorite($user_id,$search_id)
    {
        $this->dispatchBrowserEvent('close-profile-modal');

        $favorite = Favorite::where(['company_id' => $this->company, 'candidate_id' => $user_id,'search_id' => $search_id])->first();
        if ($favorite) {
            $favorite->delete();
        }

        $this->my_favorites = Favorite::where('company_id', $this->company)->where('search_id', $search_id)->pluck('candidate_id')->toArray();

        // loom video updates : 19/03/24
        // $this->emit(event: 'updateFavorites');
        $this->dispatchBrowserEvent('remove_highlight_favorite', ['id' => $user_id, 'search' => $search_id]);
        return json_encode([]);
        exit();
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

    public function saveNote()
    {
        Note::create([
            'user_id' => $this->candidateProfile->id,
            'company_id' => $this->company,
            'created_by' => Auth::user()->id,
            'note' => $this->note
        ]);
        $this->dispatchBrowserEvent('close-notes');
        $this->notes = Note::where('user_id', $this->candidateProfile->id)->latest()->get();
        $this->note = '';
    }

    // task - 86a309hbq
    /*public function filterByCategory($category)
    {
        $this->category = $category;
    }*/

    //86a2zt9nn new match
    public function filterByCategoryForNew($category)
    {
        $this->categoryNew = $category;
    }

    public function applyFilter($filter)
    {
        // $this->temp_candidates = [];
        $this->page = 1;
        if (in_array($filter, $this->category)) {
            $key = array_search($filter, $this->category);
            unset($this->category[$key]);
        } else {
            if ( in_array($filter, ['unmarked','requested', 'unmasked', 'new'])) {
                $this->category = [];
                $this->category[] = $filter;
            } else {
                if (in_array('unmarked', $this->category)) {
                    $key = array_search('unmarked', $this->category);
                    unset($this->category[$key]);
                }
                if (in_array('requested', $this->category)) {
                    $key = array_search('requested', $this->category);
                    unset($this->category[$key]);
                }
                if (in_array('unmasked', $this->category)) {
                    $key = array_search('unmasked', $this->category);
                    unset($this->category[$key]);
                }
                if (in_array('new', $this->category)) {
                    $key = array_search('new', $this->category);
                    request()->session()->flash('newView', 'This is new matches');
                    unset($this->category[$key]);
                }
                $this->category[] = $filter;
            }
            if ($filter == "") {
                $this->category = [];
            }
        }
        $this->is_filtered = true;
        $this->dispatchBrowserEvent('initAfterload');
    }
    // task - 86a309hbq end

    public function filterNew()
    {
        $this->category = 'new';
    }

    public function changeEvent($is_checked, $search_id, $candidate_id)
    {
        $search_user = \DB::table('search_user')->where(['search_id' => $search_id, 'user_id' => $candidate_id])->first();
        // if already in saved search user
        if (!empty($search_user) && $is_checked == 1) {
            \DB::table('search_user')->where('id', $search_user->id)->delete();
        }
        elseif (empty($search_user) && $is_checked == 0) {
            \DB::table('search_user')->insert([
                'search_id' => $search_id,
                'user_id' => $candidate_id
            ]);
        }

        $search = Search::find($search_id);

        if ($is_checked == 0) {
            $userIds=json_decode($search->synced_users);
            $userIds[]=$candidate_id;
            $search->synced_users=$userIds;

            // $search->synced_users;
        } elseif ($is_checked == 1) {
            $userIds=json_decode($search->synced_users);
             $index = array_search($candidate_id, $userIds);
            if ($index !== false) {
                // array_splice($userIds, $index, 1);
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
        }
        $this->emit(event: 'updateSearchCount');
    }

    public function deleteSearch($id)
    {
        $search=Search::find($id);
        $slug=$search->slug;
        if($search->delete()){
            // request()->session()->flash('success', 'This saved search has been archived.');
            $this->archive_search_message = 'This saved search has been archived.';
            // return redirect('company/archived-search/'.$slug);
            // return redirect('company/archived-searches')->with('success', 'This saved search has been archived.'); // task - 86a0y5twp
        }
        $this->dispatchBrowserEvent('show-edit-modal');
        // exit();
    }

    // task - 86a1h4d9k
    public function delete_Search($id)
    {
        $search=Search::find($id);
        if($search){
            \DB::table('searches')->where('id', $id)->delete();
            request()->session()->flash('message', 'Saved search has been deleted.');
            return redirect('company/saved-searches');
        }
        request()->session()->flash('error', 'Saved search not found.');
        return redirect('company/saved-searches');
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

                        // $this->dispatchBrowserEvent('closeModal');
                        return redirect('company/saved-search/'.$search->slug);
            }
        }
    }

    public function sendRequest($id)
    {

        $company_id = 0;
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
        $requested->sender_id=Auth::id();
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

            $this->emit(event: 'updatePage');
            $this->dispatchBrowserEvent('close-request-modal');
        }
        }else{
        $this->emit(event: 'updatePage');
        $this->dispatchBrowserEvent('close-request-modal');
    }

        // Task 862k46fvz
        // User::find($id)->companies()->syncWithPivotValues(
        //     [
        //         'company_id' => $this->company
        //     ],
        //     [
        //         'position_hiring' => $this->position_hiring,
        //         'message' => $this->message
        //     ]
        // );
        // return redirect()->route('company.dashboard');
    }


    public function newCondidate()
    {
        $user_ids = [];
        $search = Search::where('slug', $this->slug)->withTrashed()->first();
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

            $schedule_user = \DB::table('personals')->select('user_id');
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
            $zip_code_user = \DB::table('personals')->select('user_id')
            ->WhereIn('zip_code',$selectZipCodes)->where('zip_code','!=','')->get()->toArray();

            if (count($zip_code_user) > 0) {
                $zip_code_user_id = array_column($zip_code_user, "user_id");
            } else {
                $zip_code_user_id[] = 0;
            }

        }

        if (!empty($selectWorkEnvironment)) {
            $work_environment_user = \DB::table('personals')->select('user_id');
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
            $compensation_user_user = \DB::table('personals')->select('user_id');
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
            $salary_range_user = \DB::table('personals')->select('user_id');
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
            $current_position_user = \DB::table('personals')->select('user_id')
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
            $skill_user = \DB::table('skill_user')->select('user_id')->whereIn('skill_id', $selectedHardSkills)->get()->toArray();
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
            $skill_user = \DB::table('skill_user')->select('user_id')->whereIn('skill_id', $selectedSoftSkills)->get()->toArray();
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
            $industry_user = \DB::table('industry_user')->select('user_id')->whereIn('industry_id', $selectedIndustries)->get()->toArray();
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
            $interest_user = \DB::table('interest_user')->select('user_id')->whereIn('interest_id', $selectedInterests)->get()->toArray();
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
        $candidates = User::withTrashed(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companyUsers'])
            ->where('user_type', 'candidate');
        if(!empty($this->active_subscription->plan_id)){
            if ($this->active_subscription->plan_id == 1) {

                // THE RECRUITER THING SHOULD NOT DETERMINE ANYTHING RIGHT NOW. THIS IS DATA WE WILL USE WHEN WE START TO SELL RECRUITER POSITIONS!
                // $candidates= $candidates->where('allow_recuiters','!=',1); task - 86a2qrx00
            } if ($this->active_subscription->plan_id == 2) {
                /* task - https://app.clickup.com/t/86a1zmk5b?comment=90130022720538&threadedComment=90130023364650
                $candidates= $candidates->where('allow_recuiters','!=',1); */
            }
        }
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
        // $filteredUsersExp = $filteredUser->get();
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
        // dd($searched_users_id, $dup_ids, $old_synced_users);
        return array_unique($candidates->pluck('id')->toArray());
        // return $candidates->pluck('id')->toArray();
    }
}
