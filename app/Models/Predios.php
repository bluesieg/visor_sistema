<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Predios extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.predios';
    protected $primaryKey='id_pred';
}
