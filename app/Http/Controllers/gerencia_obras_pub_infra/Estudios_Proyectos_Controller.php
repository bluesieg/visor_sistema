<?php

namespace App\Http\Controllers\gerencia_obras_pub_infra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\gerencia_obras_pub_infra\Perfil;
use App\Models\gerencia_obras_pub_infra\ExpedienteTecnico;

class Estudios_Proyectos_Controller extends Controller
{

    public function index(Request $request)
    {
        if ($request['tipo']=='perfiles') 
        {
            return view('gerencia_obras_pub_infra.vw_perfiles');
        }
        if ($request['tipo']=='expedientes_tecnicos') 
        {
            return view('gerencia_obras_pub_infra.vw_expedientes_tecnicos');
        }
    }

    public function show($id,Request $request)
    {
        if ($id > 0) 
        {
            if($request['show']=='perfiles')
            {
                return $this->traer_datos_perfiles($id);
            }
            if($request['show']=='expediente_tecnico')
            {
                return $this->traer_datos_expedientes_tecnicos($id);
            }
        }
        else
        {
            if($request['grid']=='perfiles')
            {
                return $this->cargar_datos_perfiles($request);
            }
            if($request['grid']=='expediente_tecnico')
            {
                return $this->cargar_datos_expedientes_tecnicos($request);
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
            return $this->agregar_datos_pefiles($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->agregar_datos_expediente_tecnico($request);
        }
    }
    
    public function edit($id,Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->editar_datos_perfiles($id,$request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->editar_datos_expediente_tecnico($id,$request);
        }
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy(Request $request)
    {
    }
    
    public function traer_datos_perfiles($id)
    {
        $perfiles = DB::connection('gerencia_catastro')->table('geren_gopi.vw_perfiles')->where('id_perfil',$id)->get();
        return $perfiles;
    }
    
    public function traer_datos_expedientes_tecnicos($id)
    {
        $expediente_tecnico = DB::connection('gerencia_catastro')->table('geren_gopi.vw_expediente_tecnico')->where('id_expediente_tecnico',$id)->get();
        return $expediente_tecnico;
    }
    
    public function cargar_datos_perfiles(Request $request)
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
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_gopi.vw_perfiles where nomb_hab_urba like '%".strtoupper($ubicacion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_gopi.vw_perfiles')->where('nomb_hab_urba','like', '%'.strtoupper($ubicacion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_perfil;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_perfil),
                trim($Datos->codigo_snip),
                trim($Datos->ubicacion),
                trim($Datos->nomb_hab_urba),
                trim($Datos->nivel),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_expedientes_tecnicos(Request $request)
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
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_gopi.vw_expediente_tecnico where nomb_hab_urba like '%".strtoupper($ubicacion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_gopi.vw_expediente_tecnico')->where('nomb_hab_urba','like', '%'.strtoupper($ubicacion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_expediente_tecnico;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_expediente_tecnico),
                trim($Datos->codigo_snip),
                trim($Datos->ubicacion),
                trim($Datos->nomb_hab_urba),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
    
    public function agregar_datos_pefiles(Request $request)
    {
        $Perfil = new Perfil;
        $Perfil->codigo_snip = strtoupper($request['codigo_snip']);
        $Perfil->nombre_pip = strtoupper($request['nombre_pip']);
        $Perfil->id_responsable = $request['id_responsable'];
        $Perfil->monto_perfil = $request['monto_perfil']; 
        $Perfil->responsabilidad_func = strtoupper($request['responsabilidad_funcional']); 
        $Perfil->ubicacion = $request['ubicacion']; 
        $Perfil->distrito = strtoupper($request['distrito']); 
        $Perfil->provincia = strtoupper($request['provincia']); 
        $Perfil->departamento = strtoupper($request['departamento']); 
        $Perfil->unidad_form = strtoupper($request['unidad_formuladora']); 
        $Perfil->unidad_ejecutora = strtoupper($request['unidad_ejecutora']); 
        $Perfil->nivel = $request['nivel_pip']; 
        $Perfil->num_beneficiarios  = $request['num_beneficiarios']; 
        $Perfil->cantidad = $request['cantidad_alternativas']; 
        $Perfil->monto = $request['monto']; 
        $Perfil->viabilidad = $request['viabilidad']; 
        $Perfil->id_lote = $request['id_lote']; 
             
        $Perfil->save();
        
        return $Perfil->id_perfil;
    }
    
    public function editar_datos_perfiles($id_perfil,Request $request)
    {
        $Perfil = new Perfil;
        $val=  $Perfil::where("id_perfil","=",$id_perfil )->first();
        if($val)
        {
            $val->codigo_snip = strtoupper($request['codigo_snip']);
            $val->nombre_pip = strtoupper($request['nombre_pip']);
            $val->id_responsable = $request['id_responsable'];
            $val->monto_perfil = $request['monto_perfil']; 
            $val->responsabilidad_func = strtoupper($request['responsabilidad_funcional']); 
            $val->ubicacion = $request['ubicacion']; 
            $val->distrito = strtoupper($request['distrito']); 
            $val->provincia = strtoupper($request['provincia']); 
            $val->departamento = strtoupper($request['departamento']); 
            $val->unidad_form = strtoupper($request['unidad_formuladora']); 
            $val->unidad_ejecutora = strtoupper($request['unidad_ejecutora']); 
            $val->nivel = $request['nivel_pip']; 
            $val->num_beneficiarios  = $request['num_beneficiarios']; 
            $val->cantidad = $request['cantidad_alternativas']; 
            $val->monto = $request['monto']; 
            $val->viabilidad = $request['viabilidad']; 
            $val->id_lote = $request['id_lote']; 
            $val->save();
        }
        return $id_perfil;
    }
    
    public function agregar_datos_expediente_tecnico(Request $request)
    {
        $ExpedienteTecnico = new ExpedienteTecnico;
        $ExpedienteTecnico->codigo_snip = strtoupper($request['codigo_snip']);
        $ExpedienteTecnico->nombre_pip = strtoupper($request['nombre_pip']);
        $ExpedienteTecnico->id_responsable_exp = $request['id_responsable'];
        $ExpedienteTecnico->monto_exp_t = $request['monto_exp_tec']; 
        $ExpedienteTecnico->id_lote = $request['id_lote']; 
        $ExpedienteTecnico->ubicacion = $request['ubicacion']; 
        $ExpedienteTecnico->distrito = strtoupper($request['distrito']); 
        $ExpedienteTecnico->provincia = strtoupper($request['provincia']); 
        $ExpedienteTecnico->departamento = strtoupper($request['departamento']); 
        $ExpedienteTecnico->monto = $request['monto']; 
        $ExpedienteTecnico->descripcion = strtoupper($request['descripcion']); 
        $ExpedienteTecnico->tiempo_ejecucion = strtoupper($request['tiempo_ejecucion']); 
        $ExpedienteTecnico->aprobacion = strtoupper($request['aprobacion']); 
             
        $ExpedienteTecnico->save();
        
        return $ExpedienteTecnico->id_expediente_tecnico;
    }
    
    public function editar_datos_expediente_tecnico($id_expediente_tecnico,Request $request)
    {
        $ExpedienteTecnico = new ExpedienteTecnico;
        $val=  $ExpedienteTecnico::where("id_expediente_tecnico","=",$id_expediente_tecnico )->first();
        if($val)
        {
            $val->codigo_snip = strtoupper($request['codigo_snip']);
            $val->nombre_pip = strtoupper($request['nombre_pip']);
            $val->id_responsable_exp = $request['id_responsable'];
            $val->monto_exp_t = $request['monto_exp_tec']; 
            $val->id_lote = $request['id_lote']; 
            $val->ubicacion = $request['ubicacion']; 
            $val->distrito = strtoupper($request['distrito']); 
            $val->provincia = strtoupper($request['provincia']); 
            $val->departamento = strtoupper($request['departamento']); 
            $val->monto = $request['monto']; 
            $val->descripcion = strtoupper($request['descripcion']); 
            $val->tiempo_ejecucion = strtoupper($request['tiempo_ejecucion']); 
            $val->aprobacion = strtoupper($request['aprobacion']); 
            
            $val->save();
        }
        return $id_expediente_tecnico;
    }
    
}
