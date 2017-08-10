<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    public $timestamps = false;
    protected $table = 'fraccionamiento.convenio';
    protected $primaryKey='id_conv';
}
