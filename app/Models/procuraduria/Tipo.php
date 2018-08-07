<?php

namespace App\Models\procuraduria;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'procuraduria.tipo';
    protected $primaryKey='id_tipo';
}
