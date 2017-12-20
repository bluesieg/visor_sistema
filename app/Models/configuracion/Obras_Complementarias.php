<?php

namespace App\Models\configuracion;

use Illuminate\Database\Eloquent\Model;

class Obras_Complementarias extends Model
{
    public $timestamps = false;
    protected $table = 'catastro.instalaciones';
    protected $primaryKey='id_instal';
}
