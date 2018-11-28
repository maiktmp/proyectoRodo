<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Model\Alumno;
use App\Http\Model\Proceso;
use App\Http\Model\Profesor;
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
        return 'usuario';
    }

    public function guard()
    {
        return Auth::guard('profesor');
    }

    public function authenticate(Request $request)
    {
//        $profe = Profesor::find(1);
//        $profe->password = bcrypt('1428');
//        $profe->save();
//
//        $alu = Alumno::find(1);
//        $alu->password = bcrypt('1428');
//        $alu->save();


        $this->validate(
            $request,
            [
                'usuario' => 'required',
                'password' => 'required'
            ],
            [
                'usuario.required' => 'Ingrese un nombre de usuario',
                'password.required' => 'Ingrese una contraseña'
            ]
        );

        $remember = false;
        $loginParams = [
            'usuario' => $request->input('usuario'),
            'password' => $request->input('password')
        ];
//        return dd($loginParams);
        $teachLog = false;
        $studentLog = false;

        $teachLog = Auth::guard('profesor')->attempt($loginParams);
        $studentLog = Auth::guard('alumno')->attempt($loginParams);

        if ($studentLog) {
            return redirect()->route('student_revision');
        }
        if ($teachLog) {
            $profesor = Auth::guard('profesor')->user();
            if ($profesor->id === 1) {
                return redirect()->route('admin_index');
            }
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('login');
    }
}
