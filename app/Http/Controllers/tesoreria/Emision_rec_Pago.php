<?php

namespace App\Http\Controllers\tesoreria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Emision_rec_Pago extends Controller
{
    function vw_show(){
        return view('tesoreria/vw_emision_rec_pago');
    }
}
