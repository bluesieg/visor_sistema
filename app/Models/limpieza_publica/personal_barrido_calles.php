<?php

namespace App\Models\limpieza_publica;

use Illuminate\Database\Eloquent\Model;

class personal_barrido_calles extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'limpieza_publica.personal_barrido_calles';
    protected $primaryKey='id_per_barrido';
}
