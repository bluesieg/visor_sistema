<?php

namespace App\Models\licencias_edificacion;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_lic_edificacion.notificaciones';
    protected $primaryKey='id_notificacion';
}
