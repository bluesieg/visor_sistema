<?php

namespace App\Models\asesoria_legal;

use Illuminate\Database\Eloquent\Model;

class Abogados extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'asesoria_legal.abogados';
    protected $primaryKey='id_abogado';
}
