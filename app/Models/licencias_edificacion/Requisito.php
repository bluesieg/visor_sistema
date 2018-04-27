<?php

namespace App\Models\licencias_edificacion;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_lic_edificacion.requisitos';
    protected $primaryKey='id_requisito';
}
