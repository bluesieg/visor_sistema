<?php

namespace App\Models\licencias_edificacion;

use Illuminate\Database\Eloquent\Model;

class Observaciones extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_lic_edificacion.verif_admin';
    protected $primaryKey='id_exp';
}
