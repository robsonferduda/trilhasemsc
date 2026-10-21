<?php

namespace App;

use App\Services\CadasturService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guia extends Model
{
    use SoftDeletes;
    
    protected $table = 'guia_gui';
    protected $primaryKey = 'id_guia_gui';
    protected $dates = [
        'deleted_at',
        'dt_cadastur_emissao_gui',
        'dt_cadastur_validade_gui',
        'dt_cadastur_consulta_gui',
        'dt_cadastur_aviso_validade_gui',
    ];
    protected $casts = [
        'fl_cadastur_nome_confere_gui' => 'boolean',
    ];
    protected $fillable = ['id_user',
        'cd_cidade_origem_gui',
        'nm_guia_gui',
        'nm_instagram_gui',
        'nm_site_gui',
        'nm_path_logo_gui',
        'ds_path_story_instagram_gui',
        'dc_biografia_gui',
        'fl_perfil_completo_gui',
        'fl_ativo_gui',
        'nu_cadastur_gui',
        'obs_gui'
        ];
        
    public $timestamps = true;

    /**
     * 'valido', 'vencido', 'informado' ou null (número ausente ou reprovado na conferência).
     */
    public function getSeloCadasturAttribute()
    {
        $situacao = $this->sg_cadastur_situacao_gui;
        $validade = $this->dt_cadastur_validade_gui;

        if ($situacao === CadasturService::CONFERIDO && $validade && $validade->gte(today())) {
            return 'valido';
        }

        if (in_array($situacao, [CadasturService::CONFERIDO, CadasturService::VENCIDO], true) && $validade) {
            return 'vencido';
        }

        if (in_array($situacao, [null, CadasturService::PENDENTE], true) && trim((string) $this->nu_cadastur_gui) !== '') {
            return 'informado';
        }

        return null;
    }

    public function origem()
    {
        return $this->hasOne('App\Cidade', 'cd_cidade_cde', 'cd_cidade_origem_gui');
    }

    public function fone()
    {
        return $this->hasOne('App\Fone', 'id_guia_gui', 'id_guia_gui')->where('id_tipo_fone_tif', 1);
    }

    public function whatsap()
    {
        return $this->hasOne('App\Fone', 'id_guia_gui', 'id_guia_gui')->where('id_tipo_fone_tif', 2);
    }

    public function cidadesAtuacao()
    {
        return $this->belongsToMany(Cidade::class, 'guia_cidade_atuacao_gca', 'id_guia_gui', 'cd_cidade_cde');
    }

    public function unidadesConservacao()
    {
        return $this->belongsToMany(UnidadeConservacao::class, 'guia_unidade_conservacao_guc', 'id_guia_gui', 'id_unidade_conservacao_unc');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    public function eventos()
    {
        return $this->hasMany('App\Evento', 'id_guia_gui', 'id_guia_gui');
    }

    public function trilhas()
    {
        return $this->belongsToMany(Trilha::class, 'guia_trilha_gut', 'id_guia_gui', 'id_trilha_tri');
    }

    /**
     * Trilhas publicadas deste guia, primeiro as escolhidas no cadastro.
     *
     * @return \Illuminate\Support\Collection
     */
    public function trilhasPublicas()
    {
        $publicadas = function ($query) {
            $query->where('fl_publicacao_tri', 'S')
                ->whereNotNull('ds_url_tri')
                ->where('ds_url_tri', '!=', '');
        };

        $escolhidas = $this->trilhas()
            ->with(['foto', 'cidade'])
            ->where($publicadas)
            ->orderBy('nm_trilha_tri')
            ->get();

        $idsEvento = Evento::query()
            ->where('id_guia_gui', $this->id_guia_gui)
            ->where('fl_cancelado_eve', false)
            ->whereNotNull('id_trilha_tri')
            ->pluck('id_trilha_tri');

        $dosEventos = Trilha::with(['foto', 'cidade'])
            ->whereIn('id_trilha_tri', $idsEvento->all())
            ->where($publicadas)
            ->orderBy('nm_trilha_tri')
            ->get();

        return $escolhidas->concat($dosEventos)->unique('id_trilha_tri')->values();
    }

    public function urlPublica()
    {
        if ($this->nm_instagram_gui) {
            return url('guia/perfil/' . $this->nm_instagram_gui);
        }

        return url('guia/perfil/' . $this->id_guia_gui);
    }

    public function telefoneNumero()
    {
        $fone = optional($this->fone)->nu_fone_fon ?: optional($this->whatsap)->nu_fone_fon;

        return $fone ? trim($fone) : '';
    }

    public function telefoneInternacional()
    {
        $digitos = preg_replace('/\D+/', '', $this->telefoneNumero());
        if ($digitos === '') {
            return null;
        }

        if (strpos($digitos, '55') === 0 && strlen($digitos) > 11) {
            return $digitos;
        }

        return '55' . $digitos;
    }

    public function urlWhatsapp()
    {
        $numero = $this->telefoneInternacional();
        if (!$numero) {
            return null;
        }

        $texto = 'Olá! Vi seu perfil em ' . $this->urlPublica() . ' e quero informações sobre as trilhas.';

        return 'https://wa.me/' . $numero . '?text=' . rawurlencode($texto);
    }

    public function urlInstagram()
    {
        $usuario = ltrim((string) $this->nm_instagram_gui, '@');

        return $usuario !== '' ? 'https://www.instagram.com/' . $usuario : null;
    }
}
