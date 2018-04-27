<?php

namespace App\Http\Controllers\licencias_edificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\licencias_edificacion\Procedimiento;


class ProcedimientoController extends Controller
{

    public function index()
    {
        $anio = DB::connection('gerencia_catastro')->select('select * from soft_lic_edificacion.anios');
        return view('licencias_edificacion/wv_procedimiento',compact('anio'));
    }

    public function create(Request $request)
    {
        $Procedimiento = new  Procedimiento;
        $Procedimiento->descr_procedimiento = $request['descripcion'];
        $Procedimiento->anio = $request['anio'];

        $Procedimiento->save();
        return $Procedimiento->id_procedimiento;

    }
     public function get_procedimientos(){
         header('Content-type: application/json');
            $page = $_GET['page'];
            $limit = $_GET['rows'];
            $sidx = $_GET['sidx'];
            $sord = $_GET['sord'];
            $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
            if ($start < 0) {
                $start = 0;
            }

            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_procedimiento");
            $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_procedimiento')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
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
            $Lista->rows[$Index]['id'] = $Datos->id_procedimiento;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_procedimiento),
                trim($Datos->descr_procedimiento) 
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
        $procedimiento = DB::connection("gerencia_catastro")->table('soft_lic_edificacion.vw_procedimiento')->where('id_procedimiento',$id)->get();
        return $procedimiento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $Procedimiento = new  Procedimiento;
        $val=  $Procedimiento::where("id_procedimiento","=",$request['id_procedimiento'])->first();
        if(count($val)>=1)
        {
            $val->descr_procedimiento = $request['descripcion'];
            $val->anio = $request['anio'];
            $val->save();
        }
        return $request['id_procedimiento'];        
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
        $Procedimiento = new  Procedimiento;
        $val=  $Procedimiento::where("id_procedimiento","=",$request['id_procedimiento'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        return "destroy ".$request['id_procedimiento'];
    }
    
    
}
