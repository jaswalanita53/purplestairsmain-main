<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Mail;
/* Open AI Chat GPT */
use App\Models\Education;
use App\Models\Reference;
use App\Models\Employment;
use App\Models\Language;
use App\Models\Skill;
use Smalot\PdfParser\Parser;
use Yethee\Tiktoken\EncoderProvider;

class CandidateController extends Controller
{
    public function candidatestep1()
    {
        return view('pages.candidatestep1');
    }
    public function candidatestep2()
    {
        return view('pages.candidatestep2');
    }
    public function candidatestep3()
    {
        // return view('pages.candidatestep3');
        return redirect('/candidate/education');  // Task #86a0h5rvz
    }
    public function candidatestep4()
    {
        return view('pages.candidatestep4');
    }
    public function candidatestep5()
    {
        return view('pages.candidatestep5');
    }
    public function candidatestep6()
    {
        return view('pages.candidatestep6');
    }
    public function candidatestep7()
    {
        return view('pages.candidatestep7');
    }
    public function candidatestep8()
    {
        return view('pages.candidatestep8');
    }
    public function candidatestep9()
    {
        return view('pages.candidatestep9');
    }
    public function candidateProfile()
    {
        return view('pages.candidatesProfile');
    }
    public function requests()
    {
        return view('pages.candidateRequests');
    }
    public function editPersonal()
    {
        return view('pages.candidateEditPersonal');
    }
    public function editPreferences()
    {
        return view('pages.candidateEditPreferences');
    }
    public function editResume()
    {
        return view('pages.candidateEditResume');
    }

    // task - 86a2cwfq4
    public function manageAccount(){
        return view('pages.candidatemanageaccount');
    }
    public function downloadPdf()
    {
        $personal = Personal::where('user_id', Auth::user()->id)->first();
        $industries = Auth::user()->industries->pluck('name')->toArray();
        $interests = Auth::user()->interests->pluck('name')->toArray();
        $educations = Auth::user()->educations;
        $employments = Auth::user()->employments;
        $skills = Auth::user()->skills;
        $soft_skills = Auth::user()->softSkills->pluck('name')->toArray();
        $hard_skills = Auth::user()->hardSkills->pluck('name')->toArray();
        $languages = Auth::user()->languages->pluck('name')->toArray();
        $references = Auth::user()->references;
        $mode = false;

        // return to view
        //    return view('pages.downloadPdf', compact(
        //         'personal',
        //         'industries',
        //         'interests',
        //         'educations',
        //         'employments',
        //         'skills',
        //         'soft_skills',
        //         'hard_skills',
        //         'languages',
        //         'references',
        //         'mode'
        //     )); exit();

        $pdf = PDF::loadView('pages.downloadPdf', compact(
            'personal',
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
        ));
        return $pdf->download('Purple Stairs-' . strtoupper($personal->name) . '.pdf');
    }

        // 86a2zxgm6
        public function downloadPdfEmployer($user_id)
        {
           $user=User::find($user_id);
            $personal = Personal::where('user_id', $user->id)->first();
            $industries = $user->industries->pluck('name')->toArray();
            $interests = $user->interests->pluck('name')->toArray();
            $educations = $user->educations;
            $employments = $user->employments;
            $skills = $user->skills;
            $soft_skills = $user->softSkills->pluck('name')->toArray();
            $hard_skills = $user->hardSkills->pluck('name')->toArray();
            $languages = $user->languages->pluck('name')->toArray();
            $references = $user->references;
            $mode = false;

            $pdf = PDF::loadView('pages.downloadPdf', compact(
                'user',
                'personal',
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
            ));
            return $pdf->download('Purple Stairs-' . strtoupper($personal->name) . '.pdf');
        }
        // 86a2zxgm6

