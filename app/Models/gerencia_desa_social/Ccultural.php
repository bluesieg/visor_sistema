<?php

namespace App\Models\gerencia_desa_social;

use Illuminate\Database\Eloquent\Model;

class Ccultural extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_desa_social.c_cultural';
    protected $primaryKey='id_ccultural';
}
