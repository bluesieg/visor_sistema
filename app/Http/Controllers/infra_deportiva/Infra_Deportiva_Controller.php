<?php

namespace App\Http\Controllers\infra_deportiva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\infra_deportiva\infr_deportiva;

class Infra_Deportiva_Controller extends Controller
{
 
    public function index()
    {
        return view('infra_deportiva/vw_deporte');
    }

     public function create(Request $request)
    {
        
        if($request['tipo_create']=='infra_deportiva')
        {
            return $this->create_infra_deportiva($request);
        }
        
    }
    public function create_infra_deportiva(Request $request)
    {
        $data = new infr_deportiva;
        $data->id_usuario = Auth::user()->id;
        $data->fec_reg = date("d/m/Y");
        $data->id_lote = $request['id'];
        $data->pertenencia = $request['prop'];
        $data->ubicacion = strtoupper($request['ubi']);
        $data->encargado = strtoupper($request['encargado']);
        
        $data->save();
        return $data->id_deporte;
    }

    public function store(Request $request)
    {
    }

     public function show($id, Request $request)
    {
        if($id>0)
        {
            return $this->show_normal($id);
        }
        if($id==0&&$request['grid']=="mapa_infra_deportiva")
        {
            return $this->mapa($request);
        }
    }
    public function show_normal($id)
    {
        $uno=DB::connection('gerencia_catastro')->table('infr_deportiva.infr_deportiva')->where("id_lote",$id )->get();
        $dos=DB::connection('pgsql')->table('catastro.vw_lotes')->where("id_lote",$id )->get();
        $uno[0]->lote=$dos[0]->codi_lote;
        $uno[0]->manzana=$dos[0]->codi_mzna;
        $uno[0]->sector=$dos[0]->sector;
        return $uno;
    }

      public function edit($id, Request $request)
    {
       $data = new  infr_deportiva;
        $val=  $data::where("id_lote","=",$id )->first();
        if(count($val)>=1)
        {
            $val->id_usuario = Auth::user()->id;
            $val->id_lote = $request['id'];
            $val->pertenencia = $request['prop'];
            $val->ubicacion = strtoupper($request['ubi']);
            $val->encargado = strtoupper($request['encargado']);
            $val->save();
        }
        return $id;
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    /////////////mapa
    function mapa(Request $request){
        $datos = DB::connection('gerencia_catastro')->select("SELECT * FROM infr_deportiva.infr_deportiva");
        $texto="";
        $inicio=0;
        foreach($datos as $seleccion)
        {
           if($inicio==0)
           {
               $texto=$seleccion->id_lote;
               $inicio=1;
           }
           else
           {
               $texto=$texto.",".$seleccion->id_lote;
           }
        }
        
        $rutas = DB::connection('pgsql')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_lote',id_lote,
                                'codi_lote', codi_lote
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.lotes where id_lote in (".$texto.")) row) features;");

        return response()->json($rutas);
    }

}
