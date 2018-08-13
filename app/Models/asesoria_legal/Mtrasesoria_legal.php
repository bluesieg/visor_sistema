<?php

namespace App\Models\asesoria_legal;

use Illuminate\Database\Eloquent\Model;

class Mtrasesoria_legal extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'asesoria_legal.mtr_asesoria_legal';
    protected $primaryKey='id_asesoria_legal';
}
