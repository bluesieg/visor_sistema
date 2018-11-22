<?php

namespace App\Http\Controllers\gduc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Infraestructura_Urbana_Controller extends Controller
{

    public function index()
    {
        
    }

    public function show($id,Request $request)
    {
        if ($id > 0) 
        {
            
        }
        else
        {
            if ($request['mapa'] == 'salud') 
            {
                return $this->cargar_mapa_salud();
            }
            if ($request['mapa'] == 'educacion') 
            {
                return $this->cargar_mapa_educacion();
            }
            if ($request['mapa'] == 'gubernamental') 
            {
                return $this->cargar_mapa_gubernamental();
            }
            if ($request['mapa'] == 'recreacion') 
            {
                return $this->cargar_mapa_recreacion();
            }
            if ($request['mapa'] == 'equipamiento') 
            {
                return $this->cargar_mapa_equipamiento();
            }
            if ($request['mapa'] == 'financiera') 
            {
                return $this->cargar_mapa_financiera();
            }
            if ($request['mapa'] == 'turistico') 
            {
                return $this->cargar_mapa_turistico();
            }
        }  
    }
    
    public function store(Request $request)
    {

    }
    
    public function create(Request $request)
    {
        
    }
    
    public function edit($id,Request $request)
    {
        
    }
    
    public function update(Request $request, $id)
    {
        
    }
    
    public function destroy(Request $request)
    {
        
    }
    
    public function cargar_mapa_salud()
    {
        $hospitales = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'text',text,
                                'cod_txt',cod_txt,
                                'cod_uso',cod_uso,
                                'cod_num',cod_num,
                                'cod_sector',cod_sector
                             )
                          ) AS feature
                          FROM (SELECT * FROM turismo.equipamiento_salud) row) features;");

        return response()->json($hospitales);
    }
    
    public function cargar_mapa_educacion()
    {
        $educacion = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'cen_edu_l',cen_edu_l
                             )
                          ) AS feature
                          FROM (SELECT * FROM turismo.educacion) row) features;");

        return response()->json($educacion);
    }
    
    public function cargar_mapa_gubernamental()
    {
        $educacion = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'text',text
                             )
                          ) AS feature
                          FROM (SELECT * FROM turismo.gubernamental) row) features;");

        return response()->json($educacion);
    } 
    
    public function cargar_mapa_recreacion()
    {
        $educacion = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'nombre1',nombre1
                             )
                          ) AS feature
                          FROM (SELECT * FROM turismo.recreacion) row) features;");

        return response()->json($educacion);
    } 
    
    public function cargar_mapa_equipamiento()
    {
        $educacion = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'equi_impor',equi_impor
                             )
                          ) AS feature
                          FROM (SELECT * FROM turismo.equipamiento) row) features;");

        return response()->json($educacion);
    } 
    
    public function cargar_mapa_financiera()
    {
        $educacion = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'fid',fid,
                                'nombre',nombre
                             )
                          ) AS feature
                          FROM (SELECT * FROM turismo.ent_financieras) row) features;");

        return response()->json($educacion);
    }
    
    public function cargar_mapa_turistico()
    {
        $educacion = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'fid',fid,
                                'nombre',nombre
                             )
                          ) AS feature
                          FROM (SELECT * FROM turismo.atract_turist) row) features;");

        return response()->json($educacion);
    } 
}
