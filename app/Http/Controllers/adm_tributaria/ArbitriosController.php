<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\models\Arbitrios;
class ArbitriosController extends Controller
{
    
    public function index()
    {
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        $barrido = DB::select("select * from arbitrios.barrido_calles where anio='".date("Y")."' order by frecuencia");
        $seren = DB::select("select * from arbitrios.vw_serenazgo where anio='".date("Y")."' order by id_cat");
        $parjar = DB::select("select * from arbitrios.vw_parq_jardines where anio='".date("Y")."' order by id_cat");
        $upa = DB::select('select * from adm_tri.uso_predio_arbitrios order by id_uso_arb ');
        return view('adm_tributaria/vw_arbitrios', compact('anio_tra','barrido','seren','parjar','upa'));
    }

    
    public function create(Request $request)
    {
        $Arbitrio=new Arbitrios;
        $Arbitrio->id_pred = $request['pred'];
        $Arbitrio->cod_cat = $request['cod'];
        $Arbitrio->anio = $request['an'];
        $Arbitrio->id_bar_cal = $request['barfrec'];
        $Arbitrio->frentera = $request['barfrent'];
        $Arbitrio->id_rrs = $request['rrsfrec'];
        $Arbitrio->id_seren = $request['seren'];
        $Arbitrio->id_par_jar = $request['parjar'];
        $Arbitrio->save();
        return $Arbitrio->id_arb;
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

    public function show($id,Request $request)
    {
        $arbitriovw= DB::table('arbitrios.vw_arbitrios')->where('id_pred',$id)->where('anio',$request['an'])->get();
        if(count($arbitriovw)<1)
        {
            $arbitriovw=DB::table('adm_tri.vw_area_construida')->where('id_predio',$id)->get();
        }
        else
        {
            $arbitriovw[0]->id_predio=0;
        }
        return $arbitriovw;
    }

    public function edit(Request $request,$id)
    {
        $Arbitrio=new Arbitrios;
        $val=  $Arbitrio::where("id_arb","=",$id )->first();
        if(count($val)>=1)
        {
            $val->id_bar_cal = $request['barfrec'];
            $val->frentera = $request['barfrent'];
            $val->id_rrs = $request['rrsfrec'];
            $val->id_seren = $request['seren'];
            $val->id_par_jar = $request['parjar'];
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
    public function listarbitrios(Request $request)
    {
        
        header('Content-type: application/json');
        $totalg = DB::select("select count(id_arb) as total from arbitrios.vw_arbitrios where id_pred=".$request["pre"]." and anio=".$request["an"]);
        $sql = DB::select("select * from arbitrios.vw_arbitrios where id_pred=".$request["pre"]." and anio=".$request["an"]);
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        $total_pages = 0;
        if (!$sidx){
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
        
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_arb;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_arb),
                trim($Datos->cod_cat),
                trim($Datos->anio),
                trim($Datos->frecu_bar),
                trim($Datos->cos_bar), 
                trim($Datos->frecu_rrs), 
                trim($Datos->cos_rrs), 
                trim($Datos->par_cat_des),
                trim($Datos->cos_jar),               
                trim($Datos->id_cat_seren),              
                trim($Datos->cos_seren)               
                            
            );
        }
        return response()->json($Lista);
    }
    public function frec_rrs(Request $request)
    {
    $frecvw= DB::table('arbitrios.rec_res_sol')->where('id_uso',$request['id'])->where('anio',$request['an'])->get();
        return $frecvw;
    }
}
