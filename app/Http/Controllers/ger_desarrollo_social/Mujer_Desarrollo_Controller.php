<?php

namespace App\Http\Controllers\ger_desarrollo_social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\gerencia_desa_social\Ciam;
use App\Models\gerencia_desa_social\Demuna;
use App\Models\gerencia_desa_social\Omaped;
use App\Models\gerencia_desa_social\Observaciones_ciam;
use App\Models\gerencia_desa_social\Observaciones_demuna;
use App\Models\gerencia_desa_social\Observaciones_omaped;



class Mujer_Desarrollo_Controller extends Controller
{
    public function index()
    {        
       return view('ger_desarrollo_social/vw_mujer_desarrollo');
    }
     
    public function create(Request $request)
    {
        if( $request['tipo']=='ciam'){
            return $this->insert_ciam($request);
        }
        if( $request['tipo']=='demuna'){
            return $this->insert_demuna($request);
        }
        if( $request['tipo']=='omaped'){
            return $this->insert_omaped($request);
        }
        if( $request['tipo']=='observaciones_ciam'){
            return $this->insert_observaciones_1($request);
        }
        if( $request['tipo']=='observaciones_demuna'){
            return $this->insert_observaciones_2($request);
        }
        if( $request['tipo']=='observaciones_omaped'){
            return $this->insert_observaciones_3($request);
        }        
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id,Request $request)
    {            
        
        if($id==0 && $request['grid']=='ciam' ){
           return $this->grid_ciam($request['nombre']);
        }
        if($id==0 && $request['grid']=='demuna' ){
           return $this->grid_demuna($request['nombre']);
        }
        if($id==0 && $request['grid']=='omaped' ){
           return $this->grid_omaped($request['nombre']);
        }
        if($id==0 && $request['grid']=='table_observaciones_ciam'){
           return $this->grid_observaciones_1($request);
        }
        if($id==0 && $request['grid']=='table_observaciones_demuna'){
           return $this->grid_observaciones_2($request);
        }
        if($id==0 && $request['grid']=='table_observaciones_omaped'){
           return $this->grid_observaciones_3($request);
        }
        if($request['mapa']=='ciam' ){
            return $this->cargar_mapa_ciam($request);
        } 
        if($request['mapa']=='demuna' ){
            return $this->cargar_mapa_demuna($request);
        } 
        if($request['mapa']=='omaped' ){
            return $this->cargar_mapa_omaped($request);
        } 
        if($request['mapa']=='colegio' ){
            return $this->cargar_mapa_colegio($request);
        } 
        if($request['mapa']=='ccultural' ){
            return $this->cargar_mapa_ccultural($request);
        } 
        if($request['mapa']=='cdeportivo' ){
            return $this->cargar_mapa_cdeportivo($request);
        } 
        if($request['mapa']=='sisfoh' ){
            return $this->cargar_mapa_sisfoh($request);
        }
        if($request['mapa']=='pension' ){
            return $this->cargar_mapa_pension($request);
        }
        if($request['mapa']=='comedores' ){
            return $this->cargar_mapa_comedores($request);
        }
        if($request['mapa']=='vaso' ){
            return $this->cargar_mapa_vaso($request);
        }
        if($request['mapa']=='bienestar' ){
            return $this->cargar_mapa_bienestar($request);
        }
        if($request['mapa']=='asociaciones' ){
            return $this->cargar_mapa_asociaciones($request);
        }
        if($id>0)
        {
            if($request['show']=='ciam' ){
                return $this->show_ciam($id);
            }   
            if($request['show']=='demuna' ){
                return $this->show_demuna($id);
            } 
            if($request['show']=='omaped' ){
                return $this->show_omaped($id);
            }                      
            if($request['show']=='observaciones_ciam' ){
                return $this->show_observaciones_1($id);
            }   
            if($request['show']=='observaciones_demuna' ){
                return $this->show_observaciones_2($id);
            } 
            if($request['show']=='observaciones_omaped' ){
                return $this->show_observaciones_3($id);
            }
        }
    }
    public function edit($id, Request $request)
    {
        if( $request['tipo']=='ciam'){
            return $this->edit_ciam($id,$request);
        }
        if( $request['tipo']=='demuna'){
            return $this->edit_demuna($id,$request);
        } 
        if( $request['tipo']=='omaped'){
            return $this->edit_omaped($id,$request);
        }
        if( $request['tipo']=='observaciones_ciam'){
            return $this->editar_observaciones_1($id,$request);
        }
        if( $request['tipo']=='observaciones_demuna'){
            return $this->editar_observaciones_2($id,$request);
        }
        if( $request['tipo']=='observaciones_omaped'){
            return $this->editar_observaciones_3($id,$request);
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
            return $this->eliminar_observaciones_1($request);
        }
        if ($request['tipo'] == 2) 
        {
            return $this->eliminar_observaciones_2($request);
        }
        if ($request['tipo'] == 3) 
        {
            return $this->eliminar_observaciones_3($request);
        }
    }
    ///////////////////// GRILLAS ///////////////////////////
       public function grid_ciam($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.vw_ciam where persona like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.vw_ciam')->where('persona','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_ciam;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_ciam),
                trim($Datos->fecha), 
                trim($Datos->cod_catastral),
                trim($Datos->pers_nro_doc),
                trim($Datos->persona)
            );
        }
        return response()->json($Lista);
    }
     public function grid_demuna($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.vw_demuna where persona like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.vw_demuna')->where('persona','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_demuna;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_demuna),
                trim($Datos->fecha), 
                trim($Datos->cod_catastral),
                trim($Datos->pers_nro_doc),
                trim($Datos->persona)
            );
        }
        return response()->json($Lista);
    }
     public function grid_omaped($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.vw_omaped where persona like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.vw_omaped')->where('persona','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_omaped;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_omaped),
                trim($Datos->fecha), 
                trim($Datos->cod_catastral),
                trim($Datos->pers_nro_doc),
                trim($Datos->persona)
            );
        }
        return response()->json($Lista);
    }
     public function grid_observaciones_1(Request $request)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_ciam where id_ciam = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_ciam')->where('id_ciam',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_ciam where id_ciam = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_ciam')->where('id_ciam',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $Lista->rows[$Index]['id'] = $Datos->id_observaciones;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_observaciones),
                trim($Datos->fecha_registro),
                trim($Datos->observaciones)  
            );
        }
        return response()->json($Lista);
    }
     public function grid_observaciones_2(Request $request)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_demuna where id_demuna = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_demuna')->where('id_demuna',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_demuna where id_demuna = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_demuna')->where('id_demuna',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $Lista->rows[$Index]['id'] = $Datos->id_observaciones;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_observaciones),
                trim($Datos->fecha_registro),
                trim($Datos->observaciones)  
            );
        }
        return response()->json($Lista);
    }
     public function grid_observaciones_3(Request $request)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_omaped where id_omaped = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_omaped')->where('id_omaped',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_omaped where id_omaped  = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_omaped')->where('id_omaped',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $Lista->rows[$Index]['id'] = $Datos->id_observaciones;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_observaciones),
                trim($Datos->fecha_registro),
                trim($Datos->observaciones)  
            );
        }
        return response()->json($Lista);
    }
   
     ///////////////////// INSERT  ///////////////////////////
    public function insert_ciam($request)
    {
        $Ciam = new Ciam;
        $Ciam->fecha= date('d-m-Y');
        $Ciam->direccion=strtoupper($request['direccion']);
        $Ciam->id_local=$request['id_local'];
        $Ciam->id_persona=$request['id_persona'];
        $Ciam->id_lote=$request['id_lote'];
        $Ciam->cod_catastral=$request['cod_catastral'];  
        
        $Ciam->save();
        
        return response()->json([
            'id_ciam' => $Ciam->id_ciam,
        ]);
    }
     public function insert_demuna($request)
    {
        $Demuna = new Demuna;
        $Demuna->fecha  = date('d-m-Y');
        $Demuna->id_persona=$request['id_persona'];
        $Demuna->direccion= strtoupper($request['direccion']);
        $Demuna->id_lote=$request['id_lote'];
        $Demuna->cod_catastral=$request['cod_catastral'];             
        $Demuna->id_albergue=$request['id_albergue'];
        $Demuna->id_comisaria=$request['id_comisaria'];
        $Demuna->id_tipo_delito=$request['id_tipo_delito'];
        $Demuna->save();
        
        return response()->json([
            'id_demuna' => $Demuna->id_demuna,
        ]);
    }
     public function insert_omaped($request)
    {
        $Omaped = new Omaped;
        $Omaped->fecha  = date('d-m-Y');
        $Omaped->id_persona=$request['id_persona'];
        $Omaped->direccion= strtoupper($request['direccion']);
        $Omaped->id_lote=$request['id_lote'];
        $Omaped->cod_catastral=$request['cod_catastral'];             
        $Omaped->id_albergue=$request['id_albergue'];
        $Omaped->id_local=$request['id_local'];
        $Omaped->save();
        
        return response()->json([
            'id_omaped' => $Omaped->id_omaped,
        ]);
    }
    public function insert_observaciones_1($request)
    {
        $Observaciones_ciam = new Observaciones_ciam;
        $Observaciones_ciam->id_ciam   = $request['id_ciam'];
        $Observaciones_ciam->fecha_registro= date('d-m-Y');
        $Observaciones_ciam->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_ciam->save();
        
        return $Observaciones_ciam->id_observaciones;
    }
    public function insert_observaciones_2($request)
    {
        $Observaciones_demuna = new Observaciones_demuna;
        $Observaciones_demuna->id_demuna   = $request['id_demuna'];
        $Observaciones_demuna->fecha_registro= date('d-m-Y');
        $Observaciones_demuna->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_demuna->save();
        
        return $Observaciones_demuna->id_observaciones;
    }
    public function insert_observaciones_3($request)
    {
        $Observaciones_omaped = new Observaciones_omaped;
        $Observaciones_omaped->id_omaped   = $request['id_omaped'];
        $Observaciones_omaped->fecha_registro= date('d-m-Y');
        $Observaciones_omaped->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_omaped->save();
        
        return $Observaciones_omaped->id_observaciones;
    }
 
    ////////////////// SHOW /////////////////////////////////
    
   public function show_ciam($id){
        $ciam= DB::connection('gerencia_catastro')->table('geren_desa_social.vw_ciam')->where('id_ciam',$id)->get();
            return $ciam;
    }
   public function show_demuna($id){
        $demuna= DB::connection('gerencia_catastro')->table('geren_desa_social.vw_demuna')->where('id_demuna',$id)->get();
            return $demuna;
    }
   public function show_omaped($id){
        $omaped= DB::connection('gerencia_catastro')->table('geren_desa_social.vw_omaped')->where('id_omaped',$id)->get();
            return $omaped;
    }
   public function show_observaciones_1($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_ciam')->where('id_observaciones',$id)->get();
        return $observaciones;
    }
   public function show_observaciones_2($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_demuna')->where('id_observaciones',$id)->get();
        return $observaciones;
    }
   public function show_observaciones_3($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_omaped')->where('id_observaciones',$id)->get();
        return $observaciones;
    }

    ////////////////// EDIT /////////////////////////////////
     public function edit_ciam($id, Request $request)
    {
        $Ciam = new Ciam;
        $val=  $Ciam::where("id_ciam","=",$id )->first();
        if($val)
        {
            $val->fecha  = date('d-m-Y');
            $val->direccion=strtoupper($request['direccion']);
            $val->id_local=$request['id_local'];
            $val->id_persona=$request['id_persona'];
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];  
            $val->save();
        }
        return $id;        
    }
     public function edit_demuna($id, Request $request)
    {
        $Demuna = new Demuna;
        $val=  $Demuna::where("id_demuna","=",$id )->first();
        if($val)
        {
            $val->fecha  = date('d-m-Y');
            $val->id_persona=$request['id_persona'];
            $val->direccion= strtoupper($request['direccion']);
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];             
            $val->id_albergue=$request['id_albergue'];
            $val->id_comisaria=$request['id_comisaria'];
            $val->id_tipo_delito=$request['id_tipo_delito']; 
            $val->save();
        }
        return $id;   
       
    }
     public function edit_omaped($id, Request $request)
    {
       $Omaped = new Omaped;
        $val=  $Omaped::where("id_omaped","=",$id )->first();
        if($val)
        {
            $val->fecha  = date('d-m-Y');
            $val->id_persona=$request['id_persona'];
            $val->direccion= strtoupper($request['direccion']);
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];             
            $val->id_albergue=$request['id_albergue'];
            $val->id_local=$request['id_local'];
            $val->save(); 
        }
        return $id;    
    }
    public function editar_observaciones_1($id,Request $request)
    {
        $Observaciones_ciam = new Observaciones_ciam;
        $val=  $Observaciones_ciam::where("id_observaciones","=",$id )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id;
    }
    public function editar_observaciones_2($id,Request $request)
    {
        $Observaciones_demuna = new Observaciones_demuna;
        $val=  $Observaciones_demuna::where("id_observaciones","=",$id )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id;
    }
    public function editar_observaciones_3($id,Request $request)
    {
        $Observaciones_omaped = new Observaciones_omaped;
        $val=  $Observaciones_omaped::where("id_observaciones","=",$id )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id;
    }
   
    ////////////////// DESTROY /////////////////////////////////
    public function eliminar_observaciones_1(Request $request)
    {
        $Observaciones_ciam = new Observaciones_ciam;
        $val=  $Observaciones_ciam::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
    public function eliminar_observaciones_2(Request $request)
    {
        $Observaciones_demuna = new Observaciones_demuna;
        $val=  $Observaciones_demuna::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
    public function eliminar_observaciones_3(Request $request)
    {
        $Observaciones_omaped = new Observaciones_omaped;
        $val=  $Observaciones_omaped::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
    
    // mapaaaaasssssssssssss
    public function cargar_mapa_ciam(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_ciam where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $ciam = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_ciam',id_ciam,
                                'direccion',direccion,
                                'pers_nro_doc',pers_nro_doc,
                                'persona',persona,
                                'pers_fnac',pers_fnac,
                                'descripcion',descripcion,
                                'nomb_hab_urba',nomb_hab_urba,
                                'cod_catastral',cod_catastral
                                )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_ciam where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($ciam);
        }
        else
        {
            return 0; 
        }
    }
    public function cargar_mapa_demuna(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_demuna where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $demuna = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(                                
                                'id_demuna',id_demuna,
                                'direccion',direccion,
                                'pers_nro_doc',pers_nro_doc,
                                'persona',persona,
                                'pers_fnac',pers_fnac,
                                'nomb_hab_urba',nomb_hab_urba,
                                'cod_catastral',cod_catastral,
                                'albergue',albergue,
                                'direccion',delito,
                                'nombre',nombre
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_demuna where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($demuna);
        }
        else
        {
            return 0; 
        }
    }
    public function cargar_mapa_omaped(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_omaped where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $omaped = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_omaped',id_omaped,                                
                                'direccion',direccion,
                                'pers_nro_doc',pers_nro_doc,
                                'persona',persona,
                                'pers_fnac',pers_fnac,
                                'local',local,
                                'nomb_hab_urba',nomb_hab_urba,
                                'cod_catastral',cod_catastral,
                                'albergue',albergue                                
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_omaped where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($omaped);
        }
        else
        {
            return 0; 
        }
    }
      public function cargar_mapa_colegio(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_colegios1 where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $colegio = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'direccion',direccion
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_colegios1 where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($colegio);
        }
        else
        {
            return 0; 
        }
    }
      public function cargar_mapa_ccultural(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_c_cultural where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $ccultural = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_ccultural',id_ccultural,
                                'direccion',direccion
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_c_cultural where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($ccultural);
        }
        else
        {
            return 0; 
        }
    }
      public function cargar_mapa_cdeportivo(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_c_deportivo where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $cdeportivo = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_cdeportivo',id_cdeportivo,
                                'direccion',direccion
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_c_deportivo where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($cdeportivo);
        }
        else
        {
            return 0; 
        }
    }
    public function cargar_mapa_sisfoh(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_sisfoh where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $sisfoh = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_sisfoh',id_sisfoh,
                                'direccion',direccion
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_sisfoh where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($sisfoh);
        }
        else
        {
            return 0; 
        }
    }
    public function cargar_mapa_pension(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_pension_65 where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $pension = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_pension',id_pension,
                                'direccion',direccion
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_pension_65 where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($pension);
        }
        else
        {
            return 0; 
        }
    }
    public function cargar_mapa_comedores(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_comedores_populares where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $comedores = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_comedores',id_comedores,
                                'direccion',direccion
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_comedores_populares where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($comedores);
        }
        else
        {
            return 0; 
        }
    }
    public function cargar_mapa_vaso(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_vaso_leche where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $vaso = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_vaso',id_vaso,
                                'direccion',direccion
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_vaso_leche where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($vaso);
        }
        else
        {
            return 0; 
        }
    }
    public function cargar_mapa_bienestar(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_bienestar_social where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $bienestar = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_bienestar',id_bienestar,
                                'direccion',direccion
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_bienestar_social where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($bienestar);
        }
        else
        {
            return 0; 
        }
    }
    public function cargar_mapa_asociaciones(Request $request)
    {
        $id_hab_urb = $request['id_hab_urb'];
        
        $sql = DB::connection('gerencia_catastro')->select("select * from geren_desa_social.vw_asociaciones where id_hab_urb = $id_hab_urb");
        
        if($sql)
        {
            $asociaciones = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_asociaciones',id_asociaciones,
                                'direccion',direccion
                             )
                          ) AS feature
                          FROM (SELECT * FROM geren_desa_social.vw_asociaciones where id_hab_urb = $id_hab_urb) row) features;");

            return response()->json($asociaciones);
        }
        else
        {
            return 0; 
        }
    }
    
}
