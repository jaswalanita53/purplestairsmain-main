<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Search;
use App\Models\Subscription;
use App\Models\Perosnal;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use DB;
use Auth;
use App\Models\ZipCode;

class PagesController extends Controller
{
    public function welcome(){
        return view('welcome');
    }
    public function mission(){
        return view('pages.mission');
    }
    public function features(){
        return view('pages.features');
    }
    public function pricing(){
        return view('pages.pricing');
    }
    public function signupselect(){
        return view('pages.singupselect');
    }
    public function faq(){
        return view('pages.faq');
    }
    public function contact(){
        return view('pages.contact');
    }
    public function privacy(){
        return view('pages.privacy');
    }
    public function terms(){
        return view('pages.terms');
    }
    public function employerLogin(){
        Session::put('user_type','employer');
        Session::put('sidebar','sidebar_show');

        Session::forget('ref');
        if (isset($_GET['ref'])) {
            Session::put('ref',$_GET['ref']);
        }

        Session::forget('inv');
        if (isset($_GET['inv'])) {
            Session::put('inv',$_GET['inv']);
        }
        return view('pages.employerlogin');
    }

    // task - 8678ffnbw
    public function employerSignup(){
        Session::put('user_type','employer');
        Session::put('sidebar','sidebar_show');

        Session::forget('ref');
        if (isset($_GET['ref'])) {
            Session::put('ref',$_GET['ref']);
        }

        Session::forget('inv');
        if (isset($_GET['inv'])) {
            Session::put('inv',$_GET['inv']);
        }
        return view('pages.employersignup');
    }

