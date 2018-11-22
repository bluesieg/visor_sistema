<?php

namespace App\Models\infra_deportiva;

use Illuminate\Database\Eloquent\Model;

class infr_deportiva extends Model
{
     protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'infr_deportiva.infr_deportiva';
    protected $primaryKey='id_deporte';
}
