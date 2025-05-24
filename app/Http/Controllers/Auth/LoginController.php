<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        $user = \Auth::user();
        $roles = $user->roles->pluck('name');

        if ($roles->isEmpty()) {
            return '/home'; // Default jika user tidak punya role
        }

        switch ($roles[0]) {
            case 'Admin':
                return '/admin';
            case 'Super Admin':
                return '/superadmin';
            default:
                return '/home';
        }
    }
    protected function authenticated($request, $user)
    {
        if (! $user->hasVerifiedEmail()) {
            Auth::logout();
            return redirect('/login')->with('error', 'Silakan verifikasi email Anda terlebih dahulu.');
        }
    }

}
