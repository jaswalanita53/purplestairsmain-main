<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        Session::forget('ref');
        Session::forget('inv');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->isCandidate() && Auth::user()->isPublished()){
           return redirect()->route('candidates.requests');
        }
        if(Auth::user()->isEmployer() && Auth::user()->isPublished()){
            return redirect()->route('company.dashboard');
         }
        return view('home');
    }

    public function toggle_sidebar(Request $request)
    {

        // is open means currently open than collapse
        \Session::remove('sidebar');
        if(!empty($request->input('open'))){
        \Session::put('sidebar',$request->input('open'));
        echo Session::get('sidebar');
    }else{
        \Session::put('sidebar','');
        echo Session::get('sidebar');
    }
    }
}
