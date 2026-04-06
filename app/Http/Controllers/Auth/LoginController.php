<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin()
                ? redirect('/admin/dashboard')
                : redirect('/');
        }

        return view('auth.login');
    }

    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->input($this->username()),
            'password' => $request->input('password'),
            'type' => User::TYPE_ADMIN,
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('email', $request->input($this->username()))->first();

        $message = $user && $user->isUser()
            ? 'User account cannot login from the admin login page.'
            : trans('auth.failed');

        throw ValidationException::withMessages([
            $this->username() => [$message],
        ]);
    }
}
