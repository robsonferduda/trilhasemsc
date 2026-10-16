<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ServerErrorNotification;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        TokenMismatchException::class,
        ThrottleRequestsException::class,
        MethodNotAllowedHttpException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        // Enviar notificação por email para erros 500 (excluindo erros comuns)
        if ($this->shouldReportError($exception)) {
            $this->sendErrorNotification($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        // CSRF expirado / token inválido: comum em abas antigas, bots e sessões longas.
        // Não é falha do servidor — devolve o usuário ao formulário com mensagem clara.
        if ($exception instanceof TokenMismatchException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Sua sessão expirou. Recarregue a página e tente novamente.',
                ], 419);
            }

            return redirect()
                ->back()
                ->withInput($request->except($this->dontFlash))
                ->withErrors([
                    '_token' => 'Sua sessão expirou. Por favor, tente novamente.',
                ]);
        }

        return parent::render($request, $exception);
    }

    /**
     * Determina se o erro deve ser reportado via email
     *
     * @param  \Exception  $exception
     * @return bool
     */
    protected function shouldReportError($exception)
    {
        // Não reportar erros esperados do cliente / autenticação / validação
        if ($exception instanceof NotFoundHttpException ||
            $exception instanceof AuthenticationException ||
            $exception instanceof ValidationException ||
            $exception instanceof TokenMismatchException ||
            $exception instanceof ThrottleRequestsException ||
            $exception instanceof MethodNotAllowedHttpException) {
            return false;
        }

        // Não reportar erros HTTP comuns (400-499)
        if ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();
            if ($statusCode >= 400 && $statusCode < 500) {
                return false;
            }
        }

        // Reportar apenas em ambiente de produção
        return app()->environment('production');
    }

    /**
     * Envia notificação de erro por email
     *
     * @param  \Exception  $exception
     * @return void
     */
    protected function sendErrorNotification($exception)
    {
        try {
            // Email(s) para onde as notificações devem ser enviadas
            // Você pode configurar isso no arquivo .env com uma variável ERROR_NOTIFICATION_EMAIL
            $notificationEmail = env('ERROR_NOTIFICATION_EMAIL', 'robsonferduda@gmail.com');
            
            // Suporte a múltiplos emails separados por vírgula
            $emails = array_map('trim', explode(',', $notificationEmail));
            
            // Enviar notificação para cada email
            Notification::route('mail', $emails)
                ->notify(new ServerErrorNotification($exception, request()));
                
        } catch (\Exception $e) {
            // Se falhar ao enviar o email, apenas loga o erro
            // Não queremos que o sistema falhe ao tentar reportar um erro
            \Log::error('Falha ao enviar notificação de erro: ' . $e->getMessage());
        }
    }
}
