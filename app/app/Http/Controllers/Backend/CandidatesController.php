<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\CSVExportFile;
use App\Models\User;
use App\Models\Personal;
use App\Models\Industry;
use App\Models\Interest;
use App\Models\Salary;
use App\Models\Language;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Employment;
use App\Models\Reference;
use GuzzleHttp\Client;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport; // Import the UsersImport class

use Session;

class CandidatesController extends Controller
{
    public $totalActive,$totalPending;
    public function index()
    {
        $totalActive = User::where('status', 1)->whereNull('deleted_at')->Where('user_type', 'candidate')->get()->count();
        $totalPending = User::where('status', 0)->whereNull('deleted_at')->Where('user_type', 'candidate')->get()->count();
        return view('backend.users.candidate_list', [
            'totalActive' => $totalActive,
            'totalPending' => $totalPending,
        ]);
    }
    public function data(Request $request)
    {
        $input = $request->all();
        $search         = $input['search'];
        $order_columns  = $input['order_columns'];
        $columns        = $input['cols'];
        $order          = $input['order'];
        $limit          = $input['length'];
        $offset         = $input['start'];

        $employers = User::all();
        \DB::enableQueryLog();
        $_employers_ = User::select('users.*');
        $_employers_->whereNull('deleted_at');
        $_employers_->where('user_type', 'candidate');
        if ($request->has('status') && $request->status == 1) {
            $_employers_->where('status', 1);
        }
        if ($request->has('Type') && $request->Type == 'Pending') {
            $_employers_=  $_employers_->where('status', 0);
        }
        if ($request->has('Type') && $request->Type == 'Active') {
            $_employers_=  $_employers_->where('status', 1);
        }


        $extra_where = [];
        if(!empty($search['value'])) {
          $search_query = "(";
          foreach ($columns as $k => $field) {
            if($k > 0) $search_query .= " OR ";
            $search_query .= $field." LIKE '%".$search['value']."%'";
          }
          $search_query .= ")";
          // $extra_where[] = $search_query;
          $_employers_->whereRaw($search_query);
        }

        $_order = [];
        if(!empty($order)) {
          foreach ($order as $f => $odr) {
            // $_order[$order_columns[$odr['column']]] = $odr['dir'];
            $_employers_->orderBy($order_columns[$odr['column']], $odr['dir']);
          }
        }
        $_employers_->offset($offset)->limit($limit);
        $final_data = $_employers_->get();
        // print_r(\DB::getQueryLog());

        $totalData = User::where('user_type', 'candidate')->whereNull('deleted_at')->get()->count();

        $response = [];
        foreach ($final_data as $key => $user) {
            $row = array();

            $row['id'] = $user->id;
            $row['name'] = $user->name;
            $row['email'] = $user->email;
            $row['date'] = date('m-d-Y h:i A', strtotime($user->created_at));
            $row['approved_date'] = ($user->approved_date) ? date('m-d-Y h:i A', strtotime($user->approved_date)) : 'N/A'; // task - 86a2kkdyc
            $row['status'] = $user->status;
            $row['step'] = $user->step_reached;
            $row['tooltip'] = 'Started';
            $row['resume_uploaded'] = $user->resume_uploaded;
            if($user->step_reached==1){
                $row['step']=0;
            }
            elseif($user->step_reached==2){
                $row['step']=1;
                $row['tooltip'] = 'Personal info filled out';
            }
            elseif ($user->step_reached== 4 ) {
                $row['tooltip'] = 'Personal info, Preferences';
                $row['step'] = 2;
            }
            elseif ($user->step_reached== 5 ) {
                $row['tooltip'] = 'Personal info, Preferences, Education';
                $row['step'] = 3;
            }
            elseif ($user->step_reached== 6 ) {
                $row['tooltip'] = 'Personal info, Preferences, Education, Employment';
                $row['step'] = 4;
            }
            elseif ($user->step_reached==7 ) {

                $row['tooltip'] = 'Personal info, Preferences, Education and/OR Employment, Skills ';
                $row['step'] = 5;
            }
             elseif ($user->step_reached == 8) {
                $row['tooltip'] = 'Personal info, Preferences, Education and/OR Employment, Skills and/OR references';

                $row['step'] = 6;
            }
            elseif ($user->step_reached >=9 ) {

                $row['tooltip'] = 'Personal info, Preferences, Education and/OR Employment, Skills and/OR references, Image & About';
                $row['step'] = 7;
            }

            // task - 86a2ae1kx | 86a2cw8m1
            $employments = []; $yrs_of_exp = 0; $exp_months = 0;
            if ($user) {
                if($user->employments->count()) {
                    $employments = $user->employments->toArray();
                    $st_year = null;
                    $ed_year = null;

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
            }
            $row['experiance'] = ($yrs_of_exp > 0 ? $yrs_of_exp : 0);
            // task - 86a2ae1kx end

            $response[] = $row;
        }

        $json_data = array(
            "draw"            => intval($input['draw']),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data"            => $response,
        );
        echo json_encode($json_data);
    }

    // task - 86a1m4ymb
    public function add() {
        $all_industries = Industry::where('status', 1)->orderBy('name', 'asc')->pluck('id', 'name')->toArray();;
        $all_interests = Interest::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_salaries = Salary::where('status', 1)->pluck('id', 'name')->toArray();

        $all_languages = Language::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_soft_skills = Skill::where('skill_type', 'soft_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_hard_skills = Skill::where('skill_type', 'hard_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        return view('backend.users.add_candidate', compact('all_industries', 'all_interests', 'all_salaries', 'all_languages', 'all_soft_skills', 'all_hard_skills'));
    }

    public function create(Request $request) {
        $rules = array(
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            // 'phone' => 'required|digits:10',
            // 'phone' => 'required',
            // 'zipcode' => 'required|string',
        );

        if ($request->hasFile('profile')) {
            $rules['profile'] = 'max:1024|mimes:jpg,bmp,png,jpeg,gif'; // 1MB Max
        }

        $validated = $request->validate($rules);

        $input = $request->all();

        // add personal information
        $user_array = array(
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => now(),
            'user_type' => 'candidate',
            'current_step' => 0,
            'profile_photo_path' => null,
            // 'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'step_reached' => 0,
            'password' => Hash::make($input['email']),
        );
        // check if profile image
        if($request->hasFile('profile')) {
            $path = $request->file('profile')->store('public/profile');
            $file_path = str_replace('public/','storage/app/public/',$path);
            $user_array['profile_photo_path'] = $file_path;
        }
        $user = User::create($user_array);

        $personal = Personal::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'current_title' => $input['current_title'],
            'current_title_status' => isset($input['current_title_status']) ? $input['current_title_status'] : 0,
            'zip_code' => $input['zipcode'],
            'linkedin_url' => $input['linkedin_url'],
            'additional_url' => $input['additional_url'],
            'short_bio' => $input['short_bio'],
            'short_bio_status' => isset($input['short_bio_status']) ? $input['short_bio_status'] : 0,
            // 'profile_status' => 0,
            'user_id' => $user->id,
            'name_status' => isset($input['name_status']) ? $input['name_status'] : 0, // task - 86a22q138
            'email_status' => isset($input['email_status']) ? $input['email_status'] : 0, // task - 86a22q138
            'phone_status' => isset($input['phone_status']) ? $input['phone_status'] : 0, // task - 86a22q138
            'zip_code_status' => isset($input['zip_code_status']) ? $input['zip_code_status'] : 0, // task - 86a22q138
            'linkedin_url_status' => isset($input['linkedin_url_status']) ? $input['linkedin_url_status'] : 0, // task - 86a22q138
            'additional_url_status' => isset($input['additional_url_status']) ? $input['additional_url_status'] : 0, // task - 86a22q138
            'profile_status' => isset($input['profile_status']) ? $input['profile_status'] : 0, // task - 86a22q138
        ]);

        // $personals = Personal::find($personal->id);
        //get address from zip code
        $client = new Client(['base_uri' => 'https://api.zippopotam.us/']);
        try {
            $response = $client->request('GET', 'US/'.$input['zipcode']);
            $data = json_decode($response->getBody(), true);
        } catch (\Throwable $th) {
        }

        if(isset($data)){
            $personal->country = $data['country'] ? $data['country'] : '';
            $personal->country_abbr = $data['country abbreviation'] ? $data['country abbreviation'] : '';
            $personal->state = $data['places'][0]['state'] ? $data['places'][0]['state'] : '';
            $personal->state_abbr = $data['places'][0]['state abbreviation'] ? $data['places'][0]['state abbreviation'] : '';
            $personal->address = $data['places'][0]['place name'] ? $data['places'][0]['place name'] : '';
            $personal->lat = $data['places'][0]['latitude'] ? $data['places'][0]['latitude'] : '';
            $personal->lng = $data['places'][0]['longitude'] ? $data['places'][0]['longitude'] : '';
        }
        else{
            $personal->country = '';
            $personal->country_abbr = '';
            $personal->state = '';
            $personal->state_abbr = '';
            $personal->address = '';
            $personal->lat = '';
            $personal->lng = '';
        }

        $personal->save();

        // $user = User::find($user->id);

        $user->current_step = 1;
        if($user->step_reached<1){
            $user->step_reached=1;
        }
        $user->save();

        // candidate step - 2
        $personal->salary_range = isset($input['salary_range']) ? $input['salary_range'] : 0;
        $personal->work_environment_remote = isset($input['remote']) ? $input['remote'] : 0;
        $personal->work_environment_in_office = isset($input['in_office']) ? $input['in_office'] : 0;
        $personal->work_environment_hybrid = isset($input['hybrid']) ? $input['hybrid'] : 0;
        $personal->schedule_full_time = isset($input['full_time']) ? $input['full_time'] : 0;
        $personal->schedule_part_time = isset($input['part_time']) ? $input['part_time'] : 0;
        $personal->schedule_no_preference = isset($input['no_preference']) ? $input['no_preference'] : 0;
        $personal->compensation_salary = isset($input['compensation_salary']) ? $input['compensation_salary'] : 0;
        $personal->compensation_hourly = isset($input['compensation_hourly']) ? $input['compensation_hourly'] : 0;
        $personal->compensation_comission_based = isset($input['compensation_comission_based']) ? $input['compensation_comission_based'] : 0;
        $personal->prefered_benefits_insurance_benefits = isset($input['prefered_benefits_insurance_benefits']) ? $input['prefered_benefits_insurance_benefits'] : 0;
        $personal->prefered_benefits_padi_holidays = isset($input['prefered_benefits_paid_holidays']) ? $input['prefered_benefits_paid_holidays'] : 0;
        $personal->prefered_benefits_paid_vacation_days = isset($input['prefered_benefits_paid_vacation_days']) ? $input['prefered_benefits_paid_vacation_days'] : 0;
        $personal->prefered_benefits_professional_environment = isset($input['prefered_benefits_professional_environment ']) ? $input['prefered_benefits_professional_environment '] : 0;
        $personal->prefered_benefits_casual_environment = isset($input['prefered_benefits_casual_environment']) ? $input['prefered_benefits_casual_environment'] : 0;
        $personal->distance = $input['distance'];
        $personal->save();

        if(isset($input['industries'])) { $user->industries()->sync($input['industries']); }
        if(isset($input['interests'])) { $user->interests()->sync($input['interests']); }

        $user->current_step = 2;
        if($user->step_reached<2){
            $user->step_reached=2;
        }
        $user->save();

        // candidate step - 4
        $edu_organization_name = $input['organization_name'];
        foreach ($edu_organization_name as $edu_key => $edu) {
            $edu_arr = array(
                'user_id' => $user->id,
                'program_name' => $input['program_name'][$edu_key],
                'program_name_status' => isset($input['program_name_status'][$edu_key]) ? $input['program_name_status'][$edu_key] : 0,
                'organization_name' => $input['organization_name'][$edu_key],
                'organization_name_status' => isset($input['organization_name_status'][$edu_key]) ? $input['organization_name_status'][$edu_key] : 0,
                'course_description' => $input['course_description'][$edu_key],
                'course_description_status' => isset($input['course_description_status'][$edu_key]) ? $input['course_description_status'][$edu_key] : 0,
                'start_year' => $input['start_year'][$edu_key],
                'end_year' => ($input['end_year'][$edu_key]!='PRESENT') ? $input['end_year'][$edu_key] : '',
                'currently_studying' => (isset($input['currently_studying'][$edu_key])) ? $input['currently_studying'][$edu_key] : 0,
                'start_year_status' => isset($input['start_year_status'][$edu_key]) ? $input['start_year_status'][$edu_key] : 0,
            );

            Education::create($edu_arr);
        }

        $user->current_step = 4;
        if($user->step_reached<4){
            $user->step_reached=4;
        }
        $user->save();

        // candidate step - 5
        $emp_company_name = $input['company_name'];
        foreach ($emp_company_name as $emp_key => $emp) {
            $emp_arr = array(
                'user_id' => $user->id,
                'company_name' => $input['company_name'][$emp_key],
                'company_name_status' => (isset($input['company_name_status'][$emp_key])) ? $input['company_name_status'][$emp_key] : 0,
                'position' => $input['position'][$emp_key],
                'position_status' => (isset($input['position_status'][$emp_key])) ? $input['position_status'][$emp_key] : 0,
                'responsibilities' => $input['responsibilities'][$emp_key],
                'responsibilities_status' => (isset($input['responsibilities_status'][$emp_key])) ? $input['responsibilities_status'][$emp_key] : 0,
                'start_year' => $input['emp_start_year'][$emp_key],
                'end_year' => ($input['emp_end_year'][$emp_key]!='PRESENT') ? $input['emp_end_year'][$emp_key] : '' ,
                'currently_working' => (isset($input['currently_working'][$emp_key])) ? $input['currently_working'][$emp_key] : 0,
                'start_year_status' => (isset($input['emp_start_year_status'][$emp_key])) ? $input['emp_start_year_status'][$emp_key] : 0,
                'accomplishments' => $input['accomplishments'][$emp_key],
                'accomplishments_status' => (isset($input['accomplishments_status'][$emp_key])) ? $input['accomplishments_status'][$emp_key] : 0,
            );

            Employment::create($emp_arr);
        }

        $user->current_step = 5;
        if($user->step_reached<5){
            $user->step_reached=5;
        }
        $user->save();

        // candidate step - 6
        if (isset($input['language'])) {
            $user->languages()->sync($input['language']);
        }

        if (isset($input['soft_skill'])) {
            $user->softSkills()->detach($user->softSkills->pluck('id')->toArray());
            $user->softSkills()->attach($input['soft_skill']);
        }

        if (isset($input['hard_skill'])) {
            $user->hardSkills()->detach($user->hardSkills->pluck('id')->toArray());
            $user->hardSkills()->attach($input['hard_skill']);
        }

        // $user = Auth::user();
        $user->current_step = 6;
        if($user->step_reached<6){
            $user->step_reached=6;
        }
        $user->save();

        // candidate step - 7
        $reference_name = $input['ref_name'];
        foreach ($reference_name as $ref_key => $reference) {
            $ref_arr = array(
                'user_id' => $user->id,
                'name' => $input['ref_name'][$ref_key],
                'relationship' => $input['ref_relationship'][$ref_key],
                'phone' => $input['ref_phone'][$ref_key],
                'email' => $input['ref_email'][$ref_key],
                'name_status' => isset($input['ref_name_status'][$ref_key]) ? $input['ref_name_status'][$ref_key] : 0,// task - 86a22q138
                'relationship_status' => isset($input['ref_relationship_status'][$ref_key]) ? $input['ref_relationship_status'][$ref_key] : 0,// task - 86a22q138
                'phone_status' => isset($input['ref_phone_status'][$ref_key]) ? $input['ref_phone_status'][$ref_key] : 0,// task - 86a22q138
                'email_status' => isset($input['ref_email_status'][$ref_key]) ? $input['ref_email_status'][$ref_key] : 0,// task - 86a22q138
            );

            Reference::create($ref_arr);
        }

        create_candidate_contact($user, true);  // task - 86a3d37f9

        $user->current_step = 7;
            if($user->step_reached<7){
                $user->step_reached=7;
            }

        $user->save();

        // $user->status = 1;
        $user->current_step = 8;
            if($user->step_reached<8){
                $user->step_reached=8;
            }

        $user->save();

        session()->flash('success', 'Candidate added successfully !!');
        return redirect()->route('admin.candidates');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $nextUser = User::where('status', '1')->where('user_type','candidate')
        ->where('id', '<', $id)
        ->orderBy('id', 'desc')
        ->first();
        $prevUser = User::where('status', '1')->where('user_type','candidate')
        ->where('id', '>', $id)
        ->orderBy('id', 'asc')
        ->first();

        $personal = Personal::where('user_id', $id)->first();
        if (empty($personal)) {
            $personal = Personal::create(['user_id' => $id]);
        }
        $educations = Education::where('user_id', $id)->get();
        $employments = Employment::where('user_id', $id)->get();
        $references = Reference::where('user_id', $id)->get();

        $all_industries = Industry::where('status', 1)->orderBy('name', 'asc')->pluck('id', 'name')->toArray();;
        $all_interests = Interest::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_salaries = Salary::where('status', 1)->pluck('id', 'name')->toArray();

        $all_languages = Language::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_soft_skills = Skill::where('skill_type', 'soft_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_hard_skills = Skill::where('skill_type', 'hard_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();

        $sel_industries = $user->industries()->pluck('industries.id')->toArray();
        $sel_prim_industries = $user->industries()->where('primary_status', '1')->pluck('industries.id')->toArray();
        $sel_interests = $user->interests()->pluck('interests.id')->toArray();

        $sel_languages = $user->languages()->pluck('languages.id')->toArray();
        $sel_softskill = $user->softSkills->pluck('id')->toArray();
        $sel_hardskill = $user->hardSkills->pluck('id')->toArray();
        // dd($sel_hardskill);
        return view('backend.users.edit_candidate', compact('user','personal','educations','employments','references','sel_languages','sel_softskill', 'sel_hardskill', 'all_industries', 'all_interests', 'all_salaries', 'all_languages', 'all_soft_skills', 'all_hard_skills', 'sel_industries', 'sel_interests','sel_prim_industries','nextUser','prevUser'));
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
            // 'phone' => 'required|digits:10',
            // 'phone' => 'required',
            // 'zipcode' => 'required|string',
        );

        if ($request->hasFile('profile')) {
            $rules['profile'] = 'max:1024|mimes:jpg,bmp,png,jpeg,gif'; // 1MB Max
        }

        $validated = $request->validate($rules);

        $input = $request->all();

        $user = User::find($id);
        $personal = Personal::where('user_id', $id)->first();

        $user->name = $input['name'];
        // $user->current_step = 0;
        $user->updated_at = now();
        // $user->step_reached = 0;

        if($request->hasFile('profile')) {
            $path = $request->file('profile')->store('public/profile');
            $file_path = str_replace('public/','storage/app/public/',$path);
            $user->profile_photo_path = $file_path;
        }
        $user->save();

        $personal->phone = $input['phone'];
        $personal->current_title = $input['current_title'];
        $personal->current_title_status = isset($input['current_title_status']) ? $input['current_title_status'] : 0;
        $personal->short_bio = $input['short_bio'];
        $personal->short_bio_status = isset($input['short_bio_status']) ? $input['short_bio_status'] : 0;
        $personal->zip_code = $input['zipcode'];
        $personal->linkedin_url = $input['linkedin_url'];
        $personal->additional_url = $input['additional_url'];
        $personal->salary_range = $input['salary_range'];
        $personal->work_environment_remote = (isset($input['remote'])) ? $input['remote'] : 0;
        $personal->work_environment_in_office = (isset($input['in_office'])) ? $input['in_office'] : 0;
        $personal->work_environment_hybrid = (isset($input['hybrid'])) ? $input['hybrid'] : 0;
        $personal->schedule_full_time = (isset($input['full_time'])) ? $input['full_time'] : 0;
        $personal->schedule_part_time = (isset($input['part_time'])) ? $input['part_time'] : 0;
        $personal->schedule_no_preference = (isset($input['no_preference'])) ? $input['no_preference'] : 0;
        $personal->compensation_salary = (isset($input['compensation_salary'])) ? $input['compensation_salary'] : 0;
        $personal->compensation_hourly = (isset($input['compensation_hourly'])) ? $input['compensation_hourly'] : 0;
        $personal->compensation_comission_based = (isset($input['compensation_comission_based'])) ? $input['compensation_comission_based'] : 0;
        $personal->prefered_benefits_insurance_benefits = (isset($input['prefered_benefits_insurance_benefits'])) ? $input['prefered_benefits_insurance_benefits'] : 0;
        $personal->prefered_benefits_padi_holidays = (isset($input['prefered_benefits_paid_holidays'])) ? $input['prefered_benefits_paid_holidays'] : 0;
        $personal->prefered_benefits_paid_vacation_days = (isset($input['prefered_benefits_paid_vacation_days'])) ? $input['prefered_benefits_paid_vacation_days'] : 0;
        $personal->prefered_benefits_professional_environment =(isset( $input['prefered_benefits_professional_environment '])) ?  $input['prefered_benefits_professional_environment '] : 0;
        $personal->prefered_benefits_casual_environment = (isset($input['prefered_benefits_casual_environment'])) ? $input['prefered_benefits_casual_environment'] : 0;
        $personal->distance = $input['distance'];
        // task - 86a22q138
        $personal->name_status = isset($input['name_status']) ? $input['name_status'] : 0;
        $personal->email_status = isset($input['email_status']) ? $input['email_status'] : 0;
        $personal->phone_status = isset($input['phone_status']) ? $input['phone_status'] : 0;
        $personal->zip_code_status = isset($input['zip_code_status']) ? $input['zip_code_status'] : 0;
        $personal->linkedin_url_status = isset($input['linkedin_url_status']) ? $input['linkedin_url_status'] : 0;
        $personal->additional_url_status = isset($input['additional_url_status']) ? $input['additional_url_status'] : 0;
        $personal->profile_status = isset($input['profile_status']) ? $input['profile_status'] : 0;
        // task - 86a22q138 end
        $personal->save();

        $client = new Client(['base_uri' => 'https://api.zippopotam.us/']);
        try {
            $response = $client->request('GET', 'US/'.$input['zipcode']);
            $data = json_decode($response->getBody(), true);
        } catch (\Throwable $th) {
        }

        if(isset($data)){
            $personal->country = $data['country'] ? $data['country'] : '';
            $personal->country_abbr = $data['country abbreviation'] ? $data['country abbreviation'] : '';
            $personal->state = $data['places'][0]['state'] ? $data['places'][0]['state'] : '';
            $personal->state_abbr = $data['places'][0]['state abbreviation'] ? $data['places'][0]['state abbreviation'] : '';
            $personal->address = $data['places'][0]['place name'] ? $data['places'][0]['place name'] : '';
            $personal->lat = $data['places'][0]['latitude'] ? $data['places'][0]['latitude'] : '';
            $personal->lng = $data['places'][0]['longitude'] ? $data['places'][0]['longitude'] : '';
        }
        else{
            $personal->country = '';
            $personal->country_abbr = '';
            $personal->state = '';
            $personal->state_abbr = '';
            $personal->address = '';
            $personal->lat = '';
            $personal->lng = '';
        }

        $personal->save();

        if(!empty($input['industries'])){
            $selectedIndustries = $input['industries'];
            $user->industries()->detach();
            if(!empty($input['primaryIndustry'])){
                       $user->industries()->attach($input['primaryIndustry'], ['primary_status' => '1']);
              }
            foreach ($selectedIndustries as $industryId) {
                        $indUser=\DB::table('industry_user')
                        ->where('user_id',$user->id)
                        ->where('industry_id', $industryId)
                        ->first();
                        if(empty($indUser)){
                       $user->industries()->attach($industryId, ['primary_status' => '0']);
                    }
            }
        }
        if (isset( $input['interests'] )) { $user->interests()->sync($input['interests']); }

        Education::where('user_id', $id)->delete();
        $edu_organization_name = $input['organization_name'];
        foreach ($edu_organization_name as $edu_key => $edu) {
            $edu_arr = array(
                'user_id' => $id,
                'program_name' => $input['program_name'][$edu_key],
                'program_name_status' => (isset($input['program_name_status'][$edu_key])) ? $input['program_name_status'][$edu_key] : 0,
                'organization_name' => $input['organization_name'][$edu_key],
                'organization_name_status' => (isset($input['organization_name_status'][$edu_key])) ? $input['organization_name_status'][$edu_key] : 0,
                'course_description' => $input['course_description'][$edu_key],
                'course_description_status' => (isset($input['course_description_status'][$edu_key])) ? $input['course_description_status'][$edu_key] : 0,
                'start_year' => $input['start_year'][$edu_key],
                'end_year' => ($input['end_year'][$edu_key]!='PRESENT') ? $input['end_year'][$edu_key] : '',
                'currently_studying' => (isset($input['currently_studying'][$edu_key])) ? $input['currently_studying'][$edu_key] : 0,
                'start_year_status' => (isset($input['start_year_status'][$edu_key])) ? $input['start_year_status'][$edu_key] : 0,
            );

            Education::create($edu_arr);
        }

        Employment::where('user_id', $id)->delete();
        $emp_company_name = $input['company_name'];
        foreach ($emp_company_name as $emp_key => $emp) {
            $emp_arr = array(
                'user_id' => $user->id,
                'company_name' => $input['company_name'][$emp_key],
                'company_name_status' => isset($input['company_name_status'][$emp_key]) ? $input['company_name_status'][$emp_key] : 0,
                'position' => $input['position'][$emp_key],
                'position_status' => isset($input['position_status'][$emp_key]) ? $input['position_status'][$emp_key] : 0,
                'responsibilities' => $input['responsibilities'][$emp_key],
                'responsibilities_status' => isset($input['responsibilities_status'][$emp_key]) ? $input['responsibilities_status'][$emp_key] : 0,
                'start_year' => $input['emp_start_year'][$emp_key],
                'end_year' => ($input['emp_end_year'][$emp_key]!='PRESENT') ? $input['emp_end_year'][$emp_key] : '' ,
                'currently_working' => isset($input['currently_working'][$emp_key]) ? $input['currently_working'][$emp_key] : 0,
                'start_year_status' => isset($input['emp_start_year_status'][$emp_key]) ? $input['emp_start_year_status'][$emp_key] : 0,
                'accomplishments' => $input['accomplishments'][$emp_key],
                'accomplishments_status' => isset($input['accomplishments_status'][$emp_key]) ? $input['accomplishments_status'][$emp_key] : 0,
            );

            Employment::create($emp_arr);
        }

        // dd($input);
        if (isset($input['language'])) {
            $user->languages()->sync($input['language']);
        }

        if (isset($input['soft_skill'])) {
            $user->softSkills()->detach($user->softSkills->pluck('id')->toArray());
            $user->softSkills()->attach($input['soft_skill']);
        }

        if (isset($input['hard_skill'])) {
            $user->hardSkills()->detach($user->hardSkills->pluck('id')->toArray());
            $user->hardSkills()->attach($input['hard_skill']);
        }

        Reference::where('user_id', $id)->delete();
        $reference_name = $input['ref_name'];
        foreach ($reference_name as $ref_key => $reference) {
            $ref_arr = array(
                'user_id' => $user->id,
                'name' => $input['ref_name'][$ref_key],
                'relationship' => $input['ref_relationship'][$ref_key],
                'phone' => $input['ref_phone'][$ref_key],
                'email' => $input['ref_email'][$ref_key],
                'name_status' => isset($input['ref_name_status'][$ref_key]) ? $input['ref_name_status'][$ref_key] : 0,// task - 86a22q138
                'relationship_status' => isset($input['ref_relationship_status'][$ref_key]) ? $input['ref_relationship_status'][$ref_key] : 0,// task - 86a22q138
                'phone_status' => isset($input['ref_phone_status'][$ref_key]) ? $input['ref_phone_status'][$ref_key] : 0,// task - 86a22q138
                'email_status' => isset($input['ref_email_status'][$ref_key]) ? $input['ref_email_status'][$ref_key] : 0,// task - 86a22q138
            );

            Reference::create($ref_arr);
        }

        if (strtolower($input['save']) == "publish profile") {
            $user->status = 1;
        }
        $user->save();

        if (strtolower($input['save']) == "publish profile") {
            session()->flash('success', 'Candidate profile published !!');
            return redirect()->route('admin.candidates');
        } else {
            session()->flash('success', 'Candidate updated successfully !!');
            return redirect()->route('admin.candidates.edit', $id);
        }
    }
    public function exportCSV(){
        return Excel::download(new CSVExportFile, 'export.csv');
    }
    public function hard_delete($id)
    {
        $candidate = User::find($id);

        if ($candidate) {
            \DB::table('users')->where('id', $id)->delete();

            session()->flash('success', 'Candidate deleted permanently !!');
            return redirect()->route('admin.candidates');
        } else {
            session()->flash('error', 'Candidate not found.');
            return redirect()->route('admin.candidates');
        }
    }

