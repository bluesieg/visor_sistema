<?php

namespace App\Http\Controllers\presupuesto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\presupuesto\EspecificaDetalle;

class Esp_DetalleController extends Controller
{
    public function index(){
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('presupuesto/vw_especif_det',compact('anio'));
    }

    public function create(Request $request){
        $data = new EspecificaDetalle();
        $data->id_espec = $request['id_espec'];
        $data->cod_esp_det =$request['cod'];
        $data->desc_espec_detalle = $request['desc'];
        $data->save();
        return $data->id_espec_det;
    }

    public function edit(Request $request,$id){
        $data = new EspecificaDetalle();
        $val = $data::where("id_espec_det", "=", $id)->first();
        if (count($val) >= 1) {
            $val->desc_espec_detalle=$request['desc'];
            $val->save();  
            return $val->id_espec_det;
        }
    }
    public function destroy(Request $request,$id){
        $data = new EspecificaDetalle();
        $val=  $data::where("id_espec_det","=",$request['id'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
            return $val->id_espec_det;
        }
    }
    
    function get_esp_detalle(Request $request){
        $anio =  $request['anio'];
        $id_espec =  $request['id_espec'];
        $totalg = DB::select("select count(id_espec_det) as total from presupuesto.vw_especif_detalle where anio=".$anio." and id_espec=".$id_espec);
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

        $sql = DB::table('presupuesto.vw_especif_detalle')->where('anio',$anio)->where('id_espec',$id_espec)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_espec_det;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->cod_esp_det),
                trim($Datos->codigo),
                trim($Datos->desc_espec_detalle)               
            );
        }        
        return response()->json($Lista);
    }
}
