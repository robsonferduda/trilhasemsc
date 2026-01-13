<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ServerErrorNotification extends Notification
{
    use Queueable;

    protected $exception;
    protected $request;

    /**
     * Create a new notification instance.
     *
     * @param \Exception $exception
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct($exception, $request)
    {
        $this->exception = $exception;
        $this->request = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = $this->request->fullUrl();
        $method = $this->request->method();
        $ip = $this->request->ip();
        $userAgent = $this->request->userAgent();
        
        $exceptionClass = get_class($this->exception);
        $exceptionMessage = $this->exception->getMessage();
        $exceptionFile = $this->exception->getFile();
        $exceptionLine = $this->exception->getLine();
        
        return (new MailMessage)
                    ->error()
                    ->subject('[Trilhas em SC] Erro 500 Detectado - ' . date('d/m/Y H:i:s'))
                    ->greeting('⚠️ Erro 500 Detectado no Sistema')
                    ->line('Um erro interno foi detectado no sistema Trilhas em SC.')
                    ->line('')
                    ->line('**Detalhes do Erro:**')
                    ->line('• **Tipo:** ' . $exceptionClass)
                    ->line('• **Mensagem:** ' . $exceptionMessage)
                    ->line('• **Arquivo:** ' . $exceptionFile)
                    ->line('• **Linha:** ' . $exceptionLine)
                    ->line('')
                    ->line('**Detalhes da Requisição:**')
                    ->line('• **URL:** ' . $url)
                    ->line('• **Método:** ' . $method)
                    ->line('• **IP do Usuário:** ' . $ip)
                    ->line('• **User Agent:** ' . substr($userAgent, 0, 100))
                    ->line('• **Data/Hora:** ' . date('d/m/Y H:i:s'))
                    ->line('')
                    ->line('Por favor, verifique os logs do sistema para mais detalhes.')
                    ->action('Ver Logs', url('/admin/logs'))
                    ->line('Este é um email automático do sistema de monitoramento.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'exception' => get_class($this->exception),
            'message' => $this->exception->getMessage(),
            'file' => $this->exception->getFile(),
            'line' => $this->exception->getLine(),
            'url' => $this->request->fullUrl(),
        ];
    }
}
