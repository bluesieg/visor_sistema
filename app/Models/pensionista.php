<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pensionista extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.pensionista';
    protected $primaryKey='id_pen';
}
