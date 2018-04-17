<?php

namespace App\Http\Controllers\planeamiento_hab_urb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroExpedientes;


class ConsultaExpedientesController extends Controller
{

    public function index()
    {
      
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        $anio1 = DB::select('select anio from adm_tri.uit order by anio asc');
        $tip_sol = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.tipo_solictud');
        $inspectores = DB::connection('gerencia_catastro')->select('select id_inspector,apenom from soft_const_posesion.inspectores order by id_inspector');
        return view('planeamiento_hab_urb/wv_consulta_expedientes',compact('anio','anio1','tip_sol','inspectores'));
    }

    
   
    
}
