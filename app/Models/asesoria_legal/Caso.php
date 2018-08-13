<?php

namespace App\Models\asesoria_legal;

use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'asesoria_legal.caso';
    protected $primaryKey='id_caso';
}
