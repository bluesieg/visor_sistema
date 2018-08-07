<?php

namespace App\Models\procuraduria;

use Illuminate\Database\Eloquent\Model;

class TipoSancion extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'procuraduria.tipo_sancion';
    protected $primaryKey='id_tipo_sancion';
}
