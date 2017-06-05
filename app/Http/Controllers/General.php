<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class General extends Controller
{
    
    public function index() {
        return view('vw_general');
        
    }
    
    public function get_tipo_doc(Request $request) {
//        $table = DB::select('select * from tipo_documento');
//        dd($table);
        
        $doc = DB::table('tipo_documento')->get();
        
        $datos=array();
        for($y=0;$y<=(count($doc)-1);$y++){
            $Lista=array(); 
            $Lista['tip_doc']=$doc[$y]->tip_doc;
            $Lista['tipo_documento']=$doc[$y]->tipo_documento;            
            array_push($datos,$Lista);
        }
        if($request->ajax()){
            return response()->json($datos);
        }
    }
    public function get_cond_exonerac(Request $request) {
        $doc = DB::table('cond_exonerac')->get();
        
        $datos=array();
        for($y=0;$y<=(count($doc)-1);$y++){
            $Lista=array(); 
            $Lista['id_cond_exo']=$doc[$y]->id_cond_exo;
            $Lista['desc_cond_exon']=$doc[$y]->desc_cond_exon;            
            array_push($datos,$Lista);
        }
        if($request->ajax()){
            return response()->json($datos);
        }
    }
    
    function autocompletar_direccion(Request $request){
//        header("Content-Type: application/json"); 
        $data = $request->all();
//        $Consulta = DB::table('catastro.vw_vias')->where('nom_via','like','%'.$data['nom_via'].'%')->get();  
        $Consulta = DB::table('catastro.vw_vias')->get();  

        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new \stdClass();           
            $Lista->value=$Datos->id_via;
            $Lista->label=  trim($Datos->nom_via);           
            array_push($todo,$Lista);
        }        
        return response()->json($todo);
        
//                $table = DB::select('select * from catastro.vw_vias');  
//        dd($table);
    }
    /*****************************************COMBO  DEPARTAMENTO / PROVINCIA / DISTRITO **************************************/
    public function get_dpto() {
        $Consulta = DB::table('maysa.dpto')->get();
        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new \stdClass();           
            $Lista->cod=$Datos->cod;
            $Lista->dpto=  trim($Datos->dpto);           
            array_push($todo,$Lista);
        }        
        return response()->json($todo);        
    }
    
    public function get_prov(Request $request) {
        $Consulta = DB::table('maysa.prov')->where('cod',$request['cod_pdto'])->get();
        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new \stdClass();           
            $Lista->cod_prov  =  $Datos->cod_prov;
            $Lista->provinc   =  trim($Datos->provinc);           
            array_push($todo,$Lista);
        }        
        return response()->json($todo);        
    }
    
    public function get_dist(Request $request) {
        $Consulta = DB::table('maysa.dist')->where('cod_prov',$request['cod_prov'])->get();
        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new \stdClass();           
            $Lista->cod_dist  =  $Datos->cod_dist;
            $Lista->distrit   =  trim($Datos->distrit);           
            array_push($todo,$Lista);
        }        
        return response()->json($todo);        
    }
    
    
}
