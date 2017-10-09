<?php

namespace App\Models\presupuesto;

use Illuminate\Database\Eloquent\Model;

class Especifica extends Model
{
    public $timestamps = false;
    protected $table = 'presupuesto.especifica';
    protected $primaryKey='id_especif';
}
