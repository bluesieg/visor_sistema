<?php

namespace App\Http\Controllers\planeamiento_hab_urb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroExpedientes;


class RegistroExpedientesController extends Controller
{

    public function index()
    {
      
        $anio = DB::select('select anio from adm_tri.uit order by anio desc');
        $anio1 = DB::select('select anio from adm_tri.uit order by anio asc');
        $tip_sol = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.tipo_solictud');
        return view('planeamiento_hab_urb/vw_constancia_posesion',compact('anio','anio1','tip_sol'));
    }

    public function create(Request $request)
    {
        $codigo = $request['cod'];
        $expedientes = DB::connection("sql_crud")->table('vw_catastro')->where('codigoTramite',$codigo)->first();
        
        $select=DB::connection('gerencia_catastro')->table('soft_const_posesion.regist_expediente')->where('nro_expediente',$expedientes->codigoTramite)->get();
        
        if(count($expedientes)>=1)
        {
            if (count($select)>=1) {
                
                return response()->json([
                'msg' => 'repetido',
                ]);
                
            }else{
                
                $RegistroExpedientes = new  RegistroExpedientes;
            
                $RegistroExpedientes->nro_expediente = $expedientes->codigoTramite;
                $RegistroExpedientes->id_gestor = $expedientes->idInteresado;
                $RegistroExpedientes->id_estado = 1;
                $RegistroExpedientes->id_usuario = 1;
                $RegistroExpedientes->fase = 1;
                $RegistroExpedientes->gestor = $expedientes->nombres;
                $RegistroExpedientes->fecha_inicio_tramite = $expedientes->iniciado;
                $RegistroExpedientes->fecha_registro = date('d-m-Y');
                $RegistroExpedientes->numero_identificacion = $expedientes->numeroIdentificacion;

                $RegistroExpedientes->save();

                return $RegistroExpedientes->id_reg_exp;
                
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
    public function traer_datos($id,Request $request)
    {
        if($id==0)
            {
                $expe=new RegistroExpedientes;
                $val=  $expe::where("nro_expediente","=",$request['cod_expediente'] )->first();
                if(count($val)>=1)
                {
                    return $val->id_reg_exp;
                }
                else
                {
                    return 0;
                }
            }
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
                $expe=new RegistroExpedientes;
                $val=  $expe::where("nro_expediente","=",$request['cod'] )->first();
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
        
        $select=DB::connection('gerencia_catastro')->table('soft_const_posesion.regist_expediente')->where('nro_expediente',$request['nro_expediente'])->where('id_reg_exp','<>',$request['id_reg_exp'])->get();
        
        if (count($select)>= 1) {
            return response()->json([
                'msg' => 'repetido',
                ]);
        }else{
            $RegistroExpedientes = new  RegistroExpedientes;
            $val=  $RegistroExpedientes::where("id_reg_exp","=",$id )->first();
            if(count($val)>=1)
            {
                $val->nro_expediente = $request['nro_expediente'];
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
        $RegistroExpedientes = new  RegistroExpedientes;
        $val=  $RegistroExpedientes::where("id_reg_exp","=",$request['id_reg_exp'] )->first();
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
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_const_posesion.vw_expedientes where fecha_registro between '$fecha_desde' and '$fecha_hasta'");
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

     

        $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.vw_expedientes')->whereBetween('fecha_registro', [$fecha_desde, $fecha_hasta])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_reg_exp),
                trim($Datos->nro_expediente),
                trim($Datos->fase),
                trim($Datos->gestor),
                trim($Datos->fecha_inicio_tramite),
                trim($Datos->fecha_registro)
            );
        }

        return response()->json($Lista);

    }
    
}
