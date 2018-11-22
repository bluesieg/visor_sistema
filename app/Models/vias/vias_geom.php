<?php

namespace App\Models\vias;

use Illuminate\Database\Eloquent\Model;

class vias_geom extends Model
{
    protected $connection = 'pgsql';
    public $timestamps = false;
    protected $table = 'catastro.vias_geom';
    protected $primaryKey='gid';
}
