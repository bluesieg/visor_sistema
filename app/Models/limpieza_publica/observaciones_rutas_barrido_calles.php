<?php

namespace App\Models\limpieza_publica;

use Illuminate\Database\Eloquent\Model;

class observaciones_rutas_barrido_calles extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'limpieza_publica.observaciones_rutas_barrido_calles';
    protected $primaryKey='id_obs_barrido_calles';
}
