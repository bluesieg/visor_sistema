<?php

namespace App\Models\fiscalizacion;

use Illuminate\Database\Eloquent\Model;

class Puente_Carta_Predios extends Model
{
    public $timestamps = false;
    protected $table = 'fiscalizacion.puente_carta_predios';
    protected $primaryKey='id_puente';
}