    public function downloadPdf($id)
    {
        $user = User::find($id);
        $personal = Personal::where('user_id', $id)->first();
        $industries = $user->industries->pluck('name')->toArray();
        $interests = $user->interests->pluck('name')->toArray();
        $educations = Education::where('user_id', $id)->get();
        $employments = Employment::where('user_id', $id)->get();
        $skills = $user->skills;
        $soft_skills = $user->softSkills->pluck('name')->toArray();
        $hard_skills = $user->hardSkills->pluck('name')->toArray();
        $languages = $user->languages->pluck('name')->toArray();
        $references = $user->references;
        $mode = false;

        /*return view('pages.modedownloadPdf', compact(
            'user','personal',
        'industries',
        'interests',
        'educations',
        'employments',
        'skills',
        'soft_skills',
        'hard_skills',
        'languages',
        'references',
        'mode'
        )); exit();*/

        $pdf = PDF::loadView('pages.modedownloadPdf',compact('user','personal',
        'industries',
        'interests',
        'educations',
        'employments',
        'skills',
        'soft_skills',
        'hard_skills',
        'languages',
        'references',
        'mode'));
        return $pdf->download('Purple Stairs-'.strtoupper($personal->name).'.pdf');
    }

    public function downloadhiddenPdf($id)
    {
        $user = User::find($id);
        $personal = Personal::where('user_id', $id)->first();
        $industries = $user->industries->pluck('name')->toArray();
        $interests = $user->interests->pluck('name')->toArray();
        $educations = $user->educations;
        $employments = $user->employments;
        $skills = $user->skills;
        $soft_skills = $user->softSkills->pluck('name')->toArray();
        $hard_skills = $user->hardSkills->pluck('name')->toArray();
        $languages = $user->languages->pluck('name')->toArray();
        $references = $user->references;
        $mode = true;

        /*return view('pages.hiddendownloadPdf', compact(
            'user','personal',
        'industries',
        'interests',
        'educations',
        'employments',
        'skills',
        'soft_skills',
        'hard_skills',
        'languages',
        'references',
        'mode'
        )); exit();*/

        $pdf = PDF::loadView('pages.hiddendownloadPdf',compact('user','personal',
        'industries',
        'interests',
        'educations',
        'employments',
        'skills',
        'soft_skills',
        'hard_skills',
        'languages',
        'references',
        'mode'));
        return $pdf->download('Purple Stairs Hidden -'.strtoupper($personal->name).'.pdf');
    }
    // task - 86a1m4ymb end

