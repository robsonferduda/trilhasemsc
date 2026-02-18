<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Trilheiro;
use App\Mail\NovoTrilheiroNotificacao;
use App\Mail\BoasVindasTrilheiro;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'id_role' => 'TRILHEIRO',
            'password' => Hash::make($data['password']),
        ]);

        // Cria o trilheiro associado ao usuário
        $trilheiro = Trilheiro::create([
            'id_user' => $user->id,
            'nm_trilheiro_tri' => $user->name,
        ]);

        // Carrega o relacionamento user para uso no email
        $trilheiro->load('user');

        // Envia email de boas-vindas para o trilheiro
        try {
            Mail::to($user->email)->send(new BoasVindasTrilheiro($trilheiro));
            
            \Log::info('Email de boas-vindas enviado com sucesso', [
                'trilheiro_id' => $trilheiro->id_trilheiro_tri,
                'user_email' => $user->email,
                'timestamp' => now()
            ]);
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar email de boas-vindas', [
                'error' => $e->getMessage(),
                'trilheiro_id' => $trilheiro->id_trilheiro_tri,
                'user_email' => $user->email,
            ]);
        }

        // Envia email de notificação para o administrador
        try {
            Mail::send(new NovoTrilheiroNotificacao($user, $trilheiro));
            
            // Log de sucesso
            \Log::info('Email de novo trilheiro enviado com sucesso', [
                'trilheiro_id' => $trilheiro->id,
                'user_id' => $user->id,
                'user_email' => $user->email,
                'user_name' => $user->name,
                'timestamp' => now()
            ]);
        } catch (\Exception $e) {
            // Log do erro mas não interrompe o cadastro
            \Log::error('Erro ao enviar email de notificação de novo trilheiro', [
                'error' => $e->getMessage(),
                'trilheiro_id' => $trilheiro->id ?? null,
                'user_id' => $user->id,
                'user_email' => $user->email,
                'timestamp' => now(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Opcional: notificar admin por outro meio
            // ou adicionar na fila de emails para reenvio
        }

        return $user;
    }
}
