<?php

namespace App\Models\asesoria_legal;

use Illuminate\Database\Eloquent\Model;

class TipoSancion extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'asesoria_legal.tipo_sancion';
    protected $primaryKey='id_tipo_sancion';
}
