<?php

namespace App\Models\gerencia_seg_ciud;

use Illuminate\Database\Eloquent\Model;

class ObservCtrZonaRiesgo extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_seg_ciudadana.observacion_constr_zona_riesgo';
    protected $primaryKey='id_observ_ctr_zon_rg';
}
