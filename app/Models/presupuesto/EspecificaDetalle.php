<?php

namespace App\Models\presupuesto;

use Illuminate\Database\Eloquent\Model;

class EspecificaDetalle extends Model
{
    public $timestamps = false;
    protected $table = 'presupuesto.especifica_detalle';
    protected $primaryKey='id_espec_det';
}
