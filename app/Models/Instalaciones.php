<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instalaciones extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.instalaciones';
    protected $primaryKey='id_inst';
}
