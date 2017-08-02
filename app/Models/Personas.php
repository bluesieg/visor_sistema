<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.personas';
    protected $primaryKey='id_pers';
}
