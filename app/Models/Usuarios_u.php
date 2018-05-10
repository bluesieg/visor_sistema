<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios_u extends Model
{   
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'public.usuarios';
    protected $primaryKey='id';
}
