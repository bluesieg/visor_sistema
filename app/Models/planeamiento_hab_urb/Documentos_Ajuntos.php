<?php

namespace App\Models\planeamiento_hab_urb;

use Illuminate\Database\Eloquent\Model;

class Documentos_Ajuntos extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_const_posesion.documentos_adjuntos';
    protected $primaryKey='id_doc_adj';
}
