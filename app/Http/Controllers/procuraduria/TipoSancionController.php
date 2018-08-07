<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\procuraduria\TipoSancion;

class TipoSancionController extends Controller
{
    public function index()
    {
        return view('procuraduria/vw_tipo_sancion');
    }
    public function create(Request $request)
    {

        $TipoSancion = new TipoSancion;
        $TipoSancion->descripcion = strtoupper($request['descripcion']);
        $TipoSancion->save();

        return $TipoSancion->id_tipo_sancion ;
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id_tipo_sancion, Request $request)
    {
        if ($id_tipo_sancion > 0) 
        {
            $tipo_sancion = DB::connection('gerencia_catastro')->table('procuraduria.vw_tipo_sancion')->where('id_tipo_sancion',$id_tipo_sancion)->get();
            return $tipo_sancion;
        }
        
        if($request['grid']=='tipo_sancion')
        {
            return $this->cargar_datos_tipo_sancion($request['descripcion']);
        }
    }
    public function edit($id_tipo_sancion,Request $request)
    {
        $TipoSancion = new TipoSancion;
        $val=  $TipoSancion::where("id_tipo_sancion","=",$id_tipo_sancion )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_tipo_sancion;

    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    
    public function cargar_datos_tipo_sancion($descripcion)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_tipo_sancion where descripcion like '%".strtoupper($descripcion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_tipo_sancion')->where('descripcion','like', '%'.strtoupper($descripcion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_tipo_sancion;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_tipo_sancion),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
}
