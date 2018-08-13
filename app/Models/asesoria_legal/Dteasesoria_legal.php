<?php

namespace App\Models\asesoria_legal;

use Illuminate\Database\Eloquent\Model;

class Dteasesoria_legal extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'asesoria_legal.dte_asesoria_legal';
    protected $primaryKey='id_det_asesoria_legal';
}
