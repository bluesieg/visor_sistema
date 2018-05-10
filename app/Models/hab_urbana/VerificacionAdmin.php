<?php

namespace App\Models\hab_urbana;

use Illuminate\Database\Eloquent\Model;

class VerificacionAdmin extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_hab_urbana.verif_administrativa';
    protected $primaryKey='id_verif';
}
