<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Valores_Arancelarios extends Controller
{
    public function vw_val_arancel() {
        return view('configuracion/vw_valores_arancelarios');
    }
}
