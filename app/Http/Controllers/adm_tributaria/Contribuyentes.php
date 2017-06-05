<?php

namespace App\Http\Controllers\adm_tributaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Contribuyentes extends Controller
{
    public function vw_contribuyentes() {
        return view('adm_tributaria/vw_contribuyentes');
    }
    
    public function index() {
        header('Content-type: application/json');
        $totalg = DB::select('select count(id_pers) as total from vw_contribuyentes_vias');
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

        $sql = DB::table('vw_contribuyentes_vias')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_pers;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_pers),
                trim($Datos->id_persona),
                trim($Datos->tipo_doc),
                trim($Datos->nro_doc),
                trim($Datos->contribuyente), 
                trim($Datos->cod_via),
                trim($Datos->nom_via),
                trim($Datos->tlfno_fijo),
                trim($Datos->tlfono_celular)               
                
            );
        }
        return response()->json($Lista);
    }
    
    function llenar_form_contribuyentes(Request $request){
        
        $Consulta = DB::table('contribuyentes')->where('id_pers',$request['id_pers'])->get();
        $Lista=new \stdClass();
        foreach($Consulta as $Datos){                     
            $Lista->id_persona      =  trim($Datos->id_persona);
            $Lista->nro_doc         =  trim($Datos->nro_doc);
            $Lista->ape_pat         =  trim($Datos->ape_pat);
            $Lista->ape_mat         =  trim($Datos->ape_mat);
            $Lista->nombres         =  trim($Datos->nombres);
            $Lista->sexo            =  trim($Datos->sexo);
            $Lista->fnac            =  trim($Datos->fnac);
            $Lista->tipo_persona    =  trim($Datos->tipo_persona);
            $Lista->tipo_doc        =  trim($Datos->tipo_doc);
            $Lista->raz_soc         =  trim($Datos->raz_soc);
            $Lista->tlfno_fijo      =  trim($Datos->tlfno_fijo);
            $Lista->tlfono_celular  =  trim($Datos->tlfono_celular);
            $Lista->email           =  trim($Datos->email);
            $Lista->dom_fiscal      =  trim($Datos->dom_fiscal);
            $Lista->est_civil       =  trim($Datos->est_civil);
            $Lista->nro_doc_conv    =  trim($Datos->nro_doc_conv);
            $Lista->conviviente     =  trim($Datos->conviviente);
            $Lista->id_prov         =  trim($Datos->id_prov);
            $Lista->id_dist         =  trim($Datos->id_dist);
            $Lista->nro_mun         =  trim($Datos->nro_mun);
            $Lista->dpto            =  trim($Datos->dpto);
            $Lista->manz            =  trim($Datos->manz);
            $Lista->lote            =  trim($Datos->lote);
            $Lista->activo          =  trim($Datos->activo);
            $Lista->id_dpto         =  trim($Datos->id_dpto);
            $Lista->id_cond_exonerac=  trim($Datos->id_cond_exonerac);
            $Lista->id_via          =  trim($Datos->id_via);
            $Lista->tip_doc_conv    =  trim($Datos->tip_doc_conv);            
        }        
        return response()->json($Lista);
    }
    
    public function insert_new_contribuyente(Request $request){
        header('Content-type: application/json');
        
        
        $data = $request->all();        
        $id_persona = $request['tipo_persona'].$request['tipo_doc'].$request['nro_doc'];
        $data['id_persona'] = $id_persona;
        $data['dpto'] = '0';
        
        $insert=DB::table('contribuyentes')->insert($data);
        
        if ($insert) return response()->json($data);
        else return false;
    }
    
    function eliminar_contribuyente(Request $request){
//        $user = DB::table('adm_tri.contribuyentes')->select('usuario')->where('id_pers', '=', $request['id'])->get();
        $delete = DB::table('adm_tri.contribuyentes')->where('id_pers', $request['id'])->delete();

        if ($delete) {
            return response()->json([
                        'msg' => 'si',
            ]);
        }
    }
    
    function modificar_contribuyente(Request $request) {
        $data = $request->all(); 
        unset($data['id_pers']);
        $update=DB::table('adm_tri.contribuyentes')->where('id_pers',$request['id_pers'])->update($data);
        if ($update){  
            return response()->json([
                        'msg' => 'si',
            ]);
        }else return false;
    }
}
