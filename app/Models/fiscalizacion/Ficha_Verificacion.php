<?php

namespace App\Models\fiscalizacion;

use Illuminate\Database\Eloquent\Model;

class Ficha_Verificacion extends Model
{
    public $timestamps = false;
    protected $table = 'fiscalizacion.ficha_verificacion';
    protected $primaryKey='id_fic';
}
