<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    public function login(Request $request) {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user is blocked
        $user = User::where('email', $request->email)->first();

        if ($user && $user->is_blocked) {
            throw ValidationException::withMessages([
                'blocked' => 'Your account has been blocked.',
            ]);
        }

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to the desired location
            return redirect()->intended('/home');
        }

        // Authentication failed, redirect back with error
        throw ValidationException::withMessages([
            'login' => 'Invalid login credentials.',
        ]);
    }  
    
}
