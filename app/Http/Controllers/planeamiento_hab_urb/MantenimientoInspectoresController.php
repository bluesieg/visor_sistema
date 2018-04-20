<?php

namespace App\Http\Controllers\planeamiento_hab_urb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Inspectores;


class MantenimientoInspectoresController extends Controller
{

    public function index()
    {
      
      
        $tip_sol = DB::connection('gerencia_catastro')->select('select * from soft_const_posesion.tipo_solictud');
        $inspectores = DB::connection('gerencia_catastro')->select('select id_inspector,apenom from soft_const_posesion.inspectores order by id_inspector');
        return view('planeamiento_hab_urb/wv_mantenimiento_inspectores',compact('anio','anio1','tip_sol','inspectores'));
    }

    public function create(Request $request)
    {
                $Inspectores = new  Inspectores;
                $Inspectores->dni = $request['dni'];
                $Inspectores->apenom = $request['apenom'];
            
                $Inspectores->save();

    }
     public function getInspectores(){
         header('Content-type: application/json');
            $page = $_GET['page'];
            $limit = $_GET['rows'];
            $sidx = $_GET['sidx'];
            $sord = $_GET['sord'];
            $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
            if ($start < 0) {
                $start = 0;
            }

             $totalg = DB::connection('gerencia_catastro')->select("select count(id_inspector) as total from soft_const_posesion.inspectores");
             $sql = DB::connection('gerencia_catastro')->table('soft_const_posesion.inspectores')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
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
            $Lista->rows[$Index]['id'] = $Datos->id_inspector;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_inspector),
                trim($Datos->dni),
                trim($Datos->apenom)
                
            );
        }

        return response()->json($Lista);

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
    public function show($id)
    {
        $inspectores = DB::connection("gerencia_catastro")->table('soft_const_posesion.inspectores')->where('id_inspector',$id)->get();
        return $inspectores;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $select=DB::connection('gerencia_catastro')->table('soft_const_posesion.inspectores')->where('dni',$request['dni'])->where('id_inspector','<>',$request['id_inspector'])->get();

            if (count($select)>= 1) {
                return response()->json([
                    'msg' => 'repetido',
                    ]);
            }else{
                $Inspectores = new  Inspectores;
                $val=  $Inspectores::where("id_inspector","=",$request['id_inspector'])->first();
                if(count($val)>=1)
                {
                    $val->dni = $request['dni'];
                    $val->apenom = $request['apenom'];
                    $val->save();
                }
                return $request['id_inspector'];
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
        $Inspectores = new  Inspectores;
        $val=  $Inspectores::where("id_inspector","=",$request['id_inspector'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        return "destroy ".$request['id_inspector'];
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