    public function employerVerify(Request $request)
    {
        // dd($request->get('token'));
        $token = $request->get('token');
        $user = User::where('verify_token', $token)->first();

        if (empty($user)) {
            if (Auth::check()) {
                return redirect('email/verify')->with('error', 'The link is invalid or expired. Please resend the verification email.');
            }
        }

        if ($user && $user->email_verified_at == null) {
            $user->email_verified_at = Carbon::now();
            $user->verify_token = null;
            $user->save();

            return redirect('/login')->withErrors(['success' => 'Email address verified. Please login to continue.']);
        } elseif ($user && $user->email_verified_at !== null) {
            return redirect('/login');
        } else {
            return redirect('/login')->withErrors(['msg' => 'Not valid email address.']);
        }
    }
    public function reminderEmailToCandidate()
    {
        $data = [];
        $twentyFourHoursAgo = Carbon::now();
        $users = User::where('status', 0)
        ->where('reminder_status', 0)
        ->where('user_type', 'candidate')
        // ->whereDate('created_at', '>', $twentyFourHoursAgo)
        ->get();

        foreach ($users as $user) {
            $timeDifferenceInHours = $twentyFourHoursAgo->diff($user['created_at']);
            if(!empty($timeDifferenceInHours->d)){
                if($timeDifferenceInHours->d>=1){
            $toMail = $user->email;
            $data['name'] = $user->name;

            if(\Mail::send(['html' => 'mail.reminder_candidate'], $data, function ($message) use ($toMail) {
                $message->to($toMail, 'Purple Stairs')->subject('You’re Almost Done!');
                // $message->cc('eptdeveloper@gmail.com');
                $message->from('info@purplestairs.com', 'Purple Stairs');
            })){
                $updateUser=User::find($user->id);
                $updateUser->reminder_status=1;
                $updateUser->save();
            };
        }
        }
    }

        /* task - 86a20t4vm $trasactions=Transaction::get();
        if(!empty( $trasactions)){
            foreach($trasactions as $trasaction){
                if(!empty($trasaction)){
                    $url = 'https://api.banquestgateway.com/api/v2/transactions/11252276';

                    $headers = array(
                        'Authorization: Basic blZTOHhPN2N1eEc1Yk5PcUdMTE9QWDduRDdkcWNKYUs6cWdvNjc2anM='
                    );

                    $ch = curl_init($url);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $response = curl_exec($ch);

                    if (curl_errno($ch)) {
                        echo 'Curl error: ' . curl_error($ch);
                    }
                    curl_close($ch);
                    $array = json_decode($response, true);
                    if(!empty($array['status_details']['status'])){
                    $update=Transaction::find($trasaction->id);
                    $update->status=$array['status_details']['status'];
                    $update->save();
                    }
                    // Output the response
                }
            }
        }*/

    }


public function reminderEmailToCandidate3Days()
{
    $data = [];
    $twentyFourHoursAgo = Carbon::now();
    $users = User::where('status', 0)
    ->where('days3_reminder_status', 0)
    ->where('user_type', 'candidate')
    // ->whereDate('created_at', '>', $twentyFourHoursAgo)
    ->get();

    foreach ($users as $user) {
        $timeDifferenceInHours = $twentyFourHoursAgo->diff($user['created_at']);
        if(!empty($timeDifferenceInHours->d)){

            if($timeDifferenceInHours->d>=3){
        $toMail = $user->email;
        $data['name'] = $user->name;

        if(\Mail::send(['html' => 'mail.reminder_candidate3dyas'], $data, function ($message) use ($toMail) {
            $message->to($toMail, 'Purple Stairs')->subject('Employers Want to Connect With People Like You!');
            // $message->cc('eptdeveloper@gmail.com');
            $message->from('info@purplestairs.com', 'Purple Stairs');

        })){
            $updateUser=User::find($user->id);
            $updateUser->days3_reminder_status=1;
            $updateUser->save();
        };

    }
    }

}
}
public function reminderEmailToCandidate6Days()
{
    $data = [];
    $twentyFourHoursAgo = Carbon::now();
    $users = User::where('status', 0)
    ->where('days6_reminder_status', 0)
    ->where('user_type', 'candidate')
    // ->whereDate('created_at', '>', $twentyFourHoursAgo)
    ->get();

    foreach ($users as $user) {
        $timeDifferenceInHours = $twentyFourHoursAgo->diff($user['created_at']);
        if(!empty($timeDifferenceInHours->d)){

            if($timeDifferenceInHours->d>=6){
        $toMail = $user->email;
        $data['name'] = $user->name;

        if(\Mail::send(['html' => 'mail.reminder_candidate6dyas'], $data, function ($message) use ($toMail) {
            $message->to($toMail, 'Purple Stairs')->subject('Final Reminder: Finish Your Purple Stairs Profile!');
            // $message->cc('eptdeveloper@gmail.com');
            $message->from('info@purplestairs.com', 'Purple Stairs');

        })){
            $updateUser=User::find($user->id);
            $updateUser->days6_reminder_status=1;
            $updateUser->save();
        };

    }
    }

}
}
public function languageSet()
{
    $users=User::where('user_type','candidate')->where('status',1)->get();
    foreach($users as $user){
     $languae=\DB::table('language_user')->where(['user_id'=>$user->id,'language_id' => 1])->first();
     if(empty($languae)){
        $data = array(
            'user_id' => $user->id,
            'language_id' => 1,

        );
        \DB::table('language_user')->insert($data);

     }
    }
}

public function updateCharges()
{
    $client = new \GuzzleHttp\Client();
    $headers = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
    ];

    $allEmps = User::where('status', 1)
        ->whereNull('deleted_at')
        ->where('user_type', 'employer')
        ->where('reference', 0)
        ->with('subscriptions')
        ->get();

