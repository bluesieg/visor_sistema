<?php

namespace App\Models\archivo;

use Illuminate\Database\Eloquent\Model;

class auditoria_digitalizacion extends Model
{
    protected $connection = 'digitalizacion';
    public $timestamps = false;
    protected $table = 'auditoria.digitalizacion';
    protected $primaryKey='id_aud';
}
