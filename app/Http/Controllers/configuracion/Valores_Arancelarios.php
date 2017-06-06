<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Valores_Arancelarios extends Controller
{
    public function vw_val_arancel() {
        return view('configuracion/vw_valores_arancelarios');
    }
    
    function get_anio(){
        $Consulta = DB::table('adm_tri.vw_uit')->select('anio')->get();

        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new \stdClass();           
            $Lista->anio=$Datos->anio;                      
            array_push($todo,$Lista);
        }        
        return response()->json($todo);
    }
    function get_sector(){
        $Consulta = DB::table('catastro.vw_sector')->get();

        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new \stdClass();           
            $Lista->id_sec=$Datos->id_sec;   
            $Lista->sector=$Datos->sector;   
            array_push($todo,$Lista);
        }        
        return response()->json($todo);
    }
    function get_mzna(){
        $Consulta = DB::table('catastro.vw_manzanas')->get();

        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new \stdClass();           
            $Lista->id_mzna=$Datos->id_mzna;   
            $Lista->codi_mzna=$Datos->codi_mzna;   
            array_push($todo,$Lista);
        }        
        return response()->json($todo);
    }
}
