<?php

namespace App\Http\Controllers\fiscalizacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\fiscalizacion\Carta_Requerimiento;
use App\Models\fiscalizacion\Fisca_Enviados;
use App\Traits\DatesTranslator;

class Res_DeterminacionController extends Controller
{
    use DatesTranslator;
    public function index()
    {
        //
    }

    public function create()
    {
        //
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
    public function carta_requerimiento()
    {
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        $fiscalizadores = DB::select('select * from fiscalizacion.vw_fiscalizadores where flg_act=1');
        return view('fiscalizacion/vw_carta_requerimiento',compact('anio_tra','fiscalizadores'));
    }
    public function carta_create(Request $request)
    {
        $carta=new Carta_Requerimiento;
        $carta->id_contrib=$request['contri'];
        $carta->fec_reg=date("d/m/Y");
        $carta->fec_fis=$request['fec'];
        $carta->anio=date("Y");
        $carta->save();
        return $carta->id_car;
    }
    public function fisca_enviados_create(Request $request)
    {
        $fisca=new Fisca_Enviados;
        $fisca->id_car=$request['car'];
        $fisca->id_user_fis=$request['fis'];
        $fisca->save();
        return $fisca->id_fis_env;
    }
    public function get_cartas_req($an,$contrib,$ini,$fin,Request $request)
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
                    $totalg = DB::select("select count(id_car) as total from fiscalizacion.vw_carta_requerimiento where fec_reg between '".$ini."' and '".$fin."'");
                    $sql = DB::table('fiscalizacion.vw_carta_requerimiento')->wherebetween("fec_reg",[$ini,$fin])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                }
                else
                {
                    $totalg = DB::select('select count(id_car) as total from fiscalizacion.vw_carta_requerimiento where anio='.$an);
                    $sql = DB::table('fiscalizacion.vw_carta_requerimiento')->where("anio",$an)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
                }
            }
            else
            {
              $totalg = DB::select('select count(id_car) as total from fiscalizacion.vw_carta_requerimiento where anio='.$an.' and id_contrib='.$contrib);
              $sql = DB::table('fiscalizacion.vw_carta_requerimiento')->where("anio",$an)->where("id_contrib",$contrib)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
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
                
                $Lista->rows[$Index]['id'] = $Datos->id_car;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_car),
                    trim($Datos->nro_car),
                    trim($Datos->contribuyente),
                    trim($this->getCreatedAtAttribute($Datos->fec_reg)->format('d/m/Y')),
                    trim($this->getCreatedAtAttribute($Datos->fec_fis)->format('d/m/Y')),
                    '<button class="btn btn-labeled bg-color-blueDark txt-color-white" type="button" onclick="veralcab('.trim($Datos->id_car).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver</button>',
                );
            }
            return response()->json($Lista);
    }
}
