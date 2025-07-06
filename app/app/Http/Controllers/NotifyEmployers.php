<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Company;
use App\Models\Delete;
use App\Models\Search;
use App\Models\Invited_user;

class NotifyEmployers extends Controller
{
    public function send_notification(){
        $users = User::where('user_type', 'employer')->whereNull('deleted_at')->get();
        
        $todays_date = date('Y-m-d');
        foreach ($users as $user) {
            if ($user->reference > 0) {
                $user_id = $user->reference;
                $company_id = Company::where('user_id', $user->reference)->pluck('id')->first();
                $subscription = Subscription::where('user_id', $user->reference)->where('status', 1)->orderBy('id', 'desc')->first();
            } else {
                $user_id = $user->id;
                $company_id = Company::where('user_id', $user->id)->pluck('id')->first();
                $subscription = Subscription::where('user_id', $user->id)->where('status', 1)->orderBy('id', 'desc')->first();
            }

            if ($subscription) {      
                $new_data = []; $employer = null; $search = null; 
                if ($subscription->plan_id == 2) {
                    $searches = Search::where('company_id',$company_id)->withTrashed()->get();

                    foreach ($searches as $key => $search) {
                        //get saved search
                        $search_fields = json_decode($search->search_fields,true);

                        //assign respective search values from search_fields array
                        $this->selectedInterests = $search_fields['selectedInterests'];
                        $this->selectedIndustries = $search_fields['selectedIndustries'];
                        $this->selectedLanguages = $search_fields['selectedLanguages'];
                        $past_search_match_users = json_decode($search->synced_users, true);

                        // find new candidates
                        $new_candidates = User::with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companies'])
                        ->where('user_type', 'candidate')
                        ->whereIn('id', $this->newCondidate($search->slug))
                        ->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, NOW(), users.created_at))"), "<", 24)
                        ->whereNotIn('id', $past_search_match_users);

                        /*if(!empty($subscription)) { // task - 862k46g33
                            if ($subscription->plan_id == 1) {
                                $c_HR = date('G');
                                if($c_HR < 8) {
                                    $new_candidates->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, users.created_at, NOW()))"), '>', 24);
                                } else {
                                    $new_candidates->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, users.created_at, NOW()))"), '>', 24)
                                              ->where(\DB::raw('HOUR(NOW())'), ">=", 8); 
                                }
                            } 
                        }*/

                        $new_candidates_count = clone $new_candidates;
                        if ($new_candidates_count->count()) {
                            $employer = $user->name; 
                            $new_data[] = array(
                                'search' => $search->name,
                                'slug' => $search->slug,
                                'new_candidates' => $new_candidates->get()
                            ); 
                        }
                    }
                }

                // print_r($new_data);
                if(!empty($new_data)) {
                    $this->send_email($user, $new_data);
                    // return view('mail.notify_employer', compact('new_data','employer'));
                }

                // task - 8678fd0em
                $tracking = \DB::table('employer_tracking')->where('employer_id', $user_id)->first();
                $track_arr = array(
                    'employer_id' => $user_id,
                    'last_matches_on' => date('Y-m-d H:i:s'),
                );
                if ($tracking) {
                    \DB::table('employer_tracking')->where('employer_id', $user_id)->update($track_arr);
                } else {
                    $track_arr['last_unmask_req'] = date('Y-m-d H:i:s');
                    \DB::table('employer_tracking')->insert($track_arr);
                }
                // task - 8678fd0em end
            }
        }
    }

    public function send_email($user, $new_data)
    {
        $name = explode(' ', trim($user->name)); // task - 86a15vje7
        $data = array('employer' => $name[0]/*user->name*/, 'new_data' => $new_data);
        $to_mail = $user->email;

        \Mail::send(['html'=>'mail.notify_employer'], $data, function($message) use ($to_mail) {
             $message->to($to_mail, 'Purple Stairs')->subject
                ('You Have New Candidate Matches');
             $message->from('info@purplestairs.com','Purple Stairs');
        });

        // 86a314ztu
        if(!empty($user->id)){
            $invitedUsers=Invited_user::where('sender_userid',$user->id)->get();
            foreach ($invitedUsers as $key => $invitedUser) {
                if(!empty($invitedUser->invited_user_id)){
                $invited=User::find($invitedUser->invited_user_id);
                $name = explode(' ', trim($invited->name));
                $data = array('employer' => $name[0], 'new_data' => $new_data);
                $to_mail = $invited->email;
                \Mail::send(['html'=>'mail.notify_employer'], $data, function($message) use ($to_mail) {
                    $message->to($to_mail, 'Purple Stairs')->subject('You Have New Candidate Matches');
                    $message->from('info@purplestairs.com','Purple Stairs');
                });
            }
            }
        }

    }

    public function newCondidate($slug)
    {
        $user_ids = [];
        $search = Search::where('slug', $slug)->withTrashed()->first();
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
            // $current_position_user = \DB::table('personals')->whereIn('current_title', $selectCurrentPosition)->get();
            // dd($selectCurrentPosition);
            $current_position_user = \DB::table('personals')
                ->Where(function ($query) use ($selectCurrentPosition) {
                    /*for ($i = 0; $i < count($selectCurrentPosition); $i++) {
                        $query->orwhere('current_title', 'like',  '%' . $selectCurrentPosition[$i] . '%');
                    }*/
                    foreach ((array)$selectCurrentPosition as $value) {
                        $query->orwhere('current_title', 'like',  '%' . $value . '%');
                    }
                })->get();
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

        $searched_users_id="";
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



        return array_unique($candidates->pluck('id')->toArray());


        // return $candidates->pluck('id')->toArray();
    }
}
