<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\Personal;
use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route; //Task #86a0fxkj1

class Adminauth
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
        if($request->session()->has('auth')) {
            // dd($request->session()->get('auth'));
            if($request->session()->get('auth') == 'admin') {
                return $next($request);
            } else {
                return redirect(route('purplestairs.login'))->withErrors(['msg' => 'Invalid credentials.']);
            }
        } else {
            return redirect(route('purplestairs.login'));
        }
        
    }
}
