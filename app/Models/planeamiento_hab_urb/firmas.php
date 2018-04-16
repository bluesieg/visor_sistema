<?php

namespace App\MODELS\planeamiento_hab_urb;

use Illuminate\Database\Eloquent\Model;

class firmas extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_const_posesion.firmas';
    protected $primaryKey='id_firm';
}
