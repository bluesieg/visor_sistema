<?php

namespace App\Http\Controllers\hab_urbana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\hab_urbana\VerificacionAdmin;
use App\Models\hab_urbana\RegistroExpedientesHabUrb;


class CrearPoligonoController extends Controller
{

    public function index()
    {
        $fase = DB::select('SELECT fase, descr_fase FROM soft_hab_urbana.fase');
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        $anio1 = DB::select('select anio from adm_tri.uit order by anio asc');
        $tip_sol = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.tipo_solictud');
        $inspectores = DB::connection('gerencia_catastro')->select('select id_inspector,apenom from soft_const_posesion.inspectores order by id_inspector');
        $tip_doc = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.tipo_documento order by 1');
        return view('hab_urbana/vw_hab_urbana',compact('anio','anio1','tip_sol','inspectores','tip_doc'));
    }

    public function create(Request $request)
    {
          
                $VerificacionAdmin = new  VerificacionAdmin;
                $VerificacionAdmin->id_expediente = $request['id_reg_exp'];
                $VerificacionAdmin->id_procedimiento = $request['procedimiento'];
                $VerificacionAdmin->fch_verif = date('d-m-Y');
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
        $exp_poligono = DB::connection("gerencia_catastro")->table('soft_hab_urbana.registro_expediente_hab_urb')->where('id_reg_exp',$id)->get();
        return $exp_poligono;
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $select=DB::connection('gerencia_catastro')->table('soft_hab_urbana.registro_expediente_hab_urb')->where('id_hab_urb',$request['id_hab_urb'])->where('id_reg_exp','<>',$request['id_reg_exp'])->get();

            if (count($select)>= 1) {
                return response()->json([
                    'msg' => 'repetido',
                    ]);
            }else{
                $RegistroExpedientesHabUrb = new  RegistroExpedientesHabUrb;
                $val=  $RegistroExpedientesHabUrb::where("id_reg_exp","=",$id )->first();
                if(count($val)>=1)
                {
                    $val->id_hab_urb = $request['id_hab_urb'];
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
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_hab_urbana.vw_expedientes where fase=3 and fecha_registro between '$fecha_desde' and '$fecha_hasta'");
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

     

        $sql = DB::connection('gerencia_catastro')->table('soft_hab_urbana.vw_expedientes')->where('fase',3)->whereBetween('fecha_registro', [$fecha_desde, $fecha_hasta])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
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
