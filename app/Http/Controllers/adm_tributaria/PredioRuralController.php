<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Predios;

class PredioRuralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        $condicion = DB::select('select * from adm_tri.cond_prop order by id_cond ');
        $tipoterr = DB::select('select * from ADM_TRI.TIPO_PREDIO_RUSTICO  order by id_tip_pre_rus');
        $usoterr = DB::select('select * from catastro.usos_pr_rustico   order by id_uso_pr');
        $gpoterr = DB::select('select * from adm_tri.gpo_tierras where id_gpo>1 order by id_gpo');
        $ecc = DB::select('select * from adm_tri.ecc order by id_ecc ');
        $tpre = DB::select('select * from adm_tri.tip_predio order by id_tip_p ');
        $upa = DB::select('select * from adm_tri.uso_predio_arbitrios order by id_uso_arb ');
        $fadq = DB::select('select * from adm_tri.form_adq order by id_for ');
        $pisclasi = DB::select('select * from adm_tri.clas_predio where id_cla_pre>0 order by id_cla_pre');
        $pismat = DB::select('select * from adm_tri.mep order by id_mep');
        $pisecs = DB::select('select * from adm_tri.ecs order by id_ecs');
        $condi_pen = DB::select('select * from adm_tri.condi_pensionista order by id_con');
        return view('adm_tributaria/vw_predio_ru', compact('anio_tra','condicion','tipoterr','usoterr','gpoterr','ecc','tpre','upa','fadq','pisclasi','pismat','pisecs','condi_pen'));
   
    }

    public function create(Request $request)
    {
        $predio=new Predios;
        $predio->id_cond_prop = $request['condpre'];
        $predio->nro_condominios = $request['condos'];
        $predio->id_contrib = $request['contrib'];
        $predio->id_exon = 1;
        $predio->id_cond_esp_exon = 1;
        $predio->id_hab_urb = 2;
        $predio->anio = $request['an'];
        $predio->id_est_const = $request['ecc'];
        $predio->id_tip_pred = $request['tpre'];
        $predio->id_uso_pred_arbitrio = $request['uprearb'];
        $predio->id_form_adq = $request['ifor'];
        $predio->fech_adquis = $request['ffor'];
        $predio->are_terr = $request['areterr'];
        $predio->arancel = $request['aranc'];
        $predio->val_ter = ($request['areterr']+$request['arecomter'])*$request['aranc'];
        $predio->tip_pre_u_r = 2;
        $predio->lugar_pr_rust = $request['valle'];
        $predio->ubicac_pr_rus  = $request['carretera'];
        $predio->klm  = $request['km'];
        $predio->nom_pre_pr_rus   = $request['nompre'];
        $predio->norte   = $request['norte'];
        $predio->sur   = $request['sur'];
        $predio->este   = $request['este'];
        $predio->oeste   = $request['oeste'];
        $predio->id_tip_pre_rus = $request['tterr'];
        $predio->id_uso_pre_rust = $request['uterr'];
        $predio->id_via = 2;
        $predio->id_uso_predio = 1;
        $predio->val_ter = $request['areterr']*$request['aranc'];
        $predio->id_gpo_tierra=$request['gpt'];
        $predio->id_cat_gpo_tierra=$request['cgpt'];
        $predio->save();
        return $predio->id_pred;
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

    public function show($id)
    {
        $prediovw= DB::table('adm_tri.vw_predi_urba')->where('id_pred',$id)->get();
        $predio= DB::table('adm_tri.predios')->where('predios.id_pred',$id)->get();
        $prediovw[0]->lugar_pr_rust=$predio[0]->lugar_pr_rust;
        $prediovw[0]->ubicac_pr_rus=$predio[0]->ubicac_pr_rus;
        $prediovw[0]->klm=$predio[0]->klm;
        $prediovw[0]->nom_pre_pr_rus=$predio[0]->nom_pre_pr_rus;
        $prediovw[0]->norte=$predio[0]->norte;
        $prediovw[0]->sur=$predio[0]->sur;
        $prediovw[0]->este=$predio[0]->este;
        $prediovw[0]->oeste=$predio[0]->oeste;
        $prediovw[0]->id_tip_pre_rus=$predio[0]->id_tip_pre_rus;
        $prediovw[0]->id_uso_pre_rust=$predio[0]->id_uso_pre_rust;
        $prediovw[0]->id_uso_pred_arbitrio=$predio[0]->id_uso_pred_arbitrio;
        $prediovw[0]->id_gpo_tierra=$predio[0]->id_gpo_tierra;
        $prediovw[0]->id_cat_gpo_tierra=$predio[0]->id_cat_gpo_tierra;
        $prediovw[0]->fech_adquis=date("d/m/Y",strtotime(str_replace("/", "-", $predio[0]->fech_adquis)));
       
        return $prediovw;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $predio=new Predios;
        $val=  $predio::where("id_pred","=",$id )->first();
        if(count($val)>=1)
        {
            $val->id_cond_prop = $request['condpre'];
            $val->nro_condominios = $request['condos'];
            $val->id_est_const = $request['ecc'];
            $val->id_tip_pred = $request['tpre'];
            $val->id_uso_pred_arbitrio = $request['uprearb'];
            $val->id_form_adq = $request['ifor'];
            $val->fech_adquis = $request['ffor'];
            $val->are_terr = $request['areterr'];
            $val->arancel = $request['aranc'];
            $val->val_ter = $request['areterr']*$request['aranc'];
            $val->lugar_pr_rust = $request['valle'];
            $val->ubicac_pr_rus  = $request['carretera'];
            $val->klm  = $request['km'];
            $val->nom_pre_pr_rus   = $request['nompre'];
            $val->norte   = $request['norte'];
            $val->sur   = $request['sur'];
            $val->este   = $request['este'];
            $val->oeste   = $request['oeste'];
            $val->id_tip_pre_rus = $request['tterr'];
            $val->id_uso_pre_rust = $request['uterr'];
            $val->id_gpo_tierra=$request['gpt'];
            $val->id_cat_gpo_tierra=$request['cgpt'];
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
}
