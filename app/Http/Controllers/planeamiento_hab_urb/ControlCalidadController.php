<?php

namespace App\Http\Controllers\planeamiento_hab_urb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroExpedientes;
use App\Models\Notificaciones;
use App\Models\AsignarExpediente;


class ControlCalidadController extends Controller
{

    public function index()
    {
      
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        $anio1 = DB::select('select anio from adm_tri.uit order by anio asc');
        
        return view('planeamiento_hab_urb/vw_constancia_posesion',compact('anio','anio1'));
    }
    
    public function getExpedientes_ControlCalidad(Request $request){
        header('Content-type: application/json');
        $fecha_desde = $request['fecha_desde'];
        $fecha_hasta = $request['fecha_hasta'];
        
        $check = $request['check'];
        if ($check == '1') {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_const_posesion.vw_expedientes where fase = 10");
        }else{
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_const_posesion.vw_expedientes where fecha_registro between '$fecha_desde' and '$fecha_hasta' and fase = 2");
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
            $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_expedientes')->whereBetween('fecha_registro', [$fecha_desde, $fecha_hasta])->where('fase',10)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }else{
            $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_expedientes')->whereBetween('fecha_registro', [$fecha_desde, $fecha_hasta])->where('fase',2)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }

        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_reg_exp),
                trim($Datos->nro_expediente),
                trim($Datos->gestor),
                trim($Datos->fecha_inicio_tramite),
                trim($Datos->fecha_registro),
                trim($Datos->fase)
            );
        }

        return response()->json($Lista);

    }
    
    public function asignar_expediente(Request $request){
            $AsignarExpediente = new  AsignarExpediente;
            $AsignarExpediente->id_reg_exp = $request['id_control_calidad'];
            $AsignarExpediente->id_inspec = $request['inspector'];
            $AsignarExpediente->estado = 0;
            $AsignarExpediente->save();
            $this->asignar_inspeccion($AsignarExpediente->id_reg_exp);
    }
    
    public function asignar_inspeccion($id_reg_exp){
            $RegistroExpedientes = new  RegistroExpedientes;
            $val=  $RegistroExpedientes::where("id_reg_exp","=",$id_reg_exp )->first();
            if(count($val)>=1)
            {
                $val->fase = 3;
                $val->save();
            }
            return $id_reg_exp;
    }
    
    public function registrar_notificacion(Request $request){
            
            $Notificaciones = new  Notificaciones;
            $Notificaciones->cod_expediente = $request['nro_expediente'];
            $Notificaciones->notificacion = $request['notificacion'];
            $Notificaciones->save();
            $this->modificar_fase($Notificaciones->cod_expediente);
            
    }
    
    public function modificar_fase($cod_expediente){ 
            $RegistroExpedientes = new  RegistroExpedientes;
            $val=  $RegistroExpedientes::where("nro_expediente","=",$cod_expediente)->first();
            if(count($val)>=1)
            {
                $val->fase = 10;
                $val->save();
            }
            return $cod_expediente;
    }
    
    public function actualizar_expediente(Request $request){
            $RegistroExpedientes = new  RegistroExpedientes;
            $val=  $RegistroExpedientes::where("id_reg_exp","=",$request['id_control_calidad'] )->first();
            if(count($val)>=1)
            {
                $val->fase = 2;
                $val->save();
            }
            return $request['id_control_calidad'];
    }
    
    public function traer_inspecciones(Request $request){
        header('Content-type: application/json');

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_const_posesion.vw_asig_exped");
        
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

 
        $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_asig_exped')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_reg_exp),
                trim($Datos->nro_expediente),
                trim($Datos->gestor),
                trim($Datos->apenom)
            );
        }

        return response()->json($Lista);

    }
    
    public function recuperar_expediente(Request $request){
            $AsignarExpediente = new AsignarExpediente;
            $val=  $AsignarExpediente::where("id_reg_exp","=",$request['id_reg_exp'] )->first();
            if(count($val)>=1)
            {
                $val->delete();
            }
            $this->recuperar_expediente_inspeccion($request['id_reg_exp']);
    }
    
    public function recuperar_expediente_inspeccion($id_reg_exp){
            $RegistroExpedientes = new  RegistroExpedientes;
            $val=  $RegistroExpedientes::where("id_reg_exp","=",$id_reg_exp )->first();
            if(count($val)>=1)
            {
                $val->fase = 2;
                $val->save();
            }
            return $id_reg_exp;
    }
}
