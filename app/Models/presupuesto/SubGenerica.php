<?php

namespace App\Models\presupuesto;

use Illuminate\Database\Eloquent\Model;

class SubGenerica extends Model
{
    public $timestamps = false;
    protected $table = 'presupuesto.ingresos_sub_gener';
    protected $primaryKey='id_sub_gen';
}