    public function uploadPdf(Request $request)
    {
        // Validate the file upload
        $request->validate([
           'fileInput' => 'required|mimes:pdf,doc,docx,zip|max:10000',
        ],
        [
            'mimes' => 'Error: parser only accepts .doc, .docx and .pdf'
        ]);

        // Check if a file was uploaded
        if ($request->hasFile('fileInput')) {
            // Handle file upload
            $file = $request->file('fileInput');
            $filePath = $file->store('uploads');

            /* task - 86a1tnfve SHUT OFF THE EMAIL
            // Send email with attachment
            $email = 'info@purplestairs.com';
            $userName = Auth::user()->name;
            $subject = 'CV Uploaded - '.$userName;
            $message = 'Please find the attached file. ';

            $ext = $file->getClientOriginalExtension();
            if(Mail::raw($message, function ($mail) use ($email, $subject, $filePath, $userName, $ext) {
                $mail->to($email)
                    ->subject($subject)
                    ->attachData(file_get_contents(storage_path('app/' . $filePath)), $userName . '-purplestaires.' . $ext);
            })){
            }*/
            $usr=User::find(Auth::id());
            $usr->resume_uploaded='1';
            $usr->save();

            /* Open AI to feelout all the resume details */
            $file = $request->file('fileInput');
            $ext = $file->getClientOriginalExtension();

            $content = "";
            $filename = $file->getPathname();
            if (in_array($ext, ['docx'])) {
                $striped_content = '';

                if(!$filename || !file_exists($filename)) return false;

                $zip = zip_open($filename);

                if (!$zip || is_numeric($zip)) return false;

                while ($zip_entry = zip_read($zip)) {

                    if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

                    if (zip_entry_name($zip_entry) != "word/document.xml") continue;

                    $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

                    zip_entry_close($zip_entry);
                }
                zip_close($zip);

                $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
                $content = str_replace('</w:r></w:p>', " ", $content);
                $content = strip_tags($content);
            } elseif (in_array($ext, ['doc'])) { // TASK - 86a1vjkmk - POINT - 2
                $fileHandle = fopen($filename, "r");
                $line = @fread($fileHandle, filesize($filename));
                $lines = explode(chr(0x0D),$line);
                foreach($lines as $thisline)
                  {
                    $pos = strpos($thisline, chr(0x00));
                    if (($pos !== FALSE)||(strlen($thisline)==0))
                      {
                      } else {
                        $content .= $thisline." ";
                      }
                  }
                $content = strip_tags($content);
                $content = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$content);
                $content = str_replace(["\n", "\t"], "", $content);

            } elseif (in_array($ext, ['pdf'])) {
                $pdfParser = new Parser();
                $pdf = $pdfParser->parseFile($file);
                $content = $pdf->getText();
            } else {
                return response()->json(['messagePdfError' => 'Please upload a valid file.']);

            }

            $pdf_str = "\n".($content);
            $pdf_str = str_replace(['"', '!', '<'], " ", $pdf_str);

            //$prompt = 'Summarize the text below into a JSON with exactly the following structure {basic_info: {first_name, last_name, full_name, email, phone_number, location, post_code, portfolio_website_url, linkedin_url, majors, short_description, about_me, objective, GPA, profile_image, experience}, educations: [{university, course_name, program_name, is_present, duration, start_month, end_month, start_year, end_year}],work_experience: [{job_title, company, location, duration, start_month, end_month, start_year, end_year, is_present, job_summary, accomplishment}], skills: [{skill_title, skill_description}], languages:[{language}], references:[{ name, email, phone, relation}]} ' . $pdf_str;
        //    Task #86a20rvvw
        // 86a25n8jg
            $prompt = 'Extract following information from the provided text and structure it into a JSON format code only. Preserve bullets/emojis in job_summary and accomplishment. Sanitize the text of start_month, end_month, start_year,
            end_year:

                {
                  "basic_info": {
                    "first_name": "",
                    "last_name": "",
                    "full_name": "",
                    "email": "",
                    "phone_number": "",
                    "short_description": "",
                    "about_me": "",
                    "objective": "",
                    "profile_image": ""
                  },
                  "educations": [
                    {
                      "university": "",
                      "course_name": "",
                      "program_name": "",
                      "is_present": false,
                      "duration": "",
                      "start_month": "",
                      "end_month": "",
                      "start_year": "",
                      "end_year": ""
                    }
                  ],
                  "work_experience": [
                    {
                      "job_title": "",
                      "company": "",
                      "location": "",
                      "duration": "",
                      "start_month": "",
                      "end_month": "",
                      "start_year": "",
                      "end_year": "",
                      "is_present": false,
                      "job_summary": "",
                      "accomplishment": ""
                    }
                  ],
                  "skills": [],
                  "languages": [
                    {
                      "language": ""
                    }
                  ],
                  "references": [
                    {
                      "name": "",
                      "email": "",
                      "phone": "",
                      "relation": ""
                    }
                  ]
                }

                Text to analyze:' . $pdf_str;
            // get tokens
            $provider = new EncoderProvider();
            $encoder = $provider->getForModel('gpt-4-1106-preview');
            $tokens = count($encoder->encode($prompt));

            // calculate answer tokens
            $max_tokens = 4096;
            $answer_tokens = ($max_tokens - $tokens);

            $headers = [
                'Content-Type: application/json',
                'Authorization: Bearer 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'
            ];

            $body = [
                "model" => "gpt-4-1106-preview",
                "messages" => [
                    [
                        "role" => "user",
                        "content" => $prompt
                    ]
                ],
                "temperature" => 0.0,
                "max_tokens" => $answer_tokens,
                "top_p" => 1,
                "frequency_penalty" => 0,
                "presence_penalty" => 0
            ];
            set_time_limit(1800);
            $url ="https://api.openai.com/v1/chat/completions";
            $data = json_encode($body);
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $curl_response = curl_exec($ch);
            $response = json_decode($curl_response,true);

            if (isset($response['error'])) {
                $this->fileInputError = $response['error']['message'];
                return response()->json(['messagePdfError' => $response['error']['message']]);

            } else {
                $response_text = $response['choices'][0]['message']['content'];
                $res_data = str_replace(['```json', '```'], '', $response_text);
                $res_data = json_decode($res_data, true);
;
                if ($res_data) {
                    $user = Auth::user();
                    // save personal info
                    $personal = $user->personal;

                    // task - 86a1tp6e5
                    $about_me = "";
                    if ($res_data['basic_info']['about_me']) {
                        if($about_me != "") $about_me .= "\n";
                        $about_me .= $res_data['basic_info']['about_me'];
                    }
                    if ($res_data['basic_info']['short_description']) {
                        if($about_me != "") $about_me .= "\n";
                        $about_me .= $res_data['basic_info']['short_description'];
                    }
                    if ($res_data['basic_info']['objective']) {
                        if($about_me != "") $about_me .= "\n";
                        $about_me .= $res_data['basic_info']['objective'];
                    }

                    if (empty($personal)) {
                        Personal::create([
                            'user_id'   => $user->id,
                            'short_bio' => $about_me
                        ]);
                    } else {
                        $personal->short_bio    = $about_me;
                        $personal->save();
                    }

                    // save education details
                    $pdf_educations = $res_data['educations'];
                    $educations = Education::where('user_id', $user->id)->get()->toArray();
                    if ($educations) {
                        foreach ($pdf_educations as $edu_key => $edu) {
                            $row_edu = Education::where(['program_name' => $edu['program_name'], 'organization_name' => $edu['university'], 'user_id' => $user->id])->first();
                            if (empty($row_edu)) {
                                $row_edu = Education::whereRaw("((`program_name` = '' OR `program_name` IS NULL) AND (`organization_name` = '' OR `organization_name` IS NULL) AND (`start_year` = '' OR `start_year` IS NULL) AND (`end_year` = '' OR `end_year` IS NULL))")->where(['user_id' => $user->id])->first();
                            }

                            $start_year = null; $end_year = null;

                            // 86a25n8jg
                            if (!empty($edu['start_month']) && !empty($edu['start_year'])) {
                                if (is_numeric($edu['start_month'])) {
                                    $edu['start_month'] = date('F', mktime(0, 0, 0, $edu['start_month'], 1));
                                }
                                $start_year = date('M Y', strtotime($edu['start_month'] . ' ' . $edu['start_year']));
                            } elseif (!empty($edu['start_year'])) {
                                $start_year = date('Y', strtotime('Jan ' . $edu['start_year'])); // Default month is January
                            }

                            if (!empty($edu['end_month']) && !empty($edu['end_year'])) {
                                if (is_numeric($edu['end_month'])) {
                                    $edu['end_month'] = date('F', mktime(0, 0, 0, $edu['end_month'], 1));
                                }
                                $end_year = date('M Y', strtotime($edu['end_month'] . ' ' . $edu['end_year']));
                            } elseif (!empty($edu['end_year'])) {
                                $end_year = date('Y', strtotime('Jan ' . $edu['end_year'])); // Default month is January
                            }

                            if ($row_edu) {
                                $row_edu->organization_name = $edu['university'];
                                $row_edu->program_name = $edu['program_name'];
                                $row_edu->course_description = $edu['course_name'];
                                $row_edu->start_year = $start_year;
                                $row_edu->end_year = $edu['is_present'] ? null : $end_year;
                                $row_edu->currently_studying = $edu['is_present'];
                                $row_edu->save();

                            } else {
                                Education::create([
                                    'user_id' => $user->id,
                                    'organization_name' => $edu['university'],
                                    'program_name' => $edu['program_name'],
                                    'course_description' => $edu['course_name'],
                                    'start_year' => $start_year,
                                    'end_year' => $edu['is_present'] ? null : $end_year,
                                    'currently_studying' => $edu['is_present']
                                ]);
                            }
                        }
                    } else {
                        if($pdf_educations){
                            foreach ($pdf_educations as $edu_key => $edu) {
                                $start_year = null; $end_year = null;

                                if (!empty($edu['start_month']) && !empty($edu['start_year'])) {
                                    if (is_numeric($edu['start_month'])) {
                                        $edu['start_month'] = date('F', mktime(0, 0, 0, $edu['start_month'], 1));
                                    }
                                    $start_year = date('M Y', strtotime($edu['start_month'] . ' ' . $edu['start_year']));
                                } elseif (!empty($edu['start_year'])) {
                                    $start_year = date('Y', strtotime('Jan ' . $edu['start_year'])); // Default month is January
                                }

                                if (!empty($edu['end_month']) && !empty($edu['end_year'])) {
                                    if (is_numeric($edu['end_month'])) {
                                        $edu['end_month'] = date('F', mktime(0, 0, 0, $edu['end_month'], 1));
                                    }
                                    $end_year = date('M Y', strtotime($edu['end_month'] . ' ' . $edu['end_year']));
                                } elseif (!empty($edu['end_year'])) {
                                    $end_year = date('Y', strtotime('Jan ' . $edu['end_year'])); // Default month is January
                                }

                                Education::create([
                                    'user_id' => $user->id,
                                    'organization_name' => $edu['university'],
                                    'program_name' => $edu['course_name'],
                                    // 'course_description' => $edu[''],
                                    'start_year' => $start_year,
                                    'end_year' => $edu['is_present'] ? null : $end_year,
                                    'currently_studying' => $edu['is_present']
                                ]);
                            }
                        } else {
                            Education::create([
                                'user_id' => $user->id
                            ]);
                        }
                    }

                    // save employment details
                    $pdf_employments = $res_data['work_experience'];
                    $employments = Employment::where('user_id', $user->id)->get()->toArray();
                    if ($employments) {
                        foreach ($pdf_employments as $emp_key => $emp) {
                            $row_emp = Employment::where(['company_name' => $emp['company'], 'user_id' => $user->id, 'position' => $emp['job_title']])->first();
                            if (empty($row_emp)) {
                                $row_emp = Employment::whereRaw("((`company_name` = '' OR `company_name` IS NULL) AND (`position` = '' OR `position` IS NULL) AND (`start_year` = '' OR `start_year` IS NULL) AND (`end_year` = '' OR `end_year` IS NULL))")->where(['user_id' => $user->id])->first();
                            }
                            $e_start_year = null; $e_end_year = null;
                            // 86a25n8jg
                            if (!empty($emp['start_month']) && !empty($emp['start_year'])) {
                                if (is_numeric($emp['start_month'])) {
                                    $emp['start_month'] = date('F', mktime(0, 0, 0, $emp['start_month'], 1));
                                }
                                $e_start_year = date('M Y', strtotime($emp['start_month'] . ' ' . $emp['start_year']));
                            } elseif (!empty($emp['start_year'])) {
                                $e_start_year = date('Y', strtotime('Jan ' . $emp['start_year'])); // Default month is January
                            }

                            if (!empty($emp['end_month']) && !empty($emp['end_year'])) {
                                if (is_numeric($emp['end_month'])) {
                                    $emp['end_month'] = date('F', mktime(0, 0, 0, $emp['end_month'], 1));
                                }
                                $e_end_year = date('M Y', strtotime($emp['end_month'] . ' ' . $emp['end_year']));
                            } elseif (!empty($emp['end_year'])) {
                                $e_end_year = date('Y', strtotime('Jan ' . $emp['end_year'])); // Default month is January
                            }

                            if ($row_emp) {
                                $row_emp->company_name = $emp['company'];
                                $row_emp->position = $emp['job_title'];
                                $row_emp->responsibilities = $emp['job_summary'];
                                $row_emp->start_year = $e_start_year;
                                $row_emp->end_year = $emp['is_present'] ? null : $e_end_year;
                                $row_emp->currently_working = $emp['is_present'];
                                $row_emp->save();

                            } else {
                                Employment::create([
                                    'user_id' => $user->id,
                                    'company_name' => $emp['company'],
                                    'position' => $emp['job_title'],
                                    'responsibilities' => $emp['job_summary'],
                                    'start_year' => $e_start_year,
                                    'end_year' => $emp['is_present'] ? null : $e_end_year,
                                    'currently_working' => $emp['is_present']
                                ]);
                            }
                        }
                    } else {
                        if($pdf_employments){
                            foreach ($pdf_employments as $emp_key => $emp) {
                                $e_start_year = null; $e_end_year = null;
                                if (!empty($emp['start_month']) && !empty($emp['start_year'])) {
                                    if (is_numeric($emp['start_month'])) {
                                        $emp['start_month'] = date('F', mktime(0, 0, 0, $emp['start_month'], 1));
                                    }
                                    $e_start_year = date('M Y', strtotime($emp['start_month'] . ' ' . $emp['start_year']));
                                } elseif (!empty($emp['start_year'])) {
                                    $e_start_year = date('Y', strtotime('Jan ' . $emp['start_year'])); // Default month is January
                                }
                                if (!empty($emp['end_month']) && !empty($emp['end_year'])) {
                                    if (is_numeric($emp['end_month'])) {
                                        $emp['end_month'] = date('F', mktime(0, 0, 0, $emp['end_month'], 1));
                                    }
                                    $e_end_year = date('M Y', strtotime($emp['end_month'] . ' ' . $emp['end_year']));
                                } elseif (!empty($emp['end_year'])) {
                                    $e_end_year = date('Y', strtotime('Jan ' . $emp['end_year'])); // Default month is January
                                }

                                Employment::create([
                                    'user_id' => $user->id,
                                    'company_name' => $emp['company'],
                                    'position' => $emp['job_title'],
                                    'responsibilities' => $emp['job_summary'],
                                    'start_year' => $e_start_year,
                                    'end_year' => $emp['is_present'] ? null : $e_end_year,
                                    'currently_working' => $emp['is_present']
                                ]);
                            }
                        }
                    }

                    // save skills and laguages details
                    $pdf_skills = $res_data['skills'];
                    if ($pdf_skills) {
                        // $pdf_skills = array_column($pdf_skills, 'skill_title');
                        // $pdf_skill_desc= array_column($pdf_skills, 'skill_description');

                        // get related soft-skills
                        $soft_skills = Skill::where('skill_type', 'soft_skills')->whereIn('name', $pdf_skills)->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
                        // $soft_skill_id = array_column($soft_skills, 'id');
                        $soft_skill_id = array_values($soft_skills);
                        $user->softSkills()->detach($user->softSkills->pluck('id')->toArray());
                        $user->softSkills()->attach($soft_skill_id);

                        // get related hard-skills
                        $hard_skills = Skill::where('skill_type', 'hard_skills')->whereIn('name', $pdf_skills)->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
                        // $hard_skill_id = array_column($hard_skills, 'id');
                        $hard_skill_id = array_values($hard_skills);
                        $user->hardSkills()->detach($user->hardSkills->pluck('id')->toArray());
                        $user->hardSkills()->attach($hard_skill_id);
                    }


                    $pdf_languages = $res_data['languages'];
                    if ($pdf_languages) {
                        $pdf_languages = array_column($pdf_languages, 'language');
                        $synced_lang = Language::whereIn('name', $pdf_languages)->get()->toArray();
                        $synced_lang_id = array_column($synced_lang, 'id');
                        $user->languages()->sync($synced_lang_id);
                    }

                    // save references details
                    $pdf_references = $res_data['references'];
                    $references = Reference::where('user_id',$user->id)->get();
                    if ($references) {
                        foreach ($pdf_references as $ref_key => $reference) {
                            $phone = $reference['phone'];
                            if ($phone) {
                                $phone = str_replace(['+', '(', ')',' ', '-'], "", $phone);
                                $phone = substr($phone, -10);
                                $phone = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $phone);
                            }

                            $row_ref = Reference::whereRaw('( phone="'.$phone.'" OR email="'.$reference['email'].'" )')->where(['user_id' => $user->id])->first();
                            if (empty($row_emp)) {
                                $row_ref = Reference::whereRaw("((`name` = '' OR `name` IS NULL) AND (`phone` = '' OR `phone` IS NULL) AND (`email` = '' OR `email` IS NULL))")->where(['user_id' => $user->id])->first();
                            }

                            if($row_ref) {
                                $row_ref->name          = $reference['name'];
                                $row_ref->relationship  = $reference['relation'];
                                $row_ref->phone         = $phone;
                                $row_ref->email         = $reference['email'];
                                $row_ref->save();

                            } else {
                                Reference::create([
                                    'user_id'       => $user->id,
                                    'name'          => $reference['name'],
                                    'relationship'  => $reference['relation'],
                                    'phone'         => $phone,
                                    'email'         => $reference['email'],
                                ]);
                            }
                        }
                    } else {
                        if ($pdf_references) {
                            foreach ($pdf_references as $ref_key => $reference) {
                                $phone = $reference['phone'];
                                if ($phone) {
                                    $phone = str_replace(['+', '(', ')',' ', '-'], "", $phone);
                                    $phone = substr($phone, -10);
                                    $phone = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $phone);
                                }

                                Reference::create([
                                    'user_id'       => $user->id,
                                    'name'          => $reference['name'],
                                    'relationship'  => $reference['relation'],
                                    'phone'         => $phone,
                                    'email'         => $reference['email'],
                                ]);
                            }
                        } else {
                            Reference::create([
                                'user_id' => $user->id
                            ]);
                        }
                    }

                    $user->current_step = 8;
                    if($user->step_reached<8){
                        $user->step_reached=8;
                    }
                    $user->save();
                } else {
                    return response()->json(['messagePdfError' => 'No able to fetch data. Try again after some time.']);

                }
            }

            return response()->json(['messagePdf' => 'Auto-Fill Complete!']);

        } else {
            // Handle the case where no file was uploaded
            return response()->json(['messagePdfError' => 'Please upload a valid file.']);

        }
    }
}
