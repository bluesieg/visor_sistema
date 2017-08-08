<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE Illuminate\Support\Facades\DB;

class ConvenioController extends Controller
{

    public function index(){
        $cfracc=DB::table('fraccionamiento.config_fraccionamiento')->get();
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('adm_tributaria/vw_conve_fracc',compact('anio','cfracc'));
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
    
    function list_deuda_contrib(){
        header('Content-type: application/json');
        $totalg = 2;
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        $total_pages = 0;
        if (!$sidx) {
            $sidx = 1;
        }
        $count = $totalg;
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        }
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $sql = DB::select("select 'Arbitrios' as tipo, 
            sum(deuda_arb) as deuda_arb, anio::character(4) from arbitrios.vw_cta_arbitrios where id_contri=138 
            group by anio
            union
            select 'Predial' as tipo,ivpp, ano_cta as anio from adm_tri.vw_contrib_hr2 
            where id_pers=138");
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->tipo;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->tipo),   
                trim($Datos->deuda_arb),   
                trim($Datos->anio),
                "<input type='checkbox' name='chk_c_f' onclick='check_tot_fracc(".$Datos->deuda_arb.",this)'>",
            );
        }
        return response()->json($Lista);
    }
}
