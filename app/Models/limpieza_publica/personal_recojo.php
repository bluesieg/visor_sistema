<?php

namespace App\Models\limpieza_publica;

use Illuminate\Database\Eloquent\Model;

class personal_recojo extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'limpieza_publica.personal_recojo';
    protected $primaryKey='id_per_recojo';
}
