<?php

namespace App\Models\gerencia_desa_social;

use Illuminate\Database\Eloquent\Model;

class Observaciones_cdeportivo extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_desa_social.observaciones_cdeportivo';
    protected $primaryKey='id_observaciones';
}
