<?php

namespace App\Http\Controllers\gerencia_obras_pub_infra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\gerencia_obras_pub_infra\Apoyo;
use App\Models\gerencia_obras_pub_infra\Mantenimiento;
use App\Models\gerencia_obras_pub_infra\FotosMantenimiento;

class Obras_Publicas_Controller extends Controller
{

    public function index()
    {
        return view('gerencia_obras_pub_infra.vw_obras_publicas');   
    }

    public function show($id,Request $request)
    {
        if ($id > 0) 
        {
            if($request['show']=='mantenimiento')
            {
                return $this->traer_datos_mantenimiento($id);
            }
            if($request['show']=='foto_mant')
            {
                return $this->traer_datos_fotos_mantenimiento($id);
            }
        }
        else
        {
            if($request['grid']=='mantenimiento')
            {
                return $this->cargar_datos_mantenimiento($request);
            }
            if($request['grid']=='fotos_mantenimiento')
            {
                return $this->cargar_datos_fotos_mantenimiento($request);
            }
        }  
    }
    
    public function store(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->guardar_fotos_mantenimiento($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->editar_fotos_mantenimiento($request);
        }
    }
    
    public function create(Request $request)
    {
        if ($request['tipo'] == 2) 
        {
            return $this->agregar_datos_mantenimiento($request);
        }
    }
    
