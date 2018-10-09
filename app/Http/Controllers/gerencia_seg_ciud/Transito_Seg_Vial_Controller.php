<?php

namespace App\Http\Controllers\gerencia_seg_ciud;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\gerencia_seg_ciud\ObservSemaforos;
use App\Models\gerencia_seg_ciud\Semaforos;

class Transito_Seg_Vial_Controller extends Controller
{

    public function index(Request $request)
    {
        $tipo_semaforo = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.tipo_semaforo')->get();
        $controlador = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.controlador')->get();
        $estado = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.estado')->get();
        return view('gerencia_seg_ciud/vw_ubicacion_semaforos',compact('tipo_semaforo','controlador','estado'));
    }

    public function show($id,Request $request)
    {
        if ($id > 0) 
        {
            if($request['show']=='semaforos')
            {
                return $this->traer_datos_semaforos($id);
            }
            if ($request['show'] == 'observaciones') 
            {
                return $this->traer_datos_observaciones($id);
            }
        }
        else
        {
            if($request['grid']=='semaforos')
            {
                return $this->cargar_datos_semaforos($request);
            }
            if ($request['grid']=='observaciones') 
            {
                return $this->cargar_datos_observaciones($request);
            }
        }  
    }
    
    public function store(Request $request)
    {
        
    }
    
    public function create(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->agregar_datos_observaciones($request);
        }
    }
    
    public function edit($id,Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->editar_datos_observaciones($id,$request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->editar_datos_semaforos($id,$request);
        }
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->eliminar_observaciones($request);
        }
    }
    
    public function traer_datos_semaforos($id)
    {
        $datos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_semaforos')->where('id_semaforo',$id)->get();
        return $datos;
    }
    
    public function traer_datos_observaciones($id)
    {
        $observaciones = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_semaforos')->where('id_observ_sem',$id)->get();
        return $observaciones;
    }
    
    public function agregar_datos_observaciones(Request $request)
    {
        $ObservSemaforos = new ObservSemaforos;
        $ObservSemaforos->id_semaforo = $request['id_semaforo'];
        $ObservSemaforos->fecha_registro = date('d-m-Y');
        $ObservSemaforos->observaciones  = strtoupper($request['observaciones']); 
        
        $ObservSemaforos->save();
    }
    
    public function editar_datos_observaciones($id_observ_sem,Request $request)
    {
        $ObservSemaforos = new ObservSemaforos;
        $val=  $ObservSemaforos::where("id_observ_sem","=",$id_observ_sem )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observaciones']);
            $val->save();
        }
        return $id_observ_sem;
    }
    
    public function editar_datos_semaforos($id_semaforo,Request $request)
    {
        $Semaforos = new Semaforos;
        $val=  $Semaforos::where("id_semaforo","=",$id_semaforo )->first();
        if($val)
        {
            $val->ubicacion         = strtoupper($request['ubicacion']);
            $val->codigo            = strtoupper($request['codigo']);
            $val->peatonal          = $request['peatonal'];
            $val->id_tipo_semaforo  = $request['id_tipo_semaforo'];
            $val->id_controlador    = $request['id_controlador'];
            $val->id_estado         = $request['id_estado'];
            
            $val->save();
        }
        return $id_semaforo;
    }
    
    public function cargar_datos_semaforos(Request $request)
    {
        header('Content-type: application/json');
        $ubicacion = $request['ubicacion'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_semaforos where ubicacion like '%".strtoupper($ubicacion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_semaforos')->where('ubicacion','like', '%'.strtoupper($ubicacion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_semaforo;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_semaforo),
                trim($Datos->cod_semaforo),
                trim($Datos->ubicacion),
                trim($Datos->cod_controlador),
                trim($Datos->controlador),
                trim($Datos->estado)
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_observaciones(Request $request)
    {
        header('Content-type: application/json');
        $indice = $request['indice'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        if ($indice == 0) {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.observacion_semaforos where id_semaforo = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_semaforos')->where('id_semaforo',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.observacion_semaforos where id_semaforo = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_semaforos')->where('id_semaforo',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
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
            $Lista->rows[$Index]['id'] = $Datos->id_observ_sem;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_observ_sem),
                trim($Datos->fecha_registro),
                trim($Datos->observaciones),
            );
        }
        return response()->json($Lista);
    }
    
    public function eliminar_observaciones(Request $request)
    {
        $ObservSemaforos = new  ObservSemaforos;
        $val=  $ObservSemaforos::where("id_observ_sem","=",$request['id_observ_sem'])->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observ_sem'];
    }
}
