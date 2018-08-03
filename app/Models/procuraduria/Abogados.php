<?php

namespace App\Models\procuraduria;

use Illuminate\Database\Eloquent\Model;

class Abogados extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'procuraduria.abogados';
    protected $primaryKey='id_abogado';
}
