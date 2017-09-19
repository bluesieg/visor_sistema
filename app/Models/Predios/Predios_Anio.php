<?php

namespace App\Models\Predios;

use Illuminate\Database\Eloquent\Model;

class Predios_Anio extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.predios_anio';
    protected $primaryKey='id_pred_anio';
}
