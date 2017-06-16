<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Valores_Arancelarios extends Controller {

    public function vw_val_arancel() {
        return view('configuracion/vw_valores_arancelarios');
    }

    function grid_valores_arancelarios(Request $request) {

        header('Content-type: application/json');

        $filtro = $request['filtro'];
        $totalg = DB::select("select count(id_arancel) as total from catastro.vw_arancel where filtro='" . $filtro . "'");
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

        $sql = DB::table('catastro.vw_arancel')->where('filtro', $filtro)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_arancel;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_arancel),
                trim($Datos->sec),
                trim($Datos->mzna),
                trim($Datos->cod_via),
                trim($Datos->nom_via),
                trim($Datos->val_ara),
                trim($Datos->id_via)
            );
        }
        return response()->json($Lista);
    }

    function get_anio() {
        $Consulta = DB::table('adm_tri.vw_uit')->select('anio')->get();

        $todo = array();
        foreach ($Consulta as $Datos) {
            $Lista = new \stdClass();
            $Lista->anio = $Datos->anio;
            array_push($todo, $Lista);
        }
        return response()->json($todo);
    }

    function get_sector() {
        $Consulta = DB::table('catastro.vw_sector')->get();

        $todo = array();
        foreach ($Consulta as $Datos) {
            $Lista = new \stdClass();
            $Lista->sector = $Datos->sector;
            array_push($todo, $Lista);
        }
        return response()->json($todo);
    }

    function get_mzna(Request $request) {
        $Consulta = DB::table('catastro.vw_manzanas')->where('id_sec', $request['id_sec'])->get();

        $todo = array();
        foreach ($Consulta as $Datos) {
            $Lista = new \stdClass();
            $Lista->codi_mzna = $Datos->codi_mzna;
            array_push($todo, $Lista);
        }
        return response()->json($todo);
    }

    function get_autocomplete_nom_via(Request $request) {
        $Consulta = DB::table('catastro.vw_vias_cod')->where('cod_via', $request['cod_via'])->get();
        if (isset($Consulta[0]->id_via)) {
            return response()->json([
                        'msg' => 'si',
                        'id_via' => $Consulta[0]->id_via,
                        'cod_via' => $Consulta[0]->cod_via,
                        'via_compl' => $Consulta[0]->via_compl,
            ]);
        } else {
            return response()->json([
                        'msg' => 'no',
            ]);
        }
    }

    function insert_valor_arancel(Request $request) {
        header('Content-type: application/json');
        $data = $request->all();
        $cod_arancel = $request['anio'] . $request['sec'] . $request['mzna'] . $request['cod_via'];
        $data['cod_arancel'] = $cod_arancel;

        $insert = DB::table('catastro.arancel')->insert($data);

        if ($insert) {
            return response()->json([
                        'msg' => 'si',
            ]);
        } else{
            return response()->json([
                        'msg' => 'no',
            ]);
        }
            
    }

    function update_valor_arancel(Request $request) {
        $data = $request->all();
        $update = DB::table('catastro.arancel')->where('id_arancel', $data['id_arancel'])->update($data);

        if ($update) {
            return response()->json([
                        'msg' => 'si',
            ]);
        } else
            return false;
    }

    function delete_valor_arancel(Request $request) {
        $delete = DB::table('catastro.arancel')->where('id_arancel', $request['id_arancel'])->delete();
        if ($delete) {
            return response()->json([
                        'msg' => 'si',
            ]);
        } else
            return false;
    }

}
