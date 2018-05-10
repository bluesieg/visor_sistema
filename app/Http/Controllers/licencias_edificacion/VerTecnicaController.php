<?php

namespace App\Http\Controllers\licencias_edificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\licencias_edificacion\RecDocumentos;
use App\Models\licencias_edificacion\RevisionesEncargado;
use Illuminate\Support\Facades\Response;


class VerTecnicaController extends Controller
{

    public function index()
    {
        return view('licencias_edificacion/wv_recdocumentos');
    }

    public function create(Request $request)
    {
        
    }
    
    
    function guardar_f(Request $request)
    {   
        $documento1 = $request->file('file1');
        $documento2 = $request->file('file2');
        $documento3 = $request->file('file3');
        $documento4 = $request->file('file4');
        $documento5 = $request->file('file5');
        $documento6 = $request->file('file6');
        
        $notificacion1 = $request->file('notificacion1');
        $notificacion2 = $request->file('notificacion2');
        $notificacion3 = $request->file('notificacion3');
        $notificacion4 = $request->file('notificacion4');
        $notificacion5 = $request->file('notificacion5');
        $notificacion6 = $request->file('notificacion6');
        
        $id_expediente = $request['dlg_hidden_verif_tecnica_id_reg_exp'];
        $id_encargado = $request['dlg_encargado'];
        
        $revision1 = $request['revision1'];
        $revision2 = $request['revision2'];
        $revision3 = $request['revision3'];
        $revision4 = $request['revision4'];
        $revision5 = $request['revision5'];
        $revision6 = $request['revision6'];
        
        $check1 = $request['value1'];
        $check2 = $request['value2'];
        $check3 = $request['value3'];
        $check4 = $request['value4'];
        $check5 = $request['value5'];
        $check6 = $request['value6'];
        
        if($revision1)
        {
            if ($documento1) {
                $documentos_1 = \File::get($documento1);
            }else{
                $documentos_1 = "";
            }
            
            if ($notificacion1) {
                $notificaciones_1 = \File::get($notificacion1);
            }else{
                $notificaciones_1 = "";
            }
            
            $this->foto_insert($documentos_1,$id_expediente,$revision1,$check1,$id_encargado,$notificaciones_1);
        }
        if($revision2)
        {
            if ($documento2) {
                $documentos_2 = \File::get($documento2);
            }else{
                $documentos_2 = "";
            }
            
            if ($notificacion2) {
                $notificaciones_2 = \File::get($notificacion2);
            }else{
                $notificaciones_2 = "";
            }
            
            $this->foto_insert($documentos_2,$id_expediente,$revision2,$check2,$id_encargado,$notificaciones_2);
        }
        if($revision3)
        {
            if ($documento3) {
                $documentos_3 = \File::get($documento3);
            }else{
                $documentos_3 = "";
            }
            
            if ($notificacion3) {
                $notificaciones_3 = \File::get($notificacion3);
            }else{
                $notificaciones_3 = "";
            }
            
            $this->foto_insert($documentos_3,$id_expediente,$revision3,$check3,$id_encargado,$notificaciones_3);
        }
        if($revision4)
        {
             if ($documento4) {
                $documentos_4 = \File::get($documento4);
            }else{
                $documentos_4 = "";
            }
            
            if ($notificacion4) {
                $notificaciones_4 = \File::get($notificacion4);
            }else{
                $notificaciones_4 = "";
            }
            
            $this->foto_insert($documentos_4,$id_expediente,$revision4,$check4,$id_encargado,$notificaciones_4);
        }
        if($revision5)
        {
            if ($documento5) {
                $documentos_5 = \File::get($documento5);
            }else{
                $documentos_5 = "";
            }
            
            if ($notificacion5) {
                $notificaciones_5 = \File::get($notificacion5);
            }else{
                $notificaciones_5 = "";
            }
            
            $this->foto_insert($documentos_5,$id_expediente,$revision5,$check5,$id_encargado,$notificaciones_5);
        }
        if($revision6)
        {
            if ($documento6) {
                $documentos_6 = \File::get($documento6);
            }else{
                $documentos_6 = "";
            }
            
            if ($notificacion6) {
                $notificaciones_6 = \File::get($notificacion6);
            }else{
                $notificaciones_6 = "";
            }
            
            $this->foto_insert($documentos_6,$id_expediente,$revision6,$check6,$id_encargado,$notificaciones_6);
        }
    }
    
    public function foto_insert($documento,$id_expediente,$num,$estado,$id_encargado,$notificacion)
    {  
        $RevisionesEncargado = new RevisionesEncargado;
        $RevisionesEncargado->id_rev = $num;
        $RevisionesEncargado->id_encargado = $id_encargado;
        $RevisionesEncargado->documento = base64_encode($documento);
        $RevisionesEncargado->notificacion = base64_encode($notificacion);
        $RevisionesEncargado->estado = $estado;
        $RevisionesEncargado->id_expediente = $id_expediente;
        $RevisionesEncargado->save();  
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $expedientes = DB::connection("gerencia_catastro")->table('soft_lic_edificacion.vw_verif_tecnica')->where('id_reg_exp',$id)->get();
        return $expedientes; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_requisito,Request $request)
    {
              
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
    }
    
