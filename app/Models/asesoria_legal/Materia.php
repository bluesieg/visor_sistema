<?php

namespace App\Models\asesoria_legal;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'asesoria_legal.materia';
    protected $primaryKey='id_materia';
}
