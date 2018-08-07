<?php

namespace App\Models\procuraduria;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'procuraduria.proceso';
    protected $primaryKey='id_proceso';
}
