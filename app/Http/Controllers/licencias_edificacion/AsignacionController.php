<?php

namespace App\Http\Controllers\licencias_edificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\licencias_edificacion\RecDocumentos;


class AsignacionController extends Controller
{

    public function index()
    {
        return view('licencias_edificacion/wv_recdocumentos');
    }

    public function create(Request $request)
    {
        
    }
    
    public function buscar_expdiente_asignacion(Request $request){
        $codigo = $request['codigo'];
        $expedientes = DB::connection("gerencia_catastro")->table('soft_lic_edificacion.registro_expediente')->where('nro_exp',$codigo)->first();
        
        if(count($expedientes)>=1)
        {
            if ($expedientes->cod_interno == 0) {
                return response()->json([
                    'msg' => 'si',
                    'id_reg_exp' => $expedientes->id_reg_exp,
                ]);    
            }else{
                return response()->json([
                    'msg' => 'existe',
                ]);
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
    public function edit($id_reg_exp,Request $request)
    {
        $select=DB::connection('gerencia_catastro')->table('soft_lic_edificacion.registro_expediente')->where('cod_interno',$request['codigo_interno'])->where('id_reg_exp','<>',$request['id_reg_exp'])->get();

        if (count($select)>= 1) {
            return response()->json([
                'msg' => 'repetido',
                ]);
        }else{
            $RecDocumentos = new  RecDocumentos;
            $val=  $RecDocumentos::where("id_reg_exp","=",$id_reg_exp)->first();
            if(count($val)>=1)
            {
                $val->id_procedimiento = $request['modalidad'];
                $val->cod_interno = $request['codigo_interno'];
                $val->save();
            }
            $this->actualizar_expediente($id_reg_exp);
        }     
    }
    
    public function actualizar_expediente($id_reg_exp)
    {
        $RecDocumentos = new RecDocumentos;
        $val=  $RecDocumentos::where("id_reg_exp","=",$id_reg_exp)->first();
        if(count($val)>=1)
        {
            $val->fase = 2;
            $val->save();
        }
        return $id_reg_exp;
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
    
    public function get_asignacion(Request $request){
        header('Content-type: application/json');
        $fecha_inicio = $request['fecha_inicio'];
        $fecha_fin = $request['fecha_fin'];
        
        $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_asignac where fecha_registro between '$fecha_inicio' and '$fecha_fin'");
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

     

        $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_asignac')->whereBetween('fecha_registro', [$fecha_inicio, $fecha_fin])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_reg_exp;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_reg_exp),
                trim($Datos->nro_exp),
                trim($Datos->fecha_registro),
                trim($Datos->gestor),
                trim($Datos->cod_interno),
                trim($Datos->descr_procedimiento)
            );
        }

        return response()->json($Lista);

    }
    
}
