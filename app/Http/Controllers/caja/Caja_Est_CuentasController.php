<?php

namespace App\Http\Controllers\caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Traits\DatesTranslator;

class Caja_Est_CuentasController extends Controller
{
    use DatesTranslator;

    public function index()
    {     
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('caja/vw_caja_est_cuentas',compact('anio'));
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
        $desde = $request['desde'];
        $hasta = $request['hasta'];
        $totalg = DB::select("select count(id_contrib) as total from adm_tri.estado_cuentas_vlady where id_contrib='".$id_pers."' and ano_cta between ".$desde." and ".$hasta);
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

        $sql = DB::table('adm_tri.estado_cuentas_vlady')->where('id_contrib',$id_pers)->whereBetween('ano_cta',[$desde,$hasta])
                ->orderBy($sidx, $sord)->orderBy('trim','asc')->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        $cc=0;
        foreach ($sql as $Index => $Datos) {  
            $cc++;
            $Lista->rows[$Index]['id'] = $cc;
            $Lista->rows[$Index]['cell'] = array(
                $cc,
                trim($Datos->id_contrib),
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
    
    function print_est_cta_contrib($id_contrib,$desde,$hasta){
        $fracc="";
        $contrib=DB::select('select * from adm_tri.vw_contribuyentes where id_contrib='.$id_contrib);
        $convenio=DB::select('select * from fraccionamiento.vw_convenios where id_contribuyente='.$id_contrib);
        if(count($convenio) > 1){
            $fracc = DB::select("select * from fraccionamiento.detalle_convenio where id_conv_mtr=".$convenio[0]->id_conv." order by nro_cuota");
        }        
//        dd($fracc);
        $fecha_larga = mb_strtoupper($this->getCreatedAtAttribute(date('d-m-Y'))->format('l, d \d\e F \d\e\l Y'));
        $arb = DB::select('select * from arbitrios.vw_cta_arbi_x_trim where id_contrib='.$id_contrib.' and anio between '.$desde.' and '.$hasta);
        $pred = DB::select('select * from adm_tri.vw_cta_cte2 where id_contrib='.$id_contrib.' and ano_cta between '.$desde.' and '.$hasta);
        
        $view = \View::make('caja.reportes.est_cta_contrib',compact('contrib','fecha_larga','arb','pred','desde','hasta','convenio','fracc'))->render();
//        return $view;
        $pdf = \App::make('dompdf.wrapper');            
        $pdf->loadHTML($view)->setPaper('a4','landscape');
        return $pdf->stream();
    }
}
