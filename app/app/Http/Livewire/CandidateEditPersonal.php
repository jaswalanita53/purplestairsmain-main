<?php

namespace App\Http\Livewire;

use App\Models\Personal;
use App\Models\User;
use App\Models\ZipCode;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Rules\ValidUSZipCode;


class CandidateEditPersonal extends Component
{
    use WithFileUploads;

    public $name,
        $name_status,
        $email,
        $email_status,
        $phone,
        $phone_status,
        $current_title,
        $current_title_status,
        $zip_code,
        $zip_code_status,
        $linkedin_url,
        $linkedin_url_status,
        $additional_url,
        $additional_url_status,
        $country,
        $country_name_status;

    public $profile;
    public $profile_path;
    public $short_bio,
           $short_bio_status;
    public $profile_status;
    public $tmp_file;
    public $update_pic_status = false;
    public $save = 0;
    public function mount()
    {

        $personal = Personal::where('user_id', Auth::user()->id)->first();
        if (isset($personal)) {

             $this->name = $personal->name;
            $this->name_status = $personal->name_status;
            $this->email = $personal->email;
            $this->email_status = $personal->email_status;
            $this->phone = $personal->phone;
            $this->phone_status = $personal->phone_status;
            $this->current_title = $personal->current_title;
            $this->current_title_status = $personal->current_title_status;
            $this->zip_code = $personal->zip_code;
            $this->zip_code_status = $personal->zip_code_status;
            $this->linkedin_url = $personal->linkedin_url;
            $this->linkedin_url_status = $personal->linkedin_url_status;
            $this->additional_url = $personal->additional_url;
            $this->additional_url_status = $personal->additional_url_status;
            $this->short_bio = $personal->short_bio;
            $this->short_bio_status = $personal->short_bio_status;
            $this->profile_status = $personal->profile_status;
            $this->country = $personal->country;
            $this->country_name_status = $personal->country_name_status;
        }
        $personal = User::where('id', Auth::user()->id)->first();
        $this->profile_path = $personal->profile_photo_path;
    }

    public function get_user_country()
    {
        // US 69.162.81.157
        // IN 122.176.57.163
        $ip = $_SERVER['REMOTE_ADDR'];

        // Construct the API URL
        $apiUrl = "http://ipinfo.io/" . $ip . "/json";

        // Make a request to ipinfo.io
        $response = file_get_contents($apiUrl);

        // Decode the JSON response
        $data = json_decode($response, true);


        return isset($data['country']) ? $data['country'] : 'Unknown';
    }
    protected function rules()
    {
        $user_country = $this->get_user_country();
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'current_title' => ['required', 'string', 'max:255'], // task - 86a2vwxam
        ];

        // Check if the user's country is the US
        if ($user_country === 'US') {
            // If yes, add the zip code rule
            $rules['zip_code'] = ['required', new ValidUSZipCode];
            $rules['phone'] = ['required', 'regex:/^(\+1\s\d{3}-\d{3}-\d{4}|\d{3}-\d{3}-\d{4})$/'];
        }else{
            $rules['phone'] = ['required'];
        }

