<?php

namespace App\Models\gerencia_obras_pub_infra;

use Illuminate\Database\Eloquent\Model;

class FotosMantenimiento extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_gopi.fotos_mantenimiento';
    protected $primaryKey='id_foto_mant';
}
