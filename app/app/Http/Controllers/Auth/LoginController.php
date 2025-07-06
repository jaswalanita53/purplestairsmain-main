<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Check if the user exists but is soft deleted
        $user = User::withTrashed()->where($this->username(), $request->{$this->username()})->first();

        if ($user && $user->trashed()) {
            $errors = [$this->username() => trans('auth.soft_deleted')];
        }

        if ($request->expectsJson()) {
            throw ValidationException::withMessages($errors);
        }

        return redirect()->route('login')
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    public function set_usertype($flag) {
        if (\Session::has('user_type')) {
            \Session::forget('user_type');
        }
        if($flag == 'true')  { 
            \Session::put('user_type', 'employer'); 
        } else { 
            \Session::put('user_type', 'candidate'); 
        }
        echo "1";
    }

    // task - 86a32nrge
    public function verifyAccount(Request $request)
    {
        $user = User::with('delete_status')->where(['email' => $request->input('email')])->withTrashed()->first();
        if ($user) {
            if ($user->delete_status) {
                if ($user->delete_status->type == "sleep") {
                    echo '1'; die();
                }
            }
        }
        echo '0';die();
    }
}
