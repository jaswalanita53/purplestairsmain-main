<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\Personal;
use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route; //Task #86a0fxkj1

class Onboarding
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // middleware to check the user completed the steps

        //if the user is a candidate
        if (Auth::check() && Auth::user()->isCandidate()) {
            // task - 86a1hvak1
            Auth::user()->last_login = date('Y-m-d H:i:s');
            Auth::user()->save();

            // if personal info does not exist
            if (Auth::user()->status == 1) {
                return $next($request);
            } else {
                // task - 86a0fxkj1
                if(Route::is('candidateProfile')) { //Task #86a0gegw8
                    return $next($request);
                }
                // task - 86a0fxkj1 end

                if (Auth::user()->current_step == 0) {
                    $personal = Personal::where('user_id', Auth::user()->id)->first();
                    if (!isset($personal)) {
                        Personal::create([
                            'name' => Auth::user()->name,
                            'email' => Auth::user()->email,
                            'user_id' => Auth::user()->id
                        ]);
                    }
                    return redirect('candidate/personal-information');
                }
                if (Auth::user()->current_step == 1) { // Task #86a0hfczk
                    return redirect('candidate/personal-information');
                }
                if (Auth::user()->current_step == 2) {
                    return redirect('candidate/position-preferences');
                }
                if (Auth::user()->current_step == 3) {
                    return redirect('candidate/education-employment');
                }
                if (Auth::user()->current_step == 4) {
                    return redirect('candidate/education');
                }
                if (Auth::user()->current_step == 5) {
                    return redirect('candidate/employment');
                }
                if (Auth::user()->current_step == 6) {
                    return redirect('candidate/skills');
                }
                if (Auth::user()->current_step == 7) {
                    return redirect('candidate/references');
                }
                if (Auth::user()->current_step == 8) {
                    return redirect('candidate/about');
                }
                if (Auth::user()->current_step == 9) {
                    return redirect('candidate/approval');
                }
            }
        }
        //if the user is a employer
        if (Auth::check() && Auth::user()->isEmployer()) {
            // task - 86a1hvak1
            Auth::user()->last_login = date('Y-m-d H:i:s');
            Auth::user()->save();

            // if personal info does not exist
            if (Auth::user()->status == 1) {
                return $next($request);
            } elseif (Auth::user()->status == 2) { // task - 862k2tb3v
                Auth::logout();
                return redirect('login')->withErrors(['msg' => 'Your account has been disabled. Please contact info@purplestairs.com to reactivate.']); // task - 86a1z6xu7
            }elseif(Auth::user()->status == 3){
                // 86a2qw2e1
                    Auth::logout();
                    return redirect('/employer/login')->withErrors(['success' => 'You have successfully signed up for Purple Stairs. Your account will be verified and approved by email shortly.']);

            } else {
                // task - 8678ffnbw
                if (Auth::user()->reference == 0) {
                    $subscription = Subscription::where('user_id', Auth::user()->id)->where('status', 1)->first();
                    if ($subscription) {
                        Auth::logout();
                        return redirect('/employer/login')->withErrors(['success' => 'You have successfully signed up for Purple Stairs. Your account will be verified and approved by email shortly.']);
                    }
                }
                // task - 8678ffnbw end

                if (Auth::user()->current_step == 0) {
                    $company = Company::where('user_id', Auth::user()->id)->first();
                    if (!isset($company)) {
                        Company::create([
                            // 'company_name' => Auth::user()->name,
                            'company_email' => Auth::user()->email,
                            'user_id' => Auth::user()->id
                        ]);
                    }
                    return redirect('company/contact-info');
                }
                if (Auth::user()->current_step == 1) {
                    return redirect('company/contact-info');
                }
                if (Auth::user()->current_step == 2) {
                    return redirect('company/company-info');
                }
                if (Auth::user()->current_step == 3) {
                    return redirect('company/choose-plan');
                }
                if (Auth::user()->current_step == 4) {
                    return redirect('company/payment');
                }
            }
        }
        return $next($request);
    }
}
