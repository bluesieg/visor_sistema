<?php

namespace App\Models\fiscalizacion;

use Illuminate\Database\Eloquent\Model;

class Resolucion_Determinacion extends Model
{
    public $timestamps = false;
    protected $table = 'fiscalizacion.resolucion_determinacion';
    protected $primaryKey='id_rd';
}
