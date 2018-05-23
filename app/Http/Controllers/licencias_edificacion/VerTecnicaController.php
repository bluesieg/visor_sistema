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
        $id_expediente = $request['dlg_hidden_verif_tecnica_id_reg_exp'];
        $id_encargado = $request['dlg_encargado'];
        
        $revisiones_encargado = DB::connection("gerencia_catastro")->table('soft_lic_edificacion.revisiones_encargado')->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->get();
        
        if (count($revisiones_encargado) >= 1) {
            return response()->json([
                'msg' => 'existe_revisiones',
            ]);
        }else{
            $documento1 = $request->file('file1');
            $documento2 = $request->file('file2');
            $documento3 = $request->file('file3');
            $documento4 = $request->file('file4');
            $documento5 = $request->file('file5');
            $documento6 = $request->file('file6');

            $notificacion1 = $request['notificacion1'];
            $notificacion2 = $request['notificacion2'];
            $notificacion3 = $request['notificacion3'];
            $notificacion4 = $request['notificacion4'];
            $notificacion5 = $request['notificacion5'];
            $notificacion6 = $request['notificacion6'];

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

                $this->agregar_docmuentos($documentos_1,$id_expediente,$revision1,$check1,$id_encargado,$notificacion1);
            }
            if($revision2)
            {
                if ($documento2) {
                    $documentos_2 = \File::get($documento2);
                }else{
                    $documentos_2 = "";
                }

                $this->agregar_docmuentos($documentos_2,$id_expediente,$revision2,$check2,$id_encargado,$notificacion2);
            }
            if($revision3)
            {
                if ($documento3) {
                    $documentos_3 = \File::get($documento3);
                }else{
                    $documentos_3 = "";
                }

                $this->agregar_docmuentos($documentos_3,$id_expediente,$revision3,$check3,$id_encargado,$notificacion3);
            }
            if($revision4)
            {
                 if ($documento4) {
                    $documentos_4 = \File::get($documento4);
                }else{
                    $documentos_4 = "";
                }

                $this->agregar_docmuentos($documentos_4,$id_expediente,$revision4,$check4,$id_encargado,$notificacion4);
            }
            if($revision5)
            {
                if ($documento5) {
                    $documentos_5 = \File::get($documento5);
                }else{
                    $documentos_5 = "";
                }

                $this->agregar_docmuentos($documentos_5,$id_expediente,$revision5,$check5,$id_encargado,$notificacion5);
            }
            if($revision6)
            {
                if ($documento6) {
                    $documentos_6 = \File::get($documento6);
                }else{
                    $documentos_6 = "";
                }

                $this->agregar_docmuentos($documentos_6,$id_expediente,$revision6,$check6,$id_encargado,$notificacion6);
            }
            
            return 1;
        }
    }
    
    public function agregar_docmuentos($documento,$id_expediente,$num,$estado,$id_encargado,$notificacion)
    {  
        $RevisionesEncargado = new RevisionesEncargado;
        $RevisionesEncargado->id_rev = $num;
        $RevisionesEncargado->id_encargado = $id_encargado;
        $RevisionesEncargado->documento = base64_encode($documento);
        $RevisionesEncargado->notificacion = $notificacion;
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
                '<button class="btn btn-labeled bg-color-red txt-color-white" type="button" onclick="notificaciones_tecnicas('.trim($indice).')"><span class="btn-label"><i class="fa fa-print"></i></span> SUBIR DOC.</button>'
                //"<input type='file' name='notificacion".$indice."'>",
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
        
        $indice_1=0;
        foreach ($sql as $Index => $Datos) {
            $indice_1++;
            $Lista->rows[$Index]['id'] = $Datos->id_rev;
            if ($Datos->estado == 1) {
              $nuevo = "<input type='checkbox' name='estado' checked='true' class='check_".$Datos->id_rev."' onclick='cambiar_estado_1()'><input type='hidden' class='estado_".$Datos->id_rev."' name='value_".$Datos->id_rev."' value='1'>";
            }else{
              $nuevo = "<input type='checkbox' name='estado' class='check_".$Datos->id_rev."' onclick='cambiar_estado_1()'><input type='hidden' class='estado_".$Datos->id_rev."' name='value_".$Datos->id_rev."' value='0'>";
            }
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_rev),
                trim($Datos->descripcion),
                $nuevo,
                "<input type='file' name='file_".$indice_1."'>",
                '<button class="btn btn-labeled bg-color-red txt-color-white" type="button" onclick="ver_documentos('.trim($Datos->id_rev).','.trim($Datos->id_expediente).','.trim($Datos->id_encargado).')"><span class="btn-label"><i class="fa fa-print"></i></span> VER DOC.</button>',
                "<input type='text' name='revision_".$Datos->id_rev."' value='$Datos->id_rev'>",
                '<button class="btn btn-labeled bg-color-red txt-color-white" type="button" onclick="notificaciones_tecnicas('.trim($indice_1).')"><span class="btn-label"><i class="fa fa-print"></i></span> SUBIR DOC.</button>',
                //"<input type='file' name='notificacion_".$indice_1."'>",
                '<button class="btn btn-labeled bg-color-purple txt-color-white" type="button" onclick="ver_notificaciones('.trim($Datos->id_rev).','.trim($Datos->id_expediente).','.trim($Datos->id_encargado).')"><span class="btn-label"><i class="fa fa-print"></i></span> VER NOT.</button>'
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
        $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.vw_revisiones_encargado")->where('id_rev',$id_rev)->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->get();
        $institucion = DB::select('SELECT * FROM maysa.institucion');
        
        if(count($sql)>0)
        {
            $view =  \View::make('licencias_edificacion.reportes.notificaciones_tecnica', compact('sql','institucion'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("Notificacion Verificacion Tecnica".".pdf");
        }
        else
        {
            return "No hay Datos";
        }
    }
    
    function actualizar_f(Request $request)
    {   
        $documento_1 = $request->file('file_1');
        $documento_2 = $request->file('file_2');
        $documento_3 = $request->file('file_3');
        $documento_4 = $request->file('file_4');
        $documento_5 = $request->file('file_5');
        $documento_6 = $request->file('file_6');
        
        $notificacion1 = $request['notificacion1'];
        $notificacion2 = $request['notificacion2'];
        $notificacion3 = $request['notificacion3'];
        $notificacion4 = $request['notificacion4'];
        $notificacion5 = $request['notificacion5'];
        $notificacion6 = $request['notificacion6'];
        
        $id_expediente = $request['dlg_hidden_verif_tecnica_id_reg_exp'];
        $id_encargado = $request['dlg_encargado'];
        
        $revision_1 = $request['revision_1'];
        $revision_2 = $request['revision_2'];
        $revision_3 = $request['revision_3'];
        $revision_4 = $request['revision_4'];
        $revision_5 = $request['revision_5'];
        $revision_6 = $request['revision_6'];
        
        $check_1 = $request['value_1'];
        $check_2 = $request['value_2'];
        $check_3 = $request['value_3'];
        $check_4 = $request['value_4'];
        $check_5 = $request['value_5'];
        $check_6 = $request['value_6'];
        
        if($revision_1)
        {
            if ($documento_1) {
                $documentos_1 = \File::get($documento_1);
            }else{
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_1)->first();
                if($sql) {
                    $documentos_1 = $sql->documento;
                }else{
                    $documentos_1 = "";
                }
            }
            
            if ($notificacion1 == '') {
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_1)->first();
                if($sql) {
                    $notificaciones_1 = $sql->notificacion;
                }else{
                    $notificaciones_1 = "";
                }
            }else{
                $notificaciones_1 = $notificacion1;
            }
            
            $this->file_actualizar($documentos_1,$id_expediente,$revision_1,$check_1,$id_encargado,$notificaciones_1);
        }
        if($revision_2)
        {
            if ($documento_2) {
                $documentos_2 = \File::get($documento_2);
            }else{
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_2)->first();
                if($sql) {
                    $documentos_2 = $sql->documento;
                }else{
                    $documentos_2 = "";
                } 
            }
            
            if ($notificacion2 == '') {
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_2)->first();
                if($sql) {
                    $notificaciones_2 = $sql->notificacion;
                }else{
                    $notificaciones_2 = "";
                }
            }else{
                $notificaciones_2 = $notificacion2;
            }
            
            $this->file_actualizar($documentos_2,$id_expediente,$revision_2,$check_2,$id_encargado,$notificaciones_2);
        }
        if($revision_3)
        {
            if ($documento_3) {
                $documentos_3 = \File::get($documento_3);
            }else{
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_3)->first();
                if($sql) {
                    $documentos_3 = $sql->documento;
                }else{
                    $documentos_3 = "";
                } 
            }
            
            if ($notificacion3 == '') {
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_3)->first();
                if($sql) {
                    $notificaciones_3 = $sql->notificacion;
                }else{
                    $notificaciones_3 = "";
                }
            }else{
                $notificaciones_3 = $notificacion3;
            }
            
            $this->file_actualizar($documentos_3,$id_expediente,$revision_3,$check_3,$id_encargado,$notificaciones_3);
        }
        if($revision_4)
        {
             if ($documento_4) {
                $documentos_4 = \File::get($documento_4);
            }else{
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_4)->first();
                if($sql) {
                    $documentos_4 = $sql->documento;
                }else{
                    $documentos_4 = "";
                } 
            }
            
            if ($notificacion4 == '') {
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_4)->first();
                if($sql) {
                    $notificaciones_4 = $sql->notificacion;
                }else{
                    $notificaciones_4 = "";
                }
            }else{
                $notificaciones_4 = $notificacion4;
            }

            $this->file_actualizar($documentos_4,$id_expediente,$revision_4,$check_4,$id_encargado,$notificaciones_4);
        }
        if($revision_5)
        {
            if ($documento_5) {
                $documentos_5 = \File::get($documento_5);
            }else{
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_5)->first();
                if($sql) {
                    $documentos_5 = $sql->documento;
                }else{
                    $documentos_5 = "";
                } 
            }
            
            if ($notificacion5 == '') {
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_5)->first();
                if($sql) {
                    $notificaciones_5 = $sql->notificacion;
                }else{
                    $notificaciones_5 = "";
                }
            }else{
                $notificaciones_5 = $notificacion5;
            }
            
            $this->file_actualizar($documentos_5,$id_expediente,$revision_5,$check_5,$id_encargado,$notificaciones_5);
        }
        if($revision_6)
        {
            if ($documento_6) {
                $documentos_6 = \File::get($documento_6);
            }else{
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_6)->first();
                if($sql) {
                    $documentos_6 = $sql->documento;
                }else{
                    $documentos_6 = "";
                }
            }
            
            if ($notificacion6 == '') {
                $sql = DB::connection('gerencia_catastro')->table("soft_lic_edificacion.revisiones_encargado")->where('id_expediente',$id_expediente)->where('id_encargado',$id_encargado)->where('id_rev',$revision_6)->first();
                if($sql) {
                    $notificaciones_6 = $sql->notificacion;
                }else{
                    $notificaciones_6 = "";
                }
            }else{
                $notificaciones_6 = $notificacion6;
            }
            
            $this->file_actualizar($documentos_6,$id_expediente,$revision_6,$check_6,$id_encargado,$notificaciones_6);
        }
    }
    
    public function file_actualizar($documento,$id_expediente,$num,$estado,$id_encargado,$notificacion)
    {   
        $RevisionesEncargado = new RevisionesEncargado;
        $datos=  $RevisionesEncargado::where("id_expediente","=",$id_expediente)->where("id_encargado","=",$id_encargado)->where("id_rev","=",$num)->first();
        if(count($datos)>=1)
        {
            if ($datos->documento != "") {
                $datos->documento = $documento;
            }else{
                $datos->documento = base64_encode($documento); 
            }
            $datos->notificacion = $notificacion;
            $datos->estado = $estado;
            $datos->save();
        }
    }
}
