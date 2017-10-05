<?php

namespace App\Models\presupuesto;

use Illuminate\Database\Eloquent\Model;

class Generica extends Model
{
    public $timestamps = false;
    protected $table = 'presupuesto.ingresos_generica';
    protected $primaryKey='id_gener';
}
