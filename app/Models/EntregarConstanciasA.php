<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntregarConstanciasA extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_const_posesion.entregar_constancias_a';
    protected $primaryKey='id';
}
