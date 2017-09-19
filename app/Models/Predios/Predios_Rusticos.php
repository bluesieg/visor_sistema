<?php

namespace App\Models\Predios;

use Illuminate\Database\Eloquent\Model;

class Predios_Rusticos extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.predios_rusticos';
    protected $primaryKey='id_pred_rus';
}
