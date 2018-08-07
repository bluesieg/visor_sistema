<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\procuraduria\Caso;

class CasoController extends Controller
{
    public function index()
    {
        return view('procuraduria/vw_caso');
    }
    public function create(Request $request)
    {

        $Caso = new Caso;
        $Caso->descripcion = strtoupper($request['descripcion']);
        $Caso->save();

        return $Caso->id_caso;
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id_caso, Request $request)
    {
        if ($id_caso > 0) 
        {
            $casos = DB::connection('gerencia_catastro')->table('procuraduria.vw_casos')->where('id_caso',$id_caso)->get();
            return $casos;
        }
        
        if($request['grid']=='casos')
        {
            return $this->cargar_datos_caso($request['descripcion']);
        }
    }
    public function edit($id_caso,Request $request)
    {
        $Caso = new Caso;
        $val=  $Caso::where("id_caso","=",$id_caso )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_caso;

    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    
    public function cargar_datos_caso($descripcion)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_casos where descripcion like '%".strtoupper($descripcion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_casos')->where('descripcion','like', '%'.strtoupper($descripcion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_caso;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_caso),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
}
