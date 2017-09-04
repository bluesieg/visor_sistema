<?php

namespace App\Models\alcabala;

use Illuminate\Database\Eloquent\Model;

class Transferencias_Inafectas extends Model
{
    public $timestamps = false;
    protected $table = 'alcabala.transferencias_inafectas';
    protected $primaryKey='id_trans_inaf';
}
