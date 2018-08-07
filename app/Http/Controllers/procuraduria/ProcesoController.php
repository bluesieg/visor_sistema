<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\procuraduria\Proceso;

class ProcesoController extends Controller
{
    public function index()
    {
        return view('procuraduria/vw_proceso');
    }
    public function create(Request $request)
    {

        $Proceso = new Proceso;
        $Proceso->descripcion = strtoupper($request['descripcion']);
        $Proceso->save();

        return $Proceso->id_proceso;
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id_proceso, Request $request)
    {
        if ($id_proceso > 0) 
        {
            $proceso = DB::connection('gerencia_catastro')->table('procuraduria.vw_proceso')->where('id_proceso',$id_proceso)->get();
            return $proceso;
        }
        
        if($request['grid']=='proceso')
        {
            return $this->cargar_datos_procesos($request['descripcion']);
        }
    }
    public function edit($id_proceso,Request $request)
    {
        $Proceso = new Proceso;
        $val=  $Proceso::where("id_proceso","=",$id_proceso )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_proceso;

    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    
    public function cargar_datos_procesos($descripcion)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_proceso where descripcion like '%".strtoupper($descripcion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_proceso')->where('descripcion','like', '%'.strtoupper($descripcion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        foreach ($sql as $Index => $Datos) {                
            $Lista->rows[$Index]['id'] = $Datos->id_proceso;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_proceso),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
}
