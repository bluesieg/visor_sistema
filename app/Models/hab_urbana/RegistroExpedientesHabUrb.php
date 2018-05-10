<?php

namespace App\Models\hab_urbana;

use Illuminate\Database\Eloquent\Model;

class RegistroExpedientesHabUrb extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_hab_urbana.registro_expediente_hab_urb';
    protected $primaryKey='id_reg_exp';
}
