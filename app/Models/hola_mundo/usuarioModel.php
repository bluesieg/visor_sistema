<?php

namespace App\Models\hola_mundo;

use Illuminate\Database\Eloquent\Model;

class usuarioModel extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.personas';
    protected $primaryKey='id_pers';
}
