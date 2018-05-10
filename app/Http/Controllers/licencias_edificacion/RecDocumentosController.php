<?php

namespace App\Http\Controllers\licencias_edificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\licencias_edificacion\RecDocumentos;


class RecDocumentosController extends Controller
{

    public function index()
    {
        $encargados = DB::connection('gerencia_catastro')->select('select * from soft_lic_edificacion.encargado order by id_encargado asc');
        $modalidad = DB::connection('gerencia_catastro')->select('select * from soft_lic_edificacion.procedimiento order by descr_procedimiento desc');
        $tip_doc = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.tipo_documento order by 1');
        return view('licencias_edificacion/wv_recdocumentos',  compact('modalidad','encargados','tip_doc'));
    }

    public function create(Request $request)
    {
        $codigo = $request['cod'];
        $expedientes = DB::connection("sql_crud")->table('vw_catastro')->where('codigoTramite',$codigo)->first();
        
        $select=DB::connection('gerencia_catastro')->table('soft_lic_edificacion.registro_expediente')->where('nro_exp',$codigo)->get();
        
        if(count($expedientes)>=1)
        {
            if (count($select)>=1) {
                
                return response()->json([
                'msg' => 'repetido',
                ]);
                
            }else{
                
                $RecDocumentos = new  RecDocumentos;
            
                $RecDocumentos->nro_exp = $expedientes->codigoTramite;
                $RecDocumentos->id_gestor = $expedientes->idInteresado;
                $RecDocumentos->id_usuario = 1;
                $RecDocumentos->fase = 1;
                $RecDocumentos->gestor = $expedientes->nombres.' '.$expedientes->apellidos;
                $RecDocumentos->fecha_inicio_tramite = $expedientes->iniciado;
                $RecDocumentos->fecha_registro = date('d-m-Y');
                $RecDocumentos->nro_doc_gestor = $expedientes->numeroIdentificacion;

                $RecDocumentos->save();

                return $RecDocumentos->id_reg_exp;
                
            }
            
        }else{
            return response()->json([
                'msg' => 'no',
            ]);
        }
        
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
        $expedientes = DB::connection("gerencia_catastro")->table('soft_lic_edificacion.vw_registro_expediente')->where('id_reg_exp',$id)->get();
        return $expedientes; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $select=DB::connection('gerencia_catastro')->table('soft_lic_edificacion.registro_expediente')->where('nro_exp',$request['nro_expediente'])->where('id_reg_exp','<>',$request['id_reg_exp'])->get();

        if (count($select)>= 1) {
            return response()->json([
                'msg' => 'repetido',
                ]);
        }else{
            $RecDocumentos = new  RecDocumentos;
            $val=  $RecDocumentos::where("id_reg_exp","=",$id )->first();
            if(count($val)>=1)
            {
                $val->nro_exp = $request['nro_expediente'];
                $val->gestor = $request['gestor'];
                $val->fecha_inicio_tramite = $request['fecha_inicio_tramite'];
                $val->fecha_registro = $request['fecha_registro'];
                $val->save();
            }
            return $id;
        }     
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
        $RecDocumentos = new  RecDocumentos;
        $val=  $RecDocumentos::where("id_reg_exp","=",$request['id_reg_exp'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        return "destroy ".$request['id_reg_exp'];
    }
    
    public function get_documentos(Request $request){
        header('Content-type: application/json');
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_registro_expediente");
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

     

        $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_registro_expediente')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
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
                trim($Datos->fecha_registro)
            );
        }

        return response()->json($Lista);

    }
    
}
