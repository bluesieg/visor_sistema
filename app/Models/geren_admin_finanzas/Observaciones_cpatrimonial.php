<?php

namespace App\Models\geren_admin_finanzas;

use Illuminate\Database\Eloquent\Model;

class Observaciones_cpatrimonial extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_admin_finanzas.observaciones_cpatrimonial';
    protected $primaryKey='id_observaciones';
}
