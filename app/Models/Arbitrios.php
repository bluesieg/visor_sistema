<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Arbitrios extends Model
{
    public $timestamps = false;
    protected $table = 'arbitrios.arbitrios';
    protected $primaryKey='id_arb';
}
