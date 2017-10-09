<?php

namespace App\Http\Controllers\reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Contribuyentes;
use App\Models\Personas;

class ReportesController extends Controller
{
    public function index()
    {
        $dpto = DB::table('maysa.dpto')->get();
        $condicion=DB::select('select * from adm_tri.exoneracion');
        $tip_doc=DB::select('select * from adm_tri.tipo_documento');
        $tip_contrib=DB::select('select * from adm_tri.tipo_contribuyente');
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        $sectores =  DB::table('catastro.sectores')->orderBy('sector', 'asc')->where('id_sec', '>', 0)->get();
        $condicion = DB::table('adm_tri.exoneracion')->get();
        $usos_predio_arb = DB::table('adm_tri.uso_predio_arbitrios')->get();
        //$sectores = DB::select('select * from catastro.sectores order by id_sec');
        $hab_urb = DB::select('select id_hab_urb,nomb_hab_urba from catastro.hab_urb');
        $manzanas = DB::select('select * from catastro.manzanas where id_sect=(select id_sec from catastro.sectores order by id_sec limit 1) ');
        return view('reportes.vw_reportes', compact('tip_contrib','tip_doc','condicion','dpto','sectores','manzanas','anio_tra','hab_urb','condicion','usos_predio_arb'));
    }

    function consultar_persona(Request $request){
        $nro_doc = $request['nro_doc'];        
        $contribuyente = DB::table('adm_tri.vw_personas')->where('pers_nro_doc',$nro_doc)->get();
//        dd($contribuyente[0]->contribuyente);
        if(isset($contribuyente[0]->contribuyente)){
            return response()->json([
                    'contrib' => trim(str_replace('-','',$contribuyente[0]->contribuyente)),
                    'id_pers' => trim(str_replace('-','',$contribuyente[0]->id_pers)),
            ]);
        }
        
    }


