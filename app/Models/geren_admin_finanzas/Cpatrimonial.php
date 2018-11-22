<?php

namespace App\Models\geren_admin_finanzas;

use Illuminate\Database\Eloquent\Model;

class Cpatrimonial extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_admin_finanzas.cpatrimonial';
    protected $primaryKey='id_cpatrimonial';
}
