<?php

namespace App\Models\limpieza_publica;

use Illuminate\Database\Eloquent\Model;

class rutas_recojo extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'limpieza_publica.rutas_recojo';
    protected $primaryKey='id_ruta_recojo';
}
