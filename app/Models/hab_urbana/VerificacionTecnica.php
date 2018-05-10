<?php

namespace App\Models\hab_urbana;

use Illuminate\Database\Eloquent\Model;

class VerificacionTecnica extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_hab_urbana.verif_tecnica';
    protected $primaryKey='id_verif_tecnica';
}
