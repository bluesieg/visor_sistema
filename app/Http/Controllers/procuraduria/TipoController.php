<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\procuraduria\Tipo;

class TipoController extends Controller
{
    public function index()
    {
        return view('procuraduria/vw_tipo');
    }
    public function create(Request $request)
    {

        $Tipo = new Tipo;
        $Tipo->descripcion = strtoupper($request['descripcion']);
        $Tipo->save();

        return $Tipo->id_tipo ;
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id_tipo, Request $request)
    {
        if ($id_tipo > 0) 
        {
            $tipo= DB::connection('gerencia_catastro')->table('procuraduria.vw_tipos')->where('id_tipo',$id_tipo)->get();
            return $tipo;
        }
        
        if($request['grid']=='tipos')
        {
            return $this->cargar_datos_tipos($request['descripcion']);
        }
    }
    public function edit($id_tipo,Request $request)
    {
        $Tipo = new Tipo;
        $val=  $Tipo::where("id_tipo","=",$id_tipo )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_tipo;

    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    
    public function cargar_datos_tipos($descripcion)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_tipos where descripcion like '%".strtoupper($descripcion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_tipos')->where('descripcion','like', '%'.strtoupper($descripcion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_tipo;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_tipo),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
}
