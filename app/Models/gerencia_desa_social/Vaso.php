<?php

namespace App\Models\gerencia_desa_social;

use Illuminate\Database\Eloquent\Model;

class Vaso extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_desa_social.vaso_leche';
    protected $primaryKey='id_vaso';
}
