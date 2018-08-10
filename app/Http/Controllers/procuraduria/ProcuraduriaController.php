<?php

namespace App\Http\Controllers\procuraduria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\procuraduria\Mtrprocuraduria;
use App\Models\procuraduria\Dteprocuraduria;
use App\Models\procuraduria\Documentos_Adjuntos;
use Illuminate\Support\Facades\Response;

class ProcuraduriaController extends Controller
{
    public function index()
    {
        $abogados = DB::connection('gerencia_catastro')->table('procuraduria.abogados')->get();
        $tipos = DB::connection('gerencia_catastro')->table('procuraduria.tipo')->get();
        $tipos_sanciones = DB::connection('gerencia_catastro')->table('procuraduria.tipo_sancion')->get();
        $materias = DB::connection('gerencia_catastro')->table('procuraduria.materia')->get();
        $procesos = DB::connection('gerencia_catastro')->table('procuraduria.proceso')->get();
        $casos = DB::connection('gerencia_catastro')->table('procuraduria.caso')->get();
        $tip_doc = DB::connection('gerencia_catastro')->select('select * from procuraduria.tipo_documento order by 1');
        return view('procuraduria/wv_procuraduria',compact('abogados','tipos','tipos_sanciones','materias','procesos','casos','tip_doc'));
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
                'gestor'        => $expedientes->nombres,
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
                trim($Datos->fecha_registro),
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
                '<button class="btn btn-labeled btn-warning" type="button" onclick="verfile('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> VER</button>',
                '<button class="btn btn-labeled btn-danger" type="button" onclick="delfile('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-trash"></i></span> BORRAR</button>',
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
        $Mtrprocuraduria->id_responsable  = $request['id_responsable'];
        $Mtrprocuraduria->id_tipo  = $request['id_tipo'];
        $Mtrprocuraduria->id_hab_urb  = $request['id_hab_urba'];
        $Mtrprocuraduria->nomb_hab_urb  = $request['hab_urba'];
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
            $val->id_responsable = $request['id_responsable'];
            $val->id_tipo = $request['id_tipo'];
            $val->id_hab_urb = $request['id_hab_urba'];
            $val->nomb_hab_urb = $request['hab_urba'];
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
}
