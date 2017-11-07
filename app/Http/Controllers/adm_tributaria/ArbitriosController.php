<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\models\Arbitrios;
use App\Models\Cta_Arbitrios;
use App\Models\Pgo_Arbitrios;
use Illuminate\Support\Facades\Auth;
class ArbitriosController extends Controller
{
    
    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_arbmun' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        $barrido = $this->barrido_by_an(date("Y"));
        $seren = $this->serenazgo_by_an(date("Y"));
        $parjar = $this->paques_by_an(date("Y"));
        $upa = DB::select('select * from adm_tri.uso_predio_arbitrios order by id_uso_arb ');
        return view('adm_tributaria/vw_arbitrios', compact('anio_tra','barrido','seren','parjar','upa','permisos','menu'));
    }
    
    public function barrido_by_an($an)
    {
        return DB::select("select * from arbitrios.barrido_calles where anio='$an' order by frecuencia");
    }
    public function serenazgo_by_an($an)
    {
        return DB::select("select * from arbitrios.vw_serenazgo where anio='$an' order by id_cat");
    }
    public function paques_by_an($an)
    {
        return DB::select("select * from arbitrios.vw_parq_jardines where anio='$an' order by id_cat");
    }
    
    public function create(Request $request)
    {
        $Arbitrio=new Arbitrios;
        $Arbitrio->id_pred_anio = $request['pred'];
        $Arbitrio->cod_cat = $request['cod'];
        $Arbitrio->anio = $request['an'];
        $Arbitrio->id_bar_cal = $request['barfrec'];
        $Arbitrio->frentera = $request['barfrent'];
        $Arbitrio->id_rrs = $request['rrsfrec'];
        $Arbitrio->id_seren = $request['seren'];
        $Arbitrio->id_par_jar = $request['parjar'];
        $Arbitrio->id_uso_arb = $request['usorrs'];
        $Arbitrio->id_contrib = $request['contrib'];
        $Arbitrio->ini_mes = $request['inimes'];
        $Arbitrio->id_pisos = $request['pis_uso'];
        $Arbitrio->area_const = $request['area'];
        $Arbitrio->fec_reg = date("d/m/Y");
        $Arbitrio->save();
        $cta= $this->cta_arb_create($Arbitrio->id_arb,$request['mesbar'],$request['mesrrs'],$request['messeren'],$request['mesparjar'],$request['inimes']);
        return $Arbitrio->id_arb."-".$cta;
    }
    public function cta_arb_create($id_abr,$mesbar,$mesrrs,$messeren,$mesparjar,$mes)
    {
        for($i=1;$i<=4;$i++)
        {
            $cta=new Cta_Arbitrios;
            switch($i)
            {
                case 1:
                    $val=$mesbar;
                    break;
                case 2:
                    $val=$mesrrs;
                    break;
                case 3:
                    $val=$messeren;
                    break;
                case 4:
                    $val=$mesparjar;
                    break;
            }
            $cta->id_arb=$id_abr;
            $cta->id_tpo_arb=$i;
            //enero
            if($mes>=2){$cta->pgo_ene=0;}
            else{$cta->pgo_ene=$val;}
            //febrero
            if($mes>=3){$cta->pgo_feb=0;}
            else{$cta->pgo_feb=$val;}
            //marzo
            if($mes>=4){$cta->pgo_mar=0;}
            else{$cta->pgo_mar=$val;}
            //abril
            if($mes>=5){$cta->pgo_abr=0;}
            else{$cta->pgo_abr=$val;}
            //mayo
            if($mes>=6){$cta->pgo_may=0;}
            else{$cta->pgo_may=$val;}
            //juni
            if($mes>=7){$cta->pgo_jun=0;}
            else{$cta->pgo_jun=$val;}
            //julio
            if($mes>=8){$cta->pgo_jul=0;}
            else{$cta->pgo_jul=$val;}
            //agosto
            if($mes>=9){$cta->pgo_ago=0;}
            else{$cta->pgo_ago=$val;}
            //septiembre
            if($mes>=10){$cta->pgo_sep=0;}
            else{$cta->pgo_sep=$val;}
            //octubre
            if($mes>=11){$cta->pgo_oct=0;}
            else{$cta->pgo_oct=$val;}
            //noviembre
            if($mes>=12){$cta->pgo_nov=0;}
            else{$cta->pgo_nov=$val;}
            $cta->pgo_dic=$val;
            $cta->save();
            $pago=$this->pgo_arb_create($cta->id_cta_arb);
        }
        return "hecho ".$pago;
    }
    public function pgo_arb_create($id_cta_arb)
    {
        $pago=new Pgo_Arbitrios();
        $pago->id_cta_arb=$id_cta_arb;
        $pago->save();
        return "pago tambien";
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id,Request $request)
    {
        if($request['new']=="1")
        {
            $arbitriovw=DB::table('adm_tri.vw_area_construida')->where('id_pred_anio',$id)->get();
            if(count($arbitriovw)==0)
            {
                $arbitriovw=0;
            }
        }
        else
        {
            $arbitriovw= DB::table('arbitrios.vw_arbitrios')->where('id_arb',$id)->where('anio',$request['an'])->get();
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
            $val->id_uso_arb = $request['usorrs'];
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

    public function destroy($id)
    {
        //
    }
    public function listarbitrios(Request $request)
    {
        
        header('Content-type: application/json');
        $totalg = DB::select("select count(id_arb) as total from arbitrios.vw_arbitrios where id_pred_anio=".$request["pre"]." and anio=".$request["an"]);
        $sql = DB::select("select * from arbitrios.vw_arbitrios where id_pred_anio=".$request["pre"]." and anio=".$request["an"]);
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
                trim($Datos->cod_piso),
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
