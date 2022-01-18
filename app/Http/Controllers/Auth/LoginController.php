<?php

namespace App\Http\Controllers\Auth;

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

    public function username()
    {
        $login = request()->input('identity');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : (filter_var($login, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[0-9]{18}|[0-9]{8}.[0-9]{6}.[1|2]{1}.[0-9]{3}|[0-9]{8} [0-9]{6} [1|2]{1} [0-9]{3}/'))) ? 'nip' : 'username');

        if ($field == 'nip') {
            $login = str_replace(array('.', ' '), '', $login);
        }

        request()->merge([$field => $login]);

        return $field;
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'identity'  => 'required|string',
            'password'  => 'required|string',
            'email'     => 'string|exists:admins',
            'username'  => 'string|exists:admins',
            'nip'       => 'string|exists:admins'
        ]);
    }
}
