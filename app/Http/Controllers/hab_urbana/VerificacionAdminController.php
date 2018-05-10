<?php

namespace App\Http\Controllers\hab_urbana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\hab_urbana\VerificacionAdmin;
use App\Models\hab_urbana\ExpedRequisitos;


class VerificacionAdminController extends Controller
{

    public function index()
    {
        $fase = DB::select('SELECT fase, descr_fase FROM soft_hab_urbana.fase');
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        $anio1 = DB::select('select anio from adm_tri.uit order by anio asc');
        $tip_sol = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.tipo_solictud');
        $inspectores = DB::connection('gerencia_catastro')->select('select id_inspector,apenom from soft_const_posesion.inspectores order by id_inspector');
        $tip_doc = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.tipo_documento order by 1');
    }

    public function create(Request $request)
    {
          
                $VerificacionAdmin = new  VerificacionAdmin;
                $VerificacionAdmin->id_expediente = $request['id_reg_exp'];
                $VerificacionAdmin->id_procedimiento = $request['procedimiento'];
                $VerificacionAdmin->fch_verif = date('d-m-Y');
                $VerificacionAdmin->observacion = $request['observacion'];
                $VerificacionAdmin->save();
                Return  $VerificacionAdmin->id_expediente ;
                
    }
      public function insertar_requisitos(Request $request)
    {
          
                $ExpedRequisitos = new  ExpedRequisitos;
                $ExpedRequisitos->id_expediente = $request['id_reg_exp'];
                $ExpedRequisitos->id_requisito = $request['id_requisito'];
                $ExpedRequisitos->estado = $request['estado'];
                $ExpedRequisitos->save();
                
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
     public function edit($id)
    {
         $VerificacionAdmin = new  VerificacionAdmin;
         $val=  $VerificacionAdmin::where("id_expediente","=",$id )->first();
         if(count($val)>=1)
         {
             $val->fec_notificacion = date('d-m-Y');
             $val->save();
         }
         return $id;
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
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_hab_urbana.vw_expedientes where fase=2 and fecha_registro between '$fecha_desde' and '$fecha_hasta'");
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

     

        $sql = DB::connection('gerencia_catastro')->table('soft_hab_urbana.vw_expedientes')->where('fase',2)->whereBetween('fecha_registro', [$fecha_desde, $fecha_hasta])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
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
                trim($Datos->fecha_registro),
                '<button class="btn btn-labeled bg-color-greenDark txt-color-white" type="button" onclick="enviar_a_notificados_admin('.trim($Datos->id_reg_exp).')"><span class="btn-label"><i class="fa fa-print"></i></span> Fec. Notificación</button>'

            );
        }

        return response()->json($Lista);

    }
     public function getRequisitos(Request $request){
        header('Content-type: application/json');
        $id_procedimiento = $request['id'];
       
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.requisitos where id_proced = $id_procedimiento");
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

     

        $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.requisitos')->where('id_proced',$id_procedimiento)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_requisito;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_requisito),
                trim($Datos->desc_requisito),
                "<input type='checkbox' name='estado' id_requisito = '$Datos->id_requisito'>"
            );
        }

        return response()->json($Lista);

    }
    
}
