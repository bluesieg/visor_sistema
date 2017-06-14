<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Valores_Unitarios extends Controller {

    public function show_vw_val_unit() {
        return view('configuracion/vw_valores_unitarios');
    }

    function grid_val_unitarios(Request $request) {
        header('Content-type: application/json');

        $filtro = $request['filtro'];
        $totalg = DB::select("select count(id_val) as total from adm_tri.vw_val_unit where anio='" . $request['anio'] . "'");
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

        $sql = DB::table('adm_tri.vw_val_unit')->where('anio', $request['anio'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_val;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_val),
                trim($Datos->cod_val),
                trim($Datos->des_cat),
                trim($Datos->valor)
            );
        }
        return response()->json($Lista);
    }

    function magic_grid_valores_unit(Request $request) {
        $anio = $request['anio'];
//        $cod_val = DB::table('adm_tri.val_uni_descrip')->select('cod_val')->orderBy('cod_val')->get();
//        $cod_val['anio']=$anio;
//        $cod_val['p0']=$cod_val[0]->cod_val;
//        $todo = array();
//        for ($i = 0; $i < count($cod_val); $i++) {
//            $data=array();
//            $data['id_val']     = $anio.$cod_val[$i]->cod_val;
//            $data['cod_val']    = $cod_val[$i]->cod_val;
//            $data['anio']       = $anio;
//            $data['valor']      = 0.00;
//            array_push($todo,$data );
//        }
        
        $insert = DB::select('select adm_tri.f_agrega_val_unit('.$anio.')');
        

        if ($insert) {
            return response()->json([
                        'msg' => 'si',
            ]);
        } else
            return false;
        
//        dd($todo);
    }
    
    function update_valor_unitario(Request $request){
        $update = DB::table('adm_tri.val_unit')->where('id_val',$request['id_val'])->update(['valor'=>$request['valor']]);        

        if ($update) {
            return response()->json([
                        'msg' => 'si',
            ]);
        } else
            return false;
    }

}
