<?php

namespace App\Models\fiscalizacion;

use Illuminate\Database\Eloquent\Model;

class Hoja_Liquidacion extends Model
{
    public $timestamps = false;
    protected $table = 'fiscalizacion.hoja_liquidacion';
    protected $primaryKey='id_hoja_liq';
}
