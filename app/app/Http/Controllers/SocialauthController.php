<?php

namespace App\Http\Controllers;
use Socialite;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Invited_user;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class SocialauthController extends Controller
{
  public function redirect($provider)
  {
   return Socialite::driver($provider)->redirect();
  }
  public function Callback($provider)
  {
    $userSocial =   Socialite::driver($provider)->stateless()->user();
    // $userSocial =   Socialite::driver($provider)->user();

    // task - 86a1hgtbh
    $u_type = "";
    if(Session::has('user_type')){
      $u_type = Session::get('user_type');
    }

    if ($u_type == 'employer') {
      if ($userSocial->getEmail() != 'nilesh.epixel@gmail.com') {
        $exclude_domains = array('gmail.com','yahoo.com','hotmail.com','aol.com');
        if (!filter_var($userSocial->getEmail(), FILTER_VALIDATE_EMAIL)) {
          return redirect('employer/login')->withErrors(['msg' => 'Invalid email address.']);
        } else {
          $exp_umail = explode('@', $userSocial->getEmail());
          if (in_array($exp_umail[1], $exclude_domains)) {
            return redirect('employer/login')->withErrors(['msg' => '<strong>Purple Stairs requires a valid business address.</strong> Accounts cannot be activated with a personal email address to ensure the integrity of our employers and the privacy of our candidates.']);
          }
        }
      }
    }

    $users       =   User::with('delete_status')->where(['email' => $userSocial->getEmail()])->withTrashed()->first();

    $invited_id = Session::has('inv') ? Session::get('inv') : 0;

    $redirect_to = Session::has('redirect') ? Session::get('redirect') : null;

    if($users)
    {

        // 86a2yxtf1
        if(!empty($users->user_type)){
            if($users->user_type=='admin'){
                if(!empty(Session::get('user_type'))){
                    if(Session::get('user_type')=='employer'){
                        return redirect('employer/login')->withErrors(['msg' => 'You are trying to log in with the admin account.']);
                    }
            }
                return redirect('/login')->withErrors(['msg' => 'You are trying to log in with the admin account.']);
            }
        }
        Session::put('usertype', $users->user_type);
        if($users->delete_status){
            if($users->delete_status->type == 'delete'){
              if(!empty(Session::get('user_type'))){
                  if(Session::has('user_type')){
                      Session::forget('user_type');
                  }
                  return redirect('employer/login')->withErrors(['msg' => 'Your account has been deleted']);
              }
              return redirect('/login')->withErrors(['msg' => 'Your account has been deleted']);
            }
            else{
              if(!empty(Session::get('user_type'))){
                  if(Session::has('user_type')){
                      Session::forget('user_type');
                  }
                  return redirect('employer/login')->withErrors(['msg' => 'Your account has been set to sleep mode. Please email info@purplestairs.com to begin using your account again.']);
              }
              return redirect('/login')->withErrors(['msg' => 'Your account has been set to sleep mode. Please email info@purplestairs.com to begin using your account again.']);
            }
        } elseif ($users->deleted_at) {
          if(!empty(Session::get('user_type'))){
              if(Session::has('user_type')){
                  Session::forget('user_type');
              }
              return redirect('employer/login')->withErrors(['msg' => 'Your account has been deleted']);
          }
          return redirect('/login')->withErrors(['msg' => 'Your account has been deleted']);
        } elseif ($users->reference > 0 && $users->status == 1) {
          $ref = Session::has('ref') ? Session::get('ref') : 0;

          if($users->reference > 0) {
            if($ref > 0 && $ref != $users->reference) {
              return redirect('/login')->withErrors(['msg' => 'You are already connected with other company.']);
            }

            // task - 862k2tb3v
            $ref_company_status = User::where('id', $users->reference)->pluck('status')->first();
            if($ref_company_status == 2) {
              return redirect('/login')->withErrors(['msg' => 'Your company account is disabled. Please contact to your company admin.']);
            }
            // task - 862k2tb3v end
          }


          $subscription = Subscription::where('user_id', $users->reference)->where('status', 1)->first();
          $now = date('Y-m-d');
          if (!empty($subscription->expiration_date) && date('Y', strtotime($subscription->expiration_date)) > 1970) {
              $expiry_date = date('Y-m-d', strtotime($subscription->expiration_date));
              if ($now >= $expiry_date) {
                  return redirect('/login')->withErrors(['msg' => 'Your company subscription is expired. Please contact to your company.']);
              } else {
                  create_employer_contact($users, true); // task - 86a3d37f9
                  
                  Auth::login($users,true);
                  if($invited_id) { // task - 86a0unjwz
                    $invitation = Invited_user::find($invited_id);
                    $invitation->invited_user_id = $users->id;
                    $invitation->save();
                  }
                  if($redirect_to) {
                    return redirect($redirect_to);
                  } else {
                    return redirect()->route('home');
                  }
              }
          } elseif (empty($subscription)) {
              return redirect('/login')->withErrors(['msg' => 'Your company subscription is expired. Please contact to your company.']);
          } elseif ($ref && $subscription) {
            $joined_users = User::where('reference', $ref)->where('status', 1)->get()->toArray();
            $joined_cnt = count($joined_users);
            $joined_users_ids = array_column($joined_users, 'id');

            if($joined_cnt >= $subscription->number_of_users && !in_array($users->id, $joined_users_ids)) {
              return redirect('/login')->withErrors(['msg' => 'You can\'t join. Contact your company admin.']);
            } else {
                create_employer_contact($users, true); // task - 86a3d37f9

                Auth::login($users,true);
                if($invited_id) { // task - 86a0unjwz
                  $invitation = Invited_user::find($invited_id);
                  $invitation->invited_user_id = $users->id;
                  $invitation->save();
                }
                if($redirect_to) {
                  return redirect($redirect_to);
                } else {
                  return redirect()->route('home');
                }
            }
          } else {
              create_employer_contact($users, true); // task - 86a3d37f9

              Auth::login($users,true);
              if($invited_id) { // task - 86a0unjwz
                $invitation = Invited_user::find($invited_id);
                $invitation->invited_user_id = $users->id;
                $invitation->save();
              }
              if($redirect_to) {
                return redirect($redirect_to);
              } else {
                return redirect()->route('home');
              }
          }

        } elseif($users->reference > 0 && ($users->status == 0 || $users->status == 2)) {
          return redirect('/login')->withErrors(['msg' => 'Your account has been disabled. Please contact info@purplestairs.com to reactivate.']);
        }
        else{
            create_employer_contact($users, true); // task - 86a3d37f9

            Auth::login($users,true);
            $user_ref = Session::has('ref') ? Session::get('ref') : 0;
            $users->reference = $user_ref;
            $users->save();

            if($invited_id) { // task - 86a0unjwz
              $invitation = Invited_user::find($invited_id);
              $invitation->invited_user_id = $users->id;
              $invitation->save();
            }

            /*$invitation = Invited_user::find($invited_id);
            $invitation->invited_user_id = $users->id;
            $invitation->save();*/

            // return redirect()->route('home');
            if($redirect_to) {
              return redirect($redirect_to);
            } else {
              return redirect()->route('home');
            }
        }
    }
    else
    {
      $ref = Session::has('ref') ? Session::get('ref') : 0;
      if ($ref) {
        $joined_cnt = User::where('reference', $ref)->where('status', 1)->count();

        $subscription = Subscription::where('user_id', $ref)->where('status', 1)->first();
        $now = date('Y-m-d');
        if (!empty($subscription->expiration_date) && date('Y', strtotime($subscription->expiration_date)) > 1970) {
            $expiry_date = date('Y-m-d', strtotime($subscription->expiration_date));
            if ($now >= $expiry_date) {
                return redirect('/login')->withErrors(['msg' => 'Your company subscription is expired. Please contact to your company.']);
            }
        } elseif (empty($subscription)) {
            return redirect('/login')->withErrors(['msg' => 'Your company subscription is expired. Please contact to your company.']);
        }

        if ($subscription) {
          if($joined_cnt >= $subscription->number_of_users) {
            return redirect('/login')->withErrors(['msg' => 'You can\'t join. Contact your company admin.']);
          }
        }
      }

      // dd($ref);

        $ref = Session::has('ref') ? Session::get('ref') : 0;
        $shuffle_string = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $verify_token = substr(str_shuffle($shuffle_string),1,16);

        // task - 862k2tb3v
        if ($ref > 0 && $users) {
          $ref_company_status = User::where('id', $users->reference)->pluck('status')->first();
          if($ref_company_status == 2) {
            return redirect('/login')->withErrors(['msg' => 'Your company account is disabled. Please contact to your company admin.']);
          }
        }
        // task - 862k2tb3v end

        $user = User::create([
            'name' => $userSocial->getName(),
            'email' => $userSocial->getEmail(),
            'profile_photo_path' => $userSocial->getAvatar(),
            'provider_id' => $userSocial->getId(),
            'provider' => $provider,
            //bypasss email verification for social logins
            'email_verified_at' => Carbon::now(),
          //   'email_verified_at' => ($ref == 0 && Session::get('user_type')=="employer") ? null : Carbon::now(),
            'user_type' => Session::get('user_type') ? Session::get('user_type') : 'candidate',
            'reference' => $ref,
            'status' => Session::has('ref') ? 1 : 0,
            'verify_token' => $verify_token,
        ]);

        if($invited_id) {
          $invitation = Invited_user::find($invited_id);
          $invitation->invited_user_id = $user->id;
          $invitation->save();
        }

      //   if ($ref == 0 && Session::get('user_type') == 'employer') {
      //     $data = array('name' => $userSocial->getName(), 'token' => $verify_token);
      //     \Mail::send(['html'=>'mail.verify_email'], $data, function($message) use ($userSocial) {
      //          $message->to($userSocial->getEmail(), 'Purple Stairs')->subject
      //             ('Purple Stairs Verify Email');
      //          $message->from('info@purplestairs.com','Purple Stairs');
      //     });
      //   }

        if(Session::has('user_type')){
            Session::forget('user_type');
        }
        if(Session::has('ref')){
            Session::forget('ref');
        }
        if(Session::has('inv')){
            Session::forget('inv');
        }

        create_employer_contact($user, true); // task - 86a3d37f9

        if($ref > 0 || Session::get('user_type') != 'employer') {
          auth()->login($user);
          return redirect()->route('home');
        } else {
          // return redirect('/login')->withErrors(['success' => 'Verify your email to continue.']);
          return redirect('/email/verify')->withErrors(['success' => 'Verify your email to continue.']);
        }
    }
  }
}
