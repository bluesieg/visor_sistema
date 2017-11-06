<?php

namespace App\Models\presupuesto;

use Illuminate\Database\Eloquent\Model;

class Procedimientos extends Model
{
    public $timestamps = false;
    protected $table = 'presupuesto.procedimientos';
    protected $primaryKey='id_proced';
}
