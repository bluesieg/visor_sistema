<?php

namespace App\Models\fiscalizacion;

use Illuminate\Database\Eloquent\Model;

class Instalaciones_Fic extends Model
{
    public $timestamps = false;
    protected $table = 'fiscalizacion.instalaciones_fic';
    protected $primaryKey='id_inst_fic';
}
