<?php

namespace App\Models\limpieza_publica;

use Illuminate\Database\Eloquent\Model;

class rutas_barrido_calles extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'limpieza_publica.rutas_barrido_calles';
    protected $primaryKey='id_ruta_barrido';
}
