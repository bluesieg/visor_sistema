<?php

namespace App\Models\hab_urbana;

use Illuminate\Database\Eloquent\Model;

class DocumentosHabUrb extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_hab_urbana.documentos_adjuntos';
    protected $primaryKey='id_doc_adj';
}