    public function reporte_contribuyentes($sec,$mzna,$anio){
        //$sql = DB::select("select adm_tri.calcular_ivpp($an,$contri)");
        //dd($sec);
        //$anio = '2017';
        $flag = 1;
        if($mzna == '0')
        {

            $sql=DB::table('adm_tri.vw_contrib_predios_c')->where('id_sec',$sec)->where('ano_cta',$anio)->get();
            $view =  \View::make('adm_tributaria.reportes.reporte_contribuyentes', compact('sql','anio','sec','mzna','flag'))->render();
        }
        else{

            $sql=DB::table('adm_tri.vw_contrib_predios_c')->where('id_sec',$sec)->where('id_mzna',$mzna)->where('ano_cta',$anio)->get();
            $view =  \View::make('adm_tributaria.reportes.reporte_contribuyentes', compact('sql','anio','sec','mzna','flag'))->render();
        }

        if(count($sql)>=1)
        {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream($sec."_".$mzna.".pdf");
        }
        else
        {   return 'No hay datos';}

    }
    public function reporte_contribuyentes_hab_urb($cod_hab_urb,$anio){
        //$sql = DB::select("select adm_tri.calcular_ivpp($an,$contri)");
        //dd($cod_hab_urb);
        //$anio = '2017';
        $sec='0';
        $mzna = '0';
        $flag = 2;

        $sql=DB::table('adm_tri.vw_contrib_hab_urb')->where('id_hab_urb',$cod_hab_urb)->where('anio',$anio)->get();
        //dd(count($sql));
        //$sql_pre=DB::table('adm_tri.vw_predi_urba')->where('id_contrib',$contri)->where('anio',$an)->get();


        if(count($sql)>0)
        {
            $view =  \View::make('adm_tributaria.reportes.reporte_contribuyentes', compact('sql','anio','sec','mzna','flag'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream($sec."_".$mzna.".pdf");
        }
        else
        {   return 'No hay datos';}

    }

    function reporte_contribuyentes_otro($sec,$mzna,$anio){

        if($mzna == '0'){
            $sql=DB::table('reportes.vw_02_contri_predios')->where('id_sec',$sec)->where('anio',$anio)->orderBy('id_contrib')->orderBy('nro_doc_conyugue')->get();
            //$sql=DB::table('adm_tri.vw_contrib_predios_c')->where('id_sec',$sec)->where('ano_cta',$anio)->get();
            $view =  \View::make('adm_tributaria.reportes.123_123', compact('sql','anio','sec','mzna'))->render();
        }
        else{
            $sql=DB::table('reportes.vw_02_contri_predios')->where('id_sec',$sec)->where('id_mzna',$mzna)->where('anio',$anio)->orderBy('id_contrib')->orderBy('nro_doc_conyugue')->get();
            $view =  \View::make('adm_tributaria.reportes.123_123', compact('sql','anio','sec','mzna'))->render();
        }

        if(count($sql)>0)
        {
            //$view =  \View::make('adm_tributaria.reportes.123_123',compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream("PRUEBA".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }

    function reporte_prin_contribuyentes($anio,$min,$max,$num_reg){

        $sql=DB::table('reportes.vw_pricos')->where('ano_cta',$anio)->where('ivpp','>',$min)->where('ivpp','<',$max)->limit($num_reg)->orderBy('ivpp', 'desc')->get();

        if(count($sql)>0)
        {
            $view =  \View::make('reportes.contribuyentes0', compact('sql','anio','min','max'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream("PRUEBA".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }


    function reporte_contribuyentes_pred_hu($cod_hab_urb,$anio){

            $sql=DB::table('reportes.vw_02_contri_predios')->where('id_hab_urb',$cod_hab_urb)->where('anio',$anio)->orderBy('id_contrib')->orderBy('nro_doc_conyugue')->get();
            $view =  \View::make('adm_tributaria.reportes.123_123', compact('sql','anio','sec','mzna'))->render();

        if(count($sql)>0)
        {
            //$view =  \View::make('adm_tributaria.reportes.123_123',compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream("PRUEBA".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }

    public function contribuyentes_r4($anio){

        $sql=DB::table('reportes.vw_predio_contrib_x_hu')->where('codi_hab_urba', '!=', '0000')->where('anio',$anio)->get();

        if(count($sql)>0)
        {
            $view =  \View::make('reportes.contribuyentes4', compact('sql','anio'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("R4_".$anio.".pdf");
        }
        else
        {   return 'No hay datos';}

    }

    public function reporte_por_condicion($anio,$sector,$condicion){

        //$sql=DB::table('reportes.vw_pricos')->where('ano_cta',$anio)->where('ivpp','>',$min)->where('ivpp','<',$max)->limit($num_reg)->get();
        if($sector == 0){
            $sql = DB::table('reportes.vw_contribuyentes_condicion')->where('anio',$anio)->where('id_cond_exonerac',$condicion)->get();
        }
        else{
            $sql = DB::table('reportes.vw_contribuyentes_condicion')->where('anio',$anio)->where('id_sect',$sector)->where('id_cond_exonerac',$condicion)->get();
        }

        if(count($sql)>0)
        {
            $view =  \View::make('reportes.contribuyentes_condicion', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream("PRUEBA".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }

    public function reporte_num_pred_uso($anio,$sector,$uso){

        if($sector != 0 && $uso != 0){
            $sql = DB::table('reportes.vw_num_predios_uso')->where('anio',$anio)->where('id_sec',$sector)->where('id_uso_arb',$uso)->get();
            //$sql = DB::table('reportes.vw_num_predios_uso')->get();
        }
        elseif($sector == 0 && $uso != 0){
            $sql = DB::table('reportes.vw_num_predios_uso')->where('anio',$anio)->where('id_uso_arb',$uso)->get();//->where('anio',$anio)->where('id_sect',$sector)->where('id_cond_exonerac',$condicion)->limit(100)->get();

        }elseif($sector != 0 && $uso == 0){
            $sql = DB::table('reportes.vw_num_predios_uso')->where('anio',$anio)->where('id_sec',$sector)->get();
        }else{
            $sql = DB::table('reportes.vw_num_predios_uso')->where('anio',$anio)->get();
        }

        if(count($sql)>0)
        {
            $view =  \View::make('reportes.num_pred_uso', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("PRUEBA".".pdf");
        }
        else
        {
            return 'No hay datos';
        }

    }

    public function reporte_adult_pensio($anio,$sector){

        if($sector == 0){
            $sql = DB::table('reportes.vw_contribuyentes_condicion')->where('anio',$anio)->where(function($sql) {
                $sql->where('id_cond_exonerac', 4)
                    ->orWhere('id_cond_exonerac', 5);
            })->get();
        }
        else{
            $sql = DB::table('reportes.vw_contribuyentes_condicion')->where('anio',$anio)->where('id_sect',$sector)->where(function($sql) {
                $sql->where('id_cond_exonerac', 4)
                    ->orWhere('id_cond_exonerac', 5);
            })->get();
        }

        if(count($sql)>0)
        {
            $view =  \View::make('reportes.contr_adulto_pensionista', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream("PRUEBA".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }

}
