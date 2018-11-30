<?php

namespace App\Models\desarrollo_economico;

use Illuminate\Database\Eloquent\Model;

class licencias_funcionamiento extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'desarrollo_economico_local.licencias_funcionamiento';
    protected $primaryKey='id_lic_fun';
}
