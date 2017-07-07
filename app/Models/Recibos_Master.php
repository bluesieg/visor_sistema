<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recibos_Master extends Model
{
    public $timestamps = false;
    protected $table = 'tesoreria.recibos_master';
    protected $primaryKey='id_rec_mtr';
}
