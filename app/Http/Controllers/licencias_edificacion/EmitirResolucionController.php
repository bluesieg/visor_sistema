<?php

namespace App\Http\Controllers\licencias_edificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\licencias_edificacion\RecDocumentos;
use App\Models\licencias_edificacion\RevisionesEncargado;
use Illuminate\Support\Facades\Response;
use App\Models\licencias_edificacion\Documentos_Ajuntos;


class EmitirResolucionController extends Controller
{

    public function index()
    {
        return view('licencias_edificacion/wv_recdocumentos');
    }

    public function create(Request $request)
    {
        $file = $request->file('dlg_documento_file');
        
        if($file)
        {
            $file2 = \File::get($file);
            $dig=new Documentos_Ajuntos;
            $dig->id_tip_doc=$request['seltipdoc'];
            $dig->archivo = base64_encode($file2);
            $dig->id_reg_exp = $request['id_scan'];
            $dig->descripcion = $request['dlg_documento_des'];
            $dig->save();
            return $dig->id_doc_adj;
        }
        else
        {
            return 0;
        }
    }
    
    function get_pdf()
    {   
           $file = file_get_contents($_FILES['dlg_documento_file']['tmp_name']);
            if($_FILES["dlg_documento_file"]["type"]=='application/pdf')
            {  
                return Response::make($file, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="prueba"'
                ]);
            }
            else
            {    return "<html><head></head><body style='margin:3px;padding:0px;font-family:verdana;font-size:11px'>No es .pdf</body></html>";$i=0;}
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
        $Documentos_Ajuntos = new  Documentos_Ajuntos;
        $val=  $Documentos_Ajuntos::where("id_reg_exp","=",$request['id_reg_exp'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        return "destroy ".$request['id_reg_exp'];
    }
    
    public function get_expedientes_resolucion(Request $request){
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

         $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_emitir_resolucion");
         $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_emitir_resolucion')->whereBetween('fecha_registro',[$request['fecini'], $request['fecfin']])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_reg_exp),
                trim($Datos->nro_exp),
                trim($Datos->gestor),
                trim($Datos->fecha_registro),
                '<button class="btn btn-labeled bg-color-greenDark txt-color-white" type="button" onclick="subir_scan('.trim($Datos->id_reg_exp).')"><span class="btn-label"><i class="fa fa-print"></i></span> SUBIR ESCANEO</button>'
            );
        }
        return response()->json($Lista);
    }
    
    public function get_docs(Request $request){
        header('Content-type: application/json');
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

         $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_doc_adjuntos where id_reg_exp=".$request['id']);
         $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_doc_adjuntos')->where('id_reg_exp',$request['id'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
                '<button class="btn btn-labeled btn-warning" type="button" onclick="verfile('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver</button>',
                '<button class="btn btn-labeled btn-danger" type="button" onclick="delfile('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-trash"></i></span> Borrar</button>',
            );
        }
        return response()->json($Lista);
    }
    
    public function ver_documentos($id)
    {
        $sql = DB::connection('gerencia_catastro')->select('select * from soft_lic_edificacion.documentos_adjuntos where id_doc_adj='.$id);
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
}
