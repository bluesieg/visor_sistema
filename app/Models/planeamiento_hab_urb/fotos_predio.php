<?php

namespace App\MODELS\planeamiento_hab_urb;

use Illuminate\Database\Eloquent\Model;

class fotos_predio extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_const_posesion.fotos_predio';
    protected $primaryKey='ide';
}
