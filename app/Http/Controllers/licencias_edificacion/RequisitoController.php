<?php

namespace App\Http\Controllers\licencias_edificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\licencias_edificacion\Requisito;


class RequisitoController extends Controller
{

    public function index()
    {
        $anio = DB::connection('gerencia_catastro')->select('select * from soft_lic_edificacion.anios');
        return view('licencias_edificacion/wv_requisito',compact('anio'));
    }

    public function create(Request $request)
    {
        $Requisito = new  Requisito;
        $Requisito->id_proced = $request['id_procedimiento'];
        $Requisito->desc_requisito = $request['descrip_requisito'];
        $Requisito->anio = $request['anio'];
        $Requisito->estado = $request['estado'];

        $Requisito->save();
        return $Requisito->id_requisito;

    }
     public function get_requisitos(){
         header('Content-type: application/json');
            $page = $_GET['page'];
            $limit = $_GET['rows'];
            $sidx = $_GET['sidx'];
            $sord = $_GET['sord'];
            $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
            if ($start < 0) {
                $start = 0;
            }

            $totalg = DB::connection('gerencia_catastro')->select("select count(*) as total from soft_lic_edificacion.vw_requisitos");
            $sql = DB::connection('gerencia_catastro')->table('soft_lic_edificacion.vw_requisitos')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
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
            $Lista->rows[$Index]['id'] = $Datos->id_requisito;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_requisito),
                trim($Datos->desc_requisito)
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
        $requisito = DB::connection("gerencia_catastro")->table('soft_lic_edificacion.vw_requisitos')->where('id_requisito',$id)->get();
        return $requisito;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $Requisito = new Requisito;
        $val=  $Requisito::where("id_requisito","=",$request['id_requisito'])->first();
        if(count($val)>=1)
        {
            $val->desc_requisito = $request['descrip_requisito'];
            $val->anio = $request['anio'];
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
        $Requisito = new  Requisito;
        $val=  $Requisito::where("id_requisito","=",$request['id_requisito'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        return "destroy ".$request['id_requisito'];
    }
    
    
}
