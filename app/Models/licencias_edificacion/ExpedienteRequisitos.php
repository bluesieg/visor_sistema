<?php

namespace App\Models\licencias_edificacion;

use Illuminate\Database\Eloquent\Model;

class ExpedienteRequisitos extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_lic_edificacion.expediente_requisitos';
    protected $primaryKey='id_e_r';
}
