<?php

namespace App\Models\Predios;

use Illuminate\Database\Eloquent\Model;

class Predios_Contribuyentes extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.predios_contribuyentes';
    protected $primaryKey='id_pred_contri';
}
