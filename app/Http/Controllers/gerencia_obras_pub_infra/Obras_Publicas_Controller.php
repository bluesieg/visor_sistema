<?php

namespace App\Http\Controllers\gerencia_obras_pub_infra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\gerencia_obras_pub_infra\Obra;
use App\Models\gerencia_obras_pub_infra\FotosObra;

class Obras_Publicas_Controller extends Controller
{

    public function index()
    {
        $tipo_obra = DB::connection('gerencia_catastro')->table('geren_gopi.tipo_obra')->get();
        $modalidad_ejecucion = DB::connection('gerencia_catastro')->table('geren_gopi.modalidad_ejecucion')->get();
        $estado_obra = DB::connection('gerencia_catastro')->table('geren_gopi.estado_obra')->get();
        return view('gerencia_obras_pub_infra.vw_obras_publicas',compact('tipo_obra','modalidad_ejecucion','estado_obra'));   
    }

    public function show($id,Request $request)
    {
        if ($id > 0) 
        {
            if($request['show']=='obras')
            {
                return $this->traer_datos_obras($id);
            }
            if($request['show']=='foto_obra')
            {
                return $this->traer_datos_fotos_obra($id);
            }
        }
        else
        {
            if($request['grid']=='obras_publicas')
            {
                return $this->cargar_datos_obras_publicas($request);
            }
            if($request['grid']=='fotos_obra')
            {
                return $this->cargar_datos_fotos_obra($request);
            }
            if ($request['mapa'] == 'mapa_obra') 
            {
                return $this->cargar_mapa_obra($request);
            }
            if($request['reporte']=='obras')
            {
                return $this->reporte_obras($request);
            }
            if($request['fotos']=='fotos_obra')
            {
                return $this->cargar_fotos_obra($request);
            }
        }  
    }
    
    public function store(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->guardar_fotos_obra($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->editar_fotos_obra($request);
        }
    }
    
    public function create(Request $request)
    {
        $Obra = new Obra;
        $Obra->nombre = strtoupper($request['nombre']);
        $Obra->id_tipo_obra = $request['tipo_obra'];
        $Obra->id_modalidad_ejec = $request['id_modalidad_ejecucion'];
        $Obra->monto = $request['monto'];
        $Obra->observacion = strtoupper($request['observacion']); 
        $Obra->codigo_snip = strtoupper($request['codigo_snip']); 
        $Obra->perfil = $request['perfil'];
        $Obra->expediente_tecnico = $request['expediente_tecnico'];
        $Obra->tiempo_ejecucion = strtoupper($request['tiempo_ejecucion']);
        $Obra->beneficiarios = strtoupper($request['beneficiarios']); 
        $Obra->id_ejecutor = $request['id_ejecutor'];
        $Obra->id_supervisor = $request['id_supervisor'];
        $Obra->id_residente = $request['id_residente'];
        $Obra->fecha_inicio = $request['fecha_inicio'];
        $Obra->fecha_termino = $request['fecha_termino'];
        $Obra->fecha_actualizacion = date('d-m-Y');
        $Obra->ubicacion = $request['ubicacion'];
        $Obra->id_lote = $request['id_lote'];
        $Obra->distrito = strtoupper($request['distrito']); 
        $Obra->provincia = strtoupper($request['provincia']); 
        $Obra->departamento = strtoupper($request['departamento']); 
        $Obra->descripcion = strtoupper($request['descripcion']); 
        $Obra->id_estado_obra = $request['id_estado_obra']; 
        $Obra->avance_fisico = $request['avance_fisico'];
        $Obra->avance_financiero = $request['avance_financiero'];
        $Obra->save();
        
        return response()->json([
            'id_obra' => $Obra->id_obra,
        ]);
    }
    
