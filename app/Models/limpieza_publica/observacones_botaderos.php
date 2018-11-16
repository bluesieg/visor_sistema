<?php

namespace App\Models\limpieza_publica;

use Illuminate\Database\Eloquent\Model;

class observacones_botaderos extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'limpieza_publica.observaciones_botaderos';
    protected $primaryKey='id_obs_botaderos';
}
