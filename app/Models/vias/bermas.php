<?php

namespace App\Models\vias;

use Illuminate\Database\Eloquent\Model;

class bermas extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'plan_catastro.bermas';
    protected $primaryKey='id';
}
