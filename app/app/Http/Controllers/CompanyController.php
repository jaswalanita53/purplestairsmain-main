<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\Company;
use App\Models\Favorite;

use App\Models\ViewedUser;
use App\Models\Invited_user;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use App\Models\Search;
use App\Models\CompanyUser;
use App\Models\Note;
use App\Models\{Industry,
    Interest,
    Language,
    Skill,
    WorkEnvironment,
    Schedule,
    Compensation,
    Salary,
    IdealJobAttribute,
    ZipCode,
};

class CompanyController extends Controller
{
    public function companystep1(){
        return view('pages.companystep1');
    }
    public function companystep2(){
        return view('pages.companystep2');
    }
    public function companystep3(){
        return view('pages.companystep3');
    }
    public function companystep4(){
        return view('pages.companystep4');
    }
    public function companystep5(){
        return view('pages.companystep5');
    }
    public function requests(){
        return view('pages.companyRequests');
    }
    public function dashboard(){
        if(!\Session::has('sidebar')) {
            \Session::put('sidebar','sidebar_show');
        }
        return view('pages.companydashboard');
    }
    public function candidateProfile($user_id){
        return view('pages.candidateprofile',compact('user_id'));
    }
    public function savedSearches(){
        return view('pages.savedsearches');
    }
    public function archivedSearches(){
        return view('pages.archivedsearches');
    }
    public function editProfile(){
        return view('pages.editcompanyprofile');
    }
    public function viewProfile(){
        return view('pages.viewcompanyprofile');
    }
    public function savedSearch($slug){
        return view('pages.savedsearch',compact('slug'));
    }
    public function archivedSearch($slug){
        return view('pages.archivedsearch',compact('slug'));
    }

