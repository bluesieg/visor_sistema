<?php

namespace App\Models\gerencia_seg_ciud;

use Illuminate\Database\Eloquent\Model;

class CtrZonaRiesgo extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_seg_ciudadana.constr_zona_riesgo';
    protected $primaryKey='id_ctr_zon_rg';
}
