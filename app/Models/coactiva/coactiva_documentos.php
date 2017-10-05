<?php

namespace App\Models\coactiva;

use Illuminate\Database\Eloquent\Model;

class coactiva_documentos extends Model
{
    public $timestamps = false;
    protected $table = 'coactiva.coactiva_documentos';
    protected $primaryKey='id_doc';
}