    foreach ($allEmps as $emps) {
        if (!empty($emps->subscriptions[0]['renewal_id'])) {
            try {
                $hist_url = env('PAYAPI_URL') . "recurring-schedules/" . $emps->subscriptions[0]['renewal_id'];
                $h_reposnse = $client->request('GET', $hist_url, ['headers' => $headers]);
                $h_content = json_decode($h_reposnse->getBody(), true);
                $recurring = $h_content;

                // Update charges
                $planPeriod = $emps->subscriptions[0]['plan_period'];
                $discountDuration = $emps->subscriptions[0]['discount_duration'];
                $transactionCount = $recurring['transaction_count'];

                if ($planPeriod == "month" && $discountDuration > 0 && $discountDuration == ($transactionCount+1)) {
                    $planId = $emps->subscriptions[0]['plan_id'];
                    $numberOfUsers = $emps->subscriptions[0]['number_of_users'];
                    $planAmount = ($planId == 1) ? 299 : 749;
                    $additionalCharge = ($planId == 1) ? 50 : 100;
                    $amount = $planAmount + (($numberOfUsers - 1) * $additionalCharge);

                    $recurringData = [
                        'amount' => $amount
                    ];
                    $client->request('PATCH', $hist_url, ['json' => $recurringData, 'headers' => $headers]);
                }
                $subscription = Subscription::find($emps->subscriptions[0]['id']);
                $subscription->next_run_date = $recurring['next_run_date'];
                $subscription->next_charge = $recurring['amount'];
                $subscription->save();
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                session()->flash('message', $e->getMessage());
                // Log the error for further investigation
                // Log::error('Guzzle Client Exception: ' . $e->getMessage());
            }
        }
    }
}
public function searchNewMatch()
    {
        $searches = Search::withTrashed()->get();
        foreach ($searches as $search) {
            $new_match_candidates = \DB::table('new_search_matches')
                ->where('search_id', $search->id)
                ->where('status', 0)
                ->get();

            foreach ($new_match_candidates as $new_match_candidate) {
                if (!empty($new_match_candidate->updated_at)) {
                    $updated_at = Carbon::parse($new_match_candidate->viewed_at);

                    if ($updated_at->diffInHours(\Carbon\Carbon::now()) >= 24) {
                        \DB::table('new_search_matches')
                            ->where('id', $new_match_candidate->id)
                            ->where('search_id', $search->id)
                            ->delete();
                    }
                }
            }
        }
    }

    public function searchMatchUser()
    {
        $searches = Search::onlyTrashed()->get();
        foreach ($searches as $search) {
            $activeUsersId = User::where('user_type', 'candidate')
            ->where('status', '1')
                ->pluck('id')
                ->toArray();
            $selectedHardSkills = json_decode($search['search_fields'])->selectedHardSkills ?? [];
            $selectedSoftSkills = json_decode($search['search_fields'])->selectedSoftSkills ?? [];
            $selectedIndustries = json_decode($search['search_fields'])->selectedIndustries ?? [];
            $selectedInterests = json_decode($search['search_fields'])->selectedInterests ?? [];
            $selectedLanguages = json_decode($search['search_fields'])->selectedLanguages ?? [];
            $selectSchedule = json_decode($search['search_fields'])->selectSchedule ?? [];
            $selectZipCode = json_decode($search['search_fields'])->selectZipCode ?? [];
            $selectSalaryRange = json_decode($search['search_fields'])->selectSalaryRange ?? [];
            $selectCurrentPosition = json_decode($search['search_fields'])->selectCurrentPosition ?? [];
            $selectWorkEnvironment = json_decode($search['search_fields'])->selectWorkEnvironment ?? [];
            $selectCompensation = json_decode($search['search_fields'])->selectCompensation ?? [];
            $selectDistance = json_decode($search['search_fields'])->selectDistance ?? [];
            $selectMinYearOfExperience = json_decode($search['search_fields'])->selectMinYearOfExperience ?? [];
            $selectMaxYearOfExperience = json_decode($search['search_fields'])->selectMaxYearOfExperience ?? [];
            $selectMinDistance = json_decode($search['search_fields'])->selectMinDistance ?? [];
            $selectMaxDistance = json_decode($search['search_fields'])->selectMaxDistance ?? [];
            $selectSeekingPosition = json_decode($search['search_fields'])->selectSeekingPosition ?? [];
            $filterYearOfExperience = json_decode($search['search_fields'])->filterYearOfExperience ?? []; // task - 86a2qrx00
            $filterDistance = json_decode($search['search_fields'])->filterDistance ?? []; // task - 86a2qrx00
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
            $distance_user_id = [];
            $all_search_user_id = [];
            if (!empty($selectSchedule)) {
                $schedule_user = \DB::table('personals')
                ->whereIn('user_id', $activeUsersId);
                $sch_condition = [];
                if (in_array('1', $selectSchedule)) {
                    $sch_condition[] = "schedule_full_time = 1";
                }
                if (in_array('2', $selectSchedule)) {
                    $sch_condition[] = "schedule_part_time = 1";
                }
                if (in_array('3', $selectSchedule)) {
                    $sch_condition[] = "schedule_no_preference = 1 OR schedule_full_time = 1 OR schedule_part_time = 1";
                }
                if (!empty($sch_condition)) {
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
                $selectZipCode = array_filter($selectZipCode);
                $selectZipCodes = collect($selectZipCode)->flatten()->toArray();
                $zip_code_user = \DB::table('personals')->whereIn('user_id', $activeUsersId)
                    ->WhereIn('zip_code', $selectZipCodes)->where('zip_code', '!=', '')->get()->toArray();
                if (count($zip_code_user) > 0) {
                    $zip_code_user_id = array_column($zip_code_user, "user_id");
                } else {
                    $zip_code_user_id[] = 0;
                }
            }
            if (!empty($selectWorkEnvironment)) {
                $work_environment_user = \DB::table('personals')
                ->whereIn('user_id', $activeUsersId);

                $env_condition = [];
                if (in_array('1', $selectWorkEnvironment)) {
                    $env_condition[] = "work_environment_remote = 1";
                }
                if (in_array('2', $selectWorkEnvironment)) {
                    $env_condition[] = "work_environment_in_office = 1";
                }
                if (in_array('3', $selectWorkEnvironment)) {
                    $env_condition[] = "work_environment_hybrid = 1 OR (work_environment_remote = 1 AND work_environment_in_office = 1)"; // task - 86a1rtted
                }

                if (!empty($env_condition)) {
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
                $compensation_user_user = \DB::table('personals')
                ->whereIn('user_id', $activeUsersId);

                $com_condition = [];
                if (in_array('1', $selectCompensation)) {
                    $com_condition[] = "compensation_salary = 1";
                }
                if (in_array('2', $selectCompensation)) {
                    $com_condition[] = "compensation_hourly = 1";
                }
                if (in_array('3', $selectCompensation)) {
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
                $salary_range_user = \DB::table('personals')
                ->whereIn('user_id', $activeUsersId);

                $salary_range_user = $salary_range_user->whereIn('salary_range', $selectSalaryRange);
                $salary_range_user = $salary_range_user->get()->toArray();
                if (count($salary_range_user) > 0) {
                    $salary_range_user_id = array_column($salary_range_user, "user_id");
                } else {
                    $salary_range_user_id[] = 0;
                }
            }
            if (!empty($selectCurrentPosition)) {
                $positions = explode(',', $selectCurrentPosition);
                $current_position_user = \DB::table('personals')->whereIn('user_id', $activeUsersId)
                    ->Where(function ($query) use ($positions) {
                        for ($i = 0; $i < count($positions); $i++) {
                            if (in_array(strtolower(trim($positions[$i])), ['ceo', 'coo', 'cfo'])) {
                                $query->orwhere('current_title', 'like',  $positions[$i]);
                            } else {
                                $query->orwhere('current_title', 'like',  '%' . $positions[$i] . '%');
                            }
                        }
                    })
                    ->get()->toArray();
                if (count($current_position_user) > 0) {
                    $current_position_user_id = array_column($current_position_user, "user_id");
                } else {
                    $current_position_user_id[] = 0;
                }
            }
            if (!empty($selectedHardSkills)) {
                $skill_user = \DB::table('skill_user')->whereIn('skill_id', $selectedHardSkills)->whereIn('user_id', $activeUsersId)->get()->toArray();
                if (count($skill_user) > 0) {
                    $hard_skill_user_id = array_column($skill_user, "user_id");
                } else {
                    $hard_skill_user_id[] = 0;
                }
            }
            if (!empty($selectedSoftSkills)) {
                $soft_skill_user_id[] = '';
                $skill_user = \DB::table('skill_user')->whereIn('skill_id', $selectedSoftSkills)->whereIn('user_id', $activeUsersId)->get()->toArray();
                if (count($skill_user) > 0) {
                    $soft_skill_user_id = array_column($skill_user, "user_id");
                } else {
                    $soft_skill_user_id[] = 0;
                }
            }

            if (!empty($selectedIndustries)) {
                $industry_user_id[] = '';
                $industry_user = \DB::table('industry_user')->whereIn('industry_id', $selectedIndustries)->whereIn('user_id', $activeUsersId)->get()->toArray();
                if (count($industry_user) > 0) {
                    $industry_user_id = array_column($industry_user, "user_id");
                } else {
                    $industry_user_id[] = 0;
                }
            }
            if (!empty($selectedInterests)) {
                $interest_user_id[] = '';
                $interest_user = \DB::table('interest_user')->whereIn('interest_id', $selectedInterests)->whereIn('user_id', $activeUsersId)->get()->toArray();
                if (count($interest_user) > 0) {
                    $interest_user_id = array_column($interest_user, "user_id");
                } else {
                    $interest_user_id[] = 0;
                }
            }
            if (!empty($selectedLanguages)) {
                $language_user_id[] = '';
                $language_user = \DB::table('language_user')->whereIn('user_id', $activeUsersId)->select('language_user.user_id', \DB::raw('group_concat(language_id) as users_languages'))->whereIn('language_id', $selectedLanguages)->groupBy('user_id')->get()->toArray();
                if (count($language_user) > 0) {
                    foreach ($language_user as $user) {
                        $users_langs = explode(',', $user->users_languages);
                        $match_result = array_intersect($selectedLanguages, $users_langs);
                        if (count($selectedLanguages) == count($match_result)) {
                            $language_user_id[] = $user->user_id;
                        }
                    }
                } else {
                    $language_user_id[] = 0;
                }
            }

            // if ($filterYearOfExperience) {
            //     if (($selectMaxYearOfExperience - $selectMinYearOfExperience) <= 40 && ($selectMaxYearOfExperience - $selectMinYearOfExperience) >= 0) {
            //         $filteredUsersExp = \DB::table('employments')->whereIn('user_id', $activeUsersId)->get()->toArray();
            //         foreach ($filteredUsersExp as $key => $employment) {
            //             $employments = $employment->toArray();
            //             $yrs_of_exp = 0;
            //             $exp_months = 0;
            //             if (count($employments)) {
            //                 $currently_working = array_values($employment->where('currently_working', 1)->toArray());
            //                 $currently_start_years = (array_column($currently_working, 'start_year'));
            //                 $currently_end_years = (array_column($currently_working, 'end_year'));

            //                 $manual_records = array_values($employment->where('currently_working', 0)->toArray());
            //                 $manual_start_years = (array_column($manual_records, 'start_year'));
            //                 $manual_end_years = (array_column($manual_records, 'end_year'));

            //                 $tmp_year = [];
            //                 if (count($currently_working)) {
            //                     $currently_start_years = array_map(
            //                         function ($element) {
            //                             $_yr = substr($element, -4);
            //                             return date('Y', strtotime('Jan ' . $_yr));
            //                         },
            //                         $currently_start_years
            //                     );
            //                     $c_min_year = min($currently_start_years);
            //                     $c_max_year = date('Y');

            //                     for ($y = $c_min_year; $y <= $c_max_year; $y++) {
            //                         $tmp_year[$y] = $y;
            //                     }
            //                 }

            //                 if (count($manual_records)) {
            //                     $manual_start_years = array_map(
            //                         function ($element) {
            //                             $_yr = substr($element, -4);
            //                             return date('Y', strtotime('Jan ' . $_yr));
            //                         },
            //                         $manual_start_years
            //                     );

            //                     $manual_end_years = array_map(
            //                         function ($element) {
            //                             $_yr = substr($element, -4);
            //                             return date('Y', strtotime('Jan ' . $_yr));
            //                         },
            //                         $manual_end_years
            //                     );
            //                     $m_min_year = min($manual_start_years);
            //                     $m_max_year = max($manual_end_years);

            //                     for ($y = $m_min_year; $y <= $m_max_year; $y++) {
            //                         $tmp_year[$y] = $y;
            //                     }
            //                 }

            //                 if ($tmp_year) {
            //                     $min_year = min($tmp_year);
            //                     $max_year = max($tmp_year);

            //                     $yrs_of_exp = $max_year - $min_year;
            //                 }
            //             }
            //             if ($yrs_of_exp >= $selectMinYearOfExperience && $yrs_of_exp <= $selectMaxYearOfExperience) {
            //                 $yrs_exp_user_id[] = $user->id;
            //             } else {
            //                 $yrs_exp_user_id[] = 0;
            //             }
            //         }
            //     }
            // }

            if ($filterDistance) {
                $companyZip = \DB::table('companies')->where('id', $search->company_id)->first();
                if (($selectMaxDistance - $selectMinDistance) <= 100 && ($selectMaxDistance - $selectMinDistance) > 0) {
                    $filteredUserForDistance =   \DB::table('personals')
                    ->whereIn('user_id', $activeUsersId)->get()->toArray();
                    foreach ($filteredUserForDistance as $key => $personal) {
                        $first = $personal;
                        if (!empty($first)) {
                            $dist = "Failed";
                            if ($first->lat && $first->lng && $companyZip->lng && $companyZip->lng) {
                                $dist = degrees_difference($first->lat, $first->lng, $companyZip->lat, $companyZip->lng);
                            }
                            if ($dist != "Failed") {
                                if ($dist > $selectMinDistance && $dist < $selectMaxDistance) {
                                    $distance_user_id[] = $personal->user_id;
                                }
                            } else {
                                $distance_user_id[] = $personal->user_id;
                            }
                        }
                    }
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
                array_unique($yrs_exp_user_id),
                array_unique($distance_user_id),
            ]);

            if (!empty($arrays)) {
                $all_search_user_id = call_user_func_array('array_intersect', $arrays);
            } else {
                $all_search_user_id = $arrays;
            }
            $past_search_match_users = json_decode($search->synced_users, true);
            $candidates = User::where('user_type', 'candidate')->whereIn('id', $all_search_user_id)->whereNotIn('id', $past_search_match_users);
            $search = Search::withTrashed()->find($search->id);
            if (!empty($search)) {
                $search->synced_users = json_encode($all_search_user_id);
                $search->old_synced_users = json_encode($all_search_user_id); // task - 86a26mwgd

                if ($search->save()) {
                    // $search->users()->sync($this->users_id);

                    $syncedUsers = json_decode($search->synced_users, true) ?? [];
                    \DB::table('search_user')->where(['search_id' => $search->id])->whereNotIn('user_id', $syncedUsers)->delete();
                    foreach (json_decode($search->synced_users, true) as $_id) {
                    if(!empty($_id)){
                        $searchUrFirst = \DB::table('search_user')->where('user_id', $_id)->where('search_id', $search->id)->first();
                        if (empty($searchUrFirst)) {
                            $tmDate = time();
                            \DB::table('search_user')->insert([
                                ['user_id' => $_id, 'search_id' => $search->id, 'last_viewed' => date('Y-m-d H:i:s', strtotime('-1 day', $tmDate))]
                            ]);
                        }
                        }
                    }
                }

                $company = \DB::table('companies')->where('id', $search->company_id)->first();
                if (!empty($company->user_id)) {
                    $subscription = Subscription::where('user_id', $company->user_id)->where('status', 1)->first();
                }
                if (!empty($subscription)) {
                    $candidates->where('status', 1);
                    $candidates->whereNull('deleted_at');
                    if ($subscription->plan_id == 1) {
                        $c_HR = date('G');
                        if ($c_HR < 8) {
                            $candidates->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, users.created_at, NOW()))"), '>', 24);
                        } else {
                            $candidates->where(\DB::raw("DATE(users.created_at) < DATE(NOW())"), '=', 1)->where(\DB::raw($c_HR), ">=", 8);
                        }
                    } elseif ($subscription->plan_id == 2) {
                        // code...
                    } elseif ($subscription->plan_id == 3) {
                        // code...
                    }
                    \DB::table('new_search_matches')->where('search_id', $search->id)->whereNotIn('match_uid', $all_search_user_id)->delete();

                    $candidates = $candidates->get();

                    foreach ($candidates as $key => $candidate) {
                        if (!empty($candidate->id)) {
                            $newmatch = \DB::table('new_search_matches')
                            ->where('search_id', $search->id)
                                ->where('match_uid', $candidate->id)
                                ->first();

                            if (empty($newmatch)) {
                                \DB::table('new_search_matches')->insert([
                                    'match_uid' => $candidate->id,
                                    'search_id' => $search->id
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
    public function validUsZip()
    {
        $zipCodes = ZipCode::withTrashed()->get();

        foreach ($zipCodes as $zipCode) {
            $existingCode = ZipCode::withTrashed()->find($zipCode->id);

            if (!empty($existingCode)) {
                $zip_code_user = \DB::table('personals')
                    ->where('zip_code', $existingCode->zip_code)
                    ->where('country_abbr', 'US')
                    ->where('state', '!=', '')
                    ->first();

                if ($zip_code_user) {
                    $existingCode->state = $zip_code_user->state;
                    $existingCode->save();
                }
            }
        }
    }


}
