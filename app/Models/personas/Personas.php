<?php

namespace App\Models\personas;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'public.personas';
    protected $primaryKey='id_pers';
}
