<?php

namespace App\Models\asesoria_legal;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'asesoria_legal.proceso';
    protected $primaryKey='id_proceso';
}
