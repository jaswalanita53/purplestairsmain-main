<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\ZipCode;

use Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{

    public function purplestairsLogin()
    {
        if(Session::has('auth')){
            if(Session::get('auth') == 'admin') {
                return redirect(route('admin.dashboard'));
            }
        }
        return view('backend.login');
    }

    public function adminDashboard()
    {
        return view('backend.dashboard');
    }

    public function adminLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $verifyPassword = md5($password);
        // dd($verifyPassword);
        $adminUser = User::where('user_type', "admin")->where('email', $email)->first();
         // 86a2n0ckh
        if(!empty($adminUser)){
            if (/*$adminUser->id == "1" || */ $adminUser->email == $email && $adminUser->password == $verifyPassword) {
                /* task - 86a2ae1fp
                $request->session()->put('auth', $adminUser->user_type);
                // dd('here - 1');
                return redirect(route('admin.dashboard'));*/
                $digits = 6;
                $_2fa_code = rand(pow(10, $digits-1), pow(10, $digits)-1);

                $adminUser->tfa_token = $_2fa_code;
                $adminUser->tfa_created_at = date('Y-m-d H:i:s');
                $adminUser->save();

                $name = explode(' ', trim($adminUser->name));
                $data = array('name' => $name[0], 'code' => $_2fa_code);
                $to_mail = $adminUser->email;

                \Mail::send(['html'=>'mail.2fa_email'], $data, function($message) use ($to_mail) {
                    $message->to($to_mail, 'Purple Stairs')->subject
                        ('Two Factore Varification Code');
                    $message->cc(['eptdeveloper@gmail.com', 'sabrina@thepenguin.group']);
                    $message->from('info@purplestairs.com','Purple Stairs');
                });

                $request->session()->put('admin_user', $adminUser);
                return redirect('/admin/2fa');
            } else {
                if($request->session()->has('auth')){
                    $request->session()->forget('auth');
                }
                // dd('here - 2');
                return redirect(route('purplestairs.login'))->withErrors(['msg' => 'Invalid credentials.']);
            }
        }else{
            // 86a2n0ckh
            if($request->session()->has('auth')){
                $request->session()->forget('auth');
            }
            return redirect(route('purplestairs.login'));
        }
    }

    // task - 86a2ae1fp
    public function two_factor()
    {
        return view('backend.2fauth');
    }

    public function admin_two_factor(Request $request)
    {
        if($request->session()->has('admin_user')) {
            $input = $request->all();
            $adminUser = User::where('tfa_token', $input['tfa_code'])->first();
            if ($adminUser) {
                $code_time = $adminUser->tfa_created_at;
                $current_time = date('Y-m-d H:i:s');
                $diff_min = round(abs(strtotime($current_time) - strtotime($code_time)) / 60,2);

                if ($diff_min > 10) {
                    return redirect(route('purplestairs.login'))->withErrors(['msg' => 'Two factore authentication code expired.']);
                } else {
                    $session_admin = $request->session()->get('admin_user');
                    if($session_admin->email == $adminUser->email) {
                        $request->session()->put('auth', $adminUser->user_type);

                        $adminUser->tfa_token = null;
                        $adminUser->tfa_created_at = null;
                        $adminUser->save();
                        return redirect(route('admin.dashboard'));
                    } else {
                        return redirect(route('purplestairs.login'))->withErrors(['msg' => 'Invalid credentials.']);
                    }
                }
            } else {
                return redirect(url('/admin/2fa'))->withErrors(['msg' => 'Invalid authentication code.']);
            }
        } else {
            return redirect(route('purplestairs.login'))->withErrors(['msg' => 'Invalid credentials.']);
        }
    }
    // task - 86a2ae1fp end

    public function adminLogout()
    {
        if(Session::has('auth')){
            Session::forget('auth');
        }
        // return view('backend.login');
        return redirect(route('purplestairs.login'));
    }

    public function downloadCurrent()
    {
        // Get the list of backup files in the storage/app/Purple Stairs directory
        $backupFiles = Storage::files('Purple Stairs');

        // Sort the files by name in descending order
        rsort($backupFiles);

        // Check if there are any backup files
        if (count($backupFiles) > 0) {

            // Get the latest backup file
            $latestBackupFile = $backupFiles[0];

            // Get the file name from the path
            $fileName = pathinfo($latestBackupFile, PATHINFO_BASENAME);

            // Provide the file for download
            $absolutePath = storage_path('app/'.$latestBackupFile);

            // Check if the file exists before attempting to create BinaryFileResponse
            if (File::exists($absolutePath)) {
                return response()->download($absolutePath, $fileName);
            } else {
                // File does not exist
                abort(404,'The file does not exist');
            }
        }

        // No backup files found
        abort(404,'No backup files found');
    }

    public function viewZipCodes()
    {
        $zipcodes=ZipCode::get();
        return view('backend.viewZipCodes',compact('zipcodes'));
    }
    public function deleteZipCodes(Request $request)
    {
        $zipCode = ZipCode::find($request['delId']);
        if ($zipCode) {
            $zipCode->delete();
            // Optionally, you can also check if the deletion was successful
            // and return a response based on that.
            return response()->json(['message' => 'ZIP code soft deleted.']);
        } else {
            return response()->json(['message' => 'ZIP code not found.'], 404);
        }

    }

}
