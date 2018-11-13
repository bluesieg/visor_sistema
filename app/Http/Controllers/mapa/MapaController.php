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
        $permisos = DB::connection('pgsql')->select("SELECT * from permisos.vw_permisos where id_sistema='li_map_cris' and id_usu=".Auth::user()->id);
        $menu = DB::connection('pgsql')->select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $sectores = DB::connection('pgsql')->select('SELECT  id_sec, sector FROM catastro.sectores order by sector asc;');
        $anio_tra = DB::connection('pgsql')->select('select anio from adm_tri.uit order by anio desc');
        return view('cartografia/mapa_cris', compact('sectores','anio_tra','menu','permisos'));
    }
    function get_limites(){

        $limites =  DB::connection('pgsql')->select("SELECT json_build_object(
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
    function get_comisarias(){

        $cole = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       
                            'Feature',
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'nombre',nombre,
                                'id',id,
                                'x',x,
                                'y',y
                             )
                          ) AS feature
                          FROM (SELECT * FROM comisarias.comisar) row) features;");

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

        $planquebradas = DB::connection('pgsql')->select("SELECT json_build_object(
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

        $planquebradas = DB::connection('pgsql')->select("SELECT json_build_object(
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
        $leyenda = DB::select("SELECT count(gid) as total, layer,  color
            FROM catastro.aporte
            group by layer, color;");

        return response()->json($leyenda);
        
    }
    function leyenda_hab_urb()
    {
        $leyenda = DB::select("select count(id_hab_urb) as total,aprobado,color 
            from catastro.hab_urb 
            group by aprobado, color");
        return response()->json($leyenda);
        
    }
     function get_hab_urb($id){
        $where="";
        if($id>0)
        {
            $where='where id_hab_urb='.$id;
        }
       
        $sectores = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id_hab_urb',         id_hab_urb,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                              'codi_hab_urba',codi_hab_urba,
                              'nomb_hab_urba',nomb_hab_urba
                 
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.hab_urb ".$where.") row) features;");

        return response()->json($sectores);
    }
    public function get_lotes_x_hab_urb(Request $req){


        $lotes = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id_lote',         id_lote,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'id_lote', id_lote,
                                'id_mzna', id_mzna,
                                'codi_lote', codi_lote,
                                'id_hab_urb', id_hab_urb,
                                'id_sect',id_sect,
                                'codi_mzna',codi_mzna,
                                'sector',sector
                             )
                          ) AS feature
                          FROM (select l.id_lote, l.id_mzna,m.codi_mzna,s.sector, l.codi_lote, l.id_hab_urb, l.geom, m.id_sect from  catastro.lotes l
                                join catastro.manzanas m on m.id_mzna = l.id_mzna
                                join catastro.sectores s on s.id_sec=m.id_sect where id_hab_urb = '".$req->codigo."') row) features ;");

        return response()->json($lotes);
    }
    public function get_constancias($anio,$haburb,Request $req){

        $hab = DB::connection('gerencia_catastro')->select("select * from soft_const_posesion.vw_const_para_mapa where id_hab_urb=$haburb");
        if(count($hab)>=1)
        {
        $lotes = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id_lote',         id_lote,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'id_const',id_const,
                                'cod_lote',cod_lote,
                                'tipo',tipo,
                                'id_lote',id_lote,
                                'color',color
                             )
                          ) AS feature
                          FROM (select * from plan_constancias.vw_constancias_$anio where id_hab_urb=$haburb) row) features ;");
        return response()->json($lotes);
        }
        else
        {
            return 0;
        }
    }
   
    public function get_map_mod_hab_urb(Request $request,$color)
    {            
            $hab = DB::connection('gerencia_catastro')->select("select * from soft_hab_urbana.vw_habilit_$color");
            if(count($hab)>=1)
            {
             $hab = DB::connection('gerencia_catastro')->select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',
                            'Feature',
                            'geometry',
                            ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'nomb_hab_urba',nomb_hab_urba,
                                'id_hab_urb',id_hab_urb,
                                'fase',fase,
                                'id_reg_exp',id_reg_exp,
                                'color',color
                                
                             )
                          ) AS feature
                          FROM (select * from soft_hab_urbana.vw_habilit_$color ) row) features ;");
            return response()->json($hab);
            }
            else
            {
                return 0;
            }
            
        
        
        
    }
}
