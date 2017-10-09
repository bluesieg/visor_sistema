<?php

namespace App\Http\Controllers\fiscalizacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Traits\DatesTranslator;
use Illuminate\Support\Facades\Auth;
use App\Models\fiscalizacion\Resolucion_Determinacion;

class Res_DeterminacionController extends Controller
{
    use DatesTranslator;
    public function index()
    {
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('fiscalizacion/vw_res_deter',compact('anio_tra'));
    }

    public function create(Request $request)
    {
        $rd=new Resolucion_Determinacion;
        $rd->id_hoja_liq=$request['hoja'];
        $rd->fec_reg=date("d/m/Y");
        $rd->anio=date("Y");
        $rd->id_usuario=Auth::user()->id;;
        $rd->save();
        return $rd->id_rd;
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
    public function get_rd($an,$contrib,$ini,$fin,$num,Request $request)
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
            if($contrib==0)
            {
                if($an==0)
                {
                    $totalg = DB::select("select count(id_rd) as total from  fiscalizacion.vw_resolucion_determinacion where fec_reg between '".$ini."' and '".$fin."'");
                    $sql = DB::table('fiscalizacion.vw_resolucion_determinacion')->wherebetween("fec_reg",[$ini,$fin])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    
                }
                else
                {
                    if($num==0)
                    {
                        $totalg = DB::select('select count(id_rd) as total from fiscalizacion.vw_resolucion_determinacion where anio='.$an);
                        $sql = DB::table('fiscalizacion.vw_resolucion_determinacion')->where("anio",$an)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    }
                    else
                    {
                        $totalg = DB::select("select count(id_rd) as total from fiscalizacion.vw_resolucion_determinacion where nro_rd='".$num."' and anio=".$an);
                        $sql = DB::table('fiscalizacion.vw_resolucion_determinacion')->where("anio",$an)->where("nro_hoja",$num)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                    }
                }
            }
            else
            {
              $totalg = DB::select('select count(id_rd) as total from fiscalizacion.vw_resolucion_determinacion where anio='.$an.' and id_contrib='.$contrib);
              $sql = DB::table('fiscalizacion.vw_resolucion_determinacion')->where("anio",$an)->where("id_contrib",$contrib)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
                $Lista->rows[$Index]['id'] = $Datos->id_rd;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_rd),
                    trim($Datos->nro_rd),
                    trim($Datos->contribuyente),
                    trim($this->getCreatedAtAttribute($Datos->fec_reg)->format('d/m/Y')),
                    '<button class="btn btn-labeled btn-warning" type="button" onclick="verrd('.trim($Datos->id_rd).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver</button>',
                );
            }
            return response()->json($Lista);
    }
    public function rd_repo($id)
    {
        $sql    =DB::table('fiscalizacion.vw_resolucion_determinacion')->where('id_hoja_liq',$id)->get()->first();
        if(count($sql)>=1)
        {
            $fichas    =DB::table('fiscalizacion.vw_ficha_verificacion')->where('id_car',$sql->id_car)->get();
            $predios=DB::table('fiscalizacion.vw_puente_carta_predios')->where('id_car',$sql->id_car)->get();
            $sql->letras = $this->num_letras($sql->ivpp_verif-$sql->pagado+4.64);
            $sql->fec_reg=$this->getCreatedAtAttribute($sql->fec_reg)->format('l d \d\e F \d\e\l Y ');
            $sql->fec_carta=$this->getCreatedAtAttribute($sql->fec_carta)->format('l d \d\e F \d\e\l Y ');
            $view =  \View::make('fiscalizacion.reportes.rd', compact('sql','fichas','predios'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream("rd.pdf");
        }
    }
    
}
