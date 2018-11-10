<?php

namespace App\Http\Controllers\gerencia_seg_ciud;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\gerencia_seg_ciud\Plan;
use App\Models\gerencia_seg_ciud\ZonaRiesgo;
use App\Models\gerencia_seg_ciud\ObservAtenEmergencia;
use App\Models\gerencia_seg_ciud\AtencionEmergencia;
use App\Models\gerencia_seg_ciud\ObservCtrZonaRiesgo;
use App\Models\gerencia_seg_ciud\CtrZonaRiesgo;

class Riesgos_Desastres_Controller extends Controller
{

    public function index(Request $request)
    {
        if ($request['tipo']=='zona_riesgo') 
        {
            $riesgos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.tipo_riesgo')->get();
            return view('gerencia_seg_ciud.vw_zonas_riesgo', compact('riesgos'));
        }
        if ($request['tipo']=='atencion_emergencia') 
        {
            $desastres = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.tipo_desastre')->get();
            return view('gerencia_seg_ciud.vw_atencion_emergencia', compact('desastres'));
        }
        if ($request['tipo']=='ctr_zona_riesgo') 
        {
            $tipo_riesgo = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.ctr_tip_riesgo')->get();
            return view('gerencia_seg_ciud.vw_ctr_zona_riesgo', compact('tipo_riesgo'));
        }
    }

