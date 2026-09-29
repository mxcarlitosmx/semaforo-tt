<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Importante para recibir los datos de la sesión

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
     * (Esta variable será ignorada porque el método authenticated toma el control)
     *
     * @var string
     */
    protected $redirectTo = '/home';

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

    /**
     * El usuario ha sido autenticado.
     * Aquí definimos el enrutamiento inteligente basado en roles.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Si el usuario es administrador, lo mandamos a su panel
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Si es cualquier otro rol (operador), lo mandamos al panel de usuario
        return redirect()->route('user.dashboard');
    }

    protected function loggedOut(Request $request)
    {
        return redirect()->route('login');
    }
}