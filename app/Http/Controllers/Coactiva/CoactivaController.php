<?php

namespace App\Http\Controllers\Coactiva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CoactivaController extends Controller
{

    public function index(){
        return view('coactiva.vw_coactiva');
    }   
    public function recep_doc() {
        return view('coactiva.vw_recep_doc');
    }
    function emision_apertura_resolucion(){
        return view('coactiva.vw_emision_rec');
    }
    function editor_text(){
        return view('coactiva.editor_resolucion_aper');
    }
    
    public function show($id)
    {}

    public function edit($id)
    {}

    public function update(Request $request, $id)
    {}

    public function destroy($id)
    {}
    
    function get_doc(Request $request){
                
        $tip_doc=$request['tip_doc'];
        $tip_bus=$request['tip_bus'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        
        if($tip_doc=='1'){
            if($tip_bus=='1'){
                $desde= str_replace('/','-',$request['desde']);
                $hasta=str_replace('/','-',$request['hasta']);
                $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=2 and verif_env=0 and fch_env between '".$desde."' and '".$hasta."' ");            
            }else if($tip_bus=='2'){
                $del=str_pad($request['del'], 7, "0", STR_PAD_LEFT);
                $al=str_pad($request['al'], 7, "0", STR_PAD_LEFT);
                $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=2 and verif_env=0 and nro_fis between '".$del."' and '".$al."' ");            
            }
        }else{
            $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=0 and verif_env=0");            
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
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        if($tip_doc=='1'){
            if($tip_bus=='1'){
                $sql = DB::table('recaudacion.vw_genera_fisca')->where('env_op',2)->where('verif_env',0)->whereBetween('fch_env',[$desde,$hasta])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
            }else if($tip_bus=='2'){
                $sql = DB::table('recaudacion.vw_genera_fisca')->where('env_op',2)->where('verif_env',0)->whereBetween('nro_fis',[$del,$al])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
            }
        }else{
            $sql = DB::table('recaudacion.vw_genera_fisca')->where('env_op',0)->where('verif_env',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_gen_fis;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_gen_fis),
                trim($Datos->nro_fis),
                date('d-m-Y', strtotime($Datos->fec_reg)),
                trim($Datos->hora_env),
                trim($Datos->anio),
                trim($Datos->nro_doc),
                str_replace('-','',trim($Datos->contribuyente)),
                trim($Datos->estado),
                trim($Datos->verif_env),
                $Datos->monto,
                "<input type='checkbox' name='chk_recib_doc' value='".$Datos->id_gen_fis."'>"
            );
        }
        return response()->json($Lista); 
    }
    
    function get_doc_recibidos(){
        
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        
        $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=2 and verif_env=1"); 
        
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
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        $sql = DB::table('recaudacion.vw_genera_fisca')->where('env_op',2)->where('verif_env',1)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_gen_fis;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_gen_fis),
                trim($Datos->nro_fis),
                date('d-m-Y', strtotime($Datos->fec_reg)),
                trim($Datos->hora_env),
                trim($Datos->anio),
                trim($Datos->nro_doc),
                str_replace('-','',trim($Datos->contribuyente)),
                trim($Datos->estado),
                trim($Datos->verif_env),
                $Datos->monto,
                "<input type='checkbox' name='chk_doc' value='".$Datos->id_gen_fis."'>"
            );
        }
        return response()->json($Lista); 
    }
    
    function resep_documentos(Request $request){
        $array = explode('-', $request['id_gen_fis']);
        $count=count($array);
        $i=0;
        for($i==0;$i<=$count-1;$i++){            
            DB::table('recaudacion.orden_pago_master')->where('id_gen_fis',$array[$i])
                        ->update(['verif_env'=>1,'fch_recep'=>date('d-m-Y'),'hora_recep'=>date('h:i A')]);
        }
        return response()->json(['msg'=>'si']);
    }
    
    function rec_apertura(){
        $plantilla=DB::table('coactiva.plantillas')->where('id_plant',1)->value('contenido');
//        $plantilla = "<div style='background:red'>HOLa mundo</div>";
        $view = \View::make('coactiva.reportes.rec_apertura',compact('plantilla'))->render();
//        return $view;
        $pdf = \App::make('dompdf.wrapper');            
        $pdf->loadHTML($view)->setPaper('a4');
        return $pdf->stream();
    }
}
