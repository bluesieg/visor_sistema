<?php

namespace App\Models\desarrollo_economico;

use Illuminate\Database\Eloquent\Model;

class mypes extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'desarrollo_economico_local.mypes';
    protected $primaryKey='id_mype';
}
