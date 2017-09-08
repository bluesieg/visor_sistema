<?php

namespace App\Http\Controllers\recaudacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\orden_pago_master;
use App\Traits\DatesTranslator;

class OrdenPagoController extends Controller
{
    use DatesTranslator;
    public function index()
    {
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        $sectores = DB::select('select * from catastro.sectores order by sector');
        $manzanas = DB::select('select * from catastro.manzanas where id_sect=(select id_sec from catastro.sectores order by sector limit 1) ');
        return view('recaudacion/vw_orden_pago',compact('anio_tra','sectores','manzanas'));
    }
    public function create(Request $request)
    {
        if($request['tip']=='1'||$request['tip']=='3')
        {
            return $this->create_by_user($request['per']);
        }
        if($request['tip']=='4')
        {
            $sql = DB::select("select id_contrib from adm_tri.vw_predi_urba where sec='".$request['sec']."' and mzna='".$request['man']."' group by id_contrib order by id_contrib");
            $orden=0;
            foreach ($sql as $contri)
            {
                $valor=$this->create_by_user($contri->id_contrib);
                if($orden==0)
                {
                    $orden=$valor;
                }
            }
            return $orden."-".$valor;
        }
    }
    public function create_by_user($per)
    {
        $ivpp= DB::table('adm_tri.base_ivpp_op')->where('ano_cta',date("Y"))->where('id_pers',$per)->get()->first();
        $fisca= new orden_pago_master;
        $fisca->anio=date("Y");
        $fisca->fec_reg=date("d/m/Y");
        $fisca->id_per=$per;
        $fisca->ivpp_afecto=$ivpp->ivpp_afecto;
        $fisca->ivpp=$ivpp->ivpp;
        $fisca->save();
        return $fisca->id_gen_fis;
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
    public function getOP($dat,$sec,$manz,$an,$ini,$fin,Request $request)
    {
        if($dat==0&&$sec==0&&$manz==0&&$ini==0&&$fin==0)
        {
            return 0;
        }
        else
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
            if($sec==0)
            {
                if($dat==0)
                {
                    $totalg = DB::select("select count(id_gen_fis) as total from recaudacion.vw_genera_fisca where fec_reg between '".$ini."' and '".$fin."'");
                    $sql = DB::table('recaudacion.vw_genera_fisca')->wherebetween('fec_reg',[$ini,$fin])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                }
                else
                {
                    $totalg = DB::select('select count(id_gen_fis) as total from recaudacion.vw_genera_fisca where id_per='.$dat);
                    $sql = DB::table('recaudacion.vw_genera_fisca')->where('id_per',$dat)->where("anio",$an)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                }
            }
            else
            {
                $totalg = DB::select("select count(id_gen_fis) as total from recaudacion.vw_genera_fisca where id_per in (select id_contrib from adm_tri.predios where sec='".$sec."' and mzna='".$manz."' order by 1 asc)");
                $sql = DB::select("select * from recaudacion.vw_genera_fisca where id_per in (select id_contrib from adm_tri.predios where sec='".$sec."' and mzna='".$manz."' order by 1 asc) order by $sidx $sord limit $limit offset $start");
            }

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
                $Lista->rows[$Index]['id'] = $Datos->id_gen_fis;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_gen_fis),
                    trim($Datos->nro_fis),
                    trim($Datos->fec_reg),
                    trim($Datos->anio),
                    trim($Datos->nro_doc),
                    trim($Datos->contribuyente),
                    '<button class="btn btn-labeled bg-color-blueDark txt-color-white" type="button" onclick="verop('.trim($Datos->id_gen_fis).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver OP</button>',
                );
            }
            return response()->json($Lista);
        }
    }
    public function getcontrbsec(Request $request)
    {
        if($request['sec']=='0'&&$request['man']=='0')
        {
            return 0;
        }
        else
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
            
            $totalg = DB::select("select count(id_contrib) as total from adm_tri.vw_predi_urba where sec='".$request['sec']."' and mzna='".$request['man']."' group by id_contrib order by id_contrib");
            $sql = DB::select("select id_contrib,nro_doc, contribuyente from adm_tri.vw_predi_urba where sec='".$request['sec']."' and mzna='".$request['man']."' group by id_contrib,nro_doc, contribuyente order by id_contrib");
            
            

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
                $Lista->rows[$Index]['id'] = $Datos->id_contrib;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_contrib),
                    trim($Datos->nro_doc),
                    trim($Datos->contribuyente),
                    '<button type="button" class="btn btn-labeled bg-color-greenDark txt-color-white" onclick="generar_op(3,'.$Datos->id_contrib.')">
                    <span class="btn-label"><i class="fa fa-file-text-o"></i></span>Generar Nueva OP
                    </button>',
                );
            }
            return response()->json($Lista);
        }
    }
    
    public function reporte($tip,$id,$sec,$man) 
    {
        if($tip=='1'||$tip=='3')
        {
            $sql    =DB::table('recaudacion.vw_op_detalle')->where('id_gen_fis',$id)->get()->first();
            if(count($sql)>=1)
            {
                $sql->fec_reg=$this->getCreatedAtAttribute($sql->fec_reg)->format('l d, F Y ');
                $UIT =DB::table('adm_tri.uit')->where('anio',$sql->anio)->get()->first();
            }
            $view =  \View::make('recaudacion.reportes.op', compact('sql','UIT'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("OP.pdf");
        }
        if($tip=='4')
        {
            $sql = DB::select("select * from recaudacion.vw_op_detalle where id_gen_fis between ". str_replace("-", " and ", $id));

            if(count($sql)>=1)
            {
                for($i=0;$i<count($sql);$i++)
                {
                    $sql[$i]->fec_reg=$this->getCreatedAtAttribute($sql[$i]->fec_reg)->format('l d, F Y ');
                }
                $UIT =DB::table('adm_tri.uit')->where('anio',$sql[0]->anio)->get()->first();
            }
            $view =  \View::make('recaudacion.reportes.op_masivo', compact('sql','UIT'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->download("OP.pdf");
        }
        if($tip=='5')
        {
            $sql = DB::select("select * from recaudacion.vw_op_detalle where fec_reg between '".$sec."' and '".$man."'");

            if(count($sql)>=1)
            {
                for($i=0;$i<count($sql);$i++)
                {
                    $sql[$i]->fec_reg=$this->getCreatedAtAttribute($sql[$i]->fec_reg)->format('l d, F Y ');
                }
                $UIT =DB::table('adm_tri.uit')->where('anio',$sql[0]->anio)->get()->first();
            }
            $view =  \View::make('recaudacion.reportes.op_masivo', compact('sql','UIT'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("OP.pdf");
        }
    }
}
