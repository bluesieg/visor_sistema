<?php

namespace App\Models\limpieza_publica;

use Illuminate\Database\Eloquent\Model;

class botaderos extends Model
{
     protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'limpieza_publica.botaderos';
    protected $primaryKey='id_botadero';
}
