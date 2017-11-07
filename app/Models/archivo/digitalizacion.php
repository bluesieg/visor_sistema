<?php

namespace App\Models\archivo;

use Illuminate\Database\Eloquent\Model;

class digitalizacion extends Model
{
    protected $connection = 'digitalizacion';
    public $timestamps = false;
    protected $table = 'digitalizacion';
    protected $primaryKey='id';
}
