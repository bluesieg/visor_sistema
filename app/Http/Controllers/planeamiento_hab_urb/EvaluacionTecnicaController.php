<?php

namespace App\Http\Controllers\planeamiento_hab_urb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroExpedientes;
use App\Models\Notificaciones;


class EvaluacionTecnicaController extends Controller
{

    public function index()
    {
      
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        $anio1 = DB::select('select anio from adm_tri.uit order by anio asc');
        $tip_sol = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.tipo_solictud');
        $inspectores = DB::connection('gerencia_catastro')->select('select id_inspector,apenom from soft_const_posesion.inspectores order by id_inspector');
        return view('planeamiento_hab_urb/vw_constancia_posesion',compact('anio','anio1','tip_sol','inspectores'));
    }
    
    public function get_evaluacion_tecnica(Request $request){
        header('Content-type: application/json');
        $fecha_desde = $request['fecha_ini_eva_tecnica'];
        $fecha_hasta = $request['fecha_fin_eva_tecnica'];
        
        $check = $request['check'];
        if ($check == '1') {
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_const_posesion.vw_exped_para_evaluacion where fch_inspeccion between '$fecha_desde' and '$fecha_hasta' and fase = 13");    
        }
        else{
           $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_const_posesion.vw_exped_para_evaluacion where fch_inspeccion between '$fecha_desde' and '$fecha_hasta' and fase in(5,6)"); 
        }
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

     
        if ($check == '1') {
            $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_exped_para_evaluacion')->whereBetween('fch_inspeccion', [$fecha_desde, $fecha_hasta])->where('fase',13)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else{
            $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_exped_para_evaluacion')->whereBetween('fch_inspeccion', [$fecha_desde, $fecha_hasta])->whereIn('fase', array(5,6))->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_reg_exp),
                trim($Datos->fch_inspeccion),
                trim($Datos->nro_expediente),
                trim($Datos->gestor),
                trim($Datos->fecha_registro),
                trim($Datos->fase)
            );
        }

        return response()->json($Lista);

    }
    
    public function actualizar_informe(Request $request){
            $RegistroExpedientes = new  RegistroExpedientes;
            $val=  $RegistroExpedientes::where("id_reg_exp","=",$request['id_reg_exp'])->first();
            if(count($val)>=1)
            {
                $val->nro_informe = $request['inp_aprob_expe'];
                $val->fase = 6;
                $val->save();
            }
            return $request['id_reg_exp'];
    }
    
    public function registrar_notificacion_eva_tec(Request $request){
            
            $Notificaciones = new  Notificaciones;
            $Notificaciones->cod_expediente = $request['cod_expediente'];
            $Notificaciones->notificacion = $request['notificacion'];
            $Notificaciones->save();
            //$this->modificar_fase($Notificaciones->cod_expediente);    
    }
    
    public function rep_constancia($id){
            
        $sql=DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_report_constan')->where('id_reg_exp',$id)->orderBy('id_reg_exp')->get();     
        $institucion = DB::select('SELECT * FROM maysa.institucion');
        $parametros = DB::connection('gerencia_catastro')->select('SELECT informe_base FROM soft_const_posesion.parametros');
        if(count($sql)>=1)
        {
            $view =  \View::make('planeamiento_hab_urb.reportes.reporte_constancia', compact('sql','institucion','parametros'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("Reporte Constancia".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }
    
}
