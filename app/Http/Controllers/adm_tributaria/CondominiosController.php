<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Condominios;

class CondominiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $condos=new Condominios;
        $condos->id_contrib = $request['contrib'];
        $condos->direccion = $request['dir'];
        $condos->porcent = $request['porc'];
        $condos->id_pred = $request['id_pre'];
        $condos->save();
        return $condos->id_condom;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pisovw= DB::table('adm_tri.vw_condominios')->where('id_condom',$id)->get();
        return $pisovw;
    }

    public function edit(Request $request,$id)
    {
        $condos=new Condominios;
        $val=  $condos::where("id_condom","=",$id )->first();
        if(count($val)>=1)
        {
            $val->id_contrib = $request['contrib'];
            $val->direccion = $request['dir'];
            $val->porcent = $request['porc'];
            $val->save();
        }
        return "edit".$id;
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

     public function destroy(Request $request)
    {
        $condos=new Condominios;
        $val=  $condos::where("id_condom","=",$request['id'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        return "destroy ".$request['id'];
    }
    public function listcondos($id)
    {
        header('Content-type: application/json');
        $totalg = DB::select("select count(id_condom) as total from adm_tri.vw_condominios where id_pred='$id'");
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
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }
        
        $sql = DB::select("select * from adm_tri.vw_condominios where id_pred='$id' order by id_condom asc");
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_condom;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_condom),
                trim($Datos->nro_doc),
                trim($Datos->ape_pat)." ".trim($Datos->ape_mat)." ".trim($Datos->nombres),
                trim($Datos->direccion), 
                trim($Datos->porcent)
            );
        }
        return response()->json($Lista);
    }
}
