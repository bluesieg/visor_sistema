<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pisos extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.pisos';
    protected $primaryKey='id_pisos';
}
