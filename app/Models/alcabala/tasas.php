<?php

namespace App\Models\alcabala;

use Illuminate\Database\Eloquent\Model;

class tasas extends Model
{
    public $timestamps = false;
    protected $table = 'alcabala.tasas';
    protected $primaryKey='id_tas';
}