    // task - 86a1hvak1
    public function delete($id)
    {
        $candidate = User::find($id);

        if ($candidate) {
            $candidate->delete();

            session()->flash('success', 'Candidate deleted !!');
            return redirect()->route('admin.candidates');
        } else {
            session()->flash('error', 'Candidate not found.');
            return redirect()->route('admin.candidates');
        }
    }

    // task - 86a1hvak1
    public function view($id)
    {
        $user = User::find($id);
        return view('backend.users.view_candidate', compact('user'));
    }

    public function import(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,xls',
        // ]);

        $file = $request->file('csv_file');

        try {
            Excel::import(new UsersImport, $file);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import users. Error: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Users imported successfully.');
    }

    // task - 86a3d37f9
    public function migrate_to_intercom()
    {
        $candidates = User::whereNull('deleted_at')->where('user_type', 'candidate')->get();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('INTERCOM_TOKEN'),
            'Intercom-Version' => '2.11'
        ];

        $contact_message = "";
        $candidate_tag = \DB::table('roles')->where('role', 'candidate')->first();

        $tag_url = env('INTERCOM_URL') . "tags";
        if ($candidate_tag->intercom_tagid == null || $candidate_tag->intercom_tagid == '') {
            $tag_data = json_encode(["name" => 'Candidate']);
            $parameters = ['body' => $tag_data,'headers' => $headers];
            $tagcontent = intercom_api($tag_url, 'POST', $parameters);

            if ($tagcontent['id']) {
                \DB::table('roles')->where('role', 'candidate')->update(['intercom_tagid' => $tagcontent['id']]);
            }
        }

        $emp_err_cnt = 0;
        set_time_limit(0);
        foreach ($candidates as $key => $candid) {
            $request_url = env('INTERCOM_URL') . "contacts";
            $method = "POST";
            if ($candid->intercom_id) {
                $method = "PUT";
                $request_url = env('INTERCOM_URL') . "contacts/" . $candid->intercom_id;
            }

            $phone = null;
            if($candid->personal) {
                if($candid->personal->phone) {
                    $phone = str_replace([' ','(',')','-'], "", $candid->personal->phone);
                    $phone = '+1'.$phone;
                }
            }

            $payload = array(
                "role" => $candid->user_type,
                "email" => $candid->email,
                "phone" => $phone,
                "name" => $candid->name,
                "avatar" => $candid->profile_photo_path,
                "signed_up_at" => $candid->created_at,
                "last_seen_at" => $candid->last_login,
                "unsubscribed_from_emails" => true
            );

            try {
                $parameters = ['body' => json_encode($payload),'headers' => $headers];
                $content = intercom_api($request_url, $method, $parameters);

                if ($content['id']) {
                    $candid->intercom_id = $content['id'];
                    $candid->save();

                    // ADD ROLE TAG TO USER-INTERCOM
                    $ctag_data = ["id" => $candidate_tag->intercom_tagid];

                    $tagc_url = env('INTERCOM_URL') . "contacts/" . $candid->intercom_id . "/tags";
                    $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                    $content = intercom_api($tagc_url, 'POST', $parameters);
                    // ADD ROLE TAG TO USER-INTERCOM END
                }
            } catch(\GuzzleHttp\Exception\ClientException $e) {
                $message_string = json_decode($e->getResponse()->getBody(), true);
                $errors = $message_string['errors'];
                $err_arr = array_column($errors, "message");
                $contact_message .= "<b>".$candid->name ."</b> : ". implode(' | ', $err_arr);
                $emp_err_cnt++;
                // if($candid->id != '57') { dd($message_string, $candid->id, $payload); }

                if (in_array('phone is invalid', $err_arr)) {
                    $payload['phone'] = null;

                    $parameters = ['body' => json_encode($payload),'headers' => $headers];
                    $content = intercom_api($request_url, $method, $parameters);

                    if ($content['id']) {
                        $emp_err_cnt--;

                        $candid->intercom_id = $content['id'];
                        $candid->save();

                        // ADD ROLE TAG TO USER-INTERCOM
                        $ctag_data = ["id" => $candidate_tag->intercom_tagid];

                        $tagc_url = env('INTERCOM_URL') . "contacts/" . $candid->intercom_id . "/tags";
                        $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                        $content = intercom_api($tagc_url, 'POST', $parameters);
                    }
                }
            }
        }
        if($emp_err_cnt) {
            // dd($contact_message);
            echo json_encode(['message' => $contact_message]);
        } else {
            echo json_encode(['message' => "Intercom migration successfully completed."]);
        }
    }
}
