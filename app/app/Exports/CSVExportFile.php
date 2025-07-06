<?php

namespace App\Exports;
use App\Models\User;
use App\Models\Personal;
use App\Models\Skill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
class CSVExportFile implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch and return your data here
        $users =  Personal::all();

        $customizedData = $users->map(function ($user) {
            $user_id =  User::find($user->user_id);
            $data = User::where('id', $user->user_id)->whereNull('deleted_at')->first();
            if ($user_id) {
                $soft_skills = $user_id->softSkills->pluck('name')->toArray();
                $hard_skills = $user_id->hardSkills->pluck('name')->toArray();
                $soft_skills = $user_id->softSkills->pluck('name')->toArray();
                // $educations = $user_id->educations;
                // $employments = $user_id->employments->toArray();
                $languages = $user_id->languages->pluck('name')->toArray();
                $references = $user_id->references;
            }
            $step_reached = "0";
            $resume_uploaded = "No";
            $allow_recuiters = ""; // task - 86a1zaq80

            $work_settings = ""; // task - 86a2ae1kx
            if(isset($data)){
                // if($data->step_reached ==1){
                //     $step_reached =  1;
                // }else if($data->step_reached  <= 2 && $data->step_reached  >=1){
                //     $step_reached =  2;
                // }
                // else if ($data->step_reached <= 4 && $data->step_reached >= 2) {
                //     $step_reached =   3;
                // } else if ($data->step_reached <6 && $data->step_reached >= 4 ) {
                //     $step_reached =   4;
                // } else if ($data->step_reached  >= 6) {
                //     $step_reached =  5;
                // }else{
                //     $step_reached =  0;
                // };
                if($data->resume_uploaded=='1'){
                    $resume_uploaded='Yes';
                }

                // task - 86a1zaq80
                if($data->allow_recuiters=='1'){
                    $allow_recuiters='Yes';
                } elseif ($data->allow_recuiters=='0') {
                    $allow_recuiters='No';
                }
                // task - 86a1zaq80 end

                if($data->step_reached==1){
                    $step_reached=0;
                }
                elseif($data->step_reached==2){
                    $step_reached=1;
                 }
                elseif ($data->step_reached== 4 ) {
                    $step_reached = 2;
                }
                elseif ($data->step_reached== 5 ) {
                    $step_reached = 3;
                }
                elseif ($data->step_reached== 6 ) {
                    $step_reached = 4;
                }
                elseif ($data->step_reached==7 ) {
                     $step_reached = 5;
                }
                 elseif ($data->step_reached == 8) {
                      $step_reached = 6;
                }
                elseif ($data->step_reached >=9 ) {
                      $step_reached = 7;
                }
            }
            $soft_skills_set = !empty($soft_skills) ? implode(',', $soft_skills) :"N/A";
            $hard_skills_set = !empty($hard_skills) ? implode(',', $soft_skills) :"N/A";
            //$educations_set = "";
            // if(!empty($educations)){
            //     foreach($educations as $education){

            //         $educations_set .= $education;
            //     }
            // }else{
            //     $educations_set .= "N/A";
            // }
            //$employments_set = count($employments) >0 ?  $employments : "N/A";
                // if(!empty($employments)){
                //     foreach($employments as $employment){
                //         $employments_set .= $employment;
                //     }
                // }else{
                //     $employments_set .= "N/A";
                // }
            $references_set = "";

            if(!empty($references)){
                foreach($references as $reference){
                    $references_set .= $reference->name .",". $reference->relationship .",". $reference->phone.",". $reference->email .PHP_EOL ;
                }
            }else{
                $references_set .= "N/A";
            }

            $languages_set = !empty($languages) ? implode(",",$languages) :"N/A";
            $status = !empty($data->status) ? 'Active' :"Pending";
            $adSource="";
            if(!empty($data->ad_source)){
                if($data->ad_source=='Other'){
                    if(!empty($data->other_ad_source_text)){
                        $adSource=$data->other_ad_source_text;
                    }else{
                        $adSource=$data->ad_source;
                    }

                }else{
                    $adSource=$data->ad_source;
                }
            }

            // task - 86a2ae1kx
            if ($user->work_environment_remote == '1') {
                $work_settings .= "Remote";
            }
            if($user->work_environment_in_office == '1') {
                if(!empty($work_settings)) { $work_settings .= ", "; }
                $work_settings .= "In-Office";
            }
            if ($user->work_environment_hybrid == '1') {
                if(!empty($work_settings)) { $work_settings .= ", "; }
                $work_settings .= "Hybrid";
            }

            $employments = []; $yrs_of_exp = 0; $exp_months = 0;
            if ($user_id) {
                if($user_id->employments->count()) {
                    $employments = $user_id->employments->toArray();

                    $currently_working = array_values($user_id->employments->where('currently_working', 1)->toArray());
                    $currently_start_years = (array_column($currently_working, 'start_year'));
                    $currently_end_years = (array_column($currently_working, 'end_year'));

                    $manual_records = array_values($user_id->employments->where('currently_working', 0)->toArray());
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
            // task - 86a2ae1kx end

            return [$user->id,$user->name,$user->email,$user->created_at,$user->phone,$user->current_title, $user->prefered_benefits_insurance_benefits.','.$user->prefered_benefits_padi_holidays .','.$user->prefered_benefits_paid_vacation_days.','.$user->prefered_benefits_professional_environment.','.$user->prefered_benefits_casual_environment,$user->short_bio,$user->zip_code,$user->linkedin_url,$user->salary_range,$work_settings,$yrs_of_exp,$user->distance,$step_reached,$soft_skills_set,$hard_skills_set,$languages_set,$references_set,$resume_uploaded,$allow_recuiters,$status,$adSource];
        });
       return $customizedData;
    }

    public function headings(): array
    {
        // Return an array of headings
        return ['S.no','Name', 'Email','Join Date','Phone','Current Title','Prefered Benefits','Short bio','Zip Code','Linkedin URL','Salary Range','Work Settings','Yrs Of Experiance','Distance','Step Reached','Soft Skills','Hard Skils','Languages','References','Resume Uploaded', 'Allow Recruiters','Status','Ad Source'];
    }
}
