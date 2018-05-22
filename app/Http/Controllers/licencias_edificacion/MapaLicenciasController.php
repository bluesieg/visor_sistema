<?php

namespace App\Http\Controllers\licencias_edificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\licencias_edificacion\RecDocumentos;


class MapaLicenciasController extends Controller
{
    public function index()
    {
        return view('licencias_edificacion/wv_recdocumentos');
    }
    
    function get_mapa_licencias_eficiacion($color,$haburb,Request $request)
    {
        
        if ($color == 1) {
            
            $hab = DB::connection('gerencia_catastro')->select("select * from soft_lic_edificacion.vw_licencias_amarillo where id_hab_urb=$haburb");
            if(count($hab)>=1)
            {
            $licencias_rojo = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                            )
                            FROM (
                              SELECT json_build_object(
                                'type',       'Feature',
                                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                                'properties', json_build_object(
                                    'id_reg_exp',id_reg_exp,
                                    'id_lote', id_lote,
                                    'id_hab_urb', id_hab_urb
                                 )
                              ) AS feature
                              FROM (SELECT * FROM soft_lic_edificacion.vw_licencias_amarillo where id_hab_urb=$haburb) row) features;");

            return response()->json($licencias_rojo);
            }
            else
            {
                return 0;
            }
            
        }
        
        if ($color == 2) {
            
            $hab = DB::connection('gerencia_catastro')->select("select * from soft_lic_edificacion.vw_licencias_verde where id_hab_urb=$haburb");
            if(count($hab)>=1)
            {
            $licencias_rojo = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                            )
                            FROM (
                              SELECT json_build_object(
                                'type',       'Feature',
                                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                                'properties', json_build_object(
                                    'id_reg_exp',id_reg_exp,
                                    'id_lote', id_lote,
                                    'id_hab_urb', id_hab_urb
                                 )
                              ) AS feature
                              FROM (SELECT * FROM soft_lic_edificacion.vw_licencias_verde where id_hab_urb=$haburb) row) features;");

            return response()->json($licencias_rojo);
            }
            else
            {
                return 0;
            }

        }
        
        if ($color == 3) {
            
            $hab = DB::connection('gerencia_catastro')->select("select * from soft_lic_edificacion.vw_licencias_rojo where id_hab_urb=$haburb");
            if(count($hab)>=1)
            {
            $licencias_rojo = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                            )
                            FROM (
                              SELECT json_build_object(
                                'type',       'Feature',
                                'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                                'properties', json_build_object(
                                    'id_reg_exp',id_reg_exp,
                                    'id_lote', id_lote,
                                    'id_hab_urb', id_hab_urb
                                 )
                              ) AS feature
                              FROM (SELECT * FROM soft_lic_edificacion.vw_licencias_rojo where id_hab_urb=$haburb) row) features;");

            return response()->json($licencias_rojo);
            }
            else
            {
                return 0;
            }
            
        }
        
    }
 
}
