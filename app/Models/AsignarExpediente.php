<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignarExpediente extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_const_posesion.asignar_expediente';
    protected $primaryKey='id_asig_exp';
}
