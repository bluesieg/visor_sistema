<?php

namespace App\Models\gerencia_desa_social;

use Illuminate\Database\Eloquent\Model;

class Bienestar extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_desa_social.bienestar_social';
    protected $primaryKey='id_bienestar';
}
