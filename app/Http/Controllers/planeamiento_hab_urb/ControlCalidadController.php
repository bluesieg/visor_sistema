<?php

namespace App\Http\Controllers\planeamiento_hab_urb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroExpedientes;


class ControlCalidadController extends Controller
{

    public function index()
    {
      
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        $anio1 = DB::select('select anio from adm_tri.uit order by anio asc');
        return view('planeamiento_hab_urb/vw_constancia_posesion',compact('anio','anio1'));
    }
    
    public function getExpedientes_ControlCalidad(Request $request){
        header('Content-type: application/json');
        $fecha_desde = $request['fecha_desde_cc'];
        $fecha_hasta = $request['fecha_hasta_cc'];
 
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_const_posesion.vw_expedientes where fase = 2");
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        $total_pages = 0;
        if (!$sidx) {
            $sidx = 1;
        }
        $count = $totalg[0]->total;
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        }
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }

     

        $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_expedientes')->where('fase',2)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_reg_exp),
                trim($Datos->nro_expediente),
                trim($Datos->gestor),
                trim($Datos->fecha_inicio_tramite),
                trim($Datos->fecha_registro),
                trim($Datos->fase)
            );
        }

        return response()->json($Lista);

    }
    
}
