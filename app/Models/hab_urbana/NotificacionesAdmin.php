<?php

namespace App\Models\hab_urbana;

use Illuminate\Database\Eloquent\Model;

class NotificacionesAdmin extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_hab_urbana.notificaciones_admin';
    protected $primaryKey='id_notificacion_admin';
}
