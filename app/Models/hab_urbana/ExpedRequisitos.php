<?php

namespace App\Models\hab_urbana;

use Illuminate\Database\Eloquent\Model;

class ExpedRequisitos extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_hab_urbana.exped_requisitos';
    protected $primaryKey='id_exp_req';
}
