<?php

namespace App\Models\procuraduria;

use Illuminate\Database\Eloquent\Model;

class Dteprocuraduria extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'procuraduria.dte_procuraduria';
    protected $primaryKey='id_det_procuraduria';
}
