<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condominios extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.condominios';
    protected $primaryKey='id_condom';
}
