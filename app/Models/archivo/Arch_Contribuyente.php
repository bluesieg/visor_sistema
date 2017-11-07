<?php

namespace App\Models\archivo;

use Illuminate\Database\Eloquent\Model;

class Arch_Contribuyente extends Model
{
    protected $connection = 'digitalizacion';
    public $timestamps = false;
    protected $table = 'contribuyente';
    protected $primaryKey='id_contrib';
}
