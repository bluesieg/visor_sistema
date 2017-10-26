<?php

namespace App\Http\Controllers\presupuesto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProcedimientoController extends Controller
{
    public function index(){
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_pres_proced' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('presupuesto.vw_procedimientos',compact('anio','menu','permisos'));
    }

    public function create(){}

    public function edit($id){}

    public function destroy($id){}
    
    function get_procedimientos(Request $request){
        $anio =  $request['anio'];
        $totalg = DB::select("select count(id_proced) as total from presupuesto.vw_procedimiento where anio=".$anio);
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

        $sql = DB::table('presupuesto.vw_procedimiento')->where('anio',$anio)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_proced;
            $Lista->rows[$Index]['cell'] = array(
                str_pad(trim($Datos->cod_proced), 3, "0", STR_PAD_LEFT),
                trim($Datos->descrip_procedim)               
            );
        }        
        return response()->json($Lista);
    }
}
