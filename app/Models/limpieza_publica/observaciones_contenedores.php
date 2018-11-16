<?php

namespace App\Models\limpieza_publica;

use Illuminate\Database\Eloquent\Model;

class observaciones_contenedores extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'limpieza_publica.observaciones_contenedores';
    protected $primaryKey='id_obs_contenedores';
}
