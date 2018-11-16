<?php

namespace App\Models\areas_verdes;

use Illuminate\Database\Eloquent\Model;

class areas_verdes extends Model
{
     protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'areas_verdes.areas_verdes';
    protected $primaryKey='id_areas_verdes';
}