    public function show($id,Request $request)
    {
        if ($id > 0) 
        {
            if($request['show']=='mapa_delito')
            {
                return $this->traer_datos_zona_riesgo($id);
            }
            if($request['show']=='traer_datos_const_zona_riesgo')
            {
                return $this->traer_datos_const_zona_riesgo($id);
            }
            if ($request['show'] == 'observaciones') 
            {
                return $this->traer_datos_observaciones($id);
            }
            if($request['show']=='atencion_emergencia')
            {
                return $this->traer_datos_atencion_emergencia($id);
            }
            if ($request['show'] == 'observaciones_aemer') 
            {
                return $this->traer_datos_observaciones_aemergencia($id);
            }
            if ($request['show'] == 'observaciones_ctr_zona_riesgo') 
            {
                return $this->traer_datos_observaciones_ctr_zona_riesgo($id);
            }
        }
        else
        {
            if($request['grid']=='zona_riesgo')
            {
                return $this->cargar_datos_zona_riesgo($request);
            }
            if ($request['grid']=='observaciones') 
            {
                return $this->cargar_datos_observaciones($request);
            }
            if($request['grid']=='atencion_emergencia')
            {
                return $this->cargar_datos_atencion_emergencia($request);
            }
            if ($request['grid']=='observaciones_aemergencia') 
            {
                return $this->cargar_datos_observaciones_emergencia($request);
            }
            if ($request['grid']=='ctr_zona_riesgo') 
            {
                return $this->cargar_datos_const_zona_riesgo($request);
            }
            if ($request['grid']=='observaciones_ctr_zona_riesgo') 
            {
                return $this->cargar_datos_observaciones_ctr_zona_riesgo($request);
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
        if ($request['tipo'] == 2) 
        {
            return $this->agregar_datos_observaciones_aemergencia($request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->agregar_datos_observaciones_ctr_zona_riesgo($request);
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
            return $this->editar_datos_zona_riesgo($id,$request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->editar_datos_observaciones_aemergencia($id,$request);
        }
        if ($request['tipo'] == 4) 
        {
            return $this->editar_datos_atencion_emergencia($id,$request);
        }
        if ($request['tipo'] == 5) 
        {
            return $this->editar_datos_observaciones_ctr_zona_riesgo($id,$request);
        }
        if ($request['tipo'] == 6) 
        {
            return $this->editar_datos_ctr_zona_riesgo($id,$request);
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
        if ($request['tipo'] == 2) 
        {
            return $this->eliminar_observ_aemergencia($request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->eliminar_observ_ctr_zona_riesgo($request);
        }
    }
    
    public function traer_datos_zona_riesgo($id)
    {
        $datos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_zona_riesgo')->where('id_zona_riesgo',$id)->get();
        return $datos;
    }
    
    public function traer_datos_observaciones($id)
    {
        $observaciones = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.plan')->where('id_plan',$id)->get();
        return $observaciones;
    }
    
    public function traer_datos_atencion_emergencia($id)
    {
        $datos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_atencion_emergencia')->where('id_atencion_emer',$id)->get();
        return $datos;
    }
    
    public function traer_datos_observaciones_aemergencia($id)
    {
        $datos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_aemergencia')->where('id_observ_emer',$id)->get();
        return $datos;
    }
    
    public function traer_datos_observaciones_ctr_zona_riesgo($id)
    {
        $datos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_constr_zona_riesgo')->where('id_observ_ctr_zon_rg',$id)->get();
        return $datos;
    }
    
    public function traer_datos_const_zona_riesgo($id)
    {
        $datos = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_ctr_zona_riesgo')->where('id_ctr_zon_rg',$id)->get();
        return $datos;
    }
    
    public function cargar_datos_observaciones_emergencia(Request $request)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.observacion_aemergencia where id_atencion_emer = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_aemergencia')->where('id_atencion_emer',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.observacion_aemergencia where id_atencion_emer = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_aemergencia')->where('id_atencion_emer',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $Lista->rows[$Index]['id'] = $Datos->id_observ_emer;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_observ_emer),
                trim($Datos->fecha_registro),
                trim($Datos->observaciones),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_atencion_emergencia(Request $request)
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
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_atencion_emergencia where ubicacion like '%".strtoupper($ubicacion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_atencion_emergencia')->where('ubicacion','like', '%'.strtoupper($ubicacion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_atencion_emer;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_atencion_emer),
                trim($Datos->nro_doc_persona),
                trim($Datos->persona),
                trim($Datos->ubicacion),
                trim($Datos->descripcion),
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.plan where id_zona_riesgo = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.plan')->where('id_zona_riesgo',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.plan where id_zona_riesgo = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.plan')->where('id_zona_riesgo',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $Lista->rows[$Index]['id'] = $Datos->id_plan;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_plan),
                trim($Datos->fecha_registro),
                trim($Datos->plan_contin),
                trim($Datos->observaciones),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_const_zona_riesgo(Request $request)
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
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_ctr_zona_riesgo where ubicacion like '%".strtoupper($ubicacion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_ctr_zona_riesgo')->where('ubicacion','like', '%'.strtoupper($ubicacion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_ctr_zon_rg;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_ctr_zon_rg),
                trim($Datos->nro_doc_propietario),
                trim($Datos->propietario),
                trim($Datos->ubicacion),
                trim($Datos->desripcion),
                trim($Datos->notificacion),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_zona_riesgo(Request $request)
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
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.vw_zona_riesgo where ubicacion like '%".strtoupper($ubicacion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.vw_zona_riesgo')->where('ubicacion','like', '%'.strtoupper($ubicacion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_zona_riesgo;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_zona_riesgo),
                trim($Datos->nro_doc_propietario),
                trim($Datos->propietario),
                trim($Datos->ubicacion),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_observaciones_ctr_zona_riesgo(Request $request)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.observacion_constr_zona_riesgo where id_ctr_zon_rg = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_constr_zona_riesgo')->where('id_ctr_zon_rg',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_seg_ciudadana.observacion_constr_zona_riesgo where id_ctr_zon_rg = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_seg_ciudadana.observacion_constr_zona_riesgo')->where('id_ctr_zon_rg',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $Lista->rows[$Index]['id'] = $Datos->id_observ_ctr_zon_rg;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_observ_ctr_zon_rg),
                trim($Datos->fecha_registro),
                trim($Datos->observaciones),
            );
        }
        return response()->json($Lista);
    }
    
    public function agregar_datos_observaciones(Request $request)
    {
        $Plan = new Plan;
        $Plan->id_zona_riesgo = $request['id_zona_riesgo'];
        $Plan->fecha_registro = date('d-m-Y');
        $Plan->plan_contin    = strtoupper($request['plan_contingencia']); 
        $Plan->observaciones  = strtoupper($request['observaciones']); 
        
        $Plan->save();
    }
    
    public function agregar_datos_observaciones_aemergencia(Request $request)
    {
        $ObservAtenEmergencia = new ObservAtenEmergencia;
        $ObservAtenEmergencia->id_atencion_emer = $request['id_atencion_riesgo'];
        $ObservAtenEmergencia->fecha_registro   = date('d-m-Y');
        $ObservAtenEmergencia->observaciones    = strtoupper($request['observaciones']); 
        
        $ObservAtenEmergencia->save();
    }
    
