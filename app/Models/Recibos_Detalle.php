<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recibos_Detalle extends Model
{
    public $timestamps = false;
    protected $table = 'tesoreria.recibos_detalle';
    protected $primaryKey='id_rec_det';
}
