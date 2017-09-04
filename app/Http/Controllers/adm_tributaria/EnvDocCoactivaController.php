<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EnvDocCoactivaController extends Controller
{

    public function index()
    {
        return view('adm_tributaria.vw_env_doc_coactiva');
    }

    public function create()
    {}

    public function edit($id)
    {   }

    public function update(Request $request, $id)
    {   }

    public function destroy($id)
    {   }
    
    public function fis_getOP(Request $request)
    {   
        $id_contrib=$request['id_contrib'];
        $tip_doc=$request['tip_doc'];
        
        if($tip_doc=='1'){
            $totalg = DB::select('select count(id_per) as total from recaudacion.vw_genera_fisca where id_per='.$id_contrib);
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

            $sql = DB::table('recaudacion.vw_genera_fisca')->where('id_per',$id_contrib)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
            $Lista = new \stdClass();
            $Lista->page = $page;
            $Lista->total = $total_pages;
            $Lista->records = $count;

            foreach ($sql as $Index => $Datos) {
                $Lista->rows[$Index]['id'] = $Datos->id_gen_fis;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id_gen_fis),
                    trim($Datos->nro_fis),
                    date('d-m-Y', strtotime($Datos->fec_reg)),
                    trim($Datos->anio),
                    trim($Datos->nro_doc),
                    str_replace('-','',trim($Datos->contribuyente)),
                    '<button class="btn btn-labeled bg-color-blueDark txt-color-white" type="button" onclick="verop('.trim($Datos->id_gen_fis).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver OP</button>',
                    "<input type='checkbox' onclick='array_doc(".$Datos->id_gen_fis.",this)'>"
                );
            }
            return response()->json($Lista);
        }else{
            return response()->json(['msg'=>'no']);
        }        
        
    }
}
