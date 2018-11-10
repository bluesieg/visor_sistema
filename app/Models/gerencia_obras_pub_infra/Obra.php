<?php

namespace App\Models\gerencia_obras_pub_infra;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_gopi.obra';
    protected $primaryKey='id_obra';
}
