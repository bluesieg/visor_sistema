<?php

namespace App\Models\presupuesto;

use Illuminate\Database\Eloquent\Model;

class Tributos extends Model
{
    public $timestamps = false;
    protected $table = 'presupuesto.sub_proced_tributos';
    protected $primaryKey='id_tributo';
}
