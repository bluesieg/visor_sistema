<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Condominios;
use App\Models\Predios\Predios_Anio;
use App\Models\Predios\Predios_Contribuyentes;

class CondominiosController extends Controller
{
    public function calculos_ivpp($id)
    {
        DB::select("select adm_tri.actualiza_base_predio(".$id.")");
        $Predios_Anio=new Predios_Anio;
        $Predios_Anio=  $Predios_Anio::where("id_pred_anio","=",$id )->first();
        $Predios_Contribuyentes=new Predios_Contribuyentes;
        $Predios_Contribuyentes=  $Predios_Contribuyentes::where("id_pred","=",$Predios_Anio->id_pred )->first();
        DB::select("select adm_tri.calcular_ivpp($Predios_Anio->anio,$Predios_Contribuyentes->id_contrib)");
    }
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
        $condos->id_pred_anio = $request['id_pre'];
        $condos->save();
        $this->calculos_ivpp($condos->id_pred_anio);
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
        $pisovw[0]->ape_pat=trim($pisovw[0]->ape_pat);
        $pisovw[0]->ape_mat=trim($pisovw[0]->ape_mat);
        $pisovw[0]->nombres=trim($pisovw[0]->nombres);
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
        $this->calculos_ivpp($val->id_pred_anio);
        return "edit".$id;
    }

    public function update(Request $request, $id)
    {
        //
    }

     public function destroy(Request $request)
    {
        $pred=0;
        $condos=new Condominios;
        $val=  $condos::where("id_condom","=",$request['id'] )->first();
        if(count($val)>=1)
        {
            $pred=$val->id_pred_anio;
            $val->delete();
        }
        $this->calculos_ivpp($pred);
        return "destroy ".$request['id'];
    }
    public function listcondos($id)
    {
        header('Content-type: application/json');
        $totalg = DB::select("select count(id_condom) as total from adm_tri.vw_condominios where id_pred_anio='$id'");
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
        
        $sql = DB::select("select * from adm_tri.vw_condominios where id_pred_anio='$id' order by id_condom asc");
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
