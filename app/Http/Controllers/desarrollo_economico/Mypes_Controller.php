<?php

namespace App\Http\Controllers\desarrollo_economico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\desarrollo_economico\mypes;
use Illuminate\Support\Facades\Auth;

class Mypes_Controller extends Controller
{
    public function index()
    {
        return view('desarrollo_economico/vw_mypes');
    }

  
     public function create(Request $request)
    {
        
        if($request['tipo_create']=='mype')
        {
            return $this->create_mype($request);
        }
        if($request['tipo_create']=='observacion')
        {
            return $this->create_observacion_areas_verdes($request);
        }
    }
    public function create_mype(Request $request)
    {
        $mypes = new mypes;
        $mypes->id_usuario = Auth::user()->id;
        $mypes->fec_reg = date("d/m/Y");
        $mypes->id_lote = $request['id'];
        $mypes->ruc = $request['ruc'];
        $mypes->ubicacion = strtoupper($request['ubi']);
        $mypes->representante = strtoupper($request['rep']);
        
        $mypes->save();
        return $mypes->id_mype;
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
        if($id==0&&$request['grid']=="mapa_mypes")
        {
            return $this->mapa($request);
        }
    }
    public function show_normal($id)
    {
        $uno=DB::connection('gerencia_catastro')->table('desarrollo_economico_local.mypes')->where("id_lote",$id )->get();
        $dos=DB::connection('pgsql')->table('catastro.vw_lotes')->where("id_lote",$id )->get();
        $uno[0]->lote=$dos[0]->codi_lote;
        $uno[0]->manzana=$dos[0]->codi_mzna;
        $uno[0]->sector=$dos[0]->sector;
        return $uno;
    }
    public function edit($id, Request $request)
    {
       $mypes = new  mypes;
        $val=  $mypes::where("id_lote","=",$id )->first();
        if(count($val)>=1)
        {
            $val->id_usuario = Auth::user()->id;
            $val->id_lote = $request['id'];
            $val->ruc = $request['ruc'];
            $val->ubicacion = strtoupper($request['ubi']);
            $val->representante = strtoupper($request['rep']);
            $val->save();
        }
        return $id;
    }
   
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
        $verdes = DB::connection('gerencia_catastro')->select("SELECT * FROM desarrollo_economico_local.mypes");
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
