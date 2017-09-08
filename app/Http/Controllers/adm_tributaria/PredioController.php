<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Predios;


class PredioController extends Controller
{
    public function index()
    {
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        $sectores = DB::select('select * from catastro.sectores order by sector');
        $manzanas = DB::select('select * from catastro.manzanas where id_sect=(select id_sec from catastro.sectores order by sector limit 1) ');
        $condicion = DB::select('select * from adm_tri.cond_prop order by id_cond ');
        $ecc = DB::select('select * from adm_tri.ecc order by id_ecc ');
        $tpre = DB::select('select * from adm_tri.tip_predio order by id_tip_p ');
        $fadq = DB::select('select * from adm_tri.form_adq order by id_for ');
        $pisclasi = DB::select('select * from adm_tri.clas_predio where id_cla_pre>0 order by id_cla_pre');
        $pismat = DB::select('select * from adm_tri.mep order by id_mep');
        $pisecs = DB::select('select * from adm_tri.ecs order by id_ecs');
        $condi_pen = DB::select('select * from adm_tri.condi_pensionista order by id_con');
        return view('adm_tributaria/vw_predio', compact('anio_tra','sectores','manzanas','condicion','ecc','tpre','fadq','pisclasi','pismat','pisecs','condi_pen'));
    }
    public function create(Request $request)
    {
        $predio=new Predios;
        $predio->id_cond_prop = $request['condpre'];
        $predio->nro_condominios = $request['condos'];
        $predio->id_via = $request['cvia'];
        $predio->nro_mun = $request['n'];
        $predio->mzna_dist = $request['mz'];
        $predio->lote_dist = $request['lt'];
        $predio->zona = $request['zn'];
        $predio->secc = $request['secc'];
        $predio->piso = $request['piso'];
        $predio->dpto = $request['dpto'];
        $predio->nro_int = $request['int'];
        $predio->referencia = $request['ref'];
        $predio->id_contrib = $request['contrib'];
        $predio->id_exon = 1;
        $predio->id_cond_esp_exon = 1;
        $predio->id_hab_urb = 2;
        $predio->mzna = $request['mzna'];
        $predio->id_mzna_cat = $request['id_mzna'];
        $predio->sec = $request['sec'];
        $predio->lote = $request['lote'];
        $predio->anio = $request['an'];
        $predio->cod_cat = $request['sec'].$request['mzna'].$request['lote'];
        $predio->id_est_const = $request['ecc'];
        $predio->id_tip_pred = $request['tpre'];
        $predio->id_uso_predio = $request['tipuso'];
        $predio->id_form_adq = $request['ifor'];
        $predio->fech_adquis = $request['ffor'];
        $predio->luz_nro_sum = $request['luz'];
        $predio->agua_nro_sum = $request['agua'];
        $predio->licen_const = $request['liccon'];
        $predio->conform_obra = $request['confobr'];
        $predio->declar_fabrica = $request['defra'];
        $predio->are_terr = $request['areterr'];
        $predio->are_com_terr = $request['arecomter'];
        $predio->arancel = $request['aranc'];
        $predio->val_ter = ($request['areterr']+$request['arecomter'])*$request['aranc'];
        $predio->tip_pre_u_r = 1;
        $predio->save();
        DB::select("select adm_tri.calcular_ivpp($predio->anio,$predio->id_contrib)");
        DB::select("select adm_tri.actualiza_base_predio(".$request['id_pre'].")");
        return $predio->id_pred;
    }
    public function store(Request $request)
    {
        echo "store";
    }
    public function show($id)
    {
        $prediovw= DB::table('adm_tri.vw_predi_urba')->where('id_pred',$id)->get();
        $predio= DB::table('adm_tri.predios')->leftJoin('catastro.usos_predio', 'predios.id_uso_predio', '=', 'usos_predio.id_uso')->where('predios.id_pred',$id)->get();
        $prediovw[0]->id_uso_predio=$predio[0]->id_uso_predio;
        $prediovw[0]->codi_uso=$predio[0]->codi_uso;
        $prediovw[0]->desc_uso=$predio[0]->desc_uso;
        $prediovw[0]->id_uso_pred_arbitrio=$predio[0]->id_uso_pred_arbitrio;
        $prediovw[0]->fech_adquis=date("d/m/Y",strtotime(str_replace("/", "-", $predio[0]->fech_adquis)));
        $prediovw[0]->luz_nro_sum=$predio[0]->luz_nro_sum;
        $prediovw[0]->agua_nro_sum=$predio[0]->agua_nro_sum;
        $prediovw[0]->licen_const=$predio[0]->licen_const;
        $prediovw[0]->conform_obra=$predio[0]->conform_obra;
        $prediovw[0]->declar_fabrica=$predio[0]->declar_fabrica;
        return $prediovw;
    }
    public function edit(Request $request,$id)
    {
        $predio=new Predios;
        $val=  $predio::where("id_pred","=",$id )->first();
        if(count($val)>=1)
        {
            $val->id_cond_prop = $request['condpre'];
            $val->nro_condominios = $request['condos'];
            $val->id_via = $request['cvia'];
            $val->nro_mun = $request['n'];
            $val->mzna_dist = $request['mz'];
            $val->lote_dist = $request['lt'];
            $val->zona = $request['zn'];
            $val->secc = $request['secc'];
            $val->piso = $request['piso'];
            $val->dpto = $request['dpto'];
            $val->nro_int = $request['int'];
            $val->referencia = $request['ref'];
            $val->id_est_const = $request['ecc'];
            $val->id_tip_pred = $request['tpre'];
            $val->id_uso_predio = $request['tipuso'];
            $val->id_form_adq = $request['ifor'];
            $val->fech_adquis = $request['ffor'];
            $val->luz_nro_sum = $request['luz'];
            $val->agua_nro_sum = $request['agua'];
            $val->licen_const = $request['liccon'];
            $val->conform_obra = $request['confobr'];
            $val->declar_fabrica = $request['defra'];
            $val->are_terr = $request['areterr'];
            $val->are_com_terr = $request['arecomter'];
            $val->arancel = $request['aranc'];
            $val->val_ter = ($request['areterr']+$request['arecomter'])*$request['aranc'];
            $val->save();
        }
        DB::select("select adm_tri.calcular_ivpp($val->anio,$val->id_contrib)");
        DB::select("select adm_tri.actualiza_base_predio(".$request['id_pre'].")");
        return "edit".$id;
    }
    public function update(Request $request, $id)
    {
        return "update";
    }
    public function destroy(Request $request)
    {
        $predio=new Predios;
        $val=  $predio::where("id_pred","=",$request['id'] )->first();
        if(count($val)>=1)
        {
            $val->delete();
        }
        DB::select("select adm_tri.actualiza_base_predio(".$request['id_pre'].")");
        return "destroy ".$request['id'];
    }
    public function ListManz(Request $request)
    {
        $manzanas = DB::table('catastro.manzanas')->where('id_sect',$request['sec'])->orderBy('codi_mzna')->get();
        $todo=array();
        foreach($manzanas as $Datos){      
            $Lista=new \stdClass();
            $Lista->id_mzna      =  trim($Datos->id_mzna);
            $Lista->codi_mzna         =  trim($Datos->codi_mzna);
            array_push($todo, $Lista);
        }        
        return response()->json($todo);
    }
    public function listpredio(Request $request)
    {
        header('Content-type: application/json');
        if($request['mnza']=='0')
        {
            if($request['tpre']=='0')
            {
                $totalg = DB::select("select count(id_pred) as total from adm_tri.vw_predi_urba where id_contrib='".$request['ctr']."' and anio='".$request['an']."'");
                $sql = DB::select("select id_pred,tp,sec,mzna,lote,cod_cat,mzna_dist,lote_dist,nro_mun,descripcion,contribuyente,nom_via,id_via,are_terr,val_ter,val_const from adm_tri.vw_predi_urba where id_contrib='".$request['ctr']."' and anio='".$request['an']."'");
            }
            else
            {
                if($request['ctr']=='0')
                {
                    $totalg = DB::select("select count(id_pred) as total from adm_tri.vw_predi_urba where tip_pre_u_r=".$request['tpre']." and anio='".$request['an']."'");
                    $sql = DB::select("select id_pred,tp,sec,mzna,lote,cod_cat,mzna_dist,lote_dist,nro_mun,descripcion,contribuyente,nom_via,id_via,are_terr,val_ter,val_const from adm_tri.vw_predi_urba where tip_pre_u_r=".$request['tpre']." and anio='".$request['an']."'");
                }
                else
                {
                    $totalg = DB::select("select count(id_pred) as total from adm_tri.vw_predi_urba where tip_pre_u_r=".$request['tpre']." and id_contrib='".$request['ctr']."' and anio='".$request['an']."'");
                    $sql = DB::select("select id_pred,tp,sec,mzna,lote,cod_cat,mzna_dist,lote_dist,nro_mun,descripcion,contribuyente,nom_via,id_via,are_terr,val_ter,val_const from adm_tri.vw_predi_urba where tip_pre_u_r=".$request['tpre']." and id_contrib='".$request['ctr']."' and anio='".$request['an']."'");
                }
            }
        }
        else
        {
            $totalg = DB::select("select count(id_pred) as total from adm_tri.vw_predi_urba where tip_pre_u_r=".$request['tpre']." and id_mzna='".$request['mnza']."' and anio='".$request['an']."'");
            $sql = DB::select("select id_pred,tp,sec,mzna,lote,cod_cat,mzna_dist,lote_dist,nro_mun,descripcion,contribuyente,nom_via,id_via,are_terr,val_ter,val_const from adm_tri.vw_predi_urba where tip_pre_u_r=".$request['tpre']." and id_mzna='".$request['mnza']."' and anio='".$request['an']."'");
        }
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
            $Lista->rows[$Index]['id'] = $Datos->id_pred;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_pred),
                trim($Datos->tp),
                trim($Datos->sec),
                trim($Datos->mzna),
                trim($Datos->lote),
                trim($Datos->cod_cat),
                trim($Datos->mzna_dist), 
                trim($Datos->lote_dist),
                trim($Datos->nro_mun),
                trim($Datos->descripcion),
                trim($Datos->contribuyente),               
                trim($Datos->nom_via),               
                trim($Datos->id_via),               
                trim($Datos->are_terr),               
                trim($Datos->val_ter),               
                trim($Datos->val_const),               
                            
            );
        }
        return response()->json($Lista);
    }
    public function imprimir_formatos()
    {
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('adm_tributaria/imp_formatos', compact('anio_tra'));
    }

    public function reporte($tip,$id,$an,$contri) 
    {
        
        if($tip=='HR'||$tip=='hr')
        {
            $sql = DB::select("select adm_tri.calcular_ivpp($an,$contri)");
            $sql=DB::table('adm_tri.vw_contrib_hr2')->where('id_contrib',$contri)->where('ano_cta',$an)->get()->first();
            $sql_pre=DB::table('adm_tri.vw_predi_urba')->where('id_contrib',$contri)->where('anio',$an)->get();
            $view =  \View::make('adm_tributaria.reportes.hr', compact('sql','sql_pre'))->render();
        }
        if($tip=='PU'||$tip=='pu')
        {
            $sql=DB::table('adm_tri.vw_pred_pu')->where('id_pred',$id)->where('anio',$an)->get()->first();
            $sql_pis    =DB::table('adm_tri.vw_pisos')->where('id_predio',$id)->orderBy('num_pis')->get();
            $sql_ist    =DB::table('adm_tri.vw_instalaciones')->where('id_pre',$id)->orderBy('cod_instal')->get();
            $sql_cond    =DB::table('adm_tri.vw_condominios')->where('id_pred',$id)->orderBy('id_condom')->get();
            $foto = DB::connection('fotos')->select("select encode(foto,'base64') as foto from sect_".$sql->sec." where id_lote='".$sql->sec.$sql->mzna.$sql->lote."' limit 1");
            $view =  \View::make('adm_tributaria.reportes.pu', compact('sql','sql_pis','sql_ist','sql_cond','foto'))->render();
        }
        if($tip=='PR'||$tip=='pr')
        {
            $sql=DB::table('adm_tri.vw_predios_rusticos')->where('id_pred',$id)->where('anio',$an)->get()->first();
            $predio= DB::table('adm_tri.predios')->where('id_pred',$id)->get()->first();
            $sql_pis    =DB::table('adm_tri.vw_pisos')->where('id_predio',$id)->orderBy('num_pis')->get();
            $sql_ist    =DB::table('adm_tri.vw_instalaciones')->where('id_pre',$id)->orderBy('cod_instal')->get();
            $sql_cond    =DB::table('adm_tri.vw_condominios')->where('id_pred',$id)->orderBy('id_condom')->get();
            $view =  \View::make('adm_tributaria.reportes.pr', compact('sql','predio','sql_pis','sql_ist','sql_cond'))->render();
        }
        if(count($sql)>=1)
        {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream($tip.$an.".pdf");
        }
        else
        {   return 'No hay datos';}
    }
}