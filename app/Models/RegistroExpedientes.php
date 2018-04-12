<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroExpedientes extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_const_posesion.regist_expediente';
    protected $primaryKey='id_reg_exp';
}
