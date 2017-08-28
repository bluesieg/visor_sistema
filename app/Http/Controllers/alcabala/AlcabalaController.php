<?php

namespace App\Http\Controllers\alcabala;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\alcabala\deducciones;
use Illuminate\Support\Facades\DB;
use App\Models\alcabala\tasas;
use App\Models\alcabala\Alcabala;
use App\Traits\DatesTranslator;
class AlcabalaController extends Controller
{
    use DatesTranslator;
    public function index()
    {
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        $contrato = DB::select('select * from alcabala.tipo_contrato order by id_tip_cto');
        $transferencia = DB::select('select * from alcabala.doc_transf order by id_doc_transf');
        $inafecto = DB::select('select * from alcabala.transferencias_inafectas order by id_trans_inaf');
        $UIT =DB::table('adm_tri.uit')->where('anio',date("Y"))->get()->first();
        $deduc =DB::table('alcabala.deducciones')->where('flg_act',1)->get()->first();
        $tasa =DB::table('alcabala.tasas')->where('flg_act',1    )->get()->first();
        return view('alcabala/vw_alcabala', compact('anio_tra','contrato','transferencia','UIT','deduc','tasa','inafecto'));
    }

    public function create(Request $request)
    {
        $alcabala= new Alcabala;
        $alcabala->id_pred=$request["pred"];
        $alcabala->id_adqui=$request["adqui"];
        $alcabala->adqui_rep_leg=$request["adqui_rl"];
        $alcabala->id_trans=$request["trans"];
        $alcabala->trans_rep_leg=$request["trans_rl"];
        $alcabala->fecha_reg=date("d/m/Y");
        $alcabala->id_doc_cont=$request["contra"];
        $alcabala->id_doc_tranf=$request["doctrans"];
        $alcabala->fec_doc_tranf=$request["fec_doc_tranf"];
        $alcabala->nom_notaria=$request["notaria"];
        $alcabala->id_dec=DB::table('alcabala.deducciones')->where('flg_act',1)->get()->first()->id_dec;
        $alcabala->id_tas=DB::table('alcabala.tasas')->where('flg_act',1    )->get()->first()->id_tas;
        $alcabala->base_impon_autoavaluo=$request["bimpo"];
        $alcabala->porcen_adqui=$request["poradq"];
        $alcabala->valor_transferencia=$request["vtrans"];
        $alcabala->tip_camb=$request["tip_camb"];
        $alcabala->base_impon_afecta=$request["bafecta"];
        $alcabala->id_trans_inafec=$request["inafec"];
        $alcabala->impuesto_tot=$request["imp_tot"];
        $alcabala->anio=date("Y");
        $alcabala->pk_uit=DB::table('adm_tri.uit')->where('anio',date("Y"))->get()->first()->pk_uit;

        
        $alcabala->save();
        return $alcabala->id_alcab;
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function mantenimiento()
    {
        return view('alcabala/vw_mantenimiento');
    }
    
    public function get_alcabala($an,Request $request)
    {
            header('Content-type: application/json');
            $page = $_GET['page'];
            $limit = $_GET['rows'];
            $sidx = $_GET['sidx'];
            $sord = $_GET['sord'];
            $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
            if ($start < 0) {
                $start = 0;
            }
            $totalg = DB::select('select count(id_alcab) as total from alcabala.alcabala where anio='.$an);
            $sql = DB::table('alcabala.alcabala')->where("anio",$an)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();

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
                $Lista->rows[$Index]['id'] = $Datos->id_alcab;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_alcab),
                    trim($Datos->nro_alcab),
                    trim($Datos->id_adqui),
                    trim($Datos->id_trans),
                    trim($Datos->id_pred),
                    trim($this->getCreatedAtAttribute($Datos->fecha_reg)->format('d/m/Y')),
                    '<button class="btn btn-labeled bg-color-blueDark txt-color-white" type="button" onclick="verop('.trim($Datos->id_alcab).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver Alcabala</button>',
                );
            }
            return response()->json($Lista);
    }
    /////////////////deducciones
    public function ded_create(Request $request)
    {
        $this->actualiza_deduccion();
        $dedu= new deducciones;
        $dedu->nro_uit=$request["uit"];
        $dedu->fec_ini=$request["ini"];
        $dedu->act_ley=$request["ley"];
        $dedu->flg_act=1;
        $dedu->save();
        return $dedu->id_dec;
    }
    public function actualiza_deduccion()
    {
        DB::select("Update alcabala.deducciones set flg_act=0, fec_fin='".date("d/m/Y")."' where flg_act=1");
    }
    public function get_deduc(Request $request)
    {
            header('Content-type: application/json');
            $page = $_GET['page'];
            $limit = $_GET['rows'];
            $sidx = $_GET['sidx'];
            $sord = $_GET['sord'];
            $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
            if ($start < 0) {
                $start = 0;
            }
            $totalg = DB::select("select count(id_dec) as total from alcabala.deducciones");
            $sql = DB::select("select * from alcabala.deducciones order by flg_act desc");
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
                $Lista->rows[$Index]['id'] = $Datos->id_dec;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_dec),
                    trim($Datos->nro_uit),
                    trim($Datos->fec_ini),
                    trim($Datos->fec_fin),
                    trim($Datos->act_ley),
                    trim($Datos->flg_act),
                );
            }
            return response()->json($Lista);
    }
    
    //////////////////////////////tasas
    public function tas_create(Request $request)
    {
        $this->actualiza_tasas();
        $tasa= new tasas;
        $tasa->por_tas=$request["por"];
        $tasa->fec_ini=$request["ini"];
        $tasa->act_ley=$request["ley"];
        $tasa->flg_act=1;
        $tasa->save();
        return $tasa->id_tas;
    }
    public function actualiza_tasas()
    {
        DB::select("Update alcabala.tasas set flg_act=0, fec_fin='".date("d/m/Y")."' where flg_act=1");
    }
    public function get_tasas(Request $request)
    {
            header('Content-type: application/json');
            $page = $_GET['page'];
            $limit = $_GET['rows'];
            $sidx = $_GET['sidx'];
            $sord = $_GET['sord'];
            $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
            if ($start < 0) {
                $start = 0;
            }
            $totalg = DB::select("select count(id_tas) as total from alcabala.tasas");
            $sql = DB::select("select * from alcabala.tasas order by flg_act desc");
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
                $Lista->rows[$Index]['id'] = $Datos->id_tas;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_tas),
                    trim($Datos->por_tas),
                    trim($Datos->fec_ini),
                    trim($Datos->fec_fin),
                    trim($Datos->act_ley),
                    trim($Datos->flg_act),
                );
            }
            return response()->json($Lista);
    }
}
