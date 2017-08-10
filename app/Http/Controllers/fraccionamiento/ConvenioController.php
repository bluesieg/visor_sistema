<?php

namespace App\Http\Controllers\fraccionamiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Convenio;

class ConvenioController extends Controller
{

    public function index(){
        $cfracc=DB::table('fraccionamiento.config_fraccionamiento')->get();
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        $tip_f= DB::select('select * from fraccionamiento.tipo_fracc');
        return view('fraccionamiento/vw_conve_fracc',compact('anio','cfracc','tip_f'));
    }

    public function create(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $data = new Convenio();
        $data->nro_convenio     = $request['nro_convenio'];
        $data->anio             = date('Y');
        $data->cod_convenio     = $request['cod_convenio'];
        $data->id_contribuyente = $request['id_contribuyente'];
        $data->fec_reg          = date('d-m-Y');
        $data->interes          = $request['interes'];
        $data->nro_cuotas       = $request['nro_cuotas'];        
        $data->total_convenio   = $request['total_convenio'];
        $data->estado           = $request['estado'];
        $data->detalle_fracci   = $request['detalle_fracci'];
        $data->period_desde     = $request['period_desde'];
        $data->period_hast      = $request['period_hast'];
        $data->porc_cuo_inic    = $request['porc_cuo_inic'];
        $data->cuota_inicial    = $request['cuota_inicial'];
        $data->save();        
        return $data->cod_convenio;
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
    
    function list_deuda_contrib(Request $request){
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
    
    function grid_all_convenios(Request $request){
        $anio = $request['anio'];
        
        $totalg = DB::select("select count(id_conv) as total from fraccionamiento.vw_convenios where anio='".$anio."'");
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

        $sql = DB::table('fraccionamiento.vw_convenios')->where('anio',$anio)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        foreach ($sql as $Index => $Datos) {            
            $Lista->rows[$Index]['id'] = $Datos->id_conv;
            $Lista->rows[$Index]['cell'] = array(
                $Datos->nro_convenio,
                trim($Datos->anio),                
                $Datos->id_contribuyente,
                $Datos->fec_reg,
                $Datos->interes,
                $Datos->nro_cuotas,
                trim($Datos->est_actual),
                $Datos->total_convenio
            );
        }        
        return response()->json($Lista);
    }
    
    function crono_pago_fracc(Request $request){
        $cod_conv_det=$request['cod_conv_det'];
        $id_contrib=$request['id_contrib'];
        $amo=0;$inter=0;$cc=0;
        date_default_timezone_set('America/Lima');
        $contrib=DB::select('select * from adm_tri.vw_contribuyentes where id_pers='.$id_contrib);
        $conv = DB::select('select * from fraccionamiento.vw_convenios where id_contribuyente='.$id_contrib);
        
        $conv_det = DB::select("select * from fraccionamiento.vw_trae_cuota_conv where cod_conv_det='".$cod_conv_det."' order by nro_cuota asc");
                
        $todo = array();
        foreach ($conv_det as $Datos) {
            $Lista = new \stdClass();
            $Lista->nro_cuot = $Datos->nro_cuota;
            $Lista->saldo = number_format($Datos->saldo,2,'.','');
            $Lista->amor = number_format($Datos->monto,2,'.','');
            $amo=$amo+number_format($Datos->monto,2,'.','');
            $Lista->inter =  number_format($Datos->interes,2,'.','');
            $inter=$inter+number_format($Datos->interes,2,'.','');
            $Lista->total =  number_format($Datos->total,2,'.','');
            $cc=$cc+number_format($Datos->total,2,'.','');
            $fecha=explode("-", $Datos->fec_pago);
        $mes=$fecha[1];
        switch ($mes) {
            case '01':
                $fecha[1]='ene';
                break;
            case '02':
                $fecha[1]='feb';
                break;
            case '03':
                $fecha[1]='mar';
                break;
            case '04':
                $fecha[1]='abr';
                break;
            case '05':
                $fecha[1]='may';
                break;
            case '06':
                $fecha[1]='jun';
                break;
            case '07':
                $fecha[1]='jul';
                break;
            case '08':
                $fecha[1]='ago';
                break;
            case '09':
                $fecha[1]='sep';
                break;
            case '10':
                $fecha[1]='oct';
                break;
            case '11':
                $fecha[1]='nov';
                break;
            case '12':
                $fecha[1]='dic';
                break;
        }
        
            $Lista->fec_pago = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
            array_push($todo, $Lista);
        }
        $totales=array();
        $totales['tot_amo']=$amo;
        $totales['tot_inter']=$inter;
        $totales['tot_cc']=$cc;
        $fecha_larga = $this->fecha_letras(date('d-m-Y'));
        $view = \View::make('fraccionamiento.reporte.cronogramaPagos',compact('contrib','conv','todo','fecha_larga','totales'))->render();
//        return $view;

        $pdf = \App::make('dompdf.wrapper');            
        $pdf->loadHTML($view)->setPaper('a4');
        return $pdf->stream();            

    }
    
    public function fecha_letras($date){
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        
        $timestamp=strtotime($date);
        return $dias[date('w',$timestamp)].", ".date('d',$timestamp)." de ".$meses[date('n',$timestamp)-1]. " del ".date('Y',$timestamp);
    }
}
