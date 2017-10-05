<?php

namespace App\Traits;
use Jenssegers\Date\Date;

trait DatesTranslator
{
    public function getCreatedAtAttribute($created_at)
    {
        return new Date($created_at);
    }
    public function getUpdatedAtAttribute($updated_at)
    {
        return new Date($updated_at);
    }
    public function getDeletedAtAttribute($deleted_at)
    {
        return new Date($deleted_at);
    }
    function dias_transcurridos($fecha_i,$fecha_f)
    {
            $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
            $dias 	= abs($dias); $dias = round($dias);		
            return $dias;
    }
}

