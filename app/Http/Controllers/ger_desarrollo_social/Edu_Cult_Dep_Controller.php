<?php

namespace App\Http\Controllers\ger_desarrollo_social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\gerencia_desa_social\Colegios;
use App\Models\gerencia_desa_social\Cdeportivo;
use App\Models\gerencia_desa_social\Ccultural;
use App\Models\gerencia_desa_social\Observaciones_colegios;
use App\Models\gerencia_desa_social\Observaciones_ccultural;
use App\Models\gerencia_desa_social\Observaciones_cdeportivo;





class Edu_Cult_Dep_Controller extends Controller
{
    public function index()
    {
       return view('ger_desarrollo_social/vw_edu_cult_dep');
    }     
    public function create(Request $request)
    {
        if( $request['tipo']=='colegios'){
            return $this->insert_colegio($request);
        }
        if( $request['tipo']=='ccultural'){
            return $this->insert_ccultural($request);
        }
        if( $request['tipo']=='cdeportivo'){
            return $this->insert_cdeportivo($request);
        }
        if( $request['tipo']=='1'){
            return $this->insert_observaciones_1($request);
        }
        if( $request['tipo']=='2'){
            return $this->insert_observaciones_2($request);
        }
        if( $request['tipo']=='3'){
            return $this->insert_observaciones_3($request);
        }
        
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id,Request $request)
    {            
        
        if($id==0 && $request['grid']=='colegios' ){
           return $this->grid_colegio($request['nombre']);
        }
        if($id==0 && $request['grid']=='ccultural' ){
           return $this->grid_cculturales($request['nombre']);
        }
        if($id==0 && $request['grid']=='cdeportivo' ){
           return $this->grid_cdeportivos($request['nombre']);
        }
        if($id==0 && $request['grid']=='table_observaciones_1'){
           return $this->grid_observaciones_1($request);
        }
        if($id==0 && $request['grid']=='table_observaciones_2'){
           return $this->grid_observaciones_2($request);
        }
        if($id==0 && $request['grid']=='table_observaciones_3'){
           return $this->grid_observaciones_3($request);
        }        
        if($id>0)
        {
            if($request['show']=='colegios' ){
                return $this->show_colegios($id);
            }   
            if($request['show']=='cculturales' ){
                return $this->show_cculturales($id);
            } 
            if($request['show']=='cdeportivos' ){
                return $this->show_cdeportivos($id);
            }
            if($request['show']=='colegios' ){
                return $this->show_colegios($id);
            }   
            if($request['show']=='cculturales' ){
                return $this->show_cculturales($id);
            } 
            if($request['show']=='cdeportivos' ){
                return $this->show_cdeportivos($id);
            }            
            if($request['show']=='observaciones_1' ){
                return $this->show_observaciones_1($id);
            }   
            if($request['show']=='observaciones_2' ){
                return $this->show_observaciones_2($id);
            } 
            if($request['show']=='observaciones_3' ){
                return $this->show_observaciones_3($id);
            }
        }
    }
    public function edit($id, Request $request)
    {
        if( $request['tipo']=='colegios'){
            return $this->edit_colegios($id,$request);
        }
        if( $request['tipo']=='cculturales'){
            return $this->edit_cculturales($id,$request);
        } 
        if( $request['tipo']=='cdeportivos'){
            return $this->edit_cdeportivos($id,$request);
        }
        if( $request['tipo']=='observaciones_1'){
            return $this->editar_observaciones_1($id,$request);
        }
        if( $request['tipo']=='observaciones_2'){
            return $this->editar_observaciones_2($id,$request);
        }
        if( $request['tipo']=='observaciones_3'){
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
       public function grid_colegio($cole)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.colegios1 where cen_edu_l like '%".strtoupper($cole)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.colegios1')->where('cen_edu_l','like', '%'.strtoupper($cole).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id),
                trim($Datos->numero), 
                trim($Datos->cen_edu_l),
            );
        }
        return response()->json($Lista);
    }
     public function grid_cculturales($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.c_cultural where nombre like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.c_cultural')->where('nombre','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_ccultural;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_ccultural),
                trim($Datos->cod_catastral),
                trim($Datos->nombre), 
                trim($Datos->direccion)
            );
        }
        return response()->json($Lista);
    }
     public function grid_cdeportivos($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.c_deportivo where nombre like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.c_deportivo')->where('nombre','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_cdeportivo;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_cdeportivo),
                trim($Datos->cod_catastral), 
                trim($Datos->nombre), 
                trim($Datos->direccion)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_colegios where id_colegios = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_colegios')->where('id_colegios',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_colegios where id_colegios = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_colegios')->where('id_colegios',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_ccultural where id_ccultural = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_ccultural')->where('id_ccultural',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_ccultural where id_ccultural = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_ccultural')->where('id_ccultural',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_cdeportivo where id_cdeportivo = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_cdeportivo')->where('id_cdeportivo',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_cdeportivo where id_cdeportivo  = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_cdeportivo')->where('id_cdeportivo',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
    public function insert_colegio($request)
    {
        $Colegios = new Colegios;
        $Colegios->fecha  = date('d-m-Y');
        $Colegios->direccion=strtoupper($request['direccion']);
        $Colegios->cen_edu_l=strtoupper($request['cen_edu_l']);
        $Colegios->numero=$request['numero'];
        $Colegios->nro_alumnos=$request['nro_alumnos'];
        $Colegios->id_tipo=$request['id_tipo'];
        $Colegios->id_persona=$request['id_persona'];
        $Colegios->id_lote=$request['id_lote'];
        $Colegios->cod_catastral=$request['cod_catastral'];  
        
        $Colegios->save();
        
        return response()->json([
            'id' => $Colegios->id,
        ]);
    }
     public function insert_ccultural($request)
    {
        $Ccultural = new Ccultural;
        $Ccultural->fecha  = date('d-m-Y');
        $Ccultural->direccion= strtoupper($request['direccion']);
        $Ccultural->nombre=strtoupper($request['nombre']);        
        $Ccultural->id_tipo=$request['id_tipo'];
        $Ccultural->id_persona=$request['id_persona'];
        $Ccultural->id_lote=$request['id_lote'];
        $Ccultural->cod_catastral=$request['cod_catastral'];             
        $Ccultural->save();
        
        return response()->json([
            'id_ccultural' => $Ccultural->id_ccultural,
        ]);
    }
     public function insert_cdeportivo($request)
    {
        $Cdeportivo = new Cdeportivo;
        $Cdeportivo->fecha  = date('d-m-Y');
        $Cdeportivo->direccion=strtoupper($request['direccion']);
        $Cdeportivo->nombre=strtoupper($request['nombre']);        
        $Cdeportivo->id_tipo=$request['id_tipo'];
        $Cdeportivo->id_persona=$request['id_persona'];
        $Cdeportivo->id_lote=$request['id_lote'];
        $Cdeportivo->cod_catastral=$request['cod_catastral'];             
        $Cdeportivo->save();
        
        return response()->json([
            'id_cdeportivo' => $Cdeportivo->id_cdeportivo,
        ]);
    }
    public function insert_observaciones_1($request)
    {
        $Observaciones_colegios = new Observaciones_colegios;
        $Observaciones_colegios->id_colegios   = $request['id_colegios'];
        $Observaciones_colegios->fecha_registro= date('d-m-Y');
        $Observaciones_colegios->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_colegios->save();
        
        return $Observaciones_colegios->id_observaciones;
    }
    public function insert_observaciones_2($request)
    {
        $Observaciones_ccultural = new Observaciones_ccultural;
        $Observaciones_ccultural->id_ccultural   = $request['id_ccultural'];
        $Observaciones_ccultural->fecha_registro= date('d-m-Y');
        $Observaciones_ccultural->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_ccultural->save();
        
        return $Observaciones_ccultural->id_observaciones;
    }
    public function insert_observaciones_3($request)
    {
        $Observaciones_cdeportivo = new Observaciones_cdeportivo;
        $Observaciones_cdeportivo->id_cdeportivo   = $request['id_cdeportivo'];
        $Observaciones_cdeportivo->fecha_registro= date('d-m-Y');
        $Observaciones_cdeportivo->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_cdeportivo->save();
        
        return $Observaciones_cdeportivo->id_observaciones;
    }
 
    ////////////////// SHOW /////////////////////////////////
    
   public function show_colegios($id){
        $colegios= DB::connection('gerencia_catastro')->table('geren_desa_social.colegios1')->where('id',$id)->get();
            return $colegios;
    }
   public function show_cculturales($id){
        $cculturales= DB::connection('gerencia_catastro')->table('geren_desa_social.c_cultural')->where('id_ccultural',$id)->get();
            return $cculturales;
    }
   public function show_cdeportivos($id){
        $cdeportivos= DB::connection('gerencia_catastro')->table('geren_desa_social.c_deportivo')->where('id_cdeportivo',$id)->get();
            return $cdeportivos;
    }
   public function show_observaciones_1($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_colegios')->where('id_observaciones',$id)->get();
        return $observaciones;
    }
   public function show_observaciones_2($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_ccultural')->where('id_observaciones',$id)->get();
        return $observaciones;
    }
   public function show_observaciones_3($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_cdeportivo')->where('id_observaciones',$id)->get();
        return $observaciones;
    }

    ////////////////// EDIT /////////////////////////////////
     public function edit_colegios($id, Request $request)
    {
        $Colegios = new Colegios;
        $val=  $Colegios::where("id","=",$id )->first();
        if($val)
        {
            $val->fecha  = date('d-m-Y');
            $val->direccion=strtoupper($request['direccion']);
            $val->cen_edu_l=strtoupper($request['cen_edu_l']);
            $val->numero=$request['numero'];
            $val->nro_alumnos=$request['nro_alumnos'];
            $val->id_tipo=$request['id_tipo'];
            $val->id_persona=$request['id_persona'];
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];  
            $val->save();
        }
        return $id;
    }
     public function edit_cculturales($id, Request $request)
    {
        $Ccultural = new Ccultural;
        $val=  $Ccultural::where("id_ccultural","=",$id )->first();
        if($val)
        {
            $val = new Ccultural;
            $val->fecha  = date('d-m-Y');
            $val->direccion= strtoupper($request['direccion']);
            $val->nombre=strtoupper($request['nombre']);        
            $val->id_tipo=$request['id_tipo'];
            $val->id_persona=$request['id_persona'];
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];             
            $val->save();
        }
        return $id;
    }
     public function edit_cdeportivos($id, Request $request)
    {
        $Cdeportivo = new Cdeportivo;
        $val=  $Cdeportivo::where("id_cdeportivo","=",$id )->first();
        if($val)
        {
            $val->fecha  = date('d-m-Y');
            $val->direccion= strtoupper($request['direccion']);
            $val->nombre=strtoupper($request['nombre']);        
            $val->id_tipo=$request['id_tipo'];
            $val->id_persona=$request['id_persona'];
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];             
            $val->save();
            
        }
        return $id;
    }
    public function editar_observaciones_1($id,Request $request)
    {
        $Observaciones_colegios = new Observaciones_colegios;
        $val=  $Observaciones_colegios::where("id_observaciones","=",$id )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id;
    }
    public function editar_observaciones_2($id,Request $request)
    {
        $Observaciones_ccultural = new Observaciones_ccultural;
        $val=  $Observaciones_ccultural::where("id_observaciones","=",$id )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id;
    }
    public function editar_observaciones_3($id,Request $request)
    {
        $Observaciones_cdeportivo = new Observaciones_cdeportivo;
        $val=  $Observaciones_cdeportivo::where("id_observaciones","=",$id )->first();
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
        $Observaciones_colegios = new Observaciones_colegios;
        $val=  $Observaciones_colegios::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
    public function eliminar_observaciones_2(Request $request)
    {
        $Observaciones_ccultural = new Observaciones_ccultural;
        $val=  $Observaciones_ccultural::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
    public function eliminar_observaciones_3(Request $request)
    {
        $Observaciones_cdeportivo = new Observaciones_cdeportivo;
        $val=  $Observaciones_cdeportivo::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
}
