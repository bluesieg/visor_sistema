<?php

namespace App\Models\gerencia_obras_pub_infra;

use Illuminate\Database\Eloquent\Model;

class ExpedienteTecnico extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_gopi.expediente_tecnico';
    protected $primaryKey='id_expediente_tecnico';
}
