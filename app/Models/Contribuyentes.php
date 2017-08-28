<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribuyentes extends Model
{
    public $timestamps = false;
    protected $table = 'adm_tri.contribuyentes';
    protected $primaryKey='id_contrib';
}
