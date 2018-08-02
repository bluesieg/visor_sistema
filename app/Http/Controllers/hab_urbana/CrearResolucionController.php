<?php

namespace App\Http\Controllers\hab_urbana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\hab_urbana\DocumentosHabUrb;
use Illuminate\Support\Facades\Response;


class CrearResolucionController extends Controller
{

    public function index()
    {
       
    }

    public function create(Request $request)
    {
        //declar_inscripcion;
        $file = $request->file('dlg_documento_file');
        
        if($file)
        {
            $file2 = \File::get($file);
            $dig=new DocumentosHabUrb;
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
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function traer_datos($id,Request $request)
    {
        $expedientes = DB::connection("gerencia_catastro")->table('soft_hab_urbana.vw_expedientes')->where('id_reg_exp',$id)->get();
        return $expedientes;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($id==0)
            {
                $expe=new RegistroExpedientesHabUrb;
                $val=  $expe::where("nro_exp","=",$request['cod'] )->first();
                if(count($val)>=1)
                {
                    return $val;
    }
                else
                {
                    return 0;
                }
            }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
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
        $RegistroExpedientesHabUrb = new  RegistroExpedientesHabUrb;
        $val=  $RegistroExpedientesHabUrb::where("id_reg_exp","=",$request['id_reg_exp'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        return "destroy ".$request['id_reg_exp'];
    }
    
    public function getExpedientes(Request $request){
        header('Content-type: application/json');
        $fecha_desde = $request['fecha_desde'];
        $fecha_hasta = $request['fecha_hasta'];
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_hab_urbana.vw_expedientes where fase=5 and fecha_registro between '$fecha_desde' and '$fecha_hasta'");
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

     

        $sql = DB::connection('gerencia_catastro')->table('soft_hab_urbana.vw_expedientes')->where('fase',5)->whereBetween('fecha_registro', [$fecha_desde, $fecha_hasta])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_reg_exp),
                trim($Datos->nro_exp),
                trim($Datos->fase),
                trim($Datos->gestor),
                trim($Datos->fecha_inicio_tramite),
                '<button class="btn btn-labeled bg-color-greenDark txt-color-white" type="button" onclick="subir_scan('.trim($Datos->id_reg_exp).')"><span class="btn-label"><i class="fa fa-print"></i></span> SUBIR ESCANEO</button>'

            );
        }

        return response()->json($Lista);

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

         $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_hab_urbana.vw_expedientes where fase=5 ");
         $sql = DB::connection('gerencia_catastro')->table('soft_hab_urbana.vw_expedientes')->whereBetween('fecha_registro',[$request['fecini'], $request['fecfin']])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
    
     public function cargar_documetos(Request $request)
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

             $totalg = DB::connection('gerencia_catastro')->select("select count(id_reg_exp) as total from soft_hab_urbana.vw_doc_adjuntos where id_reg_exp=".$request['id']);
             $sql = DB::connection('gerencia_catastro')->table('soft_hab_urbana.vw_doc_adjuntos')->where('id_reg_exp',$request['id'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
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
                    trim($Datos->t_documento),
                    trim($Datos->descripcion),
                    '<button class="btn btn-labeled btn-warning" type="button" onclick="verfile('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver</button>',
                    '<button class="btn btn-labeled btn-danger" type="button" onclick="delfile('.trim($Datos->id_doc_adj).')"><span class="btn-label"><i class="fa fa-trash"></i></span> Borrar</button>',
                );
            }
            return response()->json($Lista);
    }
    public function ver_file_hab_urb($id)
    {
        $sql = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.documentos_adjuntos where id_doc_adj='.$id);
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
