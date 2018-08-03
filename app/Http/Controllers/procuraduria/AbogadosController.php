<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\procuraduria\Abogados;

class AbogadosController extends Controller
{
    public function index()
    {
        return view('procuraduria/vw_abogados');
    }
    public function create(Request $request)
    {
        $select=DB::connection('gerencia_catastro')->table('procuraduria.vw_abogados')->where('dni',$request['dni'])->get(); 
        if (count($select)>0) {

             return response()->json([
                'msg' => 'repetido',
                ]);

        }else{
            $Abogados = new Abogados;
            $Abogados->dni = $request['dni'];
            $Abogados->nombre = strtoupper($request['nombre']);
            $Abogados->save();

            return $Abogados->id_abogado;
        }
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id_abogado, Request $request)
    {
        if($request['grid']=='abogados')
        {
            return $this->cargar_datos_abogados();
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
    
    public function cargar_datos_abogados()
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_abogados");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_abogados')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_abogado;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_abogado),
                trim($Datos->dni),
                trim($Datos->nombre),   
            );
        }
        return response()->json($Lista);
    }
}
