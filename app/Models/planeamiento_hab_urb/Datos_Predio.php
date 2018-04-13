<?php

namespace App\Models\planeamiento_hab_urb;

use Illuminate\Database\Eloquent\Model;

class Datos_Predio extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_const_posesion.datos_predio';
    protected $primaryKey='id_dat_predio';
}
