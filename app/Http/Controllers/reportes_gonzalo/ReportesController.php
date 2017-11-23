<?php

namespace App\Http\Controllers\reportes_gonzalo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ReportesController extends Controller
{

    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_rep_gonza' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        //$condicion = DB::table('adm_tri.exoneracion')->get();
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        $sectores =  DB::table('catastro.sectores')->orderBy('sector', 'asc')->where('id_sec', '>', 0)->get();
        $condicion = DB::select('select id_exo,desc_exon from adm_tri.exoneracion');
        return view('reportes_gonzalo/vw_reportes', compact('menu','permisos','anio_tra','sectores','condicion'));
    }

    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    
    public function reportes_contribuyentes($anio,$min,$max,$num_reg)
    {

        $sql=DB::table('reportes.vw_pricos')->where('ano_cta',$anio)->where('ivpp','>',$min)->where('ivpp','<',$max)->limit($num_reg)->orderBy('ivpp', 'desc')->get();

        if(count($sql)>0)
        {
            $view =  \View::make('reportes_gonzalo.reportes.reporte_contribuyentes', compact('sql','anio','min','max'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("Listado de Contribuyentes".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }
    
    public function reportes($anio,$sector,$manzana)
    {
        
        $sql=DB::table('adm_tri.vw_predi_usu')->where('anio',$anio)->where('id_sec',$sector)->where('id_mzna',$manzana)->orderBy('id_usu')->get();

        if(count($sql)>0)
        {
            $view =  \View::make('reportes_gonzalo.reportes.predios_prueba', compact('sql','anio'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("Predios por Usuario".".pdf");
        }
        else
        {   return 'No hay datos';}
    }
    
    public function listado_contribuyentes($anio,$sector){
        
        $sql=DB::table('adm_tri.vw_contrib_predios_c')->where('ano_cta',$anio)->where('id_sec',$sector)->get();
        

        if(count($sql)>0)
        {
            $view =  \View::make('reportes_gonzalo.reportes.listado_contribuyentes', compact('sql','anio','sector'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("Lista Datos de Contribuyente".".pdf");
        }
        else
        {   return 'No hay datos';}

    }
    
    public function listado_contribuyentes_predios($anio,$sector)
    {
        
        $sql=DB::table('reportes.vw_02_contri_predios')->where('anio',$anio)->where('id_sec',$sector)->orderBy('id_contrib')->get();

        if(count($sql)>0)
        {
            $view =  \View::make('reportes_gonzalo.reportes.listado_contribuyentes_predios', compact('sql','anio','sector'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream("Lista Contribuyentes y Predios".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }
    
    public function reporte_contribuyentes_exonerados($anio,$sector,$condicion)
    {
        $sql = DB::table('reportes.vw_contribuyentes_condicion')->where('anio',$anio)->where('id_sect',$sector)->where('id_cond_exonerac',$condicion)->get();
        
        if($sql)
        {
            $view = \View::make('reportes_gonzalo.reportes.reporte_contribuyentes_exonerados', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream("PRUEBA".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }
    
    public function reporte_cantidad_contribuyentes($anio,$sector)
    {
        $sql = DB::table('reportes.vw_contribuyentes_condicion')->where('anio',$anio)->where('id_sect',$sector)->where(function($sql) {
            $sql->where('id_cond_exonerac', 4)
                ->orWhere('id_cond_exonerac', 5);
        })->get();

        if(count($sql)>0)
        {
            $view =  \View::make('reportes_gonzalo.reportes.reporte_cantidad_contribuyente', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream("PRUEBA".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }
    
    //BUSQUEDA DE USUARIOS 
    public function get_usuarios(Request $request) 
    {
        if($request['dat']=='0')
        {
            return 0;
        }
        else
        {
        header('Content-type: application/json');
        $totalg = DB::select("select count(id) as total from public.usuarios where ape_nom like '%".$request['dat']."%'");
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

        $sql = DB::table('public.usuarios')->where('ape_nom','like', '%'.strtoupper($request['dat']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id),
                trim($Datos->dni),
                trim($Datos->ape_nom),
                trim($Datos->usuario)
            );
        }
        return response()->json($Lista);
        }
    }
    
    public function reporte_usuarios($id)
    {
        $sql=DB::table('adm_tri.vw_predi_usu')->where('id_usu',$id)->orderBy('id_usu')->get();

        if(count($sql)>0)
        {
            $view =  \View::make('reportes_gonzalo.reportes.reporte_get_usuarios', compact('sql'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream("PRUEBA".".pdf");
        }
        else
        {
            return 'NO HAY RESULTADOS';
        }
    }
    
    public function reporte_contribuyentes_predios_zonas($anio,$sector)
    {
        
        $sql=DB::table('reportes.vw_02_contri_predios')->where('anio',$anio)->where('id_sec',$sector)->orderBy('id_contrib')->get();

        if(count($sql)>0)
        {
            $view =  \View::make('reportes_gonzalo.reportes.reporte_contribuyentes_predios_zonas', compact('sql','anio','sector'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4','landscape');
            return $pdf->stream("Reporte Contribuyentes y Predios por Zonas".".pdf");
        }
        else
        {
            return 'No hay datos';
        }
    }
}
