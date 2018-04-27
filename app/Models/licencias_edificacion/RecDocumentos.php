<?php

namespace App\Models\licencias_edificacion;

use Illuminate\Database\Eloquent\Model;

class RecDocumentos extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_lic_edificacion.registro_expediente';
    protected $primaryKey='id_reg_exp';
}
