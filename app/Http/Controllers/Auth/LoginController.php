<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



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

    public function redirectPath()
    {
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            $this->redirectTo = route('dashboard.admin');
            return $this->redirectTo;
        } elseif($user->hasRole('SuperAdmin')) {
            $this->redirectTo = route('dashboard');
            return $this->redirectTo;
        } else {
            // student login
            return route('student.user.index');
        }

     
    }


    //logout that redirects to login after user clicks on  stuff  
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}
