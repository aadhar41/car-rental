<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    /**
     * Role Based Authentication Redirect
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 1) {
            return redirect()->route('admin.dashboard')->with('success', 'LoggedIn as Admin.');
            // return redirect('/admin/dashboard');
        } else if ($user->role == 2) {
            // return redirect()->route('admin.dashboard')->with('success', 'LoggedIn as Admin.');
            return redirect()->route('admin.dashboard')->with('success', 'LoggedIn as User.');
            // return redirect('/user');
        } else {
            return redirect()->route('admin.dashboard')->with('success', 'LoggedIn as Other.');
            // return redirect('/admin');
        }
    }

    // redirect to a specific route after logout.
    protected function loggedOut(Request $request)
    {
        return redirect()->route('login')->with('success', 'LoggedIn as Admin.');
    }
}
