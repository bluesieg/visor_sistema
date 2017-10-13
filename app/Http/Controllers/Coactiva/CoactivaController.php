<?php

namespace App\Http\Controllers\Coactiva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Traits\DatesTranslator;
use App\Models\coactiva\coactiva_documentos;

class CoactivaController extends Controller
{
    use DatesTranslator;
    function letra(){        
        $monto= '2.00';        
        $le = $this->num_letras($monto);
        echo $le;
    }
    public function gest_exped(){
        return view('coactiva.vw_ges_exped');
    }   
    public function recep_doc() {
        return view('coactiva.vw_recep_doc');
    }
    function emision_apertura_resolucion(){
        $plantilla=DB::table('coactiva.plantillas')->where('id_plant',1)->value('contenido');
        return view('coactiva.vw_emision_rec',compact('plantilla'));
    }
    function editar_resol(Request $request){
        $id_doc=$request['id_doc'];
        $resolucion=DB::select('select * from coactiva.vw_documentos_edit where id_doc='.$id_doc);
        $resol=new \stdClass();
        foreach ($resolucion as $Index => $Datos) {
            $resol->id_doc=$Datos->id_doc;
            $resol->id_contrib=$Datos->id_contrib;
            $resol->contribuyente= str_replace('-','',$Datos->contribuyente);
            $resol->nro_resol=$Datos->nro_resol;
            $resol->fch_recep=$Datos->fch_recep;
            $resol->anio_resol=$Datos->anio_resol;
            $resol->monto=$Datos->monto;
            $resol->periodos=$Datos->periodos;
            $resol->nro_rd=$Datos->nro_rd;
            $resol->fch_emi=$Datos->fch_emi;
            $resol->fch_emi_l=mb_strtolower($this->getCreatedAtAttribute($Datos->fch_emi)->format('l, d \d\e F \d\e\l Y'));
        }
        $plantilla=DB::table('coactiva.vw_documentos')->where('id_doc',$id_doc)->value('texto');

        $plantilla = str_replace('{@fch_emi@}',$resol->fch_emi_l,$plantilla);
        $plantilla = str_replace('{@contribuyente@}',$resol->contribuyente,$plantilla);
        $plantilla = str_replace('{@nro_resol@}',$resol->nro_resol,$plantilla);
        $plantilla = str_replace('{@anio_resol@}',$resol->anio_resol,$plantilla);
        $plantilla = str_replace('{@nro_rd@}',$resol->nro_rd,$plantilla);
        $plantilla = str_replace('{@periodos@}',$resol->periodos,$plantilla);
        $plantilla = str_replace('{@monto@}', number_format($resol->monto,2,'.',','),$plantilla);
        return view('coactiva.editor_resolucion_aper',compact('plantilla','id_doc'));
    }
    