    // task - 86a3150au
    public function candidateProfileModal($user_id, $search_id = 0){
        $this->auth_user = Auth::user();

        if ($this->auth_user->reference > 0) {
            $company_id = Company::where('user_id', $this->auth_user->reference)->pluck('id')->first();
        } else {
            $company_id = Company::where('user_id', $this->auth_user->id)->pluck('id')->first();
        }

        $search_id = $search_id;
        $candidate_user = User::select('users.*', \DB::raw('(select group_concat(name_status,",",email_status,",",phone_status,",",current_title_status,",",zip_code_status,",",linkedin_url_status,",",additional_url_status,",",short_bio_status,",",profile_status,",",country_name_status) as personal_status from personals where user_id = users.id  GROUP BY `user_id`) as  personal_status'), \DB::raw('(select group_concat(program_name_status,",",organization_name_status,",",course_description_status,",",start_year_status) as edu_status from educations where user_id = users.id) as edu_status'), \DB::raw('(select group_concat(company_name_status,",",position_status,",",responsibilities_status,",",start_year_status,",",accomplishments_status) as emp_status from employments where user_id = users.id) as emp_status'), \DB::raw('(select group_concat(name_status,",", relationship_status,",", phone_status,",", email_status) as ref_status from `references` where user_id = users.id) as ref_status'))->find($user_id);
        // $candidate_user = User::find($user_id);
        $published = false;
        $saved_searches = Search::where('company_id', $company_id)->get();
        foreach ($saved_searches as $k => $search_) {
            $search_candidate = $search_->users->toArray();
            $saved_searches[$k]['candidate_ids'] = array_column($search_candidate, 'id');
        }

        $favorites = Favorite::where('company_id', $company_id)->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
        $notes = Note::where('user_id', $user_id)->where('company_id', $company_id)->latest()->get();

        echo view('pages.candidates-profile-modal',compact('candidate_user', 'published', 'saved_searches','company_id','favorites', 'search_id','notes'));
    }
    public function editSearch($search_id){
        $all_industries = Industry::where('status', 1)->orderBy('name', 'asc')->pluck('id', 'name')->toArray();;
        $all_interests = Interest::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_languages = Language::orderByRaw('id=1 DESC,id=4 DESC, `name` ASC')->pluck('id', 'name')->toArray();
        $all_soft_skills = Skill::where('skill_type', 'soft_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_hard_skills = Skill::where('skill_type', 'hard_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_work_environments = WorkEnvironment::where('status', 1)->pluck('id', 'name')->toArray();
        $all_schedules = Schedule::where('status', 1)->pluck('id', 'name')->toArray();
        $all_compensations = Compensation::where('status', 1)->pluck('id', 'name')->toArray();
        $all_salaries = Salary::where('status', 1)->pluck('id', 'name')->toArray();
        $all_ideal_job_attributes = IdealJobAttribute::where('status', 1)->pluck('id', 'name')->toArray();
        $all_current_position = Personal::distinct()->pluck('current_title');
        $all_zipcodes = ZipCode::pluck('zip_code')->toArray();
        $search=Search::find($search_id);
        return view('inc.updateEditSearch',compact(
            'search',
            'all_industries',
            'all_interests',
            'all_languages',
            'all_soft_skills',
            'all_hard_skills',
            'all_work_environments',
            'all_schedules',
            'all_compensations',
            'all_salaries',
            'all_ideal_job_attributes',
            'all_current_position',
            'all_zipcodes'
        ));
    }

    public function candidateProfileSaveNote(Request $request, $user_id)
    {
        $input = $request->all();
        Note::create([
            'user_id' => $user_id,
            'company_id' => $input['company_id'],
            'created_by' => Auth::user()->id,
            'note' => $input['note']
        ]);

        echo '<li class="active">
            <div class="add_note_list_item">
                <div class="add_note_list_item_head">
                    <ul>
                        <li>
                            <span><img src="'. asset('assets/fe/images/prpl_calender.svg') .'" alt=""></span>'. date('m-d-Y') .'
                        </li>
                    </ul>
                </div>
                <div class="add_note_list_item_content">
                    tertert
                </div>
                <div class="add_note_list_item_ftr">
                    <h6>
                    <span><img src="'. asset('assets/fe/images/demo_avatar.svg') .'" alt=""></span>'. ucwords(Auth::user()->name) .'
                    </h6>
                </div>
            </div>
        </li>';
    }

    public function candidateProfileRequest(Request $request, $user_id)
    {
        $input = $request->all();

        $requested = new CompanyUser;
        $requested->company_id = $input['company_id'];
        $requested->user_id = $user_id;
        $requested->position_hiring = $input['subject'];
        $requested->message = $input['message'];
        if($requested->save()){
            echo '<div class="pending_unmask">
                <i class="iconc"><img src="'. asset('/assets/be/images/clock.svg') .'" alt=""></i>
                <div class="pending_unmask_rt">
                    <h6>Pending Unmask</h6>
                    <p>Profile Saved In Requested</p>
                </div>
            </div>';
        }
    }
    // task - 86a3150au end

    public function manageSubsciption(){
                // 86a2u68b3
                Session::forget('add-user');
                if (isset($_GET['add-user'])) {
                    Session::put('add-user',$_GET['add-user']);
                }
                // end 86a2u68b3
        return view('pages.managesubsciption');
    }

    // task - 86a28zyzx
    public function paymentHistory(){
        return view('pages.paymenthistory');
    }

    public function manageAccount(){
        return view('pages.manageaccount');
    }
    // task - 86a28zyzx

    public function updateLatLng()
    {
        $personals = Personal::all();
        $companies = Company::all();

        $pr_count = 0; $cm_count = 0;
        foreach($personals as $per) {
            if($per->zip_code) {
                $address = str_replace(" ", "+", $per->zip_code);

                $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=" . env('MAP_API_KEY'));
                $result = json_decode($json,true);

                $status = "Failed";
                if ($result['results']) {
                    $lat=$result['results'][0]['geometry']['location']['lat'];
                    $lng=$result['results'][0]['geometry']['location']['lng'];

                    $per->lat = $lat;
                    $per->lng = $lng;
                    $per->save();

                    $pr_count++;
                }
            }
        }
        echo "<br>".$pr_count."Persons updated.";

        foreach($companies as $com) {
            if($com->company_address) {
                $address = str_replace(" ", "+", $com->company_address);

                $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=" . env('MAP_API_KEY'));
                $result = json_decode($json,true);

                $status = "Failed";
                if ($result['results']) {
                    $lat=$result['results'][0]['geometry']['location']['lat'];
                    $lng=$result['results'][0]['geometry']['location']['lng'];

                    $com->lat = $lat;
                    $com->lng = $lng;
                    $com->save();

                    $cm_count++;
                }
            }
        }
        echo "<br>".$cm_count."Companies updated.";
    }

    // task - 86a0h5tzx
    public function requestedList(){
        return view('pages.requested_list');
    }

    public function unmaskedList(){
        return view('pages.unmasked_list');
    }
    // task - 86a0h5tzx end

    public function saveFavoriteMainList(Request $request)
    {
        $input = $request->all();
        $user_id = $input['user_id'];
        $search_id = (isset($input['search_id'])) ? $input['search_id'] : null;
        if (auth()->user()->reference) {
            $company_id = User::find($ref_user)->company->id;
        } else {
            $company_id = auth()->user()->company->id;
        }

        // task - 86a2vwzh3
        if ($search_id) {
            $favorite = Favorite::where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->first();
        } else {
            $favorite = Favorite::where(['company_id' => $company_id, 'candidate_id' => $user_id])->whereRaw('(search_id IS NULL OR search_id=0)')->first();
        }
        if(empty($favorite)){
            $favorite = Favorite::create([
                'company_id' => $company_id,
                'candidate_id' => $user_id,
                'search_id' => $search_id
            ]);
        }
        if ($search_id) {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
        } else {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
        }

        // echo count($favorite_cnt);
        $marked_ids = array_merge($favorite_cnt, $relevant_cnt, $nrelevant_cnt);
        $marked_ids = array_unique($marked_ids);
        echo json_encode(['favorite_cnt' => count($favorite_cnt), 'marked_ids' => count($marked_ids)]);
    }

    public function removeFavoriteMainList(Request $request)
    {
        $input = $request->all();
        $user_id = $input['user_id'];
        $search_id = (isset($input['search_id'])) ? $input['search_id'] : null;
        if (auth()->user()->reference) {
            $company_id = User::find($ref_user)->company->id;
        } else {
            $company_id = auth()->user()->company->id;
        }

        // task - 86a2vwzh3
        if ($search_id) {
            $favorite = Favorite::where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->first();
        } else {
            $favorite = Favorite::where(['company_id' => $company_id, 'candidate_id' => $user_id])->whereRaw('(search_id IS NULL OR search_id=0)')->first();
        }
        if ($favorite) {
            $favorite->delete();
        }

        if ($search_id) {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
        } else {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
        }
        // echo count($favorite_cnt);
        $marked_ids = array_merge($favorite_cnt, $relevant_cnt, $nrelevant_cnt);
        $marked_ids = array_unique($marked_ids);
        echo json_encode(['favorite_cnt' => count($favorite_cnt), 'marked_ids' => count($marked_ids)]);
    }

    public function saveFavorite(Request $request)
    {
        $input = $request->all();
        $user_id = $input['user_id'];
        $search_id = (isset($input['search_id'])) ? $input['search_id'] : null;
        $unmasked = (isset($input['unmasked'])) ? 1 : 0;
        if (auth()->user()->reference) {
            $company_id = User::find($ref_user)->company->id;
        } else {
            $company_id = auth()->user()->company->id;
        }

        // task - 86a2vwzh3
        if ($search_id) {
            $favorite = Favorite::where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->first();
        } else {
            $favorite = Favorite::where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->first();
        }
        if(empty($favorite)){
            $favorite = Favorite::create([
                'company_id' => $company_id,
                'candidate_id' => $user_id,
                'search_id' => $search_id, 'unmasked' => $unmasked
            ]);
        }
        // echo json_encode([]);
        if ($search_id) {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
        } else {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
        }

        // echo count($favorite_cnt);
        $marked_ids = array_merge($favorite_cnt, $relevant_cnt, $nrelevant_cnt);
        $marked_ids = array_unique($marked_ids);
        echo json_encode(['favorite_cnt' => count($favorite_cnt), 'marked_ids' => count($marked_ids)]);
    }

    public function removeFavorite(Request $request)
    {
        $input = $request->all();
        $user_id = $input['user_id'];
        $search_id = (isset($input['search_id'])) ? $input['search_id'] : null;
        $unmasked = (isset($input['unmasked'])) ? 1 : 0;
        if (auth()->user()->reference) {
            $company_id = User::find($ref_user)->company->id;
        } else {
            $company_id = auth()->user()->company->id;
        }

        // task - 86a2vwzh3
        if ($search_id) {
            $favorite = Favorite::where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->first();
        } else {
            $favorite = Favorite::where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->first();
        }
        if ($favorite) {
            $favorite->delete();
        }

        // echo json_encode([]);
        if ($search_id) {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
        } else {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
        }
        // echo count($favorite_cnt);
        $marked_ids = array_merge($favorite_cnt, $relevant_cnt, $nrelevant_cnt);
        $marked_ids = array_unique($marked_ids);
        echo json_encode(['favorite_cnt' => count($favorite_cnt), 'marked_ids' => count($marked_ids)]);
    }

    // task - 86a309hbq
    public function saveRelevant(Request $request)
    {
        $input = $request->all();
        $user_id = $input['user_id'];
        $search_id = (isset($input['search_id'])) ? $input['search_id'] : null;
        $unmasked = (isset($input['unmasked'])) ? 1 : 0;
        if (auth()->user()->reference) {
            $company_id = User::find($ref_user)->company->id;
        } else {
            $company_id = auth()->user()->company->id;
        }

        // task - 86a2vwzh3
        if ($search_id) {
            $relevant = \DB::table('relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->first();

            // remove if candidate exists in non-relevant
            /*$nrelevant = \DB::table('non_relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->first();
            if ($nrelevant) {*/
                \DB::table('non_relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->delete();
            // }
        } else {
            $relevant = \DB::table('relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->first();

            // remove if candidate exists in non-relevant
            // $nrelevant = \DB::table('non_relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->first();
            // if ($nrelevant) {
                \DB::table('non_relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->delete();
            // }
        }

        if(empty($relevant)){
            $relevant = \DB::table('relevant')->insert([
                'company_id' => $company_id,
                'candidate_id' => $user_id,
                'search_id' => $search_id, 'unmasked' => $unmasked
            ]);
        }

        if ($search_id) {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
        } else {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
        }
        $marked_ids = array_merge($favorite_cnt, $relevant_cnt, $nrelevant_cnt);
        $marked_ids = array_unique($marked_ids);

        echo json_encode(['nrelevant_cnt' => count($nrelevant_cnt), 'relevant_cnt' => count($relevant_cnt), 'marked_ids' => count($marked_ids)]);
        // echo json_encode([]);
    }

    public function removeRelevant(Request $request)
    {
        $input = $request->all();
        $user_id = $input['user_id'];
        $search_id = (isset($input['search_id'])) ? $input['search_id'] : null;
        $unmasked = (isset($input['unmasked'])) ? 1 : 0;
        if (auth()->user()->reference) {
            $company_id = User::find($ref_user)->company->id;
        } else {
            $company_id = auth()->user()->company->id;
        }

        // task - 86a2vwzh3
        if ($search_id) {
            // $relevant = \DB::table('relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->first();
            // if ($relevant) {
                \DB::table('relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->delete();
            // }
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
        } else {
            // $relevant = \DB::table('relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->first();
            // if ($relevant) {
                \DB::table('relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->delete();
            // }
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
        }

        $marked_ids = array_merge($favorite_cnt, $relevant_cnt, $nrelevant_cnt);
        $marked_ids = array_unique($marked_ids);
        echo json_encode(['nrelevant_cnt' => count($nrelevant_cnt), 'relevant_cnt' => count($relevant_cnt), 'marked_ids' => count($marked_ids)]);
        // echo json_encode([]);
    }

    public function saveNonRelevant(Request $request)
    {
        $input = $request->all();
        $user_id = $input['user_id'];
        $search_id = (isset($input['search_id'])) ? $input['search_id'] : null;
        $unmasked = (isset($input['unmasked'])) ? 1 : 0;
        if (auth()->user()->reference) {
            $company_id = User::find($ref_user)->company->id;
        } else {
            $company_id = auth()->user()->company->id;
        }

        // task - 86a2vwzh3
        if ($search_id) {
            $nrelevant = \DB::table('non_relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->first();

            // remove if candidate exists in relevant
            // $relevant = \DB::table('relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->first();
            // if ($relevant) {
                \DB::table('relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->delete();
            // }
        } else {
            $nrelevant = \DB::table('non_relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->first();

            // remove if candidate exists in relevant
            // $relevant = \DB::table('relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->first();
            // if ($relevant) {
                \DB::table('relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->delete();
            // }
        }

        if(empty($nrelevant)){
            $nrelevant = \DB::table('non_relevant')->insert([
                'company_id' => $company_id,
                'candidate_id' => $user_id,
                'search_id' => $search_id, 'unmasked' => $unmasked
            ]);
        }

        if ($search_id) {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
        } else {
            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
        }
        // dd($relevant_cnt, $nrelevant_cnt);
        $marked_ids = array_merge($favorite_cnt, $relevant_cnt, $nrelevant_cnt);
        $marked_ids = array_unique($marked_ids);
        echo json_encode(['nrelevant_cnt' => count($nrelevant_cnt), 'relevant_cnt' => count($relevant_cnt), 'marked_ids' => count($marked_ids)]);
        // echo json_encode([]);
    }

    public function removeNonRelevant(Request $request)
    {
        $input = $request->all();
        $user_id = $input['user_id'];
        $search_id = (isset($input['search_id'])) ? $input['search_id'] : null;
        $unmasked = (isset($input['unmasked'])) ? 1 : 0;
        if (auth()->user()->reference) {
            $company_id = User::find($ref_user)->company->id;
        } else {
            $company_id = auth()->user()->company->id;
        }

        // task - 86a2vwzh3
        if ($search_id) {
            // $relevant = \DB::table('non_relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->first();
            // if ($relevant) {
                \DB::table('non_relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id,'search_id' => $search_id])->delete();
            // }

            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
        } else {
            // $relevant = \DB::table('non_relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->first();
            // if ($relevant) {
                \DB::table('non_relevant')->where(['company_id' => $company_id, 'candidate_id' => $user_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->delete();
            // }

            $relevant_cnt = \DB::table('relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $nrelevant_cnt = \DB::table('non_relevant')->where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            $favorite_cnt = Favorite::where(['company_id' => $company_id, 'unmasked' => $unmasked])->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
        }

        $marked_ids = array_merge($favorite_cnt, $relevant_cnt, $nrelevant_cnt);
        $marked_ids = array_unique($marked_ids);
        echo json_encode(['nrelevant_cnt' => count($nrelevant_cnt), 'relevant_cnt' => count($relevant_cnt), 'marked_ids' => count($marked_ids)]);
        // echo json_encode([]);
    }
    // task - 86a309hbq end

    // task - no SSO employers
    public function no_sso_employer(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            // dd($input);
            $digits = 6;
            $_2fa_code = rand(pow(10, $digits-1), pow(10, $digits)-1);

            $email = $input['email'];
            $password = isset($input['password']) ? $input['password'] : null;
            $otp = isset($input['otp']) ? $input['otp'] : null;

            $invited_user = Invited_user::where(['email' => $email])->whereRaw('(invited_user_id IS NULL OR invited_user_id=0 OR invited_user_id="")')->first();
            if ($invited_user) {
                $_2fa_row = \DB::table('employer_2fa')->where(['email' => $email])->first();
                if ($email && $password == '' && $otp == '') {
                    $data = array('code' => $_2fa_code);
                    \Mail::send(['html'=>'mail.2fa_employer_email'], $data, function($message) use ($email) {
                        $message->to($email, 'Purple Stairs')->subject
                            ('Employer 2FA OTP');
                        $message->cc(['eptdeveloper@gmail.com']);
                        $message->from('info@purplestairs.com','Purple Stairs');
                    });

                    if ($_2fa_row) {
                        \DB::table('employer_2fa')->where('id', $_2fa_row->id)->update(['tfa_token' => $_2fa_code, 'create_date' => date('Y-m-d H:i:s')]);
                    } else {
                        \DB::table('employer_2fa')->insert(['email' => $email, 'tfa_token' => $_2fa_code, 'create_date' => date('Y-m-d H:i:s')]);
                    }

                    $request->session()->put('employer_email', $email);
                    $request->session()->put('allow_otp', 1);
                } else {
                    if ($_2fa_row) {
                        $code_time = $_2fa_row->create_date;
                        $current_time = date('Y-m-d H:i:s');
                        $diff_sec = round(abs(strtotime($current_time) - strtotime($code_time)),2);
                        // dd($current_time, $code_time, $diff_sec);
                        if ($diff_sec > 30) {
                            Session::forget('employer_email');
                            Session::forget('allow_otp');

                            return redirect('/no-sso-employers')->withErrors(['msg' => 'Two factore authentication code expired.']);
                        } else {
                            $session_employer = $request->session()->get('employer_email');
                            if($session_employer == $_2fa_row->email) {
                                $request->validate([
                                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                                    'password' => ['required', 'string', 'min:8'],
                                    'otp' => ['required'],
                                ]);

                                $shuffle_string = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                                $verify_token = substr(str_shuffle($shuffle_string),1,16);

                                $user = User::create([
                                    'name' => $email,
                                    'email' => $email,
                                    'password' => Hash::make($password),
                                    'profile_photo_path' => null,
                                    'email_verified_at' => Carbon::now(),
                                    'user_type' => 'employer',
                                    'reference' => $invited_user->sender_userid,
                                    'status' => 1,
                                    'verify_token' => $verify_token,
                                ]);

                                $invited_user->invited_user_id = $user->id;
                                $invited_user->save();

                                \DB::table('employer_2fa')->where('id', $_2fa_row->id)->update(['tfa_token' => null, 'create_date' => null]);

                                Session::forget('employer_email');
                                Session::forget('allow_otp');

                                Auth::login($user,true);
                                return redirect('/company/dashboard');
                            } else {
                                Session::forget('employer_email');
                                Session::forget('allow_otp');

                                return redirect('no-sso-employers')->withErrors(['msg' => 'Invalid credentials.']);
                            }
                        }
                    } else {
                        Session::forget('employer_email');
                        Session::forget('allow_otp');

                        return redirect('/no-sso-employers')->with(['error' => 'This email is not valid.']);
                    }
                }
            } else {
                Session::forget('employer_email');
                Session::forget('allow_otp');

                return redirect('/no-sso-employers')->with(['error' => 'This email is not valid.']);
            }
            return redirect('/no-sso-employers');
        }

        return view('auth.no_sso');
    }
    // task - no SSO employers end
}
