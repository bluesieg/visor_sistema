<?php

namespace App\Models\fiscalizacion;

use Illuminate\Database\Eloquent\Model;

class Pisos_Fic extends Model
{
    public $timestamps = false;
    protected $table = 'fiscalizacion.pisos_fic';
    protected $primaryKey='id_pisos_fic';
}
