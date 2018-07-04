<?php

namespace App\Models\pas;

use Illuminate\Database\Eloquent\Model;

class infracciones_verificadas extends Model
{
     protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_pas.infracciones_verificadas';
    protected $primaryKey='id_infra_veric';
}
