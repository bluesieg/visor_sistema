<?php

namespace App\Models\limpieza_publica;

use Illuminate\Database\Eloquent\Model;

class contenedores extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'limpieza_publica.contenedores';
    protected $primaryKey='id';
}
