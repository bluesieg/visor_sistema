<?php

namespace App\Models\alcabala;

use Illuminate\Database\Eloquent\Model;

class Tipo_Contrato extends Model
{
    public $timestamps = false;
    protected $table = 'alcabala.tipo_contrato';
    protected $primaryKey='id_tip_cto';
}
