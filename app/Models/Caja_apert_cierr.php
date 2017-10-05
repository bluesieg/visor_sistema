<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja_apert_cierr extends Model
{
    public $timestamps = false;
    protected $table = 'tesoreria.caja_apert_cierr';
    protected $primaryKey='id_caj_mov';
}
