<?php

namespace App\Models\pas;

use Illuminate\Database\Eloquent\Model;

class registro_expe_sancionador extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_pas.registro_expe_sancionador';
    protected $primaryKey='id_exp_san';
}
