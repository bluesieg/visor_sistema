<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\procuraduria\Mtrprocuraduria;
use App\Models\procuraduria\Dteprocuraduria;
use App\Models\procuraduria\Documentos_Adjuntos;
use Illuminate\Support\Facades\Response;
use App\Models\procuraduria\Caso;
use App\Models\procuraduria\Materia;
use App\Models\procuraduria\Proceso;
use App\Models\procuraduria\TipoSancion;
use App\Models\procuraduria\Tipo;

class ProcuraduriaController extends Controller
{
    public function index(Request $request)
    {
        if ($request['tipo'] == 'procuraduria') 
        {
            $abogados = DB::connection('gerencia_catastro')->table('procuraduria.abogados')->get();
            $tipos_sanciones = DB::connection('gerencia_catastro')->table('procuraduria.tipo_sancion')->get();
            $materias = DB::connection('gerencia_catastro')->table('procuraduria.materia')->get();
            $procesos = DB::connection('gerencia_catastro')->table('procuraduria.proceso')->get();
            $casos = DB::connection('gerencia_catastro')->table('procuraduria.caso')->get();
            $tip_doc = DB::connection('gerencia_catastro')->select('select * from procuraduria.tipo_documento order by 1');
            return view('procuraduria/wv_procuraduria',compact('abogados','tipos_sanciones','materias','procesos','casos','tip_doc'));
        }
        if ($request['tipo'] == 'tipo_sancion') 
        {
            return view('procuraduria/vw_tipo_sancion');
        }
        if ($request['tipo'] == 'proceso') 
        {
            return view('procuraduria/vw_proceso');
        }
        if ($request['tipo'] == 'materia') 
        {
            return view('procuraduria/vw_materia');
        }
        if ($request['tipo'] == 'caso') 
        {
            return view('procuraduria/vw_caso');
        }
    }
    
