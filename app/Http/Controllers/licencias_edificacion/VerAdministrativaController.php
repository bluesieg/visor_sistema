<?php

namespace App\Http\Controllers\licencias_edificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\licencias_edificacion\RecDocumentos;
use App\Models\licencias_edificacion\ExpedienteRequisitos;


class VerAdministrativaController extends Controller
{

    public function index()
    {
        return view('licencias_edificacion/wv_recdocumentos');
    }

    public function create(Request $request)
    {
        $ExpedienteRequisitos = new ExpedienteRequisitos;
        $ExpedienteRequisitos->id_requisito = $request['id_requisito'];
        $ExpedienteRequisitos->estado = $request['estado'];
        $ExpedienteRequisitos->id_expediente = $request['id_reg_exp'];
        $ExpedienteRequisitos->save();
    }
    
    public function buscar_codigo_interno(Request $request){
        $codigo = $request['codigo'];
        $expedientes = DB::connection("gerencia_catastro")->table('soft_lic_edificacion.registro_expediente')->where('cod_interno',$codigo)->first();
        
        if(count($expedientes)>=1)
        {
            $procedimiento = DB::connection("gerencia_catastro")->table("soft_lic_edificacion.procedimiento")->where('id_procedimiento',$expedientes->id_procedimiento)->first();
            return response()->json([
                'msg' => 'si',
                'nro_exp' => $expedientes->nro_exp,
                'gestor' => $expedientes->gestor,
                'id_procedimiento' => $procedimiento->id_procedimiento,
                'procedimiento' => $procedimiento->descr_procedimiento,
                'id_reg_exp' => $expedientes->id_reg_exp,
            ]);    
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
        $expedientes = DB::connection("gerencia_catastro")->table('soft_lic_edificacion.vw_verif_admin')->where('id_reg_exp',$id)->get();
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
        $ExpedienteRequisitos = new ExpedienteRequisitos;
        $val=  $ExpedienteRequisitos::where("id_requisito","=",$id_requisito)->where("id_expediente","=",$request['id_reg_exp'])->first();
        if(count($val)>=1)
        {
            $val->estado = $request['estado'];
            $val->save();
        }
        return $request['id_requisito'];       
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
    
    public function get_verif_administrativa(Request $request){
        header('Content-type: application/json');
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_verif_admin");
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

     

        $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_verif_admin')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
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
    
    public function buscar_requisitos(Request $request){
        header('Content-type: application/json');
        $indice = $request['indice'];
        
        if ($indice == 0) {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.requisitos where id_proced = 0");
        }else{
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.requisitos where id_proced = '$indice'");
        }
        
        
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

     
        if ($indice == 0) {
            $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.requisitos')->where('id_proced',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }else{
            $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.requisitos')->where('id_proced',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_requisito;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_requisito),
                trim($Datos->desc_requisito),
                "<input type='checkbox' name='id_requisito_check' id_requisito = '$Datos->id_requisito'>",
                trim(0),
            );
        }

        return response()->json($Lista);

    }
    
    public function recuperar_requisitos(Request $request){
        header('Content-type: application/json');
        $indice = $request['indice'];
        
        if ($indice == 0) {
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_expediente_requisitos where id_e_r = 0");
        }else{
            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_expediente_requisitos where id_expediente = '$indice'");
        }
        
        
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

     
        if ($indice == 0) {
            $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_expediente_requisitos')->where('id_e_r',0)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }else{
            $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_expediente_requisitos')->where('id_expediente',$indice)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        }
        
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_requisito;
            if ($Datos->estado == 1) {
              $nuevo = "<input type='checkbox' name='estado' checked='true' id_requisito = '$Datos->id_requisito'>";
            }else{
              $nuevo = "<input type='checkbox' name='estado' id_requisito = '$Datos->id_requisito'>";
            }
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_requisito),
                trim($Datos->desc_requisito),
                $nuevo,
            );
        }

        return response()->json($Lista);

    }
}
