<?php

namespace App\Models\planeamiento_hab_urb;

use Illuminate\Database\Eloquent\Model;

class Insp_Campo extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_const_posesion.insp_campo';
    protected $primaryKey='ide';
}
