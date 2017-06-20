<?php

namespace App\Http\Controllers\caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Caja_ClaIn_Generica extends Controller
{
    function vw_show_generica(){
        return view('caja/vw_generica');
    }
}
