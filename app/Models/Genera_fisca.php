<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genera_fisca extends Model
{
    public $timestamps = false;
    protected $table = 'fiscalizacion.genera_fisca';
    protected $primaryKey='id_gen_fis';
}