    public function create(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->agregar_MtrProcuraduria($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->agregar_DteProcuraduria($request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->agregar_datos_casos($request);
        }
        if ($request['tipo'] == 4) 
        {
            return $this->agregar_datos_materia($request);
        }
        if ($request['tipo'] == 5) 
        {
            return $this->agregar_datos_proceso($request);
        }
        if ($request['tipo'] == 6) 
        {
            return $this->agregar_datos_tipo_sancion($request);
        }
        if ($request['tipo'] == 7) 
        {
            return $this->agregar_datos_tipos($request);
        }
    }
    
    public function store(Request $request)
    {
        if ($request['tipo']== 1) 
        {
            return $this->get_pdf();
        }
        if ($request['tipo']== 2) 
        {
            return $this->agregar_DocAdjuntos($request);
        }
    }
    public function show($id,Request $request)
    {
        if ($id > 0) {
            if ($request['show'] == 'procuraduria') 
            {
                return $this->traer_datos_procuraduria($id);
            }
            if ($request['show'] == 'observaciones') 
            {
                return $this->traer_datos_observaciones($id);
            }
            if ($request['show'] == 'casos') 
            {
                return $this->traer_datos_casos($id);
            }
            if ($request['show'] == 'materia') 
            {
                return $this->traer_datos_materia($id);
            }
            if ($request['show'] == 'proceso') 
            {
                return $this->traer_datos_proceso($id);
            }
            if ($request['show'] == 'tipo_sancion') 
            {
                return $this->traer_datos_tipo_sancion($id);
            }
            if ($request['show'] == 'tipo') 
            {
                return $this->traer_datos_tipo($id);
            }
            if($request['show']=='datos_observacion_procuraduria')
            {
                return $this->traer_observaciones_procuraduria($id);
            }
        }
        else
        {
            if ($request['reporte'] == 'escaneos') 
            {
                return $this->ver_documentos($request);
            }
            if ($request['datos'] == 'datos_expediente') 
            {
                return $this->traer_datos_expediente($request['codigo_exp']);
            }
            if ($request['grid'] == 'expedientes') 
            {
                return $this->cargar_datos_expedientes();
            }
            if ($request['grid'] == 'observaciones') 
            {
                return $this->cargar_datos_observaciones($request);
            }
            if ($request['grid'] == 'escaneos') 
            {
                return $this->cargar_datos_escaneos($request);
            }
            if ($request['grid'] == 'doc_adjuntos') 
            {
                return $this->cargar_documentos_adjuntos($request);
            }
            if ($request['grid'] == 'documentos_adj') 
            {
                return $this->documentos_adjuntos($request);
            }
            if ($request['grid'] == 'casos') 
            {
                return $this->cargar_datos_casos($request);
            }
            if ($request['grid'] == 'materia') 
            {
                return $this->cargar_datos_materia($request);
            }
            if ($request['grid'] == 'proceso') 
            {
                return $this->cargar_datos_proceso($request);
            }
            if ($request['grid'] == 'tipo_sancion') 
            {
                return $this->cargar_datos_tipo_sancion($request);
            }
            if ($request['grid'] == 'tipos') 
            {
                return $this->cargar_datos_tipos($request);
            }
            if ($request['mapa'] == 'procuraduria') 
            {
                return $this->cargar_mapa_procuraduria($request);
            }
            if($request['reporte']=='procuraduria')
            {
                return $this->abrir_reporte_procuraduria($request);
            }
        }  
    }
    public function edit($id,Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->editar_procuraduria($id,$request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->editar_observaciones($id,$request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->editar_datos_casos($id,$request);
        }
        if ($request['tipo'] == 4) 
        {
            return $this->editar_datos_materia($id,$request);
        }
        if ($request['tipo'] == 5) 
        {
            return $this->editar_datos_proceso($id,$request);
        }
        if ($request['tipo'] == 6) 
        {
            return $this->editar_datos_tipo_sancion($id,$request);
        }
        if ($request['tipo'] == 7) 
        {
            return $this->editar_datos_tipos($id,$request);
        }
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy(Request $request)
    {
        if ($request['tipo'] == 1) 
        {
            return $this->eliminar_observaciones($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->eliminar_archivos($request);
        }
    }
    
    public function traer_datos_procuraduria($id_procuraduria)
    {
        $procuraduria = DB::connection('gerencia_catastro')->table('procuraduria.vw_procuraduria')->where('id_procuraduria',$id_procuraduria)->get();
        return $procuraduria;
    }
    
    public function traer_datos_observaciones($id_det_procuraduria)
    {
        $observaciones = DB::connection('gerencia_catastro')->table('procuraduria.vw_det_procuraduria')->where('id_det_procuraduria',$id_det_procuraduria)->get();
        return $observaciones;
    }
    
    public function traer_datos_casos($id_caso)
    {
        $casos = DB::connection('gerencia_catastro')->table('procuraduria.vw_casos')->where('id_caso',$id_caso)->get();
        return $casos;
    }
    
    public function traer_datos_materia($id_materia)
    {
        $materia = DB::connection('gerencia_catastro')->table('procuraduria.vw_materia')->where('id_materia',$id_materia)->get();
        return $materia;
    }
    
    public function traer_datos_proceso($id_proceso)
    {
        $proceso = DB::connection('gerencia_catastro')->table('procuraduria.vw_proceso')->where('id_proceso',$id_proceso)->get();
        return $proceso;
    }
    
    public function traer_datos_tipo_sancion($id_tipo_sancion)
    {
        $tipo_sancion = DB::connection('gerencia_catastro')->table('procuraduria.vw_tipo_sancion')->where('id_tipo_sancion',$id_tipo_sancion)->get();
        return $tipo_sancion;
    }
    
    public function traer_datos_tipo($id_tipo)
    {
        $tipo= DB::connection('gerencia_catastro')->table('procuraduria.vw_tipos')->where('id_tipo',$id_tipo)->get();
        return $tipo;
    }
    
    public function traer_datos_expediente($codigo_expediente)
    {
        $expedientes = DB::connection("sql_crud")->table('vw_catastro')->where('codigoTramite',strtoupper($codigo_expediente))->first();
        
        $select=DB::connection('gerencia_catastro')->table('procuraduria.mtr_procuraduria')->where('nro_expediente',strtoupper($codigo_expediente))->get();
        
        if($expedientes)
        {
            if (count($select)>=1) {
                
                return response()->json([
                'msg' => 'repetido',
                ]);
                
            }else{  
            return response()->json([
                'msg' => 'si',
                'id_gestor'     => $expedientes->idInteresado,
                'gestor'        => $expedientes->nombres. " " .$expedientes->apellidos,
                'dni'           => $expedientes->numeroIdentificacion,
                'fecha_inicio'  => $expedientes->iniciado,
            ]);
                
            }
            
        }else{
            return response()->json([
                'msg' => 'no',
            ]);
        }
    }
    
    
    public function cargar_datos_expedientes()
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_procuraduria");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_procuraduria')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_procuraduria;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_procuraduria),
                trim($Datos->nro_expediente),
                trim($Datos->nro_doc_gestor),
                trim($Datos->gestor),
                trim($Datos->fecha_inicio_tramite),
                trim($Datos->nomb_hab_urba),
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_det_procuraduria where id_mtr_procuraduria = 0");
            $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_det_procuraduria')->where('id_mtr_procuraduria',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_det_procuraduria where id_mtr_procuraduria = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_det_procuraduria')->where('id_mtr_procuraduria',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $Lista->rows[$Index]['id'] = $Datos->id_det_procuraduria;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_det_procuraduria),
                trim($Datos->fecha_registro),
                trim($Datos->observaciones),  
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_escaneos(Request $request)
    {
        header('Content-type: application/json');
        $nro_expediente = $request['nro_expediente'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_procuraduria where nro_expediente like '%".strtoupper($nro_expediente)."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_procuraduria')->where('nro_expediente','like', '%'.strtoupper($nro_expediente).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_procuraduria;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_procuraduria),
                trim($Datos->nro_expediente),
                trim($Datos->nro_doc_gestor),
                trim($Datos->gestor),
                '<button class="btn btn-labeled bg-color-greenDark txt-color-white" type="button" onclick="subir_scan_procuraduria('.trim($Datos->id_procuraduria).')"><span class="btn-label"><i class="fa fa-print"></i></span> SUBIR ESCANEO</button>'
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_documentos_adjuntos(Request $request)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

         $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_doc_adjuntos where id_procuraduria=".$request['id']);
         $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_doc_adjuntos')->where('id_procuraduria',$request['id'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_doc_adj;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_doc_adj),
                trim($Datos->descripcion),
                '<button class="btn btn-labeled btn-warning" type="button" onclick="verfile_procuraduria('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> VER</button>',
                '<button class="btn btn-labeled btn-danger" type="button" onclick="delfile('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-trash"></i></span> BORRAR</button>',
            );
        }
        return response()->json($Lista);
    }
    
    public function documentos_adjuntos(Request $request)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

         $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_doc_adjuntos where id_procuraduria=".$request['id_procuraduria']);
         $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_doc_adjuntos')->where('id_procuraduria',$request['id_procuraduria'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_doc_adj;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_doc_adj),
                trim($Datos->descripcion),
                '<button class="btn btn-labeled btn-warning" type="button" onclick="verfile_procuraduria('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> VER DOCUMENTO</button>',
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_casos(Request $request)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_casos where descripcion like '%".strtoupper($request['descripcion'])."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_casos')->where('descripcion','like', '%'.strtoupper($request['descripcion']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_caso;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_caso),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_materia(Request $request)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_materia where descripcion like '%".strtoupper($request['descripcion'])."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_materia')->where('descripcion','like', '%'.strtoupper($request['descripcion']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_materia;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_materia),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_proceso(Request $request)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_proceso where descripcion like '%".strtoupper($request['descripcion'])."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_proceso')->where('descripcion','like', '%'.strtoupper($request['descripcion']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_proceso;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_proceso),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_tipo_sancion(Request $request)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_tipo_sancion where descripcion like '%".strtoupper($request['descripcion'])."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_tipo_sancion')->where('descripcion','like', '%'.strtoupper($request['descripcion']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_tipo_sancion;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_tipo_sancion),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
    
    public function cargar_datos_tipos(Request $request)
    {
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from procuraduria.vw_tipos where descripcion like '%".strtoupper($request['descripcion'])."%'");
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_tipos')->where('descripcion','like', '%'.strtoupper($request['descripcion']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_tipo;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_tipo),
                trim($Datos->descripcion),
            );
        }
        return response()->json($Lista);
    }
    
    public function agregar_MtrProcuraduria(Request $request)
    {
        $Mtrprocuraduria = new Mtrprocuraduria;
        $Mtrprocuraduria->nro_expediente           =  strtoupper($request['nro_expediente']);
        $Mtrprocuraduria->id_gestor        = $request['id_gestor'];
        $Mtrprocuraduria->gestor      = $request['gestor'];
        $Mtrprocuraduria->nro_doc_gestor  = $request['dni'];
        $Mtrprocuraduria->fecha_inicio_tramite  = $request['fecha_ini'];
        $Mtrprocuraduria->fecha_registro  = date('d-m-Y');
        $Mtrprocuraduria->id_abogado  = $request['id_abogado'];
        $Mtrprocuraduria->id_lote  = $request['id_lote'];
        $Mtrprocuraduria->cod_catastral  = $request['codigo_catastral'];
        $Mtrprocuraduria->id_tipo_sancion  = $request['id_tipo_sancion'];
        $Mtrprocuraduria->id_materia  = $request['id_materia'];
        $Mtrprocuraduria->id_proceso  = $request['id_proceso'];
        $Mtrprocuraduria->id_caso  = $request['id_caso'];
        $Mtrprocuraduria->referencia  = strtoupper($request['referencia']);
        $Mtrprocuraduria->procedimiento  = strtoupper($request['procedimiento']);
        
        $Mtrprocuraduria->save();
        
        return response()->json([
            'id_procuraduria' => $Mtrprocuraduria->id_procuraduria,
        ]);
    }
    
    public function agregar_DteProcuraduria(Request $request)
    {
        $Dteprocuraduria = new Dteprocuraduria;
        $Dteprocuraduria->id_mtr_procuraduria   = $request['id_procuraduria'];
        $Dteprocuraduria->fecha_registro        = date('d-m-Y');
        $Dteprocuraduria->observaciones         = strtoupper($request['observacion']);
        
        $Dteprocuraduria->save();
        
        return $Dteprocuraduria->id_det_procuraduria;
    }
    
    public function agregar_datos_casos(Request $request)
    {
        $Caso = new Caso;
        $Caso->descripcion = strtoupper($request['descripcion']);
        $Caso->save();

        return $Caso->id_caso;
    }
    
    public function agregar_datos_materia(Request $request)
    {
        $Materia = new Materia;
        $Materia->descripcion = strtoupper($request['descripcion']);
        $Materia->save();

        return $Materia->id_materia;
    }
    
    public function agregar_datos_proceso(Request $request)
    {
        $Proceso = new Proceso;
        $Proceso->descripcion = strtoupper($request['descripcion']);
        $Proceso->save();

        return $Proceso->id_proceso;
    }
    
    public function agregar_datos_tipo_sancion(Request $request)
    {
        $TipoSancion = new TipoSancion;
        $TipoSancion->descripcion = strtoupper($request['descripcion']);
        $TipoSancion->save();

        return $TipoSancion->id_tipo_sancion;
    }
    
    public function editar_procuraduria($id_procuraduria, Request $request)
    {
        $Mtrprocuraduria = new Mtrprocuraduria;
        $val=  $Mtrprocuraduria::where("id_procuraduria","=",$id_procuraduria )->first();
        if($val)
        {
            $val->nro_expediente = strtoupper($request['nro_expediente']);
            $val->id_gestor = $request['id_gestor'];
            $val->gestor = $request['gestor'];
            $val->nro_doc_gestor = $request['dni'];
            $val->fecha_inicio_tramite = $request['fecha_ini'];
            $val->id_abogado = $request['id_abogado'];
            $val->id_lote = $request['id_lote'];
            $val->cod_catastral = $request['codigo_catastral'];
            $val->id_tipo_sancion = $request['id_tipo_sancion'];
            $val->id_materia = $request['id_materia'];
            $val->id_proceso = $request['id_proceso'];
            $val->id_caso = $request['id_caso'];
            $val->referencia = strtoupper($request['referencia']);
            $val->procedimiento = strtoupper($request['procedimiento']);
            
            $val->save();
        }
        return $id_procuraduria;
    }
    
    public function editar_observaciones($id_det_procuraduria,Request $request)
    {
        $Dteprocuraduria = new Dteprocuraduria;
        $val=  $Dteprocuraduria::where("id_det_procuraduria","=",$id_det_procuraduria )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id_det_procuraduria;
    }
    
    public function editar_datos_casos($id_caso, Request $request)
    {
        $Caso = new Caso;
        $val=  $Caso::where("id_caso","=",$id_caso )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_caso;
    }
    
    public function editar_datos_materia($id_materia, Request $request)
    {
        $Materia = new Materia;
        $val=  $Materia::where("id_materia","=",$id_materia )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_materia;
    }
    
    public function editar_datos_proceso($id_proceso, Request $request)
    {
        $Proceso = new Proceso;
        $val=  $Proceso::where("id_proceso","=",$id_proceso )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_proceso;
    }
    
    public function editar_datos_tipo_sancion($id_tipo_sancion, Request $request)
    {
        $TipoSancion = new TipoSancion;
        $val=  $TipoSancion::where("id_tipo_sancion","=",$id_tipo_sancion )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_tipo_sancion;
    }
    
    public function editar_datos_tipos($id_tipo, Request $request)
    {
        $Tipo = new Tipo;
        $val=  $Tipo::where("id_tipo","=",$id_tipo )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_tipo;
    }
    
    public function agregar_datos_tipos(Request $request)
    {
        $Tipo = new Tipo;
        $Tipo->descripcion = strtoupper($request['descripcion']);
        $Tipo->save();

        return $Tipo->id_tipo;
    }
    
    public function get_pdf()
    {   
           $file = file_get_contents($_FILES['dlg_documento_file_procuraduria']['tmp_name']);
            if($_FILES["dlg_documento_file_procuraduria"]["type"]=='application/pdf')
            {  
                return Response::make($file, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="prueba"'
                ]);
            }
            else
            {    return "<html><head></head><body style='margin:3px;padding:0px;font-family:verdana;font-size:11px'>No es .pdf</body></html>";$i=0;}
    }
    
    public function agregar_DocAdjuntos(Request $request)
    {
        $file = $request->file('dlg_documento_file_procuraduria');
        
        if($file)
        {
            $file2 = \File::get($file);
            $dig=new Documentos_Adjuntos;
            $dig->id_tip_doc=$request['tipo_documento_procuraduria'];
            $dig->archivo = base64_encode($file2);
            $dig->id_procuraduria = $request['id_scan_procuraduria'];
            $dig->descripcion = strtoupper($request['dlg_documento_des_procuraduria']);
            $dig->save();
            return $dig->id_doc_adj;
        }
        else
        {
            return 0;
        }
    }
    
    public function ver_documentos(Request $request)
    {
        $sql = DB::connection('gerencia_catastro')->select('select * from procuraduria.documentos_adjuntos where id_doc_adj='.$request['id']);
        if(count($sql)>=1)
        {
            return Response::make(base64_decode($sql[0]->archivo), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="Documento"'
                ]);
        }
        else
        {
            return "No hay Archvos";
        }
    }
    
    public function eliminar_archivos(Request $request)
    {
        $Documentos_Adjuntos = new  Documentos_Adjuntos;
        $val=  $Documentos_Adjuntos::where("id_doc_adj","=",$request['id_doc_adj'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_doc_adj'];
    }
    
    public function eliminar_observaciones(Request $request)
    {
        $Dteprocuraduria = new  Dteprocuraduria;
        $val=  $Dteprocuraduria::where("id_det_procuraduria","=",$request['id_det_procuraduria'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_det_procuraduria'];
    }
    
    public function cargar_mapa_procuraduria(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from procuraduria.vw_procuraduria where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $procuraduria = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_procuraduria',id_procuraduria,
                                'nro_expediente',nro_expediente,
                                'nro_doc_gestor',nro_doc_gestor,
                                'gestor',gestor,
                                'fecha_inicio_tramite',fecha_inicio_tramite,
                                'cod_catastral',cod_catastral,
                                'referencia',referencia,
                                'procedimiento',procedimiento,
                                'tipo_sancion',tipo_sancion,
                                'materia',materia,
                                'proceso',proceso,
                                'caso',caso,
                                'nomb_hab_urba',nomb_hab_urba,
                                'nro_doc_persona',nro_doc_persona,
                                'persona',persona
                             )
                          ) AS feature
                          FROM (SELECT * FROM procuraduria.vw_procuraduria where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($procuraduria);
        }
        else
        {
            return 0; 
        }
    }
    
    public function traer_observaciones_procuraduria($id_procuraduria)
    {
        $observaciones = DB::connection('gerencia_catastro')->table('procuraduria.dte_procuraduria')->where("id_mtr_procuraduria",$id_procuraduria)->orderBy('fecha_registro','desc')->get();
        if ($observaciones->count()) 
        {
            return $observaciones;
        }
        else
        {
            return 0;
        }
    }
    
    public function abrir_reporte_procuraduria(Request $request)
    { 
        $sql = DB::connection('gerencia_catastro')->table('procuraduria.vw_procuraduria')->where('id_procuraduria',$request['id_procuraduria'])->first();
        $observaciones = DB::connection('gerencia_catastro')->table('procuraduria.dte_procuraduria')->where('id_mtr_procuraduria',$sql->id_procuraduria)->get();
        
        if($sql)
        {
            $view =  \View::make('procuraduria.reportes.reporte_procuraduria', compact('sql','observaciones'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("REPORTE EXPEDIENTE PROCURADURIA".".pdf");
        }
        else
        {   return 'No hay datos';}
    }
}
