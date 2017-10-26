<?php

namespace App\Http\Controllers\presupuesto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\presupuesto\Especifica;
use Illuminate\Support\Facades\Auth;

class EspecificaController extends Controller
{

    public function index(){
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_pres_especi' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('presupuesto/vw_especifica',compact('anio','menu','permisos'));
    }

    public function create(Request $request){
        $data = new Especifica();
        $data->id_sub_gen_det = $request['id_sub_gen_det'];
        $data->cod_especif =$request['cod'];
        $data->det_especifica = $request['desc'];
        $data->save();
        return $data->id_especif;
    }

    public function edit(Request $request,$id){
        $data = new Especifica();
        $val = $data::where("id_especif", "=", $id)->first();
        if (count($val) >= 1) {
            $val->det_especifica=$request['desc'];
            $val->save();  
            return $val->id_especif;
        }
    }

    public function destroy(Request $request){
        $data = new Especifica();
        $val=  $data::where("id_especif","=",$request['id'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
            return $val->id_especif;
        }
    }
    
    function get_espec(Request $request){
        $anio =  $request['anio'];
        $id_sub_gen_det =  $request['id_sub_gen_det'];
        $totalg = DB::select("select count(id_sub_gen_det) as total from presupuesto.vw_especifica_anio where anio=".$anio." and id_sub_gen_det=".$id_sub_gen_det);
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

        $sql = DB::table('presupuesto.vw_especifica_anio')->where('anio',$anio)->where('id_sub_gen_det',$id_sub_gen_det)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_especif;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->cod_especif),
                trim($Datos->codigoesp),
                trim($Datos->det_especifica)               
            );
        }        
        return response()->json($Lista);
    }
}
