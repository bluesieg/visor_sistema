<?php

namespace App\Models\procuraduria;

use Illuminate\Database\Eloquent\Model;

class Mtrprocuraduria extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'procuraduria.mtr_procuraduria';
    protected $primaryKey='id_procuraduria';
}
