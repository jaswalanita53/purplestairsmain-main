<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Auth;
class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (\Exception $e) { // Task #86a0cfevr
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                if(Auth::user()) { // task - 86a0cfevr update
                    return redirect('/home');
                }
                /*Auth::logout();
                return redirect()->back()
                ->withInput(request()->except('_token'))
                ->withError('Invalid token. Please submit the form again');*/
            };
        });
    }
}
