<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\UserLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Stevebauman\Location\Facades\Location;
use App\Models\User;

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

    /**
     * Redireciona para o provedor (Google, Facebook, etc.)
     * Aqui também podemos armazenar a URL pretendida.
     */
    public function redirectToProvider(Request $request, string $provider)
    {
        // Guarda a URL pretendida, se enviada por query (?intended=/algum/lugar) ou usa a anterior
        if ($request->filled('intended')) {
            session(['url.intended' => $request->query('intended')]);
        } elseif (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Callback do provedor: valida dados, autentica e registra log de localização/IP.
     */
    public function handleProviderCallback(Request $request, string $provider)
    {
        try {
            // Em alguns ambientes (proxy / API-only) pode precisar ->stateless()
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')->withErrors([
                'social' => 'Falha ao autenticar com ' . ucfirst($provider) . '. Tente novamente.',
            ]);
        }

        // Garante email (alguns provedores podem não retornar)
        $email = $socialUser->getEmail();
        if (empty($email)) {
            // Estratégia simples: bloqueia e pede um login alternativo
            return redirect()->route('login')->withErrors([
                'email' => 'Não recebemos seu email do ' . ucfirst($provider) . '. Verifique as permissões do perfil.',
            ]);
            // Alternativa: gerar e-mail temporário único:
            // $email = 'temp+'.Str::uuid().'@example.local';
        }

        // Busca ou cria usuário local
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name'     => $socialUser->getName() ?: ($socialUser->getNickname() ?: 'Usuário'),
                'password' => bcrypt(Str::random(24)),
            ]
        );

        // Autentica (com "remember" opcional)
        Auth::login($user, true);

        // ===== Registro do LOG de localização/IP (sem travar o login) =====
        try {
            $ip = $request->ip();

            // Evita tentar geolocalizar IPs privados/locais
            $isPrivate = filter_var(
                $ip,
                FILTER_VALIDATE_IP,
                FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
            ) === false;

            $loc = $isPrivate ? null : Location::get($ip);

            $cidade = $loc->cityName  ?? '---';
            // Para “UF” use o código da região quando disponível (SP, RJ, SC…)
            $uf     = $loc->regionCode ?? ($loc->regionName ?? '---');

            UserLog::create([
                'id_user_usu'   => $user->id,
                'nu_ip_log'     => $ip,
                'ds_cidade_log' => $cidade,
                'ds_uf_log'     => $uf,
                // opcionalmente: 'provider' => $provider,
            ]);
        } catch (\Throwable $e) {
            // Silencia erros de geolocalização para não afetar a experiência de login
            // Se quiser, logue internamente: \Log::warning('Geo falhou: '.$e->getMessage());
        }
        // ===== /log =====

        // Redireciona ao destino original ou fallback
        return redirect()->intended('/dashboard');
    }

}