<?php

namespace App\Http\Controllers\areas_verdes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\areas_verdes\areas_verdes;

class Areas_Verdes_Controller extends Controller
{

    public function index()
    {
        return view('areas_verdes/vw_areas_verdes');
    }

      public function create(Request $request)
    {
        
        if($request['tipo_create']=='area_verde')
        {
            return $this->create_area_verde($request);
        }
        if($request['tipo_create']=='observacion')
        {
            return $this->create_observacion_areas_verdes($request);
        }
    }
    
    public function create_area_verde(Request $request)
    {
        $areas = new areas_verdes;
        $areas->id_lote = $request['id'];
        $areas->codigo = $request['cod'];
        $areas->ubicacion = strtoupper($request['ubi']);
        
        $areas->save();
        return $areas->id_areas_verdes;
    }
     public function create_observacion_areas_verdes(Request $request)
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


    public function show($id, Request $request)
    {
        if($id>0)
        {
            return $this->show_normal($id);
        }
        if($id==0&&$request['grid']=="mapa_areas_verdes")
        {
            return $this->mapa($request);
        }
    }
    public function show_normal($id)
    {
        $uno=DB::connection('gerencia_catastro')->table('areas_verdes.areas_verdes')->where("id_lote",$id )->get();
        $dos=DB::connection('pgsql')->table('catastro.vw_lotes')->where("id_lote",$id )->get();
        $uno[0]->lote=$dos[0]->codi_lote;
        $uno[0]->manzana=$dos[0]->codi_mzna;
        $uno[0]->sector=$dos[0]->sector;
        return $uno;
    }
     public function edit($id, Request $request)
    {
       $areas_verdes = new  areas_verdes;
        $val=  $areas_verdes::where("id_lote","=",$id )->first();
        if(count($val)>=1)
        {
            $val->codigo = $request['cod'];
            $val->ubicacion = strtoupper($request['ubi']);
            $val->id_lote = strtoupper($request['id']);
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
        $verdes = DB::connection('gerencia_catastro')->select("SELECT * FROM areas_verdes.areas_verdes");
        $texto="";
        $inicio=0;
        foreach($verdes as $areas)
        {
           if($inicio==0)
           {
               $texto=$areas->id_lote;
               $inicio=1;
           }
           else
           {
               $texto=$texto.",".$areas->id_lote;
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
