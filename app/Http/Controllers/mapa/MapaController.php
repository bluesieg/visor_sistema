<?php

namespace App\Http\Controllers\mapa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MapaController extends Controller
{

    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_map_cris' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $sectores = DB::select('SELECT  id_sec, sector FROM catastro.sectores order by sector asc;');
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('cartografia/mapa_cris', compact('sectores','anio_tra','menu','permisos'));
    }
    function get_limites(){

        $limites =  DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'gid', gid,
                               'area_km2', area_km2,
                               'perimetro', perimetro,
                               'poblacion', poblacion,
                               'lim_norte', lim_norte,
                               'lim_sur', lim_sur,
                               'lim_este', lim_este,
                               'lim_oeste', lim_oeste,
                               'creacion', creacion
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.limites) row) features;");

        return response()->json($limites);

    }
    function get_pdm_zonificacion(){

        $zonificacion = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'gid',gid,
                                'zonificaci', zonificaci,
                                'color',color,
                                'id_zonif',id_zonif,
                                'color2',color2
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.zonificacion) row) features;");

        return response()->json($zonificacion);

      
    }
    function get_pdm_plan_vial(){

        $planvial = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'layer', layer,
                                'corte_via', corte_via,
                                'cod_vial', cod_vial,
                                'color',color
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.plan_vial) row) features;");

        return response()->json($planvial);
    }
    function get_colegios(){

        $cole = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'cen_edu_l',cen_edu_l,
                                'gid',id
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.colegios2) row) features;");

        return response()->json($cole);

      
    }
    function get_hospitales(){

        $cole = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'cen_edu_l',txtmemo,
                                'gid',id
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.equip_salud) row) features;");

        return response()->json($cole);

      
    }
    
    function get_quebradas(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'layer', layer,
                                'refname', refname,
                                'categoria', categoria
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.quebradas) row) features;");

        return response()->json($planquebradas);

      
    }
    function get_topografia(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'layer', layer,
                                'elevation', elevation
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.curvas_nivel) row) features;");

        return response()->json($planquebradas);

      
    }
    function get_carta_cotas(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'codigo', codigo
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro_cartas.c_33s_cotas) row) features;");

        return response()->json($planquebradas);

      
    }
    function get_carta_cua(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'codigo', codigo
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro_cartas.c_33s_cuad) row) features;");

        return response()->json($planquebradas);

      
    }
    function get_carta_curvas(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',gid,
                                'codigo', codigo
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro_cartas.c_33s_curvas) row) features;");

        return response()->json($planquebradas);

      
    }
    function get_carta_lagos(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',gid,
                                'codigo', codigo
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro_cartas.c_33s_lagos) row) features;");

        return response()->json($planquebradas);

      
    }
    function get_carta_rios(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'codigo', codigo,
                                'nombre',nombre
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro_cartas.c_33s_rios) row) features;");

        return response()->json($planquebradas);

      
    }
    function get_espeurba(Request $request){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'descrip',descrip,
                                'altura_de',altura_de,
                                'material_1',material_1,
                                'e_conserva',e_conserva,
                                'e_construc',e_construc,
                                'agua_',agua_,
                                'luz_',luz_,
                                'desague_',desague_,
                                'uso_1',uso_1,
                                'uso_2',uso_2,
                                'uso_3',uso_3,
                                'id_lote',id_lote
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro.expediente_urbano where id_lote like '".$request['codigo']."%') row) features;");

        return response()->json($planquebradas);

      
    }
    function get_extrac_pg(Request $request){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id,
                                'nombre',nombre
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro.extrac_pg) row) features;");

        return response()->json($planquebradas);
    }
    function get_extrac_pl(Request $request){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro.extracc_pl) row) features;");

        return response()->json($planquebradas);
    }
    function get_extrac_pt(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',fid
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro.extracc_pt) row) features;");

        return response()->json($planquebradas);
    }
    function get_limit_txt(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'gid',gid,
                                'refname',refname
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro.limit_vec_txt) row) features;");

        return response()->json($planquebradas);
    }
    function get_limit_veci(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id',id
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro.limites_vec) row) features;");

        return response()->json($planquebradas);
    }
    function get_puntosgeo_control(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'gid',gid
                             )
                          ) AS feature
                          FROM (SELECT * FROM  puntos.puntos_control) row) features;");

        return response()->json($planquebradas);
    }
    function get_puntosgeo(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'gid',gid
                             )
                          ) AS feature
                          FROM (SELECT * FROM  puntos.puntos_geod) row) features;");

        return response()->json($planquebradas);
    }
    function get_lotes_rurales(){

        $planquebradas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'fid',fid,
                                'uni_catas',cod_sector
                             )
                          ) AS feature
                          FROM (SELECT * FROM  catastro.lotes_rurales) row) features;");

        return response()->json($planquebradas);
    }
    function leyenda_aportes()
    {
        $leyenda = DB::select("SELECT layer,  color
            FROM catastro.aporte
            group by layer, color;");

        return response()->json($leyenda);
        
    }

}
