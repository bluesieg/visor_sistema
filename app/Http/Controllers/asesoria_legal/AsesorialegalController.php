<?php

namespace App\Http\Controllers\asesoria_legal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\asesoria_legal\Abogados;
use App\Models\asesoria_legal\Caso;
use App\Models\asesoria_legal\Materia;
use App\Models\asesoria_legal\Proceso;
use App\Models\asesoria_legal\Tipo;
use App\Models\asesoria_legal\TipoSancion;
use App\Models\asesoria_legal\Mtrasesoria_legal;
use App\Models\asesoria_legal\Dteasesoria_legal;


class AsesorialegalController extends Controller
{
    public function index(Request $request)
    {
        
        if( $request['tipo']=='legal'){
            $abogados = DB::connection('gerencia_catastro')->table('asesoria_legal.abogados')->get();
            $tipos = DB::connection('gerencia_catastro')->table('asesoria_legal.tipo')->get();
            $tipos_sanciones = DB::connection('gerencia_catastro')->table('asesoria_legal.tipo_sancion')->get();
            $materias = DB::connection('gerencia_catastro')->table('asesoria_legal.materia')->get();
            $procesos = DB::connection('gerencia_catastro')->table('asesoria_legal.proceso')->get();
            $casos = DB::connection('gerencia_catastro')->table('asesoria_legal.caso')->get();
            return view('asesoria_legal/vw_asesoria_legal',compact('abogados','tipos','tipos_sanciones','materias','procesos','casos'));
        }
        if( $request['tipo']=='abogados'){
            return view('asesoria_legal/vw_asesoria_abogados');
        }
        if( $request['tipo']=='tipos'){
            return view('asesoria_legal/vw_asesoria_tipo');
        }
        if( $request['tipo']=='t_sancion'){
            return view('asesoria_legal/vw_asesoria_t_sancion');
        }
        if( $request['tipo']=='proceso'){
            return view('asesoria_legal/vw_asesoria_proceso');
        }
        if( $request['tipo']=='materia'){
            return view('asesoria_legal/vw_asesoria_materia');
        }
        if( $request['tipo']=='caso'){
            return view('asesoria_legal/vw_asesoria_caso');
        }
              
    }
    public function create(Request $request)
    {
        if( $request['tipo']=='mtrlegal'){
            return $this->insert_asesoria_mtrlegal($request);
        }
        if( $request['tipo']=='detlegal'){
            return $this->insert_asesoria_detlegal($request);
        }
        if( $request['tipo']=='abogados'){
            return $this->insert_asesoria_abogados($request);
        }
        if( $request['tipo']=='tipos'){
            return $this->insert_asesoria_tipos($request);
        }
        if( $request['tipo']=='t_sancion'){
            return $this->insert_asesoria_t_sancion($request);
        }
        if( $request['tipo']=='proceso'){
            return $this->insert_asesoria_proceso($request);
        }
        if( $request['tipo']=='materia'){
            return $this->insert_asesoria_materia($request);
        }
        if( $request['tipo']=='caso'){
            return $this->insert_asesoria_caso($request);
        }
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id,Request $request)
    {        
        if($id==0 && $request['grid']=='legal' ){
           return $this->grid_asesoria_legal($request['exp']);
        }
        if($id==0 && $request['grid']=='abogados' ){
           return $this->grid_asesoria_abogados($request['nombre']);
        }
        if($id==0 && $request['grid']=='tipos' ){
           return $this->grid_asesoria_tipos($request['descripcion']);
        }
        if($id==0 && $request['grid']=='t_sancion' ){
           return $this->grid_asesoria_t_sancion($request['descripcion']);
        }
        if($id==0 && $request['grid']=='proceso' ){
           return $this->grid_asesoria_proceso($request['descripcion']);
        }
        if($id==0 && $request['grid']=='materia' ){
           return $this->grid_asesoria_materia($request['descripcion']);
        }
        if($id==0 && $request['grid']=='caso' ){
           return $this->grid_asesoria_caso($request['descripcion']);
        }
        if($id>0)
        {
            if($request['show']=='legal' ){
                return $this->show_asesoria_legal($id);
            }
            if($request['show']=='abogados' ){
                return $this->show_asesoria_abogados($id);
            }
            if($request['show']=='tipos' ){
                return $this->show_asesoria_tipos($id);
            }
            if($request['show']=='t_sancion' ){
                return $this->show_asesoria_t_sancion($id);
            }
            if($request['show']=='proceso' ){
                return $this->show_asesoria_proceso($id);
            }
            if($request['show']=='materia' ){
                return $this->show_asesoria_materia($id);
            }
            if($request['show']=='caso' ){
                return $this->show_asesoria_caso($id);
            }
        }
    }
    public function edit($id, Request $request)
    {
        if( $request['tipo']=='legal'){
            return $this->edit_asesoria_legal($id);
        }
        if( $request['tipo']=='abogados'){
            return $this->edit_asesoria_abogados($id,$request);
        }
        if( $request['tipo']=='tipos'){
            return $this->edit_asesoria_tipos($id,$request);
        }
        if( $request['tipo']=='t_sancion'){
            return $this->edit_asesoria_t_sancion($id,$request);
        }
        if( $request['tipo']=='proceso'){
            return $this->edit_asesoria_proceso($id,$request);
        }
        if( $request['tipo']=='materia'){
            return $this->edit_asesoria_materia($id,$request);
        }
        if( $request['tipo']=='caso'){
            return $this->edit_asesoria_caso($id,$request);
        }
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    ///////////////////// GRILLAS ///////////////////////////
     public function grid_asesoria_legal($exp)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from asesoria_legal.mtr_asesoria_legal where nro_expediente like '%".strtoupper($exp)."%'");
        $sql = DB::connection('gerencia_catastro')->table('asesoria_legal.mtr_asesoria_legal')->where('nro_expediente','like', '%'.strtoupper($exp).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_asesoria_legal;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_asesoria_legal),
                trim($Datos->nro_expediente),
                trim($Datos->gestor),   
                trim($Datos->fecha_inicio_tramite),   
                trim($Datos->fecha_registro),   
            );
        }
        return response()->json($Lista);
    }
    public function grid_asesoria_abogados($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from asesoria_legal.vw_abogados where nombre like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('asesoria_legal.vw_abogados')->where('nombre','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_abogado;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_abogado),
                trim($Datos->dni),
                trim($Datos->nombre),   
            );
        }
        return response()->json($Lista);
    }
    public function grid_asesoria_tipos($descripcion)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from asesoria_legal.vw_tipo where descripcion like '%".strtoupper($descripcion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('asesoria_legal.vw_tipo')->where('descripcion','like', '%'.strtoupper($descripcion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
    public function grid_asesoria_t_sancion($descripcion)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from asesoria_legal.vw_tipo_sancion where descripcion like '%".strtoupper($descripcion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('asesoria_legal.vw_tipo_sancion')->where('descripcion','like', '%'.strtoupper($descripcion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
    public function grid_asesoria_proceso($descripcion)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from asesoria_legal.vw_proceso where descripcion like '%".strtoupper($descripcion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('asesoria_legal.vw_proceso')->where('descripcion','like', '%'.strtoupper($descripcion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
    public function grid_asesoria_materia($descripcion)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from asesoria_legal.vw_materia where descripcion like '%".strtoupper($descripcion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('asesoria_legal.vw_materia')->where('descripcion','like', '%'.strtoupper($descripcion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
    public function grid_asesoria_caso($descripcion)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from asesoria_legal.vw_caso where descripcion like '%".strtoupper($descripcion)."%'");
        $sql = DB::connection('gerencia_catastro')->table('asesoria_legal.vw_caso')->where('descripcion','like', '%'.strtoupper($descripcion).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
   
    ///////////////////// INSERT  ///////////////////////////
    public function insert_asesoria_mtrlegal($request)
    {
        $Mtrasesoria_legal = new Mtrasesoria_legal;
        $Mtrasesoria_legal->nro_expediente           = $request['nro_expediente'];
        $Mtrasesoria_legal->id_gestor        = $request['id_gestor'];
        $Mtrasesoria_legal->gestor      = $request['gestor'];
        $Mtrasesoria_legal->nro_doc_gestor  = $request['dni'];
        $Mtrasesoria_legal->fecha_registro  = date('d-m-Y');
        $Mtrasesoria_legal->fecha_inicio_tramite  = $request['fecha_ini'];
        $Mtrasesoria_legal->id_responsable  = $request['id_responsable'];
        $Mtrasesoria_legal->id_tipo  = $request['id_tipo'];
        $Mtrasesoria_legal->id_hab_urb  = $request['id_hab_urba'];
        $Mtrasesoria_legal->nomb_hab_urb  = $request['hab_urba'];
        $Mtrasesoria_legal->cod_catastral  = $request['codigo_catastral'];
        $Mtrasesoria_legal->id_tipo_sancion  = $request['id_tipo_sancion'];
        $Mtrasesoria_legal->id_materia  = $request['id_materia'];
        $Mtrasesoria_legal->id_proceso  = $request['id_proceso'];
        $Mtrasesoria_legal->id_caso  = $request['id_caso'];
        $Mtrasesoria_legal->referencia  = $request['referencia'];
        $Mtrasesoria_legal->procedimiento  = $request['procedimiento'];
        
        $Mtrasesoria_legal->save();
        
        return response()->json([
            'id_asesoria_legal' => $Mtrasesoria_legal->id_asesoria_legal,
        ]);
    }
    public function insert_asesoria_detlegal($request)
    {
        $Dteasesoria_legal = new Dteasesoria_legal;
        $Dteasesoria_legal->id_mtr_asesoria_legal   = $request['id_asesoria'];
        $Dteasesoria_legal->fecha_registro        = date('d-m-Y');
        $Dteasesoria_legal->observaciones         = $request['observacion'];
        
        $Dteasesoria_legal->save();
        
        return $Dteasesoria_legal->id_det_asesoria_legal;
    }
    public function insert_asesoria_abogados($request)
    {
        $select=DB::connection('gerencia_catastro')->table('asesoria_legal.vw_abogados')->where('dni',$request['dni'])->get(); 
        if (count($select)>0) 
        {       
            return response()->json([
            'msg' => 'repetido',
        ]);
        }else{
            $Abogados = new Abogados;
            $Abogados->dni = $request['dni'];
            $Abogados->nombre = strtoupper($request['nombre']);
            $Abogados->save();

            return $Abogados->id_abogado;
        }
    }
    public function insert_asesoria_tipos($request)
    {
        $Tipo = new Tipo;
        $Tipo->descripcion = strtoupper($request['descripcion']);
        $Tipo->save();

        return $Tipo->id_tipo ;
    }
    public function insert_asesoria_t_sancion($request)
    {
        $TipoSancion = new TipoSancion;
        $TipoSancion->descripcion = strtoupper($request['descripcion']);
        $TipoSancion->save();

        return $TipoSancion->id_tipo_sancion ;
    }
    public function insert_asesoria_proceso($request)
    {
        $Proceso = new Proceso;
        $Proceso->descripcion = strtoupper($request['descripcion']);
        $Proceso->save();

        return $Proceso->id_proceso;
    }
    public function insert_asesoria_materia($request)
    {
        $Materia = new Materia;
        $Materia->descripcion = strtoupper($request['descripcion']);
        $Materia->save();

        return $Materia->id_materia;
    }
    public function insert_asesoria_caso($request)
    {
        $Caso = new Caso;
        $Caso->descripcion = strtoupper($request['descripcion']);
        $Caso->save();

        return $Caso->id_caso;
    }
    
    ////////////////// SHOW /////////////////////////////////
    
    public function show_asesoria_legal($codigo_expediente) {  
        $expedientes = DB::connection("sql_crud")->table('vw_catastro')->where('codigoTramite',strtoupper($codigo_expediente))->first();
        
        //$select=DB::connection('gerencia_catastro')->table('soft_lic_edificacion.registro_expediente')->where('nro_exp',$codigo)->get();
        
        if($expedientes)
        {
            /*if (count($select)>=1) {
                
                return response()->json([
                'msg' => 'repetido',
                ]);
                
            }else{*/  
            return response()->json([
                'msg' => 'si',
                'id_gestor'     => $expedientes->idInteresado,
                'gestor'        => $expedientes->nombres,
                'dni'           => $expedientes->numeroIdentificacion,
                'fecha_inicio'  => $expedientes->iniciado,
            ]);
                
            //}
            
        }else{
            return response()->json([
                'msg' => 'no',
            ]);
        }
    }
    public function show_asesoria_abogados($id){
        $abogados= DB::connection('gerencia_catastro')->table('asesoria_legal.vw_abogados')->where('id_abogado',$id)->get();
            return $abogados;
    }
    public function show_asesoria_tipos($id) {
        $tipo= DB::connection('gerencia_catastro')->table('asesoria_legal.vw_tipo')->where('id_tipo',$id)->get();
            return $tipo;
    }
    public function show_asesoria_t_sancion($id) {  
        $tipo_sancion = DB::connection('gerencia_catastro')->table('asesoria_legal.vw_tipo_sancion')->where('id_tipo_sancion',$id)->get();
            return $tipo_sancion;
    }
    public function show_asesoria_proceso($id) {
        $proceso = DB::connection('gerencia_catastro')->table('asesoria_legal.vw_proceso')->where('id_proceso',$id)->get();
            return $proceso;
    }
    public function show_asesoria_materia($id) {  
        $materia = DB::connection('gerencia_catastro')->table('asesoria_legal.vw_materia')->where('id_materia',$id)->get();
            return $materia;
    }
    public function show_asesoria_caso($id) {
        $casos = DB::connection('gerencia_catastro')->table('asesoria_legal.vw_caso')->where('id_caso',$id)->get();
            return $casos;
    }
    
    ////////////////// EDIT /////////////////////////////////
    public function edit_asesoria_legal($id, Request $request){}
    public function edit_asesoria_abogados($id, Request $request) {
        $select=DB::connection('gerencia_catastro')->table('asesoria_legal.vw_abogados')->where('dni',strtoupper($request['dni']))->where('id_abogado','<>',$id)->get();
        if (count($select)>0) {

             return response()->json([
                'msg' => 'repetido',
                ]);

        }else{

            $Abogados = new Abogados;
            $val=  $Abogados::where("id_abogado","=",$id )->first();
            if($val)
            {
                $val->dni = $request['dni'];
                $val->nombre = strtoupper($request['nombre']);
                $val->save();
            }
            return $id;

        }  
    }
    public function edit_asesoria_tipos($id_tipo, Request $request){
        $Tipo = new Tipo;
        $val=  $Tipo::where("id_tipo","=",$id_tipo )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_tipo;
    }
    public function edit_asesoria_t_sancion($id_tipo_sancion, Request $request){
        $TipoSancion = new TipoSancion;
        $val=  $TipoSancion::where("id_tipo_sancion","=",$id_tipo_sancion )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_tipo_sancion;
    }
    public function edit_asesoria_proceso($id_proceso, Request $request){
        $Proceso = new Proceso;
        $val=  $Proceso::where("id_proceso","=",$id_proceso )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_proceso;
    }
    public function edit_asesoria_materia($id_materia, Request $request){
        $Materia = new Materia;
        $val=  $Materia::where("id_materia","=",$id_materia )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_materia;
    }
    public function edit_asesoria_caso($id_caso, Request $request){
        $Caso = new Caso;
        $val=  $Caso::where("id_caso","=",$id_caso )->first();
        if($val)
        {
            $val->descripcion = strtoupper($request['descripcion']);
            $val->save();
        }
        return $id_caso;
    }


}
