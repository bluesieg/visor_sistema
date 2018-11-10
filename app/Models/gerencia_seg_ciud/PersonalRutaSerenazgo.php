<?php

namespace App\Models\gerencia_seg_ciud;

use Illuminate\Database\Eloquent\Model;

class PersonalRutaSerenazgo extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_seg_ciudadana.personal_ruta_serenazgo';
    protected $primaryKey='id_per_ruta_serenazgo';
}
