<?php

namespace App\Models\gerencia_seg_ciud;

use Illuminate\Database\Eloquent\Model;

class DocAdjComisarias extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'geren_seg_ciudadana.doc_adj_comisarias';
    protected $primaryKey='id_doc_adj_com';
}
