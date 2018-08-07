<?php

namespace App\Models\procuraduria;

use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'procuraduria.caso';
    protected $primaryKey='id_caso';
}