    public function edit($id,Request $request)
    {
        if ($request['tipo'] == 2) 
        {
            return $this->editar_datos_mantenimiento($id,$request);
        }
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy(Request $request)
    {
        $FotosMantenimiento = new  FotosMantenimiento;
        $val=  $FotosMantenimiento::where("id_foto_mant","=",$request['id_foto_mantenimiento'])->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_foto_mantenimiento'];
    }
    
    public function traer_datos_mantenimiento($id)
    {
        $mantenimiento = DB::connection('gerencia_catastro')->table('geren_gopi.vw_mantenimiento')->where('id_mantenimiento',$id)->get();
        return $mantenimiento;
    }
    
    public function traer_datos_fotos_mantenimiento($id)
    {
        $fotos_mantenimiento = DB::connection('gerencia_catastro')->table('geren_gopi.fotos_mantenimiento')->where('id_foto_mant',$id)->get();
        return $fotos_mantenimiento;
    }
    
    public function cargar_datos_mantenimiento(Request $request)
    {
        header('Content-type: application/json');
        $nombre = $request['nombre'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_gopi.vw_mantenimiento where nombre like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_gopi.vw_mantenimiento')->where('nombre','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_mantenimiento;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_mantenimiento),
                trim($Datos->nombre),
                trim($Datos->modalidad),
                trim($Datos->nomb_hab_urba),
                trim($Datos->fecha_inicio),
                trim($Datos->fecha_termino),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_fotos_mantenimiento(Request $request)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_gopi.fotos_mantenimiento where id_matenimiento = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_gopi.fotos_mantenimiento')->where('id_matenimiento',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_gopi.fotos_mantenimiento where id_matenimiento = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_gopi.fotos_mantenimiento')->where('id_matenimiento',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $Lista->rows[$Index]['id'] = $Datos->id_foto_mant;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_foto_mant),
                trim($Datos->fecha_creacion),
                '<button class="btn btn-labeled btn-warning" type="button" onclick="ver_foto('.trim($Datos->id_foto_mant).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> VER FOTO</button>',
            );
        }
        return response()->json($Lista);
    }
    
    public function agregar_datos_mantenimiento(Request $request)
    {
        $Mantenimiento = new Mantenimiento;
        $Mantenimiento->nombre = strtoupper($request['nombre']);
        $Mantenimiento->tipo_mant = strtoupper($request['tipo_mant']);
        $Mantenimiento->id_modalidad_ejecucion = $request['id_modalidad_ejecucion'];
        $Mantenimiento->observacion = strtoupper($request['observacion']); 
        $Mantenimiento->informe_tecnico = $request['informe_tecnico']; 
        $Mantenimiento->tiempo_ejecucion = strtoupper($request['tiempo_ejecucion']); 
        $Mantenimiento->beneficiarios = strtoupper($request['beneficiarios']); 
        $Mantenimiento->id_ejecutor = $request['id_ejecutor'];
        $Mantenimiento->id_supervisor = $request['id_supervisor'];
        $Mantenimiento->id_residente = $request['id_residente'];
        $Mantenimiento->fecha_inicio = $request['fecha_inicio'];
        $Mantenimiento->fecha_termino = $request['fecha_termino'];
        $Mantenimiento->fecha_actualizacion = date('d-m-Y');
        $Mantenimiento->id_lote = $request['id_lote'];
        $Mantenimiento->distrito = strtoupper($request['distrito']); 
        $Mantenimiento->provincia = strtoupper($request['provincia']); 
        $Mantenimiento->departamento = strtoupper($request['departamento']); 
        $Mantenimiento->descripcion = strtoupper($request['descripcion']); 
        $Mantenimiento->id_estado_mant = $request['id_estado_mant']; 
        $Mantenimiento->avance_fisico = $request['avance_fisico'];
        $Mantenimiento->avance_financiero = $request['avance_financiero'];
        $Mantenimiento->ubicacion = $request['ubicacion'];
             
        $Mantenimiento->save();
        
        return response()->json([
            'id_mantenimiento' => $Mantenimiento->id_mantenimiento,
        ]);

    }
    
    public function editar_datos_mantenimiento($id_mantenimiento,Request $request)
    {
        $Mantenimiento = new Mantenimiento;
        $val=  $Mantenimiento::where("id_mantenimiento","=",$id_mantenimiento )->first();
        if($val)
        {
            $val->nombre = strtoupper($request['nombre']);
            $val->tipo_mant = strtoupper($request['tipo_mant']);
            $val->id_modalidad_ejecucion = $request['id_modalidad_ejecucion'];
            $val->observacion = strtoupper($request['observacion']); 
            $val->informe_tecnico = $request['informe_tecnico']; 
            $val->tiempo_ejecucion = strtoupper($request['tiempo_ejecucion']); 
            $val->beneficiarios = strtoupper($request['beneficiarios']); 
            $val->id_ejecutor = $request['id_ejecutor'];
            $val->id_supervisor = $request['id_supervisor'];
            $val->id_residente = $request['id_residente'];
            $val->fecha_inicio = $request['fecha_inicio'];
            $val->fecha_termino = $request['fecha_termino'];
            $val->fecha_actualizacion = date('d-m-Y');
            $val->id_lote = $request['id_lote'];
            $val->distrito = strtoupper($request['distrito']); 
            $val->provincia = strtoupper($request['provincia']); 
            $val->departamento = strtoupper($request['departamento']); 
            $val->descripcion = strtoupper($request['descripcion']); 
            $val->id_estado_mant = $request['id_estado_mant'];
            $val->avance_fisico = $request['avance_fisico'];
            $val->avance_financiero = $request['avance_financiero'];
            $val->ubicacion = $request['ubicacion'];
            
            $val->save();
        }
        return $id_mantenimiento;
    }
    
    public function guardar_fotos_mantenimiento(Request $request)
    {
        $file = $request->file('dlg_foto_mantenimiento');
        $FotosMantenimiento = new FotosMantenimiento;
        $FotosMantenimiento->id_matenimiento = $request['id_mantenimiento_foto'];
        if ($file) 
        {
            $file_1 = \File::get($file);
            $FotosMantenimiento->foto = base64_encode($file_1);
        }
        $FotosMantenimiento->fecha_creacion = date('d-m-Y');
        
        $FotosMantenimiento->save();
        
        return $FotosMantenimiento->id_foto_mant;
    }
    
    public function editar_fotos_mantenimiento(Request $request)
    {
        $file = $request->file('dlg_foto_mantenimiento');
        $FotosMantenimiento = new FotosMantenimiento;
        $val=  $FotosMantenimiento::where("id_foto_mant","=",$request['id_foto_mantenimiento'] )->first();
        if($val)
        {
            $val->id_matenimiento = strtoupper($request['id_mantenimiento_foto']);
            if ($file) 
            {
                $file_1 = \File::get($file);
                $val->foto = base64_encode($file_1);
            }
            $val->fecha_creacion = date('d-m-Y');
            
            $val->save();
        }
        return $request['id_foto_mantenimiento'];
    }
    
}
