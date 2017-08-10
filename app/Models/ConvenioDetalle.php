<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConvenioDetalle extends Model
{
    public $timestamps = false;
    protected $table = 'fraccionamiento.detalle_convenio';
    protected $primaryKey='id_det_conv';
}