        return $rules;
    }

    // task - 86a12tj3p
    public function updated($property)
    {
        if($this->save == 1) {
            $this->validateOnly($property);
        }
    }

    public function savePersonal()
    {
        $this->save = 1;
        $this->resetErrorBag(); // task - 86a12tj3p
        $this->resetValidation(); // task - 86a12tj3p

        $this->validate();

        $personal = Personal::where('user_id', Auth::user()->id)->first();
        if (isset($personal)) {
            $personal->name = $this->name;
            $personal->name_status = $this->name_status;
            $personal->email = $this->email;
            $personal->email_status = $this->email_status;
            $personal->phone = $this->phone;
            $personal->phone_status = $this->phone_status;
            $personal->current_title = $this->current_title;
            $personal->current_title_status = $this->current_title_status;
            $personal->zip_code = $this->zip_code;
            $personal->zip_code_status = $this->zip_code_status;
            $personal->linkedin_url = $this->linkedin_url;
            $personal->linkedin_url_status = $this->linkedin_url_status;
            $personal->additional_url = $this->additional_url;
            $personal->additional_url_status = $this->additional_url_status;
            $personal->country = $this->country;
            $personal->country_name_status = $this->country_name_status;
            $personal->save();

            $user = User::find(Auth::id());
            $user->name = $personal->name;
            $user->save();
            $user_country = $this->get_user_country();

            // task - 86a2ggc6v
            if (auth()->user()->id == 1572) {
                $user_country = 'US';
            }
            // task - 86a2ggc6v end

            if ($user_country === 'US') {
            $client = new Client(['base_uri' => 'https://api.zippopotam.us/']);

            try {
                $response = $client->request('GET', 'US/' . $this->zip_code);
                $data = json_decode($response->getBody(), true);
            } catch (\Throwable $th) {
                // Handle the exception
            }

            if (isset($data)) {
                $personal->country = $data['country'] ?? '';
                $personal->country_abbr = $data['country abbreviation'] ?? '';
                $personal->state = $data['places'][0]['state'] ?? '';
                $personal->state_abbr = $data['places'][0]['state abbreviation'] ?? '';
                $personal->address = $data['places'][0]['place name'] ?? '';
                if(!empty($data['country']) && $personal->country_abbr=='US'){
                    $zipCode = ZipCode::withTrashed()->where('zip_code', $this->zip_code)->first();
                    if (empty($zipCode)) {
                        $zipCode = new ZipCode();
                        $zipCode->state =$data['places'][0]['state'] ?? '';
                        $zipCode->zip_code = $this->zip_code;
                        $zipCode->save();
                    }
                }
            } else {
                $personal->country = '';
                $personal->country_abbr = '';
                $personal->state = '';
                $personal->state_abbr = '';
                $personal->address = '';
            }
            if($this->update_pic_status){
                @unlink(Auth::user()->profile_photo_path);
               $user = Auth::user();
               $user->profile_photo_path = null;
               $user->save();
           }
        }
            if ($this->profile) {

                $path = $this->profile->store('public/profile');
                $file_extension = pathinfo($path, PATHINFO_EXTENSION);
                $allowed_extensions = ['jpg', 'png', 'jpeg'];
                // dd($this->profile->getSize());
                // Check if the file extension is allowed
                if (in_array($file_extension, $allowed_extensions)) {
                    // Check if the file size is less than or equal to 1 MB (1048576 bytes)

                    if ($this->profile->getSize() <= 1048576) {
                        $file_path = str_replace('public/', 'storage/app/public/', $path);
                        Auth::user()->profile_photo_path = $file_path;
                        $this->profile_path = $file_path;
                        Auth::user()->save();
                        // $this->dispatchBrowserEvent('temp-update-avatar', ['newPath' => $this->profile_path]);

                        if (isset($personal)) {
                            $personal->short_bio = $this->short_bio;
                            $personal->short_bio_status = $this->short_bio_status;
                            $personal->profile_status = $this->profile_status;
                            $personal->save();
                        } else {
                            Personal::create([
                                'short_bio' => $this->short_bio,
                                'short_bio_status' => $this->short_bio_status,
                                'profile_status' => $this->profile_status,
                                'user_id' => Auth::user()->id
                            ]);
                        }

                        request()->session()->flash('message', 'Profile updated!');
                    } else {
                        request()->session()->flash('message', 'Profile updated!');
                        // File size exceeds 1 MB
                        // $this->profile = null;
                        // request()->session()->flash('profile-error', 'File must be less than or equal to 1 MB in size');
                    }
                } else {
                    request()->session()->flash('message', 'Profile updated!');
                    // File extension is not allowed
                    // $this->profile = null;
                    // request()->session()->flash('profile-error', 'File must be an image with one of the allowed extensions: jpg, png, jpeg');
                }

                $this->dispatchBrowserEvent('load-switches');
            } else {
                if (isset($personal)) {
                    $personal->short_bio = $this->short_bio;
                    $personal->short_bio_status = $this->short_bio_status;
                    $personal->profile_status = $this->profile_status;
                    $personal->save();
                } else {
                    Personal::create([
                        'short_bio' => $this->short_bio,
                        'short_bio_status' => $this->short_bio_status,
                        'profile_status' => $this->profile_status,
                        'user_id' => Auth::user()->id
                    ]);
                }
                request()->session()->flash('message', 'Profile updated!');
                $this->dispatchBrowserEvent('load-switches');
            }
            $this->save = 0;
            return redirect(route("candidates.editpersonal"));
        }
    }

    protected function messages()
    {
        return [
            'profile.mimes' => 'The profile image must be one of these file types: .jpg .bmp .png .gif',
            'profile.size' => 'The profile image may not be larger than 1MB',
            'profile.max' => 'The profile image may not be larger than 1MB',
        ];
    }

    public function removeAvatar()
    {
        if (Auth::user()->profile_photo_path) {
            //@unlink(Auth::user()->profile_photo_path);
            $user = Auth::user();
            $user->profile_photo_path = null;
            $this->update_pic_status = true;
            //$user->save();

            $user = User::find(Auth::id());
            $user->profile_photo_path = null;
            //$user->save();
        }
        // $this->dispatchBrowserEvent('load-switches');
        // $this->dispatchBrowserEvent('update-avatar');
    }

    public function render()
    {
        $countries=\DB::table('countries')->get();
        $countries = json_decode($countries, true);
        // Extract country names from the response
        $countryNames = array_column($countries, 'name','iso');

        // Output the list of country names
        $user_country = $this->get_user_country();
        // task - 86a2ggc6v
        if (auth()->user()->id == 1572) {
            $user_country = 'US';
        }
        // task - 86a2ggc6v end
        
        return view('livewire.candidate-edit-personal', compact('user_country','countryNames'));
    }
    public function validateProfile() {
        $errors = (new CandidateEditResume)->getValidated();

        if(!empty($errors['end_year_error']) || !empty($errors['employment_end_year_error'])) {
            return redirect('/candidate/edit/resume?navigate=error');
        } else {
            return redirect(route("candidateProfile"));
        }
    }
}
