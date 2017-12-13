<?php

namespace App\Models\personas;

use Illuminate\Database\Eloquent\Model;

class personas extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.personas';
    protected $primaryKey='id_pers';
}
