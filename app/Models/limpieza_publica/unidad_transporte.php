<?php

namespace App\Models\limpieza_publica;

use Illuminate\Database\Eloquent\Model;

class unidad_transporte extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'limpieza_publica.unidad_transporte';
    protected $primaryKey='id_uni_trans';
}
