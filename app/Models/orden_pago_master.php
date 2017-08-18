<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orden_pago_master extends Model
{
    public $timestamps = false;
    protected $table = 'fiscalizacion.orden_pago_master';
    protected $primaryKey='id_gen_fis';
}