    public function get_verif_tecnica(Request $request){
        header('Content-type: application/json');
        $fecha_inicio = $request['fecha_inicio'];
        $fecha_fin = $request['fecha_fin'];
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_verif_tecnica where fecha_registro between '$fecha_inicio' and '$fecha_fin'");
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

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
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }

     

        $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_verif_tecnica')->whereBetween('fecha_registro', [$fecha_inicio, $fecha_fin])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_reg_exp),
                trim($Datos->cod_interno),
                trim($Datos->fecha_registro),
                trim($Datos->nro_doc_gestor),
                trim($Datos->gestor),
                trim($Datos->descr_procedimiento)
            );
        }

        return response()->json($Lista);

    }
    
    public function get_revision_expediente(Request $request){
        header('Content-type: application/json');
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.revisiones");
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

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
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }

     

        $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.revisiones')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        $indice=0;
        foreach ($sql as $Index => $Datos) {
            $indice++;
            $Lista->rows[$Index]['id'] = $Datos->id_rev;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_rev),
                trim($Datos->descripcion),
                "<input type='checkbox' class='check".$Datos->id_rev."' onclick='cambiar_estado()'><input type='hidden' class='estado".$Datos->id_rev."' name='value".$Datos->id_rev."' value='0'>",
                "<input type='file' name='file".$indice."'>",
                "<input type='text' name='revision".$Datos->id_rev."' value='$Datos->id_rev'>",
                "<input type='file' name='notificacion".$indice."'>",
            );
        }

        return response()->json($Lista);

    }
    
    public function improcedente_verif_tecnica(Request $request){
        $RecDocumentos = new RecDocumentos;
        $val=  $RecDocumentos::where("id_reg_exp","=",$request['id_reg_exp'])->first();
        if(count($val)>=1)
        {
            $val->fase = 7;
            $val->save();
        }
        return $request['id_reg_exp'];
    }
    
    public function cambiar_estado_verif_tecnica(Request $request){
        $RecDocumentos = new RecDocumentos;
        $val=  $RecDocumentos::where("id_reg_exp","=",$request['id_reg_exp'])->first();
        if(count($val)>=1)
        {
            $val->fase = 8;
            $val->save();
        }
        return $request['id_reg_exp'];
    }
    
    public function recuperar_revisiones(Request $request){
        header('Content-type: application/json');
        $indice = $request['indice'];
        $encargado = $request['encargado'];
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_revisiones_encargado where id_expediente = '$indice' and id_encargado = '$encargado'");
        
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

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
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }

        $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_revisiones_encargado')->where('id_expediente',$indice)->where('id_encargado',$encargado)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_rev;
            if ($Datos->estado == 1) {
              $nuevo = "<input type='checkbox' name='estado' checked='true' class='check".$Datos->id_rev."' onclick='cambiar_estado_1()'><input type='hidden' class='estado_".$Datos->id_rev."' name='value_".$Datos->id_rev."' value='1'>";
            }else{
              $nuevo = "<input type='checkbox' name='estado' class='check".$Datos->id_rev."' onclick='cambiar_estado_1()'><input type='hidden' class='estado_".$Datos->id_rev."' name='value_".$Datos->id_rev."' value='0'>";
            }
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_rev),
                trim($Datos->descripcion),
                $nuevo,
                "<input type='file' name='file_".$indice."'>",
                '<button class="btn btn-labeled bg-color-red txt-color-white" type="button" onclick="ver_documentos('.trim($Datos->id_rev).','.trim($Datos->id_expediente).','.trim($Datos->id_encargado).')"><span class="btn-label"><i class="fa fa-print"></i></span> VER DOC.</button>',
                "<input type='text' name='revision_".$Datos->id_rev."' value='$Datos->id_rev'>",
                "<input type='file' name='notificacion_".$indice."'>",
                '<button class="btn btn-labeled bg-color-red txt-color-white" type="button" onclick="ver_notificaciones('.trim($Datos->id_rev).','.trim($Datos->id_expediente).','.trim($Datos->id_encargado).')"><span class="btn-label"><i class="fa fa-print"></i></span> VER NOT.</button>'
            );
        }

        return response()->json($Lista);
    }
    
    public function ver_documentos_adjuntos($id_rev,$id_expediente,$id_encargado)
    {
        $sql = DB::connection('gerencia_catastro')->select("select * from soft_lic_edificacion.vw_revisiones_encargado where id_rev='$id_rev' and id_expediente = '$id_expediente' and id_encargado='$id_encargado' ");
        
        if($sql)
        {
            return Response::make(base64_decode($sql[0]->documento), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="files"'
                ]);
        }
        else
        {
            return "No hay Archivos";
        }
    }
    
    public function ver_notificaciones_adjuntos($id_rev,$id_expediente,$id_encargado)
    {
        $sql = DB::connection('gerencia_catastro')->select("select * from soft_lic_edificacion.vw_revisiones_encargado where id_rev='$id_rev' and id_expediente = '$id_expediente' and id_encargado='$id_encargado' ");
        
        if($sql)
        {
            return Response::make(base64_decode($sql[0]->notificacion), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="files"'
                ]);
        }
        else
        {
            return "No hay Archivos";
        }
    }
    
    function actualizar_f(Request $request)
    {   
        $documento1 = $request->file('file_1');
        $documento2 = $request->file('file_2');
        $documento3 = $request->file('file_3');
        $documento4 = $request->file('file_4');
        $documento5 = $request->file('file_5');
        $documento6 = $request->file('file_6');
        
        $notificacion1 = $request->file('notificacion_1');
        $notificacion2 = $request->file('notificacion_2');
        $notificacion3 = $request->file('notificacion_3');
        $notificacion4 = $request->file('notificacion_4');
        $notificacion5 = $request->file('notificacion_5');
        $notificacion6 = $request->file('notificacion_6');
        
        $id_expediente = $request['dlg_hidden_verif_tecnica_id_reg_exp'];
        $id_encargado = $request['dlg_encargado'];
        
        $revision1 = $request['revision_1'];
        $revision2 = $request['revision_2'];
        $revision3 = $request['revision_3'];
        $revision4 = $request['revision_4'];
        $revision5 = $request['revision_5'];
        $revision6 = $request['revision_6'];
        
        $check1 = $request['value_1'];
        $check2 = $request['value_2'];
        $check3 = $request['value_3'];
        $check4 = $request['value_4'];
        $check5 = $request['value_5'];
        $check6 = $request['value_6'];
        
        if($revision1)
        {
            if ($documento1) {
                $documentos_1 = \File::get($documento1);
            }else{
                $documentos_1 = "";
            }
            
            if ($notificacion1) {
                $notificaciones_1 = \File::get($notificacion1);
            }else{
                $notificaciones_1 = "";
            }
            
            $this->file_actualizar($documentos_1,$id_expediente,$revision1,$check1,$id_encargado,$notificaciones_1);
        }
        if($revision2)
        {
            if ($documento2) {
                $documentos_2 = \File::get($documento2);
            }else{
                $documentos_2 = "";
            }
            
            if ($notificacion2) {
                $notificaciones_2 = \File::get($notificacion2);
            }else{
                $notificaciones_2 = "";
            }
            
            $this->file_actualizar($documentos_2,$id_expediente,$revision2,$check2,$id_encargado,$notificaciones_2);
        }
        if($revision3)
        {
            if ($documento3) {
                $documentos_3 = \File::get($documento3);
            }else{
                $documentos_3 = "";
            }
            
            if ($notificacion3) {
                $notificaciones_3 = \File::get($notificacion3);
            }else{
                $notificaciones_3 = "";
            }
            
            $this->file_actualizar($documentos_3,$id_expediente,$revision3,$check3,$id_encargado,$notificaciones_3);
        }
        if($revision4)
        {
             if ($documento4) {
                $documentos_4 = \File::get($documento4);
            }else{
                $documentos_4 = "";
            }
            
            if ($notificacion4) {
                $notificaciones_4 = \File::get($notificacion4);
            }else{
                $notificaciones_4 = "";
            }
            
            $this->file_actualizar($documentos_4,$id_expediente,$revision4,$check4,$id_encargado,$notificaciones_4);
        }
        if($revision5)
        {
            if ($documento5) {
                $documentos_5 = \File::get($documento5);
            }else{
                $documentos_5 = "";
            }
            
            if ($notificacion5) {
                $notificaciones_5 = \File::get($notificacion5);
            }else{
                $notificaciones_5 = "";
            }
            
            $this->file_actualizar($documentos_5,$id_expediente,$revision5,$check5,$id_encargado,$notificaciones_5);
        }
        if($revision6)
        {
            if ($documento6) {
                $documentos_6 = \File::get($documento6);
            }else{
                $documentos_6 = "";
            }
            
            if ($notificacion6) {
                $notificaciones_6 = \File::get($notificacion6);
            }else{
                $notificaciones_6 = "";
            }
            
            $this->file_actualizar($documentos_6,$id_expediente,$revision6,$check6,$id_encargado,$notificaciones_6);
        }
    }
    
    public function file_actualizar($documento,$id_expediente,$num,$estado,$id_encargado,$notificacion)
    {   
        $RevisionesEncargado = new RevisionesEncargado;
        $datos=  $RevisionesEncargado::where("id_expediente","=",$id_expediente)->where("id_encargado","=",$id_encargado)->first();
        if(count($datos)>=1)
        {
            $datos->documento = base64_encode($documento);
            $datos->notificacion = base64_encode($notificacion);
            $datos->estado = $estado;
            $datos->save();
        }
    }
}
