<?php

namespace App\Models\licencias_edificacion;

use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_lic_edificacion.procedimiento';
    protected $primaryKey='id_procedimiento';
}
