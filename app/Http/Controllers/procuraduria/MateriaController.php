<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\procuraduria\Materia;

class MateriaController extends Controller
{
    public function index()
    {
        return view('procuraduria/vw_materia');
    }
    public function create(Request $request)
    {

        $Materia = new Materia;
        $Materia->descripcion = strtoupper($request['descripcion']);
        $Materia->save();

        return $Materia->id_materia;
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id_materia, Request $request)
    {
        if ($id_materia > 0) 
        {
            $materia = DB::connection('gerencia_catastro')->table('procuraduria.vw_materia')->where('id_materia',$id_materia)->get();
            return $materia;
        }
        
        if($request['grid']=='materia')
        {
            return $this->cargar_datos_materia($request['descripcion']);
        }
    }
    public function edit($id_materia,Request $request)
    {
        $Materia = new Materia;
        $val=  $Materia::where("id_materia","=",$id_materia )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_materia;

    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    
    public function cargar_datos_materia($descripcion)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_materia where descripcion like '%".strtoupper($descripcion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_materia')->where('descripcion','like', '%'.strtoupper($descripcion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_materia;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_materia),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
}
