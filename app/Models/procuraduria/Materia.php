<?php

namespace App\Models\procuraduria;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'procuraduria.materia';
    protected $primaryKey='id_materia';
}
