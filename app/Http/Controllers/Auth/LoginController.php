<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Model\UserType;
use Auth;
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
    protected $redirectTo = '/';

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
        return 'username';
    }

    public function authenticate(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Ingrese un nombre de usuario',
                'password.required' => 'Ingrese una contraseña'
            ]
        );

        $remember = false;
        $loginParams = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];

        if (!Auth::attempt($loginParams, $remember)) {
            redirect()->route('login')
                ->withErrors((['username' => 'Usuario o contraseña incorrectos.']))
                ->withInput($request->all());
        }
        $user = Auth::user();
        if ($user->userType->id === UserType::ALUMNO) {
            if ($user->documents()->count() === 0) {
                return redirect()->route('student_revision');
            }
            return redirect()->route('process_student');
        }
        if ($user->userType->id === UserType::ADMIN) {
            return redirect()->route('admin_index');
        }

        if ($user->userType->id === UserType::PROFESOR) {
            return redirect()->route('teachers_index');
        }

        return dd(Auth::user()->userType);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('login');
    }
}
