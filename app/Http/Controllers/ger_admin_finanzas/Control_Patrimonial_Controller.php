<?php

namespace App\Http\Controllers\ger_admin_finanzas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\geren_admin_finanzas\Cpatrimonial;
use App\Models\geren_admin_finanzas\Observaciones_cpatrimonial;


class Control_Patrimonial_Controller extends Controller
{
    public function index()
    {        
       return view('ger_admin_finanzas/vw_control_patrimonial');
    }
     
    public function create(Request $request)
    {
        if( $request['tipo']=='cpatrimonial'){
            return $this->insert_cpatrimonial($request);
        }        
        if( $request['tipo']=='observaciones_cpatrimonial'){
            return $this->insert_observaciones_1($request);
        }              
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id,Request $request)
    {            
        
        if($id==0 && $request['grid']=='cpatrimonial' ){
           return $this->grid_cpatrimonial($request['nombre']);
        }       
        if($id==0 && $request['grid']=='table_observaciones_cpatrimonial'){
           return $this->grid_observaciones_1($request);
        }            
        if($id>0)
        {
            if($request['show']=='cpatrimonial' ){
                return $this->show_cpatrimonial($id);
            }                      
            if($request['show']=='observaciones_cpatrimonial' ){
                return $this->show_observaciones_1($id);
            }               
        }
    }
    public function edit($id, Request $request)
    {
        if( $request['tipo']=='cpatrimonial'){
            return $this->edit_cpatrimonial($id,$request);
        }        
        if( $request['tipo']=='observaciones_cpatrimonial'){
            return $this->editar_observaciones_1($id,$request);
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
    }
    ///////////////////// GRILLAS ///////////////////////////
       public function grid_cpatrimonial($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_admin_finanzas.vw_cpatrimonial where persona like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_admin_finanzas.vw_cpatrimonial')->where('persona','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_cpatrimonial;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_cpatrimonial),
                trim($Datos->fecha), 
                trim($Datos->partida_registral),
                 trim($Datos->cod_patrimonial),
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_admin_finanzas.observaciones_cpatrimonial where id_cpatrimonial = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_admin_finanzas.observaciones_cpatrimonial')->where('id_cpatrimonial',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_admin_finanzas.observaciones_cpatrimonial where id_cpatrimonial = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_admin_finanzas.observaciones_cpatrimonial')->where('id_cpatrimonial',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
    public function insert_cpatrimonial($request)
    {
        $Cpatrimonial = new Cpatrimonial;
        $Cpatrimonial->fecha= date('d-m-Y');
        $Cpatrimonial->direccion=strtoupper($request['direccion']);
        $Cpatrimonial->id_persona=$request['id_persona'];
        $Cpatrimonial->id_lote=$request['id_lote'];
        $Cpatrimonial->cod_catastral=$request['cod_catastral'];
        $Cpatrimonial->partida_registral=$request['partida_registral'];
        $Cpatrimonial->cod_patrimonial=$request['cod_patrimonial'];
        $Cpatrimonial->cod_urbano=$request['cod_urbano'];
        $Cpatrimonial->cod_numeracion=$request['cod_numeracion'];
        $Cpatrimonial->num_expediente=$request['num_expediente'];
        $Cpatrimonial->anio=$request['anio'];
        $Cpatrimonial->referencia=strtoupper($request['referencia']);
        $Cpatrimonial->id_uso=$request['id_uso'];
        $Cpatrimonial->sinabif=$request['sinabif'];
        $Cpatrimonial->id_situacion=$request['id_situacion'];
        $Cpatrimonial->id_estado=$request['id_estado'];
        $Cpatrimonial->id_proceso=$request['id_proceso'];                
        $Cpatrimonial->save();
        
        return response()->json([
            'id_cpatrimonial' => $Cpatrimonial->id_cpatrimonial,
        ]);
    }
    
    public function insert_observaciones_1($request)
    {
        $Observaciones_cpatrimonial = new Observaciones_cpatrimonial;
        $Observaciones_cpatrimonial->id_cpatrimonial   = $request['id_cpatrimonial'];
        $Observaciones_cpatrimonial->fecha_registro= date('d-m-Y');
        $Observaciones_cpatrimonial->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_cpatrimonial->save();
        
        return $Observaciones_cpatrimonial->id_observaciones;
    }
   
 
    ////////////////// SHOW /////////////////////////////////
    
   public function show_cpatrimonial($id){
        $cpatrimonial= DB::connection('gerencia_catastro')->table('geren_admin_finanzas.cpatrimonial')->where('id_cpatrimonial',$id)->get();
            return $cpatrimonial;
    }  
   public function show_observaciones_1($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_admin_finanzas.observaciones_cpatrimonial')->where('id_observaciones',$id)->get();
        return $observaciones;
    }
   
    ////////////////// EDIT /////////////////////////////////
     public function edit_cpatrimonial($id, Request $request)
    {
        $Cpatrimonial = new Cpatrimonial;
        $val=  $Cpatrimonial::where("id_cpatrimonial","=",$id )->first();
        if($val)
        {
            $val->fecha= date('d-m-Y');
        $val->direccion=strtoupper($request['direccion']);
        $val->id_persona=$request['id_persona'];
        $val->id_lote=$request['id_lote'];
        $val->cod_catastral=$request['cod_catastral'];
        $val->partida_registral=$request['partida_registral'];
        $val->cod_patrimonial=$request['cod_patrimonial'];
        $val->cod_urbano=$request['cod_urbano'];
        $val->cod_numeracion=$request['cod_numeracion'];
        $val->num_expediente=$request['num_expediente'];
        $val->anio=$request['anio'];
        $val->referencia=strtoupper($request['referencia']);
        $val->id_uso=$request['id_uso'];
        $val->sinabif=$request['sinabif'];
        $val->id_situacion=$request['id_situacion'];
        $val->id_estado=$request['id_estado'];
        $val->id_proceso=$request['id_proceso'];   
            $val->save();
        }
        return $id;        
    }  
    public function editar_observaciones_1($id,Request $request)
    {
        $Observaciones_cpatrimonial = new Observaciones_cpatrimonial;
        $val=  $Observaciones_cpatrimonial::where("id_observaciones","=",$id )->first();
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
        $Observaciones_cpatrimonial = new Observaciones_cpatrimonial;
        $val=  $Observaciones_cpatrimonial::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
  
}
