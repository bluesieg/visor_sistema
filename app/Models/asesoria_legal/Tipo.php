<?php

namespace App\Models\asesoria_legal;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'asesoria_legal.tipo';
    protected $primaryKey='id_tipo';
}
