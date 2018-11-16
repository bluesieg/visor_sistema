<?php

namespace App\Http\Controllers\limpieza_publica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\limpieza_publica\observacones_botaderos;
use Illuminate\Support\Facades\Auth;
use App\Models\limpieza_publica\botaderos;

class Botaderos_controller extends Controller
{
    
    public function index()
    {
        return view('limpieza_publica/vw_botaderos');
    }

      public function create(Request $request)
    {
        
        if($request['tipo_create']=='observacion')
        {
            return $this->create_observacion_contenedor($request);
        }
    }
    public function create_observacion_contenedor(Request $request)
    {
        $obs = new observacones_botaderos;
        $obs->id_botadero = $request['id'];
        $obs->observacion = $request['obs'];
        $obs->fec_obs = $request['fecha'];
        $obs->fec_reg = date("d/m/Y");
        $obs->usuario = Auth::user()->id;
        $obs->save();
        return $obs->id_obs_botaderos;
    }

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
    public function show($id, Request $request)
    {
        if($id>0)
        {
            return $this->show_normal($id);
        }
        if($id==0&&$request['grid']=="mapa_botaderos")
        {
            return $this->mapa($request);
        }
         if($id==0&&$request['grid']=="observacion")
        {
            return $this->list_observacion_botaderos($request);
        }
    }
    public function show_normal($id)
    {
        return DB::connection('gerencia_catastro')->table('limpieza_publica.botaderos')->where("id_botadero",$id )->get();
    }
    public function list_observacion_botaderos(Request $request)
    {
        $codigo = strtoupper($request['cod']);
        return DB::connection('gerencia_catastro')->table('limpieza_publica.observaciones_botaderos')->where("id_botadero",$codigo)->orderBy('id_obs_botaderos','desc' )->get();
    }

    public function edit($id, Request $request)
    {
       $botaderos = new  botaderos;
        $val=  $botaderos::where("id_botadero","=",$id )->first();
        if(count($val)>=1)
        {
            $val->cod_botadero = $request['cod'];
            $val->ubicacion = strtoupper($request['ubi']);
            $val->save();
        }
        return $id;
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
     /////////////mapa
    function mapa(Request $request){
        $rutas = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_botadero',id_botadero,
                                'cod_botadero', cod_botadero
                             )
                          ) AS feature
                          FROM (SELECT * FROM limpieza_publica.botaderos) row) features;");

        return response()->json($rutas);
    }
}
