<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Evento extends Model
{
    use SoftDeletes;
    
    protected $table = 'evento_eve';
    protected $primaryKey = 'id_evento_eve';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id_guia_gui',
                            'cd_cidade_cde',
                            'nm_evento_eve',
                            'slug_eve',
                            'ds_fone_contato_eve',
                            'dt_realizacao_eve',
                            'dt_termino_eve',
                            'valor_eve',
                            'total_participantes_eve',
                            'descricao',
                            'ds_imagem_vertical_eve',
                            'ds_imagem_horizontal_eve',
                            'fl_ativo_eve',
                            'hora_inicio_eve',
                            'hora_fim_eve',
                            'fl_privado_eve',
                            'id_unico_eve'];
                            
    public $timestamps = true;

    /**
     * Boot do modelo para gerar slug automaticamente
     */
    protected static function boot()
    {
        parent::boot();

        // Gera slug ao criar um novo evento
        static::creating(function ($evento) {
            if (empty($evento->slug_eve)) {
                $evento->slug_eve = $evento->generateUniqueSlug($evento->nm_evento_eve);
            }
        });

        // Define id_unico_eve após criar o evento (se não foi definido manualmente)
        static::created(function ($evento) {
            if (empty($evento->id_unico_eve)) {
                $evento->id_unico_eve = $evento->id_evento_eve;
                $evento->save();
            }
        });

        // Atualiza slug se o nome do evento mudar
        static::updating(function ($evento) {
            if ($evento->isDirty('nm_evento_eve')) {
                $evento->slug_eve = $evento->generateUniqueSlug($evento->nm_evento_eve);
            }
        });
    }

    /**
     * Gera um slug único para o evento incluindo informações do guia e data
     *
     * @param string $title
     * @return string
     */
    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        
        // Se o evento já tem um guia associado, inclui o nome do guia no slug
        if ($this->id_guia_gui) {
            $guia = $this->guia;
            if ($guia && $guia->nm_guia_gui) {
                $guiaSlug = Str::slug($guia->nm_guia_gui);
                // Limita o nome do guia para não deixar o slug muito longo
                $guiaSlugParts = explode('-', $guiaSlug);
                $guiaSlugShort = implode('-', array_slice($guiaSlugParts, 0, 3));
                $slug = $slug . '-' . $guiaSlugShort;
            }
        }
        
        // Inclui a data no slug (formato: dia-mes-ano)
        if ($this->dt_realizacao_eve) {
            $data = date('d-m-Y', strtotime($this->dt_realizacao_eve));
            $slug = $slug . '-' . $data;
        }
        
        $originalSlug = $slug;
        $counter = 1;

        // Verifica se o slug já existe e adiciona um número se necessário
        while (static::where('slug_eve', $slug)->where('id_evento_eve', '!=', $this->id_evento_eve)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Busca evento por slug ou ID
     *
     * @param string $slugOrId
     * @return Evento|null
     */
    public static function findBySlugOrId($slugOrId)
    {
        // Se for numérico, busca por ID (para manter compatibilidade)
        if (is_numeric($slugOrId)) {
            return static::find($slugOrId);
        }
        
        // Caso contrário, busca por slug
        return static::where('slug_eve', $slugOrId)->first();
    }

    /**
     * Retorna a URL completa do evento (com slug)
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return url('eventos/' . ($this->slug_eve ?: $this->id_evento_eve));
    }

    public function local()
    {
        return $this->hasOne('App\Cidade', 'cd_cidade_cde', 'cd_cidade_cde');
    }

    public function guia()
    {
        return $this->hasOne('App\Guia', 'id_guia_gui', 'id_guia_gui');
    }

    public function eventoTrilheiros()
    {
        return $this->hasMany('App\EventoTrilheiro', 'id_evento_eve', 'id_evento_eve');
    }
    
    public function trilheiros()
    {
        return $this->belongsToMany(Trilheiro::class, 'evento_trilheiro_evt', 'id_evento_eve', 'id_trilheiro_tri');
    }

    /**
     * Clona o evento atual criando uma nova cópia
     * O novo evento mantém o id_unico_eve do evento original
     * Se este evento já é um clone, usa seu id_unico_eve (que aponta para o original)
     * Se este evento é o original, usa seu próprio id_evento_eve
     * 
     * @return Evento
     */
    public function clonar()
    {
        // Cria uma cópia do evento
        $novoEvento = $this->replicate();
        
        // Reseta campos que não devem ser copiados
        $novoEvento->slug_eve = null; // Será gerado automaticamente
        $novoEvento->fl_ativo_eve = null; // Novo evento inicia como inativo (aguardando aprovação)
        
        // Define o id_unico_eve: 
        // Se este evento já tem id_unico_eve (é um clone), usa esse valor para manter a referência ao original
        // Caso contrário, usa o id deste evento (que será o primeiro da série)
        $novoEvento->id_unico_eve = !empty($this->id_unico_eve) ? $this->id_unico_eve : $this->id_evento_eve;
        
        // Adiciona sufixo ao nome para identificar como cópia
        $novoEvento->nm_evento_eve = $this->nm_evento_eve . " (Cópia)";
        
        // Salva o novo evento
        $novoEvento->save();
        
        return $novoEvento;
    }

    /**
     * Retorna o evento original (primeiro da série)
     * 
     * @return Evento|null
     */
    public function eventoOriginal()
    {
        if ($this->id_unico_eve && $this->id_unico_eve != $this->id_evento_eve) {
            return static::find($this->id_unico_eve);
        }
        
        return null;
    }

    /**
     * Retorna todos os eventos clonados a partir deste
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function eventosClonados()
    {
        $idBase = $this->id_unico_eve ?: $this->id_evento_eve;
        
        return static::where("id_unico_eve", $idBase)
            ->where("id_evento_eve", "!=", $this->id_evento_eve)
            ->get();
    }
}
