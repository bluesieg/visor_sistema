<?php
namespace App\Http\Controllers\ger_desarrollo_social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\gerencia_desa_social\Sisfoh;
use App\Models\gerencia_desa_social\Pension;
use App\Models\gerencia_desa_social\Comedores;
use App\Models\gerencia_desa_social\Vaso;
use App\Models\gerencia_desa_social\Bienestar;
use App\Models\gerencia_desa_social\Asociaciones;
use App\Models\gerencia_desa_social\Observaciones_sisfoh;
use App\Models\gerencia_desa_social\Observaciones_pension;
use App\Models\gerencia_desa_social\Observaciones_comedores;
use App\Models\gerencia_desa_social\Observaciones_vaso;
use App\Models\gerencia_desa_social\Observaciones_bienestar;
use App\Models\gerencia_desa_social\Observaciones_asociaciones;


class Programas_Sociales_Controller extends Controller
{
    public function index()
    {        
       return view('ger_desarrollo_social/vw_programas_sociales');
    }
     
    public function create(Request $request)
    {
        if( $request['tipo']=='sisfoh'){
            return $this->insert_sisfoh($request);
        }
        if( $request['tipo']=='pension'){
            return $this->insert_pension($request);
        }
        if( $request['tipo']=='comedores'){
            return $this->insert_comedores($request);
        }
        if( $request['tipo']=='vaso'){
            return $this->insert_vaso($request);
        }
        if( $request['tipo']=='bienestar'){
            return $this->insert_bienestar($request);
        }
        if( $request['tipo']=='asociaciones'){
            return $this->insert_asociaciones($request);
        }
        if( $request['tipo']=='observaciones_sisfoh'){
            return $this->insert_observaciones_1($request);
        }
        if( $request['tipo']=='observaciones_pension'){
            return $this->insert_observaciones_2($request);
        }
        if( $request['tipo']=='observaciones_comedores'){
            return $this->insert_observaciones_3($request);
        }
        if( $request['tipo']=='observaciones_vaso'){
            return $this->insert_observaciones_4($request);
        }
        if( $request['tipo']=='observaciones_bienestar'){
            return $this->insert_observaciones_5($request);
        }
        if( $request['tipo']=='observaciones_asociaciones'){
            return $this->insert_observaciones_6($request);
        }          
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id,Request $request)
    {            
        
        if($id==0 && $request['grid']=='sisfoh' ){
           return $this->grid_sisfoh($request['nombre']);
        }
        if($id==0 && $request['grid']=='pension' ){
           return $this->grid_pension($request['nombre']);
        }
        if($id==0 && $request['grid']=='comedores' ){
           return $this->grid_comedores($request['nombre']);
        }
        if($id==0 && $request['grid']=='vaso' ){
           return $this->grid_vaso($request['nombre']);
        }
        if($id==0 && $request['grid']=='bienestar' ){
           return $this->grid_bienestar($request['nombre']);
        }
        if($id==0 && $request['grid']=='asociaciones' ){
           return $this->grid_asociaciones($request['nombre']);
        }
        if($id==0 && $request['grid']=='table_observaciones_sisfoh'){
           return $this->grid_observaciones_1($request);
        }
        if($id==0 && $request['grid']=='table_observaciones_pension'){
           return $this->grid_observaciones_2($request);
        }
        if($id==0 && $request['grid']=='table_observaciones_comedores'){
           return $this->grid_observaciones_3($request);
        }
        if($id==0 && $request['grid']=='table_observaciones_vaso'){
           return $this->grid_observaciones_4($request);
        }
        if($id==0 && $request['grid']=='table_observaciones_bienestar'){
           return $this->grid_observaciones_5($request);
        }
        if($id==0 && $request['grid']=='table_observaciones_asociaciones'){
           return $this->grid_observaciones_6($request);
        }        
        if($id>0)
        {
            if($request['show']=='sisfoh' ){
                return $this->show_sisfoh($id);
            }   
            if($request['show']=='pension' ){
                return $this->show_pension($id);
            } 
            if($request['show']=='comedores' ){
                return $this->show_comedores($id);
            }
            if($request['show']=='vaso' ){
                return $this->show_vaso($id);
            }   
            if($request['show']=='bienestar' ){
                return $this->show_bienestar($id);
            } 
            if($request['show']=='asociaciones' ){
                return $this->show_asociaciones($id);
            }   
            if($request['show']=='observaciones_sisfoh' ){
                return $this->show_observaciones_1($id);
            }   
            if($request['show']=='observaciones_pension' ){
                return $this->show_observaciones_2($id);
            } 
            if($request['show']=='observaciones_comedores' ){
                return $this->show_observaciones_3($id);
            }
            if($request['show']=='observaciones_vaso' ){
                return $this->show_observaciones_4($id);
            }   
            if($request['show']=='observaciones_bienestar' ){
                return $this->show_observaciones_5($id);
            } 
            if($request['show']=='observaciones_asociaciones' ){
                return $this->show_observaciones_6($id);
            }
        }
    }
    public function edit($id, Request $request)
    {
        if( $request['tipo']=='sisfoh'){
            return $this->edit_sisfoh($id,$request);
        }
        if( $request['tipo']=='pension'){
            return $this->edit_pension($id,$request);
        } 
        if( $request['tipo']=='comedores'){
            return $this->edit_comedores($id,$request);
        }
        if( $request['tipo']=='vaso'){
            return $this->edit_vaso($id,$request);
        }
        if( $request['tipo']=='bienestar'){
            return $this->edit_bienestar($id,$request);
        } 
        if( $request['tipo']=='asociaciones'){
            return $this->edit_asociaciones($id,$request);
        }
        if( $request['tipo']=='observaciones_sisfoh'){
            return $this->editar_observaciones_1($id,$request);
        }
        if( $request['tipo']=='observaciones_pension'){
            return $this->editar_observaciones_2($id,$request);
        }
        if( $request['tipo']=='observaciones_comedores'){
            return $this->editar_observaciones_3($id,$request);
        } 
        if( $request['tipo']=='observaciones_vaso'){
            return $this->editar_observaciones_4($id,$request);
        }
        if( $request['tipo']=='observaciones_bienestar'){
            return $this->editar_observaciones_5($id,$request);
        }
        if( $request['tipo']=='observaciones_asociaciones'){
            return $this->editar_observaciones_6($id,$request);
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
         if ($request['tipo'] == 4) 
        {
            return $this->eliminar_observaciones_4($request);
        }
        if ($request['tipo'] == 5) 
        {
            return $this->eliminar_observaciones_5($request);
        }
        if ($request['tipo'] == 6) 
        {
            return $this->eliminar_observaciones_6($request);
        }
    }
    ///////////////////// GRILLAS ///////////////////////////
     public function grid_sisfoh($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.vw_sisfoh where persona like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.vw_sisfoh')->where('persona','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_sisfoh;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_sisfoh),
                trim($Datos->fecha), 
                trim($Datos->cod_catastral),
                trim($Datos->pers_nro_doc),
                trim($Datos->persona)
            );
        }
        return response()->json($Lista);
    }
     public function grid_pension($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.vw_pension_65 where persona like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.vw_pension_65')->where('persona','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_pension;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_pension),
                trim($Datos->fecha), 
                trim($Datos->cod_catastral),
                trim($Datos->pers_nro_doc),
                trim($Datos->persona)
            );
        }
        return response()->json($Lista);
    }
     public function grid_comedores($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.vw_comedores_populares where persona like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.vw_comedores_populares')->where('persona','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_comedores;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_comedores),
                trim($Datos->fecha), 
                trim($Datos->cod_catastral),
                trim($Datos->pers_nro_doc),
                trim($Datos->persona)
            );
        }
        return response()->json($Lista);
    }
     public function grid_vaso($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.vw_vaso_leche where persona like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.vw_vaso_leche')->where('persona','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_vaso;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_vaso),
                trim($Datos->fecha), 
                trim($Datos->cod_catastral),
                trim($Datos->pers_nro_doc),
                trim($Datos->persona)
            );
        }
        return response()->json($Lista);
    }
     public function grid_bienestar($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.vw_bienestar_social where persona like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.vw_bienestar_social')->where('persona','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_bienestar;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_bienestar),
                trim($Datos->fecha), 
                trim($Datos->cod_catastral),
                trim($Datos->pers_nro_doc),
                trim($Datos->persona)
            );
        }
        return response()->json($Lista);
    }
     public function grid_asociaciones($nombre)
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

        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.vw_asociaciones where hab_urb like '%".strtoupper($nombre)."%'");
        $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.vw_asociaciones')->where('hab_urb','like', '%'.strtoupper($nombre).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_asociaciones;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_asociaciones),
                trim($Datos->fecha), 
                trim($Datos->hab_urb),
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_sisfoh where id_sisfoh = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_sisfoh')->where('id_sisfoh',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_sisfoh where id_sisfoh = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_sisfoh')->where('id_sisfoh',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_pension where id_pension = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_pension')->where('id_pension',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_pension where id_pension = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_pension')->where('id_pension',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_comedores where id_comedores = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_comedores')->where('id_comedores',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_comedores where id_comedores  = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_comedores')->where('id_comedores',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
     public function grid_observaciones_4(Request $request)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_vaso where id_vaso = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_vaso')->where('id_vaso',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_vaso where id_vaso = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_vaso')->where('id_vaso',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
     public function grid_observaciones_5(Request $request)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_bienestar where id_bienestar = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_bienestar')->where('id_bienestar',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_bienestar where id_bienestar = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_bienestar')->where('id_bienestar',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
     public function grid_observaciones_6(Request $request)
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
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_asociaciones where id_asociaciones = 0");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_asociaciones')->where('id_asociaciones',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        else
        {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from geren_desa_social.observaciones_asociaciones where id_asociaciones  = '$indice'");
            $sql = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_asociaciones')->where('id_asociaciones',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
    public function insert_sisfoh($request)
    {
        $Sisfoh = new Sisfoh;
        $Sisfoh->fecha= date('d-m-Y');
        $Sisfoh->direccion=strtoupper($request['direccion']);
        $Sisfoh->id_persona=$request['id_persona'];
        $Sisfoh->id_lote=$request['id_lote'];
        $Sisfoh->cod_catastral=$request['cod_catastral'];  
        $Sisfoh->num_familias=$request['num_familias'];

        $Sisfoh->save();
        
        return response()->json([
            'id_sisfoh' => $Sisfoh->id_sisfoh,
        ]);
    }
     public function insert_pension($request)
    {
        $Pension = new Pension;
        $Pension->fecha  = date('d-m-Y');        
        $Pension->direccion= strtoupper($request['direccion']);
        $Pension->id_persona=$request['id_persona'];
        $Pension->cod_catastral=$request['cod_catastral'];             
        $Pension->id_lote=$request['id_lote'];
        $Pension->save();
        
        return response()->json([
            'id_pension' => $Pension->id_pension,
        ]);
    }
     public function insert_comedores($request)
    {
        $Comedores = new Comedores;
        $Comedores->fecha  = date('d-m-Y');
        $Comedores->id_persona=$request['id_persona'];
        $Comedores->direccion= strtoupper($request['direccion']);
        $Comedores->id_lote=$request['id_lote'];
        $Comedores->cod_catastral=$request['cod_catastral'];             
        $Comedores->save();
        
        return response()->json([
            'id_comedores' => $Comedores->id_comedores,
        ]);
    }
     public function insert_vaso($request)
    {
        $Vaso = new Vaso;
        $Vaso->fecha= date('d-m-Y');
        $Vaso->direccion=strtoupper($request['direccion']);
        $Vaso->id_persona=$request['id_persona'];
        $Vaso->id_lote=$request['id_lote'];
        $Vaso->cod_catastral=$request['cod_catastral'];  
        
        $Vaso->save();
        
        return response()->json([
            'id_vaso' => $Vaso->id_vaso,
        ]);
    }
     public function insert_bienestar($request)
    {
        $Bienestar = new Bienestar;
        $Bienestar->fecha  = date('d-m-Y');
        $Bienestar->id_persona=$request['id_persona'];
        $Bienestar->direccion= strtoupper($request['direccion']);
        $Bienestar->id_lote=$request['id_lote'];
        $Bienestar->cod_catastral=$request['cod_catastral'];             
       $Bienestar->save();
        
        return response()->json([
            'id_bienestar' => $Bienestar->id_bienestar,
        ]);
    }
     public function insert_asociaciones($request)
    {
        $Asociaciones = new Asociaciones;
        $Asociaciones->fecha  = date('d-m-Y');
        $Asociaciones->id_persona=$request['id_persona'];
        $Asociaciones->hab_urb= strtoupper($request['hab_urb']);
        $Asociaciones->direccion= strtoupper($request['direccion']);
        $Asociaciones->directiva= strtoupper($request['directiva']);            
        $Asociaciones->id_hab_urb=$request['id_hab_urb'];
        $Asociaciones->vigencia=$request['vigencia'];
        $Asociaciones->patron_socios=$request['patron_socios'];
        $Asociaciones->partida_registral=$request['partida_registral'];
        $Asociaciones->save();
        
        return response()->json([
            'id_asociaciones' => $Asociaciones->id_asociaciones,
        ]);
    }
    public function insert_observaciones_1($request)
    {
        $Observaciones_sisfoh = new Observaciones_sisfoh;
        $Observaciones_sisfoh->id_sisfoh   = $request['id_sisfoh'];
        $Observaciones_sisfoh->fecha_registro= date('d-m-Y');
        $Observaciones_sisfoh->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_sisfoh->save();
        
        return $Observaciones_sisfoh->id_observaciones;
    }
    public function insert_observaciones_2($request)
    {
        $Observaciones_pension = new Observaciones_pension;
        $Observaciones_pension->id_pension   = $request['id_pension'];
        $Observaciones_pension->fecha_registro= date('d-m-Y');
        $Observaciones_pension->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_pension->save();
        
        return $Observaciones_pension->id_observaciones;
    }
    public function insert_observaciones_3($request)
    {
        $Observaciones_comedores = new Observaciones_comedores;
        $Observaciones_comedores->id_comedores   = $request['id_comedores'];
        $Observaciones_comedores->fecha_registro= date('d-m-Y');
        $Observaciones_comedores->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_comedores->save();
        
        return $Observaciones_comedores->id_observaciones;
    }
    public function insert_observaciones_4($request)
    {
        $Observaciones_vaso = new Observaciones_vaso;
        $Observaciones_vaso->id_vaso   = $request['id_vaso'];
        $Observaciones_vaso->fecha_registro= date('d-m-Y');
        $Observaciones_vaso->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_vaso->save();
        
        return $Observaciones_vaso->id_observaciones;
    }
    public function insert_observaciones_5($request)
    {
        $Observaciones_bienestar = new Observaciones_bienestar;
        $Observaciones_bienestar->id_bienestar   = $request['id_bienestar'];
        $Observaciones_bienestar->fecha_registro= date('d-m-Y');
        $Observaciones_bienestar->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_bienestar->save();
        
        return $Observaciones_bienestar->id_observaciones;
    }
    public function insert_observaciones_6($request)
    {
        $Observaciones_asociaciones = new Observaciones_asociaciones;
        $Observaciones_asociaciones->id_asociaciones   = $request['id_asociaciones'];
        $Observaciones_asociaciones->fecha_registro= date('d-m-Y');
        $Observaciones_asociaciones->observaciones = strtoupper($request['observaciones']);
        
        $Observaciones_asociaciones->save();
        
        return $Observaciones_asociaciones->id_observaciones;
    }
 
    ////////////////// SHOW /////////////////////////////////
    
   public function show_sisfoh($id){
        $sisfoh= DB::connection('gerencia_catastro')->table('geren_desa_social.vw_sisfoh')->where('id_sisfoh',$id)->get();
            return $sisfoh;
    }
   public function show_pension($id){
        $pension= DB::connection('gerencia_catastro')->table('geren_desa_social.vw_pension_65')->where('id_pension',$id)->get();
            return $pension;
    }
   public function show_comedores($id){
        $comedores= DB::connection('gerencia_catastro')->table('geren_desa_social.vw_comedores_populares')->where('id_comedores',$id)->get();
            return $comedores;
    }
    public function show_vaso($id){
        $vaso= DB::connection('gerencia_catastro')->table('geren_desa_social.vw_vaso_leche')->where('id_vaso',$id)->get();
            return $vaso;
    }
   public function show_bienestar($id){
        $bienestar= DB::connection('gerencia_catastro')->table('geren_desa_social.vw_bienestar_social')->where('id_bienestar',$id)->get();
            return $bienestar;
    }
   public function show_asociaciones($id){
        $asociaciones= DB::connection('gerencia_catastro')->table('geren_desa_social.vw_asociaciones')->where('id_asociaciones',$id)->get();
            return $asociaciones;
    }
   public function show_observaciones_1($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_sisfoh')->where('id_observaciones',$id)->get();
        return $observaciones;
    }
   public function show_observaciones_2($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_pension')->where('id_observaciones',$id)->get();
        return $observaciones;
    }
   public function show_observaciones_3($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_comedores')->where('id_observaciones',$id)->get();
        return $observaciones;
    }
    public function show_observaciones_4($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_vaso')->where('id_observaciones',$id)->get();
        return $observaciones;
    }
   public function show_observaciones_5($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_bienestar')->where('id_observaciones',$id)->get();
        return $observaciones;
    }
   public function show_observaciones_6($id){
        $observaciones = DB::connection('gerencia_catastro')->table('geren_desa_social.observaciones_asociaciones')->where('id_observaciones',$id)->get();
        return $observaciones;
    }

    ////////////////// EDIT /////////////////////////////////
     public function edit_sisfoh($id, Request $request)
    {
        $Sisfoh = new Sisfoh;
        $val=  $Sisfoh::where("id_sisfoh","=",$id )->first();
        if($val)
        {
            $val->fecha  = date('d-m-Y');
            $val->direccion=strtoupper($request['direccion']);
            $val->id_persona=$request['id_persona'];
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];  
            $val->num_familias=$request['num_familias'];  

            $val->save();
        }
        return $id;        
    }
     public function edit_pension($id, Request $request)
    {
        $pension = new pension;
        $val=  $pension::where("id_pension","=",$id )->first();
        if($val)
        {
            $val->fecha  = date('d-m-Y');
            $val->id_persona=$request['id_persona'];
            $val->direccion= strtoupper($request['direccion']);
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];             
            $val->save();
        }
        return $id;   
       
    }
     public function edit_comedores($id, Request $request)
    {
       $Comedores = new Comedores;
        $val=  $Comedores::where("id_comedores","=",$id )->first();
        if($val)
        {
            $val->fecha  = date('d-m-Y');
            $val->id_persona=$request['id_persona'];
            $val->direccion= strtoupper($request['direccion']);
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];             
            $val->save(); 
        }
        return $id;    
    }
     public function edit_vaso($id, Request $request)
    {
        $Vaso = new Vaso;
        $val=  $Vaso::where("id_vaso","=",$id )->first();
        if($val)
        {
            $val->fecha  = date('d-m-Y');
            $val->direccion=strtoupper($request['direccion']);
            $val->id_persona=$request['id_persona'];
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];  
            $val->save();
        }
        return $id;        
    }
     public function edit_bienestar($id, Request $request)
    {
        $Bienestar = new Bienestar;
        $val=  $Bienestar::where("id_bienestar","=",$id )->first();
        if($val)
        {
            $val->fecha  = date('d-m-Y');
            $val->id_persona=$request['id_persona'];
            $val->direccion= strtoupper($request['direccion']);
            $val->id_lote=$request['id_lote'];
            $val->cod_catastral=$request['cod_catastral'];             
            $val->save();
        }
        return $id;   
       
    }
     public function edit_asociaciones($id, Request $request)
    {
       $Asociaciones = new Asociaciones;
        $val=  Asociaciones::where("id_asociaciones","=",$id )->first();
        if($val)
        {                        
            $val = new Asociaciones;
            $val->fecha  = date('d-m-Y');
            $val->id_persona=$request['id_persona'];
            $val->hab_urb= strtoupper($request['hab_urb']);
            $val->direccion= strtoupper($request['direccion']);
            $val->directiva= strtoupper($request['directiva']);            
            $val->id_hab_urb=$request['id_hab_urb'];
            $val->vigencia=$request['vigencia'];
            $val->patron_socios=$request['patron_socios'];
            $val->partida_registral=$request['partida_registral'];
            $val->save();
        
        }
        return $id;    
    }
    public function editar_observaciones_1($id,Request $request)
    {
        $Observaciones_sisfoh = new Observaciones_sisfoh;
        $val=  $Observaciones_sisfoh::where("id_observaciones","=",$id )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id;
    }
    public function editar_observaciones_2($id,Request $request)
    {
        $Observaciones_pension = new Observaciones_pension;
        $val=  $Observaciones_pension::where("id_observaciones","=",$id )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id;
    }
    public function editar_observaciones_3($id,Request $request)
    {
        $Observaciones_comedores = new Observaciones_comedores;
        $val=  $Observaciones_comedores::where("id_observaciones","=",$id )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id;
    }
    public function editar_observaciones_4($id,Request $request)
    {
        $Observaciones_vaso = new Observaciones_vaso;
        $val=  $Observaciones_vaso::where("id_observaciones","=",$id )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id;
    }
    public function editar_observaciones_5($id,Request $request)
    {
        $Observaciones_bienestar = new Observaciones_bienestar;
        $val=  $Observaciones_bienestar::where("id_observaciones","=",$id )->first();
        if($val)
        {
            $val->observaciones = strtoupper($request['observacion']);
            $val->save();
        }
        return $id;
    }
    public function editar_observaciones_6($id,Request $request)
    {
        $Observaciones_asociaciones = new Observaciones_asociaciones;
        $val=  $Observaciones_asociaciones::where("id_observaciones","=",$id )->first();
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
        $Observaciones_sisfoh = new Observaciones_sisfoh;
        $val=  $Observaciones_sisfoh::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
    public function eliminar_observaciones_2(Request $request)
    {
        $Observaciones_pension = new Observaciones_pension;
        $val=  $Observaciones_pension::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
    public function eliminar_observaciones_3(Request $request)
    {
        $Observaciones_comedores = new Observaciones_comedores;
        $val=  $Observaciones_comedores::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
     public function eliminar_observaciones_4(Request $request)
    {
        $Observaciones_vaso = new Observaciones_vaso;
        $val=  $Observaciones_vaso::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
    public function eliminar_observaciones_5(Request $request)
    {
        $Observaciones_bienestar = new Observaciones_bienestar;
        $val=  $Observaciones_bienestar::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
    public function eliminar_observaciones_6(Request $request)
    {
        $Observaciones_asociaciones = new Observaciones_asociaciones;
        $val=  $Observaciones_asociaciones::where("id_observaciones","=",$request['id_observaciones'] )->first();
        if($val)
        {
            $val->delete();
        }
        return "destroy ".$request['id_observaciones'];
    }
}
