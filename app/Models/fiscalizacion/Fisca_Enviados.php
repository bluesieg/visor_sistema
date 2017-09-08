<?php

namespace App\Models\fiscalizacion;

use Illuminate\Database\Eloquent\Model;

class Fisca_Enviados extends Model
{
    public $timestamps = false;
    protected $table = 'fiscalizacion.fisca_enviados';
    protected $primaryKey='id_fis_env';
    
}
