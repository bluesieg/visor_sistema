<?php

namespace App\Models\presupuesto;

use Illuminate\Database\Eloquent\Model;

class SubGenDetalle extends Model
{
    public $timestamps = false;
    protected $table = 'presupuesto.sub_generica_detalle';
    protected $primaryKey='id_sub_gen_det';
}
