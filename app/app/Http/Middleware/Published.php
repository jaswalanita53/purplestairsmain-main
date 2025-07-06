<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Published
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
            if (Auth::user()->status == 1) {
                return redirect('candidate/requests');
            }
            else{
                return $next($request);
            }
        }

        if (Auth::check() && Auth::user()->isEmployer()) {
            if (Auth::user()->status == 1) {
                return redirect('company/dashboard');
            } elseif (Auth::user()->status == 0 && Auth::user()->reference > 0) {
                Auth::logout();
                return redirect('login')->withErrors(['msg' => 'Your account has been disabled. Please contact info@purplestairs.com to reactivate.']);
            }
            else{
                return $next($request);
            }
        }

        return $next($request);
    }
}