    public function agregar_datos_observaciones_ctr_zona_riesgo(Request $request)
    {
        $ObservCtrZonaRiesgo = new ObservCtrZonaRiesgo;
        $ObservCtrZonaRiesgo->id_ctr_zon_rg = $request['id_const_zona_riesgo'];
        $ObservCtrZonaRiesgo->fecha_registro   = date('d-m-Y');
        $ObservCtrZonaRiesgo->observaciones    = strtoupper($request['observaciones']); 
        $ObservCtrZonaRiesgo->usuario          = Auth::user()->id;
        
        $ObservCtrZonaRiesgo->save();
    }
    
    public function editar_datos_observaciones($id_plan,Request $request)
    {
        $Plan = new Plan;
        $val=  $Plan::where("id_plan","=",$id_plan )->first();
        if($val)
        {
            $val->plan_contin = strtoupper($request['plan_contingencia']);
            $val->observaciones = strtoupper($request['observaciones']);
            $val->save();
        }
        return $id_plan;
    }
    
    public function editar_datos_zona_riesgo($id_zona_riesgo, Request $request)
    {
        $ZonaRiesgo = new ZonaRiesgo;
        $val=  $ZonaRiesgo::where("id_zona_riesgo","=",$id_zona_riesgo )->first();
        if($val)
        {
            $val->ubicacion             = strtoupper($request['ubicacion']);
            $val->id_pers_responsable   = $request['id_pers_responsable'];
            $val->id_tipo_riesgo        = $request['tipo_riesgo'];
            $val->save();
        }
        return $id_zona_riesgo;
    }
    
    public function editar_datos_atencion_emergencia($id_atencion_emer, Request $request)
    {
        $AtencionEmergencia = new AtencionEmergencia;
        $val=  $AtencionEmergencia::where("id_atencion_emer","=",$id_atencion_emer )->first();
        if($val)
        {
            $val->ubicacion             = strtoupper($request['ubicacion']);
            $val->id_pers               = $request['id_pers'];
            $val->nro_fallecidos        = $request['nro_fallecidos'];
            $val->nro_accidentados      = $request['nro_accidentados'];
            $val->id_tipo_desastre      = $request['tipo_desastre'];
            $val->save();
        }
        return $id_atencion_emer;
    }
    
    public function editar_datos_observaciones_aemergencia($id_observ_emer, Request $request)
    {
        $ObservAtenEmergencia = new ObservAtenEmergencia;
        $val=  $ObservAtenEmergencia::where("id_observ_emer","=",$id_observ_emer )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observaciones']);
            $val->save();
        }
        return $id_observ_emer;
    }
    
    public function editar_datos_observaciones_ctr_zona_riesgo($id_observ_ctr_zon_rg, Request $request)
    {
        $ObservCtrZonaRiesgo = new ObservCtrZonaRiesgo;
        $val=  $ObservCtrZonaRiesgo::where("id_observ_ctr_zon_rg","=",$id_observ_ctr_zon_rg )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observaciones']);
            $val->save();
        }
        return $id_observ_ctr_zon_rg;
    }
    
    public function editar_datos_ctr_zona_riesgo($id_ctr_zon_rg, Request $request)
    {
        $CtrZonaRiesgo = new CtrZonaRiesgo;
        $val=  $CtrZonaRiesgo::where("id_ctr_zon_rg","=",$id_ctr_zon_rg )->first();
        if($val)
        {
            $val->ubicacion             = strtoupper($request['ubicacion']);
            $val->id_pers_propietario   = $request['id_propietario'];
            $val->notificacion        = strtoupper($request['notificacion']);
            $val->id_ctr_tip_riesgo      = $request['sel_tipo_riesgo'];
            $val->save();
        }
        return $id_ctr_zon_rg;
    }
    
    public function eliminar_observaciones(Request $request)
    {
        $Plan = new  Plan;
        $val=  $Plan::where("id_plan","=",$request['id_plan'])->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_plan'];
    }
    
    public function eliminar_observ_aemergencia(Request $request)
    {
        $ObservAtenEmergencia = new  ObservAtenEmergencia;
        $val=  $ObservAtenEmergencia::where("id_observ_emer","=",$request['id_observ_emer'])->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observ_emer'];
    }
    
    public function eliminar_observ_ctr_zona_riesgo(Request $request)
    {
        $ObservCtrZonaRiesgo = new  ObservCtrZonaRiesgo;
        $val=  $ObservCtrZonaRiesgo::where("id_observ_ctr_zon_rg","=",$request['id_observ_ctr_zon_rg'])->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observ_ctr_zon_rg'];
    }
    
}
