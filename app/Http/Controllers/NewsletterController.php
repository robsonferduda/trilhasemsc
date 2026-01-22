<?php

namespace App\Http\Controllers;

use App\Trilheiro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterUnsubscribeNotification;

class NewsletterController extends Controller
{
    /**
     * Exibe a página de confirmação de descadastro
     * 
     * @param int $trilheiroId
     * @param string $token
     * @return \Illuminate\View\View
     */
    public function showUnsubscribe($trilheiroId, $token)
    {
        if (!Trilheiro::validateUnsubscribeToken($trilheiroId, $token)) {
            return view('newsletter.erro', [
                'mensagem' => 'Link inválido ou expirado. Entre em contato conosco se precisar de ajuda.'
            ]);
        }

        $trilheiro = Trilheiro::find($trilheiroId);

        if (!$trilheiro) {
            return view('newsletter.erro', [
                'mensagem' => 'Trilheiro não encontrado.'
            ]);
        }

        // Se já está descadastrado
        if (!$trilheiro->fl_newsletter_tri) {
            return view('newsletter.sucesso', [
                'mensagem' => 'Você já não está mais inscrito em nossa newsletter.',
                'trilheiro' => $trilheiro
            ]);
        }

        return view('newsletter.confirmar-descadastro', [
            'trilheiro' => $trilheiro,
            'token' => $token
        ]);
    }

    /**
     * Processa o descadastro da newsletter
     * 
     * @param Request $request
     * @param int $trilheiroId
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsubscribe(Request $request, $trilheiroId, $token)
    {
        if (!Trilheiro::validateUnsubscribeToken($trilheiroId, $token)) {
            return redirect()->route('newsletter.erro')->with('mensagem', 'Link inválido ou expirado.');
        }

        $trilheiro = Trilheiro::find($trilheiroId);

        if (!$trilheiro) {
            return redirect()->route('newsletter.erro')->with('mensagem', 'Trilheiro não encontrado.');
        }

        // Atualiza o flag para false
        $trilheiro->update(['fl_newsletter_tri' => false]);

        // Envia notificação para os administradores
        $this->notifyAdmins($trilheiro, $request->input('motivo'));

        return view('newsletter.sucesso', [
            'mensagem' => 'Cancelamento de notificações realizado com sucesso.',
            'trilheiro' => $trilheiro
        ]);
    }

    /**
     * Reinscreve na newsletter
     * 
     * @param int $trilheiroId
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resubscribe($trilheiroId, $token)
    {
        if (!Trilheiro::validateUnsubscribeToken($trilheiroId, $token)) {
            return redirect()->route('newsletter.erro')->with('mensagem', 'Link inválido ou expirado.');
        }

        $trilheiro = Trilheiro::find($trilheiroId);

        if (!$trilheiro) {
            return redirect()->route('newsletter.erro')->with('mensagem', 'Trilheiro não encontrado.');
        }

        // Atualiza o flag para true
        $trilheiro->update(['fl_newsletter_tri' => true]);

        return view('newsletter.sucesso', [
            'mensagem' => 'Você foi inscrito novamente em nossa newsletter!',
            'trilheiro' => $trilheiro
        ]);
    }

    /**
     * Envia notificação de descadastro para os administradores
     * 
     * @param Trilheiro $trilheiro
     * @param string|null $motivo
     * @return void
     */
    private function notifyAdmins(Trilheiro $trilheiro, $motivo = null)
    {
        try {
            // Pega o email do administrador do .env
            $adminEmails = config('mail.admin_notification_emails', env('MAIL_ADMIN_NOTIFICATION', 'robsonferduda@gmail.com'));
            
            // Se for uma string com múltiplos emails separados por vírgula
            $emails = is_array($adminEmails) ? $adminEmails : explode(',', $adminEmails);
            
            foreach ($emails as $email) {
                $email = trim($email);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    Mail::to($email)->send(new NewsletterUnsubscribeNotification($trilheiro, $motivo));
                }
            }
        } catch (\Exception $e) {
            // Log do erro mas não quebra o fluxo de descadastro
            \Log::error('Erro ao enviar notificação de descadastro: ' . $e->getMessage());
        }
    }
}