    function get_expedientes(Request $request){
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        
        $totalg = DB::select("select count(id_coa_mtr) as total from coactiva.vw_coactiva_mtr where id_contrib=".$request['id_contrib']); 
        
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
        
        $sql = DB::table('coactiva.vw_coactiva_mtr')->where('id_contrib',$request['id_contrib'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_coa_mtr;            
            $Lista->rows[$Index]['cell'] = array(                
                str_replace('0','',trim($Datos->nro_procedimiento)),
                trim($Datos->nro_exped)                               
            );
        }
        return response()->json($Lista);
    }
    function get_docum_expediente(Request $request){
        $id_coa_mtr=$request['id_coa_mtr'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        
        $totalg = DB::select("select count(id_doc) as total from coactiva.vw_documentos where id_coa_mtr=".$id_coa_mtr); 
        
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
        
        $sql = DB::table('coactiva.vw_documentos')->where('id_coa_mtr',$id_coa_mtr)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        $cc=0;
        $ver = "";
        $edit= "";
        $fch_recep="";
        foreach ($sql as $Index => $Datos) {
            $cc++;            
            if($Datos->fch_recep){
                $fch_recep=date('d-m-Y', strtotime($Datos->fch_recep));
            }else{
                $fch_recep="";
            }
            if($Datos->id_tip_doc=='2'){
                $ver = "<button class='btn btn-labeled bg-color-red txt-color-white' type='button' onclick='ver_doc(".$Datos->id_doc.",".$Datos->id_coa_mtr.")'><span class='btn-label'><i class='fa fa-file-pdf-o'></i></span>Ver</button>";
                $edit= "<button class='btn btn-labeled bg-color-green txt-color-white' type='button' onclick='editar_doc(".$Datos->id_doc.")'><span class='btn-label'><i class='fa fa-pencil'></i></span>Editar</button>";
            }
            else if($Datos->id_tip_doc=='6'){
                $ver = "<button class='btn btn-labeled bg-color-red txt-color-white' type='button' onclick='ver_doc(".$Datos->id_doc.",".$Datos->id_coa_mtr.")'><span class='btn-label'><i class='fa fa-file-pdf-o'></i></span>Ver</button>";
                $edit= "";
                if($Datos->fch_recep==null){
                    $fch_recep= "<button class='btn btn-labeled bg-color-orange txt-color-white' title='Agregar Fecha de Recepción' type='button' onclick='fecha_resep_notif(".$Datos->id_doc.")'><span class='btn-label'><i class='fa fa-calendar'></i></span>Fecha</button>";
                }else{$fch_recep=date('d-m-Y', strtotime($Datos->fch_recep));}                
            }
            else if($Datos->id_tip_doc=='7'){
                $ver = "<button class='btn btn-labeled bg-color-red txt-color-white' type='button' onclick='ver_doc(".$Datos->id_doc.",".$Datos->id_coa_mtr.")'><span class='btn-label'><i class='fa fa-file-pdf-o'></i></span>Ver</button>";
                $edit= "";
            }
            $Lista->rows[$Index]['id'] = $Datos->id_doc;            
            $Lista->rows[$Index]['cell'] = array(
                $cc,
                date('d-m-Y', strtotime($Datos->fch_emi)),
                trim($Datos->tip_gestion),
                trim($Datos->nro_resol),
                $fch_recep,
                $ver,
                $edit                
            );
        }
        return response()->json($Lista);
    }

    public function edit($id)
    {}

    function fch_recep_notif(Request $request){
        $id_doc=$request['id_doc'];
        $fch_recep=$request['fch_recep'];
        DB::table('coactiva.coactiva_documentos')->where('id_doc',$id_doc)->update(['fch_recep'=>$fch_recep]);
    }

    public function destroy($id)
    {}
    
    function get_doc(Request $request){
                
        $tip_doc=$request['tip_doc'];
        $tip_bus=$request['tip_bus'];
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        
        if($tip_doc=='2'){
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
            if($tip_bus=='1'){
                $desde= str_replace('/','-',$request['desde']);
                $hasta=str_replace('/','-',$request['hasta']);
                $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=2 and verif_env=0 and fch_env between '".$desde."' and '".$hasta."' ");            
            }else if($tip_bus=='2'){
                $del=str_pad($request['del'], 7, "0", STR_PAD_LEFT);
                $al=str_pad($request['al'], 7, "0", STR_PAD_LEFT);
                $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=2 and verif_env=0 and nro_fis between '".$del."' and '".$al."' ");            
            }
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
        
        if($tip_doc=='2'){
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
                trim($Datos->id_per),
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
        
        $totalg = DB::select("select count(id_per) as total from recaudacion.vw_genera_fisca where env_op=2 and verif_env=1 and estado=0"); 
        
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
        
        $sql = DB::table('recaudacion.vw_genera_fisca')->where('env_op',2)->where('verif_env',1)->where('estado',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_gen_fis;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_gen_fis),
                trim($Datos->id_per),
                trim($Datos->nro_fis),
                date('d-m-Y', strtotime($Datos->fec_reg)),
                trim($Datos->hora_env),
                trim($Datos->anio),
                trim($Datos->nro_doc),
                str_replace('-','',trim($Datos->contribuyente)),
                trim($Datos->estado),
                trim($Datos->verif_env),
                $Datos->monto                
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
    
    function open_document($id_doc,$id_coa_mtr){
        $documento=DB::select('select * from coactiva.vw_documentos_edit where id_doc='.$id_doc);
        
        if($documento[0]->id_tip_doc=='2'){            
            $resol=new \stdClass();
            foreach ($documento as $Index => $Datos) {
                $resol->id_doc=$Datos->id_doc;
                $resol->id_contrib=$Datos->id_contrib;
                $resol->contribuyente= str_replace('-','',$Datos->contribuyente);
                $resol->nro_resol=$Datos->nro_resol;
                $resol->fch_recep=$Datos->fch_recep;
                $resol->anio_resol=$Datos->anio_resol;
                $resol->monto=$Datos->monto;
                $resol->periodos=$Datos->periodos;
                $resol->nro_rd=$Datos->nro_rd;
                $resol->fch_emi=$Datos->fch_emi;
                $resol->fch_emi_l=mb_strtolower($this->getCreatedAtAttribute($Datos->fch_emi)->format('l, d \d\e F \d\e\l Y'));
            }
            $plantilla=DB::table('coactiva.vw_documentos')->where('id_doc',$id_doc)->value('texto');

            $plantilla = str_replace('{@fch_emi@}',$resol->fch_emi_l,$plantilla);
            $plantilla = str_replace('{@contribuyente@}',$resol->contribuyente,$plantilla);
            $plantilla = str_replace('{@nro_resol@}',$resol->nro_resol,$plantilla);
            $plantilla = str_replace('{@anio_resol@}',$resol->anio_resol,$plantilla);
            $plantilla = str_replace('{@nro_rd@}',$resol->nro_rd,$plantilla);
            $plantilla = str_replace('{@periodos@}',$resol->periodos,$plantilla);
            $plantilla = str_replace('{@monto@}', number_format($resol->monto,2,'.',','),$plantilla);

            $view = \View::make('coactiva.reportes.rec_apertura',compact('plantilla','resol'))->render();
            $pdf = \App::make('dompdf.wrapper');            
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream();
        }else if($documento[0]->id_tip_doc=='6'){
            $documento=DB::select('select * from coactiva.vw_documentos_edit where id_doc='.$id_doc);
            $nro_resol=DB::table('coactiva.vw_documentos_edit')->where('id_coa_mtr',$id_coa_mtr)->where('id_tip_doc',2)->value('nro_resol');
            $view = \View::make('coactiva.reportes.c_notificacion',compact('documento','nro_resol'))->render();
            $pdf = \App::make('dompdf.wrapper');            
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream();
        }else if($documento[0]->id_tip_doc=='7'){
            $doc=DB::select('select * from coactiva.vw_documentos_edit where id_doc='.$id_doc);
            $nro_resol=DB::table('coactiva.vw_documentos_edit')->where('id_coa_mtr',$id_coa_mtr)->where('id_tip_doc',2)->value('nro_resol');
            $resol=new \stdClass();
            foreach ($doc as $Index => $Datos) {
                $resol->id_doc=$Datos->id_doc;
                $resol->id_contrib=$Datos->id_contrib;
                $resol->contribuyente= str_replace('-','',$Datos->contribuyente);
                $resol->nro_resol=$nro_resol;
                $resol->nro_exped=$Datos->nro_exped;
                $resol->anio_resol=$Datos->anio_resol;
                $resol->monto=$Datos->monto;
                $resol->periodos=$Datos->periodos;
                $resol->nro_rd=$Datos->nro_rd;
                $resol->dom_fis=$Datos->dom_fis;
                $resol->fch_larga=mb_strtolower($this->getCreatedAtAttribute(date('d-m-Y'))->format('l, d \d\e F \d\e\l Y'));
            }
            $view = \View::make('coactiva.reportes.req_pago',compact('resol'))->render();
            $pdf = \App::make('dompdf.wrapper');            
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream();
        }
        
    }
    
    function update_documento(Request $request){
        $contenido = $request['contenido'];
        $id_doc = $request['id_doc'];
       
        $update = DB::table('coactiva.coactiva_documentos')->where('id_doc',$id_doc)
                        ->update(['texto'=>$contenido]);
        if($update){return response()->json(['msg'=>'si']);}
    }
    
    function grid_all_resoluciones(){
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        
        $totalg = DB::select("select count(id_resol) as total from coactiva.vw_resol_apertura"); 
        
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
        
        $sql = DB::table('coactiva.vw_resol_apertura')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_resol;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_resol),
                trim($Datos->fch_resol),                
                trim($Datos->anio_resol),
                trim($Datos->nro_resol),
                str_replace('-','',trim($Datos->contribuyente)),                
                "<button class='btn btn-labeled bg-color-green txt-color-white' type='button' onclick='ver_resol(".$Datos->id_resol.")'><span class='btn-label'><i class='fa fa-file-text-o'></i></span> Ver REC</button>",
                trim($Datos->texto),
                "<button class='btn btn-labeled bg-color-orange txt-color-white' type='button' onclick='editor_resolucion(".$Datos->id_resol.")'><span class='btn-label'><i class='fa fa-pencil'></i></span> Editar REC</button>",
                "<button class='btn btn-labeled bg-color-red txt-color-white' type='button' onclick='print_notif(".$Datos->id_resol.")'><span class='btn-label'><i class='fa fa-file-pdf-o'></i></span>Notificación</button>"                
            );
        }
        return response()->json($Lista); 
    }
    
    function imp_cons_notif($id_resol){
        $resolucion=DB::select('select * from coactiva.vw_resol_apertura where id_resol='.$id_resol);
        $view = \View::make('coactiva.reportes.c_notificacion',compact('resolucion'))->render();
        $pdf = \App::make('dompdf.wrapper');            
        $pdf->loadHTML($view)->setPaper('a4');
        return $pdf->stream();
    }
    
    function add_documento(Request $request){
//        $id=$request['id_rd'];
        DB::table('recaudacion.orden_pago_master')->where('id_coa_mtr',$request['id_coa_mtr'])
                        ->update(['estado'=>1]);
        
        $data = new coactiva_documentos();
        $data->id_coa_mtr = $request['id_coa_mtr'];
        $data->id_tip_doc = $request['id_tip_doc'];
        $data->fch_emi = date('Y-m-d');
        $data->anio = date('Y');
        $data->periodos = date('Y');        
        $insert = $data->save();
        
//        $data=array();
//        $data['id_contrib']=$request['id_contrib'];
//        $data['fch']=date('Y-m-d');
//        $data['anio']=date('Y');
//        $data['monto']=$request['monto'];
//        $data['periodos']=date('Y');
//        $insert=DB::table('coactiva.resol_apertura')->insert($data);
        if($insert){
            return response()->json(['msg'=>'si']);
        }
    }
    
}
