<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function deleteAccount(){
        return view('pages.deleteaccount');
    }
    public function sleepAccount(){
        return view('pages.sleepaccount');
    }
    public function resetPassword(){
        return view('pages.resetpassword');
    }
}
