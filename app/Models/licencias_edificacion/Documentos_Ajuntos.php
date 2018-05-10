<?php

namespace App\Models\licencias_edificacion;

use Illuminate\Database\Eloquent\Model;

class Documentos_Ajuntos extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_lic_edificacion.documentos_adjuntos';
    protected $primaryKey='id_doc_adj';
}
