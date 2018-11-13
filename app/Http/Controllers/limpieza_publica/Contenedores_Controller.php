<?php

namespace App\Http\Controllers\limpieza_publica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\limpieza_publica\contenedores;

class Contenedores_Controller extends Controller
{
  
    public function index()
    {
        return view('limpieza_publica/vw_contenedores');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id, Request $request)
    {
        if($id==0&&$request['grid']=="contenedores")
        {
            return $this->grid_contenedores($request);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function grid_contenedores(Request $request){
        header('Content-type: application/json');
        $codigo = strtoupper($request['cod']);
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from limpieza_publica.contenedores ");
        $sql = DB::connection('gerencia_catastro')->table('limpieza_publica.contenedores')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
       
        

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
         
            $Lista->rows[$Index]['id'] = $Datos->id_per_barrido;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_per_barrido),
                trim($Datos->dni),
                trim($Datos->ape_pat)." ".trim($Datos->ape_mat)." ".trim($Datos->nombres),
                trim($Datos->telefono),
                '<button class="btn btn-labeled bg-color-red txt-color-white" type="button" onclick="quitar_personal('.trim($Datos->id_per_barrido).')"><span class="btn-label"><i class="fa fa-remove"></i></span> Quitar</button>'

            );
        }

        return response()->json($Lista);

    }
}
