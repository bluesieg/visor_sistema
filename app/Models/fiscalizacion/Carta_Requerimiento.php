<?php

namespace App\Models\fiscalizacion;

use Illuminate\Database\Eloquent\Model;

class Carta_Requerimiento extends Model
{
    public $timestamps = false;
    protected $table = 'fiscalizacion.carta_requerimiento';
    protected $primaryKey='id_car';
}
