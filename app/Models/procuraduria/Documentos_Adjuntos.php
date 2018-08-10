<?php

namespace App\Models\procuraduria;

use Illuminate\Database\Eloquent\Model;

class Documentos_Adjuntos extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'procuraduria.documentos_adjuntos';
    protected $primaryKey='id_doc_adj';
}
