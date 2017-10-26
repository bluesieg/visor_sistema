<?php

namespace App\Http\Controllers\presupuesto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\presupuesto\SubGenerica;
use Illuminate\Support\Facades\Auth;

class SubGenericaController extends Controller
{
    public function index(){
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_pres_subgen' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('presupuesto/vw_subgenerica',compact('anio','menu','permisos'));
    }

    public function create(Request $request){
        $data = new SubGenerica();
        $data->id_gener = $request['id_gener'];
        $data->cod_sub_generica =$request['subgen_cod'];
        $data->desc_sub_gen = $request['subgen_desc'];
        $data->save();
        return $data->id_sub_gen;
    }

    public function store(Request $request){}

    public function show($id){}

    public function edit(Request $request,$id) {
        $data = new SubGenerica();        
        $val = $data::where("id_sub_gen", "=", $id)->first();
        if (count($val) >= 1) {
            $val->desc_sub_gen=$request['subgen_desc'];
            $val->save();  
            return $val->id_sub_gen;
        }
    }

    public function update(Request $request, $id){}

    public function destroy(Request $request,$id){
        $data = new SubGenerica;
        $val=  $data::where("id_sub_gen","=",$request['id'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
            return $val->id_sub_gen;
        }
    }
    
    function get_subgenerica(Request $request){
        $anio =  $request['anio'];
        $id_gener =  $request['id_gener'];
        $totalg = DB::select("select count(id_sub_gen) as total from presupuesto.sub_generica_anio where anio=".$anio." and id_gener=".$id_gener);
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

        $sql = DB::table('presupuesto.sub_generica_anio')->where('anio',$anio)->where('id_gener',$id_gener)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_sub_gen;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->codigo),
                trim($Datos->desc_sub_gen)               
            );
        }        
        return response()->json($Lista);
    }
}
