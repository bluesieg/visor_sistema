<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspectores extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_const_posesion.inspectores';
    protected $primaryKey='id_inspector';
}
