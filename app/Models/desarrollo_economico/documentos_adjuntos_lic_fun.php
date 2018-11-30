<?php

namespace App\Models\desarrollo_economico;

use Illuminate\Database\Eloquent\Model;

class documentos_adjuntos_lic_fun extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'desarrollo_economico_local.documentos_adjuntos_lic_fun';
    protected $primaryKey='id_doc_adj';
}
