<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\UserLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
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

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $data = \Location::get($request->ip()); 
            $cidade = ($data) ? $data->cityName : "---";
            $uf = ($data) ? $data->areaCode : "---";

            UserLog::create([
                'id_user_usu' => Auth::user()->id,
                'nu_ip_log' => $request->ip(),
                'ds_cidade_log' => $cidade,
                'ds_uf_log' => $uf
            ]);

            switch (trim(Auth::user()->id_role)) {

                case 'ADMIN':
                    return redirect()->intended('admin/dashboard');
                    break;
                case 'GUIA':
                    return redirect('guia-e-condutores/privado/atualizar-cadastro');
                    break;
                case 'TRILHEIRO':
                    return redirect('trilheiro/privado/perfil');
                    break;
                case 'SOCIAL':
                    return redirect('cadastro/privado/escolher-perfil');
                    break;
                default:
                    return redirect()->intended('/');
                    break;
            }
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
}
