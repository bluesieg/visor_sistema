<?php

namespace App\Models\alcabala;

use Illuminate\Database\Eloquent\Model;

class deducciones extends Model
{
    public $timestamps = false;
    protected $table = 'alcabala.deducciones';
    protected $primaryKey='id_dec';
}
