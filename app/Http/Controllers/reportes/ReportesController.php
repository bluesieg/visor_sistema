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
        $sectores =  DB::table('catastro.sectores') ->orderBy('sector', 'asc')->where('id_sec', '>', 0)->get();
        //$sectores = DB::select('select * from catastro.sectores order by id_sec');
        $hab_urb = DB::select('select id_hab_urb,nomb_hab_urba from catastro.hab_urb');
        $manzanas = DB::select('select * from catastro.manzanas where id_sect=(select id_sec from catastro.sectores order by id_sec limit 1) ');
        return view('reportes.vw_reportes', compact('tip_contrib','tip_doc','condicion','dpto','sectores','manzanas','anio_tra','hab_urb'));
    }

    public function create(Request $request)
    {            
        $data = new Contribuyentes();
//        $data->tipo_doc=$request['tipo_doc'];
        $data->tipo_persona=$request['tipo_persona'];
//        $data->nro_doc=$request['nro_doc'];
        $data->tlfno_fijo=$request['tlfno_fijo']; 
        $data->tlfono_celular=$request['tlfono_celular']; 
        $data->email=$request['email'];
        $data->est_civil=$request['est_civil'];            
        $data->id_dpto=$request['id_dpto'];
        $data->id_prov=$request['id_prov']; 
        $data->id_dist=$request['id_dist'];            
        $data->nro_mun=$request['nro_mun'];
        $data->dpto=$request['dpto'];
        $data->manz=$request['manz'];
        $data->lote=$request['lote'];
        $data->id_cond_exonerac=$request['id_cond_exonerac']; 
        $data->id_via=$request['id_via'];        
        $data->id_pers=$request['id_pers']; 
        $data->id_conv=$request['id_conv'];
        $data->ref_dom_fis= strtoupper($request['ref_dom_fis']);
        $id_persona = $request['tipo_persona'].$request['tipo_doc'].$request['nro_doc'];
        $data->id_persona=$id_persona;
        $data->activo=1;
        $data->fch_inscripcion=date('Y-m-d');        
        $data->save();        
        return $data->id_contrib;
      
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $contrib = new Contribuyentes();
        
        $val = $contrib::where("id_contrib", "=", $id)->first();
        if (count($val) >= 1) {
            $val->tipo_persona=$request['tipo_persona'];
            $val->tlfno_fijo=$request['tlfno_fijo']; 
            $val->tlfono_celular=$request['tlfono_celular']; 
            $val->email=$request['email'];
            $val->est_civil=$request['est_civil'];            
            $val->id_dpto=$request['id_dpto'];
            $val->id_prov=$request['id_prov']; 
            $val->id_dist=$request['id_dist'];            
            $val->nro_mun=$request['nro_mun'];
            $val->dpto=$request['dpto'];
            $val->manz=$request['manz'];
            $val->lote=$request['lote'];
            $val->id_cond_exonerac=$request['id_cond_exonerac']; 
            $val->id_via=$request['id_via'];        
            $val->id_pers=$request['id_pers']; 
            $val->id_conv=$request['id_conv'];
            $val->ref_dom_fis= strtoupper($request['ref_dom_fis']);
            $id_persona = $request['tipo_persona'].$request['tipo_doc'].$request['nro_doc'];
            $val->id_persona=$id_persona;                    
            $val->save();  
            return $val->id_contrib;
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
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
        $sql=DB::table('adm_tri.vw_contrib_predios_c')->where('sec',$sec)->where('mzna',$mzna)->where('ano_cta',$anio)->get();
        //$sql_pre=DB::table('adm_tri.vw_predi_urba')->where('id_contrib',$contri)->where('anio',$an)->get();
        $view =  \View::make('adm_tributaria.reportes.reporte_contribuyentes', compact('sql','anio','sec','mzna','flag'))->render();

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

        /*
        $flag = 2;
        $sql=DB::table('adm_tri.vw_contrib_hab_urb')->where('id_hab_urb',$cod_hab_urb)->get();
        $view =  \View::make('adm_tributaria.reportes.reporte_contribuyentes', compact('sql','flag'))->render();

        if(count($sql)>=1)
        {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream($cod_hab_urb.".pdf");
        }
        else
        {   return 'No hay datos';}*/

    }

    function reporte_contribuyentes_otro(){

        $sql=DB::table('reportes.vw_02_contri_predios')->orderBy('id_contrib')->orderBy('nro_doc_conyugue')->get();

        if(count($sql)>0)
        {
            $view =  \View::make('adm_tributaria.reportes.123_123',compact('sql'))->render();
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
