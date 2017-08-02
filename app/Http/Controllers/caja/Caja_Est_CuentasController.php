<?php

namespace App\Http\Controllers\caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class Caja_Est_CuentasController extends Controller
{
    

    public function index()
    {        
        return view('caja/vw_caja_est_cuentas');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
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
    
    function caja_est_cuentas(Request $request){
        $id_pers = $request['id_pers'];
        $totalg = DB::select("select count(cod) as total from adm_tri.estado_cuentas_vlady where id_pers='".$id_pers."'");
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

        $sql = DB::table('adm_tri.estado_cuentas_vlady')->where('id_pers',$id_pers)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        foreach ($sql as $Index => $Datos) {            
            $Lista->rows[$Index]['id'] = $Datos->cod;
            $Lista->rows[$Index]['cell'] = array(
                $Datos->cod,
                trim($Datos->id_pers),
                trim($Datos->ano_cta),
                trim($Datos->trim),                
                trim($Datos->descrip_tributo),                
                trim($Datos->cuota),
                trim($Datos->abono),
                trim($Datos->fecha),
                trim($Datos->total)               
            );
        }        
        return response()->json($Lista);
    }
}
