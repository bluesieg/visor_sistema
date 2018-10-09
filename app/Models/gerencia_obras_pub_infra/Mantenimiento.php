<?php

namespace App\Models\gerencia_obras_pub_infra;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_gopi.mantenimiento';
    protected $primaryKey='id_mantenimiento';
}
