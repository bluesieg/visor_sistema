<?php

namespace App\Http\Controllers\presupuesto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\presupuesto\Tributos;

class TributosController extends Controller
{
    public function index(){
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_pres_trib' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $tip_trans= DB::table('presupuesto.tip_transaccion')->get();
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('presupuesto/vw_tributos',compact('tip_trans','anio','menu','permisos'));
    }

    public function create(Request $request){
        $data = new Tributos();
        $data->id_procedimiento = $request['id_proced'];
        $data->descrip_tributo = $request['desc'];
        $data->soles = $request['monto'];
        $data->save();
        return $data->id_tributo;
    }

    public function edit(Request $request,$id){
        $data = new Tributos();        
        $val = $data::where("id_tributo", "=", $id)->first();
        if (count($val) >= 1) {
            $val->descrip_tributo=$request['desc'];            
            $val->soles=$request['monto'];
            $val->save();  
            return $val->id_tributo;
        }
    }

    public function destroy(Request $request,$id){
        $data=new Tributos();
        $val=  $data::where("id_tributo","=",$request['id'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
    }
    
    function get_tributos(Request $request){
        $anio =  $request['anio'];
        $id_proced =  $request['id_proced'];
        $totalg = DB::select("select count(id_tributo) as total from presupuesto.vw_proced_tributo_x_anio where id_procedimiento=".$id_proced." and anio=".$anio);
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

        $sql = DB::table('presupuesto.vw_proced_tributo_x_anio')->where('id_procedimiento',$id_proced)->where('anio',$anio)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_tributo;
            $Lista->rows[$Index]['cell'] = array(
                str_pad(trim($Datos->cod_tributo), 3, "0", STR_PAD_LEFT),
                trim($Datos->descrip_tributo),
                trim($Datos->soles)                
            );
        }        
        return response()->json($Lista);
    }
}
