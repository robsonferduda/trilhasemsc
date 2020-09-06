<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foto extends Model
{
    use SoftDeletes;
    
    protected $table = 'foto_fot';
    protected $primaryKey = 'id_foto_fot';
    protected $dates = ['deleted_at'];
    protected $fillable = [
                            'id_trilha_tri',
                            'id_tipo_foto_tfo',
                            'nm_foto_fot',
                            'nm_path_fot',
                            'dc_alt_fot'
                          ];

    public $timestamps = true;

    public function trilha()
    {
        return $this->belongsTo('App\Trilha', 'id_trilha_tri', 'id_trilha_tri');
    }

    public function galeria()
    {
        return $this->belongsTo('App\Galeria', 'id_galeria_gal', 'id_galeria_gal')->withTimestamps();
    }

    public function tipo()
    {
        return $this->hasOne('App\TipoFoto', 'id_tipo_foto_tfo', 'id_tipo_foto_tfo');
    }
}
