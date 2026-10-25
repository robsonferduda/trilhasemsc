<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuiaAvaliacao extends Model
{
    protected $table = 'guia_avaliacao_gav';
    protected $primaryKey = 'cd_guia_avaliacao_gav';
    protected $fillable = ['id_guia_gui', 'id_trilheiro_tri', 'nr_nota_gav', 'ds_comentario_gav'];
    public $timestamps = true;

    public function guia()
    {
        return $this->belongsTo('App\Guia', 'id_guia_gui', 'id_guia_gui');
    }

    public function trilheiro()
    {
        return $this->belongsTo('App\Trilheiro', 'id_trilheiro_tri', 'id_trilheiro_tri');
    }

    public static function estrelas($nota)
    {
        $nota = (int) $nota;
        $nota = max(0, min(5, $nota));

        return str_repeat('★', $nota).str_repeat('☆', 5 - $nota);
    }
}
