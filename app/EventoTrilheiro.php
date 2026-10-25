<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventoTrilheiro extends Model
{
    use SoftDeletes;

    const INTERESSADO = 'interessado';
    const ACEITO = 'aceito';
    const PAGO = 'pago';
    const RECUSADO = 'recusado';
    const CANCELADO = 'cancelado';

    protected $table = 'evento_trilheiro_evt';
    protected $primaryKey = 'cd_evento_trilheiro_evt';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id_evento_eve',
        'id_trilheiro_tri',
        'fl_aceito_guia_evt',
        'fl_pago_evt',
        'st_inscricao_evt',
        'nr_documento_evt',
    ];

    public $timestamps = true;

    public static function nomeCompleto($nome)
    {
        $partes = preg_split('/\s+/', trim((string) $nome), -1, PREG_SPLIT_NO_EMPTY);

        return count($partes) >= 2;
    }

    public static function cpfValido($documento)
    {
        $cpf = preg_replace('/\D/', '', (string) $documento);

        if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $soma = 0;
            for ($c = 0; $c < $t; $c++) {
                $soma += (int) $cpf[$c] * (($t + 1) - $c);
            }
            $digito = ((10 * $soma) % 11) % 10;
            if ((int) $cpf[$t] !== $digito) {
                return false;
            }
        }

        return true;
    }

    public static function formatarCpf($documento)
    {
        $cpf = preg_replace('/\D/', '', (string) $documento);
        if (strlen($cpf) !== 11) {
            return $documento;
        }

        return substr($cpf, 0, 3).'.'.substr($cpf, 3, 3).'.'.substr($cpf, 6, 3).'-'.substr($cpf, 9, 2);
    }

    public function faltasParaConfirmar()
    {
        $trilheiro = $this->relationLoaded('trilheiro') ? $this->trilheiro : $this->trilheiro()->first();
        $faltas = [];

        if (!self::nomeCompleto(optional($trilheiro)->nm_trilheiro_tri)) {
            $faltas[] = 'nome completo';
        }
        if (empty(optional($trilheiro)->dt_nascimento)) {
            $faltas[] = 'data de nascimento';
        }
        if (!self::cpfValido($this->nr_documento_evt)) {
            $faltas[] = 'CPF';
        }

        return $faltas;
    }

    public static function cabeVaga($ocupadas, $limite)
    {
        if ($limite === null) {
            return true;
        }

        return (int) $ocupadas < (int) $limite;
    }

    public function ocupaVaga()
    {
        return $this->st_inscricao_evt === self::PAGO;
    }

    public function ativa()
    {
        return in_array($this->st_inscricao_evt, [self::INTERESSADO, self::ACEITO, self::PAGO], true);
    }

    public static function rotuloDoStatus($status)
    {
        switch ($status) {
            case self::ACEITO:
                return 'Aceito, aguardando pagamento';
            case self::PAGO:
                return 'Vaga confirmada';
            case self::RECUSADO:
                return 'Recusado';
            case self::CANCELADO:
                return 'Cancelado';
            default:
                return 'Interessado';
        }
    }

    public static function classeDoStatus($status)
    {
        switch ($status) {
            case self::ACEITO:
                return 'badge-info';
            case self::PAGO:
                return 'badge-success';
            case self::RECUSADO:
            case self::CANCELADO:
                return 'badge-danger';
            default:
                return 'badge-warning';
        }
    }

    public function rotuloStatus()
    {
        return self::rotuloDoStatus($this->st_inscricao_evt);
    }

    public function classeStatus()
    {
        return self::classeDoStatus($this->st_inscricao_evt);
    }

    public function aplicarStatus($status)
    {
        $this->st_inscricao_evt = $status;

        switch ($status) {
            case self::ACEITO:
                $this->fl_aceito_guia_evt = 1;
                $this->fl_pago_evt = null;
                break;
            case self::PAGO:
                $this->fl_aceito_guia_evt = 1;
                $this->fl_pago_evt = 1;
                break;
            case self::RECUSADO:
            case self::CANCELADO:
                $this->fl_aceito_guia_evt = 0;
                $this->fl_pago_evt = 0;
                break;
            default:
                $this->st_inscricao_evt = self::INTERESSADO;
                $this->fl_aceito_guia_evt = null;
                $this->fl_pago_evt = null;
                break;
        }

        return $this;
    }

    public function evento()
    {
        return $this->belongsTo('App\Evento', 'id_evento_eve', 'id_evento_eve');
    }

    public function trilheiro()
    {
        return $this->belongsTo('App\Trilheiro', 'id_trilheiro_tri', 'id_trilheiro_tri');
    }
}