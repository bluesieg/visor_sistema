<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Pisos;

class PisosController extends Controller
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $pisos=new Pisos;
        $totapisos = DB::select("select count(id_pisos) as total from adm_tri.pisos where id_predio='".$request['id_pre']."'");
        $pisos->anio = date("Y");
        $pisos->cod_piso = $request['nro'];
        $pisos->fch_const = $request['fech'];
        $pisos->ant_ano = date("Y") - substr($request['fech'],-4);
        $pisos->clas = "0".$request['clasi'];
        $pisos->mep = $request['mep'];
        $pisos->esc = $request['estconserv'];
        $pisos->ecc = $request['estconst'];
        $pisos->est_mur = substr($request['estru'],0,1);
        $pisos->est_tch = substr($request['estru'],1,1);
        $pisos->aca_pis = substr($request['estru'],2,1);
        $pisos->aca_pta = substr($request['estru'],3,1);
        $pisos->aca_rev = substr($request['estru'],4,1);
        $pisos->aca_ban = substr($request['estru'],5,1);
        $pisos->ins_ele = substr($request['estru'],6,1);
        $pisos->area_const = $request['aconst'];
        $pisos->val_areas_com = $request['acomun'];
        $pisos->num_pis = $totapisos[0]->total+1;
        $pisos->id_predio = $request['id_pre'];
        $pisos->save();
        DB::select("select adm_tri.fn_count_pisos(".$request['id_pre'].")");
        DB::select("select adm_tri.actualiza_base_predio(".$request['id_pre'].")");
        return $pisos->id_pisos;
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
        $pisovw= DB::table('adm_tri.vw_pisos')->where('id_pisos',$id)->get();
        $pisovw[0]->fch_const=date("d/m/Y",strtotime(str_replace("/", "-", $pisovw[0]->fch_const)));
        return $pisovw;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $pisos=new Pisos;
        $val=  $pisos::where("id_pisos","=",$id )->first();
        if(count($val)>=1)
        {
            $val->cod_piso = $request['nro'];
            $val->fch_const = $request['fech'];
            $val->ant_ano = date("Y") - substr($request['fech'],-4);
            $val->clas = "0".$request['clasi'];
            $val->mep = $request['mep'];
            $val->esc = $request['estconserv'];
            $val->ecc = $request['estconst'];
            $val->est_mur = substr($request['estru'],0,1);
            $val->est_tch = substr($request['estru'],1,1);
            $val->aca_pis = substr($request['estru'],2,1);
            $val->aca_pta = substr($request['estru'],3,1);
            $val->aca_rev = substr($request['estru'],4,1);
            $val->aca_ban = substr($request['estru'],5,1);
            $val->ins_ele = substr($request['estru'],6,1);
            $val->area_const = $request['aconst'];
            $val->val_areas_com = $request['acomun'];
            $val->save();
            DB::select("select adm_tri.fn_count_pisos(".$val->id_predio.")");
            DB::select("select adm_tri.actualiza_base_predio(".$val->id_predio.")");
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function listpisos($id)
    {
        header('Content-type: application/json');
        $totalg = DB::select("select count(id_pisos) as total from adm_tri.vw_pisos where id_predio='$id'");
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
        
        $sql = DB::select("select * from adm_tri.vw_pisos where id_predio='$id' order by cod_piso asc");
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_pisos;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_pisos),
                trim($Datos->cod_piso),
                date("d/m/Y",strtotime(str_replace("/", "-", $Datos->fch_const))),
                trim($Datos->mep),
                trim($Datos->esc), 
                trim($Datos->ecc),
                trim($Datos->est_mur),
                trim($Datos->est_tch),
                trim($Datos->aca_pis),               
                trim($Datos->aca_pta),               
                trim($Datos->aca_rev),               
                trim($Datos->aca_ban),               
                trim($Datos->ins_ele),               
                trim($Datos->area_const),               
            );
        }
        return response()->json($Lista);
    }
}
