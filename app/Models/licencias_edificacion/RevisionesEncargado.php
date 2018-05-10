<?php

namespace App\Models\licencias_edificacion;

use Illuminate\Database\Eloquent\Model;

class RevisionesEncargado extends Model
{
    protected $connection = 'gerencia_catastro';
    public $timestamps = false;
    protected $table = 'soft_lic_edificacion.revisiones_encargado';
    protected $primaryKey='id_rev_enc';
}