    public function edit($id,Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->editar_datos_obras($id,$request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->editar_datos_fotos_obras($id,$request);
        }
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy(Request $request)
    {
        $FotosObra = new FotosObra;
        $val=  $FotosObra::where("id_foto_obra","=",$request['id_foto_obra'])->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_foto_obra'];
    }
    
    public function traer_datos_obras($id)
    {
        $obras = DB::connection('gerencia_catastro')->table('geren_gopi.vw_obras')->where('id_obra',$id)->get();
        return $obras;
    }
    
    public function traer_datos_fotos_obra($id)
    {
        $fotos_obra = DB::connection('gerencia_catastro')->table('geren_gopi.fotos_obra')->where('id_foto_obra',$id)->get();
        return $fotos_obra;
    }
    
    public function cargar_datos_obras_publicas(Request $request)
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
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_gopi.vw_obras where nombre like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_gopi.vw_obras')->where('nombre','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_obra;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_obra),
                trim($Datos->nombre),
                trim($Datos->tipo_obra),
                trim($Datos->nomb_hab_urba),
                trim($Datos->modalidad),
                trim($Datos->estado_obra),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_fotos_obra(Request $request)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_gopi.fotos_obra where id_obra = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_gopi.fotos_obra')->where('id_obra',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_gopi.fotos_obra where id_obra = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_gopi.fotos_obra')->where('id_obra',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $Lista->rows[$Index]['id'] = $Datos->id_foto_obra;
            if ($Datos->estado == 1) {
              $nuevo = '<button class="btn btn-labeled btn-success" type="button" onclick="Cambiar_estado('.trim($Datos->id_foto_obra).','.trim($Datos->id_obra).',0)"><span class="btn-label"><i class="fa fa-plus"></i></span> VISIBLE</button>';
            }else{
               $nuevo = '<button class="btn btn-labeled btn-danger" type="button" onclick="Cambiar_estado('.trim($Datos->id_foto_obra).','.trim($Datos->id_obra).',1)"><span class="btn-label"><i class="fa fa-trash"></i></span> OCULTO</button>'; 
            }            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_foto_obra),
                trim($Datos->fecha_creacion),
                '<button class="btn btn-labeled btn-warning" type="button" onclick="ver_foto('.trim($Datos->id_foto_obra).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> VER FOTO</button>',
                $nuevo,
            );
        }
        return response()->json($Lista);
    }
    
    public function guardar_fotos_obra(Request $request)
    {
        $file = $request->file('dlg_foto_obra');
        $FotosObra = new FotosObra;
        $FotosObra->id_obra = $request['id_obra_foto'];
        if ($file) 
        {
            $file_1 = \File::get($file);
            $FotosObra->foto = base64_encode($file_1);
        }
        $FotosObra->fecha_creacion = date('d-m-Y');
        
        $FotosObra->save();
        
        return $FotosObra->id_foto_obra;
    }
    
    public function editar_fotos_obra(Request $request)
    {
        $file = $request->file('dlg_foto_obra');
        $FotosObra = new FotosObra;
        $val=  $FotosObra::where("id_foto_obra","=",$request['id_foto_obra'] )->first();
        if($val)
        {
            $val->id_obra = strtoupper($request['id_obra_foto']);
            if ($file) 
            {
                $file_1 = \File::get($file);
                $val->foto = base64_encode($file_1);
            }
            $val->fecha_creacion = date('d-m-Y');
            
            $val->save();
        }
        return $request['id_foto_obra'];
    }
    
    public function editar_datos_obras($id_obra, Request $request)
    {
        $Obra = new Obra;
        $val=  $Obra::where("id_obra","=",$id_obra)->first();
        if($val)
        {
            $val->nombre = strtoupper($request['nombre']);
            $val->id_tipo_obra = $request['tipo_obra'];
            $val->id_modalidad_ejec = $request['id_modalidad_ejecucion'];
            $val->monto = $request['monto'];
            $val->observacion = strtoupper($request['observacion']); 
            $val->codigo_snip = strtoupper($request['codigo_snip']); 
            $val->perfil = $request['perfil'];
            $val->expediente_tecnico = $request['expediente_tecnico'];
            $val->tiempo_ejecucion = strtoupper($request['tiempo_ejecucion']);
            $val->beneficiarios = strtoupper($request['beneficiarios']); 
            $val->id_ejecutor = $request['id_ejecutor'];
            $val->id_supervisor = $request['id_supervisor'];
            $val->id_residente = $request['id_residente'];
            $val->fecha_inicio = $request['fecha_inicio'];
            $val->fecha_termino = $request['fecha_termino'];
            $val->fecha_actualizacion = date('d-m-Y');
            $val->ubicacion = $request['ubicacion'];
            $val->id_lote = $request['id_lote'];
            $val->distrito = strtoupper($request['distrito']); 
            $val->provincia = strtoupper($request['provincia']); 
            $val->departamento = strtoupper($request['departamento']); 
            $val->descripcion = strtoupper($request['descripcion']); 
            $val->id_estado_obra = $request['id_estado_obra']; 
            $val->avance_fisico = $request['avance_fisico'];
            $val->avance_financiero = $request['avance_financiero'];
            
            $val->save();
        }
        return $id_obra;
    }
    
    public function editar_datos_fotos_obras($id_foto_obra, Request $request)
    {
        $id_obra = $request['id_obra'];
        $estado = $request['estado'];
        
        $FotosObra = new FotosObra;
        $val=  $FotosObra::where("id_foto_obra","=",$id_foto_obra)->where("id_obra","=",$id_obra)->first();
        if($val)
        {
            $val->estado = $estado;
            $val->save();
        }
        return $id_foto_obra;
    }
    
    function cargar_mapa_obra(Request $request)
    {
        $id_estado_obra = $request['id_estado_obra'];
        $id_hab_urb = $request['id_hab_urb'];
            
        $obras = DB::connection('gerencia_catastro')->select("select * from geren_gopi.vw_obras where id_hab_urb = $id_hab_urb and id_estado_obra = $id_estado_obra");
        
        if($obras)
        {
            $mapa = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                        'type',     'FeatureCollection',
                        'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_obra',id_obra,
                                'nombre',nombre,
                                'monto',monto,
                                'observacion',observacion,
                                'codigo_snip',codigo_snip,
                                'perfil',perfil,
                                'expediente_tecnico',expediente_tecnico,
                                'tiempo_ejecucion',tiempo_ejecucion,
                                'beneficiarios',beneficiarios,
                                'fecha_inicio',fecha_inicio,
                                'fecha_termino',fecha_termino,
                                'ubicacion',ubicacion,
                                'descripcion',descripcion,
                                'avance_fisico',avance_fisico,
                                'avance_financiero',avance_financiero,
                                'tipo_obra',tipo_obra,
                                'modalidad',modalidad,
                                'estado_obra',estado_obra,
                                'nomb_hab_urba',nomb_hab_urba,
                                'dni_ejecutor',dni_ejecutor,
                                'ejecutor',ejecutor,
                                'dni_supervisor',dni_supervisor,
                                'supervisor',supervisor,
                                'dni_residente',dni_residente,
                                'residente',residente
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_gopi.vw_obras where id_hab_urb = $id_hab_urb and id_estado_obra = $id_estado_obra) row) features;");

            return response()->json($mapa);
        }
        else
        {
            return 0;
        }
    }
    
    public function reporte_obras(Request $request)
    {
        $id_obra = $request['id_obra'];
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_gopi.vw_obras where id_obra = $id_obra ");
        
        if($sql)
        {
            $view =  \View::make('gerencia_obras_pub_infra.reportes.reporte_obras', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("REPORTE OBRA".".pdf");
        }
        else
        {
            return 'NO HAY RESULTADOS';
        }
    }
    
    public function cargar_fotos_obra(Request $request)
    {
        $id_obra = $request['id'];
        $foto = DB::connection('gerencia_catastro')->select("select foto from geren_gopi.fotos_obra where id_obra = $id_obra and estado = 1");
        if($foto)
        {
            return $foto;
        }
        else
        {
            return 0; 
        }
    }
    
}
