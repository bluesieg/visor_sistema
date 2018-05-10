<?php

namespace App\Models\hab_urbana;

use Illuminate\Database\Eloquent\Model;

class NotificacionesTecnica extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_hab_urbana.notificaciones_tecnica';
    protected $primaryKey='id_notificacion_tecnica';
}
