<?php

namespace App\Models\gerencia_seg_ciud;

use Illuminate\Database\Eloquent\Model;

class ObservRutasSerenazgo extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_seg_ciudadana.observacion_ruta_serenazgo';
    protected $primaryKey='id_observ_ruta_srzgo';
}
