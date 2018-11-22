<?php

namespace App\Models\gerencia_desa_social;

use Illuminate\Database\Eloquent\Model;

class Observaciones_ccultural extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_desa_social.observaciones_ccultural';
    protected $primaryKey='id_observaciones';
}
